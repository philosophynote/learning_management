-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 6 月 07 日 14:13
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
  `User_id` int(12) NOT NULL,
  `Date` date NOT NULL,
  `Input` time NOT NULL,
  `Output` time NOT NULL,
  `Contents` text COLLATE utf8_unicode_ci NOT NULL,
  `Thoughts` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `learn_tb`
--

INSERT INTO `learn_tb` (`Learn_id`, `User_id`, `Date`, `Input`, `Output`, `Contents`, `Thoughts`) VALUES
(5, 7, '2021-06-01', '14:24:00', '14:27:00', 'aaaaaaa', 'a'),
(7, 7, '2021-05-30', '10:27:00', '10:26:00', 'aaa', 'aaa'),
(8, 8, '2021-05-31', '02:03:00', '02:05:00', 'aaaa', 'aaaa'),
(9, 8, '2021-06-02', '04:17:00', '06:08:00', 'aaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaa'),
(10, 8, '2021-06-01', '02:42:25', '02:25:00', 'rrrrrrrr', 'rrrrrrrr'),
(11, 8, '2021-06-06', '01:01:00', '02:04:00', 'adasdewssadadasっっっっっっっ', 'fewsfsdewfdswtuuutututuut'),
(12, 7, '2021-06-06', '04:23:00', '05:15:00', 'saccdasmfcmasekofkwqpakacdcdsckpselkpvclesd:lv:les:wl.', ',vcdsv,pewsdpvmpodsemwopvmeopsdw'),
(13, 9, '2021-06-07', '03:10:00', '03:20:00', 'ndencvdnswn', 'vdsmcmvklsdmlkvmあああああああああああ');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`user_id`, `name`, `lmail`, `lpw`, `fname`, `kanri_flg`, `life_flg`) VALUES
(7, 'misato', 'misa@mail.com', '$2y$10$PFVNNAqANCM5txL7/6TlKOu/ujoWvxsuB4q0zThL2sbELYlDdKl1O', 'IMG_20151118_235835.jpg', 0, 1),
(8, 'naoki', 'naoki@mail.com', '$2y$10$ddSVDdeSfBJ4SHqkCgUJre7fnbg9COIsoMdQvQVFJaZuNauNO44ii', 'IMG_20151119_064505.jpg', 0, 1),
(9, '羽田圭介', 'hada@mail.com', '$2y$10$XrPDBUH5OyNHoUmX4Gn0u.Olop9XIEFyf55iqDkKeSG/D9oLpVlW.', 'hada.jpeg', 0, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `learn_tb`
--
ALTER TABLE `learn_tb`
  ADD PRIMARY KEY (`Learn_id`);

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
  MODIFY `Learn_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;