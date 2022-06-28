<?php

namespace Core\DataBase\QueryPartsInterfaces;

interface CRUDMethodsInterface
{
    public function select(string $table, array $fields);

    public function insert(string $table, array $fields);

    public function delete(string $table);

    public function update(string $table, array $values);

    public function where(array $condition);
}