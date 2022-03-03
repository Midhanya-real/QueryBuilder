<?php

namespace Core\Filters\Validator\DepthProcessing\Handlers;

abstract class AbstractHandler
{
    abstract protected static function fullPathForming(?string $key, string $fullPath): string;

    abstract protected static function relativePathForming(?string $key, int|string $relativePath, bool $mode): string;

    abstract protected static function formingValues(array $rawValue, bool $mode): array;

    abstract protected static function inLineQuery(array $values): string;

    protected static function isFull(string $path): bool
    {
        return strpos($path, '.');
    }

    protected static function formingQuery(array $rawValue, bool $mode): string
    {
        $rawValue = static::formingValues(rawValue: $rawValue, mode: $mode);

        return static::inLineQuery(values: $rawValue);
    }

    public static function getFormatQuery(array $value, bool $mode): string
    {
        return static::formingQuery(rawValue: $value, mode: $mode);
    }

}