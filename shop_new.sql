-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2019-05-21 17:06:35
-- 服务器版本： 5.7.24
-- PHP 版本： 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `shop_address`
--

DROP TABLE IF EXISTS `shop_address`;
CREATE TABLE IF NOT EXISTS `shop_address` (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT '地址id',
  `user_id` int(255) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户id',
  `add_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '地址名',
  `phone` int(12) UNSIGNED NOT NULL COMMENT '手机号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='用户地址表';

-- --------------------------------------------------------

--
-- 表的结构 `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE IF NOT EXISTS `shop_order` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `order_num` int(255) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单号',
  `total_price` int(255) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单价格, 单位分',
  `address` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '收货地址',
  `user_id` int(255) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` int(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单状态: 0待审核, 1付款完成, 2等待退货, 3退货完成',
  `ordetime` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '下单时间',
  `phone` int(12) UNSIGNED NOT NULL DEFAULT '0' COMMENT '手机号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='订单表';

-- --------------------------------------------------------

--
-- 表的结构 `shop_order_data`
--

DROP TABLE IF EXISTS `shop_order_data`;
CREATE TABLE IF NOT EXISTS `shop_order_data` (
  `id` int(255) NOT NULL COMMENT '自增id',
  `order_id` int(255) NOT NULL DEFAULT '0' COMMENT '订单id',
  `product_id` int(255) NOT NULL COMMENT '商品id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='订单详情';

-- --------------------------------------------------------

--
-- 表的结构 `shop_prefer`
--

DROP TABLE IF EXISTS `shop_prefer`;
CREATE TABLE IF NOT EXISTS `shop_prefer` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `pro_id` int(255) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品id',
  `user_id` int(255) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='收藏表';

-- --------------------------------------------------------

--
-- 表的结构 `shop_product`
--

DROP TABLE IF EXISTS `shop_product`;
CREATE TABLE IF NOT EXISTS `shop_product` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `category_id` int(50) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类id',
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '商品名',
  `price` int(50) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品价格, 单位分',
  `sales` int(50) NOT NULL DEFAULT '0' COMMENT '销量',
  `description` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '商品描述',
  `brand` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '品牌',
  `model` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '型号',
  `category_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '分类名',
  `efficacy` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '功效',
  `size` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '规格',
  `ps` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '注意事项',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='商品表';

--
-- 转存表中的数据 `shop_product`
--

INSERT INTO `shop_product` (`id`, `category_id`, `name`, `price`, `sales`, `description`, `brand`, `model`, `category_name`, `efficacy`, `size`, `ps`) VALUES
(1, 1, '理肤泉B5多效修护霜100ml', 19800, 49062, '修护届的“神仙水”。理肤泉当家产品，海淘爆款。这款江湖了上流传已久的产品全新上市，为了让大家愉快的“挥霍”。这波大容量的设计诚意满满。', '理肤泉 (LA ROCHE-POSAY)', '100ml(702030467)；', '乳液', '保湿,修护肌肤,滋润,修护', '100ml', '因个人肤质不同，如有不适请立即停止使用。'),
(2, 1, 'G&M绵羊油维生素E面霜 250g', 3500, 11128, 'G&M绵羊油维生素E面霜 250g，到英国你不会错过the body shop，到美国你不会错过倩碧，到日本你无法错过资生堂，到澳洲你无法拒绝“G&M绵羊油”!夏去秋来，秋去冬来，换季糟心，皮肤干涩脱皮没形象，不敢伸手不敢露腿的日子真是受够了！开启肌肤水动力', 'G&M', '经典版，250g(702011001)；升级保湿新款，250g(702026236)；', '面霜', '保湿,修护肌肤,滋润,防冻裂', '250g', '因个人肤质不同，如有不适请立即停止使用。多款包装随机发！请放心购买！	由于产品版本不同，价格不同，介意者慎购！'),
(3, 2, '蜂胶蜂蜜+水光针剂面膜套装20片', 11900, 11128, '', '', '', '面膜', '保湿,修护肌肤,滋润,防冻裂', '20片', '因个人肤质不同，如有不适请立即停止使用。多款包装随机发！请放心购买！	由于产品版本不同，价格不同，介意者慎购！'),
(4, 2, 'RAY蚕丝面膜35g*10 片', 3500, 11128, '', '', '', '面膜', '保湿,修护肌肤,滋润,防冻裂', '35g*10 片', '因个人肤质不同，如有不适请立即停止使用。多款包装随机发！请放心购买！	由于产品版本不同，价格不同，介意者慎购！');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
