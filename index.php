<?php
require_once __DIR__ . "/vendor/autoload.php";

use Core\Executor;

$config = [
    'db' => 'pgsql',
    'host' => 'localhost',
    'port' => '5432',
    'dbname' => 'QueryTester',
    'username' => 'postgres',
    'pass' => '1234'
];

$testBase = new Executor($config);
$testBase->delete('test_table')->where('age', '=', 13)->save();