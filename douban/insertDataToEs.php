<?php

require __DIR__ . '/../start.php';

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use Illuminate\Database\Capsule\Manager as DB;

class Book extends Eloquent  
{
    protected $table = 'book';

    protected $primaryKey = 'id';

    public $timestamps = false;
}

$bookModel = new Book;
$count = $bookModel::count();
$preNums = 1000;
$loopNums = ceil($count / $preNums);

// es client
$client = ClientBuilder::create()->build();
for ($i = 1; $i <= $loopNums; $i++) {
    $start = ($i - 1) * $preNums;
    $end = $i * $preNums;
    $books = $bookModel::where('id', '>=', $start)
        ->where('id', '<', $end)
        ->get();

    foreach ($books as $book) {
        $params['body'][] = [
            'index' => [
                '_index' => 'douban',
                '_type' => 'dd_book',
                '_id' => $book->id,
            ]
        ];
        $params['body'][] = $book->toArray();
    }

    $responses = $client->bulk($params);

    // erase the old bulk request
    $params = ['body' => []];

    // unset the bulk response when you are done to save memory
    unset($responses);
}
