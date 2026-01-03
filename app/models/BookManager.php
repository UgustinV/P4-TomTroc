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

    private function uploadImageToCloudinary($image)
    {
        if (!isset($image) || !is_array($image) || $image['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($image['type'], $allowedTypes)) {
            return false;
        }

        $uploadData = array(
            'file' => new CURLFile($image['tmp_name'], $image['type'], $image['name']),
            'upload_preset' => 'unsigned',
            'cloud_name' => CLOUDINARY_CLOUD_NAME
        );

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => CLOUDINARY_URL,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $uploadData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        if ($error) {
            error_log("Cloudinary upload cURL error: " . $error);
            return false;
        }

        if ($httpCode !== 200) {
            error_log("Cloudinary upload HTTP error: " . $httpCode);
            return false;
        }

        $data = json_decode($response, true);
        if (!$data || !isset($data['secure_url'])) {
            error_log("Cloudinary upload invalid response: " . $response);
            return false;
        }

        return $data['secure_url'];
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
}