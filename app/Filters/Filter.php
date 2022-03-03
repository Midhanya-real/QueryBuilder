<?php

namespace Core\Filters;

use Core\Components;
use Core\Filters\InjectionChecker\Checker;
use Core\Filters\Validator\Validator;

class Filter
{
    private Validator $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    protected function isClear(array $query): bool
    {
        return Checker::getInspect(components: Components::getAll(), rawQuery: $query);
    }

    public function getFormedQuery(array $query): string|bool
    {
        return $this->isClear(query: $query) ? $this->validator->getValidQuery(query: $query) : false;
    }
}