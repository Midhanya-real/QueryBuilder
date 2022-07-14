<?php

namespace Core\Handlers;

use Core\Validation\BuildersValidation\PostgresBuilderValidationInterface;

class PostgresHandler implements PostgresHandlerInterface
{
    private PostgresBuilderValidationInterface $builderValidation;
    private string $query = '';
    private array $params = [];

    public function __construct(PostgresBuilderValidationInterface $builderValidation)
    {
        $this->builderValidation = $builderValidation;
    }

    public function select(string $table, array $fields): static
    {
        $queryObject = $this->builderValidation->select($table, $fields);
        $this->query = $queryObject['query'];

        return $this;
    }

    public function insert(string $table, array $fields): static
    {
        $queryObject = $this->builderValidation->insert($table, $fields);

        if ($queryObject) {
            $this->query = $queryObject['query'];
            $this->params[] = $queryObject['params'];
        }

        return $this;
    }

    public function delete(string $table): static
    {
        $queryObject = $this->builderValidation->delete($table);
        $this->query = $queryObject['query'];

        return $this;
    }

    public function update(string $table, array $values): static
    {
        $queryObject = $this->builderValidation->update($table, $values);

        if ($queryObject) {
            $this->query = $queryObject['query'];
            $this->params[] = $queryObject['params'];
        }

        return $this;

    }

    public function where(array $condition): static
    {
        $queryObject = $this->builderValidation->where($condition);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
            $this->params[] = $queryObject['params'];
        }

        return $this;
    }

    public function join(string $table, array $keys): static
    {
        $queryObject = $this->builderValidation->join($table, $keys);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
        }

        return $this;
    }

    public function outJoin(string $table, array $keys): static
    {
        $queryObject = $this->builderValidation->outJoin($table, $keys);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
        }

        return $this;
    }

    public function limit(int $limit): static
    {
        $queryObject = $this->builderValidation->limit($limit);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
        }

        return $this;
    }

    public function offset(int $limit): static
    {
        $queryObject = $this->builderValidation->offset($limit);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
        }

        return $this;
    }

    public function groupBy(array $groupColumns): static
    {
        $queryObject = $this->builderValidation->groupBy($groupColumns);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
        }

        return $this;
    }

    public function orderBy(array $orderValues): static
    {
        $queryObject = $this->builderValidation->orderBy($orderValues);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
        }

        return $this;
    }

    public function having(string $agrFunc, string $sign, string $value): static
    {
        $queryObject = $this->builderValidation->having($agrFunc, $sign, $value);

        if ($queryObject) {
            $this->query .= $queryObject['query'];
            $this->params[] = $queryObject['params'];
        }

        return $this;
    }

    public function getQueryObject(): array|bool
    {
        if (!$this->query) {
            return false;
        }

        $this->query .= ';';
        return [
            'query' => $this->query,
            'params' => $this->params
        ];
    }
}