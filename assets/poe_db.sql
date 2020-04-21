-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: poe_db
-- ------------------------------------------------------
-- Server version	8.0.12

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
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Bangladesh','BD'),(2,'Belgium','BE'),(3,'Burkina Faso','BF'),(4,'Bulgaria','BG'),(5,'Bosnia and Herzegovina','BA'),(6,'Barbados','BB'),(7,'Wallis and Futuna','WF'),(8,'Saint Barthelemy','BL'),(9,'Bermuda','BM'),(10,'Brunei','BN'),(11,'Bolivia','BO'),(12,'Bahrain','BH'),(13,'Burundi','BI'),(14,'Benin','BJ'),(15,'Bhutan','BT'),(16,'Jamaica','JM'),(17,'Bouvet Island','BV'),(18,'Botswana','BW'),(19,'Samoa','WS'),(20,'Bonaire, Saint Eustatius and Saba ','BQ'),(21,'Brazil','BR'),(22,'Bahamas','BS'),(23,'Jersey','JE'),(24,'Belarus','BY'),(25,'Belize','BZ'),(26,'Russia','RU'),(27,'Rwanda','RW'),(28,'Serbia','RS'),(29,'East Timor','TL'),(30,'Reunion','RE'),(31,'Turkmenistan','TM'),(32,'Tajikistan','TJ'),(33,'Romania','RO'),(34,'Tokelau','TK'),(35,'Guinea-Bissau','GW'),(36,'Guam','GU'),(37,'Guatemala','GT'),(38,'South Georgia and the South Sandwich Islands','GS'),(39,'Greece','GR'),(40,'Equatorial Guinea','GQ'),(41,'Guadeloupe','GP'),(42,'Japan','JP'),(43,'Guyana','GY'),(44,'Guernsey','GG'),(45,'French Guiana','GF'),(46,'Georgia','GE'),(47,'Grenada','GD'),(48,'United Kingdom','GB'),(49,'Gabon','GA'),(50,'El Salvador','SV'),(51,'Guinea','GN'),(52,'Gambia','GM'),(53,'Greenland','GL'),(54,'Gibraltar','GI'),(55,'Ghana','GH'),(56,'Oman','OM'),(57,'Tunisia','TN'),(58,'Jordan','JO'),(59,'Croatia','HR'),(60,'Haiti','HT'),(61,'Hungary','HU'),(62,'Hong Kong','HK'),(63,'Honduras','HN'),(64,'Heard Island and McDonald Islands','HM'),(65,'Venezuela','VE'),(66,'Puerto Rico','PR'),(67,'Palestinian Territory','PS'),(68,'Palau','PW'),(69,'Portugal','PT'),(70,'Svalbard and Jan Mayen','SJ'),(71,'Paraguay','PY'),(72,'Iraq','IQ'),(73,'Panama','PA'),(74,'French Polynesia','PF'),(75,'Papua New Guinea','PG'),(76,'Peru','PE'),(77,'Pakistan','PK'),(78,'Philippines','PH'),(79,'Pitcairn','PN'),(80,'Poland','PL'),(81,'Saint Pierre and Miquelon','PM'),(82,'Zambia','ZM'),(83,'Western Sahara','EH'),(84,'Estonia','EE'),(85,'Egypt','EG'),(86,'South Africa','ZA'),(87,'Ecuador','EC'),(88,'Italy','IT'),(89,'Vietnam','VN'),(90,'Solomon Islands','SB'),(91,'Ethiopia','ET'),(92,'Somalia','SO'),(93,'Zimbabwe','ZW'),(94,'Saudi Arabia','SA'),(95,'Spain','ES'),(96,'Eritrea','ER'),(97,'Montenegro','ME'),(98,'Moldova','MD'),(99,'Madagascar','MG'),(100,'Saint Martin','MF'),(101,'Morocco','MA'),(102,'Monaco','MC'),(103,'Uzbekistan','UZ'),(104,'Myanmar','MM'),(105,'Mali','ML'),(106,'Macao','MO'),(107,'Mongolia','MN'),(108,'Marshall Islands','MH'),(109,'Macedonia','MK'),(110,'Mauritius','MU'),(111,'Malta','MT'),(112,'Malawi','MW'),(113,'Maldives','MV'),(114,'Martinique','MQ'),(115,'Northern Mariana Islands','MP'),(116,'Montserrat','MS'),(117,'Mauritania','MR'),(118,'Isle of Man','IM'),(119,'Uganda','UG'),(120,'Tanzania','TZ'),(121,'Malaysia','MY'),(122,'Mexico','MX'),(123,'Israel','IL'),(124,'France','FR'),(125,'British Indian Ocean Territory','IO'),(126,'Saint Helena','SH'),(127,'Finland','FI'),(128,'Fiji','FJ'),(129,'Falkland Islands','FK'),(130,'Micronesia','FM'),(131,'Faroe Islands','FO'),(132,'Nicaragua','NI'),(133,'Netherlands','NL'),(134,'Norway','NO'),(135,'Namibia','NA'),(136,'Vanuatu','VU'),(137,'New Caledonia','NC'),(138,'Niger','NE'),(139,'Norfolk Island','NF'),(140,'Nigeria','NG'),(141,'New Zealand','NZ'),(142,'Nepal','NP'),(143,'Nauru','NR'),(144,'Niue','NU'),(145,'Cook Islands','CK'),(146,'Kosovo','XK'),(147,'Ivory Coast','CI'),(148,'Switzerland','CH'),(149,'Colombia','CO'),(150,'China','CN'),(151,'Cameroon','CM'),(152,'Chile','CL'),(153,'Cocos Islands','CC'),(154,'Canada','CA'),(155,'Republic of the Congo','CG'),(156,'Central African Republic','CF'),(157,'Democratic Republic of the Congo','CD'),(158,'Czech Republic','CZ'),(159,'Cyprus','CY'),(160,'Christmas Island','CX'),(161,'Costa Rica','CR'),(162,'Curacao','CW'),(163,'Cape Verde','CV'),(164,'Cuba','CU'),(165,'Swaziland','SZ'),(166,'Syria','SY'),(167,'Sint Maarten','SX'),(168,'Kyrgyzstan','KG'),(169,'Kenya','KE'),(170,'South Sudan','SS'),(171,'Suriname','SR'),(172,'Kiribati','KI'),(173,'Cambodia','KH'),(174,'Saint Kitts and Nevis','KN'),(175,'Comoros','KM'),(176,'Sao Tome and Principe','ST'),(177,'Slovakia','SK'),(178,'South Korea','KR'),(179,'Slovenia','SI'),(180,'North Korea','KP'),(181,'Kuwait','KW'),(182,'Senegal','SN'),(183,'San Marino','SM'),(184,'Sierra Leone','SL'),(185,'Seychelles','SC'),(186,'Kazakhstan','KZ'),(187,'Cayman Islands','KY'),(188,'Singapore','SG'),(189,'Sweden','SE'),(190,'Sudan','SD'),(191,'Dominican Republic','DO'),(192,'Dominica','DM'),(193,'Djibouti','DJ'),(194,'Denmark','DK'),(195,'British Virgin Islands','VG'),(196,'Germany','DE'),(197,'Yemen','YE'),(198,'Algeria','DZ'),(199,'United States','US'),(200,'Uruguay','UY'),(201,'Mayotte','YT'),(202,'United States Minor Outlying Islands','UM'),(203,'Lebanon','LB'),(204,'Saint Lucia','LC'),(205,'Laos','LA'),(206,'Tuvalu','TV'),(207,'Taiwan','TW'),(208,'Trinidad and Tobago','TT'),(209,'Turkey','TR'),(210,'Sri Lanka','LK'),(211,'Liechtenstein','LI'),(212,'Latvia','LV'),(213,'Tonga','TO'),(214,'Lithuania','LT'),(215,'Luxembourg','LU'),(216,'Liberia','LR'),(217,'Lesotho','LS'),(218,'Thailand','TH'),(219,'French Southern Territories','TF'),(220,'Togo','TG'),(221,'Chad','TD'),(222,'Turks and Caicos Islands','TC'),(223,'Libya','LY'),(224,'Vatican','VA'),(225,'Saint Vincent and the Grenadines','VC'),(226,'United Arab Emirates','AE'),(227,'Andorra','AD'),(228,'Antigua and Barbuda','AG'),(229,'Afghanistan','AF'),(230,'Anguilla','AI'),(231,'U.S. Virgin Islands','VI'),(232,'Iceland','IS'),(233,'Iran','IR'),(234,'Armenia','AM'),(235,'Albania','AL'),(236,'Angola','AO'),(237,'Antarctica','AQ'),(238,'American Samoa','AS'),(239,'Argentina','AR'),(240,'Australia','AU'),(241,'Austria','AT'),(242,'Aruba','AW'),(243,'India','IN'),(244,'Aland Islands','AX'),(245,'Azerbaijan','AZ'),(246,'Ireland','IE'),(247,'Indonesia','ID'),(248,'Ukraine','UA'),(249,'Qatar','QA'),(250,'Mozambique','MZ');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=493 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` VALUES (1,'Bagamoyo',9),(3,'Kibaha',9),(5,'Kibiti',9),(6,'Kilwa',2),(7,'Kisarawe',9),(8,'Korogwe',3),(10,'Lindi',2),(12,'Liwale',2),(15,'Masasi',1),(16,'Mbinga',4),(17,'Mkinga',3),(18,'Mkuranga',9),(19,'Mtwara',1),(21,'Muheza',3),(22,'Nachingwea',2),(23,'Namtumbo',4),(25,'Nanyumbu',1),(26,'Newala',1),(27,'Nyasa',4),(28,'Pangani',3),(29,'Ruangwa',2),(30,'Rufiji',9),(31,'Songea dc',4),(32,'Tandahimba',1),(33,'Tanga',3),(34,'Tunduru',4),(36,'Handeni',3),(37,'Mafia',9),(39,'Kilindi',3),(40,'Morogoro Vijijini',10),(41,'Malinyi',10),(42,'Kilosa',10),(43,'Ulanga',10),(44,'Mvomero',10),(45,'Gairo',10),(47,'Kyela dc ',12),(48,'Chunya DC',12),(49,'Mbarali DC',12),(50,'Iringa Mjini',11),(51,'Kilolo',11),(52,'Mpwapwa',7),(53,'Kongwa',7),(54,'Bahi',7),(55,'Kondoa',7),(57,'Chamwino',7),(58,'Dodoma',7),(59,'Chemba',7),(60,'Mkalama',6),(61,'Itigi',6),(62,'Manyoni',6),(63,'Singida Mjini',6),(64,'Ikungi',6),(65,'Singida Vijijini',6),(66,'Iramba',6),(67,'Ludewa',13),(68,'Makete',13),(69,'Igunga',8),(70,'Kaliua',8),(71,'Nzega',8),(73,'Sikonge',8),(74,'Tabora Mjini',8),(75,'Urambo',8),(76,'Uyui',8),(77,'Hai',14),(79,'Mwanga',14),(80,'Rombo',14),(81,'Siha',14),(82,'Same',14),(83,'Songwe DC',15),(84,'Mpanda',16),(85,'Tanganyika',16),(89,'Kahama Vijijini',17),(90,'Uvinza',18),(91,'Rungwe',5),(95,'Babati Vijijini',20),(97,'Meru',21),(98,'Arusha Mjini',21),(99,'Monduli',21),(100,'Lushoto',3),(126,'Moshi Vijijini',14),(127,'Mbozi',15),(128,'Ngara',23),(129,'Kyerwa',23),(130,'Bukoba Mjini',23),(131,'Muleba',23),(132,'Missenyi',23),(133,'Karagwe',23),(135,'Biharamulo',23),(137,'Karagwe',23),(141,'Ileje',15),(144,'Geita',24),(145,'Bukombe',24),(146,'Mbogwe',24),(148,'Chato',24),(149,'Nyang\'hwale',24),(150,'Butiama',25),(151,'Bunda',25),(152,'Musoma Vijinini',25),(153,'Sengerema',26),(154,'Magu',26),(158,'Kwimba',26),(159,'Misungwi',26),(180,'Shinyanga Mjini',17),(187,'Meatu',31),(188,'Shinyanga Vijijini',17),(191,'Kishapu',17),(193,'Maswa',31),(195,'Njombe',13),(197,'Wanging\'ombe',13),(199,'Mufindi',11),(200,'Iringa Vijijini',11),(201,'Mbulu',20),(202,'Hanang',20),(204,'Ngorongoro',21),(208,'Kilombero',10),(222,'Nsimbo',16),(223,'Mlele',16),(224,'Chunya',5),(225,'Mbeya Vijijini',5),(231,'Buhigwe',18),(232,'Kibondo',18),(234,'Tarime',25),(235,'Kigoma dc',28),(239,'Mbeya dc',29),(242,'Bukoba Vijijini',23),(249,'Mbeya',5),(250,'Arusha Vijijini',21),(251,'Karatu',21),(252,'Kigoma Mjini',18),(253,'Kasulu Vijijini',18),(254,'Kasulu Mjini',18),(255,'Moshi Mjini',14),(257,'Babati',20),(259,'Njombe Mjini',13),(260,'Songea Vijijini',4),(261,'Songea Mjini',4),(263,'Ilemela',26),(264,'Ukerewe',26),(265,'Busokelo',5),(266,'Mbarali',5),(267,'Longido',21),(268,'Kigoma Vijijini',18),(269,'Kakonko',18),(271,'Makambako',13),(272,'Musoma Mjini',25),(274,'Rorya',25),(275,'Serengeti',25),(277,'Kiteto',20),(278,'Simanjiro',20),(279,'Mafinga',11),(280,'Morogoro Mjini',10),(281,'Ilala',30),(282,'Kinondoni',30),(283,'Temake',30),(284,'Ubungo',30),(285,'Kigamboni',30),(286,'Bariadi',31),(287,'Busega',31),(288,'Itilima',31),(291,'Kalambo',32),(292,'Lyamba lya mfupa',32),(293,'Nkasi',32),(294,'Sumbawanga',32),(295,'Kahama',17),(296,'Karatu DC',21),(298,'Mkulazi',10),(299,'Misenyi',23),(302,'Ushetu',17),(303,'Buchosa',26),(304,'Name of LGA',33),(305,'Mwanza CC',26),(306,'Arusha CC',21),(307,'Tanga CC',3),(308,'Chamwino DC',7),(309,'Kongwa DC',7),(310,'Hanang DC',20),(311,'Arusha DC',21),(312,'Mwanga DC',14),(313,'Rombo DC',14),(314,'same DC',14),(315,'Bunda DC',25),(316,'Kigoma DC',18),(317,'Kwimba DC',26),(318,'Bariadi DC',31),(319,'Kilolo DC',11),(320,'Makete DC',13),(321,'Rungwe DC',5),(322,'Mbeya DC',5),(323,'Kilosa DC',10),(324,'Chalinze DC',9),(325,'Liwale DC',2),(326,'Bumbuli DC',3),(327,'Bahi DC',7),(328,'Mbulu DC',20),(329,'Busega DC',31),(330,'Itigi DC',6),(331,'Meru DC',21),(332,'Morogoro DC',10),(333,'Mkuranga DC',9),(334,'Mtwara DC',1),(335,'Newala DC',1),(336,'Handeni DC',3),(337,'Manyoni DC',6),(338,'Ubungo MC',30),(339,'Dodoma MC',7),(340,'Mtwra MC',1),(341,'Kigamboni MC',30),(342,'Kasulu TC',18),(343,'Mafinga TC',11),(344,'Masasi TC',1),(345,'Handeni TC',3),(346,'Newala TC',1),(347,'Mkinga DC',3),(348,'Iringa MC',11),(349,'Korogwe TC',3),(350,'Mbeya CC',5),(351,'Chemba DC',7),(352,'Kondoa DC',7),(353,'Mpwapwa DC',7),(354,'Ikungi DC',6),(355,'Iramba DC',6),(356,'Mkalama DC',6),(357,'Singida DC',6),(358,'Babati DC',20),(359,'Kiteto DC',20),(360,'Simanjiro DC',20),(361,'Igunga DC',8),(362,'Kaliua DC',8),(363,'Nzega DC',8),(364,'Sikonge DC',8),(365,'Urambo DC',8),(366,'Uyui DC',8),(367,'Longido DC',21),(368,'Monduli DC',21),(369,'Ngorongoro DC',21),(370,'Hai DC',14),(371,'Moshi DC',14),(372,'Siha DC',14),(373,'Butiama DC',25),(374,'Musoma DC',25),(375,'Rorya DC',25),(376,'Serengeti DC',25),(377,'Tarime DC',25),(378,'Buhingwe DC',18),(379,'Kakonko DC',18),(380,'Kasulu DC',18),(381,'Kibondo DC',18),(382,'Uvinza DC',18),(383,'Buchosa DC',26),(384,'Magu DC',26),(385,'Misungwi DC',26),(386,'Sengerema DC',26),(387,'Ukerewe DC',26),(388,'Bukombe DC',24),(389,'Chato DC',24),(390,'Geita DC',24),(391,'Mbongwe DC',24),(392,'Nyang\'wale DC',24),(393,'Itilima DC',31),(394,'Maswa DC',31),(395,'Meatu DC',31),(396,'Kishapu DC',17),(397,'Msalala DC',17),(398,'Shinyanga DC',17),(399,'Ushetu DC',17),(400,'Biharamuro DC',23),(401,'Bukoba DC',23),(402,'Karagwe DC',23),(403,'Kyerwa DC',23),(404,'Missenyi DC',23),(405,'Muleba DC',23),(406,'Ngara DC',23),(407,'MleleDC',16),(408,'Mpanda DC',16),(409,'Mpimbwe DC',16),(410,'Nsimbo DC',16),(411,'Kalambo DC',32),(412,'Nkasi DC',32),(413,'Sumbawanga DC',32),(414,'Iringa DC',11),(415,'Mufindi DC',11),(416,'Ludewa DC',13),(417,'Njombe DC',13),(418,'Wanging\'ombe DC',13),(419,'Busokelo DC',5),(420,'Chunya DC',5),(421,'Kyela DC',5),(422,'Mbarali DC',5),(423,'Ileje DC',15),(424,'Mbozi DC',15),(425,'Momba DC',15),(426,'Mbinga DC',4),(427,'Namtumbo DC',4),(428,'Nyasa DC',4),(429,'Madaba DC',4),(430,'Tunduru DC',4),(431,'Gairo DC',10),(432,'Kilombero DC',10),(433,'Malinyi DC',10),(434,'Mvomero DC',10),(435,'Ulanga DC',10),(436,'Bagamoyo DC',9),(437,'Kibaha DC',9),(438,'Kibiti DC',9),(439,'Kisarawe DC',9),(440,'Mafia DC',9),(441,'Rufiji DC',9),(442,'Kilwa DC',2),(443,'Lindi DC',2),(444,'Masasi DC',1),(445,'Nanyumbu DC',1),(446,'Tandahimba DC',1),(447,'Kilindi DC',3),(448,'Korogwe DC',3),(449,'Lushoto DC',3),(450,'Muheza DC',3),(451,'Pangani DC',3),(452,'Moshi MC',14),(453,'Mlele DC',16),(454,'Nachingwea DC',2),(455,'Chamino',7),(456,'Misenyi DC',23),(457,'Mpanda TC',16),(458,'Kibaha TC',9),(459,'Rufuji DC',9),(460,'Ruangwa DC',2),(461,'Masasi DC',2),(462,'Singida MC',6),(463,'Tabora MC',8),(464,'Musoma MC',25),(465,'Kigoma MC',18),(466,'Ilemela MC',26),(467,'Shinyanga MC',17),(468,'Bukoba MC',23),(469,'Sumbawanga MC',32),(470,'Songea MC',4),(471,'Morogoro MC',10),(472,'Mtwara MC',1),(473,'Ilala MC',30),(474,'Kinondoni MC',30),(475,'Temeke MC',30),(476,'Lindi MC',2),(477,'Kondoa TC',7),(478,'Babati TC',20),(479,'Mbulu TC',20),(480,'Nzega TC',8),(481,'Bunda TC',25),(482,'Tarime TC',25),(483,'Geita TC',24),(484,'Bariadi TC',31),(485,'Kahama TC',17),(486,'Makambako TC',13),(487,'Njombe TC',13),(488,'Tunduma TC',5),(489,'Mbinga TC',4),(490,'Ifakara TC',10),(491,'Nanyamba TC',1),(492,'Nanyumba TC',1);
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entries`
--

DROP TABLE IF EXISTS `entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_type` enum('International','Local') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `transport_means` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vessel` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `point_of_entry` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seat_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `visiting_purpose` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_visiting_purpose` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration_stay` int(11) DEFAULT NULL,
  `employment` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `hotel` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `street` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mobile` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_origin` int(11) DEFAULT NULL,
  `visit_area_ebola` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `taken_care_sick_person_ebola` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `participated_burial_ebola` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `visit_area_corona` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taken_care_sick_person_corona` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `participated_burial_corona` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symptoms` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `other_symptoms` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `temperature` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_taken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entries`
--

LOCK TABLES `entries` WRITE;
/*!40000 ALTER TABLE `entries` DISABLE KEYS */;
INSERT INTO `entries` VALUES (1,'Local','Renfrid Ngolongolo','21','Female','TZ','','','','','0000-00-00','','','Tourist','',0,'Non-Government','','',0,0,'','','',6,'No','No','No','No','No','No','3,4','',NULL,NULL,'2020-04-21 09:27:21',NULL,NULL),(2,'Local','Renfrid Ngolongolo','32','','TZ','','','','','0000-00-00','','','Transit','',0,'Non-Profit','','',0,0,'','','',9,'No','No','No','No','No','No','4,5,6,7','',NULL,NULL,'2020-04-21 09:28:57',NULL,NULL),(3,'International','','','','','Passport No','','','','0000-00-00','','','','',0,'','','',0,0,'','','',0,'No','No','No','No','No','No','2,4','',NULL,NULL,'2020-04-21 10:05:37',NULL,NULL);
/*!40000 ALTER TABLE `entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'members','General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poe`
--

