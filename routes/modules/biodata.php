<?php

use App\Modules\Biodata\Controller\BiodataController;
use Illuminate\Support\Facades\Route;

Route::prefix('biodata')->middleware('jwt')->group(function () {
    Route::get('/', [BiodataController::class, 'index']);
    Route::get('{id}', [BiodataController::class, 'show']);
    Route::post('/', [BiodataController::class, 'store']);
    Route::put('{id}', [BiodataController::class, 'update']);
    Route::delete('{id}', [BiodataController::class, 'destroy']);
});
