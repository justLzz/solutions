<?php
namespace Justlzz\Solutions\Amqp\Contracts;

interface Common {
    function init();
    function setConnection ();
    function setChannel ();
    function setExchange ();
    function setQueue ();
}