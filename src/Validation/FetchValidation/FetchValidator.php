<?php

namespace Core\Validation\FetchValidation;

use Core\Actions\ValidateActions\InLineParamsAction;
use PDO;

class FetchValidator implements FetchInterface
{
    private PDO $connect;
    private array $queryObject;

    public function __construct(PDO $connect, array $queryObject)
    {
        $this->connect = $connect;
        $this->queryObject = $queryObject;
    }

    public function save(): bool
    {
        $this->queryObject['params'] = InLineParamsAction::inLine($this->queryObject['params']);

        $query = $this->connect->prepare($this->queryObject['query']);
        $query->execute($this->queryObject['params']);

        return true;
    }

    public function get(): array
    {
        $this->queryObject['params'] = InLineParamsAction::inLine($this->queryObject['params']);

        $query = $this->connect->prepare($this->queryObject['query']);
        $query->execute($this->queryObject['params']);

        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public function first(): object
    {
        $this->queryObject['params'] = InLineParamsAction::inLine($this->queryObject['params']);

        $query = $this->connect->prepare($this->queryObject['query']);
        $query->execute($this->queryObject['params']);

        return $query->fetchObject();
    }
}