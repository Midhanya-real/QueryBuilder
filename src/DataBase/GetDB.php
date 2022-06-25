<?php

namespace Core\DataBase;

use Core\DataBase\DataBases\PostgresBuilder;
use Core\DataBase\DataBases\PostgresBuilderInterface;

class GetDB implements GetDBInterface
{
    public function pgsql(): PostgresBuilderInterface
    {
        return new PostgresBuilder();
    }
}