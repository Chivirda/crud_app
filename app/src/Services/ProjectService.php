<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Project;

class ProjectService
{
    public function __construct(
        private DatabaseInterface $db
    ) {
    }

    /**
     * @return array<Project>
     */
    public function all(): array
    {
        $projects = $this->db->get('projects');

        return array_map(function ($project) {
            return new Project(
                id: $project['id'],
                name: $project['name'],
                userId: $project['user_id'],
                createdAt: $project['created_at'],
                db:$this->db
            );
        }, $projects);
    }

    public function find(int $id): ?Project
    {
        $project = $this->db->first('projects', [
            'id' => $id
        ]);

        if (! $project) {
            return null;
        }

        return new Project(
            id: $project['id'],
            name: $project['name'],
            userId: $project['user_id'],
            createdAt: $project['created_at'],
            db: $this->db
        );
    }

    public function update(int $id, string $name): void
    {
        $this->db->update('projects', [
            'name' => $name
        ], [
            'id' => $id
        ]);
    }

    public function delete(int $id): void
    {
        $this->db->delete('projects', ['id' => $id]);
    }
}
