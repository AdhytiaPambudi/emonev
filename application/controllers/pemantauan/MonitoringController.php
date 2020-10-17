<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class MonitoringController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('master/DaerahModel', 'daerah_model');
			$this->load->model('setting/DatabaseModel', 'db_model');
            $this->load->model('master/MasterModel', 'master_model');
			$this->load->model('pemantauan/MonitoringModel', 'monitor_model');
			$this->load->model('PublicModel', 'public_model');
		}

		public function index_skpd(){
			$data['view'] = 'master/skpdView';
			$this->load->view('template/layout', $data);
		}

		public function index(){
			$data['view'] = 'monitoring/monitoringView';
			$this->load->view('template/layout', $data);
		}
		
		public function get_monitoring_skpd(){
			$data = $this->monitor_model->viewPantauSKPD();
			echo $data;
		}

		public function get_monitoring_program(){
			$skpd = $_GET['skpd'];
			$data = $this->monitor_model->viewPantauProgram($skpd);
			echo $data;
		}
		
		public function get_monitoring_kegiatan(){
			
			$skpd = $_GET['skpd'];
			$prog = $_GET['prog'];
			$data = $this->monitor_model->viewPantauKegiatan($skpd,$prog);
			echo $data;
		}
		
		public function get_monitoring_rekening_kegiatan(){
			$skpd = $_GET['skpd'];
			$prog = $_GET['prog'];
			$keg = $_GET['keg'];
			
			$data = $this->monitor_model->viewPantauRincianKegiatan($skpd,$prog,$keg);
			echo $data;
		}
		
		public function get_rinci_kegiatan(){
			
			$thn  = $_GET['thn'];
			$keg = $_GET['keg'];
			$rek  = $_GET['rek'];
			$skpd  = $_GET['skpd'];
			$po  = $_GET['po'];
			$sts_ubah = 'Perubahan';


			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			$filelTemp 		= str_replace($searchdok, $replace, $dokumentasi);
			$kegTemp 		= str_replace($search, $replace, $keg);
			$rekTemp 		= str_replace($search, $replace, $rek);
			$poTemp 		= str_replace($search, $replace, $po);
			
			$data = $this->monitor_model->modalPantauRincianKegiatan($thn,$keg,$rek,$po);
			
			foreach ($data as $value) {
				$result['tahun_anggaran'] 	= $value['tahun_anggaran'];
				$result['kd_kegiatan'] 		= $value['kd_kegiatan'];
            	$result['kode'] 			= $value['kode'];
            	$result['uraian'] 			= $value['uraian'];
				$result['no'] 				= $value['no'];
				if($sts_ubah == 'Murni'){
					$result['tvolume'] 			= number_format($value['tvolume'],'2',',','.');
					$result['satuan1'] 			= $value['satuan1'];
					$result['harga1'] 			= $value['harga1'];
					$result['total'] 			= number_format($value['total'],'2',',','.');
					$result['tot_target_keg'] 	= number_format($value['tot_target_keg'],'2',',','.');
					$result['tot_persen_keuangan'] 	= number_format(($value['tot_real_keuangan']/$value['tot_target_keg'])*100,'2',',','.');
					$persenFisik = ($value['tot_real_fisik']/$value['tvolume'])*100;
					$result['tot_persen_fisik'] 	= number_format($persenFisik,'2',',','.'); 
					
				}else{
					$result['tvolume'] 			= number_format($value['tvolume_ubah'],'2',',','.');
					$result['satuan1'] 			= $value['satuan_ubah1'];
					$result['harga1'] 			= $value['harga_ubah1'];
					$result['total'] 			= number_format($value['total_ubah'],'2',',','.');
					$result['tot_target_keg'] 	= number_format($value['tot_target_keg_ubah'],'2',',','.');
					$result['tot_persen_keuangan'] 	= number_format(($value['tot_real_keuangan']/$value['tot_target_keg_ubah'])*100,'2',',','.');

					$persenFisik = ($value['tot_real_fisik']/$value['tvolume_ubah'])*100;
					$result['tot_persen_fisik'] 	= number_format($persenFisik,'2',',','.'); 
				}

				$result['monitoring_meja'] 	= $value['monitoring_meja'];
				$result['monitoring_lapangan'] 		= $value['monitoring_lapangan'];


				
            	
            	
            	
            	
            	
				// $result['total_ubah'] 		= number_format($value['total_ubah'],'2',',','.');
				$result['fisik1'] 	= number_format($value['fisik1'],'2',',','.'); 
				$result['keuangan1'] = number_format($value['keuangan1'],'2',',','.');
				$result['fisik2'] 	= number_format($value['fisik2'],'2',',','.'); 
				$result['keuangan2']= number_format($value['keuangan2'],'2',',','.');
				$result['fisik3'] 	= number_format($value['fisik3'],'2',',','.'); 
				$result['keuangan3']= number_format($value['keuangan3'],'2',',','.');
				$result['fisik4'] 	= number_format($value['fisik4'],'2',',','.'); 
				$result['keuangan4']= number_format($value['keuangan4'],'2',',','.');

            	$result['tot_real_fisik'] 	= number_format($value['tot_real_fisik'],'2',',','.'); 
				$result['tot_real_keuangan']= number_format($value['tot_real_keuangan'],'2',',','.');
				
				$result['nilai_kontrak']= number_format($value['nilai_kontrak'],'2',',','.');
				$result['kontraktor']= $value['kontraktor'];
				$result['no_kontrak']= $value['no_kontrak'];
				$result['distrik']= $value['distrik'];
				$result['kampung']= $value['kampung'];
				$result['koordinat']= $value['koordinat'];
				$result['keterangan']= $value['keterangan'];
				$result['bentuk']= $value['bentuk'];

				$folderRK		= 'assets/rab_kontrak/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';


				$result['file_rab']		= $value['file_rab'];
				if($value['file_rab'] <> ''){
					$result['preview_rab'] = "<a href='".base_url().$folderRK.$value['file_rab']."' class='btn btn-xs btn-flat btn-success btn-block' target= '_blank'>PREVIEW</a>";
				}else{
					$result['preview_rab'] = '';
				}

				$result['file_sampul']	= $value['file_kontrak'];
				if($value['file_kontrak'] <> ''){
					$result['preview_kontrak'] = "<a href='".base_url().$folderRK.$value['file_kontrak']."' target= '_blank' class='btn btn-xs btn-flat btn-success btn-block'>PREVIEW</a>";
				}else{
					$result['preview_kontrak'] = '';
				}
				
			}

			
			
			$folderFile		= 'assets/dokumentasi/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';
			$cekTable = $this->db->get_where('trdreal_lamp', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po))->result();	

				if (count($cekTable) <> 0) {
					$htmlTable = '';
					$noFile = 1;
					foreach ($cekTable as $value) {
						$kd_lamp = $value->kd_lamp;
						if ($value->file <> '') {
							$fileDok=base_url().$folderFile.$value->file;
							
						}else{
							$fileDok = ''; 
						}
						$htmlTable .= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">                 
                                    <a target="_blank" href="'.$fileDok.'" class="gambar-dok">
                                      <img src="'.$fileDok.'" alt="Forest">
                                    </a>
                                </div>';
					}
					
				}else{
					$htmlTable = '';
				}
				$result['tableLampiran'] = $htmlTable;
				$result['tbldokumentasi'] = $htmlTable;

				$config =  $this->db->query('SELECT * FROM ms_config where tahun_anggaran = '.$thn.' and kd_skpd = "'.$skpd.'" limit 1')->row();
				if(count($config) > 0){
					$result['tw1'] = $config->show_triwulan1;
					$result['tw2'] = $config->show_triwulan2;
					$result['tw3'] = $config->show_triwulan3;
					$result['tw4'] = $config->show_triwulan4; 
				}else{
					$result['tw1'] = 'T';
					$result['tw2'] = 'T';
					$result['tw3'] = 'T';
					$result['tw4'] = 'T'; 
				}




				$result['tblfisik'] = '
                                    <tr>
                                        <td style="text-align:center;">'.$result["tvolume"].' '.$result["satuan1"].'</td>
                                        <td style="text-align:center;">'.$result["fisik1"].' '.$result["satuan1"].'</td>
                                        <td style="text-align:center;">'.$result["fisik2"].' '.$result["satuan1"].'</td>
                                        <td style="text-align:center;">'.$result["fisik3"].' '.$result["satuan1"].'</td>
                                        <td style="text-align:center;">'.$result["fisik4"].' '.$result["satuan1"].'</td>
                                        <td style="text-align:center;">'.$result["tot_real_fisik"].' '.$result["satuan1"].'</td>
                                        <td style="text-align:center;">'.$result["tot_persen_fisik"].' %</td>
                                    </tr>';

                $result['tblkeu'] = '
                                    <tr>
                                        <td style="text-align:right;">'.$result["total"].'</td>
                                        <td style="text-align:right;">'.$result["keuangan1"].'</td>
                                        <td style="text-align:right;">'.$result["keuangan2"].'</td>
                                        <td style="text-align:right;">'.$result["keuangan3"].'</td>
                                        <td style="text-align:right;">'.$result["keuangan4"].'</td>
                                        <td style="text-align:right;">'.$result["tot_real_keuangan"].'</td>
                                        <td style="text-align:center;">'.$result["tot_persen_keuangan"].' %</td>
                                    </tr>';

                 if ($result["bentuk"] == 'K') {
                 	$styleK = '';
                 	$styleNK = ' style="text-decoration: line-through red;"';
                 }elseif ($result["bentuk"] == 'NK') {
                 	$styleK = ' style="text-decoration: line-through red;"';
                 	$styleNK = '';
                 }else{
                 	$styleK = '';
                 	$styleNK = '';
                 }
				$result['tblkontrak'] = '
                                    <tr>
                                        <td style="text-align:center;"><span '.$styleNK.'>Non Kontraktual</span> / <span '.$styleK.'>Kontraktual</span></td>
                                        <td style="text-align:left;">'.$result["no_kontrak"].'</td>
                                        <td style="text-align:left;">'.$result["kontraktor"].'</td>
                                        <td style="text-align:right;">'.$result["nilai_kontrak"].'</td>
                                    </tr>';     

                $result['tbllokasi'] = '
                                    <tr>
                                        <td style="text-align:left;">'.$result["distrik"].'</td>
                                        <td style="text-align:left;">'.$result["kampung"].'</td>
                                        <td style="text-align:center;">'.$result["koordinat"].'</td>
                                        <td style="text-align:left;">'.nl2br($result["keterangan"]).'</td>
                                    </tr>';      

                                        
				

			echo json_encode($result);
		}
		
		public function get_rinci_dokumentasi(){
			
			
			$thn  = $_GET['thn'];
			$keg = $_GET['keg'];
			
			$cekTable = $this->db->get_where('trdreal_lamp', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg))->result();	

				if (count($cekTable) <> 0) {
					$htmlTable = '';
					$noFile = 1;
					foreach ($cekTable as $value) {

						$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
						$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
						$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
						$filelTemp 		= str_replace($searchdok, $replace, $dokumentasi);
						$kegTemp 		= str_replace($search, $replace, $keg);
						$rekTemp 		= str_replace($search, $replace, $value->kd_rek);
						$poTemp 		= str_replace($search, $replace, $value->no_po);
						
						$folderFile		= 'assets/dokumentasi/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';


						$kd_lamp = $value->kd_lamp;
						if ($value->file <> '') {
							$fileDok="<img src='".base_url().$folderFile.$value->file."' width='100px'>";
							
						}else{
							$fileDok = ''; 
						}

						if ($value->status == 1) {
							$pub="<label class='label label-success'>Aktif</label>";
							
						}else{
							$pub = ''; 
						}
						$htmlTable .= '<tr>
										<td class="active" style="text-align: center;vertical-align:middle;">
										'.$noFile++.'
										</td>  
										<td style="text-align: center;">
											'.$fileDok.'
										</td>  
										<td>
										'.$pub.'
										</td>
										<td style="vertical-align:middle;">
											<button class="btn btn-success aktif-lampiran" type="button" data-aksi="1" data-thn="'.$value->tahun_anggaran.'" data-lamp="'.$value->kd_lamp.'" data-keg="'.$value->kd_kegiatan.'" data-rek="'.$value->kd_rek.'" data-po="'.$value->no_po.'"><i class="fa fa-eye"></i></button>
											<button class="btn btn-default aktif-lampiran" type="button" data-aksi="0" data-thn="'.$value->tahun_anggaran.'" data-lamp="'.$value->kd_lamp.'" data-keg="'.$value->kd_kegiatan.'" data-rek="'.$value->kd_rek.'" data-po="'.$value->no_po.'"><i class="fa fa-eye-slash"></i></button>
										</td>  
									</tr>';
					}
					$htmlTable .='<script type="text/javascript">
									$(document).ready(function () {
										$(\'[data-toggle="tooltip"]\').tooltip();
									});
									</script>';
				}else{
					$htmlTable = '';
				}
				$result['tableLampiran'] = $htmlTable;

			echo json_encode($result);
		}
		
		public function aktif_dokumentasi(){
			
			
			$thn  = $_GET['thn'];
			$keg = $_GET['keg'];
			$lamp = $_GET['lamp'];
			$rek = $_GET['rek'];
			$po = $_GET['po'];
			$aksi = $_GET['aksi'];
			
			$whereUpdate = array(
				'tahun_anggaran' 		=> $thn,
				'kd_kegiatan' 			=> $keg,
				'kd_rek' 			=> $rek,
				'no_po' 				=> $po,
				'kd_lamp' 				=> $lamp,
			);
			$dataUpdate = array(
				'status' 		=> $aksi,
			);


			$this->db->where($whereUpdate);
			$this->db->update('trdreal_lamp', $dataUpdate);
			
			$hasilPrimary = $this->db->affected_rows();
			
			$cekTable = $this->db->get_where('trdreal_lamp', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg))->result();	

				if (count($cekTable) <> 0) {
					$htmlTable = '';
					$noFile = 1;
					foreach ($cekTable as $value) {

						$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
						$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
						$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
						$filelTemp 		= str_replace($searchdok, $replace, $dokumentasi);
						$kegTemp 		= str_replace($search, $replace, $keg);
						$rekTemp 		= str_replace($search, $replace, $value->kd_rek);
						$poTemp 		= str_replace($search, $replace, $value->no_po);
						
						$folderFile		= 'assets/dokumentasi/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';


						$kd_lamp = $value->kd_lamp;
						if ($value->file <> '') {
							$fileDok="<img src='".base_url().$folderFile.$value->file."' width='100px'>";
							
						}else{
							$fileDok = ''; 
						}

						if ($value->status == 1) {
							$pub="<label class='label label-success'>Aktif</label>";
						}else{
							$pub = ''; 
						}
						$htmlTable .= '<tr>
										<td class="active" style="text-align: center;vertical-align:middle;">
										'.$noFile++.'
										</td>  
										<td style="text-align: center;">
											'.$fileDok.'
										</td>  
										<td>
										'.$pub.'
										</td>
										<td style="vertical-align:middle;">
											<button class="btn btn-success aktif-lampiran" type="button" data-aksi="1" data-thn="'.$value->tahun_anggaran.'" data-lamp="'.$value->kd_lamp.'" data-keg="'.$value->kd_kegiatan.'" data-rek="'.$value->kd_rek.'" data-po="'.$value->no_po.'"><i class="fa fa-eye"></i></button>
											<button class="btn btn-default aktif-lampiran" type="button" data-aksi="0" data-thn="'.$value->tahun_anggaran.'" data-lamp="'.$value->kd_lamp.'" data-keg="'.$value->kd_kegiatan.'" data-rek="'.$value->kd_rek.'" data-po="'.$value->no_po.'"><i class="fa fa-eye-slash"></i></button>
										</td>  
									</tr>';
					}
					$htmlTable .='<script type="text/javascript">
									$(document).ready(function () {
										$(\'[data-toggle="tooltip"]\').tooltip();
									});
									</script>';
				}else{
					$htmlTable = '';
				}
				$result['tableLampiran'] = $htmlTable;

			echo json_encode($result);
        }
        
        public function detail(){
			$skpd = $_GET['skpd'];
			$this->db->select('kd_skpd,nm_skpd');
			$this->db->where('kd_skpd',$skpd);
			$result = $this->db->get('ms_skpd')->row();
			$data['dinas'] = $result->nm_skpd;
			$data['kode'] = $result->kd_skpd;
			$data['view'] = 'monitoring/detailMonitoringView';
			$this->load->view('template/layout', $data);
        }
        
        public function detail_kegiatan(){
            $skpd = $_GET['skpd'];
			$prog = $_GET['prog'];
			
			$this->db->select('kd_skpd,nm_skpd,kd_program,nm_program');
			$this->db->where('kd_skpd',$skpd);
			$this->db->where('kd_program',$prog);
			$result = $this->db->get('trskpd')->row();
			
			$data['dinas'] = $result->nm_skpd;
			$data['kode_dinas'] = $result->kd_skpd;
			$data['program'] = $result->nm_program;
			$data['kode_program'] = $result->kd_program;
			$data['view'] = 'monitoring/detailMonitoringKegiatanView';
			$this->load->view('template/layout', $data);
		}

		public function rekening_kegiatan(){
            $skpd = $_GET['skpd'];
			$prog = $_GET['prog'];
			$keg = $_GET['keg'];
			
			$this->db->select('kd_skpd,nm_skpd,kd_program,nm_program,kd_kegiatan,nm_kegiatan');
			$this->db->where('kd_skpd',$skpd);
			$this->db->where('kd_program',$prog);
			$this->db->where('kd_kegiatan',$keg);
			$result = $this->db->get('trskpd')->row();
			
			$data['dinas'] = $result->nm_skpd;
			$data['kode_dinas'] = $result->kd_skpd;
			$data['program'] = $result->nm_program;
			$data['kode_program'] = $result->kd_program;
			$data['kegiatan'] = $result->nm_kegiatan;
			$data['kode_kegiatan'] = $result->kd_kegiatan;
			$data['view'] = 'monitoring/detailMonitoringRekKegiatanView';
			$this->load->view('template/layout', $data);
		}


		public function input_data_monitoring()
		{
			
			$ta 		= $this->input->post('tahun_anggaran');
			$keg		= $this->input->post('kd_kegiatan');
			$rek		= $this->input->post('kode_rek');
			$po			= $this->input->post('kode_po');

		


			// insert data primary
			$cekData = $this->db->get_where('trdreal', array('tahun_anggaran' => $ta,'kd_kegiatan' => $keg,'kd_rekening' => $rek,'no_rinci' => $po))->result();	
			
			if (count($cekData) <> 0) {
				// update
				$dataUpdate = array(
					'monitoring_meja'	 	=> $_POST['monitoring_meja'],
					'monitoring_lapangan'	 	=> $_POST['monitoring_lapangan'],
				);

				
				

				$whereUpdate = array(
					'tahun_anggaran' 		=> $ta,
					'kd_kegiatan' 			=> $keg,
					'kd_rekening' 			=> $rek,
					'no_rinci' 				=> $po
				);


				$this->db->where($whereUpdate);
				$this->db->update('trdreal', $dataUpdate);
				$hasilPrimary = $this->db->affected_rows();
			}else{
				// insert
				$dataInsert = array(
						'tahun_anggaran' 		=> $ta,
						'kd_kegiatan' 			=> $keg,
						'kd_rekening' 			=> $rek,
						'no_rinci' 				=> $po,
						'monitoring_meja'	 	=> $_POST['monitoring_meja'],
						'monitoring_lapangan'	 	=> $_POST['monitoring_lapangan'],
					);
				
				$this->db->insert('trdreal', $dataInsert);
				
				$hasilPrimary = $this->db->affected_rows();
			}

			if(count($hasilPrimary) <> 0){
				$dataBalikan['pesan'] = "Data Berhasil Diupdate!";
			}
			


		        echo json_encode($dataBalikan);	
		}
		
		public function input_data_pemantauan_file()
		{
			$ta 		= $this->input->post('tahun_anggaran');
			$keg		= $this->input->post('kd_kegiatan');
			$rek		= $this->input->post('kode_rek');
			$po		= $this->input->post('kode_po');
			$dok		= $this->input->post('dokumentasi');
			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			$filelTemp 		= str_replace($searchdok, $replace, $dokumentasi);
			$kegTemp 		= str_replace($search, $replace, $keg);
			$rekTemp 		= str_replace($search, $replace, $rek);
			$poTemp 		= str_replace($search, $replace, $po);
			

			
			$folder			= 'assets/dokumentasi/'.$ta.'/';
			$folder1		= 'assets/dokumentasi/'.$ta.'/'.$kegTemp.'/';
			$folder2		= 'assets/dokumentasi/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/';
			
			$folder3		= 'assets/dokumentasi/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';

			
			if (!file_exists($folder))
			{
				mkdir($folder); 
			}
			if (!file_exists($folder1))
			{
				mkdir($folder1); 
			}
			if (!file_exists($folder2))
			{
				mkdir($folder2); 
			}
			if (!file_exists($folder3))
			{
				mkdir($folder3); 
			}

			
			$files = $_FILES['nm_lampiran2'];  
			
			$jmlFile = count($files['name']);
			
            $config=array(  
	            'upload_path' => './'.$folder3, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

            // for ($i=0; $i < $jmlFile ; $i++) { 

			$convertFile = str_replace(' ', '_', $files['name'][$i]);
			
			$pathAndFile = $folder3.$convertFile;
			
           		if($convertFile <> ''){
                	$_FILES['nm_lampiran2']['name'] = $convertFile; 
	                $_FILES['nm_lampiran2']['type'] = $files['type'][$i];  
	                $_FILES['nm_lampiran2']['tmp_name'] = $files['tmp_name'][$i];  
	                $_FILES['nm_lampiran2']['error'] = $files['error'][$i];  
	                $_FILES['nm_lampiran2']['size'] = $files['size'][$i];  
	                $this->load->library('upload', $config); 
	                if (file_exists($pathAndFile)) {
	                	unlink($pathAndFile);
	                } 
	                $this->upload->do_upload('nm_lampiran2');
	                $upload = 1;
	         	}else{
	         		$convertFile = '';
				 }
				 
				 
            // }

				 
			
					// edit
					$max_id=$this->monitor_model->get_max_lamp($ta,$keg,$rek,$po);
					

            		$kd_lamp = $max_id;
         			$where = array();
					if ($upload == 1) {
						$data = array(
							'tahun_anggaran' 		=> $ta,
							'kd_kegiatan'		=>$keg,
							'kd_rek' 	=> $rek,
							'no_po' 	=> $po,
							'kd_lamp' 		=> $kd_lamp,
							'file' 			=> $convertFile,
						);
					}else{
						$data = array(
							'tahun_anggaran' 	=> $ta,
							'kd_kegiatan'		=>$keg,
							'kd_rek' 			=> $rek,
							'no_po' 			=> $po,
							'kd_lamp' 			=> $kd_lamp,
						);
					}

					$data = $this->security->xss_clean($data);
					$result = $this->monitor_model->insertLampiranDokumentasi($data);
					if($result){
						$dataBalikan['pesan'] = "Data Berhasil Diupdate!";
					}
					
					
			$cekTable = $this->db->get_where('trdreal_lamp', array('tahun_anggaran' => $ta,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po))->result();	
			$folderFile = $folder3;
				if (count($cekTable) <> 0) {
					$htmlTable = '';
					$noFile = 1;
					foreach ($cekTable as $value) {
						$kd_lamp = $value->kd_lamp;
						if ($value->file <> '') {
							$fileDok="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderFile.$value->file."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
							
						}else{
							$fileDok = ''; 
						}
						$htmlTable .= '<tr>
										<td class="active" style="width:10%;text-align: center;vertical-align:middle;">
										'.$noFile++.'
										</td>  
										<td style="width:5%;text-align: center;">
											'.$fileDok.'
										</td>  
										<td>
										<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$value->file.'">
										</td>
										<td style="vertical-align:middle;">
											<div class="inputWrapperRemove"  data-toggle="tooltip" title="Hapus">
											<button class="fileInput hapus-lampiran" type="button" data-thn="'.$value->tahun_anggaran.'" data-lamp="'.$value->kd_lamp.'" data-keg="'.$value->kd_kegiatan.'" data-rek="'.$value->kd_rek.'" data-po="'.$value->no_po.'"><i class="fa fa-trash"></i></button>
											</div>
										</td>  
									</tr>';
					}
					$htmlTable .='<script type="text/javascript">
									$(document).ready(function () {
										$(\'[data-toggle="tooltip"]\').tooltip();
									});
									</script>';
				}else{
					$htmlTable = '';
				}
				$dataBalikan['tableLampiran'] = $htmlTable;

		        echo json_encode($dataBalikan);	
		}


		public function del_data_pemantauan_file(){
			
			$thn  = $_GET['thn'];
			$keg = $_GET['keg'];
			$rek  = $_GET['rek'];
			$po  = $_GET['po'];
			$kd_lamp  = $_GET['lamp'];
			



			$result = $this->db->delete('trdreal_lamp', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po,'kd_lamp' => $kd_lamp));
			if($result){
				$dataBalikan['pesan'] = "Data Berhasil Diupdate!";
			}

			
			// get modal again

			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			// $filelTemp 		= str_replace($searchdok, $replace, $dokumentasi);
			$kegTemp 		= str_replace($search, $replace, $keg);
			$rekTemp 		= str_replace($search, $replace, $rek);
			$poTemp 		= str_replace($search, $replace, $po);
			
			$folderFile		= 'assets/dokumentasi/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';

			$cekTable = $this->db->get_where('trdreal_lamp', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po))->result();	
			
				if (count($cekTable) <> 0) {
					$htmlTable = '';
					$noFile = 1;
					foreach ($cekTable as $value) {
						$kd_lamp = $value->kd_lamp;
						if ($value->file <> '') {
							$fileDok="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderFile.$value->file."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
							
						}else{
							$fileDok = ''; 
						}
						$htmlTable .= '<tr>
										<td class="active" style="width:10%;text-align: center;vertical-align:middle;">
										'.$noFile++.'
										</td>  
										<td style="width:5%;text-align: center;">
											'.$fileDok.'
										</td>  
										<td>
										<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$value->file.'">
										</td>
										<td style="vertical-align:middle;">
											<div class="inputWrapperRemove"  data-toggle="tooltip" title="Hapus">
											<button class="fileInput hapus-lampiran" type="button" data-thn="'.$value->tahun_anggaran.'" data-lamp="'.$value->kd_lamp.'" data-keg="'.$value->kd_kegiatan.'" data-rek="'.$value->kd_rek.'" data-po="'.$value->no_po.'"><i class="fa fa-trash"></i></button>
											</div>
										</td>  
									</tr>';
					}
					$htmlTable .='<script type="text/javascript">
									$(document).ready(function () {
										$(\'[data-toggle="tooltip"]\').tooltip();
									});
									</script>';
				}else{
					$htmlTable = '';
				}
				$dataBalikan['tableLampiran'] = $htmlTable;

		    echo json_encode($dataBalikan);


		}

        public function get_pemantauan_detail() {
            $skpd = $_GET['skpd'];
            $list = $this->monitor_model->get_all_pemantauan_detail($skpd);
            
            $data = array();
            $html = '';
	        foreach ($list as $field) {
                $jns = '';
                $bold = '';
                $link = '#';
                if($field->jns == 'K'){
                    $jns='<font color="red">* </font>';
                    $link=base_url('pemantauan-detail-kegiatan?skpd='.$skpd.'&kegiatan='.$field->kode);

                }else{
                    $bold = 'font-weight:bold;';
                }
	            $no++;
	            $html .= '<tr><td><p style="font-size:7pt;">'.$no.'</p></td>';
	            $html .= '<td><a style="font-size:7pt;'.$bold.'" href="'.$link.'" class="klikSKPD" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">'.$jns.$field->kode.'-'.$field->uraian.'</a></td>';
	            $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">10%</p></td>';
				$html .= '<td><p style="font-size:7pt;">10%</p></td>';
				
	            $html .= '<td><center>
		 	    	<a href="'.base_url("pemantauan-detail?skpd=".$field->kd_skpd).'" class="btn btn-primary btn-flat btn-xs" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-search" aria-hidden="true" data-toggle="tooltip" title="Pemantauan"></i></a>
		 	    	</center></td></tr>';
	            $data[] = $row;
	        }
            $data['dataTable'] = $html;
	        echo json_encode($data);
		}

        public function get_pemantauan_detail_kegiatan() {
            
            $skpd = $_GET['skpd'];
            $kegiatan = $_GET['kegiatan'];

            $list = $this->monitor_model->get_pemantauan_detail_kegiatan($skpd,$kegiatan);
            
            $data = array();
            $html = '';
	        foreach ($list as $field) {
                $jns = '';
                $bold = '';
                $link = '#';
                if($field->jns == 'K'){
                    $jns='<font color="red">* </font>';
                    $link=base_url('pemantauan-detail-kegiatan?skpd='.$skpd.'&kegiatan='.$field->kode);

                }else{
                    $bold = 'font-weight:bold;';
                }
	            $no++;
	            $html .= '<tr><td><p style="font-size:7pt;">'.$no.'</p></td>';
	            $html .= '<td><a style="font-size:7pt;'.$bold.'" href="'.$link.'" class="klikSKPD" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">'.$jns.$field->kode.'-'.$field->uraian.'</a></td>';
	            $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><center>
                     <button class="btn btn-primary btn-flat btn-xs openModalTarget" data-skpd="'.$skpd.'" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">Target</button>
                     <button class="btn btn-primary btn-flat btn-xs openModalRealiasi" data-skpd="'.$skpd.'" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">Realisasi</button>
		 	    	</center></td></tr>';
	            $data[] = $row;
	        }
            $data['dataTable'] = $html;
	        echo json_encode($data);
		}


		public function get_target_kegiatan() {
			
			$skpd = $_POST['skpd'];
			$kegiatan = $_POST['id'];            
			// $data['dataHeader'] = $this->monitor_model->get_pemantauan_header_kegiatan($skpd,$kegiatan);
			$data['dataTarget'] = $this->monitor_model->get_target_kegiatan($skpd,$kegiatan);
	        echo json_encode($data);
		}

		public function get_header_kegiatan() {
			
			$skpd = $_POST['skpd'];
			$kegiatan = $_POST['id'];            
			$data['dataHeader'] = $this->monitor_model->get_pemantauan_header_kegiatan($skpd,$kegiatan);
			// $data['dataTable'] = $this->monitor_model->get_target_kegiatan($skpd,$kegiatan);
	        echo json_encode($data);
		}

		public function get_realisasi_kegiatan() {
			
			$skpd = $_POST['skpd'];
			$kegiatan = $_POST['id'];            
			// $data['data'] = $this->monitor_model->get_pemantauan_header_kegiatan($skpd,$kegiatan);
			$data['dataRealisasi'] = $this->monitor_model->get_target_kegiatan($skpd,$kegiatan);
	        echo json_encode($data);
		}

		public function get_pk_bidang($skpd) {
			$list = $this->master_model->get_all_pk_bidang($skpd);
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = '<a href="'.base_url("program-kegiatan/program?skpd=".$skpd.'&bidang='.$field->kd_urusan).'" class="" data-id="'.$field->kd_urusan.'" data-skpd="'.$skpd.'" data-nama="'.$field->nm_urusan.'">'.$field->kd_urusan.'</a>';
	            $row[] = '<a href="'.base_url("program-kegiatan/program?skpd=".$skpd.'&bidang='.$field->kd_urusan).'" class="" data-id="'.$field->kd_urusan.'" data-skpd="'.$skpd.'" data-nama="'.$field->nm_urusan.'">'.$field->nm_urusan.'</a>';
	            $row[] = number_format($field->pagu,2,",",".");
	            $row[] = number_format($field->pagu_ubah,2,",",".");
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_pk_bidang($skpd),
	            "recordsFiltered" => $this->master_model->count_filtered_pk_bidang($skpd),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}


		public function get_pk_program($skpd,$bidang) {
			$list = $this->master_model->get_all_pk_program($skpd,$bidang);
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = '<a href="'.base_url("program-kegiatan/kegiatan?skpd=".$skpd."&bidang=".$bidang."&program=".$field->kd_program).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-id="'.$field->kd_program.'" data-nama="'.$field->nm_program.'">'.$field->kd_program.'</a>';
	            $row[] = '<a href="'.base_url("program-kegiatan/kegiatan?skpd=".$skpd."&bidang=".$bidang."&program=".$field->kd_program).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-id="'.$field->kd_program.'" data-nama="'.$field->nm_program.'">'.$field->nm_program.'</a>';
	            $row[] = number_format($field->pagu,2,",",".");
	            $row[] = number_format($field->pagu_ubah,2,",",".");
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_pk_program($skpd,$bidang),
	            "recordsFiltered" => $this->master_model->count_filtered_pk_program($skpd,$bidang),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}


		public function get_pk_kegiatan($skpd,$bidang,$program) {
			
			$list = $this->master_model->get_all_pk_kegiatan($skpd,$bidang,$program);
	        $data = array();
			$no = $_POST['start'];
			
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = '<a href="'.base_url("program-kegiatan/indikator?skpd=".$skpd."&bidang=".$bidang."&program=".$program."&kegiatan=".$field->kd_kegiatan).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-program="'.$program.'" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_program.'">'.$field->kd_kegiatan.'</a>';
	            $row[] = '<a href="'.base_url("program-kegiatan/indikator?skpd=".$skpd."&bidang=".$bidang."&program=".$program."&kegiatan=".$field->kd_kegiatan).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-program="'.$program.'" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_program.'">'.$field->nm_kegiatan.'</a>';
	            $row[] = number_format($field->pagu,2,",",".");
	            $row[] = number_format($field->pagu_ubah,2,",",".");
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_kegiatan.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_kegiatan.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_pk_kegiatan($skpd,$bidang,$program),
	            "recordsFiltered" => $this->master_model->count_filtered_pk_kegiatan($skpd,$bidang,$program),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}




		public function get_last_update_database()
		{
			
			$redaksi = 'Terakhir Update : ';

			$res['fungsi'] = $redaksi.$this->db_model->get_last_update_fungsi();
			$res['urusan'] = $redaksi.$this->db_model->get_last_update_urusan();
			$res['skpd'] = $redaksi.$this->db_model->get_last_update_skpd();
			$res['program'] = $redaksi.$this->db_model->get_last_update_program();
			$res['kegiatan'] = $redaksi.$this->db_model->get_last_update_kegiatan();
			$res['sumberdana'] = $redaksi.$this->db_model->get_last_update_sumberdana();
			
			
			echo json_encode($res);

		}

		public function check_data_database()
		{
			$dtbs = $this->input->post('db');
			$tbl = $this->input->post('tbl');
			if($tbl=='skpd'){
				$res = $this->db_model->check_data_skpd($dtbs);
			}else if($tbl=='fungsi'){
				$res = $this->db_model->check_data_fungsi($dtbs);
			}else if($tbl=='urusan'){
				$res = $this->db_model->check_data_urusan($dtbs);
			}else if($tbl=='sumberdana'){
				$res = $this->db_model->check_data_sumberdana($dtbs);
			}
			
			echo json_encode($res);

		}



		public function import_data_database()
		{
			$dtbs = $this->input->post('db');
			$tbl = $this->input->post('tbl');
			if($tbl=='skpd'){
				$res = $this->db_model->import_data_skpd($dtbs);
			}else if($tbl=='fungsi'){
				$res = $this->db_model->import_data_fungsi($dtbs);
			}else if($tbl=='urusan'){
				$res = $this->db_model->import_data_urusan($dtbs);
			}else if($tbl=='sumberdana'){
				$res = $this->db_model->import_data_sumberdana($dtbs);
			}
			
			echo json_encode($res);

		}


		public function backup()
		{

			$this->load->dbutil();
			$this->load->helper('file');
			
			$config = array(
				'format'	=> 'zip',
				'filename'	=> 'database.sql'
			);
			
			$backup =& $this->dbutil->backup($config);
			
			$save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			$res = write_file($save, $backup);
			echo $res;

		}

		public function download()
		{
			$this->load->dbutil();
			$this->load->helper('file');
			
			$config = array(
				'format'	=> 'zip',
				'filename'	=> 'database.sql'
			);
			
			$backup =& $this->dbutil->backup($config);
			
			$save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			$res = write_file($save, $backup);
			echo $res;

		}

		public function restore()
		{
			$this->load->dbutil();
			$this->load->helper('file');
			
			$config = array(
				'format'	=> 'zip',
				'filename'	=> 'database.sql'
			);
			
			$backup =& $this->dbutil->backup($config);
			
			$save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			$res = write_file($save, $backup);
			echo $res;

		}

		public function get_combo_prov(){
			echo $this->daerah_model->getprov();	
		}

		public function get_prov() {
			$list = $this->daerah_model->get_all_prov();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->id_daerah;
	            $row[] = $field->nm_daerah;
	            $row[] = $field->ket;
	            $row[] = '<center>
		 	    	<a href="#" data-toggle="tooltip" title="Edit" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" data-toggle="tooltip" title="Hapus" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'"><i class="lnr lnr-trash"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->daerah_model->count_all_prov(),
	            "recordsFiltered" => $this->daerah_model->count_filtered_prov(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		

		public function getmax(){
			 $header = $this->input->post('kode');			
			 $level = $this->input->post('lvl');
			 $max_id=$this->daerah_model->get_max_daerah($level,$header);
			 echo $max_id;
		}



	}


?>