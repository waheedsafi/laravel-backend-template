<?php

namespace App\Http\Controllers\v1\template;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $locale =  App::getLocale();

        $faqs = DB::table('faqs')
            ->join('faq_trans', function ($join) use ($locale) {
                $join->on('faqs.id', '=', 'faq_trans.faq_id')
                    ->where('faq_trans.language_name', '=', $locale);
            })
            ->join('faq_types', 'faq_types.id', '=', 'faqs.faq_type_id')
            ->join('faq_type_trans', function ($join) use ($locale) {
                $join->on('faq_types.id', '=', 'faq_type_trans.faq_type_id')
                    ->where('faq_type_trans.language_name', '=', $locale);
            })
            ->where('faqs.is_active', true)
            ->select([
                'faq_type_trans.value as type_name',
                'faq_trans.question',
                'faq_trans.answer',
                'faqs.order',
            ])
            ->orderBy('faq_types.id')
            ->orderBy('faqs.order')
            ->get()
            ->groupBy('type_name');  // Group by the FAQ type name

        return response()->json(
            $faqs,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
