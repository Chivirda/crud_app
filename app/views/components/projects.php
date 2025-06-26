<?php

/**
 * @var App\Models\Project $projects;
 */
?>

<div class="list-group list-group-flush">
    <?php foreach ($projects as $project): ?>
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= $request->input('project') == $project->id() ? 'active' : '' ?>">
            <a href="/?project=<?= $project->id() ?>" class="text-decoration-none <?= $request->input('project') == $project->id() ? 'text-light' : 'text-dark' ?>">
                <i class="fas fa-inbox me-2"></i><?= htmlspecialchars($project->name()) ?> <span
                    class="badge bg-primary rounded-pill ms-2"><?= $project->activeTasksCount() ?></span>
            </a>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button class="dropdown-item"
                            onclick="confirmDeleteProject(<?= $project->id() ?>, '<?= htmlspecialchars($project->name(), ENT_QUOTES) ?>', <?= $project->activeTasksCount() ?>)">
                            <i class="fas fa-trash text-danger me-2"></i>Удалить проект
                        </button>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/projects/update?id=<?= $project->id() ?>">
                            <i class="fas fa-edit me-2"></i>Изменить проект
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>
