<div id="edit-page">
    <h1>Modifier les informations</h1>
    <form action="/P4-TomTroc/public/editBook/<?= htmlspecialchars($book->getId()) ?>" method="POST" enctype="multipart/form-data">
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div id="form-fields">
            <div>
                <label for="title">Titre</label>
                <input class="input" type="text" id="title" name="title" required value="<?= htmlspecialchars($book->getTitle()) ?>">
            </div>
            <div>
                <label for="writer">Auteur</label>
                <input class="input" type="text" id="writer" name="writer" required value="<?= htmlspecialchars($book->getWriter()) ?>">
            </div>
            <div>
                <label for="description">Commentaire</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($book->getDescription()) ?></textarea>
            </div>
            <div>
                <label for="availability">Disponibilité</label>
                <select class="input" id="availability" name="is_available" value="1">
                    <option value="1" <?= $book->getIsAvailable() ? 'selected' : '' ?>>disponible</option>
                    <option value="0" <?= !$book->getIsAvailable() ? 'selected' : '' ?>>indisponible</option>
                </select>
            </div>
            <button type="submit">Valider</button>
        </div>
        <div id="image-input">
            <p>Photo</p>
            <div id="image-field">
                <label for="image-import">
                    <img src="<?= htmlspecialchars($book->getImage()) ?>" alt="Image du livre">
                </label>
                <input type="file" id="image-import" name="image" accept=".png, .jpg, .jpeg">
            </div>
        </div>
    </form>
</div>