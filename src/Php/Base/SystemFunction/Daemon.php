<?php


namespace Justlzz\Solutions\Php\Base\SystemFunction;

/**
 * php实现守护进程
 * Class Daemon
 * @package Justlzz\Solutions\Php\Base\SystemFunction
 */
class Daemon
{
    public static function init()
    {
        try {
            $pid = pcntl_fork();
            if ($pid == -1) {
                throw new \Exception("fork error");//失败退出
            } else if ($pid>0) {
                exit(0);
            }
            $sid = posix_setsid();//开启新会话，子进程称为会话组长
            if ($sid == -1) {
                throw new \Exception("set sid error");//失败退出
            }
            //重新fork一个子进程，防止会话组长打开终端
            $pid = pcntl_fork();
            if ($pid == -1) {
                throw new \Exception("fork error");//失败退出
            } else if ($pid>0) {
                exit(0);
            }

            //关闭文件描述符
            @fclose(STDOUT);
            @fclose(STDIN);
            @fclose(STDERR);
        } catch (\Exception $exception) {
            exit($exception->getMessage());
        }




    }
}