-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2019 at 06:58 AM
-- Server version: 5.7.21-log
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `catID` int(11) DEFAULT NULL,
  `adID1` int(10) DEFAULT NULL,
  `adID2` int(10) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `first_name`, `last_name`, `email`, `password`, `catID`, `adID1`, `adID2`) VALUES
(1, 'rajat', 'saini', 'root@gmail.com', 'root', 13, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `advertisment`
--

DROP TABLE IF EXISTS `advertisment`;
CREATE TABLE IF NOT EXISTS `advertisment` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `ad_img` varchar(255) DEFAULT NULL,
  `ad_category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisment`
--

INSERT INTO `advertisment` (`aid`, `ad_img`, `ad_category`) VALUES
(1, 'adBook.jpg', 'Books'),
(2, 'adTitanic.jpg', 'Movies'),
(4, 'adGame.jpg', 'Gaming'),
(5, 'adGame1.jpg', 'Gaming'),
(6, 'ad_festival.jpg', 'Movies'),
(7, 'ad_fortnite.jpg', 'Gaming'),
(8, 'ad_uncharted.jpg', 'Gaming'),
(9, 'ad_headphone.jpg', 'Music'),
(10, 'ad_headp.jpg', 'Music');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `name`, `description`, `image`) VALUES
(10, 'Books', 'Everyone like books.', 'catBook.jpg'),
(11, 'Music', 'Buy musical instruments and albums.', 'catMusic.jpg'),
(12, 'Movies', 'Buy hollywood and bollywood movies.', 'catMovies.jpg'),
(13, 'Gaming', 'Buy gaming accessories and games.', 'catGaming.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(50) NOT NULL,
  `user_mail` varchar(55) NOT NULL,
  `tmst` date NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `pid`, `user_mail`, `tmst`) VALUES
