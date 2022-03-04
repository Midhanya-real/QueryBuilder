<?php

namespace Core;

use Core\Connections\DataBase;
use Core\Controllers\BuilderController;

class Executor
{
    private DataBase $dataBase;
    private BuilderController $builderController;
    private array $query = [];

    public function __construct(array $config)
    {
        $this->dataBase = new DataBase($config);
        $this->builderController = new BuilderController();
    }

    public function __call(string $name, array $arguments)
    {
        $this->collector(name: $name, arguments: $arguments);
        return $this;
    }

    protected function collector(string $name, array $arguments): array
    {
        foreach ($arguments as $argument) {
            if (is_array($argument) && count($arguments) == 1) {
                $this->query[$name] = $argument;
            } else {
                $this->query[$name] = $arguments;
            }
        }

        return $this->query;
    }

    protected function isValid(): bool|string
    {
        return $this->builderController->filter()->getFormedQuery(query: $this->query);
    }

    public function save(): bool|\PDOStatement
    {
        return $this->dataBase->connect()->query($this->isValid());
    }
}
