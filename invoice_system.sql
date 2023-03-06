-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 10:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_system`
--
CREATE DATABASE IF NOT EXISTS `invoice_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `invoice_system`;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `website` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `company_name`, `email`, `street_address`, `city`, `postal_code`, `phone_number`, `fax`, `website`, `created_at`, `active`) VALUES
(1, 'Annel', 'Test Company', 'avdw.minamoo@gmail.com', '16 Bradford str, 36 Sunset Village', 'Centurion', '0157', '0834835106', '', 'https://www.linkedin.com/in/annel-venter-b913ab31/', '2023-03-04 01:42:42', b'1'),
(2, 'Annel', 'Annels Company', 'annel.venter2208@gmail.com', 'address', 'city', '0123', '0123456789', '0123456789', 'http://localhost/d6_developer_challenge_ui/', '2023-03-05 13:08:27', b'1'),
(3, 'asasdasd', 'asdasdasd', 'dasasdasd', 'asdasdasd', 'sdaasdasd', '0123', '0123456789', '0123456789', 'http://localhost/d6_developer_challenge_ui/', '2023-03-05 13:20:15', b'1'),
(5, 'tester', 'testing company', 'address', 'address', 'city', '0123', '0123123123', '0123123132', 'http://localhost/', '2023-03-05 13:21:17', b'1'),
(7, 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', '7897', '7897897897', '7897897899', 'http://localhost/123', '2023-03-05 13:22:25', b'1'),
(8, 'hhjkhjk', 'hjkhjkhjk', 'hjkjhkhjk', 'hjkhjkhjk', 'hkjhjkhjk', '4564', '4564564564', '4564564564', 'http://localhost/456', '2023-03-05 13:24:38', b'1'),
(9, 'oiuoiu', 'ouioiu', 'oiuoiu', 'ouioiu', 'oiuoiu', '159', '1591591591', '1591591591', 'http://localhost/159', '2023-03-05 13:31:09', b'1'),
(10, 'rtyrtyrty', 'rtyrtyrty', 'rtyrtyrty', 'rtyrtyrty', 'rtyrtyrty', '555', '5555555555', '5555555555', 'http://localhost/555', '2023-03-05 13:39:02', b'1'),
(11, 'qqqqqqq', 'qqqqqqq', 'qqqqqqq', 'qqqqqqq', 'qqqqqqq', '2222', '2222222222', '2222222222', 'http://localhost/222', '2023-03-05 13:41:02', b'1'),
(12, 'wwwwwww', 'wwwwwww', 'wwwwwww', 'wwwwwww', 'wwwwwww', '6666', '6666666666', '6666666666', 'http://localhost/6666', '2023-03-05 13:42:36', b'1'),
(13, 'qwqwqwqwq', 'qwqwqwqwq', 'qwqwqwqwq', 'qwqwqwqwq', 'qwqwqwqwq', '6333', '6333333633', '6333333633', 'http://localhost/633', '2023-03-05 13:43:45', b'1'),
(14, 'tytytytyty', 'tytytytyty', 'tytytytyty', 'tytytytyty', 'tytytytyty', '4444', '4444444444', '4444444444', 'http://localhost/4444', '2023-03-05 13:45:09', b'1'),
(15, 'ililililii', 'ililililii', 'ililililii', 'ililililii', 'ililililii', '999', '9999999999', '9999999999', 'http://localhost/d99', '2023-03-05 13:46:24', b'1'),
(16, 'fffddfdfdfd', 'fffddfdfdfd', 'fffddfdfdfd', 'fffddfdfdfd', 'fffddfdfdfd', '9595', '9595959595', '9595959595', 'http://localhost/959', '2023-03-05 13:50:10', b'1'),
(17, 'dfdfdfdfdf', 'dfdfdfdfdf', 'dfdfdfdfdf', 'dfdfdfdfdf', 'dfdfdfdfdf', '0123', '2312312312', '2312312312', 'http://localhost/231', '2023-03-05 13:54:11', b'1'),
(18, 'bnnbnbnbnbnbnb', 'bnnbnbnbnbnbnb', 'bnnbnbnbnbnbnb', 'bnnbnbnbnbnbnb', 'bnnbnbnbnbnbnb', '4566', '4564564545', '4564564545', 'http://localhost/45', '2023-03-05 13:56:26', b'1'),
(19, 'tututututu', 'tututututu', 'tututututu', 'tututututu', 'tututututu', '4455', '4455445545', '4455445545', 'http://localhost/4455', '2023-03-05 13:58:59', b'1'),
(20, 'asasasassas', 'asasasassas', 'asasasassas', 'asasasassas', 'asasasassas', '111', '1112223331', '1112223331', 'http://localhost/111', '2023-03-05 14:00:17', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `taxable` decimal(10,2) NOT NULL,
  `tax_rate` decimal(10,2) NOT NULL,
  `tax_due` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `invoice_date`, `taxable`, `tax_rate`, `tax_due`, `total`, `created_at`, `due_date`, `active`) VALUES
(1, 1, '0000-00-00', '345.00', '6.25', '21.56', '0.00', '0000-00-00 00:00:00', '0000-00-00', b'1'),
(2, 10, '2023-03-05', '345.00', '6.25', '21.56', '0.00', '2023-03-05 00:00:00', '2023-04-04', b'1'),
(3, 1, '2023-03-05', '345.00', '6.25', '21.56', '0.00', '2023-03-05 00:00:00', '2023-04-04', b'1'),
(4, 3, '2023-03-05', '345.00', '6.25', '21.56', '0.00', '2023-03-05 00:00:00', '2023-04-04', b'1'),
(5, 5, '2023-03-05', '345.00', '6.25', '21.56', '1196.56', '2023-03-05 00:00:00', '2023-04-04', b'1'),
(6, 2, '2023-03-06', '345.00', '6.25', '21.56', '971.56', '2023-03-06 00:00:00', '2023-04-05', b'1'),
(7, 2, '2023-03-06', '375.00', '6.25', '23.44', '1003.44', '2023-03-06 00:00:00', '2023-04-05', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_config`
--

CREATE TABLE `invoice_config` (
  `id` int(11) NOT NULL,
  `service_fee_name` varchar(255) NOT NULL,
  `service_fee` decimal(10,2) NOT NULL,
  `service_fee_taxable` bit(1) NOT NULL DEFAULT b'1',
  `labor_name` varchar(255) NOT NULL,
  `labor_per_hour` decimal(10,2) NOT NULL,
  `labor_per_hour_taxable` bit(1) NOT NULL DEFAULT b'1',
  `parts_name` varchar(255) NOT NULL,
  `parts_price` decimal(10,2) NOT NULL,
  `parts_name_taxable` bit(1) NOT NULL DEFAULT b'1',
  `tax_rate` decimal(10,2) NOT NULL,
  `other_comments` text NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `due_date_days` int(6) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_config`
--

INSERT INTO `invoice_config` (`id`, `service_fee_name`, `service_fee`, `service_fee_taxable`, `labor_name`, `labor_per_hour`, `labor_per_hour_taxable`, `parts_name`, `parts_price`, `parts_name_taxable`, `tax_rate`, `other_comments`, `contact_name`, `contact_number`, `contact_email`, `due_date_days`) VALUES
(1, 'Service Fee', '230.00', b'0', 'Labor', '75.00', b'0', 'Parts', '345.00', b'1', '6.25', '1. Total Payments due in 30 days\r\n2. Please include the invoice number on your check', 'Annel Venter', '0834835106', 'avdw.minamoo@gmail.com', 30);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_preconfigured`
--

CREATE TABLE `invoice_preconfigured` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `taxable` bit(1) NOT NULL DEFAULT b'1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_preconfigured`
--

INSERT INTO `invoice_preconfigured` (`id`, `product`, `price`, `quantity`, `taxable`, `created_at`) VALUES
(1, 'Service Fee', '230.00', 1, b'0', '2023-03-05 19:47:25'),
(2, 'Labor', '75.00', 1, b'0', '2023-03-05 19:47:25'),
(3, 'Parts', '345.00', 1, b'1', '2023-03-05 19:47:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name` (`company_name`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id_index` (`customer_id`);

--
-- Indexes for table `invoice_config`
--
ALTER TABLE `invoice_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `invoice_preconfigured`
--
ALTER TABLE `invoice_preconfigured`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_config`
--
ALTER TABLE `invoice_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_preconfigured`
--
ALTER TABLE `invoice_preconfigured`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
