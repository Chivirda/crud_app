<?php

namespace App\Middleware;

use App\Kernel\Middleware\AbstractMiddleware;

class LoginMiddleware extends AbstractMiddleware
{
    public function handle(): void
    {
        if ($this->auth->check()) {
            $this->redirect->to('/');
        }
    }
}
