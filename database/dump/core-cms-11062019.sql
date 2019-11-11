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

-- Dumping data for table corecmsdb.companies: ~4 rows (approximately)
DELETE FROM `companies`;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`id`, `name`, `contact_number`, `facebook`, `twitter`, `instagram`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Lily\'s Dress Maker', '092888888', 'www.facebook.com/lily', 'www.twitter.com/lily', 'www.instagram.com/lily', 0, '2019-05-17 05:16:02', '2019-05-23 06:33:56', NULL),
	(2, 'core-cms', '0968655666', 'www.face.com', 'www.tweet.com', 'www.insta.com', 0, '2019-05-23 06:23:50', '2019-05-23 06:23:50', NULL),
	(3, 'Juke Photography', '963258753', 'test.com', 'tweet.com', 'instphoto.com', 0, '2019-05-23 06:24:26', '2019-05-23 06:24:34', NULL),
	(4, 'Tender Jucy', '963852741', 'tender.com', 'tender.com', 'tender.com', 1, '2019-05-23 06:34:56', '2019-05-23 06:35:04', NULL);
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

-- Dumping data for table corecmsdb.company_users: ~3 rows (approximately)
DELETE FROM `company_users`;
/*!40000 ALTER TABLE `company_users` DISABLE KEYS */;
INSERT INTO `company_users` (`id`, `company_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 1, '2019-05-17 05:20:25', '2019-05-23 07:14:59', NULL),
	(2, 3, 10, '2019-05-23 07:44:49', '2019-05-28 08:36:23', NULL),
	(3, 3, 11, '2019-06-13 07:39:01', '2019-06-13 07:39:01', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contacts: ~9 rows (approximately)
DELETE FROM `contacts`;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `company_id`, `user_id`, `stage_id`, `status`, `full_name`, `firstname`, `lastname`, `email`, `mobile_number`, `work_number`, `home_number`, `data_source`, `last_call_activity`, `time_in_status`, `address1`, `address2`, `city`, `state`, `zip_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(10, 3, 11, 1, '1', 'Testing01 Demo', 'Testing01', 'Demo', 'testing1223@gmail.com', '454545', '4545', '4545', NULL, NULL, NULL, 'dfd', 'dfdf', 'Santa Rosa', 'Laguna', '2024', '2019-06-13 06:09:00', '2019-06-26 07:12:57', NULL),
	(11, 3, 10, 1, '2', 'Juan Carlos Binigno', 'Juan Carlos', 'Binigno', 'juanbinigno@gmail.com', '789456', '456897', '456456', NULL, NULL, NULL, '254 Gen. Malvar St., Don Pablo Subd.,', 'None', 'Binan', 'Laguna', '4026', '2019-06-13 06:12:09', '2019-06-26 07:13:03', NULL),
	(12, 3, 11, 1, NULL, 'Carlos M Magasii', 'Carlos M', 'Magasii', 'carlos.magasi@gmail.com', '45646545', '5456465', '5464', NULL, NULL, NULL, '254 Gen. Malvar St., Don Pablo Subd.,', 'None', 'Davao', 'Mindanao', '96352', '2019-06-13 08:16:20', '2019-06-13 08:19:11', NULL),
	(20, 3, 10, 2, '3', 'Marfore Juan D', 'Marfore', 'Juan D', 'marfore@test.com', '3434', '989', '9809', NULL, NULL, NULL, 'iiuikljk', 'kjkl', 'Santa Rosa', 'Laguna', '989', '2019-06-13 08:54:27', '2019-06-21 06:42:50', NULL),
	(21, 3, 10, 1, NULL, 'BBBB BBB', 'BBBB', 'BBB', 'BBB@test.com', '5656', '9808', '9808', NULL, NULL, NULL, 'jklj', 'kjj', 'jkj', 'ljjk', 'jkj', '2019-06-13 08:56:43', '2019-06-13 08:56:43', NULL),
	(22, 3, 11, 2, '3', 'Lily Revina', 'Lily', 'Revina', 'lily@test.com', '4545', '88787', '878787', NULL, NULL, NULL, 'dfdf', 'dfdf', 'dfdf', 'dfd', '3434', '2019-06-21 06:31:17', '2019-06-21 06:40:50', NULL),
	(26, 2, 1, 1, '1', 'Jeniel Hudlom', 'Jeniel', 'Hudlom', 'jeniel@test.com', '9206968574', '9206968574', '9206968574', 'Import Customer Data', NULL, NULL, '254 Gen. Malvar St., Barangay Sala', 'na', 'Santa Rosa', 'Laguna', '1415', '2019-07-01 21:00:44', '2019-07-01 21:00:44', NULL),
	(27, 2, 1, 2, '3', 'Bryann Revina', 'Bryann', 'Revina', 'bryann@testing.com', '9206968454', '9206968454', '9206968454', 'Import Customer Data', NULL, NULL, '254 Gen. Malvar St., Barangay Sala', 'Celina Plains Subdibision, Santa Rosa, Laguna', 'Binan', 'Laguna', '2363', '2019-07-01 21:00:45', '2019-10-14 14:10:47', NULL),
	(28, 2, 1, 1, '1', 'Bryan Bio', 'Bryan', 'Bio', 'bryann@bio.com', '9204568574', '9204568574', '9204568574', 'Import Customer Data', NULL, NULL, '254 Gen. Malvar St., Barangay Sala', 'na', 'Santa Rosa', 'Laguna', '9656', '2019-07-01 21:00:45', '2019-07-01 21:00:45', NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_advances
DROP TABLE IF EXISTS `contact_advances`;
CREATE TABLE IF NOT EXISTS `contact_advances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `lender_id` int(11) NOT NULL DEFAULT '0',
  `sales_user_id` int(11) NOT NULL DEFAULT '0',
  `under_writer_user_id` int(11) NOT NULL DEFAULT '0',
  `closer_user_id` int(11) NOT NULL DEFAULT '0',
  `loan_id` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_date` date DEFAULT NULL,
  `contract_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advance_date` date DEFAULT NULL,
  `amount` double(11,2) NOT NULL,
  `payback` double(11,2) NOT NULL,
  `balance` double(11,2) NOT NULL,
  `factor_rate` double(11,2) NOT NULL,
  `remit` double(11,2) NOT NULL,
  `period` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment` double(11,2) NOT NULL,
  `advance_type` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_advances: ~5 rows (approximately)
DELETE FROM `contact_advances`;
/*!40000 ALTER TABLE `contact_advances` DISABLE KEYS */;
INSERT INTO `contact_advances` (`id`, `contact_id`, `company_id`, `lender_id`, `sales_user_id`, `under_writer_user_id`, `closer_user_id`, `loan_id`, `contract_date`, `contract_number`, `advance_date`, `amount`, `payback`, `balance`, `factor_rate`, `remit`, `period`, `period_type`, `payment`, `advance_type`, `payment_method`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 27, 0, 1, 1, 0, 1, '230919/7242', NULL, '230919/3278', NULL, 8693.00, 156474.00, 0.00, 18.00, 15.00, '5', 'days', 31294.80, 'add-on', 'ach', 'Started', '2019-09-23 17:17:28', '2019-10-22 07:37:06', NULL),
	(2, 27, 0, 2, 0, 0, 0, '240919/8415', NULL, '240919/6015', NULL, 8000.00, 2800.00, 0.00, 35.00, 25.00, '10', 'month', 280.00, 'new', 'ach', 'Started', '2019-09-24 16:15:02', '2019-09-26 07:54:13', NULL),
	(3, 28, 0, 1, 0, 0, 0, '260919/6135', NULL, '260919/9772', NULL, 85000.00, 15300.00, 0.00, 18.00, 15.00, '12', 'month', 1275.00, 'renewal', 'cc', 'Started', '2019-09-26 07:55:20', '2019-09-26 07:55:20', NULL),
	(4, 27, 0, 2, 0, 0, 0, '021019/7761', NULL, '021019/3934', NULL, 100000.00, 135000.00, 0.00, 1.35, 1.32, '24', 'days', 5625.00, 'new', 'ach', 'Started', '2010-08-02 07:26:06', '2019-10-02 07:26:57', NULL),
	(5, 27, 0, 1, 0, 0, 0, '021019/7829', NULL, '021019/4606', NULL, 200000.00, 264000.00, 0.00, 1.32, 1.35, '24', 'days', 11000.00, 'new', 'ach', 'Started', '2019-10-02 07:27:38', '2019-10-02 07:27:38', NULL),
	(6, 27, 0, 0, 1, 1, 0, '231019/7901', NULL, '231019/7919', NULL, 55000.00, 71500.00, 65000.00, 1.30, 5.00, '12', 'month', 5958.33, 'new', 'cc', 'Started', '2019-10-23 11:43:47', '2019-10-25 10:57:58', NULL);
/*!40000 ALTER TABLE `contact_advances` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_advance_financial_bank_statement_records
DROP TABLE IF EXISTS `contact_advance_financial_bank_statement_records`;
CREATE TABLE IF NOT EXISTS `contact_advance_financial_bank_statement_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` int(11) DEFAULT '0',
  `year` year(4) DEFAULT '2000',
  `total_deposits` double(11,2) DEFAULT '0.00',
  `averate_daily` double(11,2) DEFAULT '0.00',
  `withdrawal` double(11,2) DEFAULT '0.00',
  `ending_balance` double(11,2) DEFAULT '0.00',
  `deposits` int(11) DEFAULT NULL,
  `days_neg` int(11) DEFAULT NULL,
  `nsf` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_advance_financial_bank_statement_records: ~0 rows (approximately)
DELETE FROM `contact_advance_financial_bank_statement_records`;
/*!40000 ALTER TABLE `contact_advance_financial_bank_statement_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_advance_financial_bank_statement_records` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_advance_funding_info
DROP TABLE IF EXISTS `contact_advance_funding_info`;
CREATE TABLE IF NOT EXISTS `contact_advance_funding_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `contract_date` date DEFAULT NULL,
  `contract_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funding_date` date DEFAULT NULL,
  `wire_conf_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_account` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ach_gateway` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_advance_funding_info: ~0 rows (approximately)
DELETE FROM `contact_advance_funding_info`;
/*!40000 ALTER TABLE `contact_advance_funding_info` DISABLE KEYS */;
INSERT INTO `contact_advance_funding_info` (`id`, `contact_advance_id`, `contract_date`, `contract_number`, `funding_date`, `wire_conf_number`, `routing_number`, `account_number`, `account_type`, `name_of_account`, `ach_gateway`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-17 14:41:22', '2019-10-22 06:46:16', NULL),
	(2, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 06:21:27', '2019-10-24 06:51:20', NULL);
/*!40000 ALTER TABLE `contact_advance_funding_info` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_advance_merchant_statement_records
DROP TABLE IF EXISTS `contact_advance_merchant_statement_records`;
CREATE TABLE IF NOT EXISTS `contact_advance_merchant_statement_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` int(11) DEFAULT '0',
  `year` year(4) DEFAULT '2000',
  `total_volume` double(11,2) DEFAULT '0.00',
  `visa_ms_disc` double(11,2) DEFAULT '0.00',
  `amex` double(11,2) DEFAULT '0.00',
  `charge_back_volume` double(11,2) DEFAULT '0.00',
  `transaction` int(11) DEFAULT NULL,
  `batches` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_advance_merchant_statement_records: ~0 rows (approximately)
DELETE FROM `contact_advance_merchant_statement_records`;
/*!40000 ALTER TABLE `contact_advance_merchant_statement_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_advance_merchant_statement_records` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_advance_payments
DROP TABLE IF EXISTS `contact_advance_payments`;
CREATE TABLE IF NOT EXISTS `contact_advance_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `transaction_id` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(11,2) NOT NULL,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payee` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payee_id` int(11) NOT NULL DEFAULT '0',
  `memo` mediumtext COLLATE utf8mb4_unicode_ci,
  `processed` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `process_date` date DEFAULT NULL,
  `cleared_date` date DEFAULT NULL,
  `status` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_advance_payments: ~2 rows (approximately)
DELETE FROM `contact_advance_payments`;
/*!40000 ALTER TABLE `contact_advance_payments` DISABLE KEYS */;
INSERT INTO `contact_advance_payments` (`id`, `contact_advance_id`, `transaction_id`, `amount`, `type`, `payee`, `payee_id`, `memo`, `processed`, `process_date`, `cleared_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'TRAN-001', 600.00, 'cc', NULL, 1, 'Test only update', 'Bryann Revina', '2019-10-19', NULL, 'pending', '2019-10-19 15:55:29', '2019-10-21 15:26:38', NULL),
	(2, 1, 'TRAN-002', 360.00, 'cc', NULL, 1, 'test', 'Bryann Revina', '2019-10-19', NULL, 'paid', '2019-10-19 15:55:55', '2019-10-19 15:55:55', NULL),
	(3, 1, 'TRAN-003', 300.00, 'ach', NULL, 1, 'This is only a test..', 'Bryann Revina', '2019-10-21', NULL, 'paid', '2019-10-21 07:45:37', '2019-10-21 07:45:37', NULL),
	(4, 6, 'TRAN-011', 1000.00, 'ach', NULL, 1, 'This is test only', 'Bryann Revina', '2019-10-23', NULL, 'paid', '2019-10-23 12:30:11', '2019-10-23 12:34:06', NULL);
/*!40000 ALTER TABLE `contact_advance_payments` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_advance_submissions
DROP TABLE IF EXISTS `contact_advance_submissions`;
CREATE TABLE IF NOT EXISTS `contact_advance_submissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `email_template_id` int(11) NOT NULL DEFAULT '0',
  `recipient` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_advance_submissions: ~15 rows (approximately)
DELETE FROM `contact_advance_submissions`;
/*!40000 ALTER TABLE `contact_advance_submissions` DISABLE KEYS */;
INSERT INTO `contact_advance_submissions` (`id`, `contact_advance_id`, `email_template_id`, `recipient`, `sender`, `subject`, `content`, `documents`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 6, 1, 'bryann@revina.com', 'test@test.com', 'Test Only', 'This is the documents', 'serialize ekek', 'submitted', '2019-10-30 14:06:46', '2019-10-30 14:06:48', NULL),
	(2, 6, 2, 'juke@gmail.com', 'jeniel@mangahis.com', 'Submit Documents', 'This is only a test', 'test,test,testse', 'submitted', '2019-10-30 14:29:40', '2019-10-30 14:29:41', NULL),
	(3, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Test Only', '<p>this is only a test</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-30 19:01:34', '2019-10-30 19:01:34', NULL),
	(4, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Lendee Requirements', '<p>This is only a testing pace</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-31 05:10:07', '2019-10-31 05:10:07', NULL),
	(5, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Test ONly', '<p>This is a test only</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-31 06:34:15', '2019-10-31 06:34:15', NULL),
	(6, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Test ONly', '<p>This is a test only</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-31 06:34:52', '2019-10-31 06:34:52', NULL),
	(7, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Test ONly', '<p>This is a test only</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-31 06:35:06', '2019-10-31 06:35:06', NULL),
	(8, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Sample Documents', '<p>This is only a testing</p>', 'a:1:{i:0;s:1:"5";}', 'submitted', '2019-10-31 06:37:48', '2019-10-31 06:37:48', NULL),
	(9, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Test Subject', '<p>dff</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-31 06:40:02', '2019-10-31 06:40:02', NULL),
	(10, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Test Subject', '<p>This is only a test...</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-31 06:41:58', '2019-10-31 06:41:58', NULL),
	(11, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Test Subject', '<p>dfdf</p>', 'a:1:{i:0;s:1:"5";}', 'submitted', '2019-10-31 06:47:49', '2019-10-31 06:47:49', NULL),
	(12, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Sample Docs', '<p>dfdf</p>', 'a:1:{i:0;s:1:"6";}', 'submitted', '2019-10-31 06:49:00', '2019-10-31 06:49:00', NULL),
	(13, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Sample Docs', '<p>dfdf</p>', 'a:1:{i:0;s:1:"6";}', 'submitted', '2019-10-31 06:49:56', '2019-10-31 06:49:56', NULL),
	(14, 6, 0, 'a:1:{i:0;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Again Test', '<p>Sample docs to be attached</p>', 'a:1:{i:0;s:1:"6";}', 'submitted', '2019-10-31 06:50:33', '2019-10-31 06:50:33', NULL),
	(15, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Lenders Docs', '<p>PLease see attached file</p>', 'a:1:{i:0;s:1:"5";}', 'submitted', '2019-10-31 06:55:21', '2019-10-31 06:55:21', NULL),
	(16, 6, 0, 'a:2:{i:0;s:17:"bryann@google.com";i:1;s:19:"bdr030385@gmail.com";}', 'bryann.revina@gmail.com', 'Sample Docs from Lender', '<p>This is test only</p>', 'a:2:{i:0;s:1:"5";i:1;s:1:"6";}', 'submitted', '2019-10-31 07:07:05', '2019-10-31 07:07:05', NULL);
/*!40000 ALTER TABLE `contact_advance_submissions` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_advance_underwriter_notes
DROP TABLE IF EXISTS `contact_advance_underwriter_notes`;
CREATE TABLE IF NOT EXISTS `contact_advance_underwriter_notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `under_writer_opinion` mediumtext COLLATE utf8mb4_unicode_ci,
  `tax_liens_judgements` mediumtext COLLATE utf8mb4_unicode_ci,
  `ucc_position` mediumtext COLLATE utf8mb4_unicode_ci,
  `advance_history_comments` mediumtext COLLATE utf8mb4_unicode_ci,
  `major_issues` mediumtext COLLATE utf8mb4_unicode_ci,
  `required_paperworks_information` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_advance_underwriter_notes: ~0 rows (approximately)
DELETE FROM `contact_advance_underwriter_notes`;
/*!40000 ALTER TABLE `contact_advance_underwriter_notes` DISABLE KEYS */;
INSERT INTO `contact_advance_underwriter_notes` (`id`, `contact_advance_id`, `under_writer_opinion`, `tax_liens_judgements`, `ucc_position`, `advance_history_comments`, `major_issues`, `required_paperworks_information`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 1, 'This is only a test..', 'test', 'xxxxxx', 'xx', 'No issue', 'One upon a time', '2019-10-15 13:03:42', '2019-10-15 13:04:02', NULL);
/*!40000 ALTER TABLE `contact_advance_underwriter_notes` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_bank_accounts
DROP TABLE IF EXISTS `contact_bank_accounts`;
CREATE TABLE IF NOT EXISTS `contact_bank_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `check_paying_client` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_on_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_bank_accounts: ~0 rows (approximately)
DELETE FROM `contact_bank_accounts`;
/*!40000 ALTER TABLE `contact_bank_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_bank_accounts` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_broker_informations: ~9 rows (approximately)
DELETE FROM `contact_broker_informations`;
/*!40000 ALTER TABLE `contact_broker_informations` DISABLE KEYS */;
INSERT INTO `contact_broker_informations` (`id`, `contact_id`, `company_id`, `user_id`, `brokerage_fee`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 3, 11, 0.00, '2019-06-13 06:09:00', '2019-06-13 08:55:13', NULL),
	(2, 11, 3, 10, 9999.00, '2019-06-13 06:12:10', '2019-06-13 08:27:40', NULL),
	(3, 12, 3, 11, 9999.00, '2019-06-13 08:16:20', '2019-06-13 08:19:11', NULL),
	(5, 20, 3, 10, 0.00, '2019-06-13 08:54:27', '2019-06-13 08:54:27', NULL),
	(6, 21, 3, 10, 0.00, '2019-06-13 08:56:44', '2019-06-13 08:56:44', NULL),
	(7, 22, 3, 11, 0.00, '2019-06-21 06:31:17', '2019-06-21 06:31:17', NULL),
	(8, 26, 2, 1, 0.00, '2019-07-01 21:00:45', '2019-07-01 21:00:45', NULL),
	(9, 27, 2, 1, 600.00, '2019-07-01 21:00:45', '2019-10-14 14:10:47', NULL),
	(10, 28, 2, 1, 0.00, '2019-07-01 21:00:45', '2019-07-01 21:00:45', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_business_informations: ~9 rows (approximately)
DELETE FROM `contact_business_informations`;
/*!40000 ALTER TABLE `contact_business_informations` DISABLE KEYS */;
INSERT INTO `contact_business_informations` (`id`, `contact_id`, `company_id`, `user_id`, `business_name`, `years_in_business`, `legal_entity_of_business`, `accept_credit_card_from_customer`, `gross_monthly_credit_card_sales`, `gross_yearly_sales`, `filed_bankruptcy`, `bankruptcy_filed`, `credit_score`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 3, 11, 'Business name..', 1.00, 'Sole Proprietorship', 'Yes', 454.00, 454.00, 'No', '1970-01-01', 'har', '2019-06-13 06:09:00', '2019-06-25 08:14:22', NULL),
	(2, 11, 3, 10, 'Tambay Update', 30.00, 'Partnership', 'Yes', 334334.00, 343434.23, 'Yes', '2019-06-30', 'Credit store update', '2019-06-13 06:12:09', '2019-06-13 08:28:20', NULL),
	(3, 12, 3, 11, 'Test Busines', 2.00, 'Limited Liability Company-LLC', 'Yes', 4545.00, 45454.00, 'Yes', '2019-06-21', 'fgfg', '2019-06-13 08:16:20', '2019-06-13 08:19:11', NULL),
	(5, 20, 3, 10, NULL, 1.00, 'Sole Proprietorship', 'Yes', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-06-13 08:54:27', '2019-06-21 06:42:50', NULL),
	(6, 21, 3, 10, NULL, 1.00, 'Sole Proprietorship', 'NA', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-06-13 08:56:44', '2019-06-13 09:01:37', NULL),
	(7, 22, 3, 11, NULL, 1.00, 'Sole Proprietorship', 'Yes', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-06-21 06:31:17', '2019-06-21 06:40:50', NULL),
	(8, 26, 2, 1, '', 0.00, '', 'NA', 0.00, 0.00, '', NULL, 'NA', '2019-07-01 21:00:44', '2019-07-01 21:00:44', NULL),
	(9, 27, 2, 1, 'Core CMS Laravel Application', 1.00, 'Sole Proprietorship', 'NA', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-07-01 21:00:45', '2019-10-14 14:13:00', NULL),
	(10, 28, 2, 1, '', 0.00, '', 'NA', 0.00, 0.00, '', NULL, 'NA', '2019-07-01 21:00:45', '2019-07-01 21:00:45', NULL);
/*!40000 ALTER TABLE `contact_business_informations` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_call_trackers
DROP TABLE IF EXISTS `contact_call_trackers`;
CREATE TABLE IF NOT EXISTS `contact_call_trackers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `call_type` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_result` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_minutes` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_seconds` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` mediumtext COLLATE utf8mb4_unicode_ci,
  `event_type_id` int(11) NOT NULL,
  `call_update_status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_call_trackers: ~9 rows (approximately)
DELETE FROM `contact_call_trackers`;
/*!40000 ALTER TABLE `contact_call_trackers` DISABLE KEYS */;
INSERT INTO `contact_call_trackers` (`id`, `user_id`, `contact_id`, `call_type`, `call_result`, `call_minutes`, `call_seconds`, `notes`, `event_type_id`, `call_update_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 10, 'incoming', 'Connected', '2', '53', 'This is only a test', 1, 'Opened', '2019-08-01 09:04:06', '2019-08-01 09:04:06', NULL),
	(2, 1, 10, 'incoming', 'Left Message', '20', '20', 'dfd', 1, 'Opened', '2019-08-01 09:19:40', '2019-08-01 09:19:40', NULL),
	(3, 1, 10, 'incoming', 'No Answer', '10', '10', 'test', 1, 'Opened', '2019-08-05 05:36:45', '2019-08-05 05:36:45', NULL),
	(4, 1, 28, 'outgoing', 'Wrong Number', '5', '5', 'Test', 1, 'Opened', '2019-08-05 06:35:56', '2019-08-05 06:35:56', NULL),
	(5, 1, 22, 'outgoing', 'Already in Program', '2', '2', 'test only', 1, 'Opened', '2019-08-05 06:41:29', '2019-08-05 06:41:29', NULL),
	(6, 1, 27, 'Outgoing', 'Already in Program', '3', '3', 'followup to jeniel please xx xx', 2, 'Opened', '2019-08-05 06:46:30', '2019-09-09 10:11:27', NULL),
	(7, 1, 27, 'Incoming', 'No Answer', '1', '15', 'test again XXX', 2, 'Dispatched', '2019-08-07 05:36:47', '2019-08-07 06:29:09', NULL),
	(8, 1, 27, 'Outgoing', 'No Answer', '1', '50', 'This is only a test', 4, 'Opened', '2019-09-10 02:19:13', '2019-09-10 02:19:13', NULL),
	(9, 10, 21, 'Outgoing', 'No Answer', '5', '50', 'Followup payments', 4, 'Opened', '2019-09-10 02:19:58', '2019-09-10 02:21:01', NULL);
/*!40000 ALTER TABLE `contact_call_trackers` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_campaigns
DROP TABLE IF EXISTS `contact_campaigns`;
CREATE TABLE IF NOT EXISTS `contact_campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `source_id` int(11) NOT NULL DEFAULT '0',
  `media_type_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `campaign_cost` double(11,2) NOT NULL DEFAULT '0.00',
  `purchase_amount` double(11,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_campaigns: ~3 rows (approximately)
DELETE FROM `contact_campaigns`;
/*!40000 ALTER TABLE `contact_campaigns` DISABLE KEYS */;
INSERT INTO `contact_campaigns` (`id`, `contact_id`, `company_id`, `user_id`, `source_id`, `media_type_id`, `title`, `start_date`, `end_date`, `priority`, `campaign_cost`, `purchase_amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 0, 0, 0, 2, 1, 'Facebook Add', '2019-06-21', '2019-06-21', 0, 0.00, 0.00, 1, '2019-06-21 12:49:25', '2019-06-24 07:26:04', NULL),
	(2, 0, 2, 1, 1, 2, 'Landing Page Business Loan Update', '2019-06-10', '2019-06-21', 10, 15000.00, 100200.00, 2, '2019-06-21 06:13:33', '2019-06-24 07:25:55', NULL),
	(3, 0, 2, 1, 2, 2, 'Twitter Campaign', '2019-07-01', '2019-07-06', 2, 150000.00, 200000.00, 1, '2019-06-24 07:24:46', '2019-06-24 07:24:46', NULL);
/*!40000 ALTER TABLE `contact_campaigns` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_credit_cards
DROP TABLE IF EXISTS `contact_credit_cards`;
CREATE TABLE IF NOT EXISTS `contact_credit_cards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `debit_credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_issuer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_on_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration_date_month` int(11) NOT NULL DEFAULT '0',
  `expiration_date_year` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_credit_cards: ~0 rows (approximately)
DELETE FROM `contact_credit_cards`;
/*!40000 ALTER TABLE `contact_credit_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_credit_cards` ENABLE KEYS */;

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
	(1, 2, 'test', 'this is only a test', '2019-05-17 05:25:47', '2019-05-17 05:25:47', NULL);
/*!40000 ALTER TABLE `contact_custom_fields` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_datasource
DROP TABLE IF EXISTS `contact_datasource`;
CREATE TABLE IF NOT EXISTS `contact_datasource` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `source_name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=import,2=webform',
  `stage_id` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compaign_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_datasource: ~2 rows (approximately)
DELETE FROM `contact_datasource`;
/*!40000 ALTER TABLE `contact_datasource` DISABLE KEYS */;
INSERT INTO `contact_datasource` (`id`, `company_id`, `user_id`, `source_name`, `type`, `stage_id`, `status`, `compaign_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 1, 'ABC Broker', 2, 1, 'Status 02', 1, '2019-06-19 05:50:36', '2019-06-19 07:09:43', NULL),
	(2, 2, 1, 'Import Customer Data', 1, 1, 'Status 01', 1, '2019-06-19 07:09:34', '2019-06-21 05:02:30', NULL);
/*!40000 ALTER TABLE `contact_datasource` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_docs
DROP TABLE IF EXISTS `contact_docs`;
CREATE TABLE IF NOT EXISTS `contact_docs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `filename` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_docs: ~6 rows (approximately)
DELETE FROM `contact_docs`;
/*!40000 ALTER TABLE `contact_docs` DISABLE KEYS */;
INSERT INTO `contact_docs` (`id`, `user_id`, `contact_id`, `filename`, `document_title`, `document_type`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 21, 'coreCRM-07232019.sql', 'coreCRM-07232019.sql', 3, 'Add Backup Database', '2019-09-10 02:46:10', '2019-09-10 02:47:03', NULL),
	(2, 1, 28, 'RJF-123.jpg', 'RJF-123.jpg', 1, 'Fabric Images', '2019-10-14 14:37:07', '2019-10-14 14:37:07', NULL),
	(3, 1, 27, 'RG110001.jpg', 'RG110001.jpg', 3, 'Fabrics 01', '2019-10-14 15:04:41', '2019-10-15 05:13:13', '2019-10-15 05:13:13'),
	(4, 1, 27, 'RG211131-400x337.jpg', 'RG211131-400x337.jpg', 1, 'Another', '2019-10-14 15:20:51', '2019-10-15 05:13:21', '2019-10-15 05:13:21'),
	(5, 1, 27, 'RG211131-400x337.jpg', 'RG211131-400x337.jpg', 1, 'test only', '2019-10-15 05:12:42', '2019-10-15 05:12:42', NULL),
	(6, 1, 27, 'Aswith.docx', 'Aswith.docx', 3, 'Test only', '2019-10-15 05:42:25', '2019-10-15 05:42:25', NULL);
/*!40000 ALTER TABLE `contact_docs` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_events
DROP TABLE IF EXISTS `contact_events`;
CREATE TABLE IF NOT EXISTS `contact_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'assigned this event to particular user',
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `location` mediumtext COLLATE utf8mb4_unicode_ci,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_events: ~10 rows (approximately)
DELETE FROM `contact_events`;
/*!40000 ALTER TABLE `contact_events` DISABLE KEYS */;
INSERT INTO `contact_events` (`id`, `title`, `event_date`, `event_time`, `event_type_id`, `user_id`, `contact_id`, `location`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Call Jeniel Mangahis', '2019-07-19', '02:30:00', 1, 1, 27, 'Santa Rosa Office', 'This is the descriptions', '2019-07-17 09:57:41', '2019-09-04 07:30:35', NULL),
	(2, 'Call Bryan Bio', '2019-07-20', '15:15:00', 1, 11, 0, 'Golden City, Santa Rosa', 'Not working..', '2019-07-17 10:02:19', '2019-07-18 03:31:39', NULL),
	(3, 'Call Bonn Mendoza', '2019-07-18', '07:00:00', 2, 10, 0, 'Cabuyao', 'Cabuyao, City of Santa Rosa, Laguna', '2019-07-18 03:51:37', '2019-07-18 03:53:37', NULL),
	(4, 'Followup Call - [Bryann Revina]', '2019-08-07', '01:30:00', 4, 1, 27, 'test', 'test only', '2019-08-05 09:27:20', '2019-09-04 07:28:24', NULL),
	(5, 'Followup Call - [Testing01 Demo]', '2019-08-08', '02:00:00', 4, 10, 0, NULL, 'test again', '2019-08-05 09:28:06', '2019-08-05 09:28:06', NULL),
	(6, 'Followup Call - [Bryann Revina]', '2019-08-12', '01:30:00', 4, 1, 0, NULL, 'test', '2019-08-05 09:28:50', '2019-08-05 09:28:50', NULL),
	(7, 'General Meeting', '2019-09-05', '23:30:00', 2, 1, 27, 'Laguna', 'Just a test', '2019-09-04 07:23:25', '2019-09-09 09:55:56', '2019-09-09 09:55:56'),
	(8, 'General Meeting', '2019-09-07', '23:30:00', 4, 1, 27, 'test', 'Just to followup', '2019-09-04 07:26:04', '2019-09-09 09:55:14', '2019-09-09 09:55:14'),
	(9, 'Process all requirements', '2019-09-28', '23:45:00', 1, 1, 27, 'Test update', 'test update', '2019-09-04 07:35:29', '2019-09-09 09:58:11', '2019-09-09 09:58:11'),
	(10, 'Continue working on Contact History', '2019-09-10', '02:00:00', 4, 1, 27, 'Laguna', 'This is a test only', '2019-09-09 09:57:03', '2019-09-09 09:57:03', NULL);
/*!40000 ALTER TABLE `contact_events` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_history
DROP TABLE IF EXISTS `contact_history`;
CREATE TABLE IF NOT EXISTS `contact_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_history: ~27 rows (approximately)
DELETE FROM `contact_history`;
/*!40000 ALTER TABLE `contact_history` DISABLE KEYS */;
INSERT INTO `contact_history` (`id`, `user_id`, `contact_id`, `company_id`, `title`, `description`, `module`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 0, 0, 'Add Event', NULL, 'Events', '2019-09-04 13:40:42', '2019-09-04 07:35:48', '2019-09-04 07:35:48'),
	(2, 1, 0, 0, 'Add New Note', NULL, 'Notes', '2019-09-03 13:42:24', '2019-09-04 07:35:58', '2019-09-04 07:35:58'),
	(3, 1, 27, 0, 'Add New Event', NULL, 'Events', '2019-09-04 07:23:25', '2019-09-09 09:54:14', '2019-09-09 09:54:14'),
	(4, 1, 27, 0, 'Add New Event', NULL, 'Events', '2019-09-04 07:26:04', '2019-09-04 07:26:04', NULL),
	(5, 1, 27, 0, 'Update Event', NULL, 'Events', '2019-09-04 07:28:24', '2019-09-04 07:28:24', NULL),
	(6, 1, 27, 0, 'Update Event', NULL, 'Events', '2019-09-04 07:29:15', '2019-09-04 07:29:15', NULL),
	(7, 1, 27, 0, 'Update Event', NULL, 'Events', '2019-09-04 07:30:35', '2019-09-04 07:30:35', NULL),
	(8, 1, 27, 0, 'Add New Event', NULL, 'Events', '2019-09-04 07:35:29', '2019-09-04 07:35:29', NULL),
	(9, 1, 27, 0, 'Update Event', 'Assigned to User Id: 1', 'Events', '2019-09-09 09:53:44', '2019-09-09 09:53:44', NULL),
	(10, 1, 27, 0, 'Delete Event', 'Event Id: ', 'Events', '2019-09-09 09:55:57', '2019-09-09 09:55:57', NULL),
	(11, 1, 27, 0, 'Add New Event', 'Assigned to User Id: 1', 'Events', '2019-09-09 09:57:03', '2019-09-09 09:57:03', NULL),
	(12, 1, 27, 0, 'Delete Event', 'Event Id: 9', 'Events', '2019-09-09 09:58:11', '2019-09-09 09:58:11', NULL),
	(13, 1, 27, 0, 'Update Call Log', 'Call Tracker Id: 6', 'Calls', '2019-09-09 10:11:27', '2019-09-09 10:11:27', NULL),
	(14, 1, 27, 0, 'Add New Call Log', 'Call Tracker Id: 8', 'Calls', '2019-09-10 02:19:13', '2019-09-10 02:19:13', NULL),
	(15, 10, 21, 0, 'Add New Call Log', 'Call Tracker Id: 9', 'Calls', '2019-09-10 02:19:58', '2019-09-10 02:19:58', NULL),
	(16, 10, 21, 0, 'Update Call Log', 'Call Tracker Id: 9', 'Calls', '2019-09-10 02:21:01', '2019-09-10 02:21:01', NULL),
	(17, 10, 21, 0, 'Add New Note', 'Note Title: This is only a test, Note ID: 9', 'Notes', '2019-09-10 02:33:15', '2019-09-10 02:33:15', NULL),
	(18, 1, 27, 0, 'Delete Note', 'Note ID: 3', 'Notes', '2019-09-10 02:35:58', '2019-09-10 02:35:58', NULL),
	(19, 10, 21, 0, 'Add New Document', 'Document File Name: coreCRM-07232019.sql', 'Docs', '2019-09-10 02:46:10', '2019-09-10 02:46:10', NULL),
	(20, 10, 21, 0, 'Delete Document', 'Document File Name: coreCRM-07232019.sql', 'Docs', '2019-09-10 02:47:03', '2019-09-10 02:47:03', NULL),
	(21, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-09-10 03:52:26', '2019-09-10 03:52:26', NULL),
	(22, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-09-10 05:56:37', '2019-09-10 05:56:37', NULL),
	(23, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-09-10 05:58:31', '2019-09-10 05:58:31', NULL),
	(24, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-09-10 06:01:51', '2019-09-10 06:01:51', NULL),
	(25, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-09-10 06:19:44', '2019-09-10 06:19:44', NULL),
	(26, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-09-10 06:35:24', '2019-09-10 06:35:24', NULL),
	(27, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-09-10 06:54:39', '2019-09-10 06:54:39', NULL),
	(28, 1, 28, 0, 'Add New Document', 'Document File Name: RJF-123.jpg', 'Docs', '2019-10-14 14:37:07', '2019-10-14 14:37:07', NULL),
	(29, 1, 27, 0, 'Add New Document', 'Document File Name: RG110001.jpg', 'Docs', '2019-10-14 15:04:41', '2019-10-14 15:04:41', NULL),
	(30, 1, 27, 0, 'Add New Document', 'Document File Name: RG211131-400x337.jpg', 'Docs', '2019-10-14 15:20:51', '2019-10-14 15:20:51', NULL),
	(31, 1, 27, 0, 'Add New Document', 'Document File Name: RG211131-400x337.jpg', 'Docs', '2019-10-15 05:12:42', '2019-10-15 05:12:42', NULL),
	(32, 1, 27, 0, 'Delete Document', 'Document File Name: RG110001.jpg', 'Docs', '2019-10-15 05:13:13', '2019-10-15 05:13:13', NULL),
	(33, 1, 27, 0, 'Delete Document', 'Document File Name: RG211131-400x337.jpg', 'Docs', '2019-10-15 05:13:21', '2019-10-15 05:13:21', NULL),
	(34, 1, 27, 0, 'Add New Document', 'Document File Name: Aswith.docx', 'Docs', '2019-10-15 05:42:25', '2019-10-15 05:42:25', NULL),
	(35, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-10-27 14:11:03', '2019-10-27 14:11:03', NULL),
	(36, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-10-27 14:12:21', '2019-10-27 14:12:21', NULL),
	(37, 1, 27, 0, 'Send Email', NULL, 'Emails', '2019-10-27 14:14:07', '2019-10-27 14:14:07', NULL);
/*!40000 ALTER TABLE `contact_history` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_loan_informations: ~9 rows (approximately)
DELETE FROM `contact_loan_informations`;
/*!40000 ALTER TABLE `contact_loan_informations` DISABLE KEYS */;
INSERT INTO `contact_loan_informations` (`id`, `contact_id`, `company_id`, `user_id`, `loan_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 3, 11, 1111.00, '2019-06-13 06:09:00', '2019-06-13 08:18:49', NULL),
	(2, 11, 3, 10, 9999.00, '2019-06-13 06:12:10', '2019-06-13 08:27:40', NULL),
	(3, 12, 3, 11, 9999.00, '2019-06-13 08:16:20', '2019-06-13 08:19:11', NULL),
	(5, 20, 3, 10, 0.00, '2019-06-13 08:54:27', '2019-06-13 08:54:27', NULL),
	(6, 21, 3, 10, 0.00, '2019-06-13 08:56:44', '2019-06-13 08:56:44', NULL),
	(7, 22, 3, 11, 0.00, '2019-06-21 06:31:17', '2019-06-21 06:31:17', NULL),
	(8, 26, 2, 1, 0.00, '2019-07-01 21:00:44', '2019-07-01 21:00:44', NULL),
	(9, 27, 2, 1, 1500.00, '2019-07-01 21:00:45', '2019-10-14 14:10:47', NULL),
	(10, 28, 2, 1, 0.00, '2019-07-01 21:00:45', '2019-07-01 21:00:45', NULL);
/*!40000 ALTER TABLE `contact_loan_informations` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_notes
DROP TABLE IF EXISTS `contact_notes`;
CREATE TABLE IF NOT EXISTS `contact_notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL,
  `note_type_id` int(11) NOT NULL,
  `note_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify_user_id` int(11) NOT NULL,
  `cc_emails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_notes: ~8 rows (approximately)
DELETE FROM `contact_notes`;
/*!40000 ALTER TABLE `contact_notes` DISABLE KEYS */;
INSERT INTO `contact_notes` (`id`, `user_id`, `contact_id`, `note_type_id`, `note_title`, `note_content`, `notify_user_id`, `cc_emails`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 0, 27, 2, 'test number 2', 'again test test', 2, 'bdr030385@gmail.com', '2019-08-13 14:58:27', '2019-09-03 10:05:09', '2019-09-03 10:05:09'),
	(3, 0, 27, 2, 'test', '<p>sdsddfdf again a test</p>', 1, 'bryann.revina@gmail.com', '2019-08-13 22:40:33', '2019-09-10 02:35:57', '2019-09-10 02:35:57'),
	(4, 0, 27, 2, 'test', '<p>sdsddfdf again a test testng again</p>', 1, 'bryann.revina@gmail.com', '2019-08-13 22:40:33', '2019-08-13 22:40:33', NULL),
	(5, 0, 27, 4, 'Followup', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, 'bryann.revina@gmail.com', '2019-08-13 23:16:15', '2019-08-13 23:16:15', NULL),
	(6, 0, 11, 3, 'Test', '<p>Test only</p>', 11, NULL, '2019-08-18 23:44:39', '2019-08-18 23:44:39', NULL),
	(7, 0, 12, 4, 'Lorem Ipsum', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 11, NULL, '2019-08-18 23:54:55', '2019-08-18 23:54:55', NULL),
	(8, 0, 12, 3, 'Lorem Ipsum', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 10, 'a:2:{i:0;s:23:"bryann.revina@gmail.com";i:1;s:25:"jeniel.mangahis@gmail.com";}', '2019-08-19 02:35:48', '2019-08-19 02:35:48', NULL),
	(9, 0, 21, 1, 'This is only a test', '<p>How are you?</p>', 10, 'a:1:{i:0;s:23:"bryann.revina@gmail.com";}', '2019-09-10 02:33:09', '2019-09-10 02:33:09', NULL);
/*!40000 ALTER TABLE `contact_notes` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_tasks
DROP TABLE IF EXISTS `contact_tasks`;
CREATE TABLE IF NOT EXISTS `contact_tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `assigned_user_id` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '0',
  `assigned_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `due_date` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_tasks: ~8 rows (approximately)
DELETE FROM `contact_tasks`;
/*!40000 ALTER TABLE `contact_tasks` DISABLE KEYS */;
INSERT INTO `contact_tasks` (`id`, `user_id`, `assigned_user_id`, `contact_id`, `status_id`, `assigned_user`, `title`, `notes`, `due_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 27, 0, 's:1:"1";', 'Test01', '<p>This is only a test</p>', '2019-08-20', 'pending', '2019-08-20 13:16:19', '2019-08-23 04:34:13', NULL),
	(2, 1, 10, 11, 0, 's:2:"10";', 'Get 25% Downpayment', '<p>Get 25% Downpayment Get 25% Downpayment Get 25% Downpayment</p>', '2019-08-30', 'completed', '2019-08-20 07:26:53', '2019-08-20 09:32:20', NULL),
	(3, 1, 11, 11, 0, 's:2:"11";', 'Get 60% Down Payment', '<p>Please get 60% downpayment that we already discuss</p>', '2019-09-11', 'pending', '2019-08-20 08:00:56', '2019-08-20 09:53:39', NULL),
	(4, 1, 1, 27, 0, 's:1:"1";', 'Client Meeting in Binan', '<p>Please go to manila for our new client</p>', '2019-08-23', 'pending', '2019-08-22 06:47:53', '2019-08-22 06:49:38', NULL),
	(5, 1, 1, 27, 0, 's:1:"1";', 'Client Meeting in Manila', '<p>Please go to manila for our new client</p>', '2019-08-23', 'pending', '2019-08-22 06:49:00', '2019-08-26 07:04:50', NULL),
	(6, 1, 11, 10, 0, 's:2:"11";', 'Meeting with Juke', '<p>Go to makati for the meeting</p>', '2019-09-01', 'pending', '2019-08-22 09:16:38', '2019-08-22 09:17:40', NULL),
	(7, 10, 10, 21, 0, 's:2:"10";', 'Meeting with the CEO', '<p>Meeting with the ceo in us</p>', '2019-09-06', 'pending', '2019-08-22 21:58:55', '2019-08-22 21:58:55', NULL),
	(8, 1, 11, 21, 0, 's:2:"11";', 'Meeting with Juke', '<p>This is weekly meeting in manila</p>', '2019-09-03', 'pending', '2019-08-22 22:00:06', '2019-08-22 22:00:06', NULL);
/*!40000 ALTER TABLE `contact_tasks` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.contact_users
DROP TABLE IF EXISTS `contact_users`;
CREATE TABLE IF NOT EXISTS `contact_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.contact_users: ~0 rows (approximately)
DELETE FROM `contact_users`;
/*!40000 ALTER TABLE `contact_users` DISABLE KEYS */;
INSERT INTO `contact_users` (`id`, `contact_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 27, 1, '2019-10-15 13:02:26', NULL, NULL);
/*!40000 ALTER TABLE `contact_users` ENABLE KEYS */;

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
	(1, 2, 33, 'test name', 'this is only a test', '2019-05-17 05:29:18', '2019-05-17 05:29:18', NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.event_types
DROP TABLE IF EXISTS `event_types`;
CREATE TABLE IF NOT EXISTS `event_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.event_types: ~4 rows (approximately)
DELETE FROM `event_types`;
/*!40000 ALTER TABLE `event_types` DISABLE KEYS */;
INSERT INTO `event_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Phone Call', '2019-07-15 05:47:46', '2019-07-15 05:47:46', NULL),
	(2, 'Sales Calls', '2019-07-15 05:48:01', '2019-07-15 05:54:48', NULL),
	(3, 'Test', '2019-07-15 05:55:03', '2019-07-15 05:56:09', '2019-07-15 05:56:09'),
	(4, 'Followup Call', '2019-08-05 07:28:13', '2019-08-05 07:28:13', NULL);
/*!40000 ALTER TABLE `event_types` ENABLE KEYS */;

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
	(1, 'Super Admin', '2019-05-17 05:31:13', '2019-05-29 09:02:01', NULL),
	(2, 'Company User', '2019-05-29 07:25:12', '2019-05-29 07:25:12', NULL),
	(3, 'Customer', '2019-05-29 09:02:11', '2019-05-29 09:02:11', NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.lenders
DROP TABLE IF EXISTS `lenders`;
CREATE TABLE IF NOT EXISTS `lenders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_site` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.lenders: ~2 rows (approximately)
DELETE FROM `lenders`;
/*!40000 ALTER TABLE `lenders` DISABLE KEYS */;
INSERT INTO `lenders` (`id`, `company_name`, `street`, `suburb`, `city`, `state`, `zip_code`, `country`, `phone`, `email`, `url_site`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'coreCRM', '254 Gen., Malvar St., Don Pablo Subd., San Vicente', NULL, 'Santa Rosa', 'Laguna', '2024', NULL, '5456454', 'bryann@google.com', 'http://www.googlexx.com', 'This is only a test xxxx update', '2019-09-19 15:53:04', '2019-09-22 10:56:18', NULL),
	(2, 'BONN-maker', 'Celina Plains Subd., Phase 4, Block 1, Lot 6', NULL, 'Santa Rosa', 'Laguna', '2024', NULL, '3434', 'bdr030385@gmail.com', 'http://www.google.com', 'This is only a test', '2019-09-19 15:57:11', '2019-09-19 16:00:29', NULL);
/*!40000 ALTER TABLE `lenders` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.lender_contacts
DROP TABLE IF EXISTS `lender_contacts`;
CREATE TABLE IF NOT EXISTS `lender_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lender_contacts_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.lender_contacts: ~2 rows (approximately)
DELETE FROM `lender_contacts`;
/*!40000 ALTER TABLE `lender_contacts` DISABLE KEYS */;
INSERT INTO `lender_contacts` (`id`, `name`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Elaiza Mangahis', 'elaiza.mangahis@gmail.com', '2019-09-22 15:47:21', '2019-09-22 15:52:10', NULL),
	(2, 'Brian Bio', 'brian.yobe@gmail.com', '2019-09-22 15:53:02', '2019-09-22 15:53:02', NULL);
/*!40000 ALTER TABLE `lender_contacts` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.mail_messaging
DROP TABLE IF EXISTS `mail_messaging`;
CREATE TABLE IF NOT EXISTS `mail_messaging` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `date_last_opened` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.mail_messaging: ~4 rows (approximately)
DELETE FROM `mail_messaging`;
/*!40000 ALTER TABLE `mail_messaging` DISABLE KEYS */;
INSERT INTO `mail_messaging` (`id`, `user_id`, `contact_id`, `recipient`, `sender`, `subject`, `cc`, `bcc`, `content`, `status`, `date`, `date_last_opened`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(12, 1, 27, 'marfore@test.com', 'NA', 'Climb Meeting', 'juanbinigno@gmail.com,marfore@test.com', '', '<p>Climb meeting this coming sunday. Please be no late at juan carlos house</p>', 1, '2019-09-10 06:35:21', '2019-09-10 06:35:48', '2019-09-10 06:35:21', '2019-09-10 06:35:48', NULL),
	(13, 1, 27, 'BBB@test.com', 'NA', 'Followup Meeting with the Group', '', '', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '2019-09-10 06:54:37', '2019-09-10 06:54:37', '2019-09-10 06:54:37', '2019-09-10 06:54:37', NULL),
	(14, 1, 27, 'bryann@testing.com', 'NA', 'Test only', 'marfore@test.com', 'bryann@bio.com', '<p>This is only a test</p>', 1, '2019-10-27 14:11:03', '2019-10-27 14:11:03', '2019-10-27 14:11:03', '2019-10-27 14:11:03', NULL),
	(15, 1, 27, 'BBB@test.com', 'NA', 'Test only', 'marfore@test.com', 'bryann@bio.com', '<p>This is only a test.</p>', 1, '2019-10-27 14:12:21', '2019-10-27 14:12:21', '2019-10-27 14:12:21', '2019-10-27 14:12:21', NULL),
	(16, 1, 27, 'testing1223@gmail.com', 'bryann.revina@gmail.com', 'Test Only.', 'juanbinigno@gmail.com', 'carlos.magasi@gmail.com', '<p>This is a test only.</p>', 1, '2019-10-27 14:14:07', '2019-10-27 14:14:07', '2019-10-27 14:14:07', '2019-10-27 14:14:07', NULL);
/*!40000 ALTER TABLE `mail_messaging` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.media_types
DROP TABLE IF EXISTS `media_types`;
CREATE TABLE IF NOT EXISTS `media_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.media_types: ~2 rows (approximately)
DELETE FROM `media_types`;
/*!40000 ALTER TABLE `media_types` DISABLE KEYS */;
INSERT INTO `media_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Facebook', '2019-06-21 06:03:27', '2019-06-21 06:03:27', NULL),
	(2, 'Twitter', '2019-06-21 06:03:33', '2019-06-21 06:03:33', NULL);
/*!40000 ALTER TABLE `media_types` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.migrations: ~36 rows (approximately)
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
	(16, '2019_06_05_131644_create_contact_broker_informations_table', 9),
	(17, '2019_06_17_125737_add_profile_img_to_users_table', 10),
	(18, '2019_06_19_101713_create_contact_datasource_table', 11),
	(19, '2019_06_21_110546_create_contact_campaigns_table', 12),
	(20, '2019_06_21_112122_create_media_types_table', 13),
	(21, '2019_06_24_072125_create_sources_table', 14),
	(22, '2019_07_01_082501_create_mail_messaging_table', 15),
	(23, '2019_07_15_122958_create_event_types_table', 16),
	(24, '2019_07_15_123314_create_contact_events_table', 16),
	(25, '2019_07_23_071521_create_contact_bank_accounts', 17),
	(26, '2019_07_31_164757_create_contact_call_trackers_table', 18),
	(27, '2019_08_06_143907_add_contact_id_to_contact_events_table', 19),
	(28, '2019_08_12_141221_add_check_paying_client_to_contact_bank_accounts_table', 20),
	(29, '2019_08_13_124711_create_contact_notes_table', 21),
	(30, '2019_08_13_160656_create_contact_credit_cards_table', 22),
	(31, '2019_08_14_082510_create_note_types_table', 23),
	(32, '2019_08_20_085417_create_contact_tasks_table', 24),
	(33, '2019_08_19_122253_create_states_table', 25),
	(34, '2019_08_20_133225_create_contact_docs_table', 25),
	(35, '2019_08_22_153452_add_assigned_user_id_to_contact_tasks_table', 26),
	(36, '2019_09_03_173715_create_contact_history_table', 27),
	(37, '2019_09_19_121430_create_lenders_table', 28),
	(38, '2019_09_19_132108_create_lender_contacts_table', 29),
	(39, '2019_09_23_142245_create_contact_advances_table', 30),
	(40, '2019_09_23_160350_add_fields_to_contact_advances_table', 31),
	(41, '2019_09_24_142643_add_period_type_to_contact_advances_table', 32),
	(42, '2019_09_24_074809_contact_users_table', 33),
	(43, '2019_09_25_101359_add_last_login_to_users_table', 33),
	(44, '2019_09_25_115635_add_reset_code_to_users_table', 33),
	(45, '2019_10_01_071526_add_lender_id_to_contact_advances_table', 34),
	(46, '2019_10_14_131712_add_another_fields_to_contact_advances_table', 35),
	(47, '2019_10_15_122611_create_contact_advance_underwriter_notes_table', 36),
	(49, '2019_10_15_123453_add_field_to_contact_advance_underwriter_notes_table', 37),
	(50, '2019_10_17_115834_create_contact_advance_funding_info_table', 38),
	(51, '2019_10_19_133033_create_contact_advance_payments_table', 39),
	(52, '2019_10_24_082931_create_contact_advance_financial_bank_statement_records_table', 40),
	(53, '2019_10_24_083041_create_contact_advance_merchant_statement_records_table', 40),
	(54, '2019_10_28_124748_create_contact_advance_submissions_table', 41);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.note_types
DROP TABLE IF EXISTS `note_types`;
CREATE TABLE IF NOT EXISTS `note_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.note_types: ~4 rows (approximately)
DELETE FROM `note_types`;
/*!40000 ALTER TABLE `note_types` DISABLE KEYS */;
INSERT INTO `note_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'General', '2019-08-14 00:46:06', '2019-08-14 00:46:06', NULL),
	(2, 'Call', '2019-08-14 00:47:07', '2019-08-14 00:47:07', NULL),
	(3, 'Creditor', '2019-08-14 00:47:14', '2019-08-14 00:47:14', NULL),
	(4, 'Settlement', '2019-08-14 00:48:13', '2019-08-14 00:48:39', NULL);
/*!40000 ALTER TABLE `note_types` ENABLE KEYS */;

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

-- Dumping structure for table corecmsdb.sources
DROP TABLE IF EXISTS `sources`;
CREATE TABLE IF NOT EXISTS `sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.sources: ~2 rows (approximately)
DELETE FROM `sources`;
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;
INSERT INTO `sources` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Source 01', '2019-06-24 07:20:20', '2019-06-24 07:20:20', NULL),
	(2, 'Source 2', '2019-06-24 07:20:27', '2019-06-24 07:20:27', NULL);
/*!40000 ALTER TABLE `sources` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.stages
DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.stages: ~2 rows (approximately)
DELETE FROM `stages`;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Leads', '2019-06-09 00:29:17', '2019-06-09 00:29:17', NULL),
	(2, 'New', '2019-06-19 06:50:30', '2019-06-19 06:50:30', NULL);
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;

-- Dumping structure for table corecmsdb.states
DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.states: ~0 rows (approximately)
DELETE FROM `states`;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
/*!40000 ALTER TABLE `states` ENABLE KEYS */;

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
  `profile_img` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` smallint(6) NOT NULL COMMENT '0=active,1=suspended',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `reset_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.users: ~8 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `group_id`, `nickname`, `firstname`, `lastname`, `mobile_number`, `work_number`, `home_number`, `username`, `email`, `email_verified_at`, `password`, `status`, `profile_img`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `last_login`, `reset_code`) VALUES
	(1, 1, 'B1', 'Bryann', 'Revina', '09279983995', NULL, NULL, 'bryann03', 'bryann.revina@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, '0723844514a8e149966354f21b337c34.jpg', 0, NULL, '2019-05-11 06:03:15', '2019-11-05 07:12:33', NULL, '2019-11-05 07:12:33', NULL),
	(3, 3, 'User 01', 'User', '01', '5119685', '9876565', '855965', 'user01', 'user01@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, NULL, 0, NULL, '2019-05-11 06:03:15', '2019-05-29 09:08:40', NULL, NULL, NULL),
	(4, 0, 'User 02', 'User', '02', NULL, NULL, NULL, 'user02', 'user02@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, NULL, 0, NULL, '2019-05-11 06:03:15', '2019-05-11 06:03:15', NULL, NULL, NULL),
	(5, 0, 'User 03', 'User', '03', NULL, NULL, NULL, 'user03', 'user03@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, NULL, 0, NULL, '2019-05-11 06:03:15', '2019-05-11 06:03:15', NULL, NULL, NULL),
	(6, 0, 'User 04', 'User', '04', NULL, NULL, NULL, 'user04', 'test04@test.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, NULL, 0, NULL, '2019-05-16 04:05:06', '2019-05-16 04:05:12', NULL, NULL, NULL),
	(9, 0, 'Aleng Ilay', 'Lily', 'Revina', '343', '343', '343', 'bryann4545', 'test@test.com', NULL, '$2y$10$mI/RYgVKvbxjTyW6oG4QRuZNJKo9TYIWGnpUIIUKA2EJPeUJJC0le', 'active', NULL, 0, NULL, '2019-05-16 06:49:06', '2019-05-16 07:18:05', NULL, NULL, NULL),
	(10, 2, 'Sir Juke Pangan', 'Juke', 'Pangan', '09279876542', '09209876542', '09109876542', 'juke101', 'juke.pangan@test.com', NULL, '$2y$10$iZTWCTeclAJe0Np8LUK/9eZ8Uv2ecwmgg9Hjsf1kN4.KAvXxsQaiK', NULL, NULL, 0, NULL, '2019-05-23 07:44:49', '2019-10-27 15:40:02', NULL, '2019-10-27 15:40:02', NULL),
	(11, 2, 'Bonn', 'Bonn', 'Mendoza', '5465454', '5465465', '56546', 'bonn03', 'bonn.mendoza@gmail.com', NULL, '$2y$10$5brM7VSVkntHle4hJRtrBOJ8X4aLJ0mGJLEQeeqlfzW0NSyT0GPSi', NULL, NULL, 0, NULL, '2019-06-13 07:39:01', '2019-06-13 07:39:01', NULL, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.workflows: ~3 rows (approximately)
DELETE FROM `workflows`;
/*!40000 ALTER TABLE `workflows` DISABLE KEYS */;
INSERT INTO `workflows` (`id`, `workflow_category_id`, `stage_id`, `status`, `color_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 'Status 01', '#000000', '2019-06-19 01:16:44', '2019-06-19 01:16:44', NULL),
	(2, 1, 1, 'Status 02', '#000000', '2019-06-19 05:21:46', '2019-06-19 05:21:46', NULL),
	(3, 1, 2, 'On-que', '#6f1b1b', '2019-06-19 06:50:56', '2019-06-19 06:50:56', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table corecmsdb.workflow_categories: ~0 rows (approximately)
DELETE FROM `workflow_categories`;
/*!40000 ALTER TABLE `workflow_categories` DISABLE KEYS */;
INSERT INTO `workflow_categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Test03', '2019-06-19 01:15:55', '2019-06-19 01:15:55', NULL);
/*!40000 ALTER TABLE `workflow_categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
