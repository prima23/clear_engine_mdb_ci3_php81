-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2022 pada 08.45
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clear_engine`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_ci_captcha`
--

CREATE TABLE `xi_sa_ci_captcha` (
  `captcha_id` int(11) NOT NULL,
  `captcha_time` int(11) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_ci_session`
--

CREATE TABLE `xi_sa_ci_session` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_ci_session`
--

INSERT INTO `xi_sa_ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('hvm2jjhfip87rmfv4tlra6tsg8d06i07', '127.0.0.1', 1643163945, 0x6163636f756e745f6e616d657c733a31303a227072696d6161756c6961223b4170705470704f6e6c696e65403230323073657373696f6e7c733a3139323a22366232633861613562303265663961383530623631393164623062636639346631343236613238613564646536306530333831313563616634363264653637666535343465376665333930353661653364366466316133333530643462303661643036333837363332323030366435363631643932623630386663303163333064515557633937504c2b415a4d4f6570444b4c6b76534f4c4b55593077354f5169534b2f4f6234584f373038657534304d7a35544d46305231755a684e586576223b657870697265735f62797c693a313634333136333833383b66756c6c6e616d657c733a31313a225072696d612041756c6961223b67726f75705f6163746976657c733a313a2231223b67726f75705f6e616d657c733a31313a2253757065722041646d696e223b6c6576656c5f616b7365737c733a31313a2253555045522041444d494e223b6e69636b5f6c6576656c7c733a333a22534144223b757365725f69647c733a33323a223441333732394341354131353933443732453637464630464533313138354431223b756e69745f69647c733a313a2230223b756e69745f69645f6e616d657c733a303a22223b),
('i9avmspa7c644pi48m04ad25o611j8hd', '127.0.0.1', 1643096642, 0x66756c6c6e616d657c733a31313a225072696d612041756c6961223b756e69745f69645f6e616d657c733a303a22223b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_fungsi`
--

CREATE TABLE `xi_sa_fungsi` (
  `id_fungsi` int(11) NOT NULL,
  `nama_fungsi` varchar(255) NOT NULL,
  `label_fungsi` varchar(255) NOT NULL,
  `url_fungsi` varchar(255) NOT NULL,
  `deskripsi_fungsi` varchar(255) NOT NULL,
  `id_jenis_fungsi` int(3) NOT NULL,
  `id_level_akses` int(3) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_ip` varchar(20) NOT NULL,
  `mod_by` varchar(255) NOT NULL,
  `mod_date` datetime NOT NULL,
  `mod_ip` varchar(20) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_fungsi`
--

INSERT INTO `xi_sa_fungsi` (`id_fungsi`, `nama_fungsi`, `label_fungsi`, `url_fungsi`, `deskripsi_fungsi`, `id_jenis_fungsi`, `id_level_akses`, `create_by`, `create_date`, `create_ip`, `mod_by`, `mod_date`, `mod_ip`, `id_status`) VALUES
(1, 'index', 'Index', 'index', 'Fungsi untuk menampilkan data', 1, 0, 'yogisolop', '2017-06-04 19:30:40', '::1', 'yogisolop', '2020-08-28 11:45:59', '::1', 1),
(2, 'create', 'Create Data', 'create', 'Fungsi untuk menambahkan data', 2, 0, 'yogisolop', '2017-06-04 19:32:33', '::1', 'yogisolop', '2017-09-05 17:52:35', '::1', 1),
(3, 'update', 'Update Data', 'update', 'Fungsi untuk merubah data', 2, 0, 'yogisolop', '2017-06-04 19:33:01', '::1', 'yogisolop', '2017-09-05 17:52:44', '::1', 1),
(4, 'delete', 'Delete Data', 'delete', 'Fungsi untuk menghapus data', 2, 0, 'yogisolop', '2017-06-04 19:33:33', '::1', 'yogisolop', '2017-09-05 17:52:52', '::1', 1),
(5, 'listview', 'List View Data', 'listview', 'Fungsi untuk menampilkan list data', 2, 0, 'yogisolop', '2017-11-06 13:59:43', '::1', 'yogisolop', '2017-11-06 13:59:43', '::1', 1),
(6, 'review', 'Review Data', 'review', 'Fungsi untuk mereview data kembali', 2, 0, 'yogisolop', '2017-12-17 23:45:14', '::1', 'yogisolop', '2017-12-17 23:45:29', '::1', 1),
(7, 'details', 'Data Details', 'details', 'Fungsi untuk melihat rincian data', 2, 0, 'yogisolop', '2017-12-27 08:28:13', '::1', 'yogisolop', '2017-12-27 08:28:13', '::1', 1),
(8, 'searching', 'Searching', 'searching', 'Fungsi untuk mencari data', 2, 0, 'yogisolop', '2017-11-07 13:21:59', '::1', 'yogisolop', '2017-11-07 13:21:59', '::1', 1),
(9, 'rules', 'Rules Module', 'rules', 'Fungsi untuk setting rules module', 2, 0, 'yogisolop', '2017-06-05 10:51:09', '::1', 'yogisolop', '2020-04-07 22:38:12', '::1', 1),
(10, 'privileges', 'Group Privilege', 'privileges', 'Fungsi untuk setting group privilege', 2, 0, 'yogisolop', '2017-06-10 22:23:24', '::1', 'yogisolop', '2017-08-03 12:20:22', '::1', 1),
(11, 'regency', 'Data Regency', 'regency', 'Fungsi untuk mengambil data regency', 2, 0, 'yogisolop', '2020-04-11 22:38:38', '::1', 'yogisolop', '2020-04-11 22:38:38', '::1', 1),
(12, 'district', 'Data District', 'district', 'Fungsi untuk mengambil data district', 2, 0, 'yogisolop', '2020-04-11 22:39:48', '::1', 'yogisolop', '2020-04-11 22:39:48', '::1', 1),
(13, 'village', 'Data Village', 'village', 'Fungsi untuk mengambil data village', 2, 0, 'yogisolop', '2020-04-11 22:40:11', '::1', 'yogisolop', '2020-04-11 22:40:11', '::1', 1),
(14, 'approve', 'Data Approve', 'approve', 'Fungsi untuk menyetujui data', 2, 0, 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 1),
(15, 'reject', 'Data Reject', 'reject', 'Fungsi untuk menolak data', 2, 0, 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 1),
(16, 'upload', 'Upload Data', 'upload', 'Fungsi untuk mengupload file', 2, 0, 'yogisolop', '2018-07-24 22:20:18', '::1', 'yogisolop', '2018-08-03 15:09:33', '::1', 1),
(17, 'download', 'Download Data', 'download', 'Fungsi untuk mendownload file', 2, 0, 'yogisolop', '2018-07-24 22:21:04', '::1', 'yogisolop', '2018-08-03 15:09:42', '::1', 1),
(18, 'export_to_word', 'Download Word', 'export-to-word', 'Fungsi download laporan format word', 2, 0, 'yogisolop', '2020-05-02 07:16:39', '::1', 'yogisolop', '2020-05-22 08:03:33', '::1', 1),
(19, 'export_to_excel', 'Download Excel', 'export-to-excel', 'Fungsi download laporan format excel', 2, 0, 'yogisolop', '2020-05-11 08:27:30', '::1', 'yogisolop', '2020-05-11 08:27:30', '::1', 1),
(20, 'export_to_pdf', 'Download PDF', 'export-to-pdf', 'Fungsi download laporan format pdf', 2, 0, 'yogisolop', '2020-05-11 08:30:42', '::1', 'yogisolop', '2020-05-11 08:30:42', '::1', 1),
(25, 'getOptionOpd', 'Get Option OPD', 'getOptionOpd', 'untuk memanggil option data opd dari API Simpeg', 2, 0, 'primaaulia', '2021-03-25 09:22:37', '127.0.0.1', 'primaaulia', '2021-03-25 09:22:37', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_group`
--

CREATE TABLE `xi_sa_group` (
  `id_group` int(11) NOT NULL,
  `nama_group` varchar(255) NOT NULL,
  `id_level_akses` int(3) NOT NULL,
  `id_upk` int(3) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_ip` varchar(20) NOT NULL,
  `mod_by` varchar(255) NOT NULL,
  `mod_date` datetime NOT NULL,
  `mod_ip` varchar(20) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_group`
--

INSERT INTO `xi_sa_group` (`id_group`, `nama_group`, `id_level_akses`, `id_upk`, `create_by`, `create_date`, `create_ip`, `mod_by`, `mod_date`, `mod_ip`, `id_status`) VALUES
(1, 'Super Admin', 1, 0, 'yogisolop', '2020-04-07 00:00:00', '::1', 'yogisolop', '2020-04-07 00:00:00', '::1', 1),
(3, 'Admin OPD', 3, 0, 'yogisolop', '2020-09-20 12:39:02', '::1', 'primaaulia', '2021-03-24 11:43:00', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_group_privileges`
--

CREATE TABLE `xi_sa_group_privileges` (
  `id_group_privileges` int(11) NOT NULL,
  `id_group` int(11) NOT NULL DEFAULT '0',
  `id_rules` int(11) NOT NULL DEFAULT '0',
  `id_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_group_privileges`
--

INSERT INTO `xi_sa_group_privileges` (`id_group_privileges`, `id_group`, `id_rules`, `id_status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 1),
(17, 1, 17, 1),
(18, 1, 18, 1),
(19, 1, 19, 1),
(20, 1, 20, 1),
(21, 1, 21, 1),
(22, 1, 22, 1),
(23, 1, 23, 1),
(24, 1, 24, 1),
(25, 1, 25, 1),
(26, 1, 26, 1),
(27, 1, 27, 1),
(28, 1, 28, 1),
(29, 1, 29, 1),
(30, 1, 30, 1),
(31, 1, 31, 1),
(32, 1, 32, 1),
(33, 1, 33, 1),
(34, 1, 34, 1),
(35, 1, 35, 1),
(36, 1, 36, 1),
(37, 1, 37, 1),
(38, 1, 38, 1),
(39, 1, 39, 1),
(40, 1, 40, 1),
(41, 1, 41, 0),
(42, 1, 42, 0),
(43, 1, 43, 0),
(44, 1, 44, 0),
(45, 1, 45, 0),
(46, 1, 46, 0),
(47, 1, 47, 0),
(48, 1, 48, 0),
(49, 1, 49, 0),
(50, 1, 50, 0),
(51, 1, 51, 0),
(52, 1, 52, 0),
(53, 1, 53, 0),
(54, 1, 54, 0),
(55, 1, 55, 0),
(56, 1, 56, 0),
(57, 1, 57, 0),
(58, 1, 58, 0),
(59, 1, 59, 0),
(60, 1, 60, 0),
(61, 1, 61, 0),
(62, 1, 62, 0),
(63, 1, 63, 0),
(64, 1, 64, 0),
(65, 1, 65, 0),
(66, 1, 66, 0),
(67, 1, 67, 0),
(68, 1, 68, 0),
(69, 1, 69, 0),
(70, 1, 70, 0),
(71, 1, 71, 0),
(72, 1, 72, 0),
(73, 1, 73, 0),
(74, 1, 74, 0),
(75, 1, 76, 0),
(76, 1, 75, 0),
(77, 1, 77, 0),
(78, 1, 78, 0),
(79, 1, 79, 0),
(80, 1, 80, 0),
(81, 1, 81, 0),
(82, 1, 82, 0),
(83, 1, 83, 0),
(84, 1, 84, 0),
(108, 1, 85, 0),
(109, 1, 86, 0),
(110, 1, 87, 0),
(111, 1, 88, 0),
(112, 1, 89, 0),
(113, 1, 90, 0),
(114, 1, 91, 0),
(115, 1, 92, 0),
(130, 1, 93, 0),
(131, 1, 94, 1),
(132, 1, 95, 0),
(133, 1, 96, 0),
(134, 1, 97, 0),
(135, 1, 98, 0),
(136, 1, 99, 0),
(137, 1, 100, 0),
(138, 1, 101, 0),
(139, 1, 102, 0),
(140, 1, 103, 0),
(141, 1, 104, 0),
(142, 1, 105, 0),
(143, 1, 106, 0),
(144, 1, 107, 0),
(145, 1, 108, 0),
(146, 1, 109, 0),
(147, 1, 110, 0),
(148, 1, 112, 0),
(149, 1, 113, 0),
(160, 1, 114, 0),
(161, 1, 115, 0),
(162, 1, 116, 0),
(163, 1, 117, 0),
(164, 1, 118, 0),
(165, 1, 119, 0),
(166, 1, 120, 0),
(180, 1, 135, 0),
(181, 1, 136, 0),
(182, 1, 137, 0),
(183, 1, 138, 0),
(184, 1, 139, 0),
(185, 1, 140, 0),
(186, 1, 141, 0),
(187, 1, 142, 0),
(188, 1, 121, 0),
(189, 1, 122, 0),
(190, 1, 127, 0),
(191, 1, 129, 0),
(192, 1, 130, 0),
(193, 1, 131, 0),
(194, 1, 128, 0),
(195, 1, 132, 0),
(196, 1, 134, 0),
(197, 1, 143, 0),
(199, 3, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_jenis_fungsi`
--

CREATE TABLE `xi_sa_jenis_fungsi` (
  `id_jenis_fungsi` int(3) NOT NULL,
  `jenis_fungsi` varchar(100) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_jenis_fungsi`
--

INSERT INTO `xi_sa_jenis_fungsi` (`id_jenis_fungsi`, `jenis_fungsi`, `id_status`) VALUES
(1, 'Fungsi Public', 1),
(2, 'Fungsi Pendukung', 1),
(3, 'Fungsi Private', 1),
(4, 'Fungsi Belum Ada', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_kontrol`
--

CREATE TABLE `xi_sa_kontrol` (
  `id_kontrol` int(11) NOT NULL,
  `nama_kontrol` varchar(255) NOT NULL,
  `label_kontrol` varchar(255) NOT NULL,
  `url_kontrol` varchar(255) NOT NULL,
  `deskripsi_kontrol` varchar(255) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_ip` varchar(20) NOT NULL,
  `mod_by` varchar(255) NOT NULL,
  `mod_date` datetime NOT NULL,
  `mod_ip` varchar(20) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_kontrol`
--

INSERT INTO `xi_sa_kontrol` (`id_kontrol`, `nama_kontrol`, `label_kontrol`, `url_kontrol`, `deskripsi_kontrol`, `create_by`, `create_date`, `create_ip`, `mod_by`, `mod_date`, `mod_ip`, `id_status`) VALUES
(1, 'home', 'Home', 'home', 'Halaman dashboard', '', '2017-06-04 19:36:44', '::1', 'yogisolop', '2020-05-19 11:01:39', '::1', 1),
(2, 'fungsi', 'Fungsi', 'fungsi', 'Halaman manajamen fungsi', '', '2017-06-04 19:37:18', '::1', '', '2017-06-07 11:42:03', '::1', 1),
(3, 'kontrol', 'Kontrol', 'kontrol', 'Halaman manajemen kontrol', '', '2017-06-04 19:37:38', '::1', '', '2017-06-07 11:41:55', '::1', 1),
(4, 'module', 'Module', 'module', 'Halaman manajemen module', '', '2017-06-04 19:37:58', '::1', '', '2017-06-07 11:41:47', '::1', 1),
(5, 'menu', 'Menu', 'menu', 'Halaman majamen menu', '', '2017-06-07 11:41:18', '::1', '', '2017-06-07 11:41:18', '::1', 1),
(6, 'group', 'Group', 'group', 'Halaman manajemen group', '', '2017-06-10 22:23:53', '::1', '', '2017-06-10 22:24:15', '::1', 1),
(7, 'users', 'Users', 'users', 'Halaman manajemen users', '', '2017-06-14 19:18:54', '::1', '', '2017-06-14 19:19:06', '::1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_level_akses`
--

CREATE TABLE `xi_sa_level_akses` (
  `id_level_akses` int(3) NOT NULL,
  `level_akses` varchar(100) NOT NULL,
  `nick_level` char(3) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_level_akses`
--

INSERT INTO `xi_sa_level_akses` (`id_level_akses`, `level_akses`, `nick_level`, `id_status`) VALUES
(1, 'SUPER ADMIN', 'SAD', 1),
(2, 'ADMIN', 'ADM', 1),
(3, 'OPERATOR', 'OPR', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_log_akses`
--

CREATE TABLE `xi_sa_log_akses` (
  `id_log_akses` int(11) NOT NULL,
  `history_log` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_log_login`
--

CREATE TABLE `xi_sa_log_login` (
  `id_log` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `login_time` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `user_agent` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_log_mobile`
--

CREATE TABLE `xi_sa_log_mobile` (
  `id_log` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `device_model` varchar(255) NOT NULL,
  `login_time` int(11) NOT NULL,
  `logout_time` int(11) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_log_session`
--

CREATE TABLE `xi_sa_log_session` (
  `id_log_session` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `login_time` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `id_status` int(1) NOT NULL,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_log_session`
--

INSERT INTO `xi_sa_log_session` (`id_log_session`, `id_users`, `username`, `login_time`, `ip_address`, `user_agent`, `id_status`, `session_id`) VALUES
(13333, 2, 'primaaulia', 1643084832, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 0, '76896f07cf0b5d1d0d021676308346378776aad28bb32c45d9a9ddace868640dbc0a71c520ba63d165d3f3f4b210a11cfeeacbae6e4d3cdae2ca68183e8d40dbpdqczDEGu9kp8nM8XkE2UrwJ496pRHsZKUQdfEi440G8sooeui7ItXVqlZSZ+TAk'),
(13334, 2, 'primaaulia', 1643095689, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 1, '4d39cab4a159ea89b808b2d2feee8fa777f0a07cfeb98ff6298e7bbf129c4050e13395fb61a8f34ef4df6008ac5173d8a72b9e69a475ee891406b113e587e956KArKjCxKdowETmCHQd6/boWB2aXHrbkTeHdb8z52jHdewZk/fhDbsEKTenke7gJX'),
(13335, 2, 'primaaulia', 1643096074, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 1, '878d3bcb797798f6dd0e9c5ec3f888cd28311cdf3ba74dcb6e1e416662e74bbbd2ca66e9b098b2963fa7d9d39c2ecc0f92a9a9f851b3c0f97d407a5d17f336ca9XIdztwHn4ZKPrPFgvDCo7UnSOoVC+OXw+LfzZ851EFZWplCroG/6N4nvNH33Ot+'),
(13336, 2, 'primaaulia', 1643096083, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 1, '36935bed3dff87b5e57af3a0eb8dcf1fd827db91da1038535a4c60dfbc7c36b23b640acf66e4d8d8c0ae32620e2e1c15db563c8e244a7efef9534c561a782257OsYHhBw7O2MdAZVdVw6y7k6mj6iXT74Ph8QbAfVJRKZinUCY3+oMnjC3Ef5GOyWm'),
(13337, 2, 'primaaulia', 1643096104, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 1, '849de1d2420c9088d06855c8ddbe8d5d6dd8bac16cd742220a1169a23e88207fc39494fabd2b17c916c4ef5d49e8d616601e6e56cb82b43d0385c112760d8488w5nvw6HqpVuvBTDkg0Q4bm31Jmfl1WMUS/AP+rTJ3SW5lJpsmnZqh/AM994KZPLX'),
(13338, 2, 'primaaulia', 1643096130, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 0, 'fde3a35bac314609bc5d8114a72d3595aeded7446f3336a1b3e445f0a1043a37e6d1bf7df0b45773635212f7f0aadb9e854d942c8df3df8adfd8553c61b71333laNZ5X59Ifqa6nhxx/0ktb/XpqRnTgjgFMq87SK//l8m7ncghVl76zltUaiulR5d'),
(13339, 2, 'primaaulia', 1643096210, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 0, 'e56e068a583741743182139145cc43ec0445d24460a3d55d297187ed90f3245e157f56d34542148eca750c5b6d01ea71164b39e9fe5795abf47089a303463f9fYpdHDaBiFgAu4cFkW5hGs9M2R62cgQyes6WOcpGaGbv/csXwK8FMqeM9Q/JbJDUB'),
(13340, 2, 'primaaulia', 1643160238, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 1, '6b2c8aa5b02ef9a850b6191db0bcf94f1426a28a5dde60e038115caf462de67fe544e7fe39056ae3d6df1a3350d4b06ad063876322006d5661d92b608fc01c30dQUWc97PL+AZMOepDKLkvSOLKUY0w5OQiSK/Ob4XO708eu40Mz5TMF0R1uZhNXev');

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_menu`
--

CREATE TABLE `xi_sa_menu` (
  `id_menu` int(11) NOT NULL,
  `title_menu` varchar(255) NOT NULL,
  `url_menu` varchar(255) NOT NULL,
  `icon_menu` varchar(100) NOT NULL,
  `order_menu` int(3) NOT NULL,
  `id_rules` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `is_parent` enum('Y','N') NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_ip` varchar(20) NOT NULL,
  `mod_by` varchar(255) NOT NULL,
  `mod_date` datetime NOT NULL,
  `mod_ip` varchar(20) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_menu`
--

INSERT INTO `xi_sa_menu` (`id_menu`, `title_menu`, `url_menu`, `icon_menu`, `order_menu`, `id_rules`, `parent_id`, `is_parent`, `create_by`, `create_date`, `create_ip`, `mod_by`, `mod_date`, `mod_ip`, `id_status`) VALUES
(1, 'Home', '', 'fas fa-home', 1, 1, 0, 'N', '', '2017-06-07 12:09:31', '::1', 'yogisolop', '2020-09-17 20:00:32', '::1', 1),
(2, 'Manajemen', '#', 'fas fa-user-cog', 2, 0, 0, 'Y', '', '2017-06-07 12:09:47', '::1', 'yogisolop', '2019-04-23 14:32:10', '36.67.76.99', 1),
(3, 'Fungsi', '', '', 1, 2, 2, 'N', '', '2017-06-07 12:10:03', '::1', 'yogisolop', '2019-04-23 14:32:04', '36.67.76.99', 1),
(4, 'Kontrol', '', '', 2, 8, 2, 'N', '', '2017-06-07 12:10:26', '::1', 'yogisolop', '2019-04-23 14:32:20', '36.67.76.99', 1),
(5, 'Module', '', '', 3, 14, 2, 'N', '', '2017-06-07 12:10:48', '::1', 'yogisolop', '2019-04-23 14:32:26', '36.67.76.99', 1),
(6, 'Menu', '', '', 5, 21, 2, 'N', '', '2017-06-07 12:11:06', '::1', 'yogisolop', '2020-09-24 08:52:06', '::1', 1),
(7, 'Group', '', '', 4, 27, 2, 'N', '', '2017-06-10 22:25:19', '::1', 'yogisolop', '2020-09-24 08:52:14', '::1', 1),
(8, 'Users', '', '', 6, 34, 2, 'N', '', '2017-06-14 19:20:01', '::1', 'yogisolop', '2019-04-23 14:32:44', '36.67.76.99', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_module`
--

CREATE TABLE `xi_sa_module` (
  `id_module` int(11) NOT NULL,
  `nama_module` varchar(255) NOT NULL,
  `label_module` varchar(255) NOT NULL,
  `url_module` varchar(255) NOT NULL,
  `deskripsi_module` varchar(255) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_ip` varchar(20) NOT NULL,
  `mod_by` varchar(255) NOT NULL,
  `mod_date` datetime NOT NULL,
  `mod_ip` varchar(20) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_module`
--

INSERT INTO `xi_sa_module` (`id_module`, `nama_module`, `label_module`, `url_module`, `deskripsi_module`, `create_by`, `create_date`, `create_ip`, `mod_by`, `mod_date`, `mod_ip`, `id_status`) VALUES
(1, 'home', 'Home', 'home', 'Module home', 'yogisolop', '2017-06-04 19:39:22', '::1', 'yogisolop', '2020-05-19 11:06:41', '::1', 1),
(2, 'manajemen', 'Manajemen', 'manajemen', 'Module konfigurasi system khusus untuk superadmin', 'yogisolop', '2017-06-04 19:40:50', '::1', 'yogisolop', '2017-08-03 16:00:08', '::1', 1),
(3, 'master', 'Data Master', 'master', 'Module data master', 'yogisolop', '2017-11-05 13:58:28', '::1', 'yogisolop', '2020-08-28 23:30:26', '::1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_rules`
--

CREATE TABLE `xi_sa_rules` (
  `id_rules` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `id_kontrol` int(11) NOT NULL,
  `id_fungsi` int(11) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_rules`
--

INSERT INTO `xi_sa_rules` (`id_rules`, `id_module`, `id_kontrol`, `id_fungsi`, `id_status`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 2, 1, 1),
(3, 2, 2, 2, 1),
(4, 2, 2, 3, 1),
(5, 2, 2, 4, 1),
(6, 2, 2, 5, 1),
(7, 2, 2, 7, 1),
(8, 2, 3, 1, 1),
(9, 2, 3, 2, 1),
(10, 2, 3, 3, 1),
(11, 2, 3, 4, 1),
(12, 2, 3, 5, 1),
(13, 2, 3, 7, 1),
(14, 2, 4, 1, 1),
(15, 2, 4, 2, 1),
(16, 2, 4, 3, 1),
(17, 2, 4, 4, 1),
(18, 2, 4, 5, 1),
(19, 2, 4, 7, 1),
(20, 2, 4, 9, 1),
(21, 2, 5, 1, 1),
(22, 2, 5, 2, 1),
(23, 2, 5, 3, 1),
(24, 2, 5, 4, 1),
(25, 2, 5, 5, 1),
(26, 2, 5, 7, 1),
(27, 2, 6, 1, 1),
(28, 2, 6, 2, 1),
(29, 2, 6, 3, 1),
(30, 2, 6, 4, 1),
(31, 2, 6, 5, 1),
(32, 2, 6, 7, 1),
(33, 2, 6, 10, 1),
(34, 2, 7, 1, 1),
(35, 2, 7, 2, 1),
(36, 2, 7, 3, 1),
(37, 2, 7, 4, 1),
(38, 2, 7, 5, 1),
(39, 2, 7, 7, 1),
(40, 2, 7, 8, 1),
(94, 2, 7, 25, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_setting`
--

CREATE TABLE `xi_sa_setting` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_year` char(4) NOT NULL,
  `app_icon` varchar(200) NOT NULL,
  `app_favicon` varchar(200) NOT NULL,
  `app_keywords` text NOT NULL,
  `app_versi` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_setting`
--

INSERT INTO `xi_sa_setting` (`id`, `app_name`, `app_author`, `app_description`, `app_year`, `app_icon`, `app_favicon`, `app_keywords`, `app_versi`) VALUES
(1, 'xxxx', 'Dinas Komunikasi dan Informatika Provinsi Sumatera Barat', 'clear engine', '2022', 'logo_sumbar.png', 'favicon.ico', 'Aplikasi Basic', '1.0.0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_status`
--

CREATE TABLE `xi_sa_status` (
  `id_status` char(2) NOT NULL,
  `nm_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_status`
--

INSERT INTO `xi_sa_status` (`id_status`, `nm_status`) VALUES
('0', 'Tidak Aktif'),
('1', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_users`
--

CREATE TABLE `xi_sa_users` (
  `id_users` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `unit_id_name` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `foto_profile` varchar(50) NOT NULL COMMENT 'Foto Profile',
  `blokir` int(1) NOT NULL COMMENT '0=diblokir, 1=tidak diblokir',
  `id_status` int(1) NOT NULL COMMENT '0=Tidak Aktif, 1=Aktif',
  `validate_email_code` varchar(100) NOT NULL,
  `validate_email_status` int(1) NOT NULL,
  `reset_password_code` varchar(100) NOT NULL,
  `reset_password_status` int(1) NOT NULL,
  `reset_password_expired` int(11) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_ip` varchar(20) NOT NULL,
  `mod_by` varchar(255) NOT NULL,
  `mod_date` datetime NOT NULL,
  `mod_ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_users`
--

INSERT INTO `xi_sa_users` (`id_users`, `token`, `unit_id`, `unit_id_name`, `username`, `password`, `email`, `fullname`, `foto_profile`, `blokir`, `id_status`, `validate_email_code`, `validate_email_status`, `reset_password_code`, `reset_password_status`, `reset_password_expired`, `create_by`, `create_date`, `create_ip`, `mod_by`, `mod_date`, `mod_ip`) VALUES
(2, '4A3729CA5A1593D72E67FF0FE31185D1', 0, '', 'primaaulia', '$2a$12$fexNr6W.H7RPvO9rOTjojuHzoWwK1JO7N2nyuFiD/ufsrlO6tU4ju', '', 'Prima Aulia', 'default-user-icon.jpg', 0, 1, '', 0, '', 0, 0, 'yogisolop', '2020-12-23 09:18:01', '::1', 'primaaulia', '2022-01-25 11:18:37', '127.0.0.1');

--
-- Trigger `xi_sa_users`
--
DELIMITER $$
CREATE TRIGGER `tgr_users_delete` AFTER DELETE ON `xi_sa_users` FOR EACH ROW BEGIN
	DELETE FROM xi_sa_users_default_pass WHERE id_users = OLD.id_users;
    DELETE FROM xi_sa_users_privileges WHERE id_users = OLD.id_users;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_users_default_pass`
--

CREATE TABLE `xi_sa_users_default_pass` (
  `id_default_pass` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `pass_plain` char(100) NOT NULL,
  `updated` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_users_privileges`
--

CREATE TABLE `xi_sa_users_privileges` (
  `id_users_privileges` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_users_privileges`
--

INSERT INTO `xi_sa_users_privileges` (`id_users_privileges`, `id_users`, `id_group`, `id_status`) VALUES
(2, 2, 1, 1),
(89, 2, 3, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_white_list`
--

CREATE TABLE `xi_sa_white_list` (
  `id_white_list` int(11) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `method_name` varchar(100) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_white_list`
--

INSERT INTO `xi_sa_white_list` (`id_white_list`, `module_name`, `class_name`, `method_name`, `id_status`) VALUES
(1, 'auth', 'signin', 'login', 1),
(2, 'auth', 'signin', 'logout', 1),
(3, 'auth', 'signin', 'switch_group', 1),
(4, 'auth', 'signin', 'timeout', 1),
(5, 'auth', 'signin', 'account', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `xi_sa_ci_captcha`
--
ALTER TABLE `xi_sa_ci_captcha`
  ADD PRIMARY KEY (`captcha_id`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_ci_session`
--
ALTER TABLE `xi_sa_ci_session`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_fungsi`
--
ALTER TABLE `xi_sa_fungsi`
  ADD PRIMARY KEY (`id_fungsi`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_group`
--
ALTER TABLE `xi_sa_group`
  ADD PRIMARY KEY (`id_group`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_group_privileges`
--
ALTER TABLE `xi_sa_group_privileges`
  ADD PRIMARY KEY (`id_group_privileges`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_jenis_fungsi`
--
ALTER TABLE `xi_sa_jenis_fungsi`
  ADD PRIMARY KEY (`id_jenis_fungsi`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_kontrol`
--
ALTER TABLE `xi_sa_kontrol`
  ADD PRIMARY KEY (`id_kontrol`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_level_akses`
--
ALTER TABLE `xi_sa_level_akses`
  ADD PRIMARY KEY (`id_level_akses`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_log_akses`
--
ALTER TABLE `xi_sa_log_akses`
  ADD PRIMARY KEY (`id_log_akses`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_log_login`
--
ALTER TABLE `xi_sa_log_login`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_log_mobile`
--
ALTER TABLE `xi_sa_log_mobile`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_log_session`
--
ALTER TABLE `xi_sa_log_session`
  ADD PRIMARY KEY (`id_log_session`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_menu`
--
ALTER TABLE `xi_sa_menu`
  ADD PRIMARY KEY (`id_menu`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_module`
--
ALTER TABLE `xi_sa_module`
  ADD PRIMARY KEY (`id_module`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_rules`
--
ALTER TABLE `xi_sa_rules`
  ADD PRIMARY KEY (`id_rules`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_setting`
--
ALTER TABLE `xi_sa_setting`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_status`
--
ALTER TABLE `xi_sa_status`
  ADD PRIMARY KEY (`id_status`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_users`
--
ALTER TABLE `xi_sa_users`
  ADD PRIMARY KEY (`id_users`) USING BTREE;
ALTER TABLE `xi_sa_users` ADD FULLTEXT KEY `username` (`username`);

--
-- Indeks untuk tabel `xi_sa_users_default_pass`
--
ALTER TABLE `xi_sa_users_default_pass`
  ADD PRIMARY KEY (`id_default_pass`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_users_privileges`
--
ALTER TABLE `xi_sa_users_privileges`
  ADD PRIMARY KEY (`id_users_privileges`) USING BTREE;

--
-- Indeks untuk tabel `xi_sa_white_list`
--
ALTER TABLE `xi_sa_white_list`
  ADD PRIMARY KEY (`id_white_list`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `xi_sa_ci_captcha`
--
ALTER TABLE `xi_sa_ci_captcha`
  MODIFY `captcha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_fungsi`
--
ALTER TABLE `xi_sa_fungsi`
  MODIFY `id_fungsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_group`
--
ALTER TABLE `xi_sa_group`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_group_privileges`
--
ALTER TABLE `xi_sa_group_privileges`
  MODIFY `id_group_privileges` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_jenis_fungsi`
--
ALTER TABLE `xi_sa_jenis_fungsi`
  MODIFY `id_jenis_fungsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_kontrol`
--
ALTER TABLE `xi_sa_kontrol`
  MODIFY `id_kontrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_level_akses`
--
ALTER TABLE `xi_sa_level_akses`
  MODIFY `id_level_akses` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_log_akses`
--
ALTER TABLE `xi_sa_log_akses`
  MODIFY `id_log_akses` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_log_login`
--
ALTER TABLE `xi_sa_log_login`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_log_mobile`
--
ALTER TABLE `xi_sa_log_mobile`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_log_session`
--
ALTER TABLE `xi_sa_log_session`
  MODIFY `id_log_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13341;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_menu`
--
ALTER TABLE `xi_sa_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_module`
--
ALTER TABLE `xi_sa_module`
  MODIFY `id_module` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_rules`
--
ALTER TABLE `xi_sa_rules`
  MODIFY `id_rules` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_setting`
--
ALTER TABLE `xi_sa_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_users`
--
ALTER TABLE `xi_sa_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_users_default_pass`
--
ALTER TABLE `xi_sa_users_default_pass`
  MODIFY `id_default_pass` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_users_privileges`
--
ALTER TABLE `xi_sa_users_privileges`
  MODIFY `id_users_privileges` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `xi_sa_white_list`
--
ALTER TABLE `xi_sa_white_list`
  MODIFY `id_white_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
