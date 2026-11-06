-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_karaoke
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint unsigned NOT NULL,
  `data_compra` date NOT NULL,
  `valor_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compras_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `compras_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,6,'1975-05-21',123.25,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `compras` VALUES (2,6,'1988-06-20',114.79,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `compras` VALUES (3,2,'2020-04-11',265.95,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `compras` VALUES (4,4,'1977-02-01',160.91,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `compras` VALUES (5,2,'2016-05-19',74.83,'2026-11-05 20:07:26','2026-11-05 20:07:27');
INSERT INTO `compras` VALUES (6,6,'1981-04-03',222.64,'2026-11-05 20:07:26','2026-11-05 20:07:27');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_compras`
--

DROP TABLE IF EXISTS `item_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_compras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `compra_id` bigint unsigned NOT NULL,
  `produto_id` bigint unsigned NOT NULL,
  `quantidade` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_compras_compra_id_foreign` (`compra_id`),
  KEY `item_compras_produto_id_foreign` (`produto_id`),
  CONSTRAINT `item_compras_compra_id_foreign` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_compras_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_compras`
--

LOCK TABLES `item_compras` WRITE;
/*!40000 ALTER TABLE `item_compras` DISABLE KEYS */;
INSERT INTO `item_compras` VALUES (1,1,1,3,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (2,1,5,1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (3,2,2,1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (4,2,4,3,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (5,3,1,5,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (6,3,8,5,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (7,4,1,3,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (8,4,5,2,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (9,5,3,1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (10,5,4,2,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_compras` VALUES (11,6,4,5,'2026-11-05 20:07:27','2026-11-05 20:07:27');
INSERT INTO `item_compras` VALUES (12,6,8,4,'2026-11-05 20:07:27','2026-11-05 20:07:27');
/*!40000 ALTER TABLE `item_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_reservas`
--

DROP TABLE IF EXISTS `item_reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_reservas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reserva_id` bigint unsigned NOT NULL,
  `produto_id` bigint unsigned NOT NULL,
  `quantidade` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_reservas_reserva_id_foreign` (`reserva_id`),
  KEY `item_reservas_produto_id_foreign` (`produto_id`),
  CONSTRAINT `item_reservas_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  CONSTRAINT `item_reservas_reserva_id_foreign` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_reservas`
--

LOCK TABLES `item_reservas` WRITE;
/*!40000 ALTER TABLE `item_reservas` DISABLE KEYS */;
INSERT INTO `item_reservas` VALUES (1,1,4,4,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (2,1,6,1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (3,2,3,5,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (4,2,4,4,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (5,3,1,3,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (6,3,2,1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (7,4,1,1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (8,4,5,2,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (9,5,2,1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (10,5,3,5,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (11,6,4,2,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `item_reservas` VALUES (12,6,5,4,'2026-11-05 20:07:26','2026-11-05 20:07:26');
/*!40000 ALTER TABLE `item_reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` VALUES (4,'2026_11_05_165201_create_usuarios_table',1);
INSERT INTO `migrations` VALUES (5,'2026_11_05_165202_create_salas_table',1);
INSERT INTO `migrations` VALUES (6,'2026_11_05_165203_create_playlists_table',1);
INSERT INTO `migrations` VALUES (7,'2026_11_05_165204_create_produtos_table',1);
INSERT INTO `migrations` VALUES (8,'2026_11_05_165205_create_reservas_table',1);
INSERT INTO `migrations` VALUES (9,'2026_11_05_165206_create_item_reservas_table',1);
INSERT INTO `migrations` VALUES (10,'2026_11_05_165207_create_pagamentos_table',1);
INSERT INTO `migrations` VALUES (11,'2026_11_05_165208_create_compras_table',1);
INSERT INTO `migrations` VALUES (12,'2026_11_05_165209_create_item_compras_table',1);
INSERT INTO `migrations` VALUES (16,'2026_11_06_170001_add_imagem_to_produtos_table',2);
INSERT INTO `migrations` VALUES (17,'2026_11_06_170002_add_capa_to_playlists_table',2);
INSERT INTO `migrations` VALUES (18,'2026_11_06_170003_update_playlist_on_reservas_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reserva_id` bigint unsigned NOT NULL,
  `valor_total` decimal(12,2) NOT NULL,
  `forma_pagamento` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_confirmacao` datetime DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parcela` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pagamentos_reserva_id_unique` (`reserva_id`),
  CONSTRAINT `pagamentos_reserva_id_foreign` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentos`
--

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` VALUES (1,5,416.54,'Cartão de crédito','2026-11-05 17:07:26','Confirmado',3,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `pagamentos` VALUES (2,1,374.15,'Cartão de débito','2026-11-05 17:07:26','Confirmado',1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `pagamentos` VALUES (3,2,305.35,'PIX',NULL,'Pendente',1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `pagamentos` VALUES (4,3,365.98,'PIX',NULL,'Pendente',1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `pagamentos` VALUES (5,6,700.24,'Cartão de débito',NULL,'Pendente',1,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `pagamentos` VALUES (6,4,263.85,'Cartão de crédito',NULL,'Pendente',3,'2026-11-05 20:07:26','2026-11-05 20:07:26');
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capa` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlists`
--

LOCK TABLES `playlists` WRITE;
/*!40000 ALTER TABLE `playlists` DISABLE KEYS */;
INSERT INTO `playlists` VALUES (1,'Clássicos do Pop','Pop','http://pereira.com.br/consectetur-consequuntur-quibusdam-velit-temporibus-reprehenderit-ex-molestiae',NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `playlists` VALUES (2,'Clássicos do Sertanejo','Sertanejo','http://www.marinho.com.br/animi-similique-voluptas-explicabo-error-ea-id',NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `playlists` VALUES (3,'Clássicos do Pagode','Pagode','http://beltrao.com.br/temporibus-provident-est-aliquam-enim-veritatis-architecto-quod',NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `playlists` VALUES (4,'Clássicos do Rock','Rock','https://www.galindo.com/aliquam-sequi-laudantium-quas-ullam-expedita-quia-vero',NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `playlists` VALUES (5,'Clássicos do MPB','MPB','http://www.serra.com.br/enim-expedita-asperiores-soluta-fugit-dolore-quasi',NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `playlists` VALUES (6,'Clássicos do Metal','Metal','http://dearruda.org/',NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
/*!40000 ALTER TABLE `playlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(12,2) NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alcoolico` tinyint(1) NOT NULL DEFAULT '0',
  `estoque` int NOT NULL DEFAULT '0',
  `imagem` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Suco natural',28.53,'Bebida',0,79,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (2,'Porção de pastel',40.39,'Comida',0,26,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (3,'Hambúrguer',25.23,'Comida',0,47,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (4,'Caipirinha',24.80,'Bebida',1,83,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (5,'Porção de batata frita',37.66,'Comida',0,32,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (6,'Margarita',34.95,'Bebida',1,12,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (7,'Cerveja',9.37,'Bebida',1,69,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (8,'Refrigerante',24.66,'Bebida',0,30,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `produtos` VALUES (11,'Coca cola de café',0.05,'Bebida',0,3,NULL,'2026-11-06 22:53:53','2026-11-06 22:53:53');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sala_id` bigint unsigned NOT NULL,
  `usuario_id` bigint unsigned NOT NULL,
  `playlist_id` bigint unsigned DEFAULT NULL,
  `data_reserva` date NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL,
  `menor_presente` tinyint(1) NOT NULL DEFAULT '0',
  `quantidade_pessoas` int NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_cancelamento` datetime DEFAULT NULL,
  `motivo_cancelamento` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservas_playlist_id_unique` (`playlist_id`),
  KEY `reservas_sala_id_foreign` (`sala_id`),
  KEY `reservas_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `reservas_playlist_id_foreign` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`),
  CONSTRAINT `reservas_sala_id_foreign` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`),
  CONSTRAINT `reservas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,3,5,2,'2026-12-29','14:00:00','17:00:00',0,5,'Confirmada',NULL,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `reservas` VALUES (2,2,6,3,'2026-11-17','14:00:00','15:00:00',0,4,'Cancelada','2026-11-05 17:07:26','Imprevisto do cliente','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `reservas` VALUES (3,4,5,1,'2026-12-12','14:00:00','17:00:00',1,2,'Cancelada','2026-11-05 17:07:26','Imprevisto do cliente','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `reservas` VALUES (4,4,1,4,'2026-12-25','15:00:00','17:00:00',1,4,'Pendente',NULL,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `reservas` VALUES (5,5,1,5,'2026-11-16','16:00:00','17:00:00',1,18,'Confirmada',NULL,NULL,'2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `reservas` VALUES (6,1,5,6,'2026-11-16','19:00:00','21:00:00',0,9,'Cancelada','2026-11-05 17:07:26','Imprevisto do cliente','2026-11-05 20:07:26','2026-11-05 20:07:26');
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salas`
--

DROP TABLE IF EXISTS `salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacidade` int NOT NULL,
  `preco_hora` decimal(12,2) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salas`
--

LOCK TABLES `salas` WRITE;
/*!40000 ALTER TABLE `salas` DISABLE KEYS */;
INSERT INTO `salas` VALUES (1,'Grande',25,250.00,'Ocupada','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `salas` VALUES (2,'Pequena',5,80.00,'Disponível','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `salas` VALUES (3,'Pequena',5,80.00,'Disponível','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `salas` VALUES (4,'Pequena',5,80.00,'Ocupada','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `salas` VALUES (5,'Grande',25,250.00,'Manutenção','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `salas` VALUES (6,'Grande',25,250.00,'Manutenção','2026-11-05 20:07:26','2026-11-05 20:07:26');
/*!40000 ALTER TABLE `salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_cpf_unique` (`cpf`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Dr. Ícaro Ramires Sobrinho','566.644.303-43','R. Arruda, 9586','1984-09-05','(49) 90213-8965','umarin@example.com','$2y$12$ehsjLOrLWvbi5d7l5whugedbruzETWyWtLFUyg0gGKKlFo401sajC','Funcionário','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `usuarios` VALUES (2,'Ricardo Aragão Escobar','332.671.835-41','Avenida Camilo, 3218. Anexo','1990-12-29','(49) 97932-2392','felipe36@example.net','$2y$12$1JuBVsFHwdjBWO.reticjeXsbf0bNmYzwobK46GXnd4mdTuSh92Ae','Cliente','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `usuarios` VALUES (3,'Gabrielly Alves Neto','691.273.139-86','Largo Carolina Vega, 1173','1989-06-23','(49) 90232-2055','tvieira@example.net','$2y$12$i2BWnjhgaahN69w8NzUbyOiak8DWPem7xZDU37DnKVZ3qEquPWv5u','Cliente','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `usuarios` VALUES (4,'Dr. Rafael Matias Cordeiro','409.241.471-16','R. Ester, 7554. Bc. 36 Ap. 52','2000-12-02','(49) 96667-0518','kevin75@example.org','$2y$12$zRv38WPFSvLyZrQl3KDZuO7jaY2FzfU35x1RYpmnydEKjjt26n0gm','Funcionário','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `usuarios` VALUES (5,'Srta. Dirce Marques Madeira Filho','923.382.898-38','R. Ayla Deverso, 41580. Apto 62','1996-03-29','(49) 98686-7099','dmendonca@example.net','$2y$12$/YFjPV.rWKb.Ac4LmBSFGuflTAmPKh/1/gTlnG85sb9PFapdmQ1k6','Cliente','2026-11-05 20:07:26','2026-11-05 20:07:26');
INSERT INTO `usuarios` VALUES (6,'Sandro Rezende','796.474.842-43','Av. Branco, 8517. F','1982-02-15','(49) 94548-5248','rogerio.queiros@example.net','$2y$12$ApUqpGj8.UumXgyYwjI.CuuyIgbxxiJwWkGPTVIg2Dz0.gzKhoOla','Cliente','2026-11-05 20:07:26','2026-11-05 20:07:26');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-06 17:01:11

-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_karaoke
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-06 17:01:11
