<?php

namespace Core\Filters\Validator\DepthProcessing\Handlers;

class MultiLevelHandler extends AbstractHandler
{
    protected static function fullPathForming(?string $key, string $fullPath): string
    {
        $linkParts = explode('.', $key);

        return "{$linkParts[0]}.\"{$linkParts[1]}\" = {$fullPath}";
    }

    protected static function relativePathForming(?string $key, int|string $relativePath, bool $mode): string
    {
        if (is_integer($relativePath) || $relativePath == '*') {
            return "{$key} = {$relativePath}";
        } else {
            if ($mode) {
                $relativePath = "{$key} = \"{$relativePath}\'";;
            } else {
                $relativePath = "{$key} = '{$relativePath}'";
            }
        }

        return $relativePath;
    }

    protected static function inLineQuery(array $values): string
    {
        return implode(',', $values);
    }

    protected static function formingValues(array $rawValue, bool $mode): array
    {
        $columns = [];
        foreach ($rawValue as $key => $value) {
            if (static::isFull(path: $key)) {
                $columns[] = static::fullPathForming(key: $key, fullPath: $value);
            } else {
                $columns[] = static::relativePathForming(key: $key, relativePath: $value, mode: $mode);
            }
        }

        return $columns;
    }
}