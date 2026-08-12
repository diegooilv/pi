<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Noesis - IA</title>
</head>

<?= renderHeader($navItems) ?>
<main>
    <section class="noesis-ia">
        <div class="noesis-ia__header">
            <div class="noesis-ia__avatar"><img src='/assets/noesis.png' alt='Logo do Site'></div>
            <div class="noesis-ia__info">
                <h1 class="noesis-ia__title">Noesis</h1>
                <span class="noesis-ia__subtitle">Assistente Filosófica</span>
            </div>
        </div>

        <div class="noesis-ia__chat" id="noesis-ia-chat">
            <div class="noesis-ia__message noesis-ia__message--system">
                <p class="noesis-ia">Olá! Sou a Noesis, sua assistente filosófica. Faça-me uma pergunta sobre filosofia.
                </p>
            </div>

            <?php if (!empty($resposta)): ?>
                <div class="noesis-ia__message noesis-ia__message--user">
                    <p class="noesis-ia"><?= htmlspecialchars($pergunta) ?></p>
                </div>
                <div class="noesis-ia__message noesis-ia__message--noesis">
                    <div class="noesis-ia__avatar noesis-ia__avatar--small"><img src='/assets/noesis.png'
                            alt='Logo do Site'>
                    </div>
                    <div class="noesis-ia__response">
                        <?= $resposta ?>
                    </div>
                </div>
            <?php endif ?>
        </div>

        <?php if (!empty($resposta)): ?>
            <div class="noesis-ia__disclaimer">
                <svg class="noesis-ia__disclaimer-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M12 8v4m0 4h.01M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10Z"
                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <div>
                    <strong>Resposta gerada por IA</strong>
                    <span>
                        Verifique informações, interpretações e referências filosóficas em fontes confiáveis.
                    </span>
                </div>
            </div>
        <?php endif; ?>

        <form class="noesis-ia__form" action="/ia" method="POST" id="noesis-ia-form">
            <input class="noesis-ia__input" type="text" name="prompt" id="prompt"
                placeholder="<?= !empty($resposta) ? 'Continue a conversa...' : 'Digite sua pergunta filosófica...' ?>"
                autocomplete="off" required>

            <button class="noesis-ia__button" type="submit">
                <svg viewBox="0 0 24 24" fill="none" class="noesis-ia__button-icon">
                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">
        </form>
    </section>
</main>

<?= renderFooter() ?>
<?= renderVLibras() ?>