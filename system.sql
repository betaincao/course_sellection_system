-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 04 月 15 日 11:55
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `system`
--

-- --------------------------------------------------------

--
-- 表的结构 `system_1_course`
--

CREATE TABLE IF NOT EXISTS `system_1_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_1_course`
--

INSERT INTO `system_1_course` (`id`, `s_num`, `c_id`, `lang`, `all`, `status`, `create_time`) VALUES
('041521163', '04152116', 3, '(1,0)', 0, 1, '2018-04-09'),
('041521173', '04152117', 3, '(1,0)', 0, 0, '2018-04-09'),
('041521193', '04152119', 3, '(1,0)', 0, 0, '2018-04-09'),
('041521213', '04152121', 3, '(1,0)', 0, 0, '2018-04-09'),
('041521343', '04152134', 3, '(1,0)', 0, 0, '2018-04-09');

-- --------------------------------------------------------

--
-- 表的结构 `system_2_course`
--

CREATE TABLE IF NOT EXISTS `system_2_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_3_course`
--

CREATE TABLE IF NOT EXISTS `system_3_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_4_course`
--

CREATE TABLE IF NOT EXISTS `system_4_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_5_course`
--

CREATE TABLE IF NOT EXISTS `system_5_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_6_course`
--

CREATE TABLE IF NOT EXISTS `system_6_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_7_course`
--

CREATE TABLE IF NOT EXISTS `system_7_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_8_course`
--

CREATE TABLE IF NOT EXISTS `system_8_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_9_course`
--

