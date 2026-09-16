<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Novo Post</title>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main class="create-post">
        <h2>Criar novo post</h2>

        <?php if (!empty($errors)): ?>
            <div class="create-post__errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="create-post__form" action="/create-post" method="POST" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">

            <div class="create-post__field">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" maxlength="255" required
                    value="<?= htmlspecialchars($old['title'] ?? '') ?>" />
            </div>

            <div class="create-post__field">
                <label for="category_id">Categoria</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"
                            <?= (isset($old['category_id']) && $old['category_id'] == $category['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="create-post__field">
                <label for="image">Imagem de capa</label>
                <input type="file" id="image" name="image" accept="image/*" />
            </div>

            <div class="create-post__field">
                <label for="body">Conteúdo</label>
                <textarea id="body" name="body" rows="15" required><?= htmlspecialchars($old['body'] ?? '') ?></textarea>
            </div>

            <button type="submit" id="createPostBtn">Publicar</button>

        </form>
    </main>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>

<script type="module" src="/assets/js/createPost.js"></script>