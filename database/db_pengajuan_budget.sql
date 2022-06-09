/*
 Navicat Premium Data Transfer

 Source Server         : My SQL
 Source Server Type    : MySQL
 Source Server Version : 100604
 Source Host           : localhost:3306
 Source Schema         : db_pengajuan_budget

 Target Server Type    : MySQL
 Target Server Version : 100604
 File Encoding         : 65001

 Date: 06/06/2022 14:18:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for budget_approve
-- ----------------------------
DROP TABLE IF EXISTS `budget_approve`;
CREATE TABLE `budget_approve`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_budget` int(11) NOT NULL,
  `tgl_action` date NULL DEFAULT NULL,
  `is_approve` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `id_budget`) USING BTREE,
  INDEX `key_budget_req`(`id_budget`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of budget_approve
-- ----------------------------
INSERT INTO `budget_approve` VALUES (1, 1, '2022-06-06', 0);
INSERT INTO `budget_approve` VALUES (2, 1, '2022-06-06', 0);
INSERT INTO `budget_approve` VALUES (3, 1, '2022-06-06', 0);
INSERT INTO `budget_approve` VALUES (4, 1, '2022-06-06', 0);
INSERT INTO `budget_approve` VALUES (5, 2, '2022-06-06', 1);

-- ----------------------------
-- Table structure for budget_request
-- ----------------------------
DROP TABLE IF EXISTS `budget_request`;
CREATE TABLE `budget_request`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_request` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `nominal` float NULL DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tgl_request` date NULL DEFAULT NULL,
  `status` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `id_user`) USING BTREE,
  INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of budget_request
-- ----------------------------
INSERT INTO `budget_request` VALUES (1, '202206/REQ/0000001', 19, 2250000, '&lt;p&gt;Tolong di ACC sebesar&amp;nbsp;Rp. 2.250.000&lt;/p&gt;\n', '2022-06-06', 'Rejected');
INSERT INTO `budget_request` VALUES (2, '202206/REQ/0000002', 19, 10000000, '&lt;p&gt;Tolong di ACC budget sebesar&amp;nbsp;Rp. 10.000.000&lt;/p&gt;\n', '2022-06-06', 'Approved');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_menu_id` int(11) NULL DEFAULT NULL,
  `menu_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_link` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_status` tinyint(1) NOT NULL,
  `menu_ismaster` tinyint(1) NOT NULL,
  `menu_order` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `id_user` int(15) NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_deleted` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE,
  INDEX `fk_parent_id`(`men_menu_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (5, NULL, 'Setting', '#', 1, 1, 0, '2017-01-30 23:02:05', NULL, 'admin', NULL, NULL, NULL);
INSERT INTO `menu` VALUES (2, NULL, 'Staff', 'user', 1, 0, 0, '2017-01-30 23:02:22', NULL, 'admin', NULL, NULL, NULL);
INSERT INTO `menu` VALUES (3, 5, 'Role', 'role', 1, 1, 0, '2017-01-30 23:02:42', NULL, 'admin', NULL, NULL, NULL);
INSERT INTO `menu` VALUES (4, 5, 'Menu', 'menu', 1, 1, 0, '2017-01-30 23:04:12', NULL, 'admin', '2017-01-30 23:13:18', 'admin', NULL);
INSERT INTO `menu` VALUES (1, NULL, 'Dashboard', 'dashboard', 1, 0, 0, '2017-01-30 23:06:03', NULL, 'admin', NULL, NULL, NULL);
INSERT INTO `menu` VALUES (9, NULL, 'My Profile', 'user/detail', 1, 0, 0, '2017-01-30 23:02:22', NULL, 'admin', NULL, NULL, NULL);
INSERT INTO `menu` VALUES (8, NULL, 'Budget Approval', 'budgetapprove', 1, 0, 0, '2017-01-30 23:02:22', NULL, 'admin', NULL, NULL, NULL);
INSERT INTO `menu` VALUES (7, NULL, 'Budget Request', 'budgetrequest', 1, 0, 0, '2017-01-30 23:02:22', NULL, 'admin', NULL, NULL, NULL);
INSERT INTO `menu` VALUES (6, NULL, 'Notification', 'notification', 1, 0, 0, '2017-01-30 23:02:22', NULL, 'admin', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for menu_home
-- ----------------------------
DROP TABLE IF EXISTS `menu_home`;
CREATE TABLE `menu_home`  (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_menu_id` int(11) NULL DEFAULT NULL,
  `menu_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_link` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_status` tinyint(1) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_deleted` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE,
  INDEX `fk_parent_id`(`men_menu_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu_home
-- ----------------------------
INSERT INTO `menu_home` VALUES (1, NULL, 'HOME', 'home', 1, '2017-01-30 23:02:05', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (2, NULL, 'PROFILE', 'profile', 1, '2017-01-30 23:02:22', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (3, NULL, 'ORGANISASI', 'organisasi', 1, '2017-01-30 23:02:42', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (4, NULL, 'PROGRAM KERJA', '#', 1, '2017-01-30 23:04:12', 'admin', '2017-01-30 23:13:18', 'admin', NULL);
INSERT INTO `menu_home` VALUES (5, NULL, 'BERITA', 'berita', 1, '2017-01-30 23:06:03', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (6, NULL, 'JADWAL KEGIATAN', 'berita', 1, '2017-01-31 22:47:36', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (7, NULL, 'BULETIN', 'kategori', 0, '2017-02-02 14:35:44', 'admin', '2017-02-02 14:40:55', 'admin', NULL);
INSERT INTO `menu_home` VALUES (8, NULL, 'FORUM DISKUSI', 'profile', 1, '2017-02-14 11:32:32', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (9, NULL, 'KONTAK', 'kontak', 1, '2017-02-14 13:33:43', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (10, NULL, 'ABOUT', 'menu_home', 0, '2017-02-17 01:25:12', 'admin', NULL, NULL, NULL);
INSERT INTO `menu_home` VALUES (11, 2, 'STRUKTUR ORGANISASI', '#', 0, '2017-02-17 01:50:36', 'admin', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for menu_role
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role`  (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `CREATED_ON` datetime(0) NULL DEFAULT NULL,
  `id_user` int(15) NULL DEFAULT NULL,
  `CREATED_BY` int(11) NULL DEFAULT NULL,
  `UPDATED_ON` datetime(0) NULL DEFAULT NULL,
  `IS_DELETED` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`, `menu_id`) USING BTREE,
  INDEX `fk_menu_role2`(`menu_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of menu_role
-- ----------------------------
INSERT INTO `menu_role` VALUES (1, 6, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 5, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 4, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (6, 6, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (5, 6, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 9, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (6, 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 3, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (6, 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (6, 8, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (6, 9, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (5, 9, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (5, 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (5, 7, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 8, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu_role` VALUES (1, 7, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_status` tinyint(1) NOT NULL,
  `role_canlogin` tinyint(1) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `id_user` int(15) NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_deleted` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'Administrator', 1, 0, '0000-00-00 00:00:00', NULL, '', '2018-08-14 02:25:12', 'admin', NULL);
INSERT INTO `role` VALUES (5, 'Staff', 1, 0, '0000-00-00 00:00:00', NULL, 'admin', '2022-06-04 15:07:04', 'admin', NULL);
INSERT INTO `role` VALUES (6, 'Supervisor', 1, 0, '0000-00-00 00:00:00', NULL, 'admin', '2022-06-04 15:07:12', 'admin', NULL);

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_budget` int(11) NOT NULL,
  `task` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `created_at` date NULL DEFAULT NULL,
  `flag` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `id_budget`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES (1, 1, 'Request Budget Dari Faisal Gani Dengan Nomor <a href=# onclick=detailRequest(1)>202206/REQ/0000001</a>', 19, '2022-06-06', 0);
INSERT INTO `task` VALUES (4, 1, 'Request Budget Dari Faisal Gani  Dengan Nomor <a href=# onclick=detailRequestUser(1)>202206/REQ/0000001</a> Tidak Di Setujui Oleh Supervisor Bambang', 18, '2022-06-06', 1);
INSERT INTO `task` VALUES (5, 2, 'Request Budget Dari Faisal Gani Dengan Nomor <a href=# onclick=detailRequest(2)>202206/REQ/0000002</a>', 19, '2022-06-06', 0);
INSERT INTO `task` VALUES (6, 2, 'Request Budget Dari Faisal Gani  Dengan Nomor <a href=# onclick=detailRequestUser(2)>202206/REQ/0000002</a> Telah Di Setujui Oleh Supervisor Bambang', 18, '2022-06-06', 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `full_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_deleted` smallint(6) NULL DEFAULT NULL,
  `suspend` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `photo` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `is_login` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `fk_user_role`(`role_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Administrator', '0000-00-00 00:00:00', NULL, '2018-08-08 01:48:11', 'admin', NULL, NULL, 'upload/user_photo/default.png', NULL);
INSERT INTO `users` VALUES (18, 6, 'Bambang', '827ccb0eea8a706c4c34a16891f84e7b', 'Bambang', '2018-07-29 07:03:28', 'admin', '0000-00-00 00:00:00', NULL, NULL, NULL, 'upload/user_photo/default.png', NULL);
INSERT INTO `users` VALUES (19, 5, 'gani', '827ccb0eea8a706c4c34a16891f84e7b', 'Faisal Gani', '2018-08-07 11:07:48', 'admin', '0000-00-00 00:00:00', NULL, NULL, NULL, 'upload/user_photo/default.png', NULL);
INSERT INTO `users` VALUES (20, 5, 'dimas', '827ccb0eea8a706c4c34a16891f84e7b', 'Dimas', '2022-06-06 08:23:20', 'admin', '0000-00-00 00:00:00', NULL, NULL, NULL, 'upload/user_photo/default.png', NULL);

SET FOREIGN_KEY_CHECKS = 1;
