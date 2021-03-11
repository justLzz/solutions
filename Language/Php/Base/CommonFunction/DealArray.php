<?php

namespace Solutions\Language\Php\Base\CommonFunction;

/**
 * 常用处理数组方法
 * Class DealArray
 * @package Solutions\Language\Php\Base\CommonFunction
 */
class DealArray
{
    public $res = [];

    //递归处理无限极分类
    public function recursionInfinite(Array $array,Int $pid=0,Int $level=0)
    {
        /**
         * 知识点 关于static
         * 1，函数内 static 变量，只作用在该函数内部，每次调用后，static变量的值会在上一次调用的基础上更改。
         * 而定义时，如果赋予了初值，那么这条语句只会执行一次
         * 2，static 类成员变量，类的静态成员变量只属于这个类，但类的所有实例共享这个静态成员变量
         * 3，static 类成员变量，静态成员变量不需要实例化就能访问，且访问速度快一些
         * 4，static 类方法，类的静态方法只能访问静态成员变量，而不能访问非静态成员变量（如果有，会报错 ）
         * 5，Trait 的静态变量，trait 的静态变量被不同的类使用时 是互不影响的
         */
        static $list = [];
        foreach ($array as $item=>$value)
        {
            if ($value['pid'] == $pid)
            {
                $value['level'] = $level;
                $list[] = $value;
                unset($value[$item]);
                $this->recursionInfinite($array, $value['id'], $level+1);
            }
        }
        return $list;
    }

    //引用处理无限极分类
    public function quoteInfinite(Array $array)
    {
        $list = [];
        foreach ($array as $k=>$v) {
            $list[$v['id']] = $v;
        }
        $tree = [];
        foreach ($list as $k => $v) {
            if (isset($list[$v['pid']])) {
                $list[$v['pid']]['son'][] = &$list[$k];
            } else {
                $tree[] = &$list[$k];
            }
        }

        return $tree;
    }
}

$a = [ [ 'id'=>1, 'pid'=>0 ],
        [ 'id'=>2, 'pid'=>0 ],
        [ 'id'=>3, 'pid'=>0 ],
        [ 'id'=>4, 'pid'=>1 ],
        [ 'id'=>5, 'pid'=>2 ],
        [ 'id'=>6, 'pid'=>2 ],
        [ 'id'=>7, 'pid'=>3 ],
        [ 'id'=>8, 'pid'=>3 ],
        [ 'id'=>9, 'pid'=>3 ] ];

$b = new DealArray();
//var_dump($b->recursionInfinite($a));
var_dump($b->quoteInfinite($a));
