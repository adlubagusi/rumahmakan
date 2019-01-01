-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2017 at 10:08 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbresto2`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kd_kategori` char(3) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K01', 'Sambal'),
('K02', 'Lauk'),
('K03', 'Sayur'),
('K04', 'Minuman'),
('K05', 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `kd_menu` char(5) NOT NULL,
  `nm_menu` varchar(100) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `kd_kategori` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`kd_menu`, `nm_menu`, `harga`, `kd_kategori`) VALUES
('M0001', 'Sambal Trasi Lombok Ijo', '1500', 'K01'),
('M0002', 'Sambal Bawang', '1500', 'K01'),
('M0003', 'Bawang Lombok Ijo', '1500', 'K01'),
('M0004', 'Sambal Tempe', '2000', 'K01'),
('M0005', 'Sambal Tahu', '2000', 'K01'),
('M0006', 'Sambal Terasi Segar', '2000', 'K01'),
('M0007', 'Sambal Terasi Matang', '2000', 'K01'),
('M0008', 'Terasi Tomat Segar', '2000', 'K01'),
('M0009', 'Sambal bawang goreng', '2000', 'K01'),
('M0010', 'Sambal bawang tomat', '2000', 'K01'),
('M0011', 'Sambal Kecap', '2000', 'K01'),
('M0012', 'Sambal Rampelo Ati', '3500', 'K01'),
('M0013', 'Sambal Teri', '3500', 'K01'),
('M0014', 'Sambal Wader', '3500', 'K01'),
('M0015', 'Sambal Belut', '4000', 'K01'),
('M0016', 'Sambal Terong', '4000', 'K01'),
('M0017', 'Sambal Jamur', '4000', 'K01'),
('M0018', 'Sambal Cumi', '5000', 'K01'),
('M0019', 'Sambal Paru', '5500', 'K01'),
('M0020', 'Sambal Udang Pedas', '6000', 'K01'),
('M0021', 'Wadar Goreng', '7000', 'K02'),
('M0022', 'Belut Goreng', '7500', 'K02'),
('M0023', 'Ayam Goreng Paha', '10000', 'K02'),
('M0024', 'Ayam Goreng Dada', '11000', 'K02'),
('M0025', 'Sapi Goreng', '10000', 'K02'),
('M0026', 'Babat Goreng', '9000', 'K02'),
('M0027', 'Iso Goreng', '9000', 'K02'),
('M0028', 'Telor Dadar Biasa', '4000', 'K02'),
('M0029', 'Telor Ceplok', '4000', 'K02'),
('M0030', 'Tahu Goreng', '3500', 'K02'),
('M0031', 'Tempe Goreng', '3500', 'K02'),
('M0032', 'Rampelo Ati Goreng', '5000', 'K02'),
('M0033', 'Bandeng Goreng', '6000', 'K02'),
('M0034', 'Bawal', '7500', 'K02'),
('M0035', 'Lele Goreng', '7500', 'K02'),
('M0036', 'Nila', '7500', 'K02'),
('M0037', 'Udang goreng tepung ', '9000', 'K02'),
('M0038', 'Cumi goreng tepung', '9000', 'K02'),
('M0039', 'Jamur Goreng', '4000', 'K02'),
('M0040', 'Gareh Keranjang', '6000', 'K02'),
('M0041', 'Lalapan', '2000', 'K03'),
('M0042', 'Terong Goreng', '3000', 'K03'),
('M0043', 'Pecel', '3500', 'K03'),
('M0044', 'Plencing Jawa', '3500', 'K03'),
('M0045', 'Sayur Asam', '3500', 'K03'),
('M0046', 'Gudangan', '3500', 'K03'),
('M0047', 'Pete Goreng', '4000', 'K03'),
('M0048', 'Karedok', '4000', 'K03'),
('M0049', 'Ca Kangkung', '4500', 'K03'),
('M0050', 'Air Es', '1000', 'K04'),
('M0051', 'Teh (Es/Panas)', '2500', 'K04'),
('M0052', 'Jeruk (Es/Panas)', '3000', 'K04'),
('M0053', 'Coffee Mix (Es/Panas)', '3000', 'K04'),
('M0054', 'Cokelat (Es/Panas)', '3000', 'K04'),
('M0055', 'Juice Semangka', '5000', 'K04'),
('M0056', 'Juice Sawo', '5000', 'K04'),
('M0057', 'Juice Tomat', '5000', 'K04'),
('M0058', 'Juice Nanas', '5000', 'K04'),
('M0059', 'Juice Wortel', '5000', 'K04'),
('M0060', 'Juice Melon', '5000', 'K04'),
('M0061', 'Juice Jambu', '6000', 'K04'),
('M0062', 'Juice Tomat Susu', '6000', 'K04'),
('M0063', 'Juice Jeruk', '6000', 'K04'),
('M0064', 'Juice Apel', '6000', 'K04'),
('M0065', 'Juice Strawberry', '6000', 'K04'),
('M0066', 'Juice Mangga', '7000', 'K04'),
('M0067', 'Juice Alpokat', '8000', 'K04'),
('M0068', 'Juice Sirsak Bulan', '8000', 'K04'),
('M0069', 'Jeruk Nipis  (Es/Panas)', '6000', 'K04'),
('M0070', 'Susu Cokelat (Es/Panas)', '6000', 'K04'),
('M0071', 'Lemon Tea (Es/Panas)', '5000', 'K04'),
('M0072', 'Nasi Putih (per Orang)', '2000', 'K05'),
('M0073', 'Nasi Putih (per Bakul)', '12000', 'K05'),
('M0074', 'Nasi Goreng', '8000', 'K05');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `no_pembelian` char(7) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `kd_supplier` char(3) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `kd_user` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_pembelian`, `tgl_pembelian`, `kd_supplier`, `keterangan`, `kd_user`) VALUES
('BL00001', '2013-02-20', 'S01', 'belanja', 'U01'),
('BL00002', '2013-02-20', 'S01', 'Belanja', 'U01'),
('BL00003', '2013-02-22', 'S02', 'belanja', 'U01'),
('BL00004', '2013-02-23', 'S02', 'Belanja bahan mentah', 'U01'),
('BL00005', '2017-07-18', 'S03', '-', 'U01'),
('BL00006', '2017-07-18', 'S01', '-', 'U01'),
('BL00007', '2017-07-18', 'S03', '-', 'U01'),
('BL00008', '2017-07-18', 'S01', '-', 'U01'),
('BL00009', '2017-08-06', 'S01', 'tambahan minyak goreng', 'U01');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_item`
--

