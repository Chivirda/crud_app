<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    public function add(): void
    {
        $this->view('projects/add');
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => [
                'required',
                'min:3',
                'max:50'
            ]
        ]);

        if (!$validation) {
            $this->redirectWithErrors($this->request()->errors());
        }

        $this->service()->store([
            'name' => $this->request()->input('name'),
            'user_id' => $this->auth()->user()->id()
        ]);

        $this->redirect('/');
    }

    public function edit(): void
    {
        $project = $this->service()->find($this->request()->input('id'));

        $this->view('projects/edit', [
            'project' => $project
        ]);
    }

    public function update(): void
    {
        $this->service()->update($this->request()->input('id'), $this->request()->input('name'));

        $this->redirect('/');
    }

    public function destroy(): void
    {
        $this->service()->delete($this->request()->input('id'));

        $this->redirect('/');
    }

    private function service(): ProjectService
    {
        return new ProjectService($this->db());
    }
}
