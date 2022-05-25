<?php
require_once __DIR__ . "/vendor/autoload.php";

use Core\Config\Config;
use Core\BuilderConstructor;

$config = Config::getConfig();
$exec = new BuilderConstructor($config);

//$test = $exec->build()->select(['user_name', 'sum(age)'])->as('age')->from('test_table')->groupBy(['user_name'])->get();
//$test = $exec->build()->insert('', [])->values([1, 18921, 1]);
//$test = $exec->build()->delete()->from('some_table')->where('user_id', 1)->first();
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

//print_r($test);

/*class Test
{
    protected $row1 = [1, 2, 3, 4, 5];
    protected $row2 = 'query';

    public function query(): static
    {
        $this->row2 .= ' query FROM';

        return $this;
    }
}

print_r((new Test())->query());*/