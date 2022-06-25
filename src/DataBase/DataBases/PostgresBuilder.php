<?php

namespace Core\DataBase\DataBases;

class PostgresBuilder implements PostgresBuilderInterface
{
    public function select(string $table, array $fields): string
    {
        $query = 'SELECT ' . implode(', ', $fields['body']);
        $query .= ' FROM ' . $table;

        return $query;
    }

    public function insert(string $table, array $fields): string
    {
        $query = 'INSERT INTO ' . $table . '(' . implode(', ', array_keys($fields['body'])) . ')';
        $query .= ' VALUES ' . '(' . implode(', ', array_values($fields['body'])) . ')';

        return $query;
    }

    public function delete(string $table): string
    {
        return 'DELETE FROM ' . $table;
    }

    public function update(string $table, array $values): string
    {
        $query = 'UPDATE ' . $table;
        $query .= ' SET ' . implode(', ', $values['body']);

        return $query;
    }

    public function where(array $condition): string
    {
        $query = ' WHERE ';
        $query .= implode(' AND ', $condition['body']);

        return $query;
    }

    public function join(string $table, array $keys): string
    {
        $query = ' JOIN ' . $table;
        $query .= ' ON ' . implode(', ', $keys['body']);

        return $query;
    }

    public function outJoin(string $table, array $keys): string
    {
        $query = ' FULL OUTER JOIN ' . $table;
        $query .= ' ON ' . implode(', ', $keys['body']);

        return $query;
    }

    public function limit(int $limit): string
    {
        return ' LIMIT ' . $limit;
    }

    public function offset(int $limit): string
    {
        return ' OFFSET ' . $limit;
    }

    public function groupBy(array $groupColumns): string
    {
        $query = ' GROUP BY ';
        $query .= implode(', ', $groupColumns['body']);

        return $query;
    }

    public function orderBy(array $orderValues): string
    {
        $query = ' ORDER BY ';
        $query .= implode(', ', $orderValues['body']);

        return $query;
    }

    public function having(string $agrFunc, string $sign, string $value): string
    {
        return " HAVING {$agrFunc} {$sign} {$value}";
    }
}