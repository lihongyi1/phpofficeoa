/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.6.4-m7-log : Database - officeoa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`officeoa` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `officeoa`;

/*Table structure for table `oa_attach` */

DROP TABLE IF EXISTS `oa_attach`;

CREATE TABLE `oa_attach` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `attachname` varchar(255) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `content` mediumtext,
  `savename` varchar(255) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `path` mediumtext,
  `ctime` datetime DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `click` int(11) DEFAULT '0',
  `isdel` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_dept` */

DROP TABLE IF EXISTS `oa_dept`;

CREATE TABLE `oa_dept` (
  `deptid` int(11) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(255) NOT NULL,
  `deptnum` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`deptid`),
  UNIQUE KEY `deptname` (`deptname`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_enotice` */

DROP TABLE IF EXISTS `oa_enotice`;

CREATE TABLE `oa_enotice` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `click` int(11) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0' COMMENT '1:电子公文 2：内部通知 3：公文通知',
  `isdelete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_event` */

DROP TABLE IF EXISTS `oa_event`;

CREATE TABLE `oa_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` mediumtext NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `allDay` tinyint(1) DEFAULT '1',
  `isdelete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_flow_apply` */

DROP TABLE IF EXISTS `oa_flow_apply`;

CREATE TABLE `oa_flow_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `atitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `step` tinyint(1) DEFAULT '0',
  `spids` mediumtext,
  `status` tinyint(1) DEFAULT '0',
  `laststatus` tinyint(1) DEFAULT '0',
  `atime` datetime DEFAULT NULL,
  `utime` datetime DEFAULT NULL,
  `isdel` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_flow_reply` */

DROP TABLE IF EXISTS `oa_flow_reply`;

CREATE TABLE `oa_flow_reply` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `spid` int(11) NOT NULL,
  `content` mediumtext,
  `step` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `stime` datetime DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_flow_template` */

DROP TABLE IF EXISTS `oa_flow_template`;

CREATE TABLE `oa_flow_template` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `descb` mediumtext,
  `content` mediumtext,
  `fqids` varchar(255) NOT NULL,
  `spids` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `isdel` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_info` */

DROP TABLE IF EXISTS `oa_info`;

CREATE TABLE `oa_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `fromid` int(11) NOT NULL,
  `toid` int(11) NOT NULL,
  `replyid` int(11) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `isread` tinyint(1) DEFAULT '0',
  `isnew` tinyint(1) DEFAULT '1',
  `isdelete` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_position` */

DROP TABLE IF EXISTS `oa_position`;

CREATE TABLE `oa_position` (
  `positionid` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `deptid` int(11) DEFAULT NULL,
  `positionnum` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`positionid`),
  UNIQUE KEY `NewIndex1` (`positionid`,`deptid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_test` */

DROP TABLE IF EXISTS `oa_test`;

CREATE TABLE `oa_test` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `td` varchar(10) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_theme` */

DROP TABLE IF EXISTS `oa_theme`;

CREATE TABLE `oa_theme` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `theme` tinyint(1) unsigned zerofill DEFAULT NULL,
  `width` tinyint(1) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`tid`),
  UNIQUE KEY `userid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `oa_user` */

DROP TABLE IF EXISTS `oa_user`;

CREATE TABLE `oa_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `passwd` varchar(32) NOT NULL,
  `sex` tinyint(1) DEFAULT '0',
  `deptid` int(11) DEFAULT '0',
  `positionid` int(11) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL COMMENT '权限',
  `grade` tinyint(1) DEFAULT NULL,
  `role` tinyint(1) DEFAULT '0' COMMENT '角色',
  `entertime` datetime DEFAULT NULL COMMENT '入职时间',
  `isdelete` tinyint(1) DEFAULT '0' COMMENT '删除',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
