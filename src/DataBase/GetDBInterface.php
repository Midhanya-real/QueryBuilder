<?php

namespace Core\DataBase;

use Core\DataBase\DataBases\PostgresBuilderInterface;

interface GetDBInterface
{
    public function pgsql(): PostgresBuilderInterface;
}