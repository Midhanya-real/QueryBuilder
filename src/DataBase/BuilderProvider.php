<?php

namespace Core\DataBase;

use Core\DataBase\DataBases\PostgresBuilder;

class BuilderProvider
{
    public function pgsql(): PostgresBuilder
    {
        return new PostgresBuilder();
    }
}