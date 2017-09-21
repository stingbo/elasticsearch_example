##### demo简介

* Html+jquery+bootstrap+PHP+Elasticsearch中文分词搜索显示的示例。

* [相关项目信息地址]()

***

##### demo结构说明：

> README.md 此说明

-------------

> composer.json composer资源文件，此demo所使用的两个PHP库，Eloquent和elasticesearch-php库。Eloquent是Laravel里使用的数据库ORM，方便好用，能独立于Laravel使用。elasticsearch是PHP调用Elasticsearch服务的库。clone此项目后，使用命令：`composer update -vvv`安装依赖。

-------------

> items.json  使用Python爬虫获取的豆瓣读书目录下的一些信息，JSON格式

-------------

> book.sql 数据库和数据表结构

-------------

> douban.sql 爬取的数据导入MySQL后，导出的SQL数据。觉得自己学习爬数据麻烦的同学，可以直接把数据导入MySQL。

-------------

> import_data_to_book_table_form_items_json.php  把items.json文件内容导入数据表脚本，命令：`php 文件名`直接执行

-------------

> start.php PHP第三方库和数据库等前置配置

-------------

***
###### 以下四个文件是单独测试Elasticsearch示例
> createIndex.php 创建elasticsearch index、type(类似创建MySQL数据库、数据表)，命令：`php createIndex.php`

> insert.php 向elasticsearch插入测试数据，命令：`php insert.php`

> search.php 根据条件查询数据，命令：`php search.php`

> delete.php 删除elasticsearch index，命令：`php delete.php`

***

> douban 实际搜索显示demo目录

> createDoubanIndex.php 创建elasticsearch index、type(类似创建MySQL数据库、数据表)，命令：`php createDoubanIndex.php`

> insertDataToEs.php 把之前导入MySQL的数据导入ElasticSearch，使用Eloquent ORM查出数据，然后批量插入Elasticsearch，命令：`php insertDataToEs.php`

> search.php 前端请求的后端地址文件

>> view 前端模版文件目录
>>> index.html 搜索显示页面，使用ajax分页和向后端传递数据