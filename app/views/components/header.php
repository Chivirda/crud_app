<?php
/**
 * @var App\Kernel\Auth\AuthInterface $auth;
 */

$user = $auth->user();
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="fas fa-tasks me-2"></i>Планировщик задач</a>
            <?php if ($user): ?>
                <div class="navbar-nav ms-auto">
                    <button class="btn btn-outline-light btn-sm me-2" onclick="showPage('index')">Гостевая</button>
                    <button class="btn btn-outline-light btn-sm me-2" onclick="showPage('register')">Регистрация</button>
                    <button class="btn btn-outline-light btn-sm me-2" onclick="showPage('login')">Вход</button>
                    <button class="btn btn-outline-light btn-sm me-2" onclick="showPage('dashboard')">Главная</button>
                    <button class="btn btn-outline-light btn-sm me-2" onclick="showPage('add-project')">Добавить
                        проект</button>
                    <button class="btn btn-outline-light btn-sm" onclick="showPage('add-task')">Добавить задачу</button>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>