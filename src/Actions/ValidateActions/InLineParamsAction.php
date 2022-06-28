<?php

namespace Core\Actions\ValidateActions;

class InLineParamsAction
{
    public static function inLineParams(array $params): array
    {
        return $params ? array_merge(...$params) : [];
    }
}