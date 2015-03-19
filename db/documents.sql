-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- เวอร์ชั่นของเซิร์ฟเวอร์: 5.0.51b-community-nt-log
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- ฐานข้อมูล: `documents`
--
CREATE DATABASE IF NOT EXISTS `documents` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `documents`;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_configs`
--

DROP TABLE IF EXISTS `tbl_configs`;
CREATE TABLE IF NOT EXISTS `tbl_configs` (
  `website_name` varchar(255) NOT NULL,
  `website_theme` varchar(100) default NULL,
  `website_language` varchar(2) default 'th',
  PRIMARY KEY  (`website_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Configurations Table';

--
-- dump ตาราง `tbl_configs`
--

INSERT INTO `tbl_configs` (`website_name`, `website_theme`, `website_language`) VALUES
('DW/DM : File Uploader', '0', 'th');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_docs_auth`
--

DROP TABLE IF EXISTS `tbl_docs_auth`;
CREATE TABLE IF NOT EXISTS `tbl_docs_auth` (
  `group_id` tinyint(4) NOT NULL,
  `docs_cate_id` int(11) NOT NULL,
  PRIMARY KEY  (`group_id`,`docs_cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- dump ตาราง `tbl_docs_auth`
--

INSERT INTO `tbl_docs_auth` (`group_id`, `docs_cate_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 9),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(4, 6),
(4, 7),
(4, 9);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_docs_category`
--

DROP TABLE IF EXISTS `tbl_docs_category`;
CREATE TABLE IF NOT EXISTS `tbl_docs_category` (
  `docs_cate_id` int(11) NOT NULL auto_increment,
  `docs_cate_code` varchar(20) NOT NULL,
  `docs_cate_name` varchar(50) NOT NULL,
  `docs_cate_updatetime` datetime default NULL,
  PRIMARY KEY  (`docs_cate_code`),
  UNIQUE KEY `docs_cate_id` (`docs_cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Documents Category' AUTO_INCREMENT=10 ;

--
-- dump ตาราง `tbl_docs_category`
--

INSERT INTO `tbl_docs_category` (`docs_cate_id`, `docs_cate_code`, `docs_cate_name`, `docs_cate_updatetime`) VALUES
(1, 'CM', 'CM : Customer & Marketing', '2013-08-24 14:04:06'),
(2, 'FI', 'FI : Financials', '2013-08-24 15:10:51'),
(3, 'HKR', 'HKR : HR KPIs Risk', '2013-08-24 13:22:29'),
(4, 'NUA', 'NUA : Network Usage Analysis', '2013-08-24 15:03:10'),
(7, 'RISKDIV', 'RISK : Division', '2013-08-27 09:22:03'),
(9, 'RISKORG', 'RISK : Organization', '2013-08-29 11:56:37');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_documents`
--

DROP TABLE IF EXISTS `tbl_documents`;
CREATE TABLE IF NOT EXISTS `tbl_documents` (
  `docs_id` int(11) NOT NULL auto_increment,
  `docs_years` varchar(4) NOT NULL,
  `docs_filename` varchar(255) default NULL,
  `docs_desc` varchar(255) NOT NULL,
  `docs_owner` varchar(255) NOT NULL,
  `docs_uploadby` varchar(100) NOT NULL,
  `docs_updatetime` datetime default NULL,
  `docs_downloads` int(11) default '0',
  `docs_publish` varchar(1) NOT NULL default 'Y',
  `docs_cate_code` varchar(20) NOT NULL,
  PRIMARY KEY  (`docs_id`),
  KEY `NewIndex1` (`docs_cate_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Douments' AUTO_INCREMENT=29 ;

--
-- dump ตาราง `tbl_documents`
--

INSERT INTO `tbl_documents` (`docs_id`, `docs_years`, `docs_filename`, `docs_desc`, `docs_owner`, `docs_uploadby`, `docs_updatetime`, `docs_downloads`, `docs_publish`, `docs_cate_code`) VALUES
(28, '2556', '20130920-CM ข้อมูลเปรียบเทียบ Package 3G_9 พค 2556.jpg', 'CM เปรียบเทียบ Package 3G ณ 9 พ.ค. 2556', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-20 09:43:42', 5, 'Y', 'CM'),
(7, '2556', '20130904-UAT.txt', 'ทดสอบเพิ่ม Document owner', 'นายทดสอบ', 'เจ้าหน้าที่คู่เทียบ', '2013-09-10 12:56:25', 3, 'N', 'NUA'),
(8, '2556', '20130906-IIG Market share 2012.pptx', 'CM/UAT file-upload test:Industrial Bench marking Report ', 'Corporate Strategic Planning Department ', 'Palakom Trachu', '2013-09-06 14:23:28', 7, 'Y', 'CM'),
(9, '2556', '20130906-Thailand Q2-Mobile Market Share Yr2011.jpg', 'CM/UAT File-upload test:Industrial Benchmarking Report', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-06 14:22:50', 11, 'Y', 'CM'),
(10, '2556', '20130906-DWDM-CM_รายงานข้อมูลคู่เทียบ_MS Word Format_01.doc', 'CM/UAT File-Upload test:Industrial Benchmarking Report', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-06 14:29:35', 2, 'Y', 'CM'),
(11, '2556', '20130906-DWDM-CM_Internet service_รายงานข้อมูลคู่เทียบ_Excel Format.xls', 'CM/UAT File-upload test:Industrial Benchmarking Report', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-06 14:42:50', 6, 'Y', 'CM'),
(12, '2556', '20130909-NUA 01_ข้อมูลสถานีฐานบริการ 3G_2100 MHz_6 พค 2556.jpg', 'ข้อมูลสถานีฐานบริการ 3G คลื่น 2.1GHz ณ วันที่ 6 พฤษภาคม 2556', 'Corporate Strategic Planning Department ', 'Palakom Trachu', '2013-09-09 11:57:23', 6, 'Y', 'NUA'),
(13, '2556', '20130909-NUA 02_แผนการขยาย 3G_2100 MHz_AIS_6 พค 2556.jpg', 'แผนการขยายโครงข่าย 3G 2.1GHz ของ AIS ณ พฤษภาคม 2556', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 12:17:39', 3, 'Y', 'NUA'),
(14, '2556', '20130909-NUA 03_แผนการขยาย 3G_2100 MHz_Dtac_2556.jpg', 'พื้นที่ให้บริการ 3G 2.1GHz ของ Dtac ณ ต้นปี 2556', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 12:26:18', 3, 'Y', 'NUA'),
(15, '2556', '20130909-NUA 04_1_พื้นที่โครงข่ายรองรับบริการ 3G_2100 MHz_True Move H_2556.jpg', 'พื้นที่โครงข่ายเพื่อรองรับการให้บริการ 3G 2.1GHz ของ True Move H ปี 2556 (Pic 1)', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 12:38:13', 4, 'Y', 'NUA'),
(16, '2556', '20130909-NUA 04_2_พื้นที่โครงข่ายรองรับบริการ 3G_2100 MHz_True Move H_2556.jpg', 'พื้นที่โครงข่ายเพื่อรองรับการให้บริการ 3G 2.1GHz ของ True Move H ณ ปี 2556 (Pic 2)', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 12:39:39', 4, 'Y', 'NUA'),
(20, '2556', '20130909-NUA 05_แถบคลื่นความถี่ย่าน 2.1GHz ของผู้ให้บริการภายใต้เทคโนโลยี 3G.jpg', 'แถบคลื่นความถี่เพื่อรองรับการให้บริการโทรศัพท์เคลื่อนที่ภายใต้เทคโนโลยี 3 Generation(3G) ย่าน 2.1GHz จากการประมูลโดย กสทช. เมื่อ 16 ตุลาคม 2555', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 14:05:25', 3, 'Y', 'NUA'),
(21, '2556', '20130909-NUA 06_3G Mobile Network ของประเทศไทย ปี 2556.jpg', '3G Mobile Network ของประเทศไทย ปี 2556', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 14:18:50', 7, 'Y', 'NUA'),
(22, '2556', '20130909-NUA 07_เปรียบเทียบผลทดสอบการใช้งานบนเครือข่าย 3G ของ กสทช.jpg', 'เปรียบเทียบผลทดสอบการใช้งานบนเครือข่าย 3G ของ กสทช ', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 14:28:15', 6, 'Y', 'NUA'),
(23, '2556', '20130909-NUA 08_ตารางเปรียบเทียบมาตรฐานเทคโนโลยีและคลื่นความถี่ของผู้ให้บริการโทรศัพท์เคลื่อนที่ประเทศไทย.jpg', 'ตารางเปรียบเทียบมาตรฐานเทคโนโลยีและคลื่นความถี่ของผู้ให้บริการโทรศัพท์เคลื่อนที่ประเทศไทย', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 14:35:26', 3, 'Y', 'NUA'),
(24, '2556', '20130909-NUA 09_TOT IIG Connectivity Map.jpg', 'TOT International Internet Exchange Connectivity Map : March 2013', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 14:59:40', 3, 'Y', 'NUA'),
(25, '2556', '20130909-NUA 10_true IIG Connectivity Map.jpg', 'true International Internet Gateway Connectivity Map ', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 15:10:29', 6, 'Y', 'NUA'),
(26, '2556', '20130909-NUA 11_CS Loxinfo Bandwidth Map_28_06_2013.jpg', 'CS Loxinfo Bandwidth Map : status as of 28/06/2013', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 15:16:48', 4, 'Y', 'NUA'),
(27, '2556', '20130909-NUA 12_CAT Telecom Internet Map_02_09_2013.jpg', 'CAT Telecom Internet Map_02_09_2013', 'Corporate Strategic Planning Department', 'Palakom Trachu', '2013-09-09 15:23:43', 6, 'Y', 'NUA');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_icons`
--

DROP TABLE IF EXISTS `tbl_icons`;
CREATE TABLE IF NOT EXISTS `tbl_icons` (
  `icon_id` tinyint(4) NOT NULL auto_increment,
  `icon_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`icon_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§äÍ¤Í¹' AUTO_INCREMENT=24 ;

--
-- dump ตาราง `tbl_icons`
--

INSERT INTO `tbl_icons` (`icon_id`, `icon_name`) VALUES
(1, 'icon-home.png'),
(2, 'icon-config.png'),
(3, 'icon-keyin.gif'),
(4, 'icon-profile.gif'),
(5, 'icon-report.png'),
(6, 'icon-logout.png'),
(7, 'icon-manual.png'),
(8, 'icon-company.png'),
(9, 'icon-db.png'),
(10, 'icon-menu.gif'),
(11, 'icon-permission.png'),
(12, 'icon-aboutus.gif'),
(13, 'icon-form.png'),
(14, 'icon-department.png'),
(15, 'icon-approved.gif'),
(16, 'icon-group.png'),
(17, 'icon-process.gif'),
(18, 'icon-user.png'),
(19, 'icons-calendar.gif'),
(20, 'icon-printer.png'),
(21, 'icon-view.png'),
(22, 'icon-download.gif'),
(23, 'icon-upload.gif');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menu_id` tinyint(4) NOT NULL auto_increment,
  `menu_name_th` varchar(70) NOT NULL,
  `menu_name_en` varchar(70) default NULL,
  `menu_file` varchar(50) NOT NULL,
  `menu_order` tinyint(4) default NULL,
  `mgroup_id` tinyint(4) default NULL,
  `icon_id` tinyint(4) default NULL,
  PRIMARY KEY  (`menu_id`),
  KEY `Ref44105` (`icon_id`),
  KEY `Ref554` (`mgroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§àÁ¹Ù' AUTO_INCREMENT=20 ;

--
-- dump ตาราง `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `menu_name_th`, `menu_name_en`, `menu_file`, `menu_order`, `mgroup_id`, `icon_id`) VALUES
(1, 'จัดการเว็บไซต์', 'Website Management', 'config', 1, 1, 2),
(3, 'เปลี่ยนรหัสผ่าน', 'Change Password', 'profile', 1, 3, 4),
(7, 'เกี่ยวกับโปรแกรม', 'About Programs', 'about', 1, 8, 12),
(8, 'รายการเอกสาร', 'Upload new file', 'docs_upload', 1, 4, 23),
(10, 'ผู้ใช้งานระบบ', 'User Management', 'users', 6, 1, 18),
(11, 'กลุ่มผู้ใช้งาน', 'User Group Management', 'user_group', 5, 1, 16),
(13, 'กลุ่มเมนูระบบ', 'Menu Group Management', 'menu_group', 2, 1, 10),
(14, 'เมนูระบบ', 'Menu Management', 'menu', 3, 1, 10),
(16, 'คู่มือการใช้งาน', 'User Manual', 'manual', 2, 8, 7),
(17, 'สิทธิ์เมนูใช้งาน', 'Menu Authorization', 'menu_auth', 4, 1, 11),
(18, 'กลุ่มเอกสาร', 'Document Category', 'docs_category', 7, 1, 14),
(19, 'สิทธิ์กลุ่มเอกสาร', 'Document Authorization', 'docs_auth', 8, 1, 11);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_menu_auth`
--

DROP TABLE IF EXISTS `tbl_menu_auth`;
CREATE TABLE IF NOT EXISTS `tbl_menu_auth` (
  `group_id` tinyint(4) NOT NULL,
  `menu_id` tinyint(4) NOT NULL,
  PRIMARY KEY  (`group_id`,`menu_id`),
  KEY `Ref337` (`menu_id`),
  KEY `Ref838` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ÊÔ·¸Ôì¡ÒÃà¢éÒ¶Ö§àÁ¹Ù';

--
-- dump ตาราง `tbl_menu_auth`
--

INSERT INTO `tbl_menu_auth` (`group_id`, `menu_id`) VALUES
(1, 1),
(1, 3),
(1, 10),
(1, 11),
(1, 13),
(1, 14),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(2, 16),
(4, 16);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_menu_group`
--

DROP TABLE IF EXISTS `tbl_menu_group`;
CREATE TABLE IF NOT EXISTS `tbl_menu_group` (
  `mgroup_id` tinyint(4) NOT NULL auto_increment,
  `menu_group_th` varchar(50) NOT NULL,
  `menu_group_en` varchar(50) default NULL,
  `menu_path` varchar(50) NOT NULL,
  `menu_order` tinyint(4) default NULL,
  `icon_id` tinyint(4) default '3',
  PRIMARY KEY  (`mgroup_id`),
  KEY `Ref44106` (`icon_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÅØèÁàÁ¹Ù' AUTO_INCREMENT=9 ;

--
-- dump ตาราง `tbl_menu_group`
--

INSERT INTO `tbl_menu_group` (`mgroup_id`, `menu_group_th`, `menu_group_en`, `menu_path`, `menu_order`, `icon_id`) VALUES
(1, 'ผู้ดูแลระบบ', 'Administrator', 'Admin', 1, 2),
(3, 'ข้อมูลส่วนตัว', 'Profiles', 'Master', 2, 4),
(4, 'จัดการเอกสาร', 'Document Managemant', 'Uploads', 3, 23),
(8, 'คู่มือการใช้งาน', 'User Manual', 'Manual', 7, 7);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `telephone` varchar(20) default NULL,
  `updatetime` datetime default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¼Ùéãªé§Ò¹' AUTO_INCREMENT=13 ;

--
-- dump ตาราง `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `telephone`, `updatetime`) VALUES
(2, 'cat', 'MTIzNDU2', 'Document Upload', '-', 'piyapong.k@cattelecom.com', '-', '2014-03-03 11:37:17'),
(7, 'admin', 'MTIzNDU2', 'Adminstrator', 'Administrator', 'piyapong.k@cattelecom.com', '02-9999999', '2013-08-27 09:37:26'),
(8, 'compare', 'MTIzNDU2', 'เจ้าหน้าที่คู่เทียบ', NULL, NULL, NULL, '2013-08-27 09:46:32'),
(9, 'trisrisk', 'MTIzNDU2', 'เจ้าหน้าที่ TRIS & RISK', NULL, NULL, NULL, '2013-08-27 10:08:41'),
(10, 'piyapong', 'OTk5OTk5', 'นายปิยะพงษ์ แก้วน่าน', NULL, NULL, NULL, '2014-03-03 12:40:30');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_user_auth`
--

DROP TABLE IF EXISTS `tbl_user_auth`;
CREATE TABLE IF NOT EXISTS `tbl_user_auth` (
  `user_id` int(11) NOT NULL,
  `group_id` tinyint(4) NOT NULL,
  PRIMARY KEY  (`group_id`,`user_id`),
  KEY `Ref831` (`group_id`),
  KEY `Ref2032` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ÊÔ·¸Ôì¼Ùéãªé§Ò¹ÃÐºº';

--
-- dump ตาราง `tbl_user_auth`
--

INSERT INTO `tbl_user_auth` (`user_id`, `group_id`) VALUES
(7, 1),
(9, 1),
(10, 1),
(2, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(7, 4),
(9, 4),
(10, 4);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_user_group`
--

DROP TABLE IF EXISTS `tbl_user_group`;
CREATE TABLE IF NOT EXISTS `tbl_user_group` (
  `group_id` tinyint(4) NOT NULL auto_increment,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÅØèÁ¼Ùéãªé§Ò¹' AUTO_INCREMENT=5 ;

--
-- dump ตาราง `tbl_user_group`
--

INSERT INTO `tbl_user_group` (`group_id`, `group_name`) VALUES
(1, 'Administrator Groups'),
(2, 'Benchmark Groups'),
(4, 'TRIS & RISK Groups');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
