<?php
/**
 * @var App\Kernel\View\ViewInterface $view;
 * @var App\Models\Task $task;
 */
?>
<div class="dropdown">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <ul class="dropdown-menu">
        <li>
            <form action="/tasks/delete" method="POST">
                <input type="hidden" name="id" value="<?= $task->id() ?>">
                <button class="dropdown-item">
                    <i class="fas fa-trash text-danger me-2"></i>Удалить задачу
                </button>
            </form>
        </li>
        <li>
            <a class="dropdown-item" href="/tasks/update?id=<?= $task->id() ?>">
                <i class="fas fa-edit me-2"></i>Изменить задачу
            </a>
        </li>
    </ul>
</div>