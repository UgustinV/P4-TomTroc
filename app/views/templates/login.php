<div id="login-page">
    <div id="login-form">
        <h1>Connexion</h1>
        <form action="POST">
            <div>
                <label for="email">Adresse email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <div>
            <span>Pas encore de compte ?</span><a href="/P4-TomTroc/public/register"> Inscrivez-vous</a>
        </div>
    </div>
    <div>
        <img src="/P4-TomTroc/public/images/login_illustration.png" alt="Login Illustration">
    </div>
</div>