## Query Builder V2
### примеры команд:
<ul>
<li>build()->select('some_table', ['some_table.id' => 'serial', 'some_table.number' => 'phone'])->getQueryObject();</li>
<li>build()->insert('some_table', ['id' => 2, 'number' => 8124, 'user_id' => 1])->getQueryObject();</li>
<li>build()->delete('some_table')->where(['number' => 8125])->getQueryObject();</li>
<li>build()->update('some_table', ['number' => 8125])->where(['number' => 8124])->getQueryObject();</li>
<li>build()
    ->select('some_table', ['some_table.number', 'test_table.user_name'],)
    ->join('test_table', ['some_table.user_id' => 'test_table.id'])->getQueryObject();</li>
<li>build()->select('test_table', ['user_name', 'age'])->orderBy(['user_name' => 'ASC', 'age' => 'DESC'])->getQueryObject();</li>
<li>build()->select('test_table', ['user_name', 'age'])->orderBy(['user_name' => 'ASC', 'age' => 'DESC'])->getQueryObject();</li>
</ul>

### Исполняется командами:
<ul>
<li>$exec->execute(query)->save();</li>
<li>$exec->execute(query)->get();</li>
<li>$exec->execute(query)->first();</li>
</ul>
