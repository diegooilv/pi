<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Entrar</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        window.enableSubmit = () => document.getElementById("loginBtn").disabled = false;
        window.disableSubmit = () => document.getElementById("loginBtn").disabled = true;
    </script>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main class="login">
        <h2>Entrar</h2>
        <form class="login__form" action="/login" method="POST" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">

            <div class="login__field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required autocomplete="email" />
            </div>

            <div class="login__field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required minlength="8"
                    autocomplete="new-password" />
            </div>

            <div class="g-recaptcha" data-sitekey="<?= Recaptcha::captchaPublic() ?>"
                data-callback="enableSubmit" data-expired-callback="disableSubmit"></div>

            <button type="submit" id="loginBtn" disabled>Entrar</button>

        </form>

        <p>Não tem uma conta? <a href="/signup">Criar</a></p>

    </main>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>

<script type="module" src="/assets/js/login.js"></script>