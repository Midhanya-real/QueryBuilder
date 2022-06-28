<?php

namespace Core\DataBase\DataBases;

use Core\DataBase\QueryPartsInterfaces\CRUDMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\LinksMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\SortMethodsInterface;

interface PostgresBuilderInterface extends CRUDMethodsInterface, SortMethodsInterface, LinksMethodsInterface
{
    public function select(string $table, array $fields): string;

    public function insert(string $table, array $fields): string;

    public function delete(string $table): string;

    public function update(string $table, array $values): string;

    public function where(array $condition): string;

    public function join(string $table, array $keys): string;

    public function outJoin(string $table, array $keys): string;

    public function limit(int $limit): string;

    public function offset(int $limit): string;

    public function groupBy(array $groupColumns): string;

    public function orderBy(array $orderValues): string;

    public function having(string $agrFunc, string $sign, string $value): string;
}