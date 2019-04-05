# ************************************************************
# Sequel Pro SQL dump
# バージョン 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.7.17)
# データベース: problem08
# 作成時刻: 2019-04-05 11:04:20 +0000
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
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除されていない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `token`, `time`, `deleted`, `created`, `modified`)
VALUES
	(18,'y.sakamoto.actself@gmail.com ','560b7295ccc3a611de58da40f9ecb6d6c68a699d','坂本裕也',NULL,NULL,NULL,'2019-03-25 16:04:21','2019-04-05 18:42:18');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL,
  `objective_id` int(10) unsigned NOT NULL COMMENT '目標ID',
  `comment` text NOT NULL,
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除されていない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL COMMENT '部署名',
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除されていない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `department_name`, `deleted`, `created`, `modified`)
VALUES
	(1,'経理部',NULL,'2019-03-08 11:00:21','2019-04-05 19:31:13'),
	(2,'営業部',NULL,'2019-03-08 11:00:25','2019-03-08 11:00:36'),
	(3,'製造部',NULL,'2019-03-08 11:00:46','2019-03-08 11:00:46'),
	(4,'販売部',NULL,'2019-03-08 11:01:11','2019-03-08 11:01:11'),
	(5,'開発部',NULL,'2019-03-08 11:01:17','2019-03-08 11:01:17'),
	(7,'人事部',NULL,'2019-03-08 15:07:31','2019-04-05 19:31:44'),
	(10,'管理部',NULL,'2019-04-01 10:52:17','2019-04-01 10:52:17');

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name_kana` varchar(50) NOT NULL,
  `last_name_kana` varchar(50) NOT NULL,
  `gender` set('男','女') NOT NULL,
  `birthday` date NOT NULL,
  `home` varchar(50) NOT NULL,
  `hire_date` date NOT NULL COMMENT '入社日',
  `retirement_date` date DEFAULT NULL COMMENT 'NULL = 退職していない',
  `department_id` int(10) unsigned NOT NULL COMMENT '部署ID',
  `position_id` int(10) unsigned NOT NULL COMMENT '役職ID',
  `email` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sos` varchar(15) NOT NULL DEFAULT '' COMMENT '緊急連絡先番号',
  `token` varchar(50) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除していない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_id` (`member_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`version`)
VALUES
	(20190305144345);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ objectives
# ------------------------------------------------------------

DROP TABLE IF EXISTS `objectives`;

CREATE TABLE `objectives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `year` year(4) NOT NULL,
  `quarter` set('第1四半期','第2四半期','第3四半期','第4四半期') NOT NULL DEFAULT '' COMMENT '第何四半期',
  `objective` text NOT NULL,
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除されていない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ positions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) NOT NULL,
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除されていない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;

INSERT INTO `positions` (`id`, `position_name`, `deleted`, `created`, `modified`)
VALUES
	(1,'平社員',NULL,'2019-03-08 10:56:04','2019-04-01 10:45:45'),
	(2,'主任',NULL,'2019-03-08 10:56:52','2019-03-08 10:56:52'),
	(3,'係長',NULL,'2019-03-08 10:57:00','2019-03-08 10:57:00'),
	(4,'課長',NULL,'2019-03-08 10:57:16','2019-03-08 10:57:16'),
	(5,'次長',NULL,'2019-03-08 10:57:22','2019-03-26 17:33:05'),
	(7,'本部長',NULL,'2019-03-08 10:58:53','2019-03-29 20:51:33'),
	(9,'専務',NULL,'2019-03-29 21:12:27','2019-04-05 19:30:13');

/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
