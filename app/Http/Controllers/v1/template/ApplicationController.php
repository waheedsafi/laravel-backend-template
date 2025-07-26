<?php

namespace App\Http\Controllers\v1\template;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\File;

class ApplicationController extends Controller
{
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
}
