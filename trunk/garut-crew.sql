-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2009 at 12:25 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `garut-crew`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `title_en` text NOT NULL,
  `content` text NOT NULL,
  `content_en` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `title_en`, `content`, `content_en`, `created_date`, `status`) VALUES
(1, 1, 'Testing 1', '', '<p><strong>gw dewa</strong></p>', '', '2009-11-25 14:57:39', 0),
(6, 1, 'Kami Menemukan Emas', 'We Have Found Gold', '<p><strong>emas</strong></p>', '<p><strong>golds</strong></p>', '2009-11-27 11:08:07', 0),
(7, 1, 'Tes 3', 'Test 3', '<p><span style="text-decoration: underline;">Coba create</span></p>', '<p><em><strong>Create test</strong></em></p>', '2009-11-30 13:27:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `name_en` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1: products, 2: designs',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `name_en`, `type`) VALUES
(3, 'gelang', '', 0),
(5, 'kolor', '', 0),
(6, 'topi', 'hat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `design_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `commentator` varchar(100) DEFAULT NULL,
  `commentator_email` varchar(100) DEFAULT NULL,
  `submit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `design_id`, `content`, `commentator`, `commentator_email`, `submit_date`) VALUES
(2, 1, 1, NULL, 'test', NULL, NULL, '2009-11-26 17:44:29'),
(3, NULL, 1, NULL, 'Test 2', 'Karol Danutama', 'karoldanutama@gmail.com', '2009-11-26 17:52:31'),
(4, NULL, 3, NULL, 'test 3', 'test 3', 'karoldanutama@gmail.com', '2009-11-26 17:53:03'),
(5, 1, 1, NULL, 'tes 4', NULL, NULL, '2009-11-27 02:42:47'),
(6, 1, 1, NULL, 'tes 4', NULL, NULL, '2009-11-27 02:42:58'),
(7, 1, 5, NULL, '', NULL, NULL, '2009-11-27 02:57:00'),
(8, NULL, 1, NULL, 'test comment', 'Gogo', 'hallucinogenplus@yahoo.com', '2009-11-27 11:01:25'),
(12, 1, 1, NULL, 'Komentar 2', NULL, NULL, '2009-12-02 10:42:06'),
(10, 1, NULL, 6, 'Hebat', NULL, NULL, '2009-12-02 08:54:29'),
(11, 1, NULL, 6, 'Gw dewa', NULL, NULL, '2009-12-02 08:55:13'),
(13, 1, 1, NULL, 'Komentar 3', NULL, NULL, '2009-12-02 10:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

DROP TABLE IF EXISTS `designs`;
CREATE TABLE IF NOT EXISTS `designs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `description_en` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `picture_file_path` text,
  `picture_file_url` text,
  `rating` float DEFAULT '0',
  `rate_count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `category_id`, `user_id`, `name`, `description`, `description_en`, `price`, `picture_file_path`, `picture_file_url`, `rating`, `rate_count`) VALUES
(3, 5, 1, 'Design Test 1', '<p><strong>test</strong></p>', '', 300, NULL, NULL, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `description_en` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `picture_file_path` text,
  `picture_file_url` text,
  `rating` float NOT NULL DEFAULT '0',
  `rate_count` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `description_en`, `category_id`, `picture_file_path`, `picture_file_url`, `rating`, `rate_count`, `price`) VALUES
(1, 'Gelang Item', '<p>Gelang Merah</p>', '<p><em><span style="text-decoration: underline;"><strong>red glove</strong></span></em></p>', 3, '{"1":"D:\\\\xampp\\\\htdocs\\\\garut-crew-website\\\\public\\\\files\\\\CC.JPG","2":"D:\\\\xampp\\\\htdocs\\\\garut-crew-website\\\\public\\\\files\\\\Picture4.jpg","3":"D:\\\\xampp\\\\htdocs\\\\garut-crew-website\\\\public\\\\files\\\\Picture3.jpg","4":"D:\\\\xampp\\\\htdocs\\\\garut-crew-website\\\\public\\\\files\\\\Picture9.jpg"}', '{"1":"http:\\/\\/localhost\\/garut-crew-website\\/public\\/files\\/CC.JPG","2":"http:\\/\\/localhost\\/garut-crew-website\\/public\\/files\\/Picture4.jpg","3":"http:\\/\\/localhost\\/garut-crew-website\\/public\\/files\\/Picture3.jpg","4":"http:\\/\\/localhost\\/garut-crew-website\\/public\\/files\\/Picture9.jpg"}', 4.22222, 9, 50000),
(3, 'Test2', '<p><strong><span style="text-decoration: underline;">aku adalah anak gembala</span></strong></p>', '', 5, NULL, NULL, 3, 1, 200),
(4, 'test 3', '', '', 3, '{"1":"D:\\\\xampp\\\\htdocs\\\\garut-crew-website\\\\public\\\\files\\\\Picture5.jpg","2":"D:\\\\xampp\\\\htdocs\\\\garut-crew-website\\\\public\\\\files\\\\CC.JPG"}', '{"1":"http:\\/\\/localhost\\/garut-crew-website\\/public\\/files\\/Picture5.jpg","2":"http:\\/\\/localhost\\/garut-crew-website\\/public\\/files\\/CC.JPG"}', 3.25, 4, 100),
(5, 'test 10', '', '', 3, NULL, NULL, 0, 0, 200),
(8, 'test 6', '<p>test 7</p>', '', 5, NULL, NULL, 0, 0, 200),
(9, 'Gelang Ijo', '<p>Gelang Ijo</p>', '<p>Green glove</p>', 3, NULL, NULL, 0, 0, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'administrator', ''),
(2, 'login', ''),
(3, 'member', 'Regular members');

-- --------------------------------------------------------

--
-- Table structure for table `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 2),
(3, 1),
(4, 2),
(4, 3),
(5, 2),
(5, 3),
(6, 2),
(6, 1),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 2),
(9, 1),
(10, 2),
(10, 3),
(11, 2),
(11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `logins` int(10) NOT NULL,
  `last_login` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthday` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `logins`, `last_login`, `email`, `first_name`, `last_name`, `birthday`, `address`, `zipcode`, `phone`) VALUES
(1, 'admin', '93c6305e03d4c6a4f8d705bdfb6e8eced1bb014a139810d158', 63, 1260332788, 'karoldanutama@gmail.com', 'Karol', 'Danutama', '21-05-90', 'Jalan Selat Bangka IV\n', '13440', '08179851878'),
(11, 'karol', '548533b37addf0bfc90b349532968cf80eec89f8ccf91fda56', 1, 1260331314, 'kd_of_recursion@yahoo.com', 'K', 'D', '', '', '', '');
