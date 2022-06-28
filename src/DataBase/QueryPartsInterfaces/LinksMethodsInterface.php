<?php

namespace Core\DataBase\QueryPartsInterfaces;

interface LinksMethodsInterface
{
    public function join(string $table, array $keys);

    public function outJoin(string $table, array $keys);
}