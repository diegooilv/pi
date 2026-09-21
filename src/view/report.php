<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Denuncia</title>
</head>

<?php

function renderReportForm($type, $contentId, $extraCategories = [])
{
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
    return "
        <article
            class='report-content'
            id='material-{$material->getId()}'
        >
            <h2 class='report-heading'>
                Denúncia de Material
            </h2>
                class='report-card'
                href='/material/{$material->getId()}'
            >
                <div class='report-body'>
                    <h3 class='report-title'>
                        {$material->getTitle()}
                    </h3>
                    <img
                        class='report-image'
                        src='{$material->getImageUrl()}'
                        alt='{$material->getTitle()}'
                    >
                    <p class='report-description'>
                        {$material->getDescription()}
                    </p>
                </div>

            </a>

            <div class='report-footer'>
                <div class='report-actions'>
                        class='report-action'
                        href='{$material->getUrl()}'
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
                        src='{$author->getImageUrl()}'
                        alt='{$author->getUsername()}'
                    >
                        href='/user/{$author->getId()}'
                        class='report-author-name'
                    >
                        {$author->getUsername()}
                    </a>
                </div>
            </div>
            " . renderReportForm('material', $material->getId()) . "
        </article>
    ";
}

function reportPost($post, $author)
{
    return "
        <article
            class='report-content'
            id='post-{$post['id']}'
        >
            <h2 class='report-heading'>
                Denúncia de Postagem
            </h2>
                class='report-card'
                href='/post/{$post['id']}'
            >

                <div class='report-body'>
                    <h3 class='report-title'>
                        {$post['title']}
                    </h3>
                    <img
                        class='report-image'
                        src='{$post['image']}'
                        alt='{$post['title']}'
                    >
                    <p class='report-description'>
                        {$post['body']}
                    </p>
                </div>
            </a>

            <div class='report-footer'>
                <div class='report-author'>
                    <img
                        class='report-author-image'
                        src='{$author['image_url']}'
                        alt='{$author['username']}'
                    >
                        href='/user/{$author['id']}'
                        class='report-author-name'
                    >
                        {$author['username']}
                    </a>
                </div>
            </div>
            " . renderReportForm('post', $post['id']) . "
        </article>
    ";
}

function reportUser($user)
{
    $bio = $user['bio'] ?? 'Este usuário não possui biografia.';
    $imageUrl = $user['image_url'] ?? '/assets/img/default-avatar.png';

    return "
        <article
            class='report-content'
            id='user-{$user['id']}'
        >
            <h2 class='report-heading'>
                Denúncia de Usuário
            </h2>
                <a
                    class='report-card'
                    href='/user/{$user['username']}'
                >
                <div class='report-body'>
                    <img
                        class='report-image report-user-image'
                        src='{$imageUrl}'
                        alt='{$user['username']}'
                    >
                    <h3 class='report-title'>
                        {$user['username']}
                    </h3>
                    <p class='report-description'>
                        {$bio}
                    </p>
                </div>
            </a>
            " . renderReportForm('user', $user['id'], [
            'fake-profile' => 'Perfil Falso / Falsidade Ideológica',
            'harassment' => 'Assédio / Perseguição',
        ]) . "

        </article>
    ";
}

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