CREATE TABLE `pembelian_item` (
  `no_pembelian` char(7) NOT NULL,
  `item_barang` varchar(100) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_item`
--

INSERT INTO `pembelian_item` (`no_pembelian`, `item_barang`, `harga`, `jumlah`, `satuan`) VALUES
('BL00001', 'Cabe Merah Keriting (kiloan)', 25000, 10, 'Kg'),
('BL00001', 'Es Polar', 15000, 1, 'Bungkus'),
('BL00002', 'Air Mineral (AQUA) - Gelas', 23000, 5, 'Dus'),
('BL00002', 'Air Mineral (AQUA) Galon ', 14000, 1, 'Galon'),
('BL00002', 'Beras Rojolele', 7000, 5, 'Kg'),
('BL00003', 'Belut', 22000, 3, 'Kg'),
('BL00003', 'Cumi', 45000, 1, 'Kg'),
('BL00003', 'Ikan Gurameh', 30000, 2, 'Kg'),
('BL00003', 'Jamur', 12000, 4, 'Bungkus'),
('BL00003', 'Kecap', 9000, 2, 'Botol'),
('BL00003', 'Paru', 10000, 3, 'Bungkus'),
('BL00003', 'Rampelo Ati', 10000, 3, 'Bungkus'),
('BL00003', 'Tahu', 75000, 6, 'Bungkus'),
('BL00003', 'Tempe', 3500, 10, 'Bungkus'),
('BL00003', 'Terasi ', 2500, 5, 'Bungkus'),
('BL00003', 'Teri', 8000, 3, 'Kg'),
('BL00003', 'Terong', 2500, 5, 'Kg'),
('BL00004', 'Ayam Dada', 13000, 5, 'Bungkus'),
('BL00004', 'Ayam Paha', 12000, 5, 'Bungkus'),
('BL00004', 'Bandeng ', 17000, 5, 'Kg'),
('BL00004', 'Bawal', 14000, 6, 'Kg'),
('BL00004', 'Belut', 23000, 5, 'Kg'),
('BL00004', 'Terong', 3000, 5, 'Kg'),
('BL00004', 'Tomat', 7000, 1, 'Kg'),
('BL00004', 'Udang ', 27000, 5, 'Bungkus'),
('BL00004', 'Wader', 26000, 5, 'Bungkus'),
('BL00005', 'telur bebek', 20000, 2, 'Kg'),
('BL00006', 'kubis', 3000, 5, 'Kg'),
('BL00006', 'cabai', 40000, 4, 'Kg'),
('BL00007', 'telur ayam', 5000, 4, 'Kg'),
('BL00007', 'telur bebek', 40000, 3, 'Kg'),
('BL00008', 'sirup', 17000, 5, 'Botol'),
('BL00009', 'minyak goreng', 10000, 1, 'Botol');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(40) NOT NULL,
  `nomor_meja` varchar(40) NOT NULL,
  `jumlah_orang` varchar(40) NOT NULL,
  `nama_pemesan` varchar(60) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `tanggal`, `jam`, `nomor_meja`, `jumlah_orang`, `nama_pemesan`, `no_telepon`, `keterangan`) VALUES
(1, '2017-07-22', '12.00', '1-2', '8', 'indra', '08218732', '-');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` char(7) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `nomor_meja` varchar(40) NOT NULL,
  `pelanggan` varchar(60) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `uang_bayar` int(12) NOT NULL,
  `kd_user` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `tgl_penjualan`, `nomor_meja`, `pelanggan`, `keterangan`, `uang_bayar`, `kd_user`) VALUES
