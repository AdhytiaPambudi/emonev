<?php
	class PesertaModel extends CI_Model{

		var $table = 'ms_peserta a'; //nama tabel dari database
	    var $column_order = array(null,'no_induk'); //field yang ada di table 
	    var $column_search = array('no_induk','nama'); //field yang diizin untuk pencarian 
	    var $order = array('no_induk' => 'asc'); // default order 

		public function add_user($data){
			
			$this->db->insert('ms_peserta', $data);
			return true;
		}

		public function get_all_users(){
			$this->db->select('*, sys_group.id_group as sys_group_id');
			$this->db->from('sys_group');
			$this->db->join('ms_user', 'sys_group.id_group = ms_user.id_group');
			$query = $this->db->get();

			//$query = $this->db->get();
			//$query = $this->db->get('ci_users');
			return $result = $query->result_array();
		}

		private function _get_all_peserta_query()
	    {
	    	
	        $this->db->from($this->table);
			
	        $i = 0;
	     
	        foreach ($this->column_search as $item) // looping awal
	        {
	            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
	            {
	                 
	                if($i===0) // looping awal
	                {
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                }
	                else
	                {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	 
	                if(count($this->column_search) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_peserta()
	    {
	        $this->_get_all_peserta_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_peserta()
	    {
	        $this->_get_all_peserta_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_peserta()
	    {
	    	
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }


		public function get_useronline(){
			$query = $this->db->get_where('ms_peserta', array('st_login' => '1'));
			return $result = $query->result_array();
		}

		public function get_user_by_id($id){
			$query = $this->db->get_where('ms_peserta', array('no_induk' => $id));
			return $result = $query->row_array();
		}

		public function edit_user($data, $where){
			$this->db->where($where);
			$this->db->update('ms_peserta', $data);
			return true;
		}

		public function get_kab_by_id($id){

			$query = $this->db->get_where('sys_group', array('id_group' => $id));
			
			$data = array();
			$hasil = "";

			// SETTING TAHUN ANGGARAN
			// $this->db->select('thn_ang');
			// $querysysclient = $this->db->get('utilitas.sys_sclient');
			// $rowsysclient = $querysysclient->row();
			// if (isset($rowsysclient))
			// {
				$data['thn_ang'] = date('Y');
			// }

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}

		public function getprov()
		{
			$this->db->select('*');
			$this->db->from('ms_daerah');
			$this->db->where('clevel', 1);
			$this->db->order_by('id_daerah', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Provinsi--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		}

		public function getinstansi()
		{
			$this->db->select('*');
			$this->db->from('ms_instansi_kemendagri');
			$this->db->order_by('id_instansi', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Instansi--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_instansi'].'">'.$row['id_instansi'].' || '.$row['nm_instansi'].'</option>';
			}
			return $html;
		}

		public function getkab($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_daerah');
			$this->db->where('hd_daerah', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kabupaten--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		}

		public function get_username($header = '',$role = ''){
			if ($role == 'prov') {
				$query = 'select max(username) as get_usrnm from ms_user where left(username,2) = "'.$header.'"';
			}else if($role == 'kab'){
				$query = 'select max(username) as get_usrnm from ms_user where left(username,4) = "'.$header.'"';
			}else{
				$query = 'select max(username) as get_usrnm from ms_user where left(username,4) = "'.$header.'"';
			}
			$result = $this->db->query($query)->row()->get_usrnm;
			$new = '00';
			if ($result == 0 || $result == '') {
				$result = $header.$new;
			}
			$max = $result+1;
			

			return $max;
		}

	}

?>