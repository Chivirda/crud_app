<?php

namespace App\Services;

use App\Kernel\Service\AbstractService;
use App\Models\Task;

class TaskService extends AbstractService
{
    public function initialize(): void
    {
        $this->modelClass = Task::class;
        $this->tableName = 'tasks';
        $this->modelConstructorArgs = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'dueDate' => 'due_date',
            'filePath' => 'file_path',
            'userId' => 'user_id',
            'projectId' => 'project_id',
            'createdAt' => 'creatged_at',
            'db' => ':db'
        ];
    }
}