-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2022 at 06:24 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categ`
--

DROP TABLE IF EXISTS `categ`;
CREATE TABLE IF NOT EXISTS `categ` (
  `categid` tinyint NOT NULL AUTO_INCREMENT,
  `categname` varchar(255) NOT NULL,
  `description` text,
  `visibility` enum('yes','no') NOT NULL DEFAULT 'no',
  `allowcomment` enum('yes','no') NOT NULL DEFAULT 'no',
  `allowAds` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`categid`),
  UNIQUE KEY `categname` (`categname`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categ`
--

INSERT INTO `categ` (`categid`, `categname`, `description`, `visibility`, `allowcomment`, `allowAds`) VALUES
(3, 'Toys', 'This category for kids only', 'yes', 'yes', 'yes'),
(13, 'Sports', 'For all sports products', 'yes', 'yes', 'yes'),
(14, 'Fashion', 'For all men styles', 'yes', 'yes', 'yes'),
(15, 'watches', 'for all types of smart,original watches', 'no', 'no', 'no'),
(16, 'electronics', 'for all electronics machines', 'no', 'no', 'no'),
(17, 'Accessories', '-', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `itemid` int NOT NULL,
  `userid` int NOT NULL,
  PRIMARY KEY (`commentid`),
  KEY `itemid` (`itemid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `comment`, `date`, `itemid`, `userid`) VALUES
(71, 'wow', '2022-03-02', 18, 31);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `itemid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` bigint NOT NULL,
  `add_date` date NOT NULL,
  `country_made` varchar(150) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` smallint DEFAULT NULL,
  `categid` tinyint NOT NULL,
  `userid` int NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`),
  KEY `categid` (`categid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `name`, `description`, `price`, `add_date`, `country_made`, `status`, `rating`, `categid`, `userid`, `img`, `approve`) VALUES
(14, 'SpongPopSquarePants', 'A very nice toy for kids', 5, '2022-02-20', 'Japan', 'New', NULL, 3, 1, 'assets/img/ItemsImages/SpongeBob_stock_art.png', 1),
(18, 'Patrick Star\r\n', 'a very kind toys for kids', 4, '2022-02-26', 'Japan', 'New', NULL, 3, 1, 'assets/img/ItemsImages/31-310753_spongebob-png-patrick-bob-l-ponge.png', 1),
(20, 'mr kraps', 'is the manager of burger restuarant', 10, '2022-02-26', 'Japan', 'New', NULL, 3, 1, 'assets/img/ItemsImages/o.29373.jpg', 1),
(21, 'plankton', 'plankton', 2, '2022-02-26', 'Egypt', 'New', NULL, 3, 1, 'assets/img/ItemsImages/104-1047547_how-to-draw-sheldon-j-plankton-spongebob-cartoons.png', 1),
(22, 'Sandy Toy', 'Sandy is a happy girl', 20, '2022-02-26', 'Japan', 'New', NULL, 3, 1, 'assets/img/ItemsImages/107-1074172_sandy-spongebob-png-sandy-from-spongebob-transparent-png.png', 1),
(23, 'Pearl Krabs', 'she is the daughter of me.krabs', 15, '2022-02-26', 'Japan', 'New', NULL, 3, 1, 'assets/img/ItemsImages/34-344050_pearl-krabs-pearl-spongebob.png', 1),
(24, 'gary the snail', 'Spongpop Friend', 3, '2022-02-26', 'Japan', 'New', NULL, 3, 1, 'assets/img/ItemsImages/139-1397717_gary-the-snail.png', 1),
(25, 'Air VaporMax Flyknit 3', 'Nike Sneaker\r\nProduct Details\r\n\r\nNike Air Vapormax Flyknit 3\r\nMen’s lifestyle and running shoes\r\nFlyknit upper\r\nIntegrated tongue with lace-up closure and branding\r\nNike Swoosh on the sides\r\nSock-like design for a snug fit\r\nAir Max bubble unit midsole for lightweight support and comfort\r\nRubble outsole grips for stability and traction\r\nColor: Black/Anthracite-White\r\nFit: True to Size\r\nFabric: Synthetic Materials', 4250, '2022-02-26', 'USA', 'New', NULL, 13, 1, 'assets/img/ItemsImages/0000207180932_01_nc.jpg', 1),
(26, 'Air Max 270 React', 'A Max Air 270 unit and full Nike React foam midsole deliver unrivalled, all-day comfort from heel to toe.', 4, '2022-02-26', 'Japan', 'New', NULL, 13, 1, 'assets/img/ItemsImages/CV1632-100-PHSLH000-2000_1000x1000_crop_center-1.jpg', 1),
(27, 'NYLON SLING BAG', 'Easy-access zippered main compartment and front pocket\r\n\r\nTimberland-logo webbing', 599, '2022-02-26', 'Canda', 'New', NULL, 13, 1, 'assets/img/ItemsImages/image-505.jpeg', 1),
(28, 'SL20 SHOES', 'Adidas running sport shoes\r\nYou don’t build speed in a day', 2, '2022-02-26', 'Japan', 'New', NULL, 13, 1, 'assets/img/ItemsImages/SL20_Shoes_Yellow_FW9297_01_standard.jpg', 1),
(29, 'Slim Fit Short Sleeve Jean Shirt', 'Fit:\r\nSlim\r\nPattern:\r\nPlain\r\nThickness:\r\nThin\r\nSleeve Length:\r\nShort Sleeve\r\nLining Detail:\r\nWithout Lining', 229, '2022-02-26', 'Egypt', 'New', NULL, 14, 1, 'assets/img/ItemsImages/819fd478-a620-4e69-b921-09b5c3725f9f_size561x730.jpg', 1),
(30, 'Slim Fit Long Sleeve Poplin Shirt', 'MAIN FABRIC %100-COTTON', 229, '2022-02-26', 'Japan', 'New', NULL, 14, 1, 'assets/img/ItemsImages/3b187a8f-9d29-4296-881d-d811cfeed4ef_size561x730.jpg', 1),
(31, 'Slim Fit Long Sleeve Poplin Shirt', 'Fit:\r\nSlim\r\nFabric:\r\nPoplin\r\nPattern:\r\nPlaid', 229, '2022-02-26', 'Egypt', 'New', NULL, 14, 1, 'assets/img/ItemsImages/2d3912c0-a28b-4732-84fe-8cd099a7ab9f_size561x730.jpg', 1),
(40, 'فانوس رمضان', 'كل عام وحضراتكم بخير', 5, '2022-03-02', 'Egypt', 'New', NULL, 17, 31, 'assets/img/ItemsImages/518nKQvHD0L._AC_SL1041_.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `roles` bit(1) NOT NULL DEFAULT b'0',
  `truststatus` bit(1) NOT NULL DEFAULT b'0',
  `regstatus` bit(1) NOT NULL DEFAULT b'0' COMMENT 'For Approval',
  `blocked` bit(1) NOT NULL DEFAULT b'0',
  `RegDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `username_3` (`username`),
  UNIQUE KEY `username_4` (`username`),
  KEY `username_2` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `dob`, `roles`, `truststatus`, `regstatus`, `blocked`, `RegDate`, `img`) VALUES
(1, 'omar10000', 'c4ca4238a0b923820dcc509a6f75849b', 'omarahmed@gmail.com', '1970-01-01', b'1', b'0', b'0', b'0', '2022-02-08 20:37:51', 'assets/img/UsersImages/268965530_1634019420270211_6676651743708888699_n.jpg'),
(31, 'khalid', '6b92bc6a39db8dfcf740ac5b4921d3a6', 'khalid@gmail.com', '2005-10-01', b'0', b'0', b'1', b'0', '2022-03-02 22:40:16', 'assets/img/UsersImages/khalid.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `items` (`itemid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`categid`) REFERENCES `categ` (`categid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