CREATE TABLE IF NOT EXISTS `system_9_course` (
  `id` char(50) NOT NULL COMMENT '学号课程id为主键',
  `s_num` char(8) NOT NULL COMMENT '学号',
  `c_id` int(11) NOT NULL COMMENT '课程id',
  `lang` char(8) NOT NULL COMMENT '设置几选几（3,2）',
  `all` int(11) NOT NULL DEFAULT '0' COMMENT '整班选课0：不是整班选课，1：是整班选课',
  `status` int(11) NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
  `create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_admin`
--

CREATE TABLE IF NOT EXISTS `system_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL COMMENT '姓名',
  `password` char(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `system_admin`
--

INSERT INTO `system_admin` (`id`, `name`, `password`) VALUES
(2, 'caoyouming', '96e79218965eb72c92a549dd5a330112');

-- --------------------------------------------------------

--
-- 表的结构 `system_course`
--

CREATE TABLE IF NOT EXISTS `system_course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表的id',
  `c_num` char(10) NOT NULL COMMENT '课程编号',
  `c_major` char(20) NOT NULL COMMENT '课程所属专业',
  `c_grade` int(11) NOT NULL COMMENT '课程所属的年级',
  `c_name` varchar(50) NOT NULL COMMENT '课程名称',
  `c_check_address` char(2) NOT NULL COMMENT '考核组织单位',
  `c_score` int(11) NOT NULL COMMENT '学分',
  `c_all_time` int(11) NOT NULL COMMENT '总学时',
  `c_theoretical_time` int(11) NOT NULL COMMENT '理论学时',
  `c_test_hours` int(11) NOT NULL DEFAULT '0' COMMENT '试验学时',
  `c_semester` int(11) NOT NULL COMMENT '开课学期',
  `c_week_time` int(11) NOT NULL COMMENT '周学时',
  `c_remarks` char(4) NOT NULL COMMENT '备注',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `system_course`
--

INSERT INTO `system_course` (`c_id`, `c_num`, `c_major`, `c_grade`, `c_name`, `c_check_address`, `c_score`, `c_all_time`, `c_theoretical_time`, `c_test_hours`, `c_semester`, `c_week_time`, `c_remarks`) VALUES
(1, 'DZ110211', '网络工程', 2016, '计算机应用', '院考', 4, 72, 48, 24, 5, 3, '选修'),
(2, 'DZ110211', '网络工程', 2015, '计算机应用', '院考', 4, 72, 48, 24, 5, 3, '选修'),
(3, 'DZ110212', '网络工程', 2015, '你不知道的JS', '院考', 3, 36, 24, 12, 7, 2, '啊啊啊');

-- --------------------------------------------------------

--
-- 表的结构 `system_ct`
--

CREATE TABLE IF NOT EXISTS `system_ct` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'c_id,课程id，一门课程一个老师',
  `t_num` varchar(255) DEFAULT NULL COMMENT '教工号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='课程与教师' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `system_ct`
--

INSERT INTO `system_ct` (`id`, `t_num`) VALUES
(3, '04152117'),
(4, '04152117');

-- --------------------------------------------------------

--
-- 表的结构 `system_major`
--

CREATE TABLE IF NOT EXISTS `system_major` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `major_name` char(20) NOT NULL COMMENT '专业名称',
  `major_grade` int(11) NOT NULL COMMENT '专业的年级',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `system_major`
--

INSERT INTO `system_major` (`m_id`, `major_name`, `major_grade`) VALUES
(1, '网络工程', 2015),
(2, '网络工程', 2016),
(3, '网络工程', 2017),
(4, '软件工程', 2015),
(5, '软件工程', 2016),
(6, '软件工程', 2017),
(7, '计算机科学与技术', 2015),
(8, '计算机科学与技术', 2016),
(9, '计算机科学与技术', 2017);

-- --------------------------------------------------------

--
-- 表的结构 `system_notice`
--

CREATE TABLE IF NOT EXISTS `system_notice` (
  `n_time` datetime NOT NULL COMMENT '时间',
  `n_content` text NOT NULL COMMENT '内容',
  `n_title` char(50) NOT NULL COMMENT '标题',
  PRIMARY KEY (`n_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_notice`
--

INSERT INTO `system_notice` (`n_time`, `n_content`, `n_title`) VALUES
('2018-02-12 17:12:04', 'Hi,all.一学期一次的选课开始了快点去选课吧！', '又要选课了呀');

-- --------------------------------------------------------

--
-- 表的结构 `system_plan`
--

CREATE TABLE IF NOT EXISTS `system_plan` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '培养计划编号',
  `p_name` char(50) NOT NULL COMMENT '培养计划名称',
  `p_major` char(10) NOT NULL COMMENT '培养计划所属的专业',
  `p_grade` int(11) NOT NULL COMMENT '培养计划所属的年级',
  `p_path` varchar(50) NOT NULL DEFAULT '' COMMENT '培养计划对应名称',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `system_plan`
--

INSERT INTO `system_plan` (`p_id`, `p_name`, `p_major`, `p_grade`, `p_path`) VALUES
(28, '网络工程系2017曹有明简历先前', '网络工程系', 2017, '5a1e82c962bac.pdf'),
(27, '网络工程系2017测试 - 副本 (3)', '网络工程系', 2017, '5a1590e6ae692.pdf'),
(25, '软件工程系2016测试', '软件工程系', 2016, '5a15908fceff5.pdf'),
(29, '网络工程2017lalalal', '网络工程', 2017, '5a9799709af35.pdf'),
(26, '计算机科学与技术系2017测试 - 副本', '计算机科学与技术系', 2017, '5a1590a0bc7c5.pdf'),
(30, '网络工程2016lalalal', '网络工程', 2016, '5a993a0339ea7.pdf');

-- --------------------------------------------------------

--
-- 表的结构 `system_repassword`
--

CREATE TABLE IF NOT EXISTS `system_repassword` (
  `s_num` char(10) NOT NULL DEFAULT '',
  `token` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `create_time` char(15) DEFAULT NULL,
  PRIMARY KEY (`s_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用于存储修改密码的临时链接地址';

--
-- 转存表中的数据 `system_repassword`
--

INSERT INTO `system_repassword` (`s_num`, `token`, `client_ip`, `type`, `create_time`) VALUES
('0001', '11b54836fd023a1af78d04e401ebe11f', '10.245.15.39', 2, '1523616380'),
('04152116', '95909aa98d64defc10cb023f85103858', '223.104.11.68', 1, '1523630286');

-- --------------------------------------------------------

--
-- 表的结构 `system_student`
--

CREATE TABLE IF NOT EXISTS `system_student` (
  `s_num` char(10) NOT NULL DEFAULT '' COMMENT '学号',
  `name` varchar(20) NOT NULL COMMENT '学生姓名',
  `s_sex` char(5) NOT NULL DEFAULT '' COMMENT '性别',
  `s_age` int(11) NOT NULL COMMENT '年龄',
  `password` char(32) NOT NULL COMMENT '密码（用32位的md5加密）',
  `s_major` char(20) NOT NULL COMMENT '专业',
  `s_grade` int(11) NOT NULL COMMENT '年级',
  `s_mail` char(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `s_class` char(64) DEFAULT NULL COMMENT '班级',
  PRIMARY KEY (`s_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_student`
--

INSERT INTO `system_student` (`s_num`, `name`, `s_sex`, `s_age`, `password`, `s_major`, `s_grade`, `s_mail`, `s_class`) VALUES
('04152116', '曹有明', '男', 20, 'e3ceb5881a0a1fdaad01296d7554868d', '网络工程', 2015, 'iscaoyouming@163.com', '网络1504'),
('04152117', '程仕伟', '男', 20, 'e3ceb5881a0a1fdaad01296d7554868d', '网络工程', 2015, '222@qq.com', '网络1504'),
('04152121', '张坤', '男', 22, '96e79218965eb72c92a549dd5a330112', '网络工程', 2015, '', '网络1504'),
('04152134', '沈瑶', '女', 20, '96e79218965eb72c92a549dd5a330112', '网络工程', 2015, '', '网络1504'),
('07152117', 'TEST', '男', 18, '96e79218965eb72c92a549dd5a330112', '计算机科学与技术', 2017, '1111@xiyou.edu.cn', '计科1701');

-- --------------------------------------------------------

--
-- 表的结构 `system_teacher`
--

CREATE TABLE IF NOT EXISTS `system_teacher` (
  `t_num` char(10) NOT NULL COMMENT '工号',
  `name` char(10) NOT NULL COMMENT '姓名',
  `t_department` char(20) NOT NULL COMMENT '系部',
  `t_school` varchar(255) DEFAULT NULL COMMENT '教师所属学院',
  `password` char(50) NOT NULL COMMENT '密码',
  `t_sex` char(2) NOT NULL COMMENT '性别',
  `t_mail` char(20) NOT NULL DEFAULT '0' COMMENT '教师e_mail',
  PRIMARY KEY (`t_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_teacher`
--

INSERT INTO `system_teacher` (`t_num`, `name`, `t_department`, `t_school`, `password`, `t_sex`, `t_mail`) VALUES
('04152116', '曹有明', '网络工程', '计算机学院', '96e79218965eb72c92a549dd5a330112', '男', '943844391@qq.com'),
('04152117', '程仕伟', '网络工程', '计算机学院', 'e3ceb5881a0a1fdaad01296d7554868d', '男', ''),
('04152119', '国际航', '计算机科学与技术', '计算机学院', 'e3ceb5881a0a1fdaad01296d7554868d', '男', ''),
('04152121', '张坤', '软件工程', '计算机学院', 'e3ceb5881a0a1fdaad01296d7554868d', '男', '');

-- --------------------------------------------------------

--
-- 表的结构 `system_time`
--

CREATE TABLE IF NOT EXISTS `system_time` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `createtime` timestamp NULL DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='选课时间设置' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
