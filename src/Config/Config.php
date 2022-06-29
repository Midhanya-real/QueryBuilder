<?php

namespace Core\Config;

class Config
{
    private static array $config = [
        'Connection' => 'pgsql',
        'Host' => 'localhost',
        'Port' => 'some_pass',
        'DataBase' => 'some_base',
        'UserName' => 'some_user',
        'Password' => 'some_user_pass',
    ];

    public static function getConfig(): array
    {
        return static::$config;
    }
}
