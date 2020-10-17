<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('pemantauan/PemantauanModel', 'pantau_model');
		}

		public function index(){			
			ini_set('max_execution_time', 300);					
			$data['view'] = 'admin/dashboard/index';
			$this->load->view('template/layout', $data);
		}

		public function pencarian(){			
			ini_set('max_execution_time', 300);					
			$data['view'] = 'admin/dashboard/pencarian';
			$this->load->view('template/layout', $data);
		}

		public function search_kegiatan() {
			$tahun 	= $this->session->userdata('thn_ang');
			$filter = $_POST['filter'];
			$key	= $_POST['key'];
			
			$data['result'] = $this->pantau_model->search_kegiatan($tahun,$filter,$key); 

	        echo json_encode($data);
		}

		public function top_real_dashboard() {
			$tahun = $this->session->userdata('thn_ang');
			$data = $this->pantau_model->get_top_keu($tahun);
	        echo json_encode($data);
		}

		public function mpdf()
		{
			$mpdf = new \Mpdf\Mpdf();
			$data['view'] = 'admin/dashboard/index';
			$html = $this->load->view('template/layout', $data,true);
			// $html = $this->load->view('mpdfView',[],true);
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}

		public function manual()
		{
			$this->load->helper('download');
			$data   = file_get_contents(base_url().'assets/pdf/manualbook.pdf');
			force_download('ManualBook.pdf', $data);
		}

		public function get_chart_keu() {
			$skpd = $_POST['skpd'];
			$tahun = $this->session->userdata('thn_ang');

			$config =  $this->db->query('SELECT * FROM ms_config where tahun_anggaran = '.$tahun.' limit 1')->row();
			$stsAng = $config->sts_anggaran;
			

				$sql = "SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd, sum(dau.total) as susun,sum(dau.total_ubah) as ubah,
				SUM(dau.real_keuangan1) as tw1
			,SUM(dau.real_keuangan2) as tw2,SUM(dau.real_keuangan3) as tw3,SUM(dau.real_keuangan4) as tw4
			FROM ms_skpd s 
			LEFT JOIN ( SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,
									ak.kd_rek5,ak.nm_rek5, p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,
									p.harga_ubah1,p.total,p.total_ubah,
									keuangan1 as real_keuangan1,
									keuangan2 as real_keuangan2,
									keuangan3 as real_keuangan3,
									keuangan4 as real_keuangan4
									FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan
									and ak.kd_rek5 = p.kd_rek5 LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and
									r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po 
									WHERE ak.kd_skpd = '$skpd' and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd 
									WHERE thn_anggaran = $tahun and sts_anggaran = '$stsAng' and kd_group_sd in(1,2,3,4,5,6,7)) and ak.ta = $tahun)
									dau ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
									WHERE dau.kd_skpd = '$skpd'
									GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd";
			


			$res_nilai = $this->db->query($sql)->row();
			if($stsAng == 'Murni'){
				$target[0] = round($res_nilai->susun,2)*(1/4);
				$target[1] = round($res_nilai->susun,2)*(1/2);
				$target[2] = round($res_nilai->susun,2)*(3/4);
				$target[3] = round($res_nilai->susun,2);
			}else{
				$target[0] = round($res_nilai->ubah,2)*(1/4);
				$target[1] = round($res_nilai->ubah,2)*(1/2);
				$target[2] = round($res_nilai->ubah,2)*(3/4);
				$target[3] = round($res_nilai->ubah,2);
			}

			$real[0] = round($res_nilai->tw1,2);
			$real[1] = round($res_nilai->tw2,2);
			$real[2] = round($res_nilai->tw3,2);
			$real[3] = round($res_nilai->tw4,2);

			$nama[0] = "TRIWULAN 1";
			$nama[1] = "TRIWULAN 2";
			$nama[2] = "TRIWULAN 3";
			$nama[3] = "TRIWULAN 4";

			$data['nama'] 			= $nama;
			$data['target'] 		= $target;
			$data['real'] 			= $real;
			

			
	        echo json_encode($data);
		}


		public function get_chart_fisik() {

			$skpd = $_POST['skpd'];
			$tahun = $this->session->userdata('thn_ang');

			$config =  $this->db->query('SELECT * FROM ms_config where tahun_anggaran = '.$tahun.' limit 1')->row();
			$stsAng = $config->sts_anggaran;

			if($stsAng == 'Murni'){
				$vol = 'tvolume';
			}else{
				$vol = 'tvolume_ubah';
			}
			

				$sql = "SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd, 
				(SUM(dau.persenFisik1)/COUNT(dau.ta)) as persenFis1,
				(SUM(dau.persenFisik2)/COUNT(dau.ta)) as persenFis2,
				(SUM(dau.persenFisik3)/COUNT(dau.ta)) as persenFis3,
				(SUM(dau.persenFisik4)/COUNT(dau.ta)) as persenFis4
			FROM ms_skpd s 
			LEFT JOIN ( SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,
									ak.kd_rek5,ak.nm_rek5, p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,
									p.harga_ubah1,p.total,p.total_ubah,
									(fisik1/p.$vol)* 100 as persenFisik1,
									(fisik2/p.$vol)* 100 as persenFisik2,
									(fisik3/p.$vol)* 100 as persenFisik3,
									(fisik4/p.$vol)* 100 as persenFisik4
									FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan
									and ak.kd_rek5 = p.kd_rek5 LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and
									r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po 
									WHERE ak.kd_skpd = '$skpd' and p.$vol <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd 
									WHERE thn_anggaran = $tahun and sts_anggaran = '$stsAng' and kd_group_sd in(1,2,3,4,5,6,7)) and ak.ta = $tahun)
									dau ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
									WHERE dau.kd_skpd = '$skpd'
									GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd";

			$res_nilai = $this->db->query($sql)->row();
			
			$target[0] = 25;
			$target[1] = 50;
			$target[2] = 75;
			$target[3] = 100;
			

			$real[0] = round($res_nilai->persenFis1,2);
			$real[1] = round($res_nilai->persenFis2,2);
			$real[2] = round($res_nilai->persenFis3,2);
			$real[3] = round($res_nilai->persenFis4,2);

			$nama[0] = "TRIWULAN 1 (%)";
			$nama[1] = "TRIWULAN 2 (%)";
			$nama[2] = "TRIWULAN 3 (%)";
			$nama[3] = "TRIWULAN 4 (%)";

			$data['nama'] 			= $nama;
			$data['target'] 		= $target;
			$data['real'] 			= $real;
			

			
	        echo json_encode($data);
		}	






	}

?>	