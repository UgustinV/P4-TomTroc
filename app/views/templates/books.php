<div id="books-page">
    <div id="books-header">
        <h1>Nos Livres à l'échange</h1>
        <form id="book-search-form" method="GET" action="<?= BASE_URL ?>books">
            <img src="<?= BASE_URL ?>images/magnifier.svg" alt="Icône de recherche">
            <input aria-label="Recherche" type="text" name="search" placeholder="Rechercher un livre" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        </form>
    </div>
    <div id="books-container">
        <?php foreach ($books as $book): ?>
            <a href="<?= BASE_URL ?>book/<?= $book['id'] ?>" class="details-button">
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