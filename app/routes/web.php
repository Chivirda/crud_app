<?php

use App\Controllers\GuestController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\ProjectController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\LoginMiddleware;

return [
  Route::get('/', [HomeController::class, 'index'], [GuestMiddleware::class]),
  Route::get('/guest', [GuestController::class, 'index']),

  Route::get('/projects/add', [ProjectController::class,'add'], [AuthMiddleware::class]),
  Route::post('/projects/add', [ProjectController::class,'store']),

  Route::get('/register', [RegisterController::class,'index'], [LoginMiddleware::class]),
  Route::post('/register', [RegisterController::class,'register']),

  Route::get('/login', [LoginController::class,'index'], [LoginMiddleware::class]),
  Route::post('/login', [LoginController::class,'login']),
  Route::post('/logout', [LoginController::class,'logout']),
];
