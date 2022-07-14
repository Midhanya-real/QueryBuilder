<?php

namespace Core\Config;

class Config
{
    private static array $config = [
        'Connection' => 'pgsql',
        'Host' => 'localhost',
        'Port' => '5432',
        'DataBase' => 'QueryTester',
        'UserName' => 'postgres',
        'Password' => '1234',
    ];

    public static function getConfig(): array
    {
        return static::$config;
    }
}
