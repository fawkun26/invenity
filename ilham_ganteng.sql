-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: invenity
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bpp`
--

DROP TABLE IF EXISTS `bpp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bpp` (
  `bpp_id` int NOT NULL AUTO_INCREMENT,
  `bpp_report_id` varchar(50) DEFAULT NULL,
  `request_quantity` int DEFAULT NULL,
  `request_unit` varchar(50) DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `out_quantity` int DEFAULT NULL,
  `out_unit` varchar(50) DEFAULT NULL,
  `device_id` int DEFAULT NULL,
  `out_total` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`bpp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bpp`
--

LOCK TABLES `bpp` WRITE;
/*!40000 ALTER TABLE `bpp` DISABLE KEYS */;
INSERT INTO `bpp` VALUES (121,'20210301',9,'buah','5',9,'buah',122,9,'2021-03-01','admin','2021-03-01 10:02:09','admin','2021-03-01 10:02:09'),(122,'20210301',12,'buah','10',12,'buah',124,12,'2021-03-01','admin','2021-03-01 10:02:52','admin','2021-03-01 10:02:52'),(123,'20210302',5,'5','5',5,'5',124,5,'2021-03-02','admin','2021-03-02 13:00:51','admin','2021-03-02 13:00:51'),(124,'20210302',10,'10','10',10,'10',2,10,'2021-03-02','admin','2021-03-02 13:11:02','admin','2021-03-02 13:11:02');
/*!40000 ALTER TABLE `bpp` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `bpp_after_update` AFTER UPDATE ON `bpp` FOR EACH ROW BEGIN
UPDATE device_list SET device_quantity = device_quantity - NEW.out_quantity + OLD.out_quantity WHERE device_id = new.device_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `bpp_after_delete` AFTER DELETE ON `bpp` FOR EACH ROW BEGIN
UPDATE device_list SET device_quantity = device_quantity + OLD.out_quantity WHERE device_id = OLD.device_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `bpp_history`
--

DROP TABLE IF EXISTS `bpp_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bpp_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1679 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bpp_history`
--

LOCK TABLES `bpp_history` WRITE;
/*!40000 ALTER TABLE `bpp_history` DISABLE KEYS */;
INSERT INTO `bpp_history` VALUES (1674,'0','2021-02-28 17:00:00'),(1675,'0','2021-02-28 17:00:00'),(1676,'0','2021-02-28 17:00:00'),(1677,'0','2021-03-01 17:00:00'),(1678,'0','2021-03-01 17:00:00');
/*!40000 ALTER TABLE `bpp_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component`
--

DROP TABLE IF EXISTS `component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `component` (
  `component_id` int NOT NULL AUTO_INCREMENT,
  `component_name` varchar(30) NOT NULL COMMENT 'Component Name',
  `component_page` varchar(100) NOT NULL COMMENT 'Component Page',
  `component_type` enum('system','standard') NOT NULL DEFAULT 'standard' COMMENT 'Component Type',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Active Status',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`component_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component`
--

LOCK TABLES `component` WRITE;
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` VALUES (1,'User Management','user_management.php','system','yes','admin','2015-12-04 07:54:58','admin','2015-12-22 14:46:59',2),(2,'Component Management','component_management.php','system','yes','admin','2015-12-04 07:54:58','admin','2015-12-22 14:46:29',2),(3,'System Log','system_log.php','system','yes','admin','2015-12-04 07:54:58','admin','2015-12-22 14:46:55',2),(4,'System Settings','system_settings.php','system','yes','admin','2015-12-04 07:54:58','admin','2015-12-22 14:46:57',2),(5,'Device Management','device_management.php','system','yes','admin','2015-12-03 15:01:55','admin','2015-12-22 14:46:47',2),(6,'Location Management','location_management.php','system','yes','admin','2015-12-03 15:01:55','admin','2015-12-22 14:46:52',2),(7,'Report','report.php','system','yes','admin','2015-12-22 11:17:36','admin','2016-02-17 14:14:29',4),(8,'Stock Opname','stock_opname.php','system','yes','admin','2020-08-18 11:44:36','admin','2020-09-02 11:00:48',7),(9,'LPB','lpb.php','standard','yes','admin','2020-09-11 09:54:52','admin','2020-09-11 09:54:52',0),(10,'BPP','bpp.php','standard','yes','admin','2020-09-17 10:58:47','admin','2021-03-30 13:18:31',5),(18,'Device Stock Availability','device_stock_availability.php','standard','yes','admin','2021-03-13 23:50:12','admin','2021-03-13 23:50:29',1);
/*!40000 ALTER TABLE `component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_changes`
--

DROP TABLE IF EXISTS `device_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device_changes` (
  `changes_id` int(12) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `device_id` int NOT NULL,
  `changes` text,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`changes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_changes`
--

LOCK TABLES `device_changes` WRITE;
/*!40000 ALTER TABLE `device_changes` DISABLE KEYS */;
INSERT INTO `device_changes` VALUES (000000000001,3,'','admin','2020-11-30 12:42:56'),(000000000002,102,'Dev brand : local -> localzz. Dev quantity : 100 -> 90. ','admin','2020-12-01 14:30:22'),(000000000003,102,'Dev quantity : 90 -> . ','admin','2020-12-01 14:37:30'),(000000000004,102,'Dev quantity : 90 -> . ','admin','2020-12-01 14:38:34'),(000000000005,102,'Dev quantity : 0 -> 100. ','admin','2020-12-01 14:39:11'),(000000000006,102,'Dev model : cxz -> cxzxx. Dev quantity : 100 -> . ','admin','2020-12-01 14:55:39'),(000000000007,102,'Dev quantity : 0 -> 100. ','admin','2020-12-01 14:56:16'),(000000000008,102,'Dev model : cxzxx -> . Dev quantity : 100 -> . ','admin','2020-12-01 14:57:29'),(000000000009,102,'Dev model :  -> cxz. Dev quantity : 0 -> 10. ','admin','2020-12-01 14:57:42'),(000000000010,109,'','admin','2020-12-11 21:00:54'),(000000000011,109,'Dev quantity : 22 -> 23. ','admin','2020-12-11 21:01:42'),(000000000012,105,'Dev quantity : 10 -> 101. Dev description : apa -> <p>apa</p>. ','admin','2020-12-11 21:02:02'),(000000000013,5,'Dev quantity :  -> 10. ','admin','2020-12-11 22:50:15'),(000000000014,115,'Dev quantity : 20 -> 40. ','admin','2020-12-16 15:54:27'),(000000000015,5,'Dev quantity : 10 -> 100. ','admin','2020-12-16 16:02:51'),(000000000016,5,'Dev quantity : 100 -> 1000. ','admin','2020-12-16 16:03:04'),(000000000017,5,'Dev quantity : 1000 -> 100. ','admin','2020-12-20 11:38:17'),(000000000018,2,'Dev model : 3\" -> 3\\\". Dev quantity :  -> 10. ','admin','2021-01-08 00:01:46'),(000000000019,100,'Dev description : x -> <p>x</p>. Dev location id :  -> 2. ','admin','2021-01-12 22:01:24'),(000000000020,122,'','admin','2021-01-21 00:28:02'),(000000000021,124,'Dev brand :  -> xxxxxxxx. ','admin','2021-01-21 00:28:37'),(000000000022,123,'Dev brand :  -> 23123123. ','admin','2021-01-21 00:29:18'),(000000000023,123,'','admin','2021-01-21 00:29:47'),(000000000024,123,'Dev location id : 0 -> 2. ','admin','2021-01-21 00:30:11'),(000000000025,129,'Dev brand : nike -> nikeajah. Dev quantity : 10 -> 1000. ','admin','2021-01-21 00:52:13'),(000000000026,100,'Dev brand : a -> . Dev model : x -> . Dev quantity : 8 -> . Dev color : x -> . Dev serial : x -> . Dev description : <p>x</p> -> . Dev status : new -> . Dev location id : 2 -> . ','admin','2021-01-25 22:54:03'),(000000000027,100,'','admin','2021-01-25 22:54:04'),(000000000028,100,'','admin','2021-01-25 22:54:04'),(000000000029,100,'','admin','2021-01-25 22:54:05'),(000000000030,100,'','admin','2021-01-25 22:54:05'),(000000000031,100,'','admin','2021-01-25 22:54:05'),(000000000032,100,'','admin','2021-01-25 22:54:06'),(000000000033,100,'','admin','2021-01-25 22:54:09'),(000000000034,100,'','admin','2021-01-25 22:55:04'),(000000000035,100,'','admin','2021-01-25 22:56:08'),(000000000036,100,'','admin','2021-01-25 22:58:38'),(000000000037,100,'Dev quantity : -1 -> . ','admin','2021-01-25 23:00:11'),(000000000038,100,'','admin','2021-01-25 23:00:31'),(000000000039,125,'Dev brand : 30303030 -> . Dev model : asing -> . Dev quantity : 10 -> . Dev color : blue -> . Dev serial : 0009 -> . Dev description : <p>dawdawd</p> -> . Dev status : new -> . Dev location id : 2 -> . ','admin','2021-01-25 23:04:24'),(000000000040,126,'Dev brand : 0000009 -> . Dev model : Terbaru -> . Dev quantity : 100 -> . Dev color : Blue -> . Dev serial : 0000007 -> . Dev description : <p>Mantaps Gan</p> -> . Dev status : new -> . Dev location id : 2 -> . ','admin','2021-01-25 23:05:50'),(000000000041,123,'Dev model :  -> asing. Dev quantity : 0 -> 100. Dev color :  -> blue. Dev description :  -> <p>dwadwadaw</p>. ','admin','2021-01-25 23:07:23'),(000000000042,131,'Dev brand : nikeajahdada -> . Dev model : Terbaru -> . Dev quantity : 99 -> . Dev color : blue -> . Dev serial : 2039102391203 -> . Dev description : <p>dawdawd</p> -> . Dev status : new -> . Dev location id : 2 -> . ','admin','2021-01-25 23:10:49');
/*!40000 ALTER TABLE `device_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_list`
--

DROP TABLE IF EXISTS `device_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device_list` (
  `device_id` int NOT NULL AUTO_INCREMENT,
  `type_id` int NOT NULL COMMENT 'FK Device Type',
  `device_code` varchar(100) NOT NULL COMMENT 'Unique Code (5 digit number in the back)',
  `device_brand` varchar(100) NOT NULL,
  `device_quantity` int DEFAULT NULL,
  `minimum_quantity` int DEFAULT '1',
  `device_model` varchar(100) DEFAULT NULL,
  `device_serial` varchar(255) NOT NULL,
  `device_color` varchar(100) NOT NULL COMMENT 'Color',
  `device_description` text,
  `device_photo` text,
  `device_status` enum('new','in use','damaged','repaired','discarded') NOT NULL DEFAULT 'new',
  `location_id` int DEFAULT NULL COMMENT 'FK Location',
  `device_deployment_date` datetime DEFAULT NULL COMMENT 'Fill this field when assigned to a location',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_list`
--

LOCK TABLES `device_list` WRITE;
/*!40000 ALTER TABLE `device_list` DISABLE KEYS */;
INSERT INTO `device_list` VALUES (2,13,'B3','asd',10,666,'3\"','50','sdf','<p>ewfewr</p>','./assets/images/device_photos/standard_device.jpg','damaged',1,'2021-01-08 00:01:46','admin','2020-11-26 20:25:05','admin','2021-03-16 09:14:36',21),(3,10,'A5','XXX',10,22,'Baru','1','BLUE','<p>XXXX</p>','./assets/images/device_photos/XXX.png','new',2,'2020-11-30 12:42:56','admin','2020-11-30 12:39:55','admin','2021-03-18 10:28:23',4),(5,10,'A5','ZZZ',10,1,'Lama','2','BLUE','','./assets/images/device_photos/standard_device.jpg','new',1,'2020-12-20 11:38:18','admin','2020-11-30 12:57:27','admin','2021-03-18 10:11:42',6),(102,10,'A5','localzz',10,10,'cxz','3','BLUE','<p>dwadawd</p>','./assets/images/device_photos/990.png','new',2,'2020-12-01 14:57:42','admin','2020-11-30 13:57:50','admin','2021-03-15 05:15:19',8),(103,10,'A5','123456789',10,14,'0909839273','4','jfejfiejf','<p>fsaefe</p>','./assets/images/device_photos/standard_device.jpg','new',1,'0000-00-00 00:00:00','admin','2020-11-30 13:59:46','admin','2020-11-30 13:59:46',0),(104,10,'A5','awww',10,5,'777','5','Green','<p>dawdaw</p>','./assets/images/device_photos/standard_device.jpg','new',1,'0000-00-00 00:00:00','admin','2020-12-01 14:17:17','admin','2020-12-01 14:17:17',0),(110,20,'B10','abc',10,6,'r3rq3','A7X1','BLUE','<p>wrw</p>','./assets/images/device_photos/standard_device.jpg','new',2,'0000-00-00 00:00:00','admin','2020-12-11 21:03:07','admin','2020-12-11 21:03:07',0),(122,9,'A4','xxxxx',21,8,'12345','10','blue','<p>321312</p>','./assets/images/device_photos/3213123.jpg','new',2,'2021-01-21 00:28:02','admin','2021-01-13 02:25:18','admin','2021-01-21 00:28:02',1),(123,10,'A5','23123123',15,16,'asing','1111111','blue','<p>dwadwadaw</p>','./assets/images/device_photos/1111111.jpg','new',2,'2021-01-25 23:07:23','','0000-00-00 00:00:00','admin','2021-01-25 23:07:23',4),(124,9,'A4','xxxxxxxx',15,7,'','20','','','./assets/images/device_photos/22222222.png','new',0,'2021-01-21 00:28:37','','0000-00-00 00:00:00','admin','2021-01-21 00:28:37',1),(132,10,'PERUMDA/2021/A5/1','fdwdqdQ',15,15,'232312','44456112','CDADAW','<p>EWEAEA</p>','./assets/images/device_photos/44456112.jpg','new',2,'0000-00-00 00:00:00','admin','2021-01-30 16:46:59','admin','2021-01-30 16:46:59',0),(133,10,'A5/2','dwada',10,11,'fawfw','231567','blue','<p>aawfawf</p>','./assets/images/device_photos/231567.jpg','new',2,'0000-00-00 00:00:00','admin','2021-01-30 17:16:14','admin','2021-01-30 17:16:14',0),(134,10,'A5/3','wdawd',10,18,'acsc','dwada','casc','<p>dwdw</p>','./assets/images/device_photos/standard_device.jpg','new',2,'0000-00-00 00:00:00','admin','2021-01-30 17:16:47','admin','2021-01-30 17:16:47',0),(135,10,'A5/ilham-ganteng//4','Angel Steel',5,5,'AV7','666','Black','<p>mantep</p>','./assets/images/device_photos/standard_device.jpg','in use',1,'2021-03-15 07:53:53','admin','2021-03-15 07:53:53','admin','2021-03-15 07:53:53',0);
/*!40000 ALTER TABLE `device_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_type`
--

DROP TABLE IF EXISTS `device_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device_type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL COMMENT 'Device Type Name',
  `type_code` varchar(30) NOT NULL COMMENT 'Device Type Code',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Device Type Active Status',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0' COMMENT 'Total Device Type Changes',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_type`
--

LOCK TABLES `device_type` WRITE;
/*!40000 ALTER TABLE `device_type` DISABLE KEYS */;
INSERT INTO `device_type` VALUES (1,'AIR VALVE SINGLE 2\"','A1','yes','admin','2020-11-19 09:17:02','admin','2020-11-19 09:17:02',0),(7,'AIR VALVE SINGLE 3\"','A2','yes','admin','2020-11-19 09:18:11','admin','2020-11-19 09:18:11',0),(8,'AIR VALVE SINGLE 4\"','A3','yes','admin','2020-11-19 09:19:07','admin','2020-11-19 09:19:07',0),(9,'AIR VALVE DOUBLE ALL FLANGE 3\"','A4','yes','admin','2020-11-19 09:31:50','admin','2020-11-19 09:31:50',0),(10,'AIR VALVE (Single Drat) 1\"','A5','yes','admin','2020-11-19 09:32:22','admin','2020-11-19 09:32:22',0),(11,'BALL VALVE 3/4\"','B1','yes','admin','2020-11-19 09:32:58','admin','2020-11-19 09:32:58',0),(12,'BALL VALVE 1 1/2\"','B2','yes','admin','2020-11-19 09:33:27','admin','2020-11-19 09:33:27',0),(13,'BALL VALVE 2\"','B3','yes','admin','2020-11-19 09:34:00','admin','2020-11-19 09:34:00',0),(14,'BAUD & MUR 1/2 x 2\"','B4','yes','admin','2020-11-19 09:34:43','admin','2020-11-19 09:34:43',0),(15,'BAUD & MUR 3/4 x 6\"','B5','yes','admin','2020-11-19 09:35:15','admin','2020-11-19 09:35:15',0),(16,'BAUD & MUR 5/8 x 3\"','B6','yes','admin','2020-11-19 09:55:00','admin','2020-11-19 09:55:00',0),(17,'BAUD & MUR 5/8 x 4\"','B7','yes','admin','2020-11-19 09:55:49','admin','2020-11-19 09:55:49',0),(19,'BAUD & MUR 3/4 x 3\"','B9','yes','admin','2020-11-19 09:57:35','admin','2020-11-19 09:57:35',0),(20,'BAUD & MUR 7/8 x 3\"','B10','yes','admin','2020-11-19 09:58:38','admin','2020-11-19 09:58:38',0),(21,'BAUD & MUR 5/8 x 6\"','B11','yes','admin','2020-11-19 09:59:04','admin','2020-11-19 09:59:04',0),(22,'BAUD & MUR 5/8 x 7\"','B12','yes','admin','2020-11-19 11:40:58','admin','2020-11-19 11:40:58',0),(23,'BAUD & MUR 5/8 x 12\"','B13','yes','admin','2020-11-19 14:17:53','admin','2020-11-19 14:17:53',0);
/*!40000 ALTER TABLE `device_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `location_name` varchar(30) NOT NULL COMMENT 'Location Name',
  `location_photo` text COMMENT 'Location Photo - If available',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Location Active Status',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0' COMMENT 'Total Device Type Changes',
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,'Head Office Warehouse',NULL,'yes','admin','2016-11-12 11:59:44','admin','2020-08-28 10:45:41',6),(2,'Baros Warehouse',NULL,'yes','admin','2020-08-27 13:48:03','admin','2020-08-28 10:45:30',1);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_building`
--

DROP TABLE IF EXISTS `location_building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location_building` (
  `building_id` int NOT NULL AUTO_INCREMENT,
  `building_name` varchar(30) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_building`
--

LOCK TABLES `location_building` WRITE;
/*!40000 ALTER TABLE `location_building` DISABLE KEYS */;
INSERT INTO `location_building` VALUES (1,'Gedung 1','yes','admin','2016-11-12 11:59:00','admin','2016-11-12 11:59:00',0),(3,'Gedung 2','yes','admin','2020-08-26 11:11:10','admin','2020-08-26 11:11:10',0),(4,'Gedung 3','yes','admin','2020-08-26 11:11:20','admin','2020-08-26 11:11:20',0);
/*!40000 ALTER TABLE `location_building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_details`
--

DROP TABLE IF EXISTS `location_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location_details` (
  `detail_id` int NOT NULL AUTO_INCREMENT,
  `location_id` int NOT NULL COMMENT 'FK location',
  `place_id` int NOT NULL COMMENT 'FK place',
  `building_id` int NOT NULL COMMENT 'FK building',
  `floor_id` int NOT NULL COMMENT 'FK floor',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_details`
--

LOCK TABLES `location_details` WRITE;
/*!40000 ALTER TABLE `location_details` DISABLE KEYS */;
INSERT INTO `location_details` VALUES (1,1,1,4,1,'yes','admin','2016-11-12 12:09:02','admin','2020-08-26 11:12:11',3),(2,2,2,2,1,'yes','admin','2016-11-12 12:12:29','admin','2016-11-12 12:12:29',0);
/*!40000 ALTER TABLE `location_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_floor`
--

DROP TABLE IF EXISTS `location_floor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location_floor` (
  `floor_id` int NOT NULL AUTO_INCREMENT,
  `floor_name` varchar(30) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`floor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_floor`
--

LOCK TABLES `location_floor` WRITE;
/*!40000 ALTER TABLE `location_floor` DISABLE KEYS */;
INSERT INTO `location_floor` VALUES (1,'1st Floor','yes','admin','2016-10-31 13:46:37','admin','2016-11-12 11:56:48',1);
/*!40000 ALTER TABLE `location_floor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_place`
--

DROP TABLE IF EXISTS `location_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location_place` (
  `place_id` int NOT NULL AUTO_INCREMENT,
  `place_name` varchar(30) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_place`
--

LOCK TABLES `location_place` WRITE;
/*!40000 ALTER TABLE `location_place` DISABLE KEYS */;
INSERT INTO `location_place` VALUES (1,'Gudang','yes','admin','2016-10-31 13:46:37','admin','2020-08-26 11:10:44',2),(2,'adasd','yes','admin','2020-08-27 09:52:18','admin','2020-08-27 09:52:18',0);
/*!40000 ALTER TABLE `location_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lpb`
--

DROP TABLE IF EXISTS `lpb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lpb` (
  `lpb_id` int NOT NULL AUTO_INCREMENT,
  `lpb_report_id` varchar(100) NOT NULL,
  `lpb_quantity` int NOT NULL DEFAULT '0',
  `lpb_unit` varchar(100) NOT NULL,
  `lpb_code` varchar(50) NOT NULL DEFAULT '',
  `device_id` int NOT NULL DEFAULT '0',
  `lpb_description` varchar(100) NOT NULL,
  `lpb_condition` varchar(100) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `created_by` varchar(50) NOT NULL DEFAULT '',
  `created_date` date NOT NULL,
  `updated_by` varchar(50) NOT NULL DEFAULT '',
  `updated_date` date NOT NULL,
  PRIMARY KEY (`lpb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lpb`
--

LOCK TABLES `lpb` WRITE;
/*!40000 ALTER TABLE `lpb` DISABLE KEYS */;
INSERT INTO `lpb` VALUES (11,'20210128',1,'buah','AIR VALVE (Single Drat) 1\"(code=A5)(serial=1)',3,'xxxx','bagus','2021-01-28','admin','2021-01-28','admin','2021-01-28'),(12,'20210128',3,'buah','AIR VALVE (Single Drat) 1\"(code=A5)(serial=1)',3,'xxxx','bagus','2021-01-28','admin','2021-01-28','admin','2021-01-28'),(13,'20210128',20,'meter','AIR VALVE (Single Drat) 1\"(code=A5)(serial=1)',3,'xxxx','bagus','2021-01-28','admin','2021-01-28','admin','2021-01-28'),(14,'20210128',20,'meterz','AIR VALVE (Single Drat) 1\"(code=A5)(serial=2)',5,'aaaaa','bagus','2021-01-28','admin','2021-01-28','admin','2021-01-28'),(15,'20210130',9,'buah','AIR VALVE (Single Drat) 1\"(code=A5)(serial=1)',3,'wwwww','bagus','2021-01-30','admin','2021-01-30','admin','2021-01-30'),(16,'20210130',11,'buah','AIR VALVE (Single Drat) 1\"(code=A5)(serial=1)',3,'wwwww','bagus','2021-01-30','admin','2021-01-30','admin','2021-01-30'),(17,'20210130',17,'buah','AIR VALVE (Single Drat) 1\"(code=A5)(serial=2)',5,'awewe','bagusz','2021-01-30','admin','2021-01-30','admin','2021-01-30'),(18,'20210130',4,'buah','AIR VALVE (Single Drat) 1\"(code=A5)(serial=2)',5,'xxxx','bagus','2021-01-30','admin','2021-01-30','admin','2021-01-30');
/*!40000 ALTER TABLE `lpb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_logs`
--

DROP TABLE IF EXISTS `system_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `log_date` datetime NOT NULL COMMENT 'Date',
  `username` varchar(30) NOT NULL COMMENT 'Username',
  `description` text NOT NULL COMMENT 'Log Descriptions',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3328 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_logs`
--

LOCK TABLES `system_logs` WRITE;
/*!40000 ALTER TABLE `system_logs` DISABLE KEYS */;
INSERT INTO `system_logs` VALUES (3302,'2021-03-14 08:27:15','admin','admin update data :  quantity_minimum = \'123\' where  device_id = 2 from device_list table on 2021/03/14 15:27:15'),(3303,'2021-03-14 08:29:33','admin','admin update data :  quantity_minimum = \'55\' where  device_id = 2 from device_list table on 2021/03/14 15:29:33'),(3304,'2021-03-14 08:30:29','admin','admin update data :  component_name = \'BPP_Setan\', component_page = \'bpp.php\', active = \'yes\' where  component_id = \'10\'  from component table on 2021/03/14 15:30:29'),(3305,'2021-03-14 08:33:04','admin','admin update data :  quantity_minimum = \'5656\' where  device_id = 2 from device_list table on 2021/03/14 15:33:04'),(3306,'2021-03-15 05:15:07','admin','admin update data :  quantity_minimum = \'5\' where  device_id = 2 from device_list table on 2021/03/15 12:15:07'),(3307,'2021-03-15 05:15:19','admin','admin update data :  quantity_minimum = \'10\' where  device_id = 102 from device_list table on 2021/03/15 12:15:19'),(3308,'2021-03-15 05:16:20','admin','admin update data :  quantity_minimum = \'66\' where  device_id = 2 from device_list table on 2021/03/15 12:16:20'),(3309,'2021-03-15 05:16:27','admin','admin update data :  quantity_minimum = \'-34\' where  device_id = 2 from device_list table on 2021/03/15 12:16:27'),(3310,'2021-03-15 06:51:46','admin','admin update data :  quantity_minimum = \'-55\' where  device_id = 2 from device_list table on 2021/03/15 13:51:46'),(3311,'2021-03-15 06:51:54','admin','admin update data :  quantity_minimum = \'-9\' where  device_id = 2 from device_list table on 2021/03/15 13:51:54'),(3312,'2021-03-15 06:53:08','admin','admin update data :  quantity_minimum = \'0\' where  device_id = 2 from device_list table on 2021/03/15 13:53:08'),(3313,'2021-03-15 07:16:55','admin','admin update data :  minimum_quantity = \'44\' where  device_id = 2 from device_list table on 2021/03/15 14:16:55'),(3314,'2021-03-15 07:17:44','admin','admin update data :  minimum_quantity = \'4\' where  device_id = 2 from device_list table on 2021/03/15 14:17:44'),(3315,'2021-03-15 07:53:53','admin','admin insert new data into the device_list table on 2021/03/15 14:53:53'),(3316,'2021-03-15 08:03:31','ilham','ilham update data :  first_name=\'Mohamad\', last_name=\'Ilham Ramadhan Ganteng\',  updated_by=\'ilham\', updated_date=NOW(), revision = revision+1  where  username = \'ilham\' from users table on 2021/03/15 15:03:31'),(3317,'2021-03-15 08:03:31','ilham','ilham update data :  privileges=\'5,6,7,9,10,18\' where  username=\'ilham\' from user_privileges table on 2021/03/15 15:03:31'),(3318,'2021-03-16 09:14:36','admin','admin update data :  minimum_quantity = \'666\' where  device_id = 2 from device_list table on 2021/03/16 16:14:36'),(3319,'2021-03-18 10:11:35','admin','admin update data :  minimum_quantity = \'15\' where  device_id = 5 from device_list table on 2021/03/18 17:11:35'),(3320,'2021-03-18 10:11:43','admin','admin update data :  minimum_quantity = \'1\' where  device_id = 5 from device_list table on 2021/03/18 17:11:43'),(3321,'2021-03-18 10:12:30','admin','admin update data :  minimum_quantity = \'11\' where  device_id = 3 from device_list table on 2021/03/18 17:12:30'),(3322,'2021-03-18 10:28:01','admin','admin update data :  minimum_quantity = \'2\' where  device_id = 3 from device_list table on 2021/03/18 17:28:01'),(3323,'2021-03-18 10:28:23','admin','admin update data :  minimum_quantity = \'22\' where  device_id = 3 from device_list table on 2021/03/18 17:28:23'),(3324,'2021-03-29 07:52:05','admin','admin insert new data into the system_settings table on 2021/03/29 14:52:05'),(3325,'2021-03-29 07:53:21','admin','admin update data :  setting_value=\'Dadan Dahlan asdf\' where  setting_name=\'inventory_users\' from system_settings table on 2021/03/29 14:53:21'),(3326,'2021-03-30 13:18:30','admin','admin update data :  component_name = \'BPP\', component_page = \'bpp.php\', active = \'yes\' where  component_id = \'10\'  from component table on 2021/03/30 20:18:30'),(3327,'2021-03-30 13:18:31','admin','admin update data :  component_name = \'BPP\', component_page = \'bpp.php\', active = \'yes\' where  component_id = \'10\'  from component table on 2021/03/30 20:18:31');
/*!40000 ALTER TABLE `system_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_settings` (
  `setting_name` varchar(50) NOT NULL COMMENT 'Setting Name',
  `setting_value` text NOT NULL COMMENT 'Values',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_settings`
--

LOCK TABLES `system_settings` WRITE;
/*!40000 ALTER TABLE `system_settings` DISABLE KEYS */;
INSERT INTO `system_settings` VALUES ('admin_email','admin@is_inventory.com','yes','system','2015-12-10 09:33:16','system','2015-12-10 09:33:16',0),('body_background','symphony.png','yes','system','2015-12-10 09:33:16','admin','2020-11-11 09:10:33',8),('color_scheme','site-aqua.min.css','yes','system','2015-12-10 09:33:16','admin','2020-08-28 08:59:22',7),('device_code_format','devtype/ilham-ganteng/','yes','system','2016-11-09 10:48:25','admin','2021-03-12 23:03:52',5),('favicon','favicon.ico','no','system','2015-12-10 09:33:16','system','2015-12-10 09:33:16',0),('inventory_description','<p><strong><em>Inventory System is still under construction!</em></strong></p>','yes','system','2015-12-10 09:33:16','cakra','2020-09-02 14:16:45',3),('inventory_email','','yes','system','2015-12-10 09:33:16','admin','2016-11-12 11:51:41',1),('inventory_fax_number','','yes','system','2015-12-10 09:33:16','admin','2016-11-12 11:51:41',1),('inventory_location','<p><span class=\"LrzXr\">Jl. Kh. Term. A. Khotib No.30, RW.5, Cipare, Kec. Serang, Kota Serang, Banten 42117</span></p>','yes','system','2015-12-10 09:33:16','admin','2020-08-18 11:33:18',2),('inventory_logo','sclogo.png','yes','system','2015-12-10 09:33:16','admin','2020-08-19 13:56:44',4),('inventory_name','Inventory System','yes','system','2015-12-10 09:33:16','cakra','2020-09-02 14:16:45',1),('inventory_phone_number','(0254) 201443','yes','system','2015-12-10 09:33:16','admin','2020-08-18 11:33:18',2),('inventory_slogan','Perumda Tirta Albantani | Kabupaten Serang','yes','system','2015-12-10 09:33:16','admin','2020-10-12 09:03:21',3),('inventory_users','Dadan Dahlan asdf','yes','admin','2021-03-29 07:52:05','admin','2021-03-29 07:53:21',1),('inventory_website','www.tirtalabantani.web.id','yes','system','2015-12-10 09:33:16','admin','2020-11-11 09:10:33',3),('location_details','disable','yes','system','2016-11-02 11:14:23','admin','2020-08-28 08:46:56',11);
/*!40000 ALTER TABLE `system_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_privileges`
--

DROP TABLE IF EXISTS `user_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_privileges` (
  `username` varchar(30) NOT NULL,
  `privileges` text NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_privileges`
--

LOCK TABLES `user_privileges` WRITE;
/*!40000 ALTER TABLE `user_privileges` DISABLE KEYS */;
INSERT INTO `user_privileges` VALUES ('admin','*','admin','2015-12-10 08:00:24','admin','2015-12-10 08:00:24',0),('andri','5,6,7,9,10','admin','2020-11-09 09:02:00','admin','2020-11-09 09:03:15',3),('asqo','5,6,7','admin','2020-11-09 08:59:21','admin','2020-11-09 09:09:36',2),('demo','5,6,7,8,9,10','admin','2020-11-24 08:56:50','admin','2020-11-24 08:56:50',0),('faw26','5,6,7','admin','2021-01-30 17:07:03','admin','2021-01-30 17:07:03',0),('ilham','5,6,7,9,10,18','admin','2021-03-12 12:45:01','ilham','2021-03-15 08:03:31',2),('per123','5,6,7,9 ','admin','2021-01-30 17:10:06','admin','2021-01-30 17:10:06',0);
/*!40000 ALTER TABLE `user_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(30) NOT NULL COMMENT 'Unique Username',
  `password` varchar(128) NOT NULL COMMENT 'SHA512',
  `salt` varchar(64) NOT NULL COMMENT 'Random String SHA256',
  `level` enum('admin','user') NOT NULL DEFAULT 'user' COMMENT 'User Level',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'User Active Status',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `photo` text COMMENT 'User Photo Profile - Set default if empty',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint NOT NULL DEFAULT '0' COMMENT 'Total Profile Changes/Revision',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','24ce1033bdfe226997340a7104d79eeb43a54a27c101da24a5eb465c90a10800d6f8671346158f0ecf2efb4f1440f45e9c16fbc3e45d3e53e2bb94839781e95f','1f78147ac76487d519cdf84a31df14b84948c6a01f763b522df896c75a5d7e4f','admin','yes','Super','User','./assets/images/user_photos/standard_photo.jpg','admin','2015-12-02 11:26:49','admin','2020-10-12 14:15:47',5),('andri','2e65698fdaf9b8572102cb61d973b044f83705895279cdaf1077d581f2a22dcce836dd458eaed8d08384dfd2bdac042ded0d008f28c6e26762f1e6ff0f670abb','66fa0a374a61b727df7a158a71683328d3dd203040c9fccdaba59380f60e0010','user','yes','Andri','Koplak','./assets/images/user_photos/andri.jpg','admin','2020-11-09 09:02:00','admin','2020-11-09 09:03:14',3),('asqo','424112349e37d8bf3a581e1dd9e286414e03e3225c6cfa117fad1d3b527c94a5ac149f7edecc3d87f81db24072c33df8ce081168a9fd0d23f9671e24390b1987','f7f05c8903997b134ee37bccf169e8b669abe9a19d32379d4217c70da11b222f','user','yes','Ahmad','Asqolani','./assets/images/user_photos/standard_photo.jpg','admin','2020-11-09 08:59:20','admin','2020-11-09 09:09:36',2),('demo','30e863b774da42c7cd1e374b3ea089fcdb1308e44fc23a4f2e9507ba24b46274c1229b672ae1bbfa5e6636e2c52399670670e727e0a1ba3e270d692ebe485252','c86e1c37714c42d89b13bbad76ef236bd33080105d79af0f476d55dd50df3849','user','yes','Demo','App','./assets/images/user_photos/demo.png','admin','2020-11-24 08:56:50','admin','2020-11-24 08:56:50',0),('faw26','f10c13056ca047817c9c50c86401854745568edcab5b8d7d2b85c62cf15a241e1ba474e8cf86432fbb37c83ab63b5d748c51733b50a07db6d26b11dcf3f62f49','14ca9ce26d11172c6fcb8a5c6ca1247e82ed44c01f4fd8b972c923fd195b3996','user','yes','Fuadi','Ramdani','./assets/images/user_photos/standard_photo.jpg','admin','2021-01-30 17:07:03','admin','2021-01-30 17:07:03',0),('ilham','fed84450f009a5f8c601c049fc7196f25c991315d2005f8e227a43f69dd45d51141456f7e3e1e10d9ba3d22675e83b66cb39957490508a78829237e29b8f3451','7ea0973e76f0ed41e713814215686b0ed81b993bfac967b52e5f5b99977a6266','user','yes','Mohamad','Ilham Ramadhan Ganteng','./assets/images/user_photos/standard_photo.jpg','admin','2021-03-12 12:45:01','ilham','2021-03-15 08:03:31',2),('per123','3405035d5e913372c1de5b88ef1690721a83d7ea6186eb64ed19cf66ab72fc17186950db7fccdb36a108966c00ea6da135787731083b75b05322cebe30196a70','df9ac80229ce6f27d15e3e0ab171e2d96a202e787614e56267a204166f91ccaa','user','yes','permana','cakra','./assets/images/user_photos/standard_photo.jpg','admin','2021-01-30 17:10:06','admin','2021-01-30 17:10:06',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-30 13:19:50
