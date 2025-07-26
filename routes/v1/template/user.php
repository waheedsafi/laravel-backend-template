
<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;
use App\Http\Controllers\v1\template\UserController;


Route::prefix('v1')->middleware(["authorized:" . 'user:api'])->group(function () {
    Route::get('/users/statistics', [UserController::class, "userStatistics"])->middleware(["userHasMainPermission:" . PermissionEnum::users->value . ',' . 'view']);
    Route::get('/users', [UserController::class, "users"])->middleware(["userHasMainPermission:" . PermissionEnum::users->value . ',' . 'view']);
    Route::get('/user/{id}', [UserController::class, "user"])->middleware(["userHasMainPermission:" . PermissionEnum::users->value . ',' . 'view']);
    Route::delete('/user/delete/profile-picture/{id}', [UserController::class, 'deleteProfilePicture'])->middleware(['checkUserAccess', "userHasMainPermission:" . PermissionEnum::users->value . ',' . 'delete']);
    Route::post('/user/update/profile-picture', [UserController::class, 'updateProfilePicture'])->middleware(['checkUserAccess', "userHasMainPermission:" . PermissionEnum::users->value . ',' . 'edit']);
    Route::post('/user/update/information', [UserController::class, 'updateInformation'])->middleware(["userHasSubPermission:" . PermissionEnum::users->value . "," . SubPermissionEnum::user_information->value . ',' . 'edit']);
    Route::post('/user/store', [UserController::class, 'store'])->middleware(["userHasMainPermission:" . PermissionEnum::users->value . ',' . 'add']);
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware(["userHasMainPermission:" . PermissionEnum::users->value . ',' . 'delete']);
    Route::post('/user/validate/email/contact', [UserController::class, "validateEmailContact"]);
    Route::post('/user/account/change-password', [UserController::class, 'changePassword'])->middleware(["userHasSubPermission:" . PermissionEnum::users->value . "," . SubPermissionEnum::user_password->value . ',' . 'edit']);
});
