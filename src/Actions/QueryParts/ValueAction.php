<?php

namespace Core\Actions\QueryParts;

class ValueAction
{
    public static function genId(array $values): array
    {
        $ids = [];
        foreach ($values as $value) {
            $key = uniqid();
            $ids[$key] = $value;
        }

        return $ids;
    }

    public static function toStr(array $values): array
    {
        $newValues = [];
        foreach ($values as $value) {
            $newValues[] = ":{$value}";
        }

        return $newValues;
    }
}