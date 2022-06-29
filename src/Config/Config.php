<?php

namespace Core\Config;

class Config
{
    private static array $config = [
        'Connection' => 'pgsql',
        'Host' => 'localhost',
        'Port' => '1234',
        'DataBase' => 'some_base',
        'UserName' => 'some_user_name',
        'Password' => 'some_pass',
    ];

    public static function getConfig(): array
    {
        return static::$config;
    }
}
