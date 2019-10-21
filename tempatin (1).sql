-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2019 at 11:08 AM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.3.2-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tempatin`
--

-- --------------------------------------------------------

--
-- Table structure for table `controller_item`
--

CREATE TABLE `controller_item` (
  `id` int(2) NOT NULL,
  `controller_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controller_item`
--

INSERT INTO `controller_item` (`id`, `controller_name`) VALUES
(5, 'approve'),
(23, 'approvepemasukan'),
(24, 'approvepengeluaran'),
(18, 'calonkonsumen'),
(19, 'followcalon'),
(6, 'item'),
(7, 'kartukontrol'),
(1, 'kelolauser'),
(16, 'konsumen'),
(12, 'laporancalon'),
(10, 'laporankonsumen'),
(25, 'laporanmarketing'),
(14, 'laporanpemasukan'),
(26, 'laporanpembayaran'),
(13, 'laporanpengeluaran'),
(9, 'laporanunit'),
(8, 'listtransaksi'),
(27, 'listunlocktransaksi'),
(32, 'mngapprove'),
(33, 'mngapprovepengeluaran'),
(22, 'pemasukan'),
(20, 'pembayaran'),
(21, 'pengeluaran'),
(28, 'persyaratan'),
(29, 'persyaratanunit'),
(31, 'profileuser'),
(2, 'ProfilPerusahaan'),
(3, 'properti'),
(4, 'rab'),
(30, 'rekening'),
(17, 'transaksi'),
(15, 'unitproperti');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id_detail` int(5) NOT NULL,
  `id_pembayaran` int(4) NOT NULL,
  `id_rekening` int(1) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `jumlah_bayar` int(9) NOT NULL,
  `status_owner` enum('s','p','sl') NOT NULL,
  `status_manager` enum('s','p','sl') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id_detail`, `id_pembayaran`, `id_rekening`, `tgl_bayar`, `bukti_bayar`, `id_user`, `jumlah_bayar`, `status_owner`, `status_manager`) VALUES
(2, 14, 1, '2019-08-17 10:45:08', '3275dc0ec4b8c064bd8baec6e58503db.png', 4, 4000000, 'sl', 'sl'),
(7, 14, 1, '2019-08-17 14:02:22', '2d6fdc2baef262ad3d72cc9d71c3a053.png', 4, 1000000, 'sl', 'sl'),
(8, 14, 1, '2019-08-17 14:02:55', 'b445b724a185d608cfbf314bb2335a40.png', 4, 1000000, 's', 's'),
(10, 15, 1, '2019-08-17 14:53:14', '6b3d905abeb6632924bbc81ea821c535.png', 4, 1500000, 'sl', 'sl'),
(11, 15, 1, '2019-08-17 14:57:28', 'ea2f6621bc65d9c3bff0bae5ba2ecdd5.png', 4, 500000, 'sl', 'p'),
(12, 16, 1, '2019-08-17 14:58:02', 'db81f5fb83be9254cb5b617517f69f6c.png', 4, 2000000, 'sl', 'p'),
(13, 17, 1, '2019-08-17 14:59:24', 'ab57138b5db5dc68b972031340ff40b0.png', 4, 2000000, 'sl', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `detail_rab`
--

CREATE TABLE `detail_rab` (
  `id_detail` int(3) NOT NULL,
  `nama_detail` varchar(50) NOT NULL,
  `id_rab` int(3) NOT NULL,
  `volume` int(3) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `harga_satuan` int(9) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_kelompok` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_rab`
--

INSERT INTO `detail_rab` (`id_detail`, `nama_detail`, `id_rab`, `volume`, `satuan`, `harga_satuan`, `total_harga`, `id_kelompok`) VALUES
(4, 'Tukang Paku', 1, 12, 'M2', 12000, 144000, 1),
(5, 'Pembelian Genteng', 2, 12, 'kardus', 200000, 2400000, 2),
(6, 'beli piring', 1, 20, 'item', 2000, 40000, 5),
(7, 'sertifikat split', 4, 20, 'unit', 2500000, 50000000, 6),
(8, 'IMB Split', 4, 10, 'unit', 190000000, 1900000000, 6),
(9, 'Tukang gali sumur', 9, 10, 'orang', 20000, 200000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `penambahan` varchar(25) DEFAULT NULL,
  `volume` int(3) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `total_harga` int(8) DEFAULT NULL,
  `id_transaksi` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `follow_up`
--

CREATE TABLE `follow_up` (
  `id_follow` int(6) NOT NULL,
  `id_konsumen` int(5) NOT NULL,
  `tgl_follow` date NOT NULL,
  `media` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `hasil_follow` enum('bs','s') NOT NULL,
  `id_user` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow_up`
--

