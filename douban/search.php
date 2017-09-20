<?php

require __DIR__ . '/../start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();
$book_name = isset($_POST['book_name']) ? $_POST['book_name'] : '白夜行';
$page = isset($_POST['page']) && $_POST['page'] > 1 ? $_POST['page'] : 1;
$pre_page = 2;
$from = ($page - 1) * $pre_page;

$params = [
    'index' => 'douban',
    'type' => 'dd_book',
    // how long between scroll requests. should be small!
    //"scroll" => "10s"
    // how many results *per shard* you want back
    "size" => $pre_page,
    // (number) Starting offset (default: 0)[size * 0, size * 1, size * 2, size * 3, ....]
    'from' => $from,
    'body' => [
        'query' => [
            'match' => [
                'book_name' => $book_name,
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
                'book_name' => new \stdClass()
            ]
        ]
    ]
];

try {
    $response = $client->search($params);
} catch (\Exception $e) {
    //echo $e->getCode()."\n";

    //echo $e->getMessage();

    echo json_encode(['code' => $e->getCode(), 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}

$data = [
    'code' => 200,
    'total' => $response['hits']['total'],
    'page' => $page,
    'pre_page' => $pre_page,
    'page_size' => ceil($response['hits']['total'] / $pre_page),
    'data' => $response['hits']['hits'],
];
echo json_encode($data, JSON_UNESCAPED_UNICODE);
//print_r($response);
