<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class UserController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('admin/user_model', 'user_model');
			$this->load->model('admin/opd_model', 'opd_model');
		}

		public function index(){
			$data['view'] = 'admin/users/user_list';
			$this->load->view('template/layout', $data);
		}

		public function cek_user()
		{
			$user = $_POST['username'];
			$cekUser = $this->db->get_where('ms_user', array('username' => $user))->result();
			if (count($cekUser) == 1) {
				$data['sts']= 'ada';
			}else{
				$data['sts']= 'tdk';
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
	            $row[] = $field->name;
	            $row[] = $field->username;
	            if ($field->type == 1) {
	            	$type = 'Administrator';
	            }else if($field->type == 2){
	            	$type = 'User Pemda';
	            }else{
	            	$type = 'User Kemendagri';
	            }
	            $row[] = $type;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_user.'" data-username="'.$field->username.'" data-nama="'.$field->name.'" data-telp="'.$field->telp.'" data-prov="'.$field->id_prov.'" data-kab="'.$field->id_kab.'" data-email="'.$field->email.'" data-role="'.$field->type.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_user.'" data-nama="'.$field->name.'"><i class="lnr lnr-trash"></i></a></td>
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
		
		public function add(){

			if($this->input->post('submit')){

				$this->form_validation->set_rules('role', 'Role', 'trim|required');	
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

				$role = $this->input->post('role');
				if ($role == 2) {
					$this->form_validation->set_rules('prov', 'Provinsi', 'trim|required');
					$this->form_validation->set_rules('kab', 'Kabupaten', 'trim|required');			
				}
				

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/users/user_list';
					$this->load->view('template/layout', $data);
				}
				else{
					if ($role == 1) {
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'id_prov' => $role,
							'id_kab' => $role,
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}else{
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'id_prov' => $this->input->post('prov'),
							'id_kab' => $this->input->post('kab'),
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->add_user($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url('data-user'));
					}
				}
			}
			else{
				$data['view'] = 'admin/users/user_list';
				$this->load->view('template/layout', $data);
			}
			
		}

		public function insert(){
			$role = $this->input->post('role');



				
					if ($role == 1) {
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'id_prov' => $role,
							'id_kab' => $role,
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}else if ($role == 2) {
						$tipe = $this->input->post('tipe_daerah');
						
						if ($tipe == 'prov') {
							$prov = $this->input->post('prov');
							$kab = $this->input->post('prov');
						}else{
							$prov = $this->input->post('prov');
							$kab = $this->input->post('kab');
						}
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'id_prov' => $prov,
							'id_kab' => $kab,
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}else{
						$data = array(
							'name' => $this->input->post('nama'),
							'username' => $this->input->post('username'),
							'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							'is_admin' => $role,
							'id_prov' => $this->input->post('instansi'),
							'id_kab' => $this->input->post('instansi'),
							'type' => $role,
							'id_group' => $role,
							'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->add_user($data);
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
							'name' => $this->input->post('nama'),
							// 'username' => $this->input->post('username'),
							// 'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							// 'is_admin' => $role,
							// 'id_prov' => $role,
							// 'id_kab' => $role,
							// 'type' => $role,
							// 'id_group' => $role,
							// 'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}else if ($role == 2) {
						$tipe = $this->input->post('tipe_daerah');
						
						if ($tipe == 'prov') {
							$prov = $this->input->post('prov');
							$kab = $this->input->post('prov');
						}else{
							$prov = $this->input->post('prov');
							$kab = $this->input->post('kab');
						}
						$data = array(
							'name' => $this->input->post('nama'),
							// 'username' => $this->input->post('username'),
							// 'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							// 'is_admin' => $role,
							// 'id_prov' => $prov,
							// 'id_kab' => $kab,
							// 'type' => $role,
							// 'id_group' => $role,
							// 'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}else{
						$data = array(
							'name' => $this->input->post('nama'),
							// 'username' => $this->input->post('username'),
							// 'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telp' => $this->input->post('telp'),
							'email' => $this->input->post('email'),
							// 'is_admin' => $role,
							// 'id_prov' => $this->input->post('instansi'),
							// 'id_kab' => $this->input->post('instansi'),
							// 'type' => $role,
							// 'id_group' => $role,
							// 'create_at' => date('Y-m-d H:i:s'),
							'update_at' => date('Y-m-d H:i:s'),
						);
					}

					if($password != ''){
						$dataUpdate = array_merge($data,$dataPass);
					}else{
						$dataUpdate = $data;
					}
					$data = $this->security->xss_clean($dataUpdate);
					$result = $this->user_model->edit_user($data,$whereUpdate);
					if($result){
						$dataRet['pesan'] = "Data Berhasil DiUpdate!";
					}
					echo json_encode($dataRet);
			
			
		}


		public function edit($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/users/user_list';
					$this->load->view('template/layout', $data);
				}
				else{
					
						$data = array(
								'name' => $this->input->post('nama'),
								'telp' => $this->input->post('telp'),
								'email' => $this->input->post('email'),
								'update_at' => date('Y-m-d H:i:s'),
						);

					if(!empty($this->input->post('password'))){
						$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
					}
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->edit_user($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url('data-user'));
					}
				}
			}
			else{
				$data['view'] = 'admin/users/user_list';
				$this->load->view('template/layout', $data);
			}
		}



		public function del($id = 0){
			$this->db->delete('ms_user', array('id_user' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url('data-user'));
		}

	}


?>