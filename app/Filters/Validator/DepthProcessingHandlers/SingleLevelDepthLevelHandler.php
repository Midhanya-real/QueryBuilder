<?php

namespace Core\Filters\Validator\DepthProcessingHandlers;

class SingleLevelDepthLevelHandler
{
    private array $columns;
    protected static function isFull(string $path): bool
    {
        return strpos($path, '.');
    }

    protected static function fullPathForming(string $fullPath): string
    {
        $linkParts = array_combine(['table', 'column'], explode('.', $fullPath));

        return "{$linkParts['table']}.\"{$linkParts['column']}\"";
    }

    protected static function relativePathForming(int|string $relativePath, bool $mode): string
    {
        if (is_integer($relativePath) || $relativePath == '*') {
            return "{$relativePath}";
        }

        if (!$mode) {
            return "'{$relativePath}'";
        }

        return "\"{$relativePath}\"";
    }

    protected static function inLineQuery(array $values): string
    {
        return implode(', ', $values);
    }

    protected function formingValues(array $values, $mode): array
    {
        foreach ($values as $value) {
            if (static::isFull(path: $value)) {
                $this->columns[] = static::fullPathForming(fullPath: $value);
            } else {
                $this->columns[] = static::relativePathForming(relativePath: $value, mode: $mode);
            }
        }

        return $this->columns;
    }

    public function getFormatQuery(array $values, $mode): string
    {
        return static::inLineQuery($this->formingValues(values: $values, mode: $mode));
    }
}