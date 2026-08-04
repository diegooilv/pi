<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Sophia - Criar Post</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        window.enableSubmit = () => document.getElementById("loginBtn").disabled = false;
        window.disableSubmit = () => document.getElementById("loginBtn").disabled = true;
    </script>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main>
        <div class="post">
            <div class="post-content">
                <h2 class="post-title">Nova Postagem</h2>

                <form id="postForm" action="/post" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">

                    <div class="post-field">
                        <label for="title">Título</label>
                        <input type="text" id="title" name="title" maxlength="255" required>
                    </div>

                    <div class="post-field">
                        <label for="body">Conteúdo</label>
                        <textarea id="body" name="body" rows="10" required></textarea>
                    </div>

                    <div class="post-field">
                        <label for="image">Imagem</label>
                        <div class="post-image-wrapper">
                            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                            <img class="post-preview" id="preview" src="" alt="Prévia da imagem">
                        </div>
                    </div>
                    <div class="post-field">
                        <label for="category_id">Categoria</label>
                        <select id="category_id" name="category_id" required>
                            <option value="" disabled selected>Selecione uma categoria</option>
                                    <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>">
                                            <?= htmlspecialchars($category['name']) ?>
                                </option>
                                    <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="post-submit">
                        Criar Post
                    </button>

                </form>
            </div>
        </div>
        </div>
    </main>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>
<script type="module" src="/assets/js/img.js"></script>