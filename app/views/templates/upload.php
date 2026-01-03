<div id="upload-page">
    <div id="upload-form">
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
                    <input type="text" id="title" name="title" required>
                </div>
                <div>
                    <label for="writer">Auteur</label>
                    <input type="text" id="writer" name="writer" required>
                </div>
                <div>
                    <label for="description">Commentaire</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div>
                    <label for="availability">Disponibilité</label>
                    <input type="checkbox" id="availability" name="is_available" value="1" checked>
                </div>
                <button type="submit">Ajouter</button>
            </div>
            <div id="image-field">
                <img src="/P4-TomTroc/public/images/upload_illustration.svg" alt="Upload Illustration">
                <input type="file" id="image" name="image" accept="image/*" required></input>
            </div>
        </form>
    </div>
</div>