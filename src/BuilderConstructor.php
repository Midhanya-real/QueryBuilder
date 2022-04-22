<?php

namespace Core;

use Core\Connection\ConnectionInterface;
use Core\Connection\PgsqlConnection;
use Core\DataBase\PostgresBuilder;
use Core\DataBase\BuilderInterface;
use PDO;

class BuilderConstructor
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function getConnect(): ConnectionInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PgsqlConnection(),
        };
    }

    protected function getBuilder(PDO $connect): BuilderInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PostgresBuilder($connect),
        };
    }

    public function build(): BuilderInterface
    {
        $connect = $this->getConnect()->connect($this->config);
        return $this->getBuilder($connect);
    }
}