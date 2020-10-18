<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class PemantauanController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('master/DaerahModel', 'daerah_model');
			$this->load->model('setting/DatabaseModel', 'db_model');
            $this->load->model('master/MasterModel', 'master_model');
			$this->load->model('pemantauan/PemantauanModel', 'pantau_model');
			$this->load->model('PublicModel', 'public_model');
		}

		public function index_skpd(){
			$data['view'] = 'master/skpdView';
			$this->load->view('template/layout', $data);
		}

		public function index(){
			$data['view'] = 'pemantauan/pemantauanView';
			$this->load->view('template/layout', $data);
		}
		
		public function get_pantau_skpd(){
			$data = $this->pantau_model->viewPantauSKPD();
			echo $data;
		}

		public function get_pantau_program(){
			$skpd = $_GET['skpd'];
			$data = $this->pantau_model->viewPantauProgram($skpd);
			echo $data;
		}
		
		public function get_pantau_kegiatan(){
			
			$skpd = $_GET['skpd'];
			$prog = $_GET['prog'];
			$data = $this->pantau_model->viewPantauKegiatan($skpd,$prog);
			echo $data;
		}
		
		public function get_pantau_rekening_kegiatan(){
			$skpd = $_GET['skpd'];
			$prog = $_GET['prog'];
			$keg = $_GET['keg'];
			
			$data = $this->pantau_model->viewPantauRincianKegiatan($skpd,$prog,$keg);
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
			
			$data = $this->pantau_model->modalPantauRincianKegiatan($thn,$keg,$rek,$po);
			
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
			$folderRABKontrak		= 'assets/rab_kontrak/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';
			
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

			}else{
				$htmlTable = '';
			}
			$result['tableLampiran'] = $htmlTable;


			$cekKontrak = $this->db->get_where('trdreal_kontrak', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po))->result();	
			if (count($cekKontrak) <> 0) {
				$htmlKontrak = '';
				$noFileKontrak = 1;
				foreach ($cekKontrak as $valuek) {
					$kd_kontrak = $valuek->kd_kontrak;
					if ($valuek->file_rab <> '') {
						$fileRABv="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderRABKontrak .$valuek->file_rab."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
						
					}else{
						$fileRABv = ''; 
					}

					if ($valuek->file_kontrak <> '') {
						$fileKontrakv="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderRABKontrak .$valuek->file_kontrak."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
						
					}else{
						$fileKontrakv = ''; 
					}

					$htmlKontrak .= '<tr>
									<td class="active" style="width:10%;text-align: center;vertical-align:middle;">
									'.$noFileKontrak++.'
									</td>  
									<td style="width:5%;text-align: center;">
										'.$fileRABv.'
									</td>  
									<td>
									<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$valuek->file_rab.'">
									</td>
									<td style="width:5%;text-align: center;">
										'.$fileKontrakv.'
									</td>  
									<td>
									<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$valuek->file_kontrak.'">
									</td>
									<td>
                                      <input type="text" class="form-control function_separator" value = "'.$valuek->nilai_kontrak.'" />
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" value = "'.$valuek->kontraktor.'" />
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" value = "'.$valuek->no_kontrak.'" />
                                    </td>
									<td style="vertical-align:middle;">
										<div class="inputWrapperRemove"  data-toggle="tooltip" title="Hapus">
										<button class="fileInput hapus-kontrak" type="button" data-thn="'.$valuek->tahun_anggaran.'" data-kontrak="'.$valuek->kd_kontrak.'" data-keg="'.$valuek->kd_kegiatan.'" data-rek="'.$valuek->kd_rek.'" data-po="'.$valuek->no_po.'"><i class="fa fa-trash"></i></button>
										</div>
									</td>  
								</tr>';
				}
				$htmlKontrak .='<script type="text/javascript">
								$(document).ready(function () {
									$(\'[data-toggle="tooltip"]\').tooltip();
								});
								</script>';
			}else{
				$htmlKontrak = '';
			}
			$result['tableKontrak'] = $htmlKontrak;

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
				

			echo json_encode($result);
		}
		
		public function get_rinci_dokumentasi(){
			
			
			$thn  = $_GET['thn'];
			$keg = $_GET['keg'];
			
			$queryCheck = "SELECT * FROM trdreal_lamp b 
LEFT JOIN
(SELECT tahun_anggaran,kd_kegiatan,kd_rek5 AS kode,uraian, no_po AS NO,
tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah FROM trdpo) a 
ON a.kd_kegiatan = b.`kd_kegiatan` AND a.tahun_anggaran = b.`tahun_anggaran` AND a.kode = b.`kd_rek` AND a.no = b.`no_po`
WHERE b.`kd_kegiatan` = '$keg' AND b.`tahun_anggaran` = $thn";

			$cekTable = $this->db->query($queryCheck)->result();

			// $cekTable = $this->db->get_where('trdreal_lamp', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg))->result();	

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
										<td style="text-align: center;" >
											'.$fileDok.'
										</td>  
										<td>
										'.$value->uraian.'
										</td>
										<td style="text-align: center;">
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
			$data['view'] = 'pemantauan/detailPemantauanView';
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
			$data['view'] = 'pemantauan/detailPemantauanKegiatanView';
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
			$data['view'] = 'pemantauan/detailPemantauanRekKegiatanView';
			$this->load->view('template/layout', $data);
		}


		public function input_data_pemantauan()
		{
			
			$ta 		= $this->input->post('tahun_anggaran');
			$keg		= $this->input->post('kd_kegiatan');
			$rek		= $this->input->post('kode_rek');
			$po			= $this->input->post('kode_po');
			$dok		= $this->input->post('dokumentasi');
			

			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".","-");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">","|","-");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_","_");
			$filelTemp 		= str_replace($searchdok, $replace, $dok);
			$kegTemp 		= str_replace($search, $replace, $keg);
			$rekTemp 		= str_replace($search, $replace, $rek);
			$poTemp 		= str_replace($search, $replace, $po);


			// insert data primary
			$cekData = $this->db->get_where('trdreal', array('tahun_anggaran' => $ta,'kd_kegiatan' => $keg,'kd_rekening' => $rek,'no_rinci' => $po))->result();	
			
			if (count($cekData) <> 0) {
				// update
				$dataUpdate = array(
					'fisik1' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik1']),
					'fisik2' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik2']),
					'fisik3' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik3']),
					'fisik4' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik4']),
					'keuangan1' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu1']),
					'keuangan2' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu2']),
					'keuangan3' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu3']),
					'keuangan4' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu4']),
					'bentuk'	 		=> $_POST['bentuk'],
					'nilai_kontrak'	 	=> $this->public_model->convertNominalDatabase($_POST['nilai_kontrak']),
					'kontraktor'	 	=> $_POST['kontraktor'],
					'no_kontrak'	 	=> $_POST['no_kontrak'],
					'distrik'	 		=> $_POST['distrik'],
					'kampung'	 		=> $_POST['kampung'],
					'koordinat'	 		=> $_POST['koordinat'],
					'keterangan'	 	=> $_POST['keterangan'],
				);
				
				if($_POST['bentuk'] == "K"){
					$fileRAB 	= $_FILES['fileRAB'];
					$fileSampul = $_FILES['fileSampul'];

					$folderRK			= 'assets/rab_kontrak/'.$ta.'/';
					$folderRK1			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/';
					$folderRK2			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/';
					$folderRK3			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';
					if (!file_exists($folderRK))
					{
						mkdir($folderRK); 
					}
					if (!file_exists($folderRK1))
					{
						mkdir($folderRK1); 
					}
					if (!file_exists($folderRK2))
					{
						mkdir($folderRK2); 
					}
					if (!file_exists($folderRK3))
					{
						mkdir($folderRK3); 
					}

					$configRK=array(  
			            'upload_path' => './'.$folderRK3, 
			            'allowed_types' => '*',  
			            'max_size' => '200000',  
			            'max_width' => '200000',  
			            'max_height' => '200000'  
		            );

					$uploadRAB = 0;
		            $RABFile = str_replace(' ', '_', $fileRAB['name']);
					$pathAndFileRAB = $folderRK3.$RABFile;
					if($RABFile <> ''){
	                	$_FILES['fileRAB']['name'] = $RABFile; 
		                $_FILES['fileRAB']['type'] = $fileRAB['type'];  
		                $_FILES['fileRAB']['tmp_name'] = $fileRAB['tmp_name'];  
		                $_FILES['fileRAB']['error'] = $fileRAB['error'];  
		                $_FILES['fileRAB']['size'] = $fileRAB['size'];  
		                $this->load->library('upload', $configRK); 
		                if (file_exists($pathAndFileRAB)) {
		                	unlink($pathAndFileRAB);
		                } 
		                $this->upload->do_upload('fileRAB');
		                $uploadRAB = 1;
		                $dataRAB = array(
							'file_rab' 		=> $RABFile,
						);

		                $dataUpdate = array_merge($dataUpdate, $dataRAB);
		         	}else{
		         		$RABFile = '';
					}

					$uploadSampul= 0;
		            $SampulFile = str_replace(' ', '_', $fileSampul['name']);
					$pathAndFileSampul = $folderRK3.$SampulFile;
					if($SampulFile <> ''){
	                	$_FILES['fileSampul']['name'] = $SampulFile; 
		                $_FILES['fileSampul']['type'] = $fileSampul['type'];  
		                $_FILES['fileSampul']['tmp_name'] = $fileSampul['tmp_name'];  
		                $_FILES['fileSampul']['error'] = $fileSampul['error'];  
		                $_FILES['fileSampul']['size'] = $fileSampul['size'];  
		                $this->load->library('upload', $configRK); 
		                if (file_exists($pathAndFileSampul)) {
		                	unlink($pathAndFileSampul);
		                } 
		                $this->upload->do_upload('fileSampul');
		                $uploadSampul = 1;
		                $dataSampul = array(
							'file_kontrak' 		=> $SampulFile,
						);

		                $dataUpdate = array_merge($dataUpdate, $dataSampul);
		         	}else{
		         		$RABFile = '';
					}

				}

				
				

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
						'fisik1' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik1']),
						'fisik2' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik2']),
						'fisik3' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik3']),
						'fisik4' 			=> $this->public_model->convertNominalDatabase($_POST['realfisik4']),
						'keuangan1' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu1']),
						'keuangan2' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu2']),
						'keuangan3' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu3']),
						'keuangan4' 		=> $this->public_model->convertNominalDatabase($_POST['realkeu4']),
						'bentuk'	 		=> $_POST['bentuk'],
						'nilai_kontrak'	 	=> $this->public_model->convertNominalDatabase($_POST['nilai_kontrak']),
						'kontraktor'	 	=> $_POST['kontraktor'],
						'no_kontrak'	 	=> $_POST['no_kontrak'],
						'distrik'	 		=> $_POST['distrik'],
						'kampung'	 		=> $_POST['kampung'],
						'koordinat'	 		=> $_POST['koordinat'],
						'keterangan'	 	=> $_POST['keterangan'],
					);


				if($_POST['bentuk'] == "K"){
					$fileRAB 	= $_FILES['fileRAB'];
					$fileSampul = $_FILES['fileSampul'];

					$folderRK			= 'assets/rab_kontrak/'.$ta.'/';
					$folderRK1			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/';
					$folderRK2			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/';
					$folderRK3			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';
					if (!file_exists($folderRK))
					{
						mkdir($folderRK); 
					}
					if (!file_exists($folderRK1))
					{
						mkdir($folderRK1); 
					}
					if (!file_exists($folderRK2))
					{
						mkdir($folderRK2); 
					}
					if (!file_exists($folderRK3))
					{
						mkdir($folderRK3); 
					}

					$configRK=array(  
			            'upload_path' => './'.$folderRK3, 
			            'allowed_types' => '*',  
			            'max_size' => '200000',  
			            'max_width' => '200000',  
			            'max_height' => '200000'  
		            );

					$uploadRAB = 0;
		            $RABFile = str_replace(' ', '_', $fileRAB['name']);
					$pathAndFileRAB = $folderRK3.$RABFile;
					if($RABFile <> ''){
	                	$_FILES['fileRAB']['name'] = $RABFile; 
		                $_FILES['fileRAB']['type'] = $fileRAB['type'];  
		                $_FILES['fileRAB']['tmp_name'] = $fileRAB['tmp_name'];  
		                $_FILES['fileRAB']['error'] = $fileRAB['error'];  
		                $_FILES['fileRAB']['size'] = $fileRAB['size'];  
		                $this->load->library('upload', $configRK); 
		                if (file_exists($pathAndFileRAB)) {
		                	unlink($pathAndFileRAB);
		                } 
		                $this->upload->do_upload('fileRAB');
		                $uploadRAB = 1;
		                $dataRAB = array(
							'file_rab' 		=> $RABFile,
						);

		                $dataInsert = array_merge($dataInsert, $dataRAB);
		         	}else{
		         		$RABFile = '';
					}

					$uploadSampul= 0;
		            $SampulFile = str_replace(' ', '_', $fileSampul['name']);
					$pathAndFileSampul = $folderRK3.$SampulFile;
					if($SampulFile <> ''){
	                	$_FILES['fileSampul']['name'] = $SampulFile; 
		                $_FILES['fileSampul']['type'] = $fileSampul['type'];  
		                $_FILES['fileSampul']['tmp_name'] = $fileSampul['tmp_name'];  
		                $_FILES['fileSampul']['error'] = $fileSampul['error'];  
		                $_FILES['fileSampul']['size'] = $fileSampul['size'];  
		                $this->load->library('upload', $configRK); 
		                if (file_exists($pathAndFileSampul)) {
		                	unlink($pathAndFileSampul);
		                } 
		                $this->upload->do_upload('fileSampul');
		                $uploadSampul = 1;
		                $dataSampul = array(
							'file_kontrak' 		=> $SampulFile,
						);

		                $dataInsert = array_merge($dataInsert, $dataSampul);
		         	}else{
		         		$RABFile = '';
					}

				}
				
				$this->db->insert('trdreal', $dataInsert);
				
				$hasilPrimary = $this->db->affected_rows();
			}

			if(count($hasilPrimary) <> 0){
				$dataBalikan['pesan'] = "Data Berhasil Diupdate!";
			}
			

			
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
			$max_id=$this->pantau_model->get_max_lamp($ta,$keg,$rek,$po);
			

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
				$data = $this->security->xss_clean($data);
				$result = $this->pantau_model->insertLampiranDokumentasi($data);
				if($result){
					$dataBalikan['pesan'] = "Data Berhasil Diupdate!";
				}
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
					$max_id=$this->pantau_model->get_max_lamp($ta,$keg,$rek,$po);
					

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
					$result = $this->pantau_model->insertLampiranDokumentasi($data);
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


		public function input_data_pemantauan_kontrak()
		{

			$ta 		= $this->input->post('tahun_anggaran');
			$keg		= $this->input->post('kd_kegiatan');
			$rek		= $this->input->post('kode_rek');
			$po			= $this->input->post('kode_po');
			$rab		= $this->input->post('rab');
			$sampul		= $this->input->post('sampul');

			$nilai_kontrak		= $this->input->post('nilai_kontrak');
			$kontraktor		= $this->input->post('kontraktor');
			$no_kontrak		= $this->input->post('no_kontrak');
			

			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			// $filelTemp 		= str_replace($searchdok, $replace, $dokumentasi);
			$kegTemp 		= str_replace($search, $replace, $keg);
			$rekTemp 		= str_replace($search, $replace, $rek);
			$poTemp 		= str_replace($search, $replace, $po);
			
			$fileRAB 	= $_FILES['fileRAB'];
			$fileSampul = $_FILES['fileSampul'];

			

			$folderRK			= 'assets/rab_kontrak/'.$ta.'/';
			$folderRK1			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/';
			$folderRK2			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/';
			$folderRK3			= 'assets/rab_kontrak/'.$ta.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';

			if (!file_exists($folderRK))
			{
				mkdir($folderRK); 
			}
			if (!file_exists($folderRK1))
			{
				mkdir($folderRK1); 
			}
			if (!file_exists($folderRK2))
			{
				mkdir($folderRK2); 
			}
			if (!file_exists($folderRK3))
			{
				mkdir($folderRK3); 
			}

			$configRK=array(  
	            'upload_path' => './'.$folderRK3, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );

			$uploadRAB = 0;
            $RABFile = str_replace(' ', '_', $fileRAB['name']);
			$pathAndFileRAB = $folderRK3.$RABFile;
			if($RABFile <> ''){
            	$_FILES['fileRAB']['name'] = $RABFile; 
                $_FILES['fileRAB']['type'] = $fileRAB['type'];  
                $_FILES['fileRAB']['tmp_name'] = $fileRAB['tmp_name'];  
                $_FILES['fileRAB']['error'] = $fileRAB['error'];  
                $_FILES['fileRAB']['size'] = $fileRAB['size'];  
                $this->load->library('upload', $configRK); 
                if (file_exists($pathAndFileRAB)) {
                	unlink($pathAndFileRAB);
                } 
                $this->upload->do_upload('fileRAB');
                $uploadRAB = 1;
                $dataRAB = array(
					'file_rab' 		=> $RABFile,
				);

                // $dataUpdate = array_merge($dataUpdate, $dataRAB);
         	}else{
         		$RABFile = '';
			}

			$uploadSampul= 0;
            $SampulFile = str_replace(' ', '_', $fileSampul['name']);
			$pathAndFileSampul = $folderRK3.$SampulFile;
			if($SampulFile <> ''){
            	$_FILES['fileSampul']['name'] = $SampulFile; 
                $_FILES['fileSampul']['type'] = $fileSampul['type'];  
                $_FILES['fileSampul']['tmp_name'] = $fileSampul['tmp_name'];  
                $_FILES['fileSampul']['error'] = $fileSampul['error'];  
                $_FILES['fileSampul']['size'] = $fileSampul['size'];  
                $this->load->library('upload', $configRK); 
                if (file_exists($pathAndFileSampul)) {
                	unlink($pathAndFileSampul);
                } 
                $this->upload->do_upload('fileSampul');
                $uploadSampul = 1;
                $dataSampul = array(
					'file_kontrak' 		=> $SampulFile,
				);

                // $dataUpdate = array_merge($dataUpdate, $dataSampul);
         	}else{
         		$RABFile = '';
			}

				 
			
					// edit
			$max_id=$this->pantau_model->get_max_kontrak($ta,$keg,$rek,$po);
			$kd_kontrak = $max_id;
			$data = array(
					'tahun_anggaran' 	=> $ta,
					'kd_kegiatan'		=>$keg,
					'kd_rek' 			=> $rek,
					'no_po' 			=> $po,
					'kd_kontrak' 		=> $kd_kontrak,
					'nilai_kontrak'	 	=> $this->public_model->convertNominalDatabase($_POST['nilai_kontrak']),
					'kontraktor' 		=> $kontraktor,
					'no_kontrak' 		=> $no_kontrak,
				);

			

    		
 			$where = array();
			if ($uploadSampul == 1) {
				$dataSampul = array(
					'file_kontrak' 			=> $SampulFile,
				);
				$data = array_merge($data, $dataSampul);
			}


			if ($uploadRAB == 1) {
				$dataRAB = array(
					'file_rab' 			=> $RABFile,
				);
				$data = array_merge($data, $dataRAB);
			}

			$data = $this->security->xss_clean($data);

			$result = $this->pantau_model->insertLampiranKontrak($data);
			if($result){
				$dataBalikan['pesan'] = "Data Berhasil Diupdate!";
			}
			
					
			$cekKontrak = $this->db->get_where('trdreal_kontrak', array('tahun_anggaran' => $ta,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po))->result();	
			if (count($cekKontrak) <> 0) {
				$htmlKontrak = '';
				$noFileKontrak = 1;
				foreach ($cekKontrak as $valuek) {
					$kd_kontrak = $valuek->kd_kontrak;
					if ($valuek->file_rab <> '') {
						$fileRABv="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderRABKontrak .$valuek->file_rab."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
						
					}else{
						$fileRABv = ''; 
					}

					if ($valuek->file_kontrak <> '') {
						$fileKontrakv="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderRABKontrak .$valuek->file_kontrak."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
						
					}else{
						$fileKontrakv = ''; 
					}

					$htmlKontrak .= '<tr>
									<td class="active" style="width:10%;text-align: center;vertical-align:middle;">
									'.$noFileKontrak++.'
									</td>  
									<td style="width:5%;text-align: center;">
										'.$fileRABv.'
									</td>  
									<td>
									<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$valuek->file_rab.'">
									</td>
									<td style="width:5%;text-align: center;">
										'.$fileKontrakv.'
									</td>  
									<td>
									<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$valuek->file_kontrak.'">
									</td>
									<td>
                                      <input type="text" class="form-control function_separator" value = "'.$valuek->nilai_kontrak.'" />
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" value = "'.$valuek->kontraktor.'" />
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" value = "'.$valuek->no_kontrak.'" />
                                    </td>
									<td style="vertical-align:middle;">
										<div class="inputWrapperRemove"  data-toggle="tooltip" title="Hapus">
										<button class="fileInput hapus-lampiran" type="button" data-thn="'.$valuek->tahun_anggaran.'" data-kontrak="'.$valuek->kd_kontrak.'" data-keg="'.$valuek->kd_kegiatan.'" data-rek="'.$valuek->kd_rek.'" data-po="'.$valuek->no_po.'"><i class="fa fa-trash"></i></button>
										</div>
									</td>  
								</tr>';
				}
				$htmlKontrak .='<script type="text/javascript">
								$(document).ready(function () {
									$(\'[data-toggle="tooltip"]\').tooltip();
								});
								</script>';
			}else{
				$htmlKontrak = '';
			}
			
			$dataBalikan['tableKontrak'] = $htmlKontrak;

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


		public function del_data_pemantauan_kontrak(){
			
			$thn  	= $_GET['thn'];
			$keg 	= $_GET['keg'];
			$rek  	= $_GET['rek'];
			$po  	= $_GET['po'];
			$kd_kontrak  = $_GET['kd_kontrak'];
			



			$result = $this->db->delete('trdreal_kontrak', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po,'kd_kontrak' => $kd_kontrak));
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
			
			$folderFile		= 'assets/rab_kontrak/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';

			$cekKontrak = $this->db->get_where('trdreal_kontrak', array('tahun_anggaran' => $thn,'kd_kegiatan' => $keg,'kd_rek' => $rek,'no_po' => $po))->result();	
			if (count($cekKontrak) <> 0) {
				$htmlKontrak = '';
				$noFileKontrak = 1;
				foreach ($cekKontrak as $valuek) {
					$kd_kontrak = $valuek->kd_kontrak;
					if ($valuek->file_rab <> '') {
						$fileRABv="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderRABKontrak .$valuek->file_rab."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
						
					}else{
						$fileRABv = ''; 
					}

					if ($valuek->file_kontrak <> '') {
						$fileKontrakv="<div class='inputWrapperSearch'  data-toggle='tooltip' title='Preview File'><a class = 'fileInput' href='".base_url().$folderRABKontrak .$valuek->file_kontrak."' target= '_blank'><i class='icon fa fa-search'></i></a></div>";
						
					}else{
						$fileKontrakv = ''; 
					}

					$htmlKontrak .= '<tr>
									<td class="active" style="width:10%;text-align: center;vertical-align:middle;">
									'.$noFileKontrak++.'
									</td>  
									<td style="width:5%;text-align: center;">
										'.$fileRABv.'
									</td>  
									<td>
									<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$valuek->file_rab.'">
									</td>
									<td style="width:5%;text-align: center;">
										'.$fileKontrakv.'
									</td>  
									<td>
									<input type="text" class="form-control input-sm" readonly placeholder="" value = "'.$valuek->file_kontrak.'">
									</td>
									<td>
                                      <input type="text" class="form-control function_separator" value = "'.$valuek->nilai_kontrak.'" />
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" value = "'.$valuek->kontraktor.'" />
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" value = "'.$valuek->no_kontrak.'" />
                                    </td>
									<td style="vertical-align:middle;">
										<div class="inputWrapperRemove"  data-toggle="tooltip" title="Hapus">
										<button class="fileInput hapus-kontrak" type="button" data-thn="'.$valuek->tahun_anggaran.'" data-kontrak="'.$valuek->kd_kontrak.'" data-keg="'.$valuek->kd_kegiatan.'" data-rek="'.$valuek->kd_rek.'" data-po="'.$valuek->no_po.'"><i class="fa fa-trash"></i></button>
										</div>
									</td>  
								</tr>';
				}
				$htmlKontrak .='<script type="text/javascript">
								$(document).ready(function () {
									$(\'[data-toggle="tooltip"]\').tooltip();
								});
								</script>';
			}else{
				$htmlKontrak = '';
			}
				$dataBalikan['tableKontrak'] = $htmlKontrak;

		    echo json_encode($dataBalikan);


		}

        public function get_pemantauan_detail() {
            $skpd = $_GET['skpd'];
            $list = $this->pantau_model->get_all_pemantauan_detail($skpd);
            
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

            $list = $this->pantau_model->get_pemantauan_detail_kegiatan($skpd,$kegiatan);
            
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
			// $data['dataHeader'] = $this->pantau_model->get_pemantauan_header_kegiatan($skpd,$kegiatan);
			$data['dataTarget'] = $this->pantau_model->get_target_kegiatan($skpd,$kegiatan);
	        echo json_encode($data);
		}

		public function get_header_kegiatan() {
			
			$skpd = $_POST['skpd'];
			$kegiatan = $_POST['id'];            
			$data['dataHeader'] = $this->pantau_model->get_pemantauan_header_kegiatan($skpd,$kegiatan);
			// $data['dataTable'] = $this->pantau_model->get_target_kegiatan($skpd,$kegiatan);
	        echo json_encode($data);
		}

		public function get_realisasi_kegiatan() {
			
			$skpd = $_POST['skpd'];
			$kegiatan = $_POST['id'];            
			// $data['data'] = $this->pantau_model->get_pemantauan_header_kegiatan($skpd,$kegiatan);
			$data['dataRealisasi'] = $this->pantau_model->get_target_kegiatan($skpd,$kegiatan);
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

		public function add_prov(){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Provinsi', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Provinsi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/provView';
					$this->load->view('template/layout', $data);
				}
				else{

					$data = array(
						'id_daerah' 		=> $this->input->post('id_daerah'),
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
						'clevel' 			=> 1,
						'hd_daerah' 		=> "",
						'hd' 				=> "H",
						'ket' 				=> "Provinsi"
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->add_daerah($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url('data-provinsi'));
					}
						
				}
			}
			
		}

		public function edit_prov($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Provinsi', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Provinsi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/provView';
					$this->load->view('template/layout', $data);
				}
				else{
					$data = array(
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->edit_daerah($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url('data-provinsi'));
					}
				}
			}
			else{
				$data['view'] = 'master/provView';
				$this->load->view('template/layout', $data);
			}
		}

		public function del_prov($id = 0){
			$this->db->delete('ms_daerah', array('id_daerah' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url('data-provinsi'));
		}

		
		// kabupaten kota
		public function index_kab(){
			$data['view'] = 'master/kabKotaView';
			$this->load->view('template/layout', $data);
		}

		public function get_kab() {
			$list = $this->daerah_model->get_all_kab();

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
		 	    	<a href="#" data-toggle="tooltip" title="Edit" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'" data-header="'.$field->hd_daerah.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" data-toggle="tooltip" title="Hapus" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'"><i class="lnr lnr-trash"></i></a>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->daerah_model->count_all_kab(),
	            "recordsFiltered" => $this->daerah_model->count_filtered_kab(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function add_kab(){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Kabupaten/Kota', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Kabupaten/Kota', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/kabKotaView';
					$this->load->view('template/layout', $data);
				}
				else{

					$data = array(
						'id_daerah' 		=> $this->input->post('id_daerah'),
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
						'clevel' 			=> 2,
						'hd_daerah' 		=> $this->input->post('prov'),
						'hd' 				=> "D",
						'ket' 				=> "Kabupaten/Kota"
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->add_daerah($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url('data-kabupaten-kota'));
					}
						
				}
			}
			
		}

		public function edit_kab($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Kabupaten/Kota', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Kabupaten/Kota', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/kabKotaView';
					$this->load->view('template/layout', $data);
				}
				else{
					$data = array(
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->edit_daerah($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url('data-kabupaten-kota'));
					}
				}
			}
			else{
				$data['view'] = 'master/kabKotaView';
				$this->load->view('template/layout', $data);
			}
		}

		public function del_kab($id = 0){
			$this->db->delete('ms_daerah', array('id_daerah' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url('data-kabupaten-kota'));
		}

		public function getmax(){
			 $header = $this->input->post('kode');			
			 $level = $this->input->post('lvl');
			 $max_id=$this->daerah_model->get_max_daerah($level,$header);
			 echo $max_id;
		}



	}


?>