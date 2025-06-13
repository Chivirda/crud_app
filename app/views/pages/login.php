<?php
/**
 * @var App\Kernel\View\ViewInterface $view;
 * @var App\Kernel\Session\SessionInterface $session;
 */

?>

<?php $view->component('start'); ?>

<div id="login" class="page">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-sign-in-alt me-2"></i>Авторизация</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/login">
                            <div class="mb-3">
                                <label for="login-email" class="form-label">E-mail *</label>
                                <input type="email" class="form-control" id="login-email" name="email" required>
                                <?php if ($session->has('email')): ?>
                                    <?php foreach ($session->getFlash('email') as $error): ?>
                                    <div class="error" id="login-email-error"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="login-password" class="form-label">Пароль *</label>
                                <input type="password" class="form-control" id="login-password" name="password" required>
                                <?php if ($session->has('password')): ?>
                                    <?php foreach ($session->getFlash('password') as $error): ?>
                                    <div class="error" id="login-password-error"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt me-2"></i>Войти
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="/register" class="text-decoration-none">
                                Нет аккаунта? Зарегистрироваться
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $view->component('end'); ?>