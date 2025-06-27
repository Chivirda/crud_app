<?php

namespace App\Kernel\Database;

interface DatabaseInterface
{
    public function insert(string $table, array $data): int|string;
    public function first(string $table, array $conditions = []): ?array;
    public function get(string $table, array $conditions = []): array;
    public function fulltextSearch(string $table, string|array $columns, string $searchTerm, array $conditions = [], array $join = [], string $order = '', array $select = ['*']) : array;
    public function update(string $table, array $data, array $conditions = []): void;
    public function delete(string $table, array $conditions = []): void;
}
