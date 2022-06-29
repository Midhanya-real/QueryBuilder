<?php

namespace Core\Validation\BuildersValidation;

use Core\Actions\ConverterActions\BodyConverterAction;
use Core\Actions\ValidateActions\InsertionQueryValidation;
use Core\DataBase\DataBases\PostgresBuilderInterface;

class PostgresBuilderValidation implements PostgresBuilderValidationInterface
{
    private PostgresBuilderInterface $builder;

    public function __construct(PostgresBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function select(string $table, array $fields): string
    {
        empty($fields) ? $rows['body'] = ['*'] : $rows = BodyConverterAction::getSelectBody($fields);

        return $this->builder->select(table: $table, fields: $rows);
    }

    public function insert(string $table, array $fields): array|bool
    {
        if (!InsertionQueryValidation::isValidAssocBody($fields)) {
            return false;
        }

        $queryBody = BodyConverterAction::getInsertBody($fields);

        return [
            'query' => $this->builder->insert(table: $table, fields: $queryBody),
            'params' => array_values($fields)
        ];
    }

    public function delete(string $table): string
    {
        return $this->builder->delete(table: $table);
    }

    public function update(string $table, array $values): array|bool
    {
        if (!InsertionQueryValidation::isValidAssocBody($values)) {
            return false;
        }

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

        $conditions = BodyConverterAction::getSetBody($condition);

        return [
            'query' => $this->builder->where(condition: $conditions),
            'params' => $conditions['params']
        ];
    }

    public function join(string $table, array $keys): string
    {
        $condition = BodyConverterAction::getSetBody($keys, false);

        return $this->builder->join(table: $table, keys: $condition);
    }

    public function outJoin(string $table, array $keys): string
    {
        $condition = BodyConverterAction::getSetBody($keys);

        return $this->builder->outJoin(table: $table, keys: $condition);
    }

    public function limit(int $limit): string
    {
        return $this->builder->limit(limit: $limit);
    }

    public function offset(int $limit): string
    {
        return $this->builder->offset(limit: $limit);
    }

    public function groupBy(array $groupColumns): string
    {
        $groupColumns = BodyConverterAction::getSelectBody($groupColumns);

        return $this->builder->groupBy(groupColumns: $groupColumns);
    }

    public function orderBy(array $orderValues): string
    {
        $orderValues = BodyConverterAction::getOrderBody($orderValues);

        return $this->builder->orderBy(orderValues: $orderValues);
    }

    public function having(string $agrFunc, string $sign, string $value): array
    {
        return [
            'query' => $this->builder->having(agrFunc: $agrFunc, sign: $sign, value: '?'),
            'params' => [$value]
        ];
    }
}