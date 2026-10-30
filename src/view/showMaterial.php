<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Noesis - <?= htmlspecialchars($material['title']) ?></title>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main>
        <article class="post">
            <div class="post-content">
                <header class="post-header"><span
                        class="post-badge"><?= htmlspecialchars($material['category_name'] ?? 'Sem categoria') ?></span>
                    <h1 class="post-title"><?= htmlspecialchars($material['title']) ?></h1>
                    <?php if (!empty($material['image'])): ?><img class="post-cover"
                            src="<?= htmlspecialchars($material['image']) ?>"
                            alt="<?= htmlspecialchars($material['title']) ?>"><?php endif; ?>
                </header>
                <div class="post-body"><?= nl2br(htmlspecialchars($material['description'] ?? '')) ?></div>
                <?php if (!empty($material['url'])): ?><a class="material-open-btn"
                        href="<?= htmlspecialchars($material['url']) ?>" target="_blank" rel="noopener noreferrer">Abrir
                        material</a><?php endif; ?>
                <div class="post-meta"><span>por <a class="post-author__link"
                            href="/user/<?= rawurlencode($material['author_username'] ?? '') ?>"><strong><?= htmlspecialchars($material['author_name'] ?? 'Autor desconhecido') ?></strong></a></span><span><?= date('d/m/Y', strtotime($material['created_at'])) ?>
                        · <?= htmlspecialchars(strtoupper($material['type'])) ?></span></div>
                <div class="post-actions"><a class="post-report-btn"
                        href="/report/material/<?= (int) $material['id'] ?>">Denunciar
                        material</a><?php if (isset($_SESSION['auth']) && ((int) $material['author_id'] === (int) ($_SESSION['auth']['id'] ?? 0) || ($_SESSION['auth']['role'] ?? '') === 'admin')): ?><a
                            class="post-edit-btn" href="/material/<?= (int) $material['id'] ?>/edit">Editar
                            material</a><?php endif; ?></div>
            </div>
        </article>
    </main><?= renderFooter() ?><?= renderVLibras() ?>
</body>

</html>