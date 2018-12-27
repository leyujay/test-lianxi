/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-07 22:06:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `truename` varchar(20) NOT NULL COMMENT '真实姓名',
  `gid` int(10) NOT NULL COMMENT '角色id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'admin', 'a66abb5684c45962d887564f08346e8d', '张三丰', '1', '0', '1515650649');
INSERT INTO `admins` VALUES ('2', 'test', 'a66abb5684c45962d887564f08346e8d', 'tests', '1', '1', '0');

-- ----------------------------
-- Table structure for admin_groups
-- ----------------------------
DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups` (
  `gid` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `title` varchar(20) NOT NULL COMMENT '角色名称',
  `rights` text NOT NULL COMMENT '角色权限，json',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_groups
-- ----------------------------
INSERT INTO `admin_groups` VALUES ('1', '系统管理员', '[1,4,7,5,6,2,8,9,10,11,12,30,3,13,14,15,16,17,19,20,21,22,23,29,24,25,26,27,28]');
INSERT INTO `admin_groups` VALUES ('2', '开发人员', '[1,4,7,5,6,2,8,9,10,11,12,3,27,28]');

-- ----------------------------
-- Table structure for admin_menus
-- ----------------------------
DROP TABLE IF EXISTS `admin_menus`;
CREATE TABLE `admin_menus` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '上级菜单',
  `ord` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `title` varchar(20) NOT NULL,
  `controller` varchar(30) NOT NULL COMMENT '控制器名称',
  `method` varchar(30) NOT NULL COMMENT '菜单名称',
  `ishidden` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否隐藏：0正常显示，1隐藏',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_menus
-- ----------------------------
INSERT INTO `admin_menus` VALUES ('1', '0', '0', '管理员管理', '', '', '0', '0');
INSERT INTO `admin_menus` VALUES ('2', '0', '0', '权限管理', '', '', '0', '0');
INSERT INTO `admin_menus` VALUES ('3', '0', '0', '系统设置', '', '', '0', '0');
INSERT INTO `admin_menus` VALUES ('4', '1', '0', '管理员列表', 'Admin', 'index', '0', '0');
INSERT INTO `admin_menus` VALUES ('5', '1', '0', '管理员添加', 'Admin', 'add', '1', '0');
INSERT INTO `admin_menus` VALUES ('6', '1', '0', '管理员保存', 'Admin', 'save', '1', '0');
INSERT INTO `admin_menus` VALUES ('7', '4', '0', '角色测试', 'Admin', 'tests', '0', '0');
INSERT INTO `admin_menus` VALUES ('8', '2', '0', '菜单管理', 'Menu', 'index', '0', '0');
INSERT INTO `admin_menus` VALUES ('9', '2', '0', '菜单添加', 'Menu', 'add', '1', '0');
INSERT INTO `admin_menus` VALUES ('10', '2', '0', '菜单保存', 'Menu', 'save', '1', '0');
INSERT INTO `admin_menus` VALUES ('11', '2', '0', '角色管理', 'Roles', 'index', '0', '0');
INSERT INTO `admin_menus` VALUES ('12', '2', '0', '角色保存', 'Roles', 'save', '1', '0');
INSERT INTO `admin_menus` VALUES ('13', '3', '0', '网站设置', 'Site', 'index', '0', '0');
INSERT INTO `admin_menus` VALUES ('14', '3', '0', '保存设置', 'Site', 'save', '1', '0');
INSERT INTO `admin_menus` VALUES ('15', '0', '0', '商品分类', '', '', '0', '0');
INSERT INTO `admin_menus` VALUES ('16', '15', '0', '分类列表', 'Cates', 'index', '0', '0');
INSERT INTO `admin_menus` VALUES ('17', '15', '0', '分类保存', 'Cates', 'save', '1', '0');
INSERT INTO `admin_menus` VALUES ('19', '0', '0', '产品管理', '', '', '0', '0');
INSERT INTO `admin_menus` VALUES ('20', '19', '0', '产品列表', 'Product', 'index', '0', '0');
INSERT INTO `admin_menus` VALUES ('21', '19', '0', '添加产品', 'Product', 'add', '1', '0');
INSERT INTO `admin_menus` VALUES ('22', '19', '0', '保存产品', 'Product', 'save', '1', '0');
INSERT INTO `admin_menus` VALUES ('23', '19', '0', '图片上传', 'Product', 'upload_img', '1', '0');
INSERT INTO `admin_menus` VALUES ('24', '0', '0', '幻灯片管理', '', '', '0', '0');
INSERT INTO `admin_menus` VALUES ('25', '24', '0', '首页首屏', 'Slide', 'index', '0', '0');
INSERT INTO `admin_menus` VALUES ('26', '24', '0', '幻灯片保存', 'Slide', 'save', '1', '0');
INSERT INTO `admin_menus` VALUES ('27', '0', '0', '主页', 'Home', 'index', '1', '0');
INSERT INTO `admin_menus` VALUES ('28', '27', '0', '欢迎', 'Home', 'welcome', '1', '0');
INSERT INTO `admin_menus` VALUES ('29', '19', '0', '获取sku', 'Product', 'get_sku_view', '1', '0');
INSERT INTO `admin_menus` VALUES ('30', '2', '0', '角色添加', 'Roles', 'add', '1', '0');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '用户uid',
  `product_id` int(10) NOT NULL COMMENT '商品id',
  `sku_id` int(10) NOT NULL COMMENT '规格',
  `count` int(10) NOT NULL COMMENT '数量',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='购物车';

-- ----------------------------
-- Records of cart
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20) NOT NULL COMMENT '订单号',
  `uid` int(10) NOT NULL COMMENT '用户uid',
  `money` decimal(10,2) NOT NULL COMMENT '订单金额',
  `pay_money` decimal(10,2) NOT NULL COMMENT '实际支付金额',
  `ship_no` varchar(20) NOT NULL COMMENT '快递单号',
  `ship_status` tinyint(1) NOT NULL COMMENT '快递状态：0未发货，1已发货，2已签收',
  `ship_time` int(10) NOT NULL COMMENT '发货时间',
  `status` int(1) NOT NULL COMMENT '订单状态：-1未支付已关闭，0未付款，1已付款，2已完成',
  `add_time` int(10) NOT NULL COMMENT '订单生成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('10', '15270462950001521642', '1', '148.00', '148.00', '', '0', '0', '1', '1527046295');
INSERT INTO `orders` VALUES ('13', '15271454960001171922', '1', '8088.00', '8088.00', '', '0', '0', '1', '1527145496');
INSERT INTO `orders` VALUES ('14', '15282855790001500701', '1', '60.00', '60.00', '', '0', '0', '1', '1528285579');
INSERT INTO `orders` VALUES ('15', '15282870960001426933', '1', '88.00', '88.00', '', '0', '0', '1', '1528287096');

-- ----------------------------
-- Table structure for order_product
-- ----------------------------
DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20) NOT NULL COMMENT '订单号',
  `product_id` int(10) NOT NULL COMMENT '商品id',
  `sku_id` int(10) NOT NULL COMMENT '规格id',
  `price` decimal(10,2) NOT NULL COMMENT '购买时价格',
  `count` int(10) NOT NULL COMMENT '购买数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_product
-- ----------------------------
INSERT INTO `order_product` VALUES ('4', '15270462950001521642', '4', '7', '88.00', '1');
INSERT INTO `order_product` VALUES ('5', '15270462950001521642', '4', '1', '60.00', '1');
INSERT INTO `order_product` VALUES ('6', '15271447660001298642', '14', '46', '8000.00', '1');
INSERT INTO `order_product` VALUES ('7', '15271447660001298642', '4', '7', '88.00', '1');
INSERT INTO `order_product` VALUES ('8', '15271453650001546740', '14', '46', '8000.00', '1');
INSERT INTO `order_product` VALUES ('9', '15271453650001546740', '4', '7', '88.00', '1');
INSERT INTO `order_product` VALUES ('10', '15271453650001546740', '4', '1', '60.00', '1');
INSERT INTO `order_product` VALUES ('11', '15271454960001171922', '14', '46', '8000.00', '1');
INSERT INTO `order_product` VALUES ('12', '15271454960001171922', '4', '7', '88.00', '1');
INSERT INTO `order_product` VALUES ('13', '15282855790001500701', '4', '1', '60.00', '1');
INSERT INTO `order_product` VALUES ('14', '15282870960001426933', '4', '7', '88.00', '1');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL COMMENT '分类',
  `title` varchar(100) NOT NULL COMMENT '商品名称',
  `pro_no` varchar(20) NOT NULL COMMENT '商品编码',
  `keywords` varchar(255) NOT NULL COMMENT '关键字',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `img` varchar(255) NOT NULL COMMENT '商品主图',
  `price` decimal(10,2) NOT NULL COMMENT '商品最低价格(SKU价格最低的产品）',
  `cost` decimal(10,2) NOT NULL COMMENT '成本（SKU价格最低的产品）',
  `pv` int(10) NOT NULL DEFAULT '0' COMMENT '点击量',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：-1已删除，0下架，1正常',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', '3', '小米MIX2 全面屏游戏手机 6GB+64GB 黑色 全网通4G手机 双卡双待', '27237152661230158766', '没阿斯蒂芬', '小米MIX2 全面屏游戏手机 6GB+64GB 黑色 全网通4G手机 双卡双待', 'https://img14.360buyimg.com/n2/jfs/t7423/194/3204708762/379719/b21a9fc1/59bb872eNf44497eb.jpg!q95.jpg', '2598.00', '0.00', '0', '1', '1523603960');
INSERT INTO `product` VALUES ('2', '2', '荣耀10 全面屏AI摄影手机 6GB+64GB 游戏手机 幻夜黑 全网通 移动联通电信4G 双卡双待', '32280152661230188044', 'sdfasfasdfasd', '荣耀10 全面屏AI摄影手机 6GB+64GB 游戏手机 幻夜黑 全网通 移动联通电信4G 双卡双待', 'https://img12.360buyimg.com/n2/jfs/t17149/173/1779654602/189601/335d3d90/5ad8628dN03dc292f.jpg!q95.jpg', '2599.00', '0.00', '0', '1', '1523604076');
INSERT INTO `product` VALUES ('4', '1', 'Apple iPhone X (A1865) 256GB 深空灰色 移动联通电信4G手机', '12936152661230190073', 'sdfasfasdfasd', 'Apple iPhone X (A1865) 256GB 深空灰色 移动联通电信4G手机', 'https://img13.360buyimg.com/n2/jfs/t19039/182/955626038/217833/5643db84/5ab35940N1951b759.jpg!q95.jpg', '8999.00', '55.00', '103', '1', '1523604076');
INSERT INTO `product` VALUES ('5', '4', '华为 HUAWEI P20 AI智慧全面屏 6GB +64GB 亮黑色 全网通版 移动联通电信4G手机 双卡双待', '25127152661230182274', '收到发生的发', '华为 HUAWEI P20 AI智慧全面屏 6GB +64GB 亮黑色 全网通版 移动联通电信4G手机 双卡双待', 'https://img10.360buyimg.com/n2/jfs/t17137/134/1253764714/149950/acf159b1/5ac1bf58Ndefaac16.jpg!q95.jpg', '3788.00', '0.00', '0', '1', '0');
INSERT INTO `product` VALUES ('6', '21', '三星 Galaxy S9+（SM-G9650/DS）6GB+128GB 谜夜黑 移动联通电信4G手机 双卡双待', '30681152661230156278', 'dfsdfsaf', '三星 Galaxy S9+（SM-G9650/DS）6GB+128GB 谜夜黑 移动联通电信4G手机 双卡双待', 'https://img10.360buyimg.com/n2/jfs/t15904/196/2090146134/131559/edd87f33/5a96a286N0958bd54.jpg!q95.jpg', '6999.00', '0.00', '0', '1', '0');
INSERT INTO `product` VALUES ('7', '3', '黑鲨 游戏手机 极夜黑 全网通 8GB+128GB', '17471152661230161192', 'asfasdfasdfasf', '黑鲨 游戏手机 极夜黑 全网通 8GB+128GB', 'https://img10.360buyimg.com/n2/jfs/t17566/80/1619400356/250158/9aa3778e/5ad1ac92N159ae118.jpg!q95.jpg', '4249.00', '0.00', '0', '1', '0');
INSERT INTO `product` VALUES ('14', '1', 'Apple iPhone 8 Plus 64GB 红色特别版 移动联通电信4G手机', '34159152714346459342', '在', '要', '/uploads/20180524\\13b7cee33f10bcdaeeb273f31e2600f5.jpg', '5000.00', '3000.00', '3', '1', '1527143464');

-- ----------------------------
-- Table structure for product_cates
-- ----------------------------
DROP TABLE IF EXISTS `product_cates`;
CREATE TABLE `product_cates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '上级分类id',
  `ord` int(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `title` varchar(50) NOT NULL COMMENT '标签标题',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0正常，1禁用',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='商品类目表';

-- ----------------------------
-- Records of product_cates
-- ----------------------------
INSERT INTO `product_cates` VALUES ('1', '0', '0', 'iphone', '0', '0');
INSERT INTO `product_cates` VALUES ('2', '0', '0', '荣耀', '0', '0');
INSERT INTO `product_cates` VALUES ('3', '0', '0', '小米', '0', '0');
INSERT INTO `product_cates` VALUES ('4', '0', '0', '华为', '0', '0');
INSERT INTO `product_cates` VALUES ('5', '0', '0', 'vivo', '0', '0');
INSERT INTO `product_cates` VALUES ('6', '0', '0', 'OPPO', '0', '0');
INSERT INTO `product_cates` VALUES ('21', '0', '0', '三星', '0', '0');

-- ----------------------------
-- Table structure for product_img
-- ----------------------------
DROP TABLE IF EXISTS `product_img`;
CREATE TABLE `product_img` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL COMMENT '商品id',
  `img` varchar(255) NOT NULL COMMENT '商品图片url',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_img
-- ----------------------------
INSERT INTO `product_img` VALUES ('1', '9', '/uploads/20180524\\03b25e8b76a9d76ec1f5507b6ce4d7a5.jpg', '1527133137');
INSERT INTO `product_img` VALUES ('2', '9', '/uploads/20180524\\85c8d71356d050fc463824f8fbcf46dd.jpg', '1527133137');
INSERT INTO `product_img` VALUES ('3', '9', '/uploads/20180524\\7cf202c649ce34b7b3e54c195ca9d773.jpg', '1527133137');
INSERT INTO `product_img` VALUES ('4', '9', '/uploads/20180524\\6f94b5dab6642feba8d513cd2b42673e.jpg', '1527133137');
INSERT INTO `product_img` VALUES ('5', '9', '/uploads/20180524\\c3ffa6d1c8a5affdebe099a07e0233ce.jpg', '1527133137');
INSERT INTO `product_img` VALUES ('14', '13', '/uploads/20180524\\8815ac032be3ac3c6d1541f1c7e4778a.jpg', '1527142516');
INSERT INTO `product_img` VALUES ('15', '13', '/uploads/20180524\\6de09746f5a1541b9718262a47d07209.jpg', '1527142516');
INSERT INTO `product_img` VALUES ('16', '14', '/uploads/20180524\\13b7cee33f10bcdaeeb273f31e2600f5.jpg', '1527143464');
INSERT INTO `product_img` VALUES ('17', '14', '/uploads/20180524\\9d75f025f4e47def94507773933b4cce.jpg', '1527143464');
INSERT INTO `product_img` VALUES ('18', '14', '/uploads/20180524\\d03eb8c8d6dc913f1073b024559d0006.jpg', '1527143464');
INSERT INTO `product_img` VALUES ('19', '14', '/uploads/20180524\\3ff7e43272138d0bc4566009eda20a17.jpg', '1527143464');
INSERT INTO `product_img` VALUES ('20', '14', '/uploads/20180524\\b5a229efc50925be4e90d2f1a6138c90.jpg', '1527143464');

-- ----------------------------
-- Table structure for product_sku
-- ----------------------------
DROP TABLE IF EXISTS `product_sku`;
CREATE TABLE `product_sku` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL COMMENT '商品id',
  `properties` text NOT NULL COMMENT '属性键值对：property_name:property_value',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `cost` decimal(10,2) NOT NULL COMMENT '成本',
  `stock` int(10) NOT NULL COMMENT '库存',
  `weight` int(10) NOT NULL COMMENT '重量：克',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_sku
-- ----------------------------
INSERT INTO `product_sku` VALUES ('1', '4', '8:27;9:28;10:29', '60.00', '50.00', '3', '0');
INSERT INTO `product_sku` VALUES ('2', '4', '8:27;9:28;10:30', '200.00', '180.00', '19', '0');
INSERT INTO `product_sku` VALUES ('3', '4', '8:27;9:31;10:29', '120.00', '100.00', '8', '0');
INSERT INTO `product_sku` VALUES ('4', '4', '8:27;9:31;10:30', '80.00', '50.00', '8', '0');
INSERT INTO `product_sku` VALUES ('5', '4', '8:32;9:28;10:29', '70.00', '50.00', '9', '0');
INSERT INTO `product_sku` VALUES ('6', '4', '8:32;9:28;10:30', '60.00', '45.00', '3', '0');
INSERT INTO `product_sku` VALUES ('7', '4', '8:32;9:31;10:29', '88.00', '50.00', '3', '0');
INSERT INTO `product_sku` VALUES ('8', '4', '8:32;9:31;10:30', '65.00', '30.00', '6', '0');
INSERT INTO `product_sku` VALUES ('43', '14', '1:58;3:59', '5000.00', '3000.00', '10', '0');
INSERT INTO `product_sku` VALUES ('44', '14', '1:58;3:60', '6000.00', '4000.00', '20', '0');
INSERT INTO `product_sku` VALUES ('45', '14', '1:61;3:59', '7000.00', '5000.00', '30', '0');
INSERT INTO `product_sku` VALUES ('46', '14', '1:61;3:60', '8000.00', '6000.00', '37', '0');

-- ----------------------------
-- Table structure for property
-- ----------------------------
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL COMMENT '商品id',
  `name_id` int(10) NOT NULL COMMENT '类目属性id（property_name表id）',
  `value_id` int(10) NOT NULL COMMENT '类目属性值id（property_value表id）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of property
-- ----------------------------
INSERT INTO `property` VALUES ('1', '4', '8', '27');
INSERT INTO `property` VALUES ('2', '4', '9', '28');
INSERT INTO `property` VALUES ('3', '4', '10', '29');
INSERT INTO `property` VALUES ('4', '4', '10', '30');
INSERT INTO `property` VALUES ('5', '4', '9', '31');
INSERT INTO `property` VALUES ('6', '4', '8', '32');
INSERT INTO `property` VALUES ('36', '14', '1', '58');
INSERT INTO `property` VALUES ('37', '14', '3', '59');
INSERT INTO `property` VALUES ('38', '14', '3', '60');
INSERT INTO `property` VALUES ('39', '14', '1', '61');

-- ----------------------------
-- Table structure for property_name
-- ----------------------------
DROP TABLE IF EXISTS `property_name`;
CREATE TABLE `property_name` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL COMMENT '所属类目id',
  `title` varchar(255) NOT NULL COMMENT '属性名',
  `is_sale` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否销售属性：0否，1是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of property_name
-- ----------------------------
INSERT INTO `property_name` VALUES ('1', '1', '颜色', '1');
INSERT INTO `property_name` VALUES ('2', '1', '版本', '1');
INSERT INTO `property_name` VALUES ('3', '1', '内存', '1');
INSERT INTO `property_name` VALUES ('4', '1', '购买方式', '0');
INSERT INTO `property_name` VALUES ('5', '1', '套装', '0');
INSERT INTO `property_name` VALUES ('6', '1', '增值保障', '0');
INSERT INTO `property_name` VALUES ('7', '1', '白条分期', '0');
INSERT INTO `property_name` VALUES ('8', '1', '重量', '1');
INSERT INTO `property_name` VALUES ('9', '1', '尺寸', '1');
INSERT INTO `property_name` VALUES ('10', '1', '大小', '1');

-- ----------------------------
-- Table structure for property_value
-- ----------------------------
DROP TABLE IF EXISTS `property_value`;
CREATE TABLE `property_value` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_id` int(10) NOT NULL COMMENT '属性名称id(property_name表id）',
  `value` varchar(255) NOT NULL COMMENT '属性值',
  `img` varchar(255) NOT NULL COMMENT '属性图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='SKU属性值';

-- ----------------------------
-- Records of property_value
-- ----------------------------
INSERT INTO `property_value` VALUES ('1', '1', '银色', 'http://www.php.shop/static/images/color1.jpg');
INSERT INTO `property_value` VALUES ('2', '1', '深空灰色', 'http://www.php.shop/static/images/color2.jpg');
INSERT INTO `property_value` VALUES ('3', '2', '公开版', '');
INSERT INTO `property_value` VALUES ('4', '2', '【原厂延保版】', '');
INSERT INTO `property_value` VALUES ('5', '2', '双网通版', '');
INSERT INTO `property_value` VALUES ('6', '2', '无线充套装', '');
INSERT INTO `property_value` VALUES ('7', '2', '蓝牙耳机套装', '');
INSERT INTO `property_value` VALUES ('8', '2', '年年换新', '');
INSERT INTO `property_value` VALUES ('9', '2', '原厂手机壳套装', '');
INSERT INTO `property_value` VALUES ('10', '3', '64GB', '');
INSERT INTO `property_value` VALUES ('11', '3', '256GB', '');
INSERT INTO `property_value` VALUES ('12', '4', '官方标配', '');
INSERT INTO `property_value` VALUES ('13', '4', '移动优惠购', '');
INSERT INTO `property_value` VALUES ('14', '4', '电信优惠购', '');
INSERT INTO `property_value` VALUES ('15', '4', '联通优惠购', '');
INSERT INTO `property_value` VALUES ('16', '5', '优惠套装1', '');
INSERT INTO `property_value` VALUES ('17', '5', '优惠套装2', '');
INSERT INTO `property_value` VALUES ('18', '5', '优惠套装3', '');
INSERT INTO `property_value` VALUES ('19', '6', '原厂保2年 ￥1688', '');
INSERT INTO `property_value` VALUES ('20', '6', '自营碎屏保 ￥399', '');
INSERT INTO `property_value` VALUES ('21', '6', '自营延长保 ￥279', '');
INSERT INTO `property_value` VALUES ('22', '7', '不分期', '');
INSERT INTO `property_value` VALUES ('23', '7', '￥3249.69起&times3期', '');
INSERT INTO `property_value` VALUES ('24', '7', '￥1648.86起&times6期', '');
INSERT INTO `property_value` VALUES ('25', '7', '￥848.44起&times12期', '');
INSERT INTO `property_value` VALUES ('26', '7', '￥448.23起&times24期', '');
INSERT INTO `property_value` VALUES ('27', '8', '100g', '');
INSERT INTO `property_value` VALUES ('28', '9', '2m', '');
INSERT INTO `property_value` VALUES ('29', '10', 'XL', '');
INSERT INTO `property_value` VALUES ('30', '10', 'L', '');
INSERT INTO `property_value` VALUES ('31', '9', '3m', '');
INSERT INTO `property_value` VALUES ('32', '8', '200g', '');
INSERT INTO `property_value` VALUES ('58', '1', '红色', '');
INSERT INTO `property_value` VALUES ('59', '3', '128G', '');
INSERT INTO `property_value` VALUES ('60', '3', '256G', '');
INSERT INTO `property_value` VALUES ('61', '1', '灰色', '');

-- ----------------------------
-- Table structure for sites
-- ----------------------------
DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `names` varchar(50) NOT NULL,
  `values` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sites
-- ----------------------------
INSERT INTO `sites` VALUES ('site', '\"JD\\u5546\\u57ce\"');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型：0首页首屏',
  `ord` tinyint(2) NOT NULL DEFAULT '0' COMMENT '排序',
  `title` varchar(30) NOT NULL COMMENT '标题',
  `url` varchar(255) NOT NULL COMMENT '链接地址',
  `img` varchar(255) NOT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES ('2', '0', '0', '卫斯理2：余文乐燃起科幻风云', 'http://sdfasdfasdfasdf', '/uploads/20180418\\ba6c4d18ff471b02f9be94c85e9844f0.jpg');
INSERT INTO `slide` VALUES ('3', '0', '0', '街舞剧情升级：陈伟霆送抱抱', 'http://asfasdfa', '/uploads/20180418\\c2f0d9773673ae71c3248584c007910e.jpg');
INSERT INTO `slide` VALUES ('4', '0', '0', '好久不见：杨子姗郑恺异国相逢', 'http://adfasfdad', '/uploads/20180418\\c614771b1d2266095d10fd99fe07d218.jpg');
INSERT INTO `slide` VALUES ('5', '0', '0', '远大前程：陈思诚回永鑫复仇', 'http://asfdasdfasdfadsfa', '/uploads/20180418\\921031b3296df12c3bd52148434806f4.jpg');
INSERT INTO `slide` VALUES ('6', '0', '0', '魔都风云：再现乱世上海滩', 'http://asdfasdfasdfasdf', '/uploads/20180418\\810896bf49b5be6204070a3c90c6da24.jpg');
INSERT INTO `slide` VALUES ('7', '0', '0', '破冰者：罗晋潘之琳为爱出击', 'http://asdfasdfasdfaf', '/uploads/20180418\\19b910ce06d1e6a542520d7a8d8d84c4.jpg');
INSERT INTO `slide` VALUES ('8', '0', '0', '护宝联盟：阿娇陈楚河相爱相杀', 'http://asdfasdfasdfdas', '/uploads/20180418\\d230c9f10fcc345b6e3af9d54180d506.jpg');
INSERT INTO `slide` VALUES ('9', '0', '0', '2018北影节影展:高分佳片纵览', 'http://asdfasdfasdfadsfads', '/uploads/20180418\\50cd38c2de3e1dd50125e1e3d8a38756.jpg');
INSERT INTO `slide` VALUES ('10', '0', '0', '吴晓波:《十年二十人》之徐小平', 'http://asfasfasfasdfasd', '/uploads/20180418\\39544c425299aab8241476508bb72008.jpg');
INSERT INTO `slide` VALUES ('11', '0', '0', '埃及秘密：千年木乃伊离奇复活', 'http://adsfadsfasdf', '/uploads/20180418\\704a16aadaf59117a83bfc1f2aea8d3a.jpg');

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `sku_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=311 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test
-- ----------------------------
INSERT INTO `test` VALUES ('290', '769', '66');
INSERT INTO `test` VALUES ('291', '909', '66');
INSERT INTO `test` VALUES ('292', '267', '66');
INSERT INTO `test` VALUES ('293', '772', '66');
INSERT INTO `test` VALUES ('294', '471', '66');
INSERT INTO `test` VALUES ('295', '358', '66');
INSERT INTO `test` VALUES ('296', '710', '66');
INSERT INTO `test` VALUES ('297', '334', '66');
INSERT INTO `test` VALUES ('298', '386', '66');
INSERT INTO `test` VALUES ('299', '905', '66');
INSERT INTO `test` VALUES ('300', '867', '66');
INSERT INTO `test` VALUES ('301', '231', '66');
INSERT INTO `test` VALUES ('302', '623', '66');
INSERT INTO `test` VALUES ('303', '527', '66');
INSERT INTO `test` VALUES ('304', '670', '66');
INSERT INTO `test` VALUES ('305', '128', '66');
INSERT INTO `test` VALUES ('306', '430', '66');
INSERT INTO `test` VALUES ('307', '854', '66');
INSERT INTO `test` VALUES ('308', '526', '66');
INSERT INTO `test` VALUES ('309', '800', '66');
INSERT INTO `test` VALUES ('310', '703', '66');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码：md5(username+pwd)',
  `add_time` int(10) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'test', '47ec2dd791e31e2ef2076caf64ed9b3d', '0');
