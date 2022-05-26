<?php

namespace Core\DataBase\HighLevelDB;

use Core\Actions\QueryParts\SetAction;
use Core\Actions\QueryParts\ValueAction;

class PostgresBuilder implements HighLevelBuilderInterface
{
    private array $queryObject = [
        'query' => '',
        'params' => [],
    ];

    public function select(array $rows = ['*']): static
    {
        $this->queryObject['query'] = 'SELECT ' . implode(', ', $rows);

        return $this;
    }


    public function insert(string $table, array $fields): static
    {
        $this->queryObject['query'] = 'INSERT INTO ' . $table . '(' . implode(', ', $fields) . ')';

        return $this;
    }

    public function delete(): static
    {
        $this->queryObject['query'] = 'DELETE ';

        return $this;
    }

    public function update(string $table): static
    {
        $this->queryObject['query'] = 'UPDATE ' . $table;

        return $this;
    }

    public function from(string $table): static
    {
        $this->queryObject['query'] .= ' FROM ' . $table;

        return $this;
    }

    public function set(array $newValues): static
    {
        $this->queryObject['query'] .= ' SET' . SetAction::toStr(array_keys($newValues));
        $this->queryObject['params'][] = array_values($newValues);

        return $this;
    }

    public function on(string $internal, string $external): static
    {
        $this->queryObject['query'] .= " ON {$internal} = {$external}";

        return $this;
    }

    public function values(array $values): static
    {
        $this->queryObject['query'] .= ' VALUES' . '(' . implode(', ', ValueAction::toReplace($values)) . ')';
        $this->queryObject['params'][] = $values;
        return $this;
    }

    public function or(string $row, string $sign, string $value): static
    {
        $this->queryObject['query'] .= " OR {$row} {$sign} ?";
        $this->queryObject['params'][] = $value;

        return $this;
    }

    public function and(string $row, string $sign, string $value): static
    {
        $this->queryObject['query'] .= "AND {$row} {$sign} ?";
        $this->queryObject['params'][] = $value;

        return $this;
    }

    public function not(string $row): static
    {
        $this->queryObject['query'] = " NOT ?";
        $this->queryObject['params'][] = $row;

        return $this;
    }

    public function join(string $addTable): static
    {
        $this->queryObject['query'] .= ' JOIN ' . $addTable;

        return $this;
    }

    public function outJoin(string $addTable): static
    {
        $this->queryObject['query'] .= ' OUTER JOIN ' . $addTable;

        return $this;
    }

    public function union(): static
    {
        $this->queryObject['query'] .= ' UNION ';

        return $this;
    }

    public function limit(int $limit): static
    {
        $this->queryObject['query'] .= " LIMIT {$limit}";

        return $this;
    }

    public function offset(int $limit): static
    {
        $this->queryObject['query'] .= " OFFSET {$limit}";

        return $this;
    }

    public function groupBy(array $groupColumns): static
    {
        $this->queryObject['query'] .= ' GROUP BY ' . implode(', ', $groupColumns);

        return $this;
    }

    public function having(string $agrFunc, string $sign, string $value): static
    {
        $this->queryObject['query'] .= " HAVING {$agrFunc} {$sign} ?";
        $this->queryObject['params'][] = $value;

        return $this;
    }

    public function where(string $row, string $value, string $sign = ' = '): static
    {
        $this->queryObject['query'] .= " WHERE {$row} {$sign} ? ";
        $this->queryObject['params'][] = $value;

        return $this;
    }

    public function orderBy(array $orderValues): static
    {
        $this->queryObject['query'] .= " ORDER BY " . implode(',', $orderValues);

        return $this;
    }

    public function as(string $alias): static
    {
        $this->queryObject['query'] .= " AS ? ";
        $this->queryObject['params'][] = $alias;

        return $this;
    }
}