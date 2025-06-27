<?php

namespace App\Kernel\Service;

use App\Kernel\Database\DatabaseInterface;

abstract class AbstractService
{
    protected string $modelClass;
    protected string $tableName;
    protected array $modelConstructorArgs = [];

    public function __construct(
        private DatabaseInterface $db
    ) {
        $this->initialize();
    }

    abstract protected function initialize(): void;

    /**
     * @return array<object>
     */
    public function all(): array
    {
        $items = $this->db->get($this->tableName);

        return array_map(function ($item) {
            return $this->createModel($item);
        }, $items);
    }

    public function get(array $conditions = []): array
    {
        $items = $this->db->get($this->tableName, $conditions);

        return array_map(function ($item) {
            return $this->createModel($item);
        }, $items);
    }

    public function fulltextSearch(string|array $columns, string $searchTerm, array $conditions = [], array $join = [], string $order = '', array $select = ['*']) : array
    {
        $items = $this->db->fulltextSearch($this->tableName, $columns, $searchTerm, $conditions, $join, $order, $select);

        return array_map(function ($item) {
            return $this->createModel($item);
        }, $items);
    }

    public function find(int $id, int $userId): ?object
    {
        $item = $this->db->first($this->tableName, [
            'id' => $id,
            'user_id' => $userId
        ]);

        return $item ? $this->createModel($item) : null;
    }

    public function store(array $data): int
    {
        return $this->db->insert($this->tableName, $data);
    }

    public function update(int $id, array $data): void
    {
        $this->db->update($this->tableName, $data, [
            'id' => $id
        ]);
    }

    public function delete(int $id): void
    {
        $this->db->delete($this->tableName, [
            'id' => $id
        ]);
    }

    protected function createModel(array $data): object
    {
        $args = [];
        foreach ($this->modelConstructorArgs as $key => $value) {
            if ($value === ':db') {
                $args[$key] = $this->db;
            } elseif (array_key_exists($value, $data)) {
                $args[$key] = $data[$value];
            } else {
                $args[$key] = $value;
            }
        }

        return new $this->modelClass(...$args);
    }
}
