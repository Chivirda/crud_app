<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;
use App\Services\TaskService;

class HomeController extends Controller
{
    public function index(): void
    {
        $projectId = $this->request()->input('project');

        if ($projectId) {
            $this->view('home', [
                'projects' => $this->projectService()->get([
                    'user_id' => $this->auth()->user()->id()
                ]),
                'tasks' => $this->taskService()->get([
                    'project_id' => $projectId,
                    'user_id' => $this->auth()->user()->id()
                ]),
            ]);
        }
        
        $this->view('home', [
            'projects' => $this->projectService()->get([
                'user_id' => $this->auth()->user()->id()
            ]),
            'tasks' => $this->taskService()->get([
                'project_id' => $this->projectService()->all()[0]->id(),
                'user_id' => $this->auth()->user()->id()
            ]),
        ]);
    }

    public function today(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->get([
                'user_id' => $this->auth()->user()->id()
            ]),
            'tasks' => $this->taskService()->get([
                'due_date' => (new \DateTime('today'))->format('Y-m-d'),
                'project_id' => $this->request()->input('project'),
                'user_id' => $this->auth()->user()->id()
            ]),
        ]);
    }

    public function tomorrow(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->get([
                'user_id' => $this->auth()->user()->id()
            ]),
            'tasks' => $this->taskService()->get([
                'due_date' => (new \DateTime('tomorrow'))->format('Y-m-d'),
                'project_id' => $this->request()->input('project'),
                'user_id' => $this->auth()->user()->id()
            ]),
        ]);
    }

    public function overdue(): void
    {
        $overdueTasks = [];

        foreach ($this->taskService()->get([
            'project_id' => $this->request()->input('project'),
            'user_id' => $this->auth()->user()->id()
        ]) as $task) {
            if ($task->dueDate() < ((new \DateTime())->format('Y-m-d'))) {
                $overdueTasks[] = $task;
            }
        }

        $this->view('home', [
            'projects' => $this->projectService()->get([
                'user_id' => $this->auth()->user()->id()
            ]),
            'tasks' => $overdueTasks,
        ]);
    }

    public function done(): void
    {
        $this->view('home', [
            'projects' => $this->projectService()->get([
                'user_id' => $this->auth()->user()->id()
            ]),
            'tasks' => $this->taskService()->get([
                'status' => 1,
                'user_id' => $this->auth()->user()->id()
            ]),
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
