-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 06 Sep 2016 pada 12.15
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `radio`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetAncestry`(GivenID INT) RETURNS varchar(1024) CHARSET latin1
    DETERMINISTIC
BEGIN
    DECLARE rv VARCHAR(1024);
    DECLARE cm CHAR(1);
    DECLARE ch INT;

    SET rv = '';
    SET cm = '';
    SET ch = GivenID;
    WHILE ch > 0 DO
        SELECT IFNULL(root,-1) INTO ch FROM
        (SELECT root FROM sys_menus_mst WHERE id_menu = ch) A;
        IF ch > 0 THEN
            SET rv = CONCAT(rv,cm,ch);
            SET cm = ',';
        END IF;
    END WHILE;
    RETURN rv;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetFamilyTree`(GivenID INT) RETURNS varchar(1024) CHARSET latin1
    DETERMINISTIC
BEGIN

    DECLARE rv,q,queue,queue_children VARCHAR(1024);
    DECLARE queue_length,front_id,pos INT;

    SET rv = '';
    SET queue = GivenID;
    SET queue_length = 1;

    WHILE queue_length > 0 DO
        SET front_id = FORMAT(queue,0);
        IF queue_length = 1 THEN
            SET queue = '';
        ELSE
            SET pos = LOCATE(',',queue) + 1;
            SET q = SUBSTR(queue,pos);
            SET queue = q;
        END IF;
        SET queue_length = queue_length - 1;

        SELECT IFNULL(qc,'') INTO queue_children
        FROM (SELECT GROUP_CONCAT(id) qc
        FROM sys_menus_mst WHERE root = front_id) A;

        IF LENGTH(queue_children) = 0 THEN
            IF LENGTH(queue) = 0 THEN
                SET queue_length = 0;
            END IF;
        ELSE
            IF LENGTH(rv) = 0 THEN
                SET rv = queue_children;
            ELSE
                SET rv = CONCAT(rv,',',queue_children);
            END IF;
            IF LENGTH(queue) = 0 THEN
                SET queue = queue_children;
            ELSE
                SET queue = CONCAT(queue,',',queue_children);
            END IF;
            SET queue_length = LENGTH(queue) - LENGTH(REPLACE(queue,',','')) + 1;
        END IF;
    END WHILE;

    RETURN rv;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetParentIDByID`(GivenID INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
    DECLARE rv INT;

    SELECT IFNULL(root,-1) INTO rv FROM
    (SELECT root FROM sys_menus_mst WHERE id_menu = GivenID) A;
    RETURN rv;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetPriority`(inID INT) RETURNS varchar(255) CHARSET latin1
    DETERMINISTIC
begin
  DECLARE gParentID INT DEFAULT 0;
  DECLARE gPriority VARCHAR(255) DEFAULT '';
  SET gPriority = inID;
  SELECT root INTO gParentID FROM sys_menus_mst WHERE id_menu = inID;
  WHILE gParentID > 0 DO
    SET gPriority = CONCAT(gParentID, '.', gPriority);
    SELECT root INTO gParentID FROM sys_menus_mst WHERE id_menu = gParentID;
  END WHILE;
  RETURN gPriority;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hkm_spks_apv`
--

CREATE TABLE IF NOT EXISTS `hkm_spks_apv` (
  `f_spks` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `apv_nip` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `apv_status` enum('Y','T') COLLATE utf8_unicode_ci DEFAULT NULL,
  `apv_tgl` date DEFAULT NULL,
  `mandatori` enum('Y','T') COLLATE utf8_unicode_ci DEFAULT NULL,
  `komentar` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  KEY `hkm_spks_apv_f_spks_foreign` (`f_spks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `hkm_spks_apv`
--

