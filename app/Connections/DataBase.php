<?php

namespace Core\Connections;

use PDO;

class DataBase
{
    private static array $config;
    private static array $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    public function __construct(array $config)
    {
        self::$config = $config;
    }

    protected static function dnsConstr(): string
    {
        return static::$config['db'] .
            ":host=" . self::$config['host'] .
            ";port=" . self::$config['port'] .
            ";dbname=" . self::$config['dbname'];
    }

    public function connect(): PDO
    {
        return new PDO(
            dsn: static::dnsConstr(),
            username: static::$config['username'],
            password:static::$config['pass'],
            options: static::$options
        );
    }
}