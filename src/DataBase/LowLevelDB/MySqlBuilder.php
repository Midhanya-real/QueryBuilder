<?php

namespace Core\DataBase\LowLevelDB;

class MySqlBuilder implements LowLevelBuilderInterface
{

    public function select(array $rows): static
    {
        // TODO: Implement select() method.
    }

    public function insert(string $table, array $fields): static
    {
        // TODO: Implement insert() method.
    }

    public function delete(): static
    {
        // TODO: Implement delete() method.
    }

    public function update(string $table): static
    {
        // TODO: Implement update() method.
    }

    public function from(string $table): static
    {
        // TODO: Implement from() method.
    }

    public function set(array $newValues): static
    {
        // TODO: Implement set() method.
    }

    public function values(array $values): static
    {
        // TODO: Implement values() method.
    }

    public function or(string $row, string $sign, string $value): static
    {
        // TODO: Implement or() method.
    }

    public function and(string $row, string $sign, string $value): static
    {
        // TODO: Implement and() method.
    }

    public function not(string $row): static
    {
        // TODO: Implement not() method.
    }

    public function limit(int $limit): static
    {
        // TODO: Implement limit() method.
    }

    public function offset(int $limit): static
    {
        // TODO: Implement offset() method.
    }

    public function groupBy(array $groupColumns): static
    {
        // TODO: Implement groupBy() method.
    }

    public function where(string $row, string $value, string $sign): static
    {
        // TODO: Implement where() method.
    }

    public function orderBy(array $orderValues): static
    {
        // TODO: Implement orderBy() method.
    }

    public function as(string $alias): static
    {
        // TODO: Implement as() method.
    }
}