('JL00001', '2013-02-19', '1', 'Pelanggan', '', 10000, 'U01'),
('JL00002', '2013-02-20', '1', 'Pelanggan', '', 20000, 'U01'),
('JL00003', '2013-02-22', '1', 'Pelanggan', 'Sarapan', 50000, 'U01'),
('JL00004', '2013-02-22', '2', 'Pelanggan', 'sarapan 2 orang', 50000, 'U01'),
('JL00005', '2013-02-22', '3', 'Pelanggan', '1 orang', 10000, 'U01'),
('JL00006', '2013-02-22', '5', 'Pelanggan', 'sarapan', 10000, 'U01'),
('JL00007', '2013-02-23', '1', 'Septi Suhesti', 'Sarapan Keluarga', 50000, 'U01'),
('JL00008', '2013-02-23', '2', 'Pelanggan', 'sarapan', 25000, 'U01'),
('JL00009', '2013-02-23', '1', 'Pelanggan', '', 10000, 'U01'),
('JL00010', '2013-02-23', '1', 'Pelanggan', '', 12000, 'U01'),
('JL00011', '2013-02-23', '1', 'Pelanggan', '', 15000, 'U01'),
('JL00012', '2013-02-23', '1', 'Pelanggan', '', 12000, 'U01'),
('JL00013', '2013-02-23', '4', 'Pelanggan', 'sarapan, 2 orang', 20000, 'U01'),
('JL00014', '2013-02-23', '4', 'Hernanto', 'Sarapan', 20000, 'U01'),
('JL00015', '2013-02-23', '1', 'Pelanggan', '', 30000, 'U01'),
('JL00016', '2013-02-23', '1', 'Pelanggan', '', 35000, 'U01'),
('JL00017', '2013-02-23', '1', 'Pelanggan', '', 25000, 'U01'),
('JL00018', '2017-07-18', '2', 'wahyudi', '-', 16000, 'U02'),
('JL00019', '2017-07-21', '4', 'hardyan', '-', 25000, 'U02'),
('JL00020', '2017-07-24', '1', 'deni', '-', 30000, 'U02'),
('JL00021', '2017-08-03', '1', 'sdasdas', '-', 10000, 'U01'),
('JL00022', '2017-08-04', '1', 'Pelanggan', '', 12000, 'U04'),
('JL00023', '2017-08-04', 'meja 4', 'agung', '-', 22000, 'U04'),
('JL00024', '2017-08-06', 'Meja 1', 'ika', '-', 40000, 'U05'),
('JL00025', '2017-08-06', 'Meja 1', 'ika', 'tambah nasi', 2000, 'U05');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_item`
--

CREATE TABLE `penjualan_item` (
  `no_penjualan` char(7) NOT NULL,
  `kd_menu` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_item`
