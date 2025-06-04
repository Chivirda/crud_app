<?php

namespace App\Kernel\Http;

class Redirect
{
    public static function to(string $uri): void
    {
        header("Location: $uri");
        exit;
    }
}