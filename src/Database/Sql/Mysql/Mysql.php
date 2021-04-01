<?php

namespace Justlzz\Solutions\Database\Sql\Mysql;


class Mysql
{
    public $pdo = null;

    public $config = [
        'type' => 'mysql',
        'hostname' => '172.17.0.1',
        'port' => 3306,
        'dbname' => 'test',
        'username' => 'root',
        'password' => '123456',
        'charset' => 'utf8'
    ];

    protected $table;

    //以下两个参数用于预处理防止sql注入
    public $prepareSql = '';

    public $values = [];

    public function __construct()
    {
        if (is_null($this->pdo)) {
            $dsn = sprintf('%s:dbname=%s;host=%s;charset=%s',
                $this->config['type'],
                $this->config['dbname'],
                $this->config['hostname'],
                $this->config['charset']);
            try {
                $this->pdo = new \PDO($dsn, $this->config['username'], $this->config['password']);
                $this->pdo->setAttribute(\PDO::ATTR_PERSISTENT, true); // 设置数据库连接为持久连接
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // 设置抛出错误
                $this->pdo->setAttribute(\PDO::ATTR_ORACLE_NULLS, true); // 设置当字符串为空转换为 SQL 的 NULL
                $this->pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, false);//关闭事务自动提交
                $this->pdo->query('SET NAMES utf8'); // 设置数据库编码
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }

    public function table(String $table)
    {
        $this->prepareSql .= $table . ' ';
        $this->table = $table;
        return $this;
    }

    public function where(String $file, $con, $value)
    {
        if (strstr($this->prepareSql, 'WHERE'))
        {
            $this->prepareSql .= 'AND ' . $file . $con . '? ';
        } else {
            $this->prepareSql .= 'WHERE ' . $file . $con . '? ';
        }

        array_push($this->values,$value);
        return $this;

    }

    //只有select语句需要
    public function field(String $fields)
    {
        $this->prepareSql = $fields . ' FROM ' . $this->prepareSql;
        return $this;
    }

    public function select()
    {
        try {
            $preSql = stripos($this->prepareSql, 'FROM') === false ? 'SELECT * FROM ' : 'SELECT ';
            $pre = $this->pdo->prepare($preSql . $this->prepareSql);
            $pre->execute($this->values);
            $res = $pre->fetchAll(\PDO::FETCH_ASSOC);
            //清空语句和值
            $this->values = [];
            $this->prepareSql = '';
            return $res;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function first()
    {
        return $this->select()[0];
    }

    public function insert(Array $data)
    {
        try {
            $field = '';//要插入的字段
            $placeholder = '';//占位符
            $i = 1;//记录位置
            foreach ($data as $k => $v)
            {
                if ($i == 1)
                {
                    $field .= $k;
                    $placeholder .= '?';
                } else {
                    $field .= ',' . $k;
                    $placeholder .= ',?';
                }
                $i++;
            }
            $this->prepareSql = "INSERT INTO " . $this->table . " ( " . $field . " ) " . " VALUES ( "  . $placeholder . " ) ";
            $pre = $this->pdo->prepare($this->prepareSql);
            $values = array_values($data);
            $this->prepareSql = '';
            return $pre->execute($values);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function update(Array $array)
    {
        try {
            $updateFields = '';
            $i = 1;
            foreach ($array as $k=>$v)
            {
                if ($i == count($array))
                {
                    $updateFields .= $k . '=?' ;
                } else {
                    $updateFields .= $k . '=?,';
                }
                $i++;
            }
            $this->prepareSql = substr_replace($this->prepareSql, 'UPDATE ' . $this->table . ' SET ' . $updateFields, 0,strlen($this->table));
            $values = array_merge(array_values($array),$this->values);
            $pre = $this->pdo->prepare($this->prepareSql);
            $this->prepareSql = '';
            $this->values = [];
            return $pre->execute($values);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    private function __clone() {}
}