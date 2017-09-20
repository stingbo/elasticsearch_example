SET NAMES utf8;
DROP DATABASE IF EXISTS `douban`;
CREATE DATABASE IF NOT EXISTS `douban`;
USE `douban`;

DROP TABLE IF EXISTS `dd_book`;
CREATE TABLE `dd_book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_name` varchar(32) NOT NULL DEFAULT '' COMMENT '书名',
  `book_author` varchar(32) NOT NULL DEFAULT '' COMMENT '作者',
  `book_desc` text DEFAULT '' COMMENT '描述',
  `book_star` varchar(8) DEFAULT '' COMMENT '评分',
  `book_pl` varchar(16) DEFAULT '' COMMENT '评价数',
  `book_publish` varchar(32) DEFAULT '' COMMENT '出版商',
  `book_date` varchar(8) DEFAULT '' COMMENT '出版日期',
  `book_price` varchar(8) DEFAULT '' COMMENT '价格',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='书籍表';
