<?php
/**
 * @var App\Kernel\View\ViewInterface $view;
 * @var App\Kernel\Session\SessionInterface $session;
 */

?>

<?php $view->component('start'); ?>

<div id="register" class="page">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-user-plus me-2"></i>Регистрация аккаунта</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/register">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <?php if ($session->has('email')): ?>
                                    <?php foreach ($session->getFlash('email') as $error): ?>
                                    <div class="error" id="email-error"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль *</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <?php if ($session->has('password')): ?>
                                    <?php foreach ($session->getFlash('password') as $error): ?>
                                    <div class="error" id="password-error"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Имя *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <?php if ($session->has('name')): ?>
                                    <?php foreach ($session->getFlash('name') as $error): ?>
                                    <div class="error" id="name-error"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($session->has('success')): ?>
                            <div class="success mb-3" id="form-success">
                                <?= $session->getFlash('success')[0]; ?>
                            </div>
                            <?php endif; ?>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i>Зарегистрироваться
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="/login" class="text-decoration-none">
                                Уже есть аккаунт? Войти
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $view->component('end'); ?>