INSERT INTO `follow_up` (`id_follow`, `id_konsumen`, `tgl_follow`, `media`, `keterangan`, `hasil_follow`, `id_user`) VALUES
(1, 4, '2019-10-09', 'Whatsapp', 'masih proses', 'bs', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis` int(1) NOT NULL,
  `jenis_pembayaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis`, `jenis_pembayaran`) VALUES
(1, 'Tanda Jadi'),
(2, 'Uang Muka'),
(3, 'Transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kelompok`
--

CREATE TABLE `kategori_kelompok` (
  `id_kategori` int(1) NOT NULL,
  `nama_kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_kelompok`
--

INSERT INTO `kategori_kelompok` (`id_kategori`, `nama_kategori`) VALUES
(1, 'rab properti'),
(2, 'rab unit'),
(3, 'pengeluaran'),
(4, 'pemasukan');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_item`
--

CREATE TABLE `kelompok_item` (
  `id_kelompok` int(3) NOT NULL,
  `nama_kelompok` varchar(50) NOT NULL,
  `id_user` int(2) NOT NULL,
  `id_kategori` int(1) NOT NULL,
  `status` enum('a','t') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok_item`
--

INSERT INTO `kelompok_item` (`id_kelompok`, `nama_kelompok`, `id_user`, `id_kategori`, `status`) VALUES
(1, 'Pembayaran orang', 1, 1, 'a'),
(2, 'Pembelian Bahan Atap', 1, 2, 'a'),
(3, 'Perbaikan Atap', 1, 3, 'a'),
(4, 'Biaya Tanda Jadi', 1, 4, 'a'),
(5, 'Pembelian Bahan Dapur', 1, 1, 'a'),
(6, 'biaya saran unit', 1, 1, 'a'),
(7, 'Pengembalian DP', 1, 3, 'a'),
(8, 'konsumsi tukang', 1, 3, 'a'),
(9, 'Uang Cicilan', 1, 4, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_persyaratan`
--

CREATE TABLE `kelompok_persyaratan` (
  `id_sasaran` int(2) NOT NULL,
  `nama_kelompok` varchar(50) NOT NULL,
  `kategori_persyaratan` enum('unit','konsumen') NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok_persyaratan`
--

INSERT INTO `kelompok_persyaratan` (`id_sasaran`, `nama_kelompok`, `kategori_persyaratan`, `keterangan`, `status`) VALUES
(1, 'Surat Nikah', 'konsumen', 'untuk data konsumen', '1'),
(3, 'Surat Tanah bangunan', 'unit', 'untuk tanah unit', '1'),
(4, 'KTP', 'konsumen', 'untuk data diri konsumen', '1'),
(5, 'KK', 'konsumen', 'untuk data keluarga', '1');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(5) NOT NULL,
  `id_type` enum('ktp','sim') NOT NULL,
  `id_card` varchar(18) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `jenis_kelamin` enum('l','p') NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `email` varchar(25) NOT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `status_nikah` enum('m','bm') DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `tgl_lahir` varchar(30) DEFAULT NULL,
  `status_rumah` varchar(30) DEFAULT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `telp_perusahaan` varchar(15) DEFAULT NULL,
  `jenis_pekerjaan` varchar(20) DEFAULT NULL,
  `bidang_usaha` varchar(25) DEFAULT NULL,
  `jabatan` varchar(15) DEFAULT NULL,
  `alamat_perusahaan` text,
  `nama_atasan` varchar(100) DEFAULT NULL,
  `telp_atasan` varchar(13) DEFAULT NULL,
  `pendidikan_terakhir` enum('sd','smp','sma','diploma','s1','s2/s3') DEFAULT NULL,
  `status_konsumen` enum('ck','k') DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `nama_pasangan` varchar(50) DEFAULT NULL,
  `hubungan_pasangan` varchar(50) DEFAULT NULL,
  `alamat_pasangan` text,
  `telp_pasangan` varchar(13) DEFAULT NULL,
  `kantor_pasangan` varchar(50) DEFAULT NULL,
  `telp_kantor_pasangan` varchar(13) DEFAULT NULL,
  `pekerjaan_pasangan` varchar(20) DEFAULT NULL,
  `jabatan_pasangan` varchar(15) DEFAULT NULL,
  `alamat_kantor_pasangan` text,
  `bidang_usaha_p` varchar(25) DEFAULT NULL,
  `nama_atasan_p` varchar(20) DEFAULT NULL,
  `telp_atasan_p` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `id_type`, `id_card`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `telp`, `email`, `foto_ktp`, `status_nikah`, `npwp`, `tgl_lahir`, `status_rumah`, `nama_perusahaan`, `telp_perusahaan`, `jenis_pekerjaan`, `bidang_usaha`, `jabatan`, `alamat_perusahaan`, `nama_atasan`, `telp_atasan`, `pendidikan_terakhir`, `status_konsumen`, `id_user`, `tgl_buat`, `nama_pasangan`, `hubungan_pasangan`, `alamat_pasangan`, `telp_pasangan`, `kantor_pasangan`, `telp_kantor_pasangan`, `pekerjaan_pasangan`, `jabatan_pasangan`, `alamat_kantor_pasangan`, `bidang_usaha_p`, `nama_atasan_p`, `telp_atasan_p`) VALUES
(3, 'sim', '88926873585', 'sukirman', 'l', 'jl Pakuniran', '087987654436', 'asd234as@gmail.com', 'd8d2ee6908579f2c2b43947e055bbba6.png', 'm', '21312312', '1999-06-04', NULL, 'PT Indah Sejahtera', '082334647884', 'pns', NULL, 'Manager', 'Jl Pakuniran Bondowoso', 'Julian', '08445367886', 's1', 'k', 4, '2019-08-16 14:29:37', 'Bun Sudi', 'Istri', 'Jl Pakunirans', '082213034132', 'PT Anday Aja', '082337465282', 'wiraswasta', 'Karyawan', 'Jl Anday Saja Ada Jalan', '', 'Daxler', '08445367886'),
(4, 'sim', '435654756745', 'Siti Humairoh', 'l', 'Jl Pakuniran Paiton', '082334283447', 'cobain@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ck', 3, '2019-10-09 21:39:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(4) NOT NULL,
  `nama_pemasukan` varchar(50) NOT NULL,
  `volume` int(3) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga_satuan` int(7) NOT NULL,
  `total_harga` int(7) NOT NULL,
  `bukti_kwitansi` varchar(255) DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `id_properti` int(2) NOT NULL,
  `id_kelompok` int(3) NOT NULL,
  `id_unit` int(3) NOT NULL,
  `tgl_buat` date NOT NULL,
  `status_owner` enum('s','p','sl') NOT NULL,
  `status_manager` enum('s','p','sl') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `nama_pemasukan`, `volume`, `satuan`, `harga_satuan`, `total_harga`, `bukti_kwitansi`, `id_user`, `id_properti`, `id_kelompok`, `id_unit`, `tgl_buat`, `status_owner`, `status_manager`) VALUES
(1, 'percobaan', 8, 'M2', 200000, 1600000, NULL, 4, 2, 4, 3, '2019-07-23', 'sl', 's'),
(2, 'percobaan', 10, 'M3', 200000, 2000000, NULL, 4, 7, 4, 12, '2019-08-28', 's', 's'),
(3, 'Pembayaran KPR dari BANK BRI', 1, 'rumah', 130000000, 130000000, '8461a62197cbc1d0ce8d3d20445ec312.jpg', 4, 7, 9, 12, '2019-09-04', 'p', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(6) NOT NULL,
  `id_transaksi` int(4) NOT NULL,
  `nama_pembayaran` varchar(25) NOT NULL,
  `total_tagihan` int(9) NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `total_bayar` int(9) DEFAULT NULL,
  `hutang` int(9) NOT NULL,
  `status` enum('s','b','sb') NOT NULL,
  `jenis_pembayaran` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `nama_pembayaran`, `total_tagihan`, `jatuh_tempo`, `total_bayar`, `hutang`, `status`, `jenis_pembayaran`) VALUES
(14, 1, 'Tanda Jadi', 5000000, '2019-08-16', 5000000, 0, 'sb', 1),
(15, 1, 'Angsuran 1', 2000000, '2019-09-17', 2000000, 0, 'sb', 2),
(16, 1, 'Angsuran 2', 2000000, '2019-10-17', 2000000, 0, 'sb', 2),
(17, 1, 'Angsuran 3', 2000000, '2019-11-17', 2000000, 0, 'sb', 2),
(18, 1, 'kpr', 124000000, '2019-08-18', 0, 124000000, 'b', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(4) NOT NULL,
  `nama_pengeluaran` varchar(50) NOT NULL,
  `volume` int(3) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga_satuan` int(7) NOT NULL,
  `total_harga` int(7) NOT NULL,
  `bukti_kwitansi` varchar(255) DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `id_properti` int(2) NOT NULL,
  `id_unit` int(3) NOT NULL,
  `id_kelompok` int(3) NOT NULL,
  `tgl_buat` date NOT NULL,
  `status_owner` enum('s','p','sl') NOT NULL,
  `status_manager` enum('s','p','sl') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `nama_pengeluaran`, `volume`, `satuan`, `harga_satuan`, `total_harga`, `bukti_kwitansi`, `id_user`, `id_properti`, `id_unit`, `id_kelompok`, `tgl_buat`, `status_owner`, `status_manager`) VALUES
(1, 'biaya tukang rumah', 6, 'M2', 200000, 1200000, '62477097699ca26667d532125115e5a3.png', 4, 2, 1, 3, '2019-07-23', 'sl', 's'),
(2, 'Kembalikan DP spr ', 1, 'transaksi', 0, 0, '', 1, 2, 3, 7, '2019-08-14', 'sl', 'sl'),
(3, 'Kembalikan DP spr 200927-', 1, 'transaksi', 0, 900000000, '', 1, 7, 10, 7, '2019-08-14', 's', 's'),
(4, 'makan siang tukang', 20, 'nasi', 5000, 100000, '5cef5c0564e4c220a5f296cc9d75aa51.png', 4, 7, 12, 8, '2019-08-15', 'sl', 's'),
(5, 'makan malam tukang', 20, 'pecel', 6000, 120000, '12236c3a8fd270f54c2f93a542b8f670.png', 4, 7, 12, 8, '2019-08-15', 'p', 'p'),
(6, 'makan bersama nasi pecel + minum', 30, 'orang', 5000, 150000, '2b5be9c4824ebf9b4076e37687b02b9d.png', 4, 7, 12, 8, '2019-08-16', 'p', 'p'),
(9, 'makan malam tukang', 10, 'pecel', 8500, 85000, '00a5ec3fa0d0e249eaa9eeb2291246b2.png', 4, 7, 10, 8, '2019-08-24', 'p', 'sl'),
(10, 'makan siangtukang', 12, 'pecel', 7000, 84000, 'c1b761d0cc27f2ffcd29f18fa190140d.png', 4, 7, 10, 8, '2019-08-24', 'sl', 'sl');

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_konsumen`
--

CREATE TABLE `persyaratan_konsumen` (
  `id_persyaratan` int(7) NOT NULL,
  `kelompok_persyaratan` int(2) NOT NULL,
  `id_konsumen` int(4) NOT NULL,
  `id_user` int(2) NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persyaratan_konsumen`
--

INSERT INTO `persyaratan_konsumen` (`id_persyaratan`, `kelompok_persyaratan`, `id_konsumen`, `id_user`, `file`) VALUES
(1, 1, 3, 0, '29bcdf9db9fbd92e089b605ea8a2210f.pdf'),
(4, 5, 3, 4, 'de57eddbcbb5c0e96ed1e7db4793f275.pdf'),
(5, 4, 3, 4, 'a7416aa07ddd56e974313ce82c1da200.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_unit`
--

CREATE TABLE `persyaratan_unit` (
  `id_persyaratan` int(7) NOT NULL,
  `kelompok_persyaratan` int(3) DEFAULT NULL,
  `id_unit` int(3) DEFAULT NULL,
  `id_user` int(2) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persyaratan_unit`
--

INSERT INTO `persyaratan_unit` (`id_persyaratan`, `kelompok_persyaratan`, `id_unit`, `id_user`, `file`) VALUES
(2, 3, 73, 4, 'b09f35733ed6113fc0babbc2b33fd92c.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(1) NOT NULL,
  `siup` varchar(25) NOT NULL,
  `tanda_daftar_perusahaan` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `logo_perusahaan` varchar(255) DEFAULT NULL,
  `file_profile` varchar(255) DEFAULT NULL,
  `pemilik` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `siup`, `tanda_daftar_perusahaan`, `nama`, `alamat`, `email`, `telepon`, `logo_perusahaan`, `file_profile`, `pemilik`) VALUES
(1, '232342', '324234', 'Developer', 'Terserah Anda', 'lucky@gmail.com', '082553674553', 'b33a7d36a2269950ef290010024c1b4e.png', NULL, 'Syaifuddin');

-- --------------------------------------------------------

--
-- Table structure for table `properti`
--

CREATE TABLE `properti` (
  `id_properti` int(2) NOT NULL,
  `nama_properti` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `luas_tanah` int(5) NOT NULL,
  `satuan_tanah` varchar(10) NOT NULL,
  `jumlah_unit` int(5) NOT NULL,
  `rekening` int(2) NOT NULL,
  `logo_properti` varchar(255) DEFAULT NULL,
  `foto_properti` varchar(255) DEFAULT NULL,
  `tgl_buat` date NOT NULL,
  `status` enum('publish','non-publish') NOT NULL,
  `setting_spr` text,
  `id_user` int(2) NOT NULL,
  `id_rab` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properti`
--

INSERT INTO `properti` (`id_properti`, `nama_properti`, `alamat`, `luas_tanah`, `satuan_tanah`, `jumlah_unit`, `rekening`, `logo_properti`, `foto_properti`, `tgl_buat`, `status`, `setting_spr`, `id_user`, `id_rab`) VALUES
(2, 'PERUMAHAN SUFAH PERMAI', 'terserah', 10, 'm2', 9, 1, 'default2.jpg', 'default.jpg', '2019-07-29', 'publish', '<p>Penyerahan tanah dan/ bangunan tanggal Untuk pemesanan tersebut diatas maka dengan ini<br />&nbsp;&nbsp;&nbsp; Pemesan menyetujui ketentuan-ketentuan sebagai berikut :</p><p>I. Membayar uang muka pada tanggal 26 Oktober 2016 sebesar <strong><em>Rp. 15.000.000<br />&nbsp;&nbsp;&nbsp;&nbsp; ( Lima belas juta rupiah)</em></strong></p><p>II. Membayar uang muka pada tanggal 27 November 2016 sebesar <strong><em>Rp. 45.000.000<br />&nbsp;&nbsp;&nbsp;&nbsp; ( Empat puluh lima juta rupiah)</em></strong></p><p>III. Membayar uang muka pada tanggal 19 Desember 2016 sebesar <strong><em>Rp.10.000.000,-<br />&nbsp;&nbsp;&nbsp;&nbsp; (Sepuluh juta rupiah)</em></strong></p><p><strong><em>IV. </em></strong>Membayar uang muka pada tanggal 5 Januari 2017 sebesar <strong><em>Rp.10.000.000,-<br />&nbsp;&nbsp;&nbsp;&nbsp; (Sepuluh juta rupiah)</em></strong></p><p>V. Sisa pembayaran sebesar <strong><em>Rp.40.000.000,00</em></strong> <strong><em>( Empat puluh juta rupiah)</em></strong></p><p>VI. Menandatangani Surat Perjanjian Pengikat Jual Beli Tanah dan/atau bangunan, dalam waktu maksimal 21 (Dua Puluh Satu ) Hari setelah tanggal Surat Pemesanan ini.</p><p>VII. Apabila kemudian ternyata pemesan tidak bersedia/tidak mau menandatangani Surat Perjanjian Pengikat Jual Beli Tanah dan/atau Bangunan dimaksud pada butir IV, maka pemesanan ini menjadi batal, oleh karenanya berlaku ketentuan pada butir VIII.</p><p>VIII. Apabila Pemesan dalam membayar harga tanah dan/atau bangunan mempergunakan fasilitas KPR dari Bank/Lembaga Keuangan, maka pemesan harus menandatangani Surat Perjanjian&nbsp;Pengikat Jual Beli Tanah dan/atau Bangunan selambat-lambatnya 2 (dua) Minggu sejak tanggal Pemesanan ini.</p><p>IX. Apabila saatnya akan diadakan wawancara oleh pihak Bank/Lembaga Keuangan atau&nbsp;apabila telah mendapat persetujuan kredit dari Bank/Lembaga Keuangan, pemesan tidak melaksanakannya walaupun sudah diberitahu 3 (tiga) kali baik lisan maupun tertulis, maka pemesanan ini menjadi batal, oleh karenanya akan berlaku ketentuan pada butir VIII.</p><p>X. Apabila pemesanan ini menjadi batal oleh sebab apapun, sedangkan Pemesan telah<br />membayar sejumlah uang, baik tanda jadi maupun uang muka untuk pemesanan tanah dan/atau bangunan, maka pemesanan ini menjadi batal dan uang yang telah dibayar oleh pemesan untuk pemesanan tanah dan/atau bangunan dimaksud tidak boleh dikembalikan (hangus). Selanjutnya tanah dan/atau bangunan dimaksud menjadi hak sepenuhnya pengembang kavling tanah dan unit rumah.</p><p>XI. Apabila permohonan KPR dari Pemesan ditolak oleh seluruh Bank/Lembaga keuangan yang dibuktikan dengan Surat Penolakan, maka uang yang sudah dibayarkan akan dikembalikan kepada Pemesan setelah dipotong biaya administrasi <strong><em>Rp. 1.000.000,-</em></strong> (Satu Juta Rupiah). Tetapi apabila permohonan KPR yang disetujui tidak sesuai dengan &nbsp;jumlah yang dimohon (terjadi penurunan Plafond Kredit), maka pemesan wajib menambah uang muka kepada Pengembang. Pemesan diperbolehkan merubah cara pembayaran dari KPR menjadi cash bertahap ke developer karena penolakan KPR dengan ketentuan besarnya harga yang diberlakukan adalah harga yang berlaku pada saat terjadi perubahan.</p><p>XII. &nbsp;Apabila Pemesan Lalai/terlambat melakukan pembayaran sesuai dengan ketentuan pada butir III maka akan dikenakan denda sebesar 3 % (tiga persen) perbulan dari jumlah yang harus dibayar/terutang dan apabila kelalaian/keterlambatan tersebut sampai dengan 3 (tiga) bulan berturut-turut sejak tanggal terutang, maka pemesanan ini menjadi batal dan oleh karenanya akan berlaku ketentuan pada butir VIII.</p><p>XIII. Pembayaran yang dilakukan cek/giro apabila dikemudian ditolak oleh Bank yang bersangkutan, maka Pemesan dikenai biaya administrasi sebesar <strong><em>Rp. 100.000,-</em></strong> (seratus ribu rupiah) dan dikenakan denda sesuai dengan ketentuan pada butir X.</p><p>XIV. Apabila Pemesan membayar harga tanah dan/atau bangunan dengan cara mengangsur melalui developer, maka apabila sewaktu-waktu developer menghendaki, Pemesan bersedia untuk dipindahkan pembayaran angsuran harganya melalui Bank/Lembaga keuangan yang ditunjuk oleh developer, dengan ketentuan yang sama dengan pengurusan KPR sebelumnya.</p><p>XIIV. Khusus untuk pembelian tanah dan/atau bangunan dilokasi sudut (Hock) atau dengan bentuk ireguler, maka apabila tanah dan/atau bangunan yang telah dipesan berbeda dengan yang telah ditentukan oleh instansi yang berwenang (kelebihan/kekurangan) diadakan perhitungan ulang dengan berdasarkan harga tanah dan bangunan yang berlaku pada saat penandatanganan Surat Pemesanan ini.</p><p>XIIIV. Surat Pemesanan ini merupakan satu kesatuan yang tidak dapat dipisahkan dengan Surat Perjanjian Pengikatan Jual Beli Tanah dan/ atau bangunan, yang telah atau akan ditandatangani. Selanjutnya apabila Surat Perjanjian Pengikatan Jual Beli dimaksud sudah ditandatangani oleh pemesan, maka ketentuan yang berlaku untuk jual beli tanah dan/atau bangunan dimaksud adalah seperti yang diatur Dalam Surat Pengikatan Jual Beli. Demikian Surat Ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.</p><p>Guyangan, ......................................</p>', 1, NULL),
(6, 'cobain', 'terserah', 12, 'hektar', 12, 1, NULL, '932d6425f2d3f34a7a7cf2c2e67946a7.png', '2019-07-13', 'publish', '<p>terserah</p>', 1, NULL),
(7, 'sufah permai 2', 'Dsn.Sambiroto Ds.Sambiroto Kec.Baron Kab.Nganjuk', 6430, 'meter2', 65, 1, NULL, 'ad474fe0f5b156e373eeed6a0a217802.png', '2019-08-09', 'publish', '<p>&nbsp;</p><p>I.&nbsp;&nbsp; Penyerahan sertifikat setelah pembayaran lunas.</p><p>&nbsp;</p><p>II. Menandatangani Surat Perjanjian Pengikat Jual Beli Tanah kavling, dalam waktu maksimal<br />&nbsp;&nbsp;&nbsp;&nbsp; 4 ( Empat ) Hari setelah tanggal Surat Pemesanan ini.</p><p>&nbsp;</p><p>III. Siap membayar denda 1 % perhari dari angsuran yang ditentukan oleh pihak sufah permai<br />&nbsp;&nbsp;&nbsp;&nbsp; apabila terjadi keterlambatan dalam pembayaran angsuran setiap bulannya.</p><p>&nbsp;</p><p>IV. Apabila terjadi keterlambatan selama 3 kali angsuran berturut-turut maka pembeli siap<br />&nbsp;&nbsp;&nbsp; menyerahkan tanah beserta bangunan kepada Devloper (Syaifudin) untuk dilelang.</p><p>&nbsp;</p><p>V.&nbsp; Pembayaran dilakukan melalui rekening yang telah ditentukan Devloper.</p><p>&nbsp;</p><p>VI. Selanjutnya apabila Surat Perjanjian Pengikatan Jual Beli dimaksud sudah ditandatangani oleh pembeli, maka ketentuan yang berlaku untuk jual beli tanah dan/atau bangunan dimaksud adalah seperti yang diatur Dalam Surat Pengikatan Jual Beli. Demikian Surat Ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.</p><p>&nbsp;</p>', 1, NULL),
(8, 'percobaan', 'jl pakuniran', 12, 'm2', 12, 1, NULL, 'default.jpg', '2019-08-22', 'publish', '', 1, NULL),
(10, 'Sufah Permai 3', 'Jl Panglima Sudirman , Nganjuk', 100, 'm2', 12, 1, NULL, '8fd8821de3457290b03214733dbd80c7.jpg', '2019-08-22', 'publish', '', 1, NULL),
(12, 'Sufah Permai 4', 'Jl Pakuniran Nganjuk', 500, 'M2', 2000000, 1, NULL, 'default.jpg', '2019-08-22', 'publish', '', 1, NULL),
(13, 'Properti 1', 'Terserah', 10, 'm2', 12, 1, NULL, '39b596df0f696902191e58e4f42b3d85.jpg', '2019-10-05', 'publish', '<p>hehe</p>', 1, NULL),
(14, 'Properti 2', 'terserah', 12, 'm3', 12, 1, NULL, '66ebd94f7da7887a8b468519fb254e55.jpg', '2019-10-05', 'publish', '<p>geesadf</p>', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rab_properti`
--

CREATE TABLE `rab_properti` (
  `id_rab` int(3) NOT NULL,
  `nama_rab` varchar(50) NOT NULL,
  `type` enum('p','u') NOT NULL,
  `tgl_buat` date NOT NULL,
  `total_anggaran` int(11) DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `id_properti` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rab_properti`
--

INSERT INTO `rab_properti` (`id_rab`, `nama_rab`, `type`, `tgl_buat`, `total_anggaran`, `id_user`, `id_properti`) VALUES
(1, 'RAB Cobain', 'p', '2019-07-13', 184000, 1, 6),
(2, 'RAB Unit Cobain', 'u', '2019-07-13', 2400000, 1, 6),
(3, 'Perumahan permai', 'u', '2019-08-09', 0, 1, 2),
(4, 'sufah permai 2', 'p', '2019-08-09', 1950000000, 1, 7),
(5, 'Sufah Permai 3', 'p', '2019-08-22', 0, 1, 10),
(6, 'Sufah Permai 3', 'u', '2019-08-22', 0, 1, 10),
(7, 'percobaan', 'p', '2019-08-22', 0, 1, 8),
(8, 'percobaan', 'u', '2019-08-22', 0, 1, 8),
(9, 'Sufah Permai 4', 'p', '2019-08-22', 200000, 1, 12),
(10, 'Sufah Permai 4', 'u', '2019-08-22', 0, 1, 12),
(11, 'sufah permai 2', 'u', '2019-08-09', 0, 1, 7),
(12, 'Properti 1', 'p', '2019-10-05', 0, 1, 13),
(13, 'Properti 1', 'u', '2019-10-05', 0, 1, 13),
(14, 'Properti 2', 'p', '2019-10-05', 0, 1, 14),
(15, 'Properti 2', 'u', '2019-10-05', 0, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `rekening_properti`
--

CREATE TABLE `rekening_properti` (
  `id_rekening` int(1) NOT NULL,
  `no_rekening` varchar(16) NOT NULL,
  `bank` varchar(10) NOT NULL,
  `pemilik` varchar(25) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening_properti`
--

INSERT INTO `rekening_properti` (`id_rekening`, `no_rekening`, `bank`, `pemilik`, `status`) VALUES
(1, '1560087656538', 'BRI', 'owner', '1'),
(2, '231029398098', 'BRI', 'SALMAN AL FARISI', '1'),
(3, '231029398098', 'BRI', 'SALMAN AL FARISI', '0');

-- --------------------------------------------------------

--
-- Table structure for table `role_access`
--

CREATE TABLE `role_access` (
  `id` int(4) NOT NULL,
  `id_role` int(1) NOT NULL,
  `id_controller` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_access`
--

INSERT INTO `role_access` (`id`, `id_role`, `id_controller`) VALUES
(1, 1, 5),
(2, 1, 23),
(3, 1, 24),
(4, 4, 18),
(5, 3, 18),
(6, 4, 19),
(7, 3, 19),
(8, 1, 6),
(9, 1, 7),
(10, 1, 1),
(11, 3, 16),
(12, 1, 12),
(13, 3, 12),
(14, 1, 10),
(15, 2, 10),
(16, 3, 10),
(17, 1, 25),
(18, 1, 14),
(19, 1, 26),
(20, 1, 13),
(21, 2, 13),
(22, 3, 13),
(23, 1, 9),
(24, 3, 9),
(25, 2, 9),
(26, 4, 9),
(27, 1, 8),
(28, 2, 8),
(29, 1, 27),
(30, 3, 22),
(31, 3, 20),
(32, 3, 21),
(33, 1, 28),
(34, 3, 29),
(35, 1, 2),
(36, 1, 3),
(37, 1, 4),
(38, 2, 4),
(39, 1, 30),
(40, 3, 17),
(41, 4, 17),
(42, 2, 15),
(43, 1, 31),
(44, 2, 31),
(45, 3, 31),
(46, 4, 31),
(47, 2, 32),
(48, 2, 33);

-- --------------------------------------------------------

--
-- Table structure for table `surat_akta_rumah`
--

CREATE TABLE `surat_akta_rumah` (
  `id_akta` tinyint(2) NOT NULL,
  `nama_akta` varchar(25) NOT NULL,
  `isi_akta` text NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_berita_acara`
--

CREATE TABLE `surat_berita_acara` (
  `id_berita_acara` smallint(6) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_surat` tinyint(4) NOT NULL,
  `tgl_buat` date NOT NULL,
  `id_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_konsumen`
--

CREATE TABLE `surat_konsumen` (
  `id_surat_konsumen` int(11) NOT NULL,
  `id_surat` tinyint(3) NOT NULL,
  `isi_surat` int(11) NOT NULL,
  `id_konsumen` mediumint(9) NOT NULL,
  `tambahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_perumahan`
--

CREATE TABLE `surat_perumahan` (
  `id_surat_perumahan` tinyint(2) NOT NULL,
  `id_surat` tinyint(3) NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `tgl_buat` date NOT NULL,
  `id_properti` smallint(6) NOT NULL,
  `tambahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_surat`
--

CREATE TABLE `surat_surat` (
  `id_surat` tinyint(3) NOT NULL,
  `nama_surat` varchar(100) NOT NULL,
  `sifat` varchar(25) NOT NULL,
  `hal` varchar(255) NOT NULL,
  `isi_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_detail_pembayaran`
-- (See below for the actual view)
--
CREATE TABLE `tbl_detail_pembayaran` (
`id_detail` int(5)
,`id_pembayaran` int(6)
,`nama_pembayaran` varchar(25)
,`id_properti` int(2)
,`nama_properti` varchar(50)
,`id_unit` int(3)
,`nama_unit` varchar(25)
,`total_bayar` int(9)
,`hutang` int(9)
,`id_rekening` int(1)
,`no_rekening` varchar(16)
,`bank` varchar(10)
,`tgl_bayar` datetime
,`bukti_bayar` varchar(255)
,`id_user` int(2)
,`nama_lengkap` varchar(25)
,`jumlah_bayar` int(9)
,`status_owner` enum('s','p','sl')
,`status_manager` enum('s','p','sl')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_detail_rab`
-- (See below for the actual view)
--
CREATE TABLE `tbl_detail_rab` (
`id_detail` int(3)
,`nama_detail` varchar(50)
,`id_rab` int(3)
,`volume` int(3)
,`satuan` varchar(15)
,`harga_satuan` int(9)
,`total_harga` int(11)
,`id_kelompok` int(3)
,`kelompok_pengeluaran` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_follow`
-- (See below for the actual view)
--
CREATE TABLE `tbl_follow` (
`id_follow` int(6)
,`id_konsumen` int(5)
,`nama_lengkap` varchar(25)
,`tgl_follow` date
,`media` varchar(15)
,`keterangan` text
,`hasil_follow` enum('bs','s')
,`id_user` int(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_item`
-- (See below for the actual view)
--
CREATE TABLE `tbl_item` (
`id_kelompok` int(3)
,`nama_kelompok` varchar(50)
,`id_user` int(2)
,`id_kategori` int(1)
,`nama_kategori` varchar(15)
,`status` enum('a','t')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_pemasukan`
-- (See below for the actual view)
--
CREATE TABLE `tbl_pemasukan` (
`id_pemasukan` int(4)
,`nama_pemasukan` varchar(50)
,`volume` int(3)
,`satuan` varchar(10)
,`harga_satuan` int(7)
,`total_harga` int(7)
,`bukti_kwitansi` varchar(255)
,`id_user` int(2)
,`nama_lengkap` varchar(25)
,`id_properti` int(2)
,`nama_properti` varchar(50)
,`id_unit` int(3)
,`nama_unit` varchar(25)
,`id_kelompok` int(3)
,`nama_kelompok` varchar(50)
,`tgl_buat` date
,`status_owner` enum('s','p','sl')
,`status_manager` enum('s','p','sl')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_pembayaran`
-- (See below for the actual view)
--
CREATE TABLE `tbl_pembayaran` (
`id_pembayaran` int(6)
,`id_transaksi` int(4)
,`id_unit` int(3)
,`nama_unit` varchar(25)
,`id_properti` int(2)
,`nama_properti` varchar(50)
,`nama_pembayaran` varchar(25)
,`total_tagihan` int(9)
,`jatuh_tempo` date
,`total_bayar` int(9)
,`hutang` int(9)
,`status` enum('s','b','sb')
,`jenis_pembayaran` int(1)
,`nama_jenis` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_pengeluaran`
-- (See below for the actual view)
--
CREATE TABLE `tbl_pengeluaran` (
`id_pengeluaran` int(4)
,`nama_pengeluaran` varchar(50)
,`volume` int(3)
,`satuan` varchar(10)
,`harga_satuan` int(7)
,`total_harga` int(7)
,`bukti_kwitansi` varchar(255)
,`id_user` int(2)
,`nama_lengkap` varchar(25)
,`id_properti` int(2)
,`nama_properti` varchar(50)
,`id_unit` int(3)
,`nama_unit` varchar(25)
,`id_kelompok` int(3)
,`nama_kelompok` varchar(50)
,`tgl_buat` date
,`status_owner` enum('s','p','sl')
,`status_manager` enum('s','p','sl')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_properti`
-- (See below for the actual view)
--
CREATE TABLE `tbl_properti` (
`id_properti` int(2)
,`nama_properti` varchar(50)
,`luas_tanah` int(5)
,`satuan_tanah` varchar(10)
,`jumlah_unit` int(5)
,`rekening` int(2)
,`no_rekening` varchar(16)
,`bank` varchar(10)
,`logo_properti` varchar(255)
,`foto_properti` varchar(255)
,`tgl_buat` date
,`status` enum('publish','non-publish')
,`id_user` int(2)
,`setting_spr` text
,`id_rab` int(3)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_rab`
-- (See below for the actual view)
--
CREATE TABLE `tbl_rab` (
`id_detail` int(3)
,`nama_detail` varchar(50)
,`id_rab` int(3)
,`volume` int(3)
,`satuan` varchar(15)
,`harga_satuan` int(9)
,`total_harga` int(11)
,`id_kelompok` int(3)
,`kelompok_pengeluaran` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_role_access`
-- (See below for the actual view)
--
CREATE TABLE `tbl_role_access` (
`id` int(4)
,`id_role` int(1)
,`id_controller` int(2)
,`controller_name` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `tbl_transaksi` (
`id_transaksi` int(4)
,`no_spr` varchar(25)
,`id_konsumen` int(5)
,`nama_lengkap` varchar(25)
,`id_unit` int(3)
,`nama_unit` varchar(25)
,`id_properti` int(2)
,`nama_properti` varchar(50)
,`tgl_transaksi` date
,`total_kesepakatan` int(9)
,`total_tanda_jadi` int(8)
,`total_uang_muka` int(9)
,`total_cicilan` int(9)
,`total_tambahan` int(9)
,`id_type` int(1)
,`type_bayar` varchar(10)
,`periode_uang_muka` int(2)
,`periode_cicilan` int(2)
,`kunci` enum('l','u')
,`status_transaksi` enum('s','p','sl')
,`tgl_tanda_jadi` date
,`tanda_jadi` enum('tidak_masuk','masuk')
,`tgl_uang_muka` date
,`tgl_cicilan` date
,`sp3k` varchar(255)
,`id_user` int(2)
,`pembuat` varchar(25)
,`status_tj` enum('bs','s')
,`status_um` enum('bs','s')
,`status_ccl` enum('bs','s')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_unit`
-- (See below for the actual view)
--
CREATE TABLE `tbl_unit` (
`id_unit` int(3)
,`nama_unit` varchar(25)
,`id_properti` int(2)
,`nama_properti` varchar(50)
,`type` varchar(10)
,`luas_tanah` int(5)
,`satuan_tanah` varchar(10)
,`luas_bangunan` int(5)
,`satuan_bangunan` varchar(10)
,`harga_unit` int(10)
,`foto_unit` varchar(255)
,`alamat_unit` text
,`tgl_buat` date
,`status_unit` enum('bt','b','t')
,`id_user` int(2)
,`deskripsi` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_users`
-- (See below for the actual view)
--
CREATE TABLE `tbl_users` (
`id_user` int(2)
,`nama_lengkap` varchar(25)
,`Email` varchar(25)
,`no_hp` varchar(13)
,`status_user` enum('aktif','nonaktif')
,`id_akses` int(1)
,`akses` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tbl_user_assign_properti`
-- (See below for the actual view)
--
CREATE TABLE `tbl_user_assign_properti` (
`id_assign` int(2)
,`id_properti` int(2)
,`nama_properti` varchar(50)
,`foto_properti` varchar(255)
,`alamat` text
,`id_user` int(2)
,`nama_lengkap` varchar(25)
,`akses` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(4) NOT NULL,
  `no_spr` varchar(25) NOT NULL,
  `id_konsumen` int(5) NOT NULL,
  `id_unit` int(3) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_kesepakatan` int(9) NOT NULL,
  `total_tanda_jadi` int(8) NOT NULL,
  `tanda_jadi` enum('tidak_masuk','masuk') NOT NULL,
  `total_uang_muka` int(9) NOT NULL,
  `total_cicilan` int(9) NOT NULL,
  `total_tambahan` int(9) DEFAULT NULL,
  `type_bayar` int(1) NOT NULL,
  `periode_uang_muka` int(2) NOT NULL,
  `periode_cicilan` int(2) NOT NULL,
  `kunci` enum('l','u') NOT NULL,
  `status_transaksi` enum('s','p','sl') NOT NULL,
  `tgl_tanda_jadi` date NOT NULL,
  `tgl_uang_muka` date NOT NULL,
  `tgl_cicilan` date NOT NULL,
  `sp3k` varchar(255) DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `status_tj` enum('bs','s') NOT NULL,
  `status_um` enum('bs','s') NOT NULL,
  `status_ccl` enum('bs','s') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_spr`, `id_konsumen`, `id_unit`, `tgl_transaksi`, `total_kesepakatan`, `total_tanda_jadi`, `tanda_jadi`, `total_uang_muka`, `total_cicilan`, `total_tambahan`, `type_bayar`, `periode_uang_muka`, `periode_cicilan`, `kunci`, `status_transaksi`, `tgl_tanda_jadi`, `tgl_uang_muka`, `tgl_cicilan`, `sp3k`, `id_user`, `status_tj`, `status_um`, `status_ccl`) VALUES
(1, '880278648776', 3, 12, '2019-08-17', 130000000, 5000000, 'tidak_masuk', 6000000, 124000000, 0, 3, 3, 12, 'u', 'p', '2019-08-16', '2019-08-17', '2019-08-18', 'ea67bd7ffc505b0bc3a5eb2c682178eb.pdf', 3, 's', 's', 'bs');

-- --------------------------------------------------------

--
-- Table structure for table `type_bayar`
--

CREATE TABLE `type_bayar` (
  `id_type_bayar` int(1) NOT NULL,
  `type_bayar` varchar(10) NOT NULL,
  `jenis_pembayaran` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_bayar`
--

INSERT INTO `type_bayar` (`id_type_bayar`, `type_bayar`, `jenis_pembayaran`) VALUES
(1, 'cicilan', 3),
(2, 'tunai', 3),
(3, 'kpr', 3);

-- --------------------------------------------------------

--
-- Table structure for table `type_id_card`
--

CREATE TABLE `type_id_card` (
  `id_type` tinyint(2) NOT NULL,
  `nama_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(3) NOT NULL,
  `nama_unit` varchar(25) NOT NULL,
  `id_properti` int(2) NOT NULL,
  `type` varchar(10) NOT NULL,
  `luas_tanah` int(5) NOT NULL,
  `satuan_tanah` varchar(10) NOT NULL,
  `luas_bangunan` int(5) NOT NULL,
  `satuan_bangunan` varchar(10) NOT NULL,
  `harga_unit` int(10) NOT NULL,
  `foto_unit` varchar(255) NOT NULL,
  `alamat_unit` text NOT NULL,
  `tgl_buat` date NOT NULL,
  `status_unit` enum('bt','b','t') NOT NULL,
  `id_user` int(2) NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `nama_unit`, `id_properti`, `type`, `luas_tanah`, `satuan_tanah`, `luas_bangunan`, `satuan_bangunan`, `harga_unit`, `foto_unit`, `alamat_unit`, `tgl_buat`, `status_unit`, `id_user`, `deskripsi`) VALUES
(1, 'A44', 2, '312', 20, 'm2', 30, 'm2', 130000000, '33089d806c815f9d1820147145a18cc0.png', 'terserah anda ya', '2019-07-14', 'b', 2, 'hehehe'),
(3, 'A44', 2, '312', 20, 'm2', 30, 'm2', 130000000, '19cc9999f9f461ab77ad89e1631f1df5.png', 'terserah anda ya', '2019-07-14', 't', 2, 'hehehe'),
(5, 'PSP1', 2, '36x60', 60, 'm2', 30, 'm2', 130000000, 'default.jpg', 'terserah anda dulu', '2019-07-15', 'b', 2, 'fasilitas air'),
(6, 'PSP2', 2, '36x60', 60, 'm2', 30, 'm2', 130000000, 'default.jpg', 'terserah anda dulu', '2019-07-15', 'b', 2, 'fasilitas air s'),
(7, 'K1', 2, '36x60', 60, 'm2', 30, 'm2', 130000000, 'default.jpg', 'Jl Pakuniran', '2019-08-08', 'bt', 2, 'Air Tandon'),
(8, 'K2', 2, '36x60', 60, 'm2', 30, 'm2', 130000000, 'default.jpg', 'Jl Pakuniran', '2019-08-08', 'bt', 2, 'Air Tandon'),
(9, 'K3', 2, '36x60', 60, 'm2', 30, 'm2', 130000000, 'default.jpg', 'Jl Pakuniran', '2019-08-08', 'bt', 2, 'Air Tandon'),
(10, 'AP1', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(11, 'AP2', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(12, 'AP3', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'b', 5, 'Air bersih'),
(13, 'AP4', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(14, 'AP5', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'b', 5, 'Air bersih'),
(15, 'AP6', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(16, 'AP7', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(17, 'AP8', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(18, 'AP9', 7, '36x60', 60, 'm2', 32, 'm2', 130000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(19, 'AP10', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(20, 'AP11', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(21, 'AP12', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(22, 'AP13', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(23, 'AP14', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(24, 'AP15', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(25, 'AP16', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(26, 'AP17', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(27, 'AP18', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(28, 'AP19', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(29, 'AP20', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(30, 'AP21', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(31, 'AP22', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(32, 'AP23', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(33, 'AP24', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(34, 'AP25', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(35, 'AP26', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(36, 'AP27', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(37, 'AP28', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(38, 'AP29', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(39, 'AP30', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(40, 'AP31', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(41, 'AP32', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(42, 'AP33', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(43, 'AP34', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(44, 'AP35', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(45, 'AP36', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(46, 'AP37', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(47, 'AP38', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(48, 'AP39', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(49, 'AP40', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(50, 'AP41', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(51, 'AP42', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(52, 'AP43', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(53, 'AP44', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(54, 'AP45', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(55, 'AP46', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(56, 'AP47', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(57, 'AP48', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(58, 'AP49', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(59, 'AP50', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(60, 'AP51', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(61, 'AP52', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(62, 'AP53', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(63, 'AP54', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(64, 'AP55', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(65, 'AP56', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(66, 'AP57', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(67, 'AP58', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(68, 'AP59', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(69, 'AP60', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(70, 'AP61', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(71, 'AP62', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(72, 'AP63', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakuniran', '2019-08-09', 'bt', 5, 'Air bersih'),
(73, 'AP64', 7, '36x60', 60, 'm2', 32, 'm2', 120000000, 'default.jpg', 'Jl Pakunirans', '2019-08-19', 'bt', 4, 'Air bersih'),
(74, 'A2', 14, '36/60', 200, 'm3', 200, 'm3', 150000000, '9b4e9857ac2b17e4aa3d81db1c6b9624.png', 'JL Pakuniran Kec Nganjuk', '2019-10-06', 'bt', 2, 'lorem ipsum terserah anda dulu ya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(2) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `alamat` text,
  `email` varchar(25) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_akses` int(1) NOT NULL,
  `foto_user` varchar(255) DEFAULT NULL,
  `tanggal_buat` date NOT NULL,
  `status_user` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `email`, `no_hp`, `username`, `password`, `id_akses`, `foto_user`, `tanggal_buat`, `status_user`) VALUES
(1, 'salman', 'laki-laki', 'terserah saya', 'lucky@gmail.com', '0822130348278', 'owner', '$2y$10$R9lES7t5WM40OjHB.tJy2ewkvBR43qfgpa6voY6YhzQizGFimH69u', 1, '7e8c51769552468d75706ffea38af146.png', '2019-07-10', 'aktif'),
(2, 'manager', 'laki-laki', 'terserah anda', 'luccyfavos@gmail.com', '082213034156', 'manager', '$2y$10$RQqGrbK/wDiYB0oH0yrvjuPcYhVGBYsE4dSs.nUg85y7Ue/ftRUP2', 2, '4c40493691162a4986f55f4fec4dc0c7.png', '0000-00-00', 'aktif'),
(3, 'marketing', 'laki-laki', 'Jl Pakuniran No 25 Jmber', 'luckyky@gmail.com', '087655893736', 'marketing', '$2y$10$CG8BdpxJVvhOr6hDicQEfO6OpS34RSi2sZD1sMdfQSoGUVDr/x2pi', 4, 'fe1bba2aacce2b3613c7f50a55b0f74a.png', '0000-00-00', 'aktif'),
(4, 'admin', 'laki-laki', 'Jl.Panglima sudirman No 34', 'fdsga@gmail.com', '082446734886', 'admin', '$2y$10$wa7m6x0CUn2c09bfq9QOguAmuJhbIPACFJmV8gKG72Z2aFHArNlUG', 3, 'e0aa6daf248e6e81bec4c21ebb4651ce.png', '0000-00-00', 'aktif'),
(5, 'ali', 'laki-laki', 'jl pakuniran', 'luckykyh@gmail.com', '082213034131', 'ali', '$2y$10$r5PyCvfH1ZfBLLVFTba5FOXjKyty2JL/PBu731u0I6wCPFso4LUJ.', 2, 'default.jpg', '0000-00-00', 'nonaktif'),
(6, 'faris', 'laki-laki', 'jl pakuniran', 'luckykyk@gmail.com', '087655893087', 'faris', '$2y$10$fhYW0BI/my03kjeNqfdETeCXZ0WqF5lKD5vTtbXavMhe1Bs0p8Vcq', 4, 'default.jpg', '0000-00-00', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id_activity` int(11) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `id_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_assign_properti`
--

CREATE TABLE `user_assign_properti` (
  `id_assign` int(2) NOT NULL,
  `id_properti` int(2) NOT NULL,
  `id_user` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_assign_properti`
--

INSERT INTO `user_assign_properti` (`id_assign`, `id_properti`, `id_user`) VALUES
(8, 7, 5),
(9, 2, 3),
(10, 6, 3),
(11, 7, 3),
(12, 7, 6),
(15, 2, 4),
(16, 7, 4),
(19, 2, 2),
(20, 7, 2),
(21, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_akses` int(1) NOT NULL,
  `akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_akses`, `akses`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'admin'),
(4, 'marketing');

-- --------------------------------------------------------

--
-- Structure for view `tbl_detail_pembayaran`
--
DROP TABLE IF EXISTS `tbl_detail_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_detail_pembayaran`  AS  select `detail_pembayaran`.`id_detail` AS `id_detail`,`tbl_pembayaran`.`id_pembayaran` AS `id_pembayaran`,`tbl_pembayaran`.`nama_pembayaran` AS `nama_pembayaran`,`tbl_pembayaran`.`id_properti` AS `id_properti`,`tbl_pembayaran`.`nama_properti` AS `nama_properti`,`tbl_pembayaran`.`id_unit` AS `id_unit`,`tbl_pembayaran`.`nama_unit` AS `nama_unit`,`tbl_pembayaran`.`total_bayar` AS `total_bayar`,`tbl_pembayaran`.`hutang` AS `hutang`,`rekening_properti`.`id_rekening` AS `id_rekening`,`rekening_properti`.`no_rekening` AS `no_rekening`,`rekening_properti`.`bank` AS `bank`,`detail_pembayaran`.`tgl_bayar` AS `tgl_bayar`,`detail_pembayaran`.`bukti_bayar` AS `bukti_bayar`,`user`.`id_user` AS `id_user`,`user`.`nama_lengkap` AS `nama_lengkap`,`detail_pembayaran`.`jumlah_bayar` AS `jumlah_bayar`,`detail_pembayaran`.`status_owner` AS `status_owner`,`detail_pembayaran`.`status_manager` AS `status_manager` from (((`detail_pembayaran` join `tbl_pembayaran` on((`detail_pembayaran`.`id_pembayaran` = `tbl_pembayaran`.`id_pembayaran`))) join `rekening_properti` on((`detail_pembayaran`.`id_rekening` = `rekening_properti`.`id_rekening`))) join `user` on((`detail_pembayaran`.`id_user` = `user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_detail_rab`
--
DROP TABLE IF EXISTS `tbl_detail_rab`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_detail_rab`  AS  select `detail_rab`.`id_detail` AS `id_detail`,`detail_rab`.`nama_detail` AS `nama_detail`,`detail_rab`.`id_rab` AS `id_rab`,`detail_rab`.`volume` AS `volume`,`detail_rab`.`satuan` AS `satuan`,`detail_rab`.`harga_satuan` AS `harga_satuan`,`detail_rab`.`total_harga` AS `total_harga`,`ki`.`id_kelompok` AS `id_kelompok`,`ki`.`nama_kelompok` AS `kelompok_pengeluaran` from ((`detail_rab` join `rab_properti` `rap` on((`rap`.`id_rab` = `detail_rab`.`id_rab`))) join `kelompok_item` `ki` on((`ki`.`id_kelompok` = `detail_rab`.`id_kelompok`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_follow`
--
DROP TABLE IF EXISTS `tbl_follow`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_follow`  AS  select `follow_up`.`id_follow` AS `id_follow`,`konsumen`.`id_konsumen` AS `id_konsumen`,`konsumen`.`nama_lengkap` AS `nama_lengkap`,`follow_up`.`tgl_follow` AS `tgl_follow`,`follow_up`.`media` AS `media`,`follow_up`.`keterangan` AS `keterangan`,`follow_up`.`hasil_follow` AS `hasil_follow`,`follow_up`.`id_user` AS `id_user` from (`follow_up` join `konsumen` on((`konsumen`.`id_konsumen` = `follow_up`.`id_konsumen`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_item`
--
DROP TABLE IF EXISTS `tbl_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_item`  AS  select `kelompok_item`.`id_kelompok` AS `id_kelompok`,`kelompok_item`.`nama_kelompok` AS `nama_kelompok`,`kelompok_item`.`id_user` AS `id_user`,`kategori_kelompok`.`id_kategori` AS `id_kategori`,`kategori_kelompok`.`nama_kategori` AS `nama_kategori`,`kelompok_item`.`status` AS `status` from (`kelompok_item` left join `kategori_kelompok` on((`kelompok_item`.`id_kategori` = `kategori_kelompok`.`id_kategori`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_pemasukan`
--
DROP TABLE IF EXISTS `tbl_pemasukan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pemasukan`  AS  select `pemasukan`.`id_pemasukan` AS `id_pemasukan`,`pemasukan`.`nama_pemasukan` AS `nama_pemasukan`,`pemasukan`.`volume` AS `volume`,`pemasukan`.`satuan` AS `satuan`,`pemasukan`.`harga_satuan` AS `harga_satuan`,`pemasukan`.`total_harga` AS `total_harga`,`pemasukan`.`bukti_kwitansi` AS `bukti_kwitansi`,`user`.`id_user` AS `id_user`,`user`.`nama_lengkap` AS `nama_lengkap`,`pemasukan`.`id_properti` AS `id_properti`,`properti`.`nama_properti` AS `nama_properti`,`pemasukan`.`id_unit` AS `id_unit`,`unit`.`nama_unit` AS `nama_unit`,`kelompok_item`.`id_kelompok` AS `id_kelompok`,`kelompok_item`.`nama_kelompok` AS `nama_kelompok`,`pemasukan`.`tgl_buat` AS `tgl_buat`,`pemasukan`.`status_owner` AS `status_owner`,`pemasukan`.`status_manager` AS `status_manager` from ((((`pemasukan` left join `kelompok_item` on((`pemasukan`.`id_kelompok` = `kelompok_item`.`id_kelompok`))) left join `user` on((`pemasukan`.`id_user` = `user`.`id_user`))) left join `properti` on((`pemasukan`.`id_properti` = `properti`.`id_properti`))) left join `unit` on((`pemasukan`.`id_unit` = `unit`.`id_unit`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_pembayaran`
--
DROP TABLE IF EXISTS `tbl_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pembayaran`  AS  select `pembayaran`.`id_pembayaran` AS `id_pembayaran`,`tbl_transaksi`.`id_transaksi` AS `id_transaksi`,`tbl_transaksi`.`id_unit` AS `id_unit`,`tbl_transaksi`.`nama_unit` AS `nama_unit`,`tbl_transaksi`.`id_properti` AS `id_properti`,`tbl_transaksi`.`nama_properti` AS `nama_properti`,`pembayaran`.`nama_pembayaran` AS `nama_pembayaran`,`pembayaran`.`total_tagihan` AS `total_tagihan`,`pembayaran`.`jatuh_tempo` AS `jatuh_tempo`,`pembayaran`.`total_bayar` AS `total_bayar`,`pembayaran`.`hutang` AS `hutang`,`pembayaran`.`status` AS `status`,`pembayaran`.`jenis_pembayaran` AS `jenis_pembayaran`,`jenis_pembayaran`.`jenis_pembayaran` AS `nama_jenis` from ((`pembayaran` left join `tbl_transaksi` on((`pembayaran`.`id_transaksi` = `tbl_transaksi`.`id_transaksi`))) left join `jenis_pembayaran` on((`pembayaran`.`jenis_pembayaran` = `jenis_pembayaran`.`id_jenis`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_pengeluaran`
--
DROP TABLE IF EXISTS `tbl_pengeluaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pengeluaran`  AS  select `pengeluaran`.`id_pengeluaran` AS `id_pengeluaran`,`pengeluaran`.`nama_pengeluaran` AS `nama_pengeluaran`,`pengeluaran`.`volume` AS `volume`,`pengeluaran`.`satuan` AS `satuan`,`pengeluaran`.`harga_satuan` AS `harga_satuan`,`pengeluaran`.`total_harga` AS `total_harga`,`pengeluaran`.`bukti_kwitansi` AS `bukti_kwitansi`,`user`.`id_user` AS `id_user`,`user`.`nama_lengkap` AS `nama_lengkap`,`pengeluaran`.`id_properti` AS `id_properti`,`properti`.`nama_properti` AS `nama_properti`,`pengeluaran`.`id_unit` AS `id_unit`,`unit`.`nama_unit` AS `nama_unit`,`kelompok_item`.`id_kelompok` AS `id_kelompok`,`kelompok_item`.`nama_kelompok` AS `nama_kelompok`,`pengeluaran`.`tgl_buat` AS `tgl_buat`,`pengeluaran`.`status_owner` AS `status_owner`,`pengeluaran`.`status_manager` AS `status_manager` from ((((`pengeluaran` left join `kelompok_item` on((`pengeluaran`.`id_kelompok` = `kelompok_item`.`id_kelompok`))) left join `user` on((`pengeluaran`.`id_user` = `user`.`id_user`))) left join `unit` on((`pengeluaran`.`id_unit` = `unit`.`id_unit`))) left join `properti` on((`pengeluaran`.`id_properti` = `properti`.`id_properti`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_properti`
--
DROP TABLE IF EXISTS `tbl_properti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_properti`  AS  select `properti`.`id_properti` AS `id_properti`,`properti`.`nama_properti` AS `nama_properti`,`properti`.`luas_tanah` AS `luas_tanah`,`properti`.`satuan_tanah` AS `satuan_tanah`,`properti`.`jumlah_unit` AS `jumlah_unit`,`properti`.`rekening` AS `rekening`,`rekening_properti`.`no_rekening` AS `no_rekening`,`rekening_properti`.`bank` AS `bank`,`properti`.`logo_properti` AS `logo_properti`,`properti`.`foto_properti` AS `foto_properti`,`properti`.`tgl_buat` AS `tgl_buat`,`properti`.`status` AS `status`,`properti`.`id_user` AS `id_user`,`properti`.`setting_spr` AS `setting_spr`,`properti`.`id_rab` AS `id_rab` from (`properti` left join `rekening_properti` on((`properti`.`rekening` = `rekening_properti`.`id_rekening`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_rab`
--
DROP TABLE IF EXISTS `tbl_rab`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_rab`  AS  select `detail_rab`.`id_detail` AS `id_detail`,`detail_rab`.`nama_detail` AS `nama_detail`,`detail_rab`.`id_rab` AS `id_rab`,`detail_rab`.`volume` AS `volume`,`detail_rab`.`satuan` AS `satuan`,`detail_rab`.`harga_satuan` AS `harga_satuan`,`detail_rab`.`total_harga` AS `total_harga`,`ki`.`id_kelompok` AS `id_kelompok`,`ki`.`nama_kelompok` AS `kelompok_pengeluaran` from ((`detail_rab` join `rab_properti` `rap` on((`rap`.`id_rab` = `detail_rab`.`id_rab`))) join `kelompok_item` `ki` on((`ki`.`id_kelompok` = `detail_rab`.`id_kelompok`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_role_access`
--
DROP TABLE IF EXISTS `tbl_role_access`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_role_access`  AS  select `role_access`.`id` AS `id`,`role_access`.`id_role` AS `id_role`,`role_access`.`id_controller` AS `id_controller`,`controller_item`.`controller_name` AS `controller_name` from (`role_access` join `controller_item` on((`controller_item`.`id` = `role_access`.`id_controller`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_transaksi`
--
DROP TABLE IF EXISTS `tbl_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_transaksi`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`transaksi`.`no_spr` AS `no_spr`,`konsumen`.`id_konsumen` AS `id_konsumen`,`konsumen`.`nama_lengkap` AS `nama_lengkap`,`tbl_unit`.`id_unit` AS `id_unit`,`tbl_unit`.`nama_unit` AS `nama_unit`,`tbl_unit`.`id_properti` AS `id_properti`,`tbl_unit`.`nama_properti` AS `nama_properti`,`transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`transaksi`.`total_kesepakatan` AS `total_kesepakatan`,`transaksi`.`total_tanda_jadi` AS `total_tanda_jadi`,`transaksi`.`total_uang_muka` AS `total_uang_muka`,`transaksi`.`total_cicilan` AS `total_cicilan`,`transaksi`.`total_tambahan` AS `total_tambahan`,`type_bayar`.`id_type_bayar` AS `id_type`,`type_bayar`.`type_bayar` AS `type_bayar`,`transaksi`.`periode_uang_muka` AS `periode_uang_muka`,`transaksi`.`periode_cicilan` AS `periode_cicilan`,`transaksi`.`kunci` AS `kunci`,`transaksi`.`status_transaksi` AS `status_transaksi`,`transaksi`.`tgl_tanda_jadi` AS `tgl_tanda_jadi`,`transaksi`.`tanda_jadi` AS `tanda_jadi`,`transaksi`.`tgl_uang_muka` AS `tgl_uang_muka`,`transaksi`.`tgl_cicilan` AS `tgl_cicilan`,`transaksi`.`sp3k` AS `sp3k`,`user`.`id_user` AS `id_user`,`user`.`nama_lengkap` AS `pembuat`,`transaksi`.`status_tj` AS `status_tj`,`transaksi`.`status_um` AS `status_um`,`transaksi`.`status_ccl` AS `status_ccl` from ((((`transaksi` left join `konsumen` on((`transaksi`.`id_konsumen` = `konsumen`.`id_konsumen`))) left join `tbl_unit` on((`transaksi`.`id_unit` = `tbl_unit`.`id_unit`))) left join `type_bayar` on((`transaksi`.`type_bayar` = `type_bayar`.`id_type_bayar`))) left join `user` on((`transaksi`.`id_user` = `user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_unit`
--
DROP TABLE IF EXISTS `tbl_unit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_unit`  AS  select `unit`.`id_unit` AS `id_unit`,`unit`.`nama_unit` AS `nama_unit`,`properti`.`id_properti` AS `id_properti`,`properti`.`nama_properti` AS `nama_properti`,`unit`.`type` AS `type`,`unit`.`luas_tanah` AS `luas_tanah`,`unit`.`satuan_tanah` AS `satuan_tanah`,`unit`.`luas_bangunan` AS `luas_bangunan`,`unit`.`satuan_bangunan` AS `satuan_bangunan`,`unit`.`harga_unit` AS `harga_unit`,`unit`.`foto_unit` AS `foto_unit`,`unit`.`alamat_unit` AS `alamat_unit`,`unit`.`tgl_buat` AS `tgl_buat`,`unit`.`status_unit` AS `status_unit`,`unit`.`id_user` AS `id_user`,`unit`.`deskripsi` AS `deskripsi` from (`unit` join `properti` on((`unit`.`id_properti` = `properti`.`id_properti`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_users`
--
DROP TABLE IF EXISTS `tbl_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_users`  AS  select `users`.`id_user` AS `id_user`,`users`.`nama_lengkap` AS `nama_lengkap`,`users`.`email` AS `Email`,`users`.`no_hp` AS `no_hp`,`users`.`status_user` AS `status_user`,`users`.`id_akses` AS `id_akses`,`user_role`.`akses` AS `akses` from (`user` `users` left join `user_role` on((`users`.`id_akses` = `user_role`.`id_akses`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tbl_user_assign_properti`
--
DROP TABLE IF EXISTS `tbl_user_assign_properti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_user_assign_properti`  AS  select `up`.`id_assign` AS `id_assign`,`up`.`id_properti` AS `id_properti`,`p`.`nama_properti` AS `nama_properti`,`p`.`foto_properti` AS `foto_properti`,`p`.`alamat` AS `alamat`,`up`.`id_user` AS `id_user`,`us`.`nama_lengkap` AS `nama_lengkap`,`us`.`akses` AS `akses` from ((`user_assign_properti` `up` join `tbl_users` `us` on((`us`.`id_user` = `up`.`id_user`))) join `properti` `p` on((`p`.`id_properti` = `up`.`id_properti`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controller_item`
--
ALTER TABLE `controller_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `controller_name` (`controller_name`);

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pembayaran` (`id_pembayaran`,`id_rekening`,`id_user`),
  ADD KEY `id_rekening` (`id_rekening`);

--
-- Indexes for table `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_rab` (`id_rab`),
  ADD KEY `id_kelompok` (`id_kelompok`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kd_transaksi` (`id_transaksi`);

--
-- Indexes for table `follow_up`
--
ALTER TABLE `follow_up`
  ADD PRIMARY KEY (`id_follow`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_konsumen` (`id_konsumen`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kategori_kelompok`
--
ALTER TABLE `kategori_kelompok`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelompok_item`
--
ALTER TABLE `kelompok_item`
  ADD PRIMARY KEY (`id_kelompok`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kelompok_persyaratan`
--
ALTER TABLE `kelompok_persyaratan`
  ADD PRIMARY KEY (`id_sasaran`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_jenis` (`jenis_pembayaran`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `persyaratan_konsumen`
--
ALTER TABLE `persyaratan_konsumen`
  ADD PRIMARY KEY (`id_persyaratan`),
  ADD KEY `id_sasaran_id_konsumen_id_user` (`kelompok_persyaratan`,`id_konsumen`,`id_user`),
  ADD KEY `persyaratan_konsumen_ibfk_1` (`id_konsumen`);

--
-- Indexes for table `persyaratan_unit`
--
ALTER TABLE `persyaratan_unit`
  ADD PRIMARY KEY (`id_persyaratan`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `kelompok_persyaratan` (`kelompok_persyaratan`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `properti`
--
ALTER TABLE `properti`
  ADD PRIMARY KEY (`id_properti`),
  ADD KEY `id_rekening` (`rekening`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_rab` (`id_rab`),
  ADD KEY `id_properti_dexs` (`id_properti`) USING BTREE;

--
-- Indexes for table `rab_properti`
--
ALTER TABLE `rab_properti`
  ADD PRIMARY KEY (`id_rab`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_properti` (`id_properti`);

--
-- Indexes for table `rekening_properti`
--
ALTER TABLE `rekening_properti`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `role_access`
--
ALTER TABLE `role_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_akta_rumah`
--
ALTER TABLE `surat_akta_rumah`
  ADD PRIMARY KEY (`id_akta`);

--
-- Indexes for table `surat_berita_acara`
--
ALTER TABLE `surat_berita_acara`
  ADD PRIMARY KEY (`id_berita_acara`);

--
-- Indexes for table `surat_konsumen`
--
ALTER TABLE `surat_konsumen`
  ADD PRIMARY KEY (`id_surat_konsumen`);

--
-- Indexes for table `surat_perumahan`
--
ALTER TABLE `surat_perumahan`
  ADD PRIMARY KEY (`id_surat_perumahan`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_surat`
--
ALTER TABLE `surat_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_konsumen` (`id_konsumen`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `id_type_bayar` (`type_bayar`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `type_bayar`
--
ALTER TABLE `type_bayar`
  ADD PRIMARY KEY (`id_type_bayar`);

--
-- Indexes for table `type_id_card`
--
ALTER TABLE `type_id_card`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `user_id` (`id_user`),
  ADD KEY `id_properti` (`id_properti`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`),
  ADD KEY `akses_id` (`id_akses`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id_activity`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_assign_properti`
--
ALTER TABLE `user_assign_properti`
  ADD PRIMARY KEY (`id_assign`),
  ADD KEY `id_properti` (`id_properti`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `controller_item`
--
ALTER TABLE `controller_item`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `detail_rab`
--
ALTER TABLE `detail_rab`
  MODIFY `id_detail` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `follow_up`
--
ALTER TABLE `follow_up`
  MODIFY `id_follow` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id_jenis` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori_kelompok`
--
ALTER TABLE `kategori_kelompok`
  MODIFY `id_kategori` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kelompok_item`
--
ALTER TABLE `kelompok_item`
  MODIFY `id_kelompok` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kelompok_persyaratan`
--
ALTER TABLE `kelompok_persyaratan`
  MODIFY `id_sasaran` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `persyaratan_konsumen`
--
ALTER TABLE `persyaratan_konsumen`
  MODIFY `id_persyaratan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `persyaratan_unit`
--
ALTER TABLE `persyaratan_unit`
  MODIFY `id_persyaratan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `properti`
--
ALTER TABLE `properti`
  MODIFY `id_properti` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `rab_properti`
--
ALTER TABLE `rab_properti`
  MODIFY `id_rab` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `rekening_properti`
--
ALTER TABLE `rekening_properti`
  MODIFY `id_rekening` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_access`
--
ALTER TABLE `role_access`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `surat_akta_rumah`
--
ALTER TABLE `surat_akta_rumah`
  MODIFY `id_akta` tinyint(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `surat_berita_acara`
--
ALTER TABLE `surat_berita_acara`
  MODIFY `id_berita_acara` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `surat_surat`
--
ALTER TABLE `surat_surat`
  MODIFY `id_surat` tinyint(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `type_bayar`
--
ALTER TABLE `type_bayar`
  MODIFY `id_type_bayar` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `type_id_card`
--
ALTER TABLE `type_id_card`
  MODIFY `id_type` tinyint(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_assign_properti`
--
ALTER TABLE `user_assign_properti`
  MODIFY `id_assign` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_akses` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD CONSTRAINT `detail_pembayaran_ibfk_1` FOREIGN KEY (`id_rekening`) REFERENCES `rekening_properti` (`id_rekening`),
  ADD CONSTRAINT `detail_pembayaran_ibfk_2` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE;

--
-- Constraints for table `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD CONSTRAINT `detail_rab_ibfk_1` FOREIGN KEY (`id_rab`) REFERENCES `rab_properti` (`id_rab`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `follow_up`
--
ALTER TABLE `follow_up`
  ADD CONSTRAINT `follow_up_ibfk_1` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`) ON DELETE CASCADE;

--
-- Constraints for table `kelompok_item`
--
ALTER TABLE `kelompok_item`
  ADD CONSTRAINT `kelompok_item_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kelompok` (`id_kategori`);

--
-- Constraints for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD CONSTRAINT `konsumen_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pemasukan_ibfk_2` FOREIGN KEY (`id_properti`) REFERENCES `properti` (`id_properti`),
  ADD CONSTRAINT `pemasukan_ibfk_3` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok_item` (`id_kelompok`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`jenis_pembayaran`) REFERENCES `jenis_pembayaran` (`id_jenis`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_properti`) REFERENCES `properti` (`id_properti`),
  ADD CONSTRAINT `pengeluaran_ibfk_3` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok_item` (`id_kelompok`);

--
-- Constraints for table `persyaratan_konsumen`
--
ALTER TABLE `persyaratan_konsumen`
  ADD CONSTRAINT `persyaratan_konsumen_ibfk_1` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`) ON DELETE CASCADE;

--
-- Constraints for table `persyaratan_unit`
--
ALTER TABLE `persyaratan_unit`
  ADD CONSTRAINT `persyaratan_unit_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`),
  ADD CONSTRAINT `persyaratan_unit_ibfk_2` FOREIGN KEY (`kelompok_persyaratan`) REFERENCES `kelompok_persyaratan` (`id_sasaran`) ON DELETE CASCADE;

--
-- Constraints for table `properti`
--
ALTER TABLE `properti`
  ADD CONSTRAINT `properti_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `properti_ibfk_2` FOREIGN KEY (`id_rab`) REFERENCES `rab_properti` (`id_rab`);

--
-- Constraints for table `rab_properti`
--
ALTER TABLE `rab_properti`
  ADD CONSTRAINT `rab_properti_ibfk_1` FOREIGN KEY (`id_properti`) REFERENCES `properti` (`id_properti`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`id_properti`) REFERENCES `properti` (`id_properti`),
  ADD CONSTRAINT `unit_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `user_role` (`id_akses`);

--
-- Constraints for table `user_assign_properti`
--
ALTER TABLE `user_assign_properti`
  ADD CONSTRAINT `user_assign_properti_ibfk_1` FOREIGN KEY (`id_properti`) REFERENCES `properti` (`id_properti`),
  ADD CONSTRAINT `user_assign_properti_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
