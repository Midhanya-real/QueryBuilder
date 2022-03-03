<?php

namespace Core;

class Components // расширить
{
    private const CRUD =          ['select', 'insert', 'delete', 'update'];
    private const LINKS =         ['from', 'set', 'on'];
    private const CONDITIONS =    ['where', 'order by', 'distinct'];
    private const BOOLOPERATORS = ['or', 'and', 'not'];
    private const CONNECTORS =    ['inner join', 'outer join', 'union'];
    private const LIMITERS =      ['limit', 'offset'];
    private const GROUPINGS =     ['group by', 'having'];
    private const VALUES =        ['values'];

    public static function getAll(): array
    {
        return array_merge(self::CONDITIONS,
            self::BOOLOPERATORS,
            self::LINKS,
            self::CRUD,
            self::CONNECTORS,
            self::GROUPINGS,
            self::LIMITERS,
            self::VALUES
        );
    }
}