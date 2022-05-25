<?php

namespace Core\Validation\FetchValidation;

use PDO;

class FetchValidator implements FetchInterface
{
    private PDO $connect;

    public function __construct(PDO $connect)
    {
        $this->connect = $connect;
    }

    public function save(): bool
    {
        // TODO: Implement save() method.
    }

    public function get(): array
    {
        // TODO: Implement get() method.
    }

    public function first(): object
    {
        // TODO: Implement first() method.
    }

    /*public function save(): bool
{
    $this->queryObject = QueryObjectAction::toValid($this->queryObject);

    $query = $this->connect->prepare($this->queryObject['query']);
    $query->execute($this->queryObject['params']);

    return true;
}

public function get(): array
{
    $this->queryObject = QueryObjectAction::toValid($this->queryObject);

    $query = $this->connect->prepare($this->queryObject['query']);
    $query->execute($this->queryObject['params']);

    return $query->fetchAll(PDO::FETCH_CLASS);
}

public function first(): object
{
    $this->queryObject = QueryObjectAction::toValid($this->queryObject);

    $query = $this->connect->prepare($this->queryObject['query']);
    $query->execute($this->queryObject['params']);

    return $query->fetchObject();
}*/
}