<?php

namespace Core\Controllers;

use Core\Filters\Validator\DepthProcessing\Handlers\ConditionHandler;
use Core\Filters\Validator\DepthProcessing\Handlers\MultiLevelHandler;
use Core\Filters\Validator\DepthProcessing\Handlers\SingleLevelHandler;

class ProcessDepthController
{

    public function singleLevel(array $values, bool $mode = true): string
    {
        return SingleLevelHandler::getFormatQuery(value: $values, mode: $mode);
    }

    public function multilevelLevel(array $values, bool $mode = true): string
    {
        return MultiLevelHandler::getFormatQuery(value: $values, mode: $mode);
    }

    public function conditionLevel(array $values, bool $mode = true): string
    {
        return ConditionHandler::getFormatQuery(value: $values, mode: $mode);
    }
}