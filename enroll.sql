/*
Navicat MySQL Data Transfer

Source Server         : DKI New server
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : dkiuni

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2016-09-25 22:10:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for enroll
-- ----------------------------
DROP TABLE IF EXISTS `enroll`;
CREATE TABLE `enroll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_enroll` int(11) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `hak_akses` enum('1','2','3','4','5','0') DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT NULL,
  `card_id` varchar(20) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `perintah` varchar(50) DEFAULT NULL,
  `status` enum('Y','N','E') DEFAULT NULL,
  `ruang_id` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `temp_sidik_jari` text,
  `temp_wajah` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of enroll
-- ----------------------------
INSERT INTO `enroll` VALUES ('64', '53774748', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '1', '192.168.1.160', 'B', null, null);
INSERT INTO `enroll` VALUES ('65', '21914102', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '2', '192.168.1.168', 'B', null, null);
INSERT INTO `enroll` VALUES ('66', '53308373', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '3', '192.168.1.162', 'W', null, null);
INSERT INTO `enroll` VALUES ('67', '7704139', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '4', '192.168.1.163', 'W', null, null);
INSERT INTO `enroll` VALUES ('68', '70990358', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '5', '192.168.1.172', 'B', null, null);
INSERT INTO `enroll` VALUES ('69', '11552507', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '6', '192.168.1.171', 'B', null, null);
INSERT INTO `enroll` VALUES ('70', '17459574', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '7', '192.168.1.170', 'B', null, null);
INSERT INTO `enroll` VALUES ('71', '34367226', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '8', '192.168.1.173', 'B', null, null);
INSERT INTO `enroll` VALUES ('72', '71965241', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '10', '192.168.1.169', 'B', null, null);
INSERT INTO `enroll` VALUES ('73', '86029296', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '11', '192.168.1.161', 'W', null, null);
INSERT INTO `enroll` VALUES ('74', '55438159', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '12', '192.168.1.166', 'B', null, null);
INSERT INTO `enroll` VALUES ('75', '56759607', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '13', '192.168.1.165', 'B', null, null);
INSERT INTO `enroll` VALUES ('76', '66869418', 'admin', '123', '3', 'N', '0', 'admin', 'ambil_semua_user', 'Y', '14', '192.168.1.164', 'W', null, null);
