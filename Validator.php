<?php

namespace Core\Filters\Validator;

class Validator
{
    private Commands $commands;
    private string $query = '';

    public function __construct(Commands $commands)
    {
        $this->commands = $commands;
    }

    protected function formatValue(array $values): string //поправить
    {
        foreach ($values as $key => $value) {
            $this->query .= $this->commands->build(method: $key, values: $value) . ' ';
        }

        return $this->query;
    }

    public function getValidQuery(array $query): string
    {
        return $this->formatValue(values: $query) ? $this->query : false;
    }
}