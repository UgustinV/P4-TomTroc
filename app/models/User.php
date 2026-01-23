<?php

class User extends AbstractEntity
{
    private int $id;
    private string $nickname;
    private string $email;
    private string $password;
    private ?string $image;
    private string $created_at;

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

    public function setImage(?string $image): void
    {
        $this->image = $image ?? "/P4-TomTroc/public/images/user-profile.svg";
    }

    public function setCreationDate(string $creationDate): void
    {
        $this->created_at = $creationDate;
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

    public function getImage(): ?string
    {
        return $this->image;
    }
    
    public function getCreationDate(): string
    {
        return $this->created_at;
    }
}