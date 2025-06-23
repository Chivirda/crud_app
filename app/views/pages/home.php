<?php
/**
 * @var App\Kernel\View\View $view;
 * @var App\Models\Project $projects;
 * @var App\Models\Task $tasks;
 * @var App\Kernel\Storage\StorageInterface $storage;
 */
?>

<?php $view->component('start'); ?>

<div class="container-fluid">
    <div class="row">
        <!-- Левая колонка - Проекты (1/3) -->
        <div class="col-md-4 sidebar p-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-folder me-2"></i>Проекты</h5>
                </div>
                <div class="card-body">
                    <?php $view->component('projects', [
                        'projects' => $projects,
                    ]); ?>
                    <div class="mt-3">
                        <a class="btn btn-outline-primary w-100" href="/projects/add">
                            <i class="fas fa-plus me-2"></i>Добавить проект
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Правая колонка - Задачи (2/3) -->
        <div class="col-md-8 p-4">
            <!-- Поиск -->
            <div class="row mb-3">
                <div class="col-md-8">
                    <form method="GET" action="/search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Поиск задачи...">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a class="btn btn-primary" href="/tasks/add">
                        <i class="fas fa-plus me-2"></i>Добавить задачу
                    </a>
                </div>
            </div>

            <!-- Фильтры -->
            <div class="card mb-3">
                <div class="card-body">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="fas fa-list me-2"></i>Все задачи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-calendar-day me-2"></i>Повестка дня</a>
                        </li>
                        <a class="nav-link" href="#"><i class="fas fa-calendar-plus me-2"></i>Завтра</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="#"><i
                                    class="fas fa-exclamation-triangle me-2"></i>Просроченные</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Блок задач -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Входящие</h5>
                    <a href="#" class="text-decoration-none">Показать выполненные</a>
                </div>
                <div class="card-body">
                    <?php foreach ($tasks as $task): ?>
                        <div class="task-item border rounded p-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="task1">
                                </div>
                                <div class="flex-grow-1">
                                    <label class="form-check-label fw-bold" for="task1" style="cursor: pointer;">
                                        <?= htmlspecialchars($task->name()) ?>
                                    </label>
                                </div>
                                <div class="task-meta d-flex align-items-center">
                                    <?php if ($task->filePath()): ?>
                                        <a href="<?= $storage->url($task->filePath()) ?>">
                                            <i class="fas fa-paperclip text-muted me-2" title="Есть вложение"></i>
                                        </a>
                                    <?php endif; ?>
                                    <span class="badge bg-warning text-dark me-2">Сегодня</span>
                                    <span class="badge bg-info me-2">Завтра</span>
                                    <span class="badge bg-danger me-2">Просрочено</span>
                                    <span class="badge bg-success me-2">Выполнено</span>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
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
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Выполненная задача -->
                    <div class="task-item task-completed border rounded p-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="task4" checked>
                            </div>
                            <div class="flex-grow-1">
                                <label class="form-check-label text-decoration-line-through" for="task4"
                                    style="cursor: pointer;">
                                    Купить продукты
                                </label>
                            </div>
                            <div class="task-meta d-flex align-items-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"
                                                onclick="confirmDeleteTask(4, 'Купить продукты')">
                                                <i class="fas fa-trash text-danger me-2"></i>Удалить задачу
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Модальное окно удаления проекта -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Подтверждение
                    удаления</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Внимание!</strong> При удалении проекта будут удалены все связанные с ним задачи.
                </div>
                <p>Вы уверены, что хотите удалить проект <strong id="projectNameToDelete"></strong>?</p>
                <p class="text-muted">Количество задач, которые будут удалены: <span id="tasksCountToDelete"
                        class="fw-bold"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-danger" onclick="deleteProject()">
                    <i class="fas fa-trash me-2"></i>Удалить проект
                </button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/app.js"></script>

<?php $view->component('end'); ?>