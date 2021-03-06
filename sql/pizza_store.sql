-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: pizza_store
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

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
-- Table structure for table `ORDER_PIZZA`
--

DROP TABLE IF EXISTS `ORDER_PIZZA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ORDER_PIZZA` (
  `ORD_ID` int NOT NULL,
  `PIZZA_ID` int NOT NULL,
  PRIMARY KEY (`ORD_ID`,`PIZZA_ID`),
  KEY `PIZZA_ID` (`PIZZA_ID`),
  CONSTRAINT `ORDER_PIZZA_ibfk_1` FOREIGN KEY (`ORD_ID`) REFERENCES `TBLORDER` (`ORD_ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ORDER_PIZZA_ibfk_2` FOREIGN KEY (`PIZZA_ID`) REFERENCES `TBLPIZZA` (`PIZZA_ID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ORDER_PIZZA`
--

LOCK TABLES `ORDER_PIZZA` WRITE;
/*!40000 ALTER TABLE `ORDER_PIZZA` DISABLE KEYS */;
/*!40000 ALTER TABLE `ORDER_PIZZA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBLCUSTOMERS`
--

DROP TABLE IF EXISTS `TBLCUSTOMERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TBLCUSTOMERS` (
  `CUST_ID` int NOT NULL AUTO_INCREMENT,
  `CUST_EMAIL` varchar(30) NULL,
  `CUST_NAME` varchar(30) DEFAULT NULL,  
  `CUST_ADDRESS` varchar(50) DEFAULT NULL,
  `CUST_PHONE` varchar(50) DEFAULT NULL,  
  `CUST_PROVINCE` varchar(50) DEFAULT NULL,
  `CUST_CITY` varchar(50) DEFAULT NULL,
  `CUST_POSTALCODE` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`CUST_ID`),
  UNIQUE KEY `UC_TBLCUSTOMERS` (`CUST_ID`,`CUST_EMAIL`),
  UNIQUE KEY `CUST_EMAIL` (`CUST_EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBLCUSTOMERS`
--

LOCK TABLES `TBLCUSTOMERS` WRITE;
/*!40000 ALTER TABLE `TBLCUSTOMERS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBLCUSTOMERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBLORDER`
--

DROP TABLE IF EXISTS `TBLORDER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TBLORDER` (
  `ORD_ID` int NOT NULL AUTO_INCREMENT,
  `CUST_ID` int NOT NULL,
  `ORD_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ORD_ID`),
  KEY `FK_CUSTID` (`CUST_ID`),
  CONSTRAINT `FK_CUSTID` FOREIGN KEY (`CUST_ID`) REFERENCES `TBLCUSTOMERS` (`CUST_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBLORDER`
--

LOCK TABLES `TBLORDER` WRITE;
/*!40000 ALTER TABLE `TBLORDER` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBLORDER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBLPIZZA`
--

DROP TABLE IF EXISTS `TBLPIZZA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TBLPIZZA` (
  `PIZZA_ID` int NOT NULL AUTO_INCREMENT,
  `PIZZA_DOUGH` varchar(50) NOT NULL,
  `PIZZA_CHEESE` varchar(50) NOT NULL,
  `PIZZA_SAUCE` varchar(50) NOT NULL,
  `PIZZA_TOPPING1` varchar(50) NOT NULL,
  `PIZZA_TOPPING2` varchar(50) DEFAULT NULL,
  `PIZZA_TOPPING3` varchar(50) DEFAULT NULL,
  `PIZZA_TOPPING4` varchar(50) DEFAULT NULL,
  `PIZZA_TOPPING5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PIZZA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBLPIZZA`
--

LOCK TABLES `TBLPIZZA` WRITE;
/*!40000 ALTER TABLE `TBLPIZZA` DISABLE KEYS */;
-- INSERT INTO `TBLPIZZA` VALUES (1,'Thin','Cheddar','Ranch','',NULL,NULL,NULL,NULL),(2,'Thick','Mozzarella','Marinara','',NULL,NULL,NULL,NULL),(3,'Thin','Double Cheddar','Pizza Sauce','',NULL,NULL,NULL,NULL),(4,'Flatbread','Fetta Cheese','Sweet Basil','',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `TBLPIZZA` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-26 22:24:23