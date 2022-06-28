<?php

namespace Core\DataBase;

use Core\DataBase\DataBases\PostgresBuilder;
use Core\DataBase\DataBases\PostgresBuilderInterface;

class BuilderProvider implements BuilderProviderInterface
{
    public function pgsql(): PostgresBuilderInterface
    {
        return new PostgresBuilder();
    }
}