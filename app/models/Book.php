<?php

class Book extends AbstractEntity
{
    private int $id;
    private string $title;
    private string $description;
    private string $writer;
    private int $user_id;
    private bool $is_available;
    private string $image;

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function setWriter(string $writer): void
    {
        $this->writer = $writer;
    }
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function setIsAvailable(bool $is_available): void
    {
        $this->is_available = $is_available;
    }
    public function setImage(string $image): void
    {
        $this->image = $image;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getWriter(): string
    {
        return $this->writer;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getIsAvailable(): bool
    {
        return $this->is_available;
    }
    public function getImage(): string
    {
        return $this->image;
    }
}