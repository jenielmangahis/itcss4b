-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table corecmsdb.companies
DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.companies: ~3 rows (approximately)
DELETE FROM `companies`;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`id`, `name`, `contact_number`, `facebook`, `twitter`, `instagram`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Lily\'s Dress Maker', '092888888', 'www.facebook.com/lily', 'www.twitter.com/lily', 'www.instagram.com/lily', 0, '2019-05-17 13:16:02', '2019-05-23 14:33:56', NULL),
	(2, 'core-cms', '0968655666', 'www.face.com', 'www.tweet.com', 'www.insta.com', 0, '2019-05-23 14:23:50', '2019-05-23 14:23:50', NULL),
	(3, 'Juke Photography', '963258753', 'test.com', 'tweet.com', 'instphoto.com', 0, '2019-05-23 14:24:26', '2019-05-23 14:24:34', NULL),
	(4, 'Tender Jucy', '963852741', 'tender.com', 'tender.com', 'tender.com', 1, '2019-05-23 14:34:56', '2019-05-23 14:35:04', NULL);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.company_users
DROP TABLE IF EXISTS `company_users`;
CREATE TABLE IF NOT EXISTS `company_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.company_users: ~1 rows (approximately)
DELETE FROM `company_users`;
/*!40000 ALTER TABLE `company_users` DISABLE KEYS */;
INSERT INTO `company_users` (`id`, `company_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 1, '2019-05-17 13:20:25', '2019-05-23 15:14:59', NULL),
	(2, 3, 10, '2019-05-23 15:44:49', '2019-05-28 16:36:23', NULL),
	(3, 3, 11, '2019-06-13 15:39:01', '2019-06-13 15:39:01', NULL);
/*!40000 ALTER TABLE `company_users` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(95) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(95) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_number` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_source` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_call_activity` datetime DEFAULT NULL,
  `time_in_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` mediumtext COLLATE utf8mb4_unicode_ci,
  `address2` mediumtext COLLATE utf8mb4_unicode_ci,
  `city` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contacts: ~5 rows (approximately)
DELETE FROM `contacts`;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `company_id`, `user_id`, `stage_id`, `status`, `full_name`, `firstname`, `lastname`, `email`, `mobile_number`, `work_number`, `home_number`, `data_source`, `last_call_activity`, `time_in_status`, `address1`, `address2`, `city`, `state`, `zip_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(10, 3, 11, 1, NULL, 'Testing01 Demo', 'Testing01', 'Demo', 'testing1223@gmail.com', '454545', '4545', '4545', NULL, NULL, NULL, 'dfd', 'dfdf', 'Santa Rosa', 'Laguna', '2024', '2019-06-13 14:09:00', '2019-06-13 16:18:48', NULL),
	(11, 3, 10, 1, NULL, 'Juan Carlos Binigno', 'Juan Carlos', 'Binigno', 'juanbinigno@gmail.com', '789456', '456897', '456456', NULL, NULL, NULL, '254 Gen. Malvar St., Don Pablo Subd.,', 'None', 'Binan', 'Laguna', '4026', '2019-06-13 14:12:09', '2019-06-13 16:28:20', NULL),
	(12, 3, 11, 1, NULL, 'Carlos M Magasii', 'Carlos M', 'Magasii', 'carlos.magasi@gmail.com', '45646545', '5456465', '5464', NULL, NULL, NULL, '254 Gen. Malvar St., Don Pablo Subd.,', 'None', 'Davao', 'Mindanao', '96352', '2019-06-13 16:16:20', '2019-06-13 16:19:11', NULL),
	(20, 3, 10, 1, NULL, 'Marfore Juan D', 'Marfore', 'Juan D', 'marfore@test.com', '3434', '989', '9809', NULL, NULL, NULL, 'iiuikljk', 'kjkl', 'Santa Rosa', 'Laguna', '989', '2019-06-13 16:54:27', '2019-06-13 16:54:43', NULL),
	(21, 3, 10, 1, NULL, 'BBBB BBB', 'BBBB', 'BBB', 'BBB@test.com', '5656', '9808', '9808', NULL, NULL, NULL, 'jklj', 'kjj', 'jkj', 'ljjk', 'jkj', '2019-06-13 16:56:43', '2019-06-13 16:56:43', NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_broker_informations
DROP TABLE IF EXISTS `contact_broker_informations`;
CREATE TABLE IF NOT EXISTS `contact_broker_informations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `brokerage_fee` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_broker_informations: ~5 rows (approximately)
DELETE FROM `contact_broker_informations`;
/*!40000 ALTER TABLE `contact_broker_informations` DISABLE KEYS */;
INSERT INTO `contact_broker_informations` (`id`, `contact_id`, `company_id`, `user_id`, `brokerage_fee`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 3, 11, 0.00, '2019-06-13 14:09:00', '2019-06-13 16:55:13', NULL),
	(2, 11, 3, 10, 9999.00, '2019-06-13 14:12:10', '2019-06-13 16:27:40', NULL),
	(3, 12, 3, 11, 9999.00, '2019-06-13 16:16:20', '2019-06-13 16:19:11', NULL),
	(5, 20, 3, 10, 0.00, '2019-06-13 16:54:27', '2019-06-13 16:54:27', NULL),
	(6, 21, 3, 10, 0.00, '2019-06-13 16:56:44', '2019-06-13 16:56:44', NULL);
