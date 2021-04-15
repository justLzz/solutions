<?php
require '/data/www/Solutions/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$host = '172.17.0.1:9200';

$client = ClientBuilder::create()->setHosts([$host])->build();

$params = [
    'index' => 'my_index',
    'id' => 'my_id',
    'body' => ['testField' => 'abc']
];
var_dump($client->index($params));
