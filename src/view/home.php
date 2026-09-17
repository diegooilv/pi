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
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>

</html>