<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Noesis - Materiais</title>
</head>

<body><?= renderHeader($navItems) ?>
    <main class="feed"><?php if (!$materials): ?>
            <p class="feed-empty">Nenhum material publicado ainda.</p>

        <?php endif; ?><?php foreach ($materials as $materialView): ?>
            <?= renderMaterial($materialView) ?><?php endforeach; ?>
    </main>
    <nav class="pagination"><?php if ($page > 0): ?><a
                href="<?= $page === 1 ? '/materials' : '/materials?page=' . ($page - 1) ?>">Anterior</a><?php endif; ?><?php for ($i = 0; $i < $totalPages; $i++): ?><a
                href="<?= $i === 0 ? '/materials' : '/materials?page=' . $i ?>"
                class="<?= $i === $page ? 'active' : '' ?>"><?= $i + 1 ?></a><?php endfor; ?><?php if ($page < $totalPages - 1): ?><a
                href="/materials?page=<?= $page + 1 ?>">Próxima</a><?php endif; ?></nav>
    <?= renderFooter() ?><?= renderVLibras() ?>
</body>

</html>