<?php

namespace Serg\Crudapp;

use Serg\Crudapp\Router\Router;

class App
{
    public function run(): void
    {
        $router = new Router();

        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $router->dispatch($uri, $method);
    }
}
