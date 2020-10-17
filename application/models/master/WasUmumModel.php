<?php
	class WasUmumModel extends CI_Model{

		var $table = 'ms_was_umum a'; //nama tabel dari database
	    var $column_order = array(null,'id_parameter'); //field yang ada di table 
	    var $column_search = array('id_parameter','nm_parameter','tahun',); //field yang diizin untuk pencarian 
	    var $order = array('id_parameter' => 'asc'); // default order 

		public function add_parameter($data){
			$this->db->insert('ms_was_umum', $data);
			return true;
		}

		public function get_tree_parameter()
		{
			$html = '';
			$thn = $this->session->userdata('year_selected');
			$sql1 = 'SELECT * FROM ms_was_umum WHERE LENGTH(id_parameter) = 3 and tahun = '.$thn;
			$res1 = $this->db->query($sql1)->result_array();
			if (count($res1)>0) {
				// panel grup 1
				$html .= '<div class="panel-group" id="accordion1" role="tablist1" aria-multiselectable="true">';

				foreach ($res1 as $value1) {
					$html .= '<div class="panel panel-default panel-headline-custom">
						    <div class="panel-heading" role="tab1" id="heading'.$value1["id_parameter"].'">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse'.$value1["id_parameter"].'" aria-expanded="true" aria-controls="collapse'.$value1["id_parameter"].'">
						          '.$value1["nm_parameter"].'
						        </a>
						        <div class="pull-right">
						        	<a href="#" class = "label label-success showModal" data-aksi="tambah" data-level ="2">
						        		<i class="lnr lnr-plus-circle"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-info showModal" data-aksi="edit" data-level ="1">
						        		<i class="lnr lnr-pencil"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-danger">
						        		<i class="lnr lnr-trash"></i>
						        	</a>
						        </div>
						        
						      </h4>
						    </div>
						  ';	
					$sql2 = "SELECT * FROM ms_was_umum WHERE LENGTH(id_parameter) = 5 and hd_parameter = '".$value1['id_parameter']."' and tahun = ".$thn;
					$res2 = $this->db->query($sql2)->result_array();
					if (count($res2)>0) {
						$html .= '<div id="collapse'.$value1["id_parameter"].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$value1["id_parameter"].'">
				      				<div class="panel-body">';
				      	$html .= '<div class="panel-group" id="accordion2" role="tablist2" aria-multiselectable="true">';
				      	foreach ($res2 as $value2) {
				      		$html .= '<div class="panel panel-default panel-headline-custom">
						    <div class="panel-heading" role="tab2" id="heading'.$value2["id_parameter"].'">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$value2["id_parameter"].'" aria-expanded="true" aria-controls="collapse'.$value2["id_parameter"].'">
						          '.$value2["nm_parameter"].'
						        </a>
						        <div class="pull-right">
						        	<a href="#" class = "label label-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
						        		<i class="lnr lnr-plus-circle"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-info">
						        		<i class="lnr lnr-pencil"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-danger">
						        		<i class="lnr lnr-trash"></i>
						        	</a>
						        </div>
						      </h4>
						    </div>
						  ';
						  	$sql3 = "SELECT * FROM ms_was_umum WHERE LENGTH(id_parameter) = 7 and hd_parameter = '".$value2['id_parameter']."' and tahun = ".$thn;

							$res3 = $this->db->query($sql3)->result_array();
							if (count($res3)>0) {
								$html .= '<div id="collapse'.$value2["id_parameter"].'" class="panel-collapse collapse" role="tabpanel2" aria-labelledby="heading'.$value2["id_parameter"].'">
				      				<div class="panel-body">';
				      			$html .= '<div class="panel-group" id="accordion3" role="tablist3" aria-multiselectable="true">';
				      			foreach ($res3 as $value3) {
				      		$html .= '<div class="panel panel-default panel-headline-custom">
						    <div class="panel-heading" role="tab2" id="heading'.$value3["id_parameter"].'">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$value3["id_parameter"].'" aria-expanded="true" aria-controls="collapse'.$value3["id_parameter"].'">
						          '.$value3["nm_parameter"].'
						        </a>
						        <div class="pull-right">
						        	<a href="#" class = "label label-success" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
						        		<i class="lnr lnr-plus-circle"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-info">
						        		<i class="lnr lnr-pencil"></i>
						        	</a>&nbsp;
						        	<a href="#" class = "label label-danger">
						        		<i class="lnr lnr-trash"></i>
						        	</a>
						        </div>
						      </h4>
						    </div>
						  ';
				      			$html.='	</div>
				    			';
				      		}
				      			$html.='	</div>
				    			</div>';
				      		$html .= '</div>';

							}

						  // panel defailt 2
						  $html .= '</div>';
				      	}

				      	// panel grup2
				      	$html .='</div>';

				      	//panel body 1
				      	$html.='	</div>
				    			</div>';
					}
					// end panel hdefault 1
					$html .='</div>';

				}	
				// end panel grup 1
				$html .='</div>';

			}


			return $html;
			
		}


		public function get_parameter_mdb()
		{
			$html = '<div class="treeview-animated w-100 border mx-4 my-4">
					  ';
			$thn = $this->session->userdata('year_selected');
			$sql1 = 'SELECT * FROM ms_was_umum WHERE LENGTH(id_parameter) = 3 and tahun = '.$thn;
			$res1 = $this->db->query($sql1)->result_array();
			if (count($res1)>0) {
				$html .='<ul class="treeview-animated-list mb-3">';
				$html .= '<li>
							<div class="treeview-animated-element">
								<table border = "0" width = "100%">
									<tr style = "border-bottom:1px solid black;font-weight:bold;">
										<td width="90%" style="font-size:16px;font-weight:bold;">&nbsp;PARAMETER</td>
										<td width="10%" style="font-size:16px;font-weight:bold;text-align:right;">Aksi</td>
									</tr>
								</table> 
							</div>
						</li>';
				foreach ($res1 as $value1) {
					$id_par1 		= $value1['id_parameter'];
					$nm_par1 		= $value1['nm_parameter'];
					$thn1 	 		= $value1['tahun'];
					$hd_par1  		= $value1['hd_parameter'];
					$hd1  			= $value1['hd'];
					$ket1  			= $value1['ket'];
					$lvl1  			= $value1['clevel'];

					$sql2 = 'SELECT * FROM ms_was_umum WHERE LENGTH(id_parameter) = 5 and hd_parameter="'.$id_par1.'" and tahun = '.$thn;
					$res2 = $this->db->query($sql2)->result_array();
					// tentukan ada sub nya / tidak
					if (count($res2) == 0) {
						$html .= '<li>
									<div class="treeview-animated-element">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
											<tr>
												<td width="90%" style="font-size:16px;">
													<table width = "100%">
														<tr>
															<td width="10%" style="font-size:16px;">'.$id_par1.' .</td>
															<td width="90%" style="font-size:16px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="font-size:16px;">
													<span><i class="fa fa-trash ic-w mx-1 pull-right tombol-hapus" style="padding-top:2px;padding-right:5px;" data-id = "'.$value1["id_parameter"].'" data-nama = "'.$value1["nm_parameter"].'" data-tahun = "'.$value1["tahun"].'" data-aksi="hapus" data-toggle="tooltip" title="Hapus Parameter"></i></span>
													<span><i class="fa fa-pencil ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="edit" data-level ="'.$value1["clevel"].'" data-id = "'.$value1["id_parameter"].'" data-header ="'.$value1["hd_parameter"].'" data-hd ="'.$value1["hd"].'" data-ket ="'.$value1["ket"].'" data-nama ="'.$value1["nm_parameter"].'" data-toggle="tooltip" title="Edit Parameter"></i></span>
													<span><i class="fa fa-plus ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="tambah" data-level ="2" data-header ="'.$value1["id_parameter"].'" data-hd ="H" data-ket ="Sub Parameter" data-toggle="tooltip" title="Tambah Sub Parameter"></i></span>
												</td>
											</tr>
										</table> 
									</div>
								</li>';
					}else{
						$html .= '<li class="treeview-animated-items">';
						$html .= '<a class="closed">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
											<tr>
												<td width="90%" style="font-size:16px;">
													<table width = "100%">
														<tr>
															<td width="10%" style="font-size:16px;"><i class="fa fa-angle-right"></i> '.$id_par1.' .</td>
															<td width="90%" style="font-size:16px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="font-size:16px;">
													<span><i class="fa fa-trash ic-w mx-1 pull-right tombol-hapus" style="padding-top:2px;padding-right:5px;" data-id = "'.$value1["id_parameter"].'" data-nama = "'.$value1["nm_parameter"].'" data-tahun = "'.$value1["tahun"].'" data-aksi="hapus" data-toggle="tooltip" title="Hapus Parameter"></i></span>
													<span><i class="fa fa-pencil ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="edit" data-level ="'.$value1["clevel"].'" data-id = "'.$value1["id_parameter"].'" data-header ="'.$value1["hd_parameter"].'" data-hd ="'.$value1["hd"].'" data-ket ="'.$value1["ket"].'" data-nama ="'.$value1["nm_parameter"].'" data-toggle="tooltip" title="Edit Parameter"></i></span>
													<span><i class="fa fa-plus ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="tambah" data-level ="2" data-header ="'.$value1["id_parameter"].'" data-hd ="H" data-ket ="Sub Parameter" data-toggle="tooltip" title="Tambah Sub Parameter"></i></span>
												</td>
											</tr>
										</table> 

									</a>';
						$html .= '<ul class="nested">';
						foreach ($res2 as $value2) {
							$id_par2 		= $value2['id_parameter'];
							$nm_par2 		= $value2['nm_parameter'];
							$thn2 	 		= $value2['tahun'];
							$hd_par2  		= $value2['hd_parameter'];
							$hd2  			= $value2['hd'];
							$ket2  			= $value2['ket'];
							$lvl2  			= $value2['clevel'];
							$sql3 = 'SELECT * FROM ms_was_umum WHERE LENGTH(id_parameter) = 7 and hd_parameter="'.$value2["id_parameter"].'" and tahun = '.$thn;
							$res3 = $this->db->query($sql3)->result_array();
							if (count($res3) == 0) {
								$html .= '<li>
											<div class="treeview-animated-element"> 
											<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
													<tr>
														<td width="88.5%" style="font-size:14px;">
															<table width = "100%">
																<tr>
																	<td width="10%" style="font-size:14px;">'.$id_par2.' .</td>
																	<td width="90%" style="font-size:14px;">'.$nm_par2.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="font-size:14px;">
															<span><i class="fa fa-trash ic-w mx-1 pull-right tombol-hapus" style="padding-top:2px;padding-right:5px;" data-id = "'.$value2["id_parameter"].'" data-nama = "'.$value2["nm_parameter"].'" data-tahun = "'.$value2["tahun"].'" data-aksi="hapus" data-toggle="tooltip" title="Hapus Sub Parameter"></i></span>
															<span><i class="fa fa-pencil ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="edit" data-level ="'.$value2["clevel"].'" data-id = "'.$value2["id_parameter"].'" data-header ="'.$value2["hd_parameter"].'" data-hd ="'.$value2["hd"].'" data-ket ="'.$value2["ket"].'" data-nama ="'.$value2["nm_parameter"].'" data-toggle="tooltip" title="Edit Sub Parameter"></i></span>
															<span><i class="fa fa-plus ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="tambah" data-level ="3" data-header ="'.$value2["id_parameter"].'" data-hd ="D" data-ket ="Sub Parameter 2" data-toggle="tooltip" title="Tambah Sub Parameter 2"></i></span>
														</td>
													</tr>
												</table> 
											</div>
										</li>';			
							}else{
								$html .= '<li class="treeview-animated-items">';
								$html .= '<a class="closed">
											<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
												<tr>
													<td width="88.5%" style="font-size:14px;">
														<table width = "100%">
															<tr>
																<td width="10%" style="font-size:14px;">
																<i class="fa fa-angle-right"></i> '.$id_par2.' .</td>
																<td width="90%" style="font-size:14px;">'.$nm_par2.'</td>
															</tr>
														</table>
													</td>
													<td width="10%" style="font-size:14px;">
														<span><i class="fa fa-trash ic-w mx-1 pull-right tombol-hapus" style="padding-top:2px;padding-right:5px;" data-id = "'.$value2["id_parameter"].'" data-nama = "'.$value2["nm_parameter"].'" data-tahun = "'.$value2["tahun"].'" data-aksi="hapus" data-toggle="tooltip" title="Hapus Sub Parameter"></i></span>
														<span><i class="fa fa-pencil ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="edit" data-level ="'.$value2["clevel"].'" data-id = "'.$value2["id_parameter"].'" data-header ="'.$value2["hd_parameter"].'" data-hd ="'.$value2["hd"].'" data-ket ="'.$value2["ket"].'" data-nama ="'.$value2["nm_parameter"].'" data-toggle="tooltip" title="Edit Sub Parameter"></i></span>
														<span><i class="fa fa-plus ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="tambah" data-level ="3" data-header ="'.$value2["id_parameter"].'" data-hd ="D" data-ket ="Sub Parameter 2" data-toggle="tooltip" title="Tambah Sub Parameter 2"></i></span>	
													</td>
												</tr>
											</table> 
										</a>';
								$html .= '<ul class="nested">';
								foreach ($res3 as $value3) {
									$id_par3 		= $value3['id_parameter'];
									$nm_par3 		= $value3['nm_parameter'];
									$thn3 	 		= $value3['tahun'];
									$hd_par3  		= $value3['hd_parameter'];
									$hd3  			= $value3['hd'];
									$ket3  			= $value3['ket'];
									$lvl3  			= $value3['clevel'];
									$html .= '<li><div class="treeview-animated-element">
													<table border = "0" width = "100%" style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
														<tr>
															<td width="88%" style="font-size:12px;">
																<table width = "100%">
																	<tr>
																		<td width="10%" style="font-size:12px;">'.$id_par3.' .</td>
																		<td width="90%" style="font-size:12px;">'.$nm_par3.'</td>
																	</tr>
																</table>
															</td>
															<td width="10%" style="font-size:12px;">
																<span><i class="fa fa-trash ic-w mx-1 pull-right tombol-hapus" style="padding-top:2px;padding-right:5px;" data-id = "'.$value3["id_parameter"].'" data-nama = "'.$value3["nm_parameter"].'" data-tahun = "'.$value3["tahun"].'" data-aksi="hapus" data-toggle="tooltip" title="Hapus Sub Parameter 2"></i></span>
																<span><i class="fa fa-pencil ic-w mx-1 pull-right showModal" style="padding-top:2px;padding-right:5px;" data-aksi="edit" data-level ="'.$value3["clevel"].'" data-id = "'.$value3["id_parameter"].'" data-header ="'.$value3["hd_parameter"].'" data-hd ="'.$value3["hd"].'" data-ket ="'.$value3["ket"].'" data-nama ="'.$value3["nm_parameter"].'" data-toggle="tooltip" title="Edit Sub Parameter 2"></i></span>
															</td>
														</tr>
													</table> 		
											</div></li>';				
								}
								$html .= '</ul>';
								$html .= '</li>';
							}


						}
						$html .= '</ul>';
						$html .= '</li>';
					}
					//end tentukan ada sub nya /tidak

				}
				
				

				$html .='</ul>';
			}
			$html .= '</div>';
			// js
			$html .= '<script>$(document).ready(function() { $(".treeview-animated").mdbTreeview();$("[data-toggle=\'tooltip\']").tooltip(); });</script>';

			return $html;
			
		}

		private function _get_all_parameter_query()
	    {
	    	$this->db->where('hd','H');
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
	 
	    function get_all_parameter()
	    {
	        $this->_get_all_parameter_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_parameter()
	    {
	        $this->_get_all_parameter_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_parameter()
	    {
	    	$this->db->where('hd','H');
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

	    private function _get_all_sub_parameter_query()
	    {
	    	
	    	$this->db->where('hd','D');
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
	 
	    function get_all_sub_parameter()
	    {
	        $this->_get_all_sub_parameter_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_sub_parameter()
	    {
	        $this->_get_all_sub_parameter_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_sub_parameter()
	    {
	    	$this->db->where('hd','D');
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }
	   


		public function get_max_parameter($lvl,$header = '',$thn){
			
			if($lvl == 3){
				$hd = 'D';
			}else{
				$hd = 'H';
			}

			$this->db->select_max('id_parameter');
			$this->db->where('tahun', $thn);
			$this->db->where('hd', $hd);
			$this->db->where('clevel', $lvl);

			
			if ($lvl != 1) {
				$this->db->where('hd_parameter', $header);
			}else{
				$header = '';
			}

			$new = array('','100','00','00');
			$this->db->from('ms_was_umum');
			$query = $this->db->get();
			
			$result = $query->row()->id_parameter;
			if ($result == 0 || $result == '') {
				$result = $header.$new[$lvl];
			}
			$max = $result+1;
			

			return $max;
		}

		

		

		public function edit_parameter($data, $id, $thn){
			$this->db->where('id_parameter', $id);
			$this->db->where('tahun', $thn);
			$this->db->update('ms_was_umum', $data);
			return true;
		}

		public function get_combo_parameter($tahun)
		{
			
			$this->db->select('*');
			$this->db->from('ms_was_umum');
			$this->db->where('hd', 'H');
			$this->db->where('tahun', $tahun);
			$this->db->order_by('id_parameter', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Parameter--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_parameter'].'">'.$row['id_parameter'].' || '.$row['nm_parameter'].'</option>';
			}
			return $html;
		}

		public function getkab($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_was_umum');
			$this->db->where('hd_parameter', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kabupaten--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_parameter'].'">'.$row['id_parameter'].' || '.$row['nm_parameter'].'</option>';
			}
			return $html;
		}

		public function getkec($kode)
		{
			$this->db->select('*');
			$this->db->from('ms_was_umum');
			$this->db->where('hd_parameter', $kode);
			$query = $this->db->get();
			$result = $query->result_array();
			
			$html = '';
			$html .='<option value="">--Pilih Kecamatan--</option>';
			foreach($result as $row){
				$html .='<option value="'.$row['id_parameter'].'">'.$row['id_parameter'].' || '.$row['nm_parameter'].'</option>';
			}
			return $html;
		}

		

	}

?>