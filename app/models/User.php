<?php

class User extends AbstractEntity
{
    private int $id;
    private string $nickname;
    private string $email;
    private string $password;


    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function create($nickname, $email, $password)
    {
        try {
            $nickname = htmlspecialchars($nickname);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($password);

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $query = "INSERT INTO user (nickname, email, password) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            
            return $stmt->execute([$nickname, $email, $hashedPassword]);
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            return false;
        }
    }

    public function emailExists($email)
    {
        $query = "SELECT id FROM user WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }

    public function nicknameExists($nickname)
    {
        $query = "SELECT id FROM user WHERE nickname = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nickname]);
        return $stmt->fetch() !== false;
    }
}