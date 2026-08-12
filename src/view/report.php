<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Denuncia</title>
</head>

<?php

function renderReportForm()
{
    return "
        <form class='report-form'>

            <input
                class='report-input'
                type='text'
                name='reason'
                placeholder='Descreva o motivo da denúncia'
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

            " . renderReportForm() . "

        </article>
    ";
}

function reportPost($post, $author)
{
    $linksHtml = '';

    foreach ($post->getLinks() as $link) {
        $linksHtml .= "
            <a
                class='report-link'
                href='{$link}'
                target='_blank'
            >
                {$link}
            </a>
        ";
    }

    return "
        <article
            class='report-content'
            id='post-{$post->getId()}'
        >

            <h2 class='report-heading'>
                Denúncia de Postagem
            </h2>

            <a
                class='report-card'
                href='/post/{$post->getId()}'
            >

                <div class='report-body'>

                    <h3 class='report-title'>
                        {$post->getTitle()}
                    </h3>

                    <img
                        class='report-image'
                        src='{$post->getBanner()}'
                        alt='{$post->getTitle()}'
                    >

                    <p class='report-description'>
                        {$post->getDescription()}
                    </p>

                </div>

            </a>

            <div class='report-footer'>

                <div class='report-links'>
                    {$linksHtml}
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

            " . renderReportForm() . "

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