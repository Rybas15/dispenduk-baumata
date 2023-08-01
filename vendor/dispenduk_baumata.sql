-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2023 pada 05.20
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dispenduk_baumata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agama`
--

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`) VALUES
(1, 'Islam'),
(2, 'Kristen Protestan'),
(3, 'Katolik'),
(4, 'Hindu'),
(5, 'Buddha'),
(6, 'Konghucu'),
(7, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dusun`
--

CREATE TABLE `dusun` (
  `id_dusun` int(11) NOT NULL,
  `nama_dusun` varchar(75) NOT NULL,
  `kepala_dusun` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dusun`
--

INSERT INTO `dusun` (`id_dusun`, `nama_dusun`, `kepala_dusun`) VALUES
(3, 'Anggrek', 'Hermanus'),
(5, 'Duren 1', 'Tyo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id_jenis_kelamin` int(11) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id_jenis_kelamin`, `jenis_kelamin`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartu_keluarga`
--

CREATE TABLE `kartu_keluarga` (
  `id_kk` int(11) NOT NULL,
  `no_kk` char(35) NOT NULL,
  `nama_lengkap` varchar(75) NOT NULL,
  `nik` char(35) NOT NULL,
  `id_jenis_kelamin` int(11) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `no_paspor` char(35) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `id_status_perkawinan` int(11) NOT NULL,
  `id_status_keluarga` int(11) NOT NULL,
  `nama_ayah` varchar(75) NOT NULL,
  `nama_ibu` varchar(75) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kartu_keluarga`
--

INSERT INTO `kartu_keluarga` (`id_kk`, `no_kk`, `nama_lengkap`, `nik`, `id_jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `no_paspor`, `id_agama`, `id_pendidikan`, `id_pekerjaan`, `id_status_perkawinan`, `id_status_keluarga`, `nama_ayah`, `nama_ibu`, `created_at`, `updated_at`) VALUES
(2, '5371042312072183', 'Sahala Zakaria Recardo Butar Butar', '5308192708990001', 1, '1999-08-27', 'Kota Kupang', '', 3, 6, 8, 2, 1, 'Ronald', 'Monica', '2023-07-30 12:57:22', '2023-07-31 16:04:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelahiran`
--

CREATE TABLE `kelahiran` (
  `id_kelahiran` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `nama_kelahiran` varchar(100) NOT NULL,
  `id_jenis_kelamin` int(11) NOT NULL,
  `tempat_lahir` varchar(75) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `pelapor` varchar(75) NOT NULL,
  `hubungan_pelapor` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelahiran`
--

INSERT INTO `kelahiran` (`id_kelahiran`, `id_penduduk`, `nama_kelahiran`, `id_jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `nama_ayah`, `nama_ibu`, `pelapor`, `hubungan_pelapor`, `created_at`, `updated_at`) VALUES
(3, 4, 'tiara', 2, 'Jakarta', '2023-08-01', 'belum tahu', 'belum tahu', '', '', '2023-08-01 00:42:30', '2023-08-01 00:42:30'),
(4, 3, 'Itha', 2, 'Sabu', '2023-08-01', 'belum tahu', 'belum tahu', '', '', '2023-08-01 00:42:52', '2023-08-01 00:42:52'),
(5, 5, 'Sahala Zakaria Recardo Butar Butar', 1, 'Kota Kupang', '2023-08-01', 'Ronald', 'Monica', '', '', '2023-08-01 02:42:33', '2023-08-01 03:04:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kematian`
--

CREATE TABLE `kematian` (
  `id_kematian` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `nama_kematian` varchar(100) NOT NULL,
  `tempat_kematian` varchar(50) NOT NULL,
  `tgl_kematian` date NOT NULL,
  `umur` int(5) NOT NULL,
  `nama_pelapor` varchar(50) NOT NULL,
  `hubungan_pelapor` varchar(50) NOT NULL,
  `sebab` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `pekerjaan` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `pekerjaan`) VALUES
(1, 'Pegawai Negeri Sipil (PNS)'),
(2, 'Swasta'),
(3, 'Wiraswasta'),
(4, 'Pelajar / Mahasiswa'),
(5, 'Pensiunan'),
(6, 'Petani / Buruh Tani'),
(7, 'Pedagang'),
(8, 'Pengusaha'),
(9, 'Pengajar / Dosen'),
(10, 'TNI / Polri'),
(11, 'Pelayan Rumah Tangga'),
(12, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendatang`
--

CREATE TABLE `pendatang` (
  `id_pendatang` int(11) NOT NULL,
  `id_rt` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama_kk` varchar(75) NOT NULL,
  `tgl_menetap` date NOT NULL,
  `alamat_asal` varchar(100) NOT NULL,
  `alasan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `status_pendidikan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendidikan`
--

INSERT INTO `pendidikan` (`id_pendidikan`, `status_pendidikan`) VALUES
(1, 'Tidak Ada'),
(2, 'SD / MI'),
(3, 'SMP / MTs'),
(4, 'SMA / SMK / MA'),
(5, 'Diploma (D1/D2/D3)'),
(6, 'Sarjana (D4/S1)'),
(7, 'Magister (S2)'),
(8, 'Doktor (S3)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `id_kk` int(11) NOT NULL,
  `id_rt` int(11) NOT NULL,
  `nama_kk` varchar(225) NOT NULL,
  `id_jenis_kelamin` int(11) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(75) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `id_status_kawin` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nik`, `id_kk`, `id_rt`, `nama_kk`, `id_jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `alamat`, `id_pekerjaan`, `id_pendidikan`, `id_status_kawin`, `created_at`, `updated_at`) VALUES
(3, '1234567890123412', 2, 2, 'Itha', 2, '2023-07-30', 'Sabu', '', 3, 2, 2, '2023-07-30 23:58:48', '2023-07-30 23:58:48'),
(4, '3452436256', 2, 4, 'tiara', 2, '2023-07-31', 'Jakarta', 'Jln. Adisucipto', 2, 6, 1, '2023-07-31 07:43:02', '2023-07-31 18:02:19'),
(5, '5308192708990001', 2, 5, 'Sahala Zakaria Recardo Butar Butar', 1, '2023-08-01', 'Kota Kupang', 'Jalan W.J. Lalamentik No.95', 8, 6, 1, '2023-08-01 02:41:56', '2023-08-01 02:41:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pindah`
--

CREATE TABLE `pindah` (
  `id_pindah` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama_kk` varchar(100) NOT NULL,
  `tgl_pindah` date NOT NULL,
  `alamat_pindah` varchar(75) NOT NULL,
  `ket` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rt`
--

CREATE TABLE `rt` (
  `id_rt` int(11) NOT NULL,
  `id_rw` int(11) NOT NULL,
  `rt` char(10) NOT NULL,
  `nama_ketua_rt` varchar(75) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rt`
--

INSERT INTO `rt` (`id_rt`, `id_rw`, `rt`, `nama_ketua_rt`, `created_at`, `updated_at`) VALUES
(2, 3, '24', 'Jery', '2023-07-29 23:56:05', '2023-07-29 23:56:05'),
(3, 3, '25', 'Putri', '2023-07-29 23:56:16', '2023-07-29 23:56:16'),
(4, 6, '26', 'Gio', '2023-07-29 23:56:27', '2023-07-29 23:56:27'),
(5, 6, '27', 'Deby', '2023-07-29 23:56:35', '2023-07-29 23:56:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rw`
--

CREATE TABLE `rw` (
  `id_rw` int(11) NOT NULL,
  `id_dusun` int(11) NOT NULL,
  `rw` char(10) NOT NULL,
  `nama_ketua_rw` varchar(75) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rw`
--

INSERT INTO `rw` (`id_rw`, `id_dusun`, `rw`, `nama_ketua_rw`, `created_at`, `updated_at`) VALUES
(3, 3, '001', 'Rehan', '2023-07-29 23:36:16', '2023-07-29 23:36:16'),
(6, 5, '002', 'Gilang', '2023-07-29 23:42:32', '2023-07-29 23:42:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_keluarga`
--

CREATE TABLE `status_keluarga` (
  `id_status_keluarga` int(11) NOT NULL,
  `status_keluarga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_keluarga`
--

INSERT INTO `status_keluarga` (`id_status_keluarga`, `status_keluarga`) VALUES
(1, 'Kepala Keluarga'),
(2, 'Suami'),
(3, 'Istri'),
(4, 'Anak'),
(5, 'Menantu'),
(6, 'Cucu'),
(7, 'Orang Tua'),
(8, 'Mertua'),
(9, 'Famili Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_perkawinan`
--

CREATE TABLE `status_perkawinan` (
  `id_status_perkawinan` int(11) NOT NULL,
  `status_perkawinan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_perkawinan`
--

INSERT INTO `status_perkawinan` (`id_status_perkawinan`, `status_perkawinan`) VALUES
(1, 'Belum Menikah'),
(2, 'Menikah'),
(3, 'Cerai Hidup'),
(4, 'Cerai Mati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT 2,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '$2y$10$Zy3Neb36HGufJbEUqkXOeOntDCOnnC31mVlYkU6lV94/ENv6W50KO', '2023-06-21 10:06:03', '2023-06-21 10:06:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Penduduk');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indeks untuk tabel `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id_dusun`);

--
-- Indeks untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id_jenis_kelamin`);

--
-- Indeks untuk tabel `kartu_keluarga`
--
ALTER TABLE `kartu_keluarga`
  ADD PRIMARY KEY (`id_kk`),
  ADD KEY `id_jenis_kelamin` (`id_jenis_kelamin`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_pendidikan` (`id_pendidikan`),
  ADD KEY `id_pekerjaan` (`id_pekerjaan`),
  ADD KEY `id_status_perkawinan` (`id_status_perkawinan`),
  ADD KEY `id_status_keluarga` (`id_status_keluarga`);

--
-- Indeks untuk tabel `kelahiran`
--
ALTER TABLE `kelahiran`
  ADD PRIMARY KEY (`id_kelahiran`),
  ADD KEY `id_jenis_kelamin` (`id_jenis_kelamin`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indeks untuk tabel `kematian`
--
ALTER TABLE `kematian`
  ADD PRIMARY KEY (`id_kematian`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indeks untuk tabel `pendatang`
--
ALTER TABLE `pendatang`
  ADD PRIMARY KEY (`id_pendatang`),
  ADD KEY `pendatang_ibfk_1` (`id_rt`);

--
-- Indeks untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indeks untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD KEY `id_kk` (`id_kk`),
  ADD KEY `id_jenis_kelamin` (`id_jenis_kelamin`),
  ADD KEY `id_pekerjaan` (`id_pekerjaan`),
  ADD KEY `id_pendidikan` (`id_pendidikan`),
  ADD KEY `id_status_kawin` (`id_status_kawin`),
  ADD KEY `penduduk_ibfk_1` (`id_rt`);

--
-- Indeks untuk tabel `pindah`
--
ALTER TABLE `pindah`
  ADD PRIMARY KEY (`id_pindah`);

--
-- Indeks untuk tabel `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id_rt`),
  ADD KEY `id_rw` (`id_rw`);

--
-- Indeks untuk tabel `rw`
--
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id_rw`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indeks untuk tabel `status_keluarga`
--
ALTER TABLE `status_keluarga`
  ADD PRIMARY KEY (`id_status_keluarga`);

--
-- Indeks untuk tabel `status_perkawinan`
--
ALTER TABLE `status_perkawinan`
  ADD PRIMARY KEY (`id_status_perkawinan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id_dusun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id_jenis_kelamin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kartu_keluarga`
--
ALTER TABLE `kartu_keluarga`
  MODIFY `id_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelahiran`
--
ALTER TABLE `kelahiran`
  MODIFY `id_kelahiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kematian`
--
ALTER TABLE `kematian`
  MODIFY `id_kematian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pendatang`
--
ALTER TABLE `pendatang`
  MODIFY `id_pendatang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pindah`
--
ALTER TABLE `pindah`
  MODIFY `id_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rt`
--
ALTER TABLE `rt`
  MODIFY `id_rt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rw`
--
ALTER TABLE `rw`
  MODIFY `id_rw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `status_keluarga`
--
ALTER TABLE `status_keluarga`
  MODIFY `id_status_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `status_perkawinan`
--
ALTER TABLE `status_perkawinan`
  MODIFY `id_status_perkawinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kartu_keluarga`
--
ALTER TABLE `kartu_keluarga`
  ADD CONSTRAINT `kartu_keluarga_ibfk_1` FOREIGN KEY (`id_jenis_kelamin`) REFERENCES `jenis_kelamin` (`id_jenis_kelamin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kartu_keluarga_ibfk_2` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kartu_keluarga_ibfk_3` FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan` (`id_pendidikan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kartu_keluarga_ibfk_4` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kartu_keluarga_ibfk_5` FOREIGN KEY (`id_status_perkawinan`) REFERENCES `status_perkawinan` (`id_status_perkawinan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kartu_keluarga_ibfk_6` FOREIGN KEY (`id_status_keluarga`) REFERENCES `status_keluarga` (`id_status_keluarga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `kelahiran`
--
ALTER TABLE `kelahiran`
  ADD CONSTRAINT `kelahiran_ibfk_1` FOREIGN KEY (`id_jenis_kelamin`) REFERENCES `jenis_kelamin` (`id_jenis_kelamin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kelahiran_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kematian`
--
ALTER TABLE `kematian`
  ADD CONSTRAINT `kematian_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendatang`
--
ALTER TABLE `pendatang`
  ADD CONSTRAINT `pendatang_ibfk_1` FOREIGN KEY (`id_rt`) REFERENCES `rt` (`id_rt`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`id_rt`) REFERENCES `rt` (`id_rt`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`id_kk`) REFERENCES `kartu_keluarga` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_5` FOREIGN KEY (`id_jenis_kelamin`) REFERENCES `jenis_kelamin` (`id_jenis_kelamin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `penduduk_ibfk_6` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `penduduk_ibfk_7` FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan` (`id_pendidikan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `penduduk_ibfk_8` FOREIGN KEY (`id_status_kawin`) REFERENCES `status_perkawinan` (`id_status_perkawinan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `rt`
--
ALTER TABLE `rt`
  ADD CONSTRAINT `rt_ibfk_1` FOREIGN KEY (`id_rw`) REFERENCES `rw` (`id_rw`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rw`
--
ALTER TABLE `rw`
  ADD CONSTRAINT `rw_ibfk_1` FOREIGN KEY (`id_dusun`) REFERENCES `dusun` (`id_dusun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
