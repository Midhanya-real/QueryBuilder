<?php

namespace Core;

use Core\Handlers\PostgresHandlerInterface;
use Core\Validation\FetchValidation\FetchInterface;

class BuilderConstructor extends AbstractBuilderConstructor
{
    public function build(): PostgresHandlerInterface
    {
        return $this->getHandler();
    }

    public function execute(array $queryObject): FetchInterface
    {
        $connect = $this->getConnect()->connect($this->config);

        return $this->getFetch($connect, $queryObject);
    }
}