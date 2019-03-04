# ************************************************************
# Sequel Pro SQL dump
# バージョン 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.7.17)
# データベース: problem06
# 作成時刻: 2019-03-04 01:06:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# テーブルのダンプ admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理者テーブル';



# テーブルのダンプ comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL COMMENT '管理者id',
  `objective_id` int(10) unsigned NOT NULL COMMENT '目標id',
  `comment` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'コメント本文',
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  KEY `objective_id` (`objective_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`objective_id`) REFERENCES `objectives` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='コメントテーブル';



# テーブルのダンプ departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL DEFAULT '' COMMENT '部署名',
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='部署テーブル';



# テーブルのダンプ members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_kana` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '姓（カナ',
  `last_kana` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '名（カナ',
  `home` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '住所',
  `birth` date NOT NULL COMMENT '誕生日',
  `gender` tinyint(4) NOT NULL COMMENT '性別',
  `position_id` int(10) unsigned NOT NULL COMMENT '役職id',
  `department_id` int(10) unsigned NOT NULL COMMENT '部署id',
  `hire_date` date NOT NULL COMMENT '入社日',
  `retirement_date` date DEFAULT NULL COMMENT '退職日',
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sos` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '緊急連絡際',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `potisions` (`id`),
  CONSTRAINT `members_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='社員管理テーブル';



# テーブルのダンプ objectives
# ------------------------------------------------------------

DROP TABLE IF EXISTS `objectives`;

CREATE TABLE `objectives` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `year` year(4) NOT NULL COMMENT '何年',
  `quarter` tinytext NOT NULL COMMENT '第何四半期',
  `title` varchar(50) NOT NULL DEFAULT '',
  `objective` text NOT NULL COMMENT '社員目標',
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `objectives_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='社員目標管理テーブル';



# テーブルのダンプ potisions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `potisions`;

CREATE TABLE `potisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) NOT NULL DEFAULT '' COMMENT '役職名',
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='役職テーブル';




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
