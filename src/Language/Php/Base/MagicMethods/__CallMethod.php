<?php


namespace Justlzz\Solutions\Language\Php\Base\MagicMethods;


class __CallMethod
{
    //__call的使用场景之-，封装一个数据库查询类

    protected $searchKey = [
            'table'=>null,
            'field'=>null,
            'where'=>null,
            'limit'=>null,
            'order'=>null,
            'group'=>null
        ];

    protected $sql = '';

    public function __call($name, $arguments)
    {
        if (array_key_exists($name,$this->searchKey))
        {
            $this->searchKey[$name] = $arguments;
            return $this;
        }
    }

    public function select()
    {
        if ($this->searchKey['field'])
        {
            $this->sql = 'SELECT ' . $this->searchKey['field'][0] . ' FROM ';
        } else {
            $this->sql = 'SELECT * FROM ';
        }
        if ($this->searchKey['table'])
        {
            $this->sql .= $this->searchKey['table'][0] . ' ';
        } else {
            throw new \Exception('table is necessary');
        }
        if ($this->searchKey['where'])
        {
            $this->sql .= 'WHERE ' . $this->searchKey['where'][0] . ' ';
        } else {
            throw new \Exception('condition is not enough');
        }
        if ($this->searchKey['group']) $this->sql .= 'GROUP BY ' . $this->searchKey['group'][0] . ' ';
        if ($this->searchKey['order']) $this->sql .= 'ORDER BY ' . $this->searchKey['order'][0] . ' ';
        if ($this->searchKey['limit']) $this->sql .= 'LIMIT ' . $this->searchKey['limit'][0];
        return $this->sql;
    }


}