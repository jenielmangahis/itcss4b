-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2020 at 12:38 AM
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
(3, 'perfect harvest inc', '520-980-0896', NULL, NULL, NULL, 1, '2019-12-10 23:47:38', '2019-12-31 04:01:14', NULL),
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
(25, 'Top Mop Inc', '9177807463', NULL, NULL, NULL, 1, '2019-12-27 00:20:22', '2019-12-27 00:20:22', NULL),
(26, 'coordinated logistics transportation llc', '6022004496', NULL, NULL, NULL, 1, '2019-12-28 00:31:23', '2019-12-28 00:31:23', NULL),
(27, 'GVB Holdings LLC', '8175764441', NULL, NULL, NULL, 1, '2019-12-28 01:29:54', '2019-12-28 01:29:54', NULL),
(28, 'NAS TRADING INC.', '9494660788', NULL, NULL, NULL, 0, '2019-12-28 01:57:49', '2019-12-28 01:57:49', NULL),
(29, 'Neighborhood Market', '6157665506', NULL, NULL, NULL, 0, '2019-12-28 03:21:46', '2019-12-28 03:21:46', NULL),
(30, 'Pine Knot Guest Ranch', '9088666500', NULL, NULL, NULL, 1, '2019-12-28 03:40:13', '2019-12-28 03:40:13', NULL),
(31, 'Seamus Collins Contruction INC', '4157864909', NULL, NULL, NULL, 1, '2019-12-28 04:03:14', '2019-12-28 04:03:14', NULL),
(32, 'The Northwest Capital Builders,INC', '3012831256', NULL, NULL, NULL, 1, '2019-12-28 04:24:35', '2019-12-28 04:24:35', NULL),
(33, 'T & C  LLC', '720-620-0439', NULL, NULL, NULL, 1, '2019-12-31 00:04:11', '2019-12-31 00:04:11', NULL),
(34, 'Vargas Transportation', '9153162845', NULL, NULL, NULL, 1, '2019-12-31 00:08:50', '2019-12-31 00:08:50', NULL),
(35, 'Ernies Pool Service LLC', '2033711045', NULL, NULL, NULL, 1, '2019-12-31 00:19:18', '2019-12-31 00:19:18', NULL),
(36, 'Bigfoot Bites Inc', '8582078242', NULL, NULL, NULL, 1, '2019-12-31 00:41:04', '2019-12-31 00:41:04', NULL),
(37, 'Nail Tek LLC', '205879337', NULL, NULL, NULL, 1, '2019-12-31 00:46:19', '2019-12-31 00:46:19', NULL),
(38, '360 DEGREES OF PERFECTON', '303-422-0406', NULL, NULL, NULL, 1, '2019-12-31 01:06:08', '2019-12-31 01:06:08', NULL),
(39, 'ARIKA FOOD ENTERPRISES INC DBA HOUSE OF CURRIES', '(510) 848-5800', NULL, NULL, NULL, 1, '2019-12-31 01:31:30', '2019-12-31 01:31:30', NULL),
(40, 'AUTO GLAM DETAIL LLC', '615-556-8168', NULL, NULL, NULL, 1, '2019-12-31 02:06:19', '2019-12-31 02:06:19', NULL),
(41, 'Gun Gear to Go LLC', '9283254267', NULL, NULL, NULL, 1, '2019-12-31 02:17:52', '2019-12-31 02:17:52', NULL),
(42, 'CW PAINTING & HOME IMPROVEMENTS INC', '404) 925-3511', NULL, NULL, NULL, 1, '2019-12-31 02:24:21', '2019-12-31 02:24:21', NULL),
(43, 'TEXAS MOTION FURNITURE', '(936) 756-2300', NULL, NULL, NULL, 1, '2019-12-31 02:33:22', '2019-12-31 02:33:22', NULL),
(44, 'DMKA dba The Smarter Merchant LLC', '646-766-8010', NULL, NULL, NULL, 0, '2019-12-31 02:46:23', '2019-12-31 02:46:23', NULL),
(45, 'BEDI TRANSPORT INC', '307-684-2356', NULL, NULL, NULL, 1, '2019-12-31 03:12:25', '2019-12-31 03:12:25', NULL),
(46, 'GULF COAST AUDIO VIDEO LLC', '9283254267', NULL, NULL, NULL, 1, '2019-12-31 03:18:21', '2019-12-31 03:18:21', NULL),
(47, 'DAWSON-DODD INC DBA DAWSON-DODD HEATING & COOLING', 'PATRICK JOHN DAWSON', NULL, NULL, NULL, 1, '2019-12-31 03:28:42', '2019-12-31 03:28:42', NULL),
(48, 'Villa\'s Consulting iNC.', '520-270-5909', NULL, NULL, NULL, 1, '2019-12-31 03:40:16', '2019-12-31 03:40:16', NULL),
(49, 'Burger King', '6093814969', NULL, NULL, NULL, 1, '2019-12-31 03:56:05', '2019-12-31 03:56:05', NULL),
(50, 'OLD HAGS PIZZA AND PASTA', '(214) 941-8080', NULL, NULL, NULL, 1, '2019-12-31 04:00:52', '2019-12-31 04:00:52', NULL),
(51, 'COHESIVE DESIGN PARTNERS INC', '2017415233', NULL, NULL, NULL, 1, '2019-12-31 04:09:04', '2019-12-31 04:09:04', NULL),
(52, 'DWT RENOVATIONS', '8643952754', NULL, NULL, NULL, 1, '2019-12-31 04:43:07', '2019-12-31 04:43:07', NULL),
(53, 'Tolley & Lowe, Inc', '7316358569', NULL, NULL, NULL, 1, '2019-12-31 22:45:55', '2019-12-31 22:45:55', NULL),
(54, 'DK DWELLINGS LLC', '3177096986', NULL, NULL, NULL, 1, '2019-12-31 22:51:05', '2019-12-31 22:51:05', NULL),
(55, 'ELEVATION AUTOMOTIVE LLC', '720-465-9332', NULL, NULL, NULL, 1, '2019-12-31 23:45:29', '2019-12-31 23:45:29', NULL),
(56, 'EURO FLOORING INC DBA EURO FLOORING & STONE', '720-938-0440', NULL, NULL, NULL, 1, '2020-01-01 00:02:00', '2020-01-01 00:02:00', NULL),
(57, 'Jeremiah Capital Investments, LLC', '307-684-2356', NULL, NULL, NULL, 1, '2020-01-02 22:37:31', '2020-01-02 22:37:31', NULL),
(58, 'Villas Consulting Inc', '520-270-5909', NULL, NULL, NULL, 1, '2020-01-02 22:43:31', '2020-01-02 22:43:31', NULL),
(59, 'Countrywide Distributors', '516-277-1380', NULL, NULL, NULL, 1, '2020-01-02 22:51:23', '2020-01-02 22:51:23', NULL),
(60, 'Rental Depot', '865-680-1417', NULL, NULL, NULL, 1, '2020-01-02 23:05:08', '2020-01-02 23:05:08', NULL),
(61, 'JAYALAXMI INC DBA MANHATTAN BAGEL', '302-326-0554', NULL, NULL, NULL, 1, '2020-01-02 23:06:42', '2020-01-02 23:06:42', NULL),
(62, 'Organic Delight', '323-975-2571', NULL, NULL, NULL, 1, '2020-01-02 23:13:13', '2020-01-02 23:13:13', NULL),
(63, 'PENIEL TRANSIT INC', '662-417-8905', NULL, NULL, NULL, 1, '2020-01-02 23:18:07', '2020-01-02 23:18:07', NULL),
(64, 'PLANTLAB, LLC / VEER LIVING, LLC', '9176839177', NULL, NULL, NULL, 1, '2020-01-02 23:25:29', '2020-01-02 23:25:29', NULL),
(65, 'Browns Roofing', '763-450-6673', NULL, NULL, NULL, 1, '2020-01-02 23:36:37', '2020-01-02 23:36:37', NULL),
(66, 'RANKIN LYMAN', '347-952-9513', NULL, NULL, NULL, 1, '2020-01-02 23:39:44', '2020-01-02 23:39:44', NULL),
(67, 'SALLY WILLIAMSON & ASSOCIATES, INC.', '404-831-2326', NULL, NULL, NULL, 1, '2020-01-02 23:58:37', '2020-01-02 23:58:37', NULL),
(68, 'Jagbe Electronics', '516-315-1425', NULL, NULL, NULL, 1, '2020-01-03 00:06:35', '2020-01-03 00:06:35', NULL),
(69, 'SPIRIT LEATHERWORKS LLC', '541-953-9586', NULL, NULL, NULL, 1, '2020-01-03 00:10:05', '2020-01-03 00:10:05', NULL),
(70, 'SS VENTURES', '323-436-9866', NULL, NULL, NULL, 1, '2020-01-03 00:22:46', '2020-01-03 00:22:46', NULL),
(71, 'Roc Funding LLC', '646-766-8010', NULL, NULL, NULL, 0, '2020-01-03 00:55:16', '2020-01-03 00:55:16', NULL),
(72, 'XCPCNL MAINTENANCE, LLC', '214-998-0178', NULL, NULL, NULL, 1, '2020-01-03 01:07:16', '2020-01-03 01:07:16', NULL),
(73, 'Niagara Logistics', '855-676-6687', NULL, NULL, NULL, 1, '2020-01-03 02:03:03', '2020-01-03 02:03:03', NULL),
(74, 'Quick Repair', '619-440-4424', NULL, NULL, NULL, 1, '2020-01-03 02:43:42', '2020-01-03 02:43:42', NULL),
(75, 'TNT Dairy', '989-148-9057', NULL, NULL, NULL, 1, '2020-01-03 02:57:14', '2020-01-03 02:57:14', NULL),
(76, 'Eagle Drive Inn', '417-623-2228', NULL, NULL, NULL, 1, '2020-01-03 03:03:37', '2020-01-03 03:03:37', NULL),
(77, 'One world imprint', '408-858-9464', NULL, NULL, NULL, 1, '2020-01-03 03:09:43', '2020-01-03 03:09:43', NULL),
(78, 'PANCHO GATEWAY FIFTH AVENUE LLC', '646-741-5281', NULL, NULL, NULL, 1, '2020-01-03 03:33:45', '2020-01-03 03:33:45', NULL),
(79, 'Dream Car Gallery', '855-676-6687', NULL, NULL, NULL, 1, '2020-01-03 03:43:48', '2020-01-03 03:43:48', NULL),
(80, 'DUDEJI, INC.', '(714) 878-5282', NULL, NULL, NULL, 1, '2020-01-03 03:50:19', '2020-01-03 03:50:19', NULL),
(81, 'BC PLUMBING LLC', '(720) 416-3319', NULL, NULL, NULL, 1, '2020-01-03 03:57:13', '2020-01-03 03:57:13', NULL),
(82, 'Grand Glass', '310-980-8497', NULL, NULL, NULL, 0, '2020-01-03 03:57:34', '2020-01-03 03:57:34', NULL),
(83, 'AT HOME INC', '(610) 820-8301', NULL, NULL, NULL, 1, '2020-01-03 04:10:45', '2020-01-03 04:10:45', NULL),
(84, 'Chic Boutique', '914-525-9047', NULL, NULL, NULL, 1, '2020-01-03 04:17:21', '2020-01-03 04:17:21', NULL),
(85, 'Marquez Auto Repair', '847-385-8687', NULL, NULL, NULL, 1, '2020-01-03 04:46:41', '2020-01-03 04:46:41', NULL),
(86, 'Buy Tire Wholesale', '(928) 713-8826', NULL, NULL, NULL, 1, '2020-01-03 04:56:15', '2020-01-03 04:56:15', NULL);

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
(1, 2, 7, '2019-12-20 19:34:51', '2019-12-21 03:05:19', '2019-12-21 03:05:19'),
(2, 44, 16, '2019-12-31 02:48:03', '2019-12-31 02:48:20', NULL),
(3, 71, 17, '2020-01-03 01:00:38', '2020-01-03 01:00:38', NULL);

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
(2, 2, 1, 3, '8', 'Rocky Kibrew', 'Rocky', 'Kibrew', 'rkibrew@yahoo.com', '302-270-9105', NULL, NULL, NULL, NULL, NULL, '3597 Cobbs Hill Rd', NULL, 'willards', 'MD', '21874', NULL, '2019-12-09 23:56:21', '2020-01-02 14:40:16', NULL),
(3, 3, 3, 3, '8', 'Jorge Mercado', 'Jorge', 'Mercado', 'jorge@perfectharvest.com', '520-281-5717', '520-281-5717', '520-281-5717', NULL, NULL, NULL, '825 N Grand Ave', NULL, 'Nogales', 'AZ', '85621', NULL, '2019-12-10 23:53:25', '2019-12-13 22:15:06', NULL),
(4, 4, 3, 3, '8', 'Andrew Pittington', 'Andrew', 'Pittington', 'apittington@pittingtoncounseling.com', '407-506-9737', '407-330-5060', NULL, NULL, NULL, NULL, '142 West Lakeview Ave. Suite 2010', NULL, 'Lake Mary', 'Florida', '32746-6320', NULL, '2019-12-13 03:56:37', '2019-12-13 04:28:40', NULL),
(5, 5, 3, 3, '8', 'Allen YU', 'Allen', 'YU', 'allenyu1@me.com', '917-435-8552', '917-435-8552', NULL, NULL, NULL, NULL, '10 Manhattan Ave. 1st flr', '2110 1st Ave.', 'new york', 'new york', '10025', '<p>Banking with Chase AS OF 11/1/2019 $160.21<br />\r\nOther Cash Advances:<br />\r\n 1GLOBAL CAPITALF ACH<br />\r\nReceivables:<br />\r\n Metro Hasting Company LLC<br />\r\n LRP 529 EAST 83 RD Street LLC<br />\r\nAshley please send UCCs to Amex, PayPal, Square and other receivables<br />\r\nStephanie please send Bank runs to Chase, Capital One, WF, BOA, HSBC, TD Bank, Bank of Hope, Woori<br />\r\nAmerica Bank, Hanmi Bank, Investors Bank, Citibank, Flushing Bank, Santander, Sterling National bank,<br />\r\nAlma Bank, BNB Bank, Queens County Savings Bank, PNC, Dime Community Bank, Apple Bank, East<br />\r\nWest Bank, Cathay Bank, Chinatown Federal Savings, First Republic Bank, Valley bank, and United<br />\r\nOrient Bank<br />\r\nPLEASE USE BOTH EIN#45-4734520, 82-3571753<br />\r\nSSN#075-82-5591<br />\r\n11/6/19 Square- No Accounts<br />\r\n11/21 Alma Bank- No Accounts<br />\r\n11/22 Square- No Accounts<br />\r\nMetro Hasting Company LLC<br />\r\nSpoke to Maria over the phone she doesn&rsquo;t remember any amaco company. Bank statements sent</p>', '2019-12-13 04:28:11', '2019-12-28 01:29:10', NULL),
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
(25, 25, 3, 3, '7', 'Anastasiya Khomyakova', 'Anastasiya', 'Khomyakova', 'topmopnyc@gmail.com', '9177807463', NULL, NULL, NULL, NULL, NULL, '85 delancey st ste 8', NULL, 'new york', 'NY', '10002', NULL, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(26, 26, 15, 3, '10', 'Eric thomas Whitmoyer', 'Eric thomas', 'Whitmoyer', 'ERIC_WHITMOYER@hotmail.com', '6022004496', NULL, NULL, NULL, NULL, NULL, '2622east palm beach drive', NULL, 'chandler', 'az', '85249', NULL, '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(27, 27, 15, 3, '10', 'Bradley clinton Crawford', 'Bradley clinton', 'Crawford', 'noname@gmail.com', '8175764441', NULL, NULL, NULL, NULL, NULL, '4455camp bowie blvd ste 114', NULL, 'fort worth', 'tx', '76107', NULL, '2019-12-28 01:51:33', '2019-12-28 01:51:33', NULL),
(28, 28, 15, 3, '10', 'Maha Neweila', 'Maha', 'Neweila', 'noname@gmail.com', '9494660788', NULL, NULL, NULL, NULL, NULL, '421 N. Brookhurst St.Ste 120', NULL, 'Anahiem', 'CA', '92801', NULL, '2019-12-28 02:16:45', '2019-12-28 02:16:45', NULL),
(29, 29, 15, 3, '10', 'Nafeth Abdrabou', 'Nafeth', 'Abdrabou', 'maannafetha@yahoo.com', '6157665506', NULL, NULL, NULL, NULL, NULL, '2600 clarksville pike', NULL, 'nashville', 'TN', '37208', NULL, '2019-12-28 03:34:04', '2019-12-28 03:34:04', NULL),
(30, 29, 15, 3, '10', 'Nafeth Abdrabou', 'Nafeth', 'Abdrabou', 'maannafetha@yahoo.com', '6157665506', NULL, NULL, NULL, NULL, NULL, '2600 clarksville pike', NULL, 'nashville', 'TN', '37208', NULL, '2019-12-28 03:34:05', '2019-12-28 03:34:36', '2019-12-28 03:34:36'),
(31, 30, 15, 3, '10', 'Larry Perez', 'Larry', 'Perez', 'pineknotguestranch@yahho.com', '9088666500', NULL, NULL, NULL, NULL, NULL, '908 Pine Knot Ave', NULL, 'Big Bear Lake', 'CA', '92315', NULL, '2019-12-28 03:52:40', '2019-12-31 00:09:03', '2019-12-31 00:09:03'),
(32, 30, 15, 3, '10', 'Larry Perez', 'Larry', 'Perez', 'pineknotguestranch@yahoo.com', '9088666500', NULL, NULL, NULL, NULL, NULL, '908 pine Knot Ave', NULL, 'Big Bear Lake', 'CA', '92315', NULL, '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(33, 31, 15, 3, '10', 'Seamus Collins', 'Seamus', 'Collins', 'pallasmore@gmail.com', '4157864909', NULL, NULL, NULL, NULL, NULL, '2046 43rd Ave', NULL, 'San Francisco', 'CA', '94116', NULL, '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(34, 32, 15, 3, '10', 'Arshad Zamam Kundi', 'Arshad Zamam', 'Kundi', 'noemail@gmail.com', '3012831256', NULL, NULL, NULL, NULL, NULL, '18777N. Frederick Ave,Suite F', NULL, 'Gaidersburg', 'MD', '20879-3157', NULL, '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(35, 34, 3, 1, '1', 'Claudia Saenz', 'Claudia', 'Saenz', 'claudia@vargastransportation.com', '9153162845', NULL, NULL, NULL, NULL, NULL, '9611 acer', NULL, 'el paso', 'texas', '79925', NULL, '2019-12-31 00:14:08', '2019-12-31 00:14:08', NULL),
(36, 35, 3, 3, '7', 'Ernest Turey', 'Ernest', 'Turey', 'noemail@gmail.com', '2032185837', NULL, NULL, NULL, NULL, NULL, '2231 Easton Turnpike', NULL, 'fairfield', 'ct', '32935', NULL, '2019-12-31 00:37:43', '2019-12-31 00:37:43', NULL),
(37, 36, 3, 3, '7', 'Dawane Harris', 'Dawane', 'Harris', 'dawane@bigfootbites.com', '5412204302', NULL, NULL, NULL, NULL, NULL, '1112 s main st', NULL, 'lebanon', 'or', '97355', NULL, '2019-12-31 00:45:12', '2019-12-31 00:45:12', NULL),
(38, 37, 3, 3, '7', 'Tuan Trinh', 'Tuan', 'Trinh', 'tuanhtrinh@yahoo.com', '2058793377', NULL, NULL, NULL, NULL, NULL, '600 old english lane #120', NULL, 'Mountain Brook', 'AL', '35223', NULL, '2019-12-31 00:51:00', '2019-12-31 00:51:00', NULL),
(39, 38, 4, 1, '6', 'RICHARD E HOAG', 'RICHARD E', 'HOAG', 'contact@360degreesofperfection.com', '814-636-2240', '303-422-0406', NULL, NULL, NULL, NULL, '3945 INDIANA CT #600', NULL, 'ARVADA', 'CO', '80007', NULL, '2019-12-31 01:24:51', '2019-12-31 01:24:51', NULL),
(40, 39, 4, 3, '10', 'QUDSIA NUDRAT', 'QUDSIA', 'NUDRAT', 'qudsianudrat@gmail.com', '(510) 848-5800', '(510) 848-5800', NULL, NULL, NULL, NULL, '2520 Durant Ave,', NULL, 'Berkeley', 'CA', '94704', NULL, '2019-12-31 01:50:46', '2019-12-31 01:50:46', NULL),
(41, 41, 3, 3, '7', 'Richard Hall', 'Richard', 'Hall', 'noemail@gmail.com', '9283254267', NULL, NULL, NULL, NULL, NULL, '721 N  Central Expy suite 436', NULL, 'plano', 'tx', '75075', NULL, '2019-12-31 02:22:24', '2019-12-31 02:22:24', NULL),
(42, 40, 4, 3, '10', 'JASON ALLEN BOGARD', 'JASON ALLEN', 'BOGARD', 'jbo852003@gmail.com', '615-648-1508', '615-556-5168', NULL, NULL, NULL, NULL, '1501 NW BROAD STREET', NULL, 'MURFREESBORO', 'TN', '37129', NULL, '2019-12-31 02:23:08', '2019-12-31 02:23:08', NULL),
(43, 42, 3, 3, '7', 'William Woodruff', 'William', 'Woodruff', 'noemail@gmail.com', '404 925-3511', NULL, NULL, NULL, NULL, NULL, '1964 MYRTLE DR NE', NULL, 'MARIETTA', 'GA', '30066-2024', NULL, '2019-12-31 02:30:52', '2019-12-31 02:30:52', NULL),
(44, 43, 3, 3, '7', 'Brandt Maples', 'Brandt', 'Maples', 'brandt@texasmotionfurniture.com', '(936) 756-2300', NULL, NULL, NULL, NULL, NULL, '1906 N Frazier St', NULL, 'Conroe', 'TX', '77301', NULL, '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(45, 46, 3, 3, '7', 'Walthew Reardon', 'Walthew', 'Reardon', 'wreardon@bellsouth.net', '(228) 385-6649', NULL, NULL, NULL, NULL, NULL, '1955 Popps Ferry Rd #112888', NULL, 'Biloxi', 'MS', '39532', NULL, '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(46, 45, 4, 3, '10', 'VARINDER BEDI', 'VARINDER', 'BEDI', 'vbedi@protonmail.com', '661-304-0777', NULL, NULL, NULL, NULL, NULL, '5046 W AMHERST AVE', NULL, 'FRESNO', 'CA', '93722', NULL, '2019-12-31 03:24:54', '2019-12-31 03:24:54', NULL),
(47, 33, 3, 3, '10', 'Corey Basquez', 'Corey', 'Basquez', 'corey.basquez@gmail.com', '720-620-0439', '720-620-0439', NULL, NULL, NULL, NULL, '7476 S. Eagle Street, Suite E', NULL, 'Centennial', 'Colorado', '80112', NULL, '2019-12-31 03:31:23', '2019-12-31 03:55:00', NULL),
(48, 47, 4, 3, '7', 'PATRICK JOHN DAWSON DODD', 'PATRICK JOHN DAWSON', 'DODD', 'john@dawson-dodd.com', '314-575-4191', '314-575-4178', NULL, NULL, NULL, NULL, '9000 WATSON RD', NULL, 'SAINT LOUIS', 'MO', '63126', NULL, '2019-12-31 03:41:07', '2019-12-31 03:41:07', NULL),
(49, 49, 3, 3, '7', 'Eric Salisbury', 'Eric', 'Salisbury', 'smsenter@aol.com', '6093814969', NULL, NULL, NULL, NULL, NULL, 'PO BOX 588', NULL, 'MARLTON', 'NJ', '08053-0588', NULL, '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(50, 50, 3, 3, '7', 'LINDSEY MICHAEL', 'LINDSEY', 'MICHAEL', 'mjlindsey@oldhagspizza.com', '(214) 941-8080', NULL, NULL, NULL, NULL, NULL, '1315 W Davis St,', NULL, 'Dallas', 'TX', '75208', NULL, '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(51, 51, 3, 3, '7', 'Biggy Joseph', 'Biggy', 'Joseph', 'jbiggy@cohesivejewels.com', '2017415233', NULL, NULL, NULL, NULL, NULL, '27 W 20TH ST STE 1002', NULL, 'NEW YORK', 'NY', '10011-3724', NULL, '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(52, 53, 3, 3, '11', 'Jeffery Tolley', 'Jeffery', 'Tolley', 'tolleyandlowe@hotmail.com', '7316358569', NULL, NULL, NULL, NULL, NULL, '30 Mullins Lane', NULL, 'Milan', 'TN', '38358', NULL, '2019-12-31 22:56:25', '2019-12-31 22:56:25', NULL),
(53, 54, 4, 3, '10', 'ROGER ALAN KLINGER', 'ROGER ALAN', 'KLINGER', 'ROGERKLINGER@DKDWELLINGS.COM', '517-709-6986', '317-704-6980', NULL, NULL, NULL, NULL, '2979 KINGS COURT', NULL, 'CARMEL', 'IN', '46032', NULL, '2019-12-31 23:05:03', '2019-12-31 23:05:03', NULL),
(54, 55, 4, 3, '10', 'SHAUN GROSSNICKLE', 'SHAUN', 'GROSSNICKLE', 'elevationautollc@gmail.com', '720-429-6038', '720-519-8465', NULL, NULL, NULL, NULL, '5905 S NEPAL ST', NULL, 'ENGLEWOOD', 'CO', '80015', NULL, '2019-12-31 23:49:46', '2019-12-31 23:49:46', NULL),
(55, 56, 4, 3, '10', 'ADNAN CAVICIC', 'ADNAN', 'CAVICIC', 'ADNAN.EUROFLOORING@GMAIL.COM', '720-938-0440', NULL, NULL, NULL, NULL, NULL, '5951 MARION DR #', NULL, 'DENVER', 'CO', '80216', NULL, '2020-01-01 00:30:08', '2020-01-01 00:30:08', NULL),
(56, 58, 3, 3, '10', 'Sylvia Villa', 'Sylvia', 'Villa', 'Villas@msn.com', '520-270-5909', NULL, NULL, NULL, NULL, NULL, '1300 west st. marys Rd. #1', NULL, 'Tuscon', 'Arizona', '85745', NULL, '2020-01-02 22:49:37', '2020-01-03 03:40:06', NULL),
(57, 59, 3, 3, '10', 'John Napolitano', 'John', 'Napolitano', 'noname@email.com', '516-804-4632', '516-277-1380', NULL, NULL, NULL, NULL, '120 Glen Head Rd', '2304 Garfield St N. Bellmore, NY 11710', 'Glen Head', 'New York', '11545', NULL, '2020-01-02 22:58:40', '2020-01-03 02:14:55', NULL),
(58, 57, 4, 3, '10', 'KEITH LUKER', 'KEITH', 'LUKER', '12345@GMAIL.COM', '307-684-2356', NULL, NULL, NULL, NULL, NULL, '8922 BASIN HOLLOW RD', 'PO BOX 185', 'MILLVILLE', 'CA', '96062', NULL, '2020-01-02 23:01:25', '2020-01-02 23:01:25', NULL),
(59, 61, 4, 3, '10', 'CHETAN AMIN', 'CHETAN', 'AMIN', '12345@GMAIL.COM', '302-326-0554', NULL, NULL, NULL, NULL, NULL, '3209 B CONCORD PIKE', NULL, 'WILMINGTON', 'DE', '19803', NULL, '2020-01-02 23:09:02', '2020-01-02 23:24:36', NULL),
(60, 60, 3, 3, '10', 'James Robinson', 'James', 'Robinson', 'rentaldepot@gmail.com', '865-680-1417', '865-908-9206', NULL, NULL, NULL, NULL, '151 forks of the river', '1514 Graybrook Ln Knoxville, Tn 37920', 'Sevierville', 'Tennessee', '37862', NULL, '2020-01-02 23:11:57', '2020-01-03 03:37:25', NULL),
(61, 63, 4, 3, '10', 'DARNELL THOMPSON', 'DARNELL', 'THOMPSON', 'DARNELL.THOMPSON71@YAHOO.COM', '662-417-8905', NULL, NULL, NULL, NULL, NULL, '106 DOWNEY ST', NULL, 'OXFORD', 'MS', '38655', NULL, '2020-01-02 23:21:50', '2020-01-02 23:21:50', NULL),
(62, 64, 4, 3, '7', 'ADAM ZUCKER', 'ADAM', 'ZUCKER', 'ADAM.SUCKER@PLANTLAB.COM', '9176839177', NULL, NULL, NULL, NULL, NULL, '232 S RODEO DR', NULL, 'BEVERLY HILLS', 'CA', '90212', NULL, '2020-01-02 23:29:05', '2020-01-02 23:29:05', NULL),
(63, 62, 3, 3, '10', 'Jesus Lopez', 'Jesus', 'Lopez', 'Jesse@myorganicdelight.com', '323-975-2572', '323-975-2571', NULL, NULL, NULL, NULL, '1727 East 68th Street', '6750 Foster bridge Blvd Unit F', 'Los Angles', 'California', '90001', NULL, '2020-01-02 23:35:10', '2020-01-03 03:35:15', NULL),
(64, 65, 3, 3, '10', 'Thomas Brown', 'Thomas', 'Brown', 'noname@gmail.com', '763-450-6673', '763-450-6673', NULL, NULL, NULL, NULL, '4003 Morningside Road', NULL, 'Minneapolis', 'minnesota', '55416', NULL, '2020-01-02 23:49:28', '2020-01-03 03:37:03', NULL),
(65, 66, 4, 3, '10', 'RANKIN LYMAN', 'RANKIN', 'LYMAN', '12345@GMAIL.COM', '347-952-9513', NULL, NULL, NULL, NULL, NULL, '8987 PRAIRIE TRAIL WAY', NULL, 'SACRAMENTO', 'CA', '95826', NULL, '2020-01-02 23:51:15', '2020-01-02 23:51:15', NULL),
(66, 67, 4, 3, '10', 'SALLY L WILLIAMSON', 'SALLY L', 'WILLIAMSON', 'mark@sallywilliamson.com', '404-475-6550', NULL, NULL, NULL, NULL, NULL, '3050 PEACHTREE RD', NULL, 'ATLANTA', 'GA', '30305', NULL, '2020-01-03 00:04:05', '2020-01-03 00:04:05', NULL),
(67, 68, 3, 3, '10', 'George Cally', 'George', 'Cally', 'noname@gmail.com', '516-315-1425', '516-315-1425', NULL, NULL, NULL, NULL, '1568  Ocean Ave Ste# 4', '16 Fairway Drive Rocky Point, Arizona 11778', 'Bohemia', 'New york', '11716', NULL, '2020-01-03 00:16:52', '2020-01-03 03:38:27', NULL),
(68, 69, 4, 3, '10', 'WILLIAM MARK ADLER', 'WILLIAM MARK', 'ADLER', 'amccallum@spiritleatherworks.com', '541-953-9586', '541-337-1259', NULL, NULL, NULL, NULL, '100 CAP COURT', NULL, 'EUGENE', 'OR', '97402', NULL, '2020-01-03 00:21:28', '2020-01-03 00:21:28', NULL),
(69, 70, 4, 3, '10', 'PAUL FARISIAN', 'PAUL', 'FARISIAN', 'INFO.SSVENTURESLLC@GMAIL.COM', '323-346-9866', '323-346-9866', NULL, NULL, NULL, NULL, '313 VINE ST', NULL, 'GLENDALE', 'CA', '91204', NULL, '2020-01-03 00:28:23', '2020-01-03 00:28:23', NULL),
(70, 72, 4, 3, '12', 'IRVING D BOYES', 'IRVING D', 'BOYES', 'idbpre@gmail.com', '214-998-0718', NULL, NULL, NULL, NULL, NULL, '13601 PRESTON RD STE 900 EAST', NULL, 'DALLAS', 'TX', '75240', NULL, '2020-01-03 02:12:06', '2020-01-03 02:12:06', NULL),
(71, 73, 3, 3, '10', 'Travis  and James Powers and Whitelow', 'Travis  and James', 'Powers and Whitelow', 'tpowers@niagaralogistics.com', '312-636-8282(Travis)  and 312-282-4551 (James)', '855-676-6687 other  906-789-2222', NULL, NULL, NULL, NULL, '7073 US Highway 2 41 M35', NULL, 'Gladstone', 'Michigan', '49837', NULL, '2020-01-03 02:15:50', '2020-01-03 03:34:32', NULL),
(72, 74, 3, 3, '10', 'Albert Maze', 'Albert', 'Maze', 'albertmaze@yahoo.com', '619-440-4424', NULL, '858-353-6447', NULL, NULL, NULL, '14883 Summerbreeze way', NULL, 'San Diego', 'California', '92128-3734', NULL, '2020-01-03 02:54:51', '2020-01-03 03:38:06', NULL),
(73, 75, 3, 3, '7', 'Larry Recker Jr', 'Larry', 'Recker Jr', 'tntdairy2011@gmail.com', '989-418-9057', '989-418-9057', NULL, NULL, NULL, NULL, '11489 North Rich rd', NULL, 'Alma', 'Michigan', '48801', NULL, '2020-01-03 03:02:07', '2020-01-03 03:34:10', NULL),
(74, 76, 3, 3, '10', 'Jason Miller', 'Jason', 'Miller', 'noname@gmail.com', '417-623-2228', NULL, NULL, NULL, NULL, NULL, '4224 Hearnes Blvd', '527 S Main Street Joplin,MO 64801', 'Joplin', 'Missouri', '64804', NULL, '2020-01-03 03:08:45', '2020-01-03 03:37:40', NULL),
(75, 77, 3, 3, '10', 'Alberto Esparza', 'Alberto', 'Esparza', 'alberto@oneworldimprints.com', '408-858-9464', '408-858-9464', NULL, NULL, NULL, NULL, '1280 Alma Ct', '1461 Kerley Drive apt 9 San Jose, Ca 95112', 'San Jose', 'California', '95112', NULL, '2020-01-03 03:24:01', '2020-01-03 03:34:23', NULL),
(76, 80, 3, 3, '7', 'ROHIT WALIA', 'ROHIT', 'WALIA', 'rohit@theicecreamexchange.com', '(714) 878-5282', NULL, NULL, NULL, NULL, NULL, '6300 MARCELLA WAY', NULL, 'BUENA PARK', 'CA', '90620-4307', NULL, '2020-01-03 03:54:31', '2020-01-03 03:54:31', NULL),
(77, 79, 3, 3, '10', 'Bilal Imtiaz', 'Bilal', 'Imtiaz', 'nonmae@gmail.com', '855-676-6687', '516-331-5500', '516-439-7561', NULL, NULL, NULL, '760 Jericho Turnpike', NULL, 'woodbury', 'new york', '11797', NULL, '2020-01-03 03:55:18', '2020-01-03 04:57:14', NULL),
(78, 78, 4, 1, '4', 'ELIEZER Y TILSON', 'ELIEZER Y', 'TILSON', '12345@GMAIL.COM', '646-741-5281', NULL, NULL, NULL, NULL, NULL, '1282 N BROAD ST STE 2', NULL, 'HILLSIDE', 'NJ', '07205', NULL, '2020-01-03 03:57:47', '2020-01-03 03:57:47', NULL),
(79, 81, 3, 3, '10', 'LEIGH SCHMAHL', 'LEIGH', 'SCHMAHL', 'Leigh052279@msn.com', '(720) 416-3319', NULL, NULL, NULL, NULL, NULL, '16051 E COLFAX AVE LOT 21', NULL, 'AURORA', 'CO', '80011-5941', NULL, '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(80, 83, 4, 3, '12', 'PATRICK R STONICH', 'PATRICK R', 'STONICH', '12345@GMAIL.COM', '(610) 820-8301', NULL, NULL, NULL, NULL, NULL, '4315 WASHINGTON ST', NULL, 'SCHECKSVILLE', 'PA', '18014', NULL, '2020-01-03 04:17:13', '2020-01-03 04:17:13', NULL),
(81, 84, 3, 3, '10', 'SalJl Mehrotra', 'SalJl', 'Mehrotra', 'noname@gmail.com', '914-525-9947', '914-525-9947', NULL, NULL, NULL, NULL, '6 pierce drive', '3360 Palisades Center Dr West Nyack, New York 10994', 'Stony point', 'new york', '10980', NULL, '2020-01-03 04:27:47', '2020-01-03 04:57:06', NULL),
(82, 85, 3, 3, '10', 'Enrique Marquez', 'Enrique', 'Marquez', 'enriquem8505@gmail.com', '847-890-8505', '847-385-8687', NULL, NULL, NULL, NULL, '1020 Lunt Avenue Suite G', NULL, 'Schaumburg', 'Illnois', '60193', NULL, '2020-01-03 04:51:19', '2020-01-03 04:57:22', NULL);

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
(136, 25, 0, 11, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(137, 23, 0, 6, '2019-12-27 15:31:29', '2019-12-27 15:31:29', NULL),
(138, 26, 0, 5, '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(139, 26, 0, 9, '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(140, 26, 0, 10, '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(141, 26, 0, 11, '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(142, 27, 0, 5, '2019-12-28 01:52:06', '2019-12-28 01:52:06', NULL),
(143, 27, 0, 9, '2019-12-28 01:52:06', '2019-12-28 01:52:06', NULL),
(144, 27, 0, 10, '2019-12-28 01:52:06', '2019-12-28 01:52:06', NULL),
(145, 27, 0, 11, '2019-12-28 01:52:06', '2019-12-28 01:52:06', NULL),
(146, 28, 0, 5, '2019-12-28 02:16:45', '2019-12-28 02:18:12', '2019-12-28 02:18:12'),
(147, 28, 0, 9, '2019-12-28 02:16:45', '2019-12-28 02:18:12', '2019-12-28 02:18:12'),
(148, 28, 0, 10, '2019-12-28 02:16:45', '2019-12-28 02:18:12', '2019-12-28 02:18:12'),
(149, 28, 0, 11, '2019-12-28 02:16:45', '2019-12-28 02:18:12', '2019-12-28 02:18:12'),
(150, 28, 0, 5, '2019-12-28 02:18:12', '2019-12-28 02:18:12', NULL),
(151, 28, 0, 9, '2019-12-28 02:18:12', '2019-12-28 02:18:12', NULL),
(152, 28, 0, 10, '2019-12-28 02:18:12', '2019-12-28 02:18:12', NULL),
(153, 28, 0, 11, '2019-12-28 02:18:12', '2019-12-28 02:18:12', NULL),
(154, 29, 0, 5, '2019-12-28 03:34:04', '2019-12-28 03:34:58', '2019-12-28 03:34:58'),
(155, 29, 0, 9, '2019-12-28 03:34:04', '2019-12-28 03:34:58', '2019-12-28 03:34:58'),
(156, 29, 0, 10, '2019-12-28 03:34:04', '2019-12-28 03:34:58', '2019-12-28 03:34:58'),
(157, 29, 0, 11, '2019-12-28 03:34:04', '2019-12-28 03:34:58', '2019-12-28 03:34:58'),
(158, 30, 0, 5, '2019-12-28 03:34:05', '2019-12-28 03:34:05', NULL),
(159, 30, 0, 9, '2019-12-28 03:34:05', '2019-12-28 03:34:05', NULL),
(160, 30, 0, 10, '2019-12-28 03:34:05', '2019-12-28 03:34:05', NULL),
(161, 30, 0, 11, '2019-12-28 03:34:05', '2019-12-28 03:34:05', NULL),
(162, 29, 0, 5, '2019-12-28 03:34:58', '2019-12-28 03:34:58', NULL),
(163, 29, 0, 9, '2019-12-28 03:34:58', '2019-12-28 03:34:58', NULL),
(164, 29, 0, 10, '2019-12-28 03:34:58', '2019-12-28 03:34:58', NULL),
(165, 29, 0, 11, '2019-12-28 03:34:58', '2019-12-28 03:34:58', NULL),
(166, 31, 0, 5, '2019-12-28 03:52:40', '2019-12-28 03:52:40', NULL),
(167, 31, 0, 9, '2019-12-28 03:52:40', '2019-12-28 03:52:40', NULL),
(168, 31, 0, 10, '2019-12-28 03:52:40', '2019-12-28 03:52:40', NULL),
(169, 31, 0, 11, '2019-12-28 03:52:40', '2019-12-28 03:52:40', NULL),
(170, 32, 0, 5, '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(171, 32, 0, 9, '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(172, 32, 0, 10, '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(173, 32, 0, 11, '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(174, 33, 0, 5, '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(175, 33, 0, 9, '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(176, 33, 0, 10, '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(177, 33, 0, 11, '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(178, 34, 0, 5, '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(179, 34, 0, 9, '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(180, 34, 0, 10, '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(181, 34, 0, 11, '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(182, 35, 0, 9, '2019-12-31 00:14:08', '2019-12-31 00:14:08', NULL),
(183, 35, 0, 10, '2019-12-31 00:14:08', '2019-12-31 00:14:08', NULL),
(184, 35, 0, 11, '2019-12-31 00:14:08', '2019-12-31 00:14:08', NULL),
(185, 36, 0, 9, '2019-12-31 00:37:43', '2019-12-31 00:37:43', NULL),
(186, 36, 0, 10, '2019-12-31 00:37:43', '2019-12-31 00:37:43', NULL),
(187, 36, 0, 11, '2019-12-31 00:37:43', '2019-12-31 00:37:43', NULL),
(188, 37, 0, 9, '2019-12-31 00:45:12', '2019-12-31 00:45:12', NULL),
(189, 37, 0, 10, '2019-12-31 00:45:12', '2019-12-31 00:45:12', NULL),
(190, 37, 0, 11, '2019-12-31 00:45:12', '2019-12-31 00:45:12', NULL),
(191, 38, 0, 9, '2019-12-31 00:51:00', '2019-12-31 00:51:00', NULL),
(192, 38, 0, 10, '2019-12-31 00:51:00', '2019-12-31 00:51:00', NULL),
(193, 38, 0, 11, '2019-12-31 00:51:00', '2019-12-31 00:51:00', NULL),
(194, 39, 0, 9, '2019-12-31 01:24:51', '2019-12-31 01:24:51', NULL),
(195, 39, 0, 10, '2019-12-31 01:24:51', '2019-12-31 01:24:51', NULL),
(196, 39, 0, 11, '2019-12-31 01:24:51', '2019-12-31 01:24:51', NULL),
(197, 40, 0, 9, '2019-12-31 01:51:00', '2019-12-31 01:51:00', NULL),
(198, 40, 0, 10, '2019-12-31 01:51:00', '2019-12-31 01:51:00', NULL),
(199, 40, 0, 11, '2019-12-31 01:51:00', '2019-12-31 01:51:00', NULL),
(200, 41, 0, 9, '2019-12-31 02:22:24', '2019-12-31 02:22:24', NULL),
(201, 41, 0, 10, '2019-12-31 02:22:24', '2019-12-31 02:22:24', NULL),
(202, 41, 0, 11, '2019-12-31 02:22:24', '2019-12-31 02:22:24', NULL),
(203, 42, 0, 9, '2019-12-31 02:23:19', '2019-12-31 02:23:19', NULL),
(204, 42, 0, 10, '2019-12-31 02:23:19', '2019-12-31 02:23:19', NULL),
(205, 42, 0, 11, '2019-12-31 02:23:19', '2019-12-31 02:23:19', NULL),
(206, 43, 0, 9, '2019-12-31 02:30:52', '2019-12-31 02:49:20', '2019-12-31 02:49:20'),
(207, 43, 0, 10, '2019-12-31 02:30:52', '2019-12-31 02:49:20', '2019-12-31 02:49:20'),
(208, 43, 0, 11, '2019-12-31 02:30:52', '2019-12-31 02:49:20', '2019-12-31 02:49:20'),
(209, 43, 44, 16, '2019-12-31 02:49:20', '2019-12-31 02:49:20', NULL),
(210, 43, 0, 9, '2019-12-31 02:49:20', '2019-12-31 02:49:20', NULL),
(211, 43, 0, 10, '2019-12-31 02:49:20', '2019-12-31 02:49:20', NULL),
(212, 43, 0, 11, '2019-12-31 02:49:20', '2019-12-31 02:49:20', NULL),
(213, 44, 44, 16, '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(214, 44, 0, 9, '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(215, 44, 0, 10, '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(216, 44, 0, 11, '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(217, 45, 44, 16, '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(218, 45, 0, 9, '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(219, 45, 0, 10, '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(220, 45, 0, 11, '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(221, 46, 0, 9, '2019-12-31 03:25:11', '2019-12-31 03:25:11', NULL),
(222, 46, 0, 10, '2019-12-31 03:25:11', '2019-12-31 03:25:11', NULL),
(223, 46, 0, 11, '2019-12-31 03:25:11', '2019-12-31 03:25:11', NULL),
(224, 48, 0, 9, '2019-12-31 03:41:07', '2019-12-31 03:41:07', NULL),
(225, 48, 0, 10, '2019-12-31 03:41:07', '2019-12-31 03:41:07', NULL),
(226, 48, 0, 11, '2019-12-31 03:41:07', '2019-12-31 03:41:07', NULL),
(227, 47, 0, 9, '2019-12-31 03:55:00', '2020-01-03 03:47:27', '2020-01-03 03:47:27'),
(228, 47, 0, 10, '2019-12-31 03:55:00', '2020-01-03 03:47:27', '2020-01-03 03:47:27'),
(229, 47, 0, 11, '2019-12-31 03:55:00', '2020-01-03 03:47:27', '2020-01-03 03:47:27'),
(230, 49, 44, 16, '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(231, 49, 0, 9, '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(232, 49, 0, 10, '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(233, 49, 0, 11, '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(234, 50, 44, 16, '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(235, 50, 0, 9, '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(236, 50, 0, 10, '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(237, 50, 0, 11, '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(238, 51, 44, 16, '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(239, 51, 0, 9, '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(240, 51, 0, 10, '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(241, 51, 0, 11, '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(242, 52, 0, 9, '2019-12-31 22:56:25', '2019-12-31 22:56:25', NULL),
(243, 52, 0, 10, '2019-12-31 22:56:25', '2019-12-31 22:56:25', NULL),
(244, 52, 0, 11, '2019-12-31 22:56:25', '2019-12-31 22:56:25', NULL),
(245, 53, 0, 9, '2019-12-31 23:05:22', '2019-12-31 23:05:22', NULL),
(246, 53, 0, 10, '2019-12-31 23:05:22', '2019-12-31 23:05:22', NULL),
(247, 53, 0, 11, '2019-12-31 23:05:22', '2019-12-31 23:05:22', NULL),
(248, 54, 0, 9, '2019-12-31 23:49:55', '2019-12-31 23:49:55', NULL),
(249, 54, 0, 10, '2019-12-31 23:49:55', '2019-12-31 23:49:55', NULL),
(250, 54, 0, 11, '2019-12-31 23:49:55', '2019-12-31 23:49:55', NULL),
(251, 55, 0, 9, '2020-01-01 00:30:08', '2020-01-01 00:30:08', NULL),
(252, 55, 0, 10, '2020-01-01 00:30:08', '2020-01-01 00:30:08', NULL),
(253, 55, 0, 11, '2020-01-01 00:30:08', '2020-01-01 00:30:08', NULL),
(254, 58, 0, 9, '2020-01-02 23:01:37', '2020-01-02 23:01:37', NULL),
(255, 58, 0, 10, '2020-01-02 23:01:37', '2020-01-02 23:01:37', NULL),
(256, 58, 0, 11, '2020-01-02 23:01:37', '2020-01-02 23:01:37', NULL),
(257, 59, 0, 9, '2020-01-02 23:09:13', '2020-01-02 23:24:23', '2020-01-02 23:24:23'),
(258, 59, 0, 10, '2020-01-02 23:09:13', '2020-01-02 23:24:23', '2020-01-02 23:24:23'),
(259, 59, 0, 11, '2020-01-02 23:09:13', '2020-01-02 23:24:23', '2020-01-02 23:24:23'),
(260, 61, 0, 9, '2020-01-02 23:22:25', '2020-01-02 23:22:25', NULL),
(261, 61, 0, 10, '2020-01-02 23:22:25', '2020-01-02 23:22:25', NULL),
(262, 61, 0, 11, '2020-01-02 23:22:25', '2020-01-02 23:22:25', NULL),
(263, 59, 0, 9, '2020-01-02 23:24:23', '2020-01-02 23:24:36', '2020-01-02 23:24:36'),
(264, 59, 0, 10, '2020-01-02 23:24:23', '2020-01-02 23:24:36', '2020-01-02 23:24:36'),
(265, 59, 0, 11, '2020-01-02 23:24:23', '2020-01-02 23:24:36', '2020-01-02 23:24:36'),
(266, 59, 0, 9, '2020-01-02 23:24:36', '2020-01-02 23:24:36', NULL),
(267, 59, 0, 10, '2020-01-02 23:24:36', '2020-01-02 23:24:36', NULL),
(268, 59, 0, 11, '2020-01-02 23:24:36', '2020-01-02 23:24:36', NULL),
(269, 62, 0, 9, '2020-01-02 23:29:13', '2020-01-02 23:29:13', NULL),
(270, 62, 0, 10, '2020-01-02 23:29:13', '2020-01-02 23:29:13', NULL),
(271, 62, 0, 11, '2020-01-02 23:29:13', '2020-01-02 23:29:13', NULL),
(272, 65, 0, 9, '2020-01-02 23:51:29', '2020-01-02 23:51:29', NULL),
(273, 65, 0, 10, '2020-01-02 23:51:29', '2020-01-02 23:51:29', NULL),
(274, 65, 0, 11, '2020-01-02 23:51:29', '2020-01-02 23:51:29', NULL),
(275, 66, 0, 9, '2020-01-03 00:04:15', '2020-01-03 00:04:15', NULL),
(276, 66, 0, 10, '2020-01-03 00:04:15', '2020-01-03 00:04:15', NULL),
(277, 66, 0, 11, '2020-01-03 00:04:15', '2020-01-03 00:04:15', NULL),
(278, 68, 0, 9, '2020-01-03 00:21:44', '2020-01-03 00:21:44', NULL),
(279, 68, 0, 10, '2020-01-03 00:21:44', '2020-01-03 00:21:44', NULL),
(280, 68, 0, 11, '2020-01-03 00:21:44', '2020-01-03 00:21:44', NULL),
(281, 69, 0, 9, '2020-01-03 00:28:34', '2020-01-03 00:28:34', NULL),
(282, 69, 0, 10, '2020-01-03 00:28:34', '2020-01-03 00:28:34', NULL),
(283, 69, 0, 11, '2020-01-03 00:28:34', '2020-01-03 00:28:34', NULL),
(284, 70, 0, 9, '2020-01-03 02:12:06', '2020-01-03 02:12:06', NULL),
(285, 70, 0, 10, '2020-01-03 02:12:06', '2020-01-03 02:12:06', NULL),
(286, 70, 0, 11, '2020-01-03 02:12:06', '2020-01-03 02:12:06', NULL),
(287, 57, 71, 17, '2020-01-03 02:14:55', '2020-01-03 02:14:55', NULL),
(288, 73, 71, 17, '2020-01-03 03:34:10', '2020-01-03 03:34:10', NULL),
(289, 75, 71, 17, '2020-01-03 03:34:23', '2020-01-03 03:34:23', NULL),
(290, 71, 71, 17, '2020-01-03 03:34:32', '2020-01-03 03:34:32', NULL),
(291, 63, 71, 17, '2020-01-03 03:35:15', '2020-01-03 03:35:15', NULL),
(292, 64, 71, 17, '2020-01-03 03:37:03', '2020-01-03 03:37:03', NULL),
(293, 60, 71, 17, '2020-01-03 03:37:25', '2020-01-03 03:37:25', NULL),
(294, 74, 71, 17, '2020-01-03 03:37:40', '2020-01-03 03:37:40', NULL),
(295, 72, 71, 17, '2020-01-03 03:38:06', '2020-01-03 03:38:06', NULL),
(296, 67, 71, 17, '2020-01-03 03:38:27', '2020-01-03 03:38:27', NULL),
(297, 56, 71, 17, '2020-01-03 03:40:06', '2020-01-03 03:40:06', NULL),
(298, 47, 71, 17, '2020-01-03 03:47:27', '2020-01-03 03:47:27', NULL),
(299, 47, 0, 9, '2020-01-03 03:47:27', '2020-01-03 03:47:27', NULL),
(300, 47, 0, 10, '2020-01-03 03:47:27', '2020-01-03 03:47:27', NULL),
(301, 47, 0, 11, '2020-01-03 03:47:27', '2020-01-03 03:47:27', NULL),
(302, 76, 71, 17, '2020-01-03 03:54:31', '2020-01-03 03:56:00', '2020-01-03 03:56:00'),
(303, 76, 0, 9, '2020-01-03 03:54:31', '2020-01-03 03:56:00', '2020-01-03 03:56:00'),
(304, 76, 0, 10, '2020-01-03 03:54:31', '2020-01-03 03:56:00', '2020-01-03 03:56:00'),
(305, 76, 0, 11, '2020-01-03 03:54:31', '2020-01-03 03:56:00', '2020-01-03 03:56:00'),
(306, 76, 71, 17, '2020-01-03 03:56:00', '2020-01-03 03:56:00', NULL),
(307, 76, 0, 9, '2020-01-03 03:56:00', '2020-01-03 03:56:00', NULL),
(308, 76, 0, 10, '2020-01-03 03:56:00', '2020-01-03 03:56:00', NULL),
(309, 76, 0, 11, '2020-01-03 03:56:00', '2020-01-03 03:56:00', NULL),
(310, 78, 0, 9, '2020-01-03 03:57:55', '2020-01-03 03:57:55', NULL),
(311, 78, 0, 10, '2020-01-03 03:57:55', '2020-01-03 03:57:55', NULL),
(312, 78, 0, 11, '2020-01-03 03:57:55', '2020-01-03 03:57:55', NULL),
(313, 79, 71, 17, '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(314, 79, 0, 9, '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(315, 79, 0, 10, '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(316, 79, 0, 11, '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(317, 80, 0, 9, '2020-01-03 04:17:24', '2020-01-03 04:17:24', NULL),
(318, 80, 0, 10, '2020-01-03 04:17:24', '2020-01-03 04:17:24', NULL),
(319, 80, 0, 11, '2020-01-03 04:17:24', '2020-01-03 04:17:24', NULL),
(320, 81, 71, 17, '2020-01-03 04:57:06', '2020-01-03 04:57:06', NULL),
(321, 77, 71, 17, '2020-01-03 04:57:14', '2020-01-03 04:57:14', NULL),
(322, 82, 71, 17, '2020-01-03 04:57:22', '2020-01-03 04:57:22', NULL);

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
(25, 25, 25, 3, 0.00, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(26, 26, 26, 15, 0.00, '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(27, 27, 27, 15, 0.00, '2019-12-28 01:51:33', '2019-12-28 01:51:33', NULL),
(28, 28, 28, 15, 0.00, '2019-12-28 02:16:45', '2019-12-28 02:16:45', NULL),
(29, 29, 29, 15, 0.00, '2019-12-28 03:34:04', '2019-12-28 03:34:04', NULL),
(30, 30, 29, 15, 0.00, '2019-12-28 03:34:05', '2019-12-28 03:34:05', NULL),
(31, 31, 30, 15, 0.00, '2019-12-28 03:52:40', '2019-12-28 03:52:40', NULL),
(32, 32, 30, 15, 0.00, '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(33, 33, 31, 15, 0.00, '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(34, 34, 32, 15, 0.00, '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(35, 35, 34, 3, 0.00, '2019-12-31 00:14:08', '2019-12-31 00:14:08', NULL),
(36, 36, 35, 3, 0.00, '2019-12-31 00:37:43', '2019-12-31 00:37:43', NULL),
(37, 37, 36, 3, 0.00, '2019-12-31 00:45:12', '2019-12-31 00:45:12', NULL),
(38, 38, 37, 3, 0.00, '2019-12-31 00:51:00', '2019-12-31 00:51:00', NULL),
(39, 39, 38, 4, 0.00, '2019-12-31 01:24:51', '2019-12-31 01:24:51', NULL),
(40, 40, 39, 4, 0.00, '2019-12-31 01:50:46', '2019-12-31 01:50:46', NULL),
(41, 41, 41, 3, 0.00, '2019-12-31 02:22:24', '2019-12-31 02:22:24', NULL),
(42, 42, 40, 4, 0.00, '2019-12-31 02:23:08', '2019-12-31 02:23:08', NULL),
(43, 43, 42, 3, 0.00, '2019-12-31 02:30:52', '2019-12-31 02:30:52', NULL),
(44, 44, 43, 3, 0.00, '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(45, 45, 46, 3, 0.00, '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(46, 46, 45, 4, 0.00, '2019-12-31 03:24:54', '2019-12-31 03:24:54', NULL),
(47, 47, 33, 3, 0.00, '2019-12-31 03:31:23', '2019-12-31 03:55:00', NULL),
(48, 48, 47, 4, 0.00, '2019-12-31 03:41:07', '2019-12-31 03:41:07', NULL),
(49, 49, 49, 3, 0.00, '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(50, 50, 50, 3, 0.00, '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(51, 51, 51, 3, 0.00, '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(52, 52, 53, 3, 0.00, '2019-12-31 22:56:25', '2019-12-31 22:56:25', NULL),
(53, 53, 54, 4, 0.00, '2019-12-31 23:05:03', '2019-12-31 23:05:03', NULL),
(54, 54, 55, 4, 0.00, '2019-12-31 23:49:46', '2019-12-31 23:49:46', NULL),
(55, 55, 56, 4, 0.00, '2020-01-01 00:30:08', '2020-01-01 00:30:08', NULL),
(56, 56, 58, 3, 0.00, '2020-01-02 22:49:37', '2020-01-03 03:40:06', NULL),
(57, 57, 59, 3, 0.00, '2020-01-02 22:58:40', '2020-01-03 02:14:55', NULL),
(58, 58, 57, 4, 0.00, '2020-01-02 23:01:25', '2020-01-02 23:01:25', NULL),
(59, 59, 61, 4, 0.00, '2020-01-02 23:09:02', '2020-01-02 23:09:02', NULL),
(60, 60, 60, 3, 0.00, '2020-01-02 23:11:57', '2020-01-03 03:37:25', NULL),
(61, 61, 63, 4, 0.00, '2020-01-02 23:21:50', '2020-01-02 23:21:50', NULL),
(62, 62, 64, 4, 0.00, '2020-01-02 23:29:05', '2020-01-02 23:29:05', NULL),
(63, 63, 62, 3, 0.00, '2020-01-02 23:35:10', '2020-01-03 03:35:15', NULL),
(64, 64, 65, 3, 0.00, '2020-01-02 23:49:29', '2020-01-03 03:37:03', NULL),
(65, 65, 66, 4, 0.00, '2020-01-02 23:51:15', '2020-01-02 23:51:15', NULL),
(66, 66, 67, 4, 0.00, '2020-01-03 00:04:06', '2020-01-03 00:04:06', NULL),
(67, 67, 68, 3, 0.00, '2020-01-03 00:16:52', '2020-01-03 03:38:27', NULL),
(68, 68, 69, 4, 0.00, '2020-01-03 00:21:28', '2020-01-03 00:21:28', NULL),
(69, 69, 70, 4, 0.00, '2020-01-03 00:28:23', '2020-01-03 00:28:23', NULL),
(70, 70, 72, 4, 0.00, '2020-01-03 02:12:06', '2020-01-03 02:12:06', NULL),
(71, 71, 73, 3, 0.00, '2020-01-03 02:15:50', '2020-01-03 03:34:32', NULL),
(72, 72, 74, 3, 0.00, '2020-01-03 02:54:51', '2020-01-03 03:38:06', NULL),
(73, 73, 75, 3, 0.00, '2020-01-03 03:02:07', '2020-01-03 03:34:10', NULL),
(74, 74, 76, 3, 0.00, '2020-01-03 03:08:45', '2020-01-03 03:37:40', NULL),
(75, 75, 77, 3, 0.00, '2020-01-03 03:24:01', '2020-01-03 03:34:23', NULL),
(76, 76, 80, 3, 0.00, '2020-01-03 03:54:31', '2020-01-03 03:54:31', NULL),
(77, 77, 79, 3, 0.00, '2020-01-03 03:55:18', '2020-01-03 04:57:14', NULL),
(78, 78, 78, 4, 0.00, '2020-01-03 03:57:47', '2020-01-03 03:57:47', NULL),
(79, 79, 81, 3, 0.00, '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(80, 80, 83, 4, 0.00, '2020-01-03 04:17:13', '2020-01-03 04:17:13', NULL),
(81, 81, 84, 3, 0.00, '2020-01-03 04:27:47', '2020-01-03 04:57:06', NULL),
(82, 82, 85, 3, 0.00, '2020-01-03 04:51:19', '2020-01-03 04:57:22', NULL);

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
(23, 23, 2, 1, 'Iron Power', '1.00', 'Sole Proprietorship', 'yes', 110000.00, 1110000.00, 'No', '1910-01-01', 'NA', '2019-12-20 13:50:08', '2019-12-27 15:31:29', NULL),
(24, 24, 24, 3, 'Heller Family Medical', '3.00', 'Limited Liability Company-LLC', 'YES', 2500.00, 75000.00, 'No', '1910-01-01', 'NA', '2019-12-27 00:17:14', '2019-12-27 00:17:28', NULL),
(25, 25, 25, 3, 'Top Mop Inc', '6.00', 'Corporation', 'yes', 30000.00, 360000.00, 'Yes', '2019-08-23', 'NA', '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(26, 26, 26, 15, 'coordinated logistics transportation llc', '5.00', 'Limited Liability Company-LLC', 'no', 0.00, 100000.00, 'No', '1910-01-01', 'NA', '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(27, 27, 27, 15, 'GVB Holdings LLC', '3.00', 'Limited Liability Company-LLC', 'no', 0.00, 1000000.00, 'No', '1910-01-01', 'NA', '2019-12-28 01:51:33', '2019-12-28 01:52:06', NULL),
(28, 28, 28, 15, 'NAS TRADING INC.', '10.00', 'Corporation', 'no', 0.00, 500000.00, 'No', '1910-01-01', 'NA', '2019-12-28 02:16:45', '2019-12-28 02:18:12', NULL),
(29, 29, 29, 15, 'Neighborhood Market', '5.00', 'Sole Proprietorship', 'yes', 5000.00, 100000.00, 'No', '1910-01-01', 'NA', '2019-12-28 03:34:04', '2019-12-28 03:34:58', NULL),
(30, 30, 29, 15, 'Neighborhood Market', '5.00', 'Sole Proprietorship', 'yes', 5000.00, 100000.00, 'No', '1910-01-01', 'NA', '2019-12-28 03:34:05', '2019-12-28 03:34:05', NULL),
(31, 31, 30, 15, 'Pine Knot Guest Ranch', '5.00', 'Sole Proprietorship', 'yes', 6000.00, 72000.00, 'No', '1910-01-01', 'NA', '2019-12-28 03:52:40', '2019-12-28 03:52:40', NULL),
(32, 32, 30, 15, 'Pine Knot Guest Ranch', '5.00', 'Sole Proprietorship', 'yes', 6000.00, 72000.00, 'No', '1910-01-01', 'NA', '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(33, 33, 31, 15, 'Seamus Collins Contruction INC', '5.00', 'Corporation', 'no', 0.00, 1000000.00, 'No', '1910-01-01', 'NA', '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(34, 34, 32, 15, 'The Northwest Capital Builders,INC', '6.00', 'Corporation', 'no', 0.00, 2000000.00, 'No', '1910-01-01', 'NA', '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(35, 35, 34, 3, 'Vargas Transportation', '1.00', 'Sole Proprietorship', 'no', 0.00, 2940000.00, 'Yes', '2018-08-31', 'NA', '2019-12-31 00:14:08', '2019-12-31 00:14:08', NULL),
(36, 36, 35, 3, 'Ernies Pool Service LLC', '46.00', 'Limited Liability Company-LLC', 'yes', 4000.00, 22800.00, 'Yes', '2019-05-21', 'NA', '2019-12-31 00:37:43', '2019-12-31 00:37:43', NULL),
(37, 37, 36, 3, 'Bigfoot Bites Inc', '3.00', 'Corporation', 'yes', 40000.00, 500000.00, 'Yes', '2019-02-21', 'NA', '2019-12-31 00:45:12', '2019-12-31 00:45:12', NULL),
(38, 38, 37, 3, 'Nail Tek LLC', '2.00', 'Limited Liability Company-LLC', 'NO', 0.00, 40000.00, 'Yes', '2017-06-19', 'NA', '2019-12-31 00:51:00', '2019-12-31 00:51:00', NULL),
(39, 39, 38, 4, '360 DEGREES OF PERFECTON', '5.00', 'Corporation', 'YES', 4430.58, 43167.00, 'No', '1910-01-01', 'NA', '2019-12-31 01:24:51', '2019-12-31 01:24:51', NULL),
(40, 40, 39, 4, 'ARIKA FOOD ENTERPRISES INC DBA HOUSE OF CURRIES', '1.00', 'Corporation', 'YES', 29708.80, 29708.80, 'No', '1910-01-01', 'NA', '2019-12-31 01:50:46', '2019-12-31 01:51:00', NULL),
(41, 41, 41, 3, 'Gun Gear to Go LLC', '1.00', 'Sole Proprietorship', 'yes', 15000.00, 1200000.00, 'Yes', '2018-05-10', 'NA', '2019-12-31 02:22:24', '2019-12-31 02:22:24', NULL),
(42, 42, 40, 4, 'AUTO GLAM DETAIL LLC', '6.00', 'Sole Proprietorship', 'YES', 7154.00, 7154.00, 'No', '1910-01-01', 'NA', '2019-12-31 02:23:08', '2019-12-31 02:23:19', NULL),
(43, 43, 42, 3, 'CW PAINTING & HOME IMPROVEMENTS INC', '3.00', 'Corporation', 'no', 0.00, 360000.00, 'Yes', '1910-01-01', 'NA', '2019-12-31 02:30:52', '2019-12-31 02:49:20', NULL),
(44, 44, 43, 3, 'TEXAS MOTION FURNITURE', '1.00', 'Sole Proprietorship', 'yes', 25000.00, 600000.00, 'Yes', '2019-09-09', 'NA', '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(45, 45, 46, 3, 'GULF COAST AUDIO VIDEO LLC', '18.00', 'Limited Liability Company-LLC', 'yes', 8000.00, 650000.00, 'Yes', '2018-02-26', 'NA', '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(46, 46, 45, 4, 'BEDI TRANSPORT INC', '10.00', 'Corporation', 'NO', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2019-12-31 03:24:54', '2019-12-31 03:25:11', NULL),
(47, 47, 33, 3, 'T & C  LLC', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2019-12-31 03:31:23', '2020-01-03 03:47:27', NULL),
(48, 48, 47, 4, 'DAWSON-DODD INC DBA DAWSON-DODD HEATING & COOLING', '19.00', 'Corporation', 'YES', 1910.28, 1910.28, 'No', '1910-01-01', 'NA', '2019-12-31 03:41:07', '2019-12-31 03:41:07', NULL),
(49, 49, 49, 3, 'Burger King', '4.00', 'Corporation', 'yes', 15000.00, 924000.00, 'Yes', '2019-06-06', 'NA', '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(50, 50, 50, 3, 'OLD HAGS PIZZA AND PASTA', '1.00', 'Corporation', 'yes', 43000.00, 600000.00, 'Yes', '2019-09-30', 'NA', '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(51, 51, 51, 3, 'COHESIVE DESIGN PARTNERS INC', '5.00', 'Sole Proprietorship', 'no', 0.00, 504000.00, 'Yes', '2018-08-23', 'NA', '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(52, 52, 53, 3, 'Tolley & Lowe, Inc', '7.00', 'Sole Proprietorship', 'YES', 15000.00, 26250000.00, 'No', '1910-01-01', 'NA', '2019-12-31 22:56:25', '2019-12-31 22:56:25', NULL),
(53, 53, 54, 4, 'DK DWELLINGS LLC', '4.00', 'Limited Liability Company-LLC', 'NO', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2019-12-31 23:05:03', '2019-12-31 23:05:22', NULL),
(54, 54, 55, 4, 'ELEVATION AUTOMOTIVE LLC', '5.00', 'Limited Liability Company-LLC', 'YES', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2019-12-31 23:49:46', '2019-12-31 23:49:55', NULL),
(55, 55, 56, 4, 'EURO FLOORING INC DBA EURO FLOORING & STONE', '1.00', 'Corporation', '66466.33', 66466.33, 66466.33, 'No', '1910-01-01', 'NA', '2020-01-01 00:30:08', '2020-01-01 00:30:08', NULL),
(56, 56, 58, 3, 'Villas Consulting Inc', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 22:49:37', '2020-01-03 03:40:06', NULL),
(57, 57, 59, 3, 'Countrywide Distributors', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 22:58:40', '2020-01-03 02:14:55', NULL),
(58, 58, 57, 4, 'Jeremiah Capital Investments, LLC', '2.00', 'Limited Liability Company-LLC', 'NO', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 23:01:25', '2020-01-02 23:01:37', NULL),
(59, 59, 61, 4, 'JAYALAXMI INC DBA MANHATTAN BAGEL', '7.00', 'Corporation', 'YES', 34113.23, 34113.23, 'No', '1910-01-01', 'NA', '2020-01-02 23:09:02', '2020-01-02 23:24:36', NULL),
(60, 60, 60, 3, 'Rental Depot', '23.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 23:11:57', '2020-01-03 03:37:25', NULL),
(61, 61, 63, 4, 'PENIEL TRANSIT INC', '5.00', 'Corporation', 'NO', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 23:21:50', '2020-01-02 23:22:25', NULL),
(62, 62, 64, 4, 'PLANTLAB, LLC / VEER LIVING, LLC', '2.00', 'Sole Proprietorship', 'YES', 301613.00, 301613.00, 'No', '1910-01-01', 'NA', '2020-01-02 23:29:05', '2020-01-02 23:29:13', NULL),
(63, 63, 62, 3, 'Organic Delight', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 23:35:10', '2020-01-03 03:35:15', NULL),
(64, 64, 65, 3, 'Browns Roofing', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 23:49:29', '2020-01-03 03:37:03', NULL),
(65, 65, 66, 4, 'RANKIN LYMAN', '18.00', 'Sole Proprietorship', 'NO', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-02 23:51:15', '2020-01-02 23:51:29', NULL),
(66, 66, 67, 4, 'SALLY WILLIAMSON & ASSOCIATES, INC.', '1.00', 'Corporation', 'YES', 104160.39, 104160.39, 'No', '1910-01-01', 'NA', '2020-01-03 00:04:05', '2020-01-03 00:04:15', NULL),
(67, 67, 68, 3, 'Jagbe Electronics', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2020-01-03 00:16:52', '2020-01-03 03:38:27', NULL),
(68, 68, 69, 4, 'SPIRIT LEATHERWORKS LLC', '17.00', 'Limited Liability Company-LLC', 'YES', 12522.37, 12522.37, 'No', '1910-01-01', 'NA', '2020-01-03 00:21:28', '2020-01-03 00:21:44', NULL),
(69, 69, 70, 4, 'SS VENTURES', '11.00', 'Limited Liability Company-LLC', 'YES', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-03 00:28:23', '2020-01-03 00:28:34', NULL),
(70, 70, 72, 4, 'XCPCNL MAINTENANCE, LLC', '5.00', 'Limited Liability Company-LLC', 'yes', 20000.00, 3595616.00, 'No', '1910-01-01', 'NA', '2020-01-03 02:12:06', '2020-01-03 02:12:06', NULL),
(71, 71, 73, 3, 'Niagara Logistics', '14.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-03 02:15:50', '2020-01-03 03:34:32', NULL),
(72, 72, 74, 3, 'Quick Repair', '17.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-03 02:54:51', '2020-01-03 03:38:06', NULL),
(73, 73, 75, 3, 'TNT Dairy', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'Yes', '1910-01-01', 'NA', '2020-01-03 03:02:07', '2020-01-03 03:34:10', NULL),
(74, 74, 76, 3, 'Eagle Drive Inn', '10.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-03 03:08:45', '2020-01-03 03:37:40', NULL),
(75, 75, 77, 3, 'One world imprint', '1.00', 'Sole Proprietorship', 'Yes', 2000.00, 38000.00, 'No', '1910-01-01', 'NA', '2020-01-03 03:24:01', '2020-01-03 03:34:23', NULL),
(76, 76, 80, 3, 'DUDEJI, INC.', '7.00', 'Sole Proprietorship', 'YES', 23000.00, 400000.00, 'Yes', '1910-01-01', 'NA', '2020-01-03 03:54:31', '2020-01-03 03:56:00', NULL),
(77, 77, 79, 3, 'Dream Car Gallery', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-03 03:55:18', '2020-01-03 04:57:14', NULL),
(78, 78, 78, 4, 'PANCHO GATEWAY FIFTH AVENUE LLC', '1.00', 'Sole Proprietorship', 'no', 0.00, 1557067.00, 'Yes', '1910-01-01', 'NA', '2020-01-03 03:57:47', '2020-01-03 03:57:55', NULL),
(79, 79, 81, 3, 'BC PLUMBING LLC', '4.00', 'Limited Liability Company-LLC', 'yes', 2000.00, 200000.00, 'No', '1910-01-01', 'NA', '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(80, 80, 83, 4, 'AT HOME INC', '5.00', 'Corporation', 'NO', 39413.58, 118240.76, 'No', '1910-01-01', 'NA', '2020-01-03 04:17:13', '2020-01-03 04:17:24', NULL),
(81, 81, 84, 3, 'Chic Boutique', '1.00', 'Sole Proprietorship', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-03 04:27:47', '2020-01-03 04:57:06', NULL),
(82, 82, 85, 3, 'Marquez Auto Repair', '2.00', 'Corporation', 'no', 0.00, 0.00, 'No', '1910-01-01', 'NA', '2020-01-03 04:51:19', '2020-01-03 04:57:22', NULL);

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

--
-- Dumping data for table `contact_docs`
--

INSERT INTO `contact_docs` (`id`, `user_id`, `contact_id`, `filename`, `document_title`, `document_type`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 52, '20191230153143251.pdf', '20191230153143251.pdf', 10, 'order enrolling the foreign judgment in Tennessee', '2019-12-31 22:57:19', '2019-12-31 22:57:19', NULL);

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
(5, 3, 20, 0, 'Add New Note', 'Note Title: UCC\'s updates needed, Note ID: 4', 'Notes', '2019-12-21 03:00:04', '2019-12-21 03:00:04', NULL),
(6, 3, 52, 0, 'Add New Document', 'Document File Name: 20191230153143251.pdf', 'Docs', '2019-12-31 22:57:19', '2019-12-31 22:57:19', NULL),
(7, 1, 2, 0, 'Add New Note', 'Note Title: Test Only, Note ID: 5', 'Notes', '2020-01-02 14:02:59', '2020-01-02 14:02:59', NULL),
(8, 1, 2, 0, 'Delete Note', 'Note ID: 5', 'Notes', '2020-01-02 14:03:16', '2020-01-02 14:03:16', NULL),
(9, 1, 55, 0, 'Add New Note', 'Note Title: Test only, Note ID: 6', 'Notes', '2020-01-02 17:07:10', '2020-01-02 17:07:10', NULL),
(10, 1, 55, 0, 'Delete Note', 'Note ID: 6', 'Notes', '2020-01-02 18:04:23', '2020-01-02 18:04:23', NULL);

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
(25, 25, 25, 3, 49300.00, '2019-12-27 00:25:39', '2019-12-27 00:25:39', NULL),
(26, 26, 26, 15, 353705.14, '2019-12-28 01:09:19', '2019-12-28 01:09:19', NULL),
(27, 27, 27, 15, 387817.20, '2019-12-28 01:51:33', '2019-12-28 01:51:33', NULL),
(28, 28, 28, 15, 88200.00, '2019-12-28 02:16:45', '2019-12-28 02:18:12', NULL),
(29, 29, 29, 15, 86221.97, '2019-12-28 03:34:04', '2019-12-28 03:34:04', NULL),
(30, 30, 29, 15, 86221.97, '2019-12-28 03:34:05', '2019-12-28 03:34:05', NULL),
(31, 31, 30, 15, 40500.00, '2019-12-28 03:52:40', '2019-12-28 03:52:40', NULL),
(32, 32, 30, 15, 34250.00, '2019-12-28 03:59:39', '2019-12-28 03:59:39', NULL),
(33, 33, 31, 15, 177556.89, '2019-12-28 04:16:22', '2019-12-28 04:16:22', NULL),
(34, 34, 32, 15, 453554.15, '2019-12-28 04:45:22', '2019-12-28 04:45:22', NULL),
(35, 35, 34, 3, 98640.00, '2019-12-31 00:14:08', '2019-12-31 00:14:08', NULL),
(36, 36, 35, 3, 13100.00, '2019-12-31 00:37:43', '2019-12-31 00:37:43', NULL),
(37, 37, 36, 3, 35000.00, '2019-12-31 00:45:12', '2019-12-31 00:45:12', NULL),
(38, 38, 37, 3, 58400.00, '2019-12-31 00:51:00', '2019-12-31 00:51:00', NULL),
(39, 39, 38, 4, 44970.00, '2019-12-31 01:24:51', '2019-12-31 01:24:51', NULL),
(40, 40, 39, 4, 22485.00, '2019-12-31 01:50:46', '2019-12-31 01:50:46', NULL),
(41, 41, 41, 3, 115268.29, '2019-12-31 02:22:24', '2019-12-31 02:22:24', NULL),
(42, 42, 40, 4, 14900.00, '2019-12-31 02:23:08', '2019-12-31 02:23:08', NULL),
(43, 43, 42, 3, 64748.64, '2019-12-31 02:30:52', '2019-12-31 02:30:52', NULL),
(44, 44, 43, 3, 49700.00, '2019-12-31 03:16:19', '2019-12-31 03:16:19', NULL),
(45, 45, 46, 3, 54000.00, '2019-12-31 03:22:19', '2019-12-31 03:22:19', NULL),
(46, 46, 45, 4, 21750.00, '2019-12-31 03:24:54', '2019-12-31 03:24:54', NULL),
(47, 47, 33, 3, 599865.24, '2019-12-31 03:31:23', '2019-12-31 03:55:00', NULL),
(48, 48, 47, 4, 44970.00, '2019-12-31 03:41:07', '2019-12-31 03:41:07', NULL),
(49, 49, 49, 3, 86400.00, '2019-12-31 03:59:58', '2019-12-31 03:59:58', NULL),
(50, 50, 50, 3, 127800.00, '2019-12-31 04:04:23', '2019-12-31 04:04:23', NULL),
(51, 51, 51, 3, 45560.00, '2019-12-31 04:12:51', '2019-12-31 04:12:51', NULL),
(52, 52, 53, 3, 2998000.00, '2019-12-31 22:56:25', '2019-12-31 22:56:25', NULL),
(53, 53, 54, 4, 70000.00, '2019-12-31 23:05:03', '2019-12-31 23:05:03', NULL),
(54, 54, 55, 4, 14990.00, '2019-12-31 23:49:46', '2019-12-31 23:49:46', NULL),
(55, 55, 56, 4, 67455.00, '2020-01-01 00:30:08', '2020-01-01 00:30:08', NULL),
(56, 56, 58, 3, 110154.14, '2020-01-02 22:49:37', '2020-01-03 03:40:06', NULL),
(57, 57, 59, 3, 500000.00, '2020-01-02 22:58:40', '2020-01-03 02:14:55', NULL),
(58, 58, 57, 4, 51065.00, '2020-01-02 23:01:25', '2020-01-02 23:01:25', NULL),
(59, 59, 61, 4, 44970.00, '2020-01-02 23:09:02', '2020-01-02 23:09:02', NULL),
(60, 60, 60, 3, 25000.00, '2020-01-02 23:11:57', '2020-01-03 03:37:25', NULL),
(61, 61, 63, 4, 15739.50, '2020-01-02 23:21:50', '2020-01-02 23:21:50', NULL),
(62, 62, 64, 4, 112425.00, '2020-01-02 23:29:05', '2020-01-02 23:29:05', NULL),
(63, 63, 62, 3, 67481.72, '2020-01-02 23:35:10', '2020-01-03 03:35:15', NULL),
(64, 64, 65, 3, 20000.00, '2020-01-02 23:49:29', '2020-01-03 03:37:03', NULL),
(65, 65, 66, 4, 52465.00, '2020-01-02 23:51:15', '2020-01-02 23:51:15', NULL),
(66, 66, 67, 4, 87540.00, '2020-01-03 00:04:06', '2020-01-03 00:04:06', NULL),
(67, 67, 68, 3, 11200.00, '2020-01-03 00:16:52', '2020-01-03 03:38:27', NULL),
(68, 68, 69, 4, 279800.00, '2020-01-03 00:21:28', '2020-01-03 00:21:28', NULL),
(69, 69, 70, 4, 17988.00, '2020-01-03 00:28:23', '2020-01-03 00:28:23', NULL),
(70, 70, 72, 4, 149900.00, '2020-01-03 02:12:06', '2020-01-03 02:12:06', NULL),
(71, 71, 73, 3, 100000.00, '2020-01-03 02:15:50', '2020-01-03 03:34:32', NULL),
(72, 72, 74, 3, 10000.00, '2020-01-03 02:54:51', '2020-01-03 03:38:06', NULL),
(73, 73, 75, 3, 35000.00, '2020-01-03 03:02:07', '2020-01-03 03:34:10', NULL),
(74, 74, 76, 3, 10000.00, '2020-01-03 03:08:45', '2020-01-03 03:37:40', NULL),
(75, 75, 77, 3, 9000.00, '2020-01-03 03:24:01', '2020-01-03 03:34:23', NULL),
(76, 76, 80, 3, 74500.00, '2020-01-03 03:54:31', '2020-01-03 03:54:31', NULL),
(77, 77, 79, 3, 50000.00, '2020-01-03 03:55:18', '2020-01-03 04:57:14', NULL),
(78, 78, 78, 4, 262325.00, '2020-01-03 03:57:47', '2020-01-03 03:57:47', NULL),
(79, 79, 81, 3, 13410.00, '2020-01-03 04:13:34', '2020-01-03 04:13:34', NULL),
(80, 80, 83, 4, 17988.00, '2020-01-03 04:17:13', '2020-01-03 04:17:13', NULL),
(81, 81, 84, 3, 24265000.00, '2020-01-03 04:27:47', '2020-01-03 04:57:06', NULL),
(82, 82, 85, 3, 11000.00, '2020-01-03 04:51:19', '2020-01-03 04:57:22', NULL);

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
  `legal_scrub` longtext COLLATE utf8mb4_unicode_ci,
  `notify_user_id` int(11) NOT NULL,
  `cc_emails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_notes`
--

INSERT INTO `contact_notes` (`id`, `user_id`, `contact_id`, `note_type_id`, `note_title`, `note_content`, `legal_scrub`, `notify_user_id`, `cc_emails`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 23, 1, 'test', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>', NULL, 0, '', '2019-12-20 19:02:41', '2019-12-20 19:02:41', NULL),
(2, 0, 23, 1, 'test', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>test</li>\r\n	<li>test</li>\r\n	<li>test</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tt</li>\r\n</ul>\r\n\r\n<p>setse</p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>\r\n\r\n<p>&nbsp;</p>', NULL, 0, '', '2019-12-20 19:06:02', '2019-12-20 19:06:02', NULL),
(3, 0, 23, 1, 'Test Note', '<ul>\r\n	<li>\r\n	<h2>Test123</h2>\r\n	</li>\r\n	<li>123test</li>\r\n	<li>another</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, '', '2019-12-20 19:15:35', '2019-12-20 19:15:48', '2019-12-20 19:15:48'),
(4, 0, 20, 1, 'UCC\'s updates needed', '<p>I asked Randy to please get the following updates.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>&nbsp;&nbsp;&nbsp;CerCo Inc-&nbsp;127 Dale St, West Babylon, NY 11704</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Electro-Motive Diesel- 9301 W. 55th St.&nbsp;LaGrange, IL 60525&nbsp;</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gentherm-&nbsp;21680 Haggerty Road,&nbsp;Northville, MI 48167</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hercules Engine Components- 2770 South Erie St, Massillon, OH 44646</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invacare Corp.-&nbsp;1 Invacare Way&nbsp;Elyria, OH 44035-4190</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jeld-Wen Windows-&nbsp;<a href=\"mailto:investors@jeldwen.com\" target=\"_blank\">investors@jeldwen.com</a></li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mast Powertrain LLC-&nbsp;330 Nw Stallings Drive,&nbsp;Nacogdoches,&nbsp;TX&nbsp;75964&nbsp;</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nordson Corporation-&nbsp;28601 Clemens Road,&nbsp;Westlake, OH 44145 USA</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Omni Die Casting, Inc.-&nbsp;1100 Nova Dr. SE, Massillon, OH 44646</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quality Glass Block-&nbsp;1347 East St, Morris, IL 60450</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ritchey Livestock ID 13821 Sable Boulevard, Brighton, Colorado 80601</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seves Glass Block Inc.-<strong>&nbsp;</strong>10576 Broadview Road, Broadview Heights, Ohio 44147</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tri-Flex of Ohio, Inc-&nbsp;2701 Applegrove Street Nw,&nbsp;North Canton,&nbsp;OH&nbsp;44720&nbsp;</li>\r\n	<li>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Progress Rail Services- 1600 Progress DriveP.O. Box 1037Albertville,&nbsp;AL&nbsp;35950</li>\r\n</ul>', NULL, 0, '', '2019-12-21 03:00:04', '2019-12-21 03:00:04', NULL),
(5, 0, 2, 1, 'Test Only', '<h2 style=\"font-style:normal\">Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<ul>\r\n	<li>dfddfdfd</li>\r\n	<li>dfdfdfdfd</li>\r\n	<li>dfdfdsf</li>\r\n</ul>\r\n\r\n<h2 style=\"font-style:normal\">Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style=\"font-style:normal\">Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, 0, '', '2020-01-02 14:02:59', '2020-01-02 14:03:16', '2020-01-02 14:03:16'),
(6, 0, 55, 3, 'Test only', '<p>This is only a test..</p>', '<p>This is only a test.</p>', 0, '', '2020-01-02 17:07:10', '2020-01-02 18:04:23', '2020-01-02 18:04:23'),
(7, 0, 55, 1, 'legal_scrub', 'legal_scrub', '<h2 style=\"font-style:normal\">Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<h2 style=\"font-style:normal\">Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<ul>\r\n	<li>dfdfd</li>\r\n	<li>dfdf</li>\r\n	<li>dfdf</li>\r\n	<li>dfdf</li>\r\n</ul>\r\n\r\n<h2 style=\"font-style:normal\">Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 0, NULL, '2020-01-02 17:44:56', '2020-01-02 18:03:11', NULL),
(8, 0, 23, 1, 'legal_scrub', 'legal_scrub', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>test</li>\r\n	<li>test</li>\r\n	<li>test</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tes</li>\r\n	<li>tt</li>\r\n</ul>\r\n\r\n<p>setse</p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem</p>', 0, NULL, '2020-01-02 18:08:41', '2020-01-02 18:08:41', NULL);

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
(1, 1, 'Admin', 'Admin', 'Admin', '09279983995', NULL, NULL, 'admin', 'bryann.revina@gmail.com', NULL, '$2y$10$t780SAl1b2k0yXzhh5eCtuwOjgzBEukfDScQrs6CW/FUzJHhAF2qK', NULL, '0723844514a8e149966354f21b337c34.jpg', 0, NULL, '2019-05-11 11:03:15', '2020-01-03 12:33:57', NULL, '2020-01-03 06:33:57', NULL),
(2, 1, 'bonn', 'Bonn', 'Mendoza', '123456789', '123456', '1234t', 'bonn22', 'bonnmendoza@gmail.com', NULL, '$2y$10$JJOEM2xTebk3IXslpT.K0u8a4j2Jmau5HTgCDWgvW8g0yihsBBPGS', NULL, NULL, 0, NULL, '2019-12-07 17:04:58', '2019-12-07 17:04:58', NULL, NULL, NULL),
(3, 1, NULL, 'Carolina', 'Alcaraz', '(646) 766-8010', '(646) 766-8010', '(646) 766-8010', 'calcaraz', 'calcaraz@rtrrecoveryllc.com', NULL, '$2y$10$yTKD1A5ZeF7NB/hnKGy80uJcMaAJOukvnYFeyVQGqLFurWByg61i.', NULL, 'no-image.png', 0, NULL, '2019-12-09 21:44:16', '2020-01-03 03:47:02', NULL, '2020-01-02 21:47:02', NULL),
(4, 1, 'Kem', 'Kemery', 'Brisso', '347-321-9537', '347-321-9537', NULL, 'kbrisso', 'admin@capcallllc.com', NULL, '$2y$10$u/yDktEwfR1SPcYteZxTvePSk4wOw7Z56GZKuw4amWJDAuW3rkhFa', NULL, NULL, 0, NULL, '2019-12-17 05:42:52', '2020-01-02 22:31:28', NULL, '2020-01-02 16:31:28', NULL),
(5, 1, 'Nerissa', 'Nerissa', 'Thomas', '718-775-3921', NULL, NULL, 'nthomas', 'nthomas@rtrrecoveryllc.com', NULL, '$2y$10$9x69Bkp5.tdiV9wT5P3jz.63sdMwhhizodaAyctOEaNZ9jP4hFRI6', NULL, NULL, 0, NULL, '2019-12-17 05:44:21', '2020-01-02 22:03:11', NULL, '2020-01-02 16:03:11', NULL),
(6, 4, 'Jen', 'Jeniel', 'Mangahis', '6463090599', '123123123', '012312312', 'jeniel123', 'jeniel.mangahis@gmail.com', NULL, '$2y$10$HujgTX2OJPfLteCloR81n.LxAprXSjoQC8yHf8lpn9osZj3AE9Th.', NULL, NULL, 0, NULL, '2019-12-20 13:31:51', '2020-01-02 18:08:08', NULL, '2020-01-02 12:08:08', NULL),
(7, 2, 'Jeniel', 'Test jeniel', 'Test last', '2123123', '123123213', '12312312', 'jen123', 'jeniel.mangahis.test@gmail.com', NULL, '$2y$10$8iLJKnrjsgxhZXk4t9rhjuhWdSWU.3Eb1HZdiDo/yq6ckngxYDfS2', NULL, '7a5b155c95ff199e519b7d4f496f7f62.png', 0, NULL, '2019-12-20 19:34:51', '2019-12-27 15:20:56', NULL, '2019-12-27 09:20:56', NULL),
(8, 1, NULL, 'Douglas', 'Robinson', '(718) 775-3673', '(718) 775-3673', '(718) 775-3673', 'drobinson', 'drobinson@rtrrecoveryllc.com', NULL, '$2y$10$OE7SARDydvYFwozmNSylYOIdCfixeBcjqhv1DIkDkccRkGBK2Bdh.', NULL, NULL, 0, NULL, '2019-12-21 03:10:04', '2019-12-21 03:10:04', NULL, NULL, NULL),
(9, 4, NULL, 'Randy', 'Hamilton', '(718)-775-3363', '(718)-775-3363', '(718)-775-3363', 'rhamilton', 'rhamilton@rtrrecoveryllc.com', NULL, '$2y$10$.NdzHpydX06skGk86QjDTOrYy26czC2SH4ymgvg9YlorZO6fZVZ5m', NULL, NULL, 0, NULL, '2019-12-21 03:11:26', '2019-12-21 03:11:26', NULL, NULL, NULL),
(10, 4, NULL, 'Ashley', 'Bristol', '(646) 766-8010', '(646) 766-8010', '(646) 766-8010', 'abristol', 'abristol@rtrrecoveryllc.com', NULL, '$2y$10$ovX3k45uEe2dac0yGWmz3OjBewQKWQpWqj8mha2/9dIpQKTSPj7Rq', NULL, NULL, 0, NULL, '2019-12-21 03:16:06', '2019-12-21 03:16:06', NULL, NULL, NULL),
(11, 4, NULL, 'Tamara', 'Rodney', '(718) 775-3728', '(718) 775-3728', '(718) 775-3728', 'trodney', 'trodney@rtrrecoveryllc.com', NULL, '$2y$10$MHM0ntSCmgxJOp3HHjlWauThoxqhm3uGCUMJtSf.TWShK0/Doye3K', NULL, NULL, 0, NULL, '2019-12-21 03:19:25', '2019-12-21 03:19:25', NULL, NULL, NULL),
(13, 1, NULL, 'Jason', 'Leak', '718-775-3743', NULL, NULL, 'jleak', 'Jleak@capcallllc.com', NULL, '$2y$10$2CtGCtnBQnEV7WPkpJOFfOCZqzvJWUGkkaHZnOFW9kiazveX/gvre', NULL, NULL, 0, NULL, '2019-12-21 03:55:37', '2019-12-21 03:55:37', NULL, NULL, NULL),
(15, 1, NULL, 'Intern', 'Intern', '646-766-8010', NULL, NULL, 'admin@rtrrecoveryllc.com', 'admin@rtrrecoveryllc.com', NULL, '$2y$10$nooZoLWNppgZL/RkAkjpVOW.gX1ODbSjTjmn8aYHMSlw23DbWoz5.', NULL, NULL, 0, NULL, '2019-12-28 00:07:51', '2019-12-28 00:11:14', NULL, '2019-12-27 18:11:14', NULL),
(16, 2, NULL, 'Carolina', 'Alcaraz', '2019258269', NULL, NULL, 'cfernece', 'cfernece@gmail.com', NULL, '$2y$10$lQf3R.i5UemA7a.XCZLnxOyY6DxsXeAme3e2M7iI8CQM.ngfzgYMC', NULL, NULL, 0, NULL, '2019-12-31 02:48:03', '2020-01-03 01:09:16', NULL, '2020-01-02 19:09:16', NULL),
(17, 2, NULL, 'Daren', 'Dorval', '2019258269', '2019258269', '2019258269', 'droc', 'daren@rocfundinggroup.com', NULL, '$2y$10$Xs6jGJBNAjlIu/V1y/ZGG.N1Ds3rISUav95xc0Ad77wB3sOA1Honi', NULL, NULL, 0, NULL, '2020-01-03 01:00:38', '2020-01-03 03:41:05', NULL, '2020-01-02 21:41:05', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `contact_bank_accounts`
--
ALTER TABLE `contact_bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_broker_informations`
--
ALTER TABLE `contact_broker_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `contact_business_informations`
--
ALTER TABLE `contact_business_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_events`
--
ALTER TABLE `contact_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_history`
--
ALTER TABLE `contact_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_loan_informations`
--
ALTER TABLE `contact_loan_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `contact_notes`
--
ALTER TABLE `contact_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
