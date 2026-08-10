<?php
function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function has($arr, $key) {
    return !empty($arr[$key]);
}

$u = $user ?? [];
$name = $u['name'] ?? $u['username'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($name) ?> — Perfil</title>
    <link rel='stylesheet' href='/assets/css/style.css'>
</head>

<body>
    <?= renderHeader($navItems) ?>

    <main class="user-profile">

        <header class="user-profile__hero">
            <?php if (has($u, 'image_url')): ?>
                <img class="user-profile__avatar" src="<?= e($u['image_url']) ?>"
                    alt="Foto de <?= e($name) ?>">
            <?php else: ?>
                <div class="user-profile__avatar user-profile__avatar--placeholder" aria-hidden="true">
                    <?= e(mb_strtoupper(mb_substr($name, 0, 1))) ?>
                </div>
            <?php endif; ?>

            <div class="user-profile__heading">
                <h1 class="user-profile__name"><?= e($name) ?></h1>

                <?php if (has($u, 'username')): ?>
                    <p class="user-profile__username">@<?= e($u['username']) ?></p>
                <?php endif; ?>

                <?php if (has($u, 'email')): ?>
                    <p class="user-profile__email"><?= e($u['email']) ?></p>
                <?php endif; ?>
            </div>
        </header>

        <?php if (has($u, 'bio')): ?>
            <section class="user-profile__section">
                <h2 class="user-profile__section-title">Sobre</h2>
                <p class="user-profile__bio"><?= nl2br(e($u['bio'])) ?></p>
            </section>
        <?php endif; ?>

        <?php if (!has($u, 'bio')): ?>
            <section class="user-profile__section user-profile__section--empty">
                <p class="user-profile__empty-text">Este usuário ainda não escreveu uma bio.</p>
            </section>
        <?php endif; ?>

    </main>

    <?= renderFooter() ?>
</body>

</html>