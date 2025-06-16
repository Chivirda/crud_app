<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    public function add(): void
    {
        $this->view("projects/add");
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            "name" => [
                "required",
                "min:3",
                "max:12"
            ]
        ]);

        if (!$validation) {
            $this->redirectWithErrors($this->request()->errors());
        }

        $this->db()->insert('projects', [
            'name'=> $this->request()->input('name'),
            'user_id' => $this->auth()->user()->id()
        ]);

        $this->redirect('/');
    }
}
