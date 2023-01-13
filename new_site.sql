-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 13, 2023 lúc 09:09 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vongquay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(5) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `google_picture` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rules` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `point` int(15) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `phone`, `coin`, `token`, `email_id`, `fullname`, `create_at`, `google_picture`, `rules`, `status`, `point`) VALUES
(1, 'quyendz', '4297f44b13955235245b2497399d7a93', 'quyendz1509@gmail.com', '0915606449', '116', '4d3ebc5065ff690afa55d99deb0f9d28223d20a56e61a69a229afcff765cd53613db241b', NULL, 'QUYEN DEP TRAI', '2022-11-19 14:30:32', NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_history`
--

CREATE TABLE `admin_history` (
  `id` int(5) NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_history`
--

INSERT INTO `admin_history` (`id`, `noidung`, `create_time`) VALUES
(1, 'Admin đăng nhập với thiết bị: ::1', '2023-01-13 03:34:37'),
(2, 'Admin đăng nhập với thiết bị: ::1', '2023-01-13 04:38:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(1) NOT NULL,
  `trangthai` tinyint(1) DEFAULT 0,
  `notice` text COLLATE utf8_unicode_ci NOT NULL,
  `status_notice` tinyint(1) NOT NULL DEFAULT 0,
  `role_admin` tinyint(1) NOT NULL DEFAULT 1,
  `thongtin_home` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_url` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_title` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `trangthai`, `notice`, `status_notice`, `role_admin`, `thongtin_home`, `web_name`, `web_url`, `web_description`, `web_title`) VALUES
(1, 1, 'NẠP THẺ CÀO, ATM, MOMO HOÀN TOÀN TỰ ĐỘNG 100% QUÁ 5 PHÚT VUI LÒNG NHẮN TIN VÀO FANPAGE HỖ TRỢ', 1, 1, '<p><span style=\"font-size:18px\"><strong>Nạp tiền</strong> : <a href=\"/nap-thecao.html\"><span style=\"color:#e74c3c\"><span style=\"background-color:#f1c40f\">THẺ C&Agrave;O</span></span></a> | <a href=\"/naptudong.html\"><span style=\"color:#e74c3c\"><span style=\"background-color:#f1c40f\">ATM - V&Iacute; ĐIỆN TỬ AUTO</span></span></a></span></p>\n\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://cdn.discordapp.com/emojis/929897997465174016.gif\" style=\"height:28px; width:30px\" />&nbsp;CH&Igrave;A KH&Oacute;A MIỄN PH&Iacute; V&Agrave;O NG&Agrave;Y MAI <img alt=\"????‍????\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t91/1/16/1f469_200d_1f393.png\" style=\"height:16px; width:16px\" /></span></p>\n\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://cdn.discordapp.com/emojis/929897997465174016.gif\" style=\"height:28px; width:30px\" />&nbsp;BOX ZALO 1 : <a href=\"https://zalo.me/g/ishvft644\"><span style=\"color:#3498db\">BẤM</span></a> <img alt=\"????‍????\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t62/1/16/1f9d1_200d_1f393.png\" style=\"height:16px; width:16px\" /></span></p>\n\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://cdn.discordapp.com/emojis/929897997465174016.gif\" style=\"height:28px; width:30px\" />&nbsp;BOX ZALO 2 : <a href=\"https://zalo.me/g/krojme868\"><span style=\"color:#3498db\">BẤM</span></a> <img alt=\"????‍????\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tb2/1/16/1f468_200d_1f393.png\" style=\"height:16px; width:16px\" /></span></p>\n\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://cdn.discordapp.com/emojis/929897997465174016.gif\" style=\"height:28px; width:30px\" />&nbsp;BOX ZALO CH&Iacute;NH : <a href=\"https://zalo.me/g/znyxez973\"><span style=\"color:#3498db\">BẤM</span></a> <img alt=\"????‍♂\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tf6/1/16/1f482_200d_2642.png\" style=\"height:16px; width:16px\" /></span></p>\n\n<p><span style=\"font-size:18px\"><img alt=\"\" src=\"https://cdn.discordapp.com/emojis/929897997465174016.gif\" style=\"height:28px; width:30px\" />&nbsp;BOX RI&Ecirc;NG GAMOD HACK : <a href=\"https://zalo.me/g/rvbrqx812\"><span style=\"color:#3498db\">BẤM</span></a></span></p>\n\n<p><span style=\"font-size:18px\"><img alt=\"????\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t94/1/16/1f947.png\" style=\"height:16px; width:16px\" />ADMIN ZALO ( KH&Aacute;NH) <span style=\"color:#c0392b\"><strong>0985957516 </strong></span><img alt=\"????\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t94/1/16/1f947.png\" style=\"height:16px; width:16px\" /></span></p>\n\n<p><span style=\"font-size:16px\">ZALO CRVRED CHỦ GAMOD <span style=\"color:#e74c3c\"><strong>0987658766 </strong></span>HOẶC <span style=\"color:#2ecc71\"><strong>@ADMK93</strong></span> ZALO <strong><span style=\"color:#3498db\">0985957516</span></strong> <img alt=\"????\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/te/1/16/1f985.png\" style=\"height:16px; width:16px\" /> GR FB :<span style=\"color:#e74c3c\"> </span><a href=\"https://www.facebook.com/groups/342327004752606/?ref=share_group_link\"><span style=\"color:#3498db\">B&Aacute;M</span></a></span></p>\n', 'webname', 'http://locahost', 'Chơi càng nhiều ra nước càng chất', 'Vòng quay may mắn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vongquay`
--

CREATE TABLE `vongquay` (
  `id` int(15) NOT NULL,
  `ten_vat_pham` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ti_le` int(15) NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: hoạt động\r\n1: tạm ngưng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vongquay`
--

INSERT INTO `vongquay` (`id`, `ten_vat_pham`, `ti_le`, `icon`, `status`) VALUES
(1, 'Iphone14', 20, '/public/uploads/iphone14.webp', 0),
(2, 'ipad', 2, '/public/uploads/ipad.webp', 0),
(3, 'airpod', 50, '/public/uploads/airpod.webp', 0),
(4, 'Laptop gigabyte', 2, '/public/uploads/gigabyte.webp', 0),
(5, 'Chúc bạn may mắn lần sau', 10, '/public/uploads/mayman.png', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admin_history`
--
ALTER TABLE `admin_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vongquay`
--
ALTER TABLE `vongquay`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `admin_history`
--
ALTER TABLE `admin_history`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `vongquay`
--
ALTER TABLE `vongquay`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
