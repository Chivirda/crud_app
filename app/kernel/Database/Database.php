<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;
use PDO;

class Database implements DatabaseInterface
{
    private PDO $pdo;

    public function __construct(private ConfigInterface $config)
    {
        $this->connect();
    }

    public function first(string $table, array $conditions = []): ?array
    {
        $where = '';

        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function get(string $table, array $conditions = []): array
    {
        $where = '';

        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ?? [];
    }

    public function fulltextSearch(string $table, string|array $columns, string $searchTerm, array $conditions = [], array $join = [], string $order = '', array $select = ['*']): array
    {
        $searchColumns = is_array($columns) ? implode(', ', $columns) : $columns;

        $selectFields = implode(', ', $select);

        $sql = "SELECT $selectFields FROM $table";

        if (!empty($join)) {
            foreach ($join as $j) {
                $sql .= "{$j['type']} JOIN {$j['table']} ON {$j['on']}";
            }
        }

        $where = [];
        $params = [':search_term' => $searchTerm];

        $where[] = "MATCH($searchColumns) AGAINST(:search_term IN NATURAL LANGUAGE MODE)";

        if (!empty($conditions)) {
            foreach ($conditions as $field => $value) {
                $where[] = "$field = :$field";
                $params[":$field"] = $value;
            }
        }

        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        if ($order) {
            $sql .= " ORDER BY $order";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $data): int|string
    {
        $fields = implode(',', array_keys($data));
        $binds = implode(',', array_map(fn($field) => ":$field", array_keys($data)));

        $sql = "INSERT INTO $table ($fields) VALUES ($binds)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return $exception->getMessage();
        }

        return (int) $this->pdo->lastInsertId();
    }

    public function update(string $table, array $data, array $conditions = []): void
    {
        $fields = array_keys($data);

        $set = implode(', ', array_map(fn($field) => "$field = :$field", $fields));

        $where = '';

        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "UPDATE $table SET $set $where";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_merge($data, $conditions));
    }

    public function delete(string $table, array $conditions = []): void
    {
        $where = '';

        if (!empty($conditions)) {
            $where = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "DELETE FROM $table $where";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);

        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function connect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $charset = $this->config->get('database.charset');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');

        try {
            $this->pdo = new PDO(
                "$driver:host=$host;port=$port;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch (\PDOException $exception) {
            exit("Databse connection failed: {$exception->getMessage()}");
        }

    }
}
