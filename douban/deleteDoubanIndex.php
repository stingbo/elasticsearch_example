<?php

require __DIR__ . '/../start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$deleteIndexParams = [
    'index' => 'douban',
];

try {
    $response = $client->indices()->delete($deleteIndexParams);
} catch (\Exception $e) {
    echo $e->getCode()."\n";

    echo $e->getMessage();

    return false;
}

print_r($response);
