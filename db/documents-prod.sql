/*
SQLyog Enterprise - MySQL GUI v8.18 
MySQL - 5.0.51b-community-nt-log : Database - documents
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`documents` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `documents`;

/*Table structure for table `tbl_configs` */

DROP TABLE IF EXISTS `tbl_configs`;

CREATE TABLE `tbl_configs` (
  `website_name` varchar(255) NOT NULL,
  `website_theme` varchar(100) default NULL,
  `website_language` varchar(2) default 'th',
  PRIMARY KEY  (`website_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Configurations Table';

/*Data for the table `tbl_configs` */

insert  into `tbl_configs`(`website_name`,`website_theme`,`website_language`) values ('DW/DM : File Uploader','0','th');

/*Table structure for table `tbl_docs_auth` */

DROP TABLE IF EXISTS `tbl_docs_auth`;

CREATE TABLE `tbl_docs_auth` (
  `group_id` tinyint(4) NOT NULL,
  `docs_cate_id` int(11) NOT NULL,
  PRIMARY KEY  (`group_id`,`docs_cate_id`),
  CONSTRAINT `FK_tbl_docs_auth` FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_docs_auth` */

insert  into `tbl_docs_auth`(`group_id`,`docs_cate_id`) values (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(2,2),(2,4),(4,6),(4,7);

/*Table structure for table `tbl_docs_category` */

DROP TABLE IF EXISTS `tbl_docs_category`;

CREATE TABLE `tbl_docs_category` (
  `docs_cate_id` int(11) NOT NULL auto_increment,
  `docs_cate_code` varchar(20) NOT NULL,
  `docs_cate_name` varchar(50) NOT NULL,
  `docs_cate_updatetime` datetime default NULL,
  PRIMARY KEY  (`docs_cate_code`),
  UNIQUE KEY `docs_cate_id` (`docs_cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Documents Category';

/*Data for the table `tbl_docs_category` */

insert  into `tbl_docs_category`(`docs_cate_id`,`docs_cate_code`,`docs_cate_name`,`docs_cate_updatetime`) values (1,'CM','CM : Customer & Marketing','2013-08-24 14:04:06'),(2,'FI','FI : Financials','2013-08-24 15:10:51'),(3,'HKR','HKR : HR KPIs Risk','2013-08-24 13:22:29'),(4,'NUA','NUA : Network Usage Analysis','2013-08-24 15:03:10'),(7,'RISK','RISK','2013-08-27 09:22:03'),(5,'TEST','TEST : Test module','2013-08-24 16:03:00'),(6,'TRIS','TRIS','2013-08-27 09:22:19');

/*Table structure for table `tbl_documents` */

DROP TABLE IF EXISTS `tbl_documents`;

CREATE TABLE `tbl_documents` (
  `docs_id` int(11) NOT NULL auto_increment,
  `docs_years` varchar(4) NOT NULL,
  `docs_filename` varchar(255) default NULL,
  `docs_desc` varchar(255) NOT NULL,
  `docs_uploadby` varchar(100) NOT NULL,
  `docs_updatetime` datetime default NULL,
  `docs_downloads` int(11) default '0',
  `docs_publish` varchar(1) NOT NULL default 'Y',
  `docs_cate_code` varchar(20) NOT NULL,
  PRIMARY KEY  (`docs_id`),
  KEY `NewIndex1` (`docs_cate_code`),
  CONSTRAINT `FK_tbl_documents` FOREIGN KEY (`docs_cate_code`) REFERENCES `tbl_docs_category` (`docs_cate_code`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Douments';

/*Data for the table `tbl_documents` */

/*Table structure for table `tbl_icons` */

DROP TABLE IF EXISTS `tbl_icons`;

CREATE TABLE `tbl_icons` (
  `icon_id` tinyint(4) NOT NULL auto_increment,
  `icon_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`icon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§äÍ¤Í¹';

/*Data for the table `tbl_icons` */

insert  into `tbl_icons`(`icon_id`,`icon_name`) values (1,'icon-home.png'),(2,'icon-config.png'),(3,'icon-keyin.gif'),(4,'icon-profile.gif'),(5,'icon-report.png'),(6,'icon-logout.png'),(7,'icon-manual.png'),(8,'icon-company.png'),(9,'icon-db.png'),(10,'icon-menu.gif'),(11,'icon-permission.png'),(12,'icon-aboutus.gif'),(13,'icon-form.png'),(14,'icon-department.png'),(15,'icon-approved.gif'),(16,'icon-group.png'),(17,'icon-process.gif'),(18,'icon-user.png'),(19,'icons-calendar.gif'),(20,'icon-printer.png'),(21,'icon-view.png'),(22,'icon-download.gif'),(23,'icon-upload.gif');

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `menu_id` tinyint(4) NOT NULL auto_increment,
  `menu_name_th` varchar(70) NOT NULL,
  `menu_name_en` varchar(70) default NULL,
  `menu_file` varchar(50) NOT NULL,
  `menu_order` tinyint(4) default NULL,
  `mgroup_id` tinyint(4) default NULL,
  `icon_id` tinyint(4) default NULL,
  PRIMARY KEY  (`menu_id`),
  KEY `Ref44105` (`icon_id`),
  KEY `Ref554` (`mgroup_id`),
  CONSTRAINT `Reftbl_icons105` FOREIGN KEY (`icon_id`) REFERENCES `tbl_icons` (`icon_id`),
  CONSTRAINT `Reftbl_menu_group54` FOREIGN KEY (`mgroup_id`) REFERENCES `tbl_menu_group` (`mgroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§àÁ¹Ù';

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`menu_id`,`menu_name_th`,`menu_name_en`,`menu_file`,`menu_order`,`mgroup_id`,`icon_id`) values (1,'จัดการเว็บไซต์','Website Management','config',1,1,2),(3,'เปลี่ยนรหัสผ่าน','Change Password','profile',1,3,4),(7,'เกี่ยวกับโปรแกรม','About Programs','about',1,8,12),(8,'รายการเอกสาร','Upload new file','docs_upload',1,4,23),(10,'ผู้ใช้งานระบบ','User Management','users',6,1,18),(11,'กลุ่มผู้ใช้งาน','User Group Management','user_group',5,1,16),(13,'กลุ่มเมนูระบบ','Menu Group Management','menu_group',2,1,10),(14,'เมนูระบบ','Menu Management','menu',3,1,10),(16,'คู่มือการใช้งาน','User Manual','manual',2,8,7),(17,'สิทธิ์เมนูใช้งาน','Menu Authorization','menu_auth',4,1,11),(18,'กลุ่มเอกสาร','Document Category','docs_category',7,1,14),(19,'สิทธิ์กลุ่มเอกสาร','Document Authorization','docs_auth',8,1,11);

/*Table structure for table `tbl_menu_auth` */

DROP TABLE IF EXISTS `tbl_menu_auth`;

CREATE TABLE `tbl_menu_auth` (
  `group_id` tinyint(4) NOT NULL,
  `menu_id` tinyint(4) NOT NULL,
  PRIMARY KEY  (`group_id`,`menu_id`),
  KEY `Ref337` (`menu_id`),
  KEY `Ref838` (`group_id`),
  CONSTRAINT `Reftbl_menu37` FOREIGN KEY (`menu_id`) REFERENCES `tbl_menu` (`menu_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_user_group38` FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`group_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ÊÔ·¸Ôì¡ÒÃà¢éÒ¶Ö§àÁ¹Ù';

/*Data for the table `tbl_menu_auth` */

insert  into `tbl_menu_auth`(`group_id`,`menu_id`) values (1,1),(1,3),(1,10),(1,11),(1,13),(1,14),(1,17),(1,18),(1,19);

/*Table structure for table `tbl_menu_group` */

DROP TABLE IF EXISTS `tbl_menu_group`;

CREATE TABLE `tbl_menu_group` (
  `mgroup_id` tinyint(4) NOT NULL auto_increment,
  `menu_group_th` varchar(50) NOT NULL,
  `menu_group_en` varchar(50) default NULL,
  `menu_path` varchar(50) NOT NULL,
  `menu_order` tinyint(4) default NULL,
  `icon_id` tinyint(4) default '3',
  PRIMARY KEY  (`mgroup_id`),
  KEY `Ref44106` (`icon_id`),
  CONSTRAINT `Reftbl_icons106` FOREIGN KEY (`icon_id`) REFERENCES `tbl_icons` (`icon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÅØèÁàÁ¹Ù';

/*Data for the table `tbl_menu_group` */

insert  into `tbl_menu_group`(`mgroup_id`,`menu_group_th`,`menu_group_en`,`menu_path`,`menu_order`,`icon_id`) values (1,'ผู้ดูแลระบบ','Administrator','Admin',1,2),(3,'ข้อมูลส่วนตัว','Profiles','Master',2,4),(4,'จัดการเอกสาร','Document Managemant','Uploads',3,23),(8,'คู่มือการใช้งาน','User Manual','Manual',7,7);

/*Table structure for table `tbl_user_auth` */

DROP TABLE IF EXISTS `tbl_user_auth`;

CREATE TABLE `tbl_user_auth` (
  `user_id` int(11) NOT NULL,
  `group_id` tinyint(4) NOT NULL,
  PRIMARY KEY  (`group_id`,`user_id`),
  KEY `Ref831` (`group_id`),
  KEY `Ref2032` (`user_id`),
  CONSTRAINT `Reftbl_users32` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Reftbl_user_group31` FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`group_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ÊÔ·¸Ôì¼Ùéãªé§Ò¹ÃÐºº';

/*Data for the table `tbl_user_auth` */

insert  into `tbl_user_auth`(`user_id`,`group_id`) values (7,1),(2,2),(7,2),(8,2),(7,4),(9,4);

/*Table structure for table `tbl_user_group` */

DROP TABLE IF EXISTS `tbl_user_group`;

CREATE TABLE `tbl_user_group` (
  `group_id` tinyint(4) NOT NULL auto_increment,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÅØèÁ¼Ùéãªé§Ò¹';

/*Data for the table `tbl_user_group` */

insert  into `tbl_user_group`(`group_id`,`group_name`) values (1,'Administrator Groups'),(2,'Benchmark Groups'),(4,'TRIS & RISK Groups');

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `telephone` varchar(20) default NULL,
  `updatetime` datetime default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¼Ùéãªé§Ò¹';

/*Data for the table `tbl_users` */

insert  into `tbl_users`(`user_id`,`username`,`password`,`first_name`,`last_name`,`email`,`telephone`,`updatetime`) values (2,'cat','MTIzNDU2','Document Upload','-','piyapong.k@cattelecom.com','-','2013-08-25 22:00:50'),(7,'admin','MTIzNDU2','Adminstrator','Administrator','piyapong.k@cattelecom.com','02-9999999','2013-08-27 09:37:26'),(8,'compare','MTIzNDU2','เจ้าหน้าที่คู่เทียบ',NULL,NULL,NULL,'2013-08-27 09:46:32'),(9,'trisrisk','MTIzNDU2','เจ้าหน้าที่ TRIS & RISK',NULL,NULL,NULL,'2013-08-27 10:08:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
