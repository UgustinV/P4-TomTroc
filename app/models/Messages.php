<?php

class Messages extends AbstractEntity
{
    private int $id;
    private string $content;
    private int $tchatRoomId;
    private int $userId;
    private string $date;

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function setTchatRoomId(int $tchatRoomId): void
    {
        $this->tchatRoomId = $tchatRoomId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
    public function setDate(string $date): void
    {
        $this->date = $date;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getTchatRoomId(): int
    {
        return $this->tchatRoomId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getDate(): string
    {
        return $this->date;
    }
}