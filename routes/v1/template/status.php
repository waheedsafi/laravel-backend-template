
<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;
use App\Http\Controllers\v1\template\StatusController;


Route::prefix('v1')->middleware(["authorized:" . 'user:api'])->group(function () {
    Route::post('/statuses/user', [StatusController::class, "storeUser"])->middleware(["userHasSubPermission:" . PermissionEnum::users->value . "," . SubPermissionEnum::user_account_status->value . ',' . 'edit']);
    Route::get('/statuses/modify/user/{id}', [StatusController::class, "userIndex"])->middleware(["userHasSubPermission:" . PermissionEnum::users->value . "," . SubPermissionEnum::user_account_status->value . ',' . 'view']);
    Route::get('/statuses/user/{id}', [StatusController::class, "userStatuses"])->middleware(["userHasSubPermission:" . PermissionEnum::users->value . "," . SubPermissionEnum::user_account_status->value . ',' . 'view']);
});
