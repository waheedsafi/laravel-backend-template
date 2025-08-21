
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\template\MediaController;

// Route::prefix('v1')->middleware(["multiAuthorized:" . 'user:api,ngo:api,donor:api'])->group(function () {
//     Route::get('/media/profile', [MediaController::class, "downloadProfile"]);
//     Route::get('/temp/media', [MediaController::class, "tempMediadownload"]);
//     Route::get('/ngo/media', [MediaController::class, "ngoMediadownload"]);
// });
Route::prefix('v1')->group(function () {
    Route::get('/media/public', [MediaController::class, "publicFile"]);
});
Route::prefix('v1')->middleware(["authorized:" . 'user:api'])->group(function () {
    Route::get('/media/profile', [MediaController::class, "profileFile"]);
    Route::get('/media/private', [MediaController::class, "privateFile"]);
});
