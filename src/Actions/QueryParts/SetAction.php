<?php

namespace Core\Actions\QueryParts;

class SetAction
{
    public static function toStr(array $assocArr): string
    {
        $fields = [];
        foreach ($assocArr as $key => $value) {
            $fields[] = "{$key} = :{$value}";
        }

        return implode(', ', $fields);
    }

    public static function genId(array $assocArr): array
    {
        $keys = array_keys($assocArr);
        $values = array_values($assocArr);

        foreach ($keys as $key) {
            $keys = [$key => uniqid()];
        }

        $values = array_combine(array_values($keys), $values);
        return ['keys' => $keys, 'values' => $values];
    }
}