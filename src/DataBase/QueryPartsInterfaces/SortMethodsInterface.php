<?php

namespace Core\DataBase\QueryPartsInterfaces;

interface SortMethodsInterface
{
    public function limit(int $limit);

    public function offset(int $limit);

    public function groupBy(array $groupColumns);

    public function orderBy(array $orderValues);

    public function having(string $agrFunc, string $sign, string $value);
}