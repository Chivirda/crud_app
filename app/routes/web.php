<?php

use App\Controllers\GuestController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\ProjectController;
use App\Controllers\RegisterController;
use App\Controllers\TaskController;
use App\Kernel\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\LoginMiddleware;

return [
  Route::get('/', [HomeController::class, 'index'], [GuestMiddleware::class]),
  Route::get('/today', [HomeController::class, 'today'], [GuestMiddleware::class]),
  Route::get('/tomorrow', [HomeController::class, 'tomorrow'], [GuestMiddleware::class]),
  Route::get('/overdue', [HomeController::class, 'overdue'], [GuestMiddleware::class]),
  Route::get('/done', [HomeController::class, 'done'], [GuestMiddleware::class]),

  Route::get('/guest', [GuestController::class, 'index']),

  Route::get('/projects/add', [ProjectController::class,'add'], [AuthMiddleware::class]),
  Route::post('/projects/add', [ProjectController::class,'store'], [AuthMiddleware::class]),
  Route::get('/projects/update', [ProjectController::class,'edit'], [AuthMiddleware::class]),
  Route::post('/projects/update', [ProjectController::class,'update'], [AuthMiddleware::class]),
  Route::post('/projects/delete', [ProjectController::class,'destroy'], [AuthMiddleware::class]),

  Route::get('/tasks/add', [TaskController::class,'add'], [AuthMiddleware::class]),
  Route::post('/tasks/add', [TaskController::class,'store'], [AuthMiddleware::class]),
  Route::get('/tasks/update', [TaskController::class,'edit'], [AuthMiddleware::class]),
  Route::post('/tasks/update', [TaskController::class,'update'], [AuthMiddleware::class]),
  Route::post('/tasks/delete', [TaskController::class,'destroy'], [AuthMiddleware::class]),

  Route::get('/register', [RegisterController::class,'index'], [LoginMiddleware::class]),
  Route::post('/register', [RegisterController::class,'register']),

  Route::get('/login', [LoginController::class,'index'], [LoginMiddleware::class]),
  Route::post('/login', [LoginController::class,'login']),
  Route::post('/logout', [LoginController::class,'logout']),
];
