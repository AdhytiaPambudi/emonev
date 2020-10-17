<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class GroupController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('setting/GroupModel', 'gr_model');
		}

		public function index(){
			$data['view'] = 'setting/group/groupView';
			$this->load->view('template/layout', $data);
        }
        
        public function set_akses(){
			$data['view'] = 'setting/group/groupAksesView';
			$this->load->view('template/layout', $data);
		}

		public function get() {
			$list = $this->gr_model->get_all_group();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->kode;
                $row[] = $field->nama;
                $row[] = $field->ket;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kode.'" data-nama="'.$field->nama.'" data-ket="'.$field->ket.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kode.'" data-nama="'.$field->nama.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->gr_model->count_all_group(),
	            "recordsFiltered" => $this->gr_model->count_filtered_group(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function getmax(){

			 $max=$this->gr_model->get_max();
			 echo $max;
		}
		
		public function insert(){
        
            $data = array(
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'ket' => $this->input->post('ket'),
                'aktif' => 1,
            );
            
            $data = $this->security->xss_clean($data);
            $result = $this->gr_model->add_group($data);
            if($result){
                $dataRet['pesan'] = "Data Berhasil Ditambahkan!";
            }
            echo json_encode($dataRet);
			
			
		}


		public function update(){
			$whereUpdate = array('kode' => $this->input->post('kode'));
            $dataUpdate = array(
                'nama' => $this->input->post('nama'),
                'ket' => $this->input->post('ket'),
            );
            $data = $this->security->xss_clean($dataUpdate);
            $result = $this->gr_model->edit_group($data,$whereUpdate);
            if($result){
                $dataRet['pesan'] = "Data Berhasil DiUpdate!";
            }
            echo json_encode($dataRet);
		}


		public function edit($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'setting/users/user_list';
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
					$result = $this->gr_model->edit_user($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url('data-user'));
					}
				}
			}
			else{
				$data['view'] = 'setting/users/user_list';
				$this->load->view('template/layout', $data);
			}
		}

		public function del($id = 0){
			$this->db->delete('m_group', array('kode' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url('setting-group'));
		}

	}


?>