/*
Navicat MySQL Data Transfer

Source Server         : mysql_face
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : zofrapat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-02-12 15:51:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dosificaciones`
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
INSERT INTO `dosificaciones` VALUES ('1', '239404600000102', 'ccM)I\\]N9EiEB%ABB=8CrL7)FKa(Q9#E54I7eZbJGIN963zFYWWK*+@JES)EUQd[', '2016-01-29', '2016-07-27', '6', '0000-00-00 00:00:00', '2016-02-05 13:19:56');

-- ----------------------------
-- Table structure for `facturas`
-- ----------------------------
DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `autorizacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `fecha` date NOT NULL,
  `factura` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `monto` bigint(30) DEFAULT NULL,
  `control` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of facturas
-- ----------------------------
INSERT INTO `facturas` VALUES ('103', 'ccM)I\\]N9EiEB%ABB=8CrL7)FKa(Q9#E54I7eZbJGIN963zFYWWK*+@JES)EUQd[', '239404600000102', '2016-07-27', '2016-02-11', '1', '33851456013', '1500', '14-DA-91-B8-C7', null, null, '2016-02-11 15:41:28', '2016-02-11 15:41:28');
INSERT INTO `facturas` VALUES ('104', 'ccM)I\\]N9EiEB%ABB=8CrL7)FKa(Q9#E54I7eZbJGIN963zFYWWK*+@JES)EUQd[', '239404600000102', '2016-07-27', '2016-02-11', '2', '33851456013', '15000', '3A-E0-D5-DF', 'faguilar', null, '2016-02-11 15:42:55', '2016-02-11 15:42:55');
INSERT INTO `facturas` VALUES ('105', 'ccM)I\\]N9EiEB%ABB=8CrL7)FKa(Q9#E54I7eZbJGIN963zFYWWK*+@JES)EUQd[', '239404600000102', '2016-07-27', '2016-02-11', '22', '3363812015', '1242', '72-B0-09-B4-15', null, null, '2016-02-11 20:18:20', '2016-02-11 20:18:20');
