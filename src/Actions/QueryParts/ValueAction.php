<?php

namespace Core\Actions\QueryParts;

class ValueAction
{
    public static function toReplace(array $values): array
    {
        return array_fill(0, count($values), '?');
    }
}