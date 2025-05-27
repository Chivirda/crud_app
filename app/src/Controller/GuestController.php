<?php

namespace App\Controller;

class GuestController
{
    public function index(): void
    {
        include_once APP_PATH . '/views/pages/guest.php';
    }
}