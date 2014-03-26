-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2014 at 11:45 AM
-- Server version: 5.0.96
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zoytexne_vcx27`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL auto_increment,
  `parentId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `rank` tinyint(25) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parentId`, `name`, `alias`, `rank`, `status`) VALUES
(114, 0, 'Footer', 'footer', 0, 1),
(115, 0, 'Giới thiệu', 'gioi-thieu', 0, 1),
(126, 0, 'Dieukhoan', 'dieukhoan', 0, 0),
(125, 0, 'Faq', 'faq', 0, 0),
(124, 0, 'Liên hệ', 'lien-he', 0, 0),
(120, 0, 'AdsTop', 'adstop', 0, 0),
(121, 0, 'AdsCenter', 'adscenter', 0, 0),
(122, 0, 'FanPage', 'fanpage', 0, 0),
(127, 0, 'Giới hạn', 'gioi-han', 0, 0),
(128, 0, 'Nội quy', 'noi-quy', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) NOT NULL auto_increment,
  `company_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL default 'CO',
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `services_offered` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `star` tinyint(4) NOT NULL default '4',
  `categoryId` int(11) NOT NULL default '0',
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=283224 ;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL auto_increment,
  `doc_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `doc_tab` int(10) NOT NULL,
  `doc_file` varchar(255) collate utf8_unicode_ci NOT NULL,
  `doc_type` varchar(255) collate utf8_unicode_ci NOT NULL,
  `doc_size` varchar(255) collate utf8_unicode_ci NOT NULL,
  `summary` text collate utf8_unicode_ci NOT NULL,
  `up_dated` date NOT NULL,
  `create_time` int(50) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `doc_name`, `doc_tab`, `doc_file`, `doc_type`, `doc_size`, `summary`, `up_dated`, `create_time`, `status`) VALUES
(2, 'xcccccccccccccccc', 3, '1364721044_colorbox-master.zip', 'application/zip', '1077955', 'xccccccccccccccccc', '2013-03-31', 0, 0),
(3, 'SSSSSSSSSSSSSS', 3, '1364722658_dxv.doc', 'application/msword', '28672 KB', '', '2013-03-31', 0, 0),
(4, 'ssssssssss', 3, '1364723490_bootstrap.zip', 'application/zip', '84297 bytes', '', '2013-03-31', 0, 0),
(5, 'zzxz', 3, '1364723728_netbiz.doc', 'application/msword', '28672 bytes', '', '2013-03-31', 0, 0),
(6, 'zzzzzzzzzzzzzz', 3, '1364724328_cucna.rar', 'application/rar', '6375857 bytes', '', '2013-03-31', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL auto_increment,
  `fileId` int(11) NOT NULL,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `file` varchar(250) collate utf8_unicode_ci NOT NULL,
  `url_file` varchar(250) collate utf8_unicode_ci NOT NULL,
  `size` int(50) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `fileId`, `name`, `file`, `url_file`, `size`, `status`) VALUES
(2, 1, 'xupload_demo_0.5.1', '/files/20130512/xupload_demo_0.5.1.zip', '', 0, 1),
(4, 0, 'dcccccccc', '', '', 0, 0),
(5, 1, 'Báo giá tháng 1', 'caaaâ', '', 0, 1),
(6, 1, 'Báo giá tháng 1', '', 'xzzzzzzzzzzz', 0, 0),
(7, 2, 'madison', '/files/20130520/madison.zip', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL auto_increment,
  `galleryId` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `create_time` int(50) NOT NULL,
  `status` smallint(1) default '0',
  `feature` smallint(1) default '0',
  `rank` smallint(10) default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_product_category` (`galleryId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=274 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `galleryId`, `name`, `image`, `create_time`, `status`, `feature`, `rank`) VALUES
(194, 20250, 'codon1_6', '/upload/20130511/codon1_6.jpg', 20130511, 1, 0, 0),
(195, 17126, 'danbo_2', '/upload/20130511/danbo_2.jpg', 20130511, 1, 0, 0),
(196, 15738, 'codon1_7', '/upload/20130511/codon1_7.jpg', 20130511, 1, 0, 0),
(197, 12938, 'codon1_8', '/upload/20130511/codon1_8.jpg', 20130511, 1, 0, 0),
(198, 9407, 'codon1_9', '/upload/20130511/codon1_9.jpg', 20130511, 1, 0, 0),
(199, 18631, 'danbo_3', '/upload/20130511/danbo_3.jpg', 20130511, 1, 0, 0),
(200, 3359, 'mamcay', '/upload/20130511/mamcay.jpg', 20130511, 1, 0, 0),
(201, 13002, 'danbo_4', '/upload/20130511/danbo_4.jpg', 20130511, 1, 0, 0),
(202, 26801, 'codon_3', '/upload/20130511/codon_3.jpg', 20130511, 1, 0, 0),
(203, 15474, 'avtech_avp325zbp_camera_avtech_AVP325ZBP_dd', '/upload/20130513/avtech_avp325zbp_camera_avtech_AVP325ZBP_dd.png', 20130513, 1, 0, 0),
(204, 4057, 'lg_l321_bp_camera_lg_L321_BP_dd', '/upload/20130513/lg_l321_bp_camera_lg_L321_BP_dd.png', 20130513, 1, 0, 0),
(205, 31248, 'bo_6_camera_questek_dang_dome_tronbo_questek_6dome_dd_1_', '/upload/20130513/bo_6_camera_questek_dang_dome_tronbo_questek_6dome_dd_1_.png', 20130513, 1, 0, 0),
(206, 26570, 'camea', '/upload/20130513/camea.png', 20130513, 1, 0, 0),
(207, 26570, 'lg_l321', '/upload/20130513/lg_l321.png', 20130513, 1, 0, 0),
(208, 26026, 'camera2', '/upload/20130513/camera2.png', 20130513, 1, 0, 0),
(209, 17946, 'dsssssssss', '/upload/20130513/dsssssssss.jpg', 20130513, 1, 0, 0),
(210, 9291, 'camre6', '/upload/20130513/camre6.png', 20130513, 1, 0, 0),
(211, 8311, 'camre6_1', '/upload/20130513/camre6_1.png', 20130513, 1, 0, 0),
(212, 25830, 'camera5', '/upload/20130513/20130513_camera5.png', 20130513, 1, 0, 0),
(213, 30027, 'fgh_1', '/upload/20130513/fgh_1.png', 20130513, 1, 0, 0),
(214, 32370, 'camea_1', '/upload/20130513/camea_1.png', 20130513, 1, 0, 0),
(215, 32370, 'camera2_1', '/upload/20130513/camera2_1.png', 20130513, 1, 0, 0),
(216, 32370, 'dsssssssss_1', '/upload/20130513/dsssssssss_1.jpg', 20130513, 1, 0, 0),
(217, 32370, 'fgh_2', '/upload/20130513/fgh_2.png', 20130513, 1, 0, 0),
(218, 15280, 'camre6_3', '/upload/20130513/camre6_3.png', 20130513, 1, 0, 0),
(219, 17091, 'hinh1', '/upload/20130513/hinh1.jpg', 20130513, 1, 0, 0),
(220, 4030, 'hinh2', '/upload/20130513/hinh2.jpg', 20130513, 1, 0, 0),
(221, 20453, 'hinh3', '/upload/20130513/hinh3.jpg', 20130513, 1, 0, 0),
(222, 20453, 'hinh3_1', '/upload/20130513/hinh3_1.jpg', 20130513, 1, 0, 0),
(223, 32344, 'hinh4', '/upload/20130513/hinh4.jpg', 20130513, 1, 0, 0),
(224, 31899, 'anigif', '/upload/20130515/anigif.gif', 20130515, 1, 0, 0),
(225, 31899, 'anigif2', '/upload/20130515/anigif2.gif', 20130515, 1, 0, 0),
(226, 28566, 'codon', '/upload/20130517/codon.jpg', 20130517, 1, 0, 0),
(227, 20185, 'hoi_tho', '/upload/20140322/hoi_tho.jpg', 20140322, 1, 0, 0),
(228, 20185, 'hoi_tho_1', '/upload/20140322/hoi_tho_1.jpg', 20140322, 1, 0, 0),
(229, 28618, 'appstore', '/upload/20140322/appstore.jpg', 20140322, 1, 0, 0),
(230, 28618, 'appstore_1', '/upload/20140322/appstore_1.jpg', 20140322, 1, 0, 0),
(231, 14589, '_wallcoo_com__anime_cg_065375', '/upload/20140322/_wallcoo_com__anime_cg_065375.jpg', 20140322, 1, 0, 0),
(232, 10307, '_', '/upload/20140322/_.jpg', 20140322, 1, 0, 0),
(233, 17783, '_anime', '/upload/20140322/_anime.jpg', 20140322, 1, 0, 0),
(234, 32485, '_wallcoo_com__anime_cg_065375_1', '/upload/20140322/_wallcoo_com__anime_cg_065375_1.jpg', 20140322, 1, 0, 0),
(235, 4400, '018', '/upload/20140322/018.jpg', 20140322, 1, 0, 0),
(236, 10498, '_DN_chibi_L__by_Jack666rulez', '/upload/20140322/_DN_chibi_L__by_Jack666rulez.jpg', 20140322, 1, 0, 0),
(237, 16915, '4a', '/upload/20140322/4a.jpg', 20140322, 1, 0, 0),
(238, 16915, 'hoi_tho_2', '/upload/20140322/hoi_tho_2.jpg', 20140322, 1, 0, 0),
(239, 16915, '23', '/upload/20140322/23.jpg', 20140322, 1, 0, 0),
(240, 16915, '2_3', '/upload/20140322/2_3.jpg', 20140322, 1, 0, 0),
(241, 16915, '7', '/upload/20140322/7.jpg', 20140322, 1, 0, 0),
(242, 28567, 'hoi_tho', '/upload/20140322/hoi_tho.jpg', 20140322, 1, 0, 0),
(243, 18950, 'hoi_tho', 'E:/WEB LOCAL/htdocs/yii/vcx27-haivl\\upload\\20140322\\hoi_tho.jpg', 20140322, 1, 0, 0),
(244, 26141, '_222', '/upload/20140322/_222.jpg', 20140322, 1, 0, 0),
(245, 146, '_222_1', '/upload/20140322/_222_1.jpg', 20140322, 1, 0, 0),
(246, 28310, 'sada_adad', '/upload/20140322/sada_adad.jpg', 20140322, 1, 0, 0),
(247, 23739, 'appstore', '/upload/20140322/appstore.jpg', 20140322, 1, 0, 0),
(248, 23739, 'sada_adad_1', '/upload/20140322/sada_adad_1.jpg', 20140322, 1, 0, 0),
(249, 21041, 'hoitho', '/upload/20140322/hoitho.jpg', 20140322, 1, 0, 0),
(250, 23801, 'hoitho_1', '/upload/20140322/hoitho_1.jpg', 20140322, 1, 0, 0),
(251, 23801, 'appstore', '/upload/20140322/appstore.jpg', 20140322, 1, 0, 0),
(252, 15188, 'jam1', '/upload/20140322/jam1.jpg', 20140322, 1, 0, 0),
(253, 15188, 'jam1_1', '/upload/20140322/jam1_1.jpg', 20140322, 1, 0, 0),
(254, 15188, 'jam2', '/upload/20140322/jam2.jpg', 20140322, 1, 0, 0),
(255, 15188, 'jam1_2', '/upload/20140322/jam1_2.jpg', 20140322, 1, 0, 0),
(256, 15188, 'jam2_1', '/upload/20140322/jam2_1.jpg', 20140322, 1, 0, 0),
(257, 15188, 'jam2_2', '/upload/20140322/jam2_2.jpg', 20140322, 1, 0, 0),
(258, 15188, 'jam2_3', '/upload/20140322/jam2_3.jpg', 20140322, 1, 0, 0),
(259, 15188, 'jam1_3', '/upload/20140322/jam1_3.jpg', 20140322, 1, 0, 0),
(260, 15188, 'jam2_4', '/upload/20140322/jam2_4.jpg', 20140322, 1, 0, 0),
(261, 15188, 'jam1_4', '/upload/20140322/jam1_4.jpg', 20140322, 1, 0, 0),
(262, 15188, 'jam2_5', '/upload/20140322/jam2_5.jpg', 20140322, 1, 0, 0),
(263, 15188, 'jam2_6', '/upload/20140322/jam2_6.jpg', 20140322, 1, 0, 0),
(264, 15188, 'jam1_5', '/upload/20140322/jam1_5.jpg', 20140322, 1, 0, 0),
(265, 15188, 'jam1_6', '/upload/20140322/jam1_6.jpg', 20140322, 1, 0, 0),
(266, 15188, 'jam1_7', '/upload/20140322/jam1_7.jpg', 20140322, 1, 0, 0),
(267, 15188, 'jam2_7', '/upload/20140322/jam2_7.jpg', 20140322, 1, 0, 0),
(268, 4894, 'jam1_8', '/upload/20140322/jam1_8.jpg', 20140322, 1, 0, 0),
(269, 19470, 'jam1_9', '/upload/20140322/jam1_9.jpg', 20140322, 1, 0, 0),
(270, 5737, 'jam1_10', '/upload/20140322/jam1_10.jpg', 20140322, 1, 0, 0),
(271, 30662, 'zaloza', '/upload/20140322/zaloza.jpg', 20140322, 1, 0, 0),
(272, 30662, 'donga', '/upload/20140322/donga.jpg', 20140322, 1, 0, 0),
(273, 13344, 'jam1', '/upload/20140324/jam1.jpg', 20140324, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(25) NOT NULL auto_increment,
  `userId` int(100) NOT NULL,
  `categoryId` int(100) NOT NULL,
  `location` varchar(255) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(255) collate utf8_unicode_ci NOT NULL,
  `number` int(10) NOT NULL,
  `gender` int(2) NOT NULL,
  `working_hours` varchar(255) collate utf8_unicode_ci NOT NULL,
  `cityId` int(100) NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `skills` text collate utf8_unicode_ci NOT NULL,
  `education` smallint(1) NOT NULL,
  `wage` varchar(255) collate utf8_unicode_ci NOT NULL,
  `job_type` varchar(255) collate utf8_unicode_ci NOT NULL,
  `probation_period` varchar(255) collate utf8_unicode_ci NOT NULL,
  `mode` text collate utf8_unicode_ci NOT NULL,
  `required` text collate utf8_unicode_ci NOT NULL,
  `update_time` int(50) NOT NULL,
  `create_time` int(50) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `userId`, `categoryId`, `location`, `alias`, `number`, `gender`, `working_hours`, `cityId`, `content`, `skills`, `education`, `wage`, `job_type`, `probation_period`, `mode`, `required`, `update_time`, `create_time`, `status`) VALUES
(5, 5, 9, 'Nhân viên lập trình', '', 0, 1, '', 0, 'dcccccccccccccccccc', '', 2, 'Thỏa thuận', 'Nhân viên', '2 tháng', '', '', 1369864800, 1366969832, 1),
(6, 5, 9, 'Nhân viên PHP', 'nhan-vien-php', 0, 1, '', 0, 'âZZZZZZZZZZZZ', '', 3, '3.000.000 - 5.000.000', '', '', '', '', 1373752800, 1366971395, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
CREATE TABLE IF NOT EXISTS `keyword` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(250) character set utf8 collate utf8_unicode_ci NOT NULL,
  `titleId` int(11) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(250) NOT NULL,
  `model` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`id`, `title`, `titleId`, `alias`, `content`, `img`, `model`) VALUES
(1, 'camera hồng ngoại 2013', 5, 'san-pham/5-camera-hong-ngoai-2013', 'zzzzzzzzzzzzz', '/upload/2013-04-02/img404.jpg', 1),
(2, 'Camera IP 2013', 6, 'san-pham/6-camera-ip-2013', 'xxxxxxxxxxxx', '/upload/2013-04-02/images858911_anh__23_.jpg', 1),
(3, 'camera', 76, 'album/76-camera', 'Zxxxxxxxxxxxxx', '/upload/2013-04-02/img404.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `root` int(11) unsigned default NULL,
  `root1` int(11) NOT NULL,
  `lft` int(11) unsigned NOT NULL,
  `rgt` int(11) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `rank` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`),
  KEY `root` (`root`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `root`, `root1`, `lft`, `rgt`, `level`, `name`, `alias`, `description`, `rank`) VALUES
