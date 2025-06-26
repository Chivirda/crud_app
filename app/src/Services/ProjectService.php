<?php

namespace App\Services;

use App\Kernel\Service\AbstractService;
use App\Models\Project;

class ProjectService extends AbstractService
{
    protected function initialize(): void
    {
        $this->modelClass = Project::class;
        $this->tableName = 'projects';
        $this->modelConstructorArgs = [
            'id' => 'id',
            'name'=> 'name',
            'userId' => 'user_id',
            'createdAt' => 'created_at',
            'db' => ':db'
        ];
    }
}
