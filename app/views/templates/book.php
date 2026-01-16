<div>
    <?php if ($book): ?>
        <h1><?php echo htmlspecialchars($book->getTitle()); ?></h1>
        <p><?php echo htmlspecialchars($book->getWriter()); ?></p>
        <p><?php echo htmlspecialchars($book->getDescription()); ?></p>
    <?php else: ?>
        <p>Aucun livre trouvé.</p>
    <?php endif; ?>
</div>