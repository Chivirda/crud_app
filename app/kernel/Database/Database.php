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

    public function insert(string $table, array $data): int|false
    {
        $fields = implode(",", array_keys($data));
        $binds = implode(",", array_map(fn($field) => ":$field", array_keys($data)));

        $sql = "INSERT INTO $table ($fields) VALUES ($binds)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }

        return (int) $this->pdo->lastInsertId();
    }

    private function connect(): void
    {
        $driver = $this->config->get("database.driver");
        $host = $this->config->get("database.host");
        $port = $this->config->get("database.port");
        $database = $this->config->get("database.database");
        $charset = $this->config->get("database.charset");
        $username = $this->config->get("database.username");
        $password = $this->config->get("database.password");

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