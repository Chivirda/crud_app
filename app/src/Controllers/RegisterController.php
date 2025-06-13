<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view("register");
    }

    public function register(): void
    {
        $validation = $this->request()->validate([
            "email" => ["required", "email"],
            "password" => ["required", "min:8", "max:255"],
            "name" => ["required", "min:2", "max:255"]
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect("/register");
        }

        $this->db()->insert("users", [
            "email" => $this->request()->input("email"),
            "password" => password_hash($this->request()->input("password"), PASSWORD_BCRYPT),
            "name" => $this->request()->input("name"),
        ]);

        $this->session()->set("success", ['Вы успешно зарегистрировались']);

        $this->redirect('/register');
    }
}