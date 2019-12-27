-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2019 at 10:32 PM
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
(1, 'test 123', '123123', NULL, NULL, NULL, 0, '2019-12-09 22:16:09', '2019-12-09 22:20:02', '2019-12-09 22:20:02'),
(2, 'Iron Power', '302-270-9105', NULL, NULL, NULL, 0, '2019-12-09 23:47:37', '2019-12-09 23:47:37', NULL),
(3, 'perfect harvest inc', '520-980-0896', NULL, NULL, NULL, 0, '2019-12-10 23:47:38', '2019-12-10 23:47:38', NULL),
(4, 'Pittington Counseling Services', '407-330-5060', NULL, NULL, NULL, 0, '2019-12-13 03:51:15', '2019-12-13 03:51:15', NULL),
(5, 'AMACo', '917-435-8552', NULL, NULL, NULL, 0, '2019-12-13 04:05:04', '2019-12-13 04:05:04', NULL),
(6, 'AP-SAT', '(832) 559-1571', NULL, NULL, NULL, 0, '2019-12-16 21:50:04', '2019-12-16 21:50:04', NULL),
(7, 'Carolina Sun Hospitality dba Quality Inc', '2525721187', NULL, NULL, NULL, 1, '2019-12-17 01:52:05', '2019-12-17 01:52:05', NULL),
(8, '3 AMIGOS RESTAURANT GROUP LLC', '346-616-3843', NULL, NULL, NULL, 1, '2019-12-17 01:59:48', '2019-12-17 01:59:48', NULL),
(9, 'COUNTYWIDE DISTRIBUTORS INC', '516-277-1380', NULL, NULL, NULL, 1, '2019-12-17 02:59:31', '2019-12-17 02:59:31', NULL),
(10, 'ACADIAN FIRE PROTECTION', '504-466-4650', NULL, NULL, NULL, 1, '2019-12-17 23:55:08', '2019-12-17 23:55:08', NULL),
(11, 'AMERICAN GAS AND OIL CORP', '4089295943', NULL, NULL, NULL, 1, '2019-12-18 00:50:47', '2019-12-18 00:50:47', NULL),
(12, 'CARFINANCE CENTERS LLC', '760-722-7539', NULL, NULL, NULL, 1, '2019-12-18 01:19:11', '2019-12-18 01:19:11', NULL),
(13, 'SUSHI 4 REEL INC', '760-659-6784', NULL, NULL, NULL, 0, '2019-12-18 22:22:48', '2019-12-18 22:22:48', NULL),
(14, 'GO SOLAR LLC', '210-629-1430', NULL, NULL, NULL, 1, '2019-12-19 02:22:10', '2019-12-19 02:22:10', NULL),
(15, 'LOCAL PERK INC', '2486695344', NULL, NULL, NULL, 1, '2019-12-19 03:32:44', '2019-12-19 03:32:44', NULL),
(16, 'NAS TRADING INC', '949-466-0788', NULL, NULL, NULL, 1, '2019-12-19 03:43:39', '2019-12-19 03:43:39', NULL),
(17, 'Arch companies Inc', '(425) 788-1128', NULL, NULL, NULL, 1, '2019-12-19 21:51:43', '2019-12-19 21:51:43', NULL),
(18, 'G.L. Rogers', '7605211821', NULL, NULL, NULL, 1, '2019-12-19 22:21:22', '2019-12-19 22:21:22', NULL),
(19, 'House Dr Development LLC', '904-993-1936', NULL, NULL, NULL, 1, '2019-12-19 23:04:22', '2019-12-19 23:04:22', NULL),
(20, 'KEW INDUSTRIAL', '7707105574', NULL, NULL, NULL, 1, '2019-12-19 23:24:14', '2019-12-19 23:24:14', NULL),
(21, 'SMITHCNC USA LLC', '(330) 268-6381', NULL, NULL, NULL, 1, '2019-12-19 23:30:21', '2019-12-19 23:30:21', NULL),
(22, 'ROAD BUILDERS', '2103318653', NULL, NULL, NULL, 1, '2019-12-19 23:36:22', '2019-12-19 23:36:22', NULL),
(23, 'REX FREIGHT, INC.', '8183893409', NULL, NULL, NULL, 1, '2019-12-20 00:23:57', '2019-12-20 00:23:57', NULL),
(24, 'Heller Family Medical', '4122642244', NULL, NULL, NULL, 1, '2019-12-27 00:07:24', '2019-12-27 00:07:24', NULL),
(25, 'Top Mop Inc', '9177807463', NULL, NULL, NULL, 1, '2019-12-27 00:20:22', '2019-12-27 00:20:22', NULL);

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
(1, 2, 7, '2019-12-20 19:34:51', '2019-12-21 03:05:19', '2019-12-21 03:05:19');

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
  `legal_scrub` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `company_id`, `user_id`, `stage_id`, `status`, `full_name`, `firstname`, `lastname`, `email`, `mobile_number`, `work_number`, `home_number`, `data_source`, `last_call_activity`, `time_in_status`, `address1`, `address2`, `city`, `state`, `zip_code`, `legal_scrub`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 1, '1', 'Ttest Test', 'Ttest', 'Test', 'lionheart_0292@yahoo.com', '123123123', '123123123', '123123', NULL, NULL, NULL, '123', '123', 'test', 'test', '123123', NULL, '2019-12-09 22:19:40', '2019-12-09 22:19:53', '2019-12-09 22:19:53'),
