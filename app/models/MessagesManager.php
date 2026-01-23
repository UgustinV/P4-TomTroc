<?php

class MessagesManager extends AbstractEntityManager
{
    public function getMessagesByTchatRoomId(int $tchatRoomId): array
    {
        $query = "
            SELECT *
            FROM messages
            WHERE tchat_room_id = ?
            ORDER BY date ASC
        ";
        $stmt = $this->db->query($query, [$tchatRoomId]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $messages = [];
        foreach ($data as $row) {
            $messages[] = new Messages($row);
        }
        return $messages;
    }

    public function findById(int $messageId): Messages|null
    {
        $query = "
            SELECT *
            FROM messages
            WHERE id = ?
        ";
        $stmt = $this->db->query($query, [$messageId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return new Messages($data);
        } else {
            return null;
        }
    }

    private function getLastInsertId($tchatRoomId): ?int
    {
        $roomManager = new TchatRoomManager();
        $room = $roomManager->getUserTchatRoomById($tchatRoomId);
        if ($room === null) {
            return null;
        }
        $user1 = $room->getUser1();
        $user2 = $room->getUser2();
        $query = "SELECT id FROM messages WHERE user_id = ? OR user_id = ? ORDER BY date DESC LIMIT 1";
        $stmt = $this->db->query($query, [$user1, $user2]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $latestMessageId = new Messages($data);
            return $latestMessageId->getId();
        }
        return null;
    }

    public function createMessage(string $content, int $tchatRoomId, int $userId): ?int
    {
        $query = "
            INSERT INTO messages (content, tchat_room_id, user_id, date)
            VALUES (?, ?, ?, NOW())
        ";
        $this->db->query($query, [$content, $tchatRoomId, $userId]);
        return $this->getLastInsertId($tchatRoomId);
    }

    public function markMessagesAsRead(int $tchatRoomId, int $currentUserId): void
    {
        $query = "
            UPDATE messages 
            SET message_read = 1 
            WHERE tchat_room_id = ? 
            AND user_id != ? 
            AND message_read = 0
        ";
        $this->db->query($query, [$tchatRoomId, $currentUserId]);
    }

    public function countAllUnreadMessagesForUser(int $currentUserId): int
    {
        $query = "
            SELECT COUNT(*) as total_unread
            FROM messages m
            INNER JOIN tchat tr ON m.tchat_room_id = tr.id
            WHERE (tr.user1 = ? OR tr.user2 = ?)
            AND m.user_id != ?
            AND m.message_read = 0
        ";
        $stmt = $this->db->query($query, [$currentUserId, $currentUserId, $currentUserId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$data['total_unread'];
    }
}