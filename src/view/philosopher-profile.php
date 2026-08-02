<?php
function e($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function has($arr, $key)
{
    return !empty($arr[$key]);
}

$p = $philosopher ?? [];
$name = $p['name'] ?? 'Filósofo';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($name) ?> — Filósofos</title>
    <link rel='stylesheet' href='/assets/css/style.css'>
</head>

<body>
    <?= renderHeader($navItems) ?>

    <main class="philosophers-profile">

        <?php if (has($p, 'era')): ?>
            <button class="philosophers__info-trigger" id="philosophersInfoTrigger" aria-expanded="false"
                aria-controls="philosophersInfoCard" aria-label="Mais informações">
                <svg class="philosophers__info-trigger-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                    aria-hidden="true">
                    <path fill-rule="nonzero"
                        d="M256 0c70.69 0 134.69 28.66 181.02 74.98C483.34 121.3 512 185.31 512 256c0 70.69-28.66 134.7-74.98 181.02C390.69 483.34 326.69 512 256 512c-70.69 0-134.69-28.66-181.02-74.98C28.66 390.69 0 326.69 0 256c0-70.69 28.66-134.69 74.98-181.02C121.31 28.66 185.31 0 256 0zm-9.96 161.03c0-4.28.76-8.26 2.27-11.91 1.5-3.63 3.77-6.94 6.79-9.91 3-2.95 6.29-5.2 9.84-6.7 3.57-1.5 7.41-2.28 11.52-2.28 4.12 0 7.96.78 11.49 2.27 3.54 1.51 6.78 3.76 9.75 6.73 2.95 2.97 5.16 6.26 6.64 9.91 1.49 3.63 2.22 7.61 2.22 11.89 0 4.17-.73 8.08-2.21 11.69-1.48 3.6-3.68 6.94-6.65 9.97-2.94 3.03-6.18 5.32-9.72 6.84-3.54 1.51-7.38 2.29-11.52 2.29-4.22 0-8.14-.76-11.75-2.26-3.58-1.51-6.86-3.79-9.83-6.79-2.94-3.02-5.16-6.34-6.63-9.97-1.48-3.62-2.21-7.54-2.21-11.77zm13.4 178.16c-1.11 3.97-3.35 11.76 3.3 11.76 1.44 0 3.27-.81 5.46-2.4 2.37-1.71 5.09-4.31 8.13-7.75 3.09-3.5 6.32-7.65 9.67-12.42 3.33-4.76 6.84-10.22 10.49-16.31.37-.65 1.23-.87 1.89-.48l12.36 9.18c.6.43.73 1.25.35 1.86-5.69 9.88-11.44 18.51-17.26 25.88-5.85 7.41-11.79 13.57-17.8 18.43l-.1.06c-6.02 4.88-12.19 8.55-18.51 11.01-17.58 6.81-45.36 5.7-53.32-14.83-5.02-12.96-.9-27.69 3.06-40.37l19.96-60.44c1.28-4.58 2.89-9.62 3.47-14.33.97-7.87-2.49-12.96-11.06-12.96h-17.45c-.76 0-1.38-.62-1.38-1.38l.08-.48 4.58-16.68c.16-.62.73-1.04 1.35-1.02l89.12-2.79c.76-.03 1.41.57 1.44 1.33l-.07.43-37.76 124.7zm158.3-244.93c-41.39-41.39-98.58-67-161.74-67-63.16 0-120.35 25.61-161.74 67-41.39 41.39-67 98.58-67 161.74 0 63.16 25.61 120.35 67 161.74 41.39 41.39 98.58 67 161.74 67 63.16 0 120.35-25.61 161.74-67 41.39-41.39 67-98.58 67-161.74 0-63.16-25.61-120.35-67-161.74z" />
                </svg>
            </button>

            <div class="philosophers__info-card" id="philosophersInfoCard" role="dialog" aria-hidden="true">
                <h2 class="philosophers__info-card-title">Sobre as Informações</h2>
                <p class="philosophers__info-card-text">
                    Todos os textos foram elaborados com base em fontes públicas disponíveis na internet, com o apoio de
                    inteligência artificial.
                    <br>
                    As informações podem conter imprecisões ou estar desatualizadas.
                    <br>
                    <br>
                    Consulte uma fonte:<a
                        href="https://pt.wikipedia.org/wiki/<?= rawurlencode(str_replace(' ', '_', $name)) ?>"
                        target="_blank" rel="noopener noreferrer">
                        https://pt.wikipedia.org/
                    </a>
                    <br>
                    <br>
                    Encontrou algum erro ou a página não existe? <a href="/contact">Entre em contato</a>.
                </p>
            </div>
            <nav class="philosophers-profile__breadcrumb" aria-label="breadcrumb">
                <a href="/philosophers" class="philosophers-profile__breadcrumb-link">Filósofos</a>
                <span class="philosophers-profile__breadcrumb-sep" aria-hidden="true">/</span>
                <a href="/philosophers" class="philosophers-profile__breadcrumb-link">
                    <?= e($p['era']) ?>
                </a>
                <span class="philosophers-profile__breadcrumb-sep" aria-hidden="true">/</span>
                <span class="philosophers-profile__breadcrumb-current"><?= e($name) ?></span>
            </nav>
        <?php endif; ?>

        <header class="philosophers-profile__hero">
            <?php if (has($p, 'image')): ?>
                <img class="philosophers-profile__portrait" src="<?= e($p['image']) ?>"
                    alt="<?= e($p['image_alt'] ?? $name) ?>">
            <?php endif; ?>

            <div class="philosophers-profile__heading">
                <?php if (has($p, 'era')): ?>
                    <span class="philosophers-profile__tag"><?= e($p['era']) ?></span>
                <?php endif; ?>

                <h1 class="philosophers-profile__name"><?= e($name) ?></h1>

                <?php if (has($p, 'birth_year') || has($p, 'death_year') || has($p, 'birth_place')): ?>
                    <p class="philosophers-profile__dates">
                        <?php if (has($p, 'birth_year')): ?>
                            <?= e($p['birth_year']) ?>
                        <?php endif; ?>
                        <?php if (has($p, 'death_year')): ?>
                            – <?= e($p['death_year']) ?>
                        <?php elseif (has($p, 'birth_year')): ?>
                            – presente
                        <?php endif; ?>
                        <?php if (has($p, 'birth_place')): ?>
                            <span class="philosophers-profile__place">· <?= e($p['birth_place']) ?></span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>

                <?php if (has($p, 'school')): ?>
                    <p class="philosophers-profile__school"><?= e($p['school']) ?></p>
                <?php endif; ?>
            </div>
        </header>

        <?php if (has($p, 'quote')): ?>
            <blockquote class="philosophers-profile__quote">
                <p class="philosophers-profile__quote-text">"<?= e($p['quote']) ?>"</p>
                <cite class="philosophers-profile__quote-author">— <?= e($name) ?></cite>
            </blockquote>
        <?php endif; ?>

        <?php if (has($p, 'bio')): ?>
            <section class="philosophers-profile__section">
                <h2 class="philosophers-profile__section-title">Biografia</h2>
                <p class="philosophers-profile__text"><?= nl2br(e($p['bio'])) ?></p>
            </section>
        <?php endif; ?>

        <?php if (has($p, 'main_ideas') && is_array($p['main_ideas'])): ?>
            <section class="philosophers-profile__section">
                <h2 class="philosophers-profile__section-title">Principais Ideias</h2>
                <ul class="philosophers-profile__ideas">
                    <?php foreach ($p['main_ideas'] as $idea): ?>
                        <li class="philosophers-profile__ideas-item"><?= e($idea) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (has($p, 'works') && is_array($p['works'])): ?>
            <section class="philosophers-profile__section">
                <h2 class="philosophers-profile__section-title">Obras</h2>
                <ul class="philosophers-profile__works">
                    <?php foreach ($p['works'] as $work): ?>
                        <li class="philosophers-profile__works-item">
                            <span class="philosophers-profile__works-title"><?= e($work['title'] ?? '') ?></span>
                            <?php if (!empty($work['year'])): ?>
                                <span class="philosophers-profile__works-year"><?= e($work['year']) ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (has($p, 'legacy')): ?>
            <section class="philosophers-profile__section">
                <h2 class="philosophers-profile__section-title">Legado</h2>
                <p class="philosophers-profile__text"><?= nl2br(e($p['legacy'])) ?></p>
            </section>
        <?php endif; ?>

        <?php if ((has($p, 'influences') && is_array($p['influences'])) || (has($p, 'influenced') && is_array($p['influenced']))): ?>
            <section class="philosophers-profile__section philosophers-profile__relations">
                <?php if (has($p, 'influences') && is_array($p['influences'])): ?>
                    <div class="philosophers-profile__relations-col">
                        <h2 class="philosophers-profile__section-title">Influenciado por</h2>
                        <ul class="philosophers-profile__tags">
                            <?php foreach ($p['influences'] as $influence): ?>
                                <li class="philosophers-profile__tags-item"><?= e($influence) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (has($p, 'influenced') && is_array($p['influenced'])): ?>
                    <div class="philosophers-profile__relations-col">
                        <h2 class="philosophers-profile__section-title">Influenciou</h2>
                        <ul class="philosophers-profile__tags">
                            <?php foreach ($p['influenced'] as $influenced): ?>
                                <li class="philosophers-profile__tags-item"><?= e($influenced) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <nav class="philosophers-profile__back">
            <a href="/philosophers" class="philosophers-profile__back-link">← Voltar para Filósofos</a>
        </nav>

    </main>

    <?= renderFooter() ?>
    <?= renderVLibras() ?>

    <script src="/assets/js/philosophers.js" defer></script>
    <script src="/assets/js/trigger.js" defer></script>
</body>

</html>