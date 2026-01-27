<?php

class TchatRoomManager extends AbstractEntityManager
{
    public function getUserTchatRoom(int $user1, int $user2): TchatRoom|null
    {
        $query = "
            SELECT *
            FROM tchat
            WHERE (user1 IN (?, ?)) AND (user2 IN (?, ?))
        ";
        $user1 = filter_var($user1, FILTER_SANITIZE_NUMBER_INT);
        $user2 = filter_var($user2, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->db->query($query, [$user1, $user2, $user1, $user2]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($data)) {
            return new TchatRoom($data);
        } else {
            return null;
        }
    }

    public function getAllTchatRoomsForUser(int $userId): array
    {
        $query = "
            SELECT *
            FROM tchat
            WHERE user1 = ? OR user2 = ?
        ";
        $userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->db->query($query, [$userId, $userId]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tchatRooms = [];
        foreach ($data as $row) {
            $tchatRooms[] = new TchatRoom($row);
        }
        if(empty($tchatRooms)) {
            return [];
        }
        return $tchatRooms;
    }

    public function getLatestMessageRoom(int $userId): TchatRoom|null
    {
        $query = "
            SELECT *
            FROM tchat
            WHERE (user1 = ? OR user2 = ?)
            ORDER BY latest_message DESC
            LIMIT 1
        ";
        $userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->db->query($query, [$userId, $userId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($data)) {
            return new TchatRoom($data);
        } else {
            return null;
        }
    }

    public function getUserTchatRoomById(int $tchatRoomId): TchatRoom|null
    {
        $query = "
            SELECT *
            FROM tchat
            WHERE id = ?
        ";
        $tchatRoomId = filter_var($tchatRoomId, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->db->query($query, [$tchatRoomId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($data)) {
            return new TchatRoom($data);
        } else {
            return null;
        }
    }

    public function createTchatRoom(int $user1, int $user2, ?string $latestMessage): void
    {
        $query = "
            INSERT INTO tchat (user1, user2, latest_message)
            VALUES (?, ?, ?)
        ";
        $user1 = filter_var($user1, FILTER_SANITIZE_NUMBER_INT);
        $user2 = filter_var($user2, FILTER_SANITIZE_NUMBER_INT);
        $latestMessage = $latestMessage !== null ? filter_var($latestMessage, FILTER_SANITIZE_NUMBER_INT) : null;
        $this->db->query($query, [$user1, $user2, $latestMessage]);
    }

    public function updateLatestMessage(int $tchatRoomId, string $latestMessage): void
    {
        $query = "
            UPDATE tchat
            SET latest_message = ?
            WHERE id = ?
        ";
        $tchatRoomId = filter_var($tchatRoomId, FILTER_SANITIZE_NUMBER_INT);
        $latestMessage = filter_var($latestMessage, FILTER_SANITIZE_NUMBER_INT);
        $this->db->query($query, [$latestMessage, $tchatRoomId]);
    }
}