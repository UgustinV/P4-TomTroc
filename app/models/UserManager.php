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
} 