<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware('api')
    ->group(function () {
        foreach (glob(base_path('routes/modules/*.php')) as $routeFile) {
            require $routeFile;
        }
    });
