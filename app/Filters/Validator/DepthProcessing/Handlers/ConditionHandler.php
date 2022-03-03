<?php

namespace Core\Filters\Validator\DepthProcessing\Handlers;

class ConditionHandler extends SingleLevelHandler
{
    private const OPERATORS = ['=', '>', '<', '<=', '>=', '<>', '!='];

    protected static function relativePathForming(?string $key, int|string $relativePath, bool $mode): string
    {
        if (is_integer($relativePath) || in_array($relativePath, self::OPERATORS)) {
            return "{$relativePath}";
        } else {
            if ($mode) {
                $relativePath = "\"{$relativePath}\"";
            } else {
                $relativePath = "'{$relativePath}'";
            }
        }

        return $relativePath;
    }

    protected static function inLineQuery(array $values): string
    {
        return implode(' ', $values);
    }

    protected static function formingValues(array $rawValue, bool $mode): array
    {
        $columns = [];
        foreach ($rawValue as $key => $value) {
            if ($key == 2) {
                $mode = false;
            }

            if (static::isFull(path: $value)) {
                $columns[] = static::fullPathForming(key: null, fullPath: $value);
            } else {
                $columns[] = static::relativePathForming(key: null, relativePath: $value, mode: $mode);
            }
        }

        return $columns;
    }
}