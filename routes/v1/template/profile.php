
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\template\ProfileController;

Route::prefix('v1')->middleware(["authorized:" . 'user:api'])->group(function () {
    Route::post('/profiles-users/picture', [ProfileController::class, 'updatePicture']);
    Route::post('/profiles-users', [ProfileController::class, 'update']);
});
Route::prefix('v1')->middleware(["multiAuthorized:" . 'user:api'])->group(function () {
    Route::delete('/profiles', [ProfileController::class, 'delete']);
    Route::post('/profiles/change-password', [ProfileController::class, 'changePassword']);
});
