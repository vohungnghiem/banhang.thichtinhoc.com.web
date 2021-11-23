-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2021 lúc 10:39 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thichtin_banhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_13_155634_create_permission_tables', 2),
(6, '2021_10_21_014521_create_vhn_suppliers_table', 3),
(7, '2021_10_21_030525_create_vhn_products_table', 4),
(8, '2021_10_22_051246_create_vhn_in_exs_table', 5),
(9, '2021_10_22_065827_create_vhn_phieus_table', 6),
(10, '2021_10_22_085258_create_vhn_hoadon_pros_table', 7),
(11, '2021_10_22_090913_create_vhn_hd_sanphams_table', 8),
(12, '2021_10_22_092936_create_vhn_hd_tunhaps_table', 9),
(13, '2021_10_27_032023_create_vhn_hoadon_scs_table', 10),
(14, '2021_10_27_135730_create_vhn_hd_kiemtras_table', 11),
(15, '2021_10_27_135819_create_vhn_hd_suachuas_table', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 0),
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 0),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'list-super', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(2, 'add-super', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(3, 'edit-super', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(4, 'delete-super', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(5, 'password', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(6, 'list-editor', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(7, 'add-editor', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(8, 'edit-editor', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(9, 'delete-editor', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(10, 'list-other', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(11, 'add-other', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(12, 'edit-other', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(13, 'delete-other', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2021-10-17 21:31:51', '2021-10-17 21:31:51'),
(2, 'admin', 'web', '2021-10-17 21:31:51', '2021-10-17 21:31:51'),
(3, 'editor', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52'),
(4, 'other', 'web', '2021-10-17 21:31:52', '2021-10-17 21:31:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(10, 4),
(11, 1),
(11, 2),
(11, 4),
(12, 1),
(12, 2),
(12, 4),
(13, 1),
(13, 2),
(13, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `level` tinyint(4) DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `avatar`, `status`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'supper admin', 'superadmin@ex.com', NULL, '$2y$10$6cAy76dcwOO26lRFWTQP5ubW.faxhzqG.OPDZmYLYfjBG0S/qYwiq', NULL, NULL, 1, 1, NULL, '2021-10-18 07:37:20', '2021-10-18 07:37:20'),
(2, 'admin', 'admin@ex.com', NULL, '$2y$10$Hrnv/uPyVsH543kJYTy6.euESeTTPIuuYb9MdFOF6roh7xdEmqcYm', NULL, 'admin_1634743362.jpg', 1, 2, NULL, '2021-10-20 08:22:42', '2021-10-21 21:52:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_hd_kiemtras`
--

CREATE TABLE `vhn_hd_kiemtras` (
  `id_hd` int(10) UNSIGNED NOT NULL,
  `stt` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benhtrang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dexuat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_hd_kiemtras`
--

INSERT INTO `vhn_hd_kiemtras` (`id_hd`, `stt`, `name`, `benhtrang`, `dexuat`, `ghichu`, `fee`) VALUES
(64, 0, NULL, NULL, NULL, NULL, 0),
(65, 0, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_hd_sanphams`
--

CREATE TABLE `vhn_hd_sanphams` (
  `id_hd` int(10) UNSIGNED NOT NULL,
  `id_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stt` int(11) NOT NULL,
  `id_sp` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_hd_sanphams`
--

INSERT INTO `vhn_hd_sanphams` (`id_hd`, `id_type`, `stt`, `id_sp`, `name`, `quantity`, `price`, `total`, `warranty`) VALUES
(36, 'pro', 0, 16, 'THẺ NHỚ MIXIE 64G', 1, 230000, 230000, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_hd_suachuas`
--

CREATE TABLE `vhn_hd_suachuas` (
  `id_hd` int(10) UNSIGNED NOT NULL,
  `stt` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT 0,
  `fee` int(11) DEFAULT 0,
  `id_congno` int(11) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_hd_suachuas`
--

INSERT INTO `vhn_hd_suachuas` (`id_hd`, `stt`, `name`, `price`, `fee`, `id_congno`) VALUES
(64, 0, 'sửa chửa 1', 1000000, 0, 1),
(64, 1, 'sửa chửa 2', 1000000, 0, 0),
(65, 0, 'thiet vi 2 1', 1000000, 0, 1),
(65, 1, 'thiet bi 2 2', 1000000, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_hd_tunhaps`
--

CREATE TABLE `vhn_hd_tunhaps` (
  `id_hd` int(10) UNSIGNED NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_hoadon_pros`
--

CREATE TABLE `vhn_hoadon_pros` (
  `id` int(10) UNSIGNED NOT NULL,
  `mahoadon` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `tenkh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loinhuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT 1,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_hoadon_pros`
--

INSERT INTO `vhn_hoadon_pros` (`id`, `mahoadon`, `thoigian`, `tenkh`, `diachi`, `sdt`, `loinhuan`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(36, 1, '2021-11-23 00:00:00', 'nghiem', NULL, '012', NULL, NULL, 1, '2021-11-22 23:44:15', '2021-11-22 23:46:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_hoadon_scs`
--

CREATE TABLE `vhn_hoadon_scs` (
  `id` int(10) UNSIGNED NOT NULL,
  `mahoadon` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `ngaytra` datetime DEFAULT NULL,
  `tenkh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dulieucangiu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loaidichvu` int(11) DEFAULT 1,
  `loinhuan` bigint(20) DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT 1,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_hoadon_scs`
--

INSERT INTO `vhn_hoadon_scs` (`id`, `mahoadon`, `thoigian`, `ngaytra`, `tenkh`, `diachi`, `sdt`, `email`, `dulieucangiu`, `loaidichvu`, `loinhuan`, `ghichu`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(64, 2, '2021-11-23 00:00:00', '2021-12-03 00:00:00', 'nghiem 1', NULL, '01235456', NULL, NULL, 1, 400000, NULL, NULL, 4, '2021-11-22 23:33:34', '2021-11-23 00:15:08'),
(65, 3, '2021-11-23 00:00:00', '2021-12-03 00:00:00', 'nghiem 2', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, '2021-11-23 01:47:26', '2021-11-23 01:47:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_phieus`
--

CREATE TABLE `vhn_phieus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `fee` bigint(20) DEFAULT NULL,
  `date_import` datetime DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT 1,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_phieus`
--

INSERT INTO `vhn_phieus` (`id`, `name`, `type`, `fee`, `date_import`, `file`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Tiền nhà tháng 9', 2, 5000000, '2021-10-06 00:00:00', NULL, 1, 1, '2021-10-05 17:00:00', '2021-10-29 22:09:20'),
(4, 'Vốn kinh doanh', 1, 50000000, '2021-09-01 00:00:00', NULL, 1, 1, '2021-10-06 17:00:00', '2021-10-06 17:00:00'),
(5, 'Mua Tua Vit', 2, 250000, '2021-10-08 00:00:00', NULL, 1, 1, '2021-10-07 17:00:00', '2021-10-07 17:00:00'),
(6, 'Bộ test bàn phím laptop', 2, 633000, '2021-10-10 00:00:00', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(7, 'Khăn vệ sinh máy', 2, 191000, '2021-10-13 00:00:00', NULL, 1, 1, '2021-10-12 17:00:00', '2021-10-12 17:00:00'),
(8, 'thêm vốn', 1, 20000000, '2021-10-13 00:00:00', NULL, 1, 1, '2021-10-12 17:00:00', '2021-10-12 17:00:00'),
(9, 'Mua 2 ghế xoay', 2, 631000, '2021-10-18 00:00:00', NULL, 1, 1, '2021-10-17 17:00:00', '2021-10-17 17:00:00'),
(10, 'Mua nhíp công mũi nhọn inox', 2, 182000, '2021-10-19 00:00:00', NULL, 1, 1, '2021-10-18 17:00:00', '2021-10-18 17:00:00'),
(11, 'Mua tay hàn + mỏ hàn', 2, 270000, '2021-10-21 00:00:00', NULL, 1, 1, '2021-10-20 17:00:00', '2021-10-20 17:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_products`
--

CREATE TABLE `vhn_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price_sale` bigint(20) DEFAULT NULL,
  `price_import` bigint(20) DEFAULT NULL,
  `date_import` datetime DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT 1,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_products`
--

INSERT INTO `vhn_products` (`id`, `name`, `image`, `quantity`, `price_sale`, `price_import`, `date_import`, `id_supplier`, `warranty`, `location`, `location_image`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(4, 'DDR3 PC 1G SAMSUNG (HÀNG CŨ)', '2021-09-25ddr3-pc-2g1600-kingmax-renew1608693478.jpg', 3, 70000, 0, '2021-09-25 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(5, 'DDR3 PC 1G HYNIZ (HÀNG CŨ)', '2021-09-25RAM-Desktop-DDR3-Hynix-4GB-Bus-1333.jpg', 6, 70000, 0, '2021-09-25 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(6, 'DDR3 PC 2G KINGSTON (HÀNG CŨ)', '2021-09-25ROG_Zephyrus_G15_wallpaper_2560x1440.jpg', 2, 150000, 0, '2021-09-25 00:00:00', 4, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(7, 'DDR3 PC 2G KINGMAX (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 1, 150000, 0, '2021-09-25 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(8, 'DDR3 PC 2G HYNIZ (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 1, 150000, 0, '2021-09-25 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(9, 'DDR3 PC 4G KINGSTON (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 1, 290000, 0, '2021-09-25 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(10, 'DDR3 PC 8G KINGSTON (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 1, 600000, 0, '2021-09-25 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(11, 'DDR3 PC 8G SAMSUNG (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 1, 600000, 0, '2021-09-25 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(12, 'DDR3 LAPTOP 4G HYNIX/KINGSTON/SAMSUNG (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 5, 450000, 0, '2021-09-25 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(13, 'DDR3 LAPTOP 2G HYNIX/KINGSTON/SAMSUNG (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 3, 150000, 0, '2021-09-25 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(14, 'DDR2 LAPTOP 1G HYNIX/KINGSTON/SAMSUNG (HÀNG CŨ)', '2021-09-25RAM-Desktop-DDR3-Hynix-4GB-Bus-1333.jpg', 7, 50000, 0, '2021-09-25 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(15, 'DDR4 LAPTOP 4G HYNIX/KINGSTON/SAMSUNG (HÀNG CŨ)', '2021-09-25unnamed(3).jpg', 2, 450000, 0, '2021-09-25 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(16, 'THẺ NHỚ MIXIE 64G', '2021-05-13the-nho-microsd-64g-mixie-box-class10-95mbs-chinh-hang1621837821.png', 0, 230000, 126000, '2021-05-13 00:00:00', 5, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(17, 'USB 2.0 16G TOSHIBA', '2021-03-26usb-20-16g-toshiba-cong-ty1611472469_149.82578397213x250.png', 5, 120000, 62000, '2021-03-26 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(18, 'USB 2.0 8G TOSHIBA', '2021-03-26usb-20-8g-toshiba-cong-ty1611472464_149.82578397213x250.png', 3, 100000, 60000, '2021-03-26 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(19, 'USB 2.0 4G TOSHIBA', '2021-03-26usb-20-4g-toshiba-cong-ty1611472449_149.82578397213x250.png', 3, 80000, 48000, '2021-03-26 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(20, 'Thẻ nhớ MicroSD 32G TEAMGROUP', '2021-03-26the-nho-microsd-32g-teamgroup-box-class10-chinh-hang-chuyen-dung-camera1608464193_250.31055900621x250.jpg', 6, 150000, 98000, '2021-03-26 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(21, 'USB 2.0 32G KINGSTON SE9 Mini Công ty', '2021-01-01usb-20-32g-kingston-se9-mini-cong-ty1611478272.png', 1, 140000, 81000, '2021-01-01 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(22, 'USB Bluetooth Mini 06 v2.0 (Dùng cho PC)', '2020-10-03usb-bluetooth-mini-061526979514_300x240.jpg', 6, 40000, 24000, '2020-10-03 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(23, 'USB Bluetooth YET M1 (Dùng cho Loa, Amply...)', '2020-10-13usb-bluetooth-yet-m11585389994_300x168.75.jpg', 9, 50000, 24000, '2020-10-13 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(24, 'Cáp chuyển HDMI ra VGA (có audio)', '2020-10-13unnamed.jpg', 1, 80000, 41000, '2020-10-13 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(25, 'USB ra sound 7.1 3D Hình phi thuyền - 4 jack cắm', '2021-01-01usb-ra-sound-71-3d-hinh-phi-thuyen-4-jack-cam1560853056.jpg', 2, 74000, 38000, '2021-01-01 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(26, 'CaddyBay 9.5', '2021-01-01b0e285e6ffc7d3e128fddf1043fd6e46.jfif', 1, 100000, 32000, '2021-01-01 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(27, 'USB thu Wifi PIXLINK LV-UW10 (có anten)', '2021-09-01f6dc52ecb5cd367f479b8b61f78dc301.jfif', 4, 100000, 65000, '2021-01-01 00:00:00', 1, 6, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(28, 'USB thu Wifi 802.11 (Nano – Mẫu mới – ko Anten)', '2021-01-01947c81f14ec1e5351fffe21c483efc60.jfif', 9, 80000, 40000, '2021-01-01 00:00:00', 1, 6, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(29, 'Keo tản nhiệt ống chích lớn', '2021-01-01keo-tan-nhiet-ong-chich-lon1526381162.jpg', 4, 30000, 13000, '2021-01-01 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(30, 'Cáp DisplayPort to HDMI', '2021-01-0115118636718113.jpg', 7, 70000, 35000, '2021-01-01 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(31, 'Cáp DisplayPort to VGA', '2021-01-01cable-displayport-to-vga1608882670_300x206.1872909699.jpg', 6, 60000, 42000, '2021-01-01 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(32, 'USB ra sound 7.1 dạng dây', '2021-01-01usb-ra-sound-71-dang-day-apple1560852957.jpg', 5, 67000, 29000, '2021-01-01 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(33, 'Cáp chuyển Mini HDMI ra HDMI 1.5m', '2021-09-25cap-chuyen-mini-hdmi--hdmi-15m1577336873.jpg', 5, 50000, 32000, '2021-09-25 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(34, 'Cáp chuyển Type-C ra VGA', '2021-09-25cap-chuyen-typec-ra-vga1573150995.jpg', 2, 150000, 79000, '2021-09-25 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(35, 'Cáp chuyển USB 3.0 ra VGA', '2021-09-26c55838807d58e06f32b0743047e9510a.jpg_2200x2200q80.jpg_.webp', 5, 300000, 150000, '2021-09-26 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(36, 'Cáp USB nối dài 5m Chống nhiễu 2.0', '2021-09-26cable-usb-noi-dai-5m1522870034.jpg', 3, 40000, 20000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(37, 'Cáp USB nối dài 3m Chống nhiễu 2.0', '2021-09-26cable-usb-noi-dai-5m1522870034.jpg', 10, 35000, 15000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(38, 'Cáp USB nối dài 1.5m Chống nhiễu 2.0', '2021-09-26cable-usb-noi-dai-5m1522870034.jpg', 7, 30000, 11000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(39, 'Cáp Máy in 1.5m Chống nhiễu 2.0', '2021-09-26cable-may-in-15m-usb-201527056140.jpg', 7, 40000, 11000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(40, 'Cáp VGA 1.8m SAMSUNG Zin Chống nhiễu', '2021-09-26cable-vga-18m-den-zin-samsung-chong-nhieu-theo-may1573015549.jpg', 2, 50000, 22000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(41, 'Cáp nguồn PC loại tốt', '2021-09-26day-nguon-2-chan-dau-tron-tot1523856298.jpg', 19, 30000, 13000, '2021-09-26 00:00:00', 1, 0, 'Thùng Cable số 1', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(42, 'Cáp nguồn số 8 loại tốt', '2021-09-26day-nguon-so-81523856388.jpg', 8, 20000, 9000, '2021-09-26 00:00:00', 1, 0, 'Thùng Cable số 1', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(43, 'Cáp Nguồn Adapter Laptop 1.5m', '2021-09-26day-nguon-adapter-zin1523856479.jpg', 18, 30000, 13000, '2021-09-26 00:00:00', 1, 0, 'Thùng Cable số 1', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(44, 'Cáp HDMI 1.5m VSP', '2021-09-26qsKT85z4DiTftS44cJO2_simg_d0daf0_800x1200_max.jpg', 14, 60000, 37000, '2021-09-26 00:00:00', 1, 1, 'Thùng Cable số 1', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(45, 'Cáp USB Type C 3A dài 2m', NULL, 20, 100000, 30000, '2021-09-26 00:00:00', 1, 0, 'Thùng Cable số 1', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(46, 'Cáp Micro USB 2m', NULL, 13, 50000, 22000, '2021-09-26 00:00:00', 1, 0, 'Thùng Cable số 1', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(47, 'Cáp nối dài 4pin', '2021-09-26unnamed(1).jpg', 49, 30000, 10000, '2021-09-26 00:00:00', 6, 0, 'Thùng Cable số 2', NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(48, 'Cáp SATA (NỐI DÀI)', '2021-09-26cablesatanoidai.png', 5, 50000, 25000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(49, 'Cáp NGUỒN 24PIN (NỐI DÀI)', '2021-09-26fa8dc60102d865a07bf41cf71fb36d07.jfif', 7, 50000, 24000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(50, 'Cáp Nguồn Sata 1 ra 2 góc 90', '2021-09-262021-09-26f82b0fae6c73b549fa353d26e238b534.jpg', 9, 50000, 25000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(51, 'Cáp Nguồn Molex 1 ra 2 Sata', '2021-09-262021-09-265733fcc6ee64a228560daeb545e30d1a.jpg', 20, 20000, 6500, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(52, 'Cáp nguồn 2 Molex sang 8Pin PCI-E', '2021-09-26cap-nguon-2-molex-ata-sang-8pin-pci-e-vga-phukienpc-vn-1.jpeg', 5, 75000, 50000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(53, 'Cáp nguồn 2 Molex ATA sang 6pin  VGA', '2021-09-263efa620146c65b7b68ef1a37761f0ed4.jpg', 5, 70000, 40000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(54, 'Cáp sata sang 8pin pcie Cho VGA', '2021-09-26cap-nguon-sata-to-8pin-pci-e-card-vga-phukienpc-vn-3.jpg', 5, 100000, 79000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(55, 'Cáp chia Fan Molex ra 4 fan (chuẩn 4pin)', '2021-09-26screenshot_1632659955.jpeg', 21, 35000, 20000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(56, 'Cáp gộp tai nghe và mic ra jack 3,5mm Cái', '2021-09-26a58622455932ccea8ecbf88ebdd45941.jpg', 14, 30000, 14000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(57, 'jack chia loa chuẩn 3.5mm 1 ra 2 loa', '2021-09-26unnamed(2).jpg', 23, 15000, 8000, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(58, 'Cáp chia loa chuẩn 3.5mm 1 ra 2 loa', '2021-09-261af716ba50492dcec4a8906db5047b29.jfif', 10, 20000, 11200, '2021-09-26 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(59, 'Cáp 3.5mm chia Tai nghe và Loa', '2021-09-26cap-chia-tai-nghe-va-mic-audio-mic-splitter-den-500x500.jpg', 10, 50000, 32000, '2021-09-26 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(60, 'Cáp chuyển USB ra cổng 3.5 (1 Audio và 1 Mic)', '2021-09-26usb-ra-sound-71-dang-day-apple1560852957.jpg', 2, 100000, 79000, '2021-09-26 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(61, 'Cáp HDMI 3m Dây dẹp Full HD', '2021-09-26cable-hdmi-3m-14-full-hd1527017315.jpg', 6, 80000, 25000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(62, 'Cáp 1 đầu 3.5mm ra 2 đầu AV dài 1.5m', '2021-09-26cap-loa-unitek-yc9041554749623.jpg', 7, 50000, 35000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(63, 'Cáp 3.5mm Loa nối dài 1.5m', '2021-09-26cable-loa-noi-dai-15m1548239769.jpg', 10, 30000, 11000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(64, 'SP Test', NULL, 996, 10000, 0, '2021-09-26 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(65, 'SP Test', NULL, 1000, 10000, 0, NULL, 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(66, 'Cáp 3.5mm Loa nối dài 5m', '2021-09-26cable-loa-noi-dai-15m1548239769.jpg', 2, 80000, 50000, '2021-09-26 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(67, 'Cáp Loa 2 đầu 3.5mm dài 1.5m', '2021-09-26cable-loa-2-dau-35-dai-15m1548239515.jpg', 6, 30000, 10000, '2021-09-26 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(68, 'DDR4 PC 8G/2400 KINGMAX RENEW', '2021-03-01unnamed(3).jpg', 2, 750000, 680000, '2021-03-01 00:00:00', 1, 36, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(69, 'DDR4 PC 4G/2400 KINGMAX RENEW', '2021-03-01unnamed(3).jpg', 5, 470000, 345000, '2021-03-01 00:00:00', 1, 36, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(70, 'DDR3 PC 4G/1600 KINGMAX RENEW', '2021-03-01ddr3-pc-4g1600-kingmax-renew1608693488.jpg', 3, 480000, 325000, '2021-03-01 00:00:00', 1, 36, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(71, 'DDR3 PC 8G/1600 KINGMAX RENEW', '2021-03-01ddr3-pc-4g1600-kingmax-renew1608693488.jpg', 5, 850000, 660000, '2021-03-01 00:00:00', 1, 36, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(72, 'Switch PoE HRUI HR901-AF-82N Chính hãng (10/100M 8 port)', '2021-09-27switch-poe-hieu-hrui-hr901af82n-10100m-8-ports1582955718.png', 1, 850000, 500000, '2021-09-27 00:00:00', 3, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(73, 'BOX HDD WD 2.5\\\" - USB 3.0', '2021-09-27hdd-box-wd-elements-2tb1573469610.jpeg', 1, 175000, 10000, '2021-09-27 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(74, 'HDD Box WD ELEMENTS 1TB 2.5” USB 3.0 Chính Hãng', '2021-09-2713439______c____ng_di_______ng_western_digital_element_1tb_usb3_0.jpg', 1, 1750000, 1530000, '2021-09-27 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(75, 'SSD BamBa 120G', '2021-09-19SSD120GBBMOI2.jpg', 0, 650000, 450000, '2021-09-19 00:00:00', 2, 36, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(76, 'Hub Usb Type C ra 3 cổng usb + 1 Lan', '2021-09-27a1852fb36728171d5efe5ffe3705e038.jfif', 4, 150000, 100000, '2021-09-27 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(77, 'USB đọc thẻ nhớ', '2021-09-27readernhựa(1).png', 1, 50000, 10000, '2021-09-27 00:00:00', 2, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(78, 'SP Test', NULL, 3, 1500000, 1000000, NULL, 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(79, 'HDD Laptop SEAGATE 1T', '2021-09-29hdd-laptop-seagate-1tb-slim1561955934.jpeg', 2, 1250000, 750000, NULL, 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(80, 'HDD Laptop SEAGATE 500G', '2021-01-01hdd-laptop-seagate-500gb-sata-bh-24t1522893999.jpeg', 1, 750000, 305000, '2021-01-01 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(81, 'HDD Laptop HITACHI 750G', '2021-09-2971JB-FexZQL._AC_SS450_.jpg', 1, 850000, 0, '2021-09-29 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(82, 'HDD PC SEAGATE 500G', '2021-09-29hdd-pc-500g-seagate-new1523016711.jpeg', 1, 500000, 0, NULL, 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(83, 'HDD PC SEAGATE 500G', '2021-09-29hdd-pc-500g-seagate-new1523016711.jpeg', 1, 500000, 0, '2021-09-29 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(84, 'Adapter laptop dell kim lớn 65w', '2021-04-26adapter-dell-195v334a-65w1523950471.jpeg', 3, 320000, 115000, '2021-04-26 00:00:00', 4, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(85, 'Adapter DELL 19.5V-4.62A (90W)', '2021-09-29adapter-dell-195v334a-65w1523950471.jpeg', 2, 340000, 125000, '2021-04-26 00:00:00', 4, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(86, 'Adapter SONY 19.5V-4.7A', '2021-04-26adapter-sony-195v47a1523950322.jpeg', 3, 300000, 100000, '2021-04-26 00:00:00', 4, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(87, 'Adapter ZIN ACER 19V – 4.7A', '2021-09-29adapter-zin-acer-19v47a1523991962.jpeg', 3, 320000, 120000, '2021-04-26 00:00:00', 4, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(88, 'Adapter ZIN DELL 19.5V – 4.62A – Đầu nhỏ', '2021-04-26adapter-dell-195v-462a-90w-dau-nho1548752632.jpeg', 3, 390000, 160000, '2021-04-26 00:00:00', 4, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(89, 'Adapter ASUS 19V – 4.7A', 'adapter-asus-19v-47a1608829780.jpeg', 3, 330000, 105000, '2021-04-26 00:00:00', 4, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(90, 'Adapter ZIN HP 19V – 4.7A (65W) – Đầu kim lớn', 'adapter-zin-hp-185v474a-dau-kim1523991203.jpeg', 2, 330000, 145000, '2021-04-26 00:00:00', 4, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(91, 'ADAPTER BAMBA HP 19.5V - 2.31A (ĐẦU KIM NHỎ)', '2020-12-12HP2,31ADKN.jpg', 1, 300000, 130000, '2020-12-12 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(92, 'nhập test', '2021-09-29cap-nguon-2-molex-ata-sang-8pin-pci-e-vga-phukienpc-vn-1.jpeg', 1, 0, 0, NULL, 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(93, 'Adapter DELL BamBa 19.5V – 4.62A – Đầu nhỏ', 'DELL4,62Adaunho.jpg', 1, 300000, 150000, '2020-05-16 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(94, 'Adapter DELL Zin 19.5V – 4.62A – Đầu nhỏ Ovan', '2020-02-27de4,62dknovan.png', 1, 500000, 320000, '2020-02-27 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(95, 'Bàn phím IBM T430,T530,X230,W530', '2021-09-28T430KOCHUỘT.jpg', 1, 470000, 370000, '2021-09-28 00:00:00', 2, 6, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(96, 'Adapter Acer Zin 19V – 2.37A – Đầu nhỏ', '2021-09-29Sạc_Laptop_Acer_19v-2.37A_đầu_nhỏ_Zin_.jpg', 1, 300000, 110000, '2021-09-29 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(97, 'Adapter LENOVO 20V - 4.5A Đầu Kim) BAMBA', '2021-09-29LNV45kim.jpg', 1, 300000, 150000, '2021-09-29 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(98, 'Loa vi tính Microlab M108', '2021-09-29loa-vi-tinh-microlab-m108-5690-36627321-aa503525a867d92e9ed70ecf53ed9a3e.jpg_500x500Q80.jpg', 4, 400000, 0, '2021-09-29 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(99, 'Đầu Đọc Ổ Cứng Dock Seagate 2.5 Và 3.5 (CABLE + DOCK)', '2021-09-29hdd-docking-2535-seagate-usb-301522907846.jpg', 4, 150000, 70000, '2021-09-29 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(100, 'Đầu Đọc Ổ Cứng Dock 2.5 Và 3.5 (CABLE + DOCK)', '2020-09-016075f58ab1c496d339b374ae43b80d25.jfif', 2, 100000, 50000, '2020-09-01 00:00:00', 1, 1, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(101, 'Cáp Lan 3m Cat 6', '2021-09-29CAT5E-SOLID-4.png', 2, 50000, 0, '2021-09-29 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(102, 'Cáp chia VGA (1CPU ra 2VGA)', '2021-09-29cap-chia-vga-1cpu-ra-2vga1526378640.jpg', 4, 90000, 48000, '2021-09-29 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(103, 'Switch POE Tplink 2 port', '2021-09-29original.jpg', 5, 70000, 0, '2021-09-29 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(104, 'Pin HP MB04XL', '2021-09-25z2789471423351_5e610f439c0dbdeca700738193a9cf40.jpg', 0, 2650000, 1030000, '2021-09-25 00:00:00', 3, 3, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(105, 'Adapter Camera 12V-2A Điện tử Móc treo', '2021-09-30adapter-camera-12v2a-dien-tu-moc-treo1522898987.jpg', 13, 90000, 31000, '2021-09-30 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(106, 'Adapter Camera 12V-2A', '2021-09-30adapter-12v25a-action-chuyen-dung-camera1625192402.jpg', 3, 100000, 45000, '2021-09-30 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(107, 'Adapter laptop Lenovo 20v - 3.25A Đầu Vuông (Zin Cũ)', '2021-10-01sac-lenovo-vuong-65w_56ac38f915064ded8e1c9ceec4b412ad.jpg', 1, 200000, 0, '2021-10-01 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(108, 'Adapter Laptop ASUS 19V - 3.42A Đầu nhỏ (Zin Cũ)', '2021-10-01sac-Adapter-laptop-ASUS-19V-3.42A-dau-nho-chinh-hang-daiphatloc.vn3.jpg', 1, 200000, 0, '2021-10-01 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(109, 'Adapter Dell ASUS 19.5V - 3.34A – ĐẦU KIM NHỎ (Zin Cũ)', '2021-10-01Sac-Dell-19.5V-4.62A-DKN-1-1.jpg', 1, 200000, 0, '2021-10-01 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(110, 'Adapter laptop Lenovo 20V - 4.5A Đầu Vuông (Zin Cũ)', '2021-10-01sac-lenovo-vuong-65w_56ac38f915064ded8e1c9ceec4b412ad.jpg', 1, 200000, 0, '2021-10-01 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(111, 'ASRock B360M Pro4 – Socket 1151v2', '13-10-2021asrock-b360m-pro4-socket-1151v2-4.png', 1, 1500000, 700000, '2021-10-13 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(112, 'Mainboard Gigabyte B360M-D2V', '13-10-202141791_mainboard_gigabyte_b360m_d2v_0004_5.jpg', 5, 1650000, 1000000, '2021-10-13 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(113, 'Asus B360G ROG STRIX Gaming LGA 1151v2', '13-10-2021asus_b360g_gearvn00.jpg', 1, 1750000, 1000000, '2021-10-13 00:00:00', 5, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(114, 'SSD 120G MIXZA CHÍNH HÃNG', '14-10-2021c2e38459dbf568671abafdec620592a9.jpg', 5, 650000, 370000, '2021-10-14 00:00:00', 4, 36, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(115, 'Nguồn Acbel CE2 400w', '14-10-2021Nguồn-máy-tính-Acbel-CE2-400W.jpg', 3, 350000, 286000, '2021-10-14 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(116, 'Nguồn Antec 300w', '14-10-2021f715517270e207ec6b17618674f3aa38.jpg', 8, 300000, 170000, '2021-10-14 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(117, 'Bàn phím Acer Aspire e5-573,e5-575,e5-722,f5-571', '15-10-2021e5-573bb.jpg', 1, 350000, 95000, '2021-10-15 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(118, 'BÀN PHÍM HP G4,CQ43,CQ430,G6,CQ630,CQ57,450,1000,2000', '18-10-2021g4.jpg', 2, 350000, 98000, '2021-10-18 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(119, 'Camera VITACAM DZ3000', '19-10-2021z2856600236642_c0a9bba235e77bde85eeac2aef09a702.jpg', 1, 950000, 650000, '2021-10-19 00:00:00', 7, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(120, 'BÀN PHÍM DELL INSPIRON 3541,3542,3558,5545,5547,5542,5558,5559', '21-10-20203542.jpg', 1, 350000, 98000, '2020-10-21 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(121, 'BÀN PHÍM ACER ASPIRE 4535,4736,4935,3810,4810,D732 (MÀU ĐEN)', '15-06-20204736.jpg', 2, 350000, 98000, '2020-06-15 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(122, 'BÀN PHÍM ASUS K56,S56', '30-11-2020k56.jpg', 2, 350000, 98000, '2020-11-30 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(123, 'BÀN PHÍM SONY VPC-SA (MÀU ĐEN)', '26-03-2021sony-vpc-ea32en-800x800.jpeg', 1, 350000, 115000, '2021-03-26 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(124, 'BÀN PHÍM HP 15', '12-10-2020keyboard-hp-ay038tu-02.jpg', 2, 350000, 85000, '2020-10-12 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(125, 'BÀN PHÍM ASUS X502,X551,X553,K553,TP550,F554,K555,X555,X554,K555,F555,F553', '19-10-2021x502.jpg', 1, 350000, 98000, '2021-10-19 00:00:00', 2, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(126, 'HUP USB 4PORT 3.0', '20-10-2021HUBUSB3.0.jpg', 10, 150000, 70000, '2021-10-20 00:00:00', 2, 3, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(127, 'ĐỌC THẺ NHỚ ALL IN ONE (CÓ HỘP) NHÔM', '20-10-2021readernhom(3).png', 5, 50000, 20000, '2021-10-20 00:00:00', 2, 3, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(128, 'Chuột không dây Logitech Laser M185', '21-10-2021m185-gallery-1.png', 20, 100000, 65000, '2021-10-21 00:00:00', 1, 6, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(129, 'Chuột Fuhlen L102 USB', '21-10-2021mouse-fuhlen-l102-usb1625459904.png', 19, 75000, 45000, '2021-10-21 00:00:00', 1, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(130, 'Switch TP-Link TL-SF1008D 8 port Chính hãng (100Mbps)', '21-10-2021switch-tplink-sf1008d-5port1524167349.jpg', 9, 220000, 145000, '2021-10-21 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(131, 'Switch TP-Link TL-SG1005D 5 port Gigabit Chính hãng (1.0Gbps)', '21-10-2021switch-gigabit-tplink-tlsg1005d-5port-10gbps1554096229.jpg', 5, 335000, 279000, '2021-10-21 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(132, 'Chuột không dây Wireless 7D game FD i750', '24-11-2020Chuột-không-dây-Gaming-FD-i750-chính-hãng.jpg', 4, 370000, 250000, '2020-11-24 00:00:00', 1, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(133, 'CHUỘT BAMBA B06 (MÀU ĐEN) CHUYÊN GAME LED RGB', '21-10-2021B06.png', 4, 225000, 150000, '2021-10-21 00:00:00', 2, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(134, 'CHUỘT BAMBA B02 CHUYÊN GAME RGB', '21-10-2021mouseb021.png', 4, 150000, 70000, '2021-10-21 00:00:00', 2, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(135, 'Bàn phím cơ BAMBA B15 (có đèn) Chuyên Game', '21-10-2021KEYB15BB5.png', 3, 550000, 350000, '2021-10-21 00:00:00', 2, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(136, 'Bàn phím cơ BAMBA B16 (có đèn) Chuyên Game', '21-10-2021KEYB16BB5.png', 3, 600000, 390000, '2021-10-21 00:00:00', 2, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(137, 'Chuột R8 1632 LED USB Gaming', '21-10-2021mouse-r81632-usb1523502732.jpg', 4, 95000, 68000, '2021-10-21 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(138, 'Chuột BOSSTON D608 USB Chính hãng', '21-10-2021mouse-bosston-d606d608-usb1528397990.jpg', 3, 95000, 50000, '2021-10-21 00:00:00', 1, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(139, 'Wifi MERCUSYS MW305R Chính hãng (3 anten 5dBi, 300Mbps, 3 port 100Mpbs)', '1-3-202063f38c48a86546f4204333ee2828c5d2.jpg', 3, 240000, 180000, '2020-03-01 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(140, 'Wifi MERCUSYS MW325R Chính hãng (4 anten 5dBi, 300Mbps, 3 port 100Mpbs)', '1-3-2020751803_22_normal_0_20160613174635.jpg', 1, 280000, 220000, '2020-03-01 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(141, 'Wifi Băng Tần Kép AC1200 TOTOLINK A720R', '21-10-202167ef546eed72427b6884d984c330e3d0.jpg', 4, 550000, 279000, '2021-10-21 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(142, 'USB thu Wifi TP-Link TL-WN725N Chính hãng', '01-07-2020usb-thu-wifi-tplink-wn725n1529382786.jpg', 6, 150000, 118000, '2020-07-01 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(143, 'USB thu Wifi TP-Link TL-WN722N Chính hãng', '1-12-2019464862_TL-WN722N_EU_3.0_05_large_1506586575378x.jpg', 0, 200000, 157000, '2019-12-01 00:00:00', 1, 24, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(144, 'Card mạng PCI-E & USB Network', '21-10-20210d0a856bb2a86038a57ebc0213609c1b.jpg', 3, 75000, 50000, '2021-10-21 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(145, 'Wifi adapter', '21-10-2021editIMG_8106.jpg', 4, 200000, 175000, '2021-10-21 00:00:00', 6, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(146, 'CÁP CHUYỂN ĐỔI VGA SANG HDMI', '21-10-2021VGA-HDMIBBMỚI.png', 2, 250000, 145000, '2021-10-21 00:00:00', 2, 0, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(147, 'CHUỘT KHÔNG DÂY BAMBA B6 XANH', '27-10-2021b64.png', 10, 150000, 95000, '2021-10-27 00:00:00', 2, 12, NULL, NULL, 1, 1, '2021-10-09 17:00:00', '2021-10-09 17:00:00'),
(148, 'CaddyBay 9.5', 'product_1635609744caddy.jpg', 20, 100000, 45000, '2021-10-30 00:00:00', 1, 6, NULL, NULL, 1, 1, '2021-10-30 09:02:24', '2021-10-30 09:14:57'),
(149, 'caddy bay 12.7', 'product_1635863611caddy.jpg', 3, 100000, 40000, '2021-11-02 00:00:00', 1, 0, NULL, NULL, NULL, 1, '2021-11-02 07:33:31', '2021-11-03 20:06:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vhn_suppliers`
--

CREATE TABLE `vhn_suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT 1,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vhn_suppliers`
--

INSERT INTO `vhn_suppliers` (`id`, `name`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(0, 'Khách lẻ', 1, 1, NULL, NULL),
(1, 'Phát Đạt Computer', 1, 1, '2021-09-24 05:54:24', '2021-09-24 06:00:21'),
(2, 'Quốc Thắng', 1, 1, '2021-09-24 06:00:34', '2021-09-24 06:00:34'),
(3, 'Prolaptop', 1, 1, '2021-09-24 06:00:43', '2021-09-24 06:00:43'),
(4, 'H&H', 1, 1, '2021-09-24 06:01:19', '2021-09-24 06:01:19'),
(5, 'Khác', 1, 1, '2021-09-24 06:01:26', '2021-09-24 06:01:26'),
(6, 'Shopee', 1, 1, '2021-09-24 09:45:34', '2021-09-24 09:45:34'),
(7, 'VITACAM - YOOSEE', NULL, 1, '2021-10-18 21:25:05', '2021-11-03 20:05:17');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vhn_hd_kiemtras`
--
ALTER TABLE `vhn_hd_kiemtras`
  ADD PRIMARY KEY (`id_hd`,`stt`);

--
-- Chỉ mục cho bảng `vhn_hd_sanphams`
--
ALTER TABLE `vhn_hd_sanphams`
  ADD PRIMARY KEY (`id_hd`,`id_type`,`stt`),
  ADD KEY `vhn_hd_sanphams_id_sp_foreign` (`id_sp`);

--
-- Chỉ mục cho bảng `vhn_hd_suachuas`
--
ALTER TABLE `vhn_hd_suachuas`
  ADD PRIMARY KEY (`id_hd`,`stt`),
  ADD KEY `congno` (`id_congno`);

--
-- Chỉ mục cho bảng `vhn_hd_tunhaps`
--
ALTER TABLE `vhn_hd_tunhaps`
  ADD PRIMARY KEY (`id_hd`,`stt`);

--
-- Chỉ mục cho bảng `vhn_hoadon_pros`
--
ALTER TABLE `vhn_hoadon_pros`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vhn_hoadon_scs`
--
ALTER TABLE `vhn_hoadon_scs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vhn_phieus`
--
ALTER TABLE `vhn_phieus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vhn_products`
--
ALTER TABLE `vhn_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vhn_suppliers`
--
ALTER TABLE `vhn_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `vhn_hoadon_pros`
--
ALTER TABLE `vhn_hoadon_pros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `vhn_hoadon_scs`
--
ALTER TABLE `vhn_hoadon_scs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `vhn_phieus`
--
ALTER TABLE `vhn_phieus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `vhn_products`
--
ALTER TABLE `vhn_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT cho bảng `vhn_suppliers`
--
ALTER TABLE `vhn_suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `vhn_hd_kiemtras`
--
ALTER TABLE `vhn_hd_kiemtras`
  ADD CONSTRAINT `vhn_hd_kiemtras_id_hd_foreign` FOREIGN KEY (`id_hd`) REFERENCES `vhn_hoadon_scs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `vhn_hd_sanphams`
--
ALTER TABLE `vhn_hd_sanphams`
  ADD CONSTRAINT `vhn_hd_sanphams_id_sp_foreign` FOREIGN KEY (`id_sp`) REFERENCES `vhn_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `vhn_hd_suachuas`
--
ALTER TABLE `vhn_hd_suachuas`
  ADD CONSTRAINT `vhn_hd_suachuas_ibfk_1` FOREIGN KEY (`id_congno`) REFERENCES `vhn_suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vhn_hd_suachuas_ibfk_2` FOREIGN KEY (`id_hd`) REFERENCES `vhn_hoadon_scs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `vhn_hd_tunhaps`
--
ALTER TABLE `vhn_hd_tunhaps`
  ADD CONSTRAINT `vhn_hd_tunhaps_id_hd_foreign` FOREIGN KEY (`id_hd`) REFERENCES `vhn_hoadon_pros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
