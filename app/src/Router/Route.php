<?php

namespace App\Router;

class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private mixed $action
    ) {
    }

    public static function get(string $uri, $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public static function post(string $uri, $action): static
    {
        return new static($uri, 'POST', $action);
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function action(): mixed
    {
        return $this->action;
    }
}
