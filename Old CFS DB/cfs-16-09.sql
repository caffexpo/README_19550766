/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : cfs

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-09-16 14:17:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_advance_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_advance_feedback`;
CREATE TABLE `tbl_advance_feedback` (
  `adv_feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_cat_id` varchar(20) DEFAULT '' COMMENT 'very good 1,good 2,poor 3, bad 4',
  `event_id` int(11) DEFAULT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `e_created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`adv_feedback_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_advance_feedback
-- ----------------------------
INSERT INTO `tbl_advance_feedback` VALUES ('3', '1', '1', '1', '2022-09-07 07:24:58');
INSERT INTO `tbl_advance_feedback` VALUES ('4', '1', '1', '2', '2022-09-07 07:27:04');
INSERT INTO `tbl_advance_feedback` VALUES ('5', '3', '1', '6', '2022-09-07 07:24:58');
INSERT INTO `tbl_advance_feedback` VALUES ('6', '2', '2', '3', '2022-09-07 07:27:04');
INSERT INTO `tbl_advance_feedback` VALUES ('7', '4', '2', '4', null);

-- ----------------------------
-- Table structure for `tbl_beneficiaries`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_beneficiaries`;
CREATE TABLE `tbl_beneficiaries` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_name` varchar(100) DEFAULT NULL,
  `c_address` varchar(100) DEFAULT NULL,
  `c_contact` varchar(12) DEFAULT NULL,
  `gn_division` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `r_username` varchar(30) DEFAULT NULL,
  `r_password` varchar(60) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `active_stts` int(11) DEFAULT NULL COMMENT 'if 0 inactive,if 1 active',
  `org_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_beneficiaries
