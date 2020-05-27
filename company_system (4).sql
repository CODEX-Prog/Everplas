-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2020 at 02:22 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_job_orders`
--

CREATE TABLE `all_job_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `P_id` bigint(20) UNSIGNED DEFAULT NULL,
  `R_id` bigint(20) UNSIGNED DEFAULT NULL,
  `L_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requested_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `day_ago` bigint(20) NOT NULL,
  `related` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Job_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_job_orders`
--

INSERT INTO `all_job_orders` (`id`, `P_id`, `R_id`, `L_id`, `requested_by`, `from`, `description`, `date`, `day_ago`, `related`, `status`, `Job_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'Jehad Hameed Isa', 'XYZ comapny', 'dsc', '2020-04-27', 24, 'Purchasing', 'Not yet', 'JO-1589962779-0001', '2020-05-20 05:19:39', '2020-05-20 05:19:39'),
(3, NULL, 11, NULL, 'Jehad Hameed Isa', 'XYZ comapny', 'desc', '2020-04-27', 24, 'Receiving', 'Not yet', 'JO-1589965917-0011', '2020-05-20 06:11:57', '2020-05-20 06:11:57'),
(4, NULL, NULL, 15, 'Jehad Hameed Isa', 'XYZ comapny', '', '2020-05-20', 1, 'Sales', 'Not yet', 'JO-1589966330-0015', '2020-05-20 06:18:50', '2020-05-20 06:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `classification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `serial` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty_date` date DEFAULT NULL,
  `attachments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `prefix`, `name`, `description`, `manufacturer`, `delivery_date`, `cost`, `classification`, `company_id`, `contact_id`, `location`, `type`, `employee_id`, `serial`, `warranty_date`, `attachments`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'ACC-', '123', 'This is Asset Description', '123', '2019-11-22', 123, 'Public', 1, NULL, '123', 'Furniture', 2, '123', '2019-11-23', ',/uploads/inventory/attachments/123_attachments_0_1573023940.jpeg', 'aykut can', 'aykut can', '2019-11-06 04:05:40', '2019-11-06 04:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bank 1', '2019-11-03 02:55:57', '2019-11-03 02:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `client_groups`
--

CREATE TABLE `client_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_groups`
--

INSERT INTO `client_groups` (`id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Vip', '2019-10-30 03:35:53', 'aykut can', '2019-10-30 03:35:53', 'aykut can');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `address` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_card` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `telephone`, `created_at`, `created_by`, `updated_at`, `updated_by`, `vat_number`, `fax`, `website`, `group_id`, `address`, `city`, `country`, `company_card`, `Email`) VALUES
(1, 'XYZ Company', '123456789', '2019-10-30 03:36:34', 'aykut can', '2020-05-20 08:50:34', 'aykut can', '11111111', '2222222', 'www.domain.com', 1, '123123123', 'manama', 'bahrain', '/uploads/crm/company-logo/xyz-comapny_1572417394.jpeg', 'xyz@email.com'),
(2, 'ABC Company', '34243', '2020-05-19 05:44:36', 'aykut can', '2020-05-20 08:45:53', 'aykut can', '234234', '234234', 'www.abc.com', 1, 'vsdvsdvd', 'manama', 'Bahrain', '/uploads/crm/company-logo/_1589877876.jpg', 'abc@email.com'),
(5, 'DEF Company', '433', '2020-05-19 05:54:17', 'aykut can', '2020-05-20 08:46:35', 'aykut can', '40', '22', 'www.def.com', 1, 'vsdvsdvd', 'Hidd', 'Bahrain', '/uploads/crm/company-logo/_1589878457.jpg', 'def@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE `company_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`id`, `name`, `address`, `telephone`, `fax`, `logo`, `email`, `website`, `vat_number`, `created_at`, `updated_at`) VALUES
(6, 'EVERPLAS', 'Bldg: 1342, Road 5136 Askar, Bahrain', '17830115', '17830242', '/uploads/setting/comp-logo/everplas_1589283953.jpg', 'info@everplas.org', 'http://everplas.org', '22', '2020-05-12 08:45:53', '2020-05-13 05:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_telephone` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_mobile` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_mobile2` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_job` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `contact_country` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `contact_business_card` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_name`, `contact_email`, `contact_telephone`, `contact_mobile`, `contact_mobile2`, `contact_job`, `company_id`, `contact_country`, `group_id`, `contact_business_card`, `created_at`, `created_by`, `updated_at`, `updated_by`, `contact_address`, `contact_city`) VALUES
(3, '323', 'user@user.com', '3232', '44', '2323', '44', 1, 'Bahrain', 1, '/uploads/crm/contact-card/323_1590054008.jpg', '2020-05-19 04:46:14', 'aykut can', '2020-05-21 06:40:08', 'aykut can', 'vcdx', 'hidd'),
(4, 'emp1', 'user@user.com', '34243', '432345', '5432345', '432345', 2, 'Bahrain', 1, '/uploads/crm/contact-card/emp1_1590054228.jpg', '2020-05-21 05:20:17', 'aykut can', '2020-05-21 06:43:48', 'aykut can', 'tgrvfrgb54r4fr', 'Muharraq');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2019-11-03 02:56:09', '2019-11-03 02:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `marital` tinyint(1) NOT NULL,
  `phone` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `nationality` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpr_number` int(11) NOT NULL,
  `cpr_exp` date NOT NULL,
  `passport_number` int(11) NOT NULL,
  `passport_exp` date NOT NULL,
  `working_as` int(11) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `destination` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `leaves_day` int(11) NOT NULL,
  `salary_transfer_type` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `employee_cosi` int(11) NOT NULL,
  `company_cosi` int(11) NOT NULL,
  `lmra_monthly_fee` int(11) NOT NULL,
  `lmra_visa_fee` int(11) NOT NULL,
  `visa_exp_date` date NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `iban` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_license` tinyint(1) NOT NULL,
  `blood_type` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_contact_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_contact_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_contact_relation` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commotion_type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `personal_photo` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_copies` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `full_name`, `email`, `birthday`, `marital`, `phone`, `gender`, `nationality`, `address`, `cpr_number`, `cpr_exp`, `passport_number`, `passport_exp`, `working_as`, `department_id`, `destination`, `join_date`, `end_date`, `leaves_day`, `salary_transfer_type`, `basic_salary`, `employee_cosi`, `company_cosi`, `lmra_monthly_fee`, `lmra_visa_fee`, `visa_exp_date`, `bank_id`, `iban`, `short_name`, `driving_license`, `blood_type`, `emerg_contact_name`, `emerg_contact_number`, `emerg_contact_relation`, `commotion_type`, `created_at`, `updated_at`, `personal_photo`, `doc_copies`) VALUES
(2, 'Jehad Hameed Isa', 'jehad.almahari@gmail.com', '1986-06-17', 1, '123456789', 0, 'bahraini', '123', 123, '2019-11-16', 1, '2019-11-24', 1, 1, 'IT', '2019-11-04', '2027-07-05', 30, 3, 1000, 10, 10, 10, 10, '2019-11-28', 1, '11BBH24723745837836', '1', 1, 'B+', '123123', '123123123', 'Brother', 2, '2019-11-06 04:05:06', '2019-11-06 04:05:06', '/uploads/hrm/personal/jehad-hameed-isa_personal_1573023906.jpeg', ',/uploads/hrm/doc-copies/jehad-hameed-isa_doc_copy_0_1573023906.png');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `all_day` tinyint(1) NOT NULL,
  `url` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `all_day`, `url`, `created_at`, `updated_at`) VALUES
(1, 'cool', '2020-05-02 12:00:00', '2020-05-02 02:00:00', 0, NULL, '2020-05-13 05:29:06', '2020-05-13 05:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_material`
--

CREATE TABLE `job_material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_material`
--

INSERT INTO `job_material` (`id`, `job_id`, `material_id`, `description`, `quantity`, `weight`, `amount`, `created_at`, `updated_at`) VALUES
(14, 11, 1, '', 0, 0, 0, '2020-05-20 06:54:05', '2020-05-20 06:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `job_orders`
--

CREATE TABLE `job_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `documents` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `importance` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_orders`
--

INSERT INTO `job_orders` (`id`, `subject`, `company_id`, `contact_id`, `status`, `start_date`, `due_date`, `amount`, `documents`, `employee_id`, `importance`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(11, 'purchasing iron', 1, NULL, 'In Process', '2020-04-27', '2020-05-31', 54, ',/uploads/receiving/joborders/purchasing-iron_documents_0_1589968445.jpg', 2, 'Urgent', 'desc', 'aykut can', 'aykut can', '2020-05-20 06:11:57', '2020-05-20 06:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `till_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` double(8,2) NOT NULL,
  `total_vat` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `subject`, `related`, `company_id`, `contact_id`, `date`, `till_date`, `status`, `employee_id`, `address`, `country`, `city`, `email`, `phone`, `subtotal`, `total_vat`, `discount`, `total`, `created_at`, `updated_at`) VALUES
(1, 'test 1 new', 'Lead', 1, NULL, '2020-05-11', '2020-06-11', 'Open', 2, '123123123', 'bahrain', 'manama', 'xyz@email.com', '123456789', 1155.00, 55.00, 0.50, 1155.00, '2020-05-21 08:55:48', '2020-05-21 08:55:48'),
(2, 'test 1', 'Sales', 1, NULL, '2020-05-13', '2020-06-13', 'Declined', 2, '123123123', 'bahrain', 'manama', 'xyz@email.com', '123456789', 315.00, 15.00, 3.50, 311.50, '2020-05-20 06:59:48', '2020-05-20 06:59:48'),
(4, 'COOL', 'Sales', 1, NULL, '2020-05-14', '2020-06-14', 'Accepted', 2, '123123123', 'bahrain', 'manama', 'xyz@email.com', '123456789', 315.00, 15.00, 0.00, 315.00, '2020-05-14 08:28:25', '2020-05-14 08:28:25'),
(5, 'COOL', 'Sales', 1, NULL, '2020-05-14', '2020-06-14', 'Accepted', 2, '123123123', 'bahrain', 'manama', 'xyz@email.com', '123456789', 315.00, 15.00, 0.00, 315.00, '2020-05-14 08:28:25', '2020-05-14 08:28:25'),
(6, 'dscsdc', 'Sales', 1, NULL, '2020-05-14', '2020-06-14', 'Accepted', 2, '123123123', 'bahrain', 'manama', 'xyz@email.com', '123456789', 105.00, 5.00, 0.00, 105.00, '2020-05-14 08:29:43', '2020-05-14 08:29:43'),
(14, 'COOL', 'Sales', 1, NULL, '2020-05-17', '2020-06-17', 'Accepted', 2, '123123123', 'bahrain', 'manama', 'xyz@email.com', '123456789', 630.00, 30.00, 0.00, 630.00, '2020-05-20 07:23:11', '2020-05-20 07:23:11'),
(15, 'new sale', 'Lead', NULL, 4, '2020-05-20', '2020-06-20', 'Declined', 2, 'tgrvfrgb54r4fr', 'Bahrain', 'Muharraq', 'user@user.com', '34243', 1260.00, 60.00, 0.00, 1260.00, '2020-05-21 08:38:41', '2020-05-21 08:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `lead_products`
--

CREATE TABLE `lead_products` (
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `prod_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `vat` int(11) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_products`
--

INSERT INTO `lead_products` (`lead_id`, `product_id`, `prod_name`, `description`, `qty`, `rate`, `vat`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, '111', 'cool', 2, 100, 10, 210.00, '2020-05-21 08:55:48', '2020-05-21 08:55:48'),
(1, 2, '123', 'some desc', 3, 300, 45, 945.00, '2020-05-21 08:55:48', '2020-05-21 08:55:48'),
(2, 1, '111', 'cool product', 3, 100, 15, 315.00, '2020-05-20 06:59:48', '2020-05-20 06:59:48'),
(4, 2, '123', '', 1, 300, 15, 315.00, '2020-05-14 08:28:25', '2020-05-14 08:28:25'),
(5, 2, '123', '', 1, 300, 15, 315.00, '2020-05-14 08:28:25', '2020-05-14 08:28:25'),
(6, 1, '111', '', 1, 100, 5, 105.00, '2020-05-14 08:29:43', '2020-05-14 08:29:43'),
(14, 2, '123', 'dfdfdf', 2, 300, 30, 630.00, '2020-05-20 07:23:11', '2020-05-20 07:23:11'),
(15, 2, '123', '', 4, 300, 60, 1260.00, '2020-05-21 08:38:41', '2020-05-21 08:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mainten_employee_id` bigint(20) UNSIGNED NOT NULL,
  `super_employee_id` bigint(20) UNSIGNED NOT NULL,
  `review_employee_id` bigint(20) UNSIGNED NOT NULL,
  `review_date` date NOT NULL,
  `close_date` date NOT NULL,
  `reports` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintenances`
--

INSERT INTO `maintenances` (`id`, `asset_id`, `company_id`, `start_date`, `end_date`, `description`, `mainten_employee_id`, `super_employee_id`, `review_employee_id`, `review_date`, `close_date`, `reports`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-11-27', '2019-11-30', 'aaaaaaaaaaaaaa', 2, 2, 2, '2019-11-13', '2019-11-27', ',/uploads/inventory/maintenance/reports_0_1573024067.jpg', 'aykut can', 'aykut can', '2019-11-06 04:07:47', '2019-11-06 04:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `code`, `created_at`, `updated_at`, `company_id`, `contact_id`, `created_by`, `updated_by`) VALUES
(1, 'Iron', 'IRON-001', '2019-11-11 03:08:54', '2020-05-20 08:53:09', 2, NULL, 'aykut can', 'aykut can'),
(2, 'Plastic', 'Plastic-001', '2020-05-16 19:08:23', '2020-05-16 19:08:23', 1, NULL, 'aykut can', 'aykut can'),
(3, 'Wood', 'Wood-001', '2020-05-17 05:16:39', '2020-05-20 08:53:17', 5, NULL, 'aykut can', 'aykut can');

-- --------------------------------------------------------

--
-- Table structure for table `material_product`
--

CREATE TABLE `material_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_product`
--

INSERT INTO `material_product` (`id`, `material_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_purchasing`
--

CREATE TABLE `material_purchasing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pur_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_purchasing`
--

INSERT INTO `material_purchasing` (`id`, `pur_id`, `material_id`, `description`, `quantity`, `weight`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'wood logs', 55, 200, 450, '2020-05-20 05:19:39', '2020-05-20 05:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_10_13_061918_create_group_table', 2),
(5, '2019_10_13_072753_change_group_table_name', 2),
(6, '2019_10_13_180746_add_fields_into_users', 2),
(7, '2019_10_16_034255_create_companies_table', 2),
(8, '2019_10_16_041940_add_field_into_companies_table', 3),
(9, '2019_10_16_151923_create_contacts_table', 3),
(10, '2019_10_17_030949_create_events_table', 3),
(11, '2019_10_17_073924_change_fields_in_events', 4),
(12, '2019_10_17_173131_create_employees_table', 4),
(13, '2019_10_18_042031_add_fields_into_employees_table', 5),
(14, '2019_10_18_042624_change_fields_in_employees', 5),
(15, '2019_10_18_123045_change_personal_photo_field_in_employees', 5),
(16, '2019_10_18_150823_create_materials_table', 5),
(17, '2019_10_19_180323_create_compnayinformations_table', 5),
(18, '2019_10_19_190415_change_compnayinformations_table_into_companyinformations', 6),
(19, '2019_10_19_192941_create_prefixes_table', 6),
(20, '2019_10_21_021136_create_sms_table', 6),
(21, '2019_10_21_023217_create_paymentmethods_table', 6),
(22, '2019_10_21_023419_create_productcategories_table', 6),
(23, '2019_10_21_023542_create_taskcategories_table', 6),
(24, '2019_10_21_023718_create_itemcategories_table', 6),
(25, '2019_10_21_025851_change_companyinforamtions_table_name_with_company_informations', 7),
(26, '2019_10_21_030135_change_itemcategories_table_name_with_item_categories', 7),
(27, '2019_10_21_030337_change_paymentmethods_table_name_with_payment_methods', 7),
(28, '2019_10_21_030549_change_productcategories_table_name_with_product_categories', 7),
(29, '2019_10_21_030752_change_taskcategories_table_name_with_task_categories', 7),
(30, '2019_10_22_042106_set_default_value_of_fields_in_users_table', 7),
(31, '2019_10_24_102018_change_groups_talbe_name_with_user_groups', 7),
(32, '2019_10_24_102729_create_client_groups_table', 8),
(33, '2019_10_28_103112_add_fields_to_client_groups', 8),
(34, '2019_10_28_131456_add_field_to_contacts', 8),
(35, '2019_10_28_140739_add_fields_to_companies', 9),
(36, '2019_10_28_154858_change_field_in_companies', 10),
(37, '2019_10_29_015953_add_fields_to_contacts', 10),
(38, '2019_11_02_105354_create_departments_table', 11),
(39, '2019_11_02_132056_create_banks_table', 11),
(40, '2019_11_02_142132_alter_fields_in_employees', 11),
(41, '2019_11_02_142913_add_constraints_to_employees', 12),
(42, '2019_11_04_100338_create_assets_table', 13),
(43, '2019_11_04_133707_alter_fields_of_assets', 13),
(44, '2019_11_05_005124_create_maintenances_table', 13),
(45, '2019_11_06_140938_add_fields_to_materials', 14),
(46, '2019_11_06_175612_create_products', 14),
(47, '2019_11_06_182759_create_material_product_table', 14),
(48, '2019_11_06_192601_alter_fields_of_products', 14),
(49, '2019_11_06_193712_add_fields_to_products', 14),
(50, '2019_11_11_114452_create_job_orders_table', 15),
(51, '2019_11_11_125233_create_job_material_table', 15),
(52, '2019_12_26_135034_add_fields_to_products', 16),
(53, '2019_12_28_111924_delete_columns_from_products', 17),
(54, '2020_01_03_112401_create_leads_table', 17),
(55, '2020_01_03_140437_create_lead_products_table', 17),
(56, '2020_01_03_142019_alter_fields_of_leads', 18),
(60, '2020_04_28_120642_create_lead_products_table', 19),
(61, '2020_05_11_100156_add_user_id_to_companyinfo', 20),
(65, '2020_05_11_110403_add_email_to_companies', 21),
(104, '2020_05_16_130202_create_purchasing_orders_table', 22),
(105, '2020_05_16_133313_create_material_purchasing_table', 22),
(106, '2020_05_17_075059_create_all_job_orders_table', 22),
(108, '2020_05_21_075752_add_more_fields_to_contacts', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'qqq', '2020-01-12 05:21:01', '2020-01-12 05:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `prefixes`
--

CREATE TABLE `prefixes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quotation` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimation` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `po` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joborder` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_note` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiving` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accenting` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prefixes`
--

INSERT INTO `prefixes` (`id`, `invoice`, `quotation`, `estimation`, `po`, `joborder`, `receipt`, `credit_note`, `receiving`, `employee`, `accenting`, `bank`, `transaction`, `purchase`, `created_at`, `updated_at`) VALUES
(1, 'INV-', 'QUOT-', 'EST-', 'PO-', 'JO-', 'RPV-', 'CN-', 'RV-', 'EMP-', 'ACC-', 'BNK-', 'TRNS-', 'PRCH-', '2019-11-06 03:59:00', '2020-05-17 04:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thickness` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wt_size` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ending` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prefix_id`, `name`, `code`, `weight`, `color`, `thickness`, `length`, `wt_size`, `ending`, `category_id`, `price`, `photos`, `quantity`, `issue`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`, `size`) VALUES
(1, 'PO-', '111', '111111', '1', 'Black', '111', '11', '111', 'SP', 1, '100', ',/uploads/products/photos/111_photos_0_1578729369.png', '111', '111111-20200111', 'aykut can', 'aykut can', '2020-01-11 04:56:10', '2020-01-11 04:56:10', 1, '111'),
(2, 'PO-', '123', '32345', '1', 'Black', '544', '45', '34', 'SP', 1, '300', ',/uploads/products/photos/123_photos_0_1589440223.jfif', '45', '32345-20200514', 'aykut can', 'aykut can', '2020-05-14 04:10:23', '2020-05-14 04:10:23', 1, '457');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'aa', '2020-01-06 08:06:09', '2020-01-06 08:06:09'),
(2, '222', '2020-01-06 09:20:31', '2020-01-06 09:20:31'),
(3, 'qqq', '2020-01-06 09:20:40', '2020-01-06 09:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing_orders`
--

CREATE TABLE `purchasing_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `documents` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `importance` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasing_orders`
--

INSERT INTO `purchasing_orders` (`id`, `subject`, `company_id`, `contact_id`, `status`, `start_date`, `due_date`, `amount`, `documents`, `employee_id`, `importance`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'purchasing wood', 1, NULL, 'Not yet', '2020-04-27', '2020-06-07', 23, ',/uploads/purchasing/joborders/purchasing-wood_documents_0_1589962779.jpg', 2, 'Urgent', 'dsc', 'aykut can', 'aykut can', '2020-05-20 05:19:39', '2020-05-20 05:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `related` int(50) NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `till_date` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `subtotal` float NOT NULL,
  `total_vat` float NOT NULL,
  `discount` float NOT NULL,
  `total` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_categories`
--

CREATE TABLE `task_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aykut can',
  `user_view_permission` tinyint(1) NOT NULL DEFAULT 1,
  `user_delete_permission` tinyint(1) NOT NULL DEFAULT 1,
  `user_update_permission` tinyint(1) NOT NULL DEFAULT 1,
  `user_create_permission` tinyint(1) NOT NULL DEFAULT 1,
  `crm_view_permission` tinyint(1) NOT NULL DEFAULT 1,
  `crm_delete_permission` tinyint(1) NOT NULL DEFAULT 1,
  `crm_update_permission` tinyint(1) NOT NULL DEFAULT 1,
  `crm_create_permission` tinyint(1) NOT NULL DEFAULT 1,
  `grp_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `full_name`, `user_view_permission`, `user_delete_permission`, `user_update_permission`, `user_create_permission`, `crm_view_permission`, `crm_delete_permission`, `crm_update_permission`, `crm_create_permission`, `grp_id`) VALUES
(1, 'jehad.almahari', 'jehad.almahari@gmaccccil.com', NULL, '$2y$10$fAV3j7Z6Wibw8HpO3tUenuhWMizQBN8oWN0jbTOnbZnMeJC55dpiG', NULL, '2019-10-30 03:35:26', '2019-10-30 03:35:26', 'aykut can', 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(2, 'jehad almahari', 'jehad.almahari@hotmail.com', NULL, '$2y$10$WMe3edr.XLkzqFi8XziHfOWAQjB40fPoBeGeCKCF53HHQSrERbjQO', NULL, '2019-11-02 03:10:57', '2019-11-02 03:10:57', 'aykut can', 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(3, 'jehad.almahari', 'jehad.almahari@gmail.com', NULL, '$2y$10$dZxbTKl.Co3k9q3C4FkLxuIWTGzsSKmiJ/CKlP4gLw8NGx4ebOm/i', NULL, '2019-12-28 07:58:38', '2019-12-28 07:58:38', 'aykut can', 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(4, 'fahad', 'user@user.com', NULL, '$2y$10$ZB9zG.9UIs8gSydAS0zH2OYJiFBhHgRcepreusy6CKslc8Yo3DEgy', NULL, '2020-05-11 07:07:20', '2020-05-11 07:07:20', 'aykut can', 1, 1, 1, 1, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-05-11 21:00:00', '2020-05-11 21:00:00'),
(2, 'employee', '2020-05-11 21:00:00', '2020-05-11 21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_job_orders`
--
ALTER TABLE `all_job_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `all_job_orders_job_id_unique` (`Job_id`),
  ADD KEY `all_job_orders_l_id_foreign` (`L_id`),
  ADD KEY `all_job_orders_p_id_foreign` (`P_id`),
  ADD KEY `all_job_orders_r_id_foreign` (`R_id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assets_company_id_foreign` (`company_id`),
  ADD KEY `assets_contact_id_foreign` (`contact_id`),
  ADD KEY `assets_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_groups`
--
ALTER TABLE `client_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_company_name_unique` (`company_name`),
  ADD UNIQUE KEY `companies_telephone_unique` (`telephone`),
  ADD KEY `companies_group_id_foreign` (`group_id`);

--
-- Indexes for table `company_information`
--
ALTER TABLE `company_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_company_id_foreign` (`company_id`),
  ADD KEY `contacts_group_id_foreign` (`group_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_material`
--
ALTER TABLE `job_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_material_job_id_foreign` (`job_id`),
  ADD KEY `job_material_material_id_foreign` (`material_id`);

--
-- Indexes for table `job_orders`
--
ALTER TABLE `job_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_orders_company_id_foreign` (`company_id`),
  ADD KEY `job_orders_contact_id_foreign` (`contact_id`),
  ADD KEY `job_orders_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leads_company_id_foreign` (`company_id`),
  ADD KEY `leads_contact_id_foreign` (`contact_id`),
  ADD KEY `leads_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `lead_products`
--
ALTER TABLE `lead_products`
  ADD UNIQUE KEY `lead_id` (`lead_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenances_asset_id_foreign` (`asset_id`),
  ADD KEY `maintenances_company_id_foreign` (`company_id`),
  ADD KEY `maintenances_mainten_employee_id_foreign` (`mainten_employee_id`),
  ADD KEY `maintenances_super_employee_id_foreign` (`super_employee_id`),
  ADD KEY `maintenances_review_employee_id_foreign` (`review_employee_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materials_company_id_foreign` (`company_id`),
  ADD KEY `materials_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `material_product`
--
ALTER TABLE `material_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_product_material_id_foreign` (`material_id`),
  ADD KEY `material_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `material_purchasing`
--
ALTER TABLE `material_purchasing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_purchasing_pur_id_foreign` (`pur_id`),
  ADD KEY `material_purchasing_material_id_foreign` (`material_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefixes`
--
ALTER TABLE `prefixes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasing_orders`
--
ALTER TABLE `purchasing_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchasing_orders_company_id_foreign` (`company_id`),
  ADD KEY `purchasing_orders_contact_id_foreign` (`contact_id`),
  ADD KEY `purchasing_orders_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_categories`
--
ALTER TABLE `task_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `grp_id` (`grp_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_job_orders`
--
ALTER TABLE `all_job_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_groups`
--
ALTER TABLE `client_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company_information`
--
ALTER TABLE `company_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_material`
--
ALTER TABLE `job_material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `job_orders`
--
ALTER TABLE `job_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `material_product`
--
ALTER TABLE `material_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `material_purchasing`
--
ALTER TABLE `material_purchasing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prefixes`
--
ALTER TABLE `prefixes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchasing_orders`
--
ALTER TABLE `purchasing_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_categories`
--
ALTER TABLE `task_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_job_orders`
--
ALTER TABLE `all_job_orders`
  ADD CONSTRAINT `all_job_orders_l_id_foreign` FOREIGN KEY (`L_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `all_job_orders_p_id_foreign` FOREIGN KEY (`P_id`) REFERENCES `purchasing_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `all_job_orders_r_id_foreign` FOREIGN KEY (`R_id`) REFERENCES `job_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `assets_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `assets_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `client_groups` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `contacts_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `client_groups` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `job_material`
--
ALTER TABLE `job_material`
  ADD CONSTRAINT `job_material_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job_orders` (`id`),
  ADD CONSTRAINT `job_material_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`);

--
-- Constraints for table `job_orders`
--
ALTER TABLE `job_orders`
  ADD CONSTRAINT `job_orders_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `job_orders_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `job_orders_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `leads_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `leads_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `lead_products`
--
ALTER TABLE `lead_products`
  ADD CONSTRAINT `lead_products_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lead_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `maintenances_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  ADD CONSTRAINT `maintenances_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `maintenances_mainten_employee_id_foreign` FOREIGN KEY (`mainten_employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `maintenances_review_employee_id_foreign` FOREIGN KEY (`review_employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `maintenances_super_employee_id_foreign` FOREIGN KEY (`super_employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `materials_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`);

--
-- Constraints for table `material_product`
--
ALTER TABLE `material_product`
  ADD CONSTRAINT `material_product_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  ADD CONSTRAINT `material_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `material_purchasing`
--
ALTER TABLE `material_purchasing`
  ADD CONSTRAINT `material_purchasing_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  ADD CONSTRAINT `material_purchasing_pur_id_foreign` FOREIGN KEY (`pur_id`) REFERENCES `purchasing_orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`);

--
-- Constraints for table `purchasing_orders`
--
ALTER TABLE `purchasing_orders`
  ADD CONSTRAINT `purchasing_orders_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `purchasing_orders_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `purchasing_orders_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`grp_id`) REFERENCES `user_groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
