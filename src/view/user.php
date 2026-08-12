<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Noesis - Usuario</title>
</head>

<?= renderHeader($navItems) ?>
<?php if (!$user): ?>
    <main class="userprofile userprofile--empty">
        <section class="userprofile__card userprofile__card--empty">

            <h1 class="userprofile__title">Usuário não encontrado</h1>

            <p class="userprofile__text">
                O perfil que você está tentando acessar não existe ou foi removido.
            </p>

            <a class="userprofile__button" href="/">
                Voltar para o início
            </a>

        </section>
    </main>

<?php else: ?>

    <main class="userprofile">

        <section class="userprofile__card">

            <div class="userprofile__header">

                <img class="userprofile__avatar"
                    src="<?= htmlspecialchars($user['image_url'] ?? '/assets/img/default-avatar.png') ?>" alt="Avatar">

                <h1 class="userprofile__name">
                    <?= htmlspecialchars($user['name']) ?>
                </h1>

                <p class="userprofile__username">
                    @<?= htmlspecialchars($user['username']) ?>
                </p>

                <div class="userprofile__badges">
                    <span class="userprofile__badge userprofile__badge--<?= $user['role'] ?>">
                        <?= strtoupper($user['role']) ?>
                    </span>

                    <span
                        class="userprofile__badge <?= $user['active'] ? 'userprofile__badge--active' : 'userprofile__badge--inactive' ?>">
                        <?= $user['active'] ? 'ATIVO' : 'INATIVO' ?>
                    </span>
                </div>

            </div>

            <div class="userprofile__body">

                <div class="userprofile__field">
                    <span class="userprofile__label">Email</span>
                    <span class="userprofile__value"><?= htmlspecialchars($user['email']) ?></span>
                </div>

                <div class="userprofile__field">
                    <span class="userprofile__label">Bio</span>
                    <span class="userprofile__value">
                        <?= nl2br(htmlspecialchars($user['bio'] ?? 'Sem bio ainda')) ?>
                    </span>
                </div>

                <div class="userprofile__field">
                    <span class="userprofile__label">Criado em</span>
                    <span class="userprofile__value"><?= $user['created_at'] ?></span>
                </div>

                <?php if (!empty($user['disabled_at'])): ?>
                    <div class="userprofile__field">
                        <span class="userprofile__label">Desativado em</span>
                        <span class="userprofile__value"><?= $user['disabled_at'] ?></span>
                    </div>
                <?php endif; ?>

            </div>
            <div class="userprofile__report">
                <a href="/report/user/<?= htmlspecialchars($user['username']) ?>" class="userprofile__report-link">
                    Denunciar usuário
                </a>
            </div>

        </section>

    </main>

    <?= renderFooter() ?>
    <?= renderVLibras() ?>
<?php endif; ?>