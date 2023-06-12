-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2023 pada 13.41
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `kode` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`kode`, `nama`) VALUES
('1-111', 'Kas'),
('1-112', 'Piutang'),
('1-113', 'Persediaan'),
('1-114', 'Perlengkapan'),
('1-211', 'Peralatan'),
('1-212', 'Tanah'),
('1-213', 'Bangunan'),
('1-214', 'Akumulasi Penyusutan'),
('2-111', 'Simpanan Pokok'),
('2-112', 'Simpanan Sukarela'),
('2-113', 'Simpanan Wajib'),
('2-114', 'SHU Belum Dibagi'),
('3-111', 'Modal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `anggota_kode` varchar(10) NOT NULL,
  `anggota_nik` varchar(20) NOT NULL,
  `anggota_nama` varchar(80) NOT NULL,
  `anggota_tgllahir` date NOT NULL,
  `anggota_alamat` text NOT NULL,
  `anggota_pekerjaan` varchar(80) NOT NULL,
  `anggota_nohp` varchar(20) NOT NULL,
  `tgl_masuk_anggota` date DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`anggota_kode`, `anggota_nik`, `anggota_nama`, `anggota_tgllahir`, `anggota_alamat`, `anggota_pekerjaan`, `anggota_nohp`, `tgl_masuk_anggota`, `password`) VALUES
('A000001', '180213071180001', 'Yudi Setyawan', '1998-11-07', 'Gg. Damai No. 2 Rajabasa,Semarang', 'Pegawai Negeri Sipil', '082382000703', '2022-09-01', '827ccb0eea8a706c4c34a16891f84e7b'),
('A000002', '180213071180002', 'Neprisa Anggraini', '1997-11-25', 'Bandar Jaya, Solo', 'Enterpreneur', '082382000703', '2022-10-02', '827ccb0eea8a706c4c34a16891f84e7b'),
('A000003', '3374031312058161', 'Alfin Natan', '1998-09-10', 'Krajan Lor, Kaliwungu', 'Wiraswata', '08990685315', '2022-10-03', '827ccb0eea8a706c4c34a16891f84e7b'),
('A000004', '3374062238900009', 'Murjito Junaedi', '1995-04-21', 'Sendang, Weleri', 'Guru', '085692360113', '2022-10-05', '827ccb0eea8a706c4c34a16891f84e7b'),
('A000005', '3374000057869766', 'Sania Marwati', '2000-08-07', 'Ngaliyan, Semarang', 'Pegawai Negeri Sipil', '087578445990', '2022-10-02', '827ccb0eea8a706c4c34a16891f84e7b'),
('A000006', '3374008889111345', 'Suci Sukmawati', '1997-05-13', 'Pandean, Kaliwungu', 'Karyawan', '087906234980', '2022-10-01', '827ccb0eea8a706c4c34a16891f84e7b'),
('A000007', '3374022189000344', 'Ara Yuanita', '1996-02-18', 'Ngaliyan, Semarang', 'Wartawan', '08233468990', '2022-10-03', '827ccb0eea8a706c4c34a16891f84e7b'),
('A000008', '3329012910901728', 'Arvyandy Wahyu Hapsoro', '2022-10-05', 'Langenharjo', 'Mahasiswa', '089100876892', '2022-10-05', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `angsuran_id` int(11) NOT NULL,
  `angsuran_pinjaman` varchar(10) NOT NULL,
  `angsuran_waktu` datetime NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `angsuran_jumlah` double NOT NULL,
  `angsuran_denda` double NOT NULL,
  `angsuran_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`angsuran_id`, `angsuran_pinjaman`, `angsuran_waktu`, `angsuran_ke`, `angsuran_jumlah`, `angsuran_denda`, `angsuran_total`) VALUES
(3, 'P000001', '2022-06-26 00:44:08', 1, 1387500, 0, 1387500),
(4, 'P000002', '2022-10-01 21:55:18', 1, 650000, 0, 650000),
(5, 'P000002', '2022-10-01 21:55:32', 2, 650000, 0, 650000),
(6, 'P000002', '2022-10-01 21:55:42', 3, 650000, 0, 650000),
(7, 'P000001', '2022-10-01 21:56:51', 2, 1300000, 0, 1300000),
(8, 'P000001', '2022-10-01 21:57:02', 3, 1300000, 0, 1300000),
(9, 'P000001', '2022-10-01 21:57:12', 4, 1300000, 0, 1300000),
(10, 'P000001', '2022-10-01 21:57:23', 5, 1300000, 0, 1300000),
(11, 'P000003', '2022-10-01 21:58:03', 1, 780000, 0, 780000),
(12, 'P000003', '2022-10-01 21:58:16', 2, 780000, 0, 780000),
(13, 'P000003', '2022-10-01 21:58:42', 3, 780000, 5000, 785000),
(14, 'P000003', '2022-10-01 21:59:00', 4, 780000, 0, 780000),
(15, 'P000004', '2022-10-01 21:59:29', 1, 866666.66666667, 0, 866666),
(16, 'P000004', '2022-10-01 21:59:43', 2, 866666.66666667, 0, 866666),
(17, 'P000004', '2022-10-01 21:59:57', 3, 866666.66666667, 0, 866666),
(18, 'P000001', '2022-11-10 20:31:59', 6, 1300000, 0, 1300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `jurnal_id` int(11) NOT NULL,
  `kode` varchar(64) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_akun` varchar(32) NOT NULL,
  `keterangan` text NOT NULL,
  `debit` decimal(10,0) NOT NULL,
  `kredit` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`jurnal_id`, `kode`, `tanggal`, `kode_akun`, `keterangan`, `debit`, `kredit`, `created_at`) VALUES
