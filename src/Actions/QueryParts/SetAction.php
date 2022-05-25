<?php

namespace Core\Actions\QueryParts;

class SetAction
{
    public static function toStr(array $assocArr): string
    {
        $fields = [];
        foreach ($assocArr as $key) {
            $fields[] = "{$key} = ?";
        }

        return implode(', ', $fields);
    }
}