
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\template\ContactController;

Route::prefix('v1')->middleware(["authorized:" . 'user:api'])->group(function () {
    Route::post('/contacts/exist', [ContactController::class, "contactsExist"]);
});
