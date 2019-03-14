# ************************************************************
# Sequel Pro SQL dump
# バージョン 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.7.17)
# データベース: problem08
# 作成時刻: 2019-03-14 11:31:51 +0000
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
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除されていない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `deleted`, `created`, `modified`)
VALUES
	(1,'q','4b9be2a4b95ef46830495ce45cef504384190115','q',NULL,'2019-03-11 16:48:34','2019-03-11 16:48:34'),
	(2,'h','7f0514edb90b6ded5e2fbacca905d0dad8754c22','あ',NULL,'2019-03-11 18:44:27','2019-03-11 18:44:27'),
	(3,'y','2f4bd1f0add04ac88b8b56fcef9e24787fc9d51e','y',NULL,'2019-03-11 19:19:48','2019-03-11 19:19:48'),
	(4,'b','e36a78f0bb0236615f27747f978411173df6d5f0','b',NULL,'2019-03-11 20:43:16','2019-03-11 20:43:16'),
	(5,'a','5abb805de6b5ee91f8b1a37686dabd848e61fdd9','a',NULL,'2019-03-12 13:06:26','2019-03-12 13:06:26'),
	(6,'x','1e855c273eedb58a19195a11c0cbacd366fd66c4','x',NULL,'2019-03-13 20:54:23','2019-03-13 20:54:23'),
	(7,'z','339f89bd4c80a0e779a17c71a76ce8fe894656ba','z',NULL,'2019-03-13 20:58:26','2019-03-13 20:58:26');

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

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `admin_id`, `objective_id`, `comment`, `deleted`, `created`, `modified`)
VALUES
	(1,1,8,'a',NULL,'2019-03-12 14:35:15','2019-03-12 14:35:15'),
	(2,1,8,'a',NULL,'2019-03-12 14:37:19','2019-03-12 14:37:19'),
	(3,1,8,'a',NULL,'2019-03-12 14:37:48','2019-03-12 14:37:48'),
	(4,5,22,'a',NULL,'2019-03-12 14:39:10','2019-03-12 14:39:10'),
	(5,5,8,'っっf',NULL,'2019-03-12 14:43:33','2019-03-12 14:43:33'),
	(6,1,28,'eee',NULL,'2019-03-12 15:01:47','2019-03-12 15:01:47'),
	(7,1,26,'a',NULL,'2019-03-12 16:39:47','2019-03-12 16:39:47'),
	(8,1,23,'qq区',NULL,'2019-03-12 17:54:43','2019-03-12 17:54:43'),
	(9,1,19,'eee',NULL,'2019-03-12 18:03:29','2019-03-12 18:03:29'),
	(10,1,25,'っっw',NULL,'2019-03-12 18:27:16','2019-03-12 18:27:16'),
	(11,1,27,'w',NULL,'2019-03-12 18:50:40','2019-03-12 18:50:40'),
	(12,1,8,'aaa',NULL,'2019-03-13 14:58:54','2019-03-13 14:58:54'),
	(13,1,8,'a',NULL,'2019-03-13 19:32:01','2019-03-13 19:32:01'),
	(14,1,33,'コメント入力欄',NULL,'2019-03-14 17:55:16','2019-03-14 17:55:16'),
	(15,1,32,'コメント入力欄',NULL,'2019-03-14 18:00:12','2019-03-14 18:00:12'),
	(16,1,32,'コメント入力欄jhふh',NULL,'2019-03-14 18:22:55','2019-03-14 18:22:55'),
	(17,1,35,'fjaffafhirhajiuh',NULL,'2019-03-14 19:56:37','2019-03-14 19:56:37');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'経理部',NULL,'2019-03-08 11:00:21','2019-03-08 11:00:21'),
	(2,'営業部',NULL,'2019-03-08 11:00:25','2019-03-08 11:00:36'),
	(3,'製造部',NULL,'2019-03-08 11:00:46','2019-03-08 11:00:46'),
	(4,'販売部',NULL,'2019-03-08 11:01:11','2019-03-08 11:01:11'),
	(5,'開発部',NULL,'2019-03-08 11:01:17','2019-03-08 11:01:17'),
	(6,'人事部',NULL,'2019-03-08 11:01:29','2019-03-08 11:01:29'),
	(7,'総務部',NULL,'2019-03-08 15:07:31','2019-03-08 15:07:31');

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
  `sos` int(10) unsigned NOT NULL COMMENT '緊急連絡先番号',
  `deleted` datetime DEFAULT NULL COMMENT 'NULL = 削除していない',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_id` (`member_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `member_id`, `first_name`, `last_name`, `first_name_kana`, `last_name_kana`, `gender`, `birthday`, `home`, `hire_date`, `retirement_date`, `department_id`, `position_id`, `email`, `password`, `sos`, `deleted`, `created`, `modified`)
