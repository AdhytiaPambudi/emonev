<?php
	class MasterRekeningModel extends CI_Model{

		var $table_1 = 'ms_rek1'; //nama tabel dari database
	    var $column_order_1 = array(null,'kd_rek1'); //field yang ada di table 
	    var $column_search_1 = array('kd_rek1','nm_rek1'); //field yang diizin untuk pencarian 
        var $order_1 = array('kd_rek1' => 'asc'); // default order 
        
        var $table_2 = 'ms_rek2'; //nama tabel dari database
	    var $column_order_2 = array(null,'kd_rek2'); //field yang ada di table 
	    var $column_search_2 = array('kd_rek2','nm_rek2'); //field yang diizin untuk pencarian 
	    var $order_2 = array('kd_rek2' => 'asc'); // default order 

        var $table_3 = 'ms_rek3'; //nama tabel dari database
	    var $column_order_3 = array(null,'kd_rek3'); //field yang ada di table 
	    var $column_search_3 = array('kd_rek3','nm_rek3'); //field yang diizin untuk pencarian 
	    var $order_3 = array('kd_rek3' => 'asc'); // default order 

        var $table_4 = 'ms_rek4'; //nama tabel dari database
	    var $column_order_4 = array(null,'kd_rek4'); //field yang ada di table 
	    var $column_search_4 = array('kd_rek4','nm_rek4'); //field yang diizin untuk pencarian 
        var $order_4 = array('kd_rek4' => 'asc'); // default order 
        
        var $table_5 = 'ms_rek5'; //nama tabel dari database
	    var $column_order_5 = array(null,'kd_rek5'); //field yang ada di table 
	    var $column_search_5 = array('kd_rek5','nm_rek5'); //field yang diizin untuk pencarian 
	    var $order_5 = array('kd_rek5' => 'asc'); // default order 
	    
		private function _get_all_rek1_query()
	    {
	        $this->db->from($this->table_1);	
	        $i = 0;
	        foreach ($this->column_search_1 as $item) // looping awal
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
	                if(count($this->column_search_1) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_1))
	        {
	            $order = $this->order_1;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_rek1()
	    {
	        $this->_get_all_rek1_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_rek1()
	    {
	        $this->_get_all_rek1_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_rek1()
	    {
	        $this->db->from($this->table_1);
	        return $this->db->count_all_results();
        }
        
        // ---------------------------------------------------------------------------

        private function _get_all_rek2_query($parent)
	    {
            $this->db->where('kd_rek1',$parent);
	        $this->db->from($this->table_2);	
	        $i = 0;
	        foreach ($this->column_search_2 as $item) // looping awal
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
	                if(count($this->column_search_2) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_2))
	        {
	            $order = $this->order_2;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_rek2($parent)
	    {
	        $this->_get_all_rek2_query($parent);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_rek2($parent)
	    {
	        $this->_get_all_rek2_query($parent);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_rek2($parent)
	    {
            $this->db->where('kd_rek1',$parent);
	        $this->db->from($this->table_2);
	        return $this->db->count_all_results();
        }
        
        // -----------------------------------------------

        private function _get_all_rek3_query($parent)
	    {
            $this->db->where('kd_rek2',$parent);
	        $this->db->from($this->table_3);	
	        $i = 0;
	        foreach ($this->column_search_3 as $item) // looping awal
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
	                if(count($this->column_search_3) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_3))
	        {
	            $order = $this->order_3;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_rek3($parent)
	    {
	        $this->_get_all_rek3_query($parent);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_rek3($parent)
	    {
	        $this->_get_all_rek3_query($parent);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_rek3($parent)
	    {
            $this->db->where('kd_rek2',$parent);
	        $this->db->from($this->table_3);
	        return $this->db->count_all_results();
        }
        
        // -----------------------------------------------


        private function _get_all_rek4_query($parent)
	    {
            $this->db->where('kd_rek3',$parent);
	        $this->db->from($this->table_4);	
	        $i = 0;
	        foreach ($this->column_search_4 as $item) // looping awal
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
	                if(count($this->column_search_4) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_4[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_4))
	        {
	            $order = $this->order_4;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_rek4($parent)
	    {
	        $this->_get_all_rek4_query($parent);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_rek4($parent)
	    {
	        $this->_get_all_rek4_query($parent);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_rek4($parent)
	    {
            $this->db->where('kd_rek3',$parent);
	        $this->db->from($this->table_4);
	        return $this->db->count_all_results();
        }
        
        // -----------------------------------------------



        private function _get_all_rek5_query($parent)
	    {
            $this->db->where('kd_rek4',$parent);
	        $this->db->from($this->table_5);	
	        $i = 0;
	        foreach ($this->column_search_5 as $item) // looping awal
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
	                if(count($this->column_search_5) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_5[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_5))
	        {
	            $order = $this->order_5;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_rek5($parent)
	    {
	        $this->_get_all_rek5_query($parent);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_rek5($parent)
	    {
	        $this->_get_all_rek5_query($parent);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_rek5($parent)
	    {
            $this->db->where('kd_rek4',$parent);
	        $this->db->from($this->table_5);
	        return $this->db->count_all_results();
        }
        
        // -----------------------------------------------





	    // pk skpd

	    private function _get_all_pk_skpd_query()
	    {
	    	
	        $this->db->from($this->table_skpd);
			
	        $i = 0;
	     
	        foreach ($this->column_search_skpd as $item) // looping awal
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
	 
	                if(count($this->column_search_skpd) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	        
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_skpd[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_skpd))
	        {
	            $order = $this->order_skpd;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_pk_skpd()
	    {
	        $this->_get_all_pk_skpd_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_pk_skpd()
	    {
	        $this->_get_all_pk_skpd_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_pk_skpd()
	    {
	        $this->db->from($this->table_skpd);
	        return $this->db->count_all_results();
	    }


	    // pk bidang

	    private function _get_all_pk_bidang_query($whereskpd)
	    {
	    	$this->db->select('m.kd_urusan,m.nm_urusan,sum(total) as pagu, sum(total_ubah) as pagu_ubah');
	        $this->db->where('kd_skpd',$whereskpd);
	        $this->db->from('trskpd t');
	    	$this->db->join('ms_urusan m', 'm.kd_urusan = t.kd_urusan');
			
	        $i = 0;
	     
	        foreach ($this->column_search_bidang as $item) // looping awal
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
	 
	                if(count($this->column_search_bidang) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         $this->db->group_by("t.kd_urusan"); 
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_bidang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_bidang))
	        {
	            $order = $this->order_bidang;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_pk_bidang($skpd)
	    {
	        $this->_get_all_pk_bidang_query($skpd);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_pk_bidang($skpd)
	    {
	        $this->_get_all_pk_bidang_query($skpd);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_pk_bidang($skpd)
	    {
	        $this->db->select('m.kd_urusan,m.nm_urusan,sum(total) as pagu, sum(total_ubah) as pagu_ubah');
	        $this->db->from('trskpd t');
	        $this->db->where('kd_skpd',$skpd);
	    	$this->db->join('ms_urusan m', 'm.kd_urusan = t.kd_urusan');
	    	$this->db->group_by("t.kd_urusan"); 

	        return $this->db->count_all_results();
	    }


	    // pk program

	    private function _get_all_pk_program_query($whereskpd,$wherebidang)
	    {
	    	$this->db->select('t.kd_urusan,t.kd_program,t.kd_program1,t.nm_program,sum(total) as pagu, sum(total_ubah) as pagu_ubah');
	        $this->db->where('kd_skpd',$whereskpd);
	        $this->db->where('kd_urusan',$wherebidang);
	        $this->db->from('trskpd t');
	        $i = 0;
	     
	        foreach ($this->column_search_program as $item) // looping awal
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
	 
	                if(count($this->column_search_bidang) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         $this->db->group_by("t.kd_program"); 
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_bidang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_program))
	        {
	            $order = $this->order_program;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_pk_program($skpd,$bidang)
	    {
	        $this->_get_all_pk_program_query($skpd,$bidang);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_pk_program($skpd,$bidang)
	    {
	        $this->_get_all_pk_program_query($skpd,$bidang);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_pk_program($skpd,$bidang)
	    {
	        $this->db->select('t.kd_urusan,t.kd_program,t.kd_program1,t.nm_program,sum(total) as pagu, sum(total_ubah) as pagu_ubah');
	        $this->db->where('kd_skpd',$skpd);
	        $this->db->where('kd_urusan',$bidang);
	        $this->db->from('trskpd t');
	    	$this->db->group_by("t.kd_program"); 

	        return $this->db->count_all_results();
		}
		

		// pk kegiatan

	    private function _get_all_pk_kegiatan_query($whereskpd,$wherebidang,$whereprogram)
	    {
	    	$this->db->select('t.kd_kegiatan,t.kd_kegiatan1,t.nm_kegiatan,sum(total) as pagu, sum(total_ubah) as pagu_ubah');
	        $this->db->where('kd_skpd',$whereskpd);
			$this->db->where('kd_urusan',$wherebidang);
			$this->db->where('kd_program',$whereprogram);
	        $this->db->from('trskpd t');
	        $i = 0;
	     
	        foreach ($this->column_search_program as $item) // looping awal
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
	 
	                if(count($this->column_search_bidang) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         $this->db->group_by("t.kd_kegiatan"); 
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_bidang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_program))
	        {
	            $order = $this->order_program;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_pk_kegiatan($skpd,$bidang,$program)
	    {
	        $this->_get_all_pk_kegiatan_query($skpd,$bidang,$program);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_pk_kegiatan($skpd,$bidang,$program)
	    {
	        $this->_get_all_pk_kegiatan_query($skpd,$bidang,$program);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_pk_kegiatan($skpd,$bidang,$program)
	    {
			$this->db->select('t.kd_kegiatan,t.kd_kegiatan1,t.nm_kegiatan,sum(total) as pagu, sum(total_ubah) as pagu_ubah');
	        $this->db->where('kd_skpd',$skpd);
			$this->db->where('kd_urusan',$bidang);
			$this->db->where('kd_program',$program);
	        $this->db->from('trskpd t');
	    	$this->db->group_by("t.kd_kegiatan"); 

	        return $this->db->count_all_results();
	    }


	    // urusan

		public function add_urusan($data){
			
			$this->db->insert($this->table_urusan, $data);
			return true;
		}

		private function _get_all_urusan_query()
	    {
	    	
	        $this->db->from($this->table_urusan);
			
	        $i = 0;
	     
	        foreach ($this->column_search_urusan as $item) // looping awal
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
	 
	                if(count($this->column_search_urusan) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_urusan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_urusan))
	        {
	            $order = $this->order_urusan;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_urusan()
	    {
	        $this->_get_all_urusan_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_urusan()
	    {
	        $this->_get_all_urusan_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_urusan()
	    {
	        $this->db->from($this->table_urusan);
	        return $this->db->count_all_results();
	    }



	    // fungsi

	    public function add_fungsi($data){
			
			$this->db->insert($this->table_fungsi, $data);
			return true;
		}

		private function _get_all_fungsi_query()
	    {
	    	
	        $this->db->from($this->table_fungsi);
			
	        $i = 0;
	     
	        foreach ($this->column_search_fungsi as $item) // looping awal
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
	 
	                if(count($this->column_search_fungsi) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_fungsi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_fungsi))
	        {
	            $order = $this->order_fungsi;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_fungsi()
	    {
	        $this->_get_all_fungsi_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_fungsi()
	    {
	        $this->_get_all_fungsi_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_fungsi()
	    {
	        $this->db->from($this->table_fungsi);
	        return $this->db->count_all_results();
	    }



		public function get_useronline(){
			$query = $this->db->get_where('ms_user', array('st_login' => '1'));
			return $result = $query->result_array();
		}

		public function get_user_by_id($id){
			$query = $this->db->get_where('ms_user', array('id_user' => $id));
			return $result = $query->row_array();
		}

		public function edit_user($data, $where){
			$this->db->where($where);
			$this->db->update('ms_user', $data);
			return true;
		}

		public function get_kab_by_id($id){

			$query = $this->db->get_where('m_group_akses', array('ms_group_id' => $id));
			
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
					$hasil .= $row->ms_menu_id . ',';				
				} else 
				{
					$hasil .= $row->ms_menu_id;				
				}
			}
			
			$query2 = $this->db->get_where('m_group', array('id' => $id));
			// print_r($query2->row()->nama);die();
			$data['nm_group'] = $query2->row()->nama;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}

		public function getjenis()
		{
			$this->db->select('*');
			$this->db->from('m_group');
			$this->db->order_by('id', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Grup Akses--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id'].'">'.$row['kode'].' || '.$row['nama'].'</option>';
			}
			return $html;
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