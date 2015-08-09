/*
Navicat MySQL Data Transfer

Source Server         : DEV
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : biotech

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2015-06-23 23:29:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_batch`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_batch`;
CREATE TABLE `tbl_batch` (
  `BATCH_ID` varchar(6) NOT NULL,
  `BATCH_CODE` varchar(50) NOT NULL,
  `BATCH_NAME` varchar(250) NOT NULL,
  `PRODUCT_ID` varchar(6) NOT NULL,
  `BATCH_QUANTITY` decimal(10,2) NOT NULL,
  `BATCH_REMARK` varchar(1500) DEFAULT NULL,
  `BATCH_STATUS` varchar(1) NOT NULL,
  `BATCH_MODE` varchar(1) NOT NULL,
  `BATCH_CREATE_DATE` datetime NOT NULL,
  `BATCH_CREATE_BY` varchar(150) NOT NULL,
  PRIMARY KEY (`BATCH_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_batch
-- ----------------------------
INSERT INTO `tbl_batch` VALUES ('BCH002', 'DFG3235556', 'test', 'PRO002', '1500.00', '1', 'A', 'S', '2015-06-23 23:05:58', 'admin@biotech.com');
INSERT INTO `tbl_batch` VALUES ('BCH003', 'DFG3235556789', 'Cocacola', 'PRO002', '1500.00', '1', 'A', 'S', '2015-06-23 23:06:45', 'admin@biotech.com');
INSERT INTO `tbl_batch` VALUES ('BCH001', 'MNB34582345', 'Cocacola ', 'PRO001', '100.00', '1', 'A', 'S', '2015-06-23 23:03:13', 'admin@biotech.com');

-- ----------------------------
-- Table structure for `tbl_batch_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_batch_item`;
CREATE TABLE `tbl_batch_item` (
  `BATCH_ID` varchar(6) NOT NULL,
  `ITEM_ID` varchar(6) NOT NULL,
  `BATCH_ITEM_QUANTITY` decimal(10,2) NOT NULL,
  `BATCH_ITEM_REMARK` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`BATCH_ID`,`ITEM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_batch_item
-- ----------------------------
INSERT INTO `tbl_batch_item` VALUES ('BCH001', 'ITM004', '100.00', 'cxczxc');

-- ----------------------------
-- Table structure for `tbl_document_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_document_type`;
CREATE TABLE `tbl_document_type` (
  `DOC_TYPE_ID` varchar(20) NOT NULL,
  `MODULE_ID` varchar(20) NOT NULL,
  `DOC_TYPE_NAME` varchar(250) NOT NULL,
  `DOC_TYPE_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`DOC_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_document_type
-- ----------------------------
INSERT INTO `tbl_document_type` VALUES ('DOC001', 'MOD001', 'Grn', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC002', 'MOD002', 'Recipe', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC003', 'MOD002', 'Product', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC004', 'MOD002', 'Batch', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC005', 'MOD003', 'Item', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC006', 'MOD004', 'User', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC007', 'MOD004', 'Vendor', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC008', 'MOD004', 'Role', 'A');
INSERT INTO `tbl_document_type` VALUES ('DOC009', 'MOD004', 'Setting', 'A');

-- ----------------------------
-- Table structure for `tbl_grn_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grn_item`;
CREATE TABLE `tbl_grn_item` (
  `GRN_ID` varchar(20) NOT NULL,
  `ITEM_ID` varchar(20) NOT NULL,
  `ITEM_QUANTITY` decimal(20,2) NOT NULL,
  `ITEM_AMOUNT` decimal(20,2) DEFAULT NULL,
  `ITEM_EXP_DATE` datetime DEFAULT NULL,
  `ITEM_REMARK` varchar(1500) NOT NULL,
  PRIMARY KEY (`GRN_ID`,`ITEM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_grn_item
-- ----------------------------
INSERT INTO `tbl_grn_item` VALUES ('GRN001', 'ITM001', '2.00', '12.00', '2015-08-03 00:00:00', '');
INSERT INTO `tbl_grn_item` VALUES ('GRN001', 'ITM002', '2.00', '12.00', '2015-08-03 00:00:00', '');
INSERT INTO `tbl_grn_item` VALUES ('GRN002', 'ITM001', '1200.35', '45560.75', '2015-06-02 00:00:00', 'Test item by admin');
INSERT INTO `tbl_grn_item` VALUES ('GRN003', 'ITM001', '32.00', '3423.00', '2015-04-26 00:00:00', 'sdfds');
INSERT INTO `tbl_grn_item` VALUES ('GRN004', 'ITM002', '3434.00', '43434.00', '2015-06-01 00:00:00', 'sdfs');
INSERT INTO `tbl_grn_item` VALUES ('GRN005', 'ITM001', '22.00', '22.00', '2015-06-01 00:00:00', 'dasdsa');
INSERT INTO `tbl_grn_item` VALUES ('GRN005', 'ITM006', '22.00', '22.00', '2015-06-01 00:00:00', 'dasdsa');
INSERT INTO `tbl_grn_item` VALUES ('GRN006', 'ITM004', '2.00', '3.00', '2015-07-06 00:00:00', 'asd');
INSERT INTO `tbl_grn_item` VALUES ('GRN007', 'ITM002', '90.00', '33.00', '2015-06-02 00:00:00', 'll');
INSERT INTO `tbl_grn_item` VALUES ('GRN008', 'ITM007', '89.00', '789.00', '2015-06-01 00:00:00', 'uno');
INSERT INTO `tbl_grn_item` VALUES ('GRN009', 'ITM001', '4.00', '4.00', '2015-06-01 00:00:00', 'dfggdfgdfgfdg');

-- ----------------------------
-- Table structure for `tbl_grn_master`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grn_master`;
CREATE TABLE `tbl_grn_master` (
  `GRN_ID` varchar(20) NOT NULL,
  `INVOICE_ID` varchar(20) NOT NULL,
  `VENDOR_ID` varchar(20) NOT NULL,
  `INVOICE_DATE` datetime NOT NULL,
  `GRN_COMMENT` varchar(1500) DEFAULT NULL,
  `GRN_TITLE` varchar(250) NOT NULL,
  `GRN_MODE` varchar(1) NOT NULL,
  `GRN_CREATE_DATE` datetime NOT NULL,
  `GRN_CREATE_BY` varchar(250) NOT NULL,
  PRIMARY KEY (`INVOICE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_grn_master
-- ----------------------------
INSERT INTO `tbl_grn_master` VALUES ('GRN005', '3234', 'VEN001', '2015-06-05 00:00:00', '1', 'lakmal', 'S', '2015-06-21 00:35:56', '');
INSERT INTO `tbl_grn_master` VALUES ('GRN003', '32423', 'VEN001', '2015-06-04 00:00:00', '1', 'sdfsdfsd', 'S', '2015-06-20 23:32:21', '');
INSERT INTO `tbl_grn_master` VALUES ('GRN004', 'ADFG2323', 'VEN001', '2015-07-03 00:00:00', '1', 'dasd', 'S', '2015-06-20 23:36:45', '');
INSERT INTO `tbl_grn_master` VALUES ('GRN001', 'ASD2323', 'VEN001', '2015-06-08 00:00:00', '1', 'adasd', 'S', '2015-06-20 20:34:07', '');
INSERT INTO `tbl_grn_master` VALUES ('GRN002', 'ASD2325', 'VEN001', '2015-06-04 00:00:00', '1', 'This  test item', 'S', '2015-06-20 20:37:49', '');
INSERT INTO `tbl_grn_master` VALUES ('GRN006', 'GF33434', 'VEN001', '2015-07-01 00:00:00', '1', 'test', 'S', '2015-06-21 18:01:02', '');
INSERT INTO `tbl_grn_master` VALUES ('GRN008', 'POL98078', 'VEN003', '2015-06-03 00:00:00', '1', 'mno', 'S', '2015-06-21 21:24:00', 'admin@biotech.com');
INSERT INTO `tbl_grn_master` VALUES ('GRN007', 'SDF23232', 'VEN001', '2015-06-05 00:00:00', '1', 'sdsd', 'S', '2015-06-21 18:28:12', 'admin@biotech.com');
INSERT INTO `tbl_grn_master` VALUES ('GRN009', 'testabc123', 'VEN003', '2015-06-04 00:00:00', '1', 'dasdasdads', 'S', '2015-06-22 00:34:09', 'admin@biotech.com');

-- ----------------------------
-- Table structure for `tbl_item_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item_category`;
CREATE TABLE `tbl_item_category` (
  `ITEM_CAT_ID` varchar(6) NOT NULL,
  `ITEM_CAT_NAME` varchar(250) NOT NULL,
  `ITEM_CAT_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`ITEM_CAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_item_category
-- ----------------------------
INSERT INTO `tbl_item_category` VALUES ('CAT001', 'Test', 'A');
INSERT INTO `tbl_item_category` VALUES ('CAT002', 'test2', 'I');
INSERT INTO `tbl_item_category` VALUES ('CAT003', 'asdsad sadsa', 'I');

-- ----------------------------
-- Table structure for `tbl_item_master`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item_master`;
CREATE TABLE `tbl_item_master` (
  `ITEM_ID` varchar(6) NOT NULL,
  `ITEM_CODE` varchar(50) DEFAULT NULL,
  `ITEM_CATEGORY_ID` varchar(20) NOT NULL,
  `ITEM_SUB_CATEGORY_ID` varchar(20) NOT NULL,
  `ITEM_NAME` varchar(250) NOT NULL,
  `ITEM_STOCK_UNIT` varchar(6) NOT NULL,
  `ITEM_RATIO` decimal(10,2) NOT NULL,
  `ITEM_ISSUE_UNIT` varchar(6) NOT NULL,
  `ITEM_RE_ORDER_LEVEL` decimal(10,10) NOT NULL,
  `ITEM_NEAR_RE_ORDER_LEVEL` decimal(10,10) NOT NULL,
  `ITEM_LOCATION` varchar(20) DEFAULT NULL,
  `ITEM_REMARK` varchar(1500) DEFAULT NULL,
  `ITEM_STATUS` varchar(1) NOT NULL,
  `ITEM_MODE` varchar(1) NOT NULL,
  `ITEM_ADD_DATE` datetime NOT NULL,
  PRIMARY KEY (`ITEM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_item_master
-- ----------------------------
INSERT INTO `tbl_item_master` VALUES ('ITM001', 'SD0001', 'CAT001', 'SUB005', 'Costic Soda', 'UNT001', '1000.00', 'UNT003', '0.9999999999', '0.9999999999', '01', 'test', 'A', 'S', '0000-00-00 00:00:00');
INSERT INTO `tbl_item_master` VALUES ('ITM002', 'SD0002', 'CAT001', 'SUB005', 'NPA', 'UNT001', '1000.00', 'UNT003', '0.9999999999', '0.9999999999', '01', 'test', 'A', 'S', '0000-00-00 00:00:00');
INSERT INTO `tbl_item_master` VALUES ('ITM003', 'SD0003', 'CAT001', 'SUB005', 'Super pospate', 'UNT001', '1000.00', 'UNT003', '0.9999999999', '0.9999999999', '01', 'test', 'I', 'S', '0000-00-00 00:00:00');
INSERT INTO `tbl_item_master` VALUES ('ITM004', 'SD0004', 'CAT001', 'SUB002', 'xyz', 'UNT003', '1000.00', 'UNT002', '0.9999999999', '0.9999999999', '01', 'sadsa', 'A', 'S', '0000-00-00 00:00:00');
INSERT INTO `tbl_item_master` VALUES ('ITM005', 'SD0006', 'CAT001', 'SUB002', 'sas', 'UNT004', '22.00', 'UNT004', '0.9999999999', '0.9999999999', '01', 'DASDASD', 'I', 'S', '2015-06-20 10:11:04');
INSERT INTO `tbl_item_master` VALUES ('ITM006', 's34dsd', 'CAT001', 'SUB001', 'sdadas', 'UNT003', '3.00', 'UNT003', '0.9999999999', '0.9999999999', '3', 'dfdf', 'A', 'S', '2015-06-20 14:17:21');
INSERT INTO `tbl_item_master` VALUES ('ITM007', 'LOP89897', 'CAT001', 'SUB005', 'bnmjh', 'UNT003', '8.00', 'UNT003', '0.9999999999', '0.9999999999', '4', 'kk', 'A', 'S', '2015-06-21 21:22:57');

-- ----------------------------
-- Table structure for `tbl_item_sub_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item_sub_category`;
CREATE TABLE `tbl_item_sub_category` (
  `ITEM_CAT_ID` varchar(20) NOT NULL,
  `ITEM_SUB_CAT_ID` varchar(20) NOT NULL,
  `ITEM_SUB_CAT_NAME` varchar(250) NOT NULL,
  `ITEM_SUB_CAT_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`ITEM_SUB_CAT_ID`,`ITEM_CAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_item_sub_category
-- ----------------------------
INSERT INTO `tbl_item_sub_category` VALUES ('CAT001', 'SUB001', 'asdasdsd', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT001', 'SUB002', 'asdasdsd', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT001', 'SUB003', 'asdasdsd', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT001', 'SUB004', 'asdasdsd', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT001', 'SUB005', 'subtest', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT002', 'SUB006', 'test2sub', 'I');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT002', 'SUB007', 'test3sub', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT002', 'SUB008', 'test3sub', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT002', 'SUB009', 'dfsdf', 'A');
INSERT INTO `tbl_item_sub_category` VALUES ('CAT002', 'SUB010', 'dsada', 'I');

-- ----------------------------
-- Table structure for `tbl_module`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_module`;
CREATE TABLE `tbl_module` (
  `MODULE_ID` varchar(20) NOT NULL,
  `MODULE_NAME` varchar(250) NOT NULL,
  `MODULE_STATUS` varchar(1) NOT NULL,
  `MODULE_ORDER` int(2) NOT NULL,
  `MODULE_ICON` varchar(150) NOT NULL,
  PRIMARY KEY (`MODULE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_module
-- ----------------------------
INSERT INTO `tbl_module` VALUES ('MOD001', 'Purchase', 'A', '1', 'entypo-credit-card');
INSERT INTO `tbl_module` VALUES ('MOD002', 'Manufacture', 'A', '2', 'entypo-flow-tree');
INSERT INTO `tbl_module` VALUES ('MOD003', 'Stock', 'A', '3', 'entypo-database');
INSERT INTO `tbl_module` VALUES ('MOD004', 'Setup', 'A', '5', 'entypo-tools');
INSERT INTO `tbl_module` VALUES ('MOD005', 'Distribution', 'A', '4', 'entypo-flight');

-- ----------------------------
-- Table structure for `tbl_product_master`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_master`;
CREATE TABLE `tbl_product_master` (
  `PRODUCT_ID` varchar(20) NOT NULL,
  `PRODUCT_NAME` varchar(250) NOT NULL,
  `PRODUCT_CREATE_DATE` datetime NOT NULL,
  `PRODUCT_REMARK` varchar(1500) DEFAULT NULL,
  `PRODUCT_STATUS` varchar(1) NOT NULL,
  `PRODUCT_CREATE_BY` varchar(250) NOT NULL,
  `PRODUCT_MODE` varchar(1) NOT NULL,
  `PRODUCT_QUANTITY` decimal(10,2) NOT NULL,
  `UNIT_CODE` varchar(6) NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product_master
-- ----------------------------
INSERT INTO `tbl_product_master` VALUES ('PRO001', '250ml Cocacola bottle', '2015-06-23 21:30:08', '1', 'A', 'admin@biotech.com', 'S', '1.00', 'UNT005');
INSERT INTO `tbl_product_master` VALUES ('PRO002', 'Coca Powder', '2015-06-23 21:34:41', '1', 'A', 'admin@biotech.com', 'S', '1.00', 'UNT001');

-- ----------------------------
-- Table structure for `tbl_product_mat_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_mat_item`;
CREATE TABLE `tbl_product_mat_item` (
  `PRODUCT_ID` varchar(20) NOT NULL,
  `ITEM_ID` varchar(20) NOT NULL,
  `PRODUCT_ITEM_QUANTITY` decimal(10,2) NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`,`ITEM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product_mat_item
-- ----------------------------
INSERT INTO `tbl_product_mat_item` VALUES ('PRO001', 'ITM004', '1.00');

-- ----------------------------
-- Table structure for `tbl_product_order`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_order`;
CREATE TABLE `tbl_product_order` (
  `PRODUCT_ORDER_ID` varchar(20) NOT NULL,
  `BATCH_ID` varchar(20) NOT NULL,
  `PRODUCT_ID` varchar(20) NOT NULL,
  `PRODUCT_ORDER_QUANTITY` decimal(10,2) NOT NULL,
  `DUE_DATE` datetime NOT NULL,
  `START_DATE` datetime NOT NULL,
  `END_DATE` datetime NOT NULL,
  `REMARK` varchar(1500) DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`PRODUCT_ORDER_ID`,`BATCH_ID`,`PRODUCT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product_order
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_product_recipe`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_recipe`;
CREATE TABLE `tbl_product_recipe` (
  `PRODUCT_ID` varchar(20) NOT NULL DEFAULT '',
  `RECIPE_ID` varchar(20) NOT NULL DEFAULT '',
  `PRODUCT_RECIPE_REMARK` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`PRODUCT_ID`,`RECIPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product_recipe
-- ----------------------------
INSERT INTO `tbl_product_recipe` VALUES ('PRO001', 'REC006', 'main recipe');
INSERT INTO `tbl_product_recipe` VALUES ('PRO001', 'REC008', 'sub recipe');
INSERT INTO `tbl_product_recipe` VALUES ('PRO002', 'REC002', 'powder');

-- ----------------------------
-- Table structure for `tbl_recipe_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_recipe_item`;
CREATE TABLE `tbl_recipe_item` (
  `RECIPE_ID` varchar(20) NOT NULL,
  `ITEM_ID` varchar(20) NOT NULL,
  `RECIPE_ITEM_QUANTITY` decimal(10,10) NOT NULL,
  `RECIPE_ITEM_REMARK` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`RECIPE_ID`,`ITEM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_recipe_item
-- ----------------------------
INSERT INTO `tbl_recipe_item` VALUES ('REC001', 'ITM002', '0.0003400000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC005', 'ITM001', '0.0002000000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC005', 'ITM002', '0.0004500000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC005', 'ITM006', '0.0004100000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC006', 'ITM001', '0.0002000000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC006', 'ITM002', '0.0004500000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC006', 'ITM006', '0.0004100000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC007', 'ITM006', '0.0004100000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC008', 'ITM001', '0.0002000000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC008', 'ITM002', '0.0004500000', 'test');
INSERT INTO `tbl_recipe_item` VALUES ('REC008', 'ITM004', '0.4500000000', 'sd');
INSERT INTO `tbl_recipe_item` VALUES ('REC008', 'ITM006', '0.0004100000', 'test');

-- ----------------------------
-- Table structure for `tbl_recipe_master`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_recipe_master`;
CREATE TABLE `tbl_recipe_master` (
  `RECIPE_ID` varchar(20) NOT NULL,
  `RECIPE_NAME` varchar(250) NOT NULL,
  `RECIPE_CREATE_BY` varchar(250) NOT NULL,
  `RECIPE_CREATE_DATE` datetime NOT NULL,
  `RECIPE_REMARK` varchar(1500) DEFAULT NULL,
  `RECIPE_STATUS` varchar(1) NOT NULL,
  `RECIPE_MODE` varchar(1) NOT NULL,
  PRIMARY KEY (`RECIPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_recipe_master
-- ----------------------------
INSERT INTO `tbl_recipe_master` VALUES ('REC001', 'First recipe', 'admin@biotech.com', '2015-06-21 18:38:28', '1', 'A', 'S');
INSERT INTO `tbl_recipe_master` VALUES ('REC002', 'Cocacola ', 'admin@biotech.com', '2015-06-21 18:39:45', '1', 'A', 'S');
INSERT INTO `tbl_recipe_master` VALUES ('REC003', 'Cocacola ', 'admin@biotech.com', '2015-06-21 18:40:25', '1', 'A', 'S');
INSERT INTO `tbl_recipe_master` VALUES ('REC004', 'Cocacola ', 'admin@biotech.com', '2015-06-21 18:41:09', '1', 'A', 'S');
INSERT INTO `tbl_recipe_master` VALUES ('REC005', 'Cocacola ', 'admin@biotech.com', '2015-06-21 18:41:55', '1', 'A', 'S');
INSERT INTO `tbl_recipe_master` VALUES ('REC006', 'Xyz', 'admin@biotech.com', '2015-06-21 18:42:54', '1', 'A', 'S');
INSERT INTO `tbl_recipe_master` VALUES ('REC007', 'this is import recipe', 'admin@biotech.com', '2015-06-22 23:13:27', 'this is import recipe', 'A', 'S');
INSERT INTO `tbl_recipe_master` VALUES ('REC008', 'import2', 'admin@biotech.com', '2015-06-22 23:14:47', 'import recipe', 'A', 'S');

-- ----------------------------
-- Table structure for `tbl_role`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE `tbl_role` (
  `ROLE_ID` varchar(6) NOT NULL,
  `ROLE_NAME` varchar(250) NOT NULL,
  `ROLE_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_role
-- ----------------------------
INSERT INTO `tbl_role` VALUES ('ROL001', 'System admin', 'A');
INSERT INTO `tbl_role` VALUES ('ROL002', 'Purchase manager', 'A');
INSERT INTO `tbl_role` VALUES ('ROL003', 'Employer', 'A');

-- ----------------------------
-- Table structure for `tbl_role_document_type_mapping`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role_document_type_mapping`;
CREATE TABLE `tbl_role_document_type_mapping` (
  `ROLE_ID` varchar(6) NOT NULL,
  `DOC_TYPE_ID` varchar(6) NOT NULL,
  `PERMISSION_LEVEL` varchar(2) NOT NULL,
  PRIMARY KEY (`ROLE_ID`,`DOC_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_role_document_type_mapping
-- ----------------------------
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL001', 'DOC001', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL001', 'DOC002', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL001', 'DOC003', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC001', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC002', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC003', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC004', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC005', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC006', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC007', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC008', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL002', 'DOC009', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL003', 'DOC002', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL003', 'DOC003', '1');
INSERT INTO `tbl_role_document_type_mapping` VALUES ('ROL003', 'DOC005', '1');

-- ----------------------------
-- Table structure for `tbl_stock`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stock`;
CREATE TABLE `tbl_stock` (
  `ITEM_ID` varchar(20) NOT NULL,
  `STOCK_QUANTITY` decimal(20,2) NOT NULL,
  PRIMARY KEY (`ITEM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_stock
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_unit`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE `tbl_unit` (
  `UNIT_CODE` varchar(6) NOT NULL,
  `UNIT_NAME` varchar(15) NOT NULL,
  `UNIT_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`UNIT_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_unit
-- ----------------------------
INSERT INTO `tbl_unit` VALUES ('UNT001', 'Kg', 'A');
INSERT INTO `tbl_unit` VALUES ('UNT002', 'Grm', 'A');
INSERT INTO `tbl_unit` VALUES ('UNT003', 'Mg', 'A');
INSERT INTO `tbl_unit` VALUES ('UNT004', 'Leter', 'A');
INSERT INTO `tbl_unit` VALUES ('UNT005', 'Bottle', 'A');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `USER_ID` varchar(6) NOT NULL,
  `USER_NAME` varchar(250) NOT NULL,
  `USER_EMAIL` varchar(150) NOT NULL,
  `USER_PASSWORD` varchar(250) NOT NULL,
  `USER_LEVEL` varchar(1) DEFAULT NULL,
  `USER_CONTACT_NO` int(10) DEFAULT NULL,
  `USER_STATUS` varchar(1) NOT NULL,
  `USER_LAST_LOG` datetime DEFAULT NULL,
  PRIMARY KEY (`USER_EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('USR003', 'test', 'abc@123.com', '202cb962ac59075b964b07152d234b70', '', '0', 'I', '0000-00-00 00:00:00');
INSERT INTO `tbl_user` VALUES ('USR001', 'Admin', 'admin@biotech.com', '202cb962ac59075b964b07152d234b70', '1', '712176489', 'A', '2015-06-08 20:38:08');
INSERT INTO `tbl_user` VALUES ('USR002', 'lakmal', 'lakmal@abc.com', '202cb962ac59075b964b07152d234b70', '', '0', 'A', '0000-00-00 00:00:00');
INSERT INTO `tbl_user` VALUES ('USR004', 'lakshman', 'lakshman@biotech.com', '202cb962ac59075b964b07152d234b70', '', '0', 'A', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `tbl_user_role_mapping`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_role_mapping`;
CREATE TABLE `tbl_user_role_mapping` (
  `USER_ID` varchar(6) NOT NULL,
  `ROLE_ID` varchar(6) NOT NULL,
  PRIMARY KEY (`USER_ID`,`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_role_mapping
-- ----------------------------
INSERT INTO `tbl_user_role_mapping` VALUES ('USR001', 'ROL001');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR001', 'ROL002');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR001', 'ROL003');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR001', 'ROL004');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR002', 'ROL001');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR002', 'ROL002');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR002', 'ROL003');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR003', 'ROL002');
INSERT INTO `tbl_user_role_mapping` VALUES ('USR004', 'ROL001');

-- ----------------------------
-- Table structure for `tbl_vendor`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_vendor`;
CREATE TABLE `tbl_vendor` (
  `VENDOR_ID` varchar(20) NOT NULL,
  `VENDOR_NAME` varchar(250) NOT NULL,
  `VENDOR_EMAIL` varchar(150) NOT NULL,
  `VENDOR_ADDRESS` varchar(250) NOT NULL,
  `VENDOR_CONTACT_NO` int(10) NOT NULL,
  `VENDOR_TYPE` varchar(1) NOT NULL,
  `VENDOR_REMARK` varchar(1500) DEFAULT NULL,
  `VENDOR_STATUS` varchar(1) NOT NULL,
  PRIMARY KEY (`VENDOR_EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_vendor
-- ----------------------------
INSERT INTO `tbl_vendor` VALUES ('VEN001', 'Hemaz', 'abc@123.com', '23/2,Colombo,Srilanka', '1234567890', 'S', 'dfdsds', 'A');
INSERT INTO `tbl_vendor` VALUES ('VEN003', 'test vendor', 'abc@1234.com', 'asdas', '34324234', 'S', 'asdas', 'A');
INSERT INTO `tbl_vendor` VALUES ('VEN002', 'Arpico', 'abcd@123.com', '102,Colombo2,Srilanka', '1234567890', 'B', 'ada asdasdasdas asdasdasdsadsadasdsadasdsadasdasds', 'I');
