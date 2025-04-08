-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 09:52 AM
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
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_status` varchar(20) DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `user_id`, `total_amount`, `shipping_address`, `city`, `state`, `zip`, `payment_method`, `order_status`, `order_date`) VALUES
(1, 1, 245.99, 'Ganesh Genesis', 'Ahmedabad', 'Gujarat', '382481', 'Cash on Delivery', 'Delivered ', '2025-04-03 06:56:52'),
(2, 1, 4495.99, 'Ganesh Genesis', 'Ahmedabad', 'Gujarat', '382481', 'Cash on Delivery', 'Pending', '2025-04-03 07:18:27'),
(3, 1, 145.99, 'Ganesh Genesis', 'Ahmedabad', 'Gujarat', '382481', 'Cash on Delivery', 'Pending', '2025-04-04 06:07:26'),
(4, 1, 64995.99, 'vastral', 'Ahmedabad', 'Gujarat', '382418', 'UPI', 'Pending', '2025-04-04 06:08:52'),
(5, 1, 80.99, 'Ganesh Genesis', 'Ahmedabad', 'Gujarat', '382481', 'UPI', 'Pending', '2025-04-04 06:45:02'),
(6, 6, 136.99, 'Anand, high road', 'Anand', 'Gujarat', '382481', 'Cash on Delivery', 'Pending', '2025-04-04 07:20:32'),
(7, 6, 154995.99, 'Anand, high road', 'Anand', 'Gujarat', '382481', 'UPI', 'Pending', '2025-04-04 07:21:00'),
(8, 2, 293245.99, 'vastral', 'Ahmedabad', 'Gujarat', '382418', 'UPI', 'Pending', '2025-04-04 07:22:41'),
(9, 4, 229994.99, 'Ahmedabad ', 'Ahmedabad', 'Gujarat', '382418', 'UPI', 'Pending', '2025-04-04 07:33:03'),
(10, 5, 745.99, 'Anand, high road', 'Anand', 'Gujarat', '382481', 'UPI', 'Pending', '2025-04-04 10:15:41'),
(11, 1, 245.99, 'Ganesh Genesis', 'Ahmedabad', 'Gujarat', '382481', 'Cash on Delivery', 'Pending', '2025-04-05 05:52:04'),
(12, 7, 98995.99, 'k-202, navarangpura', 'Ahmedabad ', 'Gujrat', '365601', 'Cash on Delivery', 'Pending', '2025-04-08 06:58:24'),
(13, 7, 345.99, 'k-202, navarangpura', 'Ahmedabad', 'Gujrat', '365601', 'UPI', 'Pending', '2025-04-08 06:59:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
