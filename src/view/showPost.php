<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - <?= htmlspecialchars($post['title']) ?></title>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main>
        <div class="post">
            <div class="post-content">

                <div class="post-header">
                    <span
                        class="post-category post-badge"><?= htmlspecialchars($post['category_name'] ?? 'Sem categoria') ?></span>

                    <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>

                    <?php if (!empty($post['image'])): ?>
                        <img class="post-cover" src="<?= htmlspecialchars($post['image']) ?>"
                            alt="<?= htmlspecialchars($post['title']) ?>">
                    <?php endif; ?>
                </div>

                <div class="post-body">
                    <?= nl2br(htmlspecialchars($post['body'])) ?>
                </div>

                <div class="post-meta">
                    <span class="post-author">
                        <span class="post-meta__label">por</span>
                        <?php if (!empty($post['author_id'])): ?>
                            <a href="/user/<?= (int) $post['author_id'] ?>" class="post-author__link">
                                <strong><?= htmlspecialchars($post['author_name'] ?? 'Autor desconhecido') ?></strong>
                            </a>
                        <?php else: ?>
                            <strong><?= htmlspecialchars($post['author_name'] ?? 'Autor desconhecido') ?></strong>
                        <?php endif; ?>
                    </span>

                    <span class="post-meta__info">
                        <span class="post-date"><?= date('d/m/Y', strtotime($post['created_at'])) ?></span>
                        <?php if (!empty($post['reading_time'])): ?>
                            <span class="post-meta__separator">•</span>
                            <span class="post-reading-time"><?= (int) $post['reading_time'] ?> min de leitura</span>
                        <?php endif; ?>
                    </span>
                </div>

                <div class="post-actions">
                    <a href="/report/post/<?= (int) $post['id'] ?>" class="post-report-btn">
                        Denunciar post
                    </a>
                </div>
            </div>
        </div>
    </main>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>