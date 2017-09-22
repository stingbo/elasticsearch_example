<?php

require __DIR__ . '/../start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'douban',
    'body' => [
        'settings' => [
            'number_of_shards' => 3,
            'number_of_replicas' => 2
        ],
        'mappings' => [
            'dd_book' => [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => [
                    'book_name' => [
                        'type' => 'text',
                        'analyzer' => 'ik_max_word',
                        'search_analyzer' => 'ik_max_word',
                    ],
                    'book_author' => [
                        'type' => 'text',
                        'analyzer' => 'ik_max_word',
                        'search_analyzer' => 'ik_max_word',
                    ],
                    'book_desc' => [
                        'type' => 'text',
                        'analyzer' => 'ik_max_word',
                        'search_analyzer' => 'ik_max_word',
                    ],
                    'book_star' => [
                        'type' => 'text',
                    ],
                    'book_pl' => [
                        'type' => 'text',
                    ],
                    'book_publish' => [
                        'type' => 'text',
                    ],
                    'book_date' => [
                        'type' => 'text',
                    ],
                    'book_price' => [
                        'type' => 'text',
                    ],
                ]
            ]
        ]
    ]
];
// 在终端查看所有index命令:curl -X GET 'http://localhost:9200/_cat/indices?v'
$response = $client->indices()->create($params);
print_r($response);
