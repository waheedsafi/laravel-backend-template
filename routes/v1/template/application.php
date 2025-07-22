
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\template\ApplicationController;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

Route::prefix('v1')->group(function () {
    Route::get('/lang/{locale}', [ApplicationController::class, 'changeLocale']);
    Route::get('/locales/{lang}/{namespace}', [ApplicationController::class, 'getTranslations']);
    Route::get('/system-font/{direction}', [ApplicationController::class, "font"]);
    Route::get('/nationalities', [ApplicationController::class, "nationalities"]);
    Route::get('/nid/types', [ApplicationController::class, "nidTypes"]);
    Route::get('/genders', [ApplicationController::class, "genders"]);
    Route::get('/currencies', [ApplicationController::class, "currencies"]);
    Route::get('/fonts/{filename}', [ApplicationController::class, "fonts"]);
});
// Route::prefix('v1')->middleware(["multiAuthorized:" . 'user:api,ngo:api'])->group(function () {
//     Route::post('/validate/email/contact', [ApplicationController::class, "validateEmailContact"]);
// });
