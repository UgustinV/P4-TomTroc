<div>
    <h1>Mon Compte</h1>
    <div id="user-info">
        <img src="<?= htmlspecialchars($user->getImage()) ?>" alt="">
        <label for="image">modifier</label>
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
    </div>
    <div id="profile-edit-form">
        <form action="/P4-TomTroc/public/account" method="POST" enctype="multipart/form-data">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="●●●●●●●●●">
            <label for="nickname">Modifier le pseudo :</label>
            <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($user->getNickname()) ?>" required>
            <input type="file" id="image" name="image" accept="image/*">
            <button type="submit">Enregistrer</button>
        </form>
    </div>
    <div id="user-books">
        <div id="books-container">
            <table>
                <thead>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Action</th>
                </thead>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($book["image"]) ?>" alt="Image de livre" class="book-image"></td>
                        <td><?= htmlspecialchars($book["title"]) ?></td>
                        <td><?= htmlspecialchars($book["writer"]) ?></td>
                        <td><?= htmlspecialchars($book["description"]) ?></td>
                        <td><?= $book["is_available"] ? 'disponible' : 'indisponible' ?></td>
                        <td>
                            <a href="/P4-TomTroc/public/edit/<?= $book["id"] ?>">Éditer</a>
                            <a href="/P4-TomTroc/public/delete/<?= $book["id"] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>