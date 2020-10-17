<?php
	class Dashboardrenja_model extends CI_Model{
		function __construct()
		{
			parent::__construct();
			$this->DBBappeda =  $this->load->database('default', TRUE);
		}
		

		
		public function anggaranperskpd(){
/*			$q = "SELECT SUM(apbd_kab) AS apbd_kab, SUM(apbd_dak) AS apbd_dak, SUM(apbd_prov) AS apbd_prov, SUM(apbn) AS apbn, SUM(skpd) AS skpd, skpd 
					FROM `tb_musrenbang_renja` `usul`
						JOIN `tb_kegiatan` `keg` ON `usul`.`id_kegiatan` = `keg`.`id_kegiatan`
						LEFT JOIN `tb_program` `prog` ON `prog`.`id_program` = `usul`.`id_program`
						LEFT JOIN `tb_bidang` `bid` ON `bid`.`id_bidang` = `usul`.`id_bidang`
						LEFT JOIN `tb_urusan` `urusan` ON `urusan`.`id_urusan` = `usul`.`id_urusan`
						LEFT JOIN `tb_skpd` `skpd` ON `skpd`.`id_skpd` = `usul`.`id_skpd`
						LEFT JOIN `tb_kecamatan` `kecamatan` ON `kecamatan`.`kode_kecamatan` = `usul`.`kode_kecamatan`
					WHERE `usul`.`tahun` = '".date("Y")."'
					AND `usul`.`sah` = 'true'
					GROUP BY skpd
					ORDER BY apbn DESC
					LIMIT 10
				";
			$query = $this->DBBappeda->query($q);

			return $query->result_array();*/
		}
		
		public function anggaranperKeg(){
/*			$q = "SELECT SUM(apbd_kab) AS apbd_kab, SUM(apbd_dak) AS apbd_dak, SUM(apbd_prov) AS apbd_prov, SUM(apbn) AS apbn, SUM(skpd) AS skpd, kegiatan 
					FROM `tb_musrenbang_renja` `usul`
						JOIN `tb_kegiatan` `keg` ON `usul`.`id_kegiatan` = `keg`.`id_kegiatan`
						LEFT JOIN `tb_program` `prog` ON `prog`.`id_program` = `usul`.`id_program`
						LEFT JOIN `tb_bidang` `bid` ON `bid`.`id_bidang` = `usul`.`id_bidang`
						LEFT JOIN `tb_urusan` `urusan` ON `urusan`.`id_urusan` = `usul`.`id_urusan`
						LEFT JOIN `tb_skpd` `skpd` ON `skpd`.`id_skpd` = `usul`.`id_skpd`
						LEFT JOIN `tb_kecamatan` `kecamatan` ON `kecamatan`.`kode_kecamatan` = `usul`.`kode_kecamatan`
					WHERE `usul`.`tahun` = '".date("Y")."'
					AND `usul`.`sah` = 'true'
					GROUP BY kegiatan
					ORDER BY apbn DESC
					LIMIT 10
				";
			$query = $this->DBBappeda->query($q);

			return $query->result_array();*/
		}
		
		// apbd_kab, apbd_dak, apbd_prov, apbn, skpd, program 
		public function persentaseanggaran(){
/*			$q = "SELECT SUM(apbd_kab) as apbd_kab, SUM(apbd_dak) as apbd_dak, SUM(apbd_prov) as apbd_prov, SUM(apbn) as apbn, SUM(skpd) as skpd
					FROM `tb_musrenbang_renja` `usul`
						JOIN `tb_kegiatan` `keg` ON `usul`.`id_kegiatan` = `keg`.`id_kegiatan`
						LEFT JOIN `tb_program` `prog` ON `prog`.`id_program` = `usul`.`id_program`
						LEFT JOIN `tb_bidang` `bid` ON `bid`.`id_bidang` = `usul`.`id_bidang`
						LEFT JOIN `tb_urusan` `urusan` ON `urusan`.`id_urusan` = `usul`.`id_urusan`
						LEFT JOIN `tb_skpd` `skpd` ON `skpd`.`id_skpd` = `usul`.`id_skpd`
						LEFT JOIN `tb_kecamatan` `kecamatan` ON `kecamatan`.`kode_kecamatan` = `usul`.`kode_kecamatan`
					WHERE `usul`.`tahun` = '".date("Y")."'
					AND `usul`.`sah` = 'true'
					
					ORDER BY `usul`.`id_urusan`, `usul`.`id_bidang`, `usul`.`id_program`, `usul`.`id_kegiatan`
				";
			$query = $this->DBBappeda->query($q);

			return $query->result_array();*/
		}
	}
?>	