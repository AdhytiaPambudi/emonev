<?php
	class DaerahModel extends CI_Model{

		var $table = 'ms_daerah'; //nama tabel dari database
	    var $column_order = array(null,'id_daerah'); //field yang ada di table 
	    var $column_search = array('id_daerah','nm_daerah','ket',); //field yang diizin untuk pencarian 
	    var $order = array('id_daerah' => 'asc'); // default order 

		public function add_daerah($data){
			$this->db->insert('ms_daerah', $data);
			return true;
		}

		private function _get_all_prov_query()
	    {
	    	$this->db->where('clevel',1);
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
	 
	    function get_all_prov()
	    {
	        $this->_get_all_prov_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_prov()
	    {
	        $this->_get_all_prov_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_prov()
	    {
	    	$this->db->where('clevel',1);
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }


	    private function _get_all_kab_query()
	    {
	    	$this->db->where('clevel',2);
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
	 
	    function get_all_kab()
	    {
	        $this->_get_all_kab_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_kab()
	    {
	        $this->_get_all_kab_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_kab()
	    {
	    	$this->db->where('clevel',2);
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }


		public function get_max_daerah($lvl,$header = ''){
			$this->db->select_max('id_daerah');
			$this->db->where('clevel', $lvl);
			if ($lvl != 1) {
				$this->db->where('hd_daerah', $header);
			}
			$new = array('','00','00','00','2000');
			$this->db->from('ms_daerah');
			$query = $this->db->get();
			$result = $query->row()->id_daerah;
			if ($result == 0 || $result == '') {
				$result = $header.$new[$lvl];
			}
			$max = $result+1;

			return $max;
		}

		public function get_all_rek90(){
			$this->db->select('*');
			$this->db->where('left(id_rek90,2)', '52');
			$this->db->where('clevel', '5');
			$this->db->from('ms_rek90');
			$query = $this->db->get();
			return $result = $query->result_array();
		}

		public function get_lokasi_by_id($id){
			if(strlen($id) == 2){
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = l.id_daerah) as prov,
				'' as kab,
				'' as kec,
				'' as des
				 FROM ms_daerah l WHERE id_daerah = '".$id."';";
			}elseif (strlen($id) == 4) {
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = LEFT(l.hd_lokasi,2)) as prov,
				(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = l.id_daerah) as kab,
				'' as kec,
				'' as des
				 FROM ms_daerah l WHERE id_daerah = '".$id."';";
			}elseif (strlen($id) == 6) {
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = LEFT(l.hd_lokasi,2)) as prov,
				(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = LEFT(l.hd_lokasi,4)) as kab,
				(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = l.id_daerah) as kec,
				'' as des
				 FROM ms_daerah l WHERE id_daerah = '".$id."';";
			}elseif (strlen($id) == 10) {
				$csql = "SELECT *,(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = LEFT(l.hd_lokasi,2)) as prov,
				(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = LEFT(l.hd_lokasi,4)) as kab,
				(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = LEFT(l.hd_lokasi,7)) as kec,
				(SELECT nm_lokasi FROM ms_daerah WHERE id_daerah = l.id_daerah) as des
				 FROM ms_daerah l WHERE id_daerah = '".$id."';";
			}
			$query = $this->db->query($csql);
			return $result = $query->row_array();
		}

		public function edit_daerah($data, $id){
			$this->db->where('id_daerah', $id);
			$this->db->update('ms_daerah', $data);
			return true;
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

		public function getkab($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_daerah');
			$this->db->where('hd_prov', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kabupaten--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		}

		public function getkec($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_daerah');
			$this->db->where('hd_daerah', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kecamatan--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_daerah'].'">'.$row['id_daerah'].' || '.$row['nm_daerah'].'</option>';
			}
			return $html;
		}

		

	}

?>