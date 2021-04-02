<?php


namespace Justlzz\Solutions\Language\Php\Base\ToolFunction\Notice;


Interface NoticeInterface
{
    public function from($where, $name);
    public function to($where, $name);
    public function send();
}