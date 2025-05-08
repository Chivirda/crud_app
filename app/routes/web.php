<?php

use Serg\Crudapp\Router\Route;

return [
    Route::get('/', function (): void {
        include_once APP_PATH . '/views/pages/home.php';
    }),
    Route::get('/guest', function (): void {
        include_once APP_PATH . '/views/pages/guest.php';
    })
];
