<?php

namespace Core\Filters\Validator\DepthProcessingHandlers;

class ConditionLevelDepthLevelHandler
{
    private const OPERATORS = ['=', '>', '<', '<=', '>=', '<>', '!='];
    private string $columns = '';

    protected static function isFull(string $path): bool
    {
        return strpos($path, '.');
    }

    protected static function fullPathForming(string $fullPath): string
    {
        $linkParts = array_combine(['table', 'column'], explode('.', $fullPath));

        return "{$linkParts['table']}.\"{$linkParts['column']}\"";
    }

    protected function relativePathForming(int|string $relativePath, bool $mode): string
    {
        if (is_integer($relativePath) || in_array($relativePath, static::OPERATORS)) {
            return "{$relativePath}";
        }

        if (!$mode) {
            return "'{$relativePath}'";
        }

        return "\"{$relativePath}\"";

    }

    protected function formingValues(array $values): string
    {
        foreach ($values as $value) {
            if (static::isFull(path: $value)) {
                $this->columns .= static::fullPathForming(fullPath: $value) . ' ';
            } else {
                $this->columns .= static::relativePathForming(relativePath: $value, mode: true) . ' ';
            }
        }

        return $this->columns;
    }

    public function getFormatQuery(array $values): string
    {
        return $this->formingValues(values: $values);
    }
}