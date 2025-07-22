<?php

namespace App\Http\Controllers\v1\template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\Types\AboutStaffEnum;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function office()
    {
        $locale = App::getLocale();
        $office = DB::table('office_information as oi')
            ->join('office_information_trans as oit', function ($join) use (&$locale) {
                $join->on('oit.office_information_id', '=', 'oi.id')
                    ->where('oit.language_name', $locale);
            })
            ->select(
                'oi.contact',
                'oi.email',
                'oit.value as address'
            )
            ->first();

        return response()->json(
            $office,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
    public function staffs()
    {
        $locale = App::getLocale();
        $query = DB::table('about_staff as as')
            ->join('about_staff_trans as ast', function ($join) use ($locale) {
                $join->on('ast.about_staff_id', '=', 'as.id')
                    ->where('ast.language_name', '=', $locale);
            })
            ->join('about_staff_type_trans as astt', function ($join) use ($locale) {
                $join->on('astt.about_staff_type_id', '=', 'as.about_staff_type_id')
                    ->where('astt.language_name', '=', $locale);
            })
            ->select(
                'as.id',
                'as.contact',
                'as.email',
                'as.profile as picture',
                'ast.name',
                'astt.value as job'
            )
            ->get();
        return response()->json(
            $query,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
