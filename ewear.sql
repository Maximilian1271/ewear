-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2019 at 04:25 PM
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
CREATE DATABASE IF NOT EXISTS `ewear` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ewear`;

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
(1, 3, '::{\"id\":\"1\",\"size\":\"M\",\"num\":\"1\",\"colour\":\"black\"}::{\"id\":\"2\",\"size\":\"M\",\"num\":\"1\",\"colour\":\"black\"}'),
(4, 17, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cart_data` text NOT NULL,
  `user_fs` int(11) NOT NULL,
  `address` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `uniqid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cart_data`, `user_fs`, `address`, `created_at`, `status`, `uniqid`) VALUES
(1, '::{\"id\":\"3\",\"size\":\"M\",\"num\":\"1\",\"colour\":\"null\"}::{\"id\":\"1\",\"size\":\"M\",\"num\":\"1\",\"colour\":\"black\"}', 3, '{\"Name\":\"Maximilian Michael Schaumann\",\"Address\":\"Vorgartenstrasse 122\\/4\\/455\",\"Postal_Code_(ZIP)\":\"1020 Wien\",\"Payment_Method\":\"Mastercard\"}', 1547847193, 5, '5c424619ad1c19.06099741'),
(2, '::{\"id\":\"17\",\"size\":\"M\",\"num\":\"1\",\"colour\":\"red\"}', 3, '{\"Name\":\"Maximilian Michael Schaumann\",\"Address\":\"Vorgartenstrasse 122\\/4\\/455\",\"Postal_Code_(ZIP)\":\"1020 Wien\",\"Payment_Method\":\"Mastercard\"}', 1547906110, 0, '5c432c3e638a97.03946926');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `id` int(11) NOT NULL,
  `StatusName` varchar(50) NOT NULL,
  `status_fs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `StatusName`, `status_fs`) VALUES
(1, 'Processing', 0),
(2, 'Delivered', 1),
(3, 'Delayed', 2),
(4, 'Awaiting Return', 3),
(5, 'Cancelled', 5);

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
(4, 'Beany', 'Beanies', ''),
(5, 'Casual Wear', 'Wear for the extremely Casual', '');

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
(1, 'Block shop zip up hoodie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 50, 'CLK-ZIP-BLOCK-HOODIE-ATHR-XXL-DOWN-FRONT_600x.jpg', 1543524848, 1, '{\"colour\":[\"black\",\"green\"]}', 2),
(2, 'Deep Space Hoodie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 80, 'CLK-CORP-HOODIE-BLCK-HIM-UP-LEFT15_600x.jpg', 1543524848, 1, '{\"colour\":[\"black\",\"green\", \"magenta\", \"khaki\"]}', 2),
(3, 'Spy Hoodie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 80, 'CLK-TEAM-HOODIE-BLCK-HER-DOWN-LEFT15_600x.jpg', 1543524848, 1, '', 2),
(4, 'Cloud Tech Quarter Zip Long Sleeve', 'These Pants are sleek', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 65, 'CLK-CONCRETE-QUARTER-ZIP-CHHR-HER-FRONT_600x.jpg', 1543524848, 1, '{\"colour\":[\"black\",\"silver\", \"blue\"]}', 3),
(5, 'Black Pool Quarter Zip Long Sleeve', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 65, 'CLK-STEALTH-QUARTER-ZIP-BLCK-HIM-RIGHT45-MID_600x.jpg', 1543524848, 1, '{\"colour\":[\"red\"]}', 3),
(6, 'Zip Line Tee', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 35, 'CLK-LINE-TEE-BLCK-HIM-FRONT_600x.jpg', 1543524848, 1, '', 3),
(7, 'Classic Stealth Tee', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 35, 'CLK-BASIC-TEE-BLCK-HIM-LEFT30_600x.jpg', 1543524848, 1, '', 3),
(8, 'Use Your Illusion Tee', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 35, 'CLK-REFLECT-TEE-ATHR-HER-FRONT_600x.jpg', 1543524848, 1, '', 3),
(9, 'Cloak Cloud Beanie', 'These shoes are very amazing', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Test2', 20, 'CLK-BEANIE-FRONT_600x.jpg', 1543524848, 0, '', 4),
(10, 'Orange Checkered Shirt', 'This shirt is very Orange', 'This shirt is quite Orange indeed! You\'ll find that with this shirt, Luck will always follow you the most. Except when it does not. Then that is your fault :c', 60, 'blue-blue-skies-blue-sky-1195548.jpg', 1544752770, 1, '', 5),
(11, 'Checkered Tee No.2', 'This Shirt is checkered', 'This Shirt does some extraordinary things. It keeps you warm during the cold, but keeps you cold during the warm. This seems like utter magic to me. You should definitely buy!', 20, 'brick-wall-casual-cool-769733.jpg', 1544752770, 1, '', 5),
(12, 'Pink Casual Linen', 'This Product is made of linen', 'With this product you don\'t only look great, but you will instantly develop some rad abs! Trust me, the model we tried it one was like 900 lbs before! This shirt truly is a great buy!', 50, 'abs-adult-casual-936011.jpg', 1544752770, 0, '', 5),
(17, 'Iphone', 'Iphone', 'testtestt esttestte sttesttesttesttesttesttesttesttesttesttesttesttes ttesttesttesttesttesttes ttestte sttesttesttesttesttesttest', 500, 'zoidberg_by_blizz21-d4pq4d6alpha.png', 1547583419, 1, '{\"colour\":[\"red\",\" test\",\" poop\"]}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_deleted`
--

CREATE TABLE `products_deleted` (
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
-- Dumping data for table `products_deleted`
--

INSERT INTO `products_deleted` (`id`, `title`, `product_desc`, `product_desc_long`, `base_price`, `image`, `created_at`, `in_stock`, `data`, `category_fs`) VALUES
(18, 'Test Product 2', 'This product does things', 'This product does thingsThis product does thingsThis product does thingsThis product does thingsThis product does thingsThis product does thingsThis product does things', 200, 'commoditiesmarket.png', 1547911433, 1, '{\"colour\":[\"lilac\",\" pink\"]}', 1);

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
(3, 'admin', 'maximilian.schaumann@gmail.com', '{\"name\":\"Maximilian Michael\",\"surname\":\"Schaumann\",\"address\":\"Vorgartenstrasse 122/4/455\",\"zip\":\"1020 Wien\"}', 2, '5c0049fb569bc', 1, 1543522811, '70bedd697110b90ba9c7a68b0e8b0b3a90a4f785:4209', 0, 0),
(17, 'fschaumann', 'fschaumann@gmail.com', '{\"name\":\"Franziska\",\"surname\":\"Schaumann\",\"address\":\"\",\"zip\":\"\"}', 1, '5c0da13881f9c', 1, 1544397112, 'e6dfdee15ea4b7b22aab4c1acb2dddbfa749b0d8:3139', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
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
-- Indexes for table `products_deleted`
--
ALTER TABLE `products_deleted`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
