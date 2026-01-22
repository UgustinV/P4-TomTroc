<?php

class TchatRoom extends AbstractEntity
{
    private int $id;
    private int $user1;
    private int $user2;
    private ?int $latestMessage;

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setUser1(int $user1): void
    {
        $this->user1 = $user1;
    }
    public function setUser2(int $user2): void
    {
        $this->user2 = $user2;
    }
    public function setLatestMessage(?int $latestMessage): void
    {
        $this->latestMessage = $latestMessage;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getUser1(): int
    {
        return $this->user1;
    }
    public function getLatestMessage(): ?int
    {
        return $this->latestMessage;
    }
    public function getUser2(): int
    {
        return $this->user2;
    }
}