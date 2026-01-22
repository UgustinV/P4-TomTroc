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
}