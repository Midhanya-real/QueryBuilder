<?php

namespace Core\Validation\FetchValidation;

interface FetchInterface
{
    public function save(): bool;

    public function get(): array;

    public function first(): object;
}