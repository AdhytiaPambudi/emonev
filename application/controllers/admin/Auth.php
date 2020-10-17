<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('admin/auth_model', 'auth_model');
			$this->load->model('admin/opd_model', 'opd_model');
			$this->load->model('admin/User_model', 'user_model');
		}

		public function index(){

			if($this->session->has_userdata('is_admin_login'))
			{
				// redirect('admin/dashboard');
				redirect('dashboard');
			}
			else{
				redirect('login');
			}
		}

		public function backuprestore(){

			if($this->session->has_userdata('is_admin_login'))
			{
				// redirect('admin/dashboard');
				redirect('dashboard-bappeda');
			}
			else{
				redirect('login');
			}
		}

		public function login(){
			$this->load->library('encrypt');
			if($this->input->post('submit')){
				if (isset($_POST['perubahan'])) {
					$sts_ang =  "Perubahan";
				}else{
					$sts_ang =  "Murni";
				}
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['msg'] = 'Username/Password Tidak Valid!';
					$this->load->view('admin/auth/login', $data);
				}
				else {

					$data = array(
						'username' 	=> $this->input->post('username'),
						'userpwd' 	=> $this->input->post('password')
					);
					$result = $this->auth_model->login($data);


					if ($result == TRUE) {
						// cek data config
						$thn_login = $this->input->post('tahun');
						$cekConfig = $this->db->get_where('ms_user', array('username' => $user))->result();
						if (count($cekConfig) == 0) {
							$dataInsert = array('tahun_anggaran'=>$thn_login);
							$this->db->insert('ms_config',$dataInsert);
						}

						$kab = $this->user_model->get_kab_by_id($result['group_id']);
						// print_r($kab);die();
						$iduser = $result['id'];
						$data2 = array(
									'st_login' => 1,
									'last_login' => date('Y-m-d H:i:s'),
								);

						$data2 = $this->security->xss_clean($data2);
						// $result2 = $this->user_model->edit_user($data2, $iduser);
						
						$admin_data = array(
							'admin_id' 			=> $result['id'],
							'user_id' 			=> $result['id'],
						 	'name' 				=> $result['username'],
						 	'nama' 				=> $result['username'],
						 	'id_kab' 			=> $result['id_skpd'],
							 'id_prov' 			=> $result['id_skpd'],
							 'id_skpd' 			=> $result['id_skpd'],
						 	'kab' 				=> $result['group_id'],
						 	'is_admin_login' 	=> TRUE,
						 	'is_admin' 			=> $result['group_id'],
							'mn'				=> $this->encrypt->encode($kab['menu_permission']),
							'siteDec'			=> $kab['nm_group'],
							'thn_ang'			=> $this->input->post('tahun'),
							'sts_ang'			=> $sts_ang,
							// 'year_selected'		=> $kab['thn_ang'],
							'year_selected'		=> $this->input->post('tahun')
						);
						
						$this->session->set_userdata($admin_data);
						redirect(base_url('dashboard'), 'refresh');
					}
					else{
						$data['msg'] = '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">
						<button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
						  <span class="icon-sc-cl" aria-hidden="true">×</span>
						</button>
						<i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>
						<p><strong>Maaf!</strong> Username atau password salah.</p>
					</div>';
						$this->load->view('admin/auth/login', $data);
					}
				}
			}
			else{
				$data['msg'] = '';
				$this->load->view('admin/auth/login',$data);
				// redirect(base_url(''), $data);
			}
		}	

		public function login_tlhp(){
			$this->load->library('encrypt');
			if($this->input->post('submit')){
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['msg'] = 'Username/Password Tidak Valid!';
					$this->load->view('admin/auth/login-tlhp', $data);
				}
				else {

					$data = array(
						'username' 	=> $this->input->post('username'),
						'password' 	=> $this->input->post('password')
					);

					$result = $this->auth_model->login($data);

					if ($result == TRUE) {
						
						$kab = $this->user_model->get_kab_by_id($result['id_group']);

						$iduser = $result['id_user'];

						$data2 = array(
									'st_login' => 1,
									'last_login' => date('Y-m-d H:i:s'),
								);

						$data2 = $this->security->xss_clean($data2);
						$result2 = $this->user_model->edit_user($data2, $iduser);
						
						$admin_data = array(
							'admin_id' 			=> $result['id_user'],
							'user_id' 			=> $result['id_user'],
						 	'name' 				=> $result['username'],
						 	'nama' 				=> $result['name'],
						 	'id_kab' 			=> $result['id_kab'],
						 	'id_prov' 			=> $result['id_prov'],
						 	'kab' 				=> $result['id_group'],
						 	'is_admin_login' 	=> TRUE,
						 	'is_admin' 			=> $result['is_admin'],
							'mn'				=> $this->encrypt->encode($kab['menu_permission']),
							'siteDec'			=> $kab['nm_group'],
							'thn_ang'			=> $kab['thn_ang'],
							'year_selected'		=> $this->input->post('tahun')
						);

						$this->session->set_userdata($admin_data);
						redirect(base_url('tlhp-pemda'), 'refresh');
					}
					else{

						$data['msg'] = 'Username atau Password Tidak Valid!';
						$this->load->view('admin/auth/login-tlhp', $data);
					}
				}
			}
			else{
				$this->load->view('admin/auth/login-tlhp');
				// redirect(base_url(''), $data);
			}
		}	

		public function login_tlhp_kemendagri(){
			$this->load->library('encrypt');
			if($this->input->post('submit')){
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['msg'] = 'Username/Password Tidak Valid!';
					$this->load->view('admin/auth/login-tlhp-kemendagri', $data);
				}
				else {

					$data = array(
						'username' 	=> $this->input->post('username'),
						'password' 	=> $this->input->post('password')
					);

					$result = $this->auth_model->login($data);

					if ($result == TRUE) {
						
						$kab = $this->user_model->get_kab_by_id($result['id_group']);

						$iduser = $result['id_user'];

						$data2 = array(
									'st_login' => 1,
									'last_login' => date('Y-m-d H:i:s'),
								);

						$data2 = $this->security->xss_clean($data2);
						$result2 = $this->user_model->edit_user($data2, $iduser);
						
						$admin_data = array(
							'admin_id' 			=> $result['id_user'],
							'user_id' 			=> $result['id_user'],
						 	'name' 				=> $result['username'],
						 	'nama' 				=> $result['name'],
						 	'id_kab' 			=> $result['id_kab'],
						 	'id_prov' 			=> $result['id_prov'],
						 	'kab' 				=> $result['id_group'],
						 	'is_admin_login' 	=> TRUE,
						 	'is_admin' 			=> $result['is_admin'],
							'mn'				=> $this->encrypt->encode($kab['menu_permission']),
							'siteDec'			=> $kab['nm_group'],
							'thn_ang'			=> $kab['thn_ang'],
							'year_selected'		=> $this->input->post('tahun')
						);

						$this->session->set_userdata($admin_data);
						redirect(base_url('tlhp-kemendagri'), 'refresh');
					}
					else{

						$data['msg'] = 'Username atau Password Tidak Valid!';
						$this->load->view('admin/auth/login-tlhp-kemendagri', $data);
					}
				}
			}
			else{
				$this->load->view('admin/auth/login-tlhp-kemendagri');
				// redirect(base_url(''), $data);
			}
		}	



		public function change_pwd(){

			$id = $this->session->userdata('admin_id');

			if($this->input->post('submit')){
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/auth/change_pwd';
					$this->load->view('admin/layout', $data);
				}
				else{
					$data = array(
						'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
					);

					$result = $this->auth_model->change_pwd($data, $id);

					if($result){
						$this->session->set_flashdata('msg', 'Password has been changed successfully!');
						redirect(base_url('admin/auth/change_pwd'));
					}
				}
			}
			else{
				$data['view'] = 'admin/auth/change_pwd';
				$this->load->view('template/layout', $data);
			}
		}

		public function logout(){
				$id = $this->session->userdata('user_id');

				$data = array(
							'st_login' => 0,
							'last_logout' => date('Y-m-d H:i:s'),
						);

				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);

			$this->session->sess_destroy();
			// redirect(base_url('admin/auth/login'), 'refresh');
			redirect(base_url('login'), 'refresh');
		}
	}  // end class
?>