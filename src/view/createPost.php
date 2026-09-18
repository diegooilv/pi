<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Novo Post</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        window.enableSubmit = () => document.getElementById("createPostBtn").disabled = false;
        window.disableSubmit = () => document.getElementById("createPostBtn").disabled = true;
    </script>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main>
        <div class="post">
            <div class="post-content">
                <h2 class="post-title">Criar novo post</h2>

                <?php if (!empty($errors)): ?>
                    <div class="create-post__errors">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="postForm" class="create-post__form" action="/post/create" method="POST" enctype="multipart/form-data" novalidate>

                    <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">

                    <div class="post-field">
                        <label for="title">Título</label>
                        <input type="text" id="title" name="title" maxlength="255" required
                            value="<?= htmlspecialchars($old['title'] ?? '') ?>" />
                    </div>

                    <div class="post-field">
                        <label for="body">Conteúdo</label>
                        <textarea id="body" name="body" rows="15" required><?= htmlspecialchars($old['body'] ?? '') ?></textarea>
                    </div>

                    <div class="post-field">
                        <label for="image">Imagem de capa</label>
                        <div class="post-image-wrapper">
                            <input type="file" id="image" name="image" accept="image/*" />
                            <img class="post-preview" id="preview" src="" alt="Prévia da imagem">
                        </div>
                    </div>

                    <div class="post-field">
                        <label for="category_id">Categoria</label>
                        <select id="category_id" name="category_id" required>
                            <option value="" disabled <?= !isset($old['category_id']) ? 'selected' : '' ?>>Selecione uma categoria</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"
                                    <?= (isset($old['category_id']) && $old['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" id="createPostBtn" class="post-submit">
                        Publicar
                    </button>

                </form>
            </div>
        </div>
    </main>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>
<script type="module" src="/assets/js/createPost.js"></script>