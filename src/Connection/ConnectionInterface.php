<?php

namespace Core\Connection;

interface ConnectionInterface
{
    public function connect(array $params);
}