-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: makio
-- ------------------------------------------------------
-- Server version	5.7.17-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `p_id` varchar(5) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_description` varchar(300) NOT NULL,
  `p_category` varchar(30) NOT NULL,
  `p_image_id` varchar(500) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_available` tinyint(1) NOT NULL,
  `p_stock` int(11) NOT NULL,
  `p_categorytype` int(11) DEFAULT NULL,
  `ptype` varchar(45) DEFAULT NULL,
  `ptype_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('1','Paneer Masala','Paneer Masala Description','indian','cv1wVOtRnmMJtzNlo4Ew_2',20,1,100,1,'Indian',1),('2','Tandoori Chicken','Tandoori Description','indian','CARLvOcNTQmqVv42rhFz_1',30,1,100,1,'Italian',1),('3','Gopi Manchurian','Gopi Description','italian','JhMIxzQXmB03SXPg84Iw_3',20,1,100,1,'Italian',1),('4','Grilled Chicken','Grilled Chicken Description','indian','d5R11v9fRuvAx8wKYIWP_4',40,1,100,1,'Indian',2),('5','Chana Masala','Chana Masala Description','indian','JhMIxzQXmB03SXPg84Iw_3',10,1,100,1,'Indian',NULL),('6','Makio','Jumper by Makio','Jumper','clothe1',50,1,100,2,'Jumper',NULL),('7','Makio Classic','Classic Jumper By Makio','Jumper','clothe2',70,1,100,2,'Jumper',NULL),('8','Full Clothing 1','Full Clothing by Makio','Full Set','clothe3',100,1,100,2,'Full Set',NULL),('9','Leather 1','Full Leather Chair','Full Set','furniture2',500,1,100,3,'Full Set',NULL),('10','Chair','Office Chair','Leather','furniture4',300,1,100,3,'Leather',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-07 20:21:20
