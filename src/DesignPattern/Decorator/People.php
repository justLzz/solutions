<?php

namespace Solutions\DesignPattern\Decorator;

//装饰器应用场景，比如对一个方法进行装饰，再不改变原来方法的情况下，进行扩展
class People
{
    public $decorator = [];//保存装饰器对象

    public function addDecorator(Decorator $decorator)
    {
        $this->decorator[] = $decorator;
    }

    public function index()
    {
        $this->beforeAction(); //装饰器实现的前置方法
        $this->selfAction();    //本类中自己实现的逻辑
        $this->afterAction();   //装饰器实现的后置方法
    }

    public function selfAction()
    {
        echo '过了十年后的我' . PHP_EOL;
    }

    public function beforeAction()
    {
        foreach ($this->decorator as $value)
        {
            $value->before();
        }
    }

    public function afterAction()
    {
        foreach ($this->decorator as $value)
        {
            $value->after();
        }
    }

}