<?php

namespace Core\Validation\BuildersValidation;
use Core\DataBase\QueryPartsInterfaces\CRUDMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\LinksMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\SortMethodsInterface;

interface PostgresBuilderValidationInterface extends CRUDMethodsInterface, LinksMethodsInterface, SortMethodsInterface
{
    public function select(string $table, array $fields): string;

    public function insert(string $table, array $fields): array|bool;

    public function delete(string $table): string;

    public function update(string $table, array $values): array|bool;

    public function where(array $condition): array|bool;

    public function join(string $table, array $keys): string;

    public function outJoin(string $table, array $keys): string;

    public function limit(int $limit): string;

    public function offset(int $limit): string;

    public function groupBy(array $groupColumns): string;

    public function orderBy(array $orderValues): string;

    public function having(string $agrFunc, string $sign, string $value): array;
}