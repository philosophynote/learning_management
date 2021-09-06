-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 6 月 02 日 17:32
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `learn_management`
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
(5, '2021-06-01', '14:24:00', '14:27:00', 'aaaaaaa', 'a'),
(7, '2021-05-30', '10:27:00', '10:26:00', 'aaa', 'aaa'),
(8, '2021-05-31', '02:03:00', '02:05:00', 'aaaa', 'aaaa');

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
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `learn_tb`
--
ALTER TABLE `learn_tb`
  MODIFY `Learn_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
