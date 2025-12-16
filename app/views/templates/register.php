<div id="login-page">
    <div id="login-form">
        <h1>Inscription</h1>
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="/P4-TomTroc/public/register" method="POST">
            <div>
                <label for="nickname">Pseudo</label>
                <input type="text" id="nickname" name="nickname" required>
            </div>
            <div>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <div>
            <span>Déjà inscrit ?</span><a href="/P4-TomTroc/public/login"> Connectez-vous</a>
        </div>
    </div>
    <div>
        <img src="/P4-TomTroc/public/images/login_illustration.png" alt="Register Illustration">
    </div>
</div>