/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : face_laravel

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-03-14 15:50:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dosificaciones
-- ----------------------------
DROP TABLE IF EXISTS `dosificaciones`;
CREATE TABLE `dosificaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `autorizacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inicio` date NOT NULL,
  `vencimiento` date NOT NULL,
  `numero` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of dosificaciones
-- ----------------------------
INSERT INTO `dosificaciones` VALUES ('1', '29040011007', '9rCB7Sv4X29d)5k7N%3ab89p-3(5[A', '2015-01-01', '2015-12-31', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
