<?php
/**
 * @var App\Kernel\View\ViewInterface $view;
 * @var App\Kernel\Session\SessionInterface $session;
 */

?>

<?php $view->component('start'); ?>

<h1>Register</h1>

<form action="/register" method="post" class="register-form">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <?php if ($session->has("email")): ?>
            <ul>
                <?php foreach ($session->getFlash("email") as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <?php if ($session->has("password")): ?>
            <ul>
                <?php foreach ($session->getFlash("password") as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <button type="submit">Register</button>
    </div>
</form>

<?php $view->component('end'); ?>