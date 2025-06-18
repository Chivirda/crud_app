<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class GuestController extends Controller
{
    public function index(): void
    {
        $this->view('guest');
    }
}
