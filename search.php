<?php

require __DIR__ . '/start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc',
            ]
        ]
    ]
];
$params = [
    //'index' => 'index',
    //'type' => 'fulltext',
    'index' => 'user',
    'type' => 'user_type',
    // how long between scroll requests. should be small!
    //"scroll" => "10s"
    // how many results *per shard* you want back
    "size" => 3,
    // (number) Starting offset (default: 0)[size * 0, size * 1, size * 2, size * 3, ....]
    'from' => 3,
    'body' => [
        'query' => [
            'match' => [
                //'content' => '中国',
                //'name' => '连波',
                'sex' => 2,
            ]
        ],
        'highlight' => [
            'pre_tags' => [
                '<tag1>',
                '<tag2>',
            ],
            'post_tags' => [
                '</tag1>',
                '</tag2>',
            ],
            'fields' => [
                //'content' => new \stdClass()
                'name' => new \stdClass()
            ]
        ]
    ]
];

try {
    $response = $client->search($params);
} catch (\Exception $e) {
    echo $e->getCode()."\n";

    echo $e->getMessage();

    return false;
}

print_r($response);
