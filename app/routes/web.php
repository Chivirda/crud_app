<?php

use App\Controllers\GuestController;
use App\Controllers\HomeController;
use App\Kernel\Router\Route;

return [
  Route::get('/', [HomeController::class, 'index']),
  Route::get('/guest', [GuestController::class, 'index']),
];
