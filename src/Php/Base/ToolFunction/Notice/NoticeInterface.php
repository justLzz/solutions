<?php


namespace Justlzz\Solutions\Php\Base\ToolFunction\Notice;


Interface NoticeInterface
{
    public function from($where, $name);
    public function to($where);
    public function send();
}