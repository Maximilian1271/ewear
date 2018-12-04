-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 10:37 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewear`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_fs` int(11) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_fs`, `data`) VALUES
(1, 15, ''),
(2, 16, '');

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `CategoryShortDesc` varchar(100) NOT NULL,
  `CategoryDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`id`, `CategoryName`, `CategoryShortDesc`, `CategoryDesc`) VALUES
(1, 'unset', 'this means nobody has set a category yet', ''),
(2, 'Hoodie', 'Hoodies', ''),
(3, 'T-Shirt', 'T-Shirts', ''),
(4, 'Beany', 'Beanies', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `product_desc` varchar(500) NOT NULL,
  `product_desc_long` text NOT NULL,
  `base_price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` int(11) NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `data` text NOT NULL,
  `category_fs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `product_desc`, `product_desc_long`, `base_price`, `image`, `created_at`, `in_stock`, `data`, `category_fs`) VALUES
(1, 'Block shop zip up hoodie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 50, 'CLK-ZIP-BLOCK-HOODIE-ATHR-XXL-DOWN-FRONT_600x.jpg', 1543524848, 0, '{\"colour\":[\"black\",\"green\"]}', 2),
(2, 'Deep Space Hoodie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 80, 'CLK-CORP-HOODIE-BLCK-HIM-UP-LEFT15_600x.jpg', 1543524848, 1, '', 2),
(3, 'Spy Hoodie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 80, 'CLK-TEAM-HOODIE-BLCK-HER-DOWN-LEFT15_600x.jpg', 1543524848, 1, '', 2),
(4, 'Cloud Tech Quarter Zip Long Sleeve', 'These Pants are sleek', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 65, 'CLK-CONCRETE-QUARTER-ZIP-CHHR-HER-FRONT_600x.jpg', 1543524848, 1, '', 3),
(5, 'Black Pool Quarter Zip Long Sleeve', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 65, 'CLK-STEALTH-QUARTER-ZIP-BLCK-HIM-RIGHT45-MID_600x.jpg', 1543524848, 1, '', 3),
(6, 'Zip Line Tee', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 35, 'CLK-LINE-TEE-BLCK-HIM-FRONT_600x.jpg', 1543524848, 1, '', 3),
(7, 'Classic Stealth Tee', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 35, 'CLK-BASIC-TEE-BLCK-HIM-LEFT30_600x.jpg', 1543524848, 1, '', 3),
(8, 'Use Your Illusion Tee', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 35, 'CLK-REFLECT-TEE-ATHR-HER-FRONT_600x.jpg', 1543524848, 1, '', 3),
(9, 'Cloak Cloud Beanie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 20, 'CLK-BEANIE-FRONT_600x.jpg', 1543524848, 0, '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `Role` varchar(11) NOT NULL,
  `Role_Desc` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `Role`, `Role_Desc`) VALUES
(1, 'User', ''),
(2, 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `data` text CHARACTER SET latin1 NOT NULL,
  `roles_fs` int(11) NOT NULL,
  `hash` text CHARACTER SET latin1 NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `email`, `data`, `roles_fs`, `hash`, `is_active`, `created_at`, `password`, `newsletter`, `locked`) VALUES
(3, 'Admin', 'maximilian.schaumann@gmail.com', '{\"name\":\"Maximilian Michael\",\"surname\":\"Schaumann\",\"address\":\"Vorgartenstrasse 122/4/455\",\"zip\":\"1020 Wien\"}', 2, '5c0049fb569bc', 1, 1543522811, '70bedd697110b90ba9c7a68b0e8b0b3a90a4f785:4209', 0, 0),
(7, 'Troublemaker', 'moritz.boehmer@narutofan.de', '{\"name\":\"Moritz\",\"surname\":\"Boehmer\",\"address\":\"Baumgasse\",\"zip\":\"1010 Wien\"}', 1, '5c028b4661ac4', 1, 1543670598, '6ef7621b9042c8946d7f6d335e88f4ebe1ddf20c:4809', 0, 0),
(8, 'JL', 'julian.lorenz@lorenz.at', '{\"name\":\"Julian\",\"surname\":\"Lorenz\",\"address\":\"VgtStreet\",\"zip\":\"1210 Wien\"}', 1, '5c028b4661ac4', 1, 1543670598, '6ef7621b9042c8946d7f6d335e88f4ebe1ddf20c:4809', 0, 0),
(9, 'JL', 'julian.lorenz@lorenz.at', '{\"name\":\"Julian\",\"surname\":\"Lorenz\",\"address\":\"VgtStreet\",\"zip\":\"1210 Wien\"}', 1, '5c028b4661ac4', 1, 1543670598, '6ef7621b9042c8946d7f6d335e88f4ebe1ddf20c:4809', 0, 0),
(10, 'JL', 'julian.lorenz@lorenz.at', '{\"name\":\"Julian\",\"surname\":\"Lorenz\",\"address\":\"VgtStreet\",\"zip\":\"1210 Wien\"}', 1, '5c028b4661ac4', 1, 1543670598, '6ef7621b9042c8946d7f6d335e88f4ebe1ddf20c:4809', 0, 0),
(11, 'FSchaumann', 'f.schaumann@gmail.com', '{\"name\":\"Franziska\",\"surname\":\"Schaumann\",\"address\":\"Vgartenstrasse\",\"zip\":\"1020 WIen\"}', 1, '5c03c38b3e736', 1, 1543750539, 'd09c27b75a30b956ec9e6aa18b419282a706c64c:1355', 0, 0),
(15, 'MarvinB', 'marvin.b@gmail.com', '{\"name\":\"Marvin\",\"surname\":\"Buhle\",\"address\":\"\",\"zip\":\"\"}', 1, '5c045d38e820f', 1, 1543789880, '2f631bea67af591e57b785bcdf4d33b9365bc9c6:9323', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
