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
}