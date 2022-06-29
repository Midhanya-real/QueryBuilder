<?php

namespace Core;

use Core\Connection\PgsqlConnection;
use Core\DataBase\BuilderProvider;
use Core\DataBase\BuilderProviderInterface;
use Core\DataBase\DataBases\PostgresBuilderInterface;
use Core\Handlers\PostgresHandler;
use Core\Handlers\PostgresHandlerInterface;
use Core\Validation\BuildersValidation\PostgresBuilderValidation;
use Core\Validation\BuildersValidation\PostgresBuilderValidationInterface;
use Core\Validation\FetchValidation\FetchValidator;
use Core\Validation\FetchValidation\FetchInterface;
use PDO;

abstract class AbstractBuilderConstructor
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function getDB(): BuilderProviderInterface
    {
        return new BuilderProvider();
    }

    protected function getFetch(PDO $connect, array $queryObject): FetchInterface
    {
        return new FetchValidator($connect, $queryObject);
    }

    protected function getConnect(): PgsqlConnection
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PgsqlConnection(),

            //
        };
    }

    protected function getBuilder(): PostgresBuilderInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => $this->getDB()->pgsql(),

            //
        };
    }

    protected function getBuilderValidator(): PostgresBuilderValidationInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PostgresBuilderValidation($this->getBuilder()),

            //
        };
    }

    protected function getHandler(): PostgresHandlerInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PostgresHandler($this->getBuilderValidator()),

            //
        };
    }

    abstract public function build(): PostgresHandlerInterface;

    abstract public function execute(array $queryObject): FetchInterface;
}