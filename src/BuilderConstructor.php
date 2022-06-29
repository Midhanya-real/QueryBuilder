<?php

namespace Core;

use Core\Validation\BuildersValidation\PostgresBuilderValidation;
use Core\Validation\BuildersValidation\PostgresBuilderValidationInterface;
use Core\Validation\FetchValidation\FetchInterface;

class BuilderConstructor extends AbstractBuilderConstructor
{
    public function build(): PostgresBuilderValidationInterface
    {
        return $this->getBuilderValidator();
    }

    public function execute(array $queryObject): FetchInterface
    {
        $connect = $this->getConnect()->connect($this->config);

        return $this->getFetch($connect, $queryObject);
    }
}