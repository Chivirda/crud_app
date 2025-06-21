<?php
/**
 * @var App\Kernel\View\View $view;
 * @var App\Kernel\Session\Session $session;
 * @var App\Services\ProjectService $projects;
 * @var \App\Models\Task $task;
 */
?>

<?php $view->component('start'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0"><i class="fas fa-plus me-2"></i>Добавить задачу</h3>
                    <a class="btn btn-outline-light btn-sm" href="/">
                        <i class="fas fa-arrow-left"></i> Назад
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="/tasks/add" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="task-name" class="form-label">Название *</label>
                                <input type="text" class="form-control" id="task-name" name="name"
                                    placeholder="Введите название задачи" value="<?= $task->name() ?>" required>
                                <div class="error" id="task-name-error"></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="task-project" class="form-label">Проект *</label>
                                <select class="form-select" id="task-project" name="project_id" required>
                                    <option value="">Выберите проект</option>
                                    <?php foreach ($projects as $project): ?>
                                        <option value="<?= $project->id() ?>" <?php if ($project->id() === $task->projectId()): ?>selected<?php endif; ?>><?= $project->name() ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="error" id="task-project-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="task-date" class="form-label">Срок выполнения</label>
                                <input type="date" class="form-control" id="task-date" name="due_date" value="<?= $task->dueDate() ?>">
                                <div class="form-text">Формат: ГГГГ-ММ-ДД</div>
                                <div class="error" id="task-date-error"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="task-file" class="form-label">Файл</label>
                                <input type="file" class="form-control" id="task-file" name="file">
                                <div class="form-text">Необязательное поле</div>
                                <?php if ($session->has('file')): ?>
                                    <?php foreach ($session->getFlash('file') as $error): ?>
                                    <div class="error" id="task-file-error"><?= $error ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Добавить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $view->component('end'); ?>
