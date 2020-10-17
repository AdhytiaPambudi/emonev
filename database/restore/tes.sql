/*
SQLyog Ultimate v10.41 
MySQL - 5.6.26 : Database - tes_emonev
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tes_emonev` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tes_emonev`;

/*Table structure for table `m_skpd` */

DROP TABLE IF EXISTS `m_skpd`;

CREATE TABLE `m_skpd` (
  `id_skpd` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_urusan` int(11) NOT NULL,
  `id_bidang` tinyint(4) NOT NULL DEFAULT '1',
  `kode_skpd` varchar(255) DEFAULT NULL,
  `nama_skpd` varchar(255) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_skpd`),
  KEY `FK_m_skpd` (`id_jenis_urusan`) USING BTREE,
  KEY `FK_m_skpd_` (`id_bidang`) USING BTREE,
  CONSTRAINT `m_skpd_ibfk_1` FOREIGN KEY (`id_jenis_urusan`) REFERENCES `m_jenis_urusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `m_skpd_ibfk_2` FOREIGN KEY (`id_bidang`) REFERENCES `m_bidang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `m_skpd` */

insert  into `m_skpd`(`id_skpd`,`id_jenis_urusan`,`id_bidang`,`kode_skpd`,`nama_skpd`,`alias`,`status`) values (1,1,1,'1.01.01.01','DINAS PENDIDIKAN','Pendidikan',1),(2,2,1,'1.02.01.01','DINAS KESEHATAN','Kesehatan',1),(3,2,1,'1.02.01.02','PUSKESMAS 1','PUSKESMAS1',1),(6,3,1,'1.02.01.03','PUSKESMAS 2','PUSKESMAS2',1),(7,4,1,'1.02.01.04','PUSKESMAS 3','PUSKESMAS3',1),(8,5,1,'1.02.01.05','PUSKESMAS 4','PUSKESMAS4',1),(9,6,1,'1.02.01.06','PUSKESMAS 5','PUSKESMAS5',1),(10,7,1,'1.02.01.07','PUSKESMAS 6','PUSKESMAS6',1),(11,8,1,'1.02.01.08','PUSKESMAS 7','PUSKESMAS7',1),(12,9,1,'1.02.01.09','PUSKESMAS 8','PUSKESMAS8',1),(13,10,1,'1.02.01.10','PUSKESMAS 9','PUSKESMAS9',1),(14,11,1,'1.02.01.11','PUSKESMAS 10','PUSKESMAS10',1),(15,12,1,'1.02.02.01','RUMAH SAKIT UMUM DAERAH','RSUD',1),(16,13,1,'1.03.01.01','DINAS PEKERJAAN UMUM DAN PENATA RUANG','DISKOMINFO',1),(17,14,1,'1.05.01.01','KANTOR KESATUAN BANGSA DAN  POLITIK','KESBANGPOL',1),(18,15,1,'1.05.02.01','DINAS KETENTRAMAN, KETERTIBAN UMUM DAN PERLINDUNGAN MASYARAKAT','PERMAS',1),(19,16,1,'1.06.01.01','BADAN PENANGGULANGAN BENCANA DAERAH','BPBD',1),(20,17,1,'2.02.01.01','DINAS PENGENDALIAN PENDUDUK, KB, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK','PEMBERDAYAAN PEREMPUAN',1),(21,18,1,'2.05.01.01','DINAS LINGKUNGAN HIDUP DAN PERTANAHAN','LINGKUNGANHIDUP',1),(22,2,1,'2.06.01.01','DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL','CAPIL',1),(23,2,1,'2.07.01.01','DINAS PEMERINTAHAN KAMPUNG DAN SOSIAL',NULL,1),(24,2,1,'2.09.01.01','DINAS PERHUBUNGAN',NULL,1),(25,2,1,'2.10.01.01','DINAS KOMUNIKASI DAN INFORMASI, STATISTIK DAN PERSANDIAN',NULL,1),(26,2,1,'2.12.01.01','DINAS PENANAMAN MODAL, KOPERASI DAN UKM',NULL,1),(27,2,1,'2.16.01.01','DINAS KEBUDAYAAN DAN PARIWISATA',NULL,1),(28,2,1,'2.17.01.01','DINAS PERPUSTAKAAN DAN KEARSIPAN',NULL,1),(29,2,1,'3.01.01.01','DINAS PERTANIAN DAN PERIKANAN',NULL,1),(30,2,1,'3.03.01.01','DINAS KETAHANAN PANGAN',NULL,1),(31,19,1,'3.06.01.01','DINAS PERDAGANGAN, PERINDUSTRIAN DAN TENAGA KERJA','Perindustrian',1),(32,43,1,'3.08.01.01','DINAS TRANSMIGRASI','Transmigrasi',1),(33,20,1,'4.01.01.01','DEWAN PERWAKILAN RAKYAT DAERAH','DPRD',1),(34,21,1,'4.01.02.01','KEPALA DAERAH/WAKIL KEPALA DAERAH','KDWKD',1),(35,22,1,'4.01.03.01','SEKRETARIAT DAERAH','SETDA',1),(36,22,1,'4.01.03.02','Sekretariat Daerah Bagian Umum Dan Perlengkapan','SETDA UMUM',1),(37,22,1,'4.01.03.03','Sekretariat Daerah Bagian Hukum Dan HAM','SETDA HUKUM',1),(38,22,1,'4.01.03.04','Sekretariat Daerah Bagian Pertanahan ','SETDA Pertanahan',1),(39,22,1,'4.01.03.05','SETDA (BAGIAN TATA PEMERINTAHAN)','SETDA OTDA',1),(40,22,1,'4.01.03.06','Sekretariat Daerah Bagian Kesejahteraan Rakyat ','SETDA KESRA',1),(41,22,1,'4.01.03.07','Sekretariat Daerah Bagian Perekonomian Daerah','SETDA PEREKDA',1),(42,22,1,'4.01.03.08','Sekretariat Daerah Bagian Organisasi Dan Pendayagunaan Aparatur','SETDA OPA',1),(43,22,1,'4.01.03.09','Sekretariat Daerah Bagian Unit Layanan Pengadaan','SETDA ULP',1),(44,22,1,'4.01.03.10','Sekretariat Daerah (Kepala Daerah)','SETDA Bupati',1),(45,22,1,'4.01.03.11','Sekretariat Daerah (Wakil Kepal Daerah)','SETDA Wakil',1),(46,23,1,'4.01.04.01','Sekretariat DPRD','SETWAN',1),(47,24,1,'4.01.08.01','DISTRIK KARUBAGA','KARUBAGA',1),(48,25,1,'4.01.09.01','DISTRIK BOKONDINI','BOKONDINI',1),(49,26,1,'4.01.10.01','DISTRIK KANGGIME','KANGGIME',1),(50,27,1,'4.01.11.01','DISTRIK KEMBU','KEMBU',1),(51,28,1,'4.01.12.01','DISTRIK SAMPLE 1','SAMPLE1',1),(52,29,1,'4.01.13.01','DISTRIK SAMPLE 2','SAMPLE2',1),(53,30,1,'4.01.14.01','DISTRIK SAMPLE 3','SAMPLE3',1),(54,31,1,'4.01.15.01','DISTRIK SAMPLE 4','SAMPLE4',1),(55,32,1,'4.01.16.01','DISTRIK SAMPLE 5','SAMPLE5',1),(56,33,1,'4.01.17.01','DISTRIK SAMPLE 6','SAMPLE6',1),(57,34,1,'4.01.18.01','DISTRIK SAMPLE 7','SAMPLE7',1),(58,35,1,'4.01.19.01','DISTRIK SAMPLE 8','SAMPLE8',1),(59,36,1,'4.01.20.01','DISTRIK SAMPLE 9','SAMPLE9',1),(60,37,1,'4.01.21.01','DISTRIK SAMPLE 10','SAMPLE10',1),(61,38,1,'4.01.22.01','BADAN PENANGGULANGAN BENCANA DAERAH','BPBD',1),(62,39,1,'4.02.01.01','INSPEKTORAT DAERAH','Inspektorat',1),(63,40,1,'4.03.01.01','BADAN PERENCANAAN DAN PENGENDALIAN PEMBANGUNAN DAERAH','BP4D',1),(64,41,1,'4.04.05.01','BADAN PENGELOLAAN KEUANGAN DAN ASSET DAERAH','BKAD (PPKD)',1),(65,41,1,'4.04.05.02','BADAN KEUANGAN DAN ASET DAERAH','BKAD',1),(66,42,1,'4.05.23.01','BADAN KEPEGAWAIAN DAN PENDIDIKAN PELATIHAN','BKD',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;