<?php

namespace Core\Actions\ValidateActions;

class InLineParamsAction
{
    public static function inLine(array $params): array
    {
        return $params ? array_merge(...$params) : [];
    }
}