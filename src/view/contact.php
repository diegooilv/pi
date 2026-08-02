<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Sophia - Suporte</title>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main class="contact">
        <h1>Fale conosco</h1>
        <p>Tem alguma dúvida, sugestão ou reclamação? Escolha o canal mais fácil pra você:</p>
        <?php if (isset($response)): ?>
            <div class="contact-alert contact-alert--<?= $response['type'] ?>">
                <?= htmlspecialchars($response['message']) ?>
            </div>
        <?php endif; ?>
        <?php if (!isset($response)): ?>
            <section class="contact-form">
                <h2>Envie uma mensagem</h2>
                <p>Preencha o formulário abaixo e responderemos o mais breve possível.</p>

                <form action="/contact" method="POST" class="contact-form__form">
                    <div class="contact-form__group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" maxlength="100" required>
                    </div>

                    <div class="contact-form__group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" maxlength="255" required>
                    </div>

                    <div class="contact-form__group">
                        <label for="title">Título</label>
                        <input type="text" id="title" name="title" maxlength="150" required>
                    </div>

                    <div class="contact-form__group">
                        <label for="description">Descrição</label>
                        <textarea id="description" name="description" rows="6" maxlength="3000" required></textarea>
                    </div>

                    <button type="submit" class="contact-form__button">
                        Enviar mensagem
                    </button>
                </form>
            </section>
            <div class="contact-card">
                <div class="contact-item">
                    <svg class="contact-item__icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="currentColor"
                            d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 2-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z" />
                    </svg>

                    <span>Email:</span>
                    <a href="mailto:<?= $email ?>"><?= $email ?></a>
                </div>

                <div class="contact-item">
                    <svg class="contact-item__icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="currentColor"
                            d="M6.62 10.79a15.46 15.46 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24 11.36 11.36 0 0 0 3.57.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.3 21 3 13.7 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.57 1 1 0 0 1-.24 1.02l-2.2 2.2z" />
                    </svg>

                    <span>Telefone:</span>
                    <a href="tel:<?= $number ?>"><?= $number ?></a>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <?= renderFooter() ?>
</body>

</html>