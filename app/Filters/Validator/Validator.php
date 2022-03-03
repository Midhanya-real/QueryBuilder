<?php

namespace Core\Filters\Validator;

class Validator
{
    private Commands $commands;
    private static string $query = '';

    public function __construct(Commands $commands)
    {
        $this->commands = $commands;
    }

    protected function formatValue(array $values): string //поправить
    {
        foreach ($values as $key => $value) {
            static::$query .= $this->commands->build(method: $key, values: $value) . ' ';
        }

        return static::$query;
    }

    public function getValidQuery(array $query): string
    {
        return $this->formatValue(values: $query) ? static::$query : false;
    }
}