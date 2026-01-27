<div id="tchat-page">
    <?php if (!empty($rooms)): ?>
        <input type="checkbox" id="tchat-toggle" class="mobile-only" <?= isset($user) ? 'checked' : '' ?>>
        <label for="tchat-toggle">
            <img src="<?= BASE_URL ?>images/back-arrow.svg" alt="Flèche de retour" class="mobile-only back-arrow">
            <p>retour</p>
        </label>
        <div id="tchat-rooms">
            <h1>Messagerie</h1>
            <?php foreach ($rooms as $index => $room):
                $otherUserId = ($room->getUser1() === $_SESSION['user']->getId()) ? $room->getUser2() : $room->getUser1();
                $otherUser = (new UserManager())->findById($otherUserId);
                $latestMessage = (new MessagesManager())->findById($room->getLatestMessage());
                $isCurrentRoom = ($user && $user->getId() === $otherUserId);
            ?>
            <div class="tchatRoom <?= $isCurrentRoom ? 'current-room' : '' ?>">
                <a href="<?= BASE_URL ?>tchat/<?=   $otherUserId ?>">
                    <img src="<?= $otherUser->getImage() ?>" alt="User profile">
                    <div class="room-text">
                        <div class="room-text-header">
                            <span><?= $otherUser->getNickname() ?></span>
                            <span><?= date('H:i', strtotime($latestMessage->getDate())) ?></span>
                        </div>
                        <span><?= $latestMessage->getContent() ?></span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Vous n'avez aucun message</p>
    <?php endif; ?>
    <?php if ($user): ?>
        <div id="tchat-window">
            <div id="current-tchat-profile">
                <img src="<?= $user->getImage() ?>" alt="<?= $user->getNickname() ?>">
                <span><?= $user->getNickname() ?></span>
            </div>
            <div id="tchat">
                <div id="tchat-messages">
                    <?php foreach ($messages as $message):
                        $isCurrentUser = $message->getUserId() === $_SESSION['user']->getId();
                    ?>
                        <div class="<?= $isCurrentUser ? 'current-user-message' : 'other-user-message' ?>">
                            <div class="message-info">
                                <?php if (!$isCurrentUser): ?>
                                    <img src="<?= (new UserManager())->findById($message->getUserId())->getImage() ?>" alt="">
                                <?php endif; ?>
                                <span class="date"><?= date('d:m H:i', strtotime($message->getDate())) ?></span>
                            </div>
                            <span class="content"><?= $message->getContent() ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <form id="tchat-form" method="post" action="<?= BASE_URL ?>tchat/<?= $user->getId() ?>">
                    <input type="hidden" name="tchat_room_id" value="<?= $tchatRoomId ?>">
                    <input name="message" placeholder="Tapez votre message ici..." required>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>