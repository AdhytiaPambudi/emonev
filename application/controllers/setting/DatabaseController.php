<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DatabaseController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('master/DaerahModel', 'daerah_model');
			$this->load->model('setting/DatabaseModel', 'db_model');
		}

		public function index(){
			$data['view'] = 'setting/database/databaseView';
			$this->load->view('template/layout', $data);
		}

		public function get_last_update_database()
		{
			
			$redaksi = 'Terakhir Update : ';
			$update = $this->db_model->get_last_update();
			foreach ($update as $value) {
				if($value->uraian == 'anggaran'){
					$res['anggaran'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian  == 'rincian'){
					$res['rincian'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian  == 'rka'){
					$res['rka'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian =='skpd'){
					$res['skpd'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian =='fungsi'){
					$res['fungsi'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian =='urusan'){
					$res['urusan'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian =='tapd'){
					$res['tapd'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian =='ttd'){
					$res['ttd'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian =='sumberdana'){
					$res['sumberdana'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}else if($value->uraian =='rekening'){
					$res['rekening'] = $redaksi.$this->PublicModel->tgl_indo_short($value->tgl);
				}
			}

			
			
			
			echo json_encode($res);

		}

		public function check_data_database()
		{
			
			$dtbs = $this->input->post('db');
			$tbl = $this->input->post('tbl');
			
			if($tbl == 'anggaran'){
				$res = $this->db_model->check_data_anggaran($dtbs);
			}else if($tbl == 'rincian'){
				$res = $this->db_model->check_data_rincian($dtbs);
			}else if($tbl == 'rka'){
				$res = $this->db_model->check_data_rka($dtbs);
			}else if($tbl=='skpd'){
				$res = $this->db_model->check_data_skpd($dtbs);
			}else if($tbl=='fungsi'){
				$res = $this->db_model->check_data_fungsi($dtbs);
			}else if($tbl=='urusan'){
				$res = $this->db_model->check_data_urusan($dtbs);
			}else if($tbl=='tapd'){
				$res = $this->db_model->check_data_tapd($dtbs);
			}else if($tbl=='ttd'){
				$res = $this->db_model->check_data_ttd($dtbs);
			}else if($tbl=='sumberdana'){
				$res = $this->db_model->check_data_sumberdana($dtbs);
			}else if($tbl=='rekAnggaran'){
				$res = $this->db_model->check_data_rekening($dtbs);
			}
			
			echo json_encode($res);

		}

		public function import_data_database()
		{
			
			$dtbs = $this->input->post('db');
			$tbl = $this->input->post('tbl');
			
			if($tbl == 'anggaran'){
				$res = $this->db_model->import_data_anggaran($dtbs);
			}else if($tbl == 'rincian'){
				$res = $this->db_model->import_data_rincian($dtbs);
			}else if($tbl == 'rka'){
				$res = $this->db_model->import_data_rka($dtbs);
			}else if($tbl=='skpd'){
				$res = $this->db_model->import_data_skpd($dtbs);
			}else if($tbl=='fungsi'){
				$res = $this->db_model->import_data_fungsi($dtbs);
			}else if($tbl=='urusan'){
				$res = $this->db_model->import_data_urusan($dtbs);
			}else if($tbl=='tapd'){
				$res = $this->db_model->import_data_tapd($dtbs);
			}else if($tbl=='ttd'){
				$res = $this->db_model->import_data_ttd($dtbs);
			}else if($tbl=='sumberdana'){
				$res = $this->db_model->import_data_sumberdana($dtbs);
			}else if($tbl=='rekAnggaran'){
				$res = $this->db_model->import_data_rekening($dtbs);
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
			$this->load->helper('download');
			force_download(date("Y-m-d H-i-s").'-db.zip', $backup);
			return $res;

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
			
			// $save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			// $res = write_file($save, $backup);

			$this->load->helper('download');
			force_download(date("Y-m-d H-i-s").'-db.zip', $backup);


		}

		public function restore()
		{

			//upload dulu filenya
			// $fupload = $_FILES['file_restore'];

			// $nama = $_FILES['file_restore']['name'];
			// if(isset($fupload)){
			// $lokasi_file = $fupload['tmp_name'];

			// $direktori=base_url().'database/restore/'.$nama;
			// print_r($direktori);die();
			// move_uploaded_file($lokasi_file,$direktori);
			// }


			$files = $_FILES['file_restore'];  
			
			$folder		= 'database/restore/';
            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

            // for ($i=0; $i < $jmlFile ; $i++) { 

			$convertFile = str_replace(' ', '_', $files['name']);
			
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_restore']['name'] = $convertFile; 
                $_FILES['file_restore']['type'] = $files['type'];  
                $_FILES['file_restore']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_restore']['error'] = $files['error'];  
                $_FILES['file_restore']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_restore');
                $upload = 1;
         	}else{
         		$convertFile = '';
			 }

			$isi_file=file_get_contents($pathAndFile);
			$string_query=rtrim($isi_file, "\n;" );
			$array_query=explode(";", $string_query);

			$this->dbtes = $this->load->database('tes_restore', TRUE);
			$data['html'] = "";
			foreach($array_query as $query){

				$this->dbtes->query($query);
				$e = $this->db->error(); // Gets the last error that has occured
				$num = $e['code'];
				$mess = $e['message'];
				$data['html'].=$mess;
				
			}
			

			echo json_encode($data);

			// $this->load->dbutil();
			// $this->load->helper('file');
			
			// $config = array(
			// 	'format'	=> 'zip',
			// 	'filename'	=> 'database.sql'
			// );
			
			// $backup =& $this->dbutil->backup($config);
			
			// $save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			// $res = write_file($save, $backup);
			// echo $res;

		}



		public function transfer_anggaran()
		{

			$files = $_FILES['file_anggaran'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_anggaran']['name'] = $convertFile; 
                $_FILES['file_anggaran']['type'] = $files['type'];  
                $_FILES['file_anggaran']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_anggaran']['error'] = $files['error'];  
                $_FILES['file_anggaran']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_anggaran');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('trskpd');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array(
							'kd_gabungan'	=>$value->kd_gabungan,
							'kd_kegiatan'	=>$value->kd_kegiatan,
							'kd_program'	=>$value->kd_program,
							'kd_urusan'		=>$value->kd_urusan,
							'kd_skpd'		=>$value->kd_skpd,
							'nm_skpd'		=>$value->nm_skpd,
							'kd_kegiatan1'	=>$value->kd_kegiatan1,
							'nm_kegiatan'	=>$value->nm_kegiatan,
							'jns_kegiatan'	=>$value->jns_kegiatan,
							'kd_program1'		=>$value->kd_program1,
							'nm_program'		=>$value->nm_program,
							'indika'		=>$value->indika,
							'tu'		=>$value->tu,
							'tk'		=>$value->tk,
							'sasaran_giat'		=>$value->sasaran_giat,
							'sumber_dana'		=>$value->sumber_dana,
							'sumber_dana_ubah'		=>$value->sumber_dana_ubah,
							'waktu_giat'		=>$value->waktu_giat,
							'tk_kwt'		=>$value->tk_kwt,
							'kd_pptk'		=>$value->kd_pptk,
							'kd_comp'		=>$value->kd_comp,
							'kontrak'		=>$value->kontrak,
							'jns_keg'		=>$value->jns_keg,
							
							'tu_capai'		=>$value->tu_capai,
							'tu_capai_ubah'		=>$value->tu_capai_ubah,
							'tu_mas'		=>$value->tu_mas,
							'tu_mas_ubah'		=>$value->tu_mas_ubah,
							'tu_kel'		=>$value->tu_kel,
							'tu_kel_ubah'		=>$value->tu_kel_ubah,
							'tu_has'		=>$value->tu_has,
							'tu_has_ubah'		=>$value->tu_has_ubah,

							'tk_capai'		=>$value->tk_capai,
							'tk_capai_ubah'		=>$value->tk_capai_ubah,
							'tk_mas'		=>$value->tk_mas,
							'tk_mas_ubah'		=>$value->tk_mas_ubah,
							'tk_kel'		=>$value->tk_kel,
							'tk_kel_ubah'		=>$value->tk_kel_ubah,
							'tk_has'		=>$value->tk_has,
							'tk_has_ubah'		=>$value->tk_has_ubah,

							'alasan'		=>$value->alasan,
							'UserName'		=>$value->UserName,
							'latar_belakang'		=>$value->latar_belakang,
							'triw1'		=>$value->triw1,
							'triw2'		=>$value->triw2,
							'triw3'		=>$value->triw3,
							'triw4'		=>$value->triw4,
							'total'		=>$value->total,

							'triw1_ubah'		=>$value->triw1_ubah,
							'triw2_ubah'		=>$value->triw2_ubah,
							'triw3_ubah'		=>$value->triw3_ubah,
							'triw4_ubah'		=>$value->triw4_ubah,
							'total_ubah'		=>$value->total_ubah,

							'lokasi'		=>$value->lokasi,
							'kd_lokasi2'		=>$value->kd_lokasi2,
							'sumber'		=>$value->sumber,
							'lanjut'		=>$value->lanjut,
							'user'		=>$value->user,
							'tgl_update'		=>$value->tgl_update,
							'ur'		=>$value->ur,
							'k_ur'		=>$value->k_ur,
							'file'		=>$value->file,
							'tahun_anggaran'		=>$value->tahun_anggaran,



							);
				$this->db->insert('trskpd',$data);
				print_r($this->db->error());die();
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);

		}

		public function transfer_rka()
		{

			$files = $_FILES['file_urusan'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_urusan']['name'] = $convertFile; 
                $_FILES['file_urusan']['type'] = $files['type'];  
                $_FILES['file_urusan']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_urusan']['error'] = $files['error'];  
                $_FILES['file_urusan']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_urusan');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('ms_urusan');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array('kd_urusan'=>$value->kd_urusan,'nm_urusan'=>$value->nm_urusan,'header'=>$value->header,'tipe'=>$value->tipe,'kd_fungsi'=>$value->kd_fungsi);
				$this->db->insert('ms_urusan',$data);
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);

		}

		public function transfer_rincian()
		{

			$files = $_FILES['file_urusan'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_urusan']['name'] = $convertFile; 
                $_FILES['file_urusan']['type'] = $files['type'];  
                $_FILES['file_urusan']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_urusan']['error'] = $files['error'];  
                $_FILES['file_urusan']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_urusan');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('ms_urusan');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array('kd_urusan'=>$value->kd_urusan,'nm_urusan'=>$value->nm_urusan,'header'=>$value->header,'tipe'=>$value->tipe,'kd_fungsi'=>$value->kd_fungsi);
				$this->db->insert('ms_urusan',$data);
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);

		}

		public function transfer_skpd()
		{

			$files = $_FILES['file_urusan'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_urusan']['name'] = $convertFile; 
                $_FILES['file_urusan']['type'] = $files['type'];  
                $_FILES['file_urusan']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_urusan']['error'] = $files['error'];  
                $_FILES['file_urusan']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_urusan');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('ms_urusan');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array('kd_urusan'=>$value->kd_urusan,'nm_urusan'=>$value->nm_urusan,'header'=>$value->header,'tipe'=>$value->tipe,'kd_fungsi'=>$value->kd_fungsi);
				$this->db->insert('ms_urusan',$data);
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);

		}


		public function transfer_urusan()
		{

			$files = $_FILES['file_urusan'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_urusan']['name'] = $convertFile; 
                $_FILES['file_urusan']['type'] = $files['type'];  
                $_FILES['file_urusan']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_urusan']['error'] = $files['error'];  
                $_FILES['file_urusan']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_urusan');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('ms_urusan');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array('kd_urusan'=>$value->kd_urusan,'nm_urusan'=>$value->nm_urusan,'header'=>$value->header,'tipe'=>$value->tipe,'kd_fungsi'=>$value->kd_fungsi);
				$this->db->insert('ms_urusan',$data);
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);

		}


		public function transfer_fungsi()
		{

			$files = $_FILES['file_fungsi'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_fungsi']['name'] = $convertFile; 
                $_FILES['file_fungsi']['type'] = $files['type'];  
                $_FILES['file_fungsi']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_fungsi']['error'] = $files['error'];  
                $_FILES['file_fungsi']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_fungsi');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('ms_fungsi');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array('kd_fungsi'=>$value->kd_fungsi,'nm_fungsi'=>$value->nm_fungsi);
				$this->db->insert('ms_fungsi',$data);
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);
		}



		public function transfer_tapd()
		{

			$files = $_FILES['file_tapd'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_tapd']['name'] = $convertFile; 
                $_FILES['file_tapd']['type'] = $files['type'];  
                $_FILES['file_tapd']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_tapd']['error'] = $files['error'];  
                $_FILES['file_tapd']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_tapd');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('tapd');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array('no'=>$value->no,'nip'=>$value->nip,'nama'=>$value->nama,'jabatan'=>$value->jabatan);
				$this->db->insert('tapd',$data);
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);

		}


		public function transfer_ttd()
		{

			$files = $_FILES['file_ttd'];  			
			$folder		= 'database/transfer/';

            $config=array(  
	            'upload_path' => './'.$folder, 
	            'allowed_types' => '*',  
	            'max_size' => '200000',  
	            'max_width' => '200000',  
	            'max_height' => '200000'  
            );


            $i = 0;
            $upload = 0;

			$convertFile = str_replace(' ', '_', $files['name']);
			$pathAndFile = $folder.$convertFile;
			
       		if($convertFile <> ''){
            	$_FILES['file_ttd']['name'] = $convertFile; 
                $_FILES['file_ttd']['type'] = $files['type'];  
                $_FILES['file_ttd']['tmp_name'] = $files['tmp_name'];  
                $_FILES['file_ttd']['error'] = $files['error'];  
                $_FILES['file_ttd']['size'] = $files['size'];  
                $this->load->library('upload', $config); 
                if (file_exists($pathAndFile)) {
                	unlink($pathAndFile);
                } 
                $this->upload->do_upload('file_ttd');
                $upload = 1;
         	}else{
         		$convertFile = '';
			}

			$isi_file=file_get_contents($pathAndFile);
			$xmlData = simplexml_load_string($isi_file);

			$this->db->from('ms_ttd');
			$this->db->truncate();

			$i = 0;
			foreach($xmlData->row as $value){
				$data = array('nip'=>$value->nip,'nama'=>$value->nama,'jabatan'=>$value->jabatan,'pangkat'=>$value->pangkat
								,'kd_skpd'=>$value->kd_skpd,'kode'=>$value->kode,'norek'=>$value->norek,'npwp'=>$value->npwp
								,'bank'=>$value->status);
				$this->db->insert('ms_ttd',$data);
				$i++;
			}
			$res['pesan'] = $i . ' Data Berhasil DiTransfer';

			echo json_encode($res);

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