--

INSERT INTO `penjualan_item` (`no_penjualan`, `kd_menu`, `harga`, `jumlah`) VALUES
('JL00001', 'M0001', 1500, 1),
('JL00002', 'M0002', 1500, 1),
('JL00002', 'M0015', 4000, 2),
('JL00002', 'M0072', 2000, 1),
('JL00003', 'M0015', 4000, 1),
('JL00003', 'M0028', 4000, 1),
('JL00003', 'M0052', 3000, 1),
('JL00003', 'M0072', 2000, 1),
('JL00004', 'M0029', 4000, 2),
('JL00004', 'M0046', 3500, 2),
('JL00004', 'M0053', 3000, 2),
('JL00004', 'M0073', 12000, 2),
('JL00005', 'M0030', 3500, 1),
('JL00005', 'M0041', 2000, 1),
('JL00005', 'M0050', 1000, 1),
('JL00005', 'M0072', 2000, 1),
('JL00006', 'M0017', 4000, 1),
('JL00006', 'M0051', 2500, 1),
('JL00006', 'M0072', 2000, 1),
('JL00007', 'M0011', 2000, 3),
('JL00007', 'M0033', 6000, 3),
('JL00007', 'M0046', 3500, 2),
('JL00007', 'M0051', 2500, 3),
('JL00007', 'M0072', 2000, 3),
('JL00008', 'M0008', 2000, 2),
('JL00008', 'M0012', 3500, 2),
('JL00008', 'M0054', 3000, 2),
('JL00008', 'M0072', 2000, 2),
('JL00009', 'M0011', 2000, 1),
('JL00009', 'M0028', 4000, 1),
('JL00009', 'M0050', 1000, 1),
('JL00009', 'M0072', 2000, 1),
('JL00010', 'M0043', 3500, 1),
('JL00010', 'M0047', 4000, 1),
('JL00010', 'M0051', 2500, 1),
('JL00010', 'M0072', 2000, 1),
('JL00011', 'M0016', 4000, 1),
('JL00011', 'M0040', 6000, 1),
('JL00011', 'M0052', 3000, 1),
('JL00011', 'M0072', 2000, 1),
('JL00012', 'M0001', 1500, 1),
('JL00012', 'M0035', 7500, 1),
('JL00012', 'M0050', 1000, 1),
('JL00012', 'M0072', 2000, 1),
('JL00013', 'M0014', 3500, 1),
('JL00013', 'M0033', 6000, 1),
('JL00013', 'M0051', 2500, 2),
('JL00013', 'M0072', 2000, 2),
('JL00014', 'M0016', 4000, 1),
('JL00014', 'M0017', 4000, 1),
('JL00014', 'M0070', 6000, 1),
('JL00014', 'M0072', 2000, 1),
('JL00015', 'M0015', 4000, 2),
('JL00015', 'M0030', 3500, 2),
('JL00015', 'M0045', 3500, 1),
('JL00015', 'M0054', 3000, 2),
('JL00015', 'M0072', 2000, 2),
('JL00016', 'M0010', 2000, 1),
('JL00016', 'M0011', 2000, 1),
('JL00016', 'M0016', 4000, 1),
('JL00016', 'M0028', 4000, 3),
('JL00016', 'M0050', 1000, 1),
('JL00016', 'M0051', 2500, 2),
('JL00016', 'M0072', 2000, 3),
('JL00017', 'M0028', 4000, 2),
('JL00017', 'M0030', 3500, 2),
('JL00017', 'M0052', 3000, 1),
('JL00017', 'M0053', 3000, 1),
('JL00017', 'M0072', 2000, 2),
('JL00018', 'M0003', 1500, 1),
('JL00018', 'M0005', 2000, 1),
('JL00018', 'M0073', 12000, 1),
('JL00019', 'M0003', 1500, 1),
('JL00019', 'M0034', 7500, 1),
('JL00019', 'M0008', 2000, 1),
('JL00019', 'M0073', 12000, 1),
('JL00020', 'M0012', 3500, 1),
('JL00020', 'M0014', 3500, 1),
('JL00020', 'M0072', 2000, 5),
('JL00020', 'M0001', 1500, 1),
('JL00020', 'M0025', 10000, 1),
('JL00021', 'M0017', 4000, 1),
('JL00021', 'M0015', 4000, 1),
('JL00022', 'M0016', 4000, 2),
('JL00022', 'M0013', 3500, 1),
('JL00023', 'M0072', 2000, 2),
('JL00023', 'M0062', 6000, 1),
('JL00023', 'M0063', 6000, 1),
('JL00023', 'M0016', 4000, 1),
('JL00023', 'M0001', 1500, 1),
('JL00024', 'M0073', 12000, 1),
('JL00024', 'M0018', 5000, 4),
('JL00024', 'M0048', 4000, 1),
('JL00024', 'M0003', 1500, 1),
('JL00025', 'M0072', 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kd_supplier` char(3) NOT NULL,
  `nm_supplier` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telepon` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nm_supplier`, `alamat`, `no_telepon`) VALUES
('S01', 'Superindo Mart', 'Jl. Adisucipto, Yogyakarta', '02741111111'),
('S02', 'Pasar Sayur - Bantengan', 'Jl. Pleret, Blok O, Yogyakarta', '-'),
('S03', 'Bp. Bejo Sumijo (Telur)', 'Jl. Bantul, 120, Yogyakarta', '081912121212'),
('S04', 'Polarindo (Es Polar)', 'Jl. Adisucipto, Yogyakarta', '027412121212'),
('S05', 'Pak Usman Beras', 'Jl. Plamongan No.2 Magelang', '0857772222928');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_pembelian`
--

CREATE TABLE `tmp_pembelian` (
  `id` int(4) NOT NULL,
  `kd_user` char(3) NOT NULL,
  `item_barang` varchar(100) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_pembelian`
--

INSERT INTO `tmp_pembelian` (`id`, `kd_user`, `item_barang`, `harga`, `jumlah`, `satuan`) VALUES
(6, 'U02', 'es cube', 4000, 3, 'Bungkus');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_penjualan`
--

CREATE TABLE `tmp_penjualan` (
  `id` int(4) NOT NULL,
  `kd_user` char(3) NOT NULL,
  `kd_menu` char(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kd_user` char(3) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('Kasir','Admin','Meja') NOT NULL DEFAULT 'Kasir'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kd_user`, `nm_user`, `no_telepon`, `username`, `password`, `level`) VALUES
('U01', 'Bunafit Nugroho', '081911111111111', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
('U02', 'Fitria Prasetya', '081911111111111', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Kasir'),
('U03', 'Fitria Prasetiawati', '081911111111111', 'fitria', 'ef208a5dfcfc3ea9941d7a6c43841784', 'Kasir'),
('U04', 'meja 4', '0', 'meja4', '16d8fbd62375c5a77962ffd96c9275a2', 'Meja'),
('U05', 'Meja 1', '0', 'meja1', 'c4ca4238a0b923820dcc509a6f75849b', 'Meja'),
('U06', 'Meja 2', '0', 'meja2', '2', 'Meja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kd_menu`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_pembelian`);

--
-- Indexes for table `pembelian_item`
--
ALTER TABLE `pembelian_item`
  ADD KEY `nomor_penjualan_tamu` (`no_pembelian`,`item_barang`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `penjualan_item`
--
ALTER TABLE `penjualan_item`
  ADD KEY `nomor_penjualan_tamu` (`no_penjualan`,`kd_menu`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kd_supplier`);

--
-- Indexes for table `tmp_pembelian`
--
ALTER TABLE `tmp_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tmp_pembelian`
--
ALTER TABLE `tmp_pembelian`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
