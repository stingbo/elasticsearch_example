<?php

require __DIR__ . '/start.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = ['body' => []];

for ($i = 1; $i <= 123456; $i++) {
    $params['body'][] = [
        'index' => [
            '_index' => 'user',
            '_type' => 'user_type',
            '_id' => $i
        ]
    ];

    $params['body'][] = [
        'name' => '连波'.$i,
        'sex' => rand(0, 3),
        'age' => rand(10, 20),
        'motto' => '这是我的座右铭',
    ];

    // Every 1000 documents stop and send the bulk request
    if ($i % 1000 == 0) {
        $responses = $client->bulk($params);

        // erase the old bulk request
        $params = ['body' => []];

        // unset the bulk response when you are done to save memory
        unset($responses);
    }
}

// Send the last batch if it exists
if (!empty($params['body'])) {
    $responses = $client->bulk($params);
}
