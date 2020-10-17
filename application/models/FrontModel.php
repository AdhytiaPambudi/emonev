<?php
	class FrontModel extends CI_Model{

		
		public function get($limit)
		{
			$sql1 = 'SELECT id_artikel,(SELECT COUNT(id_komentar) FROM komentar where id_artikel = a.id_artikel) as komentar,judul,penulis,isi,tanggal,DAY(tanggal) as tgl,MONTHNAME(tanggal) as bln FROM artikel a ORDER BY tanggal desc LIMIT '.$limit;

			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			return $res1;
		}

		public function get_detail($id)
		{
			$sql1 = 'SELECT id_artikel,(SELECT COUNT(id_komentar) FROM komentar where id_artikel = a.id_artikel) as komentar,judul,penulis,isi,tanggal,DAY(tanggal) as tgl,MONTHNAME(tanggal) as bln FROM artikel a  where id_artikel = '.$id.' ORDER BY tanggal desc';

			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			return $res1;
		}

		public function get_arsip()
		{
			$sql1 = "SELECT CONCAT(bln,'-',thn) as judul FROM(SELECT id_artikel,(SELECT COUNT(id_komentar) FROM komentar where id_artikel = a.id_artikel) as komentar,
				judul,penulis,isi,tanggal,DAY(tanggal) as tgl,MONTHNAME(tanggal) as bln, YEAR(tanggal) as thn FROM artikel a ORDER BY tanggal desc) a
				GROUP BY CONCAT(bln,'-',thn) ORDER BY thn desc;";

			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			return $res1;
		}

		public function pie_umum($id_daerah='',$thn='')
		{
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrWasUmumAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrWasUmum('.$thn.',"'.$id_daerah.'",3);';
			}

			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			return $res1;
		}

		public function pie_umum2($id_daerah='',$thn='',$id_par1 = '')
		{
			if($id_daerah == 'nasional'){
				$sql2 = 'CALL getTrWasUmumAll2('.$thn.',5,"'.$id_par1.'");';
			}else{
				$sql2 = 'CALL getTrWasUmum2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';
			}
			
			
			$res2 = $this->db->query($sql2)->result_array();
			$this->db->close();
			return $res2;
		}

		public function pie_teknis($id_daerah='',$thn='')
		{
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrWasTeknisAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrWasTeknis('.$thn.',"'.$id_daerah.'",3);';
			}
			$res1 = $this->db->query($sql1)->result_array();
			return $res1;
		}


		public function getChartUmum($id_daerah,$thn)
		{
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrWasUmumAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrWasUmum('.$thn.',"'.$id_daerah.'",3);';
			}
			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			return $res1;

		}

		public function getChartTeknis($id_daerah,$thn)
		{
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrWasTeknisAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrWasTeknis('.$thn.',"'.$id_daerah.'",3);';
			}
			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			return $res1;

		}

		public function getChartBinwas($id_daerah,$thn)
		{
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrBinwasAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrBinwas('.$thn.',"'.$id_daerah.'",3);';
			}
			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			return $res1;

		}


		public function getChartDetail($was,$kode,$id_daerah,$thn)
		{

			if($id_daerah == 'nasional'){
				if ($was == 'binwas') {
					$sql2 = 'CALL getTrBinwasAll2('.$thn.',5,"'.$kode.'");';
				}elseif ($was == 'teknis') {
					$sql2 = 'CALL getTrWasTeknisAll2('.$thn.',5,"'.$kode.'");';
				}else{
					$sql2 = 'CALL getTrWasUmumAll2('.$thn.',5,"'.$kode.'");';
				}
			}else{
				if ($was == 'binwas') {
					$sql2 = 'CALL getTrBinwas2('.$thn.',"'.$id_daerah.'",5,"'.$kode.'");';
				}elseif ($was == 'teknis') {
					$sql2 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",5,"'.$kode.'");';
				}else{
					$sql2 = 'CALL getTrWasUmum2('.$thn.',"'.$id_daerah.'",5,"'.$kode.'");';
				}
			}


			$res1 = $this->db->query($sql2)->result_array();
			$this->db->close();
			return $res1;

		}

		public function getChartSubDetail($was,$kode,$id_daerah,$thn)
		{

			if($id_daerah == 'nasional'){
				if ($was == 'binwas') {
					$sql2 = 'CALL getTrBinwasAll2('.$thn.',7,"'.$kode.'");';
				}elseif ($was == 'teknis') {
					$sql2 = 'CALL getTrWasTeknisAll2('.$thn.',7,"'.$kode.'");';
				}else{
					$sql2 = 'CALL getTrWasUmumAll2('.$thn.',7,"'.$kode.'");';
				}
			}else{
				if ($was == 'binwas') {
					$sql2 = 'CALL getTrBinwas2('.$thn.',"'.$id_daerah.'",7,"'.$kode.'");';
				}elseif ($was == 'teknis') {
					$sql2 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",7,"'.$kode.'");';
				}else{
					$sql2 = 'CALL getTrWasUmum2('.$thn.',"'.$id_daerah.'",7,"'.$kode.'");';
				}
			}


			$res1 = $this->db->query($sql2)->result_array();
			$this->db->close();
			return $res1;

		}

		public function get_umum($id_daerah='',$thn = '')
		{
			if ($id_daerah == '' || $id_daerah == 1) {
				$html = '<center><b>--SILAHKAN PILIH DAERAH--</b></center>';
			}else{
			
			$html = '<div class="treeview-animated w-100 border mx-4 my-4">';
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrWasUmumAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrWasUmum('.$thn.',"'.$id_daerah.'",3);';
			}
			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			$jmlRes1 = count($res1);
			if (count($res1)>0) {
				$html .='<ul class="treeview-animated-list mb-3">';
				$html .= '<li>
							<div class="treeview-animated-element">
								<table border = "0" width = "100%" style="margin:0px;padding:0px;">
									<tr style = "border-bottom:0px solid black;font-weight:bold;">
										<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;">&nbsp;PARAMETER</td>
										<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;text-align:center;">Nilai</td>
										<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;text-align:center;">Bobot (%)</td>
									</tr>
								</table> 
							
							</div>
						</li>';

				foreach ($res1 as $value1) {
					$id_par1 = $value1['id_parameter'];
					$nm_par1 = $value1['nm_parameter'];
					$thn1 	 = $value1['tahun'];

					$nilai1  = $value1['nilai'];
					$bobot1  = $value1['bobot'];
					if ($bobot1<50) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}elseif ($bobot1<100) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}else{
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}
					if ($nilai1<1) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}elseif ($nilai1<2) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}else{
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}


					$drh1  = $value1['id_daerah'];
					if($id_daerah == 'nasional'){
						$sql2 = 'CALL getTrWasUmumAll2('.$thn.',5,"'.$id_par1.'");';
					}else{
						$sql2 = 'CALL getTrWasUmum2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';
					}
					
					
					$res2 = $this->db->query($sql2)->result_array();
					$this->db->close();

					$jmlRes2 = count($res2);
					// tentukan ada sub nya / tidak
					if (count($res2) == 0) {
						
						$html .= '<li>
									<div class="treeview-animated-element">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</div>
								</li>';
					}else{
						$html .= '<li class="treeview-animated-items">';
						$html .= '<a class="closed">
									
									<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table border = "0" width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;"><i class="fa fa-angle-right"></i> '.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</a>';
						$html .= '<ul class="nested active">';
						foreach ($res2 as $value2) {
							$id_par2 = $value2['id_parameter'];
							$nm_par2 = $value2['nm_parameter'];
							$thn2 	 = $value2['tahun'];
							$nilai2  = $value2['nilai'];
							$bobot2  = $value2['bobot'];
							if ($bobot2<50) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}elseif ($bobot2<100) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}else{
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}
							if ($nilai2<1) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}elseif ($nilai2<2) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}else{
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}

							$drh2  	= $value2['id_daerah'];
							if($id_daerah == 'nasional'){
								$sql3 = 'CALL getTrWasUmumAll2('.$thn.',7,"'.$id_par2.'");';
							}else{
								$sql3 = 'CALL getTrWasUmum2('.$thn.',"'.$id_daerah.'",7,"'.$id_par2.'");';
							}
							$res3 = $this->db->query($sql3)->result_array();
							$this->db->close();
							$jmlRes3 = count($res3);
							if (count($res3) == 0) {
								
								$html .= '<li>
											<div class="treeview-animated-element">
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="78.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par2.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai2.'</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot2.'</td>
													</tr>
												</table> 
											</div>
										</li>';			
							}else{
								
								$html .= '<li class="treeview-animated-items">';
								$html .= '<a class="closed">  
											<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
												<tr>
													<td width="78.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
														<table border = "0" width = "100%"  style="margin:0px;">
															<tr>
																<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
																<i class="fa fa-angle-right"></i> '.$id_par2.' .</td>
																<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
															</tr>
														</table>
													</td>
													<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai2.'</td>
													<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot2.'</td>
												</tr>
											</table> 

											
										</a>';
								$html .= '<ul class="nested active">';
								foreach ($res3 as $value3) {
									$id_par3 = $value3['id_parameter'];
									$nm_par3 = $value3['nm_parameter'];
									$thn3 	 = $value3['tahun'];
									$nilai3  = $value3['nilai'];
									$bobot3  = $value3['bobot'];

									if ($bobot3<50) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}elseif ($bobot3<100) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}else{
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}
									if ($nilai3<1) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}elseif ($nilai3<2) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}else{
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}

									$drh3  	 = $value3['id_daerah'];

									$html .= '<li><div class="treeview-animated-element"> 
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="78%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par3.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par3.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai3.'</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot3.'</td>
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
			$html .= '<script src="'.base_url().'assets/vendor/mdb/js/mdb.js"></script><script>$(document).ready(function() { $(".treeview-animated").mdbTreeview();$("[data-toggle=\'tooltip\']").tooltip(); });</script>';
		}
			return $html;
		}

		public function get_teknis($id_daerah='',$thn = '')
		{

			if ($id_daerah == '' || $id_daerah == 1) {
				$html = '<center><b>--SILAHKAN PILIH DAERAH--</b></center>';
			}else{
			
			$html = '<div class="treeview-animated w-100 border mx-4 my-4">';

			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrWasTeknisAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrWasTeknis('.$thn.',"'.$id_daerah.'",3);';
			}
			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			$jmlRes1 = count($res1);
			if (count($res1)>0) {
				$html .='<ul class="treeview-animated-list mb-3">';
				$html .= '<li>
							<div class="treeview-animated-element">
								<table border = "0" width = "100%" style="margin:0px;padding:0px;">
									<tr style = "border-bottom:0px solid black;font-weight:bold;">
										<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;">&nbsp;PARAMETER</td>
										<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;text-align:center;">Nilai</td>
										<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;text-align:center;">Bobot (%)</td>
									</tr>
								</table> 
							
							</div>
						</li>';

				foreach ($res1 as $value1) {
					$id_par1 = $value1['id_parameter'];
					$nm_par1 = $value1['nm_parameter'];
					$thn1 	 = $value1['tahun'];

					$nilai1  = $value1['nilai'];
					$bobot1  = $value1['bobot'];
					if ($bobot1<50) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}elseif ($bobot1<100) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}else{
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}
					if ($nilai1<1) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}elseif ($nilai1<2) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}else{
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}


					$drh1  = $value1['id_daerah'];
					if($id_daerah == 'nasional'){
						$sql2 = 'CALL getTrWasTeknisAll2('.$thn.',5,"'.$id_par1.'");';
					}else{
						$sql2 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';
					}
					
					$res2 = $this->db->query($sql2)->result_array();
					$this->db->close();

					$jmlRes2 = count($res2);
					// tentukan ada sub nya / tidak
					if (count($res2) == 0) {
						
						$html .= '<li>
									<div class="treeview-animated-element">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</div>
								</li>';
					}else{
						$html .= '<li class="treeview-animated-items">';
						$html .= '<a class="closed">
									
									<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table border = "0" width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;"><i class="fa fa-angle-right"></i> '.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</a>';
						$html .= '<ul class="nested active">';
						foreach ($res2 as $value2) {
							$id_par2 = $value2['id_parameter'];
							$nm_par2 = $value2['nm_parameter'];
							$thn2 	 = $value2['tahun'];
							$nilai2  = $value2['nilai'];
							$bobot2  = $value2['bobot'];
							if ($bobot2<50) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}elseif ($bobot2<100) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}else{
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}
							if ($nilai2<1) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}elseif ($nilai2<2) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}else{
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}

							$drh2  	= $value2['id_daerah'];
							if($id_daerah == 'nasional'){
								$sql3 = 'CALL getTrWasTeknisAll2('.$thn.',7,"'.$id_par2.'");';
							}else{
								$sql3 = 'CALL getTrWasTeknis2('.$thn.',"'.$id_daerah.'",7,"'.$id_par2.'");';
							}
							$res3 = $this->db->query($sql3)->result_array();
							$this->db->close();
							$jmlRes3 = count($res3);
							if (count($res3) == 0) {
								
								$html .= '<li>
											<div class="treeview-animated-element">
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="78.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par2.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai2.'</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot2.'</td>
													</tr>
												</table> 
											</div>
										</li>';			
							}else{
								
								$html .= '<li class="treeview-animated-items">';
								$html .= '<a class="closed">  
											<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
												<tr>
													<td width="78.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
														<table border = "0" width = "100%"  style="margin:0px;">
															<tr>
																<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
																<i class="fa fa-angle-right"></i> '.$id_par2.' .</td>
																<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
															</tr>
														</table>
													</td>
													<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai2.'</td>
													<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot2.'</td>
												</tr>
											</table> 

											
										</a>';
								$html .= '<ul class="nested active">';
								foreach ($res3 as $value3) {
									$id_par3 = $value3['id_parameter'];
									$nm_par3 = $value3['nm_parameter'];
									$thn3 	 = $value3['tahun'];
									$nilai3  = $value3['nilai'];
									$bobot3  = $value3['bobot'];

									if ($bobot3<50) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}elseif ($bobot3<100) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}else{
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}
									if ($nilai3<1) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}elseif ($nilai3<2) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}else{
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}

									$drh3  	 = $value3['id_daerah'];

									$html .= '<li><div class="treeview-animated-element"> 
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="78%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par3.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par3.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai3.'</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot3.'</td>
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
			$html .= '<script src="'.base_url().'assets/vendor/mdb/js/mdb.js"></script><script>$(document).ready(function() { $(".treeview-animated").mdbTreeview();$("[data-toggle=\'tooltip\']").tooltip(); });</script>';
		}
			return $html;
		}

		public function get_binwas($id_daerah='',$thn = '')
		{

			if ($id_daerah == '' || $id_daerah == 1) {
				$html = '<center><b>--SILAHKAN PILIH DAERAH--</b></center>';
			}else{
			
			$html = '<div class="treeview-animated w-100 border mx-4 my-4">';
			if($id_daerah == 'nasional'){
				$sql1 = 'CALL getTrBinwasAll('.$thn.',3);';
			}else{
				$sql1 = 'CALL getTrBinwas('.$thn.',"'.$id_daerah.'",3);';
			}
			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			$jmlRes1 = count($res1);
			if (count($res1)>0) {
				$html .='<ul class="treeview-animated-list mb-3">';
				$html .= '<li>
							<div class="treeview-animated-element">
								<table border = "0" width = "100%" style="margin:0px;padding:0px;">
									<tr style = "border-bottom:0px solid black;font-weight:bold;">
										<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;">&nbsp;PARAMETER</td>
										<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;text-align:center;">Nilai</td>
										<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;text-align:center;">Bobot (%)</td>
									</tr>
								</table> 
							
							</div>
						</li>';

				foreach ($res1 as $value1) {
					$id_par1 = $value1['id_parameter'];
					$nm_par1 = $value1['nm_parameter'];
					$thn1 	 = $value1['tahun'];

					$nilai1  = $value1['nilai'];
					$bobot1  = $value1['bobot'];
					if ($bobot1<50) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}elseif ($bobot1<100) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}else{
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}
					if ($nilai1<1) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}elseif ($nilai1<2) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}else{
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}


					$drh1  = $value1['id_daerah'];
					if($id_daerah == 'nasional'){
						$sql2 = 'CALL getTrBinwasAll2('.$thn.',5,"'.$id_par1.'");';
					}else{
						$sql2 = 'CALL getTrBinwas2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';
					}
					
					$res2 = $this->db->query($sql2)->result_array();
					$this->db->close();

					$jmlRes2 = count($res2);
					// tentukan ada sub nya / tidak
					if (count($res2) == 0) {
						
						$html .= '<li>
									<div class="treeview-animated-element">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</div>
								</li>';
					}else{
						$html .= '<li class="treeview-animated-items">';
						$html .= '<a class="closed">
									
									<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="80%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table border = "0" width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;"><i class="fa fa-angle-right"></i> '.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai1.'</td>
												<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot1.'</td>
											</tr>
										</table> 
									
									</a>';
						$html .= '<ul class="nested active">';
						foreach ($res2 as $value2) {
							$id_par2 = $value2['id_parameter'];
							$nm_par2 = $value2['nm_parameter'];
							$thn2 	 = $value2['tahun'];
							$nilai2  = $value2['nilai'];
							$bobot2  = $value2['bobot'];
							if ($bobot2<50) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}elseif ($bobot2<100) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}else{
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}
							if ($nilai2<1) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}elseif ($nilai2<2) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}else{
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}

							$drh2  	= $value2['id_daerah'];
							if($id_daerah == 'nasional'){
								$sql3 = 'CALL getTrBinwasAll2('.$thn.',7,"'.$id_par2.'");';
							}else{
								$sql3 = 'CALL getTrBinwas2('.$thn.',"'.$id_daerah.'",7,"'.$id_par2.'");';
							}
							$res3 = $this->db->query($sql3)->result_array();
							$this->db->close();
							$jmlRes3 = count($res3);
							if (count($res3) == 0) {
								
								$html .= '<li>
											<div class="treeview-animated-element">
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="78.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par2.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai2.'</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot2.'</td>
													</tr>
												</table> 
											</div>
										</li>';			
							}else{
								
								$html .= '<li class="treeview-animated-items">';
								$html .= '<a class="closed">  
											<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
												<tr>
													<td width="78.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
														<table border = "0" width = "100%"  style="margin:0px;">
															<tr>
																<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
																<i class="fa fa-angle-right"></i> '.$id_par2.' .</td>
																<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
															</tr>
														</table>
													</td>
													<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai2.'</td>
													<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot2.'</td>
												</tr>
											</table> 

											
										</a>';
								$html .= '<ul class="nested active">';
								foreach ($res3 as $value3) {
									$id_par3 = $value3['id_parameter'];
									$nm_par3 = $value3['nm_parameter'];
									$thn3 	 = $value3['tahun'];
									$nilai3  = $value3['nilai'];
									$bobot3  = $value3['bobot'];

									if ($bobot3<50) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}elseif ($bobot3<100) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}else{
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}
									if ($nilai3<1) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}elseif ($nilai3<2) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}else{
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}

									$drh3  	 = $value3['id_daerah'];

									$html .= '<li><div class="treeview-animated-element"> 
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="78%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par3.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par3.'</td>
																</tr>
															</table>
														</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$nilai3.'</td>
														<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$bobot3.'</td>
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
			$html .= '<script src="'.base_url().'assets/vendor/mdb/js/mdb.js"></script><script>$(document).ready(function() { $(".treeview-animated").mdbTreeview();$("[data-toggle=\'tooltip\']").tooltip(); });</script>';
		}
			return $html;
		}


		public function get_info_keuangan($id_daerah='',$thn = '')
		{

			if ($id_daerah == '' || $id_daerah == 1) {
				$html = '<center><b>--SILAHKAN PILIH DAERAH--</b></center>';
			}else{
			
			$html = '<div class="treeview-animated w-100 border mx-4 my-4">
					  ';
			$sql1 = 'CALL getTrInfoKeuangan('.$thn.',"'.$id_daerah.'",3);';

			$res1 = $this->db->query($sql1)->result_array();
			$this->db->close();
			$jmlRes1 = count($res1);
			if (count($res1)>0) {
				$html .='<ul class="treeview-animated-list mb-3">';
				$html .= '<li>
							<div class="treeview-animated-element">
								<table border = "0" width = "100%" style="margin:0px;padding:0px;">
									<tr style = "border-bottom:0px solid black;font-weight:bold;">
										<td width="95%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;">&nbsp;MENU</td>
										<td width="5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;font-weight:bold;text-align:center;">LINK</td>
									</tr>
								</table> 
							
							</div>
						</li>';

				foreach ($res1 as $value1) {
					$id_par1 = $value1['id_parameter'];
					$nm_par1 = $value1['nm_parameter'];
					$thn1 	 = $value1['tahun'];

					$nilai1  = $value1['nilai'];
					$bobot1  = $value1['bobot'];
					if ($bobot1<50) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}elseif ($bobot1<100) {
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}else{
						$bobot1 = "<font color='royalblue'>".$bobot1."</font>";
					}
					if ($nilai1<1) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}elseif ($nilai1<2) {
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}else{
						$nilai1 = "<font color='royalblue'>".$nilai1."</font>";
					}


					$drh1  = $value1['id_daerah'];

					$url1  = $value1['url'];

					if ($url1 <> '' || $url1 <> NULL) {
						$tombol = '<span><i class="fa fa-eye ic-w mx-1 pull-right showModal2" style="padding-top:2px;padding-right:5px;" data-id ="'.$id_par1.'" data-nama = "'.$nm_par1.'" data-nilai ="'.$nilai1.'" data-bobot ="'.$bobot1.'" data-thn ="'.$thn1.'" data-daerah ="'.$drh1.'" data-url ="'.$url1.'" data-toggle="tooltip" title="Lihat"></i></span>';
					}else{
						$tombol = '';
					}

					$sql2 = 'CALL getTrInfoKeuangan2('.$thn.',"'.$id_daerah.'",5,"'.$id_par1.'");';
					
					
					$res2 = $this->db->query($sql2)->result_array();
					$this->db->close();

					$jmlRes2 = count($res2);
					// tentukan ada sub nya / tidak
					if (count($res2) == 0) {
						
						$html .= '<li>
									<div class="treeview-animated-element">
										<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="95%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												</td>
												<td width="5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$tombol.'</td>
											</tr>
										</table> 
									
									</div>
								</li>';
					}else{
						$html .= '<li class="treeview-animated-items">';
						$html .= '<a class="closed">
									
									<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
											<tr>
												<td width="95%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
													<table border = "0" width = "100%"  style="border-bottom:0px;margin:0px;padding:0px;">
														<tr>
															<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;"><i class="fa fa-angle-right"></i> '.$id_par1.' .</td>
															<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par1.'</td>
														</tr>
													</table>
												<td width="5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$tombol.'</td>
												
											</tr>
										</table> 
									
									</a>';
						$html .= '<ul class="nested active">';
						foreach ($res2 as $value2) {
							$id_par2 = $value2['id_parameter'];
							$nm_par2 = $value2['nm_parameter'];
							$thn2 	 = $value2['tahun'];
							$nilai2  = $value2['nilai'];
							$bobot2  = $value2['bobot'];
							if ($bobot2<50) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}elseif ($bobot2<100) {
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}else{
								$bobot2 = "<font color='green'>".$bobot2."</font>";
							}
							if ($nilai2<1) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}elseif ($nilai2<2) {
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}else{
								$nilai2 = "<font color='green'>".$nilai2."</font>";
							}

							$drh2  	= $value2['id_daerah'];
							$url2  = $value2['url'];
							if ($url2 <> '' || $url2 <> NULL) {
								$tombol2 = '<span><i class="fa fa-eye ic-w mx-1 pull-right showModal2" style="padding-top:2px;padding-right:5px;" data-id ="'.$id_par2.'" data-nama = "'.$nm_par2.'" data-nilai ="'.$nilai2.'" data-bobot ="'.$bobot2.'" data-thn ="'.$thn2.'" data-daerah ="'.$drh2.'" data-url ="'.$url2.'" data-toggle="tooltip" title="Lihat"></i></span>';
							}else{
								$tombol2 = '';
							}


							$sql3 = 'CALL getTrInfoKeuangan2('.$thn.',"'.$id_daerah.'",7,"'.$id_par2.'");';
							$res3 = $this->db->query($sql3)->result_array();
							$this->db->close();
							$jmlRes3 = count($res3);
							if (count($res3) == 0) {
								
								$html .= '<li>
											<div class="treeview-animated-element">
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="93.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par2.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
																</tr>
															</table>
														</td>
														<td width="5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$tombol2.'</td>
													</tr>
												</table> 
											</div>
										</li>';			
							}else{
								
								$html .= '<li class="treeview-animated-items">';
								$html .= '<a class="closed">  
											<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
												<tr>
													<td width="93.5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
														<table border = "0" width = "100%"  style="margin:0px;">
															<tr>
																<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
																<i class="fa fa-angle-right"></i> '.$id_par2.' .</td>
																<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par2.'</td>
															</tr>
														</table>
													</td>
													<td width="5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$tombol2.'</td>
													
												</tr>
											</table> 

											
										</a>';
								$html .= '<ul class="nested active">';
								foreach ($res3 as $value3) {
									$id_par3 = $value3['id_parameter'];
									$nm_par3 = $value3['nm_parameter'];
									$thn3 	 = $value3['tahun'];
									$nilai3  = $value3['nilai'];
									$bobot3  = $value3['bobot'];



									if ($bobot3<50) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}elseif ($bobot3<100) {
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}else{
										$bobot3 = "<font color='black'>".$bobot3."</font>";
									}
									if ($nilai3<1) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}elseif ($nilai3<2) {
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}else{
										$nilai3 = "<font color='black'>".$nilai3."</font>";
									}

									$drh3  	 = $value3['id_daerah'];


									$url3  = $value3['url'];
									if ($url3 <> '' || $url3 <> NULL) {
										$tombol3 = '<span><i class="fa fa-eye ic-w mx-1 pull-right showModal2" style="padding-top:2px;padding-right:5px;" data-id ="'.$id_par3.'" data-nama = "'.$nm_par3.'" data-nilai ="'.$nilai3.'" data-bobot ="'.$bobot3.'" data-thn ="'.$thn3.'" data-daerah ="'.$drh3.'" data-url ="'.$url3.'" data-toggle="tooltip" title="Lihat"></i></span>';
									}else{
										$tombol3 = '';
									}

									$html .= '<li><div class="treeview-animated-element"> 
												<table border = "0" width = "100%" style="border-top: 1px dotted black;margin:0px;padding:0px;">
													<tr>
														<td width="93%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">
															<table border = "0" width = "100%"  style="margin:0px;">
																<tr>
																	<td width="10%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$id_par3.' .</td>
																	<td width="90%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;">'.$nm_par3.'</td>
																</tr>
															</table>
														</td>
														
														<td width="5%" style="border-bottom:0px;margin:0px;padding:0px;font-size:10px;text-align:center;">'.$tombol3.'</td>
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
			$html .= '<script src="'.base_url().'assets/vendor/mdb/js/mdb.js"></script><script>$(document).ready(function() { $(".treeview-animated").mdbTreeview();$("[data-toggle=\'tooltip\']").tooltip(); });</script>';
		}
			return $html;
		}		

		

	}

?>