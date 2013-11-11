-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2013 at 10:52 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_pelita`
--
CREATE DATABASE IF NOT EXISTS `db_pelita` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_pelita`;

-- --------------------------------------------------------

--
-- Table structure for table `perkiraan`
--

CREATE TABLE IF NOT EXISTS `perkiraan` (
  `nomoraccount` varchar(10) NOT NULL,
  `namaaccount` varchar(50) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `tanggalentry` date NOT NULL,
  `kodekaryawan` varchar(10) DEFAULT NULL,
  `tanggalsaldoawal` date NOT NULL,
  `saldo` bigint(12) NOT NULL,
  `tempnamaaccount` varchar(50) DEFAULT NULL,
  `cetak` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nomoraccount`),
  KEY `userid` (`kodekaryawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perkiraan`
--

INSERT INTO `perkiraan` (`nomoraccount`, `namaaccount`, `level`, `type`, `tanggalentry`, `kodekaryawan`, `tanggalsaldoawal`, `saldo`, `tempnamaaccount`, `cetak`) VALUES
('1', 'Aktiva', 1, 1, '2013-10-03', 'Admin001', '2013-09-26', 0, '', 1),
('1.1', 'Kas', 2, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('1.1.01', 'Kas Kecil', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.1.02', 'Kas Penerimaan Piutang', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.2', 'Bank', 2, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('1.2.01', 'BCA 2873074990 a/n PT WBK', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.2.02', 'CIMB Niaga a/c 4320100465007 a/n PT WBK', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.2.03', 'CIMB Niaga a/c 4320100465003', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.2.04', 'Commenwealth 1049870911 a/n PT WBK', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.3', 'Deposito ', 2, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('1.3.01', 'Deposito CIMB Niaga', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.4', 'Piutang Dagang', 2, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('1.4.01', 'Piutang Dagang Indoor', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.4.02', 'Piutang Dagang Jasa', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.5', 'Persediaan', 2, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('1.5.01', 'Persediaan Bahan Kertas', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.5.02', 'Persediaan Bahan Cetakan', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.6', 'Pembayaran Dimuka', 2, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('1.6.01', 'Uang Muka Pembelian', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.6.02', 'Asuransi Dibayar Dimuka', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9', 'Aktiva Tetap', 2, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('1.9.01', 'Tanah dan Bangunan', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9.02', 'Mesin dan Perlengkapan', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9.03', 'Inventaris ', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9.04', 'Kendaraan', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9.51', 'Ak. Peny. Bangunan', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9.52', 'Ak. Peny. Mesin', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9.53', 'Ak. Peny. Inventaris', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('1.9.54', 'Ak. Peny. Kendaraan', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('2', 'Kewajiban', 1, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('2.1', 'Hutang Dagang', 2, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('2.1.01', 'Hutang Dagang', 3, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('2.2', 'Penerimaan Uang Muka', 2, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('2.2.01', 'Uang Muka Penjualan', 3, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('2.3', 'Hutang Bank', 2, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('2.3.01', 'Hutang KI CIMB Niaga', 3, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('2.4', 'Hutang Leasing', 2, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('2.4.01', 'Hutang Leasing Mobil', 3, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('2.4.02', 'Hutang Leasing Mesin SM 52 ', 3, 1, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('2.4.03', 'Hutang Leasing Mesin SM 74', 3, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('2.9', 'Hutang Lain-Lain', 2, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('2.9.01', 'Hutang Lain - ', 3, 2, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('3', 'Modal Disetor', 1, 5, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('3.1', 'Modal Disetor', 2, 5, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('3.1.01', 'Modal Disetor ', 3, 5, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('3.2', 'Laba Ditahan', 2, 5, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('3.2.01', 'Laba Ditahan', 3, 5, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('3.3', 'Laba Tahun Berjalan', 2, 5, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 1),
('3.3.01', 'Laba Tahun Berjalan', 3, 5, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4', 'Pendapatan', 1, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.1', 'Pendapatan Indoor', 2, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.1.01', 'Pendapatan Indoor', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.2', 'Pendapatan Jasa', 2, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.2.01', 'Pendapatan Jasa Mesin Cetak', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.2.02', 'Pendapatan Jasa Mesin Laminating', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.2.03', 'Pendapatan Jasa Mesin Vernish', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.2.04', 'Pendapatan Jasa Mesin Pond', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.2.05', 'Pendapatan Jasa Mesin Lami   Spot', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.5', 'Retur ', 2, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.5.01', 'Retur Penjualan', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('4.5.02', 'Diskon Penjualan', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5', 'Harga Pokok Penjualan', 1, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.1', 'Harga Pokok Penjualan Indoor', 2, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.1.01', 'HPP Indoor - Bahan Kertas', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.1.02', 'HPP Indoor - CTP', 3, 4, '2013-10-17', 'Salesman', '2013-10-13', 0, '', 0),
('5.1.03', 'HPP Indoor - Ongkos Cetak', 3, 4, '2013-10-17', 'Salesman', '2013-10-13', 0, '', 0),
('5.1.04', 'HPP Indoor - Finishing', 3, 4, '2013-10-17', 'Salesman', '2013-10-17', 0, '', 0),
('5.2', 'Harga Pokok Penjualan Jasa', 2, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.2.01', 'HPP Jasa - Gaji Tenaga Kerja', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.2.02', 'HPP Jasa - Uang Makan TK', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.2.03', 'HPP Jasa - Lembur TK', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.2.04', 'HPP Jasa : Bahan Produksi', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.2.05', 'HPP Jasa - Listrik', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.2.06', 'HPP Jasa - Perbaikan Mesin', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('5.2.07', 'HPP Jasa - Penyusutan Mesin', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6', 'Biaya Operasional', 1, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.1', 'Biaya Penjualan', 2, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.1.01', 'Biaya Gaji Marketing', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.1.02', 'Biaya Komisi Marketing', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.1.03', 'Biaya Pengiriman Barang', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.1.04', 'Biaya Iklan', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.1.05', 'Biaya Entertaint', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2', 'Biaya Umum ', 2, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.01', 'Biaya Gaji Adm', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.02', 'Biaya Uang Makan ', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.03', 'Biaya Telepon', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.04', 'Biaya Alat Tulis', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.05', 'Biaya Kebersihan dan Keamanan', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.06', 'Biaya Air Minum', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.07', 'Biaya Asuransi', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.08', 'Biaya Pajak', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.09', 'Biaya Keperluan Kantor', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.10', 'Biaya Pengobatan ', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.11', 'Biaya Perbaikan Kendaraan', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.12', 'Biaya Perbaikan Inventaris', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.13', 'Biaya Penyusutan Inventaris', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.14', 'Biaya Penyusutan Kendaraan', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.15', 'Biaya Perijinan', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.16', 'Biaya Pajak', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.17', 'Biaya ..................', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.2.40', 'Biaya Umum Lain-Lain', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.3', 'Biaya Keuangan', 2, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.3.01', 'Biaya Adm. Bank', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.3.02', 'Biaya Provisi Bank', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('6.3.03', 'Biaya Bunga', 3, 4, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('7', 'Pendapatan Diluar Usaha', 1, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('7.1', 'Pendapatan Diluar Usaha', 2, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('7.1.01', 'Pendapatan Bunga Bank', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('7.1.59', 'Pendapatan Lain-Lain', 3, 3, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('9', 'Ayat Silang', 1, 6, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('9.9', 'Ayat Silang', 2, 6, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0),
('9.9.99', 'Ayat Silang', 3, 6, '2013-10-13', 'Salesman', '2013-10-13', 0, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
