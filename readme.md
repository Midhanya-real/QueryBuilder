# QueryBuilder
# examples query:

* $testBase->select('name', 'last_name')->from('test_table')->save();

* $testBase->insert('test_table', ['name', 'last_name'])->values('someName', 'some_last_name')->save();
* $testBase->update('test_table')->set(['name' => 'anotherName'])->where('id', '=', 1)->save();
* $testBase->delete('test_table')->where('name', '<>', 'anotherName')->save();
* $testBase->select('test_table.name', 'some_table.number')->from('test_table')->join('some_table')->on('test_table.id', '=', 'some_table.user_id')->save();


# join`s:
* join - inner join
* joinOut - Outer Join
* joinL - left join
* JoinR - right join

# GROUP BY and ORDER BY:
* groupBy
* OrderBy