VALUES
	(14,1,'岡本','優太','オカモト','ユウタ','男','1111-11-11','東京','1111-11-11',NULL,4,3,'a','f29bc91bbdab169fc0c0a326965953d11c7dff83',1,NULL,'2019-03-12 11:53:50','2019-03-14 18:17:20'),
	(18,2,'中川','正志','ナカガワ','マサシ','男','1111-11-11','練馬','1111-11-11',NULL,1,1,'z','380a4c847a577ff635238aa9418580f1a54981f4',1,NULL,'2019-03-14 18:36:48','2019-03-14 18:37:07');

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `objectives` WRITE;
/*!40000 ALTER TABLE `objectives` DISABLE KEYS */;

INSERT INTO `objectives` (`id`, `member_id`, `year`, `quarter`, `objective`, `deleted`, `created`, `modified`)
VALUES
	(32,1,'2009','第2四半期','rtyuiouytrtyuiiuyfdfghjkjhgfghjkljhgfghjkljhghjkjhgvfghjk,lkjhgfdfghjklkjhgfdfghjkl;kjhgfdfghjklkjhgfdfghjklkjhgfdsdfghjuikolkjuhgfdfghjklkjhgfdfghjiklokijuhygtfdfghjkljhgfdfghjkljhgfdfghjklkjhgfdghjklkjhgfdghjklkjhgfdfghjklokijuhygtfrdfghjklkjhgfdghjkjhgfdfghjkl;kjhgtfrghjuiklokjhgfdfghjklkhygtfrdfghjuikoijuhygfdfghjkjhgfdfghjklkjhgfghjkljhgfghjklkjhgfghjkljhgfghjklkjhgfghjklkjhgfghjklkjhgfgthjkljhgfghjklkjhgfghjklkjhgfdsdfghjkjhgfdfghjkl;kjhgfghjklokijuhygtfrdfrtghyujikolkjuhygtfdfghjklkijuhygtfrdertyuioliuytredswedrftgyhujikolikuytredwertyuioiuytrertyuioiuytrfdertyuioiuytrertyuiokiuytrertyu',NULL,'2019-03-14 14:53:51','2019-03-14 17:33:36'),
	(33,1,'2010','第3四半期','fcfvghjhgfdfghjkjhgfdghjkjhgfdfghjkjhgfdghjkjhgfdghjkjhgfghjk',NULL,'2019-03-14 14:54:34','2019-03-14 14:54:34'),
	(34,1,'2008','第2四半期','vcdfghjkjhvcfdfgyhujkmnbvcdrtyuikjnhbvfcdftyuikjhbgvfghjkj',NULL,'2019-03-14 17:06:33','2019-03-14 17:06:33'),
	(35,2,'2006','第2四半期','gyyydfghjkjhgfghjkjhgfdghjklkjhgfdghjkjhgfdfghjkjhgfcdfghjkmjnhbgvfc',NULL,'2019-03-14 18:38:19','2019-03-14 18:38:19');

/*!40000 ALTER TABLE `objectives` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'社員',NULL,'2019-03-08 10:56:04','2019-03-08 10:56:04'),
	(2,'主任',NULL,'2019-03-08 10:56:52','2019-03-08 10:56:52'),
	(3,'係長',NULL,'2019-03-08 10:57:00','2019-03-08 10:57:00'),
	(4,'課長',NULL,'2019-03-08 10:57:16','2019-03-08 10:57:16'),
	(5,'部長',NULL,'2019-03-08 10:57:22','2019-03-08 10:57:22'),
	(6,'専務取締役',NULL,'2019-03-08 10:57:36','2019-03-08 10:58:44'),
	(7,'社長',NULL,'2019-03-08 10:58:53','2019-03-08 10:58:53');

/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
