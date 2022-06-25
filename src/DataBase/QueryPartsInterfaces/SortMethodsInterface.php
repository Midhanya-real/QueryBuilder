<?php

namespace Core\DataBase\QueryPartsInterfaces;

interface SortMethodsInterface
{
    public function limit(int $limit): string;

    public function offset(int $limit): string;

    public function groupBy(array $groupColumns): string;

    public function orderBy(array $orderValues): string;

    public function having(string $agrFunc, string $sign, string $value): string;
}