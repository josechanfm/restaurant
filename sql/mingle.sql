-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 28, 2022 at 03:25 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mingle`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_groups`
--

CREATE TABLE `admin_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES
(1, 'webmaster', 'Webmaster'),
(2, 'admin', 'Administrator'),
(3, 'manager', 'Manager'),
(4, 'staff', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_attempts`
--

CREATE TABLE `admin_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
(1, '127.0.0.1', 'webmaster', '$2y$08$/X5gzWjesYi78GqeAv5tA.dVGBVP7C1e1PzqnYCVe5s1qhlDIPPES', NULL, NULL, NULL, NULL, NULL, NULL, 1451900190, 1643331689, 1, 'Webmaster', ''),
(2, '127.0.0.1', 'admin', '$2y$08$7Bkco6JXtC3Hu6g9ngLZDuHsFLvT7cyAxiz1FzxlX5vwccvRT7nKW', NULL, NULL, NULL, NULL, NULL, NULL, 1451900228, 1465489580, 1, 'Admin', ''),
(3, '127.0.0.1', 'manager', '$2y$08$snzIJdFXvg/rSHe0SndIAuvZyjktkjUxBXkrrGdkPy1K6r5r/dMLa', NULL, NULL, NULL, NULL, NULL, NULL, 1451900430, 1465489585, 1, 'Manager', ''),
(4, '127.0.0.1', 'staff', '$2y$08$NigAXjN23CRKllqe3KmjYuWXD5iSRPY812SijlhGeKfkrMKde9da6', NULL, NULL, NULL, NULL, NULL, NULL, 1451900439, 1465489590, 1, 'Staff', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_groups`
--

CREATE TABLE `admin_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users_groups`
--

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `api_access`
--

CREATE TABLE `api_access` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'anonymous', 1, 1, 0, NULL, 1463388382);

-- --------------------------------------------------------

--
-- Table structure for table `api_limits`
--

CREATE TABLE `api_limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `api_logs`
--

CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `faculty_id`, `department_id`, `name`) VALUES
(1, 1, 2, ''),
(2, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `name`) VALUES
(1, 1, 'Computing Study'),
(2, 1, 'Public Administrative'),
(3, 2, 'Nursing program');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `dean` varchar(64) COLLATE utf8_bin NOT NULL,
  `campus` varchar(64) COLLATE utf8_bin NOT NULL,
  `phone` varchar(16) COLLATE utf8_bin NOT NULL,
  `start` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `dean`, `campus`, `phone`, `start`) VALUES
(1, 'ESAP', '', '', '', NULL),
(2, 'ESS', '', '', '', NULL),
(3, 'Faculty of Education', 'Peter', 'Main Campus', '1234567', '2019-01-01'),
(4, 'Faculty of Philosophy', 'John', 'Main Campus', '2456787', '2019-01-01'),
(5, 'Faculty of Humanities', 'Simon', 'Main Campus', '3456546', '2019-01-01'),
(6, '', '', 'Main Campus', '', '1970-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `loaner`
--

CREATE TABLE `loaner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `remark` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaner`
--

INSERT INTO `loaner` (`id`, `name`, `contact`, `date_start`, `date_end`, `remark`, `timestamp`) VALUES
(1, 'aa', '', '0000-00-00', '0000-00-00', '', '2022-01-19 09:55:20'),
(2, 'bb', '', '0000-00-00', '0000-00-00', '', '2022-01-19 09:59:34'),
(3, 'cc', '', '0000-00-00', '0000-00-00', '', '2022-01-19 09:59:57'),
(4, 'dd', '', '0000-00-00', '0000-00-00', '', '2022-01-19 10:00:20'),
(5, 'ee', '', '0000-00-00', '0000-00-00', '', '2022-01-19 10:05:37'),
(6, 'cc', '', '0000-00-00', '0000-00-00', '', '2022-01-19 10:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `loaner_items`
--

CREATE TABLE `loaner_items` (
  `id` int(11) NOT NULL,
  `loaner_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaner_items`
--

INSERT INTO `loaner_items` (`id`, `loaner_id`, `pid`, `qty`, `timestamp`) VALUES
(1, 1, 3, 1, '2022-01-19 09:55:20'),
(2, 2, 3, 1, '2022-01-19 09:59:34'),
(3, 3, 3, 1, '2022-01-19 09:59:57'),
(4, 4, 3, 1, '2022-01-19 10:00:20'),
(5, 4, 3, 1, '2022-01-19 10:00:20'),
(6, 4, 1, 1, '2022-01-19 10:00:20'),
(7, 5, 3, 1, '2022-01-19 10:05:37'),
(8, 5, 1, 1, '2022-01-19 10:05:37'),
(9, 5, 3, 1, '2022-01-19 10:05:37'),
(10, 5, 1, 1, '2022-01-19 10:05:37'),
(11, 6, 3, 1, '2022-01-19 10:06:25'),
(12, 6, 1, 1, '2022-01-19 10:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_zh` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `staff_num` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `name_zh`, `name_en`, `nickname`, `staff_num`, `mobile`, `extension`, `email`, `timestamp`) VALUES
(1, 1, 'jose', 'chan', 'simon', '', '', '', '', '2022-01-25 15:25:22'),
(2, 1, '222', '333', '444', '555', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(20) COLLATE utf8_bin NOT NULL,
  `sub_category` varchar(50) COLLATE utf8_bin NOT NULL,
  `barcode` varchar(20) COLLATE utf8_bin NOT NULL,
  `brand` varchar(50) COLLATE utf8_bin NOT NULL,
  `name` tinytext COLLATE utf8_bin NOT NULL,
  `origin` varchar(20) COLLATE utf8_bin NOT NULL,
  `packing` varchar(20) COLLATE utf8_bin NOT NULL,
  `volume` int(11) NOT NULL,
  `unit` varchar(6) COLLATE utf8_bin NOT NULL,
  `image` varchar(20) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin DEFAULT NULL,
  `dealer_price` int(11) NOT NULL,
  `sales_price` varchar(20) COLLATE utf8_bin NOT NULL,
  `trade` varchar(20) COLLATE utf8_bin NOT NULL,
  `remarks` text COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `sub_category`, `barcode`, `brand`, `name`, `origin`, `packing`, `volume`, `unit`, `image`, `description`, `dealer_price`, `sales_price`, `trade`, `remarks`, `date`, `status`) VALUES
