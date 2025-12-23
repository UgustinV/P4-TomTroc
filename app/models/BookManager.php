<?php

class BookManager extends AbstractEntityManager
{
    public function getAllBooksWithOwners(): array
    {
        $query = "
            SELECT b.id, b.title, b.writer, b.user_id, b.image, u.nickname AS user_nickname
            FROM book b
            JOIN user u ON b.user_id = u.id
        ";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}