(2, 2, 1, 3, '8', 'Rocky Kibrew', 'Rocky', 'Kibrew', 'rkibrew@yahoo.com', '302-270-9105', NULL, NULL, NULL, NULL, NULL, '3597 Cobbs Hill Rd', NULL, 'willards', 'MD', '21874', NULL, '2019-12-09 23:56:21', '2019-12-20 13:32:32', NULL),
(3, 3, 3, 3, '8', 'Jorge Mercado', 'Jorge', 'Mercado', 'jorge@perfectharvest.com', '520-281-5717', '520-281-5717', '520-281-5717', NULL, NULL, NULL, '825 N Grand Ave', NULL, 'Nogales', 'AZ', '85621', NULL, '2019-12-10 23:53:25', '2019-12-13 22:15:06', NULL),
(4, 4, 3, 3, '8', 'Andrew Pittington', 'Andrew', 'Pittington', 'apittington@pittingtoncounseling.com', '407-506-9737', '407-330-5060', NULL, NULL, NULL, NULL, '142 West Lakeview Ave. Suite 2010', NULL, 'Lake Mary', 'Florida', '32746-6320', NULL, '2019-12-13 03:56:37', '2019-12-13 04:28:40', NULL),
(5, 5, 3, 3, '8', 'Allen YU', 'Allen', 'YU', 'allenyu1@me.com', '917-435-8552', '917-435-8552', NULL, NULL, NULL, NULL, '10 Manhattan Ave. 1st flr', '2110 1st Ave.', 'new york', 'new york', '10025', NULL, '2019-12-13 04:28:11', '2019-12-13 04:28:11', NULL),
(6, 6, 3, 3, '8', 'Thanh Mach', 'Thanh', 'Mach', 'thanhmach1960@gmail.com', '(832) 559-1571', NULL, NULL, NULL, NULL, NULL, '16630 Champion Forest Dr', NULL, 'Spring', 'TX', '77379', NULL, '2019-12-16 21:54:55', '2019-12-16 21:57:57', NULL),
(7, 7, 3, 3, '10', 'Khalid Durrani', 'Khalid', 'Durrani', 'Khalidmd57@hotmail.com', '2525721187', NULL, NULL, NULL, NULL, NULL, '197 Parham rd', NULL, 'henderson', 'NC', '27536', NULL, '2019-12-17 01:55:25', '2019-12-17 01:55:25', NULL),
(8, 8, 3, 3, '10', 'Kevin Tipton', 'Kevin', 'Tipton', 'crabdaddys.kevin@gmail.com', '7278005081', NULL, NULL, NULL, NULL, NULL, '678 75th Ave,', NULL, 'St. Pete Beach,', 'FL', '33706', NULL, '2019-12-17 02:05:40', '2019-12-17 02:05:40', NULL),
(9, 9, 3, 3, '10', 'FERDINAND PETER', 'FERDINAND', 'PETER', 'countywide1480@gmail.com', '516-277-1380', NULL, NULL, NULL, NULL, NULL, '1480 BELLMORE AVE', NULL, 'NORTH BELLMORE', 'NY', '11710-5502', NULL, '2019-12-17 03:37:42', '2019-12-17 03:57:32', NULL),
(10, 10, 3, 3, '10', 'TIMOTHY D GAUDET', 'TIMOTHY D', 'GAUDET', 'CHERIE@ACADIANFIRE.COM', '504-453-9689', '504-453-8765', NULL, NULL, NULL, NULL, '547 LAKE AVE', NULL, 'METAIRIE', 'LA', '70005', NULL, '2019-12-18 00:42:28', '2019-12-18 00:42:28', NULL),
(11, 11, 3, 3, '10', 'ANNIE KIM LE', 'ANNIE KIM', 'LE', '12345@GMIAL.COM', '4089295943', '4089295943', NULL, NULL, NULL, NULL, '1655 MCKEE RD', NULL, 'SAN JOSE', 'CA', '95116', NULL, '2019-12-18 01:14:46', '2019-12-18 01:14:46', NULL),
(12, 12, 3, 3, '10', 'DEBORAH LYNN BASS', 'DEBORAH LYNN', 'BASS', 'SPECIALFINANCE1@GMAIL.COM', '760-440-8585', '760-722-7539', NULL, NULL, NULL, NULL, '205 SOUTH COAST HIGHWAY', NULL, 'OCEANSIDE', 'CA', '92054', '<p>ssd</p>', '2019-12-18 01:45:33', '2019-12-18 22:40:09', NULL),
(13, 2, 3, 3, '8', 'Joohan Kim', 'Joohan', 'Kim', 'sushi4reel@gmail.com', '760-659-6784', '760-659-6784', NULL, NULL, NULL, NULL, '4750 Oceanside Blvd', NULL, 'Oceanside', 'California', '92056', NULL, '2019-12-18 22:36:57', '2019-12-18 22:41:21', NULL),
(14, 14, 3, 3, '10', 'DANIEL FARRUGGIA', 'DANIEL', 'FARRUGGIA', 'GOSOLAR210@GMAIL.COM', '2106291430', '2106291430', NULL, NULL, NULL, NULL, '10334 SHADY MEADOWS', NULL, 'SAN ANTONIO', 'TX', '78245', NULL, '2019-12-19 03:02:13', '2019-12-19 03:02:48', NULL),
(15, 15, 3, 3, '10', 'MARK MECHIGIAN', 'MARK', 'MECHIGIAN', 'mmechigian@gmail.com', '2487523003', '2486695344', NULL, NULL, NULL, NULL, '2199 HAGGERTY RD', NULL, 'COMMERCE CHARTER TOWNSHIP', 'MI', '48390', NULL, '2019-12-19 03:38:38', '2019-12-19 03:38:38', NULL),
(16, 17, 3, 3, '11', 'ZEESHAN QAZI', 'ZEESHAN', 'QAZI', 'zeeshanqazi61@yahoo.com', '(425) 788-1128', NULL, NULL, NULL, NULL, NULL, '14350 Phinney Ave n', NULL, 'seattle', 'wa', '98133', NULL, '2019-12-19 21:57:17', '2019-12-19 22:14:50', '2019-12-19 22:14:50'),
(17, 18, 3, 3, '10', 'Rogers Gary', 'Rogers', 'Gary', 'gleerog@gmail.com', '760521821', NULL, NULL, NULL, NULL, NULL, '940 ind Drift', NULL, 'Carlsbad', 'ca', '92011', NULL, '2019-12-19 22:24:24', '2019-12-19 22:24:24', NULL),
(18, 19, 3, 3, '10', 'Ngan Du', 'Ngan', 'Du', 'office@developjax.cm', '(904) 999-4991', '(904) 999-4991', NULL, NULL, NULL, NULL, '7402 Atlantic Blvd Suite #4', NULL, 'Jacksonville', 'Florida', '32211', NULL, '2019-12-19 23:18:04', '2019-12-21 04:21:42', NULL),
(19, 20, 3, 3, '10', 'Alvin Hegner', 'Alvin', 'Hegner', 'al.hegner@kewindustires.com', '770-710-5574', NULL, NULL, NULL, NULL, NULL, '109 KILKENNEY RD', NULL, 'TYRONE', 'GA', '30290-2757', NULL, '2019-12-19 23:27:27', '2019-12-21 04:21:56', NULL),
(20, 21, 3, 3, '10', 'DOUGLAS SMITH', 'DOUGLAS', 'SMITH', 'DOUG@SMITHCNC-USA.COM', '(330) 268-6381', NULL, NULL, NULL, NULL, NULL, '2399 Locust St Unit 3', NULL, 'Canal Fulton', 'OH', '44614', NULL, '2019-12-19 23:33:14', '2019-12-21 03:04:23', NULL),
(21, 22, 3, 3, '10', 'MICHEL VILLANUEVA', 'MICHEL', 'VILLANUEVA', 'MICHELVILLANUEVA1@HOTMAIL.COM', '2103318653', NULL, NULL, NULL, NULL, NULL, '23015 FAIRWAY BRG', NULL, 'SAN ANTONIO', 'TX', '78258-7126', NULL, '2019-12-19 23:41:58', '2019-12-21 04:20:49', NULL),
(22, 23, 3, 3, '10', 'GERMAN BALAREZO', 'GERMAN', 'BALAREZO', 'rexinc2@gmail.com', '8183893409', NULL, NULL, NULL, NULL, NULL, '2521 SAN CLEMENTE AVE', NULL, 'ALHAMBRA', 'CA', '91803-4341', NULL, '2019-12-20 00:27:46', '2019-12-20 00:27:46', NULL),
(23, 2, 1, 2, '14', 'Test fname Test lname', 'Test fname', 'Test lname', 'jeniel.mangahis18@gmail.com', '09119082622', '6463090599', '6463090599', NULL, NULL, NULL, 'test address 1', 'test address 2', 'sta rosa', 'test state', '4026', NULL, '2019-12-20 13:50:08', '2019-12-20 13:50:08', NULL),
(24, 24, 3, 3, '10', 'Jennifer Heller', 'Jennifer', 'Heller', 'heather@drjenrocks.com', '912-264-2244', NULL, NULL, NULL, NULL, NULL, '208 Scranton connector ste 120', NULL, 'Brunswick', 'GA', '31525', NULL, '2019-12-27 00:17:14', '2019-12-27 00:17:14', NULL),
(25, 25, 3, 3, '7', 'Anastasiya Khomyakova', 'Anastasiya', 'Khomyakova', 'topmopnyc@gmail.com', '9177807463', NULL, NULL, NULL, NULL, NULL, '85 delancey st ste 8', NULL, 'new york', 'NY', '10002', NULL, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL);

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
(1, 2, 0, 0, 0, 0, 0, '091219/8106', NULL, '091219/3807', NULL, 50000.00, 0.00, 0.00, 0.00, 25.00, '50', 'weeks', 0.00, 'add-on', 'ach', 'Started', '2019-12-10 00:03:04', '2019-12-10 00:03:04', NULL);

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
(1, 2, 0, 6, '2019-12-20 13:32:32', '2019-12-20 13:32:32', NULL),
(2, 20, 0, 4, '2019-12-21 03:04:23', '2019-12-21 04:21:06', '2019-12-21 04:21:06'),
(3, 20, 0, 5, '2019-12-21 03:04:23', '2019-12-21 04:21:06', '2019-12-21 04:21:06'),
(4, 22, 0, 4, '2019-12-21 03:57:38', '2019-12-21 03:57:38', NULL),
(5, 22, 0, 5, '2019-12-21 03:57:38', '2019-12-21 03:57:38', NULL),
(6, 22, 0, 9, '2019-12-21 03:57:38', '2019-12-21 03:57:38', NULL),
(7, 22, 0, 10, '2019-12-21 03:57:38', '2019-12-21 03:57:38', NULL),
(8, 22, 0, 11, '2019-12-21 03:57:38', '2019-12-21 03:57:38', NULL),
(9, 22, 0, 12, '2019-12-21 03:57:38', '2019-12-21 03:57:38', NULL),
(10, 21, 0, 4, '2019-12-21 03:59:30', '2019-12-21 04:20:50', '2019-12-21 04:20:50'),
(11, 21, 0, 5, '2019-12-21 03:59:30', '2019-12-21 04:20:50', '2019-12-21 04:20:50'),
(12, 21, 0, 9, '2019-12-21 03:59:30', '2019-12-21 04:20:50', '2019-12-21 04:20:50'),
(13, 21, 0, 10, '2019-12-21 03:59:30', '2019-12-21 04:20:50', '2019-12-21 04:20:50'),
(14, 21, 0, 11, '2019-12-21 03:59:30', '2019-12-21 04:20:50', '2019-12-21 04:20:50'),
(15, 21, 0, 12, '2019-12-21 03:59:30', '2019-12-21 04:20:50', '2019-12-21 04:20:50'),
(16, 21, 0, 4, '2019-12-21 04:20:50', '2019-12-21 04:20:50', NULL),
(17, 21, 0, 5, '2019-12-21 04:20:50', '2019-12-21 04:20:50', NULL),
(18, 21, 0, 9, '2019-12-21 04:20:50', '2019-12-21 04:20:50', NULL),
(19, 21, 0, 10, '2019-12-21 04:20:50', '2019-12-21 04:20:50', NULL),
(20, 21, 0, 11, '2019-12-21 04:20:50', '2019-12-21 04:20:50', NULL),
(21, 21, 0, 12, '2019-12-21 04:20:50', '2019-12-21 04:20:50', NULL),
(22, 20, 0, 4, '2019-12-21 04:21:06', '2019-12-21 04:21:06', NULL),
(23, 20, 0, 5, '2019-12-21 04:21:06', '2019-12-21 04:21:06', NULL),
(24, 20, 0, 9, '2019-12-21 04:21:06', '2019-12-21 04:21:06', NULL),
(25, 20, 0, 10, '2019-12-21 04:21:06', '2019-12-21 04:21:06', NULL),
(26, 20, 0, 11, '2019-12-21 04:21:06', '2019-12-21 04:21:06', NULL),
(27, 20, 0, 12, '2019-12-21 04:21:06', '2019-12-21 04:21:06', NULL),
(28, 19, 0, 4, '2019-12-21 04:21:20', '2019-12-21 04:21:56', '2019-12-21 04:21:56'),
(29, 19, 0, 5, '2019-12-21 04:21:20', '2019-12-21 04:21:56', '2019-12-21 04:21:56'),
(30, 19, 0, 9, '2019-12-21 04:21:20', '2019-12-21 04:21:56', '2019-12-21 04:21:56'),
(31, 19, 0, 10, '2019-12-21 04:21:20', '2019-12-21 04:21:56', '2019-12-21 04:21:56'),
(32, 19, 0, 11, '2019-12-21 04:21:20', '2019-12-21 04:21:56', '2019-12-21 04:21:56'),
(33, 19, 0, 12, '2019-12-21 04:21:20', '2019-12-21 04:21:56', '2019-12-21 04:21:56'),
(34, 18, 0, 4, '2019-12-21 04:21:42', '2019-12-21 04:21:42', NULL),
(35, 18, 0, 5, '2019-12-21 04:21:42', '2019-12-21 04:21:42', NULL),
(36, 18, 0, 9, '2019-12-21 04:21:42', '2019-12-21 04:21:42', NULL),
(37, 18, 0, 10, '2019-12-21 04:21:42', '2019-12-21 04:21:42', NULL),
(38, 18, 0, 11, '2019-12-21 04:21:42', '2019-12-21 04:21:42', NULL),
(39, 18, 0, 12, '2019-12-21 04:21:42', '2019-12-21 04:21:42', NULL),
(40, 19, 0, 4, '2019-12-21 04:21:56', '2019-12-21 04:21:56', NULL),
(41, 19, 0, 5, '2019-12-21 04:21:56', '2019-12-21 04:21:56', NULL),
(42, 19, 0, 9, '2019-12-21 04:21:56', '2019-12-21 04:21:56', NULL),
(43, 19, 0, 10, '2019-12-21 04:21:56', '2019-12-21 04:21:56', NULL),
(44, 19, 0, 11, '2019-12-21 04:21:56', '2019-12-21 04:21:56', NULL),
(45, 19, 0, 12, '2019-12-21 04:21:56', '2019-12-21 04:21:56', NULL),
(46, 17, 0, 4, '2019-12-21 04:22:12', '2019-12-21 04:22:12', NULL),
(47, 17, 0, 5, '2019-12-21 04:22:12', '2019-12-21 04:22:12', NULL),
(48, 17, 0, 9, '2019-12-21 04:22:12', '2019-12-21 04:22:12', NULL),
(49, 17, 0, 10, '2019-12-21 04:22:12', '2019-12-21 04:22:12', NULL),
(50, 17, 0, 11, '2019-12-21 04:22:12', '2019-12-21 04:22:12', NULL),
(51, 17, 0, 12, '2019-12-21 04:22:12', '2019-12-21 04:22:12', NULL),
(52, 15, 0, 4, '2019-12-21 04:23:17', '2019-12-21 04:23:17', NULL),
(53, 15, 0, 5, '2019-12-21 04:23:17', '2019-12-21 04:23:17', NULL),
(54, 15, 0, 9, '2019-12-21 04:23:17', '2019-12-21 04:23:17', NULL),
(55, 15, 0, 10, '2019-12-21 04:23:17', '2019-12-21 04:23:17', NULL),
(56, 15, 0, 11, '2019-12-21 04:23:17', '2019-12-21 04:23:17', NULL),
(57, 15, 0, 12, '2019-12-21 04:23:17', '2019-12-21 04:23:17', NULL),
(58, 14, 0, 4, '2019-12-21 04:24:04', '2019-12-21 04:24:04', NULL),
(59, 14, 0, 5, '2019-12-21 04:24:04', '2019-12-21 04:24:04', NULL),
(60, 14, 0, 9, '2019-12-21 04:24:04', '2019-12-21 04:24:04', NULL),
(61, 14, 0, 10, '2019-12-21 04:24:04', '2019-12-21 04:24:04', NULL),
(62, 14, 0, 11, '2019-12-21 04:24:04', '2019-12-21 04:24:04', NULL),
(63, 14, 0, 12, '2019-12-21 04:24:04', '2019-12-21 04:24:04', NULL),
(64, 13, 0, 4, '2019-12-21 04:24:23', '2019-12-21 04:24:23', NULL),
(65, 13, 0, 5, '2019-12-21 04:24:23', '2019-12-21 04:24:23', NULL),
(66, 13, 0, 9, '2019-12-21 04:24:23', '2019-12-21 04:24:23', NULL),
(67, 13, 0, 10, '2019-12-21 04:24:23', '2019-12-21 04:24:23', NULL),
(68, 13, 0, 11, '2019-12-21 04:24:23', '2019-12-21 04:24:23', NULL),
(69, 13, 0, 12, '2019-12-21 04:24:23', '2019-12-21 04:24:23', NULL),
(70, 12, 0, 4, '2019-12-21 04:24:37', '2019-12-21 04:24:37', NULL),
(71, 12, 0, 5, '2019-12-21 04:24:37', '2019-12-21 04:24:37', NULL),
(72, 12, 0, 9, '2019-12-21 04:24:37', '2019-12-21 04:24:37', NULL),
(73, 12, 0, 10, '2019-12-21 04:24:37', '2019-12-21 04:24:37', NULL),
(74, 12, 0, 11, '2019-12-21 04:24:37', '2019-12-21 04:24:37', NULL),
(75, 12, 0, 12, '2019-12-21 04:24:37', '2019-12-21 04:24:37', NULL),
(76, 11, 0, 4, '2019-12-21 04:24:52', '2019-12-21 04:24:52', NULL),
(77, 11, 0, 5, '2019-12-21 04:24:52', '2019-12-21 04:24:52', NULL),
(78, 11, 0, 9, '2019-12-21 04:24:52', '2019-12-21 04:24:52', NULL),
(79, 11, 0, 10, '2019-12-21 04:24:52', '2019-12-21 04:24:52', NULL),
(80, 11, 0, 11, '2019-12-21 04:24:52', '2019-12-21 04:24:52', NULL),
(81, 11, 0, 12, '2019-12-21 04:24:52', '2019-12-21 04:24:52', NULL),
(82, 10, 0, 4, '2019-12-21 04:25:05', '2019-12-21 04:25:05', NULL),
(83, 10, 0, 5, '2019-12-21 04:25:05', '2019-12-21 04:25:05', NULL),
(84, 10, 0, 9, '2019-12-21 04:25:05', '2019-12-21 04:25:05', NULL),
(85, 10, 0, 10, '2019-12-21 04:25:05', '2019-12-21 04:25:05', NULL),
(86, 10, 0, 11, '2019-12-21 04:25:05', '2019-12-21 04:25:05', NULL),
(87, 10, 0, 12, '2019-12-21 04:25:05', '2019-12-21 04:25:05', NULL),
(88, 9, 0, 4, '2019-12-21 04:25:19', '2019-12-21 04:25:19', NULL),
(89, 9, 0, 5, '2019-12-21 04:25:19', '2019-12-21 04:25:19', NULL),
(90, 9, 0, 9, '2019-12-21 04:25:19', '2019-12-21 04:25:19', NULL),
(91, 9, 0, 10, '2019-12-21 04:25:19', '2019-12-21 04:25:19', NULL),
(92, 9, 0, 11, '2019-12-21 04:25:19', '2019-12-21 04:25:19', NULL),
(93, 9, 0, 12, '2019-12-21 04:25:19', '2019-12-21 04:25:19', NULL),
(94, 8, 0, 4, '2019-12-21 04:25:29', '2019-12-21 04:25:29', NULL),
(95, 8, 0, 5, '2019-12-21 04:25:29', '2019-12-21 04:25:29', NULL),
(96, 8, 0, 9, '2019-12-21 04:25:29', '2019-12-21 04:25:29', NULL),
(97, 8, 0, 10, '2019-12-21 04:25:29', '2019-12-21 04:25:29', NULL),
(98, 8, 0, 11, '2019-12-21 04:25:29', '2019-12-21 04:25:29', NULL),
(99, 8, 0, 12, '2019-12-21 04:25:29', '2019-12-21 04:25:29', NULL),
(100, 7, 0, 4, '2019-12-21 04:25:51', '2019-12-21 04:25:51', NULL),
(101, 7, 0, 5, '2019-12-21 04:25:51', '2019-12-21 04:25:51', NULL),
(102, 7, 0, 9, '2019-12-21 04:25:51', '2019-12-21 04:25:51', NULL),
(103, 7, 0, 10, '2019-12-21 04:25:51', '2019-12-21 04:25:51', NULL),
(104, 7, 0, 11, '2019-12-21 04:25:51', '2019-12-21 04:25:51', NULL),
(105, 7, 0, 12, '2019-12-21 04:25:51', '2019-12-21 04:25:51', NULL),
(106, 6, 0, 4, '2019-12-21 04:26:21', '2019-12-21 04:26:21', NULL),
(107, 6, 0, 5, '2019-12-21 04:26:21', '2019-12-21 04:26:21', NULL),
(108, 6, 0, 10, '2019-12-21 04:26:21', '2019-12-21 04:26:21', NULL),
(109, 6, 0, 11, '2019-12-21 04:26:21', '2019-12-21 04:26:21', NULL),
(110, 6, 0, 12, '2019-12-21 04:26:21', '2019-12-21 04:26:21', NULL),
(111, 5, 0, 4, '2019-12-21 04:26:38', '2019-12-21 04:26:38', NULL),
(112, 5, 0, 5, '2019-12-21 04:26:38', '2019-12-21 04:26:38', NULL),
(113, 5, 0, 9, '2019-12-21 04:26:38', '2019-12-21 04:26:38', NULL),
(114, 5, 0, 10, '2019-12-21 04:26:38', '2019-12-21 04:26:38', NULL),
(115, 5, 0, 11, '2019-12-21 04:26:38', '2019-12-21 04:26:38', NULL),
(116, 5, 0, 12, '2019-12-21 04:26:38', '2019-12-21 04:26:38', NULL),
(117, 4, 0, 4, '2019-12-21 04:26:57', '2019-12-21 04:26:57', NULL),
(118, 4, 0, 5, '2019-12-21 04:26:57', '2019-12-21 04:26:57', NULL),
(119, 4, 0, 9, '2019-12-21 04:26:57', '2019-12-21 04:26:57', NULL),
(120, 4, 0, 10, '2019-12-21 04:26:57', '2019-12-21 04:26:57', NULL),
(121, 4, 0, 11, '2019-12-21 04:26:57', '2019-12-21 04:26:57', NULL),
(122, 4, 0, 12, '2019-12-21 04:26:57', '2019-12-21 04:26:57', NULL),
(123, 3, 0, 4, '2019-12-21 04:27:11', '2019-12-21 04:27:11', NULL),
(124, 3, 0, 5, '2019-12-21 04:27:11', '2019-12-21 04:27:11', NULL),
(125, 3, 0, 9, '2019-12-21 04:27:11', '2019-12-21 04:27:11', NULL),
(126, 3, 0, 10, '2019-12-21 04:27:11', '2019-12-21 04:27:11', NULL),
(127, 3, 0, 11, '2019-12-21 04:27:11', '2019-12-21 04:27:11', NULL),
(128, 3, 0, 12, '2019-12-21 04:27:11', '2019-12-21 04:27:11', NULL),
(129, 24, 0, 5, '2019-12-27 00:17:28', '2019-12-27 00:17:28', NULL),
(130, 24, 0, 9, '2019-12-27 00:17:28', '2019-12-27 00:17:28', NULL),
(131, 24, 0, 10, '2019-12-27 00:17:28', '2019-12-27 00:17:28', NULL),
(132, 24, 0, 11, '2019-12-27 00:17:28', '2019-12-27 00:17:28', NULL),
(133, 25, 0, 5, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(134, 25, 0, 9, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(135, 25, 0, 10, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(136, 25, 0, 11, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL);

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
(1, 1, 1, 3, 123123.00, '2019-12-09 22:19:41', '2019-12-09 22:19:41', NULL),
(2, 2, 2, 1, 0.00, '2019-12-09 23:56:21', '2019-12-20 13:32:32', NULL),
(3, 3, 3, 3, 0.00, '2019-12-10 23:53:25', '2019-12-13 22:15:06', NULL),
(4, 4, 4, 3, 0.00, '2019-12-13 03:56:37', '2019-12-13 04:28:40', NULL),
(5, 5, 5, 3, 400.00, '2019-12-13 04:28:11', '2019-12-13 04:28:11', NULL),
(6, 6, 6, 3, 795.00, '2019-12-16 21:54:55', '2019-12-16 21:55:06', NULL),
(7, 7, 7, 3, 0.00, '2019-12-17 01:55:25', '2019-12-17 01:55:25', NULL),
(8, 8, 8, 3, 0.00, '2019-12-17 02:05:40', '2019-12-17 02:05:40', NULL),
(9, 9, 9, 3, 0.00, '2019-12-17 03:37:42', '2019-12-17 03:37:42', NULL),
(10, 10, 10, 3, 0.00, '2019-12-18 00:42:28', '2019-12-18 00:42:28', NULL),
(11, 11, 11, 3, 0.00, '2019-12-18 01:14:46', '2019-12-18 01:14:46', NULL),
(12, 12, 12, 3, 0.00, '2019-12-18 01:45:33', '2019-12-18 01:45:33', NULL),
(13, 13, 2, 3, 0.00, '2019-12-18 22:36:57', '2019-12-18 22:36:57', NULL),
(14, 14, 14, 3, 0.00, '2019-12-19 03:02:13', '2019-12-19 03:02:13', NULL),
(15, 15, 15, 3, 0.00, '2019-12-19 03:38:38', '2019-12-19 03:38:38', NULL),
(16, 16, 17, 3, 0.00, '2019-12-19 21:57:17', '2019-12-19 21:57:17', NULL),
(17, 17, 18, 3, 0.00, '2019-12-19 22:24:24', '2019-12-19 22:24:24', NULL),
(18, 18, 19, 3, 0.00, '2019-12-19 23:18:04', '2019-12-19 23:18:36', NULL),
(19, 19, 20, 3, 0.00, '2019-12-19 23:27:27', '2019-12-19 23:27:27', NULL),
(20, 20, 21, 3, 0.00, '2019-12-19 23:33:14', '2019-12-19 23:33:14', NULL),
(21, 21, 22, 3, 0.00, '2019-12-19 23:41:58', '2019-12-19 23:41:58', NULL),
(22, 22, 23, 3, 0.00, '2019-12-20 00:27:46', '2019-12-20 00:27:46', NULL),
(23, 23, 2, 1, 0.00, '2019-12-20 13:50:08', '2019-12-20 13:50:08', NULL),
(24, 24, 24, 3, 0.00, '2019-12-27 00:17:14', '2019-12-27 00:17:14', NULL),
(25, 25, 25, 3, 0.00, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL);

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
(1, 1, 1, 3, 'test 123', '1.00', 'Sole Proprietorship', '123123', 123123.00, 123123.00, 'Yes', '1910-01-01', '123', '2019-12-09 22:19:41', '2019-12-09 22:19:41', NULL),
(2, 2, 2, 1, 'Iron Power', '1.00', 'Sole Proprietorship', 'NO', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-12-09 23:56:21', '2019-12-20 13:32:32', NULL),
(3, 3, 3, 3, 'perfect harvest inc', '1.00', 'Sole Proprietorship', 'no', 0.00, 12000.00, 'Yes', '1910-01-01', 'NA', '2019-12-10 23:53:25', '2019-12-21 04:27:11', NULL),
(4, 4, 4, 3, 'Pittington Counseling Services', '1.00', 'Sole Proprietorship', 'NA', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-12-13 03:56:37', '2019-12-21 04:26:57', NULL),
(5, 5, 5, 3, 'AMACo', '1.00', 'Sole Proprietorship', 'NA', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-12-13 04:28:11', '2019-12-21 04:26:38', NULL),
(6, 6, 6, 3, 'AP-SAT', '1.00', 'Sole Proprietorship', 'yes', 5000.00, 50000.00, 'No', '1910-01-01', 'NA', '2019-12-16 21:54:55', '2019-12-21 04:26:21', NULL),
(7, 7, 7, 3, 'Carolina Sun Hospitality dba Quality Inc', '4.00', 'Limited Liability Company-LLC', 'YES', 35000.00, 420000.00, 'No', '1910-01-01', 'NA', '2019-12-17 01:55:25', '2019-12-21 04:25:51', NULL),
(8, 8, 8, 3, '3 AMIGOS RESTAURANT GROUP LLC', '1.00', 'Sole Proprietorship', 'YES', 7000.00, 85000.00, 'Yes', '1910-01-01', 'NA', '2019-12-17 02:05:40', '2019-12-21 04:25:29', NULL),
(9, 9, 9, 3, 'COUNTYWIDE DISTRIBUTORS INC', '6.00', 'Corporation', 'yes', 58000.00, 69800.00, 'No', '1910-01-01', 'NA', '2019-12-17 03:37:42', '2019-12-21 04:25:19', NULL),
(10, 10, 10, 3, 'ACADIAN FIRE PROTECTION', '1.00', 'Sole Proprietorship', 'NO', 0.00, 619711.44, 'No', '1910-01-01', 'NA', '2019-12-18 00:42:28', '2019-12-21 04:25:05', NULL),
(11, 11, 11, 3, 'AMERICAN GAS AND OIL CORP', '4.00', 'Corporation', 'YES', 66806.37, 801676.48, 'No', '1910-01-01', 'NA', '2019-12-18 01:14:46', '2019-12-21 04:24:52', NULL),
(12, 12, 12, 3, 'CARFINANCE CENTERS LLC', '2.00', 'Limited Liability Company-LLC', 'YES', 16432.66, 197191.99, 'No', '1910-01-01', 'NA', '2019-12-18 01:45:33', '2019-12-21 04:24:37', NULL),
(13, 13, 2, 3, 'SUSHI 4 REEL INC', '1.00', 'Sole Proprietorship', 'Yes', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2019-12-18 22:36:57', '2019-12-21 04:24:23', NULL),
(14, 14, 14, 3, 'GO SOLAR LLC', '4.00', 'Sole Proprietorship', 'YES', 36714.64, 432000.00, 'No', '1910-01-01', 'NA', '2019-12-19 03:02:13', '2019-12-21 04:24:04', NULL),
(15, 15, 15, 3, 'LOCAL PERK INC', '14.00', 'Corporation', 'YES', 22339.00, 268068.79, 'No', '1910-01-01', 'NA', '2019-12-19 03:38:38', '2019-12-21 04:23:17', NULL),
(16, 16, 17, 3, 'Arch companies Inc', '27.00', 'Corporation', 'no', 0.00, 100000.00, 'No', '1910-01-01', 'NA', '2019-12-19 21:57:17', '2019-12-19 21:57:17', NULL),
(17, 17, 18, 3, 'G.L. Rogers', '4.00', 'Corporation', 'no', 0.00, 1250000.00, 'No', '1910-01-01', 'NA', '2019-12-19 22:24:24', '2019-12-21 04:22:12', NULL),
(18, 18, 19, 3, 'House Dr Development LLC', '1.00', 'Sole Proprietorship', 'no', 0.00, 100000.00, 'Yes', '1910-01-01', 'NA', '2019-12-19 23:18:04', '2019-12-21 04:21:42', NULL),
(19, 19, 20, 3, 'KEW INDUSTRIAL', '2.00', 'Limited Liability Company-LLC', 'yes', 3000.00, 36000.00, 'No', '1910-01-01', 'NA', '2019-12-19 23:27:27', '2019-12-21 04:21:56', NULL),
(20, 20, 21, 3, 'SMITHCNC USA LLC', '1.00', 'Sole Proprietorship', 'YES', 10000.00, 100000.00, 'Yes', '1910-01-01', '570', '2019-12-19 23:33:14', '2019-12-21 04:21:06', NULL),
(21, 21, 22, 3, 'ROAD BUILDERS', '1.00', 'Sole Proprietorship', 'NO', 0.00, 1139392.84, 'Yes', '1910-01-01', 'NA', '2019-12-19 23:41:58', '2019-12-21 04:20:50', NULL),
(22, 22, 23, 3, 'REX FREIGHT, INC.', '3.00', 'Corporation', 'NO', 0.00, 100000.00, 'No', '1910-01-01', 'NA', '2019-12-20 00:27:46', '2019-12-21 03:57:38', NULL),
(23, 23, 2, 1, 'Iron Power', '1.00', 'Sole Proprietorship', 'yes', 110000.00, 1110000.00, 'No', '1910-01-01', 'NA', '2019-12-20 13:50:08', '2019-12-20 13:50:08', NULL),
(24, 24, 24, 3, 'Heller Family Medical', '3.00', 'Limited Liability Company-LLC', 'YES', 2500.00, 75000.00, 'No', '1910-01-01', 'NA', '2019-12-27 00:17:14', '2019-12-27 00:17:28', NULL),
(25, 25, 25, 3, 'Top Mop Inc', '6.00', 'Corporation', 'yes', 30000.00, 360000.00, 'Yes', '2019-08-23', 'NA', '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL);

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
(1, 1, 23, 0, 'Add New Note', 'Note Title: test, Note ID: 1', 'Notes', '2019-12-20 19:02:41', '2019-12-20 19:02:41', NULL),
(2, 1, 23, 0, 'Add New Note', 'Note Title: test, Note ID: 2', 'Notes', '2019-12-20 19:06:02', '2019-12-20 19:06:02', NULL),
(3, 1, 23, 0, 'Add New Note', 'Note Title: Test Note, Note ID: 3', 'Notes', '2019-12-20 19:15:35', '2019-12-20 19:15:35', NULL),
(4, 1, 23, 0, 'Delete Note', 'Note ID: 3', 'Notes', '2019-12-20 19:15:48', '2019-12-20 19:15:48', NULL),
(5, 3, 20, 0, 'Add New Note', 'Note Title: UCC\'s updates needed, Note ID: 4', 'Notes', '2019-12-21 03:00:04', '2019-12-21 03:00:04', NULL);

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
(1, 1, 1, 3, 1123123.00, '2019-12-09 22:19:41', '2019-12-09 22:19:41', NULL),
(2, 2, 2, 1, 50000.00, '2019-12-09 23:56:21', '2019-12-20 13:32:32', NULL),
(3, 3, 3, 3, 208743.85, '2019-12-10 23:53:25', '2019-12-13 22:15:06', NULL),
(4, 4, 4, 3, 30.00, '2019-12-13 03:56:37', '2019-12-13 04:28:40', NULL),
(5, 5, 5, 3, 400.00, '2019-12-13 04:28:11', '2019-12-13 04:28:11', NULL),
(6, 6, 6, 3, 14590.00, '2019-12-16 21:54:55', '2019-12-16 21:55:06', NULL),
(7, 7, 7, 3, 191242.75, '2019-12-17 01:55:25', '2019-12-17 01:55:25', NULL),
(8, 8, 8, 3, 298684.85, '2019-12-17 02:05:40', '2019-12-17 02:05:40', NULL),
(9, 9, 9, 3, 675000.00, '2019-12-17 03:37:42', '2019-12-17 03:37:42', NULL),
(10, 10, 10, 3, 205900.00, '2019-12-18 00:42:28', '2019-12-18 00:42:28', NULL),
(11, 11, 11, 3, 214196.14, '2019-12-18 01:14:46', '2019-12-18 01:14:46', NULL),
(12, 12, 12, 3, 239817.76, '2019-12-18 01:45:33', '2019-12-18 01:45:33', NULL),
(13, 13, 2, 3, 15.00, '2019-12-18 22:36:57', '2019-12-18 22:36:57', NULL),
(14, 14, 14, 3, 110250.00, '2019-12-19 03:02:13', '2019-12-19 03:02:13', NULL),
(15, 15, 15, 3, 145217.26, '2019-12-19 03:38:38', '2019-12-19 03:38:38', NULL),
(16, 16, 17, 3, 156400.00, '2019-12-19 21:57:17', '2019-12-19 21:57:17', NULL),
(17, 17, 18, 3, 129600.00, '2019-12-19 22:24:24', '2019-12-19 22:24:24', NULL),
(18, 18, 19, 3, 60350.00, '2019-12-19 23:18:04', '2019-12-19 23:18:36', NULL),
(19, 19, 20, 3, 112000.00, '2019-12-19 23:27:27', '2019-12-19 23:27:27', NULL),
(20, 20, 21, 3, 99400.00, '2019-12-19 23:33:14', '2019-12-19 23:33:14', NULL),
(21, 21, 22, 3, 216000.00, '2019-12-19 23:41:58', '2019-12-19 23:41:58', NULL),
(22, 22, 23, 3, 100800.00, '2019-12-20 00:27:46', '2019-12-20 00:27:46', NULL),
(23, 23, 2, 1, 0.00, '2019-12-20 13:50:08', '2019-12-20 13:50:08', NULL),
(24, 24, 24, 3, 142000.00, '2019-12-27 00:17:14', '2019-12-27 00:17:14', NULL),
(25, 25, 25, 3, 49300.00, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL);

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
(1, 0, 23, 1, 'test', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>', 0, '', '2019-12-20 19:02:41', '2019-12-20 19:02:41', NULL),
(2, 0, 23, 1, 'test', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>test</li>\r\n	<li>test</li>\r\n	<li>test</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tt</li>\r\n</ul>\r\n\r\n<p>setse</p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>\r\n\r\n<p>&nbsp;</p>', 0, '', '2019-12-20 19:06:02', '2019-12-20 19:06:02', NULL),
(3, 0, 23, 1, 'Test Note', '<ul>\r\n	<li>\r\n	<h2>Test123</h2>\r\n	</li>\r\n	<li>123test</li>\r\n	<li>another</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0, '', '2019-12-20 19:15:35', '2019-12-20 19:15:48', '2019-12-20 19:15:48'),
(4, 0, 20, 1, 'UCC\'s updates needed', '<p>I asked Randy to please get the following updates.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>&nbsp;&nbsp;&nbsp;CerCo Inc-&nbsp;127 Dale St, West Babylon, NY 11704</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Electro-Motive Diesel- 9301 W. 55th St.&nbsp;LaGrange, IL 60525&nbsp;</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gentherm-&nbsp;21680 Haggerty Road,&nbsp;Northville, MI 48167</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hercules Engine Components- 2770 South Erie St, Massillon, OH 44646</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invacare Corp.-&nbsp;1 Invacare Way&nbsp;Elyria, OH 44035-4190</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jeld-Wen Windows-&nbsp;<a href=\"mailto:investors@jeldwen.com\" target=\"_blank\">investors@jeldwen.com</a></li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mast Powertrain LLC-&nbsp;330 Nw Stallings Drive,&nbsp;Nacogdoches,&nbsp;TX&nbsp;75964&nbsp;</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nordson Corporation-&nbsp;28601 Clemens Road,&nbsp;Westlake, OH 44145 USA</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Omni Die Casting, Inc.-&nbsp;1100 Nova Dr. SE, Massillon, OH 44646</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quality Glass Block-&nbsp;1347 East St, Morris, IL 60450</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ritchey Livestock ID 13821 Sable Boulevard, Brighton, Colorado 80601</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seves Glass Block Inc.-<strong>&nbsp;</strong>10576 Broadview Road, Broadview Heights, Ohio 44147</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tri-Flex of Ohio, Inc-&nbsp;2701 Applegrove Street Nw,&nbsp;North Canton,&nbsp;OH&nbsp;44720&nbsp;</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Progress Rail Services- 1600 Progress DriveP.O. Box 1037Albertville,&nbsp;AL&nbsp;35950</li>\r\n</ul>', 0, '', '2019-12-21 03:00:04', '2019-12-21 03:00:04', NULL);

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
(2, 'Company User (MCA)', '2019-05-29 12:25:12', '2019-12-10 20:37:05', NULL),
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
(1, 1, 'Admin', 'Admin', 'Admin', '09279983995', NULL, NULL, 'admin', 'bryann.revina@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, '0723844514a8e149966354f21b337c34.jpg', 0, NULL, '2019-05-11 11:03:15', '2019-12-27 08:19:51', NULL, '2019-12-27 02:19:51', NULL),
(2, 1, 'bonn', 'Bonn', 'Mendoza', '123456789', '123456', '1234t', 'bonn22', 'bonnmendoza@gmail.com', NULL, '$2y$10$JJOEM2xTebk3IXslpT.K0u8a4j2Jmau5HTgCDWgvW8g0yihsBBPGS', NULL, NULL, 0, NULL, '2019-12-07 17:04:58', '2019-12-07 17:04:58', NULL, NULL, NULL),
(3, 1, NULL, 'Carolina', 'Alcaraz', '(646) 766-8010', '(646) 766-8010', '(646) 766-8010', 'calcaraz', 'calcaraz@rtrrecoveryllc.com', NULL, '$2y$10$Y815uoLMilwnWbtH2/ETMuAh/X9/tYu2qbwMYLsWcd1oEfwTRqABi', NULL, 'no-image.png', 0, NULL, '2019-12-09 21:44:16', '2019-12-27 00:36:42', NULL, '2019-12-26 18:03:47', NULL),
(4, 4, 'Kem', 'Kemery', 'Brisso', '347-321-9537', '347-321-9537', NULL, 'kbrisso', 'admin@capcallllc.com', NULL, '$2y$10$u/yDktEwfR1SPcYteZxTvePSk4wOw7Z56GZKuw4amWJDAuW3rkhFa', NULL, NULL, 0, NULL, '2019-12-17 05:42:52', '2019-12-19 02:47:47', NULL, NULL, NULL),
(5, 4, 'Nerissa', 'Nerissa', 'Thomas', '718-775-3921', NULL, NULL, 'nthomas', 'nthomas@rtrrecoveryllc.com', NULL, '$2y$10$9x69Bkp5.tdiV9wT5P3jz.63sdMwhhizodaAyctOEaNZ9jP4hFRI6', NULL, NULL, 0, NULL, '2019-12-17 05:44:21', '2019-12-23 22:43:44', NULL, '2019-12-23 16:43:44', NULL),
(6, 4, 'Jen', 'Jeniel', 'Mangahis', '6463090599', '123123123', '012312312', 'jeniel123', 'jeniel.mangahis@gmail.com', NULL, '$2y$10$HujgTX2OJPfLteCloR81n.LxAprXSjoQC8yHf8lpn9osZj3AE9Th.', NULL, NULL, 0, NULL, '2019-12-20 13:31:51', '2019-12-27 08:09:55', NULL, '2019-12-27 02:09:55', NULL),
(7, 2, 'Jeniel', 'Test jeniel', 'Test last', '2123123', '123123213', '12312312', 'jen123', 'jeniel.mangahis.test@gmail.com', NULL, '$2y$10$8iLJKnrjsgxhZXk4t9rhjuhWdSWU.3Eb1HZdiDo/yq6ckngxYDfS2', NULL, NULL, 0, NULL, '2019-12-20 19:34:51', '2019-12-20 19:34:51', NULL, NULL, NULL),
(8, 1, NULL, 'Douglas', 'Robinson', '(718) 775-3673', '(718) 775-3673', '(718) 775-3673', 'drobinson', 'drobinson@rtrrecoveryllc.com', NULL, '$2y$10$OE7SARDydvYFwozmNSylYOIdCfixeBcjqhv1DIkDkccRkGBK2Bdh.', NULL, NULL, 0, NULL, '2019-12-21 03:10:04', '2019-12-21 03:10:04', NULL, NULL, NULL),
(9, 4, NULL, 'Randy', 'Hamilton', '(718)-775-3363', '(718)-775-3363', '(718)-775-3363', 'rhamilton', 'rhamilton@rtrrecoveryllc.com', NULL, '$2y$10$.NdzHpydX06skGk86QjDTOrYy26czC2SH4ymgvg9YlorZO6fZVZ5m', NULL, NULL, 0, NULL, '2019-12-21 03:11:26', '2019-12-21 03:11:26', NULL, NULL, NULL),
(10, 4, NULL, 'Ashley', 'Bristol', '(646) 766-8010', '(646) 766-8010', '(646) 766-8010', 'abristol', 'abristol@rtrrecoveryllc.com', NULL, '$2y$10$ovX3k45uEe2dac0yGWmz3OjBewQKWQpWqj8mha2/9dIpQKTSPj7Rq', NULL, NULL, 0, NULL, '2019-12-21 03:16:06', '2019-12-21 03:16:06', NULL, NULL, NULL),
(11, 4, NULL, 'Tamara', 'Rodney', '(718) 775-3728', '(718) 775-3728', '(718) 775-3728', 'trodney', 'trodney@rtrrecoveryllc.com', NULL, '$2y$10$MHM0ntSCmgxJOp3HHjlWauThoxqhm3uGCUMJtSf.TWShK0/Doye3K', NULL, NULL, 0, NULL, '2019-12-21 03:19:25', '2019-12-21 03:19:25', NULL, NULL, NULL),
(13, 1, NULL, 'Jason', 'Leak', '718-775-3743', NULL, NULL, 'jleak', 'Jleak@capcallllc.com', NULL, '$2y$10$2CtGCtnBQnEV7WPkpJOFfOCZqzvJWUGkkaHZnOFW9kiazveX/gvre', NULL, NULL, 0, NULL, '2019-12-21 03:55:37', '2019-12-21 03:55:37', NULL, NULL, NULL),
(14, 1, NULL, 'Intern', 'Intern', '646-766-8010', NULL, NULL, 'eheng@rtrrecoveryllc.com', 'eheng@rtrrecoveryllc.com', NULL, '$2y$10$97jVHLDQdXg3.hQzQDvYrOTJezQIgyxnkAUtVPNT4RuuAPM24lOzG', NULL, NULL, 0, NULL, '2019-12-27 00:39:07', '2019-12-27 00:40:49', NULL, '2019-12-26 18:40:49', NULL);

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
(1, 1, 1, 'Bankrupt', '#ff0000', '2019-11-27 14:44:19', '2019-12-06 18:52:55', NULL),
(2, 1, 1, 'Payment Plan', '#00ff00', '2019-11-27 14:46:22', '2019-12-06 18:53:17', NULL),
(3, 1, 1, 'Collections', '#ffff00', '2019-11-27 14:47:00', '2019-12-06 18:53:56', NULL),
(4, 1, 1, 'Legal', '#ffa500', '2019-11-27 14:47:46', '2019-12-06 18:54:56', NULL),
(5, 1, 1, 'Outside Counsel', '#ff69b4', '2019-11-27 14:48:52', '2019-12-06 18:55:25', NULL),
(6, 1, 1, 'Settled', '#0000ff', '2019-11-27 14:51:37', '2019-12-06 18:57:09', NULL),
(7, 1, 3, 'Bankrupt', '#ff0000', '2019-11-27 14:55:04', '2019-12-06 18:57:40', NULL),
(8, 1, 3, 'Payment Plan', '#00ff00', '2019-11-27 14:55:45', '2019-12-06 18:58:09', NULL),
(9, 1, 3, 'Collections', '#ffff00', '2019-11-27 14:56:51', '2019-12-06 18:58:33', NULL),
(10, 1, 3, 'Legal', '#ffa500', '2019-11-27 14:59:56', '2019-12-06 18:58:59', NULL),
(11, 1, 3, 'Outside Counsel', '#ff69b4', '2019-11-27 15:01:02', '2019-12-06 18:59:36', NULL),
(12, 1, 3, 'Settled', '#0000ff', '2019-11-27 15:01:53', '2019-12-06 19:00:05', NULL),
(13, 1, 2, 'Bankrupt', '#ff0000', '2019-11-27 15:05:41', '2019-12-06 19:00:35', NULL),
(14, 1, 2, 'Payment Plan', '#00ff00', '2019-11-27 15:06:50', '2019-12-06 19:01:01', NULL),
(15, 1, 2, 'Collections', '#ffff00', '2019-11-27 15:07:27', '2019-12-06 19:02:00', NULL),
(16, 1, 2, 'Legal', '#ffa500', '2019-11-27 15:09:56', '2019-12-06 19:02:35', NULL),
(17, 1, 2, 'Outside Counsel', '#ff69b4', '2019-11-27 15:11:27', '2019-12-06 19:03:29', NULL),
(18, 1, 2, 'Settled', '#0000ff', '2019-11-27 15:11:54', '2019-12-06 19:04:27', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact_advances`
--
ALTER TABLE `contact_advances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_advance_financial_bank_statement_records`
--
ALTER TABLE `contact_advance_financial_bank_statement_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_advance_funding_info`
--
ALTER TABLE `contact_advance_funding_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_advance_merchant_statement_records`
--
ALTER TABLE `contact_advance_merchant_statement_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_advance_participation`
--
ALTER TABLE `contact_advance_participation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_advance_payments`
--
ALTER TABLE `contact_advance_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_advance_underwriter_notes`
--
ALTER TABLE `contact_advance_underwriter_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_assigned_users`
--
ALTER TABLE `contact_assigned_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `contact_bank_accounts`
--
ALTER TABLE `contact_bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_broker_informations`
--
ALTER TABLE `contact_broker_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact_business_informations`
--
ALTER TABLE `contact_business_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact_call_trackers`
--
ALTER TABLE `contact_call_trackers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_campaigns`
--
ALTER TABLE `contact_campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_credit_cards`
--
ALTER TABLE `contact_credit_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_custom_fields`
--
ALTER TABLE `contact_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_datasource`
--
ALTER TABLE `contact_datasource`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_docs`
--
ALTER TABLE `contact_docs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_events`
--
ALTER TABLE `contact_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_history`
--
ALTER TABLE `contact_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_loan_informations`
--
ALTER TABLE `contact_loan_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact_notes`
--
ALTER TABLE `contact_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_tasks`
--
ALTER TABLE `contact_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_users`
--
ALTER TABLE `contact_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_types`
--
ALTER TABLE `media_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
