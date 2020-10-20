<?php
	class MasterModel extends CI_Model{

		var $table = 'trskpd t'; //nama tabel dari database

		// sd
		var $table_sd = 'ms_dana'; //nama tabel dari database
	    var $column_order_sd = array(null,'kd_sdana'); //field yang ada di table 
	    var $column_search_sd = array('kd_sdana','nm_sdana'); //field yang diizin untuk pencarian 
	    var $order_sd = array('kd_sdana' => 'asc'); // default order 

		// fungsi
		var $table_fungsi = 'ms_fungsi'; //nama tabel dari database
	    var $column_order_fungsi = array(null,'kd_fungsi'); //field yang ada di table 
	    var $column_search_fungsi = array('kd_fungsi','nm_fungsi'); //field yang diizin untuk pencarian 
	    var $order_fungsi = array('kd_fungsi' => 'asc'); // default order 

	    // urusan
		var $table_urusan = 'ms_urusan'; //nama tabel dari database
	    var $column_order_urusan = array(null,'kd_urusan'); //field yang ada di table 
	    var $column_search_urusan = array('kd_urusan','nm_urusan'); //field yang diizin untuk pencarian 
	    var $order_urusan = array('kd_urusan' => 'asc'); // default order 

	    // urusan
		var $table_skpd = 'viewprogkegskpd'; //nama tabel dari database
	    var $column_order_skpd = array(null,'kd_skpd'); //field yang ada di table 
	    var $column_search_skpd = array('kd_skpd','nm_skpd'); //field yang diizin untuk pencarian 
	    var $order_skpd = array('kd_skpd' => 'asc'); // default order 

	    var $order_bidang = array('kd_urusan' => 'asc'); // default order 
	    var $column_order_bidang = array(null,'kd_urusan'); //field yang ada di table 
	    var $column_search_bidang = array('kd_urusan','nm_urusan'); //field yang diizin untuk pencarian 
	    // bidang
	    var $table_bidang = 'ms_bidang'; //nama tabel dari database



	    // skpd

		public function viewSKPD()
		{
			
			$ta = $this->session->userdata('thn_ang');
			$akses = $this->session->userdata('is_admin');
			$skpd = $this->session->userdata('id_skpd');
			if($akses == 1){
				$skpd = $this->session->userdata('id_skpd');
				$query="call viewPantauSkpd('".$ta."');";
			}else if($akses == 3){
				$skpd = $this->session->userdata('id_skpd');
				$arrSKPD = $this->PublicModel->skpdByBidang($skpd);
				$query="SELECT
					  `a`.`kd_skpd`     AS `kd_skpd`,
					  `a`.`nm_skpd`     AS `nm_skpd`,
					  SUM(`a`.`Nilai`)  AS `susun`,
					  SUM(`a`.`Nilai_ubah`) AS `ubah`
					FROM (`trdrka` `a`
					   JOIN `trskpd` `b`
					     ON ((`a`.`kd_kegiatan` = `b`.`kd_kegiatan` AND a.tahun_anggaran = b.tahun_anggaran)))
					WHERE b.tahun_anggaran = ".$ta." AND a.kd_skpd IN (".$arrSKPD.")
					GROUP BY `a`.`kd_skpd`";
			}else{
				$skpd = $this->session->userdata('id_skpd');
				$query="call viewPantauSkpdBy('".$ta."','".$skpd."');";
			}
			
			$data = $this->db->query($query)->result();
			
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				$kd_skpd= '<a href="'.base_url("program-kegiatan/bidang?skpd=".$value->kd_skpd).'">'.$value->kd_skpd.'</a>';
	            $nm_skpd = '<a href="'.base_url("program-kegiatan/bidang?skpd=".$value->kd_skpd).'">'.$value->nm_skpd.'</a>';
				// $kd_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->kd_skpd.'</a>';
				// $nm_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->nm_skpd.'</a>';
				$susun 		= number_format($value->susun,2,',','.');
				$ubah 		= number_format($value->ubah,2,',','.');
				$html.='<tr>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:15%;text-align:center;">'.$kd_skpd.'</td>
							<td style="width:40%;text-align:left;">'.$nm_skpd.'</td>
							<td style="width:20%;text-align:right;">'.$susun.'</td>
							<td style="width:20%;text-align:right;">'.$ubah.'</td>
						</tr>';
			}
			
			return $html;
		}


		public function viewSD()
		{
			
			$ta = $this->session->userdata('thn_ang');
			$akses = $this->session->userdata('is_admin');
			$skpd = $this->session->userdata('id_skpd');

			$sts = 'Murni';

			if($akses == 1){
				$skpd = $this->session->userdata('id_skpd');
				$query="SELECT a.sumber,a.tahun_anggaran,m.* FROM trdrka a 
LEFT JOIN (
SELECT a.*,b.nm_group_sd FROM mapping_sd a inner JOIN ms_group_sd b on a.kd_group_sd = b.kd_group_sd  where a.sts_anggaran = '".$sts."'
) m on a.sumber = m.nm_sumberdana and a.tahun_anggaran = m.thn_anggaran WHERE a.tahun_anggaran = ".$ta."
GROUP BY a.sumber;";
			}else if($akses == 3){
				$skpd = $this->session->userdata('id_skpd');
				$arrSKPD = $this->PublicModel->skpdByBidang($skpd);
				$query="SELECT a.sumber,a.tahun_anggaran,m.* FROM trdrka a 
LEFT JOIN (
SELECT a.*,b.nm_group_sd FROM mapping_sd a inner JOIN ms_group_sd b on a.kd_group_sd = b.kd_group_sd
) m on a.sumber = m.nm_sumberdana and a.tahun_anggaran = m.thn_anggaran WHERE a.tahun_anggaran = ".$ta."
GROUP BY a.sumber;";
			}else{
				$skpd = $this->session->userdata('id_skpd');
				$query="SELECT a.sumber,a.tahun_anggaran,m.* FROM trdrka a 
LEFT JOIN (
SELECT a.*,b.nm_group_sd FROM mapping_sd a inner JOIN ms_group_sd b on a.kd_group_sd = b.kd_group_sd
) m on a.sumber = m.nm_sumberdana and a.tahun_anggaran = m.thn_anggaran WHERE a.tahun_anggaran = ".$ta."
GROUP BY a.sumber;";
			}
			
			$data = $this->db->query($query)->result();

			
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				$button = '<a href="#" class="dropdown-item btn btn-success btn-flat btn-xs showModal" data-sd="'.$value->sumber.'" data-grp="'.$value->kd_group_sd.'" data-sts="'.$sts.'" data-tahun="'.$ta.'">Mapping</a>';
				$kd_skpd= '<a href="'.base_url("program-kegiatan/bidang?skpd=".$value->kd_skpd).'">Mapping</a>';
				// $kd_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->kd_skpd.'</a>';
				// $nm_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->nm_skpd.'</a>';
				$sumber = $value->sumber;
				$nm_group_sd = $value->nm_group_sd;
				$html.='<tr>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:40%;text-align:left;">'.$sumber.'</td>
							<td style="width:40%;text-align:left;">'.$nm_group_sd.'</td>
							<td style="width:20%;text-align:center;">'.$button.'</td>
						</tr>';
			}
			
			return $html;
		}


		public function viewSDP()
		{
			
			$ta = $this->session->userdata('thn_ang');
			$akses = $this->session->userdata('is_admin');
			$skpd = $this->session->userdata('id_skpd');

			$sts = 'Perubahan';

			
				$skpd = $this->session->userdata('id_skpd');
				$query="SELECT a.sumber_ubah,a.tahun_anggaran,m.* FROM trdrka a 
						LEFT JOIN (
						SELECT a.*,b.nm_group_sd FROM mapping_sd a inner JOIN ms_group_sd b on a.kd_group_sd = b.kd_group_sd  where a.sts_anggaran = '".$sts."'
						) m on a.sumber_ubah = m.nm_sumberdana and a.tahun_anggaran = m.thn_anggaran WHERE a.tahun_anggaran = ".$ta."
						GROUP BY a.sumber_ubah;";
				
			

			$data = $this->db->query($query)->result();


			
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				$button = '<a href="#" class="dropdown-item btn btn-success btn-flat btn-xs showModal" data-sd="'.$value->sumber_ubah.'" data-grp="'.$value->kd_group_sd.'" data-sts="'.$sts.'" data-tahun="'.$ta.'">Mapping</a>';
				$kd_skpd= '<a href="'.base_url("program-kegiatan/bidang?skpd=".$value->kd_skpd).'">Mapping</a>';
				// $kd_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->kd_skpd.'</a>';
				// $nm_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->nm_skpd.'</a>';
				$sumber = $value->sumber_ubah;
				$nm_group_sd = $value->nm_group_sd;
				$html.='<tr>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:40%;text-align:left;">'.$sumber.'</td>
							<td style="width:40%;text-align:left;">'.$nm_group_sd.'</td>
							<td style="width:20%;text-align:center;">'.$button.'</td>
						</tr>';
			}
			
			return $html;
		}


		public function add_skpd($data){
			
			$this->db->insert($this->table_skpd, $data);
			return true;
		}
		public function add_mapping($data){
			
			$this->db->insert('mapping_sd', $data);
			return true;
		}

		public function edit_mapping($data, $where){
			$this->db->where($where);
			$this->db->update('mapping_sd', $data);
			return true;
		}



		private function _get_all_sd_query()
	    {
	    	
	        $this->db->from($this->table_sd);
			
	        $i = 0;
	     
	        foreach ($this->column_search_sd as $item) // looping awal
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
	 
	                if(count($this->column_search_sd) - 1 == $i) 
	                    $this->db->group_end(); 
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) 
	        {
	            $this->db->order_by($this->column_order_sd[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_sd))
	        {
	            $order = $this->order_sd;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    function get_all_sd()
	    {
	        $this->_get_all_sd_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_sd()
	    {
	        $this->_get_all_sd_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_sd()
	    {
	        $this->db->from($this->table_sd);
	        return $this->db->count_all_results();
	    }


		private function _get_all_skpd_query()
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
	 
	    function get_all_skpd()
	    {
	        $this->_get_all_skpd_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_skpd()
	    {
	        $this->_get_all_skpd_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_skpd()
	    {
	        $this->db->from($this->table_skpd);
	        return $this->db->count_all_results();
	    }


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
	    	$this->db->select('t.kd_urusan,m.nm_urusan,sum(total) as pagu, sum(total_ubah) as pagu_ubah');
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
	         $this->db->group_by(array("t.kd_urusan", "m.nm_urusan")); 
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
	         // $this->db->group_by("t.kd_program"); 
	         $this->db->group_by(array("t.kd_urusan", "t.kd_program","t.kd_program1","t.nm_program")); 
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
	         // $this->db->group_by("t.kd_kegiatan"); 
	        $this->db->group_by(array("t.kd_kegiatan","t.kd_kegiatan1","t.nm_kegiatan")); 
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