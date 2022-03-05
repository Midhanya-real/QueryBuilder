<?php

namespace Core\Filters\Validator\DepthProcessingHandlers;

class MultiLevelDepthLevelHandler
{
    private array $columns;

    protected static function isFull(string $path): bool
    {
        return strpos($path, '.');
    }

    protected static function inLineQuery(array $values): string
    {
        return implode(',', $values);
    }


    protected static function fullPathForming(string $key, string|int $fullPath): string
    {
        $linkParts = array_combine(['table', 'column'], explode('.', $key));

        if (is_integer($fullPath)) {
            return "{$linkParts['table']}.\"{$linkParts['column']}\" = {$fullPath}";
        }

        return "{$linkParts['table']}.\"{$linkParts['column']}\" = '{$fullPath}'";
    }

    protected static function relativePathForming(string $key, int|string $relativePath): string
    {
        if (is_integer($relativePath)) {
            return "\"{$key}\" = {$relativePath}";
        }

        return "\"{$key}\" = '{$relativePath}'";
    }

    protected function formingValues(array $values): array
    {
        foreach ($values as $key => $value) {
            if (static::isFull(path: $key)) {
                $this->columns[] = static::fullPathForming(key: $key, fullPath: $value);
            } else {
                $this->columns[] = static::relativePathForming(key: $key, relativePath: $value);
            }
        }

        return $this->columns;
    }

    public function getFormatQuery(array $values): string
    {
        return static::inLineQuery($this->formingValues(values: $values));
    }
}