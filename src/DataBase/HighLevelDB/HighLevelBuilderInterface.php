<?php

namespace Core\DataBase\HighLevelDB;

interface HighLevelBuilderInterface
{
    public function select(array $rows): static;

    public function insert(string $table, array $fields): static;

    public function delete(): static;

    public function update(string $table): static;

    public function from(string $table): static;

    public function set(array $newValues): static;

    public function on(string $internal, string $external): static;

    public function values(array $values): static;

    public function or(string $row, string $sign, string $value): static;

    public function and(string $row, string $sign, string $value): static;

    public function not(string $row): static;

    public function join(string $addTable): static;

    public function outJoin(string $addTable): static;

    public function union(): static;

    public function limit(int $limit): static;

    public function offset(int $limit): static;

    public function groupBy(array $groupColumns): static;

    public function having(string $agrFunc, string $sign, string $value): static;

    public function where(string $row, string $value, string $sign): static;

    public function orderBy(array $orderValues): static;

    public function as(string $alias): static;
}