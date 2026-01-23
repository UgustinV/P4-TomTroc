<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= isset($title) ? "<title>$title</title>" : '<title>TomTroc</title>' ?>
    <link rel="stylesheet" href="/P4-TomTroc/public/css/main.css">
    <?php if ($title == 'TomTroc - Home'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/home.css">
    <?php elseif ($title == 'TomTroc - Login' || $title == 'TomTroc - Register'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/login.css">
    <?php elseif ($title == 'TomTroc - Upload'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/upload.css">
    <?php elseif ($title == 'TomTroc - Books'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/books.css">
    <?php elseif ($title == 'TomTroc - Account'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/account.css">
    <?php elseif ($title == 'TomTroc - Book'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/book.css">
    <?php elseif ($title == 'TomTroc - EditBook'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/editBook.css">
    <?php elseif ($title == 'TomTroc - Tchat'): ?>
        <link rel="stylesheet" href="/P4-TomTroc/public/css/tchat.css">
    <?php endif; ?>
</head>

<body>
    <header>
        <nav>
            <div id="browse">
                <a href="/P4-TomTroc/public/">
                    <img src="/P4-TomTroc/public/images/nav_logo.svg" alt="Logo de navigation TomTroc" />
                </a>
                <a href="/P4-TomTroc/public/" <?= $title == 'TomTroc - Home' ? 'class="focus"' : '' ?>>Accueil</a>
                <a href="/P4-TomTroc/public/books" <?= $title == 'TomTroc - Books' ? 'class="focus"' : '' ?>>Nos livres à l'échange</a>
            </div>
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="hamburger">
                <img src="/P4-TomTroc/public/images/burger_menu.svg" alt="Menu" class="burger-icon">
            </label>
            <div id="burger-content">
                <ul>
                    <li>
                        <a href="/P4-TomTroc/public/" <?= $title == 'TomTroc - Home' ? 'class="focus"' : '' ?>>Accueil</a>
                    </li>
                    <li>
                        <a href="/P4-TomTroc/public/books" <?= $title == 'TomTroc - Books' ? 'class="focus"' : '' ?>>Nos livres à l'échange</a>
                    </li>
                    <?php 
                        if (isset($_SESSION['user'])) {
                            echo '
                            <li>
                                <a href="/P4-TomTroc/public/upload">
                                    Publier
                                </a>
                            </li>
                            <li>
                                <a href="/P4-TomTroc/public/tchat"' . ($title == 'TomTroc - Tchat' ? 'class="focus"' : '') . '>
                                    Messagerie
                                </a>
                            </li>
                            <li>
                                <a href="/P4-TomTroc/public/account"' . ($title == 'TomTroc - Account' ? 'class="focus"' : '') . '>
                                    Mon Compte
                                </a>
                            </li>
                            <li>
                                <a href="/P4-TomTroc/public/logout">
                                    Déconnexion
                                </a>
                            </li>';
                        }
                        else {
                            echo '<li><a href="/P4-TomTroc/public/login"' . ($title == 'TomTroc - Login' ? 'class="focus"' : '') . '>Connexion</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div id="account-manager">
                <?php 
                    if (isset($_SESSION['user'])) {
                        echo '
                        <a href="/P4-TomTroc/public/upload">
                            Publier
                        </a>
                        <a id="tchat-link" href="/P4-TomTroc/public/tchat"' . ($title == 'TomTroc - Tchat' ? 'class="focus"' : '') . '>
                            <img src="/P4-TomTroc/public/images/tchat-icon.svg" alt="Messagerie">
                            <p>Messagerie</p><p>' . ($data['unreadMessagesCount'] > 0 ? $data['unreadMessagesCount'] : '') . '</p>
                        </a>
                        <a id="account-link" href="/P4-TomTroc/public/account"' . ($title == 'TomTroc - Account' ? 'class="focus"' : '') . '>
                            <img src="/P4-TomTroc/public/images/account-icon.svg" alt="Mon Compte">
                            <p>Mon Compte</p>
                        </a>
                        <a href="/P4-TomTroc/public/logout">
                            Déconnexion
                        </a>';
                    }
                    else {
                        echo '<a href="/P4-TomTroc/public/login"' . ($title == 'TomTroc - Login' ? 'class="focus"' : '') . '>Connexion</a>';
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