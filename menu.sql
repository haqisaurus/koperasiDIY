-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2011 at 09:44 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_path` varchar(1000) NOT NULL,
  `menu_id_rel` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_path`, `menu_id_rel`) VALUES
(1, 'home', '', 0),
(2, 'Transaksi', '', 0),
(3, 'Pencarian', '', 0),
(4, 'Laporan', '', 0),
(5, 'Cetak', '', 0),
(6, 'Master', '', 0),
(7, 'Pengaturan', '', 0),
(8, 'Akuntansi', '', 0),
(9, 'Pembayaran Cabang', '', 2),
(10, 'Simpanan', '', 2),
(11, 'Transaksi Pembayaran', '', 2),
(12, 'Pinjaman', '', 2),
(13, 'Pembayaran Pribadi', '', 2),
(14, 'Sewa', '', 2),
(15, 'Pengeluaran', '', 2),
(16, 'Modal', '', 2),
(17, 'Tutup Buku', '', 2),
(18, 'Simpanan Pokok', '', 4),
(19, 'Simpanan Wajib', '', 4),
(20, 'Buku Tabungan', '', 4),
(21, 'Transaksi Simpanan Sukarela', '', 4),
(22, 'Pinjaman', '', 4),
(23, 'Angsuran', '', 4),
(24, 'Modal', '', 4),
(25, 'Pembarayan Cabang', '', 4),
(26, 'Simpanan Sukarela', '', 5),
(27, 'Simpan Pinjam', '', 5),
(28, 'Pembayaran Cabang', '', 5),
(29, 'Anggota Koperasi', '', 6),
(30, 'Cabang', '', 6),
(31, 'Jenis Modal', '', 6),
(32, 'Jenis Pengeluaran', '', 6),
(33, 'Bunga & Biaya', '', 6),
(34, 'Data Rekening Awal', '', 6),
(35, 'Sub Sub Rekening', '', 6),
(36, 'Sub Rekening', '', 6),
(37, 'Rekening', '', 6),
(38, 'Kategori', '', 6),
(39, 'Retail', '', 0),
(40, 'Barang', '', 39),
(41, 'Penjualan', '', 39),
(42, 'Daftar Hutang Anggota', '', 39),
(43, 'Laporan Penjualan', '', 39),
(44, 'Anggota', '', 3),
(45, 'Simpanan Sukarela', '', 3),
(46, 'Pinjaman', '', 3),
(47, 'Jurnal Umum', '', 8),
(48, 'Buku Besar', '', 8),
(49, 'Neraca', '', 8);
