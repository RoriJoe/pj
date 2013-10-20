-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2013 at 05:43 PM
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
-- Table structure for table `bank_d`
--

CREATE TABLE IF NOT EXISTS `bank_d` (
  `kode` int(5) NOT NULL AUTO_INCREMENT,
  `kode_bank` char(5) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `tipe` varchar(25) NOT NULL,
  `cabang` varchar(25) NOT NULL,
  `no_perkiraan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `bank_d`
--

INSERT INTO `bank_d` (`kode`, `kode_bank`, `no_rekening`, `atas_nama`, `tipe`, `cabang`, `no_perkiraan`) VALUES
(13, '101', '725852825', 'Panda', 'Tabungan', 'Gunung Salak', '25855222');

-- --------------------------------------------------------

--
-- Table structure for table `bank_h`
--

CREATE TABLE IF NOT EXISTS `bank_h` (
  `kode_bank` char(5) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `dibuat_oleh` varchar(50) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `diupdate_oleh` varchar(50) NOT NULL,
  `tanggal_update` datetime NOT NULL,
  PRIMARY KEY (`kode_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_h`
--

INSERT INTO `bank_h` (`kode_bank`, `nama_bank`, `alamat`, `dibuat_oleh`, `tanggal_buat`, `diupdate_oleh`, `tanggal_update`) VALUES
('101', 'CIMB', 'Jl. Sudirman', 'eddy', '2013-10-18 21:29:21', 'eddy', '2013-10-18 21:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `Kode` varchar(22) NOT NULL,
  `Ukuran` varchar(50) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Nama2` varchar(20) NOT NULL,
  `Satuan1` varchar(6) NOT NULL,
  `Qty1` float(11,0) DEFAULT NULL,
  `QtyGudang` int(11) DEFAULT NULL,
  `Tgl_Saw` date DEFAULT NULL,
  `Saw` int(11) DEFAULT NULL,
  `SawGudang` int(11) DEFAULT NULL,
  PRIMARY KEY (`Kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`Kode`, `Ukuran`, `Nama`, `Nama2`, `Satuan1`, `Qty1`, `QtyGudang`, `Tgl_Saw`, `Saw`, `SawGudang`) VALUES
('B1307001', '200x52', 'Pipa L', 'PL22', 'Batang', 5, NULL, NULL, NULL, NULL),
('B1307002', '22x20', 'Plat', 'P22', 'Lembar', 0, NULL, NULL, NULL, NULL),
('B1307003', '25x25x25', 'Plat Segi Tiga', 'PST2', 'Meter', 55, NULL, NULL, NULL, NULL),
('B1307004', '15x12', 'Pipa Silinder X', 'PS15', 'Meter', 15, NULL, NULL, NULL, NULL),
('B1307005', '200 x 500', 'Besi Super', 'BS25', 'Roll', 25, NULL, NULL, NULL, NULL),
('B1307006', '400x500', 'Pipa Besi 3', 'Tes Data', 'Batang', 5235, NULL, NULL, NULL, NULL),
('B1309001', '5 x 12', 'Beton Ulir', '18-KS', 'Inci', 0, NULL, NULL, NULL, NULL),
('B1309002', '13 x 5', 'Besi 1', '18-KS', 'Cm', 0, NULL, NULL, NULL, NULL),
('B1309003', '2 x 2 x 3', 'Besi 2', '2KS', 'Inci', 0, NULL, NULL, NULL, NULL),
('B1309004', '3 X 3 X 6', 'Besi 3', '3KS', 'Meter', 0, NULL, NULL, NULL, NULL),
('B1309005', '4 X 4L', 'Besi 4', '4BS', 'Cm', 0, NULL, NULL, NULL, NULL),
('B1309006', '5 X 5 ', 'Besi 5x', '5BS', 'Inci', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bpb_d`
--

CREATE TABLE IF NOT EXISTS `bpb_d` (
  `No_Bpb` varchar(25) NOT NULL,
  `Kode_brg` varchar(22) NOT NULL,
  `Qty1` int(11) NOT NULL,
  `Keterangan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bpb_d`
--

INSERT INTO `bpb_d` (`No_Bpb`, `Kode_brg`, `Qty1`, `Keterangan`) VALUES
('BPB1309001', 'B1307001', 10, ''),
('BPB1309002', 'B1307002', 5, 'tes'),
('BPB1309003', 'B1307001', 1, '11'),
('BPB1309004', 'B1307001', 46, 'twffwaf'),
('BPB1309004', 'B1307003', 15, 'Tes 2');

-- --------------------------------------------------------

--
-- Table structure for table `bpb_h`
--

CREATE TABLE IF NOT EXISTS `bpb_h` (
  `No_Bpb` varchar(25) NOT NULL,
  `Tgl_Bpb` date NOT NULL,
  `No_Reff` varchar(25) NOT NULL,
  `Kode_Supp` varchar(25) NOT NULL,
  `Kode_Gudang` varchar(25) NOT NULL,
  PRIMARY KEY (`No_Bpb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bpb_h`
--

INSERT INTO `bpb_h` (`No_Bpb`, `Tgl_Bpb`, `No_Reff`, `Kode_Supp`, `Kode_Gudang`) VALUES
('BPB1309001', '2013-07-01', '0001097776', 'S1307001', 'G1307002'),
('BPB1309002', '2013-07-02', '0002758', 'S1307002', 'G1307001'),
('BPB1309003', '2013-09-20', '35353456345', 'S1307002', 'G1307001'),
('BPB1309004', '2013-09-13', '6464565464', 'S1307001', 'G1307001');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`value`) VALUES
('Rupiah'),
('Dollar'),
('Yen'),
('Peso'),
('Gira');

-- --------------------------------------------------------

--
-- Table structure for table `do_d`
--

CREATE TABLE IF NOT EXISTS `do_d` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `No_Do` varchar(20) NOT NULL,
  `Kode_Brg` varchar(22) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Status` varchar(1) NOT NULL,
  `Keterangan` varchar(30) NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `do_h`
--

CREATE TABLE IF NOT EXISTS `do_h` (
  `No_Do` varchar(10) NOT NULL,
  `Tgl` date NOT NULL,
  `No_Po` varchar(25) DEFAULT NULL,
  `Tgl_Po` date DEFAULT NULL,
  `Kode_Plg` varchar(10) NOT NULL,
  `Kode_Gudang` varchar(10) NOT NULL,
  `Kirim` varchar(1) DEFAULT NULL,
  `Otorisasi` varchar(30) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  PRIMARY KEY (`No_Do`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE IF NOT EXISTS `gudang` (
  `Kode` varchar(22) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Alamat` varchar(30) NOT NULL,
  `Alamat2` varchar(30) DEFAULT NULL,
  `Kota` varchar(15) NOT NULL,
  `Telp` varchar(15) NOT NULL,
  `Milik_Sendiri` varchar(1) DEFAULT NULL,
  `Telp1` varchar(15) DEFAULT NULL,
  `Fax` varchar(15) NOT NULL,
  `Fax1` varchar(15) DEFAULT NULL,
  `Contac1` varchar(25) DEFAULT NULL,
  `Contac2` varchar(15) DEFAULT NULL,
  `Title1` varchar(4) DEFAULT NULL,
  `Title2` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`Kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`Kode`, `Nama`, `Alamat`, `Alamat2`, `Kota`, `Telp`, `Milik_Sendiri`, `Telp1`, `Fax`, `Fax1`, `Contac1`, `Contac2`, `Title1`, `Title2`) VALUES
('G1307001', 'Special Warehouse', 'Jl.Semesta Alam 3', NULL, 'Jakarta', '08524795555', NULL, '08125852555', '012-345', '067-890', NULL, NULL, NULL, NULL),
('G1307002', 'Gudang Murni', 'Jl.Semesta', NULL, 'Jakarta', '0123456789', NULL, '', '0551 2575', '', NULL, NULL, NULL, NULL),
('G1309001', 'Gudang Satu', 'Jl. Satu', NULL, 'Satu', '085247956204', NULL, '575475675675', '085247956204', '085247956204', NULL, NULL, NULL, NULL),
('G1309002', 'Gudag Dua', 'Jl. Belok Dua', NULL, 'Jakarta', '02547778522', NULL, '', '155288254', '', NULL, NULL, NULL, NULL),
('G1309003', 'Gudang Tiga', 'Jl. Sepon', NULL, 'Sepon', '456123789', NULL, '', '456123789', '', NULL, NULL, NULL, NULL),
('G1309004', 'Gudang Empat', 'Jl. Empat', NULL, 'Empat', '1234555', NULL, '', '1234444', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `Kode` varchar(8) NOT NULL,
  `Kode_SO` varchar(10) NOT NULL,
  `Term` int(11) NOT NULL,
  `Tgl` date NOT NULL,
  `Status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Kode`, `Kode_SO`, `Term`, `Tgl`, `Status`) VALUES
('1310001', 'SO1309003', 5, '2013-10-12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `muser`
--

CREATE TABLE IF NOT EXISTS `muser` (
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Level` int(11) NOT NULL,
  `Last_Login` timestamp NULL DEFAULT NULL,
  `image` varchar(100) DEFAULT 'user.png',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `muser`
--

INSERT INTO `muser` (`username`, `password`, `Nama`, `Level`, `Last_Login`, `image`) VALUES
('ada', '56d43845311fa224342668fc2c72fd97', 'ada', 1, '2013-10-19 23:02:00', 'ada.png'),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 1, '2013-10-19 23:02:00', 'user.png'),
('eddy', '5aa8fed9741d33c63868a87f1af05ab7', 'eddy', 2, '2013-10-19 23:02:00', 'eddy.jpg'),
('sip', '06b15d3af713e318d123274a98d70bc9', 'Sip', 1, '2013-10-19 23:02:00', 'sip.png');

-- --------------------------------------------------------

--
-- Table structure for table `os`
--

CREATE TABLE IF NOT EXISTS `os` (
  `No_Do` varchar(7) NOT NULL,
  `Kode_Brg` varchar(22) NOT NULL,
  `QtyDo` decimal(10,0) NOT NULL,
  `QtySj` decimal(10,0) NOT NULL,
  `Habis` varchar(1) NOT NULL,
  PRIMARY KEY (`No_Do`,`Kode_Brg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `Kode` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Nama1` varchar(30) DEFAULT NULL,
  `Perusahaan` varchar(50) NOT NULL,
  `Alamat1` varchar(40) NOT NULL,
  `Alamat2` varchar(40) DEFAULT NULL,
  `Kota` varchar(15) NOT NULL,
  `KodeP` varchar(5) NOT NULL,
  `Telp` varchar(20) NOT NULL,
  `Telp1` varchar(20) DEFAULT NULL,
  `Telp2` varchar(20) DEFAULT NULL,
  `Fax1` varchar(20) NOT NULL,
  `Fax2` varchar(20) DEFAULT NULL,
  `Limit` decimal(10,0) DEFAULT NULL,
  `Piutang` decimal(10,0) DEFAULT NULL,
  `NPWP` varchar(25) NOT NULL,
  `Lama` int(11) DEFAULT NULL,
  PRIMARY KEY (`Kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`Kode`, `Nama`, `Nama1`, `Perusahaan`, `Alamat1`, `Alamat2`, `Kota`, `KodeP`, `Telp`, `Telp1`, `Telp2`, `Fax1`, `Fax2`, `Limit`, `Piutang`, `NPWP`, `Lama`) VALUES
('P1307001', 'Tony', NULL, 'Stark', 'Jl. Alabama', NULL, 'Bekasi', '11475', '085247447', '0854444458', '-', '0551-8558', '-', NULL, NULL, '258 2587 57771', NULL),
('P1307002', 'Agung', NULL, 'Sentosa', 'Jl. Merdeka', NULL, 'Tanggerang', '11758', '085552475', '-', '-', '0221-25475', '', NULL, NULL, '7878 47125 58815', NULL),
('P1307003', 'aggagwgw', NULL, 'OK JAJA PT.', 'hesh', NULL, 'hesh', 'seh', '535253', '', '', '123456', '', NULL, NULL, '6346464326', NULL),
('P1307004', 'tes', NULL, ' SEMPURNA PT.', 'tes', NULL, 'test', 'est', 'tes', '', '', 'tes', '', NULL, NULL, 'tes', NULL),
('P1307005', 'test', NULL, 'OKJAYA PT.', 'ets', NULL, 't', 'tes', 'te', '', '', 'tes', '', NULL, NULL, 'teds', NULL),
('P1307006', 'etws', NULL, 'SENTOSOS PT.', 'fgeg', NULL, 'geg', 'gwe', 'fgw', '', '', 'gfewg', '', NULL, NULL, 'bgegb', NULL),
('P1307007', 'Soedirman', NULL, 'MERDEKA PT.', 'Jl. Pondok Indah', NULL, 'Jakarta', '11525', '0852478566', '', '', '055248885', '', NULL, NULL, '52225774441', NULL),
('P1307008', 'Tesla', NULL, 'Tesla Power', 'Jl. tesla', NULL, 'tes', '35555', '356346', '', '', '123456', '', NULL, NULL, '346346346', NULL),
('P1307009', 'Bung Tomo', NULL, ' Bersatu Maju PT.', 'gsegseg', NULL, 'Bandung', '46333', '521353252', '', '', '634634', '', NULL, NULL, '35325', NULL),
('P1309001', 'Ogindo', NULL, 'OGINDO PRAKARSATAMA PT.', 'Jl. Ogindo', NULL, 'Bekasi', '13578', '0852479552', '6285788555822', '', '02215877', '', NULL, NULL, '487995577758852', NULL),
('P1309002', 'Kim Jong Kook', NULL, 'ABADI BARU YES', 'Jl. Gangnam No.35', NULL, 'Bekasi', '15400', '021-528444485', '', '', '021788588', '', NULL, NULL, '777858442000457', NULL),
('P1309003', 'Sidoel Ha', NULL, 'SIDO TENGGELAM', 'Jl. Pajajaran', NULL, 'Bunyu', '11710', '258552282', '52588475552', '55847852566', '258547', '24470444', NULL, NULL, '4356463646463', NULL),
('P1309004', 'Yoo Jaes', NULL, ' RUNNING PT.', 'Jl. Sudirman', NULL, 'Tarakan', '11510', '1234567890', '', '', '123456789', '', NULL, NULL, '123456782', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `po_d`
--

CREATE TABLE IF NOT EXISTS `po_d` (
  `Kode_po` varchar(25) NOT NULL,
  `Kode_barang` varchar(25) NOT NULL,
  `Harga` decimal(10,0) DEFAULT NULL,
  `Jumlah` int(11) NOT NULL,
  `Nilai` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_d`
--

INSERT INTO `po_d` (`Kode_po`, `Kode_barang`, `Harga`, `Jumlah`, `Nilai`) VALUES
('PO1309001', 'B1307006', '5000', 10, '50000'),
('PO1309002', 'B1307004', '2000', 1, '2000'),
('PO1309002', 'B1307005', '10000', 2, '20000'),
('PO1309003', 'B1307001', '1000', 2, '2000'),
('PO1309004', 'B1307001', '100', 1, '100'),
('PO1309004', '', '0', 0, '0'),
('PO1309005', 'B1307001', '1000', 2, '2000'),
('PO1309005', 'B1307003', '2000', 2, '4000'),
('PO1309006', 'B1307001', '209000', 1, '209000'),
('PO1309006', 'B1307002', '25000', 20, '500000'),
('PO1309006', 'B1307003', '20000000', 30, '600000000'),
('PO1309007', 'B1307001', '19999', 2, '39998');

-- --------------------------------------------------------

--
-- Table structure for table `po_h`
--

CREATE TABLE IF NOT EXISTS `po_h` (
  `Kode` varchar(25) NOT NULL,
  `Tgl_po` date NOT NULL,
  `Tgl_kirim` date NOT NULL,
  `Permintaan` varchar(30) DEFAULT NULL,
  `Currency` varchar(10) NOT NULL,
  `Urgent` varchar(5) NOT NULL,
  `Kode_supplier` varchar(20) NOT NULL,
  `Kode_gudang` varchar(20) DEFAULT NULL,
  `Nama_proyek` varchar(50) DEFAULT NULL,
  `DPP` decimal(11,0) DEFAULT NULL,
  `PPN` int(11) DEFAULT NULL,
  `Total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_h`
--

INSERT INTO `po_h` (`Kode`, `Tgl_po`, `Tgl_kirim`, `Permintaan`, `Currency`, `Urgent`, `Kode_supplier`, `Kode_gudang`, `Nama_proyek`, `DPP`, `PPN`, `Total`) VALUES
('PO1309001', '2013-09-25', '2013-09-27', NULL, 'Rupiah', 'Ya', 'S1307003', 'G1307002', NULL, '100000', 0, '100000'),
('PO1309002', '2013-09-20', '2013-09-25', 'Tidak Ada', 'Rupiah', 'Ya', 'S1307002', 'G1307001', '', '22000', 2, '22040'),
('PO1309003', '2013-09-20', '2013-09-22', 'Tidak Ada', 'Rupiah', 'Ya', 'S1307001', 'G1307001', '', '2000', 5, '2100'),
('PO1309004', '2013-09-11', '2013-09-24', 'Tidak Ada', 'Rupiah', 'Tidak', 'S1307001', 'G1307001', '', '100', 0, '100'),
('PO1309005', '2013-09-12', '2013-09-27', 'Tidak Ada', 'Dollar', 'Ya', 'S1309001', 'G1309003', '', '6000', 4, '6240'),
('PO1309006', '2013-10-01', '2013-10-18', 'Tidak Ada', 'Rupiah', 'Tidak', 'S1309001', 'G1309003', '', '600709000', 5, '9999999999'),
('PO1309007', '2013-10-09', '2013-10-18', 'Tidak Ada', 'Rupiah', 'Ya', 'S1309001', '', 'aaaaa', '39998', 35, '3999813999');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE IF NOT EXISTS `satuan` (
  `Value` varchar(10) NOT NULL,
  PRIMARY KEY (`Value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`Value`) VALUES
('Batang'),
('Cm'),
('Inci'),
('Kg'),
('Lembar'),
('Meter'),
('Roll');

-- --------------------------------------------------------

--
-- Table structure for table `saw_d`
--

CREATE TABLE IF NOT EXISTS `saw_d` (
  `No_Saw` varchar(7) NOT NULL,
  `Kd_Brg` varchar(22) NOT NULL,
  `QtySaw1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_d`
--

INSERT INTO `saw_d` (`No_Saw`, `Kd_Brg`, `QtySaw1`) VALUES
('0504013', 'B1309006', 5),
('0504014', 'B1309002', 40),
('0504013', 'B1309004', 20),
('0504014', 'B1309005', 10),
('1309001', 'B1307003', 12),
('1309001', 'B1307005', 13),
('1309001', 'B1307006', 15),
('1309001', 'B1309004', 13),
('1309002', 'B1307001', 15),
('1309002', 'B1307003', 16);

-- --------------------------------------------------------

--
-- Table structure for table `saw_h`
--

CREATE TABLE IF NOT EXISTS `saw_h` (
  `No_Saw` varchar(7) NOT NULL,
  `Tgl` date NOT NULL,
  `Kd_Gudang` varchar(22) NOT NULL,
  PRIMARY KEY (`No_Saw`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_h`
--

INSERT INTO `saw_h` (`No_Saw`, `Tgl`, `Kd_Gudang`) VALUES
('0504013', '2013-10-23', 'G1307001'),
('0504014', '2013-10-25', 'G1307001'),
('1309001', '2013-10-24', 'G1309001'),
('1309002', '2013-10-25', 'G1309001');

-- --------------------------------------------------------

--
-- Table structure for table `sj_d`
--

CREATE TABLE IF NOT EXISTS `sj_d` (
  `No_Sj` varchar(7) NOT NULL,
  `Kode_Brg` varchar(22) NOT NULL,
  `Barang` varchar(50) NOT NULL,
  `Barang_SJ` varchar(50) DEFAULT NULL,
  `Qty1` int(11) NOT NULL,
  `Status` varchar(1) NOT NULL,
  `Keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_d`
--

INSERT INTO `sj_d` (`No_Sj`, `Kode_Brg`, `Barang`, `Barang_SJ`, `Qty1`, `Status`, `Keterangan`) VALUES
('130701', 'B1307003', 'Plat Segi Tiga 25x25x25', 'Plat Segi Tiga', 0, '', 'tesx'),
('130701', 'B1307005', 'Besi Super 200 x 500', 'Pipa Silinder', 0, '', 'ubah data'),
('1307001', 'B1307005', 'Besi Super 200 x 500', 'Pipa L', 10, '', 'Ubah dari b1 ke b5'),
('1307001', 'B1307002', 'Plat 22x20', 'Plat', 5, '', 'tes2'),
('1307001', 'B1307003', 'Plat Segi Tiga 25x25x25', 'Plat Segi Tiga', 7, '', 'tes3'),
('1309001', 'B1307006', 'Pipa Besi 3 400x500', 'Pipa L', 10, '', 'Tes#1'),
('1309001', 'B1307004', 'Pipa Silinder X 15x12', 'Pipa Silinder X', 5, '', 'Test#2');

-- --------------------------------------------------------

--
-- Table structure for table `sj_h`
--

CREATE TABLE IF NOT EXISTS `sj_h` (
  `No_Sj` varchar(7) NOT NULL,
  `Tgl` date NOT NULL,
  `No_Do` varchar(20) NOT NULL,
  `No_Po` varchar(25) NOT NULL,
  `No_Mobil` varchar(10) NOT NULL,
  `Kode_Plg` varchar(20) NOT NULL,
  `Kode_Gudang` varchar(20) NOT NULL,
  `Kirim` varchar(1) DEFAULT NULL,
  `Keterangan` varchar(20) NOT NULL,
  PRIMARY KEY (`No_Sj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sj_h`
--

INSERT INTO `sj_h` (`No_Sj`, `Tgl`, `No_Do`, `No_Po`, `No_Mobil`, `Kode_Plg`, `Kode_Gudang`, `Kirim`, `Keterangan`) VALUES
('1307001', '2013-07-19', 'SO1307001', 'PO12345', 'L 9359 K', 'P1307003', 'G1307001', NULL, 'Pelita'),
('1309001', '2013-10-18', 'SO1309003', 'PO1309002', 'M 0293 K', 'P1307005', 'G1309004', NULL, 'Ambil Sendiri');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `Kode` varchar(22) NOT NULL,
  `Kode_Gudang` varchar(5) NOT NULL,
  `Qty_1` decimal(10,0) NOT NULL,
  `QtyGudang` decimal(10,0) NOT NULL,
  `Tgl_Saw` date NOT NULL,
  `Saw` decimal(10,0) NOT NULL,
  `Terima` decimal(10,0) NOT NULL,
  `Ke_Do` decimal(10,0) NOT NULL,
  `Ke_Sj` decimal(10,0) NOT NULL,
  `Ke_Bpb` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Kode`,`Kode_Gudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `Kode` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Nama1` varchar(30) DEFAULT NULL,
  `Perusahaan` varchar(50) NOT NULL,
  `Alamat1` varchar(30) NOT NULL,
  `Alamat2` varchar(30) DEFAULT NULL,
  `Kota` varchar(15) NOT NULL,
  `Telp` varchar(20) NOT NULL,
  `Telp1` varchar(20) NOT NULL,
  `Telp2` varchar(20) DEFAULT NULL,
  `Fax1` varchar(20) NOT NULL,
  `Fax2` varchar(20) DEFAULT NULL,
  `Limit_Kredit` int(11) NOT NULL,
  PRIMARY KEY (`Kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Kode`, `Nama`, `Nama1`, `Perusahaan`, `Alamat1`, `Alamat2`, `Kota`, `Telp`, `Telp1`, `Telp2`, `Fax1`, `Fax2`, `Limit_Kredit`) VALUES
('S1307001', 'Tony Stark', NULL, 'Stark Company', 'Jl. Alabama', NULL, 'Tangerang', '085247956204', '', '', '0221 25884', '', 100000000),
('S1307002', 'Cockie', NULL, 'Hammer PT.', 'Jl. Kelma', NULL, 'Bandung', '08522257', '', '', '08547782', '', 0),
('S1307003', 'Arifin', NULL, 'Olala PT.', 'Gedung Energy', NULL, 'Jakarta', '3523362366', '', '', '0552 478855', '', 25000),
('S1309001', 'AFRO', NULL, 'AFRO PACIFIC INDAH STEEL', 'P.Jayakarta No.35', NULL, 'Jakarta', '628 6885 5524', '', '', '02158887', '', 6588558),
('S1309002', 'Ha Dong Hoon', NULL, ' HAHA PT.', 'Jl. Gangnam', NULL, 'Seoul', '0852577752', '', '', '021587745', '', 20000),
('S1309003', 'Turan Boss', NULL, ' TURBO CV.', 'Jl. Speeds', NULL, 'Sebatik', '789456123', '', '', '789456123', '', 20000),
('S1309004', 'Grahams', NULL, 'Graham Bell CV.', 'Jl. Liku', NULL, 'Leavis', '12345679', '', '', '123456', '', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_rekening`
--

CREATE TABLE IF NOT EXISTS `tipe_rekening` (
  `No` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tipe_rekening`
--

INSERT INTO `tipe_rekening` (`No`, `value`) VALUES
(1, 'Tabungan'),
(2, 'Giro'),
(9, 'LOL');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
