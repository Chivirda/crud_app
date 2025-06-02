<?php

namespace App\Kernel\Http;

class Request
{
    public readonly array $get;
    public readonly array $post;
    public readonly array $server;
    public readonly array $files;

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_SERVER, $_FILES);
    }

    public function uri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
