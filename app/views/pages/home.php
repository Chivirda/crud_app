<?php
/**
 * @var App\Kernel\View\View $view;
 * @var App\Services\ProjectService $projects;
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
                    <div class="list-group list-group-flush">
                        <?php foreach ($projects as $project): ?>
                            <div
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-inbox me-2"></i><?= $project->name() ?> <span
                                        class="badge bg-primary rounded-pill ms-2"><?= $project->activeTasksCount() ?></span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="/projects/delete" method="post">
                                                <input type="hidden" name="id" value="<?= $project->id() ?>">
                                                <button class="dropdown-item"
                                                    onclick="confirmDeleteProject(1, 'Входящие', 5)">
                                                    <i class="fas fa-trash text-danger me-2"></i>Удалить проект
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/projects/update?id=<?= $project->id() ?>" onclick="confirmDeleteProject(1, 'Входящие', 5)">
                                                <i class="fas fa-edit me-2"></i>Изменить проект
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
                    <a class="btn btn-primary" href="/projects/add">
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
                    <!-- Задача 1 -->
                    <div class="task-item border rounded p-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="task1">
                            </div>
                            <div class="flex-grow-1">
                                <label class="form-check-label fw-bold" for="task1" style="cursor: pointer;">
                                    Подготовить презентацию для клиента
                                </label>
                            </div>
                            <div class="task-meta d-flex align-items-center">
                                <i class="fas fa-paperclip text-muted me-2" title="Есть вложение"></i>
                                <span class="badge bg-warning text-dark me-2">Сегодня</span>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"
                                                onclick="confirmDeleteTask(1, 'Подготовить презентацию для клиента')">
                                                <i class="fas fa-trash text-danger me-2"></i>Удалить задачу
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Задача 2 -->
                    <div class="task-item task-overdue border rounded p-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="task2">
                            </div>
                            <div class="flex-grow-1">
                                <label class="form-check-label fw-bold" for="task2" style="cursor: pointer;">
                                    Отправить отчет по проекту
                                </label>
                            </div>
                            <div class="task-meta d-flex align-items-center">
                                <span class="badge bg-danger me-2">Просрочено</span>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"
                                                onclick="confirmDeleteTask(2, 'Отправить отчет по проекту')">
                                                <i class="fas fa-trash text-danger me-2"></i>Удалить задачу
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Задача 3 -->
                    <div class="task-item border rounded p-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="task3">
                            </div>
                            <div class="flex-grow-1">
                                <label class="form-check-label fw-bold" for="task3" style="cursor: pointer;">
                                    Провести встречу с командой
                                </label>
                            </div>
                            <div class="task-meta d-flex align-items-center">
                                <span class="badge bg-info me-2">Завтра</span>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"
                                                onclick="confirmDeleteTask(3, 'Провести встречу с командой')">
                                                <i class="fas fa-trash text-danger me-2"></i>Удалить задачу
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                <span class="badge bg-success me-2">Выполнено</span>
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

<?php $view->component('end'); ?>