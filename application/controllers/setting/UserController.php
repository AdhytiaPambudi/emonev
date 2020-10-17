<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class UserController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('setting/User_Model', 'user_model');
			$this->load->model('admin/opd_model', 'opd_model');
		}

		public function index(){
			$data['view'] = 'setting/user/userView';
			$this->load->view('template/layout', $data);
		}

		public function cek_user()
		{
			$user = $_POST['username'];
			$cekUser = $this->db->get_where('m_user', array('username' => $user))->result();
			if (count($cekUser) == 1) {
				$data['sts']= 'ada';
			}else{
				$data['sts']= 'tdk';
			}
			echo json_encode($data);
		}

		public function change_sts_anggaran()
		{
			
			$sts = $_POST['stsAng'];
			if($sts == 'Perubahan'){
				$sts_ganti = 'Murni';
			}else{
				$sts_ganti = 'Perubahan';
			}
			$thn = $this->session->userdata('thn_ang');
			$this->db->where('tahun_anggaran',$thn);
			$data2 = $this->db->update('ms_config', array('sts_anggaran' => $sts_ganti));
			$res = $this->db->affected_rows();
			if (count($res) > 0) {
				$data['pesan']= 'Berhasil Diupdate';
			}else{
				$data['pesan']= 'Gagal Diupdate';
			}
			echo json_encode($data);
		}

		public function change_sts_triwulan()
		{
			
			$sts = $_POST['stsTw'];
			$tw = $_POST['tw'];
			if($sts == 'Y'){
				$sts_ganti = 'T';
			}else{
				$sts_ganti = 'Y';
			}
			if($tw == 1){
				$dataUpdate= array('show_triwulan1' => $sts_ganti);
			}else if($tw == 2){
				$dataUpdate= array('show_triwulan2' => $sts_ganti);
			}else if($tw == 3){
				$dataUpdate= array('show_triwulan3' => $sts_ganti);
			}else if($tw == 4){
				$dataUpdate= array('show_triwulan4' => $sts_ganti);
			}
			
			$thn = $this->session->userdata('thn_ang');
			$this->db->where('tahun_anggaran',$thn);
			$data2 = $this->db->update('ms_config', $dataUpdate);
			$res = $this->db->affected_rows();
			if (count($res) > 0) {
				$data['pesan']= 'Berhasil Diupdate';
			}else{
				$data['pesan']= 'Gagal Diupdate';
			}
			echo json_encode($data);
		}

		public function get() {
			$list = $this->user_model->get_all_user();
			
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->username;
	            $row[] = $field->skpd;
	            $row[] = $field->grup;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id.'" data-username="'.$field->username.'"  data-nama="'.$field->nama.'" data-skpd="'.$field->id_skpd.'" data-role="'.$field->group_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id.'" data-nama="'.$field->nama.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->user_model->count_all_user(),
	            "recordsFiltered" => $this->user_model->count_filtered_user(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function get_combo_jenis_user(){

			echo $this->user_model->getjenisuser();	
		}


		public function get_combo_bidang(){

			echo $this->user_model->getbidang();	
		}

		public function get_combo_instansi(){
			echo $this->user_model->getinstansi();	
		}

		public function get_combo_prov(){
			echo $this->user_model->getprov();	
		}

		public function get_combo_kab(){
			$prov = $this->input->post('kode');
			
			echo $this->user_model->getkab($prov);	
		}

		public function getmax(){

			 $header = $this->input->post('kode');
			 $role = $this->input->post('role');
			 $username=$this->user_model->get_username($header,$role);
			 echo $username;
		}
		

		public function insert(){
			$role = $this->input->post('role');
			$skpd = $this->input->post('skpd');
			$bidang = $this->input->post('bidang');
			$username = $this->input->post('username');
			$pass = $this->input->post('password');
			$nama = $this->input->post('nama');
			if ($role == 1) {
				$data = array(
							'nama' => $nama,
							'username' => $username,
							'userpwd' =>  password_hash($pass, PASSWORD_BCRYPT),
							'aktif' => 1,
							'id_skpd' => $role,
							'group_id' => $role,
						);
					
			}else if($role == 5){
				$data = array(
					'nama' => $nama,
					'username' => $username,
					'userpwd' =>  password_hash($pass, PASSWORD_BCRYPT),
					'aktif' => 1,
					'id_skpd' => $skpd,
					'group_id' => $role,
				);
			}
			else if($role == 3){
				$data = array(
					'nama' => $nama,
					'username' => $username,
					'userpwd' =>  password_hash($pass, PASSWORD_BCRYPT),
					'aktif' => 1,
					'id_skpd' => $bidang,
					'group_id' => $role,
				);
			}

			
			$data = $this->security->xss_clean($data);
			$result = $this->db->insert('m_user',$data);
			

			if($result){
				$dataRet['pesan'] = "Data Berhasil Ditambahkan!";
			}
			echo json_encode($dataRet);
			
			
		}


		public function update(){
			
			$whereUpdate = array('username' => $this->input->post('username'));
			$role = $this->input->post('role');
			$password = $this->input->post('password');
			if($password != ''){
				$dataPass = array('password' => $password);
			}

			
				
					if ($role == 1) {
						$data = array(
							'nama' => $this->input->post('nama'),
							'id_skpd' => 1,
							'group_id' => $this->input->post('role'),
						);
					}else if($role == 5){
						
						$data = array(
							'nama' => $this->input->post('nama'),
							'id_skpd' => $this->input->post('skpd'),
							'group_id' => $this->input->post('role'),
						);
					}
					else if($role == 3){
						
						$data = array(
							'nama' => $this->input->post('nama'),
							'id_skpd' => $this->input->post('bidang'),
							'group_id' => $this->input->post('role'),
						);
					}

					if($password != ''){
						$dataUpdate = array_merge($data,$dataPass);
					}else{
						$dataUpdate = $data;
					}
					$data = $this->security->xss_clean($dataUpdate);
					
					$this->db->where($whereUpdate);
					$result = $this->db->update('m_user',$data);
					
					if($result){
						$dataRet['pesan'] = "Data Berhasil DiUpdate!";
					}else{
						$dataRet['pesan'] = "Data Gagal DiUpdate!";
					}
					echo json_encode($dataRet);
			
			
		}

		public function del($id = 0){
			$this->db->delete('m_user', array('id' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url('setting-user'));
		}

	}


?>