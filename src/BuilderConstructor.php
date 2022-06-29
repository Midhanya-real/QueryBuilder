<?php

namespace Core;

use Core\Validation\BuildersValidation\PostgresBuilderValidation;
use Core\Validation\FetchValidation\FetchInterface;

class BuilderConstructor extends AbstractBuilderConstructor
{
    public function build(): PostgresBuilderValidation
    {
        return $this->getBuilderValidator();
    }

    public function execute(array $queryObject): FetchInterface
    {
        $connect = $this->getConnect()->connect($this->config);

        return $this->getFetch($connect, $queryObject);
    }
}