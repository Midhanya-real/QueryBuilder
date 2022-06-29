<?php

namespace Core\Handlers;

use Core\Validation\BuildersValidation\PostgresBuilderValidationInterface;

class PostgresHandler implements PostgresHandlerInterface
{
    private PostgresBuilderValidationInterface $builderValidation;
    private string $query = '';
    private array $params = [];
    private string $type;

    public function __construct(PostgresBuilderValidationInterface $builderValidation)
    {
        $this->builderValidation = $builderValidation;
    }

    public function select(string $table, array $fields): static
    {
        $this->type = 'select';

        $this->query = $this->builderValidation->select($table, $fields);

        return $this;
    }

    public function insert(string $table, array $fields): static|bool
    {
        $this->type = 'insert';
        $queryObject = $this->builderValidation->insert($table, $fields);

        $this->query = $queryObject['query'];
        $this->params[] = $queryObject['params'];

        return $this;
    }

    public function delete(string $table): static
    {
        $this->type = 'delete';

        $this->query = $this->builderValidation->delete($table);

        return $this;
    }

    public function update(string $table, array $values): static|bool
    {
        $this->type = 'update';
        $queryObject = $this->builderValidation->update($table, $values);

        $this->query = $queryObject['query'];
        $this->params[] = $queryObject['params'];

        return $this;

    }

    public function where(array $condition): static|bool
    {
        $this->type = 'where';
        $queryObject = $this->builderValidation->where($condition);

        $this->query .= $queryObject['query'];
        $this->params[] = $queryObject['params'];

        return $this;
    }

    public function join(string $table, array $keys): static|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->query .= $this->builderValidation->join($table, $keys);

        return $this;
    }

    public function outJoin(string $table, array $keys): static|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->query .= $this->builderValidation->outJoin($table, $keys);

        return $this;
    }

    public function limit(int $limit): static|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->query .= $this->builderValidation->limit($limit);

        return $this;
    }

    public function offset(int $limit): static|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->query .= $this->builderValidation->offset($limit);

        return $this;
    }

    public function groupBy(array $groupColumns): static|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->type = 'groupBy';

        $this->query .= $this->builderValidation->groupBy($groupColumns);

        return $this;
    }

    public function orderBy(array $orderValues): static|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->query .=  $this->builderValidation->orderBy($orderValues);

        return $this;
    }

    public function having(string $agrFunc, string $sign, string $value): static|bool
    {
        if ($this->type != 'groupBy') {
            return false;
        }

        $queryObject = $this->builderValidation->having($agrFunc, $sign, $value);

        $this->query .= $queryObject['query'];
        $this->params[] = $queryObject['params'];

        return $this;
    }

    public function getQueryObject(): array
    {
        $this->query .= ';';
        return [
            'query' => $this->query,
            'params' => $this->params
        ];
    }
}