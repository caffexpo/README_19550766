/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : cps

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-06-27 08:54:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_advance_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_advance_feedback`;
CREATE TABLE `tbl_advance_feedback` (
  `adv_feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_cat_id` varchar(20) DEFAULT NULL COMMENT 'very good,good,normal etc',
  `event_id` int(11) DEFAULT NULL,
  `registration_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`adv_feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_advance_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_child_event`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_child_event`;
CREATE TABLE `tbl_child_event` (
  `child_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`child_event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_child_event
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_complain`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_complain`;
CREATE TABLE `tbl_complain` (
  `compln_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) DEFAULT NULL,
  `compln_cat_id` int(11) DEFAULT NULL,
  `child_name` varchar(60) DEFAULT NULL,
  `ds_division` varchar(30) DEFAULT NULL,
  `complain_date` date DEFAULT NULL,
  `complain_close_cmmnt` varchar(150) DEFAULT NULL,
  `complain_close_date` date DEFAULT NULL,
  `complain_stts` int(11) DEFAULT NULL COMMENT 'if 1 active,if 2 complete',
  PRIMARY KEY (`compln_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_complain
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_complain_caategory`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_complain_caategory`;
CREATE TABLE `tbl_complain_caategory` (
  `compln_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `complain_category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`compln_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_complain_caategory
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_complain_followpu`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_complain_followpu`;
CREATE TABLE `tbl_complain_followpu` (
  `compln_flwup_id` int(11) NOT NULL AUTO_INCREMENT,
  `complain_id` int(11) DEFAULT NULL,
  `followup` varchar(150) DEFAULT NULL,
  `folllowup_date` date DEFAULT NULL,
  PRIMARY KEY (`compln_flwup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_complain_followpu
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_donor`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_donor`;
CREATE TABLE `tbl_donor` (
  `donor_id` int(11) NOT NULL AUTO_INCREMENT,
  `donor` varchar(60) DEFAULT NULL,
  `d_address` varchar(100) DEFAULT NULL,
  `d_contact` varchar(12) DEFAULT NULL,
  `d_mail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`donor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_donor
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_employee`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_employee`;
CREATE TABLE `tbl_employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) DEFAULT NULL,
  `emp_name` varchar(100) DEFAULT NULL,
  `emp_address` varchar(150) DEFAULT NULL,
  `emp_contact` varchar(12) DEFAULT NULL,
  `emp_mail` varchar(100) DEFAULT NULL,
  `active_stts` int(11) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_employee
-- ----------------------------
INSERT INTO `tbl_employee` VALUES ('1', '1', 'kaushal', '.', '0', '.', '1');

-- ----------------------------
-- Table structure for `tbl_event`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_event`;
CREATE TABLE `tbl_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) DEFAULT NULL,
  `event_title` varchar(60) DEFAULT NULL,
  `location` varchar(60) DEFAULT NULL,
  `benifitiaries` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `event_budget` double DEFAULT NULL,
  `event_stts` int(11) DEFAULT NULL COMMENT 'if 0 pending ,if 1 active and ongoing,if 2 complete,if 3 disapprove',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_event
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_login`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_login`;
CREATE TABLE `tbl_login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `org_username` varchar(50) DEFAULT NULL,
  `org_password` varchar(50) DEFAULT NULL,
  `active_stts` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_login
-- ----------------------------
INSERT INTO `tbl_login` VALUES ('1', '1', '1', '1', 'admin', '700c8b805a3e2a265b01c77614cd8b21', '1');

-- ----------------------------
-- Table structure for `tbl_open_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_open_feedback`;
CREATE TABLE `tbl_open_feedback` (
  `open_feedback_id` int(11) DEFAULT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  `registration_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_open_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_organization`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_organization`;
CREATE TABLE `tbl_organization` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(50) DEFAULT NULL,
  `reg_no` varchar(60) DEFAULT NULL,
  `org_address` varchar(200) DEFAULT NULL,
  `org_contact` varchar(12) DEFAULT NULL,
  `org_type` int(11) DEFAULT NULL COMMENT 'if 1 main org,if 2 sub org',
  `org_stts` int(11) DEFAULT NULL COMMENT 'if 1 active,if 2 inactive',
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_organization
-- ----------------------------
INSERT INTO `tbl_organization` VALUES ('1', 'ChildFund Sri lanka', '123', '.', '0', '1', '1');
INSERT INTO `tbl_organization` VALUES ('2', 'test org', '312313', '1/12, habarakada', '0222556666', '2', '1');

-- ----------------------------
-- Table structure for `tbl_project`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_project`;
CREATE TABLE `tbl_project` (
  `proj_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(120) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `proj_desc` varchar(1000) DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `prj_from` date DEFAULT NULL,
  `prj_to` date DEFAULT NULL,
  `proj_budget` double DEFAULT NULL,
  `num_of_benefitiories` int(11) DEFAULT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `proj_stts` int(11) DEFAULT NULL COMMENT 'if 0 pending,if 1 active and ongoing,if 2 completed,if 3 disapprove',
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_project
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_registration`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_registration`;
CREATE TABLE `tbl_registration` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_name` varchar(100) DEFAULT NULL,
  `c_address` varchar(100) DEFAULT NULL,
  `c_contact` varchar(12) DEFAULT NULL,
  `gn_division` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `r_username` varchar(30) DEFAULT NULL,
  `r_password` varchar(60) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_registration
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_title`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_title`;
CREATE TABLE `tbl_title` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_title
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_user_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_type`;
CREATE TABLE `tbl_user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_type
-- ----------------------------
INSERT INTO `tbl_user_type` VALUES ('1', 'super admin');
