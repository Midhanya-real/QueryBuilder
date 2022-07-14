<?php

namespace Core\Validation\BuildersValidation;
use Core\DataBase\QueryPartsInterfaces\CRUDMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\LinksMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\SortMethodsInterface;

interface PostgresBuilderValidationInterface extends CRUDMethodsInterface, LinksMethodsInterface, SortMethodsInterface
{
    public function select(string $table, array $fields): array;

    public function insert(string $table, array $fields): array|bool;

    public function delete(string $table): array;

    public function update(string $table, array $values): array|bool;

    public function where(array $condition): array|bool;

    public function join(string $table, array $keys): array|bool;

    public function outJoin(string $table, array $keys): array|bool;

    public function limit(int $limit): array|bool;

    public function offset(int $limit): array|bool;

    public function groupBy(array $groupColumns): array|bool;

    public function orderBy(array $orderValues): array|bool;

    public function having(string $agrFunc, string $sign, string $value): array|bool;
}