(8, 20, '88maao3hoqsr8k2r3brg9du836', '2019-06-06'),
(9, 24, '88maao3hoqsr8k2r3brg9du836', '2019-06-06'),
(14, 35, '88maao3hoqsr8k2r3brg9du836', '2019-06-07'),
(15, 32, '88maao3hoqsr8k2r3brg9du836', '2019-06-07'),
(16, 32, '88maao3hoqsr8k2r3brg9du836', '2019-06-07'),
(17, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-08'),
(18, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-08'),
(19, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-09'),
(20, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-09'),
(21, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-09'),
(22, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-09'),
(23, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-10'),
(24, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-10'),
(25, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-11'),
(26, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-11'),
(27, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-11'),
(28, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-12'),
(29, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-12'),
(30, 33, '88maao3hoqsr8k2r3brg9du836', '2019-06-12'),
(51, 38, '88maao3hoqsr8k2r3brg9du836', '2019-06-06'),
(65, 24, 'rajatsaini736@gmail.com', '2019-06-17'),
(66, 7, 'rajatsaini736@gmail.com', '2019-06-17'),
(67, 1, 'rajatsaini736@gmail.com', '2019-06-17'),
(68, 29, 'rajatsaini736@gmail.com', '2019-06-17'),
(69, 39, 'rakesh@gmail.com', '2019-06-17'),
(70, 33, 'ruddy@gmail.com', '2019-06-17'),
(71, 33, 'ruddy@gmail.com', '2019-06-17'),
(72, 38, 'ruddy@gmail.com', '2019-06-17'),
(73, 37, 'rajatsaini736@gmail.com', '2019-06-18'),
(74, 39, 'rajatsaini736@gmail.com', '2019-06-18'),
(75, 29, 'rajatsaini736@gmail.com', '2019-06-18'),
(76, 29, 'rajatsaini736@gmail.com', '2019-06-18'),
(77, 29, 'rajatsaini736@gmail.com', '2019-06-18'),
(78, 29, 'rajatsaini736@gmail.com', '2019-06-18'),
(79, 29, 'rajatsaini736@gmail.com', '2019-06-18'),
(80, 33, 'rajatsaini736@gmail.com', '2019-06-18'),
(81, 37, 'ruddy@gmail.com', '2019-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `category` varchar(20) NOT NULL,
  `sub_category` varchar(100) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(200) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `c_price` int(10) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `product_name`, `category`, `sub_category`, `product_description`, `price`, `quantity`, `image`, `brand`, `c_price`) VALUES
(1, 'Wolverine', 'Books', 'Children Books', 'Story of wolverine', 500, 5, 'prochildrenbookWolverine.jpg', 'Marvel', 700),
(2, 'Spider men', 'Books', 'Children Books', 'Story of  Spider men', 700, 5, 'prochildrenbookSpidermen.jpg', 'Marvel', 900),
(3, 'Avengers', 'Books', 'Children Books', 'Story of Avengers', 1500, 5, 'prochildrenbookAvenger.jpg', 'Marvel', 1700),
(4, 'Hulk', 'Books', 'Children Books', 'Story of Hulk', 1500, 5, 'prochildrenbookHulk.jpg', 'Marvel', 2000),
(5, 'Iron men', 'Books', 'Children Books', 'Story of Iron men', 2500, 5, 'prochildrenbookIronmen.jpg', 'Marvel', 3000),
(6, 'Mirzapur', 'Books', 'Crime Books', 'A story of crime leaders', 3000, 5, 'procrimebookMirzapur.jpg', 'Amazon Prime', 3200),
(7, 'Irish Crime', 'Books', 'Crime Books', 'Story of Irish Crime', 2500, 5, 'procrimebookIrish.jpg', 'Amazon', 2700),
(8, 'Scottish Crime', 'Books', 'Crime Books', 'Story of Scottish crime', 1800, 6, 'procrimebookScottish.jpg', 'Amazon', 2000),
(9, 'Killer on the road', 'Books', 'Crime Books', 'Story of a killer', 5000, 5, 'procrimebookKillerontheroad.jpg', 'Amazon', 5200),
(10, 'Games of thrones', 'Books', 'Fiction Books', 'A story of games of thrones', 5500, 5, 'profictionbookGamesofthrones.jpg', 'GGMartin', 5700),
(11, 'Book thief', 'Books', 'Fiction Books', 'A story of world war', 2500, 5, 'profictionbookBookthief.jpg', 'World war', 2700),
(12, 'The Lord of the Rings', 'Books', 'Fiction Books', 'A story of lord of the ring', 7500, 5, 'profictionbookLordoftherings.jpg', 'Amazon', 7800),
(13, 'Transformers', 'Books', 'Fiction Books', 'A story of transformers', 4500, 5, 'profictionbookTransformers.jpg', 'Amazon', 5000),
(14, 'The History of India', 'Books', 'History Books', 'The whole history of India', 4500, 5, 'prohistorybookIndia.jpg', 'India', 5000),
(15, 'The American History', 'Books', 'History Books', 'The whole history of America', 5500, 5, 'prohistorybookAmerica.jpg', 'America', 5700),
(16, 'Guitar', 'Music', 'Instruments', 'Everyone like guitar music', 5000, 5, 'promusicinstrumentGuitar.jpg', 'Nike', 5500),
(17, 'Violin', 'Music', 'Instruments', 'Play violin as a theme music', 7000, 5, 'promusicinstrumentViolin.jpg', 'Nike', 7500),
(18, 'Sexopione', 'Music', 'Instruments', 'Sexopione', 4500, 4, 'promusicinstrumentSexopione.jpg', 'Nike', 5000),
(19, 'French Horn', 'Music', 'Instruments', 'Famous from french', 5500, 4, 'promusicinstrumentFrenchHorn.jpg', 'Nike', 5700),
(20, 'Arijit Singh Juke Box', 'Music', 'Album', 'Listen best of Arijit Singh', 700, 5, 'promusicalbumArijitJukebox.jpg', 'T-series', 750),
(21, 'Kaala Chashma Music Album', 'Music', 'Album', 'Song from Baar Baar Dekho', 450, 4, 'promusicalbumKalaChashma.jpg', 'T-series', 500),
(22, 'See You Again', 'Music', 'Album', 'A song from fast and furious', 750, 7, 'promusicalbumSeeyouagain.jpg', 'Wiz Khalifa', 1000),
(23, 'Baby', 'Music', 'Album', 'First hit of Justin Biber', 1200, 5, 'promusicalbumBaby.jpg', 'Justin Biber', 1500),
(24, 'Titanic', 'Movies', 'Hollywood', 'The big hit of Cinema', 7500, 5, 'promovieshollywoodTitanic.jpg', 'Titanic', 8000),
(26, 'Pirates of carribean', 'Movies', 'Hollywood', 'A comedy from jack sparrow', 7500, 5, 'promovieshollywoodPiratesofcarebbean.jpg', 'Marvel', 8000),
(27, 'Lord of the Rings', 'Movies', 'Hollywood', 'The story adjusted by a ring', 4500, 5, 'promovieshollywoodLordoftherings.jpg', 'T-series', 5000),
(28, 'Tiger Zinda Hai', 'Movies', 'Bollywood', 'Salman Khan movie', 450, 5, 'promoviesbollywoodTigerzindahai.jpg', 'SKF', 500),
(29, 'My Name is Khan', 'Moives', 'Bollywood', 'A movie of king of romance', 450, 5, 'promoviesbollywoodMyNameisKhan.jpg', 'SRK Films', 500),
(30, 'Hum Saath Saath Hai', 'Movies', 'Bollywood', 'Family drama, Romance', 350, 5, 'promoviesbollywoodHumsaathsaathhai.jpg', 'SKF', 400),
(31, 'Hum Aapke Hain Kon', 'Movies', 'Bollywood', 'Family drama, Romance', 450, 5, 'promoviesbollywoodHumaapkehaikon.jpg', 'SKF', 500),
(32, 'Mouse', 'Gaming', 'Accessories', 'Mouse', 4500, 5, 'progamingaccessoriesMouse.jpg', 'HP', 5000),
(33, 'X Box', 'Gaming', 'Accessories', 'Play games with x box', 5500, 5, 'progamingaccessoriesxbox.jpg', 'Sony', 6000),
(34, 'Head Phone', 'Gaming', 'Accessories', 'Headphone', 4500, 5, 'progamingaccessoriesHeadphone.jpg', 'Sony', 5000),
(35, 'Keyboard', 'Gaming', 'Accessories', 'Keyboard', 5000, 4, 'progamingaccessoriesKeyboard.jpg', 'Sony', 5500),
(36, 'Minecraft', 'Gaming', 'Games', 'Build awesome city with minecraft', 4500, 5, 'progaminggamesMinecraft.jpg', 'Minecraft', 5000),
(37, 'Need For Speed', 'Gaming', 'Games', 'Play with top car', 5500, 5, 'progaminggamesNFS.jpg', 'NFS', 7000),
(38, 'Player Unknown Battle Ground', 'Gaming', 'Games', 'Play the most popular game of this era', 8500, 5, 'progaminggamesPUBG.jpg', 'Tencent', 9000),
(39, 'Uncharted 4', 'Gaming', 'Games', 'A series of Uncharted game', 4500, 5, 'progaminggamesUncharted.jpg', 'PSP', 5000),
(41, 'Avengers Endgame', 'Movies', 'Hollywood', 'A stroy of Avengers', 500, 5, 'promovieshollywoodAvengers.jpg', 'Marvel', 700);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `scid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`scid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`scid`, `name`, `category_name`, `image`, `description`) VALUES
(3, 'Children Books', 'Books', 'scatbooksChildren.jpg', 'Buy a children book'),
(4, 'Crime Books', 'Books', 'scatbooksCrime.jpg', 'Buy a crime book'),
(5, 'Fiction Books', 'Books', 'sbcatbooksFicton.jpg', 'Buy a Fiction Book'),
(6, 'History Books', 'Books', 'sbcatbooksHistory.jpg', 'Buy a History Books'),
(7, 'Instruments', 'Music', 'subcatmusicInstuments.jpg', 'Buy musical instruments'),
(8, 'Album', 'Music', 'subcatmusicMusicalbum.jpg', 'Buy music albums'),
(9, 'Hollywood', 'Movies', 'subcatmoviesHollywood.jpg', 'Buy and watch hollywood movies'),
(10, 'Bollywood', 'Movies', 'subcatmoviesBollywood.jpg', 'Buy and watch Bollywood movies '),
(11, 'Accessories', 'Gaming', 'subcatgamingAccessories.jpg', 'Buy gaming consoles and accessories'),
(12, 'Games', 'Gaming', 'subcatgamingGame.jpg', 'Buy new gaming albums');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
CREATE TABLE IF NOT EXISTS `temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmst` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `txt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `tmst`, `txt`) VALUES
(1, '2019-06-04 10:43:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `cart` varchar(1000) DEFAULT NULL,
  `save_for_later` varchar(255) DEFAULT NULL,
  `tmst` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_page` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`uid`, `first_name`, `last_name`, `mobile`, `email`, `password`, `address`, `pincode`, `cart`, `save_for_later`, `tmst`, `last_page`) VALUES
(52, 'Rajat', 'Saini', '7073491568', 'rajatsaini736@gmail.com', 'rajatsaini', 'a-2 jai narayan vyas colony nawa city nagaur raj', 341509, ' 33  26  26', '', '2019-06-21 08:28:24', 'index.php'),
(53, 'u5g1fftuor1tshl1bmuihgfol1', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '2019-06-20 07:05:51', 'index.php'),
(54, 'Rakesh', 'kumawat', '8503875941', 'rakesh@gmail.com', 'rakeshkumawat', 'ttt', 303338, '', NULL, '2019-06-20 07:05:51', 'index.php'),
(55, 'ruddy', 'tanwar', '7073491568', 'ruddy@gmail.com', 'ruddy', 'a-2 jai narayan vyas colony nawa city nagaur raj', 341509, '', NULL, '2019-06-20 07:05:51', 'index.php'),
(56, 'b2f9puriu1p49883f11jbchsg6', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2019-06-20 07:05:51', 'index.php'),
(57, '701hth2pbhi4nct7uqjmhfekd2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-20 07:20:33', 'index.php'),
(58, 'v7ef16o849ijjt3gin526a9726', NULL, NULL, NULL, NULL, NULL, NULL, ' 26', NULL, '2019-06-21 06:47:34', 'sub_category.php?cid=Music'),
(59, 'esalivir0jglm3udgtqg0rl0t0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-24 09:47:11', 'index.php'),
(60, 'oaa5mvq7mjks0g7pjb8qecka41', NULL, NULL, NULL, NULL, NULL, NULL, ' 26 26 41 21 23', NULL, '2019-06-25 08:08:16', 'cart.php'),
(61, '5nt2gkgfafgp5g7n50dh1fs4i6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-25 09:00:46', 'index.php'),
(62, 'q6n83m6rgflr5vht5t3evpibh5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-25 09:05:37', 'index.php'),
(63, '80defd7b3sjpjb2ioimdo0fuf6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-01 06:52:36', 'index.php');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
