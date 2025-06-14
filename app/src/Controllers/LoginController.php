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

        $validation = $this->request()->validate([
            "email" => [
                "required",
                "email"
            ],
            "password" => [
                "min:4"
            ]
        ]);

        if (!$validation) {
            $this->redirectWithErrors($this->request()->errors());
        }

        $userId = $this->db()->first("users", ["email" => $email]);

        if (!$userId) {
            $this->redirectWithErrors([
                'email' => ["Пользователь с email $email не зарегистрирован"],
            ]);
        }

        $user = $this->auth()->attempt($email, $password);

        if (!$user) {
            $this->redirectWithErrors([
                'password' => ["Неверный пароль"],
            ]);
        }

        $this->redirect("/");
    }

    public function logout(): void
    {
        $this->auth()->logout();

        $this->redirect("/guest");
    }
}
