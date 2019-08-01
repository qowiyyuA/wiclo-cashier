-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2019 pada 14.50
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` varchar(255) NOT NULL,
  `ID_KATEGORI` varchar(100) DEFAULT NULL,
  `NAMA_BARANG` varchar(255) DEFAULT NULL,
  `MERK_BARANG` varchar(255) NOT NULL,
  `UKURAN_BARANG` varchar(20) NOT NULL,
  `KODE_BARCODE` varchar(255) NOT NULL,
  `STOK` int(11) DEFAULT NULL,
  `HARGA` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `ID_KATEGORI`, `NAMA_BARANG`, `MERK_BARANG`, `UKURAN_BARANG`, `KODE_BARCODE`, `STOK`, `HARGA`) VALUES
('JK003', 'KT-003', 'Nike', 'Nike', 'XL', 'Nik.JK003.150K', 3, '150000'),
('TL002', 'KT-001', 'Polo', 'Ferrari', 'XL', 'FerTL0020K', 20, '10000'),
('TL003', 'KT-001', 'Polo', 'Ferrari', 'XL', 'Fer.TL003.500K', 20, '500000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_pemasukan`
--

CREATE TABLE `detil_pemasukan` (
  `ID_BARANG` varchar(255) NOT NULL,
  `ID_PEMASUKAN` varchar(100) NOT NULL,
  `STOK_MASUK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil_pemasukan`
--

INSERT INTO `detil_pemasukan` (`ID_BARANG`, `ID_PEMASUKAN`, `STOK_MASUK`) VALUES
('JK003', 'PEM20190730001', 5),
('JK003', 'PEM20190730002', 20),
('JK003', 'STOK-001', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_penjualan`
--

CREATE TABLE `detil_penjualan` (
  `ID_BARANG` varchar(255) NOT NULL,
  `ID_PENJUALAN` varchar(100) NOT NULL,
  `JUMLAH_JUAL` int(11) DEFAULT NULL,
  `SUB_TOTAL` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil_penjualan`
--

INSERT INTO `detil_penjualan` (`ID_BARANG`, `ID_PENJUALAN`, `JUMLAH_JUAL`, `SUB_TOTAL`) VALUES
('TL002', '20190725001', 3, '30000'),
('TL002', '20190725002', 3, '30000'),
('TL002', '20190725003', 1, '10000'),
('TL002', '20190725004', 1, '10000'),
('TL002', '20190725005', 1, '10000'),
('TL002', '20190726001', 2, '20000'),
('TL002', '20190726002', 1, '10000'),
('TL002', '20190727001', 1, '10000'),
('TL003', '20190726001', 1, '500000'),
('TL003', '20190727001', 1, '500000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `ID_KATEGORI` varchar(100) NOT NULL,
  `NAMA_KATEGORI` varchar(40) DEFAULT NULL,
  `KODE_KATEGORI` varchar(30) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_AT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `KODE_KATEGORI`, `CREATED_AT`, `UPDATED_AT`) VALUES
('KT-001', 'T-shirts', 'TL', '2019-07-13 00:20:39', '0000-00-00 00:00:00'),
('KT-002', 'Tas aku', 'TS', '2019-07-13 00:27:20', '2019-07-13 00:27:20'),
('KT-003', 'jaket wow', 'JK', '2019-07-13 00:29:32', '2019-07-13 00:29:51'),
('KT-004', 'Kaos 1', 'KS', '2019-07-13 05:29:59', '2019-07-13 05:32:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` varchar(100) NOT NULL,
  `NAMA_PEGAWAI` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(30) DEFAULT NULL,
  `STATUS` varchar(30) DEFAULT NULL,
  `LOGIN_AT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LOGOUT_AT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `NAMA_PEGAWAI`, `PASSWORD`, `STATUS`, `LOGIN_AT`, `LOGOUT_AT`) VALUES
('adi123', 'Adi Harjono', '1234', '1', '2019-08-01 12:39:20', '2019-07-13 05:21:15'),
('qowi123', 'Qowi', '1234', '1', '2019-08-01 12:45:41', '0000-00-00 00:00:00'),
('sdsfsdf', 'Qowiyyu Adzkar', '1234', '2', '2019-08-01 12:45:30', '2019-07-13 05:19:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `ID_PEMASUKAN` varchar(100) NOT NULL,
  `TGL_PEMASUKAN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`ID_PEMASUKAN`, `TGL_PEMASUKAN`) VALUES
('PEM20190730001', '2019-07-30 14:22:41'),
('PEM20190730002', '2019-07-30 14:22:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `ID_PENJUALAN` varchar(100) NOT NULL,
  `ID_PEGAWAI` varchar(100) DEFAULT NULL,
  `TGL_PENJUALAN` datetime DEFAULT NULL,
  `TOTAL_HARGA_PENJUALAN` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`ID_PENJUALAN`, `ID_PEGAWAI`, `TGL_PENJUALAN`, `TOTAL_HARGA_PENJUALAN`) VALUES
('20190725003', 'adi123', '2019-07-25 15:35:10', '10000'),
('20190725004', 'adi123', '2019-07-25 15:35:10', '10000'),
('20190725005', 'adi123', '2019-07-25 15:52:49', '10000'),
('20190726001', 'adi123', '2019-07-26 15:35:19', '520000'),
('20190726002', 'adi123', '2019-07-26 15:51:01', '10000'),
('20190727001', 'adi123', '2019-07-27 05:56:27', '510000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`),
  ADD KEY `FK_MEMILIKI` (`ID_KATEGORI`);

--
-- Indeks untuk tabel `detil_pemasukan`
--
ALTER TABLE `detil_pemasukan`
  ADD PRIMARY KEY (`ID_BARANG`,`ID_PEMASUKAN`),
  ADD KEY `FK_DETIL_PEMASUKAN2` (`ID_PEMASUKAN`);

--
-- Indeks untuk tabel `detil_penjualan`
--
ALTER TABLE `detil_penjualan`
  ADD PRIMARY KEY (`ID_BARANG`,`ID_PENJUALAN`),
  ADD KEY `FK_DETIL_PENJUALAN2` (`ID_PENJUALAN`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PEGAWAI`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`ID_PEMASUKAN`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`ID_PENJUALAN`),
  ADD KEY `FK_MEMEGANG` (`ID_PEGAWAI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
