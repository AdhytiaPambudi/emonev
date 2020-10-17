<?php
	class GroupModel extends CI_Model{

		var $table = 'm_group a'; //nama tabel dari database
	    var $column_order = array(null,'kode'); //field yang ada di table 
	    var $column_search = array('nama','ket'); //field yang diizin untuk pencarian 
	    var $order = array('kode' => 'asc'); // default order 

		public function add_group($data){
			
			$this->db->insert('m_group', $data);
			return true;
		}
		

	

		private function _get_all_group_query()
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
	 
	    function get_all_group()
	    {
	        $this->_get_all_group_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_group()
	    {
	        $this->_get_all_group_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_group()
	    {
	    	
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }



		public function edit_group($data, $where){
			$this->db->where($where);
			$this->db->update('m_group', $data);
			return true;
		}


		public function get_max(){
			
			$query = "SELECT CONCAT('G',RIGHT(CONCAT('00',MAX(RIGHT(kode,3))+1),3)) AS kodemax FROM m_group;";
			$result = $this->db->query($query)->row()->kodemax;
			return $result;
		}

	}

?>