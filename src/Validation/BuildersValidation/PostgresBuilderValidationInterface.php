<?php

namespace Core\Validation\BuildersValidation;
use Core\DataBase\QueryPartsInterfaces\CRUDMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\LinksMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\SortMethodsInterface;

interface PostgresBuilderValidationInterface extends CRUDMethodsInterface, LinksMethodsInterface, SortMethodsInterface
{
    public function select(string $table, array $fields): static;

    public function insert(string $table, array $fields): static|bool;

    public function delete(string $table): static;

    public function update(string $table, array $values): static|bool;

    public function where(array $condition): static|bool;

    public function join(string $table, array $keys): static|bool;

    public function outJoin(string $table, array $keys): static|bool;

    public function limit(int $limit): static|bool;

    public function offset(int $limit): static|bool;

    public function groupBy(array $groupColumns): static|bool;

    public function orderBy(array $orderValues): static|bool;

    public function having(string $agrFunc, string $sign, string $value): static|bool;
}