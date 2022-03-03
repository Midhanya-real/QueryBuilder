<?php

namespace Core\Filters\InjectionChecker;

use Core\Components;

class Checker
{
    private static string $allData = '';

    protected static function secondLevelDepthAssembl(int|string|array $value): string
    {
        foreach ($value as $item) {
            if (!is_array($item)) {
                static::$allData .= $item;
            } else {
                static::$allData .= implode(' ', $item);
            }
        }

        return static::$allData;
    }

    protected static function setOnLine(array $query): string
    {
        foreach ($query as $value) {
            static::secondLevelDepthAssembl(value: $value);
        }

        return static::$allData;
    }

    protected static function checkValue(array $components, string $values): bool
    {
        foreach ($components as $component) {
            if (preg_match("/[\W]({$component})/i", $values)) {
                return false;
            }
        }

        return true;
    }

    public static function getInspect(array $components, array $rawQuery): bool
    {
        $lineFormatQuery = static::setOnLine(query: $rawQuery);

        return static::checkValue(components: $components, values: $lineFormatQuery);
    }
}