<?php

namespace App\Http\Controllers\v1\template;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use App\Enums\Languages\LanguageEnum;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\v1\applications\ApplicationUpdateRequest;
use App\Models\Application;
use App\Models\ApplicationTrans;

class ApplicationController extends Controller
{
    private $cacheName;

    public function __construct()
    {
        $this->cacheName = 'application_details';
    }

    public function changeLocale($locale)
    {
        // Set the language in a cookie
        if ($locale === "en" || $locale === "fa" || $locale === "ps") {
            // 1. Set app language
            App::setLocale($locale);

            $cookie = cookie(
                'locale',
                $locale,
                60 * 24 * 30,
                '/',
                null,                          // null: use current domain
                true,                 // secure only in production
                true,                         // httpOnly
                false,                         // raw
                'None' // for dev, use 'None' to allow cross-origin if needed
            );
            return response()->json([
                'message' => __('app_translation.lang_change_success'),
            ], 200, [], JSON_UNESCAPED_UNICODE)->cookie($cookie);
        } else {
            // 3. Passed language not exist in system
            response()->json([
                'message' => __('app_translation.lang_change_failed'),
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function getTranslations($lang, $namespace)
    {
        App::setLocale($lang);
        $translations = Lang::get($namespace);
        return response()
            ->json($translations)
            ->header('Cache-Control', 'no-store'); // disable HTTP caching
    }
    public function fonts($filename)
    {
        $path = public_path('fonts/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $response = response()->file($path);
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:5173');

        return $response;
    }

    public function applications()
    {
        $locale = App::getLocale();
        $query  = Cache::remember($this->cacheName, 1800, function () use ($locale) {
            return DB::table('applications as app')
                ->join('application_trans as appt', function ($join) use ($locale) {
                    $join->on('appt.application_id', '=', 'app.id')
                        ->where('appt.language_name', '=', $locale);
                })
                ->select(
                    'app.id',
                    'app.cast_to',
                    'app.value',
                    'appt.description',
                    'appt.value as name',
                )
                ->get();
        });
        return response()->json(
            $query,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
    public function updateApplication(ApplicationUpdateRequest $request)
    {
        $request->validated();
        // 1. Create
        $application = Application::find($request->id);
        if (!$application) {
            return response()->json([
                'message' => __('app_translation.application_not_found')
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }
        DB::beginTransaction();

        $application->value = $request->value;
        $application->save();
        DB::commit();

        Cache::forget($this->cacheName);

        return response()->json([
            'message' => __('app_translation.success'),
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
