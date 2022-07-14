<?php

namespace Core\Validation\BuildersValidation;

use Core\Actions\ConverterActions\BodyConverterAction;
use Core\Actions\ValidateActions\InsertionQueryValidation;
use Core\DataBase\DataBases\PostgresBuilderInterface;

class PostgresBuilderValidation implements PostgresBuilderValidationInterface
{
    private PostgresBuilderInterface $builder;
    private string $type = '';

    public function __construct(PostgresBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function select(string $table, array $fields): array
    {
        $this->type = 'select';

        empty($fields) ? $rows['body'] = ['*'] : $rows = BodyConverterAction::getSelectBody($fields);

        return [
            'query' => $this->builder->select(table: $table, fields: $rows)
        ];
    }

    public function insert(string $table, array $fields): array|bool
    {
        if (!InsertionQueryValidation::isValidAssocBody($fields)) {
            return false;
        }

        $this->type = 'insert';

        $queryBody = BodyConverterAction::getInsertBody($fields);

        return [
            'query' => $this->builder->insert(table: $table, fields: $queryBody),
            'params' => array_values($fields)
        ];
    }

    public function delete(string $table): array
    {
        $this->type = 'delete';

        return [
            'query' => $this->builder->delete(table: $table)
        ];
    }

    public function update(string $table, array $values): array|bool
    {
        if (!InsertionQueryValidation::isValidAssocBody($values)) {
            return false;
        }

        $this->type = 'update';

        $set = BodyConverterAction::getSetBody($values);

        return [
            'query' => $this->builder->update(table: $table, values: $set),
            'params' => $set['params']
        ];
    }

    public function where(array $condition): array|bool
    {
        if (!InsertionQueryValidation::isValidAssocBody($condition)) {
            return false;
        }

        if(!in_array($this->type, ['select', 'insert', 'update', 'delete'])){
            return false;
        }

        $this->type = 'where';

        $conditions = BodyConverterAction::getSetBody($condition);

        return [
            'query' => $this->builder->where(condition: $conditions),
            'params' => $conditions['params']
        ];
    }

    public function join(string $table, array $keys): array|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $condition = BodyConverterAction::getSetBody($keys, false);

        return [
            'query' => $this->builder->join(table: $table, keys: $condition)
        ];
    }

    public function outJoin(string $table, array $keys): array|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $condition = BodyConverterAction::getSetBody($keys);

        return [
            'query' => $this->builder->outJoin(table: $table, keys: $condition)
        ];
    }

    public function limit(int $limit): array|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        return [
            'query' => $this->builder->limit(limit: $limit)
        ];
    }

    public function offset(int $limit): array|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        return [
            'query' => $this->builder->offset(limit: $limit)
        ];
    }

    public function groupBy(array $groupColumns): array|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $groupColumns = BodyConverterAction::getSelectBody($groupColumns);

        return [
            'query' => $this->builder->groupBy(groupColumns: $groupColumns)
        ];
    }

    public function orderBy(array $orderValues): array|bool
    {
        if ($this->type != 'select') {
            return false;
        }

        $orderValues = BodyConverterAction::getOrderBody($orderValues);

        return [
            'query' => $this->builder->orderBy(orderValues: $orderValues)
        ];
    }

    public function having(string $agrFunc, string $sign, string $value): array|bool
    {
        if ($this->type != 'groupBy') {
            return false;
        }

        return [
            'query' => $this->builder->having(agrFunc: $agrFunc, sign: $sign, value: '?'),
            'params' => [$value]
        ];
    }
}