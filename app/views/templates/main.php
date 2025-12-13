<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= isset($title) ? "<title>$title</title>" : '<title>TomTroc</title>' ?>
    <link rel="stylesheet" href="/P4-TomTroc/public/css/main.css">
    <?= $title == 'TomTroc - Home' ? '<link rel="stylesheet" href="/P4-TomTroc/public/css/home.css">' : ($title == 'TomTroc - Login' ? '<link rel="stylesheet" href="/P4-TomTroc/public/css/login.css">' : '') ?>
</head>

<body>
    <header>
        <nav>
            <div id="browse">
                <a href="/P4-TomTroc/public/">
                    <img src="/P4-TomTroc/public/images/nav_logo.svg" alt="Logo de navigation TomTroc" />
                </a>
                <a href="/P4-TomTroc/public/">Accueil</a>
                <a href="/P4-TomTroc/public/books">Nos livres à l'échange</a>
            </div>
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="hamburger">
                <img src="/P4-TomTroc/public/images/burger_menu.svg" alt="Menu" class="burger-icon">
            </label>
            <div id="burger-content">
                <ul>
                    <li>
                        <a href="/P4-TomTroc/public/">Accueil</a>
                    </li>
                    <li>
                        <a href="/P4-TomTroc/public/books">Nos livres à l'échange</a>
                    </li>
                    <?php 
                        if (isset($_SESSION['user'])) {
                            echo '<li><a href="index.php?action=contact">Messagerie</a></li><li><a href="index.php?action=faq">Mon Compte</a></li><li><a href="index.php?action=disconnectUser">Déconnexion</a></li>';
                        }
                        else {
                            echo '<li><a href="/P4-TomTroc/public/login">Connexion</a></li>';
                        }
                        ?>
                </ul>
            </div>
            <div id="account-manager">
                <?php 
                    if (isset($_SESSION['user'])) {
                        echo '<a href="index.php?action=contact">Messagerie</a><a href="index.php?action=faq">Mon Compte</a><a href="index.php?action=disconnectUser">Déconnexion</a>';
                    }
                    else {
                        echo '<a href="/P4-TomTroc/public/login">Connexion</a>';
                    }
                ?>
            </div>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
    
    <footer>
        <a href="#">Politique de confidentialité</a>
        <a href="#">Mentions légales</a>
        <div>Tom Troc©</div>
        <img src="/P4-TomTroc/public/images/logo.svg" alt="Logo de TomTroc">
    </footer>

</body>
</html>