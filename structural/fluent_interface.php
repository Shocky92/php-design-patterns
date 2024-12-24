<?php
/*
    Fluent Interface или текучий интерфейс — это подход проектирования 
    объектно-ориентированных API. Он симулирует естественный язык, благодаря чему 
    повышает читаемость кода.
*/

class QueryBuilder
{
    private array $select = [];
    private array $from = [];
    private array $where = [];

    public function select(array $select): QueryBuilder
    {
        $this->select = $select;

        return $this;
    }

    public function from(array $from): QueryBuilder
    {
        $this->from = $from;

        return $this;
    }

    public function where(array $where): QueryBuilder
    {
        $this->where = $where;

        return $this;
    }

    public function get(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s;',
            join(', ', $this->select),
            join(', ', $this->from),
            join(' AND ', $this->where),
        );
    }
}

$queryBuilder = new QueryBuilder();
$queryBuilder->select(['id', 'title'])
    ->from(['workers'])
    ->where(['id = 1'])
    ->get();

// SELECT id, title FROM workers WHERE id = 1;