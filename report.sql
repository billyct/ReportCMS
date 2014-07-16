-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 12 月 28 日 11:10
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `report`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_answer`
--

CREATE TABLE IF NOT EXISTS `t_answer` (
  `visitor_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `t_answer`
--

-- INSERT INTO `t_answer` (`visitor_id`, `question_id`, `option_id`, `topic_id`) VALUES
-- (2, 8, 2, 0),
-- (2, 9, 0, 0),
-- (2, 19, 8, 0),
-- (2, 24, 12, 0),
-- (2, 24, 13, 0),
-- (2, 24, 14, 0),
-- (2, 24, 15, 0),
-- (2, 8, 3, 1),
-- (2, 9, 1, 1),
-- (2, 19, 10, 1),
-- (2, 24, 13, 1),
-- (2, 24, 14, 1),
-- (2, 24, 18, 1),
-- (2, 24, 19, 1),
-- (2, 24, 20, 1);

-- --------------------------------------------------------

--
-- 表的结构 `t_option`
--

CREATE TABLE IF NOT EXISTS `t_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `t_option`
--

-- INSERT INTO `t_option` (`id`, `content`, `question_id`) VALUES
-- (1, '架上绘画（古典油画、当代油画、中国古代、现当代书法绘画等）.', 8),
-- (2, '中国古代器皿 （古董家具、佛像、陶瓷等）', 8),
-- (3, '影像作品（主要是摄影） ', 8),
-- (4, ' 雕塑、装置 ', 8),
-- (5, ' 时尚奢侈品（如LV等）', 8),
-- (6, 'test_option', 11),
-- (7, '盒子放着，做留念 ', 19),
-- (8, ' 随便摆着，就一堆照片而已', 19),
-- (9, '就祭祖的时候拿出来摆放下 ', 19),
-- (10, '有主题性地进行系统分类整理，并加以保存，认为其有艺术收藏价值 ', 19),
-- (11, '没有保存', 19),
-- (12, ' 中国重要摄影家的代表作 ', 24),
-- (13, '中国历史和摄影史上著名的影像（摄影者不详）', 24),
-- (14, '艺术摄影（fine art photograph，包括沙龙摄影）', 24),
-- (15, '当代影像,用摄影媒介创作的当代艺术品 ', 24),
-- (16, '古董照片,（老照片，出自名摄影家和具有影像价值但不知摄影师）', 24),
-- (17, '摄影发展史上在技术技法有价值的照片 ', 24),
-- (18, '国外名家名作 ', 24),
-- (19, '底片 ', 24),
-- (20, '摄影图书 （古籍善本影像书）', 24);

-- --------------------------------------------------------

--
-- 表的结构 `t_question`
--

CREATE TABLE IF NOT EXISTS `t_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `type` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `t_question`
--

-- INSERT INTO `t_question` (`id`, `title`, `type`, `topic_id`) VALUES
-- (8, '如果您手上有100万元作为投资艺术品的资金，您会投资哪样?', 1, 1),
-- (9, '你认为照片仅仅是记录个人生活与感情的媒介吗，是否认为摄影也可以成为艺术？', 3, 1),
-- (11, 'test', 1, 3),
-- (12, 'test1', 1, 3),
-- (17, 'test2', 1, 3),
-- (18, 'test3', 1, 3),
-- (19, '你家里是否存有祖辈的照片？如果有，你是如何处理？', 1, 1),
-- (24, '你认为可以被收藏的影像作品类型是什么？(多选）', 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `t_topic`
--

CREATE TABLE IF NOT EXISTS `t_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `display` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `t_topic`
--

-- INSERT INTO `t_topic` (`id`, `name`, `display`) VALUES
-- (1, '摄影调查', 1),
-- (3, '编程调查', 1),
-- (4, '职业性格测试', 0);

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `t_user`
--

-- INSERT INTO `t_user` (`id`, `username`, `email`, `password`) VALUES
-- (1, 'billyct', 'billy_allen@126.com', '$1$Qu0.Z0/.$qQbQ43qtqHkoG.wLZlqjW1');

-- --------------------------------------------------------

--
-- 表的结构 `t_visitor`
--

CREATE TABLE IF NOT EXISTS `t_visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `t_visitor`
--

-- INSERT INTO `t_visitor` (`id`, `ip`, `create_at`) VALUES
-- (2, '127.0.0.1', '2012-12-28 10:08:50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
