<?php

namespace Core\Filters\Validator\DepthProcessing\Handlers;

class SingleLevelHandler extends AbstractHandler
{
    protected static function fullPathForming(?string $key, string $fullPath): string
    {
        $linkParts = explode('.', $fullPath);

        return "{$linkParts[0]}.\"{$linkParts[1]}\"";
    }

    protected static function relativePathForming(?string $key, int|string $relativePath, bool $mode): string
    {
        if (is_integer($relativePath) || $relativePath == '*') {
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
        return implode(',', $values);
    }

    protected static function formingValues(array $rawValue, bool $mode): array
    {
        $columns = [];
        foreach ($rawValue as $value) {
            if (static::isFull(path: $value)) {
                $columns[] = static::fullPathForming(key: null, fullPath: $value);
            } else {
                $columns[] = static::relativePathForming(key:null, relativePath: $value, mode: $mode);
            }
        }

        return $columns;
    }

}