(11, 'T202209102201261', '2022-09-10', '3-111', 'Modal', '0', '127330000', '2022-09-10 15:01:26'),
(12, 'T202209102201262', '2022-09-10', '1-212', 'Tanah', '150730000', '0', '2022-09-10 15:01:26'),
(13, 'T202209102203410', '2022-09-10', '1-111', 'Kas', '382500000', '0', '2022-09-10 15:03:41'),
(14, 'T202209102203411', '2022-09-10', '1-112', 'Piutang Dagang', '250000000', '0', '2022-09-10 15:03:41'),
(15, 'T202209111441560', '2022-09-11', '1-114', 'Perlengkapan', '11750000', '0', '2022-09-11 07:41:56'),
(16, 'T202209111441561', '2022-09-11', '1-113', 'Persediaan', '45000000', '0', '2022-09-11 07:41:56'),
(17, 'T202210021012360', '2022-10-02', '1-213', 'Bangunan', '123500000', '0', '2022-10-02 03:12:36'),
(18, 'T202210021013070', '2022-10-02', '1-211', 'Peralatan', '23600000', '0', '2022-10-02 03:13:07'),
(19, 'T202210021013530', '2022-10-02', '1-214', 'Akumulasi Penyusutan', '11250000', '0', '2022-10-02 03:13:53'),
(20, 'T202210021020220', '2022-10-02', '2-112', 'Simpanan Sukarela', '0', '137500000', '2022-10-02 03:20:22'),
(21, 'T202210021021210', '2022-10-02', '2-113', 'Simpanan Wajib', '0', '244500000', '2022-10-02 03:21:21'),
(22, 'T202210021023060', '2022-10-02', '2-111', 'Simpanan Pokok', '0', '489000000', '2022-10-02 03:23:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan`
--

CREATE TABLE `penarikan` (
  `kode` varchar(10) NOT NULL,
  `anggota_id` varchar(10) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penarikan`
--

INSERT INTO `penarikan` (`kode`, `anggota_id`, `amount`, `created_at`) VALUES
('P000001', 'A000001', 10000, '2022-09-11 14:18:52'),
('P000002', 'A000003', 20000, '2022-09-30 02:55:27'),
('P000003', 'A000007', 35000, '2022-09-30 02:55:44'),
('P000004', 'A000010', 20000, '2022-10-01 15:02:11'),
('P000005', 'A000009', 15000, '2022-10-01 15:02:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `pinjaman_kode` varchar(10) NOT NULL,
  `pinjaman_anggota` varchar(10) NOT NULL,
  `pinjaman_jumlah` double NOT NULL,
  `pinjaman_tempo` int(11) NOT NULL,
  `pinjaman_bunga` int(11) NOT NULL,
  `pinjaman_total` double NOT NULL,
  `pinjaman_jaminan` varchar(254) NOT NULL,
  `pinjaman_waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`pinjaman_kode`, `pinjaman_anggota`, `pinjaman_jumlah`, `pinjaman_tempo`, `pinjaman_bunga`, `pinjaman_total`, `pinjaman_jaminan`, `pinjaman_waktu`) VALUES
('P000001', 'A000002', 30000000, 24, 4, 31200000, 'BPKP mobil xenia AD 53643 HZ', '2022-10-01 21:51:29'),
('P000002', 'A000003', 15000000, 24, 4, 15600000, 'BPKB Revo H 3441 EU', '2022-10-01 21:43:07'),
('P000003', 'A000005', 18000000, 24, 4, 18720000, 'BPKB Xenia H 6378 BK', '2022-10-01 21:44:17'),
('P000004', 'A000001', 30000000, 36, 4, 31200000, 'BPKB Ayla H 2778 OU', '2022-10-01 21:51:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE `simpanan` (
  `simpanan_kode` varchar(10) NOT NULL,
  `simpanan_anggota` varchar(10) NOT NULL,
  `simpanan_jumlah` double NOT NULL,
  `simpanan_jenis` enum('wajib','pokok','sukarela') NOT NULL,
  `simpanan_waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan`
--

INSERT INTO `simpanan` (`simpanan_kode`, `simpanan_anggota`, `simpanan_jumlah`, `simpanan_jenis`, `simpanan_waktu`) VALUES
('SP000001', 'A000001', 100000, 'pokok', '2022-10-10 06:46:51'),
('SP000002', 'A000002', 100000, 'pokok', '2022-09-30 09:12:48'),
('SP000003', 'A000003', 100000, 'pokok', '2022-09-30 09:13:42'),
('SP000004', 'A000004', 100000, 'pokok', '2022-09-30 09:14:20'),
('SP000005', 'A000005', 100000, 'pokok', '2022-09-30 09:15:18'),
('SP000006', 'A000006', 100000, 'pokok', '2022-09-30 09:15:43'),
('SP000007', 'A000007', 100000, 'pokok', '2022-09-30 09:16:07'),
('SS000001', 'A000002', 75000, 'sukarela', '2022-09-30 09:11:47'),
('SS000002', 'A000004', 120000, 'sukarela', '2022-10-01 21:32:28'),
('SS000003', 'A000005', 90000, 'sukarela', '2022-10-01 21:33:05'),
('SS000004', 'A000001', 40000, 'sukarela', '2022-10-01 21:34:47'),
('SS000005', 'A000003', 50000, 'sukarela', '2022-10-01 21:36:27'),
('SS000006', 'A000006', 30000, 'sukarela', '2022-10-01 21:38:07'),
('SW000001', 'A000001', 50000, 'wajib', '2022-09-30 08:57:27'),
('SW000002', 'A000002', 50000, 'wajib', '2022-09-30 08:57:37'),
('SW000003', 'A000003', 50000, 'wajib', '2022-09-30 08:57:17'),
('SW000004', 'A000004', 50000, 'wajib', '2022-09-30 08:57:55'),
('SW000005', 'A000005', 50000, 'wajib', '2022-09-30 09:04:54'),
('SW000006', 'A000006', 50000, 'wajib', '2022-09-30 09:06:00'),
('SW000007', 'A000007', 50000, 'wajib', '2022-09-30 09:07:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_level`) VALUES
(1, 'Administrator', 'admin', '202cb962ac59075b964b07152d234b70', 'bendahara'),
(4, 'Ketua Pengawas', 'Pengawas', '202cb962ac59075b964b07152d234b70', 'pengawas'),
(6, 'Manager', 'Manager', '827ccb0eea8a706c4c34a16891f84e7b', 'manajer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`anggota_kode`),
  ADD UNIQUE KEY `anggota_nik` (`anggota_nik`);

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`angsuran_id`),
  ADD KEY `angsuran_pinjaman` (`angsuran_pinjaman`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`jurnal_id`);

--
-- Indeks untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `simpanan_anggota` (`anggota_id`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`pinjaman_kode`),
  ADD KEY `pinjaman_anggota` (`pinjaman_anggota`);

--
-- Indeks untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`simpanan_kode`),
  ADD KEY `simpanan_anggota` (`simpanan_anggota`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `angsuran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`angsuran_pinjaman`) REFERENCES `pinjaman` (`pinjaman_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`pinjaman_anggota`) REFERENCES `anggota` (`anggota_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`simpanan_anggota`) REFERENCES `anggota` (`anggota_kode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
