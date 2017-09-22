<?php

//包含Eloquent的初始化文件
include __DIR__ . '/start.php';

use Illuminate\Database\Eloquent\Model as Eloquent; 
use Illuminate\Database\Capsule\Manager as DB;

class Import extends Eloquent  
{
    private $filePath = __DIR__.'/items.json';

    protected $table = 'book';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function importBookData($chunk = 1000)
    {
        $books = json_decode(file_get_contents($this->filePath), true);
        if (is_array($books) && count($books) > $chunk) {
            $books = array_chunk($books, $chunk);
            foreach ($books as $book) {
                DB::table('book')->insert($books);
            }
        } elseif (is_array($books) && count($books) <= $chunk) {
            DB::table('book')->insert($books);
        } else {
            echo '格式不正确';
        }
    }

}

$model = new Import;
$result = $model->importBookData();
