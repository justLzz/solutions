<?php


namespace Justlzz\Solutions\Php\Frame\Laravel\Ioc;

class User
{
    protected $log;

    public function __construct(LogInterface $log,$b)
    {
        $this->log = $log;
    }

    public function login()
    {
        echo 'login' . PHP_EOL;
        $this->log->write();
    }
}