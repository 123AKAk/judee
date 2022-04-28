-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 04:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyocommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userid`, `productid`, `name`, `price`, `quantity`, `date`) VALUES
(1, 1, 9, '', 0, 5, '2022-03-20'),
(2, 1, 13, '', 0, 2, '2022-03-20'),
(3, 1, 16, '', 900, 3, '2022-03-21'),
(4, 1, 14, '', 1288, 4, '2022-03-21'),
(5, 1, 13, '', 3232, 1, '2022-03-21'),
(6, 5, 16, '', 900, 3, '2022-03-21'),
(7, 5, 14, '', 1288, 4, '2022-03-21'),
(8, 5, 13, '', 3232, 1, '2022-03-21'),
(9, 6, 11, '', 1292, 4, '2022-03-21'),
(10, 6, 14, '', 1610, 5, '2022-03-21'),
(11, 6, 9, '', 2600, 2, '2022-03-21'),
(12, 6, 13, '', 19392, 6, '2022-03-21'),
(13, 1, 13, '', 0, 0, '2022-03-22'),
(14, 1, 14, '', 322, 1, '2022-03-22'),
(15, 1, 13, 'real spotlight', 9232, 1, '2022-03-22'),
(16, 1, 11, 'Spotlight3', 323, 1, '2022-03-22'),
(17, 1, 14, 'FAVOUR', 322, 1, '2022-03-22'),
(18, 1, 13, 'real spotlight', 9232, 1, '2022-03-22'),
(19, 1, 11, 'Spotlight3', 323, 1, '2022-03-22'),
(20, 1, 14, 'FAVOUR', 322, 1, '2022-03-22'),
(21, 1, 13, 'real spotlight', 9232, 1, '2022-03-22'),
(22, 1, 11, 'Spotlight3', 323, 1, '2022-03-22'),
(23, 1, 14, 'FAVOUR', 322, 1, '2022-03-22'),
(24, 1, 13, 'real spotlight', 9232, 1, '2022-03-22'),
(25, 1, 11, 'Spotlight3', 323, 1, '2022-03-22'),
(26, 1, 14, 'FAVOUR', 322, 1, '2022-03-22'),
(27, 1, 13, 'real spotlight', 9232, 1, '2022-03-22'),
(28, 1, 11, 'Spotlight3', 323, 1, '2022-03-22'),
(29, 1, 14, 'FAVOUR', 322, 1, '2022-03-22'),
(30, 1, 13, 'real spotlight', 9232, 1, '2022-03-22'),
(31, 1, 11, 'Spotlight3', 323, 1, '2022-03-22'),
(32, 1, 14, 'FAVOUR', 322, 1, '2022-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `catname` text NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catname`, `cat_slug`) VALUES
(3, 'Necklace', 'Necklace'),
(5, 'Beads', 'Beads'),
(6, 'Wirst watch', 'Wirst watch');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `photo1` text NOT NULL,
  `photo2` text NOT NULL,
  `photo3` text NOT NULL,
  `photo4` text NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `photo1`, `photo2`, `photo3`, `photo4`, `date_added`, `counter`) VALUES
(9, 6, 'Red Neck Bead', '<p>Red Neck Bead</p>', 'Red Neck Bead', 1300, '26.jpeg', '26.jpeg', '', '', '2022-02-05', 0),
(11, 5, 'Spotlight3', '<p>asasa</p>', 'dsds', 323, '27.jpeg', '', '', '', '2022-02-05', 0),
(13, 3, 'real spotlight', '<p>aasa</p>', 'sasa', 9232, '30.jpeg', '', '', '', '2022-02-05', 0),
(14, 5, 'FAVOUR', '<p>dsdsd</p>', 'sds', 322, '23.jpeg', '25.jpeg', '', '', '2022-02-05', 0),
(16, 5, 'Another one here', '<p>dsdtgshdxzxzkxkzxzbxzbxhzbjxhzbjxhbzjhbxzjhbxjzbxhzbjxhzbjxhbzhxbzjhbxzjhbxhzbxzjhxbzjhxbzjhbxzhxjzxhzjxbhzjxhzjhxzjhxzjxhbzjhbxzjxhzjbxhzjxbzjxzjdsdtgshdxzxzkxkzxzbxzbxhzbjxhzbjxhbzjhbxzjhbxjzbxhzbjxhzbjxhbzhxbzjhbxzjhbxhzbxzjhxbzjhxbzjhbxzhxjzxhzjxbhzjxhzjhxzjhxzjxhbzjhbxzjxhzjbxhzjxbzjxzj</p><p><br></p><p>ds</p>', 'dsds', 300, '29.jpeg', '', '', '', '2022-02-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_id` text NOT NULL,
  `sales_date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `amount`, `transaction_id`, `sales_date`, `status`) VALUES
(1, 1, 100, '123', '0000-00-00', 0),
(2, 5, 230, '456', '0000-00-00', 0),
(3, 1, 210, '789', '0000-00-00', 0),
(4, 6, 122, '1011', '0000-00-00', 0),
(6, 1, 5420, '1213', '2022-03-21', 0),
(7, 1, 5420, '1415', '2022-03-21', 0),
(24, 5, 5420, '1617', '2022-03-21', 0),
(25, 6, 24894, '1819', '2022-03-21', 0),
(26, 1, 0, '3438', '2022-03-22', 0),
(27, 1, 322, '3233', '2022-03-22', 0),
(29, 1, 9877, '3031', '2022-03-22', 0),
(30, 1, 9877, '2829', '2022-03-22', 0),
(31, 1, 9877, '2627', '2022-03-22', 0),
(32, 1, 9877, '2425', '2022-03-22', 0),
(33, 1, 9877, '2223', '2022-03-22', 0),
(34, 1, 9877, '2021', '2022-03-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `email` text NOT NULL,
  `phonenumber` text NOT NULL,
  `about` text NOT NULL,
  `sitetags` text NOT NULL,
  `metadata` text NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `type` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `town_city` text NOT NULL,
  `country` text NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `contact_info` text NOT NULL,
  `ordernote` text NOT NULL,
  `created_on` text NOT NULL DEFAULT current_timestamp(),
  `activate_code` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `fullname`, `address`, `town_city`, `country`, `zipcode`, `contact_info`, `ordernote`, `created_on`, `activate_code`, `status`) VALUES
(1, 'admin@admin.com', '$2y$10$rwISLFlCTDzSowpVpj14YOCmsverMl.Rx4iUeQDv5NHLNAx54ABUG', 0, 'James Akak', '6 Aba street', 'Calabar', 'Nigeria', '+234', '+2349060047882', 'hello', '2022-02-10 19:52:33', 'Oa7WL1JFrQy4', 1),
(5, 'ekpenyongbasseysite@gmail.com', '$2y$10$uc41RLkoD1GLic7spCqf0OFiw/VGM0oWaPKqj5.s957X55zUo6cEG', 0, 'Jean Okon', '6 Aba street', 'Calabar', 'Nigeria', '+234', '+2349060047882', 'ssds', '2022-02-11 19:05:57', 'Z1wFMD6t8mKU', 1),
(6, 'dd@gmail.com', '$2y$10$/SeltlN9yQ04g0BaTv9.AeSgFe6PQjekxFAt7elKyi7zZJUeordbK', 0, '123Eyo', '', '', '', '', '', '', '2022-02-17 23:00:54', 'AHG2NjTeXrM3', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
