<?php
function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function has($arr, $key) {
    return !empty($arr[$key]);
}

$posts = $posts ?? [];
$materials = $materials ?? [];

$postsLimit = array_slice($posts, 0, 5);
$materialsLimit = array_slice($materials, 0, 5);

$userName = $user['name'] ?? $user['username'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — <?= e($userName) ?></title>
    <link rel='stylesheet' href='/assets/css/style.css'>
</head>

<body>
    <?= renderHeader($navItems) ?>

    <main class="dashboard-page">
        <h1 class="dashboard-page__title">Dashboard</h1>
        <p class="dashboard-page__subtitle">Bem-vindo de volta, <?= e($userName) ?>.</p>

        <section class="dashboard-section">
            <div class="dashboard-section__header">
                <h2 class="dashboard-section__title">Meus Posts</h2>
                <a href="/posts" class="dashboard-section__see-all">
                    Ver todos
                    <svg class="dashboard-section__arrow" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <?php if (!empty($postsLimit)): ?>
                <ul class="dashboard-list">
                    <?php foreach ($postsLimit as $post): ?>
                        <li class="dashboard-list__item">
                            <a class="dashboard-list__link" href="/posts/<?= e($post['id']) ?>">
                                <?php if (has($post, 'image')): ?>
                                    <img class="dashboard-list__image" src="<?= e($post['image']) ?>"
                                        alt="<?= e($post['title'] ?? '') ?>">
                                <?php endif; ?>

                                <div class="dashboard-list__content">
                                    <h3 class="dashboard-list__title"><?= e($post['title'] ?? 'Sem título') ?></h3>

                                    <?php if (has($post, 'excerpt')): ?>
                                        <p class="dashboard-list__excerpt"><?= e($post['excerpt']) ?></p>
                                    <?php endif; ?>

                                    <?php if (has($post, 'date')): ?>
                                        <span class="dashboard-list__date"><?= e($post['date']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="dashboard-section__empty">Você ainda não publicou nenhum post.</p>
            <?php endif; ?>
        </section>

        <section class="dashboard-section">
            <div class="dashboard-section__header">
                <h2 class="dashboard-section__title">Meus Materiais</h2>
                <a href="/materials" class="dashboard-section__see-all">
                    Ver todos
                    <svg class="dashboard-section__arrow" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <?php if (!empty($materialsLimit)): ?>
                <ul class="dashboard-list">
                    <?php foreach ($materialsLimit as $material): ?>
                        <li class="dashboard-list__item">
                            <a class="dashboard-list__link" href="/materials/<?= e($material['id']) ?>">
                                <?php if (has($material, 'image')): ?>
                                    <img class="dashboard-list__image" src="<?= e($material['image']) ?>"
                                        alt="<?= e($material['title'] ?? '') ?>">
                                <?php endif; ?>

                                <div class="dashboard-list__content">
                                    <h3 class="dashboard-list__title"><?= e($material['title'] ?? 'Sem título') ?></h3>

                                    <?php if (has($material, 'excerpt')): ?>
                                        <p class="dashboard-list__excerpt"><?= e($material['excerpt']) ?></p>
                                    <?php endif; ?>

                                    <?php if (has($material, 'date')): ?>
                                        <span class="dashboard-list__date"><?= e($material['date']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="dashboard-section__empty">Você ainda não enviou nenhum material.</p>
            <?php endif; ?>
        </section>

    </main>

    <?= renderFooter() ?>
</body>

</html>