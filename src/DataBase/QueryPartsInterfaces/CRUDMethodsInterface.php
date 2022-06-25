<?php

namespace Core\DataBase\QueryPartsInterfaces;

interface CRUDMethodsInterface
{
    public function select(string $table, array $fields): string;

    public function insert(string $table, array $fields): string;

    public function delete(string $table): string;

    public function update(string $table, array $values): string;

    public function where(array $condition): string;
}