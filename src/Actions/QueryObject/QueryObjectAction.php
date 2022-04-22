<?php

namespace Core\Actions\QueryObject;

class QueryObjectAction
{
    public static function toValid(array $queryObject): array
    {
        $queryObject['query'] .= ';';
        $queryObject['params'] = array_merge(...$queryObject['params']);

        return $queryObject;
    }
}