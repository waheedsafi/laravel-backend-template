<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;
use App\Http\Controllers\v1\template\CheckListController;


Route::prefix('v1')->middleware(["authorized:" . 'user:api'])->group(function () {
  Route::get('checklists/types', [CheckListController::class, 'checklistTypes'])->middleware(["userHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configurations_checklist->value . ',' . 'view']);
  Route::get('checklists/{id}', [CheckListController::class, "edit"])->middleware(["userHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configurations_checklist->value . ',' . 'view']);
  Route::get('checklists', [CheckListController::class, 'index'])->middleware(["userHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configurations_checklist->value . ',' . 'view']);
  Route::post('checklists', [CheckListController::class, 'store'])->middleware(["userHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configurations_checklist->value . ',' . 'add']);
  Route::delete('checklists/{id}', [CheckListController::class, 'destroy'])->middleware(["userHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configurations_checklist->value . ',' . 'delete']);
  Route::put('checklists', [CheckListController::class, 'update'])->middleware(["userHasSubPermission:" . PermissionEnum::configurations->value . "," . SubPermissionEnum::configurations_checklist->value . ',' . 'edit']);
});
