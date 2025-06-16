<?php

namespace App\Models;

class Project
{
    public function __construct(
        private int $id,
        private string $name,
        private int $userId,
        private string $createdAt
    ){
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}