-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-12 06:44:10
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `guyou`
--

-- --------------------------------------------------------

--
-- 表的结构 `gg38_admin`
--

CREATE TABLE IF NOT EXISTS `gg38_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `admin_mobile` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `gg38_admin`
--

INSERT INTO `gg38_admin` (`admin_id`, `admin_name`, `admin_password`, `admin_mobile`, `admin_addtime`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', '13163062522', '2016-09-14 02:09:10');

-- --------------------------------------------------------

--
-- 表的结构 `gg38_adv`
--

CREATE TABLE IF NOT EXISTS `gg38_adv` (
  `adv_id` int(11) NOT NULL AUTO_INCREMENT,
  `advp_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `advp_des` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adv_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1可用广告位[默认]2广告(正常)3广告(停用)4广告位停用',
  `adv_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `advertiser_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `advertiser_mobile` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adv_start` datetime NOT NULL,
  `adv_end` datetime DEFAULT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  `advp_width` float DEFAULT NULL,
  `advp_height` float DEFAULT NULL,
  PRIMARY KEY (`adv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `gg38_adv`
--

INSERT INTO `gg38_adv` (`adv_id`, `advp_name`, `advp_des`, `adv_state`, `adv_img`, `advertiser_name`, `advertiser_mobile`, `adv_start`, `adv_end`, `flag`, `advp_width`, `advp_height`) VALUES
(1, '主页左侧大广告', '位于主页的左侧较大区域', 2, 'http://localhost/guyou/uploads/adv/adv_img_1.jpg', 'aa', 'aa', '2016-08-17 09:50:00', '2016-08-25 18:50:00', 1, 200, 607.133),
(2, '主页左侧小广告', '位于主页的左侧较小区域广告位', 2, 'http://localhost/guyou/uploads/adv/adv_img_2.png', 'jerr', '13163062528', '2016-08-17 05:25:00', '2016-08-03 05:30:00', 1, 200, 260.55),
(3, '主页右侧小广告', '位于主页的右侧较小区域广告位', 2, 'http://guyou.com/uploads/adv/adv_img_3.png', '杨再坤', '13163062522', '2016-08-28 14:55:00', '2016-08-31 22:55:00', 1, 200, 260.55),
(4, '主页右侧大广告', '位于主页的右侧较大区域', 2, '   http://localhost/guyou/uploads/adv/adv_img_4.jpg', '好广告主', '13163062524', '2016-08-28 06:40:00', '2016-08-31 09:45:00', 1, 200, 607.133);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_album`
--

CREATE TABLE IF NOT EXISTS `gg38_album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `album_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `album_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `album_islock` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1默认正常',
  `album_isshow` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1所有2好友3自己可见',
  `album_head` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'http://guyou.com/public/img/logo.png',
  `photo_count` int(11) NOT NULL DEFAULT '0',
  `album_addtime` datetime NOT NULL,
  `album_modtime` datetime NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `gg38_album`
--

INSERT INTO `gg38_album` (`album_id`, `user_id`, `album_name`, `album_desc`, `album_islock`, `album_isshow`, `album_head`, `photo_count`, `album_addtime`, `album_modtime`, `flag`) VALUES
(1, 7, 'aa', 'aa', 1, 2, '41', 0, '2016-09-11 18:58:45', '2016-09-11 18:58:45', 1),
(2, 7, '我的相册', '好相册哦', 1, 1, '71', 0, '2016-09-11 18:59:19', '2016-09-11 18:59:19', 1),
(3, 7, '一个老相册', '哈哈哈哈哈哈', 1, 3, '43', 0, '2016-09-11 19:03:12', '2016-09-11 19:03:12', 1),
(4, 7, '呵呵哈哈哈', '哈哈哈哈', 1, 1, '70', 0, '2016-09-11 19:03:49', '2016-09-11 19:03:49', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_at`
--

CREATE TABLE IF NOT EXISTS `gg38_at` (
  `at_id` int(11) NOT NULL AUTO_INCREMENT,
  `at_type` tinyint(1) NOT NULL COMMENT '1说说,2评论',
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT '说说或者评论id',
  PRIMARY KEY (`at_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gg38_bank`
--

CREATE TABLE IF NOT EXISTS `gg38_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bank_addtime` datetime NOT NULL,
  PRIMARY KEY (`bank_id`),
  UNIQUE KEY `bank_id` (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `gg38_bank`
--

INSERT INTO `gg38_bank` (`bank_id`, `user_id`, `bank_name`, `bank_no`, `bank_user_name`, `bank_addtime`) VALUES
(1, 7, '建设银行', '6228480402564890018', '杨再坤', '2016-09-10 06:38:55'),
(2, 7, '建设银行', '6228480402564890018', '杨再坤', '2016-09-10 06:38:55');

-- --------------------------------------------------------

--
-- 表的结构 `gg38_bill`
--

CREATE TABLE IF NOT EXISTS `gg38_bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_type` tinyint(1) NOT NULL,
  `bill_currency` tinyint(1) NOT NULL,
  `transfer_frome_user_id` int(11) NOT NULL,
  `bill_amount` float NOT NULL,
  `bill_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_addtime` datetime NOT NULL,
  `transfer_to_user_id` int(11) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `gg38_bill`
--

INSERT INTO `gg38_bill` (`bill_id`, `bill_type`, `bill_currency`, `transfer_frome_user_id`, `bill_amount`, `bill_remark`, `bill_addtime`, `transfer_to_user_id`) VALUES
(1, 1, 2, 1, 200.56, '昵称：jerr,手机：13163062512于2016-09-21 04:20:23，充值200.56钻石成功', '2016-09-21 04:20:23', 0),
(2, 1, 2, 1, 100.56, '昵称：jerr,手机：13163062512于2016-09-21 04:20:23，充值100.56钻石成功', '2016-09-21 04:20:23', 0),
(3, 1, 2, 1, 300.82, '昵称：jerr,手机：13163062512于2016-09-10 03:44:18，充值300.82钻石成功', '2016-09-10 03:44:18', 0),
(4, 1, 2, 1, 320.16, '昵称：jerr,手机：13163062512于2016-09-10 03:49:05，充值320.16钻石成功', '2016-09-10 03:49:05', 0),
(5, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(6, 1, 2, 7, 100.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:17，充值100.13钻石成功', '2016-09-10 03:51:17', 0),
(7, 1, 2, 1, 100.59, '昵称：jerr,手机：13163062512于2016-09-06 07:06:33，充值100.59钻石成功', '2016-09-06 07:06:33', 0),
(8, 1, 2, 1, 100.59, '昵称：jerr,手机：13163062512于2016-09-06 07:07:39，充值100.59钻石成功', '2016-09-06 07:07:39', 0),
(9, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(10, 1, 2, 7, 100.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:17，充值100.13钻石成功', '2016-09-10 03:51:17', 0),
(11, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(12, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(13, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(14, 1, 2, 7, 100.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:17，充值100.13钻石成功', '2016-09-10 03:51:17', 0),
(15, 1, 2, 7, 100.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:17，充值100.13钻石成功', '2016-09-10 03:51:17', 0),
(16, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(17, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(18, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(19, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(20, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0),
(21, 1, 2, 7, 111.13, '昵称：jerr,手机：13163062522于2016-09-10 03:51:24，充值111.13钻石成功', '2016-09-10 03:51:24', 0);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_blog`
--

CREATE TABLE IF NOT EXISTS `gg38_blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_content` text COLLATE utf8_unicode_ci,
  `blog_clicks` bigint(20) NOT NULL DEFAULT '0' COMMENT '阅读次数',
  `blog_comment_clicks` int(10) NOT NULL DEFAULT '0' COMMENT '评论次数',
  `blog_rank` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1[默认]所有人2好友3自己',
  `blog_islock` tinyint(1) NOT NULL DEFAULT '1' COMMENT '正常',
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  `blog_addtime` datetime DEFAULT NULL,
  `blog_state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `gg38_blog`
--

INSERT INTO `gg38_blog` (`blog_id`, `blog_type_id`, `user_id`, `blog_title`, `blog_content`, `blog_clicks`, `blog_comment_clicks`, `blog_rank`, `blog_islock`, `flag`, `blog_addtime`, `blog_state`) VALUES
(1, 0, 1, 'aaa', '&lt;p&gt;开始写日志吧&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 03:39:55', 1),
(2, 0, 1, 'aaa', '&lt;p&gt;开始写日志吧&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 03:40:00', 1),
(3, 0, 7, '一篇老日志', '&lt;p&gt;开始啊发发&lt;img src=&quot;/ueditor/php/upload/image/20160907/1473263249127602.jpg&quot; title=&quot;1473263249127602.jpg&quot; alt=&quot;redpacket.jpg&quot;&gt;写日志吧&lt;/p&gt;', 0, 0, 4, 1, 1, '2016-09-07 05:47:37', 1),
(4, 0, 7, '一篇老日志', '&lt;p&gt;开始啊发发&lt;img src=&quot;/ueditor/php/upload/image/20160907/1473263249127602.jpg&quot; title=&quot;1473263249127602.jpg&quot; alt=&quot;redpacket.jpg&quot;&gt;写日志吧&lt;/p&gt;', 0, 0, 4, 1, 1, '2016-09-07 05:51:04', 1),
(5, 5, 7, '一篇老日志', '&lt;p&gt;开始啊发发&lt;img src=&quot;/ueditor/php/upload/image/20160907/1473263249127602.jpg&quot; title=&quot;1473263249127602.jpg&quot; alt=&quot;redpacket.jpg&quot;&gt;写日志吧&lt;/p&gt;', 0, 0, 4, 1, 1, '2016-09-07 05:51:26', 1),
(6, 5, 7, '一篇老日志', '&lt;p&gt;开始啊发发&lt;img src=&quot;/ueditor/php/upload/image/20160907/1473263249127602.jpg&quot; title=&quot;1473263249127602.jpg&quot; alt=&quot;redpacket.jpg&quot;&gt;写日志吧&lt;/p&gt;', 0, 0, 4, 1, 1, '2016-09-07 05:52:50', 1),
(7, 7, 7, '阿斯顿发生', '&lt;p&gt;开始写日志吧反反复复&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:13:38', 1),
(8, 8, 7, '阿斯顿发生', '&lt;p&gt;开始写日志吧反反复复&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:13:44', 1),
(9, 5, 7, '是是是是', '&lt;p&gt;开始写日志吧反反复复&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:13:50', 1),
(10, 5, 7, '是是是是23', '&lt;p&gt;开始写日志吧反反复复&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:13:53', 1),
(11, 6, 7, '是是是是2344', '&lt;p&gt;开始写日志吧反反复复&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:13:57', 1),
(12, 6, 7, '是是是是2344', '&lt;p&gt;开始写日志吧反反复复&lt;img alt=&quot;point1.png&quot; src=&quot;/ueditor/php/upload/image/20160908/1473264843648359.png&quot; title=&quot;1473264843648359.png&quot;&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:14:05', 1),
(13, 6, 7, '是是是是2344', '&lt;p&gt;开始写日志吧反反复复&lt;img alt=&quot;point1.png&quot; src=&quot;/ueditor/php/upload/image/20160908/1473264843648359.png&quot; title=&quot;1473264843648359.png&quot;&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:14:07', 1),
(14, 7, 7, '阿发斯蒂芬', '&lt;p&gt;开始写日志吧ffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:20:52', 1),
(15, 7, 7, '阿发斯蒂芬', '&lt;p&gt;开始写日志吧ffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:20:55', 1),
(16, 7, 7, '阿发斯蒂芬', '&lt;p&gt;开始写日志吧ffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 3, 1, 1, '2016-09-07 06:20:56', 1),
(17, 7, 7, '阿发斯蒂芬', '&lt;p&gt;开始写日志吧ffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-07 06:20:58', 1),
(18, 7, 7, '阿发斯蒂芬', '&lt;p&gt;开始写日志吧ffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 3, 1, 1, '2016-09-07 06:20:59', 1),
(19, 7, 7, 'aswwwwwwwwwwwww', '&lt;p&gt;ffffffffffff开始写日志吧fffffffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 3, 1, 1, '2016-09-11 11:36:25', 1),
(20, 7, 7, 'aaaswwwwwwwwwwwww', '&lt;p&gt;ffffffffffff开始写日志吧fffffffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 3, 1, 1, '2016-09-11 11:40:02', 1),
(21, 7, 7, 'ffffffffffff', '&lt;p&gt;ffffffffffff开始写日志吧fffffffffff&lt;br/&gt;&lt;/p&gt;', 0, 0, 1, 1, 1, '2016-09-11 11:40:27', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_blog_type`
--

CREATE TABLE IF NOT EXISTS `gg38_blog_type` (
  `blog_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blog_type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`blog_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `gg38_blog_type`
--

INSERT INTO `gg38_blog_type` (`blog_type_id`, `user_id`, `blog_type_name`) VALUES
(5, 7, 'aaa2'),
(6, 7, 'ffffff'),
(7, 7, 'fffffff'),
(8, 7, '反反复复'),
(9, 7, 'aaaaaa');

-- --------------------------------------------------------

--
-- 表的结构 `gg38_comment`
--

CREATE TABLE IF NOT EXISTS `gg38_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_comment_user_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comment_user_icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `app_type` tinyint(4) DEFAULT NULL COMMENT '1日志2相册3动态',
  `app_id` int(11) NOT NULL,
  `comment_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_addtime` datetime NOT NULL,
  `parent_comment_id` int(11) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gg38_config`
--

CREATE TABLE IF NOT EXISTS `gg38_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `field_code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `field_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_range_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `gg38_config`
--

INSERT INTO `gg38_config` (`config_id`, `parent_id`, `field_code`, `field_name`, `field_type`, `value_range_text`, `field_value`) VALUES
(1, NULL, 'bdrant', '钻石对B币换率', 'text', NULL, '0.1'),
(2, NULL, 'pointNum', '一个积分红包的积分数', 'text', NULL, '2002'),
(3, NULL, 'receiverBankNo', '银行卡号', 'text', NULL, '11233455125542'),
(4, NULL, 'receiver', '银行卡号', 'text', NULL, '菇友科技有限公司'),
(5, NULL, 'receiverBankName', '开户行', 'text', NULL, '中国建设银行'),
(6, NULL, 'alipayAccount', '支付宝账户', 'text', NULL, '2273716951@qq.com'),
(7, NULL, 'alipayQRCode', '支付宝二维码', 'text', NULL, 'http://guyou.com/uploads/alipayQRcode/alipayQRcode.png'),
(8, NULL, 'companyName', '公司名', 'text', NULL, '菇友科技有限公司'),
(9, NULL, 'firstAward', '一层邀请奖励', 'text', NULL, '3%'),
(10, NULL, 'secondAward', '二层邀请奖励', 'text', NULL, '2%'),
(11, NULL, 'thirdAward', '三层邀请奖励', 'text', NULL, '1%'),
(12, NULL, 'diamond', '钻石红包返回比例(格式必须为x:x)', 'text', NULL, '0.1'),
(13, NULL, 'point', '积分红包返回比例(格式必须为x:x)', 'text', NULL, '0.08');

-- --------------------------------------------------------

--
-- 表的结构 `gg38_friend`
--

CREATE TABLE IF NOT EXISTS `gg38_friend` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `fri_user_id` int(11) NOT NULL,
  `friend_group_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL,
  `friend_addtime` datetime NOT NULL,
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `gg38_friend`
--

INSERT INTO `gg38_friend` (`friend_id`, `fri_user_id`, `friend_group_id`, `friend_user_id`, `friend_addtime`) VALUES
(16, 7, 1, 5, '2016-09-12 05:41:23'),
(17, 5, 0, 7, '2016-09-12 05:41:23');

-- --------------------------------------------------------

--
-- 表的结构 `gg38_friend_apply`
--

CREATE TABLE IF NOT EXISTS `gg38_friend_apply` (
  `fri_apply_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `fri_apply_addtime` datetime NOT NULL,
  `fri_apply_state` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`fri_apply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `gg38_friend_apply`
--

INSERT INTO `gg38_friend_apply` (`fri_apply_id`, `from_user_id`, `to_user_id`, `fri_apply_addtime`, `fri_apply_state`) VALUES
(1, 7, 5, '2016-09-11 11:59:36', 3),
(2, 7, 5, '2016-09-11 11:59:56', 2),
(3, 7, 5, '2016-09-11 12:01:09', 1),
(4, 7, 5, '2016-09-11 12:01:32', 2),
(5, 7, 5, '2016-09-11 12:01:34', 2),
(6, 7, 5, '2016-09-11 12:01:53', 2),
(7, 7, 6, '2016-09-11 12:03:01', 1),
(8, 7, 6, '2016-09-11 12:03:06', 1),
(9, 7, 5, '2016-09-11 12:03:11', 2),
(10, 5, 7, '2016-09-11 12:04:15', 1),
(11, 5, 7, '2016-09-11 12:04:17', 2),
(12, 5, 7, '2016-09-11 12:04:18', 1),
(13, 5, 7, '2016-09-11 12:04:19', 2),
(14, 5, 7, '2016-09-11 12:04:21', 2),
(15, 5, 7, '2016-09-11 12:04:22', 2),
(16, 5, 1, '2016-09-11 12:04:23', 1),
(17, 5, 1, '2016-09-11 12:04:25', 1),
(18, 5, 5, '2016-09-11 13:35:10', 1),
(19, 5, 5, '2016-09-11 14:31:22', 1),
(20, 5, 6, '2016-09-11 14:31:23', 1),
(21, 7, 5, '2016-09-12 05:41:14', 1),
(22, 7, 6, '2016-09-12 05:41:16', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_friend_def_group`
--

CREATE TABLE IF NOT EXISTS `gg38_friend_def_group` (
  `friend_def_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_def_group_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`friend_def_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gg38_friend_group`
--

CREATE TABLE IF NOT EXISTS `gg38_friend_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_group_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `gg38_friend_group`
--

INSERT INTO `gg38_friend_group` (`group_id`, `friend_group_name`, `user_id`, `user_count`) VALUES
(1, '好朋友', 7, 0),
(3, '不好朋友', 7, 0),
(4, 'aaaa', 5, 0),
(5, 'ffff', 5, 0),
(6, '不是朋友', 7, 0);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_fri_tx`
--

CREATE TABLE IF NOT EXISTS `gg38_fri_tx` (
  `fri_tx_id` int(11) NOT NULL AUTO_INCREMENT,
  `fri_user_id` int(11) NOT NULL,
  `review_user_id` int(11) NOT NULL,
  `review_pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review_nick` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fri_tx_content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fri_tx_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-未读2-已读',
  `fri_tx_type` tinyint(1) DEFAULT NULL COMMENT '消息类型1-加好友2-评论',
  `fri_tx_addtime` datetime NOT NULL,
  PRIMARY KEY (`fri_tx_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `gg38_fri_tx`
--

INSERT INTO `gg38_fri_tx` (`fri_tx_id`, `fri_user_id`, `review_user_id`, `review_pic`, `review_nick`, `fri_tx_content`, `fri_tx_state`, `fri_tx_type`, `fri_tx_addtime`) VALUES
(1, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', ',你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(2, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(3, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(4, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(5, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(6, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(7, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(8, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(9, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(10, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(11, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(12, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(13, 7, 7, 'http://guyou.com/uploads/icon/redpacket.jpg', 'jerr', 'jerr,你的提现申请提交成功', 1, 3, '0000-00-00 00:00:00'),
(14, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(15, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(16, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(17, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(18, 6, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(19, 6, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(20, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(21, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(22, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(23, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(24, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(25, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(26, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(27, 1, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(28, 1, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(29, 5, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(30, 5, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(31, 6, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(32, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(33, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(34, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(35, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(36, 7, 0, 'http://guyou.com/public/img/vip_icon/user_icon.png', 'aaa', 'aaa,拒绝把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(37, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(38, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(39, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00'),
(40, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(41, 6, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,申请添加你为好友', 1, NULL, '0000-00-00 00:00:00'),
(42, 5, 0, 'http://guyou.com/uploads/icon/vip3.png', 'jerr', 'jerr,同意把你加为好友', 1, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `gg38_hi`
--

CREATE TABLE IF NOT EXISTS `gg38_hi` (
  `hi_id` int(11) NOT NULL AUTO_INCREMENT,
  `hi_from_user_id` int(11) NOT NULL,
  `hi_to_user_id` int(11) NOT NULL,
  `hi_content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hi__addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`hi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `gg38_hi`
--

INSERT INTO `gg38_hi` (`hi_id`, `hi_from_user_id`, `hi_to_user_id`, `hi_content`, `hi__addtime`) VALUES
(1, 5, 7, NULL, NULL),
(2, 5, 7, NULL, NULL),
(3, 5, 7, NULL, NULL),
(4, 5, 7, NULL, NULL),
(5, 5, 7, NULL, NULL),
(6, 7, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_photo`
--

CREATE TABLE IF NOT EXISTS `gg38_photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `photo_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_ishead` tinyint(1) DEFAULT '2' COMMENT '1是2否',
  `photo_islock` tinyint(1) DEFAULT '1' COMMENT '1默认正常',
  `photo_addtime` datetime DEFAULT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- 转存表中的数据 `gg38_photo`
--

INSERT INTO `gg38_photo` (`photo_id`, `album_id`, `user_id`, `photo_name`, `photo_path`, `photo_thumb`, `photo_desc`, `photo_ishead`, `photo_islock`, `photo_addtime`, `flag`) VALUES
(1, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/07.jpg', NULL, NULL, 2, 1, '2016-09-03 09:42:22', 1),
(2, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/17.jpg', NULL, NULL, 2, 1, '2016-09-03 09:42:22', 1),
(3, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/08.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb\\08.jpg', NULL, 2, 1, '2016-09-03 10:17:10', 1),
(4, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/18.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb\\18.jpg', NULL, 2, 1, '2016-09-03 10:17:10', 1),
(5, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/09.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb\\09.jpg', NULL, 2, 1, '2016-09-03 10:24:07', 1),
(6, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/19.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb\\19.jpg', NULL, 2, 1, '2016-09-03 10:24:07', 1),
(7, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/010.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/010.jpg', NULL, 2, 1, '2016-09-03 10:25:46', 1),
(8, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/110.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/110.jpg', NULL, 2, 1, '2016-09-03 10:25:46', 1),
(9, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/011.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/011.jpg', NULL, 2, 1, '2016-09-03 10:26:22', 1),
(10, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/111.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/111.jpg', NULL, 2, 1, '2016-09-03 10:26:22', 1),
(11, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/012.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/012.jpg', NULL, 2, 1, '2016-09-03 10:27:50', 1),
(12, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/112.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/112.jpg', NULL, 2, 1, '2016-09-03 10:27:50', 1),
(13, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/113.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/113.jpg', NULL, 2, 1, '2016-09-03 10:28:57', 1),
(14, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/013.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/013.jpg', NULL, 2, 1, '2016-09-03 10:28:57', 1),
(15, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/014.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/014.jpg', NULL, 2, 1, '2016-09-03 10:29:23', 1),
(16, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/114.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/114.jpg', NULL, 2, 1, '2016-09-03 10:29:23', 1),
(17, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/015.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/015.jpg', NULL, 2, 1, '2016-09-03 10:29:44', 1),
(18, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/115.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/115.jpg', NULL, 2, 1, '2016-09-03 10:29:44', 1),
(19, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/016.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/016.jpg', NULL, 2, 1, '2016-09-03 10:29:53', 1),
(20, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/116.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/116.jpg', NULL, 2, 1, '2016-09-03 10:29:53', 1),
(21, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/017.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/017.jpg', NULL, 2, 1, '2016-09-03 10:30:04', 1),
(22, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/117.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/117.jpg', NULL, 2, 1, '2016-09-03 10:30:04', 1),
(23, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/118.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/118.jpg', NULL, 2, 1, '2016-09-03 10:30:25', 1),
(24, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/018.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/018.jpg', NULL, 2, 1, '2016-09-03 10:30:25', 1),
(25, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/119.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/119.jpg', NULL, 2, 1, '2016-09-03 10:32:11', 1),
(26, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/019.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/019.jpg', NULL, 2, 1, '2016-09-03 10:32:12', 1),
(27, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/120.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/120.jpg', NULL, 2, 1, '2016-09-03 10:32:22', 1),
(28, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/020.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/020.jpg', NULL, 2, 1, '2016-09-03 10:32:22', 1),
(29, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/121.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/121.jpg', NULL, 2, 1, '2016-09-03 10:32:36', 1),
(30, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/021.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/021.jpg', NULL, 2, 1, '2016-09-03 10:32:36', 1),
(31, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/122.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/122.jpg', NULL, 2, 1, '2016-09-03 10:42:36', 1),
(32, 1, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/022.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/022.jpg', NULL, 2, 1, '2016-09-03 10:42:36', 1),
(33, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/alipayQRcode.jpg', NULL, NULL, 2, 1, '2016-09-07 03:55:50', 1),
(34, 0, NULL, 'affff', 'D:/webServer/guyou/uploads/photo/alipayQRCode.png', NULL, NULL, 2, 1, '2016-09-07 03:55:50', 1),
(35, 0, 7, 'affff', 'D:/webServer/guyou/uploads/photo/redpacket_bg1.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/redpacket_bg1.jpg', NULL, 2, 1, '2016-09-07 03:15:18', 1),
(36, 0, 7, 'affff', 'D:/webServer/guyou/uploads/photo/point12.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/point12.png', NULL, 2, 1, '2016-09-07 03:15:34', 1),
(37, 0, 7, 'affff', 'D:/webServer/guyou/uploads/photo/gold3.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/gold3.png', NULL, 2, 1, '2016-09-07 03:15:41', 1),
(38, 0, 7, 'affff', 'D:/webServer/guyou/uploads/photo/point13.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/point13.png', NULL, 2, 1, '2016-09-07 03:16:20', 1),
(39, 0, 7, 'affff', 'D:/webServer/guyou/uploads/photo/gold.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/gold.png', NULL, 2, 1, '2016-09-11 07:09:07', 1),
(40, 0, 7, 'affff', 'D:/webServer/guyou/uploads/photo/point1.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/point1.png', NULL, 2, 1, '2016-09-11 07:09:07', 1),
(41, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/point.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/point.png', NULL, 2, 1, '2016-09-11 07:25:39', 1),
(43, 3, 7, 'affff', 'D:/webServer/guyou/uploads/photo/vip2.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/vip2.png', NULL, 2, 1, '2016-09-11 07:35:03', 1),
(44, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/diamond.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/diamond.png', NULL, 2, 1, '2016-09-11 08:09:58', 1),
(46, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/jianshe.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/jianshe.png', NULL, 2, 1, '2016-09-11 08:09:58', 1),
(47, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/nongye.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/nongye.png', NULL, 2, 1, '2016-09-11 08:09:59', 1),
(48, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/point3.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/point3.png', NULL, 2, 1, '2016-09-11 08:09:59', 1),
(49, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/point11.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/point11.png', NULL, 2, 1, '2016-09-11 08:09:59', 1),
(50, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/redpacket.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/redpacket.jpg', NULL, 2, 1, '2016-09-11 08:09:59', 1),
(51, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/redpacket_bg.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/redpacket_bg.jpg', NULL, 2, 1, '2016-09-11 08:09:59', 1),
(52, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/silver.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/silver.png', NULL, 2, 1, '2016-09-11 08:10:00', 1),
(53, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/vip1.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/vip1.png', NULL, 2, 1, '2016-09-11 08:10:00', 1),
(54, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/vip21.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/vip21.png', NULL, 2, 1, '2016-09-11 08:10:00', 1),
(55, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/vip3.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/vip3.png', NULL, 2, 1, '2016-09-11 08:10:00', 1),
(56, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/user_icon.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/user_icon.png', NULL, 2, 1, '2016-09-11 08:11:21', 1),
(57, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/v1.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/v1.png', NULL, 2, 1, '2016-09-11 08:11:21', 1),
(58, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/v2.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/v2.png', NULL, 2, 1, '2016-09-11 08:11:21', 1),
(59, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/v3.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/v3.png', NULL, 2, 1, '2016-09-11 08:11:22', 1),
(60, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/钻石会员(1).png', 'D:/webServer/guyou/uploads/photo/photo_thumb/钻石会员(1).png', NULL, 2, 1, '2016-09-11 08:11:22', 1),
(61, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/alipay_logo.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/alipay_logo.png', NULL, 2, 1, '2016-09-11 08:11:22', 1),
(62, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/0.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/0.jpg', NULL, 2, 1, '2016-09-11 08:11:22', 1),
(63, 1, 7, 'affff', 'D:/webServer/guyou/uploads/photo/1.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/1.jpg', NULL, 2, 1, '2016-09-11 08:11:22', 1),
(64, 3, 7, 'affff', 'D:/webServer/guyou/uploads/photo/01.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/01.jpg', NULL, 2, 1, '2016-09-12 05:28:09', 1),
(65, 3, 7, 'affff', 'D:/webServer/guyou/uploads/photo/11.jpg', 'D:/webServer/guyou/uploads/photo/photo_thumb/11.jpg', NULL, 2, 1, '2016-09-12 05:28:10', 1),
(66, 3, 7, 'affff', 'D:/webServer/guyou/uploads/photo/v11.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/v11.png', NULL, 2, 1, '2016-09-12 05:28:23', 1),
(67, 4, 7, 'affff', 'D:/webServer/guyou/uploads/photo/user_icon1.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/user_icon1.png', NULL, 2, 1, '2016-09-12 05:36:45', 1),
(68, 4, 7, 'affff', 'D:/webServer/guyou/uploads/photo/v12.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/v12.png', NULL, 2, 1, '2016-09-12 05:36:45', 1),
(69, 4, 7, 'affff', 'D:/webServer/guyou/uploads/photo/v21.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/v21.png', NULL, 2, 1, '2016-09-12 05:36:45', 1),
(70, 4, 7, 'affff', 'D:/webServer/guyou/uploads/photo/钻石会员(1)1.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/钻石会员(1)1.png', NULL, 2, 1, '2016-09-12 05:36:45', 1),
(71, 2, 7, 'affff', 'D:/webServer/guyou/uploads/photo/v13.png', 'D:/webServer/guyou/uploads/photo/photo_thumb/v13.png', NULL, 2, 1, '2016-09-12 05:37:43', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_red_packet`
--

CREATE TABLE IF NOT EXISTS `gg38_red_packet` (
  `red_packet_id` int(11) NOT NULL AUTO_INCREMENT,
  `red_packet_type` tinyint(1) NOT NULL COMMENT '1积分红包2钻石红包',
  `red_packet_num` float NOT NULL,
  `red_packet_from_user_id` int(11) NOT NULL,
  `red_packet_addtime` datetime NOT NULL,
  `rp_state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`red_packet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `gg38_red_packet`
--

INSERT INTO `gg38_red_packet` (`red_packet_id`, `red_packet_type`, `red_packet_num`, `red_packet_from_user_id`, `red_packet_addtime`, `rp_state`) VALUES
(1, 4, 5000, 7, '2016-09-07 05:29:34', 1),
(2, 4, 5000, 7, '2016-09-07 05:29:45', 1),
(3, 4, 5000, 7, '2016-09-07 05:34:31', 1),
(4, 4, 5000, 7, '2016-09-07 05:44:51', 1),
(5, 4, 5000, 7, '2016-09-07 05:44:59', 1),
(6, 4, 5000, 7, '2016-09-07 05:46:25', 1),
(7, 4, 5000, 7, '2016-09-07 05:47:53', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_topup`
--

CREATE TABLE IF NOT EXISTS `gg38_topup` (
  `topup_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `money` float NOT NULL,
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `remit_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alipay` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `topup_type` tinyint(1) NOT NULL,
  `topup_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-代付款2-充值成功',
  `topup_addtime` datetime NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  `remark` int(6) NOT NULL,
  PRIMARY KEY (`topup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `gg38_topup`
--

INSERT INTO `gg38_topup` (`topup_id`, `user_id`, `money`, `mobile`, `remit_name`, `alipay`, `topup_type`, `topup_state`, `topup_addtime`, `flag`, `remark`) VALUES
(1, 1, 100.56, '13163062522', NULL, '22737265@qq.com', 1, 2, '2016-09-21 04:20:23', 1, 0),
(2, 1, 200.56, '13163062522', NULL, '22737265@qq.com', 1, 2, '2016-09-21 04:20:23', 1, 0),
(3, 1, 200.56, '13163062522', NULL, '22737265@qq.com', 1, 2, '2016-09-21 04:20:23', 1, 0),
(4, 1, 100.49, '13163062522', NULL, '22737165@ss.com', 1, 1, '2016-09-06 06:53:15', 1, 627232),
(5, 1, 100.24, '13163062522', '杨再坤', NULL, 2, 1, '2016-09-06 06:54:35', 1, 420782),
(6, 1, 1000.24, '1316', NULL, '12222', 1, 1, '2016-09-06 06:55:04', 1, 478675),
(7, 1, 1000.24, '1316', NULL, '12222', 1, 1, '2016-09-06 06:57:17', 1, 338297),
(8, 1, 1000.24, '1316', NULL, '12222', 1, 1, '2016-09-06 06:57:36', 1, 937086),
(9, 1, 100.59, '111', NULL, '111111', 1, 1, '2016-09-06 07:02:47', 1, 32674),
(10, 1, 22.59, '111', NULL, '111111', 1, 1, '2016-09-06 07:06:04', 1, 900014),
(11, 1, 100.59, '111', NULL, '111111', 1, 1, '2016-09-06 07:06:09', 1, 74153),
(12, 1, 100.59, '111', NULL, '111111', 1, 1, '2016-09-06 07:06:17', 1, 593317),
(13, 1, 100.59, '啊啊', '啊啊', NULL, 2, 2, '2016-09-06 07:06:33', 1, 540191),
(14, 1, 100.59, '啊啊', '啊啊', NULL, 2, 2, '2016-09-06 07:07:39', 1, 737139),
(15, 1, 100.59, '啊啊', '啊啊', NULL, 2, 1, '2016-09-06 07:08:06', 1, 692982),
(16, 1, 100.59, '啊啊', '啊啊', NULL, 2, 2, '2016-09-06 07:09:24', 1, 300411),
(17, 1, 300.82, '13163062522', 'aaaa', NULL, 2, 2, '2016-09-10 03:44:18', 1, 503716),
(18, 1, 320.16, '111111111', NULL, 'aaadd', 1, 2, '2016-09-10 03:49:05', 1, 905014),
(19, 1, 100.13, '11111', NULL, 'aaa', 1, 1, '2016-09-10 03:50:23', 1, 550658),
(20, 7, 100.13, '11111', NULL, 'aaa', 1, 2, '2016-09-10 03:51:17', 1, 262206),
(21, 7, 111.13, '11111', '111', NULL, 2, 2, '2016-09-10 03:51:24', 1, 74551);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_to_cash`
--

CREATE TABLE IF NOT EXISTS `gg38_to_cash` (
  `to_cash_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `b_icon_num` float NOT NULL,
  `to_cash_state` tinyint(1) NOT NULL DEFAULT '1',
  `to_cash_addtime` datetime NOT NULL,
  PRIMARY KEY (`to_cash_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `gg38_to_cash`
--

INSERT INTO `gg38_to_cash` (`to_cash_id`, `bank_id`, `user_id`, `b_icon_num`, `to_cash_state`, `to_cash_addtime`) VALUES
(1, 0, 7, 0, 1, '2016-09-08 04:36:10'),
(2, 0, 7, 1, 1, '2016-09-08 04:40:22'),
(3, 0, 7, 1, 1, '2016-09-08 04:54:34'),
(4, 1, 7, 1, 1, '2016-09-08 04:58:56'),
(5, 1, 7, 2, 1, '2016-09-08 04:59:33'),
(6, 1, 7, 2, 2, '2016-09-08 04:59:49');

-- --------------------------------------------------------

--
-- 表的结构 `gg38_trends`
--

CREATE TABLE IF NOT EXISTS `gg38_trends` (
  `trends_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trends_content` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trends_addtime` datetime DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`trends_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gg38_user`
--

CREATE TABLE IF NOT EXISTS `gg38_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_mobile` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_nick` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_sex` tinyint(1) DEFAULT NULL,
  `user_icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'http://guyou.com/public/img/vip_icon/user_icon.png',
  `user_birth` date DEFAULT NULL,
  `user_star` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_invitecode` char(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_pv` bigint(20) DEFAULT NULL COMMENT '主页访问量',
  `user_isonline` tinyint(1) DEFAULT NULL COMMENT '1在线2隐身3不在线',
  `user_level` int(1) DEFAULT '1' COMMENT '1[默认]普通用户2普通会员3黄金会员4钻石会员',
  `recommend_user_id` int(10) DEFAULT NULL COMMENT '推荐人id',
  `user_lastlogin` datetime DEFAULT NULL COMMENT '最后一次登录时间',
  `user_lastip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上次登录Ip',
  `user_addtime` datetime NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  `user_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '默认为1[激活状态] 2禁用',
  `can_send` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `gg38_user`
--

INSERT INTO `gg38_user` (`user_id`, `user_mobile`, `user_password`, `user_nick`, `user_email`, `user_sex`, `user_icon`, `user_birth`, `user_star`, `user_invitecode`, `user_address`, `user_pv`, `user_isonline`, `user_level`, `recommend_user_id`, `user_lastlogin`, `user_lastip`, `user_addtime`, `flag`, `user_state`, `can_send`) VALUES
(0, '11111111111', '3af69e8d6f9286c828a798230d5a696a', '系统', 'jerr@jerr.com', 1, 'http://guyou.com/public/img/vip_icon/user_icon.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-08-28 00:25:16', 1, 1, 1),
(1, '13163062512', '3af69e8d6f9286c828a798230d5a696a', 'jerr', 'jerr@jerr.com', 1, 'http://guyou.com/public/img/vip_icon/user_icon.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-08-28 00:25:16', 1, 1, 1),
(2, '13163062524', '3af69e8d6f9286c828a798230d5a696a', '一个老用户', 'jerr@jerr.com', 1, 'http://guyou.com/public/img/vip_icon/user_icon.png', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-08-28 00:25:16', 1, 1, 1),
(3, '13163062528', '3af69e8d6f9286c828a798230d5a696a', '一个用户', 'jerr@jerr.com', 2, 'http://guyou.com/public/img/vip_icon/user_icon.png', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-08-28 00:25:16', 1, 1, 1),
(4, '13163062529', '4dca599f7ae76086a4e2ed05105c2ccc', '两个用户', NULL, 2, 'http://guyou.com/public/img/vip_icon/user_icon.png', NULL, NULL, 'b101b03d7f20983d89890e47f0b75904', NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-09-04 06:56:15', 1, 1, 1),
(5, '12222222222', '4dca599f7ae76086a4e2ed05105c2ccc', 'aaa', 'ww@Aa.com', 2, 'http://guyou.com/uploads/icon/redpacket.jpg', NULL, '11', '2544266b6243aa41a603e63d2411ba91', '111', NULL, NULL, 4, NULL, NULL, NULL, '2016-09-04 07:02:57', 1, 1, 1),
(6, '12321235242', '670b14728ad9902aecba32e22fa4f6bd', 'aaaaa', NULL, 2, 'http://guyou.com/public/img/vip_icon/user_icon.png', NULL, NULL, 'd18a3a84dd1e80b6d7296e858257e676', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-09-04 10:03:49', 1, 1, 1),
(7, '13163062522', '767588a222ef831c55ebf3c6692b6104', 'jerr', '2273711@qq.com', 1, 'http://guyou.com/uploads/icon/vip3.png', NULL, '天蝎', '367fc756fbf99c1baa3cfbb0d6f75ac7', '天津滨海新区', NULL, NULL, 4, 4, NULL, NULL, '2016-09-05 09:36:13', 1, 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_user_safe`
--

CREATE TABLE IF NOT EXISTS `gg38_user_safe` (
  `user_safe_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `safe_question` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `safe_answer` char(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_safe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gg38_user_visitor`
--

CREATE TABLE IF NOT EXISTS `gg38_user_visitor` (
  `visitor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_visitor_id` int(11) NOT NULL,
  `visitor_addtime` datetime NOT NULL COMMENT '访问时间',
  PRIMARY KEY (`visitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `gg38_vip_level`
--

CREATE TABLE IF NOT EXISTS `gg38_vip_level` (
  `vip_level_id` int(10) NOT NULL AUTO_INCREMENT,
  `vip_level_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vip_level_need` int(11) NOT NULL,
  `red_packet_num` int(11) NOT NULL,
  PRIMARY KEY (`vip_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `gg38_vip_level`
--

INSERT INTO `gg38_vip_level` (`vip_level_id`, `vip_level_name`, `vip_level_need`, `red_packet_num`) VALUES
(2, '黄金会员', 2000, 3000),
(3, '钻石会员', 3001, 5000),
(4, '钻石会员', 5000, 5000);

-- --------------------------------------------------------

--
-- 表的结构 `gg38_wallet`
--

CREATE TABLE IF NOT EXISTS `gg38_wallet` (
  `wallet_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `b_icon` float NOT NULL DEFAULT '0' COMMENT 'b币',
  `diamond` float NOT NULL DEFAULT '0' COMMENT '钻石',
  `point` float DEFAULT '0' COMMENT '积分',
  `fri_apply_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `gg38_wallet`
--

INSERT INTO `gg38_wallet` (`wallet_id`, `user_id`, `b_icon`, `diamond`, `point`, `fri_apply_addtime`) VALUES
(1, 1, 0, 2728.35, 0, '2016-09-14 03:12:11'),
(2, 4, 0, 0, 0, NULL),
(3, 5, 0, 0, 0, NULL),
(4, 6, 0, 0, 0, NULL),
(5, 7, 106.8, 3336.95, 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
