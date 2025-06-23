<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;
use App\Services\TaskService;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->all(),
            'tasks' => $this->taskService()->all(),
        ]);
    }

    private function projectService(): ProjectService
    {
        return new ProjectService($this->db());
    }

    private function taskService(): TaskService
    {
        return new TaskService($this->db());
    }
}
