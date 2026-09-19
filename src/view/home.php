<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Noesis</title>
</head>

<body>
    <?= renderHeader($navItems) ?>

    <main>
        <main class="feed">
            <?php foreach ($posts as $postView): ?>
                <?= renderPost($postView) ?>
            <?php endforeach; ?>
        </main>
    </main>
    <nav class="pagination">
        <?php if ($page > 0): ?>
            <a href="<?= $page === 1 ? '/' : '/?page=' . ($page - 1) ?>">
                Anterior
            </a>
        <?php endif; ?>

        <?php for ($i = 0; $i < $totalPages; $i++): ?>
            <a href="<?= $i === 0 ? '/' : '/?page=' . $i ?>" class="<?= $i === $page ? 'active' : '' ?>">
                <?= $i + 1 ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages - 1): ?>
            <a href="/?page=<?= $page + 1 ?>">
                Próxima
            </a>
        <?php endif; ?>
    </nav>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>

</body>

</html>