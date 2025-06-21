<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function add(): void
    {
        $projects = $this->projectService()->all();

        $this->view('tasks/add', [
            'projects' => $projects
        ]);
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => [
                'required',
                'min:3',
                'max:256'
            ],
            'project_id' => [
                'required',
            ]
        ]);

        if (!$validation) {
            $this->redirectWithErrors($this->request()->errors());
        }

        $file = $this->request()->file('file');

        $taskId = $this->service()->store([
            'name' => $this->request()->input('name'),
            'user_id' => $this->auth()->user()->id(),
            'project_id' => $this->request()->input('project_id'),
            'due_date' => $this->request()->input('due_date') !== '' ? $this->request()->input('due_date') : null,
            'file_path' => $file->move('tasks'),
        ]);

        if (is_string($taskId)) {
            $this->redirectWithErrors(['file' => $taskId]);
        }

        $this->redirect('/');
    }

    public function edit(): void
    {
        $task = $this->service()->find($this->request()->input('id'));
        $projects = $this->projectService()->all();

        $this->view('tasks/edit', [
            'task' => $task,
            'projects' => $projects
        ]);
    }

    private function projectService(): ProjectService
    {
        return new ProjectService($this->db());
    }

    private function service(): TaskService
    {
        return new TaskService($this->db());
    }
}
