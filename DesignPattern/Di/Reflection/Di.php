<?php


namespace Solutions\DesignPattern\Di\Reflection;


class Di
{
    public function make($className)
    {
        $reflectionClass = new \ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();
        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter)
        {
            $dependency = $parameter->getClass();
            if (is_null($dependency)) {
                if ($parameter->isDefaultValueAvailable())
                {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    $dependencies[] = '0';
                }
            } else {
                $dependencies[] = $this->make($parameter->getClass()->name);
            }
        }

        return $dependencies;

    }
}