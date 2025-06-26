<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function add(): void
    {
        $projects = $this->projectService()->get([
            'user_id' => $this->auth()->user()->id()
        ]);

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

        $this->redirect('/?project=' . $this->request()->input('project_id'));
    }

    public function edit(): void
    {
        $this->view('tasks/edit', [
            'task' => $this->service()->find($this->request()->input('id'), $this->auth()->user()->id()),
            'projects' => $this->projectService()->all()
        ]);
    }

    public function update(): void
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

        $data = [
            'name' => $this->request()->input('name'),
            'project_id' => $this->request()->input('project_id'),
            'due_date' => $this->request()->input('due_date') !== '' ? $this->request()->input('due_date') : null,
        ];

        if ($this->request()->file('file') !== null) {
            $file = $this->request()->file('file');
            $data['file_path'] = $file->move('tasks');
        }

        $this->service()->update($this->request()->input('id'), $data);

        $this->redirect('/?project=' . $this->service()->find($this->request()->input('id'), $this->auth()->user()->id())->projectId());
    }

    public function done(): void
    {
        $this->service()->update($this->request()->input('id'), ['status' => 1]);
        $this->redirect('/?project=' . $this->service()->find($this->request()->input('id'), $this->auth()->user()->id())->projectId());
    }

    public function undone(): void
    {
        $this->service()->update($this->request()->input('id'), ['status' => 0]);
        $this->redirect('/?project=' . $this->service()->find($this->request()->input('id'), $this->auth()->user()->id())->projectId());

    }

    public function destroy(): void
    {
        $projectId = $this->service()->find($this->request()->input('id'), $this->auth()->user()->id())->projectId();

        $this->service()->delete($this->request()->input('id'));

        $this->redirect('/?project=' . $projectId);
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
