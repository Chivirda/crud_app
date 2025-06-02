<?php 
/**
 * @var App\Kernel\View\View $view;
 */

?>

<?php $view->component('start'); ?>

<h1>Add project</h1>

<form action="/projects/add" method="post">
    <div class=""><input type="text" name="name"></div>
    <div class=""><button type="submit">Add project</button></div>
</form>

<?php $view->component('end'); ?>