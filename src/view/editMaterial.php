<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Noesis - Editar Material</title>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main><?php require __DIR__ . '/materialForm.php'; ?></main><?= renderFooter() ?><?= renderVLibras() ?>
    <script type="module" src="/assets/js/materialForm.js"></script>
</body>

</html>