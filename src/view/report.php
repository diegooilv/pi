<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Denuncia</title>
</head>

<?php

function renderReportForm($type, $contentId, $extraCategories = [])
{
    $type = htmlspecialchars((string) $type, ENT_QUOTES, 'UTF-8');
    $contentId = htmlspecialchars((string) $contentId, ENT_QUOTES, 'UTF-8');
    $categoryOptions = "
                <option value='adult-content'>
                    Conteúdo Adulto (+18)
                </option>
                <option value='hate-speech'>
                    Racismo / Discriminação / Preconceito
                </option>

                <option value='misinformation'>
                    Desinformação
                </option>
    ";

    foreach ($extraCategories as $value => $label) {
        $value = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8');
        $categoryOptions .= "
                <option value='{$value}'>
                    {$label}
                </option>
        ";
    }

    return "
        <form class='report-form' action='/report' method='POST'>
            <input
                type='hidden'
                name='type'
                value='{$type}'
            >
            <input
                type='hidden'
                name='content_id'
                value='{$contentId}'
            >
            <input
                class='report-input'
                type='text'
                name='reason'
                placeholder='Descreva o motivo da denúncia'
                required
            >
            <label
                class='report-label'
                for='report-category'
            >
                Selecione a categoria:
            </label>
            <select
                class='report-select'
                id='report-category'
                name='category'
                required
            >
                {$categoryOptions}
            </select>
            <input
                class='report-submit'
                type='submit'
                value='Enviar denúncia'
            >
        </form>
    ";
}

function reportMaterial($material, $author)
{
    $materialId = (int) $material->getId();
    $title = htmlspecialchars($material->getTitle(), ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($material->getImageUrl(), ENT_QUOTES, 'UTF-8');
    $description = nl2br(htmlspecialchars($material->getDescription(), ENT_QUOTES, 'UTF-8'));
    $materialUrl = htmlspecialchars($material->getUrl(), ENT_QUOTES, 'UTF-8');
    $authorId = (int) $author->getId();
    $authorImage = htmlspecialchars($author->getImageUrl(), ENT_QUOTES, 'UTF-8');
    $authorName = htmlspecialchars($author->getUsername(), ENT_QUOTES, 'UTF-8');

    return "
        <article
            class='report-content'
            id='material-{$materialId}'
        >
            <h2 class='report-heading'>
                Denúncia de Material
            </h2>
            <a class='report-card'
                href='/material/{$materialId}'
            >
                <div class='report-body'>
                    <h3 class='report-title'>
                        {$title}
                    </h3>
                    <img
                        class='report-image'
                        src='{$imageUrl}'
                        alt='{$title}'
                    >
                    <p class='report-description'>
                        {$description}
                    </p>
                </div>

            </a>

            <div class='report-footer'>
                <div class='report-actions'>
                    <a class='report-action'
                        href='{$materialUrl}'
                        target='_blank'
                        rel='noopener noreferrer'
                        title='Abrir material'
                    >
                        📄
                    </a>
                </div>
                <div class='report-author'>
                    <img
                        class='report-author-image'
                        src='{$authorImage}'
                        alt='{$authorName}'
                    >
                    <a href='/user/{$authorId}'
                        class='report-author-name'
                    >
                        {$authorName}
                    </a>
                </div>
            </div>
            " . renderReportForm('material', $materialId) . "
        </article>
    ";
}

function reportPost($post, $author)
{
    $postId = (int) ($post['id'] ?? 0);
    $title = htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8');
    $image = htmlspecialchars($post['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $body = nl2br(htmlspecialchars($post['body'] ?? '', ENT_QUOTES, 'UTF-8'));
    $authorImage = htmlspecialchars($author['image_url'] ?? '', ENT_QUOTES, 'UTF-8');
    $authorName = htmlspecialchars($author['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $authorPath = rawurlencode($author['username'] ?? '');

    return "
        <article
            class='report-content'
            id='post-{$postId}'
        >
            <h2 class='report-heading'>
                Denúncia de Postagem
            </h2>
            <a class='report-card'
                href='/post/{$postId}'
            >

                <div class='report-body'>
                    <h3 class='report-title'>
                        {$title}
                    </h3>
                    <img
                        class='report-image'
                        src='{$image}'
                        alt='{$title}'
                    >
                    <p class='report-description'>
                        {$body}
                    </p>
                </div>
            </a>

            <div class='report-footer'>
                <div class='report-author'>
                    <img
                        class='report-author-image'
                        src='{$authorImage}'
                        alt='{$authorName}'
                    >
                    <a href='/user/{$authorPath}'
                        class='report-author-name'
                    >
                        {$authorName}
                    </a>
                </div>
            </div>
            " . renderReportForm('post', $postId) . "
        </article>
    ";
}

function reportUser($user)
{
    $userId = (int) ($user['id'] ?? 0);
    $username = htmlspecialchars($user['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $usernamePath = rawurlencode($user['username'] ?? '');
    $bio = nl2br(htmlspecialchars($user['bio'] ?? 'Este usuário não possui biografia.', ENT_QUOTES, 'UTF-8'));
    $imageUrl = htmlspecialchars($user['image_url'] ?? '/assets/img/default-avatar.png', ENT_QUOTES, 'UTF-8');

    return "
        <article
            class='report-content'
            id='user-{$userId}'
        >
            <h2 class='report-heading'>
                Denúncia de Usuário
            </h2>
                <a
                    class='report-card'
                    href='/user/{$usernamePath}'
                >
                <div class='report-body'>
                    <img
                        class='report-image report-user-image'
                        src='{$imageUrl}'
                        alt='{$username}'
                    >
                    <h3 class='report-title'>
                        {$username}
                    </h3>
                    <p class='report-description'>
                        {$bio}
                    </p>
                </div>
            </a>
            " . renderReportForm('user', $userId, [
            'fake-profile' => 'Perfil Falso / Falsidade Ideológica',
            'harassment' => 'Assédio / Perseguição',
        ]) . "

        </article>
    ";
}

echo '<body>';
echo renderHeader($navItems);
if ($type === 'material') {
    echo reportMaterial($material, $author);
} elseif ($type === 'post') {
    echo reportPost($post, $author);
} elseif ($type === 'user') {
    echo reportUser($user);
}
echo renderFooter();
echo renderVLibras();
echo '</body></html>';
