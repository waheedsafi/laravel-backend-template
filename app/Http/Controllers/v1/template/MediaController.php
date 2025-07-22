<?php

namespace App\Http\Controllers\v1\template;

use Illuminate\Http\Request;
use App\Traits\Helper\HelperTrait;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    use HelperTrait;
    public function publicFile(Request $request)
    {
        $filePath = $request->input('path');
        $path = $this->transformToPublic($filePath);

        if (!file_exists($path)) {
            return response()->json([
                'message' => __('app_translation.file_not_found'),
                'path' => $path,
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }
        return response()->file($path);
    }
}