DROP TABLE IF EXISTS `poe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poe`
--

LOCK TABLES `poe` WRITE;
/*!40000 ALTER TABLE `poe` DISABLE KEYS */;
INSERT INTO `poe` VALUES (1,'Julius Kambarage Nyerere Internation Airport (JKNI)','Dar es Salaam');
/*!40000 ALTER TABLE `poe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quarantines`
--

DROP TABLE IF EXISTS `quarantines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quarantines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `supervisor` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quarantines`
--

LOCK TABLES `quarantines` WRITE;
/*!40000 ALTER TABLE `quarantines` DISABLE KEYS */;
/*!40000 ALTER TABLE `quarantines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (2,'Arusha'),(3,'Coast/ Pwani'),(4,'Dar es Salaam'),(5,'Dodoma'),(6,'Geita'),(7,'Iringa'),(8,'Kagera'),(9,'Katavi'),(10,'Kigoma'),(11,'Kilimanjaro'),(12,'Lindi'),(13,'Manyara'),(14,'Mara'),(15,'Mbeya'),(16,'Morogoro'),(17,'Mtwara'),(18,'Mwanza'),(19,'Njombe'),(20,'Rukwa'),(21,'Ruvuma'),(22,'Shinyanga'),(23,'Simiyu'),(24,'Singida'),(25,'Songwe'),(26,'Tabora'),(28,'Tanga'),(29,'Songea');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supervisors`
--

DROP TABLE IF EXISTS `supervisors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supervisors`
--

LOCK TABLES `supervisors` WRITE;
/*!40000 ALTER TABLE `supervisors` DISABLE KEYS */;
/*!40000 ALTER TABLE `supervisors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `symptoms`
--

DROP TABLE IF EXISTS `symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `symptoms`
--

LOCK TABLES `symptoms` WRITE;
/*!40000 ALTER TABLE `symptoms` DISABLE KEYS */;
INSERT INTO `symptoms` VALUES (1,'Fever','fever'),(2,'Swollen glands','swollen_gland'),(3,'Vomiting','vomiting'),(4,'Coughing/Shortness breathing ','coughing'),(5,'Skin rash','skin_rash'),(6,'Jaundice','jaundice'),(7,'Headache','headache'),(8,'Loss of appetite','loss_of_appetite'),(9,'Joint/Muscle pain','joint_pain'),(10,'Diarrhea','diarrhea'),(11,'Body weakness','body_weakness'),(12,'Unusual bleeding','unusual_bleeding'),(13,'Flu like symptoms','flu'),(14,'Difficulty in swallowing','difficulty_swallowing'),(15,'Chills','chills'),(16,'Paralysis','paralysis'),(1000,'None of above','none_of_above');
/*!40000 ALTER TABLE `symptoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','admin','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,NULL,1268889823,1587373530,1,'Sacids','Tanzania','SACIDS','0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1,1),(2,1,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visited_areas`
--

DROP TABLE IF EXISTS `visited_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visited_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `area` int(11) DEFAULT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visited_areas`
--

LOCK TABLES `visited_areas` WRITE;
/*!40000 ALTER TABLE `visited_areas` DISABLE KEYS */;
INSERT INTO `visited_areas` VALUES (1,1,4,'K','2020-04-07',0),(2,1,NULL,'i',NULL,NULL),(3,2,3,'m','2020-04-07',23),(4,3,198,'2escs','2020-04-04',21),(5,3,236,NULL,'2020-04-11',21);
/*!40000 ALTER TABLE `visited_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visited_countries`
--

DROP TABLE IF EXISTS `visited_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visited_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poe_entry_id` int(11) NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visited_countries`
--

LOCK TABLES `visited_countries` WRITE;
/*!40000 ALTER TABLE `visited_countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `visited_countries` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-21 13:08:28
