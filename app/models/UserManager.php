<?php

class UserManager extends AbstractEntityManager
{
    public function emailExists($email): bool
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $query = "SELECT COUNT(*) FROM user WHERE email = ?";
        $stmt = $this->db->query($query, [$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function nicknameExists($nickname): bool
    {
        $nickname = htmlspecialchars($nickname);
        $query = "SELECT COUNT(*) FROM user WHERE nickname = ?";
        $stmt = $this->db->query($query, [$nickname]);
        return $stmt->fetchColumn() > 0;
    }

    public function findByEmail($email): ?User
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->db->query($query, [$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new User($data);
        }
        return null;
    }

    public function findById($id): ?User
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->db->query($query, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new User($data);
        }
        return null;
    }

    public function create($nickname, $email, $password)
    {
        try {
            $nickname = htmlspecialchars($nickname);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($password);

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user (nickname, email, password) VALUES (?, ?, ?)";
            $stmt = $this->db->query($query, [$nickname, $email, $hashedPassword]);

            return $stmt;
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            return false;
        }
    }

    public function update($nickname, $email, $password, $image, $user)
    {
        try {
            $userId = $user->getId();
            $nickname = htmlspecialchars($nickname);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($password);

            $imagePath = (isset($image) && !empty($image['tmp_name'])) ? $this->uploadImageToCloudinary($image) : null;

            $updateFields = [];
            $updateValues = [];

            $updateFields[] = "nickname = ?";
            $updateValues[] = $nickname;
            $updateFields[] = "email = ?";
            $updateValues[] = $email;

            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateFields[] = "password = ?";
                $updateValues[] = $hashedPassword;
            }

            if ($imagePath) {
                if ($user->getImage()) {
                    $this->deleteImageFromCloudinary($user->getImage());
                }
                $updateFields[] = "image = ?";
                $updateValues[] = $imagePath;
            }

            $updateValues[] = $userId;

            $query = "UPDATE user SET " . implode(", ", $updateFields) . " WHERE id = ?";
            $stmt = $this->db->query($query, $updateValues);
            
            return $stmt;
        } catch (PDOException $e) {
            error_log("Update user error: " . $e->getMessage());
            return false;
        }
    }
}