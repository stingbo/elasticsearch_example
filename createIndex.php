<?php

require __DIR__ . '/start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
    'body' => ['testField' => 'abc']
];
$params = [
    'index' => 'user',
    'body' => [
        'settings' => [
            'number_of_shards' => 3,
            'number_of_replicas' => 2
        ],
        'mappings' => [
            'user_type' => [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'analyzer' => 'ik_max_word',
                        'search_analyzer' => 'ik_max_word',
                    ],
                    'sex' => [
                        'type' => 'integer',
                    ],
                    'age' => [
                        'type' => 'integer',
                    ],
                    'motto' => [
                        'type' => 'text',
                        'analyzer' => 'ik_max_word',
                        'search_analyzer' => 'ik_max_word',
                    ],
                ]
            ]
        ]
    ]
];

//$response = $client->index($params);
$response = $client->indices()->create($params);

print_r($response);
