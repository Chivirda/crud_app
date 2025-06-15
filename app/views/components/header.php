<?php
/**
 * @var App\Kernel\Auth\AuthInterface $auth;
 */

$user = $auth->user();
?>

<header>
    <?php if ($user): ?>
        <div class="bg-white border-bottom">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-tasks text-primary me-2"></i>Мои задачи</h4>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i><?= $user->name() ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><form action="/logout" method="post">
                                <button class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Выйти
                                    </button>
                            </form></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="/"><i class="fas fa-tasks me-2"></i>Планировщик задач</a>
            </div>
        </nav>
    <?php endif; ?>
</header>