INSERT INTO `hkm_spks_apv` (`f_spks`, `apv_nip`, `apv_status`, `apv_tgl`, `mandatori`, `komentar`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('SPKS/2016/08/00001', '!@#QQ@Qwrqwerwq!', NULL, NULL, 'Y', NULL, 'pcaSdetPB1HyMjeM', NULL, '2016-08-23 14:13:12', NULL, 'A'),
('SPKS/2016/08/00001', 'sdfasdfaq12!@#!@', NULL, NULL, 'Y', NULL, 'pcaSdetPB1HyMjeM', NULL, '2016-08-23 14:13:12', NULL, 'A'),
('SPKS-2016-08-00001', '!@#QQ@Qwrqwerwq!', NULL, NULL, 'Y', NULL, 'pcaSdetPB1HyMjeM', NULL, '2016-08-23 14:29:46', NULL, 'A'),
('SPKS-2016-08-00001', 'sdfasdfaq12!@#!@', NULL, NULL, 'Y', NULL, 'pcaSdetPB1HyMjeM', NULL, '2016-08-23 14:29:47', NULL, 'A'),
('SPKS-2016-08-00004', '!@#QQ@Qwrqwerwq', 'Y', '2016-08-30', 'Y', 'saya yes aja', '1234567891011121', '12345678910111213', '2016-08-27 04:22:04', '2016-08-30 02:14:47', 'A'),
('SPKS-2016-08-00004', 'sdfasd1234123$w', NULL, NULL, 'Y', NULL, '1234567891011121', NULL, '2016-08-27 04:22:04', NULL, 'A'),
('SPKS-2016-08-00005', '!@#QQ@Qwrqwerwq', NULL, NULL, 'Y', NULL, '1234567891011121', '12345678910111213', '2016-08-27 04:23:11', '2016-08-28 18:04:39', 'N'),
('SPKS-2016-08-00005', 'sdfasd1234123$w', NULL, NULL, 'T', NULL, '1234567891011121', '12345678910111213', '2016-08-27 04:23:11', '2016-08-28 18:04:39', 'N'),
('SPKS-2016-08-00006', '!@#QQ@Qwrqwerwq', 'Y', '2016-08-27', 'Y', 'komentar pertama', '1234567891011121', '12345678910111213', '2016-08-27 04:34:51', '2016-08-30 01:50:04', 'A'),
('SPKS-2016-08-00006', 'sdfasd1234123$w', 'Y', '2016-08-27', 'T', 'komentar pertama', '1234567891011121', '12345678910111213', '2016-08-27 04:34:51', '2016-08-30 01:50:04', 'A'),
('SPKS-2016-08-00002', '!@#QQ@Qwrqwerwq', 'Y', '2016-08-27', 'Y', 'klo saya si yes..', '1234567891011121', '12345678910111213', '2016-08-27 15:39:55', '2016-08-27 16:26:55', 'A'),
('SPKS-2016-08-00002', 'sdfasd1234123$w', 'T', '2016-08-27', 'Y', 'mohon maaf saya belum bisa', '1234567891011121', '12345678910111213', '2016-08-27 15:39:55', '2016-08-27 16:29:11', 'A'),
('SPKS-2016-08-00003', '!@#QQ@Qwrqwerwq', 'T', '2016-08-27', 'Y', 'yang ini saya kurang setuju', '12345678910111213', '12345678910111213', '2016-08-27 18:52:16', '2016-08-28 19:49:49', 'A'),
('SPKS-2016-08-00003', 'sdfasd1234123$w', 'Y', '2016-08-27', 'Y', 'yup sudah mau menikah orangnya', '12345678910111213', '12345678910111213', '2016-08-27 18:52:16', '2016-08-28 19:49:49', 'A'),
('SPKS-2016-08-00005', '!@#QQ@Qwrqwerwq', 'Y', '2016-08-29', 'Y', 'klo saya sih ok dah..', '12345678910111213', '12345678910111213', '2016-08-29 01:04:39', '2016-08-28 18:05:00', 'A'),
('SPKS-2016-08-00005', 'sdfasd1234123$w', 'T', '2016-08-29', 'T', 'klo kamu gimana?', '12345678910111213', '12345678910111213', '2016-08-29 01:04:39', '2016-08-28 18:05:05', 'A'),
('SPKS-2016-08-00007', '!@#QQ@Qwrqwerwq', 'Y', '2016-08-30', 'Y', NULL, '12345678910111213', '12345678910111213', '2016-08-30 04:17:48', '2016-08-30 02:33:10', 'A'),
('SPKS-2016-08-00007', 'sdfasd1234123$w', 'Y', '2016-08-30', 'Y', 'ok', '12345678910111213', '12345678910111213', '2016-08-30 04:17:48', '2016-08-30 02:33:10', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hkm_spks_mst`
--

CREATE TABLE IF NOT EXISTS `hkm_spks_mst` (
  `id_spks` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `alias_spks` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `f_customer` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `draft` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spks` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_spks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `hkm_spks_mst`
--

INSERT INTO `hkm_spks_mst` (`id_spks`, `alias_spks`, `f_customer`, `nama`, `tgl_awal`, `tgl_akhir`, `draft`, `spks`, `keterangan`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('SPKS-2016-08-00001', 'SPKS-2016-08-00001', 'CST-00003', 'PT. Swadhika Salam Sejahtera', '2016-08-22', '2016-08-30', '23-3d-beach-sand-wallpaper.jpg', 'bebaskan-palestina-gaza.jpg', '<div>keterangan</div>', 'pcaSdetPB1HyMjeM', NULL, '2016-08-23 14:29:46', NULL, 'A'),
('SPKS-2016-08-00002', 'SPKS-2016-08-00002', 'CST-00001', 'PT. Rianday Sukses Bersama', '2016-08-30', '2016-09-29', 'camp-map.png', 'anomalis.png', 'masa jadi array', '1234567891011121', '1234567891011121', '2016-08-25 09:08:21', '2016-08-27 08:39:55', 'A'),
('SPKS-2016-08-00003', 'SPKS-2016-08-00003', 'CST-00003', 'PT. Swadhika Salam Sejahtera', '2016-08-25', '2016-08-30', 'abstract-cheetah-animal-picture-hd-wallpaper.jpg', 'anomali.png', '<div>keterangan lengkap selengkap-lengkapnya</div>', '1234567891011121', '1234567891011121', '2016-08-26 09:30:01', '2016-08-28 19:49:49', 'A'),
('SPKS-2016-08-00004', 'SPKS-2016-08-00004', 'CST-00001', 'PT. Rianday Sukses Bersama', '2016-08-30', '2016-09-29', '23-3d-beach-sand-wallpaper.jpg', 'bolt20GB.png', 'masa jadi array', '1234567891011121', '1234567891011121', '2016-08-27 04:11:47', '2016-08-26 21:22:04', 'A'),
('SPKS-2016-08-00005', 'SPKS-2016-08-00005', 'CST-00003', 'PT. Swadhika Salam Sejahtera', '2016-08-30', '2017-08-30', 'camp-map.png', NULL, '<div>test keterangan selengkapnya</div>', '1234567891011121', '1234567891011121', '2016-08-27 04:23:11', '2016-08-28 18:04:39', 'A'),
('SPKS-2016-08-00006', 'SPKS-2016-08-00006', 'CST-00002', 'PT. Salam Salim Kancil', '2016-08-30', '2016-08-30', 'bolt_mei_2015.pdf', 'agp_monitoring_20150511.png', 'aaas', '1234567891011121', '1234567891011121', '2016-08-27 04:31:16', '2016-08-30 01:50:04', 'A'),
('SPKS-2016-08-00007', 'SPKS-2016-08-00007', 'CST-00004', 'PT. Joko Lelono Maju Mundur', '2016-08-29', '2016-09-29', 'agp_monitoring_20150511.png', 'juanda.png', '<div>keterangan</div>', '1234567891011121', '1234567891011121', '2016-08-30 04:17:48', '2016-08-30 02:33:10', 'A'),
('SPKS/2016/08/00001', 'SPKS/2016/08/00001', 'CST-00003', 'PT. Swadhika Salam Sejahtera', '2016-08-22', '2016-08-30', '/opt/lampp/htdocs/laravel/laravel-projects/radio/storage/app/public/draft/23-3d-beach-sand-wallpaper.jpg', '/opt/lampp/htdocs/laravel/laravel-projects/radio/storage/app/public/spks/android_system_architecture.png', '<div>keterangan</div>', 'pcaSdetPB1HyMjeM', NULL, '2016-08-23 14:13:12', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_05_08_103339_create_pms_produk_mst', 1),
('2016_05_10_135156_pms_produk_tarif', 1),
('2016_05_10_135752_pms_customer_mst', 1),
('2016_05_10_145331_pms_tgl_libur_mst', 1),
('2016_05_10_145928_pms_pnwr_mst', 1),
('2016_05_10_152925_pms_pnwr_tayang', 1),
('2016_05_10_153433_pms_pnwr_materi', 1),
('2016_05_11_142111_pms_pnwr_spk', 1),
('2016_05_11_142955_pms_fp_mst', 1),
('2016_05_11_143840_pms_fp_det', 1),
('2016_08_08_143530_hkm', 2),
('2016_08_10_033928_sys', 3),
('2016_08_10_040050_sdm', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_customer_mst`
--

CREATE TABLE IF NOT EXISTS `pms_customer_mst` (
  `id_customer` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `nama_customer` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_customer_mst`
--

INSERT INTO `pms_customer_mst` (`id_customer`, `nama_customer`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('CST-00001', 'PT. Rianday Sukses Bersama', 'ADMIN', '2016-05-24 07:47:56', 'A'),
('CST-00002', 'PT. Salam Salim Kancil', 'ADMIN', '2016-05-24 08:05:43', 'A'),
('CST-00003', 'PT. Swadhika Salam Sejahtera', 'ADMIN', '2016-05-24 10:37:58', 'A'),
('CST-00004', 'PT. Joko Lelono Maju Mundur', 'ADMIN', '2016-05-26 01:21:05', 'A'),
('CST-00005', 'CV. Tugas Bersama', 'ADMIN', '2016-05-26 06:33:28', 'A'),
('CST-00006', 'PT. Rima Andalan', 'ADMIN', '2016-05-26 06:33:51', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_fp_det`
--

CREATE TABLE IF NOT EXISTS `pms_fp_det` (
  `f_fp` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `f_pnwr` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `total_biaya` mediumint(8) unsigned NOT NULL,
  `nilai_biaya_persen` tinyint(3) unsigned DEFAULT NULL,
  `nilai_biaya` mediumint(8) unsigned NOT NULL,
  `nilai_potongan_persen` tinyint(3) unsigned DEFAULT NULL,
  `nilai_potongan` mediumint(8) unsigned DEFAULT NULL,
  `nilai_hpp` mediumint(8) unsigned NOT NULL,
  `nilai_ppn` mediumint(8) unsigned NOT NULL,
  `nilai_akhir` mediumint(8) unsigned NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  KEY `pms_fp_det_f_fp_foreign` (`f_fp`),
  KEY `pms_fp_det_f_pnwr_foreign` (`f_pnwr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_fp_det`
--

INSERT INTO `pms_fp_det` (`f_fp`, `f_pnwr`, `total_biaya`, `nilai_biaya_persen`, `nilai_biaya`, `nilai_potongan_persen`, `nilai_potongan`, `nilai_hpp`, `nilai_ppn`, `nilai_akhir`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('FP2016.00002', '00001/RSAU/SP/06/2016', 1272727, 100, 1272727, 0, 0, 1272727, 127273, 1400000, 'ADMIN', '2016-06-21 06:43:40', 'N'),
('FP2016.00001', '00002/RSAU/SP/06/2016', 909091, 1, 9091, 0, 0, 9091, 909, 10000, 'ADMIN', '2016-06-22 05:44:35', 'A'),
('FP2016.00001', '00001/RSAU/SP/06/2016', 2272727, 10, 227273, 0, 0, 227273, 22727, 250000, 'ADMIN', '2016-06-22 06:22:42', 'N'),
('FP2016.00001', '00001/RSAU/SP/06/2016', 2272727, 10, 227273, 0, 0, 227273, 22727, 250000, 'ADMIN', '2016-06-22 06:30:21', 'N'),
('FP2016.00001', '00003/RSAU/SP/06/2016', 10000000, 10, 1000000, 0, 0, 1000000, 100000, 1100000, 'ADMIN', '2016-06-22 06:33:57', 'N'),
('FP2016.00001', '00001/RSAU/SP/06/2016', 2272727, 10, 227273, 0, 0, 227273, 22727, 250000, 'ADMIN', '2016-06-22 08:43:06', 'N'),
('FP2016.00002', '00002/RSAU/SP/06/2016', 900000, 0, 900000, 0, 0, 900000, 90000, 990000, 'ADMIN', '2016-06-22 08:43:42', 'A'),
('FP2016.00003', '00003/RSAU/SP/06/2016', 10000000, 0, 10000000, 0, 0, 10000000, 1000000, 11000000, 'ADMIN', '2016-06-22 08:45:14', 'A'),
('FP2016.00004', '00001/RSAU/SP/06/2016', 2045454, 0, 2045454, 0, 0, 2045454, 204545, 2249999, 'ADMIN', '2016-06-22 08:46:43', 'A'),
('FP2016.00001', '00001/RSAU/SP/06/2016', 227273, 0, 227273, 0, 0, 227273, 22727, 250000, 'ADMIN', '2016-06-22 08:47:43', 'N'),
('FP2016.00001', '00001/RSAU/SP/06/2016', 227273, 0, 227273, 0, 0, 227273, 22727, 250000, 'ADMIN', '2016-09-01 02:55:21', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_fp_mst`
--

CREATE TABLE IF NOT EXISTS `pms_fp_mst` (
  `id_fp` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `generate_ke` int(10) unsigned NOT NULL,
  `f_customer` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_fp` date NOT NULL DEFAULT '2016-05-13',
  `deskripsi_fp` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `jenis_faktur` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `ttd` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `netto` mediumint(8) unsigned NOT NULL,
  `netto_terbilang` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_fp`),
  KEY `pms_fp_mst_f_customer_foreign` (`f_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_fp_mst`
--

INSERT INTO `pms_fp_mst` (`id_fp`, `generate_ke`, `f_customer`, `tgl_fp`, `deskripsi_fp`, `tgl_jatuh_tempo`, `jenis_faktur`, `keterangan`, `ttd`, `netto`, `netto_terbilang`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('FP2016.00001', 1, 'CST-00001', '2016-06-21', '<div>Faktur pertama.</div>', '2016-06-30', 'TUNAI', 'keterangan', 'JOKO', 260000, 'Seratus', 'ADMIN', '2016-06-21 06:08:36', 'A'),
('FP2016.00002', 1, 'CST-00001', '2016-06-21', '<div>jeudlalaskaskal &nbsp;asdlasdkasl</div>', '2016-06-30', 'TUNAI', 'keterangan', 'JOKO', 990000, 'Seratus', 'ADMIN', '2016-06-21 06:43:40', 'A'),
('FP2016.00003', 1, 'CST-00001', '2016-06-22', '<div>judul faktur.. kadar</div>', '2016-06-30', 'TUNAI', 'keterangan', 'JOKO', 11000000, 'Seratus', 'ADMIN', '2016-06-22 08:45:14', 'A'),
('FP2016.00004', 1, 'CST-00001', '2016-06-23', '<div>penjualan gorengan selama ramadhan</div>', '2016-06-30', 'KREDIT', 'hanya keterangan semata', 'SWADHIKA', 2249999, 'Seratus', 'ADMIN', '2016-06-22 08:46:43', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_pnwr_materi`
--

CREATE TABLE IF NOT EXISTS `pms_pnwr_materi` (
  `f_pnwr` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `materi_tayang` varchar(4000) COLLATE utf8_unicode_ci NOT NULL,
  `materi_attach` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `realisasi_produk` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  KEY `pms_pnwr_materi_f_pnwr_foreign` (`f_pnwr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_pnwr_materi`
--

INSERT INTO `pms_pnwr_materi` (`f_pnwr`, `materi_tayang`, `materi_attach`, `realisasi_produk`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('00001/RSAU/SP/06/2016', '<div>Materi menggambar bebas lepas</div>', '', '', 'ADMIN', '2016-06-14 01:17:43', 'A'),
('00002/RSAU/SP/06/2016', '<div><b style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">Jakarta</b><span style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">&nbsp;- Presiden Joko Widodo (Jokowi) mengajukan nama Komisaris Jenderal Tito Karnavian sebagai calon tunggal Kepala Kepolisian RI ke Dewan Perwakilan Rakyat. Komjen Tito akan menggantikan Jenderal Badrodin Haiti yang akan memasuki masa pensiun pada 24 Juli.&nbsp;</span><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><span style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">Seperti apa profil Komjen Tito sang calon Kapolri?&nbsp;</span><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><span style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">Tito Karnavian yang lahir di Palembang 26 Oktober 1964 merupakan penerima bintang Adhi Makayasa atau lulusan terbaik Akademi Kepolisian 1987. Sejak menyandang pangkat perwira menengah Polri, Tito seperti ditasbihkan menjadi pengejar buronan polisi.</span><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><span style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">Bulan Oktober 2000, saat menjabat Kepala Satuan Reserse Umum Polda Metro Jaya, Tito memimpin pencarian buron kasus Badan Urusan Logistik (Bulog) Soewondo. Tito yang memimpin empat polisi itu berhasil menciduk Soewondo setelah menjadi buron selama 5 bulan.</span><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><span style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">Setahun kemudian Tito kembali mendapat tugas mengejar buron. Kali ini yang diburu adalah "Pangeran Cendana", Hutomo Mandala Putra alias Tommy Soeharto yang disangka terlibat penembakan hakim agung Syafiuddin Kartasasmita. Kasus itu terjadi pada Juli 2001.&nbsp;</span><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><span style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">Tito ditunjuk oleh Kapolda Metro Jaya Inspektur Jenderal Sofjan Jacoeb memimpin Tim Cobra yang beranggotakan 23 perwira polisi untuk memburu Tommy Soeharto. Di bawah pimpinan Tito, Tim Cobra berhasil menangkap Tommy Soeharto.&nbsp;</span><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"><span style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;">Pada 2005, Tito yang menjabat sebagai Kepala Kepolisian Resort Serang mendapat tugas melacak gembong teroris Doktor Azahari. Di saat yang sama tepatnya 7 November 2005 Kepala Badan Reserse Kriminal Mabes Polri ketika itu Komjen Makbul Padmanagara meminta Tito terbang ke Poso, Sulawesi Tengah, untuk melacak pelaku pembunuhan mutilasi tiga orag siswa.&nbsp;</span><br style="color: rgb(45, 45, 45); font-family: helvetica, arial; font-size: 16px; line-height: 22.4px;"></div><div></div>', '', '', 'ADMIN', '2016-06-16 23:52:00', 'A'),
('00003/RSAU/SP/06/2016', '<div>materi bellum ada</div>', '', '', 'ADMIN', '2016-06-22 14:12:37', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_pnwr_mst`
--

CREATE TABLE IF NOT EXISTS `pms_pnwr_mst` (
  `id_pnwr` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `no_po_customer` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `f_customer` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `judul_iklan` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `kepada` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `f_ae` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `f_produk` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `f_spks` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tarif` int(20) unsigned NOT NULL,
  `tgl_penawaran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `durasi` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `periode` tinyint(3) unsigned NOT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `frekuensi` tinyint(3) unsigned NOT NULL,
  `total_tayang` tinyint(3) unsigned NOT NULL,
  `jenis_bayar` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `tarif_normal` int(16) unsigned NOT NULL,
  `tarif_diskon` int(16) unsigned NOT NULL,
  `tarif_potongan` int(16) unsigned NOT NULL,
  `tarif_hpp` int(16) unsigned NOT NULL,
  `tarif_ppn` int(16) unsigned NOT NULL,
  `tarif_total` int(16) unsigned NOT NULL,
  `pnwr_hpp` int(16) unsigned NOT NULL,
  `pnwr_ppn` int(16) unsigned NOT NULL,
  `pnwr_total` mediumint(16) unsigned NOT NULL,
  `pnwr_status` enum('proses','order','pending','batal') COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_pnwr`),
  KEY `pms_pnwr_mst_f_customer_foreign` (`f_customer`),
  KEY `pms_pnwr_mst_f_produk_foreign` (`f_produk`),
  KEY `pms_pnwr_mst_f_tarif_foreign` (`tarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_pnwr_mst`
--

INSERT INTO `pms_pnwr_mst` (`id_pnwr`, `no_po_customer`, `f_customer`, `judul_iklan`, `kepada`, `f_ae`, `f_produk`, `f_spks`, `tarif`, `tgl_penawaran`, `durasi`, `periode`, `tgl_awal`, `tgl_akhir`, `frekuensi`, `total_tayang`, `jenis_bayar`, `tarif_normal`, `tarif_diskon`, `tarif_potongan`, `tarif_hpp`, `tarif_ppn`, `tarif_total`, `pnwr_hpp`, `pnwr_ppn`, `pnwr_total`, `pnwr_status`, `keterangan`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('00001/RSAU/SP/06/2016', 'po tes', 'CST-00001', 'judul test 123', 'kepada test', 'ae test', 'BRG-00006', 'SPKS-2016-08-00004', 500000, '2016-06-29 17:00:00', '60', 2, '0000-00-00', '0000-00-00', 3, 6, 'TUNAI', 3000000, 10, 300000, 2700000, 270000, 2970000, 2272727, 227273, 2500000, 'batal', 'keterangan test', 'ADMIN', '2016-05-24 08:05:43', 'A'),
('00001/RSAU/SP/08/2016', 'SKPO/JOKO/IKLAN/000012', 'CST-00003', 'IKLAN KE 12', 'Bapak joko lelono', 'budi joko', 'BRG-00006', 'SPKS-2016-08-00003', 500000, '2016-08-29 17:00:00', '60', 10, '0000-00-00', '0000-00-00', 2, 20, 'TUNAI', 10000000, 0, 0, 10000000, 1000000, 11000000, 9090909, 909091, 10000000, 'proses', 'test', 'ADMIN', '2016-05-24 10:37:58', 'A'),
('00002/RSAU/SP/06/2016', 'po tes', 'CST-00001', 'judul iklan apa saja', 'kepada test', 'ae test', 'BRG-00006', 'SPKS-2016-08-00004', 500000, '2016-08-30 17:00:00', '60', 2, '0000-00-00', '0000-00-00', 3, 6, 'TUNAI', 3000000, 10, 300000, 2700000, 270000, 2970000, 909091, 90909, 1000000, 'pending', 'keterangan test', 'ADMIN', '2016-05-24 07:47:56', 'A'),
('00002/RSAU/SP/08/2016', 'joko/12', 'CST-00004', 'joko lelono bersahaja', 'budi joko', 'andi f noya', 'BRG-00006', 'SPKS-2016-08-00007', 500000, '2016-08-29 17:00:00', '60', 20, '0000-00-00', '0000-00-00', 2, 40, 'TUNAI', 20000000, 10, 2000000, 18000000, 1800000, 19800000, 16777215, 1727273, 16777215, 'proses', 'tidak ada keterangan', 'ADMIN', '2016-05-26 01:21:05', 'A'),
('00003/RSAU/SP/06/2016', 'po-po-pi', 'CST-00001', 'iklan ke 3', 'rianday', 'ae eo', 'BRG-00006', 'SPKS-2016-08-00002', 500000, '2016-06-13 17:00:00', '60', 4, '0000-00-00', '0000-00-00', 2, 8, 'TUNAI', 4000000, 0, 0, 4000000, 400000, 4400000, 10000000, 1000000, 11000000, 'proses', 'keterangan', 'ADMIN', '2016-05-24 07:47:56', 'A'),
('00003/RSAU/SP/08/2016', 'martini', 'CST-00004', 'abcdef', 'joko lelono', 'budi joko', 'BRG-00006', 'SPKS-2016-08-00007', 500000, '2016-08-30 17:00:00', '60', 14, NULL, NULL, 3, 42, 'TUNAI', 16777215, 20, 4200000, 16777215, 1680000, 16777215, 16363636, 1636364, 16777215, 'proses', 'tidak ada keterangan', 'ADMIN', '2016-05-26 01:21:05', 'A'),
('00004/RSAU/SP/08/2016', 'RIMA/001', 'CST-00003', 'iklan remaja indonesia 2016', 'rimaday', 'budi lelono', 'BRG-00006', '', 500000, '2016-08-30 17:00:00', '60', 30, '0000-00-00', '0000-00-00', 2, 60, 'TUNAI', 30000000, 0, 0, 30000000, 3000000, 33000000, 16777215, 2727273, 16777215, 'proses', 'siap tayang', 'ADMIN', '2016-05-24 10:37:58', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_pnwr_spk`
--

CREATE TABLE IF NOT EXISTS `pms_pnwr_spk` (
  `id_spks` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `f_pnwr` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `pihak_pertama` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan_pihak_pertama` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `pihak_kedua` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan_pihak_kedua` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_spks` date NOT NULL DEFAULT '2016-05-13',
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_spks`),
  KEY `pms_pnwr_spk_f_pnwr_foreign` (`f_pnwr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_pnwr_tayang`
--

CREATE TABLE IF NOT EXISTS `pms_pnwr_tayang` (
  `f_pnwr` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `tayang_tgl` date NOT NULL,
  `tayang_jam` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `tayang_realisasi` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  KEY `pms_pnwr_tayang_f_pnwr_foreign` (`f_pnwr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_pnwr_tayang`
--

INSERT INTO `pms_pnwr_tayang` (`f_pnwr`, `tayang_tgl`, `tayang_jam`, `tayang_realisasi`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('00001/RSAU/SP/06/2016', '2016-08-08', '0815,1230,1500', '0815,1225,1545', 'Admin', '2016-08-08 03:59:32', 'A'),
('00001/RSAU/SP/06/2016', '2016-09-08', '0930,1200,1530', NULL, 'Admin', '2016-08-08 03:59:32', 'A'),
('00002/RSAU/SP/06/2016', '2016-08-08', '0730,1145,1625', '0730,1145,1625', 'Admin', '2016-08-08 04:00:51', 'A'),
('00002/RSAU/SP/06/2016', '2016-08-09', '0730,1145,1625', NULL, 'Admin', '2016-08-08 04:00:51', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_produk_mst`
--

CREATE TABLE IF NOT EXISTS `pms_produk_mst` (
  `id_produk` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `durasi` bigint(20) unsigned NOT NULL,
  `satuan_durasi` enum('detik','menit') COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_produk_mst`
--

INSERT INTO `pms_produk_mst` (`id_produk`, `nama`, `durasi`, `satuan_durasi`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('BRG-00002', 'Guest Star', 30, 'menit', 'ADMIN', '2016-05-13 18:26:06', 'A'),
('BRG-00003', 'Drama', 60, 'menit', 'ADMIN', '2016-05-13 18:42:41', 'A'),
('BRG-00004', 'Kuliner', 35, 'detik', 'ADMIN', '2016-05-14 02:13:01', 'A'),
('BRG-00006', 'Iklan A', 60, 'detik', 'ADMIN', '2016-05-14 02:21:19', 'A'),
('BRG-00007', 'Box Office', 30, 'menit', 'ADMIN', '2016-05-15 15:01:54', 'A'),
('BRG-00008', 'Melawan LP', 40, 'menit', 'ADMIN', '2016-05-15 15:02:40', 'A'),
('BRG-00009', 'Senin', 30, 'menit', 'ADMIN', '2016-05-15 15:14:22', 'A'),
('BRG-00010', 'Produk 3', 40, 'detik', 'ADMIN', '2016-05-16 01:09:49', 'A'),
('BRG-00011', 'Produk 4', 90, 'menit', 'ADMIN', '2016-05-16 06:22:21', 'A'),
('BRG-00012', 'Produk 5', 30, 'menit', 'ADMIN', '2016-05-16 07:44:28', 'A'),
('BRG-00013', 'Produk 6', 54, 'menit', 'ADMIN', '2016-05-24 09:09:21', 'A'),
('BRG-00014', 'UMKM solo', 90, 'detik', 'ADMIN', '2016-05-30 00:35:26', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_produk_tarif`
--

CREATE TABLE IF NOT EXISTS `pms_produk_tarif` (
  `id_tarif` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `f_produk` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `harga` bigint(20) unsigned NOT NULL,
  `satuan_durasi` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'A',
  PRIMARY KEY (`id_tarif`),
  KEY `pms_produk_tarif_f_produk_foreign` (`f_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_produk_tarif`
--

INSERT INTO `pms_produk_tarif` (`id_tarif`, `f_produk`, `harga`, `satuan_durasi`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('TRF-0001', 'BRG-00006', 500000, 'menit', 'ADMIN', '2016-05-14 02:24:35', 'A'),
('TRF-0002', 'BRG-00011', 90000, 'detik', 'ADMIN', '2016-05-16 06:34:55', 'A'),
('TRF-0003', 'BRG-00003', 9000, 'menit', 'ADMIN', '2016-05-16 07:22:26', 'A'),
('TRF-0004', 'BRG-00012', 150000, 'menit', 'ADMIN', '2016-05-16 07:44:51', 'A'),
('TRF-0005', 'BRG-00004', 9000, 'menit', 'ADMIN', '2016-05-16 14:06:38', 'N'),
('TRF-0006', 'BRG-00013', 20000, 'menit', 'ADMIN', '2016-05-24 09:10:02', 'A'),
('TRF-0007', 'BRG-00013', 20000, 'menit', 'ADMIN', '2016-05-24 09:10:02', 'A'),
('TRF-0008', 'BRG-00013', 2000, 'menit', 'ADMIN', '2016-05-24 09:10:02', 'A'),
('TRF-0009', 'BRG-00013', 2000, 'menit', 'ADMIN', '2016-05-24 09:10:02', 'A'),
('TRF-0010', 'BRG-00006', 50000, 'menit', 'ADMIN', '2016-05-14 02:24:35', 'A'),
('TRF-0011', 'BRG-00004', 900, 'menit', 'ADMIN', '2016-05-16 14:06:38', 'N'),
('TRF-0012', 'BRG-00004', 9000, 'menit', 'ADMIN', '2016-05-16 14:06:38', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pms_tgl_libur_mst`
--

CREATE TABLE IF NOT EXISTS `pms_tgl_libur_mst` (
  `id_tanggal` date NOT NULL,
  `deskripsi` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_update` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_status_aktif` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pms_tgl_libur_mst`
--

INSERT INTO `pms_tgl_libur_mst` (`id_tanggal`, `deskripsi`, `sys_user_update`, `sys_tgl_update`, `sys_status_aktif`) VALUES
('2015-05-26', 'tidak boleh kosong', 'ADMIN', '2016-05-23 02:43:42', 'A'),
('2016-03-14', 'hari libur nasionals', 'ADMIN', '2016-05-16 16:25:10', 'A'),
('2016-05-24', 'Pra Persiapan Puasa Ramadhan', 'ADMIN', '2016-05-23 03:12:37', 'A'),
('2016-05-27', 'Persiapan Puasa Ramadhan', 'ADMIN', '2016-05-23 03:02:27', 'A'),
('2016-06-07', 'puasa pertama''', 'ADMIN', '2016-05-24 06:19:00', 'A'),
('2016-07-07', 'Lebaran Nasional Indonesia', 'ADMIN', '2016-05-24 09:10:36', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_agama_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_agama_mst` (
  `id_agama` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nama_agama` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_agama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_agama_mst`
--

INSERT INTO `sdm_agama_mst` (`id_agama`, `nama_agama`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('ISL', 'ISLAM', 'ADMIN', NULL, '2016-08-22 09:12:47', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_bank_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_bank_mst` (
  `id_bank` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama_bank` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_bank_mst`
--

INSERT INTO `sdm_bank_mst` (`id_bank`, `nama_bank`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('MANDIRI', 'BANK MANDIRI', 'ADMIN', NULL, '2016-08-22 09:18:47', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_golongan_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_golongan_mst` (
  `id_golongan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_golongan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_golongan_mst`
--

INSERT INTO `sdm_golongan_mst` (`id_golongan`, `keterangan`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('VID', 'VI D', 'ADMIN', NULL, '2016-08-22 09:13:20', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_jabatan_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_jabatan_mst` (
  `id_jabatan` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `root` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nama_jabatan` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_jabatan_mst`
--

INSERT INTO `sdm_jabatan_mst` (`id_jabatan`, `root`, `alias_id`, `nama_jabatan`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('123QEWQ23QWEt@!#@', NULL, 'J01', 'DIREKTUR', 'ADMIN', NULL, '2016-08-22 09:14:03', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_jabatan_pegawai_trx`
--

CREATE TABLE IF NOT EXISTS `sdm_jabatan_pegawai_trx` (
  `f_nip` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `f_ou` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `f_jabatan` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `no_sk` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  KEY `sdm_jabatan_pegawai_trx_f_nip_foreign` (`f_nip`),
  KEY `sdm_jabatan_pegawai_trx_f_ou_foreign` (`f_ou`),
  KEY `sdm_jabatan_pegawai_trx_f_jabatan_foreign` (`f_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_ou_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_ou_mst` (
  `id_ou` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `root` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ket_depan` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nama_ou` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_ou`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_ou_mst`
--

INSERT INTO `sdm_ou_mst` (`id_ou`, `root`, `alias_id`, `ket_depan`, `nama_ou`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('1231!@#!@#ASKHDGFASKDFH%^&%^&!@#', 'ASTDASIHB1231$%#%$@@#$SDFSDF', '1.1', 'DIREKTORAT', 'KEUANGAN', 'ADMIN', NULL, '2016-08-22 09:17:06', NULL, 'A'),
('ASTDASIHB1231$%#%$@@#$SDFSDF', NULL, '1', '', 'ROOT', 'ADMIN', NULL, '2016-08-22 09:15:34', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_pegawai_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_pegawai_mst` (
  `nip_sys` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nip_alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` enum('LAKI-LAKI','PEREMPUAN') COLLATE utf8_unicode_ci NOT NULL,
  `alamat_tinggal` text COLLATE utf8_unicode_ci NOT NULL,
  `alamat_ktp` text COLLATE utf8_unicode_ci,
  `tgl_masuk` date NOT NULL,
  `telpon` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `no_npwp` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `no_identitas` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_jamsostek` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `f_perusahaan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `f_golongan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `f_status_kerja` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `f_status_kawin` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `f_agama` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `f_kewarganegaraan` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'INDONESIA',
  `f_bank` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_rekening` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`nip_sys`),
  KEY `sdm_pegawai_mst_f_perusahaan_foreign` (`f_perusahaan`),
  KEY `sdm_pegawai_mst_f_golongan_foreign` (`f_golongan`),
  KEY `sdm_pegawai_mst_f_status_kerja_foreign` (`f_status_kerja`),
  KEY `sdm_pegawai_mst_f_status_kawin_foreign` (`f_status_kawin`),
  KEY `sdm_pegawai_mst_f_agama_foreign` (`f_agama`),
  KEY `sdm_pegawai_mst_f_kewarganegaraan_foreign` (`f_kewarganegaraan`),
  KEY `sdm_pegawai_mst_f_bank_foreign` (`f_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_pegawai_mst`
--

INSERT INTO `sdm_pegawai_mst` (`nip_sys`, `nip_alias`, `nama`, `tempat_lahir`, `tgl_lahir`, `kelamin`, `alamat_tinggal`, `alamat_ktp`, `tgl_masuk`, `telpon`, `no_hp`, `no_npwp`, `no_identitas`, `no_jamsostek`, `f_perusahaan`, `f_golongan`, `f_status_kerja`, `f_status_kawin`, `f_agama`, `f_kewarganegaraan`, `f_bank`, `no_rekening`, `foto`, `email`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('!@#QQ@Qwrqwerwq', '00002', 'ANISA NURUL AINI', 'SLO', '1977-08-22', 'PEREMPUAN', 'WERWERWER', 'WERWERWER', '2004-08-22', '123123', '123123', '123123', '123123', '123123', 'PST', 'VID', 'KT', 'BK', 'ISL', 'IND', 'MANDIRI', '123123123', NULL, 'NISA.ERWAN@GMAIL.COM', 'ADMIN', NULL, '2016-08-22 09:23:03', NULL, 'A'),
('12345678910111213', '0000X', 'RIANDAY', 'DEPOK', '1977-08-22', 'LAKI-LAKI', 'WERWERWER', 'WERWERWER', '2004-08-22', '123123', '123123', '123123', '123123', '123123', 'PST', 'VID', 'KT', 'BK', 'ISL', 'IND', 'MANDIRI', '123123123', NULL, 'NISA.ERWAN@GMAIL.COM', 'ADMIN', NULL, '2016-08-22 09:23:03', NULL, 'A'),
('R1!@#$!@#4QWER1', '00001', 'BAMBANG NATUR', 'SOLO', '1966-08-22', 'LAKI-LAKI', 'SOLO', 'SOLO', '1996-08-22', '1231231', '1231231', '123123123', '1231231231', '123123123', 'PST', 'VID', 'KT', 'BK', 'ISL', 'IND', 'MANDIRI', '234234234234', NULL, 'bembenk@gmail.com', 'ADMIN', NULL, '2016-08-22 09:21:14', NULL, 'A'),
('sdfasd1234123$w', '00003', 'Intan', 'solo', '2016-08-23', 'PEREMPUAN', 'solo', 'solo', '2016-08-23', '1231234123', '1231231', '123123', '123123', '1231231', 'PST', 'VID', 'KT', 'BK', 'ISL', 'IND', 'MANDIRI', NULL, NULL, NULL, 'ADMIN', NULL, '2016-08-23 04:27:59', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_perusahaan_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_perusahaan_mst` (
  `id_perusahaan` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `root` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nama_perusahaan` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_perusahaan_mst`
--

INSERT INTO `sdm_perusahaan_mst` (`id_perusahaan`, `root`, `nama_perusahaan`, `alamat`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('PST', '', 'PT. JURNALINDO AKSARA GRAFIKA', 'JAKARTA PUSAT', 'ADMIN', NULL, '2016-08-22 09:17:39', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_status_kawin_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_status_kawin_mst` (
  `id_status_kawin` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nama_status` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_status_kawin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_status_kawin_mst`
--

INSERT INTO `sdm_status_kawin_mst` (`id_status_kawin`, `nama_status`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('BK', 'BELUM KAWIN', 'ADMIN', NULL, '2016-08-22 09:18:09', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sdm_status_kerja_mst`
--

CREATE TABLE IF NOT EXISTS `sdm_status_kerja_mst` (
  `id_status_kerja` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `nama_status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_status_kerja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sdm_status_kerja_mst`
--

INSERT INTO `sdm_status_kerja_mst` (`id_status_kerja`, `nama_status`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('KT', 'KARYAWAN TETAP', 'ADMIN', NULL, '2016-08-22 09:18:27', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_app_mst`
--

CREATE TABLE IF NOT EXISTS `sys_app_mst` (
  `id_app` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `f_type` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `f_module` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urutan` int(10) unsigned NOT NULL,
  `route` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `akses_role` enum('*','L') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'L',
  `keterangan` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_app`),
  KEY `sys_app_mst_f_type_foreign` (`f_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sys_app_mst`
--

INSERT INTO `sys_app_mst` (`id_app`, `nama`, `f_type`, `f_module`, `urutan`, `route`, `link`, `akses_role`, `keterangan`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('1231HlKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWao', 'Master SPKS', 'MST', NULL, 1, '/mst/hkm/spks', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 14:10:06', NULL, 'A'),
('20b9jHlKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWa3', 'Realisasi Produksi', 'TRX', 'prod', 1, '/trx/prod/realisasi', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 14:08:58', NULL, 'A'),
('20b9jHlKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWao', 'Customer', 'MST', 'pms', 2, '/mst/pms/customer', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 14:01:46', NULL, 'A'),
('4IO0cFUZlxG6dXF17uuP8rL1KlmK0yQhbfchfnUgo05JbfRqA9iXQJD2OQ82uJFpteVE7cpivuEzpLqW2VUuVxUBId35pp0nox1g3105lCpjDOOOxqOTKi2ctPSoHMiX', 'Produk dan Tarif', 'MST', 'pms', 1, '/mst/pms/produk', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 14:00:30', NULL, 'A'),
('98lKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWa3', 'Hukum', 'MENU', 'hkm', 2, '/mst/hkm/menu', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 15:30:11', NULL, 'A'),
('JvNAU7f8JNbBvLDjDaI4OFT7JVX1vJhHFxozZcHzTr4nqRB32uFnFOQWYeqUuEvW5zONWe0LJqdJTtiFQ9M84dquEJm4WzzLp2P236TUNvmKrX5Wz8vAeM02EkaSAO7p', 'Penawaran', 'TRX', 'pms', 4, '/trx/pms/pnwrMst', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 14:03:11', NULL, 'A'),
('NVxDxjsDDWTJihiEaO4QCNl1fCZCtwmMNOc45UocuL0JOof1LDvCsiZwiJgeBJPr9K4836Jp2BQMsunn7iXcovCNQg6RGF3EYMUptUT8JJM3mozrKD35Hw12AcJ7JOl3', 'Home', 'WEB', NULL, 0, '/home', NULL, '*', NULL, 'ADMIN', NULL, '2016-08-31 14:05:32', NULL, 'A'),
('NVxDxjsDDWTJihiEaO4QCNl1fCZCtwmMNOc45UocuL0JOof1LDvCsiZwiJgeBJPr9K4836Jp2BQMsunn7iXcovCNQg6RGF3EYMUptUT8JJM3mozrKD35Hw12AcJ7JOls', 'Tanggal Libur', 'MST', 'pms', 3, '/mst/pms/libur', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 14:04:20', NULL, 'A'),
('oppslKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWa3', 'Pemasaran', 'MENU', 'pms', 1, '/mst/pms/menu', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 15:30:11', NULL, 'A'),
('oppyslKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWa3', 'Pemasaran', 'MENU', 'pms', 1, '/trx/pms/menu', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 15:30:11', NULL, 'A'),
('zmvDz6XDPNXDDWytZTT4Ol6FZfAryzbEHmr2pTekgERRESVPU7cf6JhaxoK4uQdpkEcyAMz44GYjwheX0UZOShjXHXwyovNTDP2gdeLdHHas3vI2grXOdu7wFiboq0tb', 'Faktur Penjualan', 'TRX', 'pms', 2, '/trx/pms/fpMst', NULL, 'L', NULL, 'ADMIN', NULL, '2016-08-31 14:06:54', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_group_akses_det`
--

CREATE TABLE IF NOT EXISTS `sys_group_akses_det` (
  `f_app` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `f_group` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `akses` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'c,r,u,d',
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  KEY `sys_group_akses_det_f_app_foreign` (`f_app`),
  KEY `sys_group_akses_det_f_group_foreign` (`f_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_group_mst`
--

CREATE TABLE IF NOT EXISTS `sys_group_mst` (
  `id_group` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nama_group` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_menus_mst`
--

CREATE TABLE IF NOT EXISTS `sys_menus_mst` (
  `id_menu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `level` int(10) unsigned NOT NULL,
  `nama_menu` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `f_type` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `f_app` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urutan` int(10) unsigned DEFAULT NULL,
  `keterangan` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth` enum('Y','T') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_menu`),
  KEY `sys_menus_mst_f_type_foreign` (`f_type`),
  KEY `sys_menus_mst_f_app_foreign` (`f_app`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `sys_menus_mst`
--

INSERT INTO `sys_menus_mst` (`id_menu`, `root`, `level`, `nama_menu`, `f_type`, `f_app`, `urutan`, `keterangan`, `icon`, `auth`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
(1, NULL, 0, 'root', 'OTH', NULL, 1, NULL, NULL, 'Y', 'ADMIN', NULL, '2016-08-31 14:12:07', NULL, 'A'),
(2, 1, 1, 'General', 'MENU', NULL, 1, NULL, NULL, 'T', 'ADMIN', NULL, '2016-08-31 14:13:14', NULL, 'A'),
(3, 2, 2, 'Home', 'WEB', 'NVxDxjsDDWTJihiEaO4QCNl1fCZCtwmMNOc45UocuL0JOof1LDvCsiZwiJgeBJPr9K4836Jp2BQMsunn7iXcovCNQg6RGF3EYMUptUT8JJM3mozrKD35Hw12AcJ7JOl3', 1, NULL, 'fa-home', 'Y', 'ADMIN', NULL, '2016-08-31 14:15:45', NULL, 'A'),
(4, 1, 1, 'Radio', 'MENU', NULL, 2, NULL, NULL, 'Y', 'ADMIN', NULL, '2016-08-31 14:16:39', NULL, 'A'),
(5, 4, 2, 'Master', 'MENU', NULL, 1, NULL, 'fa-table', 'Y', 'ADMIN', NULL, '2016-08-31 14:17:18', NULL, 'A'),
(6, 5, 3, 'Pemasaran', 'MST', 'oppslKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWa3', 1, NULL, NULL, 'Y', 'ADMIN', NULL, '2016-08-31 15:32:21', NULL, 'A'),
(7, 8, 3, 'Pemasaran', 'TRX', 'oppyslKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWa3', 1, NULL, NULL, 'Y', 'ADMIN', NULL, '2016-08-31 15:32:21', NULL, 'A'),
(8, 4, 2, 'Transaksi', 'MENU', NULL, 2, NULL, 'fa-edit', 'Y', 'ADMIN', NULL, '2016-08-31 14:17:18', NULL, 'A'),
(9, 5, 3, 'Hukum', 'MST', '98lKYM5bPamowcRXbC8iA7jXbudMT7fkS3pgpKbEfKDScZA3vpTPAZ6vM9FTMn5J6LY8CtrmuZ3qhLAHOkodnlxHfZDQ0RKMZ0LSZvmygBWqxd8xcDtZCZWKYWa3', 2, NULL, NULL, 'Y', 'ADMIN', NULL, '2016-08-31 15:32:21', NULL, 'A'),
(10, 4, 2, 'Laporan', 'MENU', NULL, 3, NULL, 'fa-print', 'Y', 'ADMIN', NULL, '2016-08-31 14:17:18', NULL, 'A'),
(11, 4, 2, 'Approval', 'MENU', NULL, 4, NULL, 'fa-thumbs-up', 'Y', 'ADMIN', NULL, '2016-08-31 14:17:18', NULL, 'A'),
(12, 4, 2, 'Dokumentasi', 'MENU', NULL, 5, NULL, 'fa-file', 'Y', 'ADMIN', NULL, '2016-08-31 14:17:18', NULL, 'A'),
(13, 2, 2, 'Dashboard', 'MENU', NULL, 2, NULL, 'fa-navicon', 'T', 'ADMIN', NULL, '2016-08-31 14:13:14', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_module_mst`
--

CREATE TABLE IF NOT EXISTS `sys_module_mst` (
  `id_module` varchar(8) NOT NULL,
  `nama_module` varchar(32) NOT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `sys_user_created` varchar(16) NOT NULL,
  `sys_user_updated` varchar(16) DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sys_module_mst`
--

INSERT INTO `sys_module_mst` (`id_module`, `nama_module`, `keterangan`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('hkm', 'Hukum', 'modul Hukum\r\n', 'ADMIN', NULL, '2016-08-31 22:28:55', NULL, 'A'),
('HRIS', 'HRIS', 'MODUL HRIS', 'ADMIN', NULL, '2016-08-31 22:28:55', NULL, 'N'),
('pms', 'Pemasaran', 'modul pemasaran\r\n', 'ADMIN', NULL, '2016-08-31 22:28:55', NULL, 'A'),
('prod', 'Produksi', 'modul produksi\r\n', 'ADMIN', NULL, '2016-08-31 22:28:55', NULL, 'A'),
('SITE', 'SITES', 'MODUL UMUM SITE', 'ADMIN', NULL, '2016-08-31 22:28:55', NULL, 'A'),
('SYS', 'SYSTEM', 'MODUL SISTEM', 'ADMIN', NULL, '2016-08-31 22:28:55', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_negara_mst`
--

CREATE TABLE IF NOT EXISTS `sys_negara_mst` (
  `id_negara` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nama_negara` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_negara`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sys_negara_mst`
--

INSERT INTO `sys_negara_mst` (`id_negara`, `nama_negara`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('IND', 'INDONESIA', 'SYSADMIN', NULL, '2016-08-10 02:22:09', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_status_mst`
--

CREATE TABLE IF NOT EXISTS `sys_status_mst` (
  `id_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sys_status_mst`
--

INSERT INTO `sys_status_mst` (`id_status`, `keterangan`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('A', 'Aktif', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A'),
('N', 'Non-Aktif', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A'),
('T', 'Tidak', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A'),
('Y', 'Ya', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_type_mst`
--

CREATE TABLE IF NOT EXISTS `sys_type_mst` (
  `id_type` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nama_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sys_type_mst`
--

INSERT INTO `sys_type_mst` (`id_type`, `nama_type`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('APV', 'APPROVAL', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A'),
('MENU', 'Link Menu', 'SYSADMIN', NULL, '2016-08-10 02:22:09', NULL, 'A'),
('MST', 'MASTER DATA', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A'),
('OTH', 'LAIN-LAIN', 'SYSADMIN', NULL, '2016-08-10 02:22:09', NULL, 'A'),
('RPT', 'REPORT', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A'),
('TRX', 'TRANSAKSI', 'SYSADMIN', NULL, '2016-08-10 02:22:08', NULL, 'A'),
('WEB', 'Web Content', 'SYSADMIN', NULL, '2016-08-10 02:22:09', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_user_akses_det`
--

CREATE TABLE IF NOT EXISTS `sys_user_akses_det` (
  `f_user` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `f_app` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `akses` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  KEY `sys_user_akses_det_f_user_foreign` (`f_user`),
  KEY `sys_user_akses_det_f_app_foreign` (`f_app`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_user_mst`
--

CREATE TABLE IF NOT EXISTS `sys_user_mst` (
  `f_nip_sys` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_online` enum('Y','T') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_created` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_user_updated` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_tgl_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sys_tgl_updated` timestamp NULL DEFAULT NULL,
  `sys_status_aktif` enum('A','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`f_nip_sys`),
  UNIQUE KEY `sys_user_mst_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sys_user_mst`
--

INSERT INTO `sys_user_mst` (`f_nip_sys`, `name`, `email`, `password`, `is_online`, `remember_token`, `sys_user_created`, `sys_user_updated`, `sys_tgl_created`, `sys_tgl_updated`, `sys_status_aktif`) VALUES
('12345678910111213', 'rian', 'rianday.green@gmail.com', '$2y$10$MFyg.GlhLcXL1o1bF54eB.iYBU8mykgorGT9K6ySsM6Qef8Y9FEN.', 'Y', 'cNduSinQW0a3rTluTTMd6ZWP4Ssu9qMIP9hwu0wGvlErlGzXNxuZSMOuHNuK', 'ADMIN', NULL, '2016-08-10 01:11:13', NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rianday', 'rianday.green@gmail.com', '$2y$10$3TuCKmsmvHeF/er3OVOxieMxL0t0/VUUcVRZDersP02Fmg5pfygN2', 'YBTf3uJb1EmQBouORtDW2wsx69IzGY9iXaZp1KGV7pb0PcqhMp4Ym9nU1q0X', '2016-05-13 18:36:38', '2016-07-18 00:01:21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_fp_rangkuman`
--
CREATE TABLE IF NOT EXISTS `v_fp_rangkuman` (
`f_pnwr` varchar(64)
,`total_biaya` mediumint(8) unsigned
,`total_nilai_biaya_persen` decimal(25,0)
,`total_nilai_biaya` decimal(30,0)
,`total_nilai_potongan_persen` decimal(25,0)
,`total_nilai_potongan` decimal(30,0)
,`total_nilai_hpp` decimal(30,0)
,`total_nilai_ppn` decimal(30,0)
,`total_nilai_akhir` decimal(30,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_menu_app`
--
CREATE TABLE IF NOT EXISTS `v_menu_app` (
`id_menu` int(10) unsigned
,`root` int(10) unsigned
,`level` int(10) unsigned
,`type_menu` varchar(8)
,`urutan` int(10) unsigned
,`nama_menu` varchar(32)
,`ket_menu` varchar(64)
,`icon` varchar(32)
,`auth` enum('Y','T')
,`aktif_menu` enum('A','N')
,`id_app` varchar(128)
,`nama` varchar(64)
,`type_app` varchar(8)
,`route` varchar(128)
,`link` varchar(512)
,`akses_role` enum('*','L')
,`ket_app` varchar(256)
,`aktif_app` enum('A','N')
);
-- --------------------------------------------------------

--
-- Struktur untuk view `v_fp_rangkuman`
--
DROP TABLE IF EXISTS `v_fp_rangkuman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_fp_rangkuman` AS select `bb`.`f_pnwr` AS `f_pnwr`,max(`bb`.`total_biaya`) AS `total_biaya`,ifnull(sum(`bb`.`nilai_biaya_persen`),0) AS `total_nilai_biaya_persen`,sum(`bb`.`nilai_biaya`) AS `total_nilai_biaya`,sum(`bb`.`nilai_potongan_persen`) AS `total_nilai_potongan_persen`,sum(`bb`.`nilai_potongan`) AS `total_nilai_potongan`,sum(`bb`.`nilai_hpp`) AS `total_nilai_hpp`,sum(`bb`.`nilai_ppn`) AS `total_nilai_ppn`,sum(`bb`.`nilai_akhir`) AS `total_nilai_akhir` from (`pms_fp_mst` `aa` join `pms_fp_det` `bb` on((`aa`.`id_fp` = `bb`.`f_fp`))) where ((`aa`.`sys_status_aktif` = 'A') and (`bb`.`sys_status_aktif` = 'A')) group by `bb`.`f_pnwr`;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_menu_app`
--
DROP TABLE IF EXISTS `v_menu_app`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_menu_app` AS select `aa`.`id_menu` AS `id_menu`,`aa`.`root` AS `root`,`aa`.`level` AS `level`,`aa`.`f_type` AS `type_menu`,`aa`.`urutan` AS `urutan`,`aa`.`nama_menu` AS `nama_menu`,`aa`.`keterangan` AS `ket_menu`,`aa`.`icon` AS `icon`,`aa`.`auth` AS `auth`,`aa`.`sys_status_aktif` AS `aktif_menu`,`bb`.`id_app` AS `id_app`,`bb`.`nama` AS `nama`,`bb`.`f_type` AS `type_app`,`bb`.`route` AS `route`,`bb`.`link` AS `link`,`bb`.`akses_role` AS `akses_role`,`bb`.`keterangan` AS `ket_app`,`bb`.`sys_status_aktif` AS `aktif_app` from (`sys_menus_mst` `aa` left join `sys_app_mst` `bb` on(((`aa`.`f_app` = `bb`.`id_app`) and (`bb`.`sys_status_aktif` = 'A')))) where (`aa`.`sys_status_aktif` = 'A') order by `GetPriority`(`aa`.`id_menu`),`aa`.`urutan`;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hkm_spks_apv`
--
ALTER TABLE `hkm_spks_apv`
  ADD CONSTRAINT `hkm_spks_apv_f_spks_foreign` FOREIGN KEY (`f_spks`) REFERENCES `hkm_spks_mst` (`id_spks`);

--
-- Ketidakleluasaan untuk tabel `pms_fp_det`
--
ALTER TABLE `pms_fp_det`
  ADD CONSTRAINT `pms_fp_det_f_fp_foreign` FOREIGN KEY (`f_fp`) REFERENCES `pms_fp_mst` (`id_fp`),
  ADD CONSTRAINT `pms_fp_det_f_pnwr_foreign` FOREIGN KEY (`f_pnwr`) REFERENCES `pms_pnwr_mst` (`id_pnwr`);

--
-- Ketidakleluasaan untuk tabel `pms_fp_mst`
--
ALTER TABLE `pms_fp_mst`
  ADD CONSTRAINT `pms_fp_mst_f_customer_foreign` FOREIGN KEY (`f_customer`) REFERENCES `pms_customer_mst` (`id_customer`);

--
-- Ketidakleluasaan untuk tabel `pms_pnwr_materi`
--
ALTER TABLE `pms_pnwr_materi`
  ADD CONSTRAINT `pms_pnwr_materi_f_pnwr_foreign` FOREIGN KEY (`f_pnwr`) REFERENCES `pms_pnwr_mst` (`id_pnwr`);

--
-- Ketidakleluasaan untuk tabel `pms_pnwr_mst`
--
ALTER TABLE `pms_pnwr_mst`
  ADD CONSTRAINT `pms_pnwr_mst_f_customer_foreign` FOREIGN KEY (`f_customer`) REFERENCES `pms_customer_mst` (`id_customer`),
  ADD CONSTRAINT `pms_pnwr_mst_f_produk_foreign` FOREIGN KEY (`f_produk`) REFERENCES `pms_produk_mst` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `pms_pnwr_spk`
--
ALTER TABLE `pms_pnwr_spk`
  ADD CONSTRAINT `pms_pnwr_spk_f_pnwr_foreign` FOREIGN KEY (`f_pnwr`) REFERENCES `pms_pnwr_mst` (`id_pnwr`);

--
-- Ketidakleluasaan untuk tabel `pms_pnwr_tayang`
--
ALTER TABLE `pms_pnwr_tayang`
  ADD CONSTRAINT `pms_pnwr_tayang_f_pnwr_foreign` FOREIGN KEY (`f_pnwr`) REFERENCES `pms_pnwr_mst` (`id_pnwr`);

--
-- Ketidakleluasaan untuk tabel `pms_produk_tarif`
--
ALTER TABLE `pms_produk_tarif`
  ADD CONSTRAINT `pms_produk_tarif_f_produk_foreign` FOREIGN KEY (`f_produk`) REFERENCES `pms_produk_mst` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `sdm_jabatan_pegawai_trx`
--
ALTER TABLE `sdm_jabatan_pegawai_trx`
  ADD CONSTRAINT `sdm_jabatan_pegawai_trx_f_jabatan_foreign` FOREIGN KEY (`f_jabatan`) REFERENCES `sdm_jabatan_mst` (`id_jabatan`),
  ADD CONSTRAINT `sdm_jabatan_pegawai_trx_f_nip_foreign` FOREIGN KEY (`f_nip`) REFERENCES `sdm_pegawai_mst` (`nip_sys`),
  ADD CONSTRAINT `sdm_jabatan_pegawai_trx_f_ou_foreign` FOREIGN KEY (`f_ou`) REFERENCES `sdm_ou_mst` (`id_ou`);

--
-- Ketidakleluasaan untuk tabel `sdm_pegawai_mst`
--
ALTER TABLE `sdm_pegawai_mst`
  ADD CONSTRAINT `sdm_pegawai_mst_f_agama_foreign` FOREIGN KEY (`f_agama`) REFERENCES `sdm_agama_mst` (`id_agama`),
  ADD CONSTRAINT `sdm_pegawai_mst_f_bank_foreign` FOREIGN KEY (`f_bank`) REFERENCES `sdm_bank_mst` (`id_bank`),
  ADD CONSTRAINT `sdm_pegawai_mst_f_golongan_foreign` FOREIGN KEY (`f_golongan`) REFERENCES `sdm_golongan_mst` (`id_golongan`),
  ADD CONSTRAINT `sdm_pegawai_mst_f_kewarganegaraan_foreign` FOREIGN KEY (`f_kewarganegaraan`) REFERENCES `sys_negara_mst` (`id_negara`),
  ADD CONSTRAINT `sdm_pegawai_mst_f_perusahaan_foreign` FOREIGN KEY (`f_perusahaan`) REFERENCES `sdm_perusahaan_mst` (`id_perusahaan`),
  ADD CONSTRAINT `sdm_pegawai_mst_f_status_kawin_foreign` FOREIGN KEY (`f_status_kawin`) REFERENCES `sdm_status_kawin_mst` (`id_status_kawin`),
  ADD CONSTRAINT `sdm_pegawai_mst_f_status_kerja_foreign` FOREIGN KEY (`f_status_kerja`) REFERENCES `sdm_status_kerja_mst` (`id_status_kerja`);

--
-- Ketidakleluasaan untuk tabel `sys_app_mst`
--
ALTER TABLE `sys_app_mst`
  ADD CONSTRAINT `sys_app_mst_f_type_foreign` FOREIGN KEY (`f_type`) REFERENCES `sys_type_mst` (`id_type`);

--
-- Ketidakleluasaan untuk tabel `sys_group_akses_det`
--
ALTER TABLE `sys_group_akses_det`
  ADD CONSTRAINT `sys_group_akses_det_f_app_foreign` FOREIGN KEY (`f_app`) REFERENCES `sys_app_mst` (`id_app`),
  ADD CONSTRAINT `sys_group_akses_det_f_group_foreign` FOREIGN KEY (`f_group`) REFERENCES `sys_group_mst` (`id_group`);

--
-- Ketidakleluasaan untuk tabel `sys_menus_mst`
--
ALTER TABLE `sys_menus_mst`
  ADD CONSTRAINT `sys_menus_mst_f_app_foreign` FOREIGN KEY (`f_app`) REFERENCES `sys_app_mst` (`id_app`),
  ADD CONSTRAINT `sys_menus_mst_f_type_foreign` FOREIGN KEY (`f_type`) REFERENCES `sys_type_mst` (`id_type`);

--
-- Ketidakleluasaan untuk tabel `sys_user_akses_det`
--
ALTER TABLE `sys_user_akses_det`
  ADD CONSTRAINT `sys_user_akses_det_f_app_foreign` FOREIGN KEY (`f_app`) REFERENCES `sys_app_mst` (`id_app`),
  ADD CONSTRAINT `sys_user_akses_det_f_user_foreign` FOREIGN KEY (`f_user`) REFERENCES `sys_user_mst` (`f_nip_sys`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
