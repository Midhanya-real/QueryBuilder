<?php
require_once __DIR__ . "/vendor/autoload.php";

use Core\Config\Config;
use Core\BuilderConstructor;

$config = Config::getConfig();
$exec = new BuilderConstructor($config);

$test = $exec->build()->select(['user_name', 'sum(age)'])->as('age')->from('test_table')->groupBy(['user_name'])->first();
//$test = $exec->build()->insert('some_table')->values([1, 18921, 1])->save();
//$test = $exec->build()->delete()->from('some_table')->where('user_id', 1)->save();
//$test = $exec->build()->select()->from('test_table')->where('id', 2)->save();
/*$test = $exec->build()->select(
    [
        'some_table.id',
        'some_table.number',
        'test_table.user_name',
        'test_table.age'
    ]
)
    ->from('some_table')
    ->join('test_table')
    ->on('some_table.user_id', 'test_table.id')
    ->save();
*/
print_r($test);