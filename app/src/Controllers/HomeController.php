<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;
use App\Services\TaskService;

class HomeController extends Controller
{
    public function index(): void
    {
        $projects = new ProjectService($this->db());
        $tasks = new TaskService($this->db());

        $this->view('home', [
            'projects' => $projects->all(),
            'tasks' => $tasks->all()
        ]);
    }
}
