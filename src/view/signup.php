<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/assets/css/style.css'>
    <title>Noesis - Criar Conta</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        window.enableSubmit = () => document.getElementById("loginBtn").disabled = false;
        window.disableSubmit = () => document.getElementById("loginBtn").disabled = true;
    </script>
</head>

<body>
    <?= renderHeader($navItems) ?>
    <main class="signup">
        <h2>Cadastro</h2>
        <form id="signupForm" class="signup__form" action="/signup" method="POST" enctype="multipart/form-data"
            novalidate>
            <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">

            <div class="signup__field">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" required autocomplete="name" />
            </div>

            <div class="signup__field">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" required autocomplete="username"
                    pattern="[a-zA-Z0-9_]+" />
            </div>

            <div class="signup__field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required autocomplete="email" />
            </div>

            <div class="signup__field">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required minlength="8"
                    autocomplete="new-password" />
            </div>

            <div class="signup__field">
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" maxlength="300"></textarea>
            </div>

            <div class="signup__field">
                <label for="image">Foto de perfil</label>
                <div class="signup__image-wrapper">
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                    <img class="signup__preview" id="preview" src="" alt="Prévia">
                </div>
            </div>

            <div class="g-recaptcha" data-sitekey="<?= Recaptcha::captchaPublic() ?>"
                data-callback="enableSubmit" data-expired-callback="disableSubmit"></div>

            <button type="submit" id="loginBtn" disabled>Criar conta</button>
        </form>
        <p>Já tem uma conta? <a href="/login">Entrar</a></p>
    </main>
    <?= renderFooter() ?>
    <?= renderVLibras() ?>
</body>
<script type="module" src="/assets/js/signup.js"></script>