(39, 39, 0, 1, 2, 1, 'Kênh 4', 'kenh-4', '', 5),
(40, 40, 0, 1, 2, 1, 'Kênh 5', 'kenh-5', '', 6),
(41, 41, 0, 1, 2, 1, 'Kênh 6', 'kenh-6', '', 7),
(42, 42, 0, 1, 2, 1, 'Kênh 7', 'kenh-7', '', 8),
(43, 43, 0, 1, 2, 1, 'Kênh 8', 'kenh-8', '', 9),
(36, 36, 0, 1, 2, 1, 'Kênh 2', 'kenh-2', '', 3),
(35, 35, 0, 1, 8, 1, 'Kênh 1', 'kenh-1', '', 2),
(37, 37, 0, 1, 2, 1, 'Kênh 3', 'kenh-3', '', 4),
(46, 35, 0, 6, 7, 2, 'Sub Kênh 3', 'sub-kenh-3', '', 3),
(45, 35, 0, 4, 5, 2, 'Sub Kênh 2', 'sub-kenh-2', '', 2),
(44, 35, 0, 2, 3, 2, 'Sub Kênh 1', 'sub-kenh-1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

DROP TABLE IF EXISTS `online`;
CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `nick` varchar(50) collate utf8_unicode_ci NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `online`
--

INSERT INTO `online` (`id`, `name`, `phone`, `nick`, `status`) VALUES
(1, 'Huỳnh Từ Vinh', 127, 'huynhtuvinh87', 1),
(2, 'David Vinh', 905951699, 'huynhtuvinh87', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL auto_increment,
  `categoryId` int(11) NOT NULL,
  `imgId` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `image` varchar(255) NOT NULL,
  `linkImg` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `content_1` text NOT NULL,
  `create_time` int(50) NOT NULL,
  `status` smallint(1) default '0',
  `home` smallint(1) default '0',
  `rank` smallint(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `categoryId`, `imgId`, `title`, `alias`, `image`, `linkImg`, `content`, `content_1`, `create_time`, `status`, `home`, `rank`) VALUES
(10, 114, 16270, 'Phần giới thiệu trên footer', 'phan-gioi-thieu-tren-footer', '', '', '', '<p>&copy; 2014 O2.net.vn - Giấy phép MXH số abcxyz..<br /></p>', 1368431868, 1, 0, NULL),
(15, 115, 17024, 'Giới thiệu công ty', 'gioi-thieu-cong-ty', 'upload/20130517/codon.jpg', '', 'ssssssssssssssdx', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1368762232, 1, 0, 12),
(36, 120, 23801, '1', '1', 'upload/20140322/hoitho.jpg', '', '', '1', 1395498919, 1, 0, 1),
(37, 120, 23801, '2', '2', 'upload/20140322/appstore.jpg', '', '', '2', 1395498938, 1, 0, 2),
(38, 121, 30662, 'zaloza', 'zaloza', 'upload/20140322/zaloza.jpg', '', '', 'zaloza', 1395503517, 1, 0, 1),
(39, 121, 30662, 'donga', 'donga', 'upload/20140322/donga.jpg', '', '', 'donga', 1395503534, 1, 0, 2),
(40, 122, 31284, 'Facebook', 'facebook', '', '', '', '&lt;div class=&quot;fb-like-box&quot; data-href=&quot;https://www.facebook.com/NavaGroup&quot; data-width=&quot;262&quot; data-height=&quot;290&quot; data-colorscheme=&quot;light&quot; data-show-faces=&quot;true&quot; data-header=&quot;false&quot; data-stream=&quot;false&quot; data-show-border=&quot;false&quot;&gt;&lt;/div&gt;', 1395625101, 1, 0, NULL),
(41, 124, 0, 'Liên hệ', 'lien-he', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395731130, 1, 0, NULL),
(42, 125, 0, 'Faq', 'faq', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395732021, 1, 0, NULL),
(43, 126, 10068, 'Điều khoản', 'dieu-khoan', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395732030, 1, 0, NULL),
(44, 127, 214047543, 'Giới hạn', 'gioi-han', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />', 1395808545, 1, 0, NULL),
(45, 128, 615374676, 'Nội quy', 'noi-quy', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />', 1395808563, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL auto_increment,
  `menuId` int(11) NOT NULL,
  `imgId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `price` int(11) default '0',
  `warranty` varchar(100) NOT NULL,
  `origin` varchar(250) NOT NULL,
  `content_1` text NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` smallint(1) default '0',
  `home` smallint(1) default '0',
  `feature` smallint(1) default '0',
  `rank` smallint(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `menuId`, `imgId`, `name`, `alias`, `avatar`, `price`, `warranty`, `origin`, `content_1`, `content`, `create_time`, `status`, `home`, `feature`, `rank`) VALUES
(43, 35, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(44, 35, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 2', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-2', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(45, 35, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 3', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-3', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(46, 35, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 4', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-4', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(47, 35, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 5', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-5', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(48, 35, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 6', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-6', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.6', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(49, 35, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 7', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-7', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.7', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(50, 36, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 8', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-8', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.8', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(51, 36, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 9', 'khi-suc-manh-cua-tinh-yeu-da-dang-len-thi-su-khac-biet-ve-giong-loai-khong-con-la-dieu-quan-trong-nhat-9', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.9', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(52, 36, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 10', 'khi-suc-manh-cua-tinh-yeu-da-dang-len-thi-su-khac-biet-ve-giong-loai-khong-con-la-dieu-quan-trong-nhat-10', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.10', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(53, 36, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 11', 'khi-suc-manh-cua-tinh-yeu-da-dang-len-thi-su-khac-biet-ve-giong-loai-khong-con-la-dieu-quan-trong-nhat-11', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.11', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(54, 37, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 12', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-12', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(55, 37, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh13', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh13', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.13', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(56, 37, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh14', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh14', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.14', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(57, 37, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh15', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh15', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.15', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(58, 39, 15188, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh16', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh16', 'upload/20140322/jam2.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.16', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(60, 39, 4894, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh17', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh17', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.17', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(61, 39, 19470, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh19', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh19', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.17', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(62, 39, 5737, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh20', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh20', 'upload/20140322/jam1.jpg', NULL, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.20', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(63, 44, 13344, 'Soi 325 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 25', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-25', 'upload/20140324/jam1.jpg', NULL, '', 'Youtube', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.25', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395650423, 1, 0, 0, 0),
(64, 37, 0, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 12', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-12', '', 0, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395801921, 0, 0, 0, 0),
(65, 37, 0, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 12', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-12', '', 0, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395801952, 0, 0, 0, 0),
(66, 37, 0, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 12', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-12', '', 0, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395802009, 0, 0, 0, 0),
(67, 37, 0, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 12', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-12', '', 0, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395802044, 0, 0, 0, 0),
(68, 37, 0, 'Soi 365 ngày ấy và bây giờ qua bộ tranh cực ngộ nghĩnh 12', 'soi-365-ngay-ay-va-bay-gio-qua-bo-tranh-cuc-ngo-nghinh-12', '', 0, '', '', 'Khi sức mạnh của tình yêu đã dâng lên, thì sự khác biệt về giống loài không còn là điều quan trọng nhất.12', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1395802046, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(50) NOT NULL auto_increment,
  `userId` int(50) NOT NULL,
  `name_company` varchar(255) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(255) collate utf8_unicode_ci NOT NULL,
  `address` varchar(255) collate utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `scale` varchar(255) collate utf8_unicode_ci NOT NULL,
  `website` varchar(255) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

DROP TABLE IF EXISTS `quote`;
CREATE TABLE IF NOT EXISTS `quote` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `file` varchar(250) collate utf8_unicode_ci NOT NULL,
  `url_file` varchar(250) collate utf8_unicode_ci NOT NULL,
  `size` int(50) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL auto_increment,
  `serId` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `image` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` date NOT NULL,
  `status` smallint(1) default '0',
  `feature` smallint(1) default '0',
  `rank` smallint(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `serId`, `name`, `alias`, `image`, `content`, `dateCreated`, `status`, `feature`, `rank`) VALUES
(70, '', ' cccccccccc', 'cccccccccc', '/upload/2013-05-11/140.jpg', 'vdxxxxxxxxxx', '2013-05-11', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(128) collate utf8_unicode_ci NOT NULL,
  `password` varchar(128) collate utf8_unicode_ci NOT NULL,
  `email` varchar(128) collate utf8_unicode_ci NOT NULL,
  `profile` text collate utf8_unicode_ci,
  `status` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `profile`, `status`) VALUES
(1, 'demo', '2e5c7db760a33498023813489cfadc0b', 'webmaster@example.com', NULL, 0),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'contact@vietconex.com', 'admin\r\n', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
