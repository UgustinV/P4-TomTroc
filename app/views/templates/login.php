<div id="login-page">
    <div id="login-form">
        <h1>Connexion</h1>
        <form action="<?= BASE_URL ?>login" method="POST">
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <div>
            <span>Pas encore de compte ?</span><a href="<?= BASE_URL ?>register"> Inscrivez-vous</a>
        </div>
    </div>
    <div>
        <img src="<?= BASE_URL ?>images/login_illustration.png" alt="Login Illustration">
    </div>
</div>