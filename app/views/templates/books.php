<h1>Nos Livres à l'échange</h1>
<div id="books-container">
    <?php foreach ($books as $book): ?>
        <div class="book-card">
            <img src="<?= $book['image'] ?>" alt="Couverture du livre <?= htmlspecialchars($book['title']) ?>">
            <h2><?= htmlspecialchars($book['title']) ?></h2>
            <p><strong>Auteur :</strong> <?= htmlspecialchars($book['writer']) ?></p>
            <p><strong>Proposé par :</strong> <?= htmlspecialchars($book['user_nickname']) ?></p>
            <a href="/P4-TomTroc/public/book/<?= $book['id'] ?>" class="details-button">Voir les détails</a>
        </div>
    <?php endforeach; ?>
</div>