<?php

namespace Core\Connection;

use PDO;

class PgsqlConnection implements ConnectionInterface
{
    protected static array $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    protected function createConf(array $params): array
    {
        $dsn = "{$params['Connection']}:host={$params['Host']};port={$params['Port']};dbname={$params['DataBase']}";

        return [
            'dsn' => $dsn,
            'username' => $params['UserName'],
            'pass' => $params['Password']
        ];
    }

    public function connect(array $params): PDO
    {
        $params = $this->createConf($params);

        return new PDO(
            dsn: $params['dsn'],
            username: $params['username'],
            password: $params['pass'],
            options: static::$options
        );
    }
}