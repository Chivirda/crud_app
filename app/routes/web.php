<?php

use App\Controller\GuestController;
use App\Controller\HomeController;
use App\Router\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/guest', [GuestController::class, 'index']),
    Route::get('/test', function () {
        echo 'test';
    }),
];
