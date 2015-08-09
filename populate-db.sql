-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: skotchbox
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
-- Table structure for table `oc_activity`
--

DROP TABLE IF EXISTS `oc_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_bin NOT NULL,
  `user` varchar(64) COLLATE utf8_bin NOT NULL,
  `affecteduser` varchar(64) COLLATE utf8_bin NOT NULL,
  `app` varchar(255) COLLATE utf8_bin NOT NULL,
  `subject` varchar(255) COLLATE utf8_bin NOT NULL,
  `subjectparams` varchar(4000) COLLATE utf8_bin NOT NULL,
  `message` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `messageparams` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `file` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `link` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `activity_user_time` (`affecteduser`,`timestamp`),
  KEY `activity_filter_by` (`affecteduser`,`user`,`timestamp`),
  KEY `activity_filter_app` (`affecteduser`,`app`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_activity`
--

LOCK TABLES `oc_activity` WRITE;
/*!40000 ALTER TABLE `oc_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_activity_mq`
--

DROP TABLE IF EXISTS `oc_activity_mq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_activity_mq` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `amq_timestamp` int(11) NOT NULL DEFAULT '0',
  `amq_latest_send` int(11) NOT NULL DEFAULT '0',
  `amq_type` varchar(255) COLLATE utf8_bin NOT NULL,
  `amq_affecteduser` varchar(64) COLLATE utf8_bin NOT NULL,
  `amq_appid` varchar(255) COLLATE utf8_bin NOT NULL,
  `amq_subject` varchar(255) COLLATE utf8_bin NOT NULL,
  `amq_subjectparams` varchar(4000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`mail_id`),
  KEY `amp_user` (`amq_affecteduser`),
  KEY `amp_latest_send_time` (`amq_latest_send`),
  KEY `amp_timestamp_time` (`amq_timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_activity_mq`
--

LOCK TABLES `oc_activity_mq` WRITE;
/*!40000 ALTER TABLE `oc_activity_mq` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_activity_mq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_appconfig`
--

DROP TABLE IF EXISTS `oc_appconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_appconfig` (
  `appid` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `configkey` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `configvalue` longtext COLLATE utf8_bin,
  PRIMARY KEY (`appid`,`configkey`),
  KEY `appconfig_config_key_index` (`configkey`),
  KEY `appconfig_appid_key` (`appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_appconfig`
--

LOCK TABLES `oc_appconfig` WRITE;
/*!40000 ALTER TABLE `oc_appconfig` DISABLE KEYS */;
INSERT INTO `oc_appconfig` VALUES ('activity','enabled','no'),('activity','installed_version','2.0.1'),('activity','types','filesystem'),('backgroundjob','lastjob','1'),('core','backgroundjobs_mode','ajax'),('core','incoming_server2server_share_enabled','no'),('core','installedat','1439048593.7236'),('core','lastcron','1439064269'),('core','lastupdateResult','{\"version\":{},\"versionstring\":{},\"url\":{},\"web\":{}}'),('core','lastupdatedat','1439062468'),('core','outgoing_server2server_share_enabled','no'),('core','public_files','files_sharing/public.php'),('core','public_gallery','gallery/public.php'),('core','public_webdav','files_sharing/publicwebdav.php'),('core','remote_files','files/appinfo/remote.php'),('core','remote_webdav','files/appinfo/remote.php'),('external','enabled','yes'),('external','installed_version','1.2'),('external','ocsid','166046'),('external','sites','[[\"Kalenteri\",\"https:\\/\\/www.google.com\\/calendar\\/embed?height=800&wkst=2&bgcolor=%23FFFFFF&src=dominante.choir.internal%40gmail.com&color=%232952A3&src=fi.finnish%23holiday%40group.v.calendar.google.com&color=%23875509&src=e_2_fi%23weeknum%40group.v.calendar.google.com&color=%23B1440E&ctz=Europe%2FHelsinki\",\"external.png\"],[\"Laulutunnit\",\"https:\\/\\/docs.google.com\\/forms\\/d\\/1-LvglKmDZZ-aXj-LAAM856Iu7pmPp-HvQjOhMDpVqWA\\/viewform?embedded=true#start=embed\",\"external.png\"]]'),('external','types',''),('files','enabled','yes'),('files','installed_version','1.1.9'),('files','types','filesystem'),('files_locking','enabled','yes'),('files_locking','installed_version',''),('files_locking','types','filesystem'),('files_pdfviewer','enabled','yes'),('files_pdfviewer','installed_version','0.7'),('files_pdfviewer','ocsid','166049'),('files_pdfviewer','types',''),('files_sharing','8','1439063753.7627'),('files_sharing','enabled','yes'),('files_sharing','incoming_server2server_share_enabled','no'),('files_sharing','installed_version','0.6.2'),('files_sharing','outgoing_server2server_share_enabled','no'),('files_sharing','types','filesystem'),('files_texteditor','enabled','yes'),('files_texteditor','installed_version','0.4'),('files_texteditor','ocsid','166051'),('files_texteditor','types',''),('files_trashbin','enabled','yes'),('files_trashbin','installed_version','0.6.3'),('files_trashbin','types','filesystem'),('files_versions','enabled','no'),('files_versions','installed_version','1.0.6'),('files_versions','types','filesystem'),('files_videoviewer','enabled','yes'),('files_videoviewer','installed_version','0.1.3'),('files_videoviewer','ocsid','166054'),('files_videoviewer','types',''),('firstrunwizard','enabled','no'),('firstrunwizard','installed_version','1.1'),('firstrunwizard','ocsid','166055'),('firstrunwizard','types',''),('gallery','enabled','yes'),('gallery','installed_version','0.6.0'),('gallery','ocsid','166056'),('gallery','types',''),('old_menu','enabled','yes'),('old_menu','installed_version','2.1'),('old_menu','types',''),('provisioning_api','enabled','yes'),('provisioning_api','installed_version','0.2'),('provisioning_api','types','filesystem'),('templateeditor','enabled','yes'),('templateeditor','installed_version','0.1'),('templateeditor','types',''),('updater','enabled','no'),('updater','installed_version','0.6'),('updater','types','');
/*!40000 ALTER TABLE `oc_appconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_file_map`
--

DROP TABLE IF EXISTS `oc_file_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_file_map` (
  `logic_path` varchar(512) COLLATE utf8_bin NOT NULL DEFAULT '',
  `logic_path_hash` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `physic_path` varchar(512) COLLATE utf8_bin NOT NULL DEFAULT '',
  `physic_path_hash` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`logic_path_hash`),
  UNIQUE KEY `file_map_pp_index` (`physic_path_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_file_map`
--

LOCK TABLES `oc_file_map` WRITE;
/*!40000 ALTER TABLE `oc_file_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_file_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_filecache`
--

DROP TABLE IF EXISTS `oc_filecache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_filecache` (
  `fileid` int(11) NOT NULL AUTO_INCREMENT,
  `storage` int(11) NOT NULL DEFAULT '0',
  `path` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `path_hash` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `mimetype` int(11) NOT NULL DEFAULT '0',
  `mimepart` int(11) NOT NULL DEFAULT '0',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `mtime` int(11) NOT NULL DEFAULT '0',
  `storage_mtime` int(11) NOT NULL DEFAULT '0',
  `encrypted` int(11) NOT NULL DEFAULT '0',
  `unencrypted_size` bigint(20) NOT NULL DEFAULT '0',
  `etag` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `permissions` int(11) DEFAULT '0',
  PRIMARY KEY (`fileid`),
  UNIQUE KEY `fs_storage_path_hash` (`storage`,`path_hash`),
  KEY `fs_parent_name_hash` (`parent`,`name`),
  KEY `fs_storage_mimetype` (`storage`,`mimetype`),
  KEY `fs_storage_mimepart` (`storage`,`mimepart`),
  KEY `fs_storage_size` (`storage`,`size`,`fileid`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_filecache`
--

LOCK TABLES `oc_filecache` WRITE;
/*!40000 ALTER TABLE `oc_filecache` DISABLE KEYS */;
INSERT INTO `oc_filecache` VALUES (1,1,'','d41d8cd98f00b204e9800998ecf8427e',-1,'',2,1,2930658,1439058444,1439058444,0,0,'55c649d2724f6',23),(2,1,'files','45b963397aa40d4a0063e0d85e4fe7a1',1,'files',2,1,715598,1439058631,1439058631,0,0,'55c64a8d860bf',31),(6,1,'files/Photos','d01bb67e7b71dd49fd06bad922f521c9',2,'Photos',2,1,678556,1439048594,1439048594,0,0,'55c62392479c5',31),(7,1,'files/Photos/Paris.jpg','a208ddedf08367bbc56963107248dda5',6,'Paris.jpg',7,6,228761,1439048594,1439048594,0,0,'b955b7d57be75c46bae0398ce820963a',27),(8,1,'files/Photos/San Francisco.jpg','9fc714efbeaafee22f7058e73d2b1c3b',6,'San Francisco.jpg',7,6,216071,1439048594,1439048594,0,0,'c41a70c534a92020cc8728b86794eec1',27),(9,1,'files/Photos/Squirrel.jpg','de85d1da71bcd6232ad893f959063b8c',6,'Squirrel.jpg',7,6,233724,1439048594,1439048594,0,0,'f918a9b91adb1c14ff459932fbae06ae',27),(10,1,'files/Yhteinen kuorokansio/testi.jes','24afabd8270976e75b24ce116349077f',38,'testi.jes',8,3,5,1439055037,1439055037,0,0,'43fff786bfb85b5d72925090cda64659',27),(11,1,'thumbnails','3b8779ba05b8f0aed49650f3ff8beb4b',1,'thumbnails',2,1,345479,1439058083,1439057914,0,0,'55c648a3227cf',31),(12,1,'thumbnails/7','6faab433a48974ab4ae1fb6910b507e5',11,'7',2,1,101758,1439058140,1439058140,0,0,'55c648a2b7c7d',31),(13,1,'thumbnails/7/1024-683-max.png','d86885abffe07ff4ea120db577666506',12,'1024-683-max.png',9,6,79994,1439057459,1439057459,0,0,'e4e3eed3fa4881538a854671a0bf8c00',27),(14,1,'thumbnails/7/400-400.png','9e8bb5a4fd24c08c095d6dab80609d45',12,'400-400.png',9,6,20084,1439057459,1439057459,0,0,'f87a9e165712827809c1b6f37f834bd9',27),(15,1,'thumbnails/8','06bd11f283c892ec519e5df4f85e1420',11,'8',2,1,115796,1439058141,1439058141,0,0,'55c648a322b77',31),(16,1,'thumbnails/8/1024-683-max.png','d942269747ee5c59b0368d0650859e58',15,'1024-683-max.png',9,6,91662,1439057460,1439057460,0,0,'2d12e1c51ab09529b539d53d5352e298',27),(17,1,'thumbnails/8/400-400.png','0c0b0d45fbae12097d43faefe9a7134d',15,'400-400.png',9,6,22255,1439057460,1439057460,0,0,'263a6bfdfc06ea16b47b19e87d9c688e',27),(18,1,'thumbnails/9','86b1ab3bceb06e26267cbe0fde8125dd',11,'9',2,1,93844,1439058141,1439058141,0,0,'55c648a302a3e',31),(19,1,'thumbnails/9/1024-768-max.png','22ab18830d2de672925ee5cf2103ea06',18,'1024-768-max.png',9,6,73058,1439057460,1439057460,0,0,'6e34efec4a07041076f9005aca84c62e',27),(20,1,'thumbnails/9/400-400.png','ab2cb8705711582cffdbfccdd9c8e612',18,'400-400.png',9,6,18904,1439057460,1439057460,0,0,'c25b76916683a901409be70e80c31622',27),(21,1,'files/Yhteinen kuorokansio/.DS_Store','946f5ae6d18ae1ea0446456f44d46a4e',38,'.DS_Store',8,3,6148,1439058548,1439058548,0,0,'fc1a3834094a23b71371b61fa3517a1b',27),(22,1,'files/Yhteinen kuorokansio/8df39c6ee82ec31f46146ece40dbf321.png','7423cd60bee5fbf5f8762a67a179d271',38,'8df39c6ee82ec31f46146ece40dbf321.png',9,6,24741,1433165998,1433165998,0,0,'71ce7282efe149551da6be4912a46353',27),(23,1,'files_trashbin/files/pikkuruba.mp4.d1439058386','af609e054411648f58230554149ff23d',35,'pikkuruba.mp4.d1439058386',8,3,8684645,1437044672,1437044672,0,0,'efabe88690193940d8bbccd258fde800',27),(24,1,'thumbnails/22','53d91e5d0404e82175284822c12d0174',11,'22',2,1,34081,1439057914,1439057914,0,0,'55c647c0418b2',31),(25,1,'thumbnails/22/192-192-max.png','bcd38707dc8cf75e6e539f9130a11db4',24,'192-192-max.png',9,6,26690,1439057914,1439057914,0,0,'f122bf32e11281ed70a9434388a02c95',27),(26,1,'thumbnails/22/72-72.png','ffb05096bfdff8a77abf8eda30ea00e5',24,'72-72.png',9,6,7391,1439057914,1439057914,0,0,'22181cf00259f07c581d33955cca1372',27),(27,1,'files_trashbin/files/2015-06-03 22.35.01.mov.d1439058386','6fab476df78c4db72cfb8c67df2ce7be',35,'2015-06-03 22.35.01.mov.d1439058386',8,3,62238146,1433410949,1433410949,0,0,'7231b6882c38ca5f4f9cd4bd830542a8',27),(28,1,'cache','0fea6a13c52b4d4725368f24b045ca84',1,'cache',2,1,0,1439058102,1439058102,0,0,'55c6487c024e5',31),(29,1,'thumbnails/7/72-72.png','5d1f4ac7703ad8568d9d980a52d1a3c8',12,'72-72.png',9,6,1680,1439058140,1439058140,0,0,'be7c728d2382989a9d06e6295682c133',27),(30,1,'thumbnails/9/72-72.png','1ac9423c22435c218cfda22daf86fae4',18,'72-72.png',9,6,1882,1439058141,1439058141,0,0,'4287679e4cba7400403ca4a898699885',27),(31,1,'thumbnails/8/72-72.png','bc2090f4410a73a7c81907c6168587df',15,'72-72.png',9,6,1879,1439058141,1439058141,0,0,'17158dacf677cf83dcbd8b29b7459143',27),(32,1,'files_trashbin/files/trailer_480p.mov.d1439058386','97ec6ba3d07c7c3d420ba8aa6e4cc57d',35,'trailer_480p.mov.d1439058386',8,3,11061011,1439058316,1439058316,0,0,'41cb15cd661aea57cdf9bbd469ddd7cf',27),(33,1,'files_trashbin/files/big-buck-bunny_trailer.webm.d1439058386','7fc06520bc058751f0a64e78cfc3796e',35,'big-buck-bunny_trailer.webm.d1439058386',8,3,2165175,1439058402,1439058402,0,0,'8e3e65bd82fd5c2bfbb40e8a8e97a4b8',27),(34,1,'files_trashbin','fb66dca5f27af6f15c1d1d81e6f8d28b',1,'files_trashbin',2,1,84148977,1439058444,1439058444,0,0,'55c649d272f56',31),(35,1,'files_trashbin/files','3014a771cbe30761f2e9ff3272110dbf',34,'files',2,1,84148977,1439058444,1439058444,0,0,'55c649d27346e',31),(36,1,'files_trashbin/versions','c639d144d3f1014051e14a98beac5705',34,'versions',2,1,0,1439058444,1439058444,0,0,'55c649d24b23c',31),(37,1,'files_trashbin/keys','9195c7cfc1b867f229ac78cc1b6a0be3',34,'keys',2,1,0,1439058444,1439058444,0,0,'55c649d24e351',31),(38,1,'files/Yhteinen kuorokansio','663e527b7812b0ce2c7239f5f7b844a8',2,'Yhteinen kuorokansio',2,1,30894,1439058555,1439058555,0,0,'55c64a417d844',31),(39,1,'files/.DS_Store','5bce846d7224d07f8ecfd1d9c3da809c',2,'.DS_Store',8,3,6148,1439058560,1439058560,0,0,'45c3a9c3466771a6731c684c901f1056',27),(50,4,'','d41d8cd98f00b204e9800998ecf8427e',-1,'',2,1,2930658,1439062915,1439062915,0,0,'55c65b83bb293',23),(51,4,'cache','0fea6a13c52b4d4725368f24b045ca84',50,'cache',2,1,0,1439058901,1439058901,0,0,'55c64b9bc5a03',31),(52,4,'files','45b963397aa40d4a0063e0d85e4fe7a1',50,'files',2,1,2728763,1439063753,1439058901,0,0,'55c65ec9b953d',31),(53,4,'files/Documents','0ad78ba05b6961d92f7970b2b3922eca',52,'Documents',2,1,36227,1439058901,1439058901,0,0,'55c64b9be4e5f',31),(54,4,'files/Documents/Example.odt','c89c560541b952a435783a7d51a27d50',53,'Example.odt',4,3,36227,1439058901,1439058901,0,0,'95508ad85e635ba7c40e53e9e8d57dc6',27),(55,4,'files/ownCloudUserManual.pdf','c8edba2d1b8eb651c107b43532c34445',52,'ownCloudUserManual.pdf',5,3,2215875,1439058901,1439058901,0,0,'f11ce33fd9b144640558cd811873cfbf',27),(56,4,'files/Photos','d01bb67e7b71dd49fd06bad922f521c9',52,'Photos',2,1,476661,1439063753,1439063753,0,0,'55c65ec9b9aec',31),(57,4,'files_trashbin/files/Paris.jpg.d1439062915','9f1071cfb972ed4d9bf5121c24622a0b',61,'Paris.jpg.d1439062915',8,3,228761,1439058901,1439058901,0,0,'2c6173dfc04c43a24193e68526e238f1',27),(58,4,'files/Photos/San Francisco.jpg','9fc714efbeaafee22f7058e73d2b1c3b',56,'San Francisco.jpg',7,6,216071,1439058901,1439058901,0,0,'91cf106a67ecc1a89e4efd861f7e1f58',27),(59,4,'files/Photos/Squirrel.jpg','de85d1da71bcd6232ad893f959063b8c',56,'Squirrel.jpg',7,6,233724,1439058901,1439058901,0,0,'ff9df70f99e8c4afcd4b0665c1df3452',27),(60,4,'files_trashbin','fb66dca5f27af6f15c1d1d81e6f8d28b',50,'files_trashbin',2,1,228761,1439062915,1439062915,0,0,'55c65b83bbc43',31),(61,4,'files_trashbin/files','3014a771cbe30761f2e9ff3272110dbf',60,'files',2,1,228761,1439062915,1439062915,0,0,'55c65b83bc0ab',31),(62,4,'files_trashbin/versions','c639d144d3f1014051e14a98beac5705',60,'versions',2,1,0,1439062915,1439062915,0,0,'55c65b83b23db',31),(63,4,'files_trashbin/keys','9195c7cfc1b867f229ac78cc1b6a0be3',60,'keys',2,1,0,1439062915,1439062915,0,0,'55c65b83b4998',31),(64,5,'','d41d8cd98f00b204e9800998ecf8427e',-1,'',2,1,2252102,1439064273,1439064273,0,0,'55c660d133286',23),(65,5,'cache','0fea6a13c52b4d4725368f24b045ca84',64,'cache',2,1,0,1439063701,1439063701,0,0,'55c65e959928a',31),(66,5,'files','45b963397aa40d4a0063e0d85e4fe7a1',64,'files',2,1,36227,1439064273,1439064273,0,0,'55c660d1394b9',31),(67,5,'files/Documents','0ad78ba05b6961d92f7970b2b3922eca',66,'Documents',2,1,36227,1439063710,1439063701,0,0,'55c65e9ecee85',31),(68,5,'files/Documents/Example.odt','c89c560541b952a435783a7d51a27d50',67,'Example.odt',4,3,36227,1439063701,1439063701,0,0,'2731e5cf941206f3b55e08bbe6f4ac5e',27),(69,5,'files_trashbin/files/ownCloudUserManual.pdf.d1439064273','a671a218107bbd46b24d6a0861d6e897',86,'ownCloudUserManual.pdf.d1439064273',8,3,2215875,1439063701,1439063701,0,0,'5242d87ac148ddda4b924b8fa279ae6c',27),(70,4,'files/Photos/Paris.jpg','a208ddedf08367bbc56963107248dda5',56,'Paris.jpg',7,6,0,1439063701,1439063701,0,0,'e2f9f2149a9724663b5300e8ba5cda6b',27),(71,5,'thumbnails','3b8779ba05b8f0aed49650f3ff8beb4b',64,'thumbnails',2,1,288555,1439063754,1439063754,0,0,'55c65eca2e268',31),(72,5,'thumbnails/8','06bd11f283c892ec519e5df4f85e1420',71,'8',2,1,93553,1439063711,1439063711,0,0,'55c65e9fcf752',31),(73,5,'thumbnails/8/1024-683-max.png','d942269747ee5c59b0368d0650859e58',72,'1024-683-max.png',9,6,91662,1439063711,1439063711,0,0,'6237168d783aeddf3785846ab284ab2c',27),(74,5,'thumbnails/8/72-72.png','bc2090f4410a73a7c81907c6168587df',72,'72-72.png',9,6,1891,1439063711,1439063711,0,0,'2955cb6a75efc3f8d96a414796855421',27),(75,5,'thumbnails/58','4b643e615bb7876970fac9d20d0cae88',71,'58',2,1,93553,1439063747,1439063747,0,0,'55c65ec3e1f32',31),(76,5,'thumbnails/58/1024-683-max.png','2aaff645a2194db04a64acf28d0832d1',75,'1024-683-max.png',9,6,91662,1439063747,1439063747,0,0,'64c476084f62755b628d676fbf185a6f',27),(77,5,'thumbnails/59','cc1f6b83d0a961a79ef2b868dfa04d95',71,'59',2,1,74947,1439063747,1439063747,0,0,'55c65ec401517',31),(78,5,'thumbnails/58/72-72.png','9fea5bb200ac01f4c787fcfe57e40352',75,'72-72.png',9,6,1891,1439063747,1439063747,0,0,'d7d3aa3e201ec3197092b88cfcb4b317',27),(79,5,'thumbnails/59/1024-768-max.png','2923915b78c8ed2fe620b9dc854ea3b3',77,'1024-768-max.png',9,6,73058,1439063747,1439063747,0,0,'8bb15f6083859fcfb752a3f6aad12e14',27),(80,5,'thumbnails/59/72-72.png','fc7eeb76005de85f9821a47fdac24575',77,'72-72.png',9,6,1889,1439063747,1439063747,0,0,'098c461f5cbc4a86ea5fe89b3723ca67',27),(81,4,'files/Photos/Screen Shot 2015-08-01 at 08.13.48.png','5a45838ceed9042ac03496e37f28b9a4',56,'Screen Shot 2015-08-01 at 08.13.48.png',9,6,26866,1439063753,1439063753,0,0,'fa44afef751f71c15975b77146efe102',27),(82,5,'thumbnails/81','d2479680e6000db0111f1ee41a406520',71,'81',2,1,26502,1439063754,1439063754,0,0,'55c65eca2e965',31),(83,5,'thumbnails/81/730-132-max.png','de4f7cd413d92ef66916de52cbe93ba8',82,'730-132-max.png',9,6,22526,1439063754,1439063754,0,0,'553a46d0d58af887b459356abfde4e56',27),(84,5,'thumbnails/81/72-72.png','64dfc78695c4fd82c85f693ca60bfec5',82,'72-72.png',9,6,3976,1439063754,1439063754,0,0,'ab3c756257c7b549ee93b1271561d325',27),(85,5,'files_trashbin','fb66dca5f27af6f15c1d1d81e6f8d28b',64,'files_trashbin',2,1,2215875,1439064273,1439064273,0,0,'55c660d133880',31),(86,5,'files_trashbin/files','3014a771cbe30761f2e9ff3272110dbf',85,'files',2,1,2215875,1439064273,1439064273,0,0,'55c660d133ca3',31),(87,5,'files_trashbin/versions','c639d144d3f1014051e14a98beac5705',85,'versions',2,1,0,1439064273,1439064273,0,0,'55c660d128c47',31),(88,5,'files_trashbin/keys','9195c7cfc1b867f229ac78cc1b6a0be3',85,'keys',2,1,0,1439064273,1439064273,0,0,'55c660d12b599',31);
/*!40000 ALTER TABLE `oc_filecache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_files_trash`
--

DROP TABLE IF EXISTS `oc_files_trash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_files_trash` (
  `auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(250) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timestamp` varchar(12) COLLATE utf8_bin NOT NULL DEFAULT '',
  `location` varchar(512) COLLATE utf8_bin NOT NULL DEFAULT '',
  `type` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `mime` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`auto_id`),
  KEY `id_index` (`id`),
  KEY `timestamp_index` (`timestamp`),
  KEY `user_index` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_files_trash`
--

LOCK TABLES `oc_files_trash` WRITE;
/*!40000 ALTER TABLE `oc_files_trash` DISABLE KEYS */;
INSERT INTO `oc_files_trash` VALUES (1,'pikkuruba.mp4','admin','1439058386','.',NULL,NULL),(2,'2015-06-03 22.35.01.mov','admin','1439058386','.',NULL,NULL),(3,'trailer_480p.mov','admin','1439058386','.',NULL,NULL),(4,'big-buck-bunny_trailer.webm','admin','1439058386','.',NULL,NULL),(5,'Paris.jpg','saara-sopraano','1439062915','Photos',NULL,NULL),(6,'ownCloudUserManual.pdf','teemu-tenori','1439064273','.',NULL,NULL);
/*!40000 ALTER TABLE `oc_files_trash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_group_admin`
--

DROP TABLE IF EXISTS `oc_group_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_group_admin` (
  `gid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `uid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`gid`,`uid`),
  KEY `group_admin_uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_group_admin`
--

LOCK TABLES `oc_group_admin` WRITE;
/*!40000 ALTER TABLE `oc_group_admin` DISABLE KEYS */;
INSERT INTO `oc_group_admin` VALUES ('kuorolaiset','ryhmayllapitaja');
/*!40000 ALTER TABLE `oc_group_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_group_user`
--

DROP TABLE IF EXISTS `oc_group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_group_user` (
  `gid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `uid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`gid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_group_user`
--

LOCK TABLES `oc_group_user` WRITE;
/*!40000 ALTER TABLE `oc_group_user` DISABLE KEYS */;
INSERT INTO `oc_group_user` VALUES ('admin','admin'),('kuorolaiset','ryhmayllapitaja'),('kuorolaiset','saara-sopraano'),('kuorolaiset','teemu-tenori');
/*!40000 ALTER TABLE `oc_group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_groups`
--

DROP TABLE IF EXISTS `oc_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_groups` (
  `gid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_groups`
--

LOCK TABLES `oc_groups` WRITE;
/*!40000 ALTER TABLE `oc_groups` DISABLE KEYS */;
INSERT INTO `oc_groups` VALUES ('admin'),('kuorolaiset');
/*!40000 ALTER TABLE `oc_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_jobs`
--

DROP TABLE IF EXISTS `oc_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `argument` varchar(4000) COLLATE utf8_bin NOT NULL DEFAULT '',
  `last_run` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `job_class_index` (`class`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_jobs`
--

LOCK TABLES `oc_jobs` WRITE;
/*!40000 ALTER TABLE `oc_jobs` DISABLE KEYS */;
INSERT INTO `oc_jobs` VALUES (1,'OCA\\Activity\\BackgroundJob\\EmailNotification','null',1439051409),(2,'OCA\\Activity\\BackgroundJob\\ExpireActivities','null',1439049617),(3,'OCA\\Files_sharing\\Lib\\DeleteOrphanedSharesJob','null',1439051394),(4,'OC\\Command\\CommandJob','\"O:33:\\\"OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\\":2:{s:39:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000user\\\";s:5:\\\"admin\\\";s:47:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000trashBinSize\\\";i:8684645;}\"',0),(5,'OC\\Command\\CommandJob','\"O:33:\\\"OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\\":2:{s:39:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000user\\\";s:5:\\\"admin\\\";s:47:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000trashBinSize\\\";i:70922791;}\"',0),(6,'OC\\Command\\CommandJob','\"O:33:\\\"OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\\":2:{s:39:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000user\\\";s:5:\\\"admin\\\";s:47:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000trashBinSize\\\";i:81983802;}\"',0),(7,'OC\\Command\\CommandJob','\"O:33:\\\"OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\\":2:{s:39:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000user\\\";s:5:\\\"admin\\\";s:47:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000trashBinSize\\\";i:84148977;}\"',0),(8,'OC\\Command\\CommandJob','\"O:33:\\\"OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\\":2:{s:39:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000user\\\";s:14:\\\"saara-sopraano\\\";s:47:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000trashBinSize\\\";i:228761;}\"',0),(9,'OC\\Command\\CommandJob','\"O:33:\\\"OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\\":2:{s:39:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000user\\\";s:12:\\\"teemu-tenori\\\";s:47:\\\"\\u0000OCA\\\\Files_Trashbin\\\\Command\\\\Expire\\u0000trashBinSize\\\";i:2215875;}\"',0);
/*!40000 ALTER TABLE `oc_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_mimetypes`
--

DROP TABLE IF EXISTS `oc_mimetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_mimetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mimetype` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mimetype_id_index` (`mimetype`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_mimetypes`
--

LOCK TABLES `oc_mimetypes` WRITE;
/*!40000 ALTER TABLE `oc_mimetypes` DISABLE KEYS */;
INSERT INTO `oc_mimetypes` VALUES (3,'application'),(8,'application/octet-stream'),(5,'application/pdf'),(4,'application/vnd.oasis.opendocument.text'),(1,'httpd'),(2,'httpd/unix-directory'),(6,'image'),(7,'image/jpeg'),(9,'image/png'),(10,'video'),(11,'video/mp4'),(12,'video/quicktime'),(13,'video/webm');
/*!40000 ALTER TABLE `oc_mimetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_preferences`
--

DROP TABLE IF EXISTS `oc_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_preferences` (
  `userid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `appid` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `configkey` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `configvalue` longtext COLLATE utf8_bin,
  PRIMARY KEY (`userid`,`appid`,`configkey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_preferences`
--

LOCK TABLES `oc_preferences` WRITE;
/*!40000 ALTER TABLE `oc_preferences` DISABLE KEYS */;
INSERT INTO `oc_preferences` VALUES ('admin','core','lang','fi_FI'),('admin','core','timezone','Europe/Helsinki'),('admin','firstrunwizard','show','0'),('admin','login','lastLogin','1439062468'),('saara-sopraano','core','timezone','Europe/Helsinki'),('saara-sopraano','files_sharing','last_propagate','1439058843.7899'),('saara-sopraano','login','lastLogin','1439062877'),('teemu-tenori','files_sharing','last_propagate','1439063754.0446'),('teemu-tenori','login','lastLogin','1439063701');
/*!40000 ALTER TABLE `oc_preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_privatedata`
--

DROP TABLE IF EXISTS `oc_privatedata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_privatedata` (
  `keyid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `app` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `key` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`keyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_privatedata`
--

LOCK TABLES `oc_privatedata` WRITE;
/*!40000 ALTER TABLE `oc_privatedata` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_privatedata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_properties`
--

DROP TABLE IF EXISTS `oc_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `propertypath` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `propertyname` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `propertyvalue` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_index` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_properties`
--

LOCK TABLES `oc_properties` WRITE;
/*!40000 ALTER TABLE `oc_properties` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_share`
--

DROP TABLE IF EXISTS `oc_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `share_type` smallint(6) NOT NULL DEFAULT '0',
  `share_with` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `uid_owner` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `parent` int(11) DEFAULT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `item_source` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `item_target` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `file_source` int(11) DEFAULT NULL,
  `file_target` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `permissions` smallint(6) NOT NULL DEFAULT '0',
  `stime` bigint(20) NOT NULL DEFAULT '0',
  `accepted` smallint(6) NOT NULL DEFAULT '0',
  `expiration` datetime DEFAULT NULL,
  `token` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `mail_send` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `item_share_type_index` (`item_type`,`share_type`),
  KEY `file_source_index` (`file_source`),
  KEY `token_index` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_share`
--

LOCK TABLES `oc_share` WRITE;
/*!40000 ALTER TABLE `oc_share` DISABLE KEYS */;
INSERT INTO `oc_share` VALUES (1,3,NULL,'admin',NULL,'file','10','/10',10,'/testi.jes',1,1439058460,0,NULL,'yzmzHpodKAyjksf',0),(4,0,'saara-sopraano','admin',NULL,'folder','38','/38',38,'/Yhteinen kuorokansio',17,1439058828,0,NULL,NULL,0),(5,0,'teemu-tenori','saara-sopraano',4,'folder','38','/38',38,'/Yhteinen kuorokansio',17,1439062454,0,NULL,NULL,0),(6,0,'saara-sopraano','admin',NULL,'folder','6','/6',6,'/Photos (2)',17,1439062531,0,NULL,NULL,0),(7,0,'teemu-tenori','admin',NULL,'file','8','/8',8,'/San Francisco.jpg',1,1439062678,0,NULL,NULL,0),(8,0,'teemu-tenori','saara-sopraano',NULL,'folder','56','/56',56,'/Photos',5,1439063670,0,NULL,NULL,0);
/*!40000 ALTER TABLE `oc_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_share_external`
--

DROP TABLE IF EXISTS `oc_share_external`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_share_external` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remote` varchar(512) COLLATE utf8_bin NOT NULL COMMENT 'Url of the remove owncloud instance',
  `remote_id` int(11) NOT NULL DEFAULT '-1',
  `share_token` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'Public share token',
  `password` varchar(64) COLLATE utf8_bin DEFAULT NULL COMMENT 'Optional password for the public share',
  `name` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'Original name on the remote server',
  `owner` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'User that owns the public share on the remote server',
  `user` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'Local user which added the external share',
  `mountpoint` varchar(4000) COLLATE utf8_bin NOT NULL COMMENT 'Full path where the share is mounted',
  `mountpoint_hash` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'md5 hash of the mountpoint',
  `accepted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sh_external_mp` (`user`,`mountpoint_hash`),
  KEY `sh_external_user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_share_external`
--

LOCK TABLES `oc_share_external` WRITE;
/*!40000 ALTER TABLE `oc_share_external` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_share_external` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_storages`
--

DROP TABLE IF EXISTS `oc_storages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_storages` (
  `id` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `numeric_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`numeric_id`),
  UNIQUE KEY `storages_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_storages`
--

LOCK TABLES `oc_storages` WRITE;
/*!40000 ALTER TABLE `oc_storages` DISABLE KEYS */;
INSERT INTO `oc_storages` VALUES ('home::admin',1),('home::saara-sopraano',4),('home::teemu-tenori',5),('local::/var/www/public/data/',2);
/*!40000 ALTER TABLE `oc_storages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_users`
--

DROP TABLE IF EXISTS `oc_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_users` (
  `uid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `displayname` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_users`
--

LOCK TABLES `oc_users` WRITE;
/*!40000 ALTER TABLE `oc_users` DISABLE KEYS */;
INSERT INTO `oc_users` VALUES ('admin',NULL,'1|$2y$10$k3jSPG9quxy3ldd8amS/W..mHf3iNIeKplAkDd7Iw4BIuviRfA6RO'),('ryhmayllapitaja',NULL,'1|$2y$10$68vDuqxLD0Na7LQgos5IouFPIwZTIjJ8iz2RNst5MKRDifQ1xXHpi'),('saara-sopraano',NULL,'1|$2y$10$P7p8PfV8tQ4rGwsQxYtjS.1yLlvceFnxQeVYNvkuNKrCQJIul7HJ.'),('teemu-tenori',NULL,'1|$2y$10$yVI/.9XdErwB4MLqnh2MxeRcoOhwA4N7N9VPqgHcWqZrC1JKBo92G');
/*!40000 ALTER TABLE `oc_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_vcategory`
--

DROP TABLE IF EXISTS `oc_vcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_vcategory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `type` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `category` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uid_index` (`uid`),
  KEY `type_index` (`type`),
  KEY `category_index` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_vcategory`
--

LOCK TABLES `oc_vcategory` WRITE;
/*!40000 ALTER TABLE `oc_vcategory` DISABLE KEYS */;
INSERT INTO `oc_vcategory` VALUES (1,'admin','files','_$!<Favorite>!$_');
/*!40000 ALTER TABLE `oc_vcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_vcategory_to_object`
--

DROP TABLE IF EXISTS `oc_vcategory_to_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_vcategory_to_object` (
  `objid` int(10) unsigned NOT NULL DEFAULT '0',
  `categoryid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`categoryid`,`objid`,`type`),
  KEY `vcategory_objectd_index` (`objid`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_vcategory_to_object`
--

LOCK TABLES `oc_vcategory_to_object` WRITE;
/*!40000 ALTER TABLE `oc_vcategory_to_object` DISABLE KEYS */;
INSERT INTO `oc_vcategory_to_object` VALUES (7,1,'files');
/*!40000 ALTER TABLE `oc_vcategory_to_object` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-08 20:06:33