(1, '1', '11', '8809470122234', 'Mediheal美迪惠尔', '(27ml×10)美迪惠尔水润保湿面膜-升级版带logo（完税版）', '韩国', '50盒/件', 50, '盒', 'image001.png', '<p>\n	&ldquo;在韩国，每三秒钟卖出一盒。MEDIHEAL美迪惠尔是韩国L&amp;P(株)化妆品旗下护肤品牌。MEADIHEAL美迪惠尔一直延续&ldquo;安全、温和、舒适&rdquo;的品牌理念，全线产品均通过严格的皮肤科安全测试，旨在让大家毫无顾虑的享受肌肤的美丽蜕变。&rdquo; 常规爆款系列，堆头促销明星系列，且适宜长期堆头，且品牌的筛选在精不在多，能极大程度上起到带动效果。</p>\n', 64, '220', '一般贸易', NULL, '2020-02-10', 1),
(2, '1', '11', '8809127535370', 'Merbliss\n茉贝丽思', '（25g*5片）Merbliss茉贝丽思 婚纱补水面膜（完税版）', '韩国', '100盒/件', 100, '盒', 'image003.png', '“韩国热卖，准新娘面膜，号称一片立即改善肌肤，在你人生中非常重要的日子给你非常好的状态；面膜厚度仅有0.21毫米，能够吸收达到面膜重量的10倍精华，而精华含量25毫克，相当于一瓶精华素，各大美妆博主强势推荐。”', 40, '89', '一般贸易', NULL, '2021-02-10', 1),
(3, '1', '11', '8809127534854', 'NeFactory 秘法特丽', '（3g*0.2g*3g*5片）秘法特丽猪鼻贴三部曲（完税版）', '韩国', '100盒/件', 100, '盒', 'image005.png', '“韩国人气鼻贴，低刺激，含有猪皮胶原蛋白，紧贴面部线条的同时，能够滋养瓶皮肤，为干燥的肌肤表层提供充分水分，使之恢复弹性。”', 38, '88', '一般贸易', NULL, '2021-02-10', 0),
(4, '1', '12', '83078002084', 'Carmex    小蜜媞 ', '10g 小蜜媞 修护唇膏（管装）(完税版)', '美国', '12支/中盒\n 30中盒/件', 360, '支', 'image007.png', '“美国PharmacyTimesmagazine的年度最佳护唇圣品，消费者心目中的最佳唇部保养品牌之一。在美上市后长达60多年的销售传奇，全世界平均每分钟可卖出100个，至今全球累积销量已达75亿支。是好莱坞明星的最爱、网络询问度最高、销售No. 1的护唇膏!”                 常规爆款季节商品，，细分品类在精不在多，唇膏系列明细商品。', 16, '38.9', '一般贸易', NULL, '2021-02-10', 0),
(5, '1', '12', '83078002053', 'Carmex    小蜜媞 ', '7.5g 小蜜媞 修护唇膏（盒装）(完税版)', '美国', '12盒/中盒 \n30中盒/件', 360, '盒', 'image009.png', '“美国PharmacyTimesmagazine的年度最佳护唇圣品，消费者心目中的最佳唇部保养品牌之一。在美上市后长达60多年的销售传奇，全世界平均每分钟可卖出100个，至今全球累积销量已达75亿支。是好莱坞明星的最爱、网络询问度最高、销售No. 1的护唇膏!”                 常规爆款季节商品，，细分品类在精不在多，唇膏系列明细商品。', 16, '38.9', '一般贸易', NULL, '2021-02-10', 0),
(6, '1', '11', '8809381691423', ' Rainbow  莱妃尔', '（25ml×10）Rainbow莱妃尔熊猫莹润面膜（完税版）', '韩国', '50盒/件 ', 50, '盒', 'image011.png', '“经典动物面膜”，进口品渠道必卖系列。“熊猫、老虎、羊羊、美猴王”。莱妃尔作为面膜专业工厂起步以来，通过不断的研发，最终研制出国际上最先的3step面膜，努力成为韩国国内第一的面膜生产供应商。”                   常规爆款系列，堆头促销明星系列，且适宜长期堆头，且零售端利润空间客观，知名品牌却能保有一定利润空间和差异化。', 56, '180', '一般贸易', NULL, '2021-02-10', 0),
(7, '1', '11', '8809381691447', ' Rainbow  莱妃尔', '（25ml×10）Rainbow莱妃尔羊羊保湿紧致面膜（完税版）', '韩国', '50盒/件 ', 50, '盒', 'image013.png', '“经典动物面膜”，进口品渠道必卖系列。“熊猫、老虎、羊羊、美猴王”。莱妃尔作为面膜专业工厂起步以来，通过不断的研发，最终研制出国际上最先的3step面膜，努力成为韩国国内第一的面膜生产供应商。”                   常规爆款系列，堆头促销明星系列，且适宜长期堆头，且零售端利润空间客观，知名品牌却能保有一定利润空间和差异化。', 56, '180', '一般贸易', NULL, '2021-02-10', 0),
(8, '1', '11', '8809381691430', ' Rainbow  莱妃尔', '（25ml×10）Rainbow莱妃尔老虎抗皱面膜（完税版）', '韩国', '50盒/件 ', 50, '盒', 'image015.png', '“经典动物面膜”，进口品渠道必卖系列。“熊猫、老虎、羊羊、美猴王”。莱妃尔作为面膜专业工厂起步以来，通过不断的研发，最终研制出国际上最先的3step面膜，努力成为韩国国内第一的面膜生产供应商。”                   常规爆款系列，堆头促销明星系列，且适宜长期堆头，且零售端利润空间客观，知名品牌却能保有一定利润空间和差异化。', 56, '180', '一般贸易', NULL, '2021-02-10', 0),
(9, '1', '11', '8809381691454', ' Rainbow  莱妃尔', '（25ml×10）Rainbow莱妃尔美猴王舒缓保湿面膜（完税版）', '韩国', '50盒/件', 50, '盒', 'image017.png', '“经典动物面膜”，进口品渠道必卖系列。“熊猫、老虎、羊羊、美猴王”。莱妃尔作为面膜专业工厂起步以来，通过不断的研发，最终研制出国际上最先的3step面膜，努力成为韩国国内第一的面膜生产供应商。”                   常规爆款系列，堆头促销明星系列，且适宜长期堆头，且零售端利润空间客观，知名品牌却能保有一定利润空间和差异化。', 56, '180', '一般贸易', NULL, '2021-02-10', 0),
(10, '1', '11', '8809381690426', ' Rainbow  莱妃尔', '（25ml×10）Rainbow莱妃尔三部曲保湿紧致面膜（完税版）', '韩国', '30盒/件 ', 30, '盒', 'image019.png', '“彩虹三部曲”，三部曲面膜鼻祖。“卸妆、洁面、面膜护肤”，莱妃尔作为面膜专业工厂起步以来，通过不断的研发，最终研制出国际上最先的3step面膜，努力成为韩国国内第一的面膜生产供应商。”                   常规爆款系列，堆头促销明星系列，且适宜长期堆头，且零售端利润空间客观，知名品牌却能保有一定利润空间和差异化。', 49, '160', '一般贸易', NULL, '2021-02-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms_users`
--

CREATE TABLE `sms_users` (
  `id` int(11) DEFAULT NULL,
  `admin_user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'member', '$2y$08$kkqUE2hrqAJtg.pPnAhvL.1iE7LIujK5LZ61arONLpaBBWh/ek61G', NULL, 'member@member.com', NULL, NULL, NULL, NULL, 1451903855, 1625027226, 1, 'Member', 'One', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_access`
--
ALTER TABLE `api_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_limits`
--
ALTER TABLE `api_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_logs`
--
ALTER TABLE `api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaner`
--
ALTER TABLE `loaner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaner_items`
--
ALTER TABLE `loaner_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `api_access`
--
ALTER TABLE `api_access`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_limits`
--
ALTER TABLE `api_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_logs`
--
ALTER TABLE `api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loaner`
--
ALTER TABLE `loaner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loaner_items`
--
ALTER TABLE `loaner_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