-- ----------------------------
INSERT INTO `tbl_beneficiaries` VALUES ('1', 'sdfsdf', 'dsfsd', '3424324', 'anuradhapura', null, 'admin', '700c8b805a3e2a265b01c77614cd8b21', null, '1', null);
INSERT INTO `tbl_beneficiaries` VALUES ('2', 'xcvxc', 'cxvxvx', '4123123312', 'katharagama', '2022-08-09', 'admin2', '1234', '1', '1', '1');
INSERT INTO `tbl_beneficiaries` VALUES ('3', 'kkjjjj', 'cxvxvx', '15588988882', 'katharagama', '2022-09-05', 'U13', '12345', '1', '1', '1');
INSERT INTO `tbl_beneficiaries` VALUES ('4', 'fdgdfgfd', 'cxvxvxb dfsf sdfsdfsd', '432432424', 'hambannthota', '2022-08-31', 'U14', 'grbr', '1', '1', '1');

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
  `compln_cat_id` int(11) DEFAULT NULL COMMENT 'after getig complai,super level users need to allocate it',
  `child_name` varchar(60) DEFAULT NULL,
  `ds_division` varchar(30) DEFAULT NULL,
  `complain_date` date DEFAULT NULL,
  `complain_close_cmmnt` varchar(150) DEFAULT NULL,
  `complain_close_date` date DEFAULT NULL,
  `complain_stts` int(11) DEFAULT NULL COMMENT 'if 1 active,if 2 complete',
  `complain` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`compln_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_complain
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_complain_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_complain_category`;
CREATE TABLE `tbl_complain_category` (
  `compln_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `complain_category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`compln_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_complain_category
-- ----------------------------
INSERT INTO `tbl_complain_category` VALUES ('1', 'Child safe guarding');
INSERT INTO `tbl_complain_category` VALUES ('2', 'Curruptions');

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
  `donor_stts` int(11) DEFAULT NULL COMMENT 'if 1 active ,if 2 inactive',
  PRIMARY KEY (`donor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_donor
-- ----------------------------
INSERT INTO `tbl_donor` VALUES ('1', 'Mr sahan', '.', '0', null, '1');
INSERT INTO `tbl_donor` VALUES ('2', 'Mrs samitha perera', '.', '0', null, '0');
INSERT INTO `tbl_donor` VALUES ('3', 'MR Prabath', '.', '0', null, '1');
INSERT INTO `tbl_donor` VALUES ('4', 'xxxxx', 'asdasd cxvdfadf cvfd', '231200000', 'dasasd@gg.ll', '1');

-- ----------------------------
-- Table structure for `tbl_donor_stages`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_donor_stages`;
CREATE TABLE `tbl_donor_stages` (
  `donor_stage_id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_id` int(11) DEFAULT NULL,
  `financial_year` int(11) DEFAULT NULL,
  `donor_stage` varchar(20) DEFAULT NULL,
  `year_donation` double DEFAULT NULL,
  PRIMARY KEY (`donor_stage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_donor_stages
-- ----------------------------
INSERT INTO `tbl_donor_stages` VALUES ('1', '2', '2022', 'Platinum', '1060000');
INSERT INTO `tbl_donor_stages` VALUES ('2', '1', '2022', 'Silver', '410000');
INSERT INTO `tbl_donor_stages` VALUES ('3', '2', '2023', 'Silver', '450000');

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
  `active_stts` int(11) DEFAULT NULL COMMENT 'if 1 active,if 0 inactive',
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_employee
-- ----------------------------
INSERT INTO `tbl_employee` VALUES ('1', '1', 'kaushal', '.homagama', '0772565385', '.', '1');
INSERT INTO `tbl_employee` VALUES ('2', '2', 'Terance', null, null, null, '1');
INSERT INTO `tbl_employee` VALUES ('3', '1', 'sister kalyani', '.', '0', '.', '1');
INSERT INTO `tbl_employee` VALUES ('4', '2', 'saman fernando', 'kolonnawa', '0112456789', '.', '1');

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
  `event_date` date DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_event
-- ----------------------------
INSERT INTO `tbl_event` VALUES ('1', '1', 'sdfsdfs', 'dsfdsf', '20', '2022', '9', null, '1', '2022-07-19');
INSERT INTO `tbl_event` VALUES ('2', '1', 'vvcxvcxv', 'fdsfdsf', '10', '2022', '5', null, '1', '2022-07-19');
INSERT INTO `tbl_event` VALUES ('3', '1', 'xczc', 'zxccxzc', '2', '2021', '3', null, '1', '2022-07-06');
INSERT INTO `tbl_event` VALUES ('4', '1', 'xczc', 'zxccxzc', '2', '2021', '3', '1000', '1', '2022-07-06');
INSERT INTO `tbl_event` VALUES ('5', '3', 'fasfasd', 'asddasd', '12', '2021', '4', '4000', '1', '2022-07-07');

-- ----------------------------
-- Table structure for `tbl_event_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_event_category`;
CREATE TABLE `tbl_event_category` (
  `event_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_cat_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`event_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_event_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_gn_division`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gn_division`;
CREATE TABLE `tbl_gn_division` (
  `gn_div_id` int(11) NOT NULL AUTO_INCREMENT,
  `gn_division` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`gn_div_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_gn_division
-- ----------------------------
INSERT INTO `tbl_gn_division` VALUES ('1', 'katharagama');
INSERT INTO `tbl_gn_division` VALUES ('2', 'hambannthota');

-- ----------------------------
-- Table structure for `tbl_location`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_location`;
CREATE TABLE `tbl_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_location
-- ----------------------------
INSERT INTO `tbl_location` VALUES ('1', 'hambanthota');
INSERT INTO `tbl_location` VALUES ('2', 'anuradhapura');
INSERT INTO `tbl_location` VALUES ('3', 'kilinochchi');

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
  `active_stts` int(11) DEFAULT NULL COMMENT 'if 1 active,if 0 inactive',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_login
-- ----------------------------
INSERT INTO `tbl_login` VALUES ('1', '1', '1', '1', 'admin', '700c8b805a3e2a265b01c77614cd8b21', '1');
INSERT INTO `tbl_login` VALUES ('2', '3', '2', '2', 'tera', '700c8b805a3e2a265b01c77614cd8b21', '1');

-- ----------------------------
-- Table structure for `tbl_open_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_open_feedback`;
CREATE TABLE `tbl_open_feedback` (
  `open_feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback` varchar(500) DEFAULT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `ofb_created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`open_feedback_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_open_feedback
-- ----------------------------
INSERT INTO `tbl_open_feedback` VALUES ('1', 'ds sffsdf ffsdfs fdfsdf dffsdfd asfsdf fafsdf dsadasd', '1', '2022-09-14 12:48:24');
INSERT INTO `tbl_open_feedback` VALUES ('2', 'sdds sdff fewf grewo rwe opegkegko rore oergr- ergegp dfbego kgkrwfw egwoo fwfwfp gfweofwo', '2', '2022-09-14 12:48:50');

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
INSERT INTO `tbl_organization` VALUES ('1', 'ChildFund Sri lanka', '123', 'abcd', '0', '1', '1');
INSERT INTO `tbl_organization` VALUES ('2', 'test org', '312313', '1/12, habarakada', '0222556666', '2', '1');

-- ----------------------------
-- Table structure for `tbl_pages`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pages`;
CREATE TABLE `tbl_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) DEFAULT NULL,
  `page_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_pages
-- ----------------------------
INSERT INTO `tbl_pages` VALUES ('1', 'Create Organization', '10');
INSERT INTO `tbl_pages` VALUES ('2', 'View Organizations', '11');
INSERT INTO `tbl_pages` VALUES ('3', 'Create Employee', '12');
INSERT INTO `tbl_pages` VALUES ('4', 'View Employee', '13');
INSERT INTO `tbl_pages` VALUES ('5', 'Create Projects', '14');
INSERT INTO `tbl_pages` VALUES ('6', 'Approve/Disapprove Project', '15');
INSERT INTO `tbl_pages` VALUES ('7', 'View Projects', '16');
INSERT INTO `tbl_pages` VALUES ('8', 'User Privilages', '17');
INSERT INTO `tbl_pages` VALUES ('9', 'Login Manage', '18');
INSERT INTO `tbl_pages` VALUES ('10', 'Create Event', '19');
INSERT INTO `tbl_pages` VALUES ('11', 'View Event', '20');
INSERT INTO `tbl_pages` VALUES ('12', 'Approve/Disapprove  Events', '21');
INSERT INTO `tbl_pages` VALUES ('13', 'Donor Creation', '22');
INSERT INTO `tbl_pages` VALUES ('14', 'View Donor', '23');
INSERT INTO `tbl_pages` VALUES ('16', 'Beneficiary create', '24');
INSERT INTO `tbl_pages` VALUES ('17', 'View Benificiary', '25');
INSERT INTO `tbl_pages` VALUES ('18', 'Advance Feedbacks', '26');
INSERT INTO `tbl_pages` VALUES ('19', 'General Feedbacks', '27');

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
  `balance_budget` double DEFAULT NULL,
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_project
-- ----------------------------
INSERT INTO `tbl_project` VALUES ('1', 'Disaster risk reduction project', '1', 'la bla bla', '2022-03-01', '2022-03-03', '2022-12-28', '1500000', '1500', '1', '1', '1499000');
INSERT INTO `tbl_project` VALUES ('2', 'test project 1', '1', 'dsffdsfsd', '2022-07-01', '2022-07-06', '2022-07-31', '250000', '20', '1', '3', '250000');
INSERT INTO `tbl_project` VALUES ('3', 'test proj 2', '2', 'cxvvv', '2022-07-01', '2022-07-06', '2022-07-31', '30000', '10', '1', '1', '26000');
INSERT INTO `tbl_project` VALUES ('4', 'foods chile care', '2', 'sdfdsfsdfdsfs', '2022-07-21', '2022-07-20', '2022-07-31', '200000', '20', '1', '1', '200000');
INSERT INTO `tbl_project` VALUES ('5', 'simple project', '2', 'fdvsdfsdfdsf', '2022-07-18', '2022-07-19', '2022-07-31', '25600', '50', '1', '1', '25600');
INSERT INTO `tbl_project` VALUES ('6', 'test progecfcsd', '1', 'sfdsfsdfsdfsdf', '2022-08-10', '2022-08-10', '2022-11-24', '520000', '50', '2', '1', '520000');
INSERT INTO `tbl_project` VALUES ('7', 'dgdfgfd dsdasda', '1', 'xcvxzzxc sdfcds sdasdsad dsasdasd', '2022-08-23', '2022-08-23', '2022-08-31', '540000', '20', '2', '1', '540000');
INSERT INTO `tbl_project` VALUES ('8', 'cxvzxcczczc', '1', 'sdfdsfdsfd', '2022-08-11', '2022-08-09', '2022-08-29', '410000', '20', '1', '1', '410000');
INSERT INTO `tbl_project` VALUES ('9', 'sdf sddasdas', '1', 'sdfdsfdsf', '2022-08-17', '2022-08-31', '2022-08-30', '450000', '20', '2', '1', '450000');

-- ----------------------------
-- Table structure for `tbl_title`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_title`;
CREATE TABLE `tbl_title` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_title
-- ----------------------------
INSERT INTO `tbl_title` VALUES ('1', 'Mr');
INSERT INTO `tbl_title` VALUES ('2', 'Mrs');
INSERT INTO `tbl_title` VALUES ('3', 'Child');

-- ----------------------------
-- Table structure for `tbl_user_privilage`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_privilage`;
CREATE TABLE `tbl_user_privilage` (
  `user_priv_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_priv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_user_privilage
-- ----------------------------
INSERT INTO `tbl_user_privilage` VALUES ('36', '2', '10', null);
INSERT INTO `tbl_user_privilage` VALUES ('37', '2', '11', null);
INSERT INTO `tbl_user_privilage` VALUES ('93', '3', '12', null);
INSERT INTO `tbl_user_privilage` VALUES ('94', '3', '13', null);
INSERT INTO `tbl_user_privilage` VALUES ('95', '3', '14', null);
INSERT INTO `tbl_user_privilage` VALUES ('96', '3', '16', null);
INSERT INTO `tbl_user_privilage` VALUES ('97', '3', '19', null);
INSERT INTO `tbl_user_privilage` VALUES ('98', '3', '20', null);
INSERT INTO `tbl_user_privilage` VALUES ('99', '3', '21', null);
INSERT INTO `tbl_user_privilage` VALUES ('100', '3', '24', null);
INSERT INTO `tbl_user_privilage` VALUES ('101', '3', '25', null);
INSERT INTO `tbl_user_privilage` VALUES ('102', '1', '10', null);
INSERT INTO `tbl_user_privilage` VALUES ('103', '1', '11', null);
INSERT INTO `tbl_user_privilage` VALUES ('104', '1', '12', null);
INSERT INTO `tbl_user_privilage` VALUES ('105', '1', '13', null);
INSERT INTO `tbl_user_privilage` VALUES ('106', '1', '14', null);
INSERT INTO `tbl_user_privilage` VALUES ('107', '1', '15', null);
INSERT INTO `tbl_user_privilage` VALUES ('108', '1', '16', null);
INSERT INTO `tbl_user_privilage` VALUES ('109', '1', '17', null);
INSERT INTO `tbl_user_privilage` VALUES ('110', '1', '18', null);
INSERT INTO `tbl_user_privilage` VALUES ('111', '1', '19', null);
INSERT INTO `tbl_user_privilage` VALUES ('112', '1', '20', null);
INSERT INTO `tbl_user_privilage` VALUES ('113', '1', '21', null);
INSERT INTO `tbl_user_privilage` VALUES ('114', '1', '22', null);
INSERT INTO `tbl_user_privilage` VALUES ('115', '1', '23', null);
INSERT INTO `tbl_user_privilage` VALUES ('116', '1', '24', null);
INSERT INTO `tbl_user_privilage` VALUES ('117', '1', '25', null);
INSERT INTO `tbl_user_privilage` VALUES ('118', '1', '26', null);
INSERT INTO `tbl_user_privilage` VALUES ('119', '1', '27', null);

-- ----------------------------
-- Table structure for `tbl_user_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_type`;
CREATE TABLE `tbl_user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_type
-- ----------------------------
INSERT INTO `tbl_user_type` VALUES ('1', 'main org super admin');
INSERT INTO `tbl_user_type` VALUES ('2', 'main org user');
INSERT INTO `tbl_user_type` VALUES ('3', 'sub org admin');
INSERT INTO `tbl_user_type` VALUES ('4', 'sub org user');
