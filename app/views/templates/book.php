<p id="breadcrumb">Nos livres > <?= htmlspecialchars($book->getTitle()) ?></p>
<div id="book-details">
    <?php if ($book): ?>
        <img src="<?= $book->getImage() ?>" alt="">
        <div id="details">
            <div id="title-name">
                <h1><?= htmlspecialchars($book->getTitle()); ?></h1>
                <h2>par <?= htmlspecialchars($book->getWriter()); ?></h2>
            </div>
            <div id="separator-line"> </div>
            <span>DESCRIPTION</span>
            <p><?= htmlspecialchars($book->getDescription()); ?></p>
            <span>PROPRIÉTAIRE</span>
            <div id="owner">
                <img src=<?= $owner->getImage() ?> alt="Image de profile de <?= htmlspecialchars($owner->getNickname()); ?>>">
                <h3><?= htmlspecialchars($owner->getNickname()); ?></h3>
            </div>
            <a href=<?= "/P4-TomTroc/public/tchat/" . $owner->getId() ?>>Envoyer un message</a>
        </div>
    <?php else: ?>
        <p>Aucun livre trouvé.</p>
    <?php endif; ?>
</div>