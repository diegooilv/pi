<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Noesis - Editar Post</title>

</head>

<body>

    <?= renderHeader($navItems) ?>

    <main>
        <div class="post">
            <div class="post-content">
                <h2 class="post-title">Editar post</h2>
                <?php if (!empty($errors)): ?>
                    <div class="create-post__errors">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li>
                                    <?= htmlspecialchars($error) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                <?php endif; ?>

                <form id="postForm" class="create-post__form" action="/post/<?= (int) $post['id'] ?>/edit" method="POST"
                    enctype="multipart/form-data" novalidate>

                    <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">

                    <div class="post-field">
                        <label for="title">
                            Título
                        </label>
                        <input type="text" id="title" name="title" maxlength="255" required
                            value="<?= htmlspecialchars($post['title'] ?? '') ?>" />
                    </div>

                    <div class="post-field">
                        <label for="body">
                            Conteúdo
                        </label>
                        <textarea id="body" name="body" rows="15"
                            required><?= htmlspecialchars($post['body'] ?? '') ?></textarea>
                    </div>

                    <div class="post-field">
                        <label for="image">
                            Imagem de capa
                        </label>
                        <div class="post-image-wrapper">
                            <input type="file" id="image" name="image" accept="image/*" />

                            <img class="post-preview" id="preview" src="<?= htmlspecialchars($post['image'] ?? '') ?>"
                                alt="Prévia da imagem">
                        </div>
                    </div>
                    <button type="submit" id="editPostBtn" class="post-submit">
                        Salvar alterações
                    </button>
                </form>
            </div>
        </div>
    </main>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>

<script type="module" src="/assets/js/createPost.js"></script>