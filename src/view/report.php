<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Denuncia</title>
</head>

<?php

function renderReportForm($type, $contentId)
{
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
                <option value='adult-content'>
                    Conteúdo Adulto (+18)
                </option>

                <option value='hate-speech'>
                    Racismo / Discriminação / Preconceito
                </option>

                <option value='misinformation'>
                    Desinformação
                </option>
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

            <a
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

                    <a
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

                    <a
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

            <a
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

                    <a
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

echo renderHeader($navItems);
if ($type === 'material') {
    echo reportMaterial($material, $author);
} elseif ($type === 'post') {
    echo reportPost($post, $author);
}
echo renderFooter();
echo renderVLibras();