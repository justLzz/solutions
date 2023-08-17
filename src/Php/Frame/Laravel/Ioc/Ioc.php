<?php


namespace Justlzz\Solutions\Php\Frame\Laravel\Ioc;


class Ioc
{
    public $binding = [];

    public function bind($abstract, $concrete)
    {
        //这里为什么要返回一个closure呢？因为bind的时候还不需要创建User对象，所以采用closure等make的时候再创建FileLog;
        $this->binding[$abstract]['concrete'] = function ($ioc) use ($concrete) {
            return $ioc->build($concrete);
        };
    }

    public function make($abstract) {
        $concrete = $this->binding[$abstract]['concrete'];//获得具体类，此处是一个闭包
        return $concrete($this);//运行闭包实例化对象
    }

    //实例化对象
    public function build($concrete)
    {
        $reflector = new \ReflectionClass($concrete);
        $constructor = $reflector->getConstructor();//获取构造函数
        if (is_null($constructor)) {
            return $reflector->newInstance();
        } else {
            $dependencies = $constructor->getParameters();//获取构造函数参数
            $instances = $this->getDependencies($dependencies);
            return $reflector->newInstanceArgs($instances);
        }
    }

    //获取对象依赖
    public function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter)
        {
            if ($parameter->getClass()) {
                $dependencies[] = $this->make($parameter->getClass()->name);//获取类名并实例化
            } else {
                $dependencies[] = null;
            }

        }
        return $dependencies;
    }
}