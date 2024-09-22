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

 Date: 22/09/2024 00:19:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for agenda
-- ----------------------------
DROP TABLE IF EXISTS `agenda`;
CREATE TABLE `agenda`  (
  `id_agenda` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `jam_masuk` time NULL DEFAULT NULL,
  `jam_pulang` time NULL DEFAULT NULL,
  `rencana` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `realisasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `penugasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `masalah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keramahan` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `penampilan` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `senyum` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `komunikasi` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `realisasi_kerja` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `catatan_kerja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hari` int NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `persetujuan_pkl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `persetujuan_pembimbing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `absen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `absen_jumat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_agenda`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of agenda
-- ----------------------------
INSERT INTO `agenda` VALUES (17, '2024-09-22', '14:14:00', '12:13:00', 'qwe', 'qwe', 'qwe', 'qwe', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'qweqwe', 1, 10, 'Disetujui', 'Disetujui', 'Hadir', NULL);

-- ----------------------------
-- Table structure for alamat
-- ----------------------------
DROP TABLE IF EXISTS `alamat`;
CREATE TABLE `alamat`  (
  `latitude` decimal(9, 6) NULL DEFAULT NULL,
  `longitude` decimal(9, 6) NOT NULL,
  `id_user` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of alamat
-- ----------------------------

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
  `persetujuan` enum('Setuju','Tidak Setuju') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lokasi
-- ----------------------------
INSERT INTO `lokasi` VALUES (28, 1.12712480, 104.03411250, 'PT. Solnet Indonesia, Jalan Raja H Fisabilillah, Batam 29412, Riau Islands, Indonesia', 10, NULL, NULL, NULL, NULL, NULL, NULL, 'Setuju');

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
  `persetujuan` enum('Setuju','Tidak Setuju') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lokasi_backup
-- ----------------------------
INSERT INTO `lokasi_backup` VALUES (22, 0.61125510, 104.28841720, 'Beach at end of Batam\'s last land linked island, 39, Batam, Riau Islands, Indonesia', 10, 10, '2024-09-12 11:11:31', '2024-09-12 11:11:31', 10, NULL, NULL, 'Tidak Setuju');
INSERT INTO `lokasi_backup` VALUES (23, 1.13054143, 103.96432456, 'Golf Buggy Track, Batam 29427, Riau Islands, Indonesia', 10, 10, '2024-09-12 11:11:49', '2024-09-12 11:11:49', 10, NULL, NULL, 'Tidak Setuju');
INSERT INTO `lokasi_backup` VALUES (24, 0.61825294, 104.28335583, '39, Batam, Riau Islands, Indonesia', 10, 10, '2024-09-12 11:11:59', '2024-09-12 11:11:59', 10, NULL, NULL, 'Tidak Setuju');

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
) ENGINE = InnoDB AUTO_INCREMENT = 451 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (394, 'kepala sekolah', 'dashboard', 1);
INSERT INTO `permissions` VALUES (395, 'kepala sekolah', 'data', 1);
INSERT INTO `permissions` VALUES (404, 'Pembimbing', 'dashboard', 1);
INSERT INTO `permissions` VALUES (405, 'Pembimbing', 'murid', 1);
INSERT INTO `permissions` VALUES (406, 'Pembimbing', 'agenda_murid', 1);
INSERT INTO `permissions` VALUES (409, 'kepala sekolah', 'agenda_murid', 1);
INSERT INTO `permissions` VALUES (411, 'admin', 'dashboard', 1);
INSERT INTO `permissions` VALUES (412, 'admin', 'data', 1);
INSERT INTO `permissions` VALUES (413, 'admin', 'input_alamat', 1);
INSERT INTO `permissions` VALUES (414, 'admin', 'agenda', 1);
INSERT INTO `permissions` VALUES (415, 'admin', 'pemilihan', 1);
INSERT INTO `permissions` VALUES (416, 'admin', 'murid', 1);
INSERT INTO `permissions` VALUES (417, 'admin', 'murid_bimbingan', 1);
INSERT INTO `permissions` VALUES (418, 'admin', 'user', 1);
INSERT INTO `permissions` VALUES (419, 'admin', 'setting', 1);
INSERT INTO `permissions` VALUES (420, 'admin', 'log_activity', 1);
INSERT INTO `permissions` VALUES (421, 'admin', 'restore_data', 1);
INSERT INTO `permissions` VALUES (422, 'admin', 'level', 1);
INSERT INTO `permissions` VALUES (423, 'admin', 'restore_edit', 1);
INSERT INTO `permissions` VALUES (428, 'Kesiswaan', 'dashboard', 1);
INSERT INTO `permissions` VALUES (429, 'Kesiswaan', 'data', 1);
INSERT INTO `permissions` VALUES (430, 'Kesiswaan', 'pemilihan', 1);
INSERT INTO `permissions` VALUES (431, 'murid', 'dashboard', 1);
INSERT INTO `permissions` VALUES (432, 'murid', 'input_alamat', 1);
INSERT INTO `permissions` VALUES (433, 'murid', 'agenda', 1);
INSERT INTO `permissions` VALUES (434, 'guru', 'dashboard', 1);
INSERT INTO `permissions` VALUES (435, 'guru', 'data', 1);
INSERT INTO `permissions` VALUES (436, 'guru', 'murid_bimbingan', 1);
INSERT INTO `permissions` VALUES (441, 'kajur', 'dashboard', 1);
INSERT INTO `permissions` VALUES (442, 'kajur', 'data', 1);
INSERT INTO `permissions` VALUES (443, 'kajur', 'pemilihan', 1);
INSERT INTO `permissions` VALUES (444, 'kajur', 'murid_bimbingan', 1);
INSERT INTO `permissions` VALUES (445, 'kajur', 'murid_pkl', 1);
INSERT INTO `permissions` VALUES (446, 'kepala sekolah', 'murid_pkl', 1);
INSERT INTO `permissions` VALUES (447, 'Kesiswaan', 'murid_pkl', 1);
INSERT INTO `permissions` VALUES (448, 'admin', 'murid_pkl', 1);
INSERT INTO `permissions` VALUES (449, 'admin', 'agenda_murid', 1);
INSERT INTO `permissions` VALUES (450, 'guru', 'agenda_murid', 1);

-- ----------------------------
-- Table structure for pt
-- ----------------------------
DROP TABLE IF EXISTS `pt`;
CREATE TABLE `pt`  (
  `id_pt` int NOT NULL AUTO_INCREMENT,
  `id` int NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `nama_pt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_pt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pt`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pt
-- ----------------------------
INSERT INTO `pt` VALUES (5, 28, 10, 'Contoh Nama PT', 'Contoh Nomor PT');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

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
  `level` enum('Admin','Murid','Guru','Kajur','Kepala Sekolah','Kesiswaan','Pembimbing') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nis` int NULL DEFAULT NULL,
  `kelas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `pembimbing` int NULL DEFAULT NULL,
  `pembimbing_pkl` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE INDEX `1`(`nis` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'Admin', 0, '', '', '1725287272_dac72b11945b0c10f533.jpg', 1, '2024-09-02 21:45:57', NULL, NULL);
INSERT INTO `user` VALUES (2, 'Ahmad', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161019, 'AKL  XII', 'AKL', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (4, 'kajur', 'c4ca4238a0b923820dcc509a6f75849b', 'Kajur', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (5, 'kepsek', 'c4ca4238a0b923820dcc509a6f75849b', 'Kepala Sekolah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (10, 'Elvan', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161018, 'RPL XII A', 'RPL', NULL, 10, '2024-09-02 21:34:36', 12, 25);
INSERT INTO `user` VALUES (12, 'Guru', 'c4ca4238a0b923820dcc509a6f75849b', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (15, 'Ibnu', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161069, 'BDP XII', 'BDP', '1725288270_b836b740e732df6f1f9f.jpg', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (16, 'User', 'c4ca4238a0b923820dcc509a6f75849b', 'Murid', 22161718, 'RPL XII A', 'RPL', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (21, 'deren', 'dc5d6249e4134cc68d3b2437e0a53b7d', 'Murid', 22161048, 'RPL 12 B', 'RPL', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (22, 'Guru2', 'c4ca4238a0b923820dcc509a6f75849b', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (23, 'Guru3', 'c4ca4238a0b923820dcc509a6f75849b', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (24, 'Kesiswaan', 'c4ca4238a0b923820dcc509a6f75849b', 'Kesiswaan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (25, 'Pembimbing', 'c4ca4238a0b923820dcc509a6f75849b', 'Pembimbing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 327 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `user_activity` VALUES (289, 10, 'Menghapus Lokasi', NULL, '2024-09-03 15:53:02', '2024-09-03 15:53:02');
INSERT INTO `user_activity` VALUES (290, 10, 'Menyimpan Lokasi', NULL, '2024-09-03 15:59:08', '2024-09-03 15:59:08');
INSERT INTO `user_activity` VALUES (291, 1, 'Menerima PKL Murid', NULL, '2024-09-11 11:51:21', '2024-09-11 11:51:21');
INSERT INTO `user_activity` VALUES (292, 10, 'Mengedit Data PT', NULL, '2024-09-18 08:29:15', '2024-09-18 08:29:15');
INSERT INTO `user_activity` VALUES (293, 10, 'Menambah Agenda Harian PT', NULL, '2024-09-18 13:08:51', '2024-09-18 13:08:51');
INSERT INTO `user_activity` VALUES (294, 10, 'Melihat Surat PDF', NULL, '2024-09-19 20:51:47', '2024-09-19 20:51:47');
INSERT INTO `user_activity` VALUES (295, 10, 'Mengedit Agenda Harian PT', NULL, '2024-09-20 20:17:58', '2024-09-20 20:17:58');
INSERT INTO `user_activity` VALUES (296, 2, 'Masuk ke Dashboard', NULL, '2024-09-20 20:18:16', '2024-09-20 20:18:16');
INSERT INTO `user_activity` VALUES (297, 1, 'Menyetujui Agenda', NULL, '2024-09-21 19:24:48', '2024-09-21 19:24:48');
INSERT INTO `user_activity` VALUES (298, 1, 'Tidak Menyetujui Agenda', NULL, '2024-09-21 20:07:25', '2024-09-21 20:07:25');
INSERT INTO `user_activity` VALUES (299, 12, 'Masuk ke Dashboard', NULL, '2024-09-21 22:54:44', '2024-09-21 22:54:44');
INSERT INTO `user_activity` VALUES (300, 4, 'Masuk ke Dashboard', NULL, '2024-09-21 22:55:20', '2024-09-21 22:55:20');
INSERT INTO `user_activity` VALUES (301, 4, 'Masuk ke profile', NULL, '2024-09-21 22:56:32', '2024-09-21 22:56:32');
INSERT INTO `user_activity` VALUES (302, 4, 'Masuk ke Data Alamat PKL', NULL, '2024-09-21 23:08:39', '2024-09-21 23:08:39');
INSERT INTO `user_activity` VALUES (303, 4, 'Menerima PKL Murid', NULL, '2024-09-21 23:09:06', '2024-09-21 23:09:06');
INSERT INTO `user_activity` VALUES (304, 25, 'Menyetujui Agenda', NULL, '2024-09-21 23:35:40', '2024-09-21 23:35:40');
INSERT INTO `user_activity` VALUES (305, 12, 'Menyetujui Agenda', NULL, '2024-09-21 23:35:56', '2024-09-21 23:35:56');
INSERT INTO `user_activity` VALUES (306, 1, 'Masuk ke Permissions', NULL, '2024-09-21 23:44:19', '2024-09-21 23:44:19');
INSERT INTO `user_activity` VALUES (307, 1, 'Masuk ke Hak Akses', NULL, '2024-09-21 23:44:24', '2024-09-21 23:44:24');
INSERT INTO `user_activity` VALUES (308, 1, 'Mengupdate Hak Akses', NULL, '2024-09-21 23:45:01', '2024-09-21 23:45:01');
INSERT INTO `user_activity` VALUES (309, 25, 'Masuk ke Dashboard', NULL, '2024-09-21 23:45:33', '2024-09-21 23:45:33');
INSERT INTO `user_activity` VALUES (310, 25, 'Masuk ke Pemilihan Murid', NULL, '2024-09-21 23:47:28', '2024-09-21 23:47:28');
INSERT INTO `user_activity` VALUES (311, 25, 'Masuk ke Agenda Murid', NULL, '2024-09-21 23:47:32', '2024-09-21 23:47:32');
INSERT INTO `user_activity` VALUES (312, 24, 'Masuk ke Dashboard', NULL, '2024-09-21 23:48:31', '2024-09-21 23:48:31');
INSERT INTO `user_activity` VALUES (313, 24, 'Masuk ke Agenda', NULL, '2024-09-21 23:48:35', '2024-09-21 23:48:35');
INSERT INTO `user_activity` VALUES (314, 24, 'Masuk ke Data Alamat PKL', NULL, '2024-09-21 23:48:52', '2024-09-21 23:48:52');
INSERT INTO `user_activity` VALUES (315, 24, 'Masuk ke Pemilihan Pembimbing', NULL, '2024-09-21 23:48:57', '2024-09-21 23:48:57');
INSERT INTO `user_activity` VALUES (316, 1, 'Masuk ke Daftar Murid PKL', NULL, '2024-09-21 23:53:59', '2024-09-21 23:53:59');
INSERT INTO `user_activity` VALUES (317, 1, 'Masuk ke Agenda Murid', NULL, '2024-09-21 23:54:32', '2024-09-21 23:54:32');
INSERT INTO `user_activity` VALUES (318, 10, 'Masuk ke Agenda', NULL, '2024-09-22 00:05:50', '2024-09-22 00:05:50');
INSERT INTO `user_activity` VALUES (319, 4, 'Masuk ke Pemilihan Pembimbing', NULL, '2024-09-22 00:08:57', '2024-09-22 00:08:57');
INSERT INTO `user_activity` VALUES (320, 22, 'Masuk ke Dashboard', NULL, '2024-09-22 00:09:33', '2024-09-22 00:09:33');
INSERT INTO `user_activity` VALUES (321, 22, 'Masuk ke Daftar Murid Bimbingan', NULL, '2024-09-22 00:09:42', '2024-09-22 00:09:42');
INSERT INTO `user_activity` VALUES (322, 22, 'Masuk ke Agenda Murid', NULL, '2024-09-22 00:11:09', '2024-09-22 00:11:09');
INSERT INTO `user_activity` VALUES (323, 25, 'Menambah Agenda Harian PT', NULL, '2024-09-22 00:14:27', '2024-09-22 00:14:27');
INSERT INTO `user_activity` VALUES (324, 25, 'Mengedit Agenda Harian PT', NULL, '2024-09-22 00:14:27', '2024-09-22 00:14:27');
INSERT INTO `user_activity` VALUES (325, 12, 'Masuk ke Daftar Murid Bimbingan', NULL, '2024-09-22 00:15:06', '2024-09-22 00:15:06');
INSERT INTO `user_activity` VALUES (326, 12, 'Masuk ke Agenda Murid', NULL, '2024-09-22 00:15:11', '2024-09-22 00:15:11');

SET FOREIGN_KEY_CHECKS = 1;
