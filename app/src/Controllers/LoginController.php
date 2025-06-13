<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view("login");
    }

    public function login(): void
    {
        $email = $this->request()->input("email");
        $password = $this->request()->input("password");

        $userId = $this->db()->first("users", ["email" => $email]);

        if (! $userId) {
            $this->session()->set("email", ["Пользователь с email $email не зарегистрирован"]);
            $this->redirect("/login");
        }

        $validation = $this->request()->validate([
            "email" => [
                "required",
                "email"
            ],
            "password" => [
                "min:4"
            ]
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect("/login");
        }

        if ($this->auth()->attempt($email, $password)) {
            $this->redirect("/");
        } else {
            $this->session()->set("password", ["Пароль указан неверно"]);
            $this->redirect("/login");
        }

    }

    public function logout(): void
    {
        $this->auth()->logout();

        $this->redirect("/guest");
    }
}