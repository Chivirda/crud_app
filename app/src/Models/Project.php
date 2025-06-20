<?php

namespace App\Models;

use App\Kernel\Database\DatabaseInterface;

class Project
{
    public function __construct(
        private int $id,
        private string $name,
        private int $userId,
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

    public function userId(): int
    {
        return $this->userId;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function activeTasksCount(): int
    {
        $tasks = $this->db->get('tasks', [
            'project_id' => $this->id,
            'status' => 0
        ]);

        return $tasks ? count($tasks) : 0;
    }

    public function tasks(): array
    {
        return $this->db->get('tasks', [
            'project_id' => $this->id
        ]);
    }
}
