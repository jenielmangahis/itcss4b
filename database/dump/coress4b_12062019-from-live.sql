-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2019 at 10:48 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coress4b_crmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `contact_number`, `facebook`, `twitter`, `instagram`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Core CRM', '123123123', 'testfacebook', 'test twitter', 'test instagram', 0, '2019-10-25 15:35:59', '2019-10-25 15:35:59', NULL),
(6, 'DMKA dba The Smarter Merchant LLC', '212-803-3320', NULL, NULL, NULL, 0, '2019-10-28 23:03:35', '2019-10-28 23:03:35', NULL),
(7, 'CapCall LLC', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:06:22', '2019-10-28 23:06:22', NULL),
(8, 'CapCall LLC', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:06:23', '2019-10-28 23:06:29', '2019-10-28 23:06:29'),
(9, 'LLSV', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:06:43', '2019-10-28 23:06:43', NULL),
(10, 'WCM', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:07:15', '2019-10-28 23:07:15', NULL),
(11, 'TVT Capital LLC', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:07:30', '2019-10-28 23:07:40', NULL),
(12, 'Hunter Caroline Holdings', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:07:56', '2019-10-28 23:07:56', NULL),
(13, 'Citi Capital', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:08:15', '2019-10-28 23:08:15', NULL),
(14, '24 Capital', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:08:28', '2019-10-28 23:08:28', NULL),
(15, 'Sandstone', '732-210-9190', NULL, NULL, NULL, 0, '2019-10-28 23:09:11', '2019-10-28 23:09:11', NULL),
(16, 'Roc Funding LLC', '718-414-2489', NULL, NULL, NULL, 0, '2019-10-28 23:09:41', '2019-10-28 23:09:41', NULL),
(17, '6th Avenue', '9143642696', NULL, NULL, NULL, 0, '2019-10-28 23:10:24', '2019-10-28 23:10:24', NULL),
(18, 'FundsoFast- GMA', '9145197451', NULL, NULL, NULL, 0, '2019-10-28 23:11:43', '2019-10-28 23:11:43', NULL),
(19, 'Mr. Advance', '(917) 410-6870', NULL, NULL, NULL, 0, '2019-10-28 23:12:50', '2019-10-28 23:12:50', NULL),
(20, 'Summit Capital Funding', '646-922-9109', NULL, NULL, NULL, 0, '2019-10-28 23:15:28', '2019-10-28 23:15:28', NULL),
(21, 'Yes Capital LLC', '347-229-9271', NULL, NULL, NULL, 0, '2019-10-28 23:17:13', '2019-10-28 23:17:13', NULL),
(22, 'ABC Company', '6463090599', 'test', 'test twitter', 'test', 0, '2019-11-30 00:09:21', '2019-11-30 00:09:21', NULL),
(23, 'perfect harvest inc', '646-766-8010', NULL, NULL, NULL, 1, '2019-12-03 00:58:34', '2019-12-03 00:58:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

DROP TABLE IF EXISTS `company_users`;
CREATE TABLE `company_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_users`
--

INSERT INTO `company_users` (`id`, `company_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 9, 14, '2019-10-25 15:48:52', '2019-10-29 00:13:47', NULL),
(5, 5, 15, '2019-10-25 15:49:58', '2019-10-25 15:49:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `company_id`, `user_id`, `stage_id`, `status`, `full_name`, `firstname`, `lastname`, `email`, `mobile_number`, `work_number`, `home_number`, `data_source`, `last_call_activity`, `time_in_status`, `address1`, `address2`, `city`, `state`, `zip_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 5, 15, 1, NULL, 'Sample fname Sample lname', 'Sample fname', 'Sample lname', 'contact1@gmail.com', '09119082622', '094666663', '012312312', NULL, NULL, NULL, 'test address 1', 'test address 2', 'sta rosa', 'test state', '4026', '2019-10-25 15:54:18', '2019-10-30 02:38:53', NULL),
(31, 5, 15, 1, NULL, 'Jason Leak', 'Jason', 'Leak', 'Jleak@CapCallLLC.com', '718-775-3743', '718-775-3743', '718-775-3743', NULL, NULL, NULL, '122 east 42nd street suite 2112', 'TVT', 'NEW YORK', 'New York', '10168', '2019-11-12 23:00:48', '2019-11-12 23:02:16', '2019-11-12 23:02:16'),
(32, 5, 15, 3, '10', 'Carolina Alcaraz', 'Carolina', 'Alcaraz', 'cfernece@gmail.com', '2019258269', NULL, NULL, NULL, NULL, NULL, '315 KNOPF ST', NULL, 'LINDEN', 'NJ', '07036', '2019-12-03 01:01:24', '2019-12-03 01:01:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_advances`
--

DROP TABLE IF EXISTS `contact_advances`;
CREATE TABLE `contact_advances` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_advances`
--

INSERT INTO `contact_advances` (`id`, `contact_id`, `company_id`, `lender_id`, `sales_user_id`, `under_writer_user_id`, `closer_user_id`, `loan_id`, `contract_date`, `contract_number`, `advance_date`, `amount`, `payback`, `balance`, `factor_rate`, `remit`, `period`, `period_type`, `payment`, `advance_type`, `payment_method`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 30, 0, 3, 0, 0, 15, '271019/0827', NULL, '271019/7140', NULL, 10000.00, 14900.00, 135000.00, 1.49, 0.01, '150', 'days', 99.33, 'new', 'ach', 'Started', '2019-10-27 14:22:51', '2019-11-29 22:45:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_advance_financial_bank_statement_records`
--

DROP TABLE IF EXISTS `contact_advance_financial_bank_statement_records`;
CREATE TABLE `contact_advance_financial_bank_statement_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_advance_financial_bank_statement_records`
--

INSERT INTO `contact_advance_financial_bank_statement_records` (`id`, `contact_advance_id`, `name`, `month`, `year`, `total_deposits`, `averate_daily`, `withdrawal`, `ending_balance`, `deposits`, `days_neg`, `nsf`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'Eastwest Inc.', 1, 2019, 100.00, 100.00, 100.00, 100.00, 1, 2, 4, '2019-10-24 18:41:27', '2019-10-25 11:26:57', NULL),
(2, 6, 'Eastwest Inc.', 2, 2019, 100.00, 100.00, 100.00, 100.00, 1, 2, 4, '2019-10-24 18:41:27', '2019-10-25 11:26:57', NULL),
(3, 6, 'Eastwest Inc.', 3, 2019, 100.00, 100.00, 100.00, 100.00, 1, 2, 4, '2019-10-24 18:41:27', '2019-10-25 11:26:57', NULL),
(4, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(5, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(6, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(7, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(8, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(9, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(10, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(11, 6, 'Eastwest Inc.', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 18:41:27', '2019-10-25 11:12:40', NULL),
(12, 6, 'Eastwest Inc.', 12, 2019, 350.00, 350.00, 350.00, 350.00, 2, 2, 2, '2019-10-24 18:41:27', '2019-10-25 11:27:20', NULL),
(13, 7, NULL, 1, 2001, 1000.00, 5.00, 500.00, 500.00, 1, 1, 1, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(14, 7, NULL, 2, 2001, 15000.00, 5.00, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(15, 7, NULL, 3, NULL, 20000.00, 2.00, 500.00, 35000.00, 1, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(16, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(17, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(18, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(19, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(20, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(21, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(22, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(23, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(24, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_advance_funding_info`
--

DROP TABLE IF EXISTS `contact_advance_funding_info`;
CREATE TABLE `contact_advance_funding_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_advance_funding_info`
--

INSERT INTO `contact_advance_funding_info` (`id`, `contact_advance_id`, `contract_date`, `contract_number`, `funding_date`, `wire_conf_number`, `routing_number`, `account_number`, `account_type`, `name_of_account`, `ach_gateway`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, '2019-11-01', 'test', '2019-11-01', '12312', '123123123', '123123132', 'Savings Account', 'test', 'Other', '2019-11-29 22:45:05', '2019-11-29 22:45:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_advance_merchant_statement_records`
--

DROP TABLE IF EXISTS `contact_advance_merchant_statement_records`;
CREATE TABLE `contact_advance_merchant_statement_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_advance_merchant_statement_records`
--

INSERT INTO `contact_advance_merchant_statement_records` (`id`, `contact_advance_id`, `name`, `month`, `year`, `total_volume`, `visa_ms_disc`, `amex`, `charge_back_volume`, `transaction`, `batches`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 6, 'BPI Bank', 1, 2019, 130.00, 130.00, 130.00, 130.00, 1, 1, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(5, 6, 'BPI Bank', 2, 2019, 130.00, 130.00, 130.00, 130.00, 1, 1, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(6, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(7, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(8, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(9, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(10, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(11, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(12, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(13, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:58', NULL),
(14, 6, 'BPI Bank', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-25 15:34:06', '2019-10-25 15:57:59', NULL),
(15, 6, 'BPI Bank', 12, 2019, 1150.00, 1550.00, 650.00, 360.00, 2, 2, '2019-10-25 15:34:06', '2019-10-25 15:57:59', NULL),
(16, 7, NULL, 1, NULL, 10.00, 5000.00, 5.00, 5.00, 30, 4, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(17, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(18, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(19, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(20, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(21, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(22, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(23, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(24, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(25, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(26, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL),
(27, 7, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-27 20:19:05', '2019-10-27 20:19:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_advance_participation`
--

DROP TABLE IF EXISTS `contact_advance_participation`;
CREATE TABLE `contact_advance_participation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `lender_id` int(11) NOT NULL DEFAULT '0',
  `loan_amount` double(11,2) DEFAULT NULL,
  `loan_amount_percent` double(11,2) DEFAULT NULL,
  `fee_amount` double(11,2) DEFAULT NULL,
  `fee_percent` double(11,2) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_advance_participation`
--

INSERT INTO `contact_advance_participation` (`id`, `contact_advance_id`, `lender_id`, `loan_amount`, `loan_amount_percent`, `fee_amount`, `fee_percent`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 1, 25000.00, 25.00, 75000.00, 75.00, 'payback', '2019-11-18 05:18:36', '2019-11-17 22:35:53', NULL),
(2, 6, 2, 15000.00, 2.00, 32000.00, 6.00, 'advance', '2019-11-17 22:20:53', '2019-11-17 22:20:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_advance_payments`
--

DROP TABLE IF EXISTS `contact_advance_payments`;
CREATE TABLE `contact_advance_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_advance_underwriter_notes`
--

DROP TABLE IF EXISTS `contact_advance_underwriter_notes`;
CREATE TABLE `contact_advance_underwriter_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_advance_id` int(11) NOT NULL DEFAULT '0',
  `under_writer_opinion` mediumtext COLLATE utf8mb4_unicode_ci,
  `tax_liens_judgements` mediumtext COLLATE utf8mb4_unicode_ci,
  `ucc_position` mediumtext COLLATE utf8mb4_unicode_ci,
  `advance_history_comments` mediumtext COLLATE utf8mb4_unicode_ci,
  `major_issues` mediumtext COLLATE utf8mb4_unicode_ci,
  `required_paperworks_information` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_advance_underwriter_notes`
--

INSERT INTO `contact_advance_underwriter_notes` (`id`, `contact_advance_id`, `under_writer_opinion`, `tax_liens_judgements`, `ucc_position`, `advance_history_comments`, `major_issues`, `required_paperworks_information`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 7, 'Test note', 'Test note', 'Test note', 'Test note', 'Test note', 'Test note', '2019-10-27 19:10:17', '2019-10-27 19:10:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_assigned_users`
--

DROP TABLE IF EXISTS `contact_assigned_users`;
CREATE TABLE `contact_assigned_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_assigned_users`
--

INSERT INTO `contact_assigned_users` (`id`, `contact_id`, `company_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 26, 3, 10, '2019-12-05 00:29:17', '2019-12-05 00:29:17', NULL),
(2, 12, 3, 10, '2019-12-05 00:33:24', '2019-12-05 00:33:24', NULL),
(3, 12, 3, 11, '2019-12-05 00:33:24', '2019-12-05 00:33:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_bank_accounts`
--

DROP TABLE IF EXISTS `contact_bank_accounts`;
CREATE TABLE `contact_bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `check_paying_client` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_on_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_check_paying_client` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_bank_accounts`
--

INSERT INTO `contact_bank_accounts` (`id`, `contact_id`, `check_paying_client`, `routing_number`, `bank_name`, `account_number`, `account_type`, `address`, `city`, `state_id`, `zip`, `name_on_account`, `phone`, `is_check_paying_client`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 30, NULL, '123123123', 'BPI', '123123132', 'Checking Account', 'test add 1', 'sta rosa', 2, '4026', 'Jeniel Mangahis', NULL, 0, '2019-10-27 13:46:36', '2019-10-27 13:46:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_broker_informations`
--

DROP TABLE IF EXISTS `contact_broker_informations`;
CREATE TABLE `contact_broker_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `brokerage_fee` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_broker_informations`
--

INSERT INTO `contact_broker_informations` (`id`, `contact_id`, `company_id`, `user_id`, `brokerage_fee`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 30, 5, 15, 500.00, '2019-10-25 15:54:18', '2019-10-30 02:38:53', NULL),
(13, 31, 5, 15, 100.00, '2019-11-12 23:00:48', '2019-11-12 23:00:48', NULL),
(14, 32, 5, 15, 150.00, '2019-12-03 01:01:24', '2019-12-03 01:01:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_business_informations`
--

DROP TABLE IF EXISTS `contact_business_informations`;
CREATE TABLE `contact_business_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_business_informations`
--

INSERT INTO `contact_business_informations` (`id`, `contact_id`, `company_id`, `user_id`, `business_name`, `years_in_business`, `legal_entity_of_business`, `accept_credit_card_from_customer`, `gross_monthly_credit_card_sales`, `gross_yearly_sales`, `filed_bankruptcy`, `bankruptcy_filed`, `credit_score`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 30, 5, 15, 'Sample business name', '1.00', 'Sole Proprietorship', 'yes', 110000.00, 1110000.00, 'No', '1910-01-01', '10', '2019-10-25 15:54:18', '2019-10-30 02:58:48', NULL),
(13, 31, 5, 15, 'TVT CAPITAL LLC', '1.00', 'Sole Proprietorship', 'NO', 10000.00, 200000.00, 'Yes', '1910-01-01', '750', '2019-11-12 23:00:48', '2019-11-12 23:00:48', NULL),
(14, 32, 5, 15, 'YPF CAPITAL LLC', '1.00', 'Sole Proprietorship', 'no', 10000.00, 100000.00, 'No', '2019-12-02', '670', '2019-12-03 01:01:24', '2019-12-03 01:01:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_call_trackers`
--

DROP TABLE IF EXISTS `contact_call_trackers`;
CREATE TABLE `contact_call_trackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_call_trackers`
--

INSERT INTO `contact_call_trackers` (`id`, `user_id`, `contact_id`, `call_type`, `call_result`, `call_minutes`, `call_seconds`, `notes`, `event_type_id`, `call_update_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 1, 30, 'Outgoing', 'Connected', '3', '30', 'this is a test call notes', 1, 'Completed', '2019-10-27 12:31:19', '2019-10-27 12:31:19', NULL),
(11, 1, 30, 'Outgoing', 'Connected', '12', '25', 'sample telemarketing', 1, 'Opened', '2019-10-27 18:49:12', '2019-10-27 18:49:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_campaigns`
--

DROP TABLE IF EXISTS `contact_campaigns`;
CREATE TABLE `contact_campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_credit_cards`
--

DROP TABLE IF EXISTS `contact_credit_cards`;
CREATE TABLE `contact_credit_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `state_id` int(11) DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_credit_cards`
--

INSERT INTO `contact_credit_cards` (`id`, `contact_id`, `debit_credit`, `card_type`, `card_issuer`, `name_on_card`, `card_number`, `expiration_date_month`, `expiration_date_year`, `address`, `address2`, `city`, `state_id`, `zip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 30, 'Credit Card', 'American Express', 'test', 'jeniel mangahis', '123123123', 1, 2020, 'test add 1', 'test address 2', 'sta rosa', 1, '4026', '2019-10-27 13:42:05', '2019-10-27 13:42:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_custom_fields`
--

DROP TABLE IF EXISTS `contact_custom_fields`;
CREATE TABLE `contact_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL,
  `name` varchar(95) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_custom_fields`
--

INSERT INTO `contact_custom_fields` (`id`, `contact_id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'test', 'this is only a test', '2019-05-17 10:25:47', '2019-05-17 10:25:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_datasource`
--

DROP TABLE IF EXISTS `contact_datasource`;
CREATE TABLE `contact_datasource` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `source_name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=import,2=webform',
  `stage_id` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compaign_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_datasource`
--

INSERT INTO `contact_datasource` (`id`, `company_id`, `user_id`, `source_name`, `type`, `stage_id`, `status`, `compaign_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'ABC Broker', 2, 1, 'Status 02', 1, '2019-06-19 10:50:36', '2019-06-19 12:09:43', NULL),
(2, 2, 1, 'Import Customer Data', 1, 1, 'Status 01', 1, '2019-06-19 12:09:34', '2019-06-21 10:02:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_docs`
--

DROP TABLE IF EXISTS `contact_docs`;
CREATE TABLE `contact_docs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `filename` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_docs`
--

INSERT INTO `contact_docs` (`id`, `user_id`, `contact_id`, `filename`, `document_title`, `document_type`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 1, 30, 'jeniel.xls', 'jeniel.xls', 1, 'test doc', '2019-10-27 13:02:15', '2019-10-27 13:02:15', NULL),
(9, 1, 30, 'doc01515920190701125800.pdf', 'doc01515920190701125800.pdf', 3, 'BANK RESPONSE 12.2', '2019-12-03 01:18:58', '2019-12-03 01:18:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_events`
--

DROP TABLE IF EXISTS `contact_events`;
CREATE TABLE `contact_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_events`
--

INSERT INTO `contact_events` (`id`, `title`, `event_date`, `event_time`, `event_type_id`, `user_id`, `contact_id`, `location`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'Sample Events', '2019-10-28', '16:15:00', 2, 14, 30, 'homebased', 'this is a sample event for monday', '2019-10-27 13:03:19', '2019-10-27 13:03:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_history`
--

DROP TABLE IF EXISTS `contact_history`;
CREATE TABLE `contact_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_history`
--

INSERT INTO `contact_history` (`id`, `user_id`, `contact_id`, `company_id`, `title`, `description`, `module`, `created_at`, `updated_at`, `deleted_at`) VALUES
(36, 1, 30, 0, 'Add New Call Log', 'Call Tracker Id: 10', 'Calls', '2019-10-27 12:31:19', '2019-10-27 12:31:19', NULL),
(37, 1, 30, 0, 'Add New Document', 'Document File Name: jeniel.xls', 'Docs', '2019-10-27 13:02:15', '2019-10-27 13:02:15', NULL),
(38, 1, 30, 0, 'Add New Event', 'Assigned to User Id: 14', 'Events', '2019-10-27 13:03:19', '2019-10-27 13:03:19', NULL),
(39, 1, 30, 0, 'Add New Call Log', 'Call Tracker Id: 11', 'Calls', '2019-10-27 18:49:12', '2019-10-27 18:49:12', NULL),
(40, 1, 30, 0, 'Add New Document', 'Document File Name: doc01515920190701125800.pdf', 'Docs', '2019-12-03 01:18:58', '2019-12-03 01:18:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_loan_informations`
--

DROP TABLE IF EXISTS `contact_loan_informations`;
CREATE TABLE `contact_loan_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `loan_amount` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_loan_informations`
--

INSERT INTO `contact_loan_informations` (`id`, `contact_id`, `company_id`, `user_id`, `loan_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 30, 5, 15, 100000.00, '2019-10-25 15:54:18', '2019-10-30 02:38:53', NULL),
(13, 31, 5, 15, 10000.00, '2019-11-12 23:00:48', '2019-11-12 23:00:48', NULL),
(14, 32, 5, 15, 10000.00, '2019-12-03 01:01:24', '2019-12-03 01:01:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_notes`
--

DROP TABLE IF EXISTS `contact_notes`;
CREATE TABLE `contact_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL,
  `note_type_id` int(11) NOT NULL,
  `note_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify_user_id` int(11) NOT NULL,
  `cc_emails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_notes`
--

INSERT INTO `contact_notes` (`id`, `user_id`, `contact_id`, `note_type_id`, `note_title`, `note_content`, `notify_user_id`, `cc_emails`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 0, 30, 2, 'Sample note', '<p>this is a sample notes</p>', 15, '', '2019-10-27 12:55:14', '2019-10-27 12:55:14', NULL),
(11, 0, 30, 2, 'Sample note', '<p>this is a sample notes</p>', 15, '', '2019-10-27 12:56:28', '2019-10-27 12:56:28', NULL),
(12, 0, 30, 4, '- DK DWELLING LEGAL SCRUB=', '<p>fgjd;fgmdmg;dmg;fm</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>note&nbsp;</p>\r\n\r\n<p>nycef&nbsp;</p>\r\n\r\n<p>maybe&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>check&nbsp;</p>', 15, '', '2019-12-03 01:12:58', '2019-12-03 01:12:58', NULL),
(13, 0, 30, 4, '- DK DWELLING LEGAL SCRUB=', '<p>fgjd;fgmdmg;dmg;fm</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>note&nbsp;</p>\r\n\r\n<p>nycef&nbsp;</p>\r\n\r\n<p>maybe&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>check&nbsp;</p>', 15, '', '2019-12-03 01:13:00', '2019-12-03 01:13:00', NULL),
(14, 0, 30, 3, '- DK DWELLING LEGAL SCRUB=', '<p>fgjd;fgmdmg;dmg;fm</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>note&nbsp;</p>\r\n\r\n<p>nycef&nbsp;</p>\r\n\r\n<p>maybe&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>check&nbsp;</p>', 15, '', '2019-12-03 01:13:46', '2019-12-03 01:13:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_tasks`
--

DROP TABLE IF EXISTS `contact_tasks`;
CREATE TABLE `contact_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_tasks`
--

INSERT INTO `contact_tasks` (`id`, `user_id`, `assigned_user_id`, `contact_id`, `status_id`, `assigned_user`, `title`, `notes`, `due_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 1, 15, 30, 0, 's:2:\"15\";', 'New task', '<p><br />\r\nthis is a sample content for the task details</p>', '2019-10-29', 'pending', '2019-10-27 13:09:03', '2019-10-27 13:09:03', NULL),
(10, 1, 15, 30, 0, 's:2:\"15\";', 'New task', '<p><br />\r\nthis is a sample content for the task details</p>', '2019-10-29', 'pending', '2019-10-27 13:10:13', '2019-10-27 13:10:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_users`
--

DROP TABLE IF EXISTS `contact_users`;
CREATE TABLE `contact_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_users`
--

INSERT INTO `contact_users` (`id`, `contact_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 30, 16, '2019-10-27 17:24:28', '2019-10-27 17:24:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

DROP TABLE IF EXISTS `event_types`;
CREATE TABLE `event_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Phone Call', '2019-07-15 10:47:46', '2019-07-15 10:47:46', NULL),
(2, 'Sales Calls', '2019-07-15 10:48:01', '2019-07-15 10:54:48', NULL),
(4, 'Followup Call', '2019-08-05 12:28:13', '2019-08-05 12:28:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', '2019-05-17 10:31:13', '2019-05-29 14:02:01', NULL),
(2, 'Company User', '2019-05-29 12:25:12', '2019-05-29 12:25:12', NULL),
(3, 'Customer', '2019-05-29 14:02:11', '2019-05-29 14:02:11', NULL),
(4, 'RTR Recovery Group', '2019-11-30 00:06:18', '2019-11-30 00:06:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lenders`
--

DROP TABLE IF EXISTS `lenders`;
CREATE TABLE `lenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lenders`
--

INSERT INTO `lenders` (`id`, `company_name`, `street`, `suburb`, `city`, `state`, `zip_code`, `country`, `phone`, `email`, `url_site`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Core-Lenders', '123 test address', NULL, 'test city', 'Arizona', '4026', NULL, '123123123', 'jeniel.mangahis@gmail.com', 'www.testjenlending.com', 'this is a sample lender for CoreCRM', '2019-10-27 13:50:38', '2019-10-27 13:50:38', NULL),
(4, 'New shine lending corp', '123 test address', NULL, 'sta rosa', 'Arizona', '4026', NULL, '123123123', 'bryann.revina03@gmail.com', 'www.testbryannlending.com', 'This is a sample only for CoreCRM', '2019-10-27 13:53:41', '2019-10-27 13:53:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lender_contacts`
--

DROP TABLE IF EXISTS `lender_contacts`;
CREATE TABLE `lender_contacts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_messaging`
--

DROP TABLE IF EXISTS `mail_messaging`;
CREATE TABLE `mail_messaging` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `date_last_opened` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_messaging`
--

INSERT INTO `mail_messaging` (`id`, `user_id`, `contact_id`, `recipient`, `subject`, `cc`, `bcc`, `content`, `status`, `date`, `date_last_opened`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 1, 30, 'contact1@gmail.com', 'Email for testing', '', '', '<p>This is a test content for sending email</p>', 1, '2019-10-27 19:26:36', '2019-10-27 19:26:36', '2019-10-27 19:26:36', '2019-10-27 19:26:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_types`
--

DROP TABLE IF EXISTS `media_types`;
CREATE TABLE `media_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_types`
--

INSERT INTO `media_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Facebook', '2019-06-21 11:03:27', '2019-06-21 11:03:27', NULL),
(2, 'Twitter', '2019-06-21 11:03:33', '2019-06-21 11:03:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
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
(51, '2019_10_19_133033_create_contact_advance_payments_table', 39);

-- --------------------------------------------------------

--
-- Table structure for table `note_types`
--

DROP TABLE IF EXISTS `note_types`;
CREATE TABLE `note_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `note_types`
--

INSERT INTO `note_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'General', '2019-08-14 05:46:06', '2019-08-14 05:46:06', NULL),
(2, 'Call', '2019-08-14 05:47:07', '2019-08-14 05:47:07', NULL),
(3, 'Creditor', '2019-08-14 05:47:14', '2019-08-14 05:47:14', NULL),
(4, 'Settlement', '2019-08-14 05:48:13', '2019-08-14 05:48:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

DROP TABLE IF EXISTS `sources`;
CREATE TABLE `sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE `stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Leads', '2019-06-09 05:29:17', '2019-06-09 05:29:17', NULL),
(2, 'New', '2019-06-19 11:50:30', '2019-06-19 11:50:30', NULL),
(3, 'Default', '2019-11-27 14:31:55', '2019-11-27 14:31:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Alabama', '2019-10-27 13:25:30', '2019-10-27 13:25:30', NULL),
(2, 'Alaska', '2019-10-27 13:25:45', '2019-10-27 13:25:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `reset_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `nickname`, `firstname`, `lastname`, `mobile_number`, `work_number`, `home_number`, `username`, `email`, `email_verified_at`, `password`, `status`, `profile_img`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `last_login`, `reset_code`) VALUES
(1, 1, 'Admin', 'Admin', 'Admin', '09279983995', NULL, NULL, 'admin', 'bryann.revina@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, '0723844514a8e149966354f21b337c34.jpg', 0, NULL, '2019-05-11 11:03:15', '2019-12-05 21:52:36', NULL, '2019-12-05 15:52:36', NULL),
(13, 1, NULL, 'Jeniel', 'Mangahis', '09179082622', '123123123', '654654', 'jeniel', 'jeniel.mangahis@gmail.com', NULL, '$2y$10$Skuf8ITZlH5tLFu7Bi1MiePKU/l8lgh0chF.GeoUMwtR991snkwqC', NULL, NULL, 0, NULL, '2019-10-25 15:41:39', '2019-10-25 15:41:39', NULL, NULL, NULL),
(14, 2, 'User1 test', 'User 01', 'Test', '09119082622', '094666663', '012312312', 'user1', 'user1@gmail.com', NULL, '$2y$10$SzAHd/zJ7bN05/L4Xn7PmeYmsgqWCitBbb.2AKVyqPplsWXaQsV7u', NULL, NULL, 0, NULL, '2019-10-25 15:48:52', '2019-10-25 15:50:32', NULL, '2019-10-25 10:50:32', NULL),
(15, 2, 'User2 test', 'User 02', 'Test', '09119082622', '094666663', '123123123123', 'user2', 'user2@gmail.com', NULL, '$2y$10$K4Jxv4NiNmPwUMIhJJOfseFLa.eXIngSc6LvoGznILJeopi9QN.Cq', NULL, NULL, 0, NULL, '2019-10-25 15:49:58', '2019-10-25 15:49:58', NULL, NULL, NULL),
(16, 3, '', 'Sample fname', 'Sample lname', '09119082622', '094666663', '012312312', 'sample_customer', 'contact1@gmail.com', NULL, '$2y$10$pE/ORTG68hGJci.GDNl71OvTK9Sme8iO4QO.eXluFrnFHa8i7/IxK', NULL, NULL, 0, NULL, '2019-10-27 17:24:28', '2019-11-11 21:00:56', NULL, '2019-11-11 15:00:56', NULL),
(17, 4, 'juke', 'Juke', 'Paran', '6463090599', '6463090599', '6463090599', 'juke', 'it@css4b.com', NULL, '$2y$10$naxQekw8twk3Qhdvhjg81ub7awsbYTddjZv1xQqoqj6InPVHxBiXa', NULL, NULL, 0, NULL, '2019-11-30 00:07:58', '2019-11-30 00:07:58', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workflows`
--

DROP TABLE IF EXISTS `workflows`;
CREATE TABLE `workflows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `workflow_category_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workflows`
--

INSERT INTO `workflows` (`id`, `workflow_category_id`, `stage_id`, `status`, `color_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Bankrupt', '#d22c96', '2019-11-27 14:44:19', '2019-11-27 14:44:19', NULL),
(2, 1, 1, 'Payment Plan', '#d1da0f', '2019-11-27 14:46:22', '2019-11-27 14:46:22', NULL),
(3, 1, 1, 'Collections', '#11d742', '2019-11-27 14:47:00', '2019-11-27 14:47:00', NULL),
(4, 1, 1, 'Legal', '#b63f14', '2019-11-27 14:47:46', '2019-11-27 14:47:46', NULL),
(5, 1, 1, 'Outside Counsel', '#0daad2', '2019-11-27 14:48:52', '2019-11-27 14:48:52', NULL),
(6, 1, 1, 'Settled', '#15e422', '2019-11-27 14:51:37', '2019-11-27 14:51:37', NULL),
(7, 1, 3, 'Bankrupt', '#d22c96', '2019-11-27 14:55:04', '2019-11-27 14:55:04', NULL),
(8, 1, 3, 'Payment Plan', '#d1da0f', '2019-11-27 14:55:45', '2019-11-27 14:55:45', NULL),
(9, 1, 3, 'Collections', '#11d742', '2019-11-27 14:56:51', '2019-11-27 14:56:51', NULL),
(10, 1, 3, 'Legal', '#b63f14', '2019-11-27 14:59:56', '2019-11-27 14:59:56', NULL),
(11, 1, 3, 'Outside Counsel', '#0daad2', '2019-11-27 15:01:02', '2019-11-27 15:05:03', NULL),
(12, 1, 3, 'Settled', '#15e422', '2019-11-27 15:01:53', '2019-11-27 15:01:53', NULL),
(13, 1, 2, 'Bankrupt', '#d22c96', '2019-11-27 15:05:41', '2019-11-27 15:05:41', NULL),
(14, 1, 2, 'Payment Plan', '#d1da0f', '2019-11-27 15:06:50', '2019-11-27 15:06:50', NULL),
(15, 1, 2, 'Collections', '#11d742', '2019-11-27 15:07:27', '2019-11-27 15:07:27', NULL),
(16, 1, 2, 'Legal', '#b63f14', '2019-11-27 15:09:56', '2019-11-27 15:09:56', NULL),
(17, 1, 2, 'Outside Counsel', '#0daad2', '2019-11-27 15:11:27', '2019-11-27 15:11:27', NULL),
(18, 1, 2, 'Settled', '#15e422', '2019-11-27 15:11:54', '2019-11-27 15:11:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workflow_categories`
--

DROP TABLE IF EXISTS `workflow_categories`;
CREATE TABLE `workflow_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workflow_categories`
--

INSERT INTO `workflow_categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Contacts', '2019-11-27 14:43:29', '2019-11-27 14:43:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_advances`
--
ALTER TABLE `contact_advances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_advance_financial_bank_statement_records`
--
ALTER TABLE `contact_advance_financial_bank_statement_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_advance_funding_info`
--
ALTER TABLE `contact_advance_funding_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_advance_merchant_statement_records`
--
ALTER TABLE `contact_advance_merchant_statement_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_advance_participation`
--
ALTER TABLE `contact_advance_participation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_advance_payments`
--
ALTER TABLE `contact_advance_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_advance_underwriter_notes`
--
ALTER TABLE `contact_advance_underwriter_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_assigned_users`
--
ALTER TABLE `contact_assigned_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_bank_accounts`
--
ALTER TABLE `contact_bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_broker_informations`
--
ALTER TABLE `contact_broker_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_business_informations`
--
ALTER TABLE `contact_business_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_call_trackers`
--
ALTER TABLE `contact_call_trackers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_campaigns`
--
ALTER TABLE `contact_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_credit_cards`
--
ALTER TABLE `contact_credit_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_custom_fields`
--
ALTER TABLE `contact_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_datasource`
--
ALTER TABLE `contact_datasource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_docs`
--
ALTER TABLE `contact_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_events`
--
ALTER TABLE `contact_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_history`
--
ALTER TABLE `contact_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_loan_informations`
--
ALTER TABLE `contact_loan_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_notes`
--
ALTER TABLE `contact_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_tasks`
--
ALTER TABLE `contact_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_users`
--
ALTER TABLE `contact_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lenders`
--
ALTER TABLE `lenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lender_contacts`
--
ALTER TABLE `lender_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_messaging`
--
ALTER TABLE `mail_messaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_types`
--
ALTER TABLE `media_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note_types`
--
ALTER TABLE `note_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workflows`
--
ALTER TABLE `workflows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workflow_categories`
--
ALTER TABLE `workflow_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `contact_advances`
--
ALTER TABLE `contact_advances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_advance_financial_bank_statement_records`
--
ALTER TABLE `contact_advance_financial_bank_statement_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `contact_advance_funding_info`
--
ALTER TABLE `contact_advance_funding_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_advance_merchant_statement_records`
--
ALTER TABLE `contact_advance_merchant_statement_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_advance_participation`
--
ALTER TABLE `contact_advance_participation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_advance_payments`
--
ALTER TABLE `contact_advance_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_advance_underwriter_notes`
--
ALTER TABLE `contact_advance_underwriter_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_assigned_users`
--
ALTER TABLE `contact_assigned_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_bank_accounts`
--
ALTER TABLE `contact_bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_broker_informations`
--
ALTER TABLE `contact_broker_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_business_informations`
--
ALTER TABLE `contact_business_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_call_trackers`
--
ALTER TABLE `contact_call_trackers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_campaigns`
--
ALTER TABLE `contact_campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_credit_cards`
--
ALTER TABLE `contact_credit_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_custom_fields`
--
ALTER TABLE `contact_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_datasource`
--
ALTER TABLE `contact_datasource`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_docs`
--
ALTER TABLE `contact_docs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_events`
--
ALTER TABLE `contact_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_history`
--
ALTER TABLE `contact_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `contact_loan_informations`
--
ALTER TABLE `contact_loan_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_notes`
--
ALTER TABLE `contact_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_tasks`
--
ALTER TABLE `contact_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_users`
--
ALTER TABLE `contact_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lenders`
--
ALTER TABLE `lenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lender_contacts`
--
ALTER TABLE `lender_contacts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_messaging`
--
ALTER TABLE `mail_messaging`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `media_types`
--
ALTER TABLE `media_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `note_types`
--
ALTER TABLE `note_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `workflows`
--
ALTER TABLE `workflows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `workflow_categories`
--
ALTER TABLE `workflow_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
