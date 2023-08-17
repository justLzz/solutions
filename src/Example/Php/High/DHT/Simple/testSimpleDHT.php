<?php

require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Language\Php\High\DHT\Simple\ConsistentHash;
use Justlzz\Solutions\Language\Php\High\DHT\Simple\Md5Hash;
$hash = new ConsistentHash();
$targets=[
    "192.168.1.1:11011",
    "192.168.1.1:11012",
    "192.168.1.1:11013",
    "192.168.1.1:11014",
    "192.168.1.1:11015",
];

$hash->addTargets($targets);

for ($i=0; $i < 25; $i++) {
    $resource = sprintf("format %d",$i);
    var_dump($resource." --> ".$hash->lookup($resource));
}