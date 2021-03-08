<?php
namespace Solutions\Amqp\Contracts;

interface Common {
    function init();
    function setExchangeName(String $name);
    function setExchangeType(String $type);
    function setExchangeArguments(Array $arguments);
    function setQueueName(String $name);
    function setQueueFlags(Int $flags);
    function setRouteKey(String $routeKey);
    function setConnection ();
    function setChannel ();
    function setExchange ();
    function setQueue ();
}