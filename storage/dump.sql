# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17)
# Database: ninja-media-script-2-v
# Generation Time: 2017-12-27 03:06:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`, `slug`, `order`, `created_at`, `updated_at`)
VALUES
	(1,'Uncategorized','uncategorized',33,'2013-10-24 16:41:57','2014-01-28 15:25:19'),
	(2,'Animals','animals',1,'2013-10-18 15:57:00','2014-01-28 15:45:25'),
	(25,'News','news',24,'2013-10-24 16:40:46','2013-10-24 16:40:46'),
	(29,'Sports','sports',31,'2013-10-24 16:41:30','2014-01-26 17:22:09'),
	(31,'Comics','comics',18,'2014-01-28 14:59:34','2014-01-28 16:00:58'),
	(32,'Cartoon','cartoon',3,'2014-01-28 15:25:09','2014-01-28 15:25:09'),
	(33,'Music','music',22,'2014-01-28 15:44:11','2014-01-28 15:44:11'),
	(34,'Architecture','architecture',2,'2014-01-28 15:45:15','2014-01-28 15:45:31'),
	(35,'Film','film',20,'2014-01-28 16:00:22','2014-01-28 16:00:22'),
	(36,'Family','family',19,'2014-01-28 16:01:08','2014-01-28 16:01:08'),
	(37,'Comedy','comedy',13,'2014-01-31 04:11:41','2014-01-31 04:11:41'),
	(38,'Vehicles','vehicles',38,'2014-01-31 04:20:05','2014-01-31 04:20:05'),
	(39,'Food','food',21,'2014-01-31 04:46:00','2014-01-31 04:46:00'),
	(40,'Retro','retro',25,'2014-02-04 04:38:23','2017-12-23 05:02:56');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comment_flags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment_flags`;

CREATE TABLE `comment_flags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comment_flags_comment_id_foreign` (`comment_id`),
  KEY `comment_flags_user_id_foreign` (`user_id`),
  CONSTRAINT `comment_flags_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_flags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table comment_votes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment_votes`;

CREATE TABLE `comment_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `up` tinyint(1) NOT NULL DEFAULT '0',
  `down` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comment_votes_comment_id_foreign` (`comment_id`),
  KEY `comment_votes_user_id_foreign` (`user_id`),
  CONSTRAINT `comment_votes_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table data_rows
# ------------------------------------------------------------

DROP TABLE IF EXISTS `data_rows`;

CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`)
VALUES
	(14,2,'id','number','id',1,0,0,0,0,0,'',1),
	(15,2,'author_id','text','author_id',1,0,0,0,0,0,'',2),
	(16,2,'title','text','title',1,1,1,1,1,1,'',3),
	(17,2,'excerpt','text_area','excerpt',0,0,0,0,0,1,'',4),
	(18,2,'body','rich_text_box','body',0,0,1,1,1,1,'',5),
	(19,2,'slug','text','slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\"}}',6),
	(20,2,'meta_description','text','meta description',0,0,1,1,1,1,'',7),
	(21,2,'meta_keywords','text','meta_keywords',0,0,0,0,0,1,'',8),
	(22,2,'status','select_dropdown','status',1,1,1,1,1,1,'{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}',9),
	(23,2,'created_at','timestamp','created_at',0,1,1,0,0,0,'',10),
	(24,2,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',11),
	(25,2,'image','image','image',0,0,0,0,0,1,'',12),
	(26,3,'id','number','id',1,0,0,0,0,0,'',1),
	(27,3,'name','text','name',1,1,1,1,1,1,'',2),
	(28,3,'email','text','email',1,1,1,1,1,1,'',3),
	(29,3,'password','password','password',0,0,0,1,1,0,'',4),
	(30,3,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"roles\",\"pivot\":\"0\"}',10),
	(31,3,'remember_token','text','remember_token',0,0,0,0,0,0,'',5),
	(32,3,'created_at','timestamp','created_at',0,1,1,0,0,0,'',6),
	(33,3,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',7),
	(34,3,'avatar','image','avatar',0,1,1,1,1,1,'',8),
	(35,5,'id','number','id',1,0,0,0,0,0,'',1),
	(36,5,'name','text','name',1,1,1,1,1,1,'',2),
	(37,5,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),
	(38,5,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),
	(39,4,'id','number','id',1,0,0,0,0,0,'',1),
	(40,4,'parent_id','select_dropdown','parent_id',0,0,1,1,1,1,'{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2),
	(41,4,'order','text','order',1,1,1,1,1,1,'{\"default\":1}',3),
	(42,4,'name','text','name',1,1,1,1,1,1,'',4),
	(43,4,'slug','text','slug',1,1,1,1,1,1,'{\"slugify\":{\"origin\":\"name\"}}',5),
	(44,4,'created_at','timestamp','created_at',0,0,1,0,0,0,'',6),
	(45,4,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',7),
	(46,6,'id','number','id',1,0,0,0,0,0,'',1),
	(47,6,'name','text','Name',1,1,1,1,1,1,'',2),
	(48,6,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),
	(49,6,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),
	(50,6,'display_name','text','Display Name',1,1,1,1,1,1,'',5),
	(53,3,'role_id','text','role_id',1,1,1,1,1,1,'',9),
	(54,8,'id','hidden','Id',1,0,0,0,0,0,'',1),
	(55,8,'user_id','select_dropdown','User Id',1,0,1,1,1,1,'',2),
	(56,8,'category_id','select_dropdown','Category Id',1,0,1,1,1,1,'',3),
	(57,8,'title','text','Title',1,1,1,1,1,1,'',4),
	(58,8,'slug','text','Slug',1,0,1,1,1,1,'',8),
	(59,8,'body','text_area','Description',0,0,1,1,1,1,'',9),
	(60,8,'active','checkbox','Active',1,0,1,1,1,1,'',7),
	(61,8,'vid','hidden','Vid',1,0,1,1,1,1,'',20),
	(62,8,'pic','hidden','Pic',1,0,1,1,1,1,'',21),
	(63,8,'pic_url','image','Pic Url',0,1,1,1,1,1,'',6),
	(64,8,'vid_url','text','Vid Url',0,0,1,1,1,1,'',10),
	(65,8,'link_url','hidden','Link Url',0,0,1,1,1,1,'',11),
	(66,8,'tags','text','Tags',0,0,1,1,1,1,'',12),
	(67,8,'created_at','timestamp','Created At',0,1,1,1,0,1,'',15),
	(68,8,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',19),
	(69,8,'nsfw','checkbox','Not Safe For Work',1,0,1,1,1,1,'',14),
	(70,8,'views','text','Views',1,0,1,1,1,1,'',16),
	(71,8,'pic_url_multi','hidden','Pic Url Multi',0,0,1,1,1,1,'',17),
	(72,8,'delete_img','hidden','Delete Img',0,0,1,1,1,1,'',18),
	(73,8,'post_belongsto_user_relationship','relationship','User',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"categories\",\"pivot\":\"0\"}',13),
	(74,8,'post_belongsto_category_relationship','relationship','categories',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\"}',5),
	(75,9,'id','checkbox','Id',1,0,0,0,0,0,'',1),
	(76,9,'user_id','select_dropdown','User Id',1,0,1,1,1,1,'',2),
	(77,9,'post_id','select_dropdown','Post',1,1,1,1,1,1,'',3),
	(78,9,'comment','text_area','Comment',1,1,1,1,1,1,'',5),
	(79,9,'created_at','timestamp','Created At',0,1,1,1,0,1,'',7),
	(80,9,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',8),
	(82,9,'comment_belongsto_post_relationship','relationship','Post',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Post\",\"table\":\"posts\",\"type\":\"belongsTo\",\"column\":\"post_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"categories\",\"pivot\":\"0\"}',4),
	(83,9,'comment_belongsto_user_relationship','relationship','User',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"categories\",\"pivot\":\"0\"}',6),
	(85,10,'id','checkbox','Id',1,0,0,0,0,0,'',1),
	(86,10,'user_id','checkbox','User Id',1,1,1,1,1,1,'',2),
	(87,10,'comment_id','checkbox','Comment Id',1,1,1,1,1,1,'',3),
	(88,10,'created_at','timestamp','Created At',0,1,1,1,0,1,'',6),
	(89,10,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',7),
	(90,10,'comment_flag_belongsto_comment_relationship','relationship','comment',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Comment\",\"table\":\"comments\",\"type\":\"belongsTo\",\"column\":\"comment_id\",\"key\":\"id\",\"label\":\"comment\",\"pivot_table\":\"categories\",\"pivot\":\"0\"}',4),
	(91,10,'comment_flag_belongsto_user_relationship','relationship','user',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"categories\",\"pivot\":\"0\"}',5);

/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table data_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `data_types`;

CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `created_at`, `updated_at`)
VALUES
	(2,'pages','pages','Page','Pages','voyager-file-text','TCG\\Voyager\\Models\\Page','','','',1,0,'2017-09-28 14:57:26','2017-12-26 14:55:41'),
	(3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy','','',1,0,'2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(4,'categories','categories','Category','Categories','voyager-categories','TCG\\Voyager\\Models\\Category',NULL,'','',1,0,'2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,'2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'','',1,0,'2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(8,'posts','posts','Post','Posts','voyager-photos','App\\Models\\Post','','','',1,1,'2017-09-28 21:07:38','2017-09-28 21:07:38'),
	(9,'comments','comments','Comment','Comments','voyager-bubble','App\\Models\\Comment','','','',1,0,'2017-12-18 13:51:17','2017-12-18 13:51:17'),
	(10,'comment_flags','comment-flags','Comment Flag','Comment Flags','voyager-warning','App\\Models\\CommentFlag','','','',1,0,'2017-12-23 05:16:46','2017-12-23 05:16:46');

/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menu_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu_items`;

CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`)
VALUES
	(1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2017-09-28 14:57:26','2017-09-28 14:57:26','voyager.dashboard',NULL),
	(2,1,'Media','','_self','voyager-images',NULL,NULL,9,'2017-09-28 14:57:26','2017-12-23 05:22:49','voyager.media.index',NULL),
	(3,1,'Posts','','_self','voyager-photos','#000000',NULL,2,'2017-09-28 14:57:26','2017-09-28 23:04:21','voyager.posts.index','null'),
	(4,1,'Users','','_self','voyager-person',NULL,NULL,7,'2017-09-28 14:57:26','2017-12-23 05:22:49','voyager.users.index',NULL),
	(5,1,'Categories','','_self','voyager-categories',NULL,NULL,6,'2017-09-28 14:57:26','2017-12-23 05:22:49','voyager.categories.index',NULL),
	(6,1,'Pages','','_self','voyager-file-text',NULL,NULL,5,'2017-09-28 14:57:26','2017-12-23 05:22:49','voyager.pages.index',NULL),
	(7,1,'Roles','','_self','voyager-lock',NULL,NULL,8,'2017-09-28 14:57:26','2017-12-23 05:22:49','voyager.roles.index',NULL),
	(8,1,'Tools','','_self','voyager-tools',NULL,NULL,11,'2017-09-28 14:57:26','2017-12-23 05:22:49',NULL,NULL),
	(9,1,'Menu Builder','','_self','voyager-list',NULL,8,1,'2017-09-28 14:57:26','2017-09-28 23:06:07','voyager.menus.index',NULL),
	(10,1,'Database','','_self','voyager-data',NULL,8,2,'2017-09-28 14:57:26','2017-09-28 23:06:07','voyager.database.index',NULL),
	(11,1,'Compass','/admin/compass','_self','voyager-compass',NULL,8,3,'2017-09-28 14:57:26','2017-09-28 23:06:07',NULL,NULL),
	(12,1,'Hooks','/admin/hooks','_self','voyager-hook',NULL,8,4,'2017-09-28 14:57:26','2017-09-28 23:06:07',NULL,NULL),
	(13,1,'Settings','','_self','voyager-settings',NULL,NULL,12,'2017-09-28 14:57:26','2017-12-23 05:22:49','voyager.settings.index',NULL),
	(14,1,'Themes','/admin/themes','_self','voyager-paint-bucket',NULL,NULL,10,'2017-09-28 22:57:30','2017-12-23 05:22:49',NULL,NULL),
	(15,2,'Home','/','_self','fa fa-home','#000000',NULL,1,'2017-12-14 17:45:26','2017-12-14 17:47:24',NULL,''),
	(16,2,'Popular','/#_','_self','fa fa-star','#000000',NULL,2,'2017-12-14 17:45:59','2017-12-14 17:47:24',NULL,''),
	(17,2,'for the Week','/popular/week','_self','','#000000',16,1,'2017-12-14 17:46:48','2017-12-14 20:39:11',NULL,''),
	(18,2,'for the Month','/popular/month','_self','','#000000',16,2,'2017-12-14 17:46:59','2017-12-14 17:47:25',NULL,''),
	(19,2,'for the Year','/popular/year','_self','','#000000',16,3,'2017-12-14 17:47:10','2017-12-14 17:47:28',NULL,''),
	(20,2,'All Time','/popular','_self','','#000000',16,4,'2017-12-14 17:47:21','2017-12-14 17:47:29',NULL,''),
	(21,2,'Categories','/#_','_self','fa fa-list','#000000',NULL,3,'2017-12-14 17:48:05','2017-12-14 17:48:48',NULL,''),
	(22,2,'Animals','/category/animals','_self','','#000000',21,1,'2017-12-14 17:48:29','2017-12-14 17:48:48',NULL,''),
	(23,2,'Architecture','/category/architecture','_self','','#000000',21,2,'2017-12-14 17:48:43','2017-12-14 17:48:50',NULL,''),
	(24,2,'Cartoon','/category/cartoon','_self','','#000000',21,3,'2017-12-14 17:49:06','2017-12-14 17:49:36',NULL,''),
	(25,2,'Comedy','/category/comedy','_self','','#000000',21,4,'2017-12-14 17:49:25','2017-12-14 17:49:37',NULL,''),
	(26,2,'Comics','/category/comics','_self','','#000000',21,5,'2017-12-14 17:49:53','2017-12-14 17:51:51',NULL,''),
	(27,2,'Family','/category/family','_self','','#000000',21,6,'2017-12-14 17:50:05','2017-12-14 17:51:54',NULL,''),
	(28,2,'Film','/category/film','_self','','#000000',21,7,'2017-12-14 17:50:20','2017-12-14 17:51:55',NULL,''),
	(29,2,'Food','/category/food','_self','','#000000',21,8,'2017-12-14 17:50:31','2017-12-14 17:51:56',NULL,''),
	(30,2,'Music','/category/music','_self','','#000000',21,9,'2017-12-14 17:50:42','2017-12-14 17:51:58',NULL,''),
	(31,2,'News','/category/news','_self','','#000000',21,10,'2017-12-14 17:50:56','2017-12-14 17:51:59',NULL,''),
	(32,2,'Retro','/category/retro','_self','','#000000',21,11,'2017-12-14 17:51:08','2017-12-14 17:52:00',NULL,''),
	(33,2,'Sports','/category/sports','_self','','#000000',21,12,'2017-12-14 17:51:20','2017-12-14 17:52:01',NULL,''),
	(34,2,'Uncategorized','/category/uncategorized','_self','','#000000',21,13,'2017-12-14 17:51:35','2017-12-14 17:52:02',NULL,''),
	(35,2,'Vehicles','/category/vehicles','_self','','#000000',21,14,'2017-12-14 17:51:46','2017-12-14 17:52:03',NULL,''),
	(36,1,'Comments','/admin/comments','_self','voyager-bubble',NULL,NULL,3,'2017-12-18 13:51:18','2017-12-18 13:56:34',NULL,NULL),
	(37,1,'Comment Flags','/admin/comment-flags','_self','voyager-warning',NULL,NULL,4,'2017-12-23 05:16:46','2017-12-23 05:22:49',NULL,NULL),
	(38,2,'More','#_','_self','fa fa-diamond','#000000',NULL,4,'2017-12-26 14:34:10','2017-12-26 14:59:58',NULL,''),
	(39,2,'Leaderboard','/leaderboard','_self','voyager-star','#000000',38,2,'2017-12-26 14:34:52','2017-12-26 15:06:31',NULL,''),
	(40,2,'Contact','/page/contact','_self','','#000000',38,1,'2017-12-26 15:06:27','2017-12-26 15:06:31',NULL,'');

/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'admin','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(2,'main','2017-12-14 17:44:59','2017-12-14 17:44:59');

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2016_01_01_000000_add_voyager_user_fields',1),
	(4,'2016_01_01_000000_create_data_types_table',1),
	(5,'2016_01_01_000000_create_pages_table',1),
	(6,'2016_01_01_000000_create_posts_table',1),
	(7,'2016_02_15_204651_create_categories_table',1),
	(8,'2016_05_19_173453_create_menu_table',1),
	(9,'2016_10_21_190000_create_roles_table',1),
	(10,'2016_10_21_190000_create_settings_table',1),
	(11,'2016_11_30_135954_create_permission_table',1),
	(12,'2016_11_30_141208_create_permission_role_table',1),
	(13,'2016_12_26_201236_data_types__add__server_side',1),
	(14,'2017_01_13_000000_add_route_to_menu_items_table',1),
	(15,'2017_01_14_005015_create_translations_table',1),
	(16,'2017_01_15_000000_add_permission_group_id_to_permissions_table',1),
	(17,'2017_01_15_000000_create_permission_groups_table',1),
	(18,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),
	(19,'2017_03_06_000000_add_controller_to_data_types_table',1),
	(20,'2017_04_11_000000_alter_post_nullable_fields_table',1),
	(21,'2017_04_21_000000_add_order_to_data_rows_table',1),
	(22,'2017_07_05_210000_add_policyname_to_data_types_table',1),
	(23,'2017_08_05_000000_add_group_to_settings_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `is_read` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table oauth_facebook
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth_facebook`;

CREATE TABLE `oauth_facebook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `oauth_userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `oauth_facebook_user_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table oauth_google
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth_google`;

CREATE TABLE `oauth_google` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `oauth_userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `oauth_google_user_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8_unicode_ci,
  `body` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`)
VALUES
	(2,1,'Contact',NULL,'<p>This is the contact page and you can add pages like this and many other pages inside of the Ninja Media Script Admin dashboard. Simply go to (yoursite.com/admin) and once you have logged in you can visit the page section from the left navigation.</p>\r\n<p>From there you can choose to Add, Edit, Delete any pages.</p>\r\n<p>Remember after you have added the page to your site you may also need to add a link to the page in the Menu Builder.</p>\r\n<p>Thanks again for using Ninja Media Script.</p>\r\n<p>&nbsp;</p>\r\n<h3>Need Support?</h3>\r\n<p>If you are inquiring about contacting Support for this script please visit our forums at <a href=\"https://devdojo.com/forums\" target=\"_blank\" rel=\"noopener noreferrer\">https://devdojo.com/forums</a></p>\r\n<p>-DevDojo</p>',NULL,'contact','Contact Page',NULL,'ACTIVE','2017-12-26 14:58:08','2017-12-26 15:18:20');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;

INSERT INTO `password_resets` (`email`, `token`, `created_at`)
VALUES
	('tnylea@gmail.com','$2y$10$j6YJaJoHkCFOBiB9DJEMfOzi3O7RyMAQ81l2Xun9JycEmj3KxLrci','2017-12-23 21:48:10');

/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permission_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_groups`;

CREATE TABLE `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;

INSERT INTO `permission_role` (`permission_id`, `role_id`)
VALUES
	(1,1),
	(2,1),
	(3,1),
	(4,1),
	(5,1),
	(6,1),
	(7,1),
	(8,1),
	(9,1),
	(10,1),
	(11,1),
	(12,1),
	(13,1),
	(14,1),
	(15,1),
	(16,1),
	(17,1),
	(18,1),
	(19,1),
	(20,1),
	(21,1),
	(22,1),
	(23,1),
	(24,1),
	(30,1),
	(31,1),
	(32,1),
	(33,1),
	(34,1),
	(35,1),
	(36,1),
	(37,1),
	(38,1),
	(39,1),
	(40,1),
	(41,1),
	(42,1),
	(43,1),
	(44,1),
	(45,1),
	(46,1),
	(47,1),
	(48,1),
	(49,1),
	(50,1),
	(51,1),
	(52,1),
	(53,1),
	(54,1),
	(55,1);

/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `permission_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`, `permission_group_id`)
VALUES
	(1,'browse_admin',NULL,'2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(2,'browse_database',NULL,'2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(3,'browse_media',NULL,'2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(4,'browse_compass',NULL,'2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(5,'browse_menus','menus','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(6,'read_menus','menus','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(7,'edit_menus','menus','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(8,'add_menus','menus','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(9,'delete_menus','menus','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(10,'browse_pages','pages','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(11,'read_pages','pages','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(12,'edit_pages','pages','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(13,'add_pages','pages','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(14,'delete_pages','pages','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(15,'browse_roles','roles','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(16,'read_roles','roles','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(17,'edit_roles','roles','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(18,'add_roles','roles','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(19,'delete_roles','roles','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(20,'browse_users','users','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(21,'read_users','users','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(22,'edit_users','users','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(23,'add_users','users','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(24,'delete_users','users','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(30,'browse_categories','categories','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(31,'read_categories','categories','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(32,'edit_categories','categories','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(33,'add_categories','categories','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(34,'delete_categories','categories','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(35,'browse_settings','settings','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(36,'read_settings','settings','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(37,'edit_settings','settings','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(38,'add_settings','settings','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(39,'delete_settings','settings','2017-09-28 14:57:26','2017-09-28 14:57:26',NULL),
	(40,'browse_posts','posts','2017-09-28 21:07:38','2017-09-28 21:07:38',NULL),
	(41,'read_posts','posts','2017-09-28 21:07:38','2017-09-28 21:07:38',NULL),
	(42,'edit_posts','posts','2017-09-28 21:07:38','2017-09-28 21:07:38',NULL),
	(43,'add_posts','posts','2017-09-28 21:07:38','2017-09-28 21:07:38',NULL),
	(44,'delete_posts','posts','2017-09-28 21:07:38','2017-09-28 21:07:38',NULL),
	(45,'browse_themes','admin','2017-09-28 22:57:30','2017-09-28 22:57:30',NULL),
	(46,'browse_comments','comments','2017-12-18 13:51:17','2017-12-18 13:51:17',NULL),
	(47,'read_comments','comments','2017-12-18 13:51:17','2017-12-18 13:51:17',NULL),
	(48,'edit_comments','comments','2017-12-18 13:51:17','2017-12-18 13:51:17',NULL),
	(49,'add_comments','comments','2017-12-18 13:51:17','2017-12-18 13:51:17',NULL),
	(50,'delete_comments','comments','2017-12-18 13:51:17','2017-12-18 13:51:17',NULL),
	(51,'browse_comment_flags','comment_flags','2017-12-23 05:16:46','2017-12-23 05:16:46',NULL),
	(52,'read_comment_flags','comment_flags','2017-12-23 05:16:46','2017-12-23 05:16:46',NULL),
	(53,'edit_comment_flags','comment_flags','2017-12-23 05:16:46','2017-12-23 05:16:46',NULL),
	(54,'add_comment_flags','comment_flags','2017-12-23 05:16:46','2017-12-23 05:16:46',NULL),
	(55,'delete_comment_flags','comment_flags','2017-12-23 05:16:46','2017-12-23 05:16:46',NULL);

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table points
# ------------------------------------------------------------

DROP TABLE IF EXISTS `points`;

CREATE TABLE `points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `points` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `points_user_id_foreign` (`user_id`),
  CONSTRAINT `points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table post_flags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_flags`;

CREATE TABLE `post_flags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_flags_post_id_foreign` (`post_id`),
  KEY `post_flags_user_id_foreign` (`user_id`),
  CONSTRAINT `post_flags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_flags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table post_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_likes`;

CREATE TABLE `post_likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_likes_post_id_foreign` (`post_id`),
  KEY `post_likes_user_id_foreign` (`user_id`),
  CONSTRAINT `post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `vid` tinyint(1) NOT NULL DEFAULT '0',
  `pic` tinyint(1) NOT NULL DEFAULT '1',
  `pic_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vid_url` text COLLATE utf8_unicode_ci,
  `link_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nsfw` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `pic_url_multi` text COLLATE utf8_unicode_ci,
  `delete_img` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `slug`, `body`, `active`, `vid`, `pic`, `pic_url`, `vid_url`, `link_url`, `tags`, `created_at`, `updated_at`, `nsfw`, `views`, `pic_url_multi`, `delete_img`)
VALUES
	(94,1,1,'What would you do?','what-would-you-do','',1,0,1,'posts/December2013/what_would_you_do.jpg',NULL,'','','2013-12-27 17:27:31','2014-01-30 22:15:53',0,0,NULL,NULL),
	(95,1,1,'Google Fridge','google-fridge','',1,0,1,'posts/December2013/google-egg-fridge.jpg',NULL,'','','2013-12-27 17:29:21','2014-01-30 22:15:53',0,0,NULL,NULL),
	(96,1,39,'Hamburger Helper','hamburger-helper','',1,0,1,'posts/December2013/hamburger-helper.jpg',NULL,'','','2013-12-27 17:30:03','2014-02-08 17:34:01',0,0,NULL,NULL),
	(97,1,39,'Lies','lies','',1,0,1,'posts/December2013/lies.jpg',NULL,'','','2013-12-27 17:30:40','2017-12-10 14:45:20',0,1,NULL,NULL),
	(98,1,1,'Tips-n-Tricks','tips-n-tricks','',1,0,1,'posts/December2013/tips-n-tricks.jpg',NULL,'','','2013-12-27 17:31:04','2014-01-30 22:15:53',0,0,NULL,NULL),
	(99,1,39,'This Just in...','this-just-in','',1,0,1,'posts/December2013/cheeseburger-stabbing.jpg',NULL,'','','2013-12-27 17:31:42','2014-02-08 17:34:25',0,0,NULL,NULL),
	(100,1,1,'Hold My Calls','hold-my-calls','',1,0,1,'posts/December2013/hold-my-calls.jpg',NULL,'','','2013-12-27 17:34:29','2014-01-30 22:15:53',0,0,NULL,NULL),
	(101,1,1,'Welcome To The Jungle','welcome-to-the-jungle','',1,0,1,'posts/December2013/welcome_to_the_jungle.jpg',NULL,'','','2013-12-27 17:34:57','2014-01-30 22:15:53',0,0,NULL,NULL),
	(102,1,1,'Will this be on the test?','will-this-be-on-the-test','',1,0,1,'posts/December2013/test-blackboard.jpg',NULL,'','','2013-12-27 17:35:19','2014-01-30 22:15:53',0,0,NULL,NULL),
	(103,1,2,'Just keep on smilin fatty','just-keep-on-smilin-fatty','',1,0,1,'posts/December2013/just_keep_smilin_fatty.jpg',NULL,'','','2013-12-27 17:40:47','2014-02-08 17:35:45',0,0,NULL,NULL),
	(104,1,1,'Choose your own adventure','choose-your-own-adventure','',1,0,1,'posts/December2013/choose_your_own_adventure.jpg',NULL,'','','2013-12-27 17:41:34','2014-01-30 22:15:53',0,0,NULL,NULL),
	(105,1,1,'Keep up the adequate work!','keep-up-the-adequate-work','',1,0,1,'posts/December2013/adequate_work.jpg',NULL,'','','2013-12-27 17:41:52','2014-01-30 22:15:53',0,0,NULL,NULL),
	(106,1,1,'Hey Ladies...','hey-ladies','',1,0,1,'posts/December2013/hey_ladies.jpg',NULL,'','','2013-12-27 17:42:10','2014-01-30 22:15:53',0,0,NULL,NULL),
	(107,1,1,'A Case of the Mondays','a-case-of-the-mondays','',1,0,1,'posts/December2013/filled_with_excitement.jpg',NULL,'','','2013-12-27 17:42:33','2014-01-30 22:15:53',0,0,NULL,NULL),
	(108,1,1,'Be Honest Now','be-honest-now','',1,0,1,'posts/December2013/be_honest_now.jpg',NULL,'','','2013-12-27 17:43:00','2014-01-30 22:15:53',0,0,NULL,NULL),
	(109,1,1,'Meet Your New Cubemate','meet-your-new-cubemate','',1,0,1,'posts/December2013/cubemate_small.jpg',NULL,'','','2013-12-27 17:47:17','2014-01-30 22:15:53',0,0,NULL,NULL),
	(110,1,1,'Those Bastards','those-bastards','',1,0,1,'posts/December2013/piano_robot.jpg',NULL,'','','2013-12-27 17:47:39','2014-01-30 22:15:53',0,0,NULL,NULL),
	(112,1,1,'Is this a problem these days?','is-this-a-problem-these-days','',1,0,1,'posts/December2013/is-this-a-problem-these-days.jpg',NULL,'','','2013-12-28 02:51:52','2014-01-30 22:15:53',0,0,NULL,NULL),
	(113,1,1,'Defense','defense','',1,0,1,'posts/December2013/defense.jpg',NULL,'','','2013-12-28 02:52:07','2017-12-21 23:10:42',0,1,NULL,NULL),
	(114,1,1,'Ooops Sorry','ooops-sorry','',1,0,1,'posts/December2013/ooops-sorry.jpg',NULL,'','','2013-12-28 02:52:23','2014-01-30 22:15:53',0,0,NULL,NULL),
	(115,1,1,'The day I lost control...','the-day-i-lost-control','',1,0,1,'posts/December2013/the-day-i-lost-control.jpg',NULL,'','','2013-12-28 02:52:48','2014-01-30 22:15:53',0,0,NULL,NULL),
	(116,1,1,'What I remember most about LEGOs','what-i-remember-most-about-legos','',1,0,1,'posts/December2013/what-i-remember-most-about-legos.jpg',NULL,'','','2013-12-28 02:53:01','2017-12-16 21:41:58',0,1,NULL,NULL),
	(117,1,1,'Tea Submarine','tea-submarine','',1,0,1,'posts/December2013/tea-submarine.jpg',NULL,'','','2013-12-28 02:53:28','2014-01-30 22:15:53',0,0,NULL,NULL),
	(118,1,1,'Do we have a problem?','do-we-have-a-problem','',1,0,1,'posts/December2013/do-we-have-a-problem.jpg',NULL,'','','2013-12-28 02:53:44','2014-01-30 22:15:53',0,0,NULL,NULL),
	(119,1,1,'Simplest rubiks cube solution','simplest-rubiks-cube-solution','',1,0,1,'posts/December2013/simplest-rubiks-cube-solution.jpg',NULL,'','','2013-12-28 03:03:45','2014-01-30 22:15:53',0,0,NULL,NULL),
	(120,1,1,'IMPOSTER!','imposter','',1,0,1,'posts/December2013/imposter.jpg',NULL,'','','2013-12-28 03:04:03','2014-01-30 22:15:53',0,0,NULL,NULL),
	(121,1,1,'Life is just a game.','life-is-just-a-game','',1,0,1,'posts/December2013/life-is-just-a-game.jpg',NULL,'','','2013-12-28 03:04:22','2014-01-30 22:15:53',0,0,NULL,NULL),
	(122,1,1,'Pepsi Vs. Coke','pepsi-vs-coke','',1,0,1,'posts/December2013/pepsi-vs-coke.jpg',NULL,'','','2013-12-28 03:04:52','2014-01-30 22:15:54',0,0,NULL,NULL),
	(123,1,1,'Shadow Faces','shadow-faces','',1,0,1,'posts/December2013/shadow-faces.jpg',NULL,'','','2013-12-28 03:05:08','2014-01-30 22:15:54',0,0,NULL,NULL),
	(124,1,1,'Oh Google...','oh-google','',1,0,1,'posts/December2013/oh-google.jpg',NULL,'','','2013-12-28 03:05:23','2014-01-30 22:15:54',0,0,NULL,NULL),
	(125,1,1,'Poker is not for everyone','poker-is-not-for-everyone','',1,0,1,'posts/December2013/poker-is-not-for-everyone.jpg',NULL,'','','2013-12-28 03:05:49','2014-01-30 22:15:54',0,0,NULL,NULL),
	(126,1,1,'In case of nothing to do...','in-case-of-nothing-to-do','',1,0,1,'posts/December2013/in-case-of-nothing-to-do.jpg',NULL,'','','2013-12-28 03:06:03','2014-01-30 22:15:54',0,0,NULL,NULL),
	(127,1,1,'Life was much easier...','life-was-much-easier','',1,0,1,'posts/December2013/life-was-much-easier.jpg',NULL,'','','2013-12-28 03:06:19','2014-01-30 22:15:54',0,0,NULL,NULL),
	(128,1,1,'well played son, well played','well-played-son-well-played','',1,0,1,'posts/December2013/well-played-son-well-played.jpg',NULL,'','','2013-12-28 03:06:35','2017-12-10 14:41:47',0,1,NULL,NULL),
	(129,1,1,'Seat Savers','seat-savers','',1,0,1,'posts/December2013/seat-savers.jpg',NULL,'','','2013-12-28 03:06:52','2014-01-30 22:15:54',0,0,NULL,NULL),
	(130,1,1,'Harry Potter on Facebook','harry-potter-on-facebook','',1,0,1,'posts/December2013/harry-potter-on-facebook.jpg',NULL,'','','2013-12-28 03:07:01','2014-01-30 22:15:54',0,0,NULL,NULL),
	(131,1,1,'Donuts\\\' escalator','donuts-escalator','',1,0,1,'posts/December2013/donuts-escalator.jpg',NULL,'','','2013-12-28 03:07:16','2014-01-30 22:15:54',0,0,NULL,NULL),
	(132,1,1,'Ctrl-V, Ctrl-X, Ctrl-Z','ctrl-v-ctrl-x-ctrl-z','',1,0,1,'posts/December2013/ctrl-v-ctrl-x-ctrl-z.jpg',NULL,'','','2013-12-28 03:07:29','2014-01-30 22:15:54',0,0,NULL,NULL),
	(133,1,1,'Cleverness','cleverness','',1,0,1,'posts/December2013/cleverness.jpg',NULL,'','','2013-12-28 03:08:13','2014-01-30 22:15:54',0,0,NULL,NULL),
	(134,1,1,'If condoms had sponsors','if-condoms-had-sponsors','',1,0,1,'posts/December2013/if-condoms-had-sponsors.jpg',NULL,'','','2013-12-28 03:08:42','2014-01-30 22:15:54',0,0,NULL,NULL),
	(135,1,1,'Eggregation','eggregation','',1,0,1,'posts/December2013/eggregation.jpg',NULL,'','','2013-12-28 03:08:53','2014-01-30 22:15:54',0,0,NULL,NULL),
	(136,1,1,'Banana Bedtime','banana-bedtime','',1,0,1,'posts/December2013/banana-bedtime.jpg',NULL,'','','2013-12-28 03:09:11','2017-12-21 05:52:16',0,1,NULL,NULL),
	(137,1,1,'Just Dream :)','just-dream','',1,0,1,'posts/December2013/just-dream.jpg',NULL,'','','2013-12-28 03:09:25','2014-01-30 22:15:54',0,0,NULL,NULL),
	(138,1,1,'Formula of iPad','formula-of-ipad','',1,0,1,'posts/December2013/formula-of-ipad.jpg',NULL,'','','2013-12-28 15:32:42','2014-01-30 22:15:54',0,0,NULL,NULL),
	(139,1,1,'How to draw an owl','how-to-draw-an-owl','',1,0,1,'posts/December2013/how-to-draw-an-owl.jpg',NULL,'','','2013-12-28 15:33:10','2014-01-30 22:15:54',0,0,NULL,NULL),
	(140,1,1,'FALLING (in love) ROCKS','falling-in-love-rocks','',1,0,1,'posts/December2013/falling-in-love-rocks.jpg',NULL,'','','2013-12-28 15:33:30','2014-01-30 22:15:54',0,0,NULL,NULL),
	(141,1,1,'That\\\'s my plan','that-s-my-plan','',1,0,1,'posts/December2013/thats-my-plan.jpg',NULL,'','','2013-12-28 15:33:48','2014-01-30 22:15:54',0,0,NULL,NULL),
	(142,1,1,'What the flip...','what-the-flip','',1,0,1,'posts/December2013/what-the-flip.jpg',NULL,'','','2013-12-28 15:34:17','2014-01-30 22:15:54',0,0,NULL,NULL),
	(143,1,1,'Blood Puddle Pillows','blood-puddle-pillows','',1,0,1,'posts/December2013/blood-puddle-pillows.jpg',NULL,'','','2013-12-28 15:36:03','2014-01-30 22:15:54',0,0,NULL,NULL),
	(144,1,31,'Play Outside','play-outside','',1,0,1,'posts/December2013/play-outside.jpg',NULL,'','','2013-12-28 15:36:23','2017-12-07 14:16:10',0,1,NULL,NULL),
	(145,1,1,'Uses of Google','uses-of-google','',1,0,1,'posts/December2013/uses-of-google.jpg',NULL,'','','2013-12-28 15:36:38','2014-01-30 22:15:54',0,0,NULL,NULL),
	(146,1,1,'Heavy Metal','heavy-metal','',1,0,1,'posts/December2013/heavy-metal.jpg',NULL,'','','2013-12-28 15:37:02','2014-01-30 22:15:54',0,0,NULL,NULL),
	(147,1,1,'Check out what I can do...','check-out-what-i-can-do','',1,0,1,'posts/December2013/check-out-what-i-can-do.jpg',NULL,'','','2013-12-28 15:37:22','2014-01-30 22:15:54',0,0,NULL,NULL),
	(148,1,1,'Bitchin','bitchin','',1,0,1,'posts/December2013/bitchin.jpg',NULL,'','','2013-12-28 15:37:40','2017-12-16 04:14:19',0,1,NULL,NULL),
	(149,1,1,'Passport!','passport','',1,0,1,'posts/December2013/passport.jpg',NULL,'','','2013-12-28 15:37:54','2014-01-30 22:15:54',0,0,NULL,NULL),
	(150,1,1,'Say goodbye to your friends and get in the car...','say-goodbye-to-your-friends-and-get-in-the-car','',1,0,1,'posts/December2013/say-goodbye-to-your-friends-and-get-in-the-car.jpg',NULL,'','','2013-12-28 15:38:09','2014-01-30 22:15:54',0,0,NULL,NULL),
	(151,1,1,'Kitty Ping Pong','kitty-ping-pong','',1,0,1,'posts/January2014/kitty-gif.gif','','','funny,kitty,ping pong,cute','2014-01-04 04:01:29','2014-01-30 22:15:54',0,0,NULL,NULL),
	(152,1,1,'Cool Ball Flip','cool-ball-flip','',1,0,1,'posts/January2014/cool-ball-flip.gif','','','gif,cool ball flip,exercise ball','2014-01-04 05:10:10','2017-10-18 20:59:24',0,1,NULL,NULL),
	(153,1,1,'Alone In The Dark','alone-in-the-dark','',1,0,1,'posts/January2014/alone-in-the-dark.jpg','','','funny,black guys','2014-01-04 05:12:40','2014-01-30 22:15:54',0,0,NULL,NULL),
	(154,1,1,'Freedom of Speech','freedom-of-speech','',1,0,1,'posts/January2014/freedom-of-speech.jpg','','','freedom of speech,kids drawing,homework','2014-01-04 05:14:13','2014-01-30 22:15:54',0,0,NULL,NULL),
	(156,1,1,'Rainbow in your hand','rainbow-in-your-hand','',1,0,1,'posts/January2014/rainbow-in-your-hand.jpg','','','rainbow,cards,flipcards','2014-01-04 05:16:19','2014-01-30 22:15:54',0,0,NULL,NULL),
	(157,1,1,'I need some space','i-need-some-space','',1,0,1,'posts/January2014/i-need-some-space.jpg','','','cartoon,keyboard,characters','2014-01-04 05:17:04','2014-01-30 22:15:54',0,0,NULL,NULL),
	(158,1,1,'It\\\'s too late...','it-s-too-late','',1,0,1,'posts/January2014/its-too-late.jpg','','','funny,food,egg,chicken','2014-01-04 05:18:06','2017-12-15 05:30:58',0,1,NULL,NULL),
	(159,1,1,'Pizza Cat','pizza-cat','',1,0,1,'posts/January2014/pizza-cat.jpg','','','pizza,food,cat','2014-01-04 05:18:51','2014-01-30 22:15:54',0,0,NULL,NULL),
	(160,1,1,'Space Saving Sofa Bed','space-saving-sofa-bed','',1,0,1,'posts/January2014/52ceb86074c03-space-saving-sofa-bed.jpg.jpg','','','couch,cool,space saving,transform','2014-01-09 14:55:28','2014-01-30 22:15:54',0,0,NULL,NULL),
	(162,1,1,'Guillotine Bowling Alley','guillotine-bowling-alley','',1,0,1,'posts/January2014/52ceb8f06dc47-guillotine-bowling-alley.jpg.jpg','','','guillotine,bowling','2014-01-09 14:57:52','2014-01-30 22:15:54',0,0,NULL,NULL),
	(163,1,1,'It\\\'s A Boy!','it-s-a-boy','',1,0,1,'posts/January2014/its-a-boy.jpg','','','card,funny,babies','2014-01-09 14:58:21','2014-01-30 22:15:54',0,0,NULL,NULL),
	(164,1,1,'Secrets of the Warp Whistle','secrets-of-the-warp-whistle','',1,0,1,'posts/January2014/secrets-of-the-warp-whistle.jpg','','','mario,warp whistle,games','2014-01-09 14:59:15','2017-12-15 05:24:07',0,1,NULL,NULL),
	(165,1,1,'A common work occurrence','a-common-work-occurrence','',1,0,1,'posts/January2014/a-common-work-occurrence.jpg','','','funny,computer,music','2014-01-09 15:00:16','2014-01-30 22:15:54',0,0,NULL,NULL),
	(166,1,1,'Real Life Cartoon Boy','real-life-cartoon-boy','',1,0,1,'posts/January2014/real-life-cartoon-boy.jpg','','','up,movie','2014-01-09 15:00:50','2014-01-30 22:15:54',0,0,NULL,NULL),
	(167,1,1,'Timone and Pumba','timone-and-pumba','',1,0,1,'posts/January2014/timone-and-pumba.jpg','','','lion king,timone,pumba','2014-01-09 15:01:18','2014-01-30 22:15:54',0,0,NULL,NULL),
	(168,1,1,'This is how phobias begin','this-is-how-phobias-begin','',1,0,1,'posts/January2014/this-is-how-phobias-begin.jpg','','','easter,creepy,phobias','2014-01-09 15:02:11','2017-12-11 06:47:13',0,1,NULL,NULL),
	(169,1,1,'Back in my day...','back-in-my-day','',1,0,1,'posts/January2014/back-in-my-day.jpg','','','ipod,music','2014-01-09 15:03:00','2016-01-04 13:36:17',0,2,NULL,NULL),
	(170,1,1,'Flower Skirt','flower-skirt','',1,0,1,'posts/January2014/flower-skirt.jpg','','','flower,skirt,flower skirt','2014-01-09 15:03:52','2014-01-30 22:15:54',0,0,NULL,NULL),
	(171,1,32,'This music smells funny','this-music-smells-funny','',1,0,1,'posts/January2014/this-music-smells-funny.jpg','','','simpsons,cartoon,funny','2014-01-28 15:26:02','2014-01-30 22:15:54',0,0,NULL,NULL),
	(172,1,2,'Light me up!','light-me-up','',1,0,1,'posts/January2014/light-me-up.jpg','','','cigarette,lighter,bird,smoke','2014-01-28 15:30:52','2014-01-30 22:15:54',0,0,NULL,NULL),
	(173,1,1,'Bubble Pop','bubble-pop','',1,0,1,'posts/January2014/bubble-pop.jpg','','','bubble,pop,slow motion','2014-01-28 15:34:22','2014-01-30 22:15:54',0,0,NULL,NULL),
	(174,1,32,'The Pug Factory','the-pug-factory','',1,0,1,'posts/January2014/the-pug-factory.jpg','','','pugs,dogs,funny,cartoon','2014-01-28 15:37:12','2014-01-30 22:15:54',0,0,NULL,NULL),
	(175,1,32,'Conspiracy','conspiracy','',1,0,1,'posts/January2014/conspiracy.jpg','','','funny,fridge,conspiracy,toe','2014-01-28 15:38:32','2017-12-10 14:41:44',0,1,NULL,NULL),
	(176,1,1,'R2D2 Snowman','r2d2-snowman','',1,0,1,'posts/January2014/r2d2-snowman.jpg','','','snow,snowman','2014-01-28 15:40:03','2014-01-30 22:15:54',0,0,NULL,NULL),
	(177,1,29,'Skate or Die','skate-or-die','',1,0,1,'posts/January2014/skate-or-die.jpg','','','skate,fall,hurt,injury','2014-01-28 15:41:32','2014-01-30 22:15:54',0,0,NULL,NULL),
	(178,1,36,'The power of Christ compels you!','the-power-of-christ-compels-you','',1,0,1,'posts/January2014/the-power-of-christ-compels-you.jpg','','','funny,family photo,funny kid','2014-01-28 16:01:54','2014-01-30 22:15:54',0,0,NULL,NULL),
	(179,1,35,'Dumb and Dumber - Inception Style','dumb-and-dumber-inception-style','',1,1,1,'posts/January2014/dumb-and-dumber---inception-style.jpg','http://www.youtube.com/watch?v=zLDx-BPgxxA','','dumb & dumber,remake,inception','2014-01-28 16:02:46','2014-01-30 22:15:54',0,0,NULL,NULL),
	(180,1,35,'Pick a vowel?','pick-a-vowel','',1,0,1,'posts/January2014/pick-a-vowel.jpg','','','scrubs,tv show','2014-01-28 16:03:59','2014-01-30 22:15:54',0,0,NULL,NULL),
	(181,1,1,'Go Go Gadget Mailbox','go-go-gadget-mailbox','',1,0,1,'posts/January2014/go-go-gadget-mailbox.jpg','','','mailbox,ghetto rig','2014-01-28 16:04:51','2014-01-30 22:15:54',0,0,NULL,NULL),
	(182,1,2,'Yodawg!','yodawg','',1,0,1,'posts/January2014/yodawg.jpg','','','yoda,dog,costume','2014-01-28 16:05:58','2014-01-30 22:15:54',0,0,NULL,NULL),
	(184,1,2,'Can I hold him?','can-i-hold-him','',1,0,1,'posts/January2014/can-i-hold-him.jpg','','','pig,bacon,funny','2014-01-31 03:56:28','2014-01-31 03:56:28',0,0,NULL,NULL),
	(185,1,2,'A dog towing a cat, towing a rat no, really','a-dog-towing-a-cat-towing-a-rat-no-really','',1,0,1,'posts/January2014/a-dog-towing-a-cat-towing-a-rat-no-really.jpg','','','dog,cat,rat,towing','2014-01-31 03:57:47','2014-01-31 03:57:47',0,0,NULL,NULL),
	(186,1,1,'BATMAAN!','batmaan','',1,0,1,'posts/January2014/batmaan.jpg','','','batman','2014-01-31 04:01:51','2014-01-31 04:01:51',0,0,NULL,NULL),
	(187,1,32,'Everybody Loves WiFi','everybody-loves-wifi','',1,0,1,'posts/January2014/everybody-loves-wifi.jpg','','','wifi,frog,alligator','2014-01-31 04:04:23','2014-01-31 04:04:23',0,0,NULL,NULL),
	(188,1,2,'Awwww.....now I can go to sleep....','awwww-now-i-can-go-to-sleep','',1,0,1,'posts/January2014/awwwwnow-i-can-go-to-sleep.jpg','','','cat,sleep,kitten','2014-01-31 04:05:49','2014-01-31 04:05:49',0,0,NULL,NULL),
	(189,1,35,'Pool Jumpers Trailer','pool-jumpers-trailer','',1,1,1,'posts/January2014/pool-jumpers-trailer.jpg','http://www.youtube.com/watch?v=5GIZ3cN4JwA','','trailer,pool jumpers,pools','2014-01-31 04:09:40','2014-01-31 04:09:40',0,0,NULL,NULL),
	(190,1,2,'Slowest Reader Ever','slowest-reader-ever','',1,0,1,'posts/January2014/slowest-reader-ever.jpg','','','cat,reading,book','2014-01-31 04:10:45','2014-01-31 04:10:45',0,0,NULL,NULL),
	(191,1,1,'Fire Dragon... literally','fire-dragon-literally','',1,0,1,'posts/January2014/fire-dragon-literally.jpg','','','fire,dragon','2014-01-31 04:13:52','2017-12-10 15:51:10',0,1,NULL,NULL),
	(192,1,37,'Harvard Sailing Team - Boys Will Be Girls ','harvard-sailing-team-boys-will-be-girls','',1,1,1,'posts/January2014/harvard-sailing-team---boys-will-be-girls.jpg','http://www.youtube.com/watch?v=gspaoaecNAg','','harvard,sailing,sailing team,funny','2014-01-31 04:15:55','2017-12-19 03:35:02',0,1,NULL,NULL),
	(193,1,2,'Rest up, little buddy.','rest-up-little-buddy','',1,0,1,'posts/January2014/rest-up-little-buddy.jpg','','','kitten,cast,cute,cat,hurt','2014-01-31 04:17:03','2017-10-18 20:59:31',0,1,NULL,NULL),
	(194,1,2,'Stealth Mode','stealth-mode','',1,0,1,'posts/January2014/stealth-mode.jpg','','','food,steal,stealth,cat','2014-01-31 04:18:35','2017-12-16 04:10:45',0,1,NULL,NULL),
	(195,1,38,'It\'s ok, truck. Things will get better.','it-s-ok-truck-things-will-get-better','',1,0,1,'posts/January2014/its-ok-truck-things-will-get-better.jpg','','','vehicle,truck,sad','2014-01-31 04:20:51','2014-01-31 04:20:51',0,0,NULL,NULL),
	(196,1,34,'Book Cave','book-cave','',1,0,1,'posts/January2014/book-cave.jpg','','','books,cave,bookshelf','2014-01-31 04:23:03','2017-12-16 04:10:37',0,2,NULL,NULL),
	(197,1,34,'Invisible Bookshelf','invisible-bookshelf','',1,0,1,'posts/January2014/invisible-bookshelf.jpg','','','books,bookshelf','2014-01-31 04:23:36','2017-12-13 05:30:19',0,1,NULL,NULL),
	(198,1,1,'Awesome...','awesome','',1,0,1,'posts/January2014/awesome.jpg','','','outside,drive-in,theater','2014-01-31 04:25:05','2014-01-31 04:25:05',0,0,NULL,NULL),
	(199,1,2,'I have the same look when I get to sleep in','i-have-the-same-look-when-i-get-to-sleep-in','',1,0,1,'posts/January2014/i-have-the-same-look-when-i-get-to-sleep-in.jpg','','','pig,blanket,sleep,cute','2014-01-31 04:26:17','2014-01-31 04:26:17',0,0,NULL,NULL),
	(200,1,1,'Bare Necessities','bare-necessities','',1,0,1,'posts/January2014/bare-necessities.jpg','','','old school,nintendo,pizza','2014-01-31 04:26:57','2017-12-10 15:59:26',0,1,NULL,NULL),
	(201,1,1,'Brain Transplant','brain-transplant','',1,0,1,'posts/January2014/brain-transplant.jpg','','','brain transplant,brain,gummy bear,candy','2014-01-31 04:28:35','2017-12-16 04:10:34',0,2,NULL,NULL),
	(204,1,39,'Diet Coke Ninjas','diet-coke-ninjas','',1,0,1,'posts/January2014/diet-coke-ninjas.jpg','','','coke,ninjas','2014-01-31 04:46:31','2014-01-31 04:46:31',0,0,NULL,NULL),
	(205,1,1,'The additional sign was necessary','the-additional-sign-was-necessary','',1,0,1,'posts/January2014/the-additional-sign-was-necessary.jpg','','','batman,atm,sign','2014-01-31 04:51:12','2017-12-13 15:43:25',0,2,NULL,NULL),
	(206,1,2,'Raphael is Real','raphael-is-real','',1,0,1,'posts/January2014/raphael-is-real.jpg','','','ninja turtles,turtle,raphael,teenage mutant ninja turtles','2014-01-31 04:52:34','2017-12-13 14:55:11',0,3,NULL,NULL),
	(210,1,2,'Today Has Been Ruff','today-has-been-ruff','',1,0,1,'posts/February2014/today-has-been-ruff.jpg','','','funny,couch,dog','2014-02-03 01:36:30','2017-12-13 15:36:39',0,2,NULL,NULL),
	(212,1,40,'Nintendo Bed','nintendo-bed','',1,0,1,'posts/February2014/nintendo-bed.jpg','','','nintendo,bed','2014-02-04 04:39:09','2017-12-13 15:43:14',0,4,NULL,NULL),
	(213,1,32,'Hate it when this happens!','hate-it-when-this-happens','',1,0,1,'posts/February2014/hate-it-when-this-happens.jpg','','','potato head,pee,urinal','2014-02-04 04:39:59','2017-12-13 15:35:36',0,5,NULL,NULL),
	(214,1,2,'Must be Monday','must-be-monday','',1,0,1,'posts/February2014/must-be-monday.gif','','','funny,dog,puppies,fall','2014-02-08 16:58:11','2017-12-13 15:35:00',0,6,NULL,NULL),
	(215,1,39,'Breakfast for One','breakfast-for-one','',1,0,1,'posts/February2014/breakfast-for-one.jpg','','','pan,solo,hans solo,pan solo','2014-02-08 17:15:06','2017-12-13 15:41:41',0,6,NULL,NULL),
	(216,1,31,'Highlight Anything Stupid','highlight-anything-stupid','',1,0,1,'posts/February2014/highlight-anything-stupid.jpg','','','xkcd,hightlighter,final project,comic','2014-02-08 17:31:12','2017-12-20 05:05:41',0,16,NULL,NULL);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`)
VALUES
	(1,'admin','Administrator','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(2,'user','Normal User','2017-09-28 14:57:26','2017-09-28 14:57:26');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`)
VALUES
	(1,'site.title','Site Title','Your Site Name','','text',1,'Site'),
	(2,'site.description','Site Description','Viral Fun Media Sharing Script','','text',2,'Site'),
	(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID','','','text',6,'Site'),
	(5,'admin.bg_image','Admin Background Image','settings/October2017/admin-bg.jpg','','image',5,'Admin'),
	(6,'admin.title','Admin Title','Ninja Media Script','','text',1,'Admin'),
	(7,'admin.description','Admin Description','Your Viral Fun Media Sharing Site','','text',2,'Admin'),
	(8,'admin.loader','Admin Loader','settings/October2017/admin-loader.png','','image',3,'Admin'),
	(9,'admin.icon_image','Admin Icon Image','settings/October2017/admin-icon1.png','','image',4,'Admin'),
	(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)','','','text',1,'Admin'),
	(11,'site.user_email_verify','Require User Email Verification?','0','','checkbox',7,'Site'),
	(12,'site.twitter_username','Twitter Username','thedevdojo','','text',8,'Site'),
	(13,'site.facebook_page','Facebook Page/User','thedevdojo','','text',9,'Site'),
	(14,'site.google_page','Google+ Page','+devdojo','','text',10,'Site'),
	(15,'site.like_icon','Like Icon','fa-thumbs-o-up','{\r\n    \"default\": \"fa-thumbs-o-up\",\r\n    \"options\": {\r\n        \"fa-thumbs-o-up\" : \"Thumbs Up\",\r\n        \"fa-star\" : \"Star\",\r\n        \"fa-heart\" : \"Heart\",\r\n        \"fa-sun-o\" : \"Sun\",\r\n        \"fa-smile-o\" : \"Smile\",\r\n        \"fa-check\" : \"Checkmark\"\r\n    }\r\n}','select_dropdown',11,'Site'),
	(16,'site.captcha','Enable Captcha On Signup','0','','checkbox',12,'Site'),
	(17,'site.captcha_public_key','Captcha Public Key (only if above is ON)','','','text',13,'Site'),
	(18,'site.favicon','Site Favicon','settings/December2017/jxUsRqHADmGhy4oHBWnf.png','','image',14,'Site'),
	(19,'site.auto_approve_posts','Auto Approve Posts Once Submitted','0','','checkbox',28,'Site'),
	(20,'social-auth.facebook_client_id','Facebook Client ID','574958095906653','','text',15,'Social Auth'),
	(21,'social-auth.facebook_client_secret','Facebook Client Secret','5c02ac2e9ebca3387fb5300e479912f9','','text',16,'Social Auth'),
	(22,'social-auth.google_client_id','Google Client ID','13497725668-gnajm77hup5grcr9ldel4srioi0qt857.apps.googleusercontent.com','','text',17,'Social Auth'),
	(24,'social-auth.google_client_secret','Google Client Secret','NwZ-40lreMmg9e7NqH5loJ-u','','text',19,'Social Auth'),
	(25,'mail.driver','Mail Driver (ex. smtp, mailgun, etc)','','','text',20,'Mail'),
	(26,'mail.host','Mail Host (ex. mailtrap.io)','','','text',21,'Mail'),
	(27,'mail.port','Mail Port (ex. 2525)','','','text',22,'Mail'),
	(28,'mail.username','Mail Username or Email','','','text',23,'Mail'),
	(29,'mail.password','Mail Password','','','text',24,'Mail'),
	(30,'mail.encryption','Mail Encryption','','','text',25,'Mail'),
	(31,'mail.mailgun_domain','Mailgun Domain (Only if Using Mailgun Driver)','','','text',26,'Mail'),
	(32,'mail.mailgun_secret','Mailgun Secret (Only if Using Mailgun Driver)','','','text',27,'Mail'),
	(33,'site.debug','Debug Mode (turn on to get error messages)','1','','checkbox',29,'Site'),
	(34,'site.url','Site URL','http://ninja-media-script.dev','','text',4,'Site');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table translations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `translations`;

CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`)
VALUES
	(1,'data_types','display_name_singular',1,'pt','Post','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(2,'data_types','display_name_singular',2,'pt','Página','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(3,'data_types','display_name_singular',3,'pt','Utilizador','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(4,'data_types','display_name_singular',4,'pt','Categoria','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(5,'data_types','display_name_singular',5,'pt','Menu','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(6,'data_types','display_name_singular',6,'pt','Função','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(7,'data_types','display_name_plural',1,'pt','Posts','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(8,'data_types','display_name_plural',2,'pt','Páginas','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(9,'data_types','display_name_plural',3,'pt','Utilizadores','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(10,'data_types','display_name_plural',4,'pt','Categorias','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(11,'data_types','display_name_plural',5,'pt','Menus','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(12,'data_types','display_name_plural',6,'pt','Funções','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(13,'categories','slug',1,'pt','categoria-1','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(14,'categories','name',1,'pt','Categoria 1','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(15,'categories','slug',2,'pt','categoria-2','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(16,'categories','name',2,'pt','Categoria 2','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(17,'pages','title',1,'pt','Olá Mundo','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(18,'pages','slug',1,'pt','ola-mundo','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(19,'pages','body',1,'pt','<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(20,'menu_items','title',1,'pt','Painel de Controle','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(21,'menu_items','title',2,'pt','Media','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(22,'menu_items','title',3,'pt','Publicações','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(23,'menu_items','title',4,'pt','Utilizadores','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(24,'menu_items','title',5,'pt','Categorias','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(25,'menu_items','title',6,'pt','Páginas','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(26,'menu_items','title',7,'pt','Funções','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(27,'menu_items','title',8,'pt','Ferramentas','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(28,'menu_items','title',9,'pt','Menus','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(29,'menu_items','title',10,'pt','Base de dados','2017-09-28 14:57:26','2017-09-28 14:57:26'),
	(30,'menu_items','title',13,'pt','Configurações','2017-09-28 14:57:26','2017-09-28 14:57:26');

/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'users/default.png',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `username`, `name`, `email`, `avatar`, `password`, `remember_token`, `active`, `created_at`, `updated_at`, `activation_token`)
VALUES
	(1,1,'admin','Admin','admin@admin.com','users/admin/avatar.jpg','$2y$10$wj8AKu1z3PNa1jdc/zRNsusJgbEE1yuI6QE26i7kEIWUpclKL3Foe','eUzY7pDeJ4yVUaXXiOLwB2pGd2OpRGJBjhnstQEFehlQGJULV71IvUvBi418',1,'2017-09-28 14:57:26','2017-12-14 14:11:12',NULL),
	(15,2,'johndoe','johndoe','johndoe@gmail.com','users/default.png','$2y$10$2ib.kZOE86Hy8ZNzf4i/5eewbdjDlDwMzNTI9b4aFQP3z9NQOXOw.','TZXdwqyIfNBKQW9uMe6ydCwNSRFSkucDforPnE8iqQyt6ZtI30veENujPGwz',0,'2017-12-26 18:31:15','2017-12-26 18:31:15','4xUVfjGjm74uXUQ21cj5lFaAlGVopeGxuAj7hUry3KNZSE71BOVwuXqeChvJ2u2b');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table voyager_theme_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `voyager_theme_options`;

CREATE TABLE `voyager_theme_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `voyager_theme_id` int(10) unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `voyager_theme_options_voyager_theme_id_index` (`voyager_theme_id`),
  CONSTRAINT `voyager_theme_options_voyager_theme_id_foreign` FOREIGN KEY (`voyager_theme_id`) REFERENCES `voyager_themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `voyager_theme_options` WRITE;
/*!40000 ALTER TABLE `voyager_theme_options` DISABLE KEYS */;

INSERT INTO `voyager_theme_options` (`id`, `voyager_theme_id`, `key`, `value`, `created_at`, `updated_at`)
VALUES
	(3,1,'logo_light','themes/September2017/light-logo.png','2017-09-29 00:26:09','2017-09-29 00:26:09'),
	(4,1,'logo_dark','themes/September2017/dark-logo1.png','2017-09-29 00:26:09','2017-09-29 00:33:39'),
	(5,1,'color_scheme','dark','2017-09-29 15:11:18','2017-12-23 16:42:02'),
	(8,1,'default_color','#ee222e','2017-09-29 23:58:41','2017-09-30 00:29:21'),
	(9,1,'random_bar','1','2017-09-29 23:59:25','2017-12-13 15:22:13'),
	(11,1,'pagination_type','infinite_scroll','2017-12-09 23:16:34','2017-12-11 15:17:29'),
	(12,1,'custom_js','','2017-12-10 15:30:28','2017-12-10 15:32:32'),
	(13,1,'post_display','list','2017-12-11 17:26:46','2017-12-11 17:46:24'),
	(14,1,'sidebar','1','2017-12-11 21:05:46','2017-12-11 21:42:30'),
	(15,1,'sidebar_settings','1','2017-12-11 21:05:46','2017-12-11 21:32:33'),
	(16,1,'open_posts','0','2017-12-13 15:38:50','2017-12-13 15:39:59'),
	(17,1,'like_icon','fa-thumbs-up','2017-12-14 15:01:12','2017-12-14 15:05:33'),
	(18,1,'social_share_image','themes/December2017/J1rzV6uN6Qsd4WnRbZhU.jpg','2017-12-16 03:28:48','2017-12-16 03:28:48'),
	(19,1,'ad_sidebar','<a href=\"http://codecanyon.net/item/ninja-media-script-viral-fun-media-sharing-site/6822888\" target=\"_blank\"><img src=\"/themes/default/assets/img/advertisement.jpg\" width=\"302\" height=\"252\"></a>','2017-12-19 14:38:50','2017-12-19 14:43:38'),
	(20,1,'ad_post_top','<a href=\"http://codecanyon.net/item/ninja-media-script-viral-fun-media-sharing-site/6822888\" target=\"_blank\"><img src=\"/themes/default/assets/img/top-advertisement.jpg\" width=\"728\" height=\"90\"></a>','2017-12-19 14:38:50','2017-12-19 14:38:50'),
	(23,1,'custom_css','','2017-12-26 15:21:52','2017-12-26 15:22:40');

/*!40000 ALTER TABLE `voyager_theme_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table voyager_themes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `voyager_themes`;

CREATE TABLE `voyager_themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voyager_themes_folder_unique` (`folder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `voyager_themes` WRITE;
/*!40000 ALTER TABLE `voyager_themes` DISABLE KEYS */;

INSERT INTO `voyager_themes` (`id`, `name`, `folder`, `active`, `version`, `created_at`, `updated_at`)
VALUES
	(1,'Default','default',1,'1.0','2017-09-28 23:08:17','2017-09-28 23:32:39');

/*!40000 ALTER TABLE `voyager_themes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
