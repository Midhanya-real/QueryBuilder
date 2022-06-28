<?php

namespace Core;

use Core\Connection\PgsqlConnection;
use Core\DataBase\DataBases\PostgresBuilderInterface;
use Core\DataBase\BuilderProvider;
use Core\DataBase\BuilderProviderInterface;
use Core\Validation\BuildersValidation\PostgresBuilderValidation;
use Core\Validation\BuildersValidation\PostgresBuilderValidationInterface;
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

    protected function getConnect(): PgsqlConnection
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PgsqlConnection(),

            //
        };
    }

    protected function getDB(): BuilderProviderInterface
    {
        return new BuilderProvider();
    }

    protected function getFetch(PDO $connect, array $queryObject): FetchInterface
    {
        return new FetchValidator($connect, $queryObject);
    }

    protected function getBuilder(): PostgresBuilderInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => $this->getDB()->pgsql(),

            //
        };
    }

    protected function getValidator(): PostgresBuilderValidationInterface
    {
        return match ($this->config['Connection']) {
            'pgsql' => new PostgresBuilderValidation($this->getBuilder()),

            //
        };
    }

    public function build(): PostgresBuilderValidation
    {
        return $this->getValidator();
    }

    public function execute(array $queryObject): FetchInterface
    {
        $connect = $this->getConnect()->connect($this->config);

        return $this->getFetch($connect, $queryObject);
    }
}