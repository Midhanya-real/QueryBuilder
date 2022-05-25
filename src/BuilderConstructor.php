<?php

namespace Core;

use Core\Connection\ConnectionInterface;
use Core\Connection\PgsqlConnection;
use Core\DataBase\HighLevelDB\BuilderInterface;
use Core\DataBase\HighLevelDB\PostgresBuilder;
use Core\Validation\FetchValidation\FetchInterface;
use Core\Validation\FetchValidation\FetchValidator;
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

    protected function getBuilder(): BuilderInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PostgresBuilder(),
        };
    }

    protected function getFetch(PDO $connect): FetchInterface
    {
        return new FetchValidator($connect);
    }

    public function build()
    {
//        $connect = $this->getConnect()->connect($this->config);
//        return $this->getBuilder();
    }
}