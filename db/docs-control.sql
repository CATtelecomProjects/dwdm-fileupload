/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.1.39-community : Database - docs_control
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`fileupload` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `fileupload`;

/*Table structure for table `tbl_company` */

DROP TABLE IF EXISTS `tbl_company`;

CREATE TABLE `tbl_company` (
  `company_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_telephone` varchar(30) DEFAULT NULL,
  `company_fax` varchar(30) DEFAULT NULL,
  `company_website` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¢éÍÁÙÅºÃÔÉÑ·';

/*Data for the table `tbl_company` */

insert  into `tbl_company`(company_id,company_name,company_address,company_telephone,company_fax,company_website) values (1,'Wow Inteligion Network Co,ltd.','กทม.','02-4567890','02-4567893','http://www.win.co.th'),(2,'บริษัท ทดสอบ','ที่อยู่1','02-4444444','02-4555555','http://www.kpn.co.th'),(3,'ชื่อบริษัท ','ที่อยู่ .','02-5555555','02-6666666','http://localhost/MyJobs/docs-control/'),(4,'บริษัท ก','ที่อยู่ ก.','02-3333333','02-8888888','http://www.sss.com');

/*Table structure for table `tbl_configs` */

DROP TABLE IF EXISTS `tbl_configs`;

CREATE TABLE `tbl_configs` (
  `website_name` varchar(255) NOT NULL,
  `website_theme` varchar(100) DEFAULT NULL,
  `website_language` varchar(2) DEFAULT 'th',
  PRIMARY KEY (`website_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÓË¹´¤èÒÃÐºº';

/*Data for the table `tbl_configs` */

insert  into `tbl_configs`(website_name,website_theme,website_language) values ('Web Application Document Control','3','th');

/*Table structure for table `tbl_docs_attach` */

DROP TABLE IF EXISTS `tbl_docs_attach`;

CREATE TABLE `tbl_docs_attach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `docs_id` int(11) NOT NULL,
  `file_names` varchar(100) DEFAULT NULL,
  `file_path` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Ref23176` (`docs_id`),
  CONSTRAINT `Reftbl_documents176` FOREIGN KEY (`docs_id`) REFERENCES `tbl_documents` (`docs_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§à¡çºª×èÍàÍ¡ÊÒÃá¹º';

/*Data for the table `tbl_docs_attach` */

insert  into `tbl_docs_attach`(id,docs_id,file_names,file_path) values (13,3,'jquery.autocomplete.docx','QLM/ABC/DEF'),(14,3,'KPI system Questions.doc','QLM/ABC/DEF'),(15,3,'IT Risk Management_19022010V1.xls','QLM/ABC/DEF'),(16,4,'KPI system Questions.doc','SOP/IOK/KMJ'),(17,3,'Questionare.sav','QLM/ABC/DEF'),(18,4,'KPI system Questions.doc','SOP/IOK/KMJ'),(19,4,'IT Risk Management Template.xls','SOP/IOK/KMJ'),(20,6,'jquery_documentation.pdf','QBT/SDS/CAS'),(21,6,'jQuery-Best-Practices.pdf','QBT/SDS/CAS');

/*Table structure for table `tbl_docs_distribution` */

DROP TABLE IF EXISTS `tbl_docs_distribution`;

CREATE TABLE `tbl_docs_distribution` (
  `dist_id` int(11) NOT NULL AUTO_INCREMENT,
  `objective` text,
  `copy_number` smallint(6) DEFAULT NULL,
  `location_use_store` varchar(255) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `approve_date` datetime DEFAULT NULL,
  `distribution_status` varchar(1) DEFAULT 'N',
  `docs_id` int(11) NOT NULL,
  `request_by` int(11) NOT NULL,
  `approve_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`dist_id`),
  KEY `Ref2388` (`docs_id`),
  KEY `Ref2089` (`request_by`),
  KEY `Ref2090` (`approve_by`),
  CONSTRAINT `Reftbl_documents88` FOREIGN KEY (`docs_id`) REFERENCES `tbl_documents` (`docs_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_users89` FOREIGN KEY (`request_by`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_users90` FOREIGN KEY (`approve_by`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÒÃ¢ÍÊÓà¹ÒàÍ¡ÊÒÃ';

/*Data for the table `tbl_docs_distribution` */

/*Table structure for table `tbl_docs_refers` */

DROP TABLE IF EXISTS `tbl_docs_refers`;

CREATE TABLE `tbl_docs_refers` (
  `docs_sessions` varchar(20) NOT NULL,
  `refer_docs_id` int(11) NOT NULL,
  PRIMARY KEY (`docs_sessions`,`refer_docs_id`),
  KEY `Ref2397` (`refer_docs_id`),
  KEY `Ref53170` (`docs_sessions`),
  CONSTRAINT `Reftbl_docs_sessions170` FOREIGN KEY (`docs_sessions`) REFERENCES `tbl_docs_sessions` (`docs_sessions`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_documents97` FOREIGN KEY (`refer_docs_id`) REFERENCES `tbl_documents` (`docs_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÒÃÍéÒ§ÍÔ§àÍ¡ÊÒÃÍ×è¹';

/*Data for the table `tbl_docs_refers` */

/*Table structure for table `tbl_docs_related_site` */

DROP TABLE IF EXISTS `tbl_docs_related_site`;

CREATE TABLE `tbl_docs_related_site` (
  `docs_sessions` varchar(20) NOT NULL,
  `site_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`docs_sessions`,`site_id`),
  KEY `Ref53173` (`docs_sessions`),
  KEY `Ref9116` (`site_id`),
  CONSTRAINT `Reftbl_docs_sessions173` FOREIGN KEY (`docs_sessions`) REFERENCES `tbl_docs_sessions` (`docs_sessions`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_sites116` FOREIGN KEY (`site_id`) REFERENCES `tbl_sites` (`site_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§Ë¹èÇÂ§Ò¹·Õèà¡ÕèÂÇ¢éÍ§¡ÑºàÍ¡ÊÒÃ';

/*Data for the table `tbl_docs_related_site` */

/*Table structure for table `tbl_docs_request` */

DROP TABLE IF EXISTS `tbl_docs_request`;

CREATE TABLE `tbl_docs_request` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `req_type` varchar(1) NOT NULL DEFAULT 'N',
  `docs_group_code` varchar(3) NOT NULL,
  `jobs_func_code` varchar(3) NOT NULL,
  `docs_category` varchar(1) NOT NULL DEFAULT 'I',
  `docs_code` varchar(16) DEFAULT NULL,
  `docs_code_other_sys` varchar(16) DEFAULT NULL,
  `docs_code_external` varchar(16) DEFAULT NULL,
  `docs_name` varchar(255) NOT NULL,
  `docs_requestdate` datetime NOT NULL,
  `docs_expire_day` varchar(3) DEFAULT NULL,
  `docs_expire_month` varchar(2) DEFAULT NULL,
  `docs_expire_year` varchar(4) DEFAULT NULL,
  `docs_effect_date` date DEFAULT NULL,
  `docs_objective` text,
  `docs_store_location` varchar(255) DEFAULT NULL,
  `docs_relate` varchar(255) DEFAULT NULL,
  `req_result` varchar(1) DEFAULT NULL,
  `docs_approve_ext` varchar(100) DEFAULT NULL,
  `site_efffective_ctrl` varchar(255) DEFAULT NULL,
  `docs_site` varchar(100) DEFAULT NULL,
  `site_id` tinyint(4) NOT NULL,
  `request_by` int(11) NOT NULL,
  `docs_type_code` varchar(3) NOT NULL,
  `docs_sessions` varchar(20) NOT NULL,
  PRIMARY KEY (`req_id`),
  KEY `Ref15166` (`docs_type_code`),
  KEY `Ref53168` (`docs_sessions`),
  KEY `Ref9175` (`site_id`),
  KEY `Ref20132` (`request_by`),
  CONSTRAINT `Reftbl_docs_sessions168` FOREIGN KEY (`docs_sessions`) REFERENCES `tbl_docs_sessions` (`docs_sessions`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_docs_type166` FOREIGN KEY (`docs_type_code`) REFERENCES `tbl_docs_type` (`docs_type_code`) ON UPDATE CASCADE,
  CONSTRAINT `Reftbl_sites175` FOREIGN KEY (`site_id`) REFERENCES `tbl_sites` (`site_id`),
  CONSTRAINT `Reftbl_users132` FOREIGN KEY (`request_by`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÒÃ¢ÍÊÃéÒ§/á¡éä¢àÍ¡ÊÒÃãËÁè';

/*Data for the table `tbl_docs_request` */

insert  into `tbl_docs_request`(req_id,req_type,docs_group_code,jobs_func_code,docs_category,docs_code,docs_code_other_sys,docs_code_external,docs_name,docs_requestdate,docs_expire_day,docs_expire_month,docs_expire_year,docs_effect_date,docs_objective,docs_store_location,docs_relate,req_result,docs_approve_ext,site_efffective_ctrl,docs_site,site_id,request_by,docs_type_code,docs_sessions) values (1,'N','ABC','DEF','E',NULL,'yyy-yyy-yyy-yyy','xxx-xxx-xxx-xxx','ชื่อเอกสาร 1','2010-10-15 00:03:42','1','2','3','2010-11-15','รายละเอียดที่ขอจัดทำ หรือแก้ไขโดยสังเขป',NULL,'ชื่อแบบฟอร์มที่เกี่ยวข้อง','Y','ผู้อนุมัติเอกสาร/ผู้ประกาศใช้เอกสาร(เอกสารภายนอก)','หน่วยงานที่อยู่ในขอบเขตของการบังคับเอกสาร','หน่วยงานที่ออกเอกสาร',1,6,'QLM','4cb737ee791b4'),(7,'N','LKK','FTY','E',NULL,'','','ชื่อเอกสาร 2','2010-10-16 15:17:07','7','0','0','2010-10-16','lk;l;l',NULL,'',NULL,'','','',4,7,'PLC','4cb95f83dbfd5'),(8,'N','IOK','KMJ','I',NULL,'','','Test Request Document','2010-10-16 15:24:15','0','3','0','2010-10-30','Test',NULL,'','Y','','','',4,7,'SOP','4cb9612f568f7'),(9,'N','ODK','KSD','I',NULL,'','','Test เอกสาร 2','2010-10-16 17:19:34','0','5','0','2011-06-30','ทดสอบ',NULL,'',NULL,'','','',4,7,'FRS','4cb97c3618268'),(10,'N','SDW','WSD','I',NULL,'','','ชื่อเอกสารทดสอบ','2010-10-17 10:47:41','2','1','0','2013-09-30','แก้ไขโดยสังเขป',NULL,'',NULL,'','','',3,7,'FRS','4cba71dca0ec4'),(11,'N','SDS','CAS','E',NULL,'','','Test New request Document','2010-10-17 11:24:09','3','3','1','2010-10-17','Objective',NULL,'','Y','','','',3,7,'QBT','4cba7a695fae8'),(12,'N','RTY','ERT','I',NULL,'','','test','2010-10-20 23:21:04','0','0','0','2010-10-20','test',NULL,'','Y','','','',4,7,'ANM','4cbf16f079340');

/*Table structure for table `tbl_docs_sessions` */

DROP TABLE IF EXISTS `tbl_docs_sessions`;

CREATE TABLE `tbl_docs_sessions` (
  `docs_sessions` varchar(20) NOT NULL,
  PRIMARY KEY (`docs_sessions`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§à¡çº¤èÒ Sessions ¢Í§àÍ¡ÊÒÃ';

/*Data for the table `tbl_docs_sessions` */

insert  into `tbl_docs_sessions`(docs_sessions) values ('4cb737ee791b4'),('4cb95f83dbfd5'),('4cb9612f568f7'),('4cb97c3618268'),('4cba71dca0ec4'),('4cba7a695fae8'),('4cbf16f079340');

/*Table structure for table `tbl_docs_statistics` */

DROP TABLE IF EXISTS `tbl_docs_statistics`;

CREATE TABLE `tbl_docs_statistics` (
  `stat_datetime` datetime NOT NULL,
  `stat_type` varchar(1) DEFAULT NULL,
  `stat_desc` varchar(255) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `IP` varchar(15) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`stat_datetime`),
  KEY `Ref20102` (`user_id`),
  CONSTRAINT `Reftbl_users102` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§à¡çºÊ¶ÔµÔ¡ÒÃàÃÕÂ¡ãªéàÍ¡ÊÒÃ';

/*Data for the table `tbl_docs_statistics` */

/*Table structure for table `tbl_docs_type` */

DROP TABLE IF EXISTS `tbl_docs_type`;

CREATE TABLE `tbl_docs_type` (
  `docs_type_code` varchar(3) NOT NULL,
  `docs_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`docs_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ª¹Ô´àÍ¡ÊÒÃ';

/*Data for the table `tbl_docs_type` */

insert  into `tbl_docs_type`(docs_type_code,docs_type_name) values ('ANM','Announcement'),('EXD','External Document'),('FRM','Form'),('FRS','Spacial Form'),('PLC','Policy'),('QBT','Quality Objective'),('QLM','Quality Manual'),('SOP','Standard Operating Procedure'),('WIN','Work instruction');

/*Table structure for table `tbl_documents` */

DROP TABLE IF EXISTS `tbl_documents`;

CREATE TABLE `tbl_documents` (
  `docs_id` int(11) NOT NULL AUTO_INCREMENT,
  `req_type` varchar(1) NOT NULL DEFAULT 'N',
  `docs_category` varchar(1) DEFAULT NULL,
  `docs_group_code` varchar(3) NOT NULL,
  `jobs_func_code` varchar(3) NOT NULL,
  `docs_code` varchar(20) NOT NULL,
  `docs_code_other_sys` varchar(20) DEFAULT NULL,
  `docs_code_external` varchar(20) DEFAULT NULL,
  `docs_mode` varchar(1) NOT NULL DEFAULT 'N',
  `docs_name` varchar(255) NOT NULL,
  `docs_requestdate` datetime NOT NULL,
  `docs_expire_day` varchar(2) DEFAULT NULL,
  `docs_expire_month` varchar(2) DEFAULT NULL,
  `docs_expire_year` varchar(4) DEFAULT NULL,
  `docs_effect_date` date DEFAULT NULL,
  `docs_objective` text,
  `docs_store_location` varchar(255) DEFAULT NULL,
  `docs_relate` varchar(255) DEFAULT NULL,
  `docs_status` varchar(1) NOT NULL DEFAULT 'P',
  `docs_filename` varchar(255) DEFAULT NULL,
  `docs_views` int(11) DEFAULT '0',
  `docs_downloads` int(11) DEFAULT '0',
  `docs_updatetime` datetime DEFAULT NULL,
  `docs_approve_ext` varchar(100) DEFAULT NULL,
  `site_efffective_ctrl` varchar(255) DEFAULT NULL,
  `docs_site` varchar(100) DEFAULT NULL,
  `docs_requestby` int(11) NOT NULL,
  `docs_approveby` int(11) DEFAULT NULL,
  `site_id` tinyint(4) NOT NULL,
  `req_id` int(11) NOT NULL,
  `docs_type_code` varchar(3) NOT NULL,
  `docs_sessions` varchar(20) NOT NULL,
  PRIMARY KEY (`docs_id`),
  KEY `Ref15167` (`docs_type_code`),
  KEY `Ref53172` (`docs_sessions`),
  KEY `Ref9115` (`site_id`),
  KEY `Ref20130` (`docs_approveby`),
  KEY `Ref2059` (`docs_requestby`),
  KEY `Ref52159` (`req_id`),
  CONSTRAINT `Reftbl_docs_request159` FOREIGN KEY (`req_id`) REFERENCES `tbl_docs_request` (`req_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_docs_sessions172` FOREIGN KEY (`docs_sessions`) REFERENCES `tbl_docs_sessions` (`docs_sessions`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_docs_type167` FOREIGN KEY (`docs_type_code`) REFERENCES `tbl_docs_type` (`docs_type_code`) ON UPDATE CASCADE,
  CONSTRAINT `Reftbl_sites115` FOREIGN KEY (`site_id`) REFERENCES `tbl_sites` (`site_id`),
  CONSTRAINT `Reftbl_users130` FOREIGN KEY (`docs_approveby`) REFERENCES `tbl_users` (`user_id`),
  CONSTRAINT `Reftbl_users59` FOREIGN KEY (`docs_requestby`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§àÍ¡ÊÒÃ';

/*Data for the table `tbl_documents` */

insert  into `tbl_documents`(docs_id,req_type,docs_category,docs_group_code,jobs_func_code,docs_code,docs_code_other_sys,docs_code_external,docs_mode,docs_name,docs_requestdate,docs_expire_day,docs_expire_month,docs_expire_year,docs_effect_date,docs_objective,docs_store_location,docs_relate,docs_status,docs_filename,docs_views,docs_downloads,docs_updatetime,docs_approve_ext,site_efffective_ctrl,docs_site,docs_requestby,docs_approveby,site_id,req_id,docs_type_code,docs_sessions) values (3,'N','E','ABC','DEF','QLM-ABC-DEF-001-00','yyy-yyy-yyy-yyy','xxx-xxx-xxx-xxx','N','ชื่อเอกสาร 1','2010-10-15 00:03:42','1','2','3','2010-11-15','รายละเอียดที่ขอจัดทำ หรือแก้ไขโดยสังเขป',NULL,'ชื่อแบบฟอร์มที่เกี่ยวข้อง','P',NULL,0,0,'2010-10-17 19:27:11','ผู้อนุมัติเอกสาร/ผู้ประกาศใช้เอกสาร(เอกสารภายนอก)','หน่วยงานที่อยู่ในขอบเขตของการบังคับเอกสาร','หน่วยงานที่ออกเอกสาร',6,7,1,1,'QLM','4cb737ee791b4'),(4,'N','I','IOK','KMJ','SOP-IOK-KMJ-001-00','','','N','Test Request Document','2010-10-16 15:24:15','0','3','0','2010-10-30','Test',NULL,'','N',NULL,0,0,'2010-10-17 20:06:35','','','',7,7,4,8,'SOP','4cb9612f568f7'),(5,'N','I','RTY','ERT','ANM-RTY-ERT-001-00','','','N','test','2010-10-20 23:21:04','0','0','0','2010-10-20','test',NULL,'','P',NULL,0,0,'2010-10-20 23:23:14','','','',7,7,4,12,'ANM','4cbf16f079340'),(6,'N','E','SDS','CAS','QBT-SDS-CAS-001-00','','','N','Test New request Document','2010-10-17 11:24:09','3','3','1','2010-10-17','Objective',NULL,'','N',NULL,0,0,'2010-10-25 10:36:38','','','',7,7,3,11,'QBT','4cba7a695fae8');

/*Table structure for table `tbl_icons` */

DROP TABLE IF EXISTS `tbl_icons`;

CREATE TABLE `tbl_icons` (
  `icon_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `icon_name` varchar(50) NOT NULL,
  PRIMARY KEY (`icon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§äÍ¤Í¹';

/*Data for the table `tbl_icons` */

insert  into `tbl_icons`(icon_id,icon_name) values (1,'icon-home.png'),(2,'icon-config.png'),(3,'icon-keyin.gif'),(4,'icon-profile.gif'),(5,'icon-report.png'),(6,'icon-logout.png'),(7,'icon-manual.png'),(8,'icon-company.png'),(9,'icon-db.png'),(10,'icon-menu.gif'),(11,'icon-permission.png'),(12,'icon-aboutus.gif'),(13,'icon-form.png'),(14,'icon-department.png'),(15,'icon-approved.gif'),(16,'icon-group.png'),(17,'icon-process.gif'),(18,'icon-user.png'),(19,'icons-calendar.gif'),(20,'icon-printer.png'),(21,'icon-view.png'),(22,'icon-download.gif'),(23,'icon-upload.gif');

/*Table structure for table `tbl_members` */

DROP TABLE IF EXISTS `tbl_members`;

CREATE TABLE `tbl_members` (
  `member_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `member_fname` varchar(50) NOT NULL,
  `member_lname` varchar(50) NOT NULL,
  `member_address` varchar(255) DEFAULT NULL,
  `member_telephone` varchar(20) DEFAULT NULL,
  `member_fax` varchar(20) DEFAULT NULL,
  `member_email` varchar(30) DEFAULT NULL,
  `member_company` varchar(60) DEFAULT NULL,
  `group_id` tinyint(4) DEFAULT NULL,
  `prefix_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`member_id`),
  KEY `Ref8124` (`group_id`),
  KEY `Ref21125` (`prefix_id`),
  CONSTRAINT `Reftbl_prefix125` FOREIGN KEY (`prefix_id`) REFERENCES `tbl_prefix` (`prefix_id`),
  CONSTRAINT `Reftbl_user_group124` FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ÊÁÒªÔ¡';

/*Data for the table `tbl_members` */

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `menu_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `menu_name_th` varchar(70) NOT NULL,
  `menu_name_en` varchar(70) DEFAULT NULL,
  `menu_file` varchar(50) NOT NULL,
  `menu_order` tinyint(4) DEFAULT NULL,
  `mgroup_id` tinyint(4) DEFAULT NULL,
  `icon_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `Ref44105` (`icon_id`),
  KEY `Ref554` (`mgroup_id`),
  CONSTRAINT `Reftbl_icons105` FOREIGN KEY (`icon_id`) REFERENCES `tbl_icons` (`icon_id`),
  CONSTRAINT `Reftbl_menu_group54` FOREIGN KEY (`mgroup_id`) REFERENCES `tbl_menu_group` (`mgroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§àÁ¹Ù';

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(menu_id,menu_name_th,menu_name_en,menu_file,menu_order,mgroup_id,icon_id) values (1,'ปรับแต่งระบบ','System Configurations','config',1,1,2),(3,'เปลี่ยนรหัสผ่าน','Change Password','profile',1,3,4),(4,'ข้อมูลบริษัท','Company Profile','company',2,1,8),(5,'ข้อมูลไซต์งาน','Site Management','site',3,1,8),(6,'ตำแหน่งงาน','Position Management','positions',4,1,14),(7,'เกี่ยวกับโปรแกรม','About Programs','about',1,8,12),(8,'จัดทำเอกสารใหม่','Document Request','docs_request',1,4,3),(9,'สิทธิ์กลุ่มผู้ใช้งาน','Group Authorization','group_auth',NULL,NULL,11),(10,'ผู้ใช้งานระบบ','User Management','users',6,1,18),(11,'ประเภทผู้ใช้งาน','User Group Management','user_group',5,1,16),(12,'สิทธิ์ผู้ใช้งานระบบ','User Authorization','user_auth',7,1,11),(13,'กลุ่มเมนูระบบ','Menu Group Management','menu_group',8,1,10),(14,'เมนูระบบ','Menu Management','menu',9,1,10),(15,'รายงานการเรียกดูเอกสาร','Report Document Stats','rep_docs_stats',1,7,5),(16,'คู่มือการใช้งาน','User Manual','manual',2,8,7),(17,'สิทธิ์เมนูใช้งาน','Menu Authorization','menu_auth',10,1,11),(18,'แก้ไขเอกสาร','Document Revise','docs_revise',2,4,3),(19,'ขอทำสำเนาเอกสาร','Document Distribution','docs_distribution',3,4,3),(20,'อนุมัติเอกสาร','Document Approve','approve',1,5,15),(21,'จัดทำเอกสาร','Document Control','docs_control',1,6,13),(22,'อนุมัติการสำเนาเอกสาร','Approve Distribution','approve_distribution',2,6,13),(23,'รายงานสรุปสำเนาเอกสาร','Distribution Report','rep_docs_distribution',2,7,5);

/*Table structure for table `tbl_menu_auth` */

DROP TABLE IF EXISTS `tbl_menu_auth`;

CREATE TABLE `tbl_menu_auth` (
  `group_id` tinyint(4) NOT NULL,
  `menu_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`group_id`,`menu_id`),
  KEY `Ref337` (`menu_id`),
  KEY `Ref838` (`group_id`),
  CONSTRAINT `Reftbl_menu37` FOREIGN KEY (`menu_id`) REFERENCES `tbl_menu` (`menu_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_user_group38` FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`group_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ÊÔ·¸Ôì¡ÒÃà¢éÒ¶Ö§àÁ¹Ù';

/*Data for the table `tbl_menu_auth` */

insert  into `tbl_menu_auth`(group_id,menu_id) values (1,1),(1,3),(2,3),(3,3),(4,3),(1,4),(1,5),(1,6),(1,7),(2,7),(3,7),(4,7),(1,8),(2,8),(1,10),(1,11),(1,13),(1,14),(1,15),(2,15),(3,15),(1,16),(2,16),(3,16),(4,16),(1,17),(1,18),(2,18),(1,19),(2,19),(1,20),(3,20),(1,21),(4,21),(1,22),(4,22),(1,23),(2,23),(3,23);

/*Table structure for table `tbl_menu_group` */

DROP TABLE IF EXISTS `tbl_menu_group`;

CREATE TABLE `tbl_menu_group` (
  `mgroup_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `menu_group_th` varchar(50) NOT NULL,
  `menu_group_en` varchar(50) DEFAULT NULL,
  `menu_path` varchar(50) NOT NULL,
  `menu_order` tinyint(4) DEFAULT NULL,
  `icon_id` tinyint(4) DEFAULT '3',
  PRIMARY KEY (`mgroup_id`),
  KEY `Ref44106` (`icon_id`),
  CONSTRAINT `Reftbl_icons106` FOREIGN KEY (`icon_id`) REFERENCES `tbl_icons` (`icon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÅØèÁàÁ¹Ù';

/*Data for the table `tbl_menu_group` */

insert  into `tbl_menu_group`(mgroup_id,menu_group_th,menu_group_en,menu_path,menu_order,icon_id) values (1,'ผู้ดูแลระบบ','Administrator','Admin',1,2),(3,'ข้อมูลส่วนตัว','Profiles','Master',2,4),(4,'จัดทำ/แก้ไขเอกสาร','Document Request','Request',3,3),(5,'อนุมัติเอกสาร','Document Approve','Approve',4,15),(6,'ควบคุมเอกสาร','Document Control','Docs',5,13),(7,'รายงาน','Reports','Reports',6,5),(8,'คู่มือการใช้งาน','User Manual','Manual',7,7);

/*Table structure for table `tbl_positions` */

DROP TABLE IF EXISTS `tbl_positions`;

CREATE TABLE `tbl_positions` (
  `position_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) NOT NULL,
  `position_name_short` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§µÓáË¹è§§Ò¹';

/*Data for the table `tbl_positions` */

insert  into `tbl_positions`(position_id,position_name,position_name_short) values (1,'Manager','MTP'),(2,'General Manager','GM'),(3,'Director','DI'),(4,'ชื่อตำแหน่งงาน ','TEST');

/*Table structure for table `tbl_prefix` */

DROP TABLE IF EXISTS `tbl_prefix`;

CREATE TABLE `tbl_prefix` (
  `prefix_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `prefix_name` varchar(15) NOT NULL,
  PRIMARY KEY (`prefix_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¤Ó¹ÓË¹éÒª×èÍ';

/*Data for the table `tbl_prefix` */

insert  into `tbl_prefix`(prefix_id,prefix_name) values (1,'นาย'),(2,'นางสาว'),(3,'นาง');

/*Table structure for table `tbl_relate_docs_emai` */

DROP TABLE IF EXISTS `tbl_relate_docs_emai`;

CREATE TABLE `tbl_relate_docs_emai` (
  `docs_sessions` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`docs_sessions`,`email`),
  KEY `Ref53169` (`docs_sessions`),
  CONSTRAINT `Reftbl_docs_sessions169` FOREIGN KEY (`docs_sessions`) REFERENCES `tbl_docs_sessions` (`docs_sessions`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§à¡çºÍÕàÁÅìà¾ÔèÁàµÔÁ·Õèà¡ÕèÂÇ¢éÍ§¡ÑºàÍ¡ÊÒÃ';

/*Data for the table `tbl_relate_docs_emai` */

/*Table structure for table `tbl_sites` */

DROP TABLE IF EXISTS `tbl_sites`;

CREATE TABLE `tbl_sites` (
  `site_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `site_name_short` varchar(12) DEFAULT NULL,
  `site_address` varchar(255) DEFAULT NULL,
  `site_telephone` varchar(20) DEFAULT NULL,
  `company_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`site_id`),
  KEY `Ref1103` (`company_id`),
  CONSTRAINT `Reftbl_company103` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`company_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ä«µì§Ò¹';

/*Data for the table `tbl_sites` */

insert  into `tbl_sites`(site_id,site_name,site_name_short,site_address,site_telephone,company_id) values (1,'มาบตาพุด','MTP','ระยอง','0818987456',1),(2,'ระยอง','RYG','ระยอง','0875643521',1),(3,'แหลมฉบัง','LCB','จ.ชลบุรี','038-6433456',3),(4,'กทม.','BKK','สีลม กทม.','02-4567890',1);

/*Table structure for table `tbl_supervisor` */

DROP TABLE IF EXISTS `tbl_supervisor`;

CREATE TABLE `tbl_supervisor` (
  `site_id` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`site_id`),
  KEY `Ref20128` (`user_id`),
  KEY `Ref9127` (`site_id`),
  CONSTRAINT `Reftbl_sites127` FOREIGN KEY (`site_id`) REFERENCES `tbl_sites` (`site_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_users128` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ËÑÇË¹éÒáµèÅÐä«µì§Ò¹';

/*Data for the table `tbl_supervisor` */

/*Table structure for table `tbl_user_auth` */

DROP TABLE IF EXISTS `tbl_user_auth`;

CREATE TABLE `tbl_user_auth` (
  `group_id` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `Ref831` (`group_id`),
  KEY `Ref2032` (`user_id`),
  CONSTRAINT `Reftbl_users32` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_user_group31` FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`group_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§ÊÔ·¸Ôì¼Ùéãªé§Ò¹ÃÐºº';

/*Data for the table `tbl_user_auth` */

insert  into `tbl_user_auth`(group_id,user_id) values (1,1),(1,7),(2,1),(2,2),(2,7),(3,1),(3,3),(3,7),(4,1),(4,5),(4,6),(4,7);

/*Table structure for table `tbl_user_group` */

DROP TABLE IF EXISTS `tbl_user_group`;

CREATE TABLE `tbl_user_group` (
  `group_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÅØèÁ¼Ùéãªé§Ò¹';

/*Data for the table `tbl_user_group` */

insert  into `tbl_user_group`(group_id,group_name) values (1,'Admin'),(2,'Document Controllers'),(3,'Approver'),(4,'Users/Requester');

/*Table structure for table `tbl_user_on_site` */

DROP TABLE IF EXISTS `tbl_user_on_site`;

CREATE TABLE `tbl_user_on_site` (
  `user_id` int(11) NOT NULL,
  `site_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`,`site_id`),
  KEY `Ref9114` (`site_id`),
  KEY `Ref2061` (`user_id`),
  CONSTRAINT `Reftbl_sites114` FOREIGN KEY (`site_id`) REFERENCES `tbl_sites` (`site_id`) ON DELETE CASCADE,
  CONSTRAINT `Reftbl_users61` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¡ÒÃÊÑ§¡Ñ´ä«µì§Ò¹¢Í§¼Ùéãªé§Ò¹';

/*Data for the table `tbl_user_on_site` */

insert  into `tbl_user_on_site`(user_id,site_id) values (1,1),(2,1),(7,1),(1,2),(2,2),(3,2),(7,2),(1,3),(2,3),(3,3),(7,3),(1,4),(2,4),(3,4),(7,4);

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `passwords` varchar(50) NOT NULL,
  `emp_code` varchar(10) NOT NULL DEFAULT '999999',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL DEFAULT 'M',
  `telephone` varchar(20) DEFAULT NULL,
  `prefix_id` tinyint(4) NOT NULL,
  `position_id` tinyint(4) DEFAULT NULL,
  `site_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `Ref2125` (`prefix_id`),
  KEY `Ref9174` (`site_id`),
  KEY `Ref1419` (`position_id`),
  CONSTRAINT `Reftbl_positions19` FOREIGN KEY (`position_id`) REFERENCES `tbl_positions` (`position_id`),
  CONSTRAINT `Reftbl_prefix25` FOREIGN KEY (`prefix_id`) REFERENCES `tbl_prefix` (`prefix_id`),
  CONSTRAINT `Reftbl_sites174` FOREIGN KEY (`site_id`) REFERENCES `tbl_sites` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='µÒÃÒ§¼Ùéãªé§Ò¹';

/*Data for the table `tbl_users` */

insert  into `tbl_users`(user_id,username,passwords,emp_code,first_name,last_name,email,gender,telephone,prefix_id,position_id,site_id) values (1,'piyapong','MTIzNDU2','999999','ปิยะพงษ์','แก้วน่าน','piyapong@docs.co.th','M','086-4416151',1,4,4),(2,'docs','MTIzNDU2','123456','Document Control','-','docs@docs.co.th','M','-',1,2,4),(3,'approve','MTIzNDU2','654321','Approver','-','approve@docs.co.th','F','-',2,3,1),(5,'user2','MTIzNDU2','12345678','User 2','ทดสอบ','user2@docs.co.th','F','085-3333333',3,2,4),(6,'user1','MTIzNDU2','123456789','User 1','test 22 ','user1@docs.co.th','M','087-9876654',2,2,1),(7,'admin','MTIzNDU2','987654','ผู้ดูแลระบบ','Administrator','admin@docs.co.th','M','02-9999999',1,3,4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
