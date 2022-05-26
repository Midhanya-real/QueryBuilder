<?php

namespace Core;

use Core\Connection\ConnectionInterface;
use Core\Connection\PgsqlConnection;
use Core\DataBase\GetLevel;
use Core\DataBase\HighLevelDB\HighLevelBuilderInterface;
use Core\DataBase\HighLevelDB\PostgresBuilder;
use Core\DataBase\LowLevelDB\LowLevelBuilderInterface;
use Core\DataBase\LowLevelDB\MySqlBuilder;
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

    protected function getBuilder(): HighLevelBuilderInterface|LowLevelBuilderInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => (new GetLevel())->getHighDb(PostgresBuilder::class),
            'mysql' => (new GetLevel())->getLowDb(MySqlBuilder::class),

            //...
        };
    }

    protected function getFetch(PDO $connect): FetchInterface
    {
        return new FetchValidator($connect);
    }

    public function build()
    {

    }
}