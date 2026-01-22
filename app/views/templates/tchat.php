<div>
    <h1>Messagerie</h1>
    <?php if ($user): ?>
        <div>
            <strong>Chatting with User : <?= htmlspecialchars($user->getNickname()) ?></strong>
        </div>
        <div id="tchat-messages">
            <?php foreach ($messages as $message): ?>
                <div class="message">
                    <span class="author"><?= htmlspecialchars($message->getUserId()) ?>:</span>
                    <span class="content"><?= htmlspecialchars($message->getContent()) ?></span>
                    <span class="date"><?= htmlspecialchars($message->getDate()) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <form id="tchat-form" method="post" action="/P4-TomTroc/public/tchat/<?= htmlspecialchars($user->getId()) ?>">
            <input type="hidden" name="tchat_room_id" value="<?= htmlspecialchars($tchatRoomId) ?>">
            <textarea name="message" placeholder="Type your message here..." required></textarea>
            <button type="submit">Send</button>
        </form>
    <?php endif; ?>
    <?php if (!empty($otherUsers) && !empty($rooms)): ?>
        <div id="tchat-rooms">
            <h2>Your Chats</h2>
            <ul>
                <?php foreach ($rooms as $index => $room): ?>
                    <?php 
                        $otherUserId = ($room->getUser1() === $_SESSION['user']->getId()) ? $room->getUser2() : $room->getUser1();
                        $user = (new UserManager())->findById($otherUserId);
                    ?>
                    <li>
                        <a href="/P4-TomTroc/public/tchat/<?= htmlspecialchars($otherUserId) ?>">
                            Chat with <?= htmlspecialchars($user->getNickname()) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <p>You have no chat rooms. Start a new conversation!</p>
    <?php endif; ?>
</div>