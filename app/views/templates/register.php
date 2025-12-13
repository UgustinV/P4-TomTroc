<div id="login-page">
    <div id="login-form">
        <h1>Connexion</h1>
        <form action="POST">
            <div>
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" required>
            </div>
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
            <span>Déjà inscrit ?</span><a href="/P4-TomTroc/public/login"> Connectez-vous</a>
        </div>
    </div>
    <div>
        <img src="/P4-TomTroc/public/images/login_illustration.png" alt="Register Illustration">
    </div>
</div>