
<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;
use App\Http\Controllers\v1\template\ApplicationController;

Route::prefix('v1')->group(function () {
    Route::get('/lang/{locale}', [ApplicationController::class, 'changeLocale']);
    Route::get('/locales/{lang}/{namespace}', [ApplicationController::class, 'getTranslations']);
    Route::get('/system-font/{direction}', [ApplicationController::class, "font"]);
    Route::get('/nationalities', [ApplicationController::class, "nationalities"]);
    Route::get('/nid/types', [ApplicationController::class, "nidTypes"]);
    Route::get('/genders', [ApplicationController::class, "genders"]);
    Route::get('/currencies', [ApplicationController::class, "currencies"]);
    Route::get('/fonts/{filename}', [ApplicationController::class, "fonts"]);

    // Applications
    Route::get('/applications', [ApplicationController::class, "applications"]);
    Route::put('/applications', [ApplicationController::class, "updateApplication"]);
});
