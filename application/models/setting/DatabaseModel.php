<?php
	class DatabaseModel extends CI_Model{

		
		var $table_anggaran = 'trskpd'; //nama tabel dari database
		var $table_rincian = 'trdpo'; //nama tabel dari database
		var $table_rka = 'trdrka'; //nama tabel dari database
		var $table_skpd = 'ms_skpd'; //nama tabel dari database

		var $table_fungsi = 'ms_fungsi'; //nama tabel dari database
		var $table_urusan = 'ms_urusan'; //nama tabel dari database
		var $table_tapd = 'tapd'; //nama tabel dari database
		var $table_ttd = 'ms_ttd'; //nama tabel dari database
		
		var $table_program = 'ms_program'; //nama tabel dari database
		var $table_sumberdana = 'ms_dana'; //nama tabel dari database

		var $table_rek1 = 'ms_rek1'; //nama tabel dari database
		var $table_rek2 = 'ms_rek2'; //nama tabel dari database
		var $table_rek3 = 'ms_rek3'; //nama tabel dari database
		var $table_rek4 = 'ms_rek4'; //nama tabel dari database
		var $table_rek5 = 'ms_rek5'; //nama tabel dari database



	    var $column_order = array(null,'id_daerah'); //field yang ada di table 
	    var $column_search = array('id_daerah','nm_daerah','ket',); //field yang diizin untuk pencarian 
	    var $order = array('id_daerah' => 'asc'); // default order 

		public function check_data_anggaran($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
			$cdb->select("*,".$thn." as tahun_anggaran");
			$cdb->from($this->table_anggaran);
			$res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $anggaranArray = array('anggaranPackSession' => $res->result_array());
	        $this->session->set_userdata($anggaranArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel Anggaran Masih Kosong!</p>
                            </div>';
	        }else{
				$data['preview'] = '<div class="static-table-list">
										<table class="table">
											<thead>
												<tr>
													<td>No.</td>
													<td>Kode Gabungan</td>
													<td>Nama SKPD</td>
													<td>Nama Program</td>
													<td>Nama Kegiatan</td>
													<td>Pagu</td>
													<td>Pagu Ubah</td>
												<tr>
											</thead>
											<tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
					$data['preview'].='<tr>
										<td>'.$no.'</td>
										<td>'.$value["kd_gabungan"].'</td>
										<td>'.$value["nm_skpd"].'</td>
										<td>'.$value["nm_program"].'</td>
										<td>'.$value["nm_kegiatan"].'</td>
										<td>'.$value["total"].'</td>
										<td>'.$value["total_ubah"].'</td>
									</tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA ANGGARAN '.$thn;
	        return $data;

		}


		public function check_data_rka($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
			$cdb->select("*,".$thn." as tahun_anggaran");
			$cdb->from($this->table_rka);
			$res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $rkaArray = array('rkaPackSession' => $res->result_array());
	        $this->session->set_userdata($rkaArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel RKA Masih Kosong!</p>
                            </div>';
	        }else{
				$data['preview'] = '<div class="static-table-list">
										<table class="table">
											<thead>
												<tr>
													<td>No.</td>
													<td>Nama SKPD</td>
													<td>Nama Kegiatan</td>
													<td>Nama Rekening</td>
													<td>Sumber Dana</td>
													<td>Total</td>
													<td>Total Ubah</td>
												<tr>
											</thead>
											<tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
					$data['preview'].='<tr>
										<td>'.$no.'</td>
										<td>'.$value["nm_skpd"].'</td>
										<td>'.$value["nm_kegiatan"].'</td>
										<td>'.$value["nm_rek5"].'</td>
										<td>'.$value["sumber"].'</td>
										<td>'.$value["Nilai"].'</td>
										<td>'.$value["Nilai_ubah"].'</td>
									</tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA RKA (KEU) '.$thn;
	        return $data;
		}

		public function check_data_rincian($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
			$cdb->select("*,".$thn." as tahun_anggaran");
			$cdb->from($this->table_rincian);
			$res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $rincianArray = array('rincianPackSession' => $res->result_array());
	        $this->session->set_userdata($rincianArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel Rincian Masih Kosong!</p>
                            </div>';
	        }else{
				$data['preview'] = '<div class="static-table-list">
										<table class="table">
											<thead>
												<tr>
													<td>No.</td>
													<td>Kode Kegiatan</td>
													<td>Kode Rekening</td>
													<td>no_rinci</td>
													<td>Uraian</td>
													<td>Total</td>
													<td>Total Ubah</td>
												<tr>
											</thead>
											<tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
					$data['preview'].='<tr>
										<td>'.$no.'</td>
										<td>'.$value["kd_kegiatan"].'</td>
										<td>'.$value["kd_rek5"].'</td>
										<td>'.$value["no_po"].'</td>
										<td>'.$value["uraian"].'</td>
										<td>'.$value["total"].'</td>
										<td>'.$value["total_ubah"].'</td>
									</tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA RINCIAN ANGGARAN '.$thn;
	        return $data;

		}

		public function check_data_skpd($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
			$cdb->select("*,".$thn." as tahun_anggaran");
			$cdb->from($this->table_skpd);
			$res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $skpdArray = array('skpdPackSession' => $res->result_array());
	        $this->session->set_userdata($skpdArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel SKPD Masih Kosong!</p>
                            </div>';
	        }else{
				$data['preview'] = '<div class="static-table-list">
										<table class="table">
											<thead>
												<tr>
													<td>No.</td>
													<td>Kode SKPD</td>
													<td>Nama SKPD</td>
												<tr>
											</thead>
											<tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
					$data['preview'].='<tr>
										<td>'.$no.'</td>
										<td>'.$value["kd_skpd"].'</td>
										<td>'.$value["nm_skpd"].'</td>
									</tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA SKPD '.$thn;
	        return $data;

		}



	    public function check_data_fungsi($database = ''){
			
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
	        $cdb->from($this->table_fungsi);
	        $res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $fungsiArray = array('fungsiPackSession' => $res->result_array());
	        $this->session->set_userdata($fungsiArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel Fungsi Masih Kosong!</p>
                            </div>';
	        }else{
		        $data['preview'] = '<div class="static-table-list"><table class="table">
		        					<thead><tr><td>No.</td><td>Kode Fungsi</td><td>Nama Fungsi</td><tr></thead><tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
			        $data['preview'].='<tr><td>'.$no.'</td><td>'.$value["kd_fungsi"].'</td><td>'.$value["nm_fungsi"].'</td></tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA FUNGSI';
	        return $data;

		}


		public function check_data_urusan($database = ''){
			
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
	        $cdb->from($this->table_urusan);
	        $res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $skpdArray = array('urusanPackSession' => $res->result_array());
	        $this->session->set_userdata($skpdArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel Urusan Masih Kosong!</p>
                            </div>';
	        }else{
		        $data['preview'] = '<div class="static-table-list"><table class="table">
		        					<thead><tr><td>No.</td><td>Kode Urusan</td><td>Nama Urusan</td><tr></thead><tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
			        $data['preview'].='<tr><td>'.$no.'</td><td>'.$value["kd_urusan"].'</td><td>'.$value["nm_urusan"].'</td></tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA URUSAN';
	        return $data;

		}

		public function check_data_tapd($database = ''){
			
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
	        $cdb->from($this->table_tapd);
	        $res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $tapdArray = array('tapdPackSession' => $res->result_array());
	        $this->session->set_userdata($tapdArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel TAPD Masih Kosong!</p>
                            </div>';
	        }else{
				$data['preview'] = '<div class="static-table-list">
										<table class="table">
										<thead>
											<tr>
												<td>No.</td>
												<td>NIP</td>
												<td>Nama</td>
												<td>Jabatan</td>
											<tr>
										</thead>
										<tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
					$data['preview'].='<tr>
											<td>'.$no.'</td>
											<td>'.$value["nip"].'</td>
											<td>'.$value["nama"].'</td>
											<td>'.$value["jabatan"].'</td>
										</tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA TAPD';
	        return $data;

		}


		public function check_data_ttd($database = ''){
			
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
	        $cdb->from($this->table_ttd);
	        $res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $ttdArray = array('ttdPackSession' => $res->result_array());
	        $this->session->set_userdata($ttdArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel TTD Masih Kosong!</p>
                            </div>';
	        }else{
				$data['preview'] = '<div class="static-table-list">
										<table class="table">
										<thead>
											<tr>
												<td>No.</td>
												<td>NIP</td>
												<td>Nama</td>
												<td>Jabatan</td>
											<tr>
										</thead>
										<tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
					$data['preview'].='<tr>
											<td>'.$no.'</td>
											<td>'.$value["nip"].'</td>
											<td>'.$value["nama"].'</td>
											<td>'.$value["jabatan"].'</td>
										</tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA TTD';
	        return $data;
		}
		


		public function check_data_sumberdana($database = ''){
			
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
	        $cdb->from($this->table_sumberdana);
	        $res = $cdb->get();
	        $cdb->close();
	        $data['resArray'] = $res->result();
	        $skpdArray = array('sumberdanaPackSession' => $res->result_array());
	        $this->session->set_userdata($skpdArray);
	        if (count($data['resArray']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel Sumber Dana Masih Kosong!</p>
                            </div>';
	        }else{
		        $data['preview'] = '<div class="static-table-list"><table class="table">
		        					<thead><tr><td>No.</td><td>Kode</td><td>Nama Sumber Dana</td><tr></thead><tbody>';
		        $no=0;
		        foreach ($res->result_array() as $value) {
		        	$no++;
			        $data['preview'].='<tr><td>'.$no.'</td><td>'.$value["kd_sdana"].'</td><td>'.$value["nm_sdana"].'</td></tr>';
		        }
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA SUMBER DANA';
	        return $data;

		}

		public function check_data_rekening($database = ''){
			
			$thn = $this->session->userdata('thn_ang');
			$configDB = "keu".$thn;
			if($database == 'bpddata'){
				$cdb = $this->db;
			}else{
				$db2 = $this->load->database($configDB,TRUE);
				$cdb = $db2;
			}
			// rek1
			$cdb->from($this->table_rek1);
	        $res1 = $cdb->get();
	        $cdb->close();
	        $data['rek1Array'] = $res1->result();
	        $rek1Array = array('rek1PackSession' => $res1->result_array());
			$this->session->set_userdata($rek1Array);

			// rek2
			$cdb->from($this->table_rek2);
	        $res2 = $cdb->get();
	        $cdb->close();
	        $data['rek2Array'] = $res2->result();
	        $rek2Array = array('rek2PackSession' => $res2->result_array());
			$this->session->set_userdata($rek2Array);

			// rek3
			$cdb->from($this->table_rek3);
	        $res3 = $cdb->get();
	        $cdb->close();
	        $data['rek3Array'] = $res3->result();
	        $rek3Array = array('rek3PackSession' => $res3->result_array());
			$this->session->set_userdata($rek3Array);

			// rek4
			$cdb->from($this->table_rek4);
	        $res4 = $cdb->get();
	        $cdb->close();
	        $data['rek4Array'] = $res4->result();
	        $rek4Array = array('rek4PackSession' => $res4->result_array());
			$this->session->set_userdata($rek4Array);

			// rek5
			$cdb->from($this->table_rek5);
	        $res5 = $cdb->get();
	        $cdb->close();
	        $data['rek5Array'] = $res5->result();
	        $rek5Array = array('rek5PackSession' => $res5->result_array());
			$this->session->set_userdata($rek5Array);
			


	        if (count($data['rek1Array']) == 0 || count($data['rek2Array']) == 0 || count($data['rek3Array']) == 0 || count($data['rek4Array']) == 0 || count($data['rek5Array']) == 0) {
	        	$data['preview'] = '<div class="alert alert-warning alert-st-three" role="alert">
                                <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro" aria-hidden="true"></i>
                                <p class="message-mg-rt"><strong>Peringatan! </strong>Tabel Rekening Masih Kosong!</p>
                            </div>';
	        }else{
				$data['preview'] = '<div class="static-table-list">
										<table class="table">
											<thead>
											<tr>
												<td>No.</td>
												<td>Tabel</td>
												<td>Jumlah</td>
											<tr>
										</thead>
										<tbody>';
		        $no=0;
		        
		        	
					$data['preview'].='<tr>
											<td>1</td>
											<td>REKENING AKUN</td>
											<td>'.count($data['rek1Array']).'</td>
										</tr>';
					$data['preview'].='<tr>
										<td>2</td>
										<td>REKENING KELOMPOK</td>
										<td>'.count($data['rek2Array']).'</td>
									</tr>';
					$data['preview'].='<tr>
									<td>3</td>
									<td>REKENING JENIS</td>
									<td>'.count($data['rek3Array']).'</td>
								</tr>';
					$data['preview'].='<tr>
								<td>4</td>
								<td>REKENING OBJEK</td>
								<td>'.count($data['rek4Array']).'</td>
							</tr>';
					$data['preview'].='<tr>
											<td>5</td>
											<td>REKENING RINCIAN OBJEK</td>
											<td>'.count($data['rek5Array']).'</td>
										</tr>';
				
		        $data['preview'] .= '</tbody></table></div>';
	        }

	        $data['judul'] = 'DATA REKENING';
	        return $data;

		}

		public function get_last_update()
		{
			$sql = "SELECT 'anggaran' as uraian, max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'trskpd'
			UNION ALL 
			SELECT 'rka' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'trdrka'
			UNION ALL 
			SELECT 'rincian' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'trdpo'
			UNION ALL 
			SELECT 'skpd' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'ms_skpd'
			UNION ALL 
			SELECT 'fungsi' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'ms_fungsi'
			UNION ALL 
			SELECT 'urusan' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'ms_urusan'
			UNION ALL 
			SELECT 'tapd' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'tapd'
			UNION ALL 
			SELECT 'ttd' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'ms_ttd'
			UNION ALL 
			SELECT 'sumberdana' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'ms_dana'
			UNION ALL 
			SELECT 'rekening' as uraian,max(tgl_tr) as tgl FROM ms_database_history where table_tr = 'ms_rek5'
			;";
			$data = $this->db->query($sql)->result();
			
			return $data;
		}


		public function get_last_update_fungsi()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'ms_fungsi' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}


		

		public function get_last_update_urusan()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'ms_urusan' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}

		public function get_last_update_anggaran()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'trskpd' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}

		public function get_last_update_realisasi()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'trreal' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}


		public function get_last_update_skpd()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'ms_skpd' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}

		public function get_last_update_program()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'ms_program' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}
		public function get_last_update_kegiatan()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'ms_kegiatan' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}
		public function get_last_update_sumberdana()
		{
			$sql = "SELECT tgl_tr as tgl FROM ms_database_history where table_tr = 'ms_sumber' ORDER BY tgl_tr desc limit 1";
			$data = $this->db->query($sql)->row()->tgl;
			if ($data) {
				$tgl = $this->PublicModel->tgl_indo_short($data);
			}else{
				$tgl = '-';
			}
			return $tgl;
		}



		public function import_data_anggaran($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$data = $this->session->userdata('anggaranPackSession');
			$this->db->where('tahun_anggaran', $thn);
			$this->db->delete($this->table_anggaran);
			
			$dataBalikan = $this->db->insert_batch($this->table_anggaran, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_anggaran,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}

		public function import_data_rincian($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$data = $this->session->userdata('rincianPackSession');
			$this->db->where('tahun_anggaran', $thn);
			$this->db->delete($this->table_rincian);
			
			$dataBalikan = $this->db->insert_batch($this->table_rincian, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_rincian,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}


		public function import_data_rka($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$data = $this->session->userdata('rkaPackSession');
			$this->db->where('tahun_anggaran', $thn);
			$this->db->delete($this->table_rka);
			
			$dataBalikan = $this->db->insert_batch($this->table_rka, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_rka,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}

		public function import_data_skpd($database = ''){
			$thn = $this->session->userdata('thn_ang');
			$data = $this->session->userdata('skpdPackSession');
			$this->db->where('tahun_anggaran', $thn);
			$this->db->delete($this->table_skpd);
			
			$dataBalikan = $this->db->insert_batch($this->table_skpd, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_skpd,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}

		public function import_data_fungsi($database = ''){
			
			$data = $this->session->userdata('fungsiPackSession');
			$this->db->from($this->table_fungsi);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_fungsi, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_fungsi,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}


		

		public function import_data_urusan($database = ''){
			
			$data = $this->session->userdata('urusanPackSession');
			$this->db->from($this->table_urusan);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_urusan, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_urusan,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}

		public function import_data_tapd($database = ''){
			
			$data = $this->session->userdata('tapdPackSession');
			$this->db->from($this->table_tapd);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_tapd, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_tapd,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}

		public function import_data_ttd($database = ''){
			
			$data = $this->session->userdata('ttdPackSession');
			$this->db->from($this->table_ttd);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_ttd, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_ttd,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}

		public function import_data_rekening($database = ''){
			
			$data1 = $this->session->userdata('rek1PackSession');
			$this->db->from($this->table_rek1);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_rek1, $data1);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_rek1,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}

			$data2 = $this->session->userdata('rek2PackSession');
			$this->db->from($this->table_rek2);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_rek2, $data2);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_rek2,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}

			$data3 = $this->session->userdata('rek3PackSession');
			$this->db->from($this->table_rek3);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_rek3, $data3);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_rek3,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}

			$data4 = $this->session->userdata('rek4PackSession');
			$this->db->from($this->table_rek4);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_rek4, $data4);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_rek4,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}

			$data5 = $this->session->userdata('rek5PackSession');
			$this->db->from($this->table_rek5);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_rek5, $data5);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_rek5,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}

		

		

		public function import_data_sumberdana($database = ''){
			
			$data = $this->session->userdata('sumberdanaPackSession');
			$this->db->from($this->table_sumberdana);
			$this->db->truncate();
			$dataBalikan = $this->db->insert_batch($this->table_sumberdana, $data);
			if($dataBalikan >0){
				$data_history =  array('tgl_tr' => date('Y-m-d'),
										'id_admin_tr' => $this->session->userdata('admin_id'),
										'nm_admin_tr' => $this->session->userdata('nama'),
										'table_tr' => $this->table_sumberdana,
										'data' => $dataBalikan, );
				$this->db->insert('ms_database_history',$data_history);
			}
	        return $dataBalikan;
		}



		

	}

?>