<?php

require __DIR__ . '/start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
    //'id' => 'my_ids',
];

try {
    $response = $client->delete($params);
} catch (\Exception $e) {
    echo $e->getCode()."\n";

    echo $e->getMessage();

    return false;
}

print_r($response);
