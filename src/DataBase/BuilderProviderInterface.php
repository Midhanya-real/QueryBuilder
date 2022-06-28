<?php

namespace Core\DataBase;

use Core\DataBase\DataBases\PostgresBuilderInterface;

interface BuilderProviderInterface
{
    public function pgsql(): PostgresBuilderInterface;
}