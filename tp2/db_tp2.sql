/*
 Navicat Premium Data Transfer

 Source Server         : mykoneksi
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : db_tp2

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 16/04/2022 01:36:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bidang_divisi
-- ----------------------------
DROP TABLE IF EXISTS `bidang_divisi`;
CREATE TABLE `bidang_divisi`  (
  `id_bidang` bigint NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_divisi` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id_bidang`) USING BTREE,
  INDEX `id_divisi`(`id_divisi` ASC) USING BTREE,
  CONSTRAINT `bidang_divisi_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 109 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bidang_divisi
-- ----------------------------
INSERT INTO `bidang_divisi` VALUES (100, 'Captain', 1);
INSERT INTO `bidang_divisi` VALUES (101, 'Member', 1);
INSERT INTO `bidang_divisi` VALUES (102, 'Captain', 2);
INSERT INTO `bidang_divisi` VALUES (103, 'Member', 3);

-- ----------------------------
-- Table structure for divisi
-- ----------------------------
DROP TABLE IF EXISTS `divisi`;
CREATE TABLE `divisi`  (
  `id_divisi` bigint NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_divisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of divisi
-- ----------------------------
INSERT INTO `divisi` VALUES (1, '1st Division');
INSERT INTO `divisi` VALUES (2, '3rd Division');
INSERT INTO `divisi` VALUES (3, 'Spies');

-- ----------------------------
-- Table structure for pengurus
-- ----------------------------
DROP TABLE IF EXISTS `pengurus`;
CREATE TABLE `pengurus`  (
  `id_pengurus` bigint NOT NULL AUTO_INCREMENT,
  `nim` bigint NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `semester` bigint NULL DEFAULT NULL,
  `id_bidang` bigint NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengurus`) USING BTREE,
  INDEX `id_bidang`(`id_bidang` ASC) USING BTREE,
  CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang_divisi` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 222 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengurus
-- ----------------------------
INSERT INTO `pengurus` VALUES (201, 1002, 'Kumanaku Seizou', 3, 101, 'img/orang13.webp');
INSERT INTO `pengurus` VALUES (202, 1003, 'Kamiyama', 3, 101, 'img/orang14.jpg');
INSERT INTO `pengurus` VALUES (203, 1004, 'Saitou Shimaru', 5, 102, 'img/orang15.jpg');
INSERT INTO `pengurus` VALUES (204, 1005, 'Yamazaki Sagaru', 5, 103, 'img/orang12.jpg');
INSERT INTO `pengurus` VALUES (209, 10004, 'Okita Sougo', 5, 100, 'img/orang11.jpg');

SET FOREIGN_KEY_CHECKS = 1;
