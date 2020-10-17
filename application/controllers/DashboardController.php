<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DashboardController extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('bappeda/Dashboardrenja_model', 'bappeda_model');
			$this->load->model('pengawasan/HasilPengawasanModel', 'was_model');
			$this->load->model('profil/AkuntansiPelaporanModel', 'akuntansi_pelaporan_model');
		}

		public function index(){	
					
			ini_set('max_execution_time', 300);					
			$this->load->view('front/dashboard', $data);
		}

		public function profil()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('front/profil', $data);	
		}

		public function hasil_pengawasan()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('front/hasilPengawasanView', $data);	
		}

		public function e_audit()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}
		public function e_dupak()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}
		public function e_dumas()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}
		public function m_tlhp()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}

		public function get_pengawasan()
		{
			$daerah = $this->input->post('daerah');
			$tahun 	= $this->input->post('tahun');


			$data['chartUmum1'] = $this->was_model->getChartUmum($daerah,$tahun);
			$data['chartTeknis1'] = $this->was_model->getChartTeknis($daerah,$tahun);
			$data['chartBinwas1'] = $this->was_model->getChartBinwas($daerah,$tahun);

			echo $this->load->view('front/menuPengawasanView', $data);	
		}

		public function get_detail_pengawasan()
		{
			$was = $this->input->post('was');
			$kode 	= $this->input->post('kode');
			$daerah = $this->input->post('daerah');
			$tahun 	= $this->input->post('tahun');

			$data['was'] = $was;
			$data['chartDetail'] = $this->was_model->getChartDetail($was,$kode,$daerah,$tahun);
			// $data['chartUmum2'] = $this->was_model->getChartDetail($was,$kode,$daerah,$tahun);
			
			echo $this->load->view('front/menuPengawasanDetailView', $data);	
		}

		public function get_sub_detail_pengawasan()
		{
			$was = $this->input->post('was');
			$kode 	= $this->input->post('kode');
			$daerah = $this->input->post('daerah');
			$tahun 	= $this->input->post('tahun');

			$data['was'] = $was;
			$data['chartSubDetail'] = $this->was_model->getChartSubDetail($was,$kode,$daerah,$tahun);
			// $data['chartUmum2'] = $this->was_model->getChartDetail($was,$kode,$daerah,$tahun);
			
			echo $this->load->view('front/menuPengawasanSubDetailView', $data);	
		}


		public function get_pengawasan2()
		{
			$daerah = $this->input->post('daerah');
			$tahun 	= $this->input->post('tahun');

			 $pie_umum = $this->was_model->pie_umum($daerah,$tahun);

			 $graph_umum = '[';
			 $graph_umum2 = '[';
			 $graph_umum3 = '[';
			 foreach ($pie_umum as $valueUmum) {
			 	$bobot = $valueUmum["bobot"]=null?0:(float)$valueUmum["bobot"];
			 	$id_par1 = $valueUmum["id_parameter"];
			 	$pie_umum2 = $this->was_model->pie_umum2($daerah,$tahun,$id_par1);


			 	$graph_umum .= '{
                    name: "'.$valueUmum["nm_parameter"].'",
                    y: '.$bobot.',
                    drilldown: "'.$id_par1.'"
                },';

                foreach ($pie_umum2 as $valueUmum2) {
					$graph_umum2 .= '{
                name: "'.$id_par1.'",
                id: "'.$id_par1.'",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ],
                    [
                        "v63.0",
                        53.02
                    ],
                    [
                        "v62.0",
                        1.4
                    ],
                    [
                        "v61.0",
                        0.88
                    ],
                    [
                        "v60.0",
                        0.56
                    ],
                    [
                        "v59.0",
                        0.45
                    ],
                    [
                        "v58.0",
                        0.49
                    ],
                    [
                        "v57.0",
                        0.32
                    ],
                    [
                        "v56.0",
                        0.29
                    ],
                    [
                        "v55.0",
                        0.79
                    ],
                    [
                        "v54.0",
                        0.18
                    ],
                    [
                        "v51.0",
                        0.13
                    ],
                    [
                        "v49.0",
                        2.16
                    ],
                    [
                        "v48.0",
                        0.13
                    ],
                    [
                        "v47.0",
                        0.11
                    ],
                    [
                        "v43.0",
                        0.17
                    ],
                    [
                        "v29.0",
                        0.26
                    ]
                ]
            },';                	
                }

			 }
                $graph_umum2 .= ']';
			 
                
			 
			 $graph_umum .= ']';



			 $data['graph_umum'] = $graph_umum;
			 $data['graph_umum2'] = $graph_umum2;
			 print_r($graph_umum);
			 print_r($graph_umum2);die();

			 
       		
			$data['umum'] = $this->was_model->get_umum($daerah,$tahun); 
			$data['teknis'] = $this->was_model->get_teknis($daerah,$tahun); 
			$data['binwas'] = $this->was_model->get_binwas($daerah,$tahun); 
			echo $this->load->view('front/menuPengawasanView', $data);	
		}

		public function get_info_keuangan()
		{
			
			$daerah = $this->input->post('daerah');
			$tahun 	= $this->input->post('tahun');
			$data['keuangan'] = $this->was_model->get_info_keuangan($daerah,$tahun); 
			
			echo $this->load->view('front/menuInfoKeuanganDaerahView', $data);	
		}

		public function index_info_pembangunan()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}
		public function index_info_keuangan()
		{
			ini_set('max_execution_time', 300);	
			// $data['menu']  = $this->db->query("SELECT * FROM ms_indikator_keuangan where clevel = 1 and tahun = 2020")->result(); 		
			// $this->load->view('front/infoKeuanganDaerahView', $data);	
			$this->load->view('front/infoKeuanganDaerahView', $data);	
		}
		public function index_info_lainnya()
		{
			ini_set('max_execution_time', 300);					
			$this->load->view('404', $data);	
		}

		public function get_info_akuntansi_pelaporan($id = 0){

				$data['nilai']=$this->akuntansi_pelaporan_model->getHeader($id);
				$data['urusanAnggaran']=$this->akuntansi_pelaporan_model->get_detail_ur_ro($id);
				$data['urusanReal']=$this->akuntansi_pelaporan_model->get_detail_ur_real_ro($id);
				$data['pendAnggaran']=$this->akuntansi_pelaporan_model->get_detail_pend_ro($id);
				$data['pendReal']=$this->akuntansi_pelaporan_model->get_detail_pend_real_ro($id);
				$data['countUr']=$this->akuntansi_pelaporan_model->get_count_ur($id);
				$data['countUrReal']=$this->akuntansi_pelaporan_model->get_count_ur_real($id);
				$data['countPend']=$this->akuntansi_pelaporan_model->get_count_pend($id);
				$data['kode']=$id;
				
				// $data['view'] = 'profil/editAkuntansiPelaporanView';
				$this->load->view('front/akuntansiPelaporanView', $data);
			
		}

	public function index2(){			
			ini_set('max_execution_time', 300);					
			
			$persentaseanggaran			= $this->bappeda_model->persentaseanggaran();
/* 			$anggaranProg				= $this->bappeda_model->anggaranperprog();		
			
			$jml 	= count($anggaranProg);			
			$i 		= 0;			
			$xAxis 	= ''; $anggaran= ''; $apbdkab=''; $apbdprov=''; $realisasi 	= ''; $apbddak=''; $apbn='';			
			foreach ($anggaranProg as $row) {				
				$xAxis 		.= "'".$row['program']."'";				
				$apbdkab 	.= $row['apbd_kab'];				
				$apbddak 	.= $row['apbd_dak'];				
				$apbdprov	.= $row['apbd_prov'];				
				$apbn 		.= $row['apbn'];
				if ($i < $jml-1) {					
					$xAxis .=','; $apbdkab .=','; $apbddak .=','; $apbdprov .=','; 	$apbn .=','; 					
				}				
				$i++;			
			}	
			$data['chartP_anggaran'] = array('xAxisVal'=>$xAxis, 'kabVal'=>$apbdkab, 'dakVal'=>$apbddak, 'provVal'=>$apbdprov, 'apbnVal'=>$apbn);
			 */
			foreach ($persentaseanggaran as $key => $value) {
				$data['persentase'][] = array("name"=>$key,   "y" =>$value);
			}		

			$data['persentase'] = json_encode($data['persentase'], JSON_NUMERIC_CHECK);
			
			$anggaranSkpd				= $this->bappeda_model->anggaranperskpd();		
			$jml 	= count($anggaranSkpd);			
			$i 		= 0;			
			$xAxis 	= ''; $anggaran= ''; $apbdkab=''; $apbdprov=''; $realisasi 	= ''; $apbddak=''; $apbn='';			
			foreach ($anggaranSkpd as $row) {				
				$xAxis 		.= "'".$row['skpd']."'";				
				$apbdkab 	.= $row['apbd_kab'];				
				$apbddak 	.= $row['apbd_dak'];				
				$apbdprov	.= $row['apbd_prov'];				
				$apbn 		.= $row['apbn'];
				if ($i < $jml-1) {					
					$xAxis .=','; $apbdkab .=','; $apbddak .=','; $apbdprov .=','; 	$apbn .=','; 					
				}				
				$i++;			
			}	
			$data['chartP_anggaranSKPD'] = array('xAxisVal'=>$xAxis, 'kabVal'=>$apbdkab, 'dakVal'=>$apbddak, 'provVal'=>$apbdprov, 'apbnVal'=>$apbn);
			
			$anggaranKeg				= $this->bappeda_model->anggaranperKeg();		
			$jml 	= count($anggaranKeg);			
			$i 		= 0;			
			$xAxis 	= ''; $anggaran= ''; $apbdkab=''; $apbdprov=''; $realisasi 	= ''; $apbddak=''; $apbn='';			
			foreach ($anggaranKeg as $row) {				
				$xAxis 		.= "'".$row['kegiatan']."'";				
				$apbdkab 	.= $row['apbd_kab'];				
				$apbddak 	.= $row['apbd_dak'];				
				$apbdprov	.= $row['apbd_prov'];				
				$apbn 		.= $row['apbn'];
				if ($i < $jml-1) {					
					$xAxis .=','; $apbdkab .=','; $apbddak .=','; $apbdprov .=','; 	$apbn .=','; 					
				}				
				$i++;			
			}	
			$data['chartP_anggaranKeg'] = array('xAxisVal'=>$xAxis, 'kabVal'=>$apbdkab, 'dakVal'=>$apbddak, 'provVal'=>$apbdprov, 'apbnVal'=>$apbn);

			// $this->mybreadcrumb->add('Dashboard', base_url('dashboard-perencanaan'));
			// $this->mybreadcrumb->add('Perencanaan', base_url('dashboard-perencanaan'));
			// $data['breadcrumbs'] = $this->mybreadcrumb->render();
			$data['view'] = 'admin/dashboard/bappeda';			// $data['view'] 		= 'keuangan/dashboard';
			$this->load->view('template/layout', $data);
		}






	}

?>	