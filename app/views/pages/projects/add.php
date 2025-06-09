<?php
/**
 * @var App\Kernel\View\View $view;
 * @var App\Kernel\Session\Session $session;
 * @var App\Kernel\Session\Session $session;
 */

?>

<?php $view->component('start'); ?>

<h1>Add project</h1>

<form action="/projects/add" method="post">
    <div class=""><input type="text" name="name"></div>
    <ul>
        <?php if ($session->has('name')): ?>
            <?php foreach ($session->getFlash('name') as $name): ?>
                <li style="color: red;"><?= $name ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <div class=""><button type="submit">Add project</button></div>
</form>

<?php $view->component('end'); ?>
