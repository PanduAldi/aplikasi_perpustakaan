-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 31 Jan 2016 pada 05.25
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `kd_buku` varchar(15) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_anggota`
--

CREATE TABLE IF NOT EXISTS `t_anggota` (
  `id_anggota` varchar(15) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_anggota`
--

INSERT INTO `t_anggota` (`id_anggota`, `nim`, `nama`, `alamat`, `foto`) VALUES
('20151201001', '12383023', 'pandu aldi pratama', 'jl. raya pulosari rt. 01 / rw. 01 Kec. Brebes', 'Pandhu.jpg'),
('20151201002', '123830', 'waud', 'tegal', '533927_437870252971584_1088888724_a.jpg'),
('20151202003', '12383022', 'sapa aja', 'dimana aja', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_buku`
--

CREATE TABLE IF NOT EXISTS `t_buku` (
  `kd_buku` varchar(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('y','n') NOT NULL,
  `cover` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_buku`
--

INSERT INTO `t_buku` (`kd_buku`, `judul`, `penerbit`, `pengarang`, `deskripsi`, `status`, `cover`) VALUES
('BUK01', 'Belajar PHP', 'aneka', 'pandu', '<p>buku ini adalah buku</p>', 'y', ''),
('BUK02', 'Point Of Sales menggunakan PHP (OOP)', 'perpustakaan', 'andi', '<p>ini adalah buku point of sales</p>', 'y', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_peminjaman`
--

CREATE TABLE IF NOT EXISTS `t_peminjaman` (
  `kd_peminjaman` varchar(15) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `kd_buku` varchar(10) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_peminjaman`
--

INSERT INTO `t_peminjaman` (`kd_peminjaman`, `id_anggota`, `kd_buku`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
('20160126001', '20151201001', 'BUK02', '2016-01-26', '2016-02-06', 'y'),
('20160126001', '20151201001', 'BUK01', '2016-01-30', '2016-02-04', 'y'),
('20160130002', '20151201001', 'BUK02', '2016-01-30', '2016-02-06', 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengembalian`
--

CREATE TABLE IF NOT EXISTS `t_pengembalian` (
  `kd_peminjaman` varchar(15) NOT NULL,
  `kd_buku` varchar(15) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` int(11) NOT NULL,
  `petugas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_pengembalian`
--

INSERT INTO `t_pengembalian` (`kd_peminjaman`, `kd_buku`, `tgl_kembali`, `denda`, `petugas`) VALUES
('20160126001', 'BUK01', '2016-01-29', 0, 'pandu'),
('20160126001', 'BUK02', '2016-01-30', 2000, 'pandu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(70) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('1','2') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'pandu', 'pandu', '8acf7115033fa7bbfebe4b9b726ab374', '1'),
(2, 'aldi', 'aldi', '5cf15fc7e77e85f5d525727358c0ffc9', '2'),
(4, 'petugas1', 'petugas1', 'b53fe7751b37e40ff34d012c7774d65f', '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
