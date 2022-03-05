<?php

namespace Core\Filters\Validator;

use Core\Controllers\ProcessDepthController;

class Commands
{
    private ProcessDepthController $depthController;

    public function __construct(ProcessDepthController $depthController)
    {
        $this->depthController = $depthController;
    }

    public function build(string $method, array $values)
    {
        return $this->$method($values);
    }

    protected function singleLevelAction(string $method, array $values, bool $mode = true): string
    {
        $formatValues = $this->depthController->singleLevel(values: $values, mode: $mode);

        return "{$method} {$formatValues}";
    }

    protected function multiLevelAction(string $method, array $values): string
    {
        $formatValues = $this->depthController->multiLevel(values: $values);

        return "{$method} {$formatValues}";
    }

    protected function conditionAction(string $method, array $values): string
    {
        $condition = $this->depthController->conditionLevel(values: $values);

        return "{$method} {$condition}";
    }

    protected function insert(array $values): string
    {
        $method = "INSERT INTO";
        $table = $values[0];
        $formatValues = $this->depthController->singleLevel(values: $values[1], mode: true);

        return "{$method} \"{$table}\" ({$formatValues})";
    }

    protected function values(array $values): string
    {
        $method = 'VALUES';
        $formatValues = $this->depthController->singleLevel(values: $values, mode: false);

        return "{$method} ({$formatValues})";
    }

    protected function select(array $values): string
    {
        return $this->singleLevelAction(method: 'SELECT', values: $values);
    }

    protected function update(array $values): string
    {
        return $this->singleLevelAction(method: 'UPDATE', values: $values);
    }

    protected function delete(array $values): string
    {
        return $this->singleLevelAction(method: 'DELETE FROM', values: $values);
    }

    protected function where(array $values): string
    {
        return $this->conditionAction(method: 'WHERE', values: $values);
    }

    protected function orderBy(array $values)
    {
        return $this->singleLevelAction(method: 'ORDER BY', values: $values);
    }

    protected function groupBy(array $values): string
    {
        return $this->singleLevelAction(method: 'GROUP BY', values: $values);
    }

    protected function having(array $values): string
    {
        return $this->conditionAction(method: 'HAVING', values: $values);
    }

    protected function distinct(array $values): string
    {
        return $this->singleLevelAction(method: 'DISTINCT', values: $values);
    }

    protected function from(array $values): string
    {
        return $this->singleLevelAction(method: 'FROM', values: $values);
    }

    protected function set(array $values): string
    {
        return $this->multiLevelAction(method: 'SET', values: $values);
    }

    protected function join(array $values): string
    {
        return $this->singleLevelAction(method: 'JOIN', values: $values);
    }

    protected function joinOut(array $values): string
    {
        return $this->singleLevelAction(method: 'OUTER JOIN', values: $values);
    }

    protected function joinL(array $values): string
    {
        return $this->singleLevelAction(method: 'LEFT JOIN', values: $values);
    }

    protected function joinR(array $values): string
    {
        return $this->singleLevelAction(method: 'RIGHT JOIN', values: $values);
    }

    protected function on(array $values): string
    {
        return $this->conditionAction(method: 'ON', values: $values);
    }

    protected function or(array $values): string
    {
        return $this->conditionAction(method: 'OR', values: $values);
    }

    protected function and(array $values): string
    {
        return $this->conditionAction(method: 'AND', values: $values);
    }

    protected function not(array $values): string
    {
        return $this->conditionAction(method: 'NOT', values: $values);
    }

    protected function limit(array $values): string
    {
        return $this->singleLevelAction(method: 'LIMIT', values: $values);
    }

    protected function offset(array $values): string
    {
        return $this->singleLevelAction(method: 'OFFSET', values: $values);
    }
}