-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_quickkart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcat_id` int(11) NOT NULL,
  `subcat_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcat_id`, `subcat_name`, `category_id`) VALUES
(1, 'Mobile Phones', 1),
(2, 'Laptops', 1),
(3, 'Televisions', 1),
(4, 'Cameras', 1),
(5, 'Accessories', 1),
(6, 'Fresh Vegetables', 2),
(7, 'Fruits', 2),
(8, 'Dairy Products', 2),
(9, 'Snacks & Chips', 2),
(10, 'Baking Essentials', 2),
(11, 'Footwear', 3),
(12, 'Accessories', 3),
(13, 'Kids Wear', 3),
(14, 'Men Fashion', 3),
(15, 'Womens Fashion', 3),
(16, 'Home Decor', 4),
(17, 'Kitchen Appliances', 4),
(18, 'Cleaning Supplies', 4),
(19, 'Furniture', 4),
(20, 'Storage Solutions', 4),
(21, 'Soft Drinks', 5),
(22, 'Juices', 5),
(23, 'Tea & Coffee', 5),
(24, 'Energy Drinks', 5),
(25, 'Alcoholic Beverages', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
