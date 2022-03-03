<?php

namespace Core\Controllers;

use Core\Filters\Filter;
use Core\Filters\Validator\Commands;
use Core\Filters\Validator\Validator;

class BuilderController
{
    protected final function depthController(): ProcessDepthController
    {
        return new ProcessDepthController();
    }

    protected final function commands(): Commands
    {
        return new Commands($this->depthController());
    }

    protected final function Validator(): Validator
    {
        return new Validator($this->commands());
    }

    public final function filter(): Filter
    {
        return new Filter($this->Validator());
    }
}