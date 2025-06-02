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
        dd($this->request()->input("name"));
    }
}