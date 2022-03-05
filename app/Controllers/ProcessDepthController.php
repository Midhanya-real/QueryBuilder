<?php

namespace Core\Controllers;

use Core\Filters\Validator\DepthProcessingHandlers\ConditionLevelDepthLevelHandler;
use Core\Filters\Validator\DepthProcessingHandlers\MultiLevelDepthLevelHandler;
use Core\Filters\Validator\DepthProcessingHandlers\SingleLevelDepthLevelHandler;

class ProcessDepthController
{
    public function singleLevel(array $values, $mode): string
    {
        return (new SingleLevelDepthLevelHandler())->getFormatQuery($values, $mode);
    }

    public function multiLevel(array $values): string
    {
        return (new MultiLevelDepthLevelHandler())->getFormatQuery($values);
    }

    public function conditionLevel(array $values): string
    {
        return (new ConditionLevelDepthLevelHandler())->getFormatQuery($values);
    }
}