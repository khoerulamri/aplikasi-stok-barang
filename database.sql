/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.17-MariaDB : Database - stok_barang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stok_barang` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `stok_barang`;

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `kode_petugas` varchar(255) NOT NULL,
  `nama_petugas` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(255) DEFAULT NULL,
  `kode_hak_akses` varchar(255) DEFAULT NULL COMMENT 'administrator,pelipat,penjual,produksi',
  PRIMARY KEY (`kode_petugas`) USING BTREE,
  UNIQUE KEY `UniqUserName` (`user_name`) USING BTREE,
  KEY `FK_akun_hak_akses` (`kode_hak_akses`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `ukuran_barang` varchar(255) NOT NULL DEFAULT '''''',
  `bahan_barang` varchar(255) NOT NULL DEFAULT '''''',
  `kode_perusahaan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `kode_customer` varchar(255) NOT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telpon` varchar(12) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`kode_customer`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `data_stok` */

DROP TABLE IF EXISTS `data_stok`;

CREATE TABLE `data_stok` (
  `kode_perusahaan` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `qty_produksi` int(11) DEFAULT NULL,
  `qty_gudang` int(11) DEFAULT NULL,
  `qty_penjualan` int(11) DEFAULT NULL,
  `last_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_perusahaan`,`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `gudang` */

DROP TABLE IF EXISTS `gudang`;

CREATE TABLE `gudang` (
  `id_transaksi_gudang` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi_produksi` int(11) DEFAULT NULL,
  `tgl_input` datetime DEFAULT current_timestamp(),
  `tgl_serahkan` date DEFAULT NULL,
  `kode_petugas` varchar(255) DEFAULT NULL,
  `kode_pelipat` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_gudang`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `gudang_hapus` */

DROP TABLE IF EXISTS `gudang_hapus`;

CREATE TABLE `gudang_hapus` (
  `id_transaksi_gudang` bigint(20) unsigned NOT NULL,
  `id_transaksi_produksi` int(11) DEFAULT NULL,
  `tgl_input` datetime DEFAULT current_timestamp(),
  `tgl_serahkan` date DEFAULT NULL,
  `kode_petugas` varchar(255) DEFAULT NULL,
  `kode_pelipat` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `hak_akses` */

DROP TABLE IF EXISTS `hak_akses`;

CREATE TABLE `hak_akses` (
  `kode_hak_akses` varchar(100) NOT NULL,
  `nama_hak_akses` varchar(255) DEFAULT NULL,
  `m_file` char(1) DEFAULT '0',
  `m_login` char(1) DEFAULT '0',
  `m_logout` char(1) DEFAULT '0',
  `m_exit` char(1) DEFAULT '0',
  `m_informasi` char(1) DEFAULT '0',
  `m_infoakun` char(1) DEFAULT '0',
  `m_infopass` char(1) DEFAULT '0',
  `m_setting` char(1) DEFAULT '0',
  `m_instansi` char(1) DEFAULT '0',
  `m_petugas` char(1) DEFAULT '0',
  `m_hak_akses` char(1) DEFAULT '0',
  `m_koneksi` char(1) DEFAULT '0',
  `m_data_base` char(1) DEFAULT '0',
  `m_back_up_database` char(1) DEFAULT '0',
  `m_restore_database` char(1) DEFAULT '0',
  `m_sesi_login` char(1) DEFAULT '0',
  `m_transaksi` char(1) DEFAULT '0',
  `m_pemesanan` char(1) DEFAULT '0',
  `m_pembayaran` char(1) DEFAULT '0',
  `m_laporan` char(1) DEFAULT '0',
  `m_lap_pemesanan` char(1) DEFAULT '0',
  `m_lap_pembayaran` char(1) DEFAULT '0',
  `m_lap_perpj_all` char(1) DEFAULT '0',
  `m_lap_perpj_tempo` char(1) DEFAULT '0',
  `m_lap_kinerja` char(1) DEFAULT '0',
  `m_customer` char(1) DEFAULT '0',
  `m_pj` char(1) DEFAULT '0',
  `m_rekening` char(1) DEFAULT '0',
  `m_warna` char(1) DEFAULT '0',
  PRIMARY KEY (`kode_hak_akses`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `history_login` */

DROP TABLE IF EXISTS `history_login`;

CREATE TABLE `history_login` (
  `login_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_petugas` varchar(255) DEFAULT NULL,
  `waktu_login` datetime DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `perangkat` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`login_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Table structure for table `pelipat` */

DROP TABLE IF EXISTS `pelipat`;

CREATE TABLE `pelipat` (
  `kode_pelipat` varchar(255) NOT NULL,
  `nama_pelipat` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telpon` varchar(12) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`kode_pelipat`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id_transaksi_penjualan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_input` datetime DEFAULT current_timestamp(),
  `tgl_transaksi` date DEFAULT NULL,
  `kode_petugas` varchar(255) DEFAULT NULL,
  `kode_customer` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_barang` double DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  `status_transaksi` varchar(20) DEFAULT NULL COMMENT 'Lunas - Belum Lunas',
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `penjualan_detail` */

DROP TABLE IF EXISTS `penjualan_detail`;

CREATE TABLE `penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi_penjualan` int(11) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_barang` double DEFAULT NULL,
  PRIMARY KEY (`id_penjualan_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `penjualan_detail_hapus` */

DROP TABLE IF EXISTS `penjualan_detail_hapus`;

CREATE TABLE `penjualan_detail_hapus` (
  `id_penjualan_detail` int(11) DEFAULT 0,
  `id_transaksi_penjualan` int(11) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_barang` double DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `penjualan_hapus` */

DROP TABLE IF EXISTS `penjualan_hapus`;

CREATE TABLE `penjualan_hapus` (
  `id_transaksi_penjualan` bigint(20) unsigned NOT NULL,
  `tgl_input` datetime DEFAULT current_timestamp(),
  `tgl_transaksi` date DEFAULT NULL,
  `kode_petugas` varchar(255) DEFAULT NULL,
  `kode_customer` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_barang` double DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  `status_transaksi` varchar(20) DEFAULT NULL COMMENT 'Lunas - Belum Lunas',
  `keterangan` varchar(255) DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `perusahaan` */

DROP TABLE IF EXISTS `perusahaan`;

CREATE TABLE `perusahaan` (
  `kode_perusahaan` varchar(255) NOT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telpon` varchar(12) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`kode_perusahaan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `produksi` */

DROP TABLE IF EXISTS `produksi`;

CREATE TABLE `produksi` (
  `id_transaksi_produksi` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_input` datetime DEFAULT current_timestamp(),
  `kode_petugas` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `tgl_produksi` date DEFAULT NULL,
  `kode_sumber_transaksi` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_produksi`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `produksi_hapus` */

DROP TABLE IF EXISTS `produksi_hapus`;

CREATE TABLE `produksi_hapus` (
  `id_transaksi_produksi` bigint(20) unsigned NOT NULL,
  `tgl_input` datetime DEFAULT current_timestamp(),
  `kode_petugas` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `tgl_produksi` date DEFAULT NULL,
  `kode_sumber_transaksi` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `sesi_login` */

DROP TABLE IF EXISTS `sesi_login`;

CREATE TABLE `sesi_login` (
  `kode` varchar(255) NOT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `sumber_transaksi` */

DROP TABLE IF EXISTS `sumber_transaksi`;

CREATE TABLE `sumber_transaksi` (
  `kode_sumber_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sumber_transaksi` varchar(255) NOT NULL,
  PRIMARY KEY (`kode_sumber_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
