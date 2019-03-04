# ************************************************************
# Sequel Pro SQL dump
# バージョン 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.7.17)
# データベース: problem06
# 作成時刻: 2019-03-04 00:52:46 +0000
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理者テーブル';

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `deleted`, `created`, `modified`)
VALUES
	(121,'a','0d217ce62e90c58cf8178e0e7eb53f74a86f793e','a',NULL,'2017-08-02 16:30:55','2017-08-02 16:30:55'),
	(127,'st-fle-@outlook.jp','30649aa2ebc0af29a1986e3e9cce0970e8062535','w',NULL,'2017-08-08 15:54:14','2017-08-08 15:54:14'),
	(128,'test@example.jp','75984f60bed1f82626f92da61c9ba5bcda344493','test',NULL,'2017-08-08 20:01:45','2017-08-08 20:01:45'),
	(129,'w','w','w',NULL,'2019-02-21 00:19:59','2019-02-21 00:19:59'),
	(131,'b','b','b',NULL,'2019-02-25 17:31:33','2019-02-25 17:31:33'),
	(133,'c','c','c',NULL,'2019-02-25 17:49:49','2019-02-25 17:49:49'),
	(134,'d','d','d',NULL,'2019-02-25 17:55:28','2019-02-25 17:55:28'),
	(136,'e','e','e',NULL,'2019-02-25 18:02:01','2019-02-25 18:02:01'),
	(137,'f','f','f',NULL,'2019-02-25 18:02:38','2019-02-25 18:02:38'),
	(138,'g','g','g',NULL,'2019-02-25 18:46:18','2019-02-25 18:46:18'),
	(139,'h','h','h',NULL,'2019-02-25 18:46:51','2019-02-25 18:46:51'),
	(140,'p','p','p',NULL,'2019-02-25 19:04:33','2019-02-25 19:04:33'),
	(141,'qq','qq','qq',NULL,'2019-02-25 19:16:19','2019-02-25 19:16:19'),
	(143,'ww','qq','qq',NULL,'2019-02-25 22:31:05','2019-02-25 22:31:05'),
	(145,'www','qq','qq',NULL,'2019-02-25 22:32:01','2019-02-25 22:32:01'),
	(146,'wwww','qq','qq',NULL,'2019-02-25 22:37:32','2019-02-25 22:37:32'),
	(148,'aaa','qq','qq',NULL,'2019-02-25 22:39:01','2019-02-25 22:39:01'),
	(149,'xxx','qq','qq',NULL,'2019-02-25 22:39:13','2019-02-25 22:39:13'),
	(150,'lll','qq','qq',NULL,'2019-02-25 22:40:31','2019-02-25 22:40:31'),
	(151,'llll','qq','qq',NULL,'2019-02-25 22:42:04','2019-02-25 22:42:04'),
	(152,'lllln','qq','qq',NULL,'2019-02-25 22:44:53','2019-02-25 22:44:53'),
	(154,'llllnnn','qq','qq',NULL,'2019-02-25 22:48:45','2019-02-25 22:48:45'),
	(156,'nnn','qq','qq',NULL,'2019-02-25 22:50:09','2019-02-25 22:50:09'),
	(157,'nnnm','qq','qq',NULL,'2019-02-25 22:52:32','2019-02-25 22:52:32'),
	(158,'nnnm2','b7fa5b7246967c70a5a9e2348ab35d27a7482616','qq',NULL,'2019-02-25 22:54:08','2019-02-25 22:54:08'),
	(159,'uu','4fb2ed47de57c8a7e6c4f8b7d1665013f018453d','qq',NULL,'2019-02-25 22:54:45','2019-02-25 22:54:45'),
	(160,'uut','c92e4f018ebd34cffab1edc599c0d3daa2ef86f4','qq',NULL,'2019-02-25 22:54:54','2019-02-25 22:54:54'),
	(161,'uutm','cf91ae68fd6385b0a63f0ef1760134f3adcb6f96','qq',NULL,'2019-02-25 23:08:37','2019-02-25 23:08:37'),
	(162,'q','cd7a138fef55541195b2470f32b6b314aecbd8ac','q',NULL,'2019-02-26 00:08:07','2019-02-26 00:08:07'),
	(164,'qmmmmm','0dad370a964e9030a99ec9740743424e006f13a1','q',NULL,'2019-02-26 00:10:13','2019-02-26 00:10:13'),
	(166,'qmmmmmx','25e7fe19a13ea9257077c17f69e80631ba04a052','q',NULL,'2019-02-26 00:11:11','2019-02-26 00:11:11'),
	(167,'xxxx','df4d8c24e67b9e78d498d7dd94859fda107a282b','q',NULL,'2019-02-26 00:23:05','2019-02-26 00:23:05'),
	(169,'っc','92fae7e8e117c9ceb023af759e1f92c971b0e45c','c',NULL,'2019-02-26 10:26:17','2019-02-26 10:26:17'),
	(170,'あああ','1779cabfe19a8ce15b877e098fe5723a537b0f77','あああ',NULL,'2019-02-26 11:23:30','2019-02-26 11:23:30'),
	(171,'kk','53f9f7de6f183fc100832cf2cbda816fbf124c02','kk',NULL,'2019-02-26 12:03:37','2019-02-26 12:03:37'),
	(172,'ddd','','ddd',NULL,'2019-02-26 14:00:07','2019-02-26 14:00:07'),
	(173,'ssss','','ddd',NULL,'2019-02-26 14:01:06','2019-02-26 14:01:06'),
	(174,'ssssss','','ddd',NULL,'2019-02-26 14:02:41','2019-02-26 14:02:41'),
	(175,'ssssssh','ddd','ddd',NULL,'2019-02-26 14:17:45','2019-02-26 14:17:45'),
	(176,'sssssshj','','ddd',NULL,'2019-02-26 14:22:18','2019-02-26 14:22:18'),
	(177,'sssssshjg','76002bddced87157607d6db35da5a74df1bb610c','ddd',NULL,'2019-02-26 14:23:27','2019-02-26 14:23:27'),
	(178,'sssssshjgr','','ddd',NULL,'2019-02-26 14:23:57','2019-02-26 14:23:57'),
	(180,'vvv','a28e25e50983a8c632275daed27e30a3ecda88c3','ddd',NULL,'2019-02-26 14:31:00','2019-02-26 14:31:00'),
	(183,'vvvllllll','4f866632102958500c9cdfd727ae29447b6134e7','ddd',NULL,'2019-02-26 14:32:31','2019-02-26 14:32:31'),
	(184,'vvvllllllnnnn','1db0b6bbdcc66b587e85c9740c74f9313442724c','ddd',NULL,'2019-02-26 14:32:45','2019-02-26 14:32:45'),
	(185,'kkk','b94fdc59cca5be3a8cd8337cde8d258fc98914fd','kkk',NULL,'2019-02-26 14:33:23','2019-02-26 14:33:23'),
	(186,'bbb','87655da46fd72da5a9c6cec51dd7176645275788','bbb',NULL,'2019-02-26 14:43:00','2019-02-26 14:43:00'),
	(187,'vvvvvv','6fa5fa95e2495140a7f55a8f5afa7c7ca272a692','',NULL,'2019-02-26 14:52:06','2019-02-26 14:52:06'),
	(188,'x','7c1f8bae7eb1895ccc74c8ab131473fe7eeeca3b','s',NULL,'2019-02-26 15:27:30','2019-02-26 15:27:30'),
	(189,'pppppp','0f6c9ccbc32ea6d9ca6ea128a7505c4e37a250b3','kkk',NULL,'2019-02-27 12:07:14','2019-02-27 12:07:14'),
	(190,'aaaa','6996fae8f9fc50cbf0bc7a624af02c9a713aaf51','aaaa',NULL,'2019-02-27 12:31:59','2019-02-27 12:31:59'),
	(191,'z','d9c653eefa28af50c9efb34df0981e7551069f35','z',NULL,'2019-02-27 16:47:45','2019-02-27 16:47:45'),
	(192,'lllllll','101af105db13f84c3b959e5a03c9e7643e01404b','q',NULL,'2019-02-28 11:13:56','2019-02-28 11:13:56'),
	(193,'rrr','f8614eb1ac155d323d9d797c97d91c257a73fe3e','vvv',NULL,'2019-02-28 14:51:02','2019-02-28 14:51:02'),
	(194,'nnnnnn','8c855842ff4b90fc180c27c23178242a1b9932e6','kkk',NULL,'2019-03-02 13:58:16','2019-03-02 13:58:16');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL COMMENT '管理者id',
  `objective_id` int(10) NOT NULL COMMENT '目標id',
  `comment` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'コメント本文',
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='コメントテーブル';

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `admin_id`, `objective_id`, `comment`, `deleted`, `created`, `modified`)
VALUES
	(1,1,1,'コメント',NULL,'2019-02-20 16:54:48','2019-02-20 16:54:48');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


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
  PRIMARY KEY (`id`)
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
