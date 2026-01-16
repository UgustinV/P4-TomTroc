<?php

class BookManager extends AbstractEntityManager
{
    public function getAllBooksWithOwners(): array
    {
        $query = "
            SELECT b.id, b.title, b.writer, b.user_id, b.image, b.is_available, u.nickname AS user_nickname
            FROM book b
            JOIN user u ON b.user_id = u.id
        ";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserBooks($userId): array
    {
        $userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        $query = "
            SELECT b.id, b.title, b.writer, b.user_id, b.description, b.image, b.is_available, u.nickname AS user_nickname
            FROM book b
            JOIN user u ON b.user_id = u.id
            WHERE b.user_id = ?
        ";
        $stmt = $this->db->query($query, [$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $description, $writer, $image, $is_available, $user_id)
    {
        try {
            $title = htmlspecialchars($title);
            $description = htmlspecialchars($description);
            $writer = htmlspecialchars($writer);
            $is_available = (bool)$is_available;
            $user_id = (int)$user_id;

            // Handle image upload to Cloudinary
            $imagePath = $this->uploadImageToCloudinary($image);
            if (!$imagePath) {
                throw new Exception("Image upload failed");
            }

            $query = "INSERT INTO book (title, description, writer, image, is_available, user_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->query($query, [$title, $description, $writer, $imagePath, $is_available, $user_id]);
            
            return $stmt;
        } catch (Exception $e) {
            error_log("Book creation error: " . $e->getMessage());
            return false;
        }
    }

    public function update($title, $description, $writer, $image, $is_available, $book)
    {
        try {
            $title = htmlspecialchars($title);
            $description = htmlspecialchars($description);
            $writer = htmlspecialchars($writer);
            $is_available = (bool)$is_available;

            $previousImagePath = $book->getImage();

            if (!empty($image) && isset($image['tmp_name']) && $image['tmp_name'] !== '' && $image['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImageToCloudinary($image);
                if($imagePath) {
                    $this->deleteImageFromCloudinary($previousImagePath);
                } else {
                    $imagePath = $previousImagePath;
                }
            } else {
                $imagePath = $previousImagePath;
            }

            $query = "UPDATE book SET title = ?, description = ?, writer = ?, image = ?, is_available = ? WHERE id = ?";
            $stmt = $this->db->query($query, [$title, $description, $writer, $imagePath, $is_available, $book->getId()]);
            
            return $stmt;
        } catch (Exception $e) {
            error_log("Book update error: " . $e->getMessage());
            return false;
        }
    }

    public function getLastInserted(): ?Book
    {
        $query = "SELECT * FROM book ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->query($query);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Book($data);
        }
        return null;
    }

    public function searchBooks($searchTerm)
    {
        $searchTerm = htmlspecialchars($searchTerm);
        $sql = "SELECT b.id, b.title, b.writer, b.user_id, b.image, b.is_available, u.nickname as user_nickname
                FROM book b
                JOIN user u ON b.user_id = u.id
                WHERE b.title LIKE :search
                OR b.writer LIKE :search
                OR u.nickname LIKE :search";
        
        $stmt = $stmt = $this->db->query($sql, ['search' => '%' . $searchTerm . '%']);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestBooks(): array
    {
        $query = "
            SELECT b.id, b.title, b.writer, b.user_id, b.image, b.is_available, u.nickname AS user_nickname
            FROM book b
            JOIN user u ON b.user_id = u.id
            ORDER BY b.id DESC
            LIMIT 4
        ";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookById($id): ?Book
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM book WHERE id = ?";
        $stmt = $this->db->query($query, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Book($data);
        }
        return null;
    }
}