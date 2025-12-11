<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav>
            <div id="browse">
                <a href="index.php">
                    <img src="./images/logo.png" alt="Logo de TomTroc" />
                </a>
                <a href="index.php">Accueil</a>
                <a href="index.php?action=apropos">Nos livres à l'échange</a>
            </div>
            <div id="account-manager">
                <?php 
                    // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                    if (isset($_SESSION['user'])) {
                        echo '<a href="index.php?action=contact">Messagerie</a><a href="index.php?action=faq">Mon Compte</a><a href="index.php?action=disconnectUser">Déconnexion</a>';
                    }
                    else {
                        echo '<a href="index.php?action=login">Connexion</a>';
                    }
                ?>
            </div>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
    
    <footer>
        <a href="">Politique de confidentialité</a>
        <a href="">Mentions légales</a>
        <div>Tom Troc©</div>
    </footer>

</body>
</html>