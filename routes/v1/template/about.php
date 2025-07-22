
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\template\AboutController;




Route::prefix('v1')->group(function () {
  Route::get('/about/office', [AboutController::class, "office"]);
  Route::get('/about/staffs', [AboutController::class, "staffs"]);
  // Route::get('/public/sliders', [AboutController::class, 'publicSliders']);
});
// Route::prefix('v1')->middleware(["authorized:" . 'user:api'])->group(function () {
//   Route::get('/staff/director', [AboutController::class, "director"]);
//   Route::get('/staff/manager', [AboutController::class, "manager"]);
//   Route::get('/staff/technicalSupports', [AboutController::class, "technicalSupports"]);
//   Route::post('/staff/store', [AboutController::class, "staffStore"]);
//   Route::post('/office/store', [AboutController::class, "officeStore"]);
//   Route::post('/office/update', [AboutController::class, "officeUpdate"]);
//   Route::get('/staff/{id}', [AboutController::class, "staff"]);
//   Route::post('/staff/update', [AboutController::class, 'update']);
//   Route::delete('/staff/{id}', [AboutController::class, 'staffDestroy']);
//   Route::post('/slider/store', [AboutController::class, 'sliderFileUpload']);
//   Route::get('/sliders', [AboutController::class, 'sliders']);
//   Route::delete('/slider/{id}', [AboutController::class, 'sliderDestroy']);
//   Route::POST('/slider/change/status', [AboutController::class, 'changeStatusSlider']);
// });
