<?php
/**
 * @var App\Kernel\View\View $view;
 */

?>

<?php $view->component('start'); ?>

<div id="index" class="page">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="hero-section py-5">
                    <h1 class="display-4 mb-4"><i class="fas fa-tasks text-primary"></i> Планировщик задач</h1>
                    <p class="lead mb-5">
                        Веб-приложение для удобного ведения списка дел. Сервис помогает пользователям не забывать о предстоящих важных событиях и задачах. После создания аккаунта, пользователь может начать вносить свои дела, деля их по проектам и указывая сроки.
                    </p>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="/register" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Зарегистрироваться
                        </a>
                        <a href="/login" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Войти
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $view->component('end'); ?>