<div id="books-page">
    <div id="books-header">
        <h1>Nos Livres à l'échange</h1>
        <form id="book-search-form" method="GET" action="/P4-TomTroc/public/books">
            <img src="/P4-TomTroc/public/images/magnifier.svg" alt="Icône de recherche">
            <input type="text" name="search" placeholder="Rechercher un livre" value="<?= isset($_GET['search']) ? htmlspecialchars(string: $_GET['search']) : '' ?>">
        </form>
    </div>
    <div id="books-container">
        <?php foreach ($books as $book): ?>
            <a href="/P4-TomTroc/public/book/<?= $book['id'] ?>" class="details-button">
                <div class="book-card">
                    <div class="book-image-container">
                        <?= $book['is_available'] ? '' : '<div class="unavailable">non dispo.</div>' ?>
                        <img src="<?= $book['image'] ?>" alt="Couverture du livre <?= $book['title'] ?>">
                    </div>
                    <div class="book-info">
                        <h2><?= $book['title'] ?></h2>
                        <p><?= $book['writer'] ?></p>
                        <p><strong>Vendu par :</strong> <?= $book['user_nickname'] ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>