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
            'tasks' => $this->taskService()->all()
        ]);
    }

    public function today(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->all(),
            'tasks' => $this->taskService()->get([
                'due_date' => (new \DateTime('today'))->format('Y-m-d')
            ])
        ]);
    }

    public function tomorrow(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->all(),
            'tasks' => $this->taskService()->get([
                'due_date' => (new \DateTime('tomorrow'))->format('Y-m-d')
            ])
        ]);
    }

    public function overdue(): void
    {
        $overduetTasks = [];

        foreach ($this->taskService()->all() as $task) {
            if ($task->dueDate() < (new \DateTime())->format('Y-m-d')) {
                $overduetTasks[] = $task;
            }
        }

        $this->view('home', [
            'projects' => $this->projectService()->all(),
            'tasks' => $overduetTasks
        ]);
    }

    public function done(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->all(),
            'tasks' => $this->taskService()->get([
                'status' => 1
            ])
        ]);
    }

    public function filter(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->all(),
            'tasks' => $this->taskService()->get([
                'project_id' => $this->request()->input('project_id')
            ])
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
