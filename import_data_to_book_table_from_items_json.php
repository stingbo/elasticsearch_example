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

    public function importBookData()
    {
        $books = json_decode(file_get_contents($this->filePath), true);
        DB::table('book')->insert($books);
    }

}

$model = new Import;
$result = $model->importBookData();
