-- MySQL dump 10.13  Distrib 8.3.0, for Linux (x86_64)
--
-- Host: localhost    Database: BusBooking
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrators` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES (1,'Admin','admin','$2y$10$VJJzVr8Hjb0R0gFl4DgTp.hHgofZvwnKnA6cY8CwoFGblAz.Y7pDm','1');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `schedule_id` int NOT NULL,
  `book_date` datetime NOT NULL,
  `quantity` int NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `schedule_id` (`schedule_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_utilities`
--

DROP TABLE IF EXISTS `bus_utilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bus_utilities` (
  `bus_id` int NOT NULL,
  `utility_id` int NOT NULL,
  PRIMARY KEY (`bus_id`,`utility_id`),
  KEY `utility_id` (`utility_id`),
  CONSTRAINT `bus_utilities_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`),
  CONSTRAINT `bus_utilities_ibfk_2` FOREIGN KEY (`utility_id`) REFERENCES `utilities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_utilities`
--

LOCK TABLES `bus_utilities` WRITE;
/*!40000 ALTER TABLE `bus_utilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `bus_utilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `seat_number` int NOT NULL,
  `status` int DEFAULT NULL,
  `vehicle_type_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_type_id` (`vehicle_type_id`),
  CONSTRAINT `buses_ibfk_1` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buses`
--

LOCK TABLES `buses` WRITE;
/*!40000 ALTER TABLE `buses` DISABLE KEYS */;
INSERT INTO `buses` VALUES (4,'Đức Phúc Limousine ','20G - 00028',9,1,NULL);
/*!40000 ALTER TABLE `buses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `amount` float NOT NULL,
  `proof_image` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `listed_price` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (1,'Hà Nội','Thái Nguyên',140000),(2,'Thái Nguyên','Hà Nội',140000),(3,'Nội Bài','Thái Nguyên',160000),(4,'Thái Nguyên','Nội Bài',160000);
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bus_id` int NOT NULL,
  `route_id` int NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `price` float NOT NULL,
  `policies` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_id` (`bus_id`),
  KEY `route_id` (`route_id`),
  CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`),
  CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (12,4,2,'2024-03-31 16:00:00','2024-03-31 18:00:00',140000,NULL),(13,4,2,'2024-04-01 16:00:00','2024-04-01 18:00:00',140000,NULL),(14,4,2,'2024-04-02 16:00:00','2024-04-02 18:00:00',140000,NULL),(15,4,2,'2024-04-03 16:00:00','2024-04-03 18:00:00',140000,NULL),(16,4,2,'2024-04-04 16:00:00','2024-04-04 18:00:00',140000,NULL),(17,4,2,'2024-04-05 16:00:00','2024-04-05 18:00:00',140000,NULL),(18,4,2,'2024-04-06 16:00:00','2024-04-06 18:00:00',140000,NULL),(19,4,2,'2024-04-07 16:00:00','2024-04-07 18:00:00',140000,NULL),(25,4,2,'2024-04-06 16:00:00','2024-04-06 18:00:00',140000,NULL),(27,4,2,'2024-04-08 16:00:00','2024-04-08 18:00:00',140000,NULL),(28,4,1,'2024-04-04 06:00:00','2024-04-04 08:00:00',120000,NULL),(29,4,1,'2024-04-04 06:00:00','2024-04-04 08:00:00',120000,NULL),(30,4,1,'2024-04-05 06:00:00','2024-04-05 08:00:00',120000,NULL),(31,4,1,'2024-04-06 06:00:00','2024-04-06 08:00:00',120000,NULL),(32,4,1,'2024-04-07 06:00:00','2024-04-07 08:00:00',120000,NULL),(33,4,1,'2024-04-08 06:00:00','2024-04-08 08:00:00',120000,NULL),(34,4,1,'2024-04-09 06:00:00','2024-04-09 08:00:00',120000,NULL),(35,4,1,'2024-04-10 06:00:00','2024-04-10 08:00:00',120000,NULL),(36,4,1,'2024-04-11 06:00:00','2024-04-11 08:00:00',120000,NULL),(37,4,1,'2024-04-12 06:00:00','2024-04-12 08:00:00',120000,NULL),(38,4,1,'2024-04-13 06:00:00','2024-04-13 08:00:00',120000,NULL),(39,4,1,'2024-04-14 06:00:00','2024-04-14 08:00:00',120000,NULL),(40,4,1,'2024-04-15 06:00:00','2024-04-15 08:00:00',120000,NULL),(41,4,1,'2024-04-16 06:00:00','2024-04-16 08:00:00',120000,NULL),(42,4,1,'2024-04-17 06:00:00','2024-04-17 08:00:00',120000,NULL),(43,4,1,'2024-04-18 06:00:00','2024-04-18 08:00:00',120000,NULL),(44,4,1,'2024-04-19 06:00:00','2024-04-19 08:00:00',120000,NULL),(45,4,1,'2024-04-20 06:00:00','2024-04-20 08:00:00',120000,NULL),(46,4,1,'2024-04-21 06:00:00','2024-04-21 08:00:00',120000,NULL),(47,4,1,'2024-04-22 06:00:00','2024-04-22 08:00:00',120000,NULL),(48,4,1,'2024-04-23 06:00:00','2024-04-23 08:00:00',120000,NULL),(49,4,1,'2024-04-24 06:00:00','2024-04-24 08:00:00',120000,NULL),(50,4,1,'2024-04-25 06:00:00','2024-04-25 08:00:00',120000,NULL),(51,4,1,'2024-04-26 06:00:00','2024-04-26 08:00:00',120000,NULL),(52,4,1,'2024-04-27 06:00:00','2024-04-27 08:00:00',120000,NULL),(53,4,1,'2024-04-28 06:00:00','2024-04-28 08:00:00',120000,NULL),(54,4,1,'2024-04-29 06:00:00','2024-04-29 08:00:00',120000,NULL);
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stop_points`
--

DROP TABLE IF EXISTS `stop_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stop_points` (
  `id` int NOT NULL AUTO_INCREMENT,
  `schedule_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `arrival_time` datetime DEFAULT NULL,
  `sequence` int NOT NULL,
  `is_lock` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_id` (`schedule_id`),
  CONSTRAINT `stop_points_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stop_points`
--

LOCK TABLES `stop_points` WRITE;
/*!40000 ALTER TABLE `stop_points` DISABLE KEYS */;
INSERT INTO `stop_points` VALUES (33,12,'Thái Nguyên','2024-03-31 16:00:00',1,1),(34,12,'Sông Công','2024-03-31 16:20:00',2,0),(35,12,'Hà Nội','2024-03-31 18:00:00',3,1),(39,14,'Thái Nguyên','2024-04-02 16:00:00',1,1),(40,14,'Sông Công','2024-04-02 16:20:00',2,0),(41,14,'Hà Nội','2024-04-02 18:00:00',3,1),(42,15,'Thái Nguyên','2024-04-03 16:00:00',1,1),(43,15,'Sông Công','2024-04-03 16:20:00',2,0),(44,15,'Hà Nội','2024-04-03 18:00:00',3,1),(45,16,'Thái Nguyên','2024-04-04 16:00:00',1,1),(46,16,'Sông Công','2024-04-04 16:20:00',2,0),(47,16,'Hà Nội','2024-04-04 18:00:00',3,1),(48,17,'Thái Nguyên','2024-04-05 16:00:00',1,1),(49,17,'Sông Công','2024-04-05 16:20:00',2,0),(50,17,'Hà Nội','2024-04-05 18:00:00',3,1),(51,18,'Thái Nguyên','2024-04-06 16:00:00',1,1),(52,18,'Sông Công','2024-04-06 16:20:00',2,0),(53,18,'Hà Nội','2024-04-06 18:00:00',3,1),(54,19,'Thái Nguyên','2024-04-07 16:00:00',1,1),(55,19,'Sông Công','2024-04-07 16:20:00',2,0),(56,19,'Hà Nội','2024-04-07 18:00:00',3,1),(72,25,'Thái Nguyên','2024-04-06 16:00:00',1,1),(73,25,'Sông Công','2024-04-06 16:20:00',2,0),(74,25,'Hà Nội','2024-04-06 18:00:00',3,1),(78,27,'Thái Nguyên','2024-04-08 16:00:00',1,1),(79,27,'Sông Công','2024-04-08 16:20:00',2,0),(80,27,'Hà Nội','2024-04-08 18:00:00',3,1),(85,13,'Thái Nguyên','2024-04-01 16:00:00',1,1),(86,13,'Sông Công','2024-04-01 16:20:00',2,0),(87,13,'Nội bài','2024-04-01 17:00:00',3,0),(88,13,'Hà Nội','2024-04-01 18:00:00',4,1),(89,28,'Hà Nội','2024-04-04 06:00:00',1,1),(90,28,'Nội Bài','2024-04-04 07:00:00',2,0),(91,28,'Sông Công','2024-04-04 07:30:00',3,0),(92,28,'Thái Nguyên','2024-04-04 08:00:00',4,1),(93,29,'Hà Nội','2024-04-04 06:00:00',1,1),(94,29,'Nội Bài','2024-04-04 07:00:00',2,0),(95,29,'Sông Công','2024-04-04 07:30:00',3,0),(96,29,'Thái Nguyên','2024-04-04 08:00:00',4,1),(97,30,'Hà Nội','2024-04-05 06:00:00',1,1),(98,30,'Nội Bài','2024-04-05 07:00:00',2,0),(99,30,'Sông Công','2024-04-05 07:30:00',3,0),(100,30,'Thái Nguyên','2024-04-05 08:00:00',4,1),(101,31,'Hà Nội','2024-04-06 06:00:00',1,1),(102,31,'Nội Bài','2024-04-06 07:00:00',2,0),(103,31,'Sông Công','2024-04-06 07:30:00',3,0),(104,31,'Thái Nguyên','2024-04-06 08:00:00',4,1),(105,32,'Hà Nội','2024-04-07 06:00:00',1,1),(106,32,'Nội Bài','2024-04-07 07:00:00',2,0),(107,32,'Sông Công','2024-04-07 07:30:00',3,0),(108,32,'Thái Nguyên','2024-04-07 08:00:00',4,1),(109,33,'Hà Nội','2024-04-08 06:00:00',1,1),(110,33,'Nội Bài','2024-04-08 07:00:00',2,0),(111,33,'Sông Công','2024-04-08 07:30:00',3,0),(112,33,'Thái Nguyên','2024-04-08 08:00:00',4,1),(113,34,'Hà Nội','2024-04-09 06:00:00',1,1),(114,34,'Nội Bài','2024-04-09 07:00:00',2,0),(115,34,'Sông Công','2024-04-09 07:30:00',3,0),(116,34,'Thái Nguyên','2024-04-09 08:00:00',4,1),(117,35,'Hà Nội','2024-04-10 06:00:00',1,1),(118,35,'Nội Bài','2024-04-10 07:00:00',2,0),(119,35,'Sông Công','2024-04-10 07:30:00',3,0),(120,35,'Thái Nguyên','2024-04-10 08:00:00',4,1),(121,36,'Hà Nội','2024-04-11 06:00:00',1,1),(122,36,'Nội Bài','2024-04-11 07:00:00',2,0),(123,36,'Sông Công','2024-04-11 07:30:00',3,0),(124,36,'Thái Nguyên','2024-04-11 08:00:00',4,1),(125,37,'Hà Nội','2024-04-12 06:00:00',1,1),(126,37,'Nội Bài','2024-04-12 07:00:00',2,0),(127,37,'Sông Công','2024-04-12 07:30:00',3,0),(128,37,'Thái Nguyên','2024-04-12 08:00:00',4,1),(129,38,'Hà Nội','2024-04-13 06:00:00',1,1),(130,38,'Nội Bài','2024-04-13 07:00:00',2,0),(131,38,'Sông Công','2024-04-13 07:30:00',3,0),(132,38,'Thái Nguyên','2024-04-13 08:00:00',4,1),(133,39,'Hà Nội','2024-04-14 06:00:00',1,1),(134,39,'Nội Bài','2024-04-14 07:00:00',2,0),(135,39,'Sông Công','2024-04-14 07:30:00',3,0),(136,39,'Thái Nguyên','2024-04-14 08:00:00',4,1),(137,40,'Hà Nội','2024-04-15 06:00:00',1,1),(138,40,'Nội Bài','2024-04-15 07:00:00',2,0),(139,40,'Sông Công','2024-04-15 07:30:00',3,0),(140,40,'Thái Nguyên','2024-04-15 08:00:00',4,1),(141,41,'Hà Nội','2024-04-16 06:00:00',1,1),(142,41,'Nội Bài','2024-04-16 07:00:00',2,0),(143,41,'Sông Công','2024-04-16 07:30:00',3,0),(144,41,'Thái Nguyên','2024-04-16 08:00:00',4,1),(145,42,'Hà Nội','2024-04-17 06:00:00',1,1),(146,42,'Nội Bài','2024-04-17 07:00:00',2,0),(147,42,'Sông Công','2024-04-17 07:30:00',3,0),(148,42,'Thái Nguyên','2024-04-17 08:00:00',4,1),(149,43,'Hà Nội','2024-04-18 06:00:00',1,1),(150,43,'Nội Bài','2024-04-18 07:00:00',2,0),(151,43,'Sông Công','2024-04-18 07:30:00',3,0),(152,43,'Thái Nguyên','2024-04-18 08:00:00',4,1),(153,44,'Hà Nội','2024-04-19 06:00:00',1,1),(154,44,'Nội Bài','2024-04-19 07:00:00',2,0),(155,44,'Sông Công','2024-04-19 07:30:00',3,0),(156,44,'Thái Nguyên','2024-04-19 08:00:00',4,1),(157,45,'Hà Nội','2024-04-20 06:00:00',1,1),(158,45,'Nội Bài','2024-04-20 07:00:00',2,0),(159,45,'Sông Công','2024-04-20 07:30:00',3,0),(160,45,'Thái Nguyên','2024-04-20 08:00:00',4,1),(161,46,'Hà Nội','2024-04-21 06:00:00',1,1),(162,46,'Nội Bài','2024-04-21 07:00:00',2,0),(163,46,'Sông Công','2024-04-21 07:30:00',3,0),(164,46,'Thái Nguyên','2024-04-21 08:00:00',4,1),(165,47,'Hà Nội','2024-04-22 06:00:00',1,1),(166,47,'Nội Bài','2024-04-22 07:00:00',2,0),(167,47,'Sông Công','2024-04-22 07:30:00',3,0),(168,47,'Thái Nguyên','2024-04-22 08:00:00',4,1),(169,48,'Hà Nội','2024-04-23 06:00:00',1,1),(170,48,'Nội Bài','2024-04-23 07:00:00',2,0),(171,48,'Sông Công','2024-04-23 07:30:00',3,0),(172,48,'Thái Nguyên','2024-04-23 08:00:00',4,1),(173,49,'Hà Nội','2024-04-24 06:00:00',1,1),(174,49,'Nội Bài','2024-04-24 07:00:00',2,0),(175,49,'Sông Công','2024-04-24 07:30:00',3,0),(176,49,'Thái Nguyên','2024-04-24 08:00:00',4,1),(177,50,'Hà Nội','2024-04-25 06:00:00',1,1),(178,50,'Nội Bài','2024-04-25 07:00:00',2,0),(179,50,'Sông Công','2024-04-25 07:30:00',3,0),(180,50,'Thái Nguyên','2024-04-25 08:00:00',4,1),(181,51,'Hà Nội','2024-04-26 06:00:00',1,1),(182,51,'Nội Bài','2024-04-26 07:00:00',2,0),(183,51,'Sông Công','2024-04-26 07:30:00',3,0),(184,51,'Thái Nguyên','2024-04-26 08:00:00',4,1),(185,52,'Hà Nội','2024-04-27 06:00:00',1,1),(186,52,'Nội Bài','2024-04-27 07:00:00',2,0),(187,52,'Sông Công','2024-04-27 07:30:00',3,0),(188,52,'Thái Nguyên','2024-04-27 08:00:00',4,1),(189,53,'Hà Nội','2024-04-28 06:00:00',1,1),(190,53,'Nội Bài','2024-04-28 07:00:00',2,0),(191,53,'Sông Công','2024-04-28 07:30:00',3,0),(192,53,'Thái Nguyên','2024-04-28 08:00:00',4,1),(193,54,'Hà Nội','2024-04-29 06:00:00',1,1),(194,54,'Nội Bài','2024-04-29 07:00:00',2,0),(195,54,'Sông Công','2024-04-29 07:30:00',3,0),(196,54,'Thái Nguyên','2024-04-29 08:00:00',4,1);
/*!40000 ALTER TABLE `stop_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `passenger_name` varchar(100) NOT NULL,
  `seat_numbers` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Trung Nguyen','viettrungcntt03@gmail.com','$2y$10$VJJzVr8Hjb0R0gFl4DgTp.hHgofZvwnKnA6cY8CwoFGblAz.Y7pDm','',NULL),(2,'Việt Trung','a@gmail.com','$2y$10$v/XTJCO6dKRc0fzwxF3ZNenKxRSqgiPN4Sdbv1m1eujxdJQhBQrtG','',NULL),(3,'Trung Nguyen','a1@gmail.com','$2y$10$EfBW7.KPPwoQqF20iJl17.PUQJEV5ZwWpsNnS3HwFGg9dqlGb8z96','',NULL),(4,'Trung Nguyen','34627xuantran@gmail.com','$2y$10$YSLBJXm5GSg44zH.S8eXzeGTy3mXL1QmL0UZ29TGBX2ef5vOuM3BO','',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilities`
--

DROP TABLE IF EXISTS `utilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilities`
--

LOCK TABLES `utilities` WRITE;
/*!40000 ALTER TABLE `utilities` DISABLE KEYS */;
INSERT INTO `utilities` VALUES (1,'Wifi','Cung cấp dịch vụ Wifi miễn phí cho hành khách'),(2,'Cổng sạc USB','Cổng sạc USB cho phép hành khách sạc thiết bị điện tử'),(3,'LCD','Màn hình LCD để phát các chương trình giải trí'),(4,'Nước uống','Cung cấp nước uống miễn phí cho hành khách'),(5,'Khăn lạnh','Cung cấp khăn lạnh cho hành khách để làm mát'),(6,'Điều hòa','Hệ thống điều hòa nhiệt độ để đảm bảo sự thoải mái cho hành khách'),(7,'Chăn đắp','Cung cấp chăn đắp cho hành khách trong suốt hành trình');
/*!40000 ALTER TABLE `utilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_types`
--

DROP TABLE IF EXISTS `vehicle_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_types`
--

LOCK TABLES `vehicle_types` WRITE;
/*!40000 ALTER TABLE `vehicle_types` DISABLE KEYS */;
INSERT INTO `vehicle_types` VALUES (1,'Xe khách','Xe chở khách với cấu hình ghế tiêu chuẩn, phù hợp cho các chuyến đi ngắn.'),(2,'Xe bus','Xe bus lớn, thường được sử dụng cho các tuyến đường dài và có khả năng chứa nhiều hành khách.'),(3,'Xe limousine','Xe cao cấp với các tiện nghi nâng cao, cung cấp trải nghiệm thoải mái và sang trọng nhất.');
/*!40000 ALTER TABLE `vehicle_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-03 13:22:42
