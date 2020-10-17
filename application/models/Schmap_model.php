<?php
	class Schmap_model extends CI_Model{
		function __construct()
		{
			parent::__construct();
			$this->DBSch =  $this->load->database('schoolmap', TRUE);
		}
		
		public function getSekolahbyKec ($thn){
			$q 		= "SELECT d.kecamatan, SUM(if(b.id_jenjang='00' AND b.id_status=4,1,0)) as tk_negeri, 
								SUM(if(b.id_jenjang='00' AND b.id_status=5,1,0)) as tk_swasta, 
								SUM(if(b.id_jenjang='01' AND b.id_status=4,1,0)) as ra_negeri, 
								SUM(if(b.id_jenjang='01' AND b.id_status=5,1,0)) as ra_swasta, 
								SUM(if(b.id_jenjang='10' AND b.id_status=4,1,0)) as sd_negeri, 
								SUM(if(b.id_jenjang='10' AND b.id_status=5,1,0)) as sd_swasta, 
								SUM(if(b.id_jenjang='11' AND b.id_status=4,1,0)) as mi_negeri, 
								SUM(if(b.id_jenjang='11' AND b.id_status=5,1,0)) as mi_swasta, 
								SUM(if(b.id_jenjang='20' AND b.id_status=4,1,0)) as smp_negeri, 
								SUM(if(b.id_jenjang='20' AND b.id_status=5,1,0)) as smp_swasta, 
								SUM(if(b.id_jenjang='21' AND b.id_status=4,1,0)) as mts_negeri, 
								SUM(if(b.id_jenjang='21' AND b.id_status=5,1,0)) as mts_swasta, 
								SUM(if(b.id_jenjang='30' AND b.id_status=4,1,0)) as sma_negeri, 
								SUM(if(b.id_jenjang='30' AND b.id_status=5,1,0)) as sma_swasta, 
								SUM(if(b.id_jenjang='31' AND b.id_status=4,1,0)) as ma_negeri, 
								SUM(if(b.id_jenjang='31' AND b.id_status=5,1,0)) as ma_swasta, 
								SUM(if(b.id_jenjang='34' AND b.id_status=4,1,0)) as smk_negeri, 
								SUM(if(b.id_jenjang='34' AND b.id_status=5,1,0)) as smk_swasta, 
								SUM(if(b.id_jenjang='90' AND b.id_status=4,1,0)) as slb_negeri, 
								SUM(if(b.id_jenjang='90' AND b.id_status=5,1,0)) as slb_swasta 
						FROM sekolah_periodik a 
						INNER JOIN sekolah b ON a.id_sekolah=b.id_sekolah 
						INNER JOIN ref_kelurahan c ON b.id_kelurahan=c.id_kelurahan 
						INNER JOIN ref_kecamatan d ON c.id_kecamatan=d.id_kecamatan 
							WHERE a.tahun='".$thn."' GROUP BY c.id_kecamatan";
			$query 	= $this->DBSch->query($q);

			$data 	= ($query !== FALSE && $query->num_rows() > 0) ? $query->result_array() : array();

			return $data;

		}
		
		public function chart_getSekolahbyKec(){
			$q 		= "SELECT d.kecamatan, 
								 ( SUM(IF(b.id_jenjang='00' AND b.id_status=4,1,0)) + 
								SUM(IF(b.id_jenjang='00' AND b.id_status=5,1,0))) AS tk, 
								( SUM(IF(b.id_jenjang='01' AND b.id_status=4,1,0)) + 
								SUM(IF(b.id_jenjang='01' AND b.id_status=5,1,0)) ) AS ra, 
								( SUM(IF(b.id_jenjang='10' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='10' AND b.id_status=5,1,0)) ) AS sd, 
								( SUM(IF(b.id_jenjang='11' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='11' AND b.id_status=5,1,0)) ) AS mi, 
								( SUM(IF(b.id_jenjang='20' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='20' AND b.id_status=5,1,0)) ) AS smp, 
								( SUM(IF(b.id_jenjang='21' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='21' AND b.id_status=5,1,0)) ) AS mts, 
								( SUM(IF(b.id_jenjang='30' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='30' AND b.id_status=5,1,0)) ) AS sma, 
								( SUM(IF(b.id_jenjang='31' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='31' AND b.id_status=5,1,0)) ) AS ma, 
								( SUM(IF(b.id_jenjang='34' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='34' AND b.id_status=5,1,0)) ) AS smk, 
								( SUM(IF(b.id_jenjang='90' AND b.id_status=4,1,0)) +
								SUM(IF(b.id_jenjang='90' AND b.id_status=5,1,0)) ) AS slb
						FROM sekolah_periodik a 
						INNER JOIN sekolah b ON a.id_sekolah=b.id_sekolah 
						INNER JOIN ref_kelurahan c ON b.id_kelurahan=c.id_kelurahan 
						INNER JOIN ref_kecamatan d ON c.id_kecamatan=d.id_kecamatan 
							WHERE a.tahun='".date("Y")."' GROUP BY c.id_kecamatan";
			$query 	= $this->DBSch->query($q);

			$data 	= ($query !== FALSE && $query->num_rows() > 0) ? $query->result_array() : array();

			return $data;

		}
		
		public function chartSiswabyKec(){
			$q 		= "SELECT e.kecamatan, SUM(IF(b.id_kelamin=4 AND c.id_jenjang='00',1,0)) AS siswa_tk_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='00',1,0)) AS siswa_tk_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='01',1,0)) AS siswa_ra_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='01',1,0)) AS siswa_ra_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='10',1,0)) AS siswa_sd_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='10',1,0)) AS siswa_sd_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='11',1,0)) AS siswa_mi_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='11',1,0)) AS siswa_mi_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='20',1,0)) AS siswa_smp_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='20',1,0)) AS siswa_smp_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='21',1,0)) AS siswa_mts_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='21',1,0)) AS siswa_mts_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='30',1,0)) AS siswa_sma_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='30',1,0)) AS siswa_sma_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='31',1,0)) AS siswa_ma_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='31',1,0)) AS siswa_ma_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='34',1,0)) AS siswa_smk_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='34',1,0)) AS siswa_smk_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='90',1,0)) AS siswa_slb_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='90',1,0)) AS siswa_slb_perempuan 
						FROM siswa_terdaftar a INNER JOIN siswa_data b ON a.id_siswa=b.id_siswa 
						INNER JOIN sekolah c ON a.id_sekolah=c.id_sekolah 
						INNER JOIN ref_kelurahan d ON c.id_kelurahan=d.id_kelurahan 
						INNER JOIN ref_kecamatan e ON d.id_kecamatan=e.id_kecamatan 
						WHERE a.tahun='".date("Y")."' AND a.id_status < 11 GROUP BY d.id_kecamatan";
			$query 	= $this->DBSch->query($q);

			$data 	= ($query !== FALSE && $query->num_rows() > 0) ? $query->result_array() : array();
			return $data;
		}
		
		public function chartGurubyKec(){
			$q 		= "SELECT e.kecamatan, SUM(IF(b.id_kelamin=4 AND c.id_jenjang='00',1,0)) AS guru_tk_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='00',1,0)) AS guru_tk_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='01',1,0)) AS guru_ra_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='01',1,0)) AS guru_ra_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='10',1,0)) AS guru_sd_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='10',1,0)) AS guru_sd_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='11',1,0)) AS guru_mi_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='11',1,0)) AS guru_mi_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='20',1,0)) AS guru_smp_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='20',1,0)) AS guru_smp_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='21',1,0)) AS guru_mts_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='21',1,0)) AS guru_mts_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='30',1,0)) AS guru_sma_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='30',1,0)) AS guru_sma_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='31',1,0)) AS guru_ma_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='31',1,0)) AS guru_ma_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='34',1,0)) AS guru_smk_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='34',1,0)) AS guru_smk_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='90',1,0)) AS guru_slb_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='90',1,0)) AS guru_slb_perempuan 
						FROM ptk_terdaftar a 
						INNER JOIN ptk_data b ON a.id_ptk=b.id_ptk 
						INNER JOIN sekolah c ON a.id_sekolah=c.id_sekolah 
						INNER JOIN ref_kelurahan d ON c.id_kelurahan=d.id_kelurahan 
						INNER JOIN ref_kecamatan e ON d.id_kecamatan=e.id_kecamatan 
						INNER JOIN ptk_penugasan f ON a.id_ptk_penugasan=f.id_ptk_penugasan 
							WHERE a.tahun='".date("Y")."' AND a.id_status_induk=4 AND f.id_ketenagaan=4 AND a.id_status < 11 GROUP BY d.id_kecamatan";
			$query 	= $this->DBSch->query($q);

			$data 	= ($query !== FALSE && $query->num_rows() > 0) ? $query->result_array() : array();
			return $data;
		}
		
		public function chartTendikbyKec(){
			$q 		= "SELECT e.kecamatan, SUM(IF(b.id_kelamin=4 AND c.id_jenjang='00',1,0)) AS tendik_tk_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='00',1,0)) AS tendik_tk_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='01',1,0)) AS tendik_ra_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='01',1,0)) AS tendik_ra_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='10',1,0)) AS tendik_sd_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='10',1,0)) AS tendik_sd_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='11',1,0)) AS tendik_mi_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='11',1,0)) AS tendik_mi_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='20',1,0)) AS tendik_smp_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='20',1,0)) AS tendik_smp_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='21',1,0)) AS tendik_mts_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='21',1,0)) AS tendik_mts_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='30',1,0)) AS tendik_sma_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='30',1,0)) AS tendik_sma_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='31',1,0)) AS tendik_ma_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='31',1,0)) AS tendik_ma_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='34',1,0)) AS tendik_smk_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='34',1,0)) AS tendik_smk_perempuan, 
							SUM(IF(b.id_kelamin=4 AND c.id_jenjang='90',1,0)) AS tendik_slb_laki2, 
							SUM(IF(b.id_kelamin=5 AND c.id_jenjang='90',1,0)) AS tendik_slb_perempuan 
						FROM ptk_terdaftar a INNER JOIN ptk_data b ON a.id_ptk=b.id_ptk 
						INNER JOIN sekolah c ON a.id_sekolah=c.id_sekolah 
						INNER JOIN ref_kelurahan d ON c.id_kelurahan=d.id_kelurahan 
						INNER JOIN ref_kecamatan e ON d.id_kecamatan=e.id_kecamatan 
						INNER JOIN ptk_penugasan f ON a.id_ptk_penugasan=f.id_ptk_penugasan 
						WHERE a.tahun='".date("Y")."' AND a.id_status_induk=4 AND f.id_ketenagaan=5 AND a.id_status < 11 GROUP BY d.id_kecamatan";
			$query 	= $this->DBSch->query($q);

			$data 	= ($query !== FALSE && $query->num_rows() > 0) ? $query->result_array() : array();
			return $data;
		}
		
		public function chartPrasaranabyKec(){
			$q 		= "SELECT d.nama as jenjang, 
							SUM(IF(a.id_jenis_prasarana=1 AND b.id_kondisi=4,1,0)) as ruang_kelas_baik, 
							SUM(IF(a.id_jenis_prasarana=1 AND b.id_kondisi=5,1,0)) as ruang_kelas_rusak_ringan, 
							SUM(IF(a.id_jenis_prasarana=1 AND b.id_kondisi=6,1,0)) as ruang_kelas_rusak_sedang, 
							SUM(IF(a.id_jenis_prasarana=1 AND b.id_kondisi=7,1,0)) as ruang_kelas_rusak_berat, 
							SUM(IF(a.id_jenis_prasarana=1 AND b.id_kondisi=8,1,0)) as ruang_kelas_rusak_total 
						FROM prasarana a INNER JOIN prasarana_kondisi b ON a.id_prasarana=b.id_prasarana 
						INNER JOIN sekolah c ON a.id_sekolah=c.id_sekolah 
						INNER JOIN ref_sekolah_jenjang d ON c.id_jenjang=d.id_jenjang 
							WHERE b.tahun='".date("Y")."' GROUP BY c.id_jenjang";
			$query 	= $this->DBSch->query($q);

			$data 	= ($query !== FALSE && $query->num_rows() > 0) ? $query->result_array() : array();
			return $data;
		}
	}
?>	