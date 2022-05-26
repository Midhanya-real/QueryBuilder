<?php

namespace Core\DataBase;

use Core\DataBase\HighLevelDB\HighLevelBuilderInterface;
use Core\DataBase\LowLevelDB\LowLevelBuilderInterface;

class GetLevel
{
    public function getHighDb(string $builder): HighLevelBuilderInterface
    {
        return new $builder;
    }

    public function getLowDb(string $builder): LowLevelBuilderInterface
    {
        return new $builder;
    }
}