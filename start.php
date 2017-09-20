<?php

// 载入composer的autoload文件
require __DIR__ . '/vendor/autoload.php';  

use Illuminate\Container\Container;  
use Illuminate\Database\Capsule\Manager as Capsule;

// 数据库根据情况修改
$database = [
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'douban',
    'username'  => 'root',
    'password'  => 'wanlianbo',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => 'dd_',
];

$capsule = new Capsule;

// 创建链接
$capsule->addConnection($database);

// 设置全局静态可访问
$capsule->setAsGlobal();

// 启动Eloquent
$capsule->bootEloquent();
