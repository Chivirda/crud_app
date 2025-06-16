<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;

class HomeController extends Controller
{
    public function index(): void
    {
        $projects = new ProjectService($this->db());

        $this->view('home', ['projects' => $projects->all()]);
    }
}
