<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class FrontController extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('FrontModel', 'fmodel');
			$this->load->model('pemantauan/MonitoringModel', 'monitor_model');
		}

		public function index(){	
			$this->load->view('dashboardMonevView');
		}

		public function get_combo_skpd() {
            $list = $this->PublicModel->get_combo_skpd_all_akses();
	        echo $list;
		}
		
		public function get_chart_keu() {
			$skpd = $_POST['skpd'];
			$tahun = $_POST['thn'];

			$config =  $this->db->query('SELECT * FROM ms_config where tahun_anggaran = '.$tahun.' limit 1')->row();
			$stsAng = $config->sts_anggaran;
			
				
				$sql = 'SELECT
				`a`.`kd_skpd`     AS `kd_skpd`,
				`a`.`nm_skpd`     AS `nm_skpd`,
				SUM(`a`.`Nilai`)  AS `susun`,
				SUM(`a`.`Nilai_ubah`) AS `ubah`,
				  (SELECT sum(keuangan1) from trdreal tr1 where mid(tr1.kd_kegiatan,6,10) = a.kd_skpd and tahun_anggaran = a.tahun_anggaran) as tw1,
				  (SELECT sum(keuangan2) from trdreal tr2 where mid(tr2.kd_kegiatan,6,10) = a.kd_skpd and tahun_anggaran = a.tahun_anggaran) as tw2,
				  (SELECT sum(keuangan3) from trdreal tr3 where mid(tr3.kd_kegiatan,6,10) = a.kd_skpd and tahun_anggaran = a.tahun_anggaran) as tw3,
				  (SELECT sum(keuangan4) from trdreal tr4 where mid(tr4.kd_kegiatan,6,10) = a.kd_skpd and tahun_anggaran = a.tahun_anggaran) as tw4
			  FROM (`trdrka` `a`
				 JOIN `trskpd` `b`
				   ON ((`a`.`kd_kegiatan` = `b`.`kd_kegiatan` AND a.tahun_anggaran = b.tahun_anggaran)))
			  WHERE b.tahun_anggaran = '.$tahun.' AND a.kd_skpd = "'.$skpd.'"
			  GROUP BY `a`.`kd_skpd`;';
			


			$res_nilai = $this->db->query($sql)->row();
			if($stsAng == 'Murni'){
				$target[0] = (int)$res_nilai->susun*0.25;
				$target[1] = (int)$res_nilai->susun*0.5;
				$target[2] = (int)$res_nilai->susun*0.75;
				$target[3] = (int)$res_nilai->susun;
			}else{
				$target[0] = (int)$res_nilai->ubah*0.25;
				$target[1] = (int)$res_nilai->ubah*0.5;
				$target[2] = (int)$res_nilai->ubah*0.75;
				$target[3] = (int)$res_nilai->ubah;
			}

			$real[0] = (int)$res_nilai->tw1;
			$real[1] = (int)$res_nilai->tw2;
			$real[2] = (int)$res_nilai->tw3;
			$real[3] = (int)$res_nilai->tw4;

			$nama[0] = "TRIWULAN 1";
			$nama[1] = "TRIWULAN 2";
			$nama[2] = "TRIWULAN 3";
			$nama[3] = "TRIWULAN 4";

			$data['nama'] 			= $nama;
			$data['target'] 		= $target;
			$data['real'] 			= $real;
			

			
	        echo json_encode($data);
		}

		public function get_table_fisik() {
			$skpd = $_POST['skpd'];
			$tahun = $_POST['thn'];
			$where = '';
			if($skpd <>'all'){
				$where = " AND a.kd_skpd = '".$skpd."' ";
			}
			$sql = "SELECT l.*,a.kd_skpd, a.nm_skpd, a.nm_kegiatan,r.bentuk,r.kontraktor,r.no_kontrak,r.distrik,r.kampung,r.koordinat FROM trdreal_lamp l
left join anggarankegiatan a on a.ta = l.tahun_anggaran AND a.kd_kegiatan = l.kd_kegiatan
left join trdreal r on l.kd_kegiatan = r.kd_kegiatan and l.tahun_anggaran = r.tahun_anggaran and l.kd_rek = r.kd_rekening and l.no_po = r.no_rinci
where `status` = 1 and l.tahun_anggaran = $tahun $where
GROUP BY l.kd_kegiatan, l.tahun_anggaran;
			
			";
			$html = '';
			$data = $this->db->query($sql)->result();
			if(count($data) == 0){
				$html.='<tr><td colspan="5" align="center">Belum Ada Data</td></tr>';
			}else{
				$no = 0;
				foreach ($data as $value) {
					$no++;
					$button = '<a href="#" class="dropdown-item btn btn-success btn-flat btn-xs showDokumentasi" data-keg="'.$value->kd_kegiatan.'" data-tahun="'.$tahun.'"><i class="fa fa-file-image-o"></i></a>';	
					$html.='<tr>
								<td style="width:5%;text-align:center;">'.$no.'</td>
								<td style="width:35%;text-align:left;">'.$value->nm_skpd.'</td>
								<td style="width:35%;text-align:left;">'.$value->nm_kegiatan.'</td>
								<td style="width:20%;text-align:left;">'.$value->distrik.'-'.$value->kampung.'</td>';
					$html .='<td style="width:5%;text-align:center;">'.$button.'</td>';
					$html.=	'</tr>';
				}
			}
			
			
			echo $html;
		}

		public function form_daftar(){	
			
			$data['menu_aktif'] 	= 'FORM DAFTAR';
			$this->template->views('portal/formDaftarView', $data);
		}


		public function berita_pengumuman()
		{
			$html = '';
			$res = $this->fmodel->get(4);

			foreach ($res as $value) {	
				
			$html .= '<div class="col-lg-6 col-sm-6"> 
            <div class="news-content wow fadeInLeft" data-wow-duration="1s" data-wow-delay="600ms"> 
              <div class="entry-header">  
                <div class="blog-image">
                  <a href="'.base_url('berita-pengumuman/detail/'.$value["id_artikel"]).'"><img alt="" src="'.base_url().'assets/front/images/blog/post3.jpg" class="img-responsive"></a>
                </div>              
                <div class="post-date">
                  <h2>'.$value["tgl"].'<span>'.$value["bln"].'</span></h2>
                </div>              
              </div>
              <div class="entry-content"> 
                <h3 class="entry-title">
                  <a href="'.base_url('berita-pengumuman/detail/'.$value["id_artikel"]).'">'.$value["judul"].'</a>
                </h3>             
                <ul class="entry-meta">
                <li><a href="#"><i class="fa fa-user"></i> By: '.$value["penulis"].' <span>/</span></a></li>
                <li><a href="#"><i class="fa fa-comments"></i> '.$value["Komentar"].' Komentar</a></li>
                </ul> 
                
              </div>
            </div>
          </div>';
			}
          echo($html);
		}

		public function get_rinci_kegiatan(){
			
			$thn  = $_GET['thn'];
			$keg = $_GET['keg'];


			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			$filelTemp 		= str_replace($searchdok, $replace, $dokumentasi);
			$kegTemp 		= str_replace($search, $replace, $keg);
			
			
			$data = $this->monitor_model->modalDokumentasi($thn,$keg);
			
			$no =1;
			foreach ($data as $value) {
				$rekTemp 		= str_replace($search, $replace, $value['kd_rek']);
				$poTemp 		= str_replace($search, $replace, $value['no_po']);
				$folderFile		= 'assets/dokumentasi/'.$thn.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';
				$result['tbldokumentasi'] = '
                                    <tr>
                                    	<td rowspan="2" style="text-align:center;">'.$no++.'</td>
                                        <td style="text-align:center;">'.$value["uraian"].'</td>
                                        <td style="text-align:center;">'.$value["distrik"].'</td>
                                        <td style="text-align:center;">'.$value["kampung"].'</td>
                                        <td style="text-align:center;">'.$value["koordinat"].'</td>
                                        <td style="text-align:center;">'.$value["no_kontrak"].'</td>
                                        <td style="text-align:center;">'.$value["kontraktor"].'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="text-align:center;">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 "><a target="_blank" href="'.base_url().$folderFile.$value["file"].'" class="gambar-dok">
                                      <img src="'.base_url().$folderFile.$value["file"].'" alt="gambar">
                                    </a></div></td>
                                    </tr>';

			}

			 

                                        
				

			echo json_encode($result);
		}






	}

?>	