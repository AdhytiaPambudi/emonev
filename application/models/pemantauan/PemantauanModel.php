<?php
	class PemantauanModel extends CI_Model{

		var $table = 'trskpd t'; //nama tabel dari database

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

		public function viewPantauSKPD()
		{
			
			$ta = $this->session->userdata('thn_ang');
			$akses = $this->session->userdata('is_admin');
			

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
				$kd_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->kd_skpd.'</a>';
				$nm_skpd 	= '<a href="'.base_url("pemantauan-detail?skpd=".$value->kd_skpd).'">'.$value->nm_skpd.'</a>';
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

		public function viewPantauProgram($skpd)
		{
			$ta = $this->session->userdata('thn_ang');
			
			$query="call viewPantauProgram('".$ta."','".$skpd."');";
			$data = $this->db->query($query)->result();
			
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				$kd_program 	= '<a href="'.base_url("pemantauan-detail-kegiatan?skpd=".$skpd).'&prog='.$value->kd_program.'">'.$value->kd_program.'</a>';
				$nm_program 	= '<a href="'.base_url("pemantauan-detail-kegiatan?skpd=".$skpd).'&prog='.$value->kd_program.'">'.$value->nm_program.'</a>';
				$susun 		= number_format($value->susun,2,',','.');
				$ubah 		= number_format($value->ubah,2,',','.');
				$html.='<tr>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:15%;text-align:center;">'.$kd_program.'</td>
							<td style="width:40%;text-align:left;">'.$nm_program.'</td>
							<td style="width:20%;text-align:right;">'.$susun.'</td>
							<td style="width:20%;text-align:right;">'.$ubah.'</td>
						</tr>';
			}
			
			return $html;
		}

		public function viewPantauKegiatan($skpd,$prog)
		{
			$ta = $this->session->userdata('thn_ang');
			
			$query="call viewPantauKegiatan('".$ta."','".$skpd."','".$prog."');";
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			foreach ($data as $value) {
				$no++;
				$kd_kegiatan 	= '<a href="'.base_url("pemantauan-rekening-kegiatan?skpd=".$skpd).'&prog='.$prog.'&keg='.$value->kd_kegiatan.'">'.$value->kd_kegiatan.'</a>';
				$nm_kegiatan 	= '<a href="'.base_url("pemantauan-rekening-kegiatan?skpd=".$skpd).'&prog='.$prog.'&keg='.$value->kd_kegiatan.'">'.$value->nm_kegiatan.'</a>';
				$susun 		= number_format($value->susun,2,',','.');
				$ubah 		= number_format($value->ubah,2,',','.');
				$dok = $value->dok;
				if($dok == 0){
					$button = '';
				}else{
					$button = '<a href="#" class="dropdown-item btn btn-success btn-flat btn-xs showGambar" data-keg="'.$value->kd_kegiatan.'" data-tahun="'.$ta.'"><i class="fa fa-file-image-o"></i></a>';
				}
				$html.='<tr>
							<td style="width:5%;text-align:center;">'.$no.'</td>
							<td style="width:15%;text-align:center;">'.$kd_kegiatan.'</td>
							<td style="width:40%;text-align:left;">'.$nm_kegiatan.'</td>
							<td style="width:20%;text-align:right;">'.$susun.'</td>
							<td style="width:20%;text-align:right;">'.$ubah.'</td>';
							if($this->session->userdata('is_admin') == 1 || $this->session->userdata('is_admin') == 3){ 
							$html .='<td style="width:20%;text-align:center;">'.$button.'</td>';
							}
				$html.=			'
						</tr>';
			}
			
			return $html;
		}

		public function viewPantauRincianKegiatan($skpd,$prog,$keg)
		{
			$ta = $this->session->userdata('thn_ang');
			$sts_ubah = 'Perubahan';
			
			$query="SELECT a.*,b.fisik1,b.fisik2,b.fisik3,b.fisik4,b.keuangan1,b.keuangan2,b.keuangan3,b.keuangan4,
			CASE
			WHEN b.fisik4 >= b.fisik3 AND b.fisik4 >= b.fisik2 AND b.fisik4 >= b.fisik1 THEN b.fisik4
			WHEN b.fisik4 <= b.fisik3 AND b.fisik3 >= b.fisik2 AND b.fisik3 >= b.fisik1 THEN b.fisik3
			WHEN b.fisik4 <= b.fisik2 AND b.fisik3 <= b.fisik2 AND b.fisik2 >= b.fisik1 THEN b.fisik2
					WHEN b.fisik4 <= b.fisik1 AND b.fisik3 <= b.fisik1 AND b.fisik2 <= b.fisik1 THEN b.fisik1
			ELSE 0
		END AS tot_real_fisik,
				CASE
			WHEN b.keuangan4 >= b.keuangan3 AND b.keuangan4 >= b.keuangan2 AND b.keuangan4 >= b.keuangan1 THEN b.keuangan4
			WHEN b.keuangan4 <= b.keuangan3 AND b.keuangan3 >= b.keuangan2 AND b.keuangan3 >= b.keuangan1 THEN b.keuangan3
			WHEN b.keuangan4 <= b.keuangan2 AND b.keuangan3 <= b.keuangan2 AND b.keuangan2 >= b.keuangan1 THEN b.keuangan2
					WHEN b.keuangan4 <= b.keuangan1 AND b.keuangan3 <= b.keuangan1 AND b.keuangan2 <= b.keuangan1 THEN b.keuangan1
			ELSE 0
		END AS tot_real_keuangan,
		(SELECT sum(Nilai) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg,
		(SELECT sum(Nilai_Ubah) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg_ubah
			 FROM (SELECT tahun_anggaran,kd_kegiatan,kd_rek5 as kode,nm_rek5 as uraian, 0 as no,'' as tvolume,'' as tvolume_ubah, '' as satuan1, '' as satuan_ubah1, '' as harga1,'' as harga_ubah1,
			  Nilai as total, Nilai_ubah as total_ubah FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = ".$ta."
			 union all 
			 SELECT tahun_anggaran,kd_kegiatan,kd_rek5 as kode,uraian, no_po as no,
			 tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah FROM trdpo
			 where kd_kegiatan = '".$keg."' and tahun_anggaran = ".$ta.") a
			left JOIN
			(SELECT * from trdreal)b
			on a.tahun_anggaran = b.tahun_anggaran and a.kd_kegiatan = b.kd_kegiatan and a.kode = b.kd_rekening and a.no = b.no_rinci
			order by a.kode, a.no";
			 
			$data = $this->db->query($query)->result();
			$html = "";
			$no = 0;
			$persenFisik = 0;
			foreach ($data as $value) {
				if($value->no== 0){
					$uraian = '<b>'.$value->uraian.'</b>';
				}else{
					$uraian 	= '<a href="#" class="showModal" data-tahun="'.$ta.'" data-skpd="'.$skpd.'" data-keg="'.$keg.'" data-rek="'.$value->kode.'" data-po="'.$value->no.'">'.$value->uraian.'</a>';
				}
				if($sts_ubah == 'Murni'){
					$target_keuangan 		= number_format($value->total,2,',','.');
					$target_fisik 			= number_format($value->tvolume,0,',','.').' '.$value->satuan1;
					$real_fisik 			= number_format($value->tot_real_fisik,0,',','.') .' '.$value->satuan1;
					$real_keuangan 			= number_format($value->tot_real_keuangan,2,',','.');
					if($value->tvolume){
						$persenFisik = ($value->tot_real_fisik/$value->tvolume)*100;
					}
					$tot_persen_target 	= number_format(($value->total/$value->tot_target_keg)*100,'2',',','.');
					$tot_persen_keuangan 	= number_format(($value->tot_real_keuangan/$value->tot_target_keg)*100,'2',',','.');
				}else{
					$target_keuangan 		= number_format($value->total_ubah,2,',','.');
					$target_fisik 			= number_format($value->tvolume_ubah,0,',','.').' '.$value->satuan_ubah1;
					$real_fisik 			= number_format($value->tot_real_fisik,0,',','.') .' '.$value->satuan_ubah1;
					$real_keuangan 			= number_format($value->tot_real_keuangan,2,',','.');
					if($value->tvolume_ubah){
						$persenFisik = ($value->tot_real_fisik/$value->tvolume_ubah)*100;
					}
					$tot_persen_target 	= number_format(($value->total_ubah/$value->tot_target_keg_ubah)*100,'2',',','.');
					$tot_persen_keuangan 	= number_format(($value->tot_real_keuangan/$value->tot_target_keg_ubah)*100,'2',',','.');
				}
				$tot_persen_fisik 		= number_format($persenFisik,'2',',','.'); 
				
				$html.='<tr>
							<td style="width:44%;text-align:left;">'.$uraian.'</td>
							<td style="width:8%;text-align:center;">'.$target_fisik.'</td>
							<td style="width:8%;text-align:right;">'.$target_keuangan.'</td>
							<td style="width:8%;text-align:center;">'.$tot_persen_target.'</td>
							<td style="width:8%;text-align:center;">'.$real_fisik.'</td>
							<td style="width:8%;text-align:center;">'.$tot_persen_fisik.'</td>
							<td style="width:8%;text-align:right;">'.$real_keuangan.'</td>
							<td style="width:8%;text-align:right;">'.$tot_persen_keuangan.'</td>
						</tr>';
			}
			
			return $html;
		}


		public function search_kegiatan($ta,$filter,$key)
		{
			$akses = $this->session->userdata('is_admin');
			$skpd = $this->session->userdata('id_skpd');
			if($filter == 'kegiatan'){
				if($akses == 5){
					$where = " AND a.kd_skpd = '".$skpd."' ";
				}else{
					$where = "";
				}

				$query = "SELECT
				`a`.`tahun_anggaran` AS `ta`,
				`a`.`kd_skpd`        AS `kd_skpd`,
				`a`.`nm_skpd`        AS `nm_skpd`,
				`b`.`kd_program`        AS `kd_program`,
				`b`.`nm_program`        AS `nm_program`,
				`a`.`kd_kegiatan`    AS `kd_kegiatan`,
				`a`.`nm_kegiatan`    AS `nm_kegiatan`,
				SUM(`a`.`Nilai`)     AS `susun`,
				SUM(`a`.`Nilai_ubah`) AS `ubah`
			  FROM (`trdrka` `a`
				 JOIN `trskpd` `b`
				   ON (((`a`.`kd_kegiatan` = `b`.`kd_kegiatan`)
						AND (`a`.`tahun_anggaran` = `b`.`tahun_anggaran`))))
			  WHERE `a`.`tahun_anggaran` = ".$ta." and a.nm_kegiatan like '%".$key."%' ".$where."
			  GROUP BY `b`.`tahun_anggaran`,`a`.`kd_skpd`,`a`.`nm_skpd`,`b`.`kd_program`,`b`.`nm_program`,`a`.`kd_kegiatan`,`a`.`nm_kegiatan`;";

				$data = $this->db->query($query)->result();
				$html ="";
				if(count($data)<>0){
					foreach ($data as $value) {
						$html .= '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
							<div class="panel-body">
								<div class="text-left content-bg-pro">
									<h4>'.$value->nm_skpd.'</h4>
									<small>Nama Kegiatan &nbsp;&nbsp; : '.$value->nm_kegiatan.'</small><br>
									<small>Pagu Anggaran &nbsp; : Rp.'.number_format($value->susun,'2',',','.').'</small><br>
									<small>Pagu Perubahan : Rp. '.number_format($value->ubah,'2',',','.').'</small>
									<a href="'.base_url("pemantauan-rekening-kegiatan?skpd=".$value->kd_skpd).'&prog='.$value->kd_program.'&keg='.$value->kd_kegiatan.'" class="btn btn-success pull-right">Lihat Kegiatan</a>
								</div>
	
							</div>
						</div>
					</div></div><hr>';
					}
				}else{
					$html .= '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
							<div class="panel-body">
								<div class="text-center content-bg-pro">
									<h4>Pemberitahuan!</h4>
									<small>Hasil Pencarian Tidak Tersedia!</small>
								</div>
	
							</div>
						</div>
					</div></div>';
				}

			}else if($filter == 'uraian'){
				if($akses == 5){
					$where = " AND a.kd_skpd = '".$skpd."' ";
				}else{
					$where = "";
				}

				$query = "SELECT t1.*,t2.kd_skpd,t2.nm_skpd,t2.kd_program,t2.nm_kegiatan FROM
				(SELECT d.no_trdrka,d.tahun_anggaran,d.kd_kegiatan,d.uraian,d.total as susun,d.total_ubah as ubah,e.kontraktor from (SELECT no_trdrka,tahun_anggaran,kd_kegiatan,kd_rek5 as kode,uraian, no_po as no,
					  tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah FROM trdpo
					  where  tahun_anggaran = '".$ta."') d
					 left JOIN
					 (SELECT * from trdreal) e
					 on d.tahun_anggaran = e.tahun_anggaran and d.kd_kegiatan = e.kd_kegiatan and d.kode = e.kd_rekening and d.no = e.no_rinci
					 ) t1
		INNER JOIN
					(SELECT
						`a`.`no_trdrka` AS `no_trdrka`,
						`a`.`tahun_anggaran` AS `ta`,
						`a`.`kd_skpd`        AS `kd_skpd`,
						`a`.`nm_skpd`        AS `nm_skpd`,
						`b`.`kd_program`        AS `kd_program`,
						`b`.`nm_program`        AS `nm_program`,
						`a`.`kd_kegiatan`    AS `kd_kegiatan`,
						`a`.`nm_kegiatan`    AS `nm_kegiatan`,
						SUM(`a`.`Nilai`)     AS `susun`,
						SUM(`a`.`Nilai_ubah`) AS `ubah`
					  FROM (`trdrka` `a`
						 JOIN `trskpd` `b`
						   ON (((`a`.`kd_kegiatan` = `b`.`kd_kegiatan`)
								AND (`a`.`tahun_anggaran` = `b`.`tahun_anggaran`))))
		GROUP BY a.no_trdrka,`a`.`tahun_anggaran`,`a`.`kd_skpd`,`a`.`nm_skpd`,`b`.`kd_program`,`b`.`nm_program`,`a`.`kd_kegiatan`,`a`.`nm_kegiatan`) t2
		on t1.no_trdrka = t2.no_trdrka AND t1.tahun_anggaran = t2.ta AND t1.kd_kegiatan = t2.kd_kegiatan
		WHERE t1.tahun_anggaran = ".$ta." ".$where." and uraian LIKE '%".$key."%'";

				$data = $this->db->query($query)->result();
				$html ="";
				if(count($data)<>0){
					foreach ($data as $value) {
						$html .= '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
							<div class="panel-body">
								<div class="text-left content-bg-pro">
									<h4>'.$value->nm_skpd.'</h4>
									<small>Nama Kegiatan &nbsp;&nbsp; : '.$value->nm_kegiatan.'</small><br>
									<small>Uraian Kegiatan &nbsp;: '.$value->uraian.'</small><br>
									<small>Nama Kontraktor&nbsp;: '.$value->kontraktor.'</small><br>
									<small>Pagu Anggaran &nbsp; : Rp.'.number_format($value->susun,'2',',','.').'</small><br>
									<small>Pagu Perubahan : Rp. '.number_format($value->ubah,'2',',','.').'</small>
									<a href="'.base_url("pemantauan-rekening-kegiatan?skpd=".$value->kd_skpd).'&prog='.$value->kd_program.'&keg='.$value->kd_kegiatan.'" class="btn btn-success pull-right">Lihat Kegiatan</a>
								</div>
							</div>
						</div>
					</div></div><hr>';
					}
				}else{
					$html .= '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
							<div class="panel-body">
								<div class="text-center content-bg-pro">
									<h4>Pemberitahuan!</h4>
									<small>Hasil Pencarian Tidak Tersedia!</small>
								</div>
	
							</div>
						</div>
					</div></div>';
				}
			}else if($filter == 'perusahaan'){
				if($akses == 5){
					$where = " AND a.kd_skpd = '".$skpd."' ";
				}else{
					$where = "";
				}

				$query = "SELECT t1.*,t2.kd_skpd,t2.nm_skpd,t2.kd_program,t2.nm_kegiatan FROM
				(SELECT d.no_trdrka,d.tahun_anggaran,d.kd_kegiatan,d.uraian,d.total as susun,d.total_ubah as ubah,e.kontraktor from (SELECT no_trdrka,tahun_anggaran,kd_kegiatan,kd_rek5 as kode,uraian, no_po as no,
					  tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah FROM trdpo
					  where  tahun_anggaran = '".$ta."') d
					 left JOIN
					 (SELECT * from trdreal) e
					 on d.tahun_anggaran = e.tahun_anggaran and d.kd_kegiatan = e.kd_kegiatan and d.kode = e.kd_rekening and d.no = e.no_rinci
					 ) t1
		INNER JOIN
					(SELECT
						`a`.`no_trdrka` AS `no_trdrka`,
						`a`.`tahun_anggaran` AS `ta`,
						`a`.`kd_skpd`        AS `kd_skpd`,
						`a`.`nm_skpd`        AS `nm_skpd`,
						`b`.`kd_program`        AS `kd_program`,
						`b`.`nm_program`        AS `nm_program`,
						`a`.`kd_kegiatan`    AS `kd_kegiatan`,
						`a`.`nm_kegiatan`    AS `nm_kegiatan`,
						SUM(`a`.`Nilai`)     AS `susun`,
						SUM(`a`.`Nilai_ubah`) AS `ubah`
					  FROM (`trdrka` `a`
						 JOIN `trskpd` `b`
						   ON (((`a`.`kd_kegiatan` = `b`.`kd_kegiatan`)
								AND (`a`.`tahun_anggaran` = `b`.`tahun_anggaran`))))
		GROUP BY a.no_trdrka,`a`.`tahun_anggaran`,`a`.`kd_skpd`,`a`.`nm_skpd`,`b`.`kd_program`,`b`.`nm_program`,`a`.`kd_kegiatan`,`a`.`nm_kegiatan`) t2
		on t1.no_trdrka = t2.no_trdrka AND t1.tahun_anggaran = t2.ta AND t1.kd_kegiatan = t2.kd_kegiatan
		WHERE t1.tahun_anggaran = ".$ta." ".$where." and kontraktor LIKE '%".$key."%'";

				$data = $this->db->query($query)->result();
				$html ="";
				if(count($data)<>0){
					foreach ($data as $value) {
						$html .= '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
							<div class="panel-body">
								<div class="text-left content-bg-pro">
									<h4>'.$value->nm_skpd.'</h4>
									<small>Nama Kegiatan &nbsp;&nbsp; : '.$value->nm_kegiatan.'</small><br>
									<small>Uraian Kegiatan &nbsp;: '.$value->uraian.'</small><br>
									<small>Nama Kontraktor&nbsp;: '.$value->kontraktor.'</small><br>
									<small>Pagu Anggaran &nbsp; : Rp.'.number_format($value->susun,'2',',','.').'</small><br>
									<small>Pagu Perubahan : Rp. '.number_format($value->ubah,'2',',','.').'</small>
									<a href="'.base_url("pemantauan-rekening-kegiatan?skpd=".$value->kd_skpd).'&prog='.$value->kd_program.'&keg='.$value->kd_kegiatan.'" class="btn btn-success pull-right">Lihat Kegiatan</a>
								</div>
							</div>
						</div>
					</div></div><hr>';
					}
				}else{
					$html .= '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
							<div class="panel-body">
								<div class="text-center content-bg-pro">
									<h4>Pemberitahuan!</h4>
									<small>Hasil Pencarian Tidak Tersedia!</small>
								</div>
	
							</div>
						</div>
					</div></div>';
				}
			}

		
			return $html;
		}

		public function modalPantauRincianKegiatan($ta,$keg,$rek,$po)
		{
			// $ta = $this->session->userdata('thn_ang');
			
			$query="SELECT a.*,b.bentuk,b.nilai_kontrak,b.kontraktor,b.no_kontrak,b.distrik,b.kampung,b.koordinat,b.keterangan,b.file_rab,b.file_kontrak,
			b.fisik1,b.fisik2,b.fisik3,b.fisik4,b.keuangan1,b.keuangan2,b.keuangan3,b.keuangan4,
			CASE
			WHEN b.fisik4 >= b.fisik3 AND b.fisik4 >= b.fisik2 AND b.fisik4 >= b.fisik1 THEN b.fisik4
			WHEN b.fisik4 <= b.fisik3 AND b.fisik3 >= b.fisik2 AND b.fisik3 >= b.fisik1 THEN b.fisik3
			WHEN b.fisik4 <= b.fisik2 AND b.fisik3 <= b.fisik2 AND b.fisik2 >= b.fisik1 THEN b.fisik2
					WHEN b.fisik4 <= b.fisik1 AND b.fisik3 <= b.fisik1 AND b.fisik2 <= b.fisik1 THEN b.fisik1
			ELSE 0
		END AS tot_real_fisik,
				CASE
			WHEN b.keuangan4 >= b.keuangan3 AND b.keuangan4 >= b.keuangan2 AND b.keuangan4 >= b.keuangan1 THEN b.keuangan4
			WHEN b.keuangan4 <= b.keuangan3 AND b.keuangan3 >= b.keuangan2 AND b.keuangan3 >= b.keuangan1 THEN b.keuangan3
			WHEN b.keuangan4 <= b.keuangan2 AND b.keuangan3 <= b.keuangan2 AND b.keuangan2 >= b.keuangan1 THEN b.keuangan2
					WHEN b.keuangan4 <= b.keuangan1 AND b.keuangan3 <= b.keuangan1 AND b.keuangan2 <= b.keuangan1 THEN b.keuangan1
			ELSE 0
		END AS tot_real_keuangan,
		(SELECT sum(Nilai) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg,
		(SELECT sum(Nilai_Ubah) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg_ubah
			 FROM (
			 SELECT tahun_anggaran,kd_kegiatan,kd_rek5 as kode,uraian, no_po as no,
			 tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah FROM trdpo
			 where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."' and kd_rek5 = '".$rek."' and no_po = '".$po."') a
			left JOIN
			(SELECT * from trdreal)b
			on a.tahun_anggaran = b.tahun_anggaran and a.kd_kegiatan = b.kd_kegiatan and a.kode = b.kd_rekening and a.no = b.no_rinci
			 order by a.kode, a.no";

			 
			 
			$data = $this->db->query($query)->result_array();			
			return $data;
		}

		public function get_max_lamp($ta,$keg,$rek,$po){

			$this->db->select_max('kd_lamp');
			$this->db->where('tahun_anggaran', $ta);
			$this->db->where('kd_kegiatan', $keg);
			$this->db->where('kd_rek', $rek);
			$this->db->where('no_po', $po);
			$this->db->from('trdreal_lamp');
			$query = $this->db->get();

			
			$result = $query->row()->kd_lamp;
			if (!$result) {
				$result = 1;
			}else{
				$max_temuan = $result+1;
				$result = $max_temuan;
			}
			
			return $result;
		}

		public function get_max_kontrak($ta,$keg,$rek,$po){

			$this->db->select_max('kd_kontrak');
			$this->db->where('tahun_anggaran', $ta);
			$this->db->where('kd_kegiatan', $keg);
			$this->db->where('kd_rek', $rek);
			$this->db->where('no_po', $po);
			$this->db->from('trdreal_kontrak');
			$query = $this->db->get();

			
			$result = $query->row()->kd_kontrak;
			if (!$result) {
				$result = 1;
			}else{
				$max_temuan = $result+1;
				$result = $max_temuan;
			}
			
			return $result;
		}

		public function insertLampiranDokumentasi($data){
			$this->db->insert('trdreal_lamp', $data);
			return true;
		}
		public function insertLampiranKontrak($data){
			$this->db->insert('trdreal_kontrak', $data);
			
			return true;
		}

		function dpa22_pdf($skpd){
			$thn_anggaran = $this->session->userdata('thn_ang');
			$spacing = $_GET['spacing'];
			$tanggal = '';
			$kab     = '';
			$daerah  = '';
			$thn     = '';
			$ibukota     = '';


			$id = $skpd;
			$sqldns="SELECT a.kd_urusan as kd_u,b.nm_urusan as nm_u,a.kd_skpd as kd_sk,a.nm_skpd as nm_sk FROM ms_skpd a INNER JOIN ms_urusan b ON a.kd_urusan=b.kd_urusan WHERE kd_skpd='$id'";
					 $sqlskpd=$this->db->query($sqldns);
					 foreach ($sqlskpd->result() as $rowdns)
					{
						$kd_urusan=$rowdns->kd_u;                    
						$nm_urusan= $rowdns->nm_u;
						$kd_skpd  = $rowdns->kd_sk;
						$nm_skpd  = $rowdns->nm_sk;
					}
			$sqlsc="SELECT * FROM ms_data_umum where tahun_anggaran =".$thn_anggaran;
					 $sqlsclient=$this->db->query($sqlsc);
					 foreach ($sqlsclient->result() as $rowsc)
					{  
						$tgl=$rowsc->tgl_dpa;
						$tanggal = $this->PublicModel->tgl_indo($tgl);
						$kab     = strtoupper($rowsc->nama_daerah);
						$daerah  = $rowsc->nama_daerah;
						$thn     = $rowsc->tahun_anggaran;
						$ibukota     = $rowsc->ibukota;
						$logo     = $rowsc->logo_daerah;
						$logoPath = base_url().$logo;
						
					}
			$sqlttd1="SELECT nama as nm,nip as nip,jabatan as jab FROM ms_ttd where kode='PPK'";
					 $sqlttd=$this->db->query($sqlttd1);
					 foreach ($sqlttd->result() as $rowttd)
					{
						$nip=$rowttd->nip;                    
						$nama= $rowttd->nm;
						$jabatan  = $rowttd->jab;
					}
					
			
			$cRet='';
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						<tr> <td width=\"15%\" rowspan=\"2\" align=\"center\"><img src=\"".$logoPath."\" style=\"width:100px;\"></td>
							 <td colspan=\"9\" width=\"70%\" align=\"center\"><strong>DOKUMEN PELAKSANAAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</strong></td>
							 <td width=\"15%\" rowspan=\"2\" align=\"center\"><strong>FORMULIR DPA - SKPD 2.2  </strong></td>
						</tr>
						<tr>
							 <td colspan=\"9\" width=\"70%\" align=\"center\">$kab<br>Tahun Anggaran $thn</td>
						</tr>
					  </table>";
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"1\">                
			<tr>
						<td width=\"100%\" align=\"left\" colspan=\"11\">
							<table border=\"0\">
								<tr>
									<td width=\"23%\" align=\"left\">&nbsp;
									Urusan Pemerintahan<br>&nbsp;
									Organisasi
									</td>
									<td colspan=\"10\" width=\"77%\" align=\"left\">
									: $kd_urusan - $nm_urusan<br>
									: $kd_skpd   - $nm_skpd
									</td>
								</tr>
							</table>
						</td>
			 </tr>
			  <tr>
							<td colspan=\"11\" align=\"center\" style=\"border:1px solid black;\"><strong>Rekapitulasi Anggaran Belanja Langsung Berdasarkan Program dan Kegiatan </strong></td>
						</tr></table>";
			$cRet .= "<table style=\"border-collapse:collapse;font-size:8pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr><td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>Program</b></td>                            
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"12%\" align=\"center\"><b>kegiatan</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"18%\" align=\"center\"><b>Uraian</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"6%\" align=\"center\"><b>Lokasi Kegiatan</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"6%\" align=\"center\"><b>Target Kinerja</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"6%\" align=\"center\"><b>Sumber Dana</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"32%\" align=\"center\"><b>Triwilan</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"9%\" align=\"center\"><b>Jumlah (Rp)</b></td>
							</tr>
							<tr>
								<td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>I</b></td>
								<td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>II</b></td>
								<td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>III</b></td>
								<td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>IV</b></td>
							</tr>    
						 </thead>
						
	
						
						 
							<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\" align=\"center\">&nbsp;</td>                            
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"12%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"18%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"6%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"6%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"6%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"8%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"8%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"8%\">&nbsp;</td>                            
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"8%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"9%\">&nbsp;</td>
							</tr>
							";
	
						$sql1="SELECT *,CASE 
								 WHEN LEFT(prog,4)=SUBSTRING(prog,6,4) AND RIGHT(prog,2) < 14 THEN 'A'
								 WHEN LEFT(prog,4)!=SUBSTRING(prog,6,4) THEN 'B'
								 ELSE 'C'
								 END AS urut FROM (
								SELECT a.kd_program AS prog,a.kd_program AS prog1,' ' AS giat,a.nm_program AS uraian, ' ' AS lokasi,' ' AS target,' ' AS sumber,
								'' AS triw1,
								'' AS triw2,
								'' AS triw3,
								'' AS triw4,
								'' AS jumlah 
								FROM trskpd a LEFT JOIN trdrka c ON c.kd_kegiatan=a.kd_kegiatan
								WHERE RIGHT(a.kd_program,2)<>'00' AND a.kd_skpd = '$id' GROUP BY a.kd_program,a.nm_program
								UNION 
								SELECT a.kd_program AS prog,' ' AS prog1,a.kd_kegiatan AS giat,a.nm_kegiatan AS uraian, a.lokasi AS lokasi,a.tk_kel AS target,GROUP_CONCAT(DISTINCT c.sumber) AS sumber,
								(SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan) AS triw1,
								(SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan)  AS triw2,
								(SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan) AS triw3,
								(SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan) AS triw4,
								(SELECT SUM(nilai) AS nilai FROM trdrka WHERE kd_kegiatan = a.kd_kegiatan ) AS jumlah 
								FROM trskpd a LEFT JOIN trdrka c ON c.kd_kegiatan=a.kd_kegiatan 
								WHERE RIGHT(a.kd_program,2)<>'00' AND a.kd_skpd = '$id' 
								GROUP BY a.kd_program,a.kd_kegiatan,a.nm_kegiatan,a.lokasi,a.tk_kel,giat
								) a ORDER BY urut, a.prog,a.giat";

						// print_r($sql1);die();
								
						
					 
					$query = $this->db->query($sql1);
					foreach ($query->result() as $row)
					{
						$prog=$row->prog1;
						$giat=$row->giat;
						$uraian=$row->uraian;
						$lokasi=$row->lokasi;
						$target=$row->target;
						$sumber=$row->sumber;
						$triw1=empty($row->triw1) || $row->triw1 == 0 ? '' :number_format($row->triw1,2,',','.');
						$triw2=empty($row->triw2) || $row->triw2 == 0 ? '' :number_format($row->triw2,2,',','.');
						$triw3=empty($row->triw3) || $row->triw3 == 0 ? '' :number_format($row->triw3,2,',','.');
						$triw4=empty($row->triw4) || $row->triw4 == 0 ? '' :number_format($row->triw4,2,',','.');
						
						//$nilai= number_format($row->jumlah,"2",",",".");
						$nilai= number_format($row->triw1+$row->triw2+$row->triw3+$row->triw4,"2",",",".");
						$nilaitot=$nilai;
					   
						 if (strlen($prog)>=18){
						 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\"><b>$prog</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$giat</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$lokasi</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$target</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$sumber</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw1</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw2</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw3</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw4</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$nilai</td>
										 </tr>
										 ";
									 }else{
	
							 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\">$prog</td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$giat</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$uraian</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$lokasi</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$target</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$sumber</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw1</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw2</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw3</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$triw4</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$nilai</td>
										 </tr>
										 ";
	
									}
					}
					
					if ($spacing >= 0) {
						for ($i=0; $i < $spacing ; $i++) { 
							
							$cRet .= "<tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\">&nbsp;</td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">&nbsp;</td>
										 </tr>";
						}
					}

					$q ="SELECT SUM(nilai) as juminten FROM trdrka WHERE kd_kegiatan IN (SELECT kd_kegiatan FROM trskpd WHERE jns_kegiatan='52' AND kd_skpd='$id') ";
					$s = $this->db->query($q);
					
					foreach ($s->result() as $r)
					{
						$j=$r->juminten;
					}
					$jo = number_format($j,2,',','.');
					$query2="SELECT SUM(nilai)/4 AS triw1,SUM(nilai)/4 AS triw2,SUM(nilai)/4 AS triw3,SUM(nilai)/4 AS triw4 FROM trdrka WHERE left(kd_rek5,2)='52' AND kd_skpd='$id'";
					$sqltw=$this->db->query($query2);
					

					foreach ($sqltw->result_array() as $t)
					{
							
							$tot_keg = $t['triw1']+$t['triw2']+$t['triw3']+$t['triw4'];
							$tot_keg = number_format($tot_keg,2,',','.');
							
							$tottw1  = empty($t['triw1']) || $t['triw1'] == 0 ? '' : number_format($t['triw1'],2,',','.');
							$tottw2  = empty($t['triw2']) || $t['triw2'] == 0 ? '' : number_format($t['triw2'],2,',','.');
							$tottw3  = empty($t['triw3']) || $t['triw3'] == 0 ? '' : number_format($t['triw3'],2,',','.');
							$tottw4  = empty($t['triw4']) || $t['triw4'] == 0 ? '' : number_format($t['triw4'],2,',','.');
							
					
					$cRet    .="<tr>
										 <td colspan=\"6\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>JUMLAH</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$tottw1</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$tottw2</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$tottw3</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$tottw4</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$jo</b></td>
								  </tr>" ;    
					}
					

					$cRet .="  <tfoot>
					<tr>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"10%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"12%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"18%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"6%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"6%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"6%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"8%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"8%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"8%\">&nbsp;</td>
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"8%\">&nbsp;</td>                           
						   <td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"9%\">&nbsp;</td>  
						</tr>
					</tfoot>";




					$cRet .="<tr>
									
									<td colspan=\"8\" width=\"70%\" align=\"left\" style=\"border-right:none;\">&nbsp;<br>&nbsp;
									<br>&nbsp;
									&nbsp;<br>
									&nbsp;<br>
									&nbsp;<br>
									&nbsp;	
									</td>
									<td width=\"30%\" colspan=\"3\" align=\"center\" style=\"border-left:none;\">$ibukota ,$tanggal
									<br><b>$jabatan</b>
									  <p>&nbsp;</p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<br><b>$nama</b>
									<br>NIP. $nip 
									</td>
								 </tr>";
			$cRet    .= "</table>";
			// print_r($cRet);die();
			return $cRet;
		}

		function dpa221_pdf($skpd,$giat){
			$thn_anggaran = $this->session->userdata('thn_ang');
			$sqldns="SELECT a.kd_urusan as kd_u,b.nm_urusan as nm_u,a.kd_skpd as kd_sk,a.nm_skpd as nm_sk FROM ms_skpd a INNER JOIN ms_urusan b ON a.kd_urusan=b.kd_urusan WHERE kd_skpd='$skpd'";
					 $sqlskpd=$this->db->query($sqldns);
					 foreach ($sqlskpd->result() as $rowdns)
					{
						$kd_urusan=$rowdns->kd_u;                    
						$nm_urusan= $rowdns->nm_u;
						$kd_skpd  = $rowdns->kd_sk;
						$nm_skpd  = $rowdns->nm_sk;
						$org=substr($kd_skpd,5,2);
					}
			$sqlsc="SELECT * FROM ms_data_umum where tahun_anggaran =".$thn_anggaran;
			$sqlsclient=$this->db->query($sqlsc);
					foreach ($sqlsclient->result() as $rowsc)
				   {  
					   $tgl=$rowsc->tgl_dpa;
					   $tanggal = $this->PublicModel->tgl_indo($tgl);
					   $kab     = strtoupper($rowsc->nama_daerah);
					   $daerah  = $rowsc->nama_daerah;
					   $thn     = $rowsc->tahun_anggaran;
					   $ibukota     = $rowsc->ibukota;
					   $logo     = $rowsc->logo_daerah;
					   $logoPath = base_url().$logo;
				   }
			$sqlttd1="SELECT nama as nm,nip as nip,jabatan as jab FROM ms_ttd where kode='PPK'";
					 $sqlttd=$this->db->query($sqlttd1);
					 foreach ($sqlttd->result() as $rowttd)
					{
						$nip=$rowttd->nip;                    
						$nama= $rowttd->nm;
						$jabatan  = $rowttd->jab;
					}
			$sqlorg="SELECT f.kd_urusan,f.nm_urusan,a.kd_skpd,e.nm_skpd,a.kd_program,a.nm_program,a.kd_kegiatan,a.nm_kegiatan,SUM(d.nilai) AS nilai,a.tu_capai,a.tu_mas,a.tu_kel,a.tu_has,
					a.tk_capai,a.tk_mas,a.tk_kel,a.tk_has,a.lokasi,GROUP_CONCAT(DISTINCT d.sumber) AS sumber,a.sasaran_giat,a.waktu_giat,right(a.kd_program,2) as programx,substr(a.kd_kegiatan,20,2) as kegiatanx 
					FROM trskpd a
					INNER JOIN trdrka d ON a.kd_kegiatan=d.kd_kegiatan
					INNER JOIN ms_skpd e ON a.kd_skpd=e.kd_skpd
					INNER JOIN ms_urusan f ON a.kd_urusan=f.kd_urusan WHERE a.kd_kegiatan='$giat'
					GROUP BY f.kd_urusan,f.nm_urusan,a.kd_skpd,a.kd_program,
					a.nm_program,a.kd_kegiatan,a.nm_kegiatan,
					a.tu_capai,a.tu_mas,a.tu_kel,a.tu_has, a.tk_capai,a.tk_mas,a.tk_kel,a.tk_has,a.lokasi,
					a.sasaran_giat,a.waktu_giat
					";

					
					 $sqlorg1=$this->db->query($sqlorg);
					 foreach ($sqlorg1->result() as $roworg)
					{
						$kd_urusan=$roworg->kd_urusan;                    
						$nm_urusan= $roworg->nm_urusan;
						$kd_skpd  = $roworg->kd_skpd;
						$nm_skpd  = $roworg->nm_skpd;
						$kd_prog  = $roworg->kd_program;
						$nm_prog  = $roworg->nm_program;
						$kd_giat  = $roworg->kd_kegiatan;
						$nm_giat  = $roworg->nm_kegiatan;
						$lokasi  = $roworg->lokasi;
						$sumber = $roworg->sumber;
						$tu_capai  = $roworg->tu_capai;
						$tu_mas  = $roworg->tu_mas;
						$tu_kel  = $roworg->tu_kel;
						$tu_has  = $roworg->tu_has;
						$tk_capai  = $roworg->tk_capai;
						$tk_mas  = $roworg->tk_mas;
						$tk_kel  = $roworg->tk_kel;
						$tk_has  = $roworg->tk_has;
						$sas_giat = $roworg->sasaran_giat;
						$wkt_giat = $roworg->waktu_giat;
						$progx = $roworg->programx;
						$kegx = $roworg->kegiatanx;
					}
			$sqltp="SELECT SUM(nilai) AS totb FROM trdrka WHERE kd_kegiatan='$giat' AND kd_skpd='$skpd'";
						$sqlb=$this->db->query($sqltp);
					 foreach ($sqlb->result() as $rowb)
					{
					   $totp=number_format($rowb->totb,"2",".",",");
					   $terbilang=$this->PublicModel->terbilang(ceil($rowb->totb));
					   $terbilang2= strtoupper($terbilang);
					}         
	
			$sqlttd2="SELECT nama as nm,nip as nip,jabatan as jab FROM ms_ttd where kode='PPK'";
					 $sqlttd3=$this->db->query($sqlttd2);
					 foreach ($sqlttd3->result() as $rowttd2)
					{
						$nip2=$rowttd2->nip;                    
						$nama2= $rowttd2->nm;
						$jabatan2  = $rowttd2->jab;
					}				
						
			$cRet='';
			
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">                  
						<tr> <td width=\"15%\" rowspan=\"3\" align=\"center\"><img src=\"".$logoPath."\" alt='logo' width='90' height='80' /></td>
							 <td width=\"50%\" rowspan=\"2\" align=\"center\"><strong>DOKUMEN PELAKSANAAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH </strong></td>
							 <td width=\"20%\" colspan=\"6\" align=\"center\"><strong>NOMOR DPA SKPD  </strong></td>
							 <td width=\"15%\" rowspan=\"3\" align=\"center\"><strong>&nbsp;<br>FORMULIR DPA - SKPD 2.2.1  </strong></td>
						</tr>
						<tr>
							 <td width=\"5%\" align=\"center\">$kd_urusan</td>
							 <td width=\"5%\" align=\"center\">$kd_skpd</td>
							 <td width=\"5%\" align=\"center\">$progx</td>
							 <td width=\"5%\" align=\"center\">$kegx</td>
							 <td width=\"5%\" align=\"center\">5</td>
							 <td width=\"5%\" align=\"center\">2</td>
						</tr>
						<tr>
							 <td width=\"85%\" colspan=\"7\" align=\"center\">$kab<br>Tahun Anggaran $thn</td>
						</tr>
	
					  </table>";
					  
				$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"1\">	  
							
								<tr>
									<td width=\"30%\" style=\"border-right:none;\" align=\"left\">Urusan Pemerintahan</td>
									<td width=\"70%\" style=\"border-left:none;\" colspan=\"8\" align=\"left\">: $kd_urusan - $nm_urusan<br></td>
								</tr>
								<tr>
									<td width=\"30%\" style=\"border-right:none;\" align=\"left\">Organisasi</td>
									<td width=\"70%\" style=\"border-left:none;\" colspan=\"8\" align=\"left\">: $kd_skpd   - $nm_skpd<br></td>
								</tr>
								<tr>
									<td width=\"30%\" style=\"border-right:none;\" align=\"left\">Program</td>
									<td width=\"70%\" style=\"border-left:none;\" colspan=\"8\" align=\"left\">: $kd_prog   - $nm_prog<br></td>
								</tr>
								<tr>
									<td width=\"30%\" style=\"border-right:none;\" align=\"left\">Kegiatan</td>
									<td width=\"70%\" style=\"border-left:none;\" colspan=\"8\" align=\"left\">: $kd_giat   - $nm_giat<br></td>
								</tr>
								<tr>
									<td width=\"30%\" style=\"border-right:none;\" align=\"left\">Waktu Pelaksanaan</td>
									<td width=\"70%\" style=\"border-left:none;\" colspan=\"8\" align=\"left\">: $wkt_giat<br></td>
								</tr>
								<tr>
									<td width=\"30%\" style=\"border-right:none;\" align=\"left\">Lokasi Kegiatan</td>
									<td width=\"70%\" style=\"border-left:none;\" colspan=\"8\" align=\"left\">: $lokasi<br></td>
								</tr>
								<tr>
									<td width=\"30%\" style=\"border-right:none;\" align=\"left\">Sumber Dana</td>
									<td width=\"70%\" style=\"border-left:none;\" colspan=\"8\" align=\"left\">: $sumber<br></td>
								</tr>
								
						</table>";
	
			$cRet .= "<table width =\"100%\" border=\"1\" style=\"font-size:10pt;border-collapse:collapse;\">
					<tr>
						<td width=\"100%\" colspan=\"9\" align=\"center\"><b>Indikator & Tolak Ukur Kinerja Belaja langsung</b></td>
					 </tr>";
			$cRet .="<tr>
					 <td width=\"20%\" align=\"center\"><b>Indikator</b></td>
					 <td width=\"60%\" colspan=\"4\" align=\"center\"><b>Tolak Ukur Kerja</b> </td>
					 <td width=\"20%\" colspan=\"4\" align=\"center\"><b>Target Kinerja</b> </td>
					</tr>";		  
			$cRet .=" <tr align=\"center\">
						<td colspan=\"1\">Capaian Program </td>
						<td colspan=\"4\">$tu_capai</td>
						<td colspan=\"4\">$tk_capai</td>
					 </tr>";
			$cRet .=" <tr align=\"center\">
						<td>Masukan </td>
						<td colspan=\"4\">$tu_mas</td>
						<td colspan=\"4\">Rp. $totp</td>
					</tr>";
			$cRet .=" <tr align=\"center\">
						<td>Keluaran </td>
						<td colspan=\"4\">$tu_kel</td>
						<td colspan=\"4\">$tk_kel</td>
					  </tr>";
			$cRet .=" <tr align=\"center\">
						<td>Hasil </td>
						<td colspan=\"4\">$tu_has</td>
						<td colspan=\"4\">$tk_has</td>
					  </tr>";
			$cRet .= "<tr>
						<td colspan=\"9\"  width=\"100%\" align=\"left\">Kelompok Sasaran Kegiatan : $sas_giat</td>
					</tr>";
			
			$cRet .= "<tr>
							<td colspan=\"9\" align=\"center\"><b>Rincian Dokumen Pelaksanaan Anggaran Belanja Langsung<br>Program dan Per Kegiatan Satuan Kerja Perangkat Daerah</b></td>
					  </tr></table>";
						
			$cRet .="</table>";
			$cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">     
					   <thead>
						<tr><td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>Kode Rekening</b></td>                            
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"40%\" align=\"center\"><b>Uraian</b></td>
								<td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"30%\" align=\"center\"><b>Rincian Perhitungan</b></td>
								<td rowspan=\"2\" colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>Jumlah(Rp.)</b></td></tr>
							<tr>
								 <td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>Volume</b></td>
								<td width=\"8%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>Satuan</b></td>
								<td width=\"14%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>harga</b></td>
							</tr>                         
							<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\" align=\"center\">&nbsp;</td>                            
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"40%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"8%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"8%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"14%\">&nbsp;</td>
								<td colspan=\"4\" style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"20%\">&nbsp;</td></tr>
								</thead>
							";
					 $sql1="SELECT * FROM(SELECT LEFT(a.kd_rek5,1)AS rek1,LEFT(a.kd_rek5,1)AS rek,b.nm_rek1 AS nama ,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,'1' AS id,'' as nopo FROM trdrka a INNER JOIN ms_rek1 b ON LEFT(a.kd_rek5,1)=b.kd_rek1 WHERE a.kd_kegiatan='$giat' AND a.kd_skpd='$skpd' 
							GROUP BY LEFT(a.kd_rek5,1) 
							UNION ALL 
							SELECT LEFT(a.kd_rek5,2) AS rek1,LEFT(a.kd_rek5,2) AS rek,b.nm_rek2 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,'2' AS id,'' as nopo FROM trdrka a INNER JOIN ms_rek2 b ON LEFT(a.kd_rek5,2)=b.kd_rek2 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$skpd'  GROUP BY LEFT(a.kd_rek5,2) 
							UNION ALL  
							SELECT LEFT(a.kd_rek5,3) AS rek1,LEFT(a.kd_rek5,3) AS rek,b.nm_rek3 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,'3' AS id,'' as nopo FROM trdrka a INNER JOIN ms_rek3 b ON LEFT(a.kd_rek5,3)=b.kd_rek3 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$skpd'  GROUP BY LEFT(a.kd_rek5,3) 
							UNION ALL 
							SELECT LEFT(a.kd_rek5,5) AS rek1,LEFT(a.kd_rek5,5) AS rek,b.nm_rek4 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,'4' AS id,'' as nopo FROM trdrka a INNER JOIN ms_rek4 b ON LEFT(a.kd_rek5,5)=b.kd_rek4 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$skpd'  GROUP BY LEFT(a.kd_rek5,5) 
							UNION ALL 
							SELECT a.kd_rek5 AS rek1,a.kd_rek5 AS rek,b.nm_rek5 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,'5' AS id,'' as nopo FROM trdrka a INNER JOIN ms_rek5 b ON a.kd_rek5=b.kd_rek5 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$skpd'  GROUP BY a.kd_rek5 
							UNION ALL 
							SELECT RIGHT(a.no_trdrka,7) AS rek1,' 'AS rek,a.uraian AS nama,a.tvolume AS volume,concat(a.satuan1,if(length(a.satuan2)=0,'',','),a.satuan2,if(length(a.satuan3)=0,'',','),a.satuan3) AS satuan,
							a.harga1 AS harga,a.total AS nilai,'6' AS id,a.no_po as nopo FROM trdpo a  WHERE LEFT(a.no_trdrka,10)='$skpd' AND SUBSTR(no_trdrka,11,21)='$giat' ORDER BY CAST(nopo as UNSIGNED)) a ORDER BY a.rek1,a.id";
					 
					 $query = $this->db->query($sql1);
					 
						foreach ($query->result() as $row)
					{
						$rek1=$row->rek1;
						$rek=$row->rek;
						$reke=$this->PublicModel->separator_rek($rek);
						$uraian=ucwords(strtolower($row->nama));
						$volum=$row->volume;
						$sat=ucwords(strtolower($row->satuan));
						$hrg= empty($row->harga) || $row->harga == 0 ? '' :number_format($row->harga,2,',','.');
						$nila= number_format($row->nilai,"2",".",",");
					   
						if (strlen($rek1)<=5){
						 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\"><b>$reke</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"40%\"><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"8%\" align=\"right\">$volum</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"8%\" align=\"left\">$sat</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"14%\" align=\"right\">$hrg</td>
										 <td colspan=\"4\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"20%\" align=\"right\"><b>$nila</b></td></tr>
										 ";
									 }else{
						  $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\">$reke</td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"40%\">$uraian</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"8%\" align=\"right\">$volum</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"8%\" align=\"left\">$sat</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"14%\" align=\"right\">$hrg</td>
										 <td colspan=\"4\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"20%\" align=\"right\">$nila</td></tr>
										 ";
	
									 }
					}
						$cRet .= "<tr>
									<td style=\"vertical-align:top;border-top: none;border-bottom:\" >&nbsp;</td>
									<td style=\"vertical-align:top;border-top: none;border-bottom:\" >&nbsp;</td>
									<td style=\"vertical-align:top;border-top: none;border-bottom:\" >&nbsp;</td>
									<td style=\"vertical-align:top;border-top: none;border-bottom:\" >&nbsp;</td>
									<td style=\"vertical-align:top;border-top: none;border-bottom:\" >&nbsp;</td>
									<td colspan=\"4\" style=\"vertical-align:top;border-top: none;border-bottom:\" align=\"right\">&nbsp;</td>
								 </tr>";       
						$cRet    .=" <tr>				
										 <td colspan=\"5\" style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"80%\" align=\"right\" ><b>Jumlah</b></td>
										 <td colspan=\"4\" style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"20%\" align=\"right\"><b>$totp</b></td></tr>";									 
	
					 $cRet .= "<tr>
									<td width=\"100%\" colspan=\"9\" align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rencana Penarikan Dana per Triwulan</td>
								</tr>";
								 
					  $qtriw = "SELECT '1' AS NO ,'Pendapatan' AS uraian,sum(nilai)/4 AS triw1,sum(nilai)/4 AS triw2,sum(nilai)/4 AS triw3,sum(nilai)/4 AS triw4 ,sum(nilai) AS jumlah FROM trdrka
							  WHERE kd_kegiatan='$giat' AND kd_skpd='$skpd'";
							  $querytriw = $this->db->query($qtriw);;
													  
					foreach ($querytriw->result() as $rowt)
					{
						$resttriw1=empty($rowt->triw1) || $rowt->triw1 == 0 ? '' :number_format($rowt->triw1,2,',','.');
						$resttriw2=empty($rowt->triw2) || $rowt->triw2 == 0 ? '' :number_format($rowt->triw2,2,',','.');
						$resttriw3=empty($rowt->triw3) || $rowt->triw3 == 0 ? '' :number_format($rowt->triw3,2,',','.');
						$resttriw4=empty($rowt->triw4) || $rowt->triw4 == 0 ? '' :number_format($rowt->triw4,2,',','.');
						$resttriw5=empty($rowt->jumlah) || $rowt->jumlah == 0 ? '' :number_format($rowt->jumlah,2,',','.');
	
					$cRet .="<tr>
									<td width =\"15%\" align=\"left\">&nbsp;<br>
									Triwulan I<br>
									Triwulan II<br>
									Triwulan III<br>
									Triwulan IV <br>
									<b>Jumlah</b>
									</td>

									
									<td colspan =\"2\" align=\"right\">&nbsp;<br>
									$resttriw1<br>
									$resttriw2<br>
									$resttriw3<br>
									<u>$resttriw4</u><br>
									<b>$resttriw5</b>						
									</td>
									<td colspan=\"6\" align=\"center\" style=\"border: 1px solid black;\">$ibukota, $tanggal 
									<br>
									Mengesahkan,
									<br>
									<b>$jabatan
									  <br><br /><br /><br /><br />&nbsp;
									$nama<br></b>
									NIP.$nip
									</td>
								   </tr>";
			}
			$cRet .=       " </table>";
			
			return $cRet;  
		}



		function dppa22_pdf($skpd){
			$id = $skpd;
			$thn_anggaran = $this->session->userdata('thn_ang');
			
			$sqldns="SELECT a.kd_urusan as kd_u,b.nm_urusan as nm_u,a.kd_skpd as kd_sk,a.nm_skpd as nm_sk FROM ms_skpd a INNER JOIN ms_urusan b ON a.kd_urusan=b.kd_urusan WHERE kd_skpd='$id'";
					 $sqlskpd=$this->db->query($sqldns);
					 foreach ($sqlskpd->result() as $rowdns)
					{
					   
						$kd_urusan=$rowdns->kd_u;                    
						$nm_urusan= $rowdns->nm_u;
						$kd_skpd  = $rowdns->kd_sk;
						$nm_skpd  = $rowdns->nm_sk;
					}
					$sqlsc="SELECT * FROM ms_data_umum where tahun_anggaran =".$thn_anggaran;
					$sqlsclient=$this->db->query($sqlsc);
							foreach ($sqlsclient->result() as $rowsc)
						   {  
							   $tgl=$rowsc->tgl_dpa;
							   $tanggal = $this->PublicModel->tgl_indo($tgl);
							   $kab     = strtoupper($rowsc->nama_daerah);
							   $daerah  = $rowsc->nama_daerah;
							   $thn     = $rowsc->tahun_anggaran;
							   $ibukota     = $rowsc->ibukota;
							   $logo     = $rowsc->logo_daerah;
							   $logoPath = base_url().$logo;
						   }
			$sqlttd1="SELECT nama as nm,nip as nip,jabatan as jab FROM ms_ttd where kd_skpd='4.04.01.00' and kode='PT'";
					 $sqlttd=$this->db->query($sqlttd1);
					 foreach ($sqlttd->result() as $rowttd)
					{
						$nip=$rowttd->nip;                    
						$nama= $rowttd->nm;
						$jabatan  = $rowttd->jab;
					}
			
			
			$cRet='';
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						<tr> 
							<td colspan=\"2\" width=\"20%\" rowspan=\"3\" align=\"center\">
							<img src=\"".$logoPath."\" width=\"100\">
							</td>
							 <td colspan=\"4\" width=\"60%\" align=\"center\">
								 <strong>DOKUMEN PELAKSANAAN PERUBAHAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</strong>
							</td>
							 <td colspan=\"4\" width=\"20%\" rowspan=\"3\" align=\"center\">
								 <strong>FORMULIR<br>DPPA - SKPD <br>2.2</strong>
							</td>
						</tr>
						<tr>
							 <td colspan=\"4\" width=\"60%\" align=\"center\"><strong>$kab</strong></td>
						</tr>
						<tr>
							 <td colspan=\"4\" width=\"60%\" align=\"center\"><strong>TAHUN ANGARAN $thn</strong></td>
						</tr>
						<tr>
							 <td colspan=\"2\" width=\"20%\" align=\"left\" style=\"border-right:none;border-bottom:none;\">Urusan Pemerintahan</td>
							 <td colspan=\"8\" width=\"80%\" align=\"left\" style=\"border-left:none;border-bottom:none;\">&nbsp;: $kd_urusan - $nm_urusan</td>
						</tr>
						<tr>
							 <td colspan=\"2\" width=\"20%\" align=\"left\" style=\"border-right:none;border-top:none;\">Organisasi</td>
							 <td colspan=\"8\" width=\"80%\" align=\"left\"  style=\"border-left:none;border-top:none;\">&nbsp;: $kd_skpd - $nm_skpd</td>
						</tr>
						
						</table>
					  ";
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
			  			<tr>
							<td align=\"center\" colspan=\"10\">
								<strong>Rekapitulasi Dokumen Pelaksanaan Perubahan Anggaran Belanja Menurut Program dan Kegiatan </strong>
							</td>
						</tr>
					</table>";
			$cRet .= "<table style=\"border-collapse:collapse;font-size:8pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr><td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"12%\" align=\"center\"><b>Program</b></td>                            
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"18%\" align=\"center\"><b>kegiatan</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>Uraian</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"7%\" align=\"center\"><b>Lokasi Kegiatan</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"7%\" align=\"center\"><b>Target Kinerja</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"7%\" align=\"center\"><b>Sumber Dana</b></td>
								<td colspan=\"2\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>Jumlah (Rp)</b></td>
								<td colspan=\"2\" bgcolor=\"#CCCCCC\" width=\"16%\" align=\"center\"><b>Bertambah/(Berkurang)</b></td>
							</tr>
							<tr>
								 <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\">Sebelum Perubahan</td>
								<td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\">Setelah Perubahan</td>
								<td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\">(Rp)</td>
								<td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\">%</td>
							</tr>    
						 </thead>
						 <tfoot>
						 <tr>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"10%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"10%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"20%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"8%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"8%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"8%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"10%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"10%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"10%\"></td>
								<td style=\"border-top: solid 1px black;border-bottom: none;border-left: none;border-right: none;\" width=\"6%\"></td>                           
							 </tr>
						 </tfoot>
						
					   ";
							
					 $sql1="SELECT * FROM (
							SELECT a.kd_program AS prog,a.kd_program AS prog1,' ' AS giat,a.nm_program AS uraian, ' ' AS lokasi,' 'AS target,' ' AS sumber,
							(SELECT SUM(nilai) AS nilai FROM trdrka WHERE  LEFT(kd_kegiatan,LENGTH(a.kd_program))= a.kd_program) AS jumlah ,
							(SELECT SUM(nilai_ubah) AS nilai FROM trdrka WHERE  LEFT(kd_kegiatan,LENGTH(a.kd_program))= a.kd_program) AS jumlah_u 
							FROM trskpd a LEFT JOIN trdrka c ON c.kd_kegiatan=a.kd_kegiatan 
							WHERE RIGHT(a.kd_program,2)<>'00' AND a.kd_skpd = '$id' GROUP BY a.kd_program,a.nm_program
							UNION 
							SELECT a.kd_program AS prog,' ' AS prog1,a.kd_kegiatan AS giat,a.nm_kegiatan AS uraian, a.lokasi AS lokasi,a.tk_kel_ubah AS target,c.sumber_ubah AS sumber,
							(SELECT SUM(nilai) AS nilai FROM trdrka WHERE kd_kegiatan = a.kd_kegiatan ) AS jumlah ,
							(SELECT SUM(nilai_ubah) AS nilai FROM trdrka WHERE kd_kegiatan = a.kd_kegiatan ) AS jumlah_u
							FROM trskpd a LEFT JOIN trdrka c ON c.kd_kegiatan=a.kd_kegiatan 
							WHERE RIGHT(a.kd_program,2)<>'00' AND a.kd_skpd = '$id' 
							GROUP BY a.kd_program,a.kd_kegiatan,a.nm_kegiatan,a.lokasi,a.tk_kel_ubah,c.sumber_ubah,giat
							)
							a ORDER BY a.prog,a.giat";


					 
					 $query = $this->db->query($sql1);
					 //$query = $this->skpd_model->getAllc();
													  
					foreach ($query->result() as $row)
					{
						$prog=$row->prog1;
						$giat=$row->giat;
						$uraian=$row->uraian;
						$lokasi=$row->lokasi;
						$target=$row->target;
						$sumber=$row->sumber;                    
						$nilai=empty($row->jumlah) || $row->jumlah == 0 ? '' :number_format($row->jumlah,2,',','.');
						$nilai_u=empty($row->jumlah_u) || $row->jumlah_u == 0 ? '' :number_format($row->jumlah_u,2,',','.');
						//$hrg=number_format($row->harga,"2",".",",");
						$n=$row->jumlah;
						$n_u=$row->jumlah_u;
						$n_s = $n_u - $n;
						if ($n_s < 0){
							$x1="("; $n_s=$n_s*-1; $y1=")";}
						else {
							$x1=""; $y1="";}
						$n_selisih = number_format($n_s,"2",".",",");
						//$per1   = ($n_s!=0)?($n_s / $n ) * 100:0;
	
						if($n == 0){
							$per1   = 100;
						}else{
							$per1   = ($n_s!=0)?($n_s / $n ) * 100:0;
						}
	
						$persen1= number_format($per1,"2",".",",");
	
						if ($giat == ' '){
						$cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\"><b>$prog</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$giat</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$lokasi</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$target</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$sumber</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$nilai</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$nilai_u</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$x1$n_selisih$y1</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$persen1</b></td>
										 
										 </tr>
										
										 ";
						   }else{
						 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\">$prog</td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$giat</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$uraian</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$lokasi</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$target</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$sumber</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$nilai</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$nilai_u</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$x1$n_selisih$y1</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$persen1</td>
										 
										 </tr>
											 
										 ";
						   }
					}
					$sqltp="SELECT SUM(nilai) AS totp,SUM(nilai_ubah) AS totp_u FROM trdrka WHERE LEFT(kd_rek5,2)='52' AND kd_skpd='$id'";
						$sqlp=$this->db->query($sqltp);
					 foreach ($sqlp->result() as $rowp)
					{
					   $totp=number_format($rowp->totp,"2",".",",");
					   $totp_u=number_format($rowp->totp_u,"2",".",",");
					   $totsusun=$rowp->totp;
					   $totubah=$rowp->totp_u;
					   $selisiubah=$totubah-$totsusun;
					  if ($selisiubah < 0){
							$xw1="("; $selisiubah=$selisiubah*-1; $yw1=")";}
					  else {
							$xw1=""; $yw1="";}
					  $n_selisihtot = number_format($selisiubah,"2",".",",");
					  if($selisiubah == 0){
							$pertot   = 100;
						}else{
							$pertot   = ($selisiubah!=0)?($selisiubah / $totsusun ) * 100:0;
						}
					   $persentot= number_format($pertot,"2",".",",");
						$cRet    .=" <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\"></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ></td>
										 <td align=\"center\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" colspan=\"3\"><b>JUMLAH BELANJA</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$totp</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$totp_u</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$xw1$n_selisihtot$yw1<b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$persentot</b></td></tr>";
					}
					
					$cRet .="<tr>
									
									<td width=\"60%\" colspan=\"6\" align=\"left\" style=\"border-right:none;\">&nbsp;<br>&nbsp;
									<br>&nbsp;
									&nbsp;<br>
									&nbsp;<br>
									&nbsp;<br>
									&nbsp;	
									</td>
									<td width=\"40%\" colspan=\"4\" style=\"border-left:none;\" align=\"center\">$ibukota ,$tanggal
									<br>Mengesahkan,
									 <br>
										<b>$jabatan
										<br><br><br>&nbsp;<br>
										<b><u>$nama</u><br>
										<b>NIP.$nip
									</td>
								 </tr>";
					 
			$cRet    .= "</table>";
			return $cRet;             
		}


		function get_top_keu($thn)
		{
			// $sts_ubah = $this->session->userdata('sts_ang');
			ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');
			$config =  $this->db->query('SELECT * FROM ms_config where tahun_anggaran = '.$thn.' limit 1')->row();
			$stsAng = $config->sts_anggaran;


			$html['top_keu'] = '';
			$html['top_fisik'] = '';
			$html['bot_keu'] = '';
			$html['bot_fisik'] = '';
			
			if($stsAng == 'Murni'){
				$nilai = 'total';
				$vol = 'tvolume';
			}else{
				$nilai = 'total_ubah';
				$vol = 'tvolume_ubah';
			}

			// $sql_old = "SELECT jml.tahun_anggaran,jml.kd_skpd,jml.nm_skpd, jml.anggaran as angJML,jml.realisasi as realJML, jml.persenKeu as keuJML, jml.persenFis as fisJML 
			// FROM(
			// SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd, sum(dau.$nilai) as anggaran,SUM(dau.real_keuangan) as realisasi, 
			// (sum(dau.real_keuangan)/sum(dau.$nilai))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis 
			// FROM ms_skpd s 
			// LEFT JOIN ( SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,
			// 						ak.kd_rek5,ak.nm_rek5, p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,
			// 						p.harga_ubah1,p.total,p.total_ubah,GREATEST(fisik1,fisik2,fisik3,fisik4) as real_fisik, GREATEST(keuangan1,keuangan2,keuangan3,keuangan4) as real_keuangan,
			// 						(GREATEST(keuangan1,keuangan2,keuangan3,keuangan4)/p.$nilai)* 100 as persenKeuangan, (GREATEST(fisik1,fisik2,fisik3,fisik4)/p.tvolume)* 100 as persenFisik, ak.nm_sumberdana 
			// 						FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan
			// 						and ak.kd_rek5 = p.kd_rek5 LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and
			// 						r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po 
			// 						WHERE p.$vol <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd 
			// 						WHERE thn_anggaran = $thn and sts_anggaran = '$stsAng' and kd_group_sd in(1,2,3,4,5,6,7)) and ak.ta = $thn)
			// 						dau ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)jml;";

			
			$sql = "SELECT ta as tahun_anggaran,kd_skpd,(SELECT nm_skpd FROM ms_skpd WHERE b.kd_skpd = kd_skpd AND b.ta = tahun_anggaran) as nm_skpd,
			sum(b.$nilai) as angJML,SUM(b.real_keuangan) as realJML, 
			(sum(b.real_keuangan)/sum(b.$nilai))*100 as keuJML,(SUM(b.persenFisik)/COUNT(b.ta)) as fisJML 
					 FROM 
					(SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,p.tvolume,p.tvolume_ubah,p.total,p.total_ubah,
					GREATEST(fisik1,fisik2,fisik3,fisik4) as real_fisik,
					GREATEST(keuangan1,keuangan2,keuangan3,keuangan4) as real_keuangan,
					(GREATEST(keuangan1,keuangan2,keuangan3,keuangan4)/p.$nilai)* 100 as persenKeuangan,
					(GREATEST(fisik1,fisik2,fisik3,fisik4)/p.$vol)* 100 as persenFisik
					FROM anggarankegiatan ak 
					INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5 
					LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po 
					WHERE p.$vol <> 0 
								and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd 
									WHERE thn_anggaran = $thn and sts_anggaran = '$stsAng' and kd_group_sd in(1,2,3,4,5,6,7))
								and ak.ta = $thn) b GROUP BY b.kd_skpd
					ORDER BY b.kd_skpd asc";

			$data = $this->db->query($sql)->result_array();


			$dataTopKeu = $data;
			$dataBotKeu = $data;
			$dataTopFisik = $data;
			$dataBotFisik = $data;

			// CARI DATA TOP KEUANGAN
			$keysTopKeu = array_column($dataTopKeu, 'keuJML');
			array_multisort($keysTopKeu, SORT_DESC, $dataTopKeu);
			// CARI DATA BOT KEUANGAN
			$keysBotKeu = array_column($dataBotKeu, 'keuJML');
			array_multisort($keysBotKeu, SORT_ASC, $dataBotKeu);

			// CARI DATA TOP FISIK
			$keysTopFisik = array_column($dataTopFisik, 'fisJML');
			array_multisort($keysTopFisik, SORT_DESC, $dataTopFisik);
			// CARI DATA BOT FISIK
			$keysBotFisik = array_column($dataBotFisik, 'fisJML');
			array_multisort($keysBotFisik, SORT_ASC, $dataBotFisik);


			$itopkeu = 0;
			$itopfisik = 0;
			$ibotkeu = 0;
			$ibotfisik = 0;
			foreach ($dataTopKeu as $value) {
				if($itopkeu >=5){
					break;
				}else{

					$nm_skpd=$value['nm_skpd'];
					$persen=number_format($value['keuJML'],'2',',','.');
					$persenIf=round($value['keuJML'],2);

					if($persenIf <= 25){
						$warna = " label-info label-4 ";
						
					}else if($persenIf <= 50){
						$warna = " label-warning label-5 ";
						
					}else if($persenIf <= 75){
						$warna = " label-success label-3 ";
						
					}else if($persenIf <= 100){
						$warna = " label-danger label-1 ";
						
					}
					$itopkeu++;
					$html['top_keu'].= '<li>'.$nm_skpd.'<span class="pull-right '.$warna.' label">'.$persen.'%</span></li>';
				}
			}

			foreach ($dataBotKeu as $value) {
				if($ibotkeu >=5){
					break;
				}else{

					$nm_skpd=$value['nm_skpd'];
					$persen=number_format($value['keuJML'],'2',',','.');
					$persenIf=round($value['keuJML'],2);

					if($persenIf <= 25){
						$warna = " label-info label-4 ";
						
					}else if($persenIf <= 50){
						$warna = " label-warning label-5 ";
						
					}else if($persenIf <= 75){
						$warna = " label-success label-3 ";
						
					}else if($persenIf <= 100){
						$warna = " label-danger label-1 ";
						
					}
					$ibotkeu++;
					$html['bot_keu'].= '<li>'.$nm_skpd.'<span class="pull-right '.$warna.' label">'.$persen.'%</span></li>';
				}
			}


			foreach ($dataTopFisik as $value) {
				if($itopfisik >=5){
					break;
				}else{

					$nm_skpd=$value['nm_skpd'];
					$persen=number_format($value['fisJML'],'2',',','.');
					$persenIf=round($value['fisJML'],2);

					if($persenIf <= 25){
						$warna = " label-info label-4 ";
						
					}else if($persenIf <= 50){
						$warna = " label-warning label-5 ";
						
					}else if($persenIf <= 75){
						$warna = " label-success label-3 ";
						
					}else if($persenIf <= 100){
						$warna = " label-danger label-1 ";
						
					}
					$itopfisik++;
					$html['top_fisik'].= '<li>'.$nm_skpd.'<span class="pull-right '.$warna.' label">'.$persen.'%</span></li>';
				}
			}

			foreach ($dataBotFisik as $value) {
				if($ibotfisik >=5){
					break;
				}else{

					$nm_skpd=$value['nm_skpd'];
					$persen=number_format($value['fisJML'],'2',',','.');
					$persenIf=round($value['fisJML'],2);

					if($persenIf <= 25){
						$warna = " label-info label-4 ";
						
					}else if($persenIf <= 50){
						$warna = " label-warning label-5 ";
						
					}else if($persenIf <= 75){
						$warna = " label-success label-3 ";
						
					}else if($persenIf <= 100){
						$warna = " label-danger label-1 ";
						
					}
					$ibotfisik++;
					$html['bot_fisik'].= '<li>'.$nm_skpd.'<span class="pull-right '.$warna.' label">'.$persen.'%</span></li>';
				}
			}






			return $html;
		}

		function get_top_fisik($thn)
		{
			$html = '';
			
			$sts_ubah = "Perubahan";
			if($sts_ubah == 'Murni'){
				$nilai = 'a.Nilai';
			}else{
				$nilai = 'a.Nilai_ubah';
			}

			$sql = "SELECT *,IFNULL((tot_real_keuangan/nilai)*100,0) as persen 
					FROM(SELECT a.kd_skpd,a.nm_skpd,sum(".$nilai.") as nilai, sum(a.Nilai_ubah) as nilai_ubah,
					 month(NOW()) as skrg,
						CASE
						WHEN month(NOW()) <= 3 THEN sum(b.keuangan1)
						WHEN month(NOW()) <= 6 THEN sum(b.keuangan2)
								WHEN month(NOW()) <= 9 THEN sum(b.keuangan3)
								WHEN month(NOW()) <= 12 THEN sum(b.keuangan4)
						ELSE 0
					END AS tot_real_keuangan
				from trdrka a 
				LEFT JOIN trdreal b on a.tahun_anggaran = b.tahun_anggaran and a.kd_kegiatan = b.kd_kegiatan and a.kd_rek5 = b.kd_rekening
				where left(kd_rek5,1) in('5') and a.tahun_anggaran = ".$thn." group by	a.kd_skpd) a order by persen asc,kd_skpd asc limit 5;";


			$data = $this->db->query($sql)->result();
			foreach ($data as $value) {
				$nm_skpd=$value->nm_skpd;
				$persen=number_format($value->persen,'2',',','.');
				$persenIf=$value->persen;
				if($persenIf >= 0){
					$warna = " label-info label-4 ";
				}else if($persenIf >= 25){
					$warna = " label-warning label-5 ";
				}else if($persenIf >= 50){
					$warna = " label-success label-3 ";
				}else if($persenIf >= 75){
					$warna = " label-danger label-1 ";
				}
				
				$html.= '<li>'.$nm_skpd.'<span class="pull-right '.$warna.' label">'.$persen.'%</span></li>';
			}

			return $html;
		}

		function get_top_fisik2($thn)
		{
			$html = '';
			
			$sts_ubah = "Perubahan";
			if($sts_ubah == 'Murni'){
				$nilai = 'a.Nilai';
			}else{
				$nilai = 'a.Nilai_ubah';
			}

			$sql = "SELECT *,IFNULL((tot_real_keuangan/nilai)*100,0) as persen 
					FROM(SELECT a.kd_skpd,a.nm_skpd,sum(".$nilai.") as nilai, sum(a.Nilai_ubah) as nilai_ubah,
					 month(NOW()) as skrg,
						CASE
						WHEN month(NOW()) <= 3 THEN sum(b.fisik1)
						WHEN month(NOW()) <= 6 THEN sum(b.fisik2)
								WHEN month(NOW()) <= 9 THEN sum(b.fisik3)
								WHEN month(NOW()) <= 12 THEN sum(b.fisik4)
						ELSE 0
					END AS tot_real_keuangan
				from trdrka a 
				LEFT JOIN trdreal b on a.tahun_anggaran = b.tahun_anggaran and a.kd_kegiatan = b.kd_kegiatan and a.kd_rek5 = b.kd_rekening
				where left(kd_rek5,1) in('5') and a.tahun_anggaran = ".$thn." group by	a.kd_skpd) a order by persen desc,kd_skpd asc limit 5;";
			$data = $this->db->query($sql)->result();
			foreach ($data as $value) {
				$nm_skpd=$value->nm_skpd;
				$persen=number_format($value->persen,'2',',','.');
				$persenIf=$value->persen;
				if($persenIf >= 0){
					$warna = " label-info label-4 ";
				}else if($persenIf >= 25){
					$warna = " label-warning label-5 ";
				}else if($persenIf >= 50){
					$warna = " label-success label-3 ";
				}else if($persenIf >= 75){
					$warna = " label-danger label-1 ";
				}
				
				$html.= '<li>'.$nm_skpd.'<span class="pull-right '.$warna.' label">'.$persen.'%</span></li>';
			}
			return $html;
		}

		function dppa221_pdf($id,$giat){

			$thn_anggaran = $this->session->userdata('thn_ang');
			
			$sqldns="SELECT a.kd_urusan as kd_u,b.nm_urusan as nm_u,a.kd_skpd as kd_sk,a.nm_skpd as nm_sk FROM ms_skpd a INNER JOIN ms_urusan b ON a.kd_urusan=b.kd_urusan WHERE kd_skpd='$id'";
					 $sqlskpd=$this->db->query($sqldns);
					 foreach ($sqlskpd->result() as $rowdns)
					{
					   
						$kd_urusan=$rowdns->kd_u;                    
						$nm_urusan= $rowdns->nm_u;
						$kd_skpd  = $rowdns->kd_sk;
						$nm_skpd  = $rowdns->nm_sk;
						$org=substr($kd_skpd,5,5);
					}
					$sqlsc="SELECT * FROM ms_data_umum where tahun_anggaran =".$thn_anggaran;
					$sqlsclient=$this->db->query($sqlsc);
							foreach ($sqlsclient->result() as $rowsc)
						   {  
							   $tgl=$rowsc->tgl_dpa;
							   $tanggal = $this->PublicModel->tgl_indo($tgl);
							   $kab     = strtoupper($rowsc->nama_daerah);
							   $daerah  = $rowsc->nama_daerah;
							   $thn     = $rowsc->tahun_anggaran;
							   $ibukota    = $rowsc->ibukota;
							   $logo     = $rowsc->logo_daerah;
							   $logoPath = base_url().$logo;

						   }
					
			$sqlttd1="SELECT nama as nm,nip as nip,jabatan as jab FROM ms_ttd where kd_skpd='4.04.01.00' and kode='PT'";
					 $sqlttd=$this->db->query($sqlttd1);
					 $tesjab=0;
					 foreach ($sqlttd->result() as $rowttd)
					{
						$nip=$rowttd->nip;                    
						$nama= $rowttd->nm;
						$jabatan  = $rowttd->jab;
						$tesjab++;
					}
					if($tesjab==0){
						$nip='belum ada nip';
						$nama= 'belum ada nama';
						$jabatan  = 'belum ada jabatan';
					}
			$sqlorg="SELECT f.kd_urusan,f.nm_urusan,a.kd_skpd,e.nm_skpd,a.kd_program,a.nm_program,a.kd_kegiatan,a.nm_kegiatan,SUM(d.nilai_ubah) AS nilai,a.tu_capai_ubah,a.tu_mas_ubah,a.tu_kel_ubah,a.tu_has_ubah,
					a.tk_capai_ubah,a.tk_mas_ubah,a.tk_kel_ubah,a.tk_has_ubah,a.lokasi,d.sumber_ubah as sumber,a.sasaran_giat,a.waktu_giat,right(a.kd_program,2) as programx,substr(a.kd_kegiatan,20,2) as kegiatanx 
					,a.tu_capai,a.tu_mas,a.tu_kel,a.tu_has,a.tk_capai,a.tk_mas,a.tk_kel,a.tk_has FROM trskpd a
					INNER JOIN trdrka d ON a.kd_kegiatan=d.kd_kegiatan
					INNER JOIN ms_skpd e ON a.kd_skpd=e.kd_skpd
					INNER JOIN ms_urusan f ON a.kd_urusan=f.kd_urusan where a.kd_kegiatan='$giat'
					-- GROUP BY a.kd_skpd
					GROUP BY
					f.kd_urusan,f.nm_urusan,a.kd_skpd,a.kd_program,a.nm_program,a.nm_kegiatan,a.tu_capai_ubah,
					a.tu_mas_ubah,a.tu_kel_ubah,a.tu_has_ubah, a.tk_capai_ubah,a.tk_mas_ubah,a.tk_kel_ubah,a.tk_has_ubah,a.lokasi,d.sumber_ubah,
					a.sasaran_giat,a.waktu_giat,
					a.tu_capai,a.tu_mas,a.tu_kel,a.tu_has,a.tk_capai,a.tk_mas,a.tk_kel,a.tk_has 

					";
					
					 $sqlorg1=$this->db->query($sqlorg);
					 $joss=0;
					 foreach ($sqlorg1->result() as $roworg)
					{
						$kd_urusan=$roworg->kd_urusan;                    
						$nm_urusan= $roworg->nm_urusan;
						$kd_skpd  = $roworg->kd_skpd;
						$nm_skpd  = $roworg->nm_skpd;
						$kd_prog  = $roworg->kd_program;
						$nm_prog  = $roworg->nm_program;
						$kd_giat  = $roworg->kd_kegiatan;
						$nm_giat  = $roworg->nm_kegiatan;
						$waktu  = $roworg->waktu_giat;
						$lokasi  = $roworg->lokasi;
						$sumber  = $roworg->sumber;
						$programx  = $roworg->programx;
						$kegiatanx  = $roworg->kegiatanx;
						
						$tu_capai_u= $roworg->tu_capai_ubah;
						$tu_mas_u  = $roworg->tu_mas_ubah;
						$tu_kel_u  = $roworg->tu_kel_ubah;
						$tu_has_u  = $roworg->tu_has_ubah;
						$tk_capai_u= $roworg->tk_capai_ubah;
						$tk_mas_u  = $roworg->tk_mas_ubah;
						$tk_kel_u  = $roworg->tk_kel_ubah;
						$tk_has_u  = $roworg->tk_has_ubah;
						$sas_giat = $roworg->sasaran_giat;

						$tu_capai= $roworg->tu_capai;
						$tu_mas  = $roworg->tu_mas;
						$tu_kel  = $roworg->tu_kel;
						$tu_has  = $roworg->tu_has;
						$tk_capai= $roworg->tk_capai;
						$tk_mas  = $roworg->tk_mas;
						$tk_kel  = $roworg->tk_kel;
						$tk_has  = $roworg->tk_has;
						$joss++;
					}
					if ($joss==0){
						$kd_urusan='&nbsp;';                    
						$nm_urusan='&nbsp;';
						$kd_skpd  = '&nbsp;';
						$nm_skpd  = '&nbsp;';
						$kd_prog  = '&nbsp;';
						$nm_prog  = '&nbsp;';
						$kd_giat  = '&nbsp;';
						$nm_giat  = '&nbsp;';
						$waktu  = '&nbsp;';
						$lokasi  = '&nbsp;';
						$sumber  = '&nbsp;';
						$programx  = '&nbsp;';
						$kegiatanx  = '&nbsp;';
						
						$tu_capai= '&nbsp;';
						$tu_mas  = '&nbsp;';
						$tu_kel  = '&nbsp;';
						$tu_has  = '&nbsp;';
						$tk_capai= '&nbsp;';
						$tk_mas  = '&nbsp;';
						$tk_kel  = '&nbsp;';
						$tk_has  = '&nbsp;';
					
					
					}
			
			
			$sqltp="SELECT SUM(nilai_ubah) AS totb_u,sum(nilai)as totb FROM trdrka WHERE kd_kegiatan='$giat' AND kd_skpd='$id'";
						$sqlb=$this->db->query($sqltp);
					 foreach ($sqlb->result() as $rowb)
					{
					   $totp=number_format($rowb->totb,2,',','.');
					   $totp_u=number_format($rowb->totb_u,2,',','.');
					} 
					
			
			$cRet='';
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						<tr>
						<td width=\"10%\" rowspan=\"3\" align=\"center\">
								<img src=\"".$logoPath."\" width=\"100\" height=\"100\" />
							</td>
							 <td width=\"45%\" colspan=\"2\" rowspan=\"2\" align=\"center\" style=\"font-size:10pt;\" ><strong>DOKUMEN PELAKSANAAN PERUBAHAN ANGGARAN <br>SATUAN KERJA PERANGKAT DAERAH</strong></td>
							 <td width=\"30%\" colspan=\"6\" align=\"center\" style=\"font-size:10pt;\"><strong>NOMOR DPPA SKPD </strong></td>
							 <td width=\"15%\" colspan=\"3\" rowspan=\"3\" align=\"center\"><strong>&nbsp;<br>FORMULIR<br>DPPA - SKPD <br>2.2.1</strong></td>
						</tr>
						<tr>
							 <td width=\"5%\" align=\"center\"><b>$kd_urusan</b></td>
							 <td width=\"9%\" align=\"center\"><b>$kd_skpd</b></td>
							 <td width=\"5%\" align=\"center\"><b>$programx</b></td>
							 <td width=\"5%\" align=\"center\"><b>$kegiatanx</b></td>
							 <td width=\"3%\" align=\"center\"><b>5</b></td>
							 <td width=\"3%\" align=\"center\"><b>2</b></td>
						</tr>
						<tr>
							 <td width=\"75%\" colspan=\"8\" align=\"center\" style=\"font-size:12pt;\"><strong>$kab <br> TAHUN ANGGARAN $thn</strong> </td>
						</tr>
	
					  </table>";
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"1\">
					<tr><td width=\"100%\" colspan=\"12\">";
			$cRet .="<table style=\"border-collapse:collapse;font-size:14;\" width=\"100%\" align=\"left\" border=\"0\" cellpadding=\"2\">
								<tr>
									<td colspan=\"2\">&nbsp;Urusan Pemerintahan</td>
									<td colspan=\"10\">$kd_urusan - $nm_urusan</td>
								</tr>
								<tr>
									<td colspan=\"2\">&nbsp;Organisasi</td>
									<td colspan=\"10\">$kd_skpd   - $nm_skpd</td>
								</tr>
								<tr>
									<td colspan=\"2\">&nbsp;Program</td>
									<td colspan=\"10\">$kd_prog   - $nm_prog</td>
								</tr>
								<tr>
									<td colspan=\"2\">&nbsp;Kegiatan</td>
									<td colspan=\"10\">$kd_giat   - $nm_giat</td>
								</tr>
								<tr>
									<td colspan=\"2\">&nbsp;Waktu Pelaksanaan</td>
									<td colspan=\"10\">$waktu</td>
								</tr>
								<tr>
									<td colspan=\"2\">&nbsp;Lokasi Kegiatan</td>
									<td colspan=\"10\">$lokasi</td>
								</tr>
								<tr>
									<td colspan=\"2\">&nbsp;Sumber Dana</td>
									<td colspan=\"10\">$sumber</td>
								</tr>
						</table></td></tr>";
			$cRet .= "<tr style=\"border:1px solid black;\">
						<td  align=\"center\" width=\"100%\" colspan=\"12\"><b>Perubahan Indikator & Tolak Ukur Kinerja Belaja Langsung</b></td>
					 </tr>";
			$cRet .="<tr>
					 <td rowspan=\"2\" colspan=\"4\" style=\"border:1px solid black;\" width=\"18%\" align=\"center\"><b>Indikator</b> </td>
					 <td colspan=\"4\" width=\"44%\" style=\"border:1px solid black;\" align=\"center\"><b>Tolak Ukur Kinerja</b> </td>
					 <td colspan=\"4\" width=\"34%\" style=\"border:1px solid black;\" align=\"center\"><b>Target Kinerja </b></td>
					</tr>";
			$cRet .="<tr style=\"border:1px solid black;\">
						  <td style=\"border:1px solid black;\" colspan=\"2\" align=\"center\" width=\"22%\"><b>Sebelum Perubahan</b></td>
						  <td style=\"border:1px solid black;\" colspan=\"2\" align=\"center\" width=\"22%\"><b>Setelah Perubahan</b></td>
						  <td style=\"border:1px solid black;\" colspan=\"2\" align=\"center\" width=\"19%\"><b>Sebelum Perubahan</b></td>
					   <td style=\"border:1px solid black;\" colspan=\"2\" align=\"center\" width=\"19%\"><b>Setelah Perubahan</b></td>
					  </tr>";		  
			$cRet .=" <tr align=\"center\">
						<td style=\"border:1px solid black;\" colspan=\"4\" >Capaian Program </td>
						<td style=\"border:1px solid black;\" colspan=\"2\" > $tu_capai</td>
						<td style=\"border:1px solid black;\" colspan=\"2\" > $tu_capai_u</td>
						<td style=\"border:1px solid black;\" colspan=\"2\" > $tk_capai</td>
						<td style=\"border:1px solid black;\" colspan=\"2\" > $tk_capai_u</td>
					 </tr>";
			$cRet .=" <tr align=\"center\">
						<td style=\"border:1px solid black;\" colspan=\"4\">Masukan </td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tu_mas</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tu_mas_u</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> Rp. $totp</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> Rp. $totp_u</td>
					</tr>";
			$cRet .=" <tr align=\"center\">
						<td style=\"border:1px solid black;\" colspan=\"4\">Keluaran </td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tu_kel</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tu_kel_u</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tk_kel</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tk_kel_u</td>
					  </tr>";
			$cRet .=" <tr align=\"center\">
						<td style=\"border:1px solid black;\" colspan=\"4\">Hasil </td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tu_has</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tu_has_u</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tk_has</td>
						<td style=\"border:1px solid black;\" colspan=\"2\"> $tk_has_u</td>
					  </tr>";
			$cRet .= "<tr>
						<td style=\"border:1px solid black;\" colspan=\"12\" width=\"100%\" align=\"left\">Kelompok Sasaran Kegiatan : $sas_giat</td>
					</tr>";
			
			$cRet .= "<tr>
							<td style=\"border:1px solid black;\" colspan=\"12\" align=\"center\"><b>RINCIAN PERUBAHAN ANGGARAN BELANJA LANGSUNG <br>PROGRAM DAN PER KEGIATAN SATUAN KERJA PERANGKAT DAERAH</b></td>
					  </tr>";
						
			$cRet .="</table>";
			 
			$cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr><td rowspan=\"3\" width=\"10%\" align=\"center\"><b>Kode Rekening</b></td>                            
								<td rowspan=\"3\" width=\"25%\" align=\"center\"><b>Uraian</b></td>
								<td colspan=\"4\" width=\"26%\" align=\"center\"><b>Sebelum Perubahan</b></td>
								<td colspan=\"4\" width=\"26%\" align=\"center\"><b>Setelah Perubahan</b></td>
								<td colspan=\"2\" width=\"13%\" align=\"center\"><b>Bertambah/ (berkurang)</b></td></tr>
							<tr>
								 <td colspan=\"3\" width=\"16%\" align=\"center\">Rincian Penghitungan</td>
								<td rowspan=\"2\" width=\"10%\" align=\"center\">Jumlah</td>
								<td colspan=\"3\" width=\"16%\" align=\"center\">Rincian Penghitungan</td>
								<td rowspan=\"2\" width=\"10%\" align=\"center\">Jumlah</td>
								<td rowspan=\"2\" width=\"10%\" align=\"center\">(Rp)</td>
								<td rowspan=\"2\" width=\"3%\" align=\"center\">%</td>
							</tr>
							<tr>
								 <td width=\"3%\" align=\"center\">Volume</td>
								<td width=\"3%\" align=\"center\">Satuan</td>
								<td width=\"10%\" align=\"center\">harga</td>
								<td width=\"3%\" align=\"center\">Volume</td>
								<td width=\"3%\" align=\"center\">Satuan</td>
								<td width=\"10%\" align=\"center\">harga</td>
							</tr> 
							<tr>
								 <td width=\"10%\" align=\"center\">1</td>
								<td width=\"25%\" align=\"center\">2</td>
								<td width=\"3%\" align=\"center\">3</td>
								<td width=\"3%\" align=\"center\">4</td>
								<td width=\"10%\" align=\"center\">5</td>
								<td width=\"10%\" align=\"center\">6=3x5</td>
								<td width=\"3%\" align=\"center\">7</td>
								<td width=\"3%\" align=\"center\">8</td>
								<td width=\"10%\" align=\"center\">9</td>
								<td width=\"10%\" align=\"center\">10=7x9</td>
								<td width=\"10%\" align=\"center\">11=10-6</td>
								<td width=\"3%\" align=\"center\">12</td>
							</tr>    
						 </thead>
						<tfoot>
							<tr>
								<td colspan=\"12\" style=\"border:solid 1px white;border-top: solid 1px black;\"></td>                       
							 </tr>
						 </tfoot>
		
						
						 
							";
								
					 $sql1="SELECT * FROM(SELECT LEFT(a.kd_rek5,1)AS rek1,LEFT(a.kd_rek5,1)AS rek,b.nm_rek1 AS nama ,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,' 'AS volume_u,' 'AS satuan_u,
							' 'AS harga_u,SUM(a.nilai_ubah) AS nilai_u,'1' AS id,0 as po FROM trdrka a INNER JOIN ms_rek1 b ON LEFT(a.kd_rek5,1)=b.kd_rek1 WHERE a.kd_kegiatan='$giat' AND a.kd_skpd='$id' 
							GROUP BY LEFT(a.kd_rek5,1) 
							UNION ALL 
							SELECT LEFT(a.kd_rek5,2) AS rek1,LEFT(a.kd_rek5,2) AS rek,b.nm_rek2 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,' 'AS volume_u,' 'AS satuan_u,
							' 'AS harga_u,SUM(a.nilai_ubah) AS nilai_u,'2' AS id,0 as po FROM trdrka a INNER JOIN ms_rek2 b ON LEFT(a.kd_rek5,2)=b.kd_rek2 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$id'  GROUP BY LEFT(a.kd_rek5,2) 
							UNION ALL  
							SELECT LEFT(a.kd_rek5,3) AS rek1,LEFT(a.kd_rek5,3) AS rek,b.nm_rek3 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,' 'AS volume_u,' 'AS satuan_u,
							' 'AS harga_u,SUM(a.nilai_ubah) AS nilai_u,'3' AS id,0 as po FROM trdrka a INNER JOIN ms_rek3 b ON LEFT(a.kd_rek5,3)=b.kd_rek3 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$id'  GROUP BY LEFT(a.kd_rek5,3) 
							UNION ALL 
							SELECT LEFT(a.kd_rek5,5) AS rek1,LEFT(a.kd_rek5,5) AS rek,b.nm_rek4 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,' 'AS volume_u,' 'AS satuan_u,
							' 'AS harga_u,SUM(a.nilai_ubah) AS nilai_u,'4' AS id,0 as po FROM trdrka a INNER JOIN ms_rek4 b ON LEFT(a.kd_rek5,5)=b.kd_rek4 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$id'  GROUP BY LEFT(a.kd_rek5,5) 
							UNION ALL 
							SELECT a.kd_rek5 AS rek1,a.kd_rek5 AS rek,b.nm_rek5 AS nama,' 'AS volume,' 'AS satuan,
							' 'AS harga,SUM(a.nilai) AS nilai,' 'AS volume_u,' 'AS satuan_u,
							' 'AS harga_u,SUM(a.nilai_ubah) AS nilai_u,'5' AS id,0 as po FROM trdrka a INNER JOIN ms_rek5 b ON a.kd_rek5=b.kd_rek5 WHERE a.kd_kegiatan='$giat'
							AND a.kd_skpd='$id'  GROUP BY a.kd_rek5 
							UNION ALL 
							SELECT RIGHT(a.no_trdrka,7) AS rek1,' 'AS rek,a.uraian AS nama,a.volume1 AS volume,a.satuan1 AS satuan,
							a.harga1 AS harga,a.total AS nilai,a.volume_ubah1 AS volume_u,a.satuan_ubah1 AS satuan_u,
							a.harga_ubah1 AS harga_u,a.total_ubah AS nilai_u,'6' AS id,a.no_po as po FROM trdpo a  WHERE LEFT(a.no_trdrka,10)='$id' AND SUBSTR(no_trdrka,11,21)='$giat' ) a ORDER BY a.rek1,a.id,a.po";
					 
					 $query = $this->db->query($sql1);
					 //$query = $this->skpd_model->getAllc();
													  
					foreach ($query->result() as $row)
					{
						$rek1=$row->rek1;
						$rek=$row->rek;
						$reke=$this->PublicModel->separator_rek($rek);
						$uraian=$row->nama;
						$volum=empty($row->volume) || $row->volume == 0 ? '' :number_format($row->volume,0,',','.');//$row->volume;
						$sat=$row->satuan;
						$hrg= empty($row->harga) || $row->harga == 0 ? '' :number_format($row->harga,2,',','.');                    
						$nila= number_format($row->nilai,2,',','.');                    
						$volum_u=empty($row->volume_u) || $row->volume_u == 0 ? '' :number_format($row->volume_u,0,',','.');//$row->volume_u;
						$sat_u=$row->satuan_u;
						$hrg_u= empty($row->harga_u) || $row->harga_u == 0 ? '' :number_format($row->harga_u,2,',','.');                    
						$nila_u= number_format($row->nilai_u,2,',','.');
						$n=$row->nilai;
						$n_u=$row->nilai_u;
						$n_s = $n_u - $n;
						if ($n_s < 0){
							$x1="("; $n_s=$n_s*-1; $y1=")";}
						else {
							$x1=""; $y1="";}
						$n_selisih = number_format($n_s,2,',','.');
						//$per1   = ($n_s!=0)?($n_s / $n ) * 100:0; 
						 if($n == 0){
							$per1   = 100;
						}else{
							$per1   = ($n_s!=0)?($n_s / $n ) * 100:0;
						}					
						$persen1= number_format($per1,2,',','.');
						if(strlen($rek1) <=5){
						 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\"><b>$reke</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"25%\"><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\"><b>$volum</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\"><b>$sat</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$hrg</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$nila</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\"><b>$volum_u</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\"><b>$sat_u</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$hrg_u</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$nila_u</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$x1$n_selisih$y1</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"right\"><b>$persen1</b></td></tr>
										 ";
						}else{
							 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\">$reke</td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"25%\">$uraian</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\">$volum</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\">$sat</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$hrg</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$nila</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\">$volum_u</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"center\">$sat_u</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$hrg_u</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$nila_u</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">$x1$n_selisih$y1</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"right\">$persen1</td></tr>
										 ";
						
						
						
						}
					}
						$cRet .= "<tr>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\"></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"25%\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\" align=\"right\">&nbsp;</td>
								 </tr>";
					 $sqltp="SELECT SUM(nilai) AS totp,sum(nilai_ubah) as totp_u FROM trdrka WHERE kd_kegiatan='$giat'  AND kd_skpd='$id'";
						$sqlp=$this->db->query($sqltp);
					 foreach ($sqlp->result() as $rowp)
					{
					   $totp=number_format($rowp->totp,2,',','.');
					   $totp_u=number_format($rowp->totp_u,2,',','.');
					   
					   $n_s = $rowp->totp_u - $rowp->totp;
						if ($n_s < 0){
							$x1="("; $n_s=$n_s*-1; $y1=")";}
						else {
							$x1=""; 
							$n_s=$n_s*1;
							$y1="";}
						$n_selisihx = number_format($n_s,2,',','.');
	
						 if($rowp->totp == 0){
							$per12   = 100;
						}else{
							$per12   = ($n_s!=0)?($n_s / $rowp->totp ) * 100:0;
						}					
						$persen12= number_format($per12,2,',','.');					
						
					   
						$cRet    .=" <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"left\">&nbsp;</td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"25%\"><b>JUMLAH BELANJA</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$totp</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\">&nbsp;</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$totp_u</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"right\"><b>$x1$n_selisihx$y1</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"3%\"><b>$persen12</b></td>
										</tr>";
					 } 
					 $cRet .= "<tr>
									<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align=\"right\"></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align=\"right\">&nbsp;</td>
								</tr>";
					 
				   
								 
					  $qtriw = "SELECT '1' AS NO ,'Pendapatan' AS uraian,triw1_ubah AS triw1,triw2_ubah AS triw2,triw3_ubah AS triw3,triw4_ubah AS triw4 ,total_ubah AS jumlah FROM trskpd
							  WHERE kd_kegiatan='$giat' AND kd_skpd='$id'";
							  $sqltriw=$this->db->query($qtriw);
							  $resttriw = $sqltriw->result_array();
							//   $sqltriw=mysqli_query($qtriw) or die ("query gagal ".mysqli_error());
							//   $resttriw=mysqli_fetch_array($sqltriw);
							  $resttriw1= empty($resttriw[2]) || $resttriw[2] == 0 ? '0' : number_format($resttriw[2],2,',','.');
							  $resttriw2= empty($resttriw[3]) || $resttriw[3] == 0 ? '0' : number_format($resttriw[3],2,',','.');
							  $resttriw3= empty($resttriw[4]) || $resttriw[4] == 0 ? '0' : number_format($resttriw[4],2,',','.');
							  $resttriw4= empty($resttriw[5]) || $resttriw[5] == 0 ? '0' : number_format($resttriw[5],2,',','.');
							  $resttriw5= empty($resttriw[6]) || $resttriw[6] == 0 ? '0' : number_format($resttriw[6],2,',','.');
					$cRet .= " <tr>
								   <td style=\" border-right:none;\"></td>
								   <td style=\" border-left:none; border-right:none;\" colspan=\"7\"></td>
									<td colspan=\"4\" align=\"center\" style=\" border-left:none; \">
										$daerah ,$tanggal<br>
										Mengesahkan,	
										<br>
										<b>$jabatan
										<br><br /><br />&nbsp;<br>
										<b><u>$nama</u><br>
										<b>NIP.$nip
									</td>
								</tr>
					<tr>
						<td width=\"100%\" colspan=\"12\" align=\"center\" style=\"font-size:14px;\"><b>Rencana Penarikan Dana per Triwulan</b></td>
					</tr>";
			$cRet .= "<tr> <td width=\"100%\" colspan=\"12\" style=\"padding:10px 30px\">
						<table width=\"100%\" border=\"0\" style=\"border-collapse:collapse;\" cellpadding=\"4\">
							<tr>
								<td colspan=\"7\">Triwulan I</td>
								<td>Rp</td>
								<td colspan=\"4\" align=\"right\">$resttriw1</td>
							</tr>
							<tr>
								<td colspan=\"7\">Triwulan II</td>
								<td >Rp</td>
								<td colspan=\"4\" align=\"right\">$resttriw2</td>
							</tr>
							<tr>
								<td colspan=\"7\">Triwulan III</td>
								<td >Rp</td>
								<td colspan=\"4\" align=\"right\">$resttriw3</td>
							</tr>
							<tr>
								<td colspan=\"7\">Triwulan IV</td>
								<td >Rp</td>
								<td colspan=\"4\" style=\"border-bottom:1px solid black;\" align=\"right\">$resttriw4</td>
							</tr>
							<tr>
								<td colspan=\"7\"><b>Jumlah</b></td>
								<td ><b>Rp</b></td>
								<td colspan=\"4\" style=\"border-bottom:1px solid black;\" align=\"right\"><b>$resttriw5</b></td>
							</tr>
						</table>
					 </td></tr>";
	
			$cRet .=       " </table>";
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">
						<tr>
							<td align=\"center\" colspan=\"12\" style=\"vertical-align:top;border-top: 1px solid black;border-bottom: none;\"><b>Tim Anggaran Pemerintah Daerah</b></td>
						</tr>
						<tr>
							 <td width=\"5%\" align=\"center\" ><b>No</td>
							 <td width=\"15%\"  colspan=\"2\" align=\"center\"><b>Nama</td>
							 <td width=\"15%\"  colspan=\"2\" align=\"center\"><b>NIP</td>
							 <td width=\"50%\"  colspan=\"3\" align=\"center\"><b>Jabatan</td>
							 <td colspan=\"4\" width=\"10%\"  align=\"center\"><b>Tanda Tangan</td>
							 
						</tr>";
						$sqltapd="SELECT no,nip,nama,jabatan FROM tapd ORDER BY NO";
					 $sqlsclient=$this->db->query($sqltapd);
					 foreach ($sqlsclient->result() as $row)
					{
						$notapd=$row->no;
						$namatapd=$row->nama;
						$niptapd=$row->nip;
						$jabatantapd=$row->jabatan;
							$cRet .="<tr>
								<td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: solid 1px black;border-right: solid 1px black\"  width=\"5%\" align=\"Center\">$notapd.</td>
								<td  colspan=\"2\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: solid 1px black;border-right: solid 1px black\" width=\"15%\" align=\"left\">$namatapd</td>
								<td  colspan=\"2\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: solid 1px black;border-right: solid 1px black\" width=\"15%\" align=\"left\">$niptapd</td>
								<td  colspan=\"3\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: solid 1px black;border-left: solid 1px black;border-right: solid 1px black\" width=\"50%\" align=\"left\">$jabatantapd</td>";
							if( $notapd%2 == 1){
							$cRet .="<td  colspan=\"2\" width=\"10%\" align=\"left\" style=\"border-right:none\"></td>
								<td  colspan=\"2\" width=\"10%\" align=\"center\" style=\"border-left:none\">$no</td>
								</tr>";
							}else{
							$cRet .="<td  colspan=\"2\" width=\"10%\" align=\"center\" style=\"border-right:none\">$no</td>
								<td  colspan=\"2\" width=\"10%\" align=\"left\" style=\"border-left:none\"></td>
								</tr>";
							}
						
					   }
			$cRet .= " </table>";
			return $cRet;
			
					
		}


		private function _get_all_pemantauan_skpd_query()
	    {
	    	$this->db->select('kd_skpd,nm_skpd,sum(susun) as pagu, sum(ubah) as pagu_ubah');
	        $this->db->from('anggarankegiatan');
			
			
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
			$this->db->group_by("kd_skpd"); 
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
	 
	    function get_all_pemantauan_skpd()
	    {
			$this->_get_all_pemantauan_skpd_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_pemantauan_skpd()
	    {
	        $this->_get_all_pemantauan_skpd_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_pemantauan_skpd()
	    {
	        $this->db->select('kd_skpd,nm_skpd,sum(susun) as pagu, sum(ubah) as pagu_ubah');
			$this->db->from('anggarankegiatan');
			$this->db->group_by('kd_skpd');
	        return $this->db->count_all_results();
	    }


        private function _get_all_pemantauan_detail_query($skpd)
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
	 
	    function get_all_pemantauan_detail($skpd)
	    {
	        $query = $this->db->query("CALL getPemantauan('".$skpd."')");
	        return $query->result();
        }
        
        function get_pemantauan_detail_kegiatan($skpd,$kegiatan)
	    {
	        $query = $this->db->query("CALL getPemantauanKegiatan('".$skpd."','".$kegiatan."')");
	        return $query->result();
		}
		
		function get_pemantauan_header_kegiatan($skpd,$kegiatan)
	    {
			
			$html = '';
			$sql = 'SELECT * FROM anggarankegiatan a WHERE a.kd_kegiatan = "1.01.1.01.01.00.01.01" and a.kd_skpd = "1.01.01.00" GROUP BY a.kd_kegiatan;';
			$this->db->close();
			$query = $this->db->query($sql)->result();
			foreach ($query as $value) {
				$html .= '<tr class="unread">
							<td class="" width="1%">
								<div class="checkbox checkbox-single checkbox-success">
									<input type="checkbox" checked>
									<label></label>
								</div>
							</td>
							<td width="19%" style="align:left;">Urusan Pemerintahan</td>
							<td width="80%" style="align:left;">'.$value->kd_urusan.' - '.$value->nm_urusan.'</td>
						</tr>
						<tr class="unread">
							<td class="" width="1%">
								<div class="checkbox checkbox-single checkbox-success">
									<input type="checkbox" checked>
									<label></label>
								</div>
							</td>
							<td width="19%" style="align:left;">Organisasi</td>
							<td width="80%" style="align:left;">'.$value->kd_skpd.' - '.$value->nm_skpd.'</td>
						</tr>

						<tr class="unread">
							<td class="" width="1%">
								<div class="checkbox checkbox-single checkbox-success">
									<input type="checkbox" checked>
									<label></label>
								</div>
							</td>
							<td width="19%" style="align:left;">Program</td>
							<td width="80%" style="align:left;">'.$value->kd_program.' - '.$value->nm_program.'</td>
						</tr>

						<tr class="unread">
							<td class="" width="1%">
								<div class="checkbox checkbox-single checkbox-success">
									<input type="checkbox" checked>
									<label></label>
								</div>
							</td>
							<td width="19%" style="align:left;">Kegiatan</td>
							<td width="80%" style="align:left;">'.$value->kd_kegiatan.' - '.$value->nm_kegiatan.'</td>
						</tr>

						<tr class="unread">
							<td class="" width="1%">
								<div class="checkbox checkbox-single checkbox-success">
									<input type="checkbox" checked>
									<label></label>
								</div>
							</td>
							<td width="19%" style="align:left;">Waktu Pelaksanaan</td>
							<td width="80%" style="align:left;">'.$value->waktu_giat.'</td>
						</tr>
						<tr class="unread">
							<td class="" width="1%">
								<div class="checkbox checkbox-single checkbox-success">
									<input type="checkbox" checked>
									<label></label>
								</div>
							</td>
							<td width="19%" style="align:left;">Lokasi Kegiatan</td>
							<td width="80%" style="align:left;">'.$value->lokasi.'</td>
						</tr>
						<tr class="unread">
							<td class="" width="1%">
								<div class="checkbox checkbox-single checkbox-success">
									<input type="checkbox" checked>
									<label></label>
								</div>
							</td>
							<td width="19%" style="align:left;">Sumber Dana</td>
							<td width="80%" style="align:left;">'.$value->nm_sumberdana.'</td>
						</tr>
						';
			}
			
	        return $html;
	    }

		function get_target_kegiatan($skpd,$kegiatan)
	    {
			$html = '';
			$sql = "SELECT * FROM (SELECT  kd_kegiatan,kd_rek5 as kode,nm_rek5 as uraian, 0 as no,'' as tvolume,'' as tvolume_ubah, '' as satuan1, '' as satuan_ubah1, '' as harga1,'' as harga_ubah1,
					Nilai as total, Nilai_ubah as total_ubah, Nilai as tot_rek, Nilai_ubah as tot_rek_ubah
					FROM trdrka where kd_kegiatan = '".$kegiatan."' 
					union all 
					SELECT kd_kegiatan,kd_rek5 as kode,uraian, no_po as no,
					tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah,
					(SELECT Nilai FROM trdrka WHERE kd_kegiatan = '".$kegiatan."') AS tot_rek,
  					(SELECT Nilai_ubah FROM trdrka WHERE kd_kegiatan = '".$kegiatan."') AS tot_rek_ubah FROM trdpo
					where kd_kegiatan = '".$kegiatan."') a
					order by kode, no";
			
			$this->db->close();
			
			$query = $this->db->query($sql)->result();
			
			foreach ($query as $value) {
				
				$no = $value->no;
				

				if($no == 0){
					$uraian = '<b>'.$value->uraian.'</b>';
					$button = '';
				}else{
					$uraian = $value->uraian;
					$button = '<button class="btn btn-xs  btn-primary">Edit</button>';
				}	
				$total = number_format($value->total,2,",",".");
				$total_ubah = number_format($value->total_ubah,2,",",".");
				$persen_murni = number_format(($value->total/$value->tot_rek)*100,2,",",".");
				$persen_ubah = number_format(($value->total_ubah/$value->tot_rek_ubah)*100,2,",",".");


				$html .= '<tr>
				<td style="width:60%">'.$uraian.'</td>
				<td style="width:10%">'.$total.'</td>
				<td style="width:10%">'.$value->tvolume.' '.$value->satuan1.'</td>
				<td style="width:10%">'.$persen_murni.'</td>
				<td style="width:10%">'.$button.'</td>
				
			</tr>';
			}
			
	        return $html;
	    }
	 
	    function count_filtered_pemantauan_detail($skpd)
	    {
	        $query = $this->db->query("CALL getPemantauan('1.03.01.00')");
	        return $query->num_rows();
	    }
	 
	    public function count_all_pemantauan_detail($skpd)
	    {
	        $this->db->query("CALL getPemantauan('1.03.01.00')");
	        return $this->db->count_all_results();
	    }


	    // skpd

		public function add_skpd($data){
			
			$this->db->insert($this->table_skpd, $data);
			return true;
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