/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : dingdan

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2017-06-08 13:31:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_banben
-- ----------------------------
DROP TABLE IF EXISTS `tp_banben`;
CREATE TABLE `tp_banben` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '版本id',
  `name` varchar(20) NOT NULL COMMENT '版本名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_banben
-- ----------------------------
INSERT INTO `tp_banben` VALUES ('1', '微盟旺铺-SDP');
INSERT INTO `tp_banben` VALUES ('2', '微盟旺铺-微众销');
INSERT INTO `tp_banben` VALUES ('3', '黄金版');
INSERT INTO `tp_banben` VALUES ('4', '增强版');
INSERT INTO `tp_banben` VALUES ('5', '至尊版');
INSERT INTO `tp_banben` VALUES ('6', '客来店');
INSERT INTO `tp_banben` VALUES ('7', '微房产');
INSERT INTO `tp_banben` VALUES ('8', '微酒店');
INSERT INTO `tp_banben` VALUES ('9', '微汽车');
INSERT INTO `tp_banben` VALUES ('10', '微生活');
INSERT INTO `tp_banben` VALUES ('11', '微餐饮');
INSERT INTO `tp_banben` VALUES ('12', '微医疗');
INSERT INTO `tp_banben` VALUES ('13', '智慧餐厅-多店版');
INSERT INTO `tp_banben` VALUES ('14', '智慧餐厅-单店版');

-- ----------------------------
-- Table structure for tp_dept
-- ----------------------------
DROP TABLE IF EXISTS `tp_dept`;
CREATE TABLE `tp_dept` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `bumenming` varchar(20) NOT NULL DEFAULT '' COMMENT '部门名字',
  `jingli` varchar(20) NOT NULL DEFAULT '' COMMENT '部门经理',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_dept
-- ----------------------------
INSERT INTO `tp_dept` VALUES ('1', '移动电商一部', '梁新');
INSERT INTO `tp_dept` VALUES ('2', '移动电商二部', '牛娜娜');
INSERT INTO `tp_dept` VALUES ('3', '移动电商三部', '吕晓蕾');
INSERT INTO `tp_dept` VALUES ('4', '新媒体一部', '王凯');
INSERT INTO `tp_dept` VALUES ('5', '智慧门店一部', '黄尊可');

-- ----------------------------
-- Table structure for tp_hetong
-- ----------------------------
DROP TABLE IF EXISTS `tp_hetong`;
CREATE TABLE `tp_hetong` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品申请表id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `qid` int(11) NOT NULL COMMENT '企业id',
  `bianhao` varchar(20) NOT NULL COMMENT '合同编号',
  `date` int(20) NOT NULL DEFAULT '0',
  `money` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '合同金额',
  `realmomey` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `shenqingren` varchar(10) NOT NULL COMMENT '申请人',
  `banben` varchar(10) NOT NULL COMMENT '申请版本',
  `nianxian` varchar(10) NOT NULL COMMENT '开通年限',
  `daiyunyingdate` varchar(10) NOT NULL COMMENT '代运营周期',
  `dept` varchar(20) NOT NULL COMMENT '部门',
  `jingli` varchar(10) NOT NULL COMMENT '经理',
  `laiyuan` varchar(10) NOT NULL DEFAULT '1' COMMENT '客户来源1在线咨询2在线注册3个人开发',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '合同申请时间',
  `updatetime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='产品开通申请表';

-- ----------------------------
-- Records of tp_hetong
-- ----------------------------
INSERT INTO `tp_hetong` VALUES ('43', '1', '49', '454679', '1490457600', '66655.00', '6555.00', '激光', '微盟旺铺-微众销', '1年', '1年', '新媒体一部', '牛娜娜', '2', '1490341955', '0');
INSERT INTO `tp_hetong` VALUES ('44', '1', '50', '1234546', '1490371200', '1234.00', '1234.00', '记起', '微盟旺铺-微众销', '2年', '2年', '移动电商二部', '牛娜娜', '1', '1490342659', '0');

-- ----------------------------
-- Table structure for tp_qiye
-- ----------------------------
DROP TABLE IF EXISTS `tp_qiye`;
CREATE TABLE `tp_qiye` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `qname` varchar(50) NOT NULL DEFAULT '' COMMENT '企业名称',
  `qaddr` varchar(200) NOT NULL DEFAULT '' COMMENT '企业地址',
  `faren` varchar(20) NOT NULL COMMENT '企业法人姓名',
  `yunying` varchar(20) NOT NULL COMMENT '运营人',
  `farentel` char(11) NOT NULL COMMENT '法人手机号',
  `yunyingtel` char(11) NOT NULL COMMENT '运营人手机号',
  `weimeng` varchar(50) NOT NULL COMMENT '微盟用户名',
  `weimengpwd` varchar(50) NOT NULL COMMENT '微盟密码',
  `qq` varchar(50) NOT NULL COMMENT 'qq',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `wechat` varchar(50) NOT NULL COMMENT '公众号',
  `wechatpwd` varchar(30) NOT NULL COMMENT '微信密码',
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1提单2开通',
  `leibie` varchar(10) NOT NULL DEFAULT '1' COMMENT '1新开2版本升级3续费',
  `detail` text NOT NULL COMMENT '客户特殊需求',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qiye
-- ----------------------------
INSERT INTO `tp_qiye` VALUES ('49', '1', '哦哦哦了', '墨迹了', '投简历', '16454', '13456251648', '13513425769', '664619', '6666666', '66666', '6666@qq.com', 'sjsjs', 'sjsjd', '1', '2', '浓郁');
INSERT INTO `tp_qiye` VALUES ('50', '1', '微盟', 'qgd294', 'jsjs', 'nnnbb', '18764521364', '18612345769', '4648', '64846', '161815', '1642@qq.com', 'snxbs', 'horn', '2', '2', '');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `xingming` varchar(20) NOT NULL DEFAULT '' COMMENT '用户姓名',
  `uname` varchar(20) NOT NULL DEFAULT '' COMMENT '登录用户名',
  `upwd` varchar(20) NOT NULL COMMENT '用户密码',
  `utype` tinyint(2) NOT NULL DEFAULT '2' COMMENT '用户类型2普通用户1超级管理员',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `token` varchar(100) NOT NULL DEFAULT '' COMMENT '验证用户token',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', '', 'admin', '123456', '1', '0', '1490340756');
INSERT INTO `tp_user` VALUES ('10', '李广岳', 'liguangyue', '123456', '2', '1489630509', '1490229309');
