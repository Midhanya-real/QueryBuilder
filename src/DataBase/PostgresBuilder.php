<?php

namespace Core\DataBase;

use Core\Actions\QueryObject\QueryObjectAction;
use Core\Actions\QueryParts\SetAction;
use Core\Actions\QueryParts\ValueAction;
use PDO;

class PostgresBuilder implements BuilderInterface
{
    private PDO $connect;
    private array $queryObject = [
        'query' => '',
        'params' => [],
    ];

    public function __construct(PDO $connect)
    {
        $this->connect = $connect;
    }

    public function select(array $rows = ['*']): static
    {
        $this->queryObject['query'] .= ' SELECT ' . implode(', ', $rows);

        return $this;
    }


    public function insert(string $table, null|array $fields = null): static
    {
        $this->queryObject['query'] .= ' INSERT INTO ' . $table;

        if (!is_null($fields)) {
            $this->queryObject['query'] .= '(' . implode(', ', $fields) . ')';
        }

        return $this;
    }

    public function delete(): static
    {
        $this->queryObject['query'] .= ' DELETE ';

        return $this;
    }

    public function update(string $table): static
    {
        $this->queryObject['query'] .= ' UPDATE ' . $table;

        return $this;
    }

    public function from(string $table): static
    {
        $this->queryObject['query'] .= ' FROM ' . $table;

        return $this;
    }

    public function set(array $newValues): static
    {
        $newValues = SetAction::genId($newValues);
        $this->queryObject['query'] .= ' SET ' . SetAction::toStr($newValues['keys']);
        $this->queryObject['params'][] = $newValues['values'];

        return $this;
    }

    public function on(string $internal, string $external): static
    {
        $this->queryObject['query'] .= " ON {$internal} = {$external}";

        return $this;
    }

    public function values(array $values): static
    {
        $values = ValueAction::genId($values);
        $this->queryObject['query'] .= ' VALUES ' . '(' . implode(', ', ValueAction::toStr(array_keys($values))) . ')';
        $this->queryObject['params'][] = $values;

        return $this;
    }

    public function or(string $row, string $sign, string $value): static
    {
        $id = uniqId();
        $this->queryObject['query'] .= " OR {$row} {$sign} :{$id}";
        $this->queryObject['params'][] = [$id => $value];

        return $this;
    }

    public function and(string $row, string $sign, string $value): static
    {
        $id = uniqId();
        $this->queryObject['query'] .= " AND {$row} {$sign} :{$id}";
        $this->queryObject['params'][] = [$id => $value];

        return $this;
    }

    public function not(string $row): static
    {
        $id = uniqid();
        $this->queryObject['query'] .= " NOT :{$id} ";
        $this->queryObject['params'][] = [$id => $row];

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
        $id = uniqId();
        $this->queryObject['query'] .= " HAVING {$agrFunc} {$sign} :{$id}";
        $this->queryObject['params'][] = [$id => $value];

        return $this;
    }

    public function where(string $row, string $value, string $sign = ' = '): static
    {
        $id = uniqId();
        $this->queryObject['query'] .= " WHERE {$row} {$sign} :{$id} ";
        $this->queryObject['params'][] = [$id => $value];

        return $this;
    }

    public function orderBy(string $orderValue): static
    {
        $this->queryObject['query'] .= " ORDER BY {$orderValue}";

        return $this;
    }

    public function as(string $alias): static
    {
        $this->queryObject['query'] .= " AS {$alias} ";

        return $this;
    }

    public function save(): bool
    {
        $this->queryObject = QueryObjectAction::toValid($this->queryObject);

        $query = $this->connect->prepare($this->queryObject['query']);
        $query->execute($this->queryObject['params']);

        return true;
    }

    public function get(): array
    {
        $this->queryObject = QueryObjectAction::toValid($this->queryObject);

        $query = $this->connect->prepare($this->queryObject['query']);
        $query->execute($this->queryObject['params']);

        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public function first(): object
    {
        $this->queryObject = QueryObjectAction::toValid($this->queryObject);

        $query = $this->connect->prepare($this->queryObject['query']);
        $query->execute($this->queryObject['params']);

        return $query->fetchObject();
    }
}