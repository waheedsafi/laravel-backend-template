
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\template\FaqController;


Route::prefix('v1')->group(function () {
  Route::get('/faqs', [FaqController::class, "index"]);
});
