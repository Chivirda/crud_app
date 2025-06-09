<?php

use App\Controllers\GuestController;
use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;

return [
  Route::get('/', [HomeController::class, 'index']),
  Route::get('/guest', [GuestController::class, 'index']),

  Route::get('/projects/add', [ProjectController::class,'add']),
  Route::post('/projects/add', [ProjectController::class,'store']),

  Route::get('/register', [RegisterController::class,'index']),
  Route::post('/register', [RegisterController::class,'register']),
];
