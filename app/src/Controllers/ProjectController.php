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

        dd('Success');
    }
}
