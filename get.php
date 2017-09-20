<?php

require __DIR__ . '/start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    //'index' => 'my_index',
    //'type' => 'my_type',
    //'id' => 'my_id',
    'index' => 'index',
    'type' => 'fulltext',
    'id' => 1,
    //'id' => 'my_ids',
];

try {
    $response = $client->get($params);
} catch (\Exception $e) {
    echo $e->getCode()."\n";

    echo $e->getMessage();

    return false;
}

print_r($response);
