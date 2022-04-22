<?php

namespace Core\Connection;

use PDO;

interface ConnectionInterface
{
    public function connect(array $params);
}