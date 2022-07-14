<?php

namespace Core\Handlers;

use \Core\DataBase\QueryPartsInterfaces\CRUDMethodsInterface;
use \Core\DataBase\QueryPartsInterfaces\SortMethodsInterface;
use \Core\DataBase\QueryPartsInterfaces\LinksMethodsInterface;

interface PostgresHandlerInterface extends CRUDMethodsInterface, SortMethodsInterface, LinksMethodsInterface
{
    public function select(string $table, array $fields): static;

    public function insert(string $table, array $fields): static;

    public function delete(string $table): static;

    public function update(string $table, array $values): static;

    public function where(array $condition): static;

    public function join(string $table, array $keys): static;

    public function outJoin(string $table, array $keys): static;

    public function limit(int $limit): static;

    public function offset(int $limit): static;

    public function groupBy(array $groupColumns): static;

    public function orderBy(array $orderValues): static;

    public function having(string $agrFunc, string $sign, string $value): static;

    public function getQueryObject(): array|bool;
}