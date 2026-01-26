<div id="user-profile">
    <div id="user-info">
        <div id="user-image-container">
            <img src="<?= htmlspecialchars($user->getImage()) ?>" alt="">
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
                    echo '<p>Vous n\'avez pas encore ajouté de livres.</p>';
                } elseif ($bookCount === 1) {
                    echo '<p>1 livre</p>';
                } else {
                    echo '<p>' . $bookCount . ' livres</p>';
                }
            ?>
        </div>
        <div id="send-message">
            <a href="/P4-TomTroc/public/tchat/<?= $user->getId() ?>">Écrire un message</a>
        </div>
    </div>
    <div id="user-books">
        <div id="table-header">
            <span>PHOTO</span>
            <span>TITRE</span>
            <span>AUTEUR</span>
            <span>DESCRIPTION</span>
        </div>
        <?php foreach ($books as $book): ?>
            <a class="book-row" href="/P4-TomTroc/public/book/<?= $book["id"] ?>">
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
            </a>
        <?php endforeach; ?>
    </div>
</div>