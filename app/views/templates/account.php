<div id="account-page">
    <h1>Mon Compte</h1>
    <div id="user-section">
        <div id="user-info">
            <div id="user-image-container">
                <img src="<?= htmlspecialchars($user->getImage()) ?>" alt="">
                <label for="image">modifier</label>
            </div>
            <h2><?= htmlspecialchars($user->getNickname()) ?></h2>
            <?php
                if ($user->getCreationDate()) {
                    $creation_date = new DateTime($user->getCreationDate());
                    $current_date = new DateTime();
                    $interval = $current_date->diff($creation_date);
                    if ($interval->y >= 1) {
                        $years = $interval->y;
                        echo '<p>Membre depuis ' . $years . ' an' . ($years > 1 ? 's' : '') . '</p>';
                    } elseif ($interval->m >= 1) {
                        $months = $interval->m;
                        echo '<p>Membre depuis ' . $months . ' mois</p>';
                    } elseif ($interval->d >= 1) {
                        $days = $interval->d;
                        echo '<p>Membre depuis ' . $days . ' jour' . ($days > 1 ? 's' : '') . '</p>';
                    } else {
                        echo '<p>Membre depuis moins d\'un jour</p>';
                    }
                }
            ?>
            <span>BIBLIOTHEQUE</span>
            <div id="books-count">
                <img src="/P4-TomTroc/public/images/library.svg" alt="Icone bibliothèque">
                <?php
                    $bookCount = count($books);
                    if ($bookCount === 0) {
                        echo '<p>Vous n\'avez pas encore ajouté de livre.</p>';
                    } elseif ($bookCount === 1) {
                        echo '<p>1 livre</p>';
                    } else {
                        echo '<p>' . $bookCount . ' livres</p>';
                    }
                ?>
            </div>
        </div>
        <div id="profile-edit-form">
            <div id="profile-edit-container">
                <h3>Vos informations personnelles</h3>
                <form action="/P4-TomTroc/public/account" method="POST" enctype="multipart/form-data">
                    <div class="input-field">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>
                    </div>
                    <div class="input-field">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="●●●●●●●●●">
                    </div>
                    <div class="input-field">
                        <label for="nickname">Pseudo :</label>
                        <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($user->getNickname()) ?>" required>
                    </div>
                    <input type="file" id="image" name="image" accept="image/*">
                    <button type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
    <div id="user-books">
        <div id="table-header">
            <span>PHOTO</span>
            <span>TITRE</span>
            <span>AUTEUR</span>
            <span>DESCRIPTION</span>
            <span>DISPONIBILITÉ</span>
            <span>ACTION</span>
        </div>
        <?php foreach ($books as $book): ?>
            <div class="book-row">
                <div class="book-photo">
                    <img src="<?= htmlspecialchars($book["image"]) ?>" alt="">
                </div>
                <div class="book-title">
                    <p><?= htmlspecialchars($book["title"]) ?></p>
                </div>
                <div class="book-writer">
                    <p><?= htmlspecialchars($book["writer"]) ?></p>
                </div>
                <div class="book-description">
                    <p><?= htmlspecialchars($book["description"]) ?></p>
                </div>
                <div class="book-availability">
                    <?php if ($book["is_available"]): ?>
                        <span class="available">disponible</span>
                    <?php else: ?>
                        <span class="unavailable">non dispo.</span>
                    <?php endif; ?>
                </div>
                <div class="book-action">
                    <a href="/P4-TomTroc/public/editBook/<?= $book["id"] ?>">Éditer</a>
                    <a href="/P4-TomTroc/public/deleteBook/<?= $book["id"] ?>">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>