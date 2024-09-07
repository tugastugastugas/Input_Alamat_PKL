/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : pe

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 07/09/2024 22:25:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lokasi
-- ----------------------------
DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE `lokasi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `latitude` decimal(10, 8) NULL DEFAULT NULL,
  `longitude` decimal(11, 8) NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lokasi
-- ----------------------------
INSERT INTO `lokasi` VALUES (10, 1.12687590, 104.06204590, 'Batam 24961, Riau Islands, Indonesia', 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lokasi` VALUES (11, 1.12731209, 104.06167391, 'Lat: 1.1273120911900656, Lon: 104.0616739104397', 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lokasi` VALUES (14, 1.10979900, 104.04108310, 'Golden Land, Batam, Riau Islands, Indonesia', 2, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lokasi` VALUES (21, 1.06605190, 104.03083640, 'PT. Schneider Electric Manufacturing Batam Lot 04, Jalan Beringin, Batamindo Industrial Park, Batam 29433, Riau Islands, Indonesia', 10, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lokasi` VALUES (24, 1.06605190, 104.03083640, 'PT. Schneider Electric Manufacturing Batam Lot 04, Jalan Beringin, Batamindo Industrial Park, Batam 29433, Riau Islands, Indonesia', 18, NULL, NULL, 18, '2024-09-07 21:28:20', NULL, NULL);

-- ----------------------------
-- Table structure for lokasi_backup
-- ----------------------------
DROP TABLE IF EXISTS `lokasi_backup`;
CREATE TABLE `lokasi_backup`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `latitude` decimal(10, 8) NULL DEFAULT NULL,
  `longitude` decimal(11, 8) NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lokasi_backup
-- ----------------------------
INSERT INTO `lokasi_backup` VALUES (22, 1.06874000, 104.02025000, 'PT. Epson Manufacturing Batam, Jalan Dam Mukakuning, Komplek Otorita Dam Mukakuning, Batam 29433, Riau Islands, Indonesia', 10, 10, '2024-09-04 13:04:24', '2024-09-04 13:04:24', 10, NULL, NULL);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id_permission` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `can_access` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_permission`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 404 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (304, 'Guru', 'dashboard', 1);
INSERT INTO `permissions` VALUES (305, 'Guru', 'data', 1);
INSERT INTO `permissions` VALUES (306, 'Kajur', 'dashboard', 1);
INSERT INTO `permissions` VALUES (307, 'Kajur', 'data', 1);
INSERT INTO `permissions` VALUES (308, 'Murid', 'dashboard', 1);
INSERT INTO `permissions` VALUES (309, 'Murid', 'input_alamat', 1);
INSERT INTO `permissions` VALUES (394, 'kepala sekolah', 'dashboard', 1);
INSERT INTO `permissions` VALUES (395, 'kepala sekolah', 'data', 1);
INSERT INTO `permissions` VALUES (396, 'admin', 'dashboard', 1);
INSERT INTO `permissions` VALUES (397, 'admin', 'data', 1);
INSERT INTO `permissions` VALUES (398, 'admin', 'user', 1);
INSERT INTO `permissions` VALUES (399, 'admin', 'setting', 1);
INSERT INTO `permissions` VALUES (400, 'admin', 'log_activity', 1);
INSERT INTO `permissions` VALUES (401, 'admin', 'restore_data', 1);
INSERT INTO `permissions` VALUES (402, 'admin', 'level', 1);
INSERT INTO `permissions` VALUES (403, 'admin', 'restore_edit', 1);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tab_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Family Laundry Terbaik Sekota Batam', '1725332968_662e88e23ff933c0fa4b.png', '1725241914_efccb8304b5aab92c62a.jpg', '1722867534_4b659a2e04aa2671b071.jpeg', NULL, 1, NULL, NULL, '2024-09-03 10:09:35', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` enum('Admin','Murid','Guru','Kajur','Kepala Sekolah') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nis` int NULL DEFAULT NULL,
  `kelas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE INDEX `1`(`nis` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'Admin', 0, '', '', '1725287272_dac72b11945b0c10f533.jpg', 1, '2024-09-02 21:45:57');
INSERT INTO `user` VALUES (2, 'Ahmad', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161019, 'AKL  XII', 'AKL', NULL, NULL, NULL);
INSERT INTO `user` VALUES (4, 'kajur', 'c4ca4238a0b923820dcc509a6f75849b', 'Kajur', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (5, 'kepsek', 'c4ca4238a0b923820dcc509a6f75849b', 'Kepala Sekolah', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (10, 'Elvan', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161018, 'RPL XII A', 'RPL', '1725430070_a7f56407cd5700ad0bd2.png', 10, '2024-09-02 21:34:36');
INSERT INTO `user` VALUES (12, 'Guru', 'c4ca4238a0b923820dcc509a6f75849b', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (15, 'Ibnu', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161069, 'BDP XII', 'BDP', '1725288270_b836b740e732df6f1f9f.jpg', NULL, NULL);
INSERT INTO `user` VALUES (18, 'User', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161010, 'RPL XI A', 'RPL', '1725288159_5695430fa933ee820f22.jpg', NULL, NULL);

-- ----------------------------
-- Table structure for user_activity
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 307 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_activity
-- ----------------------------
INSERT INTO `user_activity` VALUES (265, 1, 'Masuk ke Dashboard', NULL, '2024-09-02 21:03:56', '2024-09-02 21:03:56');
INSERT INTO `user_activity` VALUES (266, 1, 'Masuk ke User', NULL, '2024-09-02 21:11:17', '2024-09-02 21:11:17');
INSERT INTO `user_activity` VALUES (267, 1, 'Masuk ke Setting', NULL, '2024-09-02 21:11:21', '2024-09-02 21:11:21');
INSERT INTO `user_activity` VALUES (268, 1, 'Melakukan Setting', NULL, '2024-09-02 21:11:26', '2024-09-02 21:11:26');
INSERT INTO `user_activity` VALUES (269, 1, 'Mereset Password', NULL, '2024-09-02 21:11:45', '2024-09-02 21:11:45');
INSERT INTO `user_activity` VALUES (270, 10, 'Masuk ke Input Alamat PKL', NULL, '2024-09-02 21:17:31', '2024-09-02 21:17:31');
INSERT INTO `user_activity` VALUES (271, 1, 'Masuk ke profile', NULL, '2024-09-02 21:26:50', '2024-09-02 21:26:50');
INSERT INTO `user_activity` VALUES (272, 1, 'Mengedit Profile', NULL, '2024-09-02 21:27:01', '2024-09-02 21:27:01');
INSERT INTO `user_activity` VALUES (273, 1, 'Mengedit Foto', NULL, '2024-09-02 21:27:24', '2024-09-02 21:27:24');
INSERT INTO `user_activity` VALUES (274, 10, 'Masuk ke profile', NULL, '2024-09-02 21:30:06', '2024-09-02 21:30:06');
INSERT INTO `user_activity` VALUES (275, 10, 'Mengubah Password', NULL, '2024-09-02 21:30:17', '2024-09-02 21:30:17');
INSERT INTO `user_activity` VALUES (276, 1, 'Mengubah Password', NULL, '2024-09-02 21:31:55', '2024-09-02 21:31:55');
INSERT INTO `user_activity` VALUES (277, 10, 'Masuk ke Dashboard', NULL, '2024-09-02 21:33:25', '2024-09-02 21:33:25');
INSERT INTO `user_activity` VALUES (278, 13, 'Masuk ke Dashboard', NULL, '2024-09-02 21:41:42', '2024-09-02 21:41:42');
INSERT INTO `user_activity` VALUES (279, 13, 'Masuk ke profile', NULL, '2024-09-02 21:41:46', '2024-09-02 21:41:46');
INSERT INTO `user_activity` VALUES (280, 13, 'Mengedit Foto', NULL, '2024-09-02 21:42:39', '2024-09-02 21:42:39');
INSERT INTO `user_activity` VALUES (281, 14, 'Masuk ke Dashboard', NULL, '2024-09-02 21:43:37', '2024-09-02 21:43:37');
INSERT INTO `user_activity` VALUES (282, 14, 'Masuk ke profile', NULL, '2024-09-02 21:43:41', '2024-09-02 21:43:41');
INSERT INTO `user_activity` VALUES (283, 15, 'Masuk ke Dashboard', NULL, '2024-09-02 21:44:44', '2024-09-02 21:44:44');
INSERT INTO `user_activity` VALUES (284, 15, 'Masuk ke profile', NULL, '2024-09-02 21:44:50', '2024-09-02 21:44:50');
INSERT INTO `user_activity` VALUES (285, 1, 'Masuk ke Restore Edit', NULL, '2024-09-02 21:46:12', '2024-09-02 21:46:12');
INSERT INTO `user_activity` VALUES (286, 1, 'Melihat ke Detail User', NULL, '2024-09-02 21:46:30', '2024-09-02 21:46:30');
INSERT INTO `user_activity` VALUES (287, 1, 'Mengedit User', NULL, '2024-09-02 21:55:15', '2024-09-02 21:55:15');
INSERT INTO `user_activity` VALUES (288, 1, 'Masuk ke Data Alamat PKL', NULL, '2024-09-03 09:48:01', '2024-09-03 09:48:01');
INSERT INTO `user_activity` VALUES (289, 1, 'Masuk ke Permissions', NULL, '2024-09-04 12:56:27', '2024-09-04 12:56:27');
INSERT INTO `user_activity` VALUES (290, 1, 'Masuk ke Hak Akses', NULL, '2024-09-04 12:56:30', '2024-09-04 12:56:30');
INSERT INTO `user_activity` VALUES (291, 10, 'Menyimpan Lokasi', NULL, '2024-09-04 12:59:33', '2024-09-04 12:59:33');
INSERT INTO `user_activity` VALUES (292, 1, 'Masuk Ke Restore Data', NULL, '2024-09-04 13:03:02', '2024-09-04 13:03:02');
INSERT INTO `user_activity` VALUES (293, 10, 'Menghapus Lokasi', NULL, '2024-09-04 13:04:42', '2024-09-04 13:04:42');
INSERT INTO `user_activity` VALUES (294, 10, 'Mengedit Foto', NULL, '2024-09-04 13:07:32', '2024-09-04 13:07:32');
INSERT INTO `user_activity` VALUES (295, 1, 'Masuk ke Tanbah User', NULL, '2024-09-04 13:09:18', '2024-09-04 13:09:18');
INSERT INTO `user_activity` VALUES (296, 1, 'Menambah User', NULL, '2024-09-07 20:39:17', '2024-09-07 20:39:17');
INSERT INTO `user_activity` VALUES (297, 1, 'Menghapus User', NULL, '2024-09-07 20:39:21', '2024-09-07 20:39:21');
INSERT INTO `user_activity` VALUES (298, 1, 'Merestore Data', NULL, '2024-09-07 20:49:35', '2024-09-07 20:49:35');
INSERT INTO `user_activity` VALUES (299, 17, 'Masuk ke Dashboard', NULL, '2024-09-07 21:22:22', '2024-09-07 21:22:22');
INSERT INTO `user_activity` VALUES (300, 17, 'Masuk ke Input Alamat PKL', NULL, '2024-09-07 21:22:27', '2024-09-07 21:22:27');
INSERT INTO `user_activity` VALUES (301, 17, 'Menyimpan Lokasi', NULL, '2024-09-07 21:22:46', '2024-09-07 21:22:46');
INSERT INTO `user_activity` VALUES (302, 18, 'Masuk ke Dashboard', NULL, '2024-09-07 21:25:41', '2024-09-07 21:25:41');
INSERT INTO `user_activity` VALUES (303, 18, 'Masuk ke Input Alamat PKL', NULL, '2024-09-07 21:25:43', '2024-09-07 21:25:43');
INSERT INTO `user_activity` VALUES (304, 18, 'Menyimpan Lokasi', NULL, '2024-09-07 21:25:55', '2024-09-07 21:25:55');
INSERT INTO `user_activity` VALUES (305, 1, 'Merestore Data Edit', NULL, '2024-09-07 21:28:40', '2024-09-07 21:28:40');
INSERT INTO `user_activity` VALUES (306, 18, 'Menghapus Lokasi', NULL, '2024-09-07 21:28:50', '2024-09-07 21:28:50');

SET FOREIGN_KEY_CHECKS = 1;
