-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2018 年 12 月 28 日 13:21
-- 伺服器版本: 10.1.37-MariaDB
-- PHP 版本： 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Apply`
--

CREATE TABLE `Apply` (
  `userid` varchar(10) NOT NULL,
  `classid` varchar(10) NOT NULL,
  `office` varchar(10) NOT NULL,
  `purpose` text NOT NULL,
  `return_date` date NOT NULL,
  `borrower` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `course_time` varchar(2) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `Apply`
--

INSERT INTO `Apply` (`userid`, `classid`, `office`, `purpose`, `return_date`, `borrower`, `date`, `course_time`, `day`) VALUES
('B044020031', '4069', 'Of01', 'sd', '2018-12-26', 'timchen', '2018-12-25', 'A', 'Tuesday'),
('B044020031', '4069', 'Of01', 'sd', '2018-10-01', 'timchen', '2018-09-13', 'B', 'Thursday'),
('B044020031', '4069', 'Of01', 'sd', '2018-09-20', 'timchen', '2018-09-13', 'A', 'Thursday'),
('B044020031', '4069', 'Of01', 'sd', '2018-12-28', 'timchen', '2018-12-27', 'A', 'Thursday'),
('B044020089', '4069', 'Of01', 'sd', '2018-09-12', 'John', '2018-09-11', 'C', 'Tuesday');

-- --------------------------------------------------------

--
-- 資料表結構 `Classroom`
--

CREATE TABLE `Classroom` (
  `classid` varchar(10) NOT NULL,
  `classname` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `class address` varchar(10) CHARACTER SET utf8 NOT NULL,
  `accommodate` int(20) NOT NULL,
  `available_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `Classroom`
--

INSERT INTO `Classroom` (`classid`, `classname`, `class address`, `accommodate`, `available_time`) VALUES
('3051', 'CM3051', 'CM_new', 40, '0000-00-00'),
('4069', 'CM4069', 'CM_new', 40, '0000-00-00');

-- --------------------------------------------------------

--
-- 資料表結構 `Classroom_with_Equip`
--

CREATE TABLE `Classroom_with_Equip` (
  `userid` varchar(10) NOT NULL,
  `classid` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(10) NOT NULL,
  `course_time` varchar(1) NOT NULL,
  `equipid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `Classroom_with_Equip`
--

INSERT INTO `Classroom_with_Equip` (`userid`, `classid`, `date`, `day`, `course_time`, `equipid`) VALUES
('B044020031', '3021', '2018-12-06', 'Monday', 'A', 'marker'),
('B044020031', '4069', '2018-12-25', 'Tuesday', 'A', 'marker'),
('B044020031', '4069', '2018-09-13', 'Thursday', 'B', 'projector'),
('B044020031', '4069', '2018-09-13', 'Thursday', 'B', 'marker'),
('B044020031', '4069', '2018-09-13', 'Thursday', 'A', 'marker');

-- --------------------------------------------------------

--
-- 資料表結構 `Equipment`
--

CREATE TABLE `Equipment` (
  `equippid` varchar(10) NOT NULL,
  `equip_name` varchar(15) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `Equipment`
--

INSERT INTO `Equipment` (`equippid`, `equip_name`, `available`) VALUES
('A01', 'projector', 1),
('A02', 'extension ', 1),
('A03', 'marker', 1),
('A04', 'microphone', 1),
('A05', 'transformer', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `User`
--

CREATE TABLE `User` (
  `userid` varchar(20) NOT NULL,
  `username` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `labid` varchar(10) NOT NULL,
  `phone` int(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `User`
--

INSERT INTO `User` (`userid`, `username`, `email`, `labid`, `phone`, `password`) VALUES
('B044020031', 'timchen', 'timchen.nba@gmail.co', '0902320557', 0, '0127'),
('B044020089', 'John', 'john@gmail.com', '123', 912345678, '123');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `Classroom`
--
ALTER TABLE `Classroom`
  ADD PRIMARY KEY (`classid`);

--
-- 資料表索引 `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
