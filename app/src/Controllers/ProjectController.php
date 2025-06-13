<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class ProjectController extends Controller
{
    public function add(): void
    {
        $this->view("projects/add");
    }

    public function store(): void
    {
        $file = $this->request()->file("file");

        $filePath = $file->move('projects');

        dd($this->storage()->url($filePath));
        $validation = $this->request()->validate([
            "name" => [
                "required",
                "min:3",
                "max:12"
            ]
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect("/projects/add");
        }

        $id = $this->db()->insert('projects', [
            'name'=> $this->request()->input('name'),
        ]);

        dd("Project created with id: $id");
    }
}
