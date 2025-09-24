-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2025 at 04:19 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satpol`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `loggable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loggable_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `judul`, `tanggal`, `waktu`, `lokasi`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'perjalanan dinas', '2025-09-22', '02:48:00', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2025-09-22 00:47:11', '2025-09-22 01:25:35'),
(2, 'test 2', '2025-09-04', '14:57:00', 'dirumah', 'akhkaxka hadba da', '2025-09-22 00:57:28', '2025-09-22 01:43:39'),
(3, 'test4', '2025-09-27', '15:13:00', 'sekolah', 'test', '2025-09-22 01:13:38', '2025-09-22 01:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `user_id`, `judul`, `deskripsi`, `cover`, `created_at`, `updated_at`) VALUES
(7, 3, 'KUNJUNGAN WAMEN DIKTI SAINTEK', NULL, 'album-covers/Gfbm5nQ4ka9E65wK5c67Kk9rv4NsQ0z9QIX3cL9m.jpg', '2025-09-15 02:02:24', '2025-09-15 02:02:24'),
(8, 3, 'Kegiatan Operasi dan Sosialisasi Berantas Rokok Ilegal pada Jumat, 29 Agustus 2025', NULL, 'album-covers/r6pD9iFKoTHlqD4z1wyUpXom4MbiAE0635l4HpD6.jpg', '2025-09-15 19:18:25', '2025-09-15 19:18:25'),
(9, 3, 'Melaksanakan Operasi dan Sosialisasi Pemberantasan Rokok IIlegal', 'Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Katingan melalui Bidang Penegakan Perda dan Produk Hukum Lainnya melaksanakan Operasi dan Sosialisasi Pemberantasan Rokok IIlegal bersama Kantor Pengawasan dan Pelayanan Bea dan Cukai Tipe Madya Pabean C Sampit (KPPBC TMP C Sampit) yang dilaksanakan di Tumbang Samba, Kecamatan Katingan Tengah, Kabupaten Katingan pada Jumat (29/08/2025).', 'album-covers/akMMBuyFblXVsf10t4RqyvDn699J7YNOT4CnZtui.jpg', '2025-09-15 19:29:44', '2025-09-15 19:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berita` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','archive','publish') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `id_user`, `judul`, `slug`, `berita`, `thumbnail`, `status`, `views`, `created_at`, `updated_at`) VALUES
(5, 3, 'SATPOL PP DAN DAMKAR KABUPATEN KATINGAN LAKUKAN PENGAMANAN KUNJUNGAN WAMEN DIKTI SAINTEK DALAM VISITASI LOKASI RENCANA PEMBANGUNAN SMA UNGGULAN GARUDA DI KABUPATEN KATINGAN', 'satpol-pp-dan-damkar-kabupaten-katingan-lakukan-pengamanan-kunjungan-wamen-dikti-saintek-dalam-visitasi-lokasi-rencana-pembangunan-sma-unggulan-garuda-di-kabupaten-katingan', '<div class=\"xdj266r x14z9mp xat24cr x1lziwak x1vvkbs x126k92a\">\r\n<div dir=\"auto\" style=\"text-align: justify;\">Dalam rangka menjaga Ketentraman dan Ketertiban Umum, Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Katingan melaksanakan Pengamanan dalam kunjungan Wakil Menteri Pendidikan Tinggi, Sains dan Teknologi Republik Indonesia dalam Visitasi SMA Unggulan Garuda bertempat di Komplek Perkantoran Pemerintah Daerah Kabupaten Katingan pada Jumat (12/09/2025).</div>\r\n<div dir=\"auto\" style=\"text-align: justify;\">&nbsp;</div>\r\n</div>\r\n<div class=\"x14z9mp xat24cr x1lziwak x1vvkbs xtlvy1s x126k92a\" style=\"text-align: justify;\">\r\n<div dir=\"auto\">Kunjungan Wakil Menteri Pendidikan Tinggi, Sains dan Teknologi Republik Indonesia, Prof. Stella Christie, Ph.D., ke lokasi rencana pembangunan SMA Unggulan Garuda di Kabupaten Katingan bertujuan untuk meninjau langsung kelayakan lokasi, mengevaluasi potensi pengembangan infrastruktur pendidikan, serta mendorong pemerataan akses pendidikan berkualitas di wilayah Kalimantan Tengah. Kunjungan ini juga merupakan langkah strategis dalam memperkuat sinergi antara pemerintah pusat dan daerah untuk menciptakan sumber daya manusia unggul dari daerah.</div>\r\n<div dir=\"auto\">&nbsp;</div>\r\n</div>\r\n<div class=\"x14z9mp xat24cr x1lziwak x1vvkbs xtlvy1s x126k92a\">\r\n<div dir=\"auto\" style=\"text-align: justify;\">Tugas pengamanan Satuan Polisi Pamong Praja (Satpol PP) Kabupaten Katingan dalam kunjungan Wakil Menteri Pendidikan Tinggi, Sains dan Teknologi Republik Indonesia, Prof. Stella Christie, Ph.D., adalah untuk memastikan kelancaran, ketertiban, dan keamanan selama kegiatan visitasi berlangsung. Satpol PP bertanggung jawab dalam pengaturan lalu lintas di sekitar lokasi, pengamanan area kunjungan, pengawalan rombongan, serta menjaga agar kegiatan berjalan tanpa gangguan dari pihak luar. Selain itu, Satpol PP juga berkoordinasi dengan aparat keamanan lainnya untuk mengantisipasi potensi risiko serta memberikan dukungan terhadap protokol kehadiran pejabat negara.</div>\r\n</div>', 'berita-thumbnails/hIQqGm76yi5QpTBmCIYhRIvyOuFKAifV8r3kzHJl.jpg', 'publish', 7, '2025-09-15 01:58:29', '2025-09-15 21:11:32'),
(6, 3, 'Wakil Bupati Katingan Mewakili Pemerintah Daerah Kabupaten Katingan Menyampaikan Dukungan Penuh Terhadap Kegiatan Berantas Rokok Ilegal Yang Dilaksanakan Di Kabupaten Katingan', 'wakil-bupati-katingan-mewakili-pemerintah-daerah-kabupaten-katingan-menyampaikan-dukungan-penuh-terhadap-kegiatan-berantas-rokok-ilegal-yang-dilaksanakan-di-kabupaten-katingan', '<div class=\"xdj266r x14z9mp xat24cr x1lziwak x1vvkbs x126k92a\">\r\n<div dir=\"auto\" style=\"text-align: justify;\">Wakil Bupati Katingan Firdaus, menyampaikan dukungan penuh terhadap Kegiatan Berantas Rokok Ilegal yang ada di Kabupaten Katingan yang dilakukan oleh Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Katingan bersama dengan Kantor Pengawasan dan Pelayanan Bea dan Cukai Tipe Madya Pabean C Sampit (KPPBC TMP C Sampit).</div>\r\n<div dir=\"auto\" style=\"text-align: justify;\">&nbsp;</div>\r\n</div>\r\n<div class=\"x14z9mp xat24cr x1lziwak x1vvkbs xtlvy1s x126k92a\" style=\"text-align: justify;\">\r\n<div dir=\"auto\">Hal ini disampaikannya saat mengunjungi Kantor Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Katingan dan melaksanakan pertemuan langsung dengan jajaran Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Katingan bersama Perwakilan Kantor Pengawasan dan Pelayanan Bea dan Cukai Tipe Madya Pabean C Sampit (KPPBC TMP C Sampit) yang membahas rencana Kegiatan Operasi dan Sosialisasi Berantas Rokok Ilegal pada Jumat, 29 Agustus 2025 bertempat di Ruang Rapat Kasat PolPP dan Damkar Kabupaten Katingan.</div>\r\n<div dir=\"auto\">&nbsp;</div>\r\n</div>\r\n<div class=\"x14z9mp xat24cr x1lziwak x1vvkbs xtlvy1s x126k92a\">\r\n<div dir=\"auto\" style=\"text-align: justify;\">Dalam pertemuan ini, Wakil Bupati Katingan mengharapkan Operasi Bersama Pemberantasan Rokok Ilegal ini dapat memberikan dampak positif yang signifikan bagi pembangunan Kabupaten Katingan khususnya dalam meningkatkan penerimaan negara dari sektor cukai yang kemudian dapat dialokasikan untuk membiayai program-program strategis seperti pendidikan, kesehatan, dan infrastruktur. Selain itu, operasi ini juga menjadi langkah nyata dalam menciptakan iklim usaha yang sehat dan adil, melindungi masyarakat dari peredaran produk ilegal yang berisiko, serta meningkatkan kesadaran hukum di kalangan pelaku usaha dan masyarakat. Dengan sinergi antar instansi yang solid, upaya pemberantasan rokok ilegal ini diharapkan menjadi bagian dari gerakan bersama menuju pembangunan yang lebih berkeadilan dan berkelanjutan.</div>\r\n</div>', 'berita-thumbnails/2Ao1kDhIUzTq3LOhNi5uhMXSctMoTwvx6xM8WWQc.jpg', 'publish', 1, '2025-09-15 19:15:38', '2025-09-15 19:15:57'),
(7, 3, 'Satpol Pp Dan Damkar Kabupaten Katingan Laksanakan Kegiatan Operasi Dan Sosialisasi Berantas Rokok Ilegal Bersama Kantor Pengawasan Dan Pelayanan Bea Dan Cukai Sampit Di Tumbang Samba, Kecamatan Katingan Tengah, Kabupaten Katingan', 'satpol-pp-dan-damkar-kabupaten-katingan-laksanakan-kegiatan-operasi-dan-sosialisasi-berantas-rokok-ilegal-bersama-kantor-pengawasan-dan-pelayanan-bea-dan-cukai-sampit-di-tumbang-samba-kecamatan-katingan-tengah-kabupaten-katingan', '<div class=\"xdj266r x14z9mp xat24cr x1lziwak x1vvkbs x126k92a\">\r\n<div dir=\"auto\">Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Katingan melalui Bidang Penegakan Perda dan Produk Hukum Lainnya melaksanakan Operasi dan Sosialisasi Pemberantasan Rokok IIlegal bersama Kantor Pengawasan dan Pelayanan Bea dan Cukai Tipe Madya Pabean C Sampit (KPPBC TMP C Sampit) yang dilaksanakan di Tumbang Samba, Kecamatan Katingan Tengah, Kabupaten Katingan pada Jumat (29/08/2025).</div>\r\n<div dir=\"auto\">&nbsp;</div>\r\n</div>\r\n<div class=\"x14z9mp xat24cr x1lziwak x1vvkbs xtlvy1s x126k92a\">\r\n<div dir=\"auto\">Kegiatan yang dipimpin oleh Kepala Bidang Penegakan Perda dan Produk Hukum Lainnya Ebit Theopilus Babtista, S.H, bersama dengan Ketua Tim Kantor Pengawasan dan Pelayanan Bea dan Cukai Tipe Madya Pabean C Sampit (KPPBC TMP C Sampit) Roberto Panjaitan bersama dengan seluruh anggota yang terlibat ini ialah melaksanakan Operasi dan sosialisasi diantaranya :</div>\r\n<div dir=\"auto\">\r\n<ul>\r\n<li dir=\"auto\">Melakukan operasi penindakan di bidang cukai berupa penghentian,pemeriksaan, penegahan dan/ atau penyegelan terhadap saranapengangkut, barang, badan, bangunan atau tempat, atas adanyaperedaran Barang Kena Cukai yang tanpa dilekati pita cukai, dilekatipita cukai palsu, dilekati pita cukai bekas, dilekati pita cukai yang bukan peruntukannya, dan dilekati pita cukai salah personifikasi.</li>\r\n<li dir=\"auto\">Melakukan pemantauan dan pengawasan secara mendalam terhadapseluruh kegiatan di bidang cukai;</li>\r\n<li dir=\"auto\">Mengambil tindakan yang diperlukan dalam upaya pengamanan hakhak negara dan pencegahan pelanggaran ketentuan perundangundangan yang berlaku pada Pita Cukai</li>\r\n<li dir=\"auto\">Melakukan sosialisasi tentang pelanggaran dibidang cukai secara langsung maupun menempelkan Stiker Gempur Rokok Ilegal di Toko yang di kunjungi.</li>\r\n</ul>\r\n</div>\r\n</div>', 'berita-thumbnails/U2wzEHSozVPtOjhz2i7qUWKcfSwFFEy3AQAXsAIZ.jpg', 'publish', 1, '2025-09-15 19:26:47', '2025-09-15 19:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  `download_count` int NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `judul`, `deskripsi`, `file_path`, `file_name`, `file_size`, `file_extension`, `kategori`, `is_public`, `download_count`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'LKIP 2024 POLDAM', NULL, 'documents/8AtzasaLQXiFZvYRRgCc172fAaBrjixwwSY4oFe6.pdf', 'LKIP_2024_POLDAM.pdf', '5112426', 'pdf', 'Laporan', 1, 0, 3, '2025-09-14 20:41:21', '2025-09-14 20:41:21'),
(3, 'RENJA POL PP DAMKAR 2025', NULL, 'documents/1LgNxdhjpartvxdAxljz3ymuKeDoDQO80DuHOkv9.pdf', 'RENJA POL PP DAMKAR 2025.pdf', '1725096', 'pdf', 'Laporan', 1, 0, 3, '2025-09-14 20:44:22', '2025-09-14 20:44:22'),
(4, 'RENSTRA SATPOL PP DAMKAR 2025-2029', NULL, 'documents/5xsWkLGycs8fWe7a9bOMU28oK4jFaKzxZy0inhTb.pdf', 'RENSTRA SATPOL PP DAMKAR 2025-2029.pdf', '1672065', 'pdf', 'Laporan', 1, 0, 3, '2025-09-14 20:45:15', '2025-09-14 20:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_13_042026_create_permission_tables', 1),
(5, '2025_08_13_072011_berita', 1),
(6, '2025_08_14_012808_add_status_to_berita_table', 1),
(7, '2025_08_14_025334_create_albums_table', 1),
(8, '2025_08_14_025334_create_photos_table', 1),
(9, '2025_08_20_075009_dokumen', 1),
(10, '2025_08_25_021238_organizational_structure', 1),
(11, '2025_08_25_082205_modify_description_to_nip_in_organizational_structures_table', 1),
(12, '2025_08_25_085011_add_section_to_organizational_structures_table', 1),
(13, '2025_08_26_065520_create_sliders_table', 1),
(14, '2025_08_26_082357_create_visi_misis_table', 1),
(15, '2025_08_28_064052_add_slug_to_berita_table', 1),
(16, '2025_09_08_030035_change_title_to_nullable_in_sliders_table', 2),
(17, '2025_09_09_035217_create_activity_logs_table', 3),
(18, '2025_09_12_040936_sejarah', 4),
(19, '2025_09_12_070048_create_tugas_table', 5),
(20, '2025_09_15_030330_create_personal_access_tokens_table', 6),
(21, '2025_09_22_062455_create_kontaks_table', 7),
(22, '2025_09_22_065116_rename_kontaks_to_kontak_table', 8),
(23, '2025_09_22_070558_add_read_at_to_kontak_table', 9),
(24, '2025_09_22_073436_create_agendas_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `organizational_structures`
--

CREATE TABLE `organizational_structures` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` int DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizational_structures`
--

INSERT INTO `organizational_structures` (`id`, `name`, `position`, `section`, `nip`, `photo`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Dony Merianto, S.IP., M.A.P', 'Plt. KEPALA SATPOL  PP DAN DAMKAR', 1, '197805132007011007', 'organizational-photos/VJfg4dEpNfBKz6RatM3xWgDcbs151oGsU4AbSW49.png', 1, NULL, '2025-09-02 19:16:36', '2025-09-08 00:14:54'),
(2, 'Budiman L. Gaol, S.Sos', 'SEKRETARIS', 2, '19780128200711009', 'organizational-photos/EJ71MagWk3I1gYZfsqcqcEylhKwYLYNjgg3EvfxS.jpg', 1, NULL, '2025-09-02 19:17:04', '2025-09-02 20:12:15'),
(6, 'Roberto, SH', 'KASUBBAG UMUM DAN KEPEGAWAIAN', 3, '198209292007011008', 'organizational-photos/xIea3mbxfQLqfoPn4dWMOJD0LMheIBKyeU8B78lb.jpg', 1, NULL, '2025-09-08 00:17:51', '2025-09-08 00:17:51'),
(7, 'Andri, SE', 'KASUBBAG KEUANGAN', 3, '197211012005011007', 'organizational-photos/qjFpXsK49qUbeG0PY4KOWUY4WhqsX7xB6QXzZAYE.jpg', 2, NULL, '2025-09-08 00:19:17', '2025-09-08 00:19:17'),
(8, 'Helpinto, SH', 'KASUBBAG PENYUSUNAN PROGRAM, PELAPORAN, EVALUASI DAN IT', 3, '198303102007011002', 'organizational-photos/FjQnvV4gz0NPgxhYqViifXwrfrMSeao2ARh2gsSf.jpg', 3, NULL, '2025-09-08 00:20:49', '2025-09-08 00:20:49'),
(9, 'Ebit Theopilus Babtista, SH', 'KABID PENEGAKAN PERDA DAN PRODUK HUKUM', 4, '198305182010011008', 'organizational-photos/3LlBCBcGI0QRb8Eflkcsof4jLg37xyfjMPo7GXSC.jpg', 1, NULL, '2025-09-08 00:22:26', '2025-09-08 00:22:26'),
(10, 'Liliwatie, S.Sos', 'Plt. KABID KETENTRAMAN DAN KETERTIBAN MASYARAKAT', 4, '198208172010012008', 'organizational-photos/eZJC7ofc9quIVs6T8dJ9hXqtoGvEmzcx5r7lRM1c.jpg', 2, NULL, '2025-09-08 00:23:22', '2025-09-08 00:23:31'),
(11, 'Wahiman, M.Pd', 'KABID PERLINDUNGAN MASYARAKAT', 4, '197107051995031003', 'organizational-photos/Upcm8junzo6kudOKeIPVr03XnT3YH45ilq04b3gH.jpg', 3, NULL, '2025-09-08 00:24:35', '2025-09-08 00:24:35'),
(12, 'Yoshua Paskaputra, ST', 'KABID PEMADAM KEBAKARAN', 4, '198304032008041002', 'organizational-photos/Wa519rSpeLvPeV0BbMrtFJobaU9HocaJVMVVWNxn.jpg', 4, NULL, '2025-09-08 00:25:46', '2025-09-08 00:25:46'),
(13, 'Jaida, SH', 'KASUBBID PENEGAKAN', 5, '196910222006041005', 'organizational-photos/MyYTq475hX7qRxBz05uAywq7hIMgaQm7nnM61zOj.jpg', 1, NULL, '2025-09-08 00:28:40', '2025-09-08 00:28:40'),
(14, 'Nugroho Junianto, S.Sos', 'KASUBBID OPERASIONAL DAN PENGENDALIAN', 5, '198006112007011013', 'organizational-photos/AjVD6Uo0FuAvdJoQDg8WbcFozByKROGgQFgdx2K9.jpg', 2, NULL, '2025-09-08 00:29:31', '2025-09-08 00:29:31'),
(15, 'Darto Khornegi, S.IP', 'KASUBBID PEMBINAAN MASYARAKAT', 5, '197509232007011009', 'organizational-photos/WIwsqFaMMN8zEvcDEvJ8MOKrpbw5W9roJckwX9eF.jpg', 3, NULL, '2025-09-08 00:30:25', '2025-09-08 00:30:39'),
(16, 'Daswandi Supar, M.Si', 'KASUBBID OPERASIONAL DAN PERSONIL', 5, '197901242010011002', 'organizational-photos/mHwZdoGZhuHFWxYjFxmCECSICvGXrYxduaHnaXjL.jpg', 4, NULL, '2025-09-08 00:31:40', '2025-09-08 00:31:40'),
(17, 'Raden Ardy Fitrianto, SH', 'KASUBBID KERJASAMA ANTAR LEMBAGA', 6, '197908242007011004', 'organizational-photos/wTJSVIhuI8Wq17SEgT5J0FHMfavxvpRs9cpFyMvp.jpg', 1, NULL, '2025-09-08 00:33:54', '2025-09-08 00:33:54'),
(18, 'Rano, SH', 'KASUBBID KETERTIBAN UMUM', 6, '198411032007011003', 'organizational-photos/AnX1oN3eWMeULRq38bOvWljpOSotQRiUemW0awxb.jpg', 2, NULL, '2025-09-08 00:35:00', '2025-09-08 00:35:18'),
(19, 'Milono, SH', 'Plt. KASUBBID PELATIHAN DAN PENGEMBANGAN SATLINMAS', 6, '198210272007011002', 'organizational-photos/wVj47rNHnNFyKt4QaxNoDeeLwfdceeDCVHERmKsP.jpg', 3, NULL, '2025-09-08 00:36:58', '2025-09-08 00:36:58'),
(20, 'Irus, S.So', 'KASUBBID SARANA DAN PRASARANA', 6, '197609242007011010', 'organizational-photos/qHuZxH4JLTIRDPT2vVKNuwO8W8gYxmqjIxhos952.jpg', 4, NULL, '2025-09-08 00:38:28', '2025-09-08 00:38:28'),
(21, 'Samson I. Bangas, ST. M.Si', 'Polisi Pamong Praja Ahli Muda', 7, '197011292005011009', 'organizational-photos/PtrLOfDQan0Ebr09LjbKdc8ohsDyhF03i4OFZgHt.jpg', 1, NULL, '2025-09-08 00:40:04', '2025-09-08 00:40:04'),
(22, 'Theni Pamaahi, SH', 'Analis Kebijakan Ahli Muda', 7, '197410192008042001', 'organizational-photos/EJFSScHyYJhTplhVexJqoKlkdmZ6CXZrcFPO8khl.jpg', 2, NULL, '2025-09-08 00:40:42', '2025-09-08 00:40:42'),
(23, 'Emoe Tuah Pahlevi, S.Sos', 'Polisi Pamong Praja Ahli Muda', 7, '197605302007011007', 'organizational-photos/f21wl3Zms8gCl69Z4hsiKlrRD37TXhk71cmmxFLs.png', 3, NULL, '2025-09-08 00:41:58', '2025-09-08 00:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('dondisetiawan1234@gmail.com', '$2y$12$9ZhuIuKs8MIUdDr.CKtZJukWf/fqjWj/5MneDM5Rq9.K8q16UlG7u', '2025-09-11 19:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view berita', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(2, 'create berita', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(3, 'edit berita', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(4, 'delete berita', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(5, 'view users', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(6, 'create users', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(7, 'edit users', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(8, 'delete users', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'auth_token', 'c87c53614abb8e9c1dcf49ce1f651bc5e1978f163378b84f8e0055f1f4bc38b5', '[\"*\"]', '2025-09-14 20:08:10', NULL, '2025-09-14 20:04:45', '2025-09-14 20:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint UNSIGNED NOT NULL,
  `album_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `album_id`, `judul`, `deskripsi`, `path`, `created_at`, `updated_at`) VALUES
(7, 7, 'q', NULL, 'album-photos/7/6whIyAuYKzKyvpOJx2jjXY5KzRp9KfLSGypEBVkE.jpg', '2025-09-15 02:02:52', '2025-09-15 02:02:52'),
(8, 7, 'a', NULL, 'album-photos/7/MGDHcAs0dSV5Zo2bdEYZRQkZDKOUsE6fKnXzlM6f.jpg', '2025-09-15 02:03:08', '2025-09-15 02:03:08'),
(9, 7, '547953056 18042205139658226 7189112603969737000 N', NULL, 'album-photos/7/h4YJeqmYdPaDaUowKDMCV2YA7PVMcgu9n2LVJGZX.jpg', '2025-09-15 18:42:16', '2025-09-15 18:42:16'),
(10, 7, '548757838 18042205148658226 8313748800427681272 N', NULL, 'album-photos/7/MFXrsFuhYQyln5lyID4Jzm50D7pruqPwaTj9bBBS.jpg', '2025-09-15 18:43:42', '2025-09-15 18:43:42'),
(11, 8, '540508290 18040719164658226 5971969487749178933 N', NULL, 'album-photos/8/l5Cbtq9JnseMKUjUAi1HBmIYvxV1C34olvDEoCyo.jpg', '2025-09-15 19:18:47', '2025-09-15 19:18:47'),
(12, 8, '540515278 18040719155658226 8320429478053589879 N', NULL, 'album-photos/8/GsG747tlvnNdocj55WYvGMVZVJenXN4Lv2LZFuYb.jpg', '2025-09-15 19:19:02', '2025-09-15 19:19:02'),
(13, 8, '541926374 18040719173658226 8281001775605850730 N', NULL, 'album-photos/8/L9NWqaw6ou7azV5bqPXOwcuF4wCFQzVXwx0crOxv.jpg', '2025-09-15 19:19:14', '2025-09-15 19:19:14'),
(14, 9, '540460924 18040720193658226 823800776395711522 N', NULL, 'album-photos/9/jxikh86YpppBSaSnFmV46WpfZCTiks8ELR8WpW6o.jpg', '2025-09-15 19:29:55', '2025-09-15 19:29:55'),
(15, 9, '540678389 18040720184658226 9179131802906408252 N', NULL, 'album-photos/9/n6UY4xIXkTllZkF5om5BF6ECX4tLwQHJur9AcAmc.jpg', '2025-09-15 19:30:06', '2025-09-15 19:30:06'),
(16, 9, '542353303 18040720175658226 7828118344273729917 N', NULL, 'album-photos/9/67qMtoYwZNdhNaNYDCNHRCCV4UU9fHvafj2aJ8Zn.jpg', '2025-09-15 19:30:14', '2025-09-15 19:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(2, 'super-admin', 'web', '2025-09-02 00:02:55', '2025-09-02 00:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sejarah`
--

CREATE TABLE `sejarah` (
  `id` bigint UNSIGNED NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sejarah`
--

INSERT INTO `sejarah` (`id`, `konten`, `created_at`, `updated_at`) VALUES
(1, '<p style=\"text-align: justify;\">Satuan Polisi Pamong Praja (Satpol PP) merupakan salah satu perangkat pemerintah daerah yang memiliki sejarah panjang dalam perjalanan pemerintahan Indonesia. Keberadaan lembaga ini tidak terlepas dari kebutuhan pemerintah untuk menjaga ketertiban umum, menegakkan aturan, serta melindungi masyarakat sejak masa awal kemerdekaan.</p>\r\n<p style=\"text-align: justify;\">Awal mula pembentukan Satpol PP dapat ditelusuri pada tahun 1950, ketika pemerintah menetapkan Peraturan Pemerintah Nomor 50 Tahun 1950 tentang Susunan Organisasi dan Tata Kerja Kementerian Dalam Negeri. Dalam peraturan tersebut, dibentuklah satu kesatuan yang disebut \"Polisi Pamong Praja\" yang berada di bawah Kementerian Dalam Negeri. Tujuannya adalah untuk membantu kepala daerah dalam menegakkan peraturan daerah dan menjaga ketertiban masyarakat di wilayah masing-masing.</p>\r\n<p style=\"text-align: justify;\">Seiring perkembangan waktu, dasar hukum Satpol PP terus mengalami perubahan untuk menyesuaikan dengan dinamika pemerintahan dan kebutuhan masyarakat. Pada masa Orde Lama dan Orde Baru, peran Satpol PP lebih difokuskan pada upaya penertiban umum, terutama terhadap kegiatan masyarakat yang dianggap mengganggu ketertiban. Meskipun begitu, kedudukannya sering dipandang hanya sebagai perangkat tambahan, bukan bagian strategis dari pemerintahan daerah.</p>\r\n<p style=\"text-align: justify;\">Perkembangan penting terjadi setelah diterbitkannya Undang-Undang Nomor 22 Tahun 1999 tentang Pemerintahan Daerah yang menjadi tonggak awal otonomi daerah di Indonesia. Dalam UU tersebut ditegaskan bahwa Satpol PP merupakan perangkat daerah yang memiliki tugas khusus dalam menegakkan peraturan daerah, menjaga ketertiban umum, dan ketenteraman masyarakat. Kedudukan ini semakin diperjelas melalui Undang-Undang Nomor 32 Tahun 2004 dan kemudian Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah, yang hingga kini menjadi landasan hukum utama keberadaan Satpol PP.</p>\r\n<p style=\"text-align: justify;\">Selanjutnya, pemerintah mengeluarkan Peraturan Pemerintah Nomor 6 Tahun 2010 tentang Satuan Polisi Pamong Praja yang kemudian diperbarui dengan Peraturan Pemerintah Nomor 16 Tahun 2018. Regulasi ini mempertegas tugas, fungsi, wewenang, serta prinsip-prinsip pelaksanaan Satpol PP, termasuk pengaturan mengenai status kepegawaian yang menegaskan bahwa anggota Satpol PP adalah pegawai negeri sipil.</p>\r\n<p style=\"text-align: justify;\">Dalam perkembangannya, Satpol PP tidak hanya dikenal sebagai penegak peraturan daerah, tetapi juga berperan dalam memberikan perlindungan kepada masyarakat, membantu penanganan bencana, hingga mendukung ketenteraman dan keamanan di tingkat daerah. Peran ini semakin dipertegas dengan terbitnya Permendagri Nomor 16 Tahun 2023, yang mengatur tata cara pelaksanaan tugas Satpol PP agar dilakukan secara humanis, persuasif, tegas, dan berlandaskan standar operasional prosedur (SOP) serta kode etik.</p>\r\n<p style=\"text-align: justify;\">Hingga saat ini, Satpol PP telah menjadi bagian penting dari pemerintahan daerah. Dari sejarah panjangnya sejak tahun 1950, Satpol PP terus berkembang sebagai perangkat daerah yang tidak hanya menjalankan fungsi penegakan hukum di tingkat lokal, tetapi juga sebagai garda terdepan pemerintah daerah dalam menciptakan lingkungan yang tertib, aman, dan kondusif bagi masyarakat.</p>', '2025-09-11 21:24:19', '2025-09-11 23:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EdFPdyNXAdWDkj6mnWM30avLfHYaIYSblOGuPNvA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVNKV0JVSkl6NkZTbkhUS1VTSUdyVG5qM1I1cko5UWhlWHJCNjRRVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb250YWsiO31zOjE0OiJjYXB0Y2hhX2Fuc3dlciI7aToyO30=', 1758600800);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image_path`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(4, NULL, 'sliders/OOFeQjIF7ExXIClPGRiJD4pk6U8r88P4ZTlshon5.jpg', 0, 1, '2025-09-15 00:44:11', '2025-09-15 00:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `konten`, `created_at`, `updated_at`) VALUES
(1, '<p style=\"text-align: justify;\">Satuan Polisi Pamong Praja (Satpol PP) merupakan perangkat pemerintah daerah yang memiliki peran penting dalam penyelenggaraan ketertiban umum, ketenteraman masyarakat, serta penegakan peraturan daerah. Dasar hukum yang mengatur keberadaan Satpol PP antara lain adalah Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah, yang kemudian dijabarkan lebih rinci melalui Peraturan Pemerintah Nomor 16 Tahun 2018 tentang Satuan Polisi Pamong Praja, serta diperkuat dengan Permendagri Nomor 16 Tahun 2023 mengenai tata cara pelaksanaan tugas Satpol PP.</p>\r\n<p style=\"text-align: justify;\">Secara umum, Satpol PP memiliki tugas pokok untuk menegakkan Peraturan Daerah (Perda) dan Peraturan Kepala Daerah (Perkada), menyelenggarakan ketertiban umum dan ketenteraman masyarakat, serta melaksanakan perlindungan kepada masyarakat. Tugas tersebut menunjukkan bahwa Satpol PP tidak hanya berfungsi sebagai penegak aturan, tetapi juga hadir untuk menciptakan rasa aman, nyaman, dan tertib di tengah kehidupan masyarakat.</p>\r\n<p style=\"text-align: justify;\">Dalam rangka melaksanakan tugas pokok tersebut, Satpol PP memiliki sejumlah fungsi utama. Fungsi tersebut meliputi penyusunan program penegakan Perda dan Perkada, serta program ketertiban umum, ketenteraman, dan perlindungan masyarakat. Satpol PP juga bertugas melaksanakan kebijakan penegakan Perda dan Perkada, melakukan koordinasi dengan berbagai instansi terkait, serta melaksanakan pengawasan terhadap masyarakat, aparatur, maupun badan hukum agar senantiasa mematuhi ketentuan peraturan perundang-undangan. Selain itu, Satpol PP dapat diberikan fungsi tambahan oleh kepala daerah sesuai kebutuhan dan ketentuan hukum yang berlaku.</p>\r\n<p style=\"text-align: justify;\">Sejalan dengan tugas dan fungsinya, Satpol PP juga memiliki wewenang yang diatur dalam peraturan perundang-undangan. Wewenang tersebut antara lain melakukan tindakan penertiban non-yustisial terhadap warga, aparatur, atau badan hukum yang melanggar Perda dan Perkada. Satpol PP juga berwenang menindak pihak-pihak yang mengganggu ketertiban umum dan ketenteraman masyarakat, melakukan penyelidikan terhadap dugaan pelanggaran peraturan daerah, serta melaksanakan tindakan administratif terhadap setiap pelanggaran yang ditemukan.</p>\r\n<p style=\"text-align: justify;\">Agar pelaksanaan tugas, fungsi, dan wewenang berjalan sesuai dengan prinsip pemerintahan yang baik, Satpol PP wajib menjalankan perannya dengan pendekatan humanis, persuasif, dan tegas, serta berdasarkan standar operasional prosedur (SOP) dan kode etik yang berlaku. Anggota Satpol PP merupakan pegawai negeri sipil yang telah memenuhi persyaratan, sehingga dapat menjalankan tugas secara profesional. Selain itu, pelaksanaan tugas Satpol PP tidak terlepas dari koordinasi dengan instansi terkait, seperti Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia, dan aparat penegak hukum lainnya, guna mendukung terciptanya ketertiban dan keamanan yang menyeluruh.</p>\r\n<p style=\"text-align: justify;\">Dengan demikian, dapat disimpulkan bahwa Satpol PP berperan strategis dalam menjaga ketertiban umum, melindungi masyarakat, serta menegakkan peraturan daerah. Keberadaan Satpol PP diharapkan dapat menjadi garda terdepan pemerintah daerah dalam mewujudkan lingkungan yang tertib, aman, dan kondusif, sekaligus sebagai representasi hadirnya pemerintah dalam memberikan pelayanan terbaik bagi masyarakat.</p>', '2025-09-12 00:14:44', '2025-09-12 00:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', NULL, '$2y$12$CwZ6jzsuhh0YBK98oQuo6utGdJjA9KV6iiDC953mgKulaB9XOt4Dy', NULL, '2025-09-02 00:02:55', '2025-09-02 00:02:55'),
(2, 'Admin', 'admin@example.com', NULL, '$2y$12$WQ2ZIWu1BkLQ3uRf6d.LS..h8AILRY2icy5nGEGQ9TqwSzm4nST.G', NULL, '2025-09-02 00:02:56', '2025-09-02 00:02:56'),
(3, 'karbit', 'karbit@gmail.com', NULL, '$2y$12$vVVyo8XiqriG9HZsGDd21u/j7AMG7un6w9RbdRl1oOImMJLXl5eAS', NULL, '2025-09-02 01:19:19', '2025-09-02 01:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `visi_misis`
--

CREATE TABLE `visi_misis` (
  `id` bigint UNSIGNED NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visi_misis`
--

INSERT INTO `visi_misis` (`id`, `visi`, `misi`, `created_at`, `updated_at`) VALUES
(1, '<p>\"Terwujudnya Kabupaten Katingan yang Maju, Sejahtera, Berkeadilan, dan Berakhlak Mulia.\"</p>', '<p style=\"text-align: justify;\">Dalam rangka mewujudkan visi tersebut, Satuan Polisi Pamong Praja dan Pemadam Kebakaran Kabupaten Katingan menetapkan misi sebagai berikut:</p>\r\n<ol>\r\n<li style=\"text-align: justify;\">Menegakkan Peraturan Daerah dan Peraturan Kepala Daerah secara adil, profesional, dan humanis.</li>\r\n<li style=\"text-align: justify;\">Mewujudkan ketenteraman dan ketertiban umum serta memberikan perlindungan kepada masyarakat.</li>\r\n<li style=\"text-align: justify;\">Menyelenggarakan pencegahan, penanggulangan, dan penyelamatan kebakaran maupun non-kebakaran secara cepat, tepat, dan terpadu.</li>\r\n<li style=\"text-align: justify;\">Meningkatkan kapasitas, integritas, dan profesionalisme aparatur Satpol PP dan Damkar untuk mendukung pelayanan publik yang berkualitas.</li>\r\n<li style=\"text-align: justify;\">Memperkuat koordinasi dan kemitraan strategis dengan TNI, Polri, perangkat daerah, serta masyarakat dalam menjaga stabilitas dan keamanan daerah.</li>\r\n</ol>', '2025-09-02 18:55:15', '2025-09-15 00:51:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `activity_logs_loggable_type_loggable_id_index` (`loggable_type`,`loggable_id`);

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_id_user_foreign` (`id_user`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`),
  ADD KEY `documents_kategori_index` (`kategori`),
  ADD KEY `documents_is_public_index` (`is_public`),
  ADD KEY `documents_created_at_index` (`created_at`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `organizational_structures`
--
ALTER TABLE `organizational_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizational_structures_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_album_id_foreign` (`album_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sejarah`
--
ALTER TABLE `sejarah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visi_misis`
--
ALTER TABLE `visi_misis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `organizational_structures`
--
ALTER TABLE `organizational_structures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sejarah`
--
ALTER TABLE `sejarah`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visi_misis`
--
ALTER TABLE `visi_misis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organizational_structures`
--
ALTER TABLE `organizational_structures`
  ADD CONSTRAINT `organizational_structures_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `organizational_structures` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
