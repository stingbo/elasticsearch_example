<?php

require __DIR__ . '/../start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();
$content = isset($_GET['content']) ? $_GET['content'] : '白夜行';
$page = isset($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$pre_page = 3;
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
            'bool' => [
                // 类化sql的and
                //'must' => [
                // 类化sql的or
                'should' => [
                    ['match' => ['book_name' => $content]],
                    ['match' => ['book_desc' => $content]]
                ]
            ]
        ],
        'highlight' => [
            'pre_tags' => [
                '<b><font color="#FF0000">',
                '<strong>',
            ],
            'post_tags' => [
                '</font></b>',
                '</strong>',
            ],
            'fields' => [
                'book_name' => new \stdClass(),
                'book_desc' => new \stdClass(),
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
    die;
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
