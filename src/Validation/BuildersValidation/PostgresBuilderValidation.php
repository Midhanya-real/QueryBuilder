<?php

namespace Core\Validation\BuildersValidation;

use Core\Actions\ConverterActions\BodyConverterAction;
use Core\Actions\ValidateActions\InsertionQueryValidation;
use Core\DataBase\DataBases\PostgresBuilderInterface;

class PostgresBuilderValidation implements PostgresBuilderValidationInterface
{
    private string $query = '';
    private string $type;
    private array $params = [];

    private PostgresBuilderInterface $builder;

    public function __construct(PostgresBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function select(string $table, array $fields): static
    {
        $this->type = 'select';
        empty($fields) ? $rows['body'] = ['*'] : $rows = BodyConverterAction::getSelectBody($fields);

        $this->query = $this->builder->select(table: $table, fields: $rows);

        return $this;
    }

    public function insert(string $table, array $fields): static|bool
    {
        if (!InsertionQueryValidation::isValidAssocBody($fields)) {
            return false;
        }

        $this->type = 'insert';

        $queryBody = BodyConverterAction::getInsertBody($fields);

        $this->query = $this->builder->insert(table: $table, fields: $queryBody);
        $this->params[] = array_values($fields);

        return $this;
    }

    public function delete(string $table): static
    {
        $this->type = 'delete';
        $this->query = $this->builder->delete(table: $table);

        return $this;
    }

    public function update(string $table, array $values): bool|static
    {
        if (!InsertionQueryValidation::isValidAssocBody($values)) {
            return false;
        }

        $set = BodyConverterAction::getSetBody($values);

        $this->type = 'update';
        $this->query = $this->builder->update(table: $table, values: $set);
        $this->params[] = $set['params'];

        return $this;
    }

    public function where(array $condition): bool|static
    {
        if (!InsertionQueryValidation::isValidAssocBody($condition)) {
            return false;
        }

        if (!in_array($this->type, ['select', 'insert', 'update', 'delete'])) {
            return false;
        }

        $this->type = 'where';

        $conditions = BodyConverterAction::getSetBody($condition);
        $this->query .= $this->builder->where(condition: $conditions);
        $this->params[] = $conditions['params'];

        return $this;
    }

    public function join(string $table, array $keys): bool|static
    {
        if ($this->type != 'select') {
            return false;
        }

        $condition = BodyConverterAction::getSetBody($keys, false);
        $this->query .= $this->builder->join(table: $table, keys: $condition);

        return $this;
    }

    public function outJoin(string $table, array $keys): bool|static
    {
        if ($this->type != 'select') {
            return false;
        }

        $condition = BodyConverterAction::getSetBody($keys);
        $this->query .= $this->builder->outJoin(table: $table, keys: $condition);

        return $this;
    }

    public function limit(int $limit): bool|static
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->query .= $this->builder->limit(limit: $limit);

        return $this;
    }

    public function offset(int $limit): bool|static
    {
        if ($this->type != 'select') {
            return false;
        }

        $this->query .= $this->builder->offset(limit: $limit);

        return $this;
    }

    public function groupBy(array $groupColumns): bool|static
    {
        if ($this->type != 'select') {
            return false;
        }

        $groupColumns = BodyConverterAction::getSelectBody($groupColumns);

        $this->type = 'groupBy';
        $this->query .= $this->builder->groupBy(groupColumns: $groupColumns);

        return $this;
    }

    public function orderBy(array $orderValues): bool|static
    {
        if ($this->type != 'select') {
            return false;
        }

        $orderValues = BodyConverterAction::getOrderBody($orderValues);
        $this->query .= $this->builder->orderBy(orderValues: $orderValues);

        return $this;
    }

    public function having(string $agrFunc, string $sign, string $value): bool|static
    {
        if ($this->type != 'groupBy') {
            return false;
        }

        $this->query .= $this->builder->having(agrFunc: $agrFunc, sign: $sign, value: '?');
        $this->params[] = [$value];

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