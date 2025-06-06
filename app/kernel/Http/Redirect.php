<?php

namespace App\Kernel\Http;

class Redirect implements RedirectInterface
{
    public static function to(string $uri): void
    {
        header("Location: $uri");
        exit;
    }
}
