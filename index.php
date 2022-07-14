<?php
require_once __DIR__ . "/vendor/autoload.php";

use Core\Config\Config;
use Core\BuilderConstructor;

$config = Config::getConfig();
$exec = new BuilderConstructor($config);


//$test = $exec->build()->select('some_table', ['some_table.id' => 'serial', 'some_table.number' => 'phone'])->getQueryObject();
$test = $exec->build()->insert('some_table', ['id' => 2, 'number' => 8124, 'user_id' => 1])->getQueryObject();
//$test = $exec->build()->delete('some_table')->where(['number' => 8125])->getQueryObject();
$test_one = $exec->build()->update('some_table', ['number' => 8125])->where(['number' => 8124])->getQueryObject();
/*$test = $exec->build()
    ->select('some_table', ['some_table.number' => 'phone', 'test_table.user_name' => 'first_name'],)
    ->join('test_table', ['some_table.user_id' => 'test_table.id'])->getQueryObject();*/
//$test = $exec->build()->select('test_table', ['user_name', 'age'])->orderBy(['user_name', 'age' => 'DESC'])->getQueryObject();
//$test = $exec->build()->select('test_table', ['user_name', 'sum(age)' => 'counter'])->groupBy(['user_name', 'age'])->having('age', '<', 16)->getQueryObject();
//print_r($exec->execute($test)->get());
print_r($test);
print_r($test_one);