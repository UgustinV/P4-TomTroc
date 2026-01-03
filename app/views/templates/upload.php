<div id="upload-page">
    <h1>Ajouter un livre</h1>
    <form action="/P4-TomTroc/public/upload" method="POST" enctype="multipart/form-data">
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
                <input class="input" type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="writer">Auteur</label>
                <input class="input" type="text" id="writer" name="writer" required>
            </div>
            <div>
                <label for="description">Commentaire</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div>
                <label for="availability">Disponibilité</label>
                <select class="input" id="availability" name="is_available" value="1">
                    <option value="1" selected>Disponible</option>
                    <option value="0">Indisponible</option>
                </select>
            </div>
            <button type="submit">Ajouter</button>
        </div>
        <div id="image-input">
            <p>Photo</p>
            <div id="image-field">
                <label for="image-import">
                    <img src="/P4-TomTroc/public/images/upload_illustration.svg" alt="Upload Illustration">
                </label>
                <input type="file" id="image-import" name="image" accept=".png, .jpg, .jpeg" required>
            </div>
        </div>
    </form>
</div>