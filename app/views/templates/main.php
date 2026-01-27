<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= isset($title) ? "<title>$title</title>" : '<title>TomTroc</title>' ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/main.css">
    <?php
        $cssFiles = [];
        switch ($title) {
            case 'TomTroc - Home':
                $cssFiles[] = 'home.css';
                break;
            case 'TomTroc - Login':
            case 'TomTroc - Register':
                $cssFiles[] = 'login.css';
                break;
            case 'TomTroc - Upload':
                $cssFiles[] = 'upload.css';
                break;
            case 'TomTroc - Books':
                $cssFiles[] = 'books.css';
                break;
            case 'TomTroc - Account':
                $cssFiles[] = 'account.css';
                break;
            case 'TomTroc - Book':
                $cssFiles[] = 'book.css';
                break;
            case 'TomTroc - EditBook':
                $cssFiles[] = 'editBook.css';
                break;
            case 'TomTroc - Tchat':
                $cssFiles[] = 'tchat.css';
                break;
            case 'TomTroc - UserProfile':
                $cssFiles[] = 'userProfile.css';
                break;
        }

        foreach ($cssFiles as $cssFile) {
            echo '<link rel="stylesheet" href="' . BASE_URL . 'css/' . $cssFile . '">';
        }
    ?>
</head>

<body>
    <header>
        <nav>
            <div id="browse">
                <a href="<?= BASE_URL ?>">
                    <img src="<?= BASE_URL ?>images/nav_logo.svg" alt="Logo de navigation TomTroc" />
                </a>
                <a href="<?= BASE_URL ?>" <?= $title == 'TomTroc - Home' ? 'class="focus"' : '' ?>>Accueil</a>
                <a href="<?= BASE_URL ?>books" <?= $title == 'TomTroc - Books' ? 'class="focus"' : '' ?>>Nos livres à l'échange</a>
            </div>
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="hamburger">
                <img src="<?= BASE_URL ?>images/burger_menu.svg" alt="Menu" class="burger-icon">
            </label>
            <div id="burger-content">
                <ul>
                    <li>
                        <a href="<?= BASE_URL ?>" <?= $title == 'TomTroc - Home' ? 'class="focus"' : '' ?>>Accueil</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>books" <?= $title == 'TomTroc - Books' ? 'class="focus"' : '' ?>>Nos livres à l'échange</a>
                    </li>
                    <?php 
                        if (isset($_SESSION['user'])) {
                            echo '
                            <li>
                                <a href="' . BASE_URL . 'upload">
                                    Publier
                                </a>
                            </li>
                            <li>
                                <a href="' . BASE_URL . 'tchat"' . ($title == 'TomTroc - Tchat' ? 'class="focus"' : '') . '>
                                    Messagerie
                                </a>
                            </li>
                            <li>
                                <a href="' . BASE_URL . 'account"' . ($title == 'TomTroc - Account' ? 'class="focus"' : '') . '>
                                    Mon Compte
                                </a>
                            </li>
                            <li>
                                <a href="' . BASE_URL . 'logout">
                                    Déconnexion
                                </a>
                            </li>';
                        }
                        else {
                            echo '<li><a href="' . BASE_URL . 'login"' . ($title == 'TomTroc - Login' ? 'class="focus"' : '') . '>Connexion</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div id="account-manager">
                <?php 
                    if (isset($_SESSION['user'])) {
                        echo '
                        <a href="' . BASE_URL . 'upload">
                            Publier
                        </a>
                        <a id="tchat-link" href="' . BASE_URL . 'tchat"' . ($title == 'TomTroc - Tchat' ? 'class="focus"' : '') . '>
                            <img src="' . BASE_URL . 'images/tchat-icon.svg" alt="Messagerie">
                            <p>Messagerie</p>'
                            . ($data['unreadMessagesCount'] > 0 ? '<p>' . $data['unreadMessagesCount'] . '</p>' : '') .
                        '</a>
                        <a id="account-link" href="' . BASE_URL . 'account"' . ($title == 'TomTroc - Account' ? 'class="focus"' : '') . '>
                            <img src="' . BASE_URL . 'images/account-icon.svg" alt="Mon Compte">
                            <p>Mon Compte</p>
                        </a>
                        <a href="' . BASE_URL . 'logout">
                            Déconnexion
                        </a>';
                    }
                    else {
                        echo '<a href="' . BASE_URL . 'login"' . ($title == 'TomTroc - Login' ? 'class="focus"' : '') . '>Connexion</a>';
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
        <img src="<?= BASE_URL ?>images/logo.svg" alt="Logo de TomTroc">
    </footer>

</body>
</html>