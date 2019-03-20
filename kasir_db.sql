-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2019 pada 03.40
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
  `ID_WARNA` varchar(50) NOT NULL,
  `KODE_BARCODE` varchar(255) NOT NULL,
  `NAMA_BARANG` varchar(40) DEFAULT NULL,
  `MERK_BARANG` varchar(255) NOT NULL,
  `UKURAN_BARANG` varchar(20) NOT NULL,
  `WARNA` varchar(100) NOT NULL,
  `STOK` int(11) DEFAULT NULL,
  `HARGA` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `ID_KATEGORI`, `ID_WARNA`, `KODE_BARCODE`, `NAMA_BARANG`, `MERK_BARANG`, `UKURAN_BARANG`, `WARNA`, `STOK`, `HARGA`) VALUES
('KB-02', 'KT-001', 'W-001', 'Sup.KT-001.W-001.L.125K', 'Suprime woman', 'Suprime', 'L', 'W-001', 10, '125000'),
('KB-05', 'KT-001', 'W-002', 'Nik.KT-001.W-002.XL.140K', 'Nike men tshirt', 'Nike', 'XL', 'W-002', 5, '140000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_pemasukan`
--

CREATE TABLE `detil_pemasukan` (
  `ID_BARANG` varchar(255) NOT NULL,
  `ID_PEMASUKAN` varchar(100) NOT NULL,
  `STOK_MASUK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `ID_KATEGORI` varchar(100) NOT NULL,
  `NAMA_KATEGORI` varchar(40) DEFAULT NULL,
  `KODE_KATEGORI` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `KODE_KATEGORI`) VALUES
('KT-001', 'Baju', 'bj'),
('KT-002', 'Hoodie', 'hd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` varchar(100) NOT NULL,
  `NAMA_PEGAWAI` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(30) DEFAULT NULL,
  `STATUS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `NAMA_PEGAWAI`, `PASSWORD`, `STATUS`) VALUES
('admin', 'Qowi', '1234', 'admin'),
('ads', 'adi', '1234', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `ID_PEMASUKAN` varchar(100) NOT NULL,
  `TGL_PEMASUKAN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `warna`
--

CREATE TABLE `warna` (
  `ID_WARNA` varchar(50) NOT NULL,
  `NAMA_WARNA` varchar(100) NOT NULL,
  `KODE_WARNA` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `warna`
--

INSERT INTO `warna` (`ID_WARNA`, `NAMA_WARNA`, `KODE_WARNA`) VALUES
('W-001', 'Biru', '#0d47a1'),
('W-002', 'Hijau', '#2e7d32'),
('W-003', 'Hijau Tua', '#1a7001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`),
  ADD KEY `FK_MEMILIKI` (`ID_KATEGORI`),
  ADD KEY `FK_WARNA_BARANG` (`ID_WARNA`);

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

--
-- Indeks untuk tabel `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`ID_WARNA`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`),
  ADD CONSTRAINT `FK_WARNA_BARANG` FOREIGN KEY (`ID_WARNA`) REFERENCES `warna` (`id_warna`);

--
-- Ketidakleluasaan untuk tabel `detil_pemasukan`
--
ALTER TABLE `detil_pemasukan`
  ADD CONSTRAINT `FK_DETIL_PEMASUKAN` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `FK_DETIL_PEMASUKAN2` FOREIGN KEY (`ID_PEMASUKAN`) REFERENCES `pemasukan` (`ID_PEMASUKAN`);

--
-- Ketidakleluasaan untuk tabel `detil_penjualan`
--
ALTER TABLE `detil_penjualan`
  ADD CONSTRAINT `FK_DETIL_PENJUALAN` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `FK_DETIL_PENJUALAN2` FOREIGN KEY (`ID_PENJUALAN`) REFERENCES `penjualan` (`ID_PENJUALAN`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `FK_MEMEGANG` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
