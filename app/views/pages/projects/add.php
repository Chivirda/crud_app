<?php

/**
 * @var App\Kernel\View\View $view;
 * @var App\Kernel\Session\Session $session;
 */

?>

<?php $view->component('start'); ?>

<h1>Add project</h1>

<form action="/projects/add" method="post">
    <div class="">
        <input type="text" name="name">
        <?php if ($session->has('name')): ?>
            <ul>
                <?php foreach ($session->getFlash('name') as $error): ?>
                    <li style="color: red;">
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php endif; ?>
    </div>
    <div class=""><button type="submit">Add project</button></div>
</form>

<?php $view->component('end'); ?>
