-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db_1`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_20210327_table`
--

CREATE TABLE `gs_20210327_table` (
  `id` mediumint(12) NOT NULL,
  `b_genre_1` varchar(128) NOT NULL,
  `b_genre_2` varchar(128) NOT NULL,
  `b_name` varchar(64) NOT NULL,
  `b_url` text NOT NULL,
  `b_remarks` text NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_20210327_table`
--

INSERT INTO `gs_20210327_table` (`id`, `b_genre_1`, `b_genre_2`, `b_name`, `b_url`, `b_remarks`, `indate`) VALUES
(8, '文芸', '小説', '波のうえの魔術師', 'https://www.google.com', 'あああああ', '2021-03-28 20:44:01'),
(9, '文芸', '小説', '4TEEN', 'https://www.google.com', 'いいいいい', '2021-03-28 20:44:24'),
(10, '文芸', '小説', '池袋ウエストゲートパーク', 'https://www.google.com', 'ううううう', '2021-03-28 20:44:45'),
(11, '文芸', '小説', '娼年', 'https://www.google.com', 'えええええ', '2021-03-28 20:45:04'),
(12, '文芸', '小説', '赤・黒（ルージュ・ノワール）', 'https://www.google.com', 'おおおおお', '2021-03-28 20:46:07'),
(13, 'ビジネス書', '経営学', 'ザ・プロフェッショナル', 'https://www.google.com', 'かかかかか', '2021-03-28 20:47:31'),
(14, 'コミック・雑誌', '単行本', 'サンクチュアリ (漫画)', 'https://www.google.com', 'ききききき', '2021-03-28 21:04:02'),
(15, 'コミック・雑誌', '単行本', 'うしおととら', 'https://www.google.com', 'くくくくく', '2021-03-28 21:05:24'),
(16, '学習参考書', '大学受験参考書', 'DUO', 'https://www.google.com', 'けけけけけ', '2021-03-28 21:05:43'),
(17, 'ビジネス書', '金融', 'デリバティブキーワード', 'https://www.google.com', 'こここここ', '2021-03-28 21:11:17'),
(18, '実用書', '旅行', '地球の歩き方（スペイン）', 'https://www.google.com', 'さささささ', '2021-03-28 21:17:05'),
(33, '文芸', '小説', 'aaaaa', 'aaaaa', 'aaaaaaa', '2021-04-04 17:40:14'),
(39, '文芸', '小説', 'cccc', 'aaaaa', 'aaaaaa', '2021-04-13 23:45:12'),
(44, '実用書', '料理', '奥の細道', 'https://www.google.com', 'aaaaaaa', '2021-04-10 12:45:32');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_20210327_table`
--
ALTER TABLE `gs_20210327_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_20210327_table`
--
ALTER TABLE `gs_20210327_table`
  MODIFY `id` mediumint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
