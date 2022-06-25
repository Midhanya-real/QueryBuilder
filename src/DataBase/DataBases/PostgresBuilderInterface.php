<?php

namespace Core\DataBase\DataBases;

use Core\DataBase\QueryPartsInterfaces\CRUDMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\LinksMethodsInterface;
use Core\DataBase\QueryPartsInterfaces\SortMethodsInterface;

interface PostgresBuilderInterface extends CRUDMethodsInterface, SortMethodsInterface, LinksMethodsInterface
{

}