-- MySQL dump 10.13  Distrib 8.4.0, for Linux (x86_64)
--
-- Host: localhost    Database: BusBooking
-- ------------------------------------------------------
-- Server version	8.4.0

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
  `origin` int DEFAULT NULL,
  `destination` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'unpaid',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
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
-- Table structure for table `bus_offices`
--

DROP TABLE IF EXISTS `bus_offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bus_offices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bus_id` int NOT NULL,
  `office_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_id` (`bus_id`),
  CONSTRAINT `bus_offices_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_offices`
--

LOCK TABLES `bus_offices` WRITE;
/*!40000 ALTER TABLE `bus_offices` DISABLE KEYS */;
INSERT INTO `bus_offices` VALUES (1,4,'Vp Thống Nhất: 266 Thống Nhất, Thái Nguyên.'),(2,4,'Vp Chùa Hàng: Tổ 8, Chùa Hàng, Thái Nguyên.'),(3,4,'Vp Túc Duyên: Tổ 13, Túc Duyên, Thái Nguyên.');
/*!40000 ALTER TABLE `bus_offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_phones`
--

DROP TABLE IF EXISTS `bus_phones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bus_phones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bus_id` int NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_id` (`bus_id`),
  CONSTRAINT `bus_phones_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_phones`
--

LOCK TABLES `bus_phones` WRITE;
/*!40000 ALTER TABLE `bus_phones` DISABLE KEYS */;
INSERT INTO `bus_phones` VALUES (1,4,'02439900333'),(2,4,'0902252200');
/*!40000 ALTER TABLE `bus_phones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_slides`
--

DROP TABLE IF EXISTS `bus_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bus_slides` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bus_id` int NOT NULL,
  `slide_url` varchar(255) NOT NULL,
  `slide_type` enum('image','video') NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `bus_id` (`bus_id`),
  CONSTRAINT `bus_slides_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_slides`
--

LOCK TABLES `bus_slides` WRITE;
/*!40000 ALTER TABLE `bus_slides` DISABLE KEYS */;
INSERT INTO `bus_slides` VALUES (1,4,'1709783165_xe-duc-phuc-limousine-thai-nguyen-01.jpg','image',NULL),(2,4,'1709783165_xe-duc-phuc-limousine-thai-nguyen-02.jpg','image',NULL),(3,4,'1709783165_xe-duc-phuc-limousine-thai-nguyen-03.jpg','image',NULL),(4,4,'1709783165_xe-duc-phuc-limousine-thai-nguyen-04.jpg','image',NULL),(5,4,'1709783165_xe-duc-phuc-limousine-thai-nguyen-05.jpg','image',NULL),(6,4,'1709783165_xe-duc-phuc-limousine-thai-nguyen-06.jpg','image',NULL),(7,4,'1709783165_xe-duc-phuc-limousine-thai-nguyen-07.jpg','image',NULL);
/*!40000 ALTER TABLE `bus_slides` ENABLE KEYS */;
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
INSERT INTO `bus_utilities` VALUES (4,1),(4,2),(4,3),(4,4),(4,5),(4,6);
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
  `description` text,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `vehicle_type_id` (`vehicle_type_id`),
  CONSTRAINT `buses_ibfk_1` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buses`
--

LOCK TABLES `buses` WRITE;
/*!40000 ALTER TABLE `buses` DISABLE KEYS */;
INSERT INTO `buses` VALUES (4,'Đức Phúc Limousine ','20G - 00028',9,1,3,'<p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: helveticaneue, sans-serif, Arial; font-size: 14px; text-align: justify; user-select: text !important;\"><strong style=\"font-weight: bold; user-select: text !important;\">Hãng xe Đức Phúc Limousine</strong>&nbsp;thuộc Công ty TNHH vận tải du lịch Đức Phúc. Xe Đức Phúc Limousine, tiền thân là hãng xe NewStar Limousine, là một trong những hãng xe Limousine đầu tiên trên tuyến Hà Nội - Thái Nguyên, Nội Bài - Thái Nguyên. Với đội ngũ nhân viên nhiệt tình, hệ thông xe chất lượng, xe Đức Phúc Limousine đã và luôn&nbsp;được nhiều khách hàng tin tưởng, chọn lựa.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: helveticaneue, sans-serif, Arial; font-size: 14px; text-align: justify; user-select: text !important;\"><strong style=\"font-weight: bold; user-select: text !important;\">Xe Đức Phúc Limousine&nbsp;</strong>sử dụng dòng xe&nbsp;Limousine Dcar VIP 9 chỗ được thiết kế từ xe Transit 16 chỗ thông thường, cho không gian sử dụng rộng rãi,&nbsp;đảm bảo sự thư giãn, thoải mái tối đa. Xe có 9 ghế bọc da cao cấp&nbsp;với 2 ghế đầu xe và 7 ghế hạng thương gia&nbsp;ở khoang sau.<strong style=\"font-weight: bold; user-select: text !important;\">&nbsp;</strong>Các ghế đều được bọc da toàn bộ, êm ái, sạch sẽ.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: helveticaneue, sans-serif, Arial; font-size: 14px; text-align: justify; user-select: text !important;\">Trên xe cũng trang bị đầy đủ tiện nghi như: Wifi tốc độ cao, cổng sạc USB mỗi ghế, màn hình Led cỡ lớn 32 inch, chăn đắp và nước&nbsp;uống&nbsp;miễn phí. Nội thất xe còn được trang trí hệ thống đèn LED giọt nước, đèn bầu trời sao mang lại sự thư giãn, thoải mái tối đa cho hành khách.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: helveticaneue, sans-serif, Arial; font-size: 14px; text-align: center; user-select: text !important;\"><img src=\"https://saodieu.vn/media/Anh%20Hang%20Xe%20-%20Dong%20Dau/xe-duc-phuc-limousine-thai-nguyen.jpg\" alt=\"\" width=\"800\" height=\"436\" style=\"border-width: initial; border-color: initial; border-image: initial; max-width: 100%; height: auto; user-select: text !important;\"></p>','<ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: inside; color: rgb(51, 51, 51); font-family: helveticaneue, sans-serif, Arial; font-size: 14px; text-align: justify; user-select: text !important;\"><li style=\"list-style: inside disc; text-align: justify; user-select: text !important;\"><em style=\"user-select: text !important;\">Giá vé áp dụng cho tất cả các ghế. Vị trí chỗ ngồi sẽ do lái xe sắp xếp khi khách lên xe.</em></li><li style=\"list-style: inside disc; text-align: justify; user-select: text !important;\"><em style=\"user-select: text !important;\">Đón trả tận nơi 09 quận nội thành Hà Nội (Hoàn Kiếm, Ba Đình, Tây Hồ, Đống Đa, Mỹ Đình, Cầu Giấy, Hai Bà Trưng, Long Biên) và Sảnh sân bay Nội Bài phụ thu&nbsp;<span style=\"color: rgb(255, 102, 0); user-select: text !important;\">20.000 đ/vé.</span></em></li><li style=\"list-style: inside disc; text-align: justify; user-select: text !important;\"><em style=\"user-select: text !important;\">Đón trả tận nơi Tp Phổ Yên, Tp Sông Công phụ thu&nbsp;<span style=\"color: rgb(255, 102, 0); user-select: text !important;\">20k/vé.</span></em></li><li style=\"list-style: inside disc; text-align: justify; user-select: text !important;\"><em style=\"user-select: text !important;\">Đón trả tận nơi&nbsp;Phú Bình&nbsp;phụ thu&nbsp;<span style=\"color: rgb(255, 102, 0); user-select: text !important;\">40k/vé.</span></em></li><li style=\"list-style: inside disc; text-align: justify; user-select: text !important;\"><em style=\"user-select: text !important;\">Xe đón trả tận nơi có thể là xe Limousine hoặc xe trung chuyển.</em></li><li style=\"list-style: inside disc; text-align: justify; user-select: text !important;\"><em style=\"user-select: text !important;\">Thời gian đón, trả khách tận nơi có thể xê dịch phụ thuộc vào vị trí đón, trả và tình trạng giao thông thực tế.</em></li></ul>');
/*!40000 ALTER TABLE `buses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_methods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` tinyint(1) DEFAULT '1',
  `type` varchar(100) DEFAULT NULL,
  `sort_order` int DEFAULT '999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (5,'Chuyển khoản ngân hàng','<p><span data-tt=\"{&quot;paragraphStyle&quot;:{&quot;alignment&quot;:4,&quot;writingDirection&quot;:1}}\" style=\"white-space-collapse: preserve;\">Tên  TK: Nguyễn Việt Trung \r\n</span></p><p><span data-tt=\"{&quot;paragraphStyle&quot;:{&quot;alignment&quot;:4,&quot;writingDirection&quot;:1}}\" style=\"white-space-collapse: preserve;\">Số TK: 0901000131200\r\n</span></p><p><span data-tt=\"{&quot;paragraphStyle&quot;:{&quot;alignment&quot;:4,&quot;style&quot;:3,&quot;writingDirection&quot;:1}}\" style=\"white-space-collapse: preserve;\">Ngân hàng </span><span data-tt=\"{&quot;paragraphStyle&quot;:{&quot;alignment&quot;:4,&quot;style&quot;:3,&quot;writingDirection&quot;:1}}\" style=\"white-space-collapse: preserve;\">Vietcombank - chi nhánh Hà Nam</span></p>','uploads/payment-methods/1715507810_ce48875451382ef4f56a.jpeg',1,'online',1),(6,'Ví điện tử MoMo','<p>Số tài khoản Momo: 0919047269</p>','uploads/payment-methods/1715508027_a0e6f160a88d78f4ef08.png',1,'online',2),(7,'Thanh toán tiền mặt','<p>Nhân viên sẽ gọi điện để xác nhận đặt vé và hẹn lịch thanh toán.</p><p>Hoặc bạn có thể liên hệ trực tiếp với tổng đài viên:</p><ol><li>Trần Văn Nghiệp:&nbsp;<a href=\"tel:0837841230\" style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">0837841230</a></li><li>Nguyễn Việt Trung:&nbsp;<a href=\"tel:0919047269\" style=\"font-family: &quot;Times New Roman&quot;; font-size: medium;\">0919047269</a></li></ol><p><em style=\"color: rgb(51, 51, 51); font-family: helveticaneue, sans-serif, Arial; font-size: 14px; text-align: justify; user-select: text !important;\">(<span style=\"color: rgb(255, 102, 0); user-select: text !important;\">Lưu ý:</span>&nbsp;Vé của bạn sẽ được giữ nếu vé được xác nhận&nbsp;<span style=\"font-weight: bolder;\">khi hệ thống quản trị duyệt</span>&nbsp;và&nbsp;<span style=\"font-weight: bolder;\">vui lòng kiểm tra mail</span>).</em><br></p>',NULL,1,'offline',3);
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
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
  `method_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  KEY `fk_payment_methods` (`method_id`),
  CONSTRAINT `fk_payment_methods` FOREIGN KEY (`method_id`) REFERENCES `payment_methods` (`id`),
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
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (12,4,2,'2024-03-31 16:00:00','2024-03-31 18:00:00',140000,NULL),(13,4,2,'2024-04-01 16:00:00','2024-04-01 18:00:00',140000,NULL),(14,4,2,'2024-04-02 16:00:00','2024-04-02 18:00:00',140000,NULL),(15,4,2,'2024-04-03 16:00:00','2024-04-03 18:00:00',140000,NULL),(16,4,2,'2024-04-04 16:00:00','2024-04-04 18:00:00',140000,NULL),(17,4,2,'2024-04-05 16:00:00','2024-04-05 18:00:00',140000,NULL),(18,4,2,'2024-04-06 16:00:00','2024-04-06 18:00:00',140000,NULL),(19,4,2,'2024-04-07 16:00:00','2024-04-07 18:00:00',140000,NULL),(25,4,2,'2024-04-06 16:00:00','2024-04-06 18:00:00',140000,NULL),(27,4,2,'2024-04-08 16:00:00','2024-04-08 18:00:00',140000,NULL),(28,4,1,'2024-04-04 06:00:00','2024-04-04 08:00:00',120000,NULL),(29,4,1,'2024-04-04 06:00:00','2024-04-04 08:00:00',120000,NULL),(30,4,1,'2024-04-05 06:00:00','2024-04-05 08:00:00',120000,NULL),(31,4,1,'2024-04-06 06:00:00','2024-04-06 08:00:00',120000,NULL),(32,4,1,'2024-04-07 06:00:00','2024-04-07 08:00:00',120000,NULL),(33,4,1,'2024-04-08 06:00:00','2024-04-08 08:00:00',120000,NULL),(34,4,1,'2024-04-09 06:00:00','2024-04-09 08:00:00',120000,NULL),(35,4,1,'2024-04-10 06:00:00','2024-04-10 08:00:00',120000,NULL),(36,4,1,'2024-04-11 06:00:00','2024-04-11 08:00:00',120000,NULL),(37,4,1,'2024-04-12 06:00:00','2024-04-12 08:00:00',120000,NULL),(38,4,1,'2024-04-13 06:00:00','2024-04-13 08:00:00',120000,NULL),(39,4,1,'2024-04-14 06:00:00','2024-04-14 08:00:00',120000,NULL),(40,4,1,'2024-04-15 06:00:00','2024-04-15 08:00:00',120000,NULL),(41,4,1,'2024-04-16 06:00:00','2024-04-16 08:00:00',120000,NULL),(42,4,1,'2024-04-17 06:00:00','2024-04-17 08:00:00',120000,NULL),(43,4,1,'2024-04-18 06:00:00','2024-04-18 08:00:00',120000,NULL),(44,4,1,'2024-04-19 06:00:00','2024-04-19 08:00:00',120000,NULL),(45,4,1,'2024-04-20 06:00:00','2024-04-20 08:00:00',120000,NULL),(46,4,1,'2024-04-21 06:00:00','2024-04-21 08:00:00',120000,NULL),(47,4,1,'2024-04-22 06:00:00','2024-04-22 08:00:00',120000,NULL),(48,4,1,'2024-04-23 06:00:00','2024-04-23 08:00:00',120000,NULL),(49,4,1,'2024-04-24 06:00:00','2024-04-24 08:00:00',120000,NULL),(50,4,1,'2024-04-25 06:00:00','2024-04-25 08:00:00',120000,NULL),(51,4,1,'2024-04-26 06:00:00','2024-04-26 08:00:00',120000,NULL),(52,4,1,'2024-04-27 06:00:00','2024-04-27 08:00:00',120000,NULL),(53,4,1,'2024-04-28 06:00:00','2024-04-28 08:00:00',120000,NULL),(54,4,1,'2024-04-29 06:00:00','2024-04-29 08:00:00',120000,NULL),(55,4,2,'2024-04-08 16:00:00','2024-04-08 18:00:00',140000,NULL),(56,4,2,'2024-04-09 16:00:00','2024-04-09 18:00:00',140000,NULL),(57,4,2,'2024-04-10 16:00:00','2024-04-10 18:00:00',140000,NULL),(58,4,2,'2024-04-11 16:00:00','2024-04-11 18:00:00',140000,NULL),(59,4,2,'2024-04-12 16:00:00','2024-04-12 18:00:00',140000,NULL),(60,4,2,'2024-04-13 16:00:00','2024-04-13 18:00:00',140000,NULL),(61,4,2,'2024-04-14 16:00:00','2024-04-14 18:00:00',140000,NULL),(62,4,2,'2024-04-15 16:00:00','2024-04-15 18:00:00',140000,NULL),(63,4,2,'2024-04-16 16:00:00','2024-04-16 18:00:00',140000,NULL),(64,4,2,'2024-04-17 16:00:00','2024-04-17 18:00:00',140000,NULL),(65,4,2,'2024-04-18 16:00:00','2024-04-18 18:00:00',140000,NULL),(66,4,2,'2024-04-19 16:00:00','2024-04-19 18:00:00',140000,NULL),(67,4,2,'2024-04-20 16:00:00','2024-04-20 18:00:00',140000,NULL),(68,4,2,'2024-04-21 16:00:00','2024-04-21 18:00:00',140000,NULL),(69,4,2,'2024-04-22 16:00:00','2024-04-22 18:00:00',140000,NULL),(70,4,2,'2024-04-23 16:00:00','2024-04-23 18:00:00',140000,NULL),(71,4,2,'2024-04-24 16:00:00','2024-04-24 18:00:00',140000,NULL),(72,4,2,'2024-04-25 16:00:00','2024-04-25 18:00:00',140000,NULL),(73,4,2,'2024-04-26 16:00:00','2024-04-26 18:00:00',140000,NULL),(74,4,2,'2024-04-27 16:00:00','2024-04-27 18:00:00',140000,NULL),(75,4,2,'2024-04-28 16:00:00','2024-04-28 18:00:00',140000,NULL),(76,4,2,'2024-04-29 16:00:00','2024-04-29 18:00:00',140000,NULL),(77,4,2,'2024-04-30 16:00:00','2024-04-30 18:00:00',140000,NULL),(78,4,2,'2024-05-01 16:00:00','2024-05-01 18:00:00',140000,NULL),(79,4,2,'2024-05-02 16:00:00','2024-05-02 18:00:00',140000,NULL),(80,4,2,'2024-05-03 16:00:00','2024-05-03 18:00:00',140000,NULL),(81,4,2,'2024-05-04 16:00:00','2024-05-04 18:00:00',140000,NULL),(82,4,2,'2024-05-05 16:00:00','2024-05-05 18:00:00',140000,NULL),(83,4,2,'2024-05-06 16:00:00','2024-05-06 18:00:00',140000,NULL),(84,4,2,'2024-05-07 16:00:00','2024-05-07 18:00:00',140000,NULL),(85,4,2,'2024-05-08 16:00:00','2024-05-08 18:00:00',140000,NULL),(86,4,2,'2024-05-09 16:00:00','2024-05-09 18:00:00',140000,NULL),(87,4,2,'2024-05-10 16:00:00','2024-05-10 18:00:00',140000,NULL),(88,4,2,'2024-05-11 16:00:00','2024-05-11 18:00:00',140000,NULL),(89,4,2,'2024-05-12 16:00:00','2024-05-12 18:00:00',140000,NULL),(90,4,2,'2024-05-13 16:00:00','2024-05-13 18:00:00',140000,NULL),(91,4,2,'2024-05-14 16:00:00','2024-05-14 18:00:00',140000,NULL),(92,4,2,'2024-05-15 16:00:00','2024-05-15 18:00:00',140000,NULL),(93,4,2,'2024-05-16 16:00:00','2024-05-16 18:00:00',140000,NULL),(94,4,2,'2024-05-17 16:00:00','2024-05-17 18:00:00',140000,NULL),(95,4,2,'2024-05-18 16:00:00','2024-05-18 18:00:00',140000,NULL),(96,4,2,'2024-05-19 16:00:00','2024-05-19 18:00:00',140000,NULL),(97,4,2,'2024-05-20 16:00:00','2024-05-20 18:00:00',140000,NULL),(98,4,2,'2024-05-21 16:00:00','2024-05-21 18:00:00',140000,NULL),(99,4,2,'2024-05-22 16:00:00','2024-05-22 18:00:00',140000,NULL),(100,4,2,'2024-05-23 16:00:00','2024-05-23 18:00:00',140000,NULL),(101,4,2,'2024-05-24 16:00:00','2024-05-24 18:00:00',140000,NULL),(102,4,2,'2024-05-25 16:00:00','2024-05-25 18:00:00',140000,NULL),(103,4,2,'2024-05-26 16:00:00','2024-05-26 18:00:00',140000,NULL),(104,4,2,'2024-05-27 16:00:00','2024-05-27 18:00:00',140000,NULL),(105,4,2,'2024-05-28 16:00:00','2024-05-28 18:00:00',140000,NULL),(106,4,2,'2024-05-29 16:00:00','2024-05-29 18:00:00',140000,NULL),(107,4,2,'2024-05-30 16:00:00','2024-05-30 18:00:00',140000,NULL),(108,4,1,'2024-04-30 14:00:00','2024-04-30 16:00:00',140000,NULL),(110,4,1,'2024-05-01 14:00:00','2024-05-01 16:00:00',140000,NULL),(111,4,1,'2024-05-02 14:00:00','2024-05-02 16:00:00',140000,NULL),(112,4,1,'2024-05-03 14:00:00','2024-05-03 16:00:00',140000,NULL),(113,4,1,'2024-05-04 14:00:00','2024-05-04 16:00:00',140000,NULL),(114,4,1,'2024-05-05 14:00:00','2024-05-05 16:00:00',140000,NULL),(115,4,1,'2024-05-06 14:00:00','2024-05-06 16:00:00',140000,NULL),(116,4,1,'2024-05-07 14:00:00','2024-05-07 16:00:00',140000,NULL),(117,4,1,'2024-05-08 14:00:00','2024-05-08 16:00:00',140000,NULL),(118,4,1,'2024-05-09 14:00:00','2024-05-09 16:00:00',140000,NULL),(119,4,1,'2024-05-10 14:00:00','2024-05-10 16:00:00',140000,NULL),(120,4,1,'2024-05-11 14:00:00','2024-05-11 16:00:00',140000,NULL),(121,4,1,'2024-05-12 14:00:00','2024-05-12 16:00:00',140000,NULL),(122,4,1,'2024-05-13 14:00:00','2024-05-13 16:00:00',140000,NULL),(123,4,1,'2024-05-14 14:00:00','2024-05-14 16:00:00',140000,NULL),(124,4,1,'2024-05-15 14:00:00','2024-05-15 16:00:00',140000,NULL),(125,4,1,'2024-05-16 14:00:00','2024-05-16 16:00:00',140000,NULL),(126,4,1,'2024-05-17 14:00:00','2024-05-17 16:00:00',140000,NULL),(127,4,1,'2024-05-18 14:00:00','2024-05-18 16:00:00',140000,NULL),(128,4,1,'2024-05-19 14:00:00','2024-05-19 16:00:00',140000,NULL),(129,4,1,'2024-05-20 14:00:00','2024-05-20 16:00:00',140000,NULL),(130,4,1,'2024-05-21 14:00:00','2024-05-21 16:00:00',140000,NULL),(131,4,1,'2024-05-22 14:00:00','2024-05-22 16:00:00',140000,NULL),(132,4,1,'2024-05-23 14:00:00','2024-05-23 16:00:00',140000,NULL),(133,4,1,'2024-05-24 14:00:00','2024-05-24 16:00:00',140000,NULL),(134,4,1,'2024-05-25 14:00:00','2024-05-25 16:00:00',140000,NULL),(135,4,1,'2024-05-26 14:00:00','2024-05-26 16:00:00',140000,NULL),(136,4,1,'2024-05-27 14:00:00','2024-05-27 16:00:00',140000,NULL),(137,4,1,'2024-05-28 14:00:00','2024-05-28 16:00:00',140000,NULL),(138,4,1,'2024-05-29 14:00:00','2024-05-29 16:00:00',140000,NULL),(139,4,1,'2024-05-30 14:00:00','2024-05-30 16:00:00',140000,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=452 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stop_points`
--

LOCK TABLES `stop_points` WRITE;
/*!40000 ALTER TABLE `stop_points` DISABLE KEYS */;
INSERT INTO `stop_points` VALUES (33,12,'Thái Nguyên','2024-03-31 16:00:00',1,1),(34,12,'Sông Công','2024-03-31 16:20:00',2,0),(35,12,'Hà Nội','2024-03-31 18:00:00',3,1),(39,14,'Thái Nguyên','2024-04-02 16:00:00',1,1),(40,14,'Sông Công','2024-04-02 16:20:00',2,0),(41,14,'Hà Nội','2024-04-02 18:00:00',3,1),(42,15,'Thái Nguyên','2024-04-03 16:00:00',1,1),(43,15,'Sông Công','2024-04-03 16:20:00',2,0),(44,15,'Hà Nội','2024-04-03 18:00:00',3,1),(45,16,'Thái Nguyên','2024-04-04 16:00:00',1,1),(46,16,'Sông Công','2024-04-04 16:20:00',2,0),(47,16,'Hà Nội','2024-04-04 18:00:00',3,1),(48,17,'Thái Nguyên','2024-04-05 16:00:00',1,1),(49,17,'Sông Công','2024-04-05 16:20:00',2,0),(50,17,'Hà Nội','2024-04-05 18:00:00',3,1),(51,18,'Thái Nguyên','2024-04-06 16:00:00',1,1),(52,18,'Sông Công','2024-04-06 16:20:00',2,0),(53,18,'Hà Nội','2024-04-06 18:00:00',3,1),(54,19,'Thái Nguyên','2024-04-07 16:00:00',1,1),(55,19,'Sông Công','2024-04-07 16:20:00',2,0),(56,19,'Hà Nội','2024-04-07 18:00:00',3,1),(72,25,'Thái Nguyên','2024-04-06 16:00:00',1,1),(73,25,'Sông Công','2024-04-06 16:20:00',2,0),(74,25,'Hà Nội','2024-04-06 18:00:00',3,1),(78,27,'Thái Nguyên','2024-04-08 16:00:00',1,1),(79,27,'Sông Công','2024-04-08 16:20:00',2,0),(80,27,'Hà Nội','2024-04-08 18:00:00',3,1),(85,13,'Thái Nguyên','2024-04-01 16:00:00',1,1),(86,13,'Sông Công','2024-04-01 16:20:00',2,0),(87,13,'Nội bài','2024-04-01 17:00:00',3,0),(88,13,'Hà Nội','2024-04-01 18:00:00',4,1),(89,28,'Hà Nội','2024-04-04 06:00:00',1,1),(90,28,'Nội Bài','2024-04-04 07:00:00',2,0),(91,28,'Sông Công','2024-04-04 07:30:00',3,0),(92,28,'Thái Nguyên','2024-04-04 08:00:00',4,1),(93,29,'Hà Nội','2024-04-04 06:00:00',1,1),(94,29,'Nội Bài','2024-04-04 07:00:00',2,0),(95,29,'Sông Công','2024-04-04 07:30:00',3,0),(96,29,'Thái Nguyên','2024-04-04 08:00:00',4,1),(97,30,'Hà Nội','2024-04-05 06:00:00',1,1),(98,30,'Nội Bài','2024-04-05 07:00:00',2,0),(99,30,'Sông Công','2024-04-05 07:30:00',3,0),(100,30,'Thái Nguyên','2024-04-05 08:00:00',4,1),(101,31,'Hà Nội','2024-04-06 06:00:00',1,1),(102,31,'Nội Bài','2024-04-06 07:00:00',2,0),(103,31,'Sông Công','2024-04-06 07:30:00',3,0),(104,31,'Thái Nguyên','2024-04-06 08:00:00',4,1),(105,32,'Hà Nội','2024-04-07 06:00:00',1,1),(106,32,'Nội Bài','2024-04-07 07:00:00',2,0),(107,32,'Sông Công','2024-04-07 07:30:00',3,0),(108,32,'Thái Nguyên','2024-04-07 08:00:00',4,1),(109,33,'Hà Nội','2024-04-08 06:00:00',1,1),(110,33,'Nội Bài','2024-04-08 07:00:00',2,0),(111,33,'Sông Công','2024-04-08 07:30:00',3,0),(112,33,'Thái Nguyên','2024-04-08 08:00:00',4,1),(113,34,'Hà Nội','2024-04-09 06:00:00',1,1),(114,34,'Nội Bài','2024-04-09 07:00:00',2,0),(115,34,'Sông Công','2024-04-09 07:30:00',3,0),(116,34,'Thái Nguyên','2024-04-09 08:00:00',4,1),(117,35,'Hà Nội','2024-04-10 06:00:00',1,1),(118,35,'Nội Bài','2024-04-10 07:00:00',2,0),(119,35,'Sông Công','2024-04-10 07:30:00',3,0),(120,35,'Thái Nguyên','2024-04-10 08:00:00',4,1),(121,36,'Hà Nội','2024-04-11 06:00:00',1,1),(122,36,'Nội Bài','2024-04-11 07:00:00',2,0),(123,36,'Sông Công','2024-04-11 07:30:00',3,0),(124,36,'Thái Nguyên','2024-04-11 08:00:00',4,1),(125,37,'Hà Nội','2024-04-12 06:00:00',1,1),(126,37,'Nội Bài','2024-04-12 07:00:00',2,0),(127,37,'Sông Công','2024-04-12 07:30:00',3,0),(128,37,'Thái Nguyên','2024-04-12 08:00:00',4,1),(129,38,'Hà Nội','2024-04-13 06:00:00',1,1),(130,38,'Nội Bài','2024-04-13 07:00:00',2,0),(131,38,'Sông Công','2024-04-13 07:30:00',3,0),(132,38,'Thái Nguyên','2024-04-13 08:00:00',4,1),(133,39,'Hà Nội','2024-04-14 06:00:00',1,1),(134,39,'Nội Bài','2024-04-14 07:00:00',2,0),(135,39,'Sông Công','2024-04-14 07:30:00',3,0),(136,39,'Thái Nguyên','2024-04-14 08:00:00',4,1),(137,40,'Hà Nội','2024-04-15 06:00:00',1,1),(138,40,'Nội Bài','2024-04-15 07:00:00',2,0),(139,40,'Sông Công','2024-04-15 07:30:00',3,0),(140,40,'Thái Nguyên','2024-04-15 08:00:00',4,1),(141,41,'Hà Nội','2024-04-16 06:00:00',1,1),(142,41,'Nội Bài','2024-04-16 07:00:00',2,0),(143,41,'Sông Công','2024-04-16 07:30:00',3,0),(144,41,'Thái Nguyên','2024-04-16 08:00:00',4,1),(145,42,'Hà Nội','2024-04-17 06:00:00',1,1),(146,42,'Nội Bài','2024-04-17 07:00:00',2,0),(147,42,'Sông Công','2024-04-17 07:30:00',3,0),(148,42,'Thái Nguyên','2024-04-17 08:00:00',4,1),(149,43,'Hà Nội','2024-04-18 06:00:00',1,1),(150,43,'Nội Bài','2024-04-18 07:00:00',2,0),(151,43,'Sông Công','2024-04-18 07:30:00',3,0),(152,43,'Thái Nguyên','2024-04-18 08:00:00',4,1),(153,44,'Hà Nội','2024-04-19 06:00:00',1,1),(154,44,'Nội Bài','2024-04-19 07:00:00',2,0),(155,44,'Sông Công','2024-04-19 07:30:00',3,0),(156,44,'Thái Nguyên','2024-04-19 08:00:00',4,1),(157,45,'Hà Nội','2024-04-20 06:00:00',1,1),(158,45,'Nội Bài','2024-04-20 07:00:00',2,0),(159,45,'Sông Công','2024-04-20 07:30:00',3,0),(160,45,'Thái Nguyên','2024-04-20 08:00:00',4,1),(161,46,'Hà Nội','2024-04-21 06:00:00',1,1),(162,46,'Nội Bài','2024-04-21 07:00:00',2,0),(163,46,'Sông Công','2024-04-21 07:30:00',3,0),(164,46,'Thái Nguyên','2024-04-21 08:00:00',4,1),(165,47,'Hà Nội','2024-04-22 06:00:00',1,1),(166,47,'Nội Bài','2024-04-22 07:00:00',2,0),(167,47,'Sông Công','2024-04-22 07:30:00',3,0),(168,47,'Thái Nguyên','2024-04-22 08:00:00',4,1),(169,48,'Hà Nội','2024-04-23 06:00:00',1,1),(170,48,'Nội Bài','2024-04-23 07:00:00',2,0),(171,48,'Sông Công','2024-04-23 07:30:00',3,0),(172,48,'Thái Nguyên','2024-04-23 08:00:00',4,1),(173,49,'Hà Nội','2024-04-24 06:00:00',1,1),(174,49,'Nội Bài','2024-04-24 07:00:00',2,0),(175,49,'Sông Công','2024-04-24 07:30:00',3,0),(176,49,'Thái Nguyên','2024-04-24 08:00:00',4,1),(177,50,'Hà Nội','2024-04-25 06:00:00',1,1),(178,50,'Nội Bài','2024-04-25 07:00:00',2,0),(179,50,'Sông Công','2024-04-25 07:30:00',3,0),(180,50,'Thái Nguyên','2024-04-25 08:00:00',4,1),(181,51,'Hà Nội','2024-04-26 06:00:00',1,1),(182,51,'Nội Bài','2024-04-26 07:00:00',2,0),(183,51,'Sông Công','2024-04-26 07:30:00',3,0),(184,51,'Thái Nguyên','2024-04-26 08:00:00',4,1),(185,52,'Hà Nội','2024-04-27 06:00:00',1,1),(186,52,'Nội Bài','2024-04-27 07:00:00',2,0),(187,52,'Sông Công','2024-04-27 07:30:00',3,0),(188,52,'Thái Nguyên','2024-04-27 08:00:00',4,1),(189,53,'Hà Nội','2024-04-28 06:00:00',1,1),(190,53,'Nội Bài','2024-04-28 07:00:00',2,0),(191,53,'Sông Công','2024-04-28 07:30:00',3,0),(192,53,'Thái Nguyên','2024-04-28 08:00:00',4,1),(193,54,'Hà Nội','2024-04-29 06:00:00',1,1),(194,54,'Nội Bài','2024-04-29 07:00:00',2,0),(195,54,'Sông Công','2024-04-29 07:30:00',3,0),(196,54,'Thái Nguyên','2024-04-29 08:00:00',4,1),(197,55,'Thái Nguyên','2024-04-08 16:00:00',1,1),(198,55,'Sông Công','2024-04-08 16:20:00',2,0),(199,55,'Hà Nội','2024-04-08 18:00:00',3,1),(200,56,'Thái Nguyên','2024-04-09 16:00:00',1,1),(201,56,'Sông Công','2024-04-09 16:20:00',2,0),(202,56,'Hà Nội','2024-04-09 18:00:00',3,1),(203,57,'Thái Nguyên','2024-04-10 16:00:00',1,1),(204,57,'Sông Công','2024-04-10 16:20:00',2,0),(205,57,'Hà Nội','2024-04-10 18:00:00',3,1),(206,58,'Thái Nguyên','2024-04-11 16:00:00',1,1),(207,58,'Sông Công','2024-04-11 16:20:00',2,0),(208,58,'Hà Nội','2024-04-11 18:00:00',3,1),(209,59,'Thái Nguyên','2024-04-12 16:00:00',1,1),(210,59,'Sông Công','2024-04-12 16:20:00',2,0),(211,59,'Hà Nội','2024-04-12 18:00:00',3,1),(212,60,'Thái Nguyên','2024-04-13 16:00:00',1,1),(213,60,'Sông Công','2024-04-13 16:20:00',2,0),(214,60,'Hà Nội','2024-04-13 18:00:00',3,1),(215,61,'Thái Nguyên','2024-04-14 16:00:00',1,1),(216,61,'Sông Công','2024-04-14 16:20:00',2,0),(217,61,'Hà Nội','2024-04-14 18:00:00',3,1),(218,62,'Thái Nguyên','2024-04-15 16:00:00',1,1),(219,62,'Sông Công','2024-04-15 16:20:00',2,0),(220,62,'Hà Nội','2024-04-15 18:00:00',3,1),(221,63,'Thái Nguyên','2024-04-16 16:00:00',1,1),(222,63,'Sông Công','2024-04-16 16:20:00',2,0),(223,63,'Hà Nội','2024-04-16 18:00:00',3,1),(224,64,'Thái Nguyên','2024-04-17 16:00:00',1,1),(225,64,'Sông Công','2024-04-17 16:20:00',2,0),(226,64,'Hà Nội','2024-04-17 18:00:00',3,1),(227,65,'Thái Nguyên','2024-04-18 16:00:00',1,1),(228,65,'Sông Công','2024-04-18 16:20:00',2,0),(229,65,'Hà Nội','2024-04-18 18:00:00',3,1),(230,66,'Thái Nguyên','2024-04-19 16:00:00',1,1),(231,66,'Sông Công','2024-04-19 16:20:00',2,0),(232,66,'Hà Nội','2024-04-19 18:00:00',3,1),(233,67,'Thái Nguyên','2024-04-20 16:00:00',1,1),(234,67,'Sông Công','2024-04-20 16:20:00',2,0),(235,67,'Hà Nội','2024-04-20 18:00:00',3,1),(236,68,'Thái Nguyên','2024-04-21 16:00:00',1,1),(237,68,'Sông Công','2024-04-21 16:20:00',2,0),(238,68,'Hà Nội','2024-04-21 18:00:00',3,1),(239,69,'Thái Nguyên','2024-04-22 16:00:00',1,1),(240,69,'Sông Công','2024-04-22 16:20:00',2,0),(241,69,'Hà Nội','2024-04-22 18:00:00',3,1),(242,70,'Thái Nguyên','2024-04-23 16:00:00',1,1),(243,70,'Sông Công','2024-04-23 16:20:00',2,0),(244,70,'Hà Nội','2024-04-23 18:00:00',3,1),(245,71,'Thái Nguyên','2024-04-24 16:00:00',1,1),(246,71,'Sông Công','2024-04-24 16:20:00',2,0),(247,71,'Hà Nội','2024-04-24 18:00:00',3,1),(248,72,'Thái Nguyên','2024-04-25 16:00:00',1,1),(249,72,'Sông Công','2024-04-25 16:20:00',2,0),(250,72,'Hà Nội','2024-04-25 18:00:00',3,1),(251,73,'Thái Nguyên','2024-04-26 16:00:00',1,1),(252,73,'Sông Công','2024-04-26 16:20:00',2,0),(253,73,'Hà Nội','2024-04-26 18:00:00',3,1),(254,74,'Thái Nguyên','2024-04-27 16:00:00',1,1),(255,74,'Sông Công','2024-04-27 16:20:00',2,0),(256,74,'Hà Nội','2024-04-27 18:00:00',3,1),(257,75,'Thái Nguyên','2024-04-28 16:00:00',1,1),(258,75,'Sông Công','2024-04-28 16:20:00',2,0),(259,75,'Hà Nội','2024-04-28 18:00:00',3,1),(260,76,'Thái Nguyên','2024-04-29 16:00:00',1,1),(261,76,'Sông Công','2024-04-29 16:20:00',2,0),(262,76,'Hà Nội','2024-04-29 18:00:00',3,1),(263,77,'Thái Nguyên','2024-04-30 16:00:00',1,1),(264,77,'Sông Công','2024-04-30 16:20:00',2,0),(265,77,'Hà Nội','2024-04-30 18:00:00',3,1),(266,78,'Thái Nguyên','2024-05-01 16:00:00',1,1),(267,78,'Sông Công','2024-05-01 16:20:00',2,0),(268,78,'Hà Nội','2024-05-01 18:00:00',3,1),(269,79,'Thái Nguyên','2024-05-02 16:00:00',1,1),(270,79,'Sông Công','2024-05-02 16:20:00',2,0),(271,79,'Hà Nội','2024-05-02 18:00:00',3,1),(272,80,'Thái Nguyên','2024-05-03 16:00:00',1,1),(273,80,'Sông Công','2024-05-03 16:20:00',2,0),(274,80,'Hà Nội','2024-05-03 18:00:00',3,1),(275,81,'Thái Nguyên','2024-05-04 16:00:00',1,1),(276,81,'Sông Công','2024-05-04 16:20:00',2,0),(277,81,'Hà Nội','2024-05-04 18:00:00',3,1),(278,82,'Thái Nguyên','2024-05-05 16:00:00',1,1),(279,82,'Sông Công','2024-05-05 16:20:00',2,0),(280,82,'Hà Nội','2024-05-05 18:00:00',3,1),(281,83,'Thái Nguyên','2024-05-06 16:00:00',1,1),(282,83,'Sông Công','2024-05-06 16:20:00',2,0),(283,83,'Hà Nội','2024-05-06 18:00:00',3,1),(284,84,'Thái Nguyên','2024-05-07 16:00:00',1,1),(285,84,'Sông Công','2024-05-07 16:20:00',2,0),(286,84,'Hà Nội','2024-05-07 18:00:00',3,1),(287,85,'Thái Nguyên','2024-05-08 16:00:00',1,1),(288,85,'Sông Công','2024-05-08 16:20:00',2,0),(289,85,'Hà Nội','2024-05-08 18:00:00',3,1),(290,86,'Thái Nguyên','2024-05-09 16:00:00',1,1),(291,86,'Sông Công','2024-05-09 16:20:00',2,0),(292,86,'Hà Nội','2024-05-09 18:00:00',3,1),(293,87,'Thái Nguyên','2024-05-10 16:00:00',1,1),(294,87,'Sông Công','2024-05-10 16:20:00',2,0),(295,87,'Hà Nội','2024-05-10 18:00:00',3,1),(296,88,'Thái Nguyên','2024-05-11 16:00:00',1,1),(297,88,'Sông Công','2024-05-11 16:20:00',2,0),(298,88,'Hà Nội','2024-05-11 18:00:00',3,1),(299,89,'Thái Nguyên','2024-05-12 16:00:00',1,1),(300,89,'Sông Công','2024-05-12 16:20:00',2,0),(301,89,'Hà Nội','2024-05-12 18:00:00',3,1),(302,90,'Thái Nguyên','2024-05-13 16:00:00',1,1),(303,90,'Sông Công','2024-05-13 16:20:00',2,0),(304,90,'Hà Nội','2024-05-13 18:00:00',3,1),(305,91,'Thái Nguyên','2024-05-14 16:00:00',1,1),(306,91,'Sông Công','2024-05-14 16:20:00',2,0),(307,91,'Hà Nội','2024-05-14 18:00:00',3,1),(308,92,'Thái Nguyên','2024-05-15 16:00:00',1,1),(309,92,'Sông Công','2024-05-15 16:20:00',2,0),(310,92,'Hà Nội','2024-05-15 18:00:00',3,1),(311,93,'Thái Nguyên','2024-05-16 16:00:00',1,1),(312,93,'Sông Công','2024-05-16 16:20:00',2,0),(313,93,'Hà Nội','2024-05-16 18:00:00',3,1),(314,94,'Thái Nguyên','2024-05-17 16:00:00',1,1),(315,94,'Sông Công','2024-05-17 16:20:00',2,0),(316,94,'Hà Nội','2024-05-17 18:00:00',3,1),(317,95,'Thái Nguyên','2024-05-18 16:00:00',1,1),(318,95,'Sông Công','2024-05-18 16:20:00',2,0),(319,95,'Hà Nội','2024-05-18 18:00:00',3,1),(320,96,'Thái Nguyên','2024-05-19 16:00:00',1,1),(321,96,'Sông Công','2024-05-19 16:20:00',2,0),(322,96,'Hà Nội','2024-05-19 18:00:00',3,1),(323,97,'Thái Nguyên','2024-05-20 16:00:00',1,1),(324,97,'Sông Công','2024-05-20 16:20:00',2,0),(325,97,'Hà Nội','2024-05-20 18:00:00',3,1),(326,98,'Thái Nguyên','2024-05-21 16:00:00',1,1),(327,98,'Sông Công','2024-05-21 16:20:00',2,0),(328,98,'Hà Nội','2024-05-21 18:00:00',3,1),(329,99,'Thái Nguyên','2024-05-22 16:00:00',1,1),(330,99,'Sông Công','2024-05-22 16:20:00',2,0),(331,99,'Hà Nội','2024-05-22 18:00:00',3,1),(332,100,'Thái Nguyên','2024-05-23 16:00:00',1,1),(333,100,'Sông Công','2024-05-23 16:20:00',2,0),(334,100,'Hà Nội','2024-05-23 18:00:00',3,1),(335,101,'Thái Nguyên','2024-05-24 16:00:00',1,1),(336,101,'Sông Công','2024-05-24 16:20:00',2,0),(337,101,'Hà Nội','2024-05-24 18:00:00',3,1),(338,102,'Thái Nguyên','2024-05-25 16:00:00',1,1),(339,102,'Sông Công','2024-05-25 16:20:00',2,0),(340,102,'Hà Nội','2024-05-25 18:00:00',3,1),(341,103,'Thái Nguyên','2024-05-26 16:00:00',1,1),(342,103,'Sông Công','2024-05-26 16:20:00',2,0),(343,103,'Hà Nội','2024-05-26 18:00:00',3,1),(344,104,'Thái Nguyên','2024-05-27 16:00:00',1,1),(345,104,'Sông Công','2024-05-27 16:20:00',2,0),(346,104,'Hà Nội','2024-05-27 18:00:00',3,1),(347,105,'Thái Nguyên','2024-05-28 16:00:00',1,1),(348,105,'Sông Công','2024-05-28 16:20:00',2,0),(349,105,'Hà Nội','2024-05-28 18:00:00',3,1),(350,106,'Thái Nguyên','2024-05-29 16:00:00',1,1),(351,106,'Sông Công','2024-05-29 16:20:00',2,0),(352,106,'Hà Nội','2024-05-29 18:00:00',3,1),(353,107,'Thái Nguyên','2024-05-30 16:00:00',1,1),(354,107,'Sông Công','2024-05-30 16:20:00',2,0),(355,107,'Hà Nội','2024-05-30 18:00:00',3,1),(356,108,'Hà Nội','2024-04-30 14:00:00',1,1),(357,108,'Sông Công','2024-04-30 15:40:00',2,0),(358,108,'Thái Nguyên','2024-04-30 16:00:00',3,1),(362,110,'Hà Nội','2024-05-01 14:00:00',1,1),(363,110,'Sông Công','2024-05-01 15:40:00',2,0),(364,110,'Thái Nguyên','2024-05-01 16:00:00',3,1),(365,111,'Hà Nội','2024-05-02 14:00:00',1,1),(366,111,'Sông Công','2024-05-02 15:40:00',2,0),(367,111,'Thái Nguyên','2024-05-02 16:00:00',3,1),(368,112,'Hà Nội','2024-05-03 14:00:00',1,1),(369,112,'Sông Công','2024-05-03 15:40:00',2,0),(370,112,'Thái Nguyên','2024-05-03 16:00:00',3,1),(371,113,'Hà Nội','2024-05-04 14:00:00',1,1),(372,113,'Sông Công','2024-05-04 15:40:00',2,0),(373,113,'Thái Nguyên','2024-05-04 16:00:00',3,1),(374,114,'Hà Nội','2024-05-05 14:00:00',1,1),(375,114,'Sông Công','2024-05-05 15:40:00',2,0),(376,114,'Thái Nguyên','2024-05-05 16:00:00',3,1),(377,115,'Hà Nội','2024-05-06 14:00:00',1,1),(378,115,'Sông Công','2024-05-06 15:40:00',2,0),(379,115,'Thái Nguyên','2024-05-06 16:00:00',3,1),(380,116,'Hà Nội','2024-05-07 14:00:00',1,1),(381,116,'Sông Công','2024-05-07 15:40:00',2,0),(382,116,'Thái Nguyên','2024-05-07 16:00:00',3,1),(383,117,'Hà Nội','2024-05-08 14:00:00',1,1),(384,117,'Sông Công','2024-05-08 15:40:00',2,0),(385,117,'Thái Nguyên','2024-05-08 16:00:00',3,1),(386,118,'Hà Nội','2024-05-09 14:00:00',1,1),(387,118,'Sông Công','2024-05-09 15:40:00',2,0),(388,118,'Thái Nguyên','2024-05-09 16:00:00',3,1),(389,119,'Hà Nội','2024-05-10 14:00:00',1,1),(390,119,'Sông Công','2024-05-10 15:40:00',2,0),(391,119,'Thái Nguyên','2024-05-10 16:00:00',3,1),(392,120,'Hà Nội','2024-05-11 14:00:00',1,1),(393,120,'Sông Công','2024-05-11 15:40:00',2,0),(394,120,'Thái Nguyên','2024-05-11 16:00:00',3,1),(395,121,'Hà Nội','2024-05-12 14:00:00',1,1),(396,121,'Sông Công','2024-05-12 15:40:00',2,0),(397,121,'Thái Nguyên','2024-05-12 16:00:00',3,1),(398,122,'Hà Nội','2024-05-13 14:00:00',1,1),(399,122,'Sông Công','2024-05-13 15:40:00',2,0),(400,122,'Thái Nguyên','2024-05-13 16:00:00',3,1),(401,123,'Hà Nội','2024-05-14 14:00:00',1,1),(402,123,'Sông Công','2024-05-14 15:40:00',2,0),(403,123,'Thái Nguyên','2024-05-14 16:00:00',3,1),(404,124,'Hà Nội','2024-05-15 14:00:00',1,1),(405,124,'Sông Công','2024-05-15 15:40:00',2,0),(406,124,'Thái Nguyên','2024-05-15 16:00:00',3,1),(407,125,'Hà Nội','2024-05-16 14:00:00',1,1),(408,125,'Sông Công','2024-05-16 15:40:00',2,0),(409,125,'Thái Nguyên','2024-05-16 16:00:00',3,1),(410,126,'Hà Nội','2024-05-17 14:00:00',1,1),(411,126,'Sông Công','2024-05-17 15:40:00',2,0),(412,126,'Thái Nguyên','2024-05-17 16:00:00',3,1),(413,127,'Hà Nội','2024-05-18 14:00:00',1,1),(414,127,'Sông Công','2024-05-18 15:40:00',2,0),(415,127,'Thái Nguyên','2024-05-18 16:00:00',3,1),(416,128,'Hà Nội','2024-05-19 14:00:00',1,1),(417,128,'Sông Công','2024-05-19 15:40:00',2,0),(418,128,'Thái Nguyên','2024-05-19 16:00:00',3,1),(419,129,'Hà Nội','2024-05-20 14:00:00',1,1),(420,129,'Sông Công','2024-05-20 15:40:00',2,0),(421,129,'Thái Nguyên','2024-05-20 16:00:00',3,1),(422,130,'Hà Nội','2024-05-21 14:00:00',1,1),(423,130,'Sông Công','2024-05-21 15:40:00',2,0),(424,130,'Thái Nguyên','2024-05-21 16:00:00',3,1),(425,131,'Hà Nội','2024-05-22 14:00:00',1,1),(426,131,'Sông Công','2024-05-22 15:40:00',2,0),(427,131,'Thái Nguyên','2024-05-22 16:00:00',3,1),(428,132,'Hà Nội','2024-05-23 14:00:00',1,1),(429,132,'Sông Công','2024-05-23 15:40:00',2,0),(430,132,'Thái Nguyên','2024-05-23 16:00:00',3,1),(431,133,'Hà Nội','2024-05-24 14:00:00',1,1),(432,133,'Sông Công','2024-05-24 15:40:00',2,0),(433,133,'Thái Nguyên','2024-05-24 16:00:00',3,1),(434,134,'Hà Nội','2024-05-25 14:00:00',1,1),(435,134,'Sông Công','2024-05-25 15:40:00',2,0),(436,134,'Thái Nguyên','2024-05-25 16:00:00',3,1),(437,135,'Hà Nội','2024-05-26 14:00:00',1,1),(438,135,'Sông Công','2024-05-26 15:40:00',2,0),(439,135,'Thái Nguyên','2024-05-26 16:00:00',3,1),(440,136,'Hà Nội','2024-05-27 14:00:00',1,1),(441,136,'Sông Công','2024-05-27 15:40:00',2,0),(442,136,'Thái Nguyên','2024-05-27 16:00:00',3,1),(443,137,'Hà Nội','2024-05-28 14:00:00',1,1),(444,137,'Sông Công','2024-05-28 15:40:00',2,0),(445,137,'Thái Nguyên','2024-05-28 16:00:00',3,1),(446,138,'Hà Nội','2024-05-29 14:00:00',1,1),(447,138,'Sông Công','2024-05-29 15:40:00',2,0),(448,138,'Thái Nguyên','2024-05-29 16:00:00',3,1),(449,139,'Hà Nội','2024-05-30 14:00:00',1,1),(450,139,'Sông Công','2024-05-30 15:40:00',2,0),(451,139,'Thái Nguyên','2024-05-30 16:00:00',3,1);
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
  `oauth_id` varchar(50) DEFAULT NULL,
  `profile_img` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'Nguyễn Việt Trung ','viettrungcntt03@gmail.com','','',NULL,'115508379644976569332','https://lh3.googleusercontent.com/a/ACg8ocIscZbGICQlMkifZakoplMNtzpApO5UzXJVFTwVXiCg3sU6EpJW=s96-c','2024-05-03 21:35:37','2024-05-03 21:51:19');
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

-- Dump completed on 2024-05-15 15:23:02
