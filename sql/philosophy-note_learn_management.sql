-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql1035.db.sakura.ne.jp
-- 生成日時: 2021 年 6 月 07 日 23:18
-- サーバのバージョン： 5.7.32-log
-- PHP のバージョン: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `philosophy-note_learn_management`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `learn_tb`
--

CREATE TABLE `learn_tb` (
  `Learn_id` int(16) NOT NULL,
  `Date` date NOT NULL,
  `Input` time NOT NULL,
  `Output` time NOT NULL,
  `Contents` text COLLATE utf8_unicode_ci NOT NULL,
  `Thoughts` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `learn_tb`
--

INSERT INTO `learn_tb` (`Learn_id`, `Date`, `Input`, `Output`, `Contents`, `Thoughts`) VALUES
(8, '2021-05-31', '02:03:00', '02:05:00', 'aaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaa'),
(9, '2021-06-02', '01:03:00', '02:03:00', 'saxsa', 'xasxsax'),
(10, '2021-06-01', '04:20:00', '08:21:00', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaa'),
(11, '2021-05-30', '03:04:00', '05:05:00', 'sssssssssssssssss', 'sssssssssssssssss'),
(12, '2021-05-29', '05:04:00', '06:37:00', 'akkkkkkkkkkkkk', 'sssssssssssssssss'),
(13, '2021-05-28', '04:08:00', '01:57:00', 'xxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxx'),
(14, '2021-05-27', '04:25:00', '06:00:00', 'kkkkakakakka', 'iiiiiiiiiiiiiiiiiiiiii'),
(15, '2021-05-26', '03:21:00', '02:00:00', 'kekiki', 'dsacfdksacofjow');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`user_id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(2, 'aaaa', 'aaaa', 'aaaa', 1, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `learn_tb`
--
ALTER TABLE `learn_tb`
  ADD PRIMARY KEY (`Learn_id`),
  ADD UNIQUE KEY `Date` (`Date`);

--
-- テーブルのインデックス `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `learn_tb`
--
ALTER TABLE `learn_tb`
  MODIFY `Learn_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルのAUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
