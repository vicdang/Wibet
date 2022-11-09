-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 06, 2022 lúc 11:49 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bet`
--

CREATE TABLE `bet` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT 0,
  `match_id` int(11) UNSIGNED DEFAULT 0,
  `option` tinyint(4) DEFAULT 0,
  `money` bigint(20) DEFAULT 0,
  `is_active` bit(1) DEFAULT b'1',
  `created_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `bet`
--

INSERT INTO `bet` (`id`, `user_id`, `match_id`, `option`, `money`, `is_active`, `created_time`) VALUES
(1, 10, 5, 2, 500, b'0', '2018-06-15 04:43:27'),
(2, 20, 5, 2, 300, b'0', '2018-06-15 01:45:20'),
(3, 14, 5, 2, 100, b'0', '2018-06-15 08:45:05'),
(4, 7, 5, 1, 49, b'0', '2018-06-15 09:01:34'),
(5, 17, 5, 2, 100, b'0', '2018-06-15 09:02:07'),
(6, 16, 5, 2, 500, b'0', '2018-06-15 09:02:13'),
(8, 18, 5, 2, 100, b'0', '2018-06-15 09:08:51'),
(9, 21, 5, 2, 150, b'0', '2018-06-15 09:11:22'),
(10, 19, 5, 1, 99, b'0', '2018-06-15 09:12:15'),
(11, 19, 6, 2, 99, b'0', '2018-06-15 09:15:10'),
(12, 22, 5, 2, 100, b'0', '2018-06-15 09:23:16'),
(13, 22, 6, 2, 100, b'0', '2018-06-15 09:23:26'),
(14, 22, 7, 2, 100, b'0', '2018-06-15 09:23:34'),
(15, 7, 7, 2, 152, b'0', '2018-06-15 10:06:50'),
(16, 20, 7, 1, 400, b'0', '2018-06-15 10:51:25'),
(17, 12, 5, 2, 500, b'0', '2018-06-15 10:01:37'),
(18, 13, 5, 2, 500, b'0', '2018-06-15 10:02:55'),
(19, 23, 5, 2, 500, b'0', '2018-06-15 10:54:11'),
(20, 16, 7, 2, 1000, b'0', '2018-06-15 13:58:46'),
(21, 12, 6, 1, 1000, b'0', '2018-06-15 13:59:26'),
(22, 13, 6, 1, 1000, b'0', '2018-06-15 14:01:03'),
(24, 23, 6, 1, 1000, b'0', '2018-06-15 14:13:39'),
(25, 17, 7, 2, 300, b'0', '2018-06-15 14:25:18'),
(26, 6, 6, 1, 200, b'0', '2018-06-15 09:58:19'),
(27, 6, 7, 2, 300, b'0', '2018-06-15 14:27:00'),
(28, 7, 6, 1, 53, b'0', '2018-06-15 14:46:52'),
(30, 10, 6, 2, 200, b'0', '2018-06-15 14:51:07'),
(32, 18, 7, 1, 100, b'0', '2018-06-15 08:01:08'),
(33, 19, 7, 1, 99, b'0', '2018-06-15 17:31:05'),
(34, 19, 8, 1, 101, b'1', '2018-06-15 17:07:47'),
(35, 10, 7, 2, 600, b'0', '2018-06-15 17:29:16'),
(37, 1, 7, 1, 10, b'0', '2018-06-15 17:55:02'),
(38, 22, 8, 1, 101, b'1', '2018-06-15 22:38:10'),
(39, 22, 9, 1, 100, b'1', '2018-06-15 22:38:36'),
(40, 22, 10, 2, 100, b'1', '2018-06-15 22:38:50'),
(41, 21, 8, 1, 100, b'1', '2018-06-16 05:35:46'),
(42, 21, 9, 1, 50, b'1', '2018-06-16 05:36:18'),
(43, 21, 10, 1, 50, b'1', '2018-06-16 05:36:33'),
(44, 10, 8, 1, 305, b'1', '2018-06-16 02:54:16'),
(45, 12, 8, 1, 500, b'1', '2018-06-16 09:11:02'),
(46, 13, 8, 1, 500, b'1', '2018-06-16 09:11:55'),
(47, 17, 8, 1, 400, b'1', '2018-06-16 02:43:16'),
(48, 17, 9, 1, 200, b'1', '2018-06-16 09:43:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `campaign`
--

CREATE TABLE `campaign` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `description`, `image`) VALUES
(1, 'World Cup 2018', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `match`
--

CREATE TABLE `match` (
  `id` int(11) UNSIGNED NOT NULL,
  `campaign_id` int(10) UNSIGNED DEFAULT NULL,
  `team_1` varchar(50) DEFAULT NULL,
  `team_2` varchar(50) DEFAULT NULL,
  `team_1_score` tinyint(4) DEFAULT NULL,
  `team_2_score` tinyint(4) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `match_date` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT current_timestamp(),
  `modified_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `match`
--

INSERT INTO `match` (`id`, `campaign_id`, `team_1`, `team_2`, `team_1_score`, `team_2_score`, `rate`, `result`, `match_date`, `description`, `created_by`, `created_time`, `modified_time`) VALUES
(5, NULL, 'Egypt', 'Uruquay', 0, 1, -0.5, 2, '2018-06-15 11:45:16', 'Uruquay chap 1/2 trai', NULL, '2018-06-15 07:51:41', NULL),
(6, NULL, 'Marocco', 'Iran', 0, 1, -0.5, 2, '2018-06-15 15:00:53', 'Iran chap Morocco 1/2 trai', NULL, '2018-06-15 08:49:52', NULL),
(7, NULL, 'Portugal', 'Spain', 3, 3, 0.5, 2, '2018-06-15 18:00:21', 'Portugal chap Spain 1/2 trai', NULL, '2018-06-15 08:51:23', NULL),
(8, NULL, 'France', 'Australia', NULL, NULL, 1.5, NULL, '2018-06-16 10:00:57', 'France chap 1-1/2 trai (1 trai ruoi) ', NULL, '2018-06-15 09:46:40', NULL),
(9, NULL, 'Argentina', 'Iceland', NULL, NULL, 1.5, NULL, '2018-06-16 13:00:56', 'Argentina chap 1-1/2 trai (1 trai ruoi)', NULL, '2018-06-15 09:48:41', NULL),
(10, NULL, 'Peru', 'Denmark', NULL, NULL, -0.5, NULL, '2018-06-16 16:00:44', 'Denmark chap 0.5 trai', NULL, '2018-06-15 09:51:41', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profile`
--

CREATE TABLE `profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `money` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `created_at`, `updated_at`, `full_name`, `money`) VALUES
(1, 1, '2014-06-04 11:17:34', '2014-06-10 21:05:05', 'Administrator', 490),
(3, 3, '2018-06-13 20:49:22', '2018-06-14 18:23:48', 'Don Nguyen', 500),
(4, 4, '2018-06-13 21:33:26', NULL, 'Don Nguyen 2', 500),
(5, 5, '2018-06-13 21:56:40', '2018-06-14 18:23:40', 'Son Nguyen Truong', 500);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `can_admin` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`, `can_admin`) VALUES
(1, 'Admin', '2022-11-05 07:00:25', NULL, 1),
(2, 'User', '2014-06-04 11:17:34', NULL, 0),
(3, 'Guest', '2014-06-04 11:17:34', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  `banned_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `role_id`, `status`, `email`, `username`, `password`, `auth_key`, `access_token`, `logged_in_ip`, `logged_in_at`, `created_ip`, `created_at`, `updated_at`, `banned_at`, `banned_reason`, `new_email`, `api_key`) VALUES
(1, 1, 1, 'admin@localhost.com', 'admin', '$2y$10$xKehUS4XJcmfQ8nPVczrw.ZzDCK8y8lJnf7G5UY48vW80FNJf711i', 'KSQVZx_QRLt7Jic-WL2uzQl6tNlHyrE9', NULL, '::1', '2022-11-05 08:37:58', NULL, '2014-06-04 11:17:34', '2016-06-05 00:21:36', NULL, NULL, NULL, '1UneDlwyKNYl8VL2uFD2B6LqHtbXydN8'),
(2, 2, 1, 'demo@localhost.com', 'demo', '$2y$13$BMXGoquhph6.YvhEV8nVye3MzM/4lx.z0.OY0UwhypuIQTR1uvUqe', 'mX2t9ZBulMzPV9I3tyxXh7EVKjtJk6_u', NULL, '127.0.0.1', '2014-06-05 19:19:52', '127.0.0.1', '2014-06-05 18:53:22', '2016-06-05 00:21:52', NULL, NULL, NULL, 'sCxWJ9oSziMovuFGZIM1XJlCwfDNSeg9'),
(3, 1, 1, 'ntdon@tma.com.vn', 'ntdon', '$2y$13$Ywpzb5y/anrwCtwyJYikLub8X9SfObxQJXZgMJs2HDs/5yI1LwJhi', '6m8kN25r7r4eSz20rnrX0m5BHirE_kxi', NULL, '10.250.193.114', '2018-06-15 13:21:04', NULL, '2018-06-13 20:49:22', '2018-06-14 18:23:48', NULL, NULL, NULL, 'xJ1SA1P2StXD0yanZMAT_BAU2TbzBJED'),
(4, 2, 1, 'ntdon2@tma.com.vn', 'ntdon2', '$2y$13$a7ikCb.W.zjddY0CiO.DFe8/cKLeJY6cQ64MnObVhhD./VuaJuiw.', 'QbzZI0MYhHyCpB0MXbfI6nNX1AK7YmfF', NULL, '10.250.193.114', '2018-06-14 19:37:24', NULL, '2018-06-13 21:33:26', NULL, NULL, NULL, NULL, 'FIKUlB0HwHGfBDeO9qz_7gaUZrHqi4lR'),
(5, 1, 1, 'nguyentruongson@tma.com.vn', 'sonnt', '$2y$13$X..tCJ1fm7tKclkyreLQBu7Ur99aqcSwhykLAvNudP5TQd1IWHtWy', 'noDmopMLhdv1ATVT_-K6UB09H7wvED2t', NULL, NULL, NULL, NULL, '2018-06-13 21:56:40', '2018-06-14 18:23:40', NULL, NULL, NULL, 'RkIseQPk907nYOI7sSjdKaF-l7sHtOVr'),
(6, 2, 1, 'lttrung@tma.com.vn', 'lttrung', '$2y$13$5JQ3xeC2877RchqL1cjEjuVtvQERJExDt1yqLxp6F8p2GZ5tjGDEO', 'bmrjL5UyFH3rPM1z_wxEInd2hqzjYP_E', NULL, '172.16.32.183', '2018-06-15 02:56:39', NULL, '2018-06-14 11:47:05', '2018-06-14 17:42:41', NULL, NULL, NULL, 'FIEq64pRDvpEDGclnV_UzXKZLqLgMa4p'),
(7, 2, 1, 'ltdat@tma.com.vn', 'ltdat', '$2y$13$v1cmM3q2J7lMTldL0m2h4ef8rBXCe5kCSBrdPxfjwxENzXHbUQtCG', '9TjW1Hgz_L9abQPeZEdzln-VwAfRBY3u', NULL, '10.250.194.131', '2018-06-15 03:37:25', NULL, '2018-06-14 11:48:53', '2018-06-14 18:04:56', NULL, NULL, NULL, 'qZqVDTxiwj7lNSal5QCC2zxvjZGN-njz'),
(8, 2, 1, 'hnthanh@tma.com.vn', 'hnthanh', '$2y$13$hbMs3QNR2plz3ivKFSHNDu2VtH8QXUl4ADP8eRRstudHQm54WG8Ta', 'ZMNR-uMcz9XILzheiaClDFo2DZUw4PUO', NULL, '172.17.0.52', '2018-06-14 19:23:26', NULL, '2018-06-14 14:44:02', NULL, NULL, NULL, NULL, 'zvSyaPCQPFKwlpnOopAVpusSVTyZTPl9'),
(10, 2, 1, 'vcduy@tma.com.vn', 'vcduy', '$2y$13$k0eQO/cJaV0n3toU04ciKuHXKFljxswARIFMH3G.7.KKGZzer6sZ.', '3G_Mpjbxf2uCH6f2b46nxbUj6YEj9P6D', NULL, '192.168.10.150', '2018-06-14 17:54:23', NULL, '2018-06-14 17:46:21', NULL, NULL, NULL, NULL, 'zhRmRb2Nk4dnCubLoRtdZaWDifyGTv1x'),
(11, 2, 1, 'hthong@tma.com.vn', 'hthong', '$2y$13$rlKMhhu8Zln3uC8bNekkGOgq/oBc08g9jR82RqtETCFAnRU0fe.DO', 'j9YhDEKhc-c40ZFPnC5zMjdEt5Nyiz94', NULL, '10.250.193.15', '2018-06-14 17:50:31', NULL, '2018-06-14 17:49:21', NULL, NULL, NULL, NULL, 'CXkKPzfbvy2_6TQGjB4SiE7MmHZsnC-V'),
(12, 2, 1, 'tttoai@tma.com.vn', 'tttoai', '$2y$13$t.tCj7JsN.pHt7/MAuAk3uQkMbMT7J.hLgf0iEu6rlj2ooSUBSgtO', 'WZORRX-4Kzdvj6J-g5HZjWIK86hR3UJF', NULL, '192.168.31.18', '2018-06-15 17:46:19', NULL, '2018-06-14 17:54:39', '2018-06-15 18:58:37', NULL, NULL, NULL, 'x7zMmPHRyRssfZ4vhixM-qY8ajlaIYTW'),
(13, 2, 1, 'toai.truong@tma.com.vn', 'toai_truong', '$2y$13$sjjNCR8qU0hVXBNiIyTWJOc7re38ylb8n86fiU250Q.ALgqJnJr8K', 'IsCwM5920vsKzRrJ0sogAi0YSE1z17Gq', NULL, '192.168.31.18', '2018-06-15 19:11:39', NULL, '2018-06-14 17:55:46', '2018-06-15 18:58:49', NULL, NULL, NULL, 'zTnlsJFddNrUv95HpkCJZ9fzUBZw1R0x'),
(14, 2, 1, 'tlnhan@tma.com.vn', 'tlnhan', '$2y$13$KQyiUAjWTrIt.MCjMHRXEO/ha2ZEH5g/b2KSQfyeUHDroL8sQqAmW', 'RZTs112dfahtpH_RM5idKtmqUBgMH0dT', NULL, '10.250.193.211', '2018-06-14 18:09:48', NULL, '2018-06-14 17:59:57', NULL, NULL, NULL, NULL, 'vrWHqo6BYTYF_hc_zJmX4UYZSBAa9oix'),
(15, 2, 1, 'ncqphong@tma.com.vn', 'ncqphong', '$2y$13$/pg8dOjFxX/9y8NtkRia1OiL42bwr.4EIzy72O2ti/kR1T6VxYeWW', '5wBJBRY9Lm-cOklJmvqTSHtwEVaaUfiy', NULL, '10.250.193.107', '2018-06-15 19:00:18', NULL, '2018-06-14 18:08:55', NULL, NULL, NULL, NULL, '2cMb_wc11aJ82fzTySBjm4VJh0HXUQ-W'),
(16, 2, 1, 'nttung@tma.com.vn', 'nttung', '$2y$13$ltJkZMD7mAf9AdBrmXpKYukwhFLgWTUmj5XFvzouwt.3IMfh/7.GG', 'Ya20EEk3_X-XSg1SojYlBVoqDT3Sp8bt', NULL, '10.250.194.131', '2018-06-14 23:57:53', NULL, '2018-06-14 18:21:41', NULL, NULL, NULL, NULL, '8o-DsR9-rIGWWw7J4l6kEzQ7AGF-jYh5'),
(17, 2, 1, 'dttuan@tma.com.vn', 'dttuan', '$2y$13$nrkgKxYHTl/03.qihNMeA.DKwJdNk2JKHkA9yVLezFlB6fryaGTru', 'qxrBpepDw9vyDmqZPe-kWwVqxibot7OL', NULL, '10.250.193.40', '2018-06-15 19:40:34', NULL, '2018-06-14 18:23:28', NULL, NULL, NULL, NULL, 'gE1H48tqRCypcFWfrRpQB1tZxt6WxVlB'),
(18, 2, 1, 'dmnhat@tma.com.vn', 'dmnhat', '$2y$13$EzeX6pI08ucapsrqOjOslOmGZKY2HE1UvhVK9qCJ46vwrC/wKDGya', 'Hb6rsLGXkQsKl-5WpjjuSYLhKDGLPSCe', NULL, '10.250.193.73', '2018-06-14 19:06:06', NULL, '2018-06-14 18:30:46', NULL, NULL, NULL, NULL, 'gHMpN-ZNeZ3lu0pvoxao_FEF8ZOYoI15'),
(19, 2, 1, 'hnan@tma.com.vn', 'hnan', '$2y$13$313fgR3nMqjO7X6gzvXfROAfUcRaEUgvkZ58pMMfFhKZ3zlRT2T1.', 'KruEb-JoPHKCzIjdyhOwYpOech8AbuNT', NULL, '192.168.10.150', '2018-06-15 10:30:52', NULL, '2018-06-14 18:32:44', NULL, NULL, NULL, NULL, 'uswiRNuYivMy015ZWfd_bMMUZzwijMOF'),
(20, 2, 1, 'lvlinh@tma.com.vn', 'lvlinh', '$2y$13$nrJsrXz3Sn7RfrWfSV8dQu9fM42YEgHxp1bEW1P7VTqq3ypVHBO5.', 'craJTM2fVISL8hUeD1_yuQbcFLvsmdOk', NULL, '10.250.193.21', '2018-06-14 18:43:05', NULL, '2018-06-14 18:36:32', NULL, NULL, NULL, NULL, 'rBDZ3YAbEFj2O19oq4Z36Gj37ndKKbeb'),
(21, 2, 1, 'dnluyen@tma.com.vn', 'dnluyen', '$2y$13$6hyE8fqRzEy.Cn8VmB.YSeEdxTZH9BBl11qUTbyz3Esr1mveK40FW', 'y6QY0Z_UHJ0ssZAhwxLgP9IX9G9NUQPA', NULL, '10.250.193.83', '2018-06-15 15:30:37', NULL, '2018-06-14 18:39:44', NULL, NULL, NULL, NULL, 'oFDqXcZewT5yXtouv9jFZu6qcvoLLsg8'),
(22, 2, 1, 'tpvhiep@tma.com.vn', 'tpvhiep', '$2y$13$QHgz0bn6FYSBbc7e6Zzf0.3yYUfC1rvbw0csVqxDqIDIzhRlACfu6', '0y2VlSgCNZ2F4H_s2BTFFNKYzAILydVj', NULL, '172.16.32.229', '2018-06-15 08:30:45', NULL, '2018-06-14 19:05:45', NULL, NULL, NULL, NULL, 'CbMB--VIMh0Kx5y3xJNkJBtXdYf7-_qr'),
(23, 2, 1, 'txbinh@tma.com.vn', 'txbinh', '$2y$13$pmg2GlKJe8PUrNwrpAKpYu3514Imyvj6rPKhB4KgaMA2HYMzDN6Aa', '7dO37ik0lBEwG6LR96ungb7flDzU2v8e', NULL, '10.250.193.91', '2018-06-15 17:39:59', NULL, '2018-06-14 20:52:10', NULL, NULL, NULL, NULL, '-k4hcYE9zHDHNbxtvNZRsLyXb0GGSTpo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userkey`
--

CREATE TABLE `userkey` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL,
  `key` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `consume_time` timestamp NULL DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `userkey`
--

INSERT INTO `userkey` (`id`, `user_id`, `type`, `key`, `create_time`, `consume_time`, `expire_time`) VALUES
(1, 2, 1, 'ToLB9LOW4FKq-yHNlF8qF3Fh7BxD0YrM', '2014-06-05 18:58:44', NULL, NULL),
(2, 1, 2, 'dQUAsDInj-6TLB7PrtDaPy1auQ7o2ILq', '2014-06-10 21:04:27', NULL, '2014-06-10 21:49:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_auth`
--

CREATE TABLE `user_auth` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_attributes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` smallint(6) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`email`),
  ADD UNIQUE KEY `user_username` (`username`),
  ADD KEY `user_role_id` (`role_id`);

--
-- Chỉ mục cho bảng `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_auth_provider_id` (`provider_id`),
  ADD KEY `user_auth_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_token_token` (`token`),
  ADD KEY `user_token_user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `user_auth`
--
ALTER TABLE `user_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Các ràng buộc cho bảng `user_auth`
--
ALTER TABLE `user_auth`
  ADD CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `user_token`
--
ALTER TABLE `user_token`
  ADD CONSTRAINT `user_token_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
