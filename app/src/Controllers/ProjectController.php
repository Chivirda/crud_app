<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Validator\Validator;

class ProjectController extends Controller
{
    public function add(): void
    {
        $this->view("projects/add");
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            "name"=> [
                "required",
                "min:3",
                "max:12"
            ]
        ]);

        if (! $validation) {
            $this->redirect("/projects/add");
        }

        dd('Success');
    }
}