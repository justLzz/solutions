<?php
namespace Solutions\Amqp\Contracts;

interface Common {
    function init();
    function setExchangeName(String $name);
    function setExchangeType(String $type);
    function setExchangeArguments(Array $arguments);
    function setExchangeFlags(Array $flags);
    function setQueueName(String $name);
    function setQueueFlags(Array $flags);
    function setRouteKey(String $routeKey);
    function setConnection ();
    function setChannel ();
    function setExchange ();
    function setQueue ();
}