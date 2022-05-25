## Query Builder V2
### примеры команд:
<ul>
<li>build()->insert('some_table')->values([1, 18921, 1])->save();</li>
<li>build()->delete()->from('some_table')->where('user_id', 1)->first();</li>
<li>build()->select()->from('test_table')->get();</li>
<li>build()->select(['user_name', 'sum(age)'])->as('age')->from('test_table')->groupBy(['user_name'])->get();</li>
<li>build()->select(
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
    ->get();</li>
</ul>