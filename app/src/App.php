<?php

namespace Serg\Crudapp;

class App
{
    public function run(): void
    {
        $routes = require_once APP_PATH.'/routes/web.php';

        $uri = $_SERVER['REQUEST_URI'];

        $routes[$uri]();
    }
}
