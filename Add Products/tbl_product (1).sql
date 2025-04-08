-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 03:36 PM
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
-- Database: `db_project3`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_thumb1` varchar(255) NOT NULL,
  `product_thumb2` varchar(255) NOT NULL,
  `product_thumb3` varchar(255) NOT NULL,
  `product_thumb4` varchar(255) NOT NULL,
  `product_details` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_price`, `product_thumb1`, `product_thumb2`, `product_thumb3`, `product_thumb4`, `product_details`) VALUES
(2, 'boAt Airdopes 311 Pro', '899', 'boat-1.jpg', 'boat-2.jpg', 'boat-3.jpg', 'boat-4.jpg', 'The boAt Airdopes 311 Pro are budget-friendly true wireless earbuds that cater to casual users seeking decent audio quality and convenience.The Airdopes 311 Pro deliver a well-rounded experience for their price range, with a focus on portability, decent sound, and essential features. They’re designed for users who want reliable, lightweight earbuds for everyday use. While they excel in delivering deep bass and stable connectivity, they may not satisfy audiophiles or those looking for premium features like active noise cancellation.Features dynamic d'),
(3, 'Noise Buds N1 Pro', '1399', 'noice-1.jpg', 'noice-2.jpg', 'noice-3.jpg', 'noice-4.jpg', 'These earbuds offer an exceptional audio experience with Active Noise Cancellation (ANC) of up to 32 dB, letting you enjoy your playlists without any background disturbances. Their metallic and chrome finish adds a sleek, stylish touch, making them more than just regular earbuds — they’re a statement piece. With an impressive playtime of up to 60 hours, you can keep your music going without frequent recharges. The 11mm drivers deliver a dynamic and well-balanced sound, perfect for audiophiles seeking high-quality audio. Whether you’re gaming or bing'),
(4, 'OnePlus Nord Buds 2r ', '2000', 'plus-1.jpg', 'plus-2.jpg', 'plus-3.jpg', 'plus-4.jpg', 'The OnePlus Nord Buds 2R offer an exceptional audio experience with 12.4mm drivers that deliver deep bass and clear sound. Designed for comfort and convenience, these true wireless earbuds feature up to 38 hours of playback with the case, ensuring long-lasting entertainment. The 4-mic design enhances voice clarity for calls, while IP55 water resistance makes them perfect for workouts or outdoor use. With a sleek, ergonomic design and reliable performance, the OnePlus Nord Buds 2R are a great choice for users seeking quality and value in true wireles'),
(5, ' Boult Z20', '1500', 'boult-1.jpg', 'boult-2.jpg', 'boult-3.jpg', 'boult-4.jpg', 'Overall, the Boult Z20 Truly Wireless Bluetooth Earbuds offer excellent value for money. The combination of Rich Bass, Zen™ Calling ENC Mic, Low Latency Gaming, and impressive battery life makes them a fantastic option for anyone looking for a quality wireless earbud experience. Whether you\'re a music lover, gamer, or someone who frequently makes calls, these earbuds meet all needs with ease. Boult has certainly raised the bar with this launch, and they are undoubtedly worth the investment.'),
(6, 'realme Buds T110', '1200', 'realme-1.jpg', 'realme-2.jpg', 'realme-3.jpg', 'realme-4.jpg', 'The Realme Buds T110 offer an impressive combination of features that make them stand out in this price range. They deliver excellent sound quality with clear, detailed, and immersive audio (8/10), and the pure, deep bass feels natural and well-balanced. The 360° audio enhances the listening experience, making it more dynamic and engaging. Comfort is a strong point, with an 8.5/10 rating, making them great for long hours of use. The battery backup is outstanding, lasting long without frequent charging, while the instant connectivity ensures super-fa'),
(7, 'JBL Vibe Beam', '2499', 'jbl-1.jpg', 'jbl-2.jpg', 'jbl-3.jpg', 'jbl-4.jpg', 'The JBL Vibe Beam earbuds offer a powerful and reliable audio experience, featuring 8mm drivers with JBL Deep Bass Sound that bring your mixes to life with high-quality audio. With an impressive battery life of up to 32 hours (8 hours from the earbuds and 24 from the case) and speed charging that provides an extra two hours of playtime in just 10 minutes, they’re perfect for all-day use. Hands-free calls are clearer and more customizable with VoiceAware, letting you control how much of your own voice you hear during conversations. Built for adventur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