/*!40000 ALTER TABLE `contact_broker_informations` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_business_informations
DROP TABLE IF EXISTS `contact_business_informations`;
CREATE TABLE IF NOT EXISTS `contact_business_informations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years_in_business` decimal(8,2) NOT NULL,
  `legal_entity_of_business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accept_credit_card_from_customer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gross_monthly_credit_card_sales` double(11,2) NOT NULL,
  `gross_yearly_sales` double(11,2) NOT NULL,
  `filed_bankruptcy` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankruptcy_filed` date DEFAULT NULL,
  `credit_score` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_business_informations: ~5 rows (approximately)
DELETE FROM `contact_business_informations`;
/*!40000 ALTER TABLE `contact_business_informations` DISABLE KEYS */;
INSERT INTO `contact_business_informations` (`id`, `contact_id`, `company_id`, `user_id`, `business_name`, `years_in_business`, `legal_entity_of_business`, `accept_credit_card_from_customer`, `gross_monthly_credit_card_sales`, `gross_yearly_sales`, `filed_bankruptcy`, `bankruptcy_filed`, `credit_score`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 3, 11, 'Business name..', 1.00, 'Sole Proprietorship', 'Yes', 454.00, 454.00, 'No', '1970-01-01', 'har', '2019-06-13 14:09:00', '2019-06-13 17:00:45', NULL),
	(2, 11, 3, 10, 'Tambay Update', 30.00, 'Partnership', 'Yes', 334334.00, 343434.23, 'Yes', '2019-06-30', 'Credit store update', '2019-06-13 14:12:09', '2019-06-13 16:28:20', NULL),
	(3, 12, 3, 11, 'Test Busines', 2.00, 'Limited Liability Company-LLC', 'Yes', 4545.00, 45454.00, 'Yes', '2019-06-21', 'fgfg', '2019-06-13 16:16:20', '2019-06-13 16:19:11', NULL),
	(5, 20, 3, 10, NULL, 1.00, 'Sole Proprietorship', 'Yes', 0.00, 0.00, 'Yes', NULL, 'NA', '2019-06-13 16:54:27', '2019-06-13 16:54:43', NULL),
	(6, 21, 3, 10, NULL, 1.00, 'Sole Proprietorship', 'NA', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-06-13 16:56:44', '2019-06-13 17:01:37', NULL);
/*!40000 ALTER TABLE `contact_business_informations` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_custom_fields
DROP TABLE IF EXISTS `contact_custom_fields`;
CREATE TABLE IF NOT EXISTS `contact_custom_fields` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `name` varchar(95) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_custom_fields: ~0 rows (approximately)
DELETE FROM `contact_custom_fields`;
/*!40000 ALTER TABLE `contact_custom_fields` DISABLE KEYS */;
INSERT INTO `contact_custom_fields` (`id`, `contact_id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 'test', 'this is only a test', '2019-05-17 13:25:47', '2019-05-17 13:25:47', NULL);
/*!40000 ALTER TABLE `contact_custom_fields` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_loan_informations
DROP TABLE IF EXISTS `contact_loan_informations`;
CREATE TABLE IF NOT EXISTS `contact_loan_informations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `loan_amount` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_loan_informations: ~5 rows (approximately)
DELETE FROM `contact_loan_informations`;
/*!40000 ALTER TABLE `contact_loan_informations` DISABLE KEYS */;
INSERT INTO `contact_loan_informations` (`id`, `contact_id`, `company_id`, `user_id`, `loan_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 3, 11, 1111.00, '2019-06-13 14:09:00', '2019-06-13 16:18:49', NULL),
	(2, 11, 3, 10, 9999.00, '2019-06-13 14:12:10', '2019-06-13 16:27:40', NULL),
	(3, 12, 3, 11, 9999.00, '2019-06-13 16:16:20', '2019-06-13 16:19:11', NULL),
	(5, 20, 3, 10, 0.00, '2019-06-13 16:54:27', '2019-06-13 16:54:27', NULL),
	(6, 21, 3, 10, 0.00, '2019-06-13 16:56:44', '2019-06-13 16:56:44', NULL);
/*!40000 ALTER TABLE `contact_loan_informations` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.email_templates
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.email_templates: ~0 rows (approximately)
DELETE FROM `email_templates`;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` (`id`, `company_id`, `user_id`, `name`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 33, 'test name', 'this is only a test', '2019-05-17 13:29:18', '2019-05-17 13:29:18', NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.groups: ~3 rows (approximately)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Super Admin', '2019-05-17 13:31:13', '2019-05-29 17:02:01', NULL),
	(2, 'Company User', '2019-05-29 15:25:12', '2019-05-29 15:25:12', NULL),
	(3, 'Customer', '2019-05-29 17:02:11', '2019-05-29 17:02:11', NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.migrations: ~14 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_05_15_171105_add_fields_to_users_table', 2),
	(4, '2019_05_17_115730_create_companies_table', 3),
	(5, '2019_05_17_120739_create_groups_table', 3),
	(6, '2019_05_17_121357_create_company_users_table', 4),
	(7, '2019_05_17_122755_create_contacts_table', 4),
	(8, '2019_05_17_123711_create_contact_custom_fields_table', 4),
	(9, '2019_05_17_124603_create_email_templates_table', 5),
	(10, '2019_06_03_151807_create_workflow_categories', 6),
	(11, '2019_06_03_152053_create_stages_table', 6),
	(12, '2019_06_05_083634_create_workflow_table', 7),
	(13, '2019_06_05_125241_add_fields_to_contacts_table', 8),
	(14, '2019_06_05_131623_create_contact_business_informations_table', 9),
	(15, '2019_06_05_131630_create_contact_loan_informations_table', 9),
	(16, '2019_06_05_131644_create_contact_broker_informations_table', 9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.stages
DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.stages: ~0 rows (approximately)
DELETE FROM `stages`;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Leads', '2019-06-09 08:29:17', '2019-06-09 08:29:17', NULL);
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` smallint(6) NOT NULL COMMENT '0=active,1=suspended',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.users: ~7 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `group_id`, `nickname`, `firstname`, `lastname`, `mobile_number`, `work_number`, `home_number`, `username`, `email`, `email_verified_at`, `password`, `status`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'B1', 'Bryann', 'Revina', NULL, NULL, NULL, 'bryann03', 'bryann.revina@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, 0, NULL, '2019-05-11 14:03:15', '2019-05-11 14:03:15', NULL),
	(3, 3, 'User 01', 'User', '01', '5119685', '9876565', '855965', 'user01', 'user01@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, 0, NULL, '2019-05-11 14:03:15', '2019-05-29 17:08:40', NULL),
	(4, 0, 'User 02', 'User', '02', NULL, NULL, NULL, 'user02', 'user02@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, 0, NULL, '2019-05-11 14:03:15', '2019-05-11 14:03:15', NULL),
	(5, 0, 'User 03', 'User', '03', NULL, NULL, NULL, 'user03', 'user03@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, 0, NULL, '2019-05-11 14:03:15', '2019-05-11 14:03:15', NULL),
	(6, 0, 'User 04', 'User', '04', NULL, NULL, NULL, 'user04', 'test04@test.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, 0, NULL, '2019-05-16 12:05:06', '2019-05-16 12:05:12', NULL),
	(9, 0, 'Aleng Ilay', 'Lily', 'Revina', '343', '343', '343', 'bryann4545', 'test@test.com', NULL, '$2y$10$mI/RYgVKvbxjTyW6oG4QRuZNJKo9TYIWGnpUIIUKA2EJPeUJJC0le', 'active', 0, NULL, '2019-05-16 14:49:06', '2019-05-16 15:18:05', NULL),
	(10, 2, 'Sir Juke Pangan', 'Juke', 'Pangan', '09279876542', '09209876542', '09109876542', 'juke101', 'juke.pangan@test.com', NULL, '$2y$10$iZTWCTeclAJe0Np8LUK/9eZ8Uv2ecwmgg9Hjsf1kN4.KAvXxsQaiK', NULL, 0, NULL, '2019-05-23 15:44:49', '2019-05-29 14:52:29', NULL),
	(11, 2, 'Bonn', 'Bonn', 'Mendoza', '5465454', '5465465', '56546', 'bonn03', 'bonn.mendoza@gmail.com', NULL, '$2y$10$5brM7VSVkntHle4hJRtrBOJ8X4aLJ0mGJLEQeeqlfzW0NSyT0GPSi', NULL, 0, NULL, '2019-06-13 15:39:01', '2019-06-13 15:39:01', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.workflows
DROP TABLE IF EXISTS `workflows`;
CREATE TABLE IF NOT EXISTS `workflows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `workflow_category_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.workflows: ~0 rows (approximately)
DELETE FROM `workflows`;
/*!40000 ALTER TABLE `workflows` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflows` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.workflow_categories
DROP TABLE IF EXISTS `workflow_categories`;
CREATE TABLE IF NOT EXISTS `workflow_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.workflow_categories: ~0 rows (approximately)
DELETE FROM `workflow_categories`;
/*!40000 ALTER TABLE `workflow_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
