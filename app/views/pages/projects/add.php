<?php
/**
 * @var App\Kernel\View\View $view;
 * @var App\Kernel\Session\Session $session;
 * @var App\Kernel\Session\Session $session;
 */

?>

<?php $view->component('start'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0"><i class="fas fa-folder-plus me-2"></i>Добавить проект</h3>
                    <a class="btn btn-outline-light btn-sm" href="/">
                        <i class="fas fa-arrow-left"></i> Назад
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="/projects/add">
                        <div class="mb-3">
                            <label for="project-name" class="form-label">Название проекта *</label>
                            <input type="text" class="form-control" id="project-name" name="name"
                                placeholder="Введите название проекта" required>
                            <?php if ($session->has('name')): ?>
                                <?php foreach ($session->getFlash('name') as $error): ?>
                                    <div class="error" id="project-name-error"><?= $error ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Создать проект
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $view->component('end'); ?>