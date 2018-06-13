# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.01 (MySQL 5.6.23)
# Database: ciee_challenge
# Generation Time: 2018-06-13 03:51:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table people
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people`;

CREATE TABLE `people` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `date_birth` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;

INSERT INTO `people` (`id`, `name`, `last_name`, `date_birth`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'dinaerte','neto','1985-07-15','2018-06-06 12:53:53','2018-06-10 23:01:30',NULL),
	(2,'dinaerte','',NULL,'0000-00-00 00:00:00','2018-06-10 23:01:30',NULL),
	(3,'Dinaerte','Neto','1985-07-15','0000-00-00 00:00:00','2018-06-10 23:01:30',NULL),
	(4,'Dinaerte','Neto','1985-07-15','2018-06-10 21:09:59','2018-06-10 23:01:30',NULL),
	(5,'Dinaerte','Neto','1985-07-15','2018-06-10 21:16:16','2018-06-10 23:01:30',NULL),
	(6,'Dinaerte','Neto','1985-07-15','2018-06-10 21:16:31','2018-06-10 23:01:30',NULL),
	(7,'teste','teste lastname','2015-06-12','2018-06-10 21:16:54','2018-06-10 23:21:54','2018-06-10 23:30:41'),
	(8,'Dinaerte','Neto','1985-07-15','2018-06-10 21:17:23','2018-06-10 23:01:30',NULL),
	(9,'Dinaerte','Neto','1985-07-15','2018-06-10 21:31:42','2018-06-10 23:01:30',NULL),
	(10,'Dinaerte','Neto','1985-07-15','2018-06-10 22:50:01','2018-06-10 23:01:30',NULL),
	(11,'Dinaerte','Neto','1985-07-15','2018-06-10 22:52:00','2018-06-10 23:01:30',NULL),
	(12,'Dinaerte','Neto','1985-07-15','2018-06-10 22:52:30','2018-06-10 23:01:30',NULL),
	(13,'Dinaerte','Neto','1985-07-15','2018-06-10 22:53:52','2018-06-10 23:01:30',NULL),
	(14,'Dinaerte xsa ','Neto','1985-07-15','2018-06-10 22:54:36','2018-06-10 23:01:30',NULL),
	(15,'Dinaerte xsa ','Neto','1985-07-15','2018-06-10 22:55:28','2018-06-10 23:01:30',NULL);

/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table people_contact_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people_contact_types`;

CREATE TABLE `people_contact_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `people_contact_types` WRITE;
/*!40000 ALTER TABLE `people_contact_types` DISABLE KEYS */;

INSERT INTO `people_contact_types` (`id`, `type`)
VALUES
	(1,'E-Mail'),
	(2,'Whatsapp'),
	(3,'Phone'),
	(4,'Cellphone'),
	(5,'Others');

/*!40000 ALTER TABLE `people_contact_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table people_contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people_contacts`;

CREATE TABLE `people_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `people_id` int(10) unsigned NOT NULL,
  `people_contact_type_id` int(10) unsigned NOT NULL,
  `value` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `people_contacts` WRITE;
/*!40000 ALTER TABLE `people_contacts` DISABLE KEYS */;

INSERT INTO `people_contacts` (`id`, `people_id`, `people_contact_type_id`, `value`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,1,'11965568653','2018-06-06 12:12:53','2018-06-06 11:00:00',NULL),
	(2,7,2,'elias@appciee.com','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(3,7,3,'1111111111111','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(4,8,1,'dinaerteneto@gmail.com','2018-06-10 21:17:23','2018-06-10 21:17:23',NULL),
	(5,8,2,'1126191662','2018-06-10 21:17:23','2018-06-10 21:17:23',NULL),
	(6,15,1,'dinaerteneto@gmail.com','2018-06-10 22:55:28','2018-06-10 22:55:28',NULL),
	(7,15,2,'1126191662','2018-06-10 22:55:28','2018-06-10 22:55:28',NULL),
	(8,0,0,'','2018-06-11 05:47:44','2018-06-11 05:47:44',NULL),
	(9,8,2,'teste','2018-06-11 05:48:26','2018-06-11 16:06:07','2018-06-11 16:07:49'),
	(10,0,1,'dinaerte@smartside.com.br','2018-06-11 16:02:43','2018-06-11 16:02:43',NULL);

/*!40000 ALTER TABLE `people_contacts` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
