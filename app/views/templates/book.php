<p id="breadcrumb">Nos livres > <?= $book->getTitle() ?></p>
<div id="book-details">
    <?php if ($book): ?>
        <img src="<?= $book->getImage() ?>" alt="">
        <div id="details">
            <div id="title-name">
                <h1><?= $book->getTitle() ?></h1>
                <h2>par <?= $book->getWriter() ?></h2>
            </div>
            <div id="separator-line"> </div>
            <span>DESCRIPTION</span>
            <p><?= $book->getDescription() ?></p>
            <span>PROPRIÉTAIRE</span>
            <a id="owner" href="<?= BASE_URL . "userProfile/" . $owner->getId() ?>">
                <img src="<?= $owner->getImage() ?>" alt="Image de profile de <?= $owner->getNickname() ?>">
                <h3><?= $owner->getNickname() ?></h3>
            </a>
            <a href=<?= BASE_URL . "tchat/" . $owner->getId() ?>>Envoyer un message</a>
        </div>
    <?php else: ?>
        <p>Aucun livre trouvé.</p>
    <?php endif; ?>
</div>