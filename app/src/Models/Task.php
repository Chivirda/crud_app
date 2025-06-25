<?php

namespace App\Models;

use App\Kernel\Database\DatabaseInterface;

class Task
{
    public function __construct(
        private int $id,
        private string $name,
        private int $status,
        private ?string $dueDate,
        private ?string $filePath,
        private int $userId,
        private int $projectId,
        private string $createdAt,
        private DatabaseInterface $db
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function dueDate(): ?string
    {
        return $this->dueDate;
    }

    public function filePath(): ?string
    {
        return $this->filePath;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function projectId(): int
    {
        return $this->projectId;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function isActive(): bool
    {
        return $this->status === 0;
    }

    public function today(): bool
    {
        return $this->dueDate() === (new \DateTime('today'))->format('Y-m-d');
    }

    public function tomorrow(): bool
    {
        return $this->dueDate() === (new \DateTime('tomorrow'))->format('Y-m-d');
    }

    public function overdue(): bool
    {
        return $this->dueDate() < ((new \DateTime())->format('Y-m-d'));
    }
}