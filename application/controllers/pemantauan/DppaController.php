<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DppaController extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('master/DaerahModel', 'daerah_model');
			$this->load->model('setting/DatabaseModel', 'db_model');
            $this->load->model('master/MasterModel', 'master_model');
            $this->load->model('pemantauan/PemantauanModel', 'pantau_model');
            $this->load->model('PublicModel', 'public_model');
		}


        public function dppa22($skpd = '')
		{
			$margins = $_GET['margins'];
			$orientation = $_GET['orientation'];
			$mg = $this->PublicModel->getMargins($margins);

            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);
			$body = $this->pantau_model->dppa22_pdf($skpd);
			$filename = 'DPPA_22_'.$skpdFile.'.pdf';
			$this->public_model->_mpdf('',$header,$body,$mg['L'],$mg['R'],$mg['T'],$mg['B'],10,$orientation,1,true,'A4',$filename);
        }

        public function dppa22_excel($skpd = '')
		{
            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);
			$data['table'] = $this->pantau_model->dppa22_pdf($skpd);
            $data['filename'] = 'DPPA_22_'.$skpdFile.'.xls';
            $this->load->view('laporan/excel', $data);
			// $this->public_model->_mpdf('',$header,$body,10,10,10,10,10,'L',1,true,'A4',$filename);
        }
        
        public function dppa221($skpd = '',$kegiatan = '')
		{
			$margins = $_GET['margins'];
			$orientation = $_GET['orientation'];
			$mg = $this->PublicModel->getMargins($margins);
			
            $header = '';
            $kegFile = str_replace('.', '_', $kegiatan);
			$body = $this->pantau_model->dppa221_pdf($skpd,$kegiatan);
			$filename = 'DPPA_221_'.$kegFile.'.pdf';
			$this->public_model->_mpdf('',$header,$body,$mg['L'],$mg['R'],$mg['T'],$mg['B'],10,$orientation,1,true,'A4',$filename);
        }

        public function dppa221_excel($skpd = '',$kegiatan = '')
		{
            $header = '';
            $kegFile = str_replace('.', '_', $kegiatan);
			$data['table'] = $this->pantau_model->dppa221_pdf($skpd,$kegiatan);
			$data['filename'] = 'DPPA_221_'.$kegFile.'.xls';
            $this->load->view('laporan/excel', $data);
        }
        

		public function index(){
			$data['view'] = 'dpa/dppaView';
			$this->load->view('template/layout', $data);
        }
        
        public function detail(){
            $skpd = $_GET['skpd'];
			$this->db->where('kd_skpd',$skpd);
			$data['skpd'] = $this->db->get('viewprogkegskpd')->row();
			$data['view'] = 'pemantauan/detailPemantauanView';
			$this->load->view('template/layout', $data);
        }
        
        public function detail_kegiatan(){
            $skpd = $_GET['skpd'];
            $kegiatan = $_GET['kegiatan'];
			$this->db->where('kd_skpd',$skpd);
            $data['skpd'] = $this->db->get('viewprogkegskpd')->row();
            $data['kegiatan'] = $kegiatan;
			$data['view'] = 'pemantauan/detailPemantauanKegiatanView';
			$this->load->view('template/layout', $data);
		}

		public function index_pk_bidang(){
			$skpd = $_GET['skpd'];
			$this->db->where('kd_skpd',$skpd);
			$data['skpd'] = $this->db->get('viewprogkegskpd')->row();
			$data['view'] = 'master/programKegiatanBidangView';
			$this->load->view('template/layout', $data);
		}
		public function index_pk_program(){
			$skpd = $_GET['skpd'];
			$bidang = $_GET['bidang'];
			$this->db->where('kd_skpd',$skpd);
			$data['skpd'] = $this->db->get('viewprogkegskpd')->row();

			$this->db->where('kd_urusan',$bidang);
			$data['bidang'] = $this->db->get('ms_urusan')->row();
			
			$data['view'] = 'master/programKegiatanProgramView';
			$this->load->view('template/layout', $data);
		}
		public function index_pk_kegiatan(){
			$skpd = $_GET['skpd'];
			$bidang = $_GET['bidang'];
			$program = $_GET['program'];
			$this->db->where('kd_skpd',$skpd);
			$data['skpd'] = $this->db->get('viewprogkegskpd')->row();

			$this->db->where('kd_urusan',$bidang);
			$data['bidang'] = $this->db->get('ms_urusan')->row();
			
			$this->db->select('kd_program,nm_program');
			$this->db->where('kd_program',$program);
			$this->db->group_by('kd_program');
			$data['program'] = $this->db->get('trskpd')->row();


			$data['view'] = 'master/programKegiatanKegiatanView';
			$this->load->view('template/layout', $data);
		}



		

		public function get_fungsi() {
			$list = $this->master_model->get_all_fungsi();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->kd_fungsi;
	            $row[] = $field->nm_fungsi;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_fungsi.'" data-nama="'.$field->nm_fungsi.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_fungsi.'" data-nama="'.$field->nm_fungsi.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_fungsi(),
	            "recordsFiltered" => $this->master_model->count_filtered_fungsi(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function get_urusan() {
			$list = $this->master_model->get_all_urusan();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->kd_urusan;
	            $row[] = $field->nm_urusan;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_urusan.'" data-nama="'.$field->nm_urusan.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_urusan.'" data-nama="'.$field->nm_urusan.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_urusan(),
	            "recordsFiltered" => $this->master_model->count_filtered_urusan(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}


		public function get_skpd() {
			$list = $this->master_model->get_all_skpd();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->kd_skpd;
	            $row[] = $field->nm_skpd;
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_skpd(),
	            "recordsFiltered" => $this->master_model->count_filtered_skpd(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function get_pemantauan_skpd() {

			$list = $this->pantau_model->get_all_pemantauan_skpd();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = '<a href="'.base_url("pemantauan-detail?skpd=".$field->kd_skpd).'" class="klikSKPD" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'">'.$field->kd_skpd.'</a>';
	            $row[] = '<a href="'.base_url("pemantauan-detail?skpd=".$field->kd_skpd).'" class="klikSKPD" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'">'.$field->nm_skpd.'</a>';
	            $row[] = number_format($field->pagu,2,",",".");
	            $row[] = number_format($field->pagu_ubah,2,",",".");
	            $row[] = '<center>
		 	    	<a href="'.base_url("pemantauan-detail?skpd=".$field->kd_skpd).'" class="btn btn-primary btn-flat btn-xs edit" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-search" aria-hidden="true" data-toggle="tooltip" title="Pemantauan"></i></a>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->pantau_model->count_all_pemantauan_skpd(),
	            "recordsFiltered" => $this->pantau_model->count_filtered_pemantauan_skpd(),
	            "data" => $data,
	        );
	        echo json_encode($output);
        }
        

        public function get_pemantauan_detail() {
            $skpd = $_GET['skpd'];
            $list = $this->pantau_model->get_all_pemantauan_detail($skpd);
            
            $data = array();
            $html = '';
	        foreach ($list as $field) {
                $jns = '';
                $bold = '';
                $link = '#';
                if($field->jns == 'K'){
                    $jns='<font color="red">* </font>';
                    $link=base_url('pemantauan-detail-kegiatan?skpd='.$skpd.'&kegiatan='.$field->kode);

                }else{
                    $bold = 'font-weight:bold;';
                }
	            $no++;
	            $html .= '<tr><td><p style="font-size:7pt;">'.$no.'</p></td>';
	            $html .= '<td><a style="font-size:7pt;'.$bold.'" href="'.$link.'" class="klikSKPD" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">'.$jns.$field->kode.'-'.$field->uraian.'</a></td>';
	            $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><center>
		 	    	<a href="'.base_url("pemantauan-detail?skpd=".$field->kd_skpd).'" class="btn btn-primary btn-flat btn-xs" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-search" aria-hidden="true" data-toggle="tooltip" title="Pemantauan"></i></a>
		 	    	</center></td></tr>';
	            $data[] = $row;
	        }
            $data['dataTable'] = $html;
	        echo json_encode($data);
		}

        public function get_pemantauan_detail_kegiatan() {
            
            $skpd = $_GET['skpd'];
            $kegiatan = $_GET['kegiatan'];

            $list = $this->pantau_model->get_pemantauan_detail_kegiatan($skpd,$kegiatan);
            
            $data = array();
            $html = '';
	        foreach ($list as $field) {
                $jns = '';
                $bold = '';
                $link = '#';
                if($field->jns == 'K'){
                    $jns='<font color="red">* </font>';
                    $link=base_url('pemantauan-detail-kegiatan?skpd='.$skpd.'&kegiatan='.$field->kode);

                }else{
                    $bold = 'font-weight:bold;';
                }
	            $no++;
	            $html .= '<tr><td><p style="font-size:7pt;">'.$no.'</p></td>';
	            $html .= '<td><a style="font-size:7pt;'.$bold.'" href="'.$link.'" class="klikSKPD" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">'.$jns.$field->kode.'-'.$field->uraian.'</a></td>';
	            $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><center>
                     <button class="btn btn-primary btn-flat btn-xs openModalTarget" data-skpd="'.$skpd.'" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">Target</button>
                     <button class="btn btn-primary btn-flat btn-xs openModalRealiasi" data-skpd="'.$skpd.'" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">Realisasi</button>
		 	    	</center></td></tr>';
	            $data[] = $row;
	        }
            $data['dataTable'] = $html;
	        echo json_encode($data);
		}


		public function get_target_kegiatan() {
			
            
            $skpd = $_POST['skpd'];
            $kegiatan = $_POST['id'];

            $list = $this->pantau_model->get_pemantauan_detail_kegiatan($skpd,$kegiatan);
			
			
            $data = array();
            $html = '';
	        foreach ($list as $field) {
                $jns = '';
                $bold = '';
                $link = '#';
                if($field->jns == 'K'){
                    $jns='<font color="red">* </font>';
                    $link=base_url('pemantauan-detail-kegiatan?skpd='.$skpd.'&kegiatan='.$field->kode);

                }else{
                    $bold = 'font-weight:bold;';
                }
	            $no++;
	            $html .= '<tr><td><p style="font-size:7pt;">'.$no.'</p></td>';
	            $html .= '<td><a style="font-size:7pt;'.$bold.'" href="'.$link.'" class="klikSKPD" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'">'.$jns.$field->kode.'-'.$field->uraian.'</a></td>';
	            $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">'.number_format($field->pagu_ubah,2,",",".").'</p></td>';
                $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><p style="font-size:7pt;">10%</p></td>';
	            $html .= '<td><center>
                     <a href="#" class="btn btn-primary btn-flat btn-xs openModalTarget" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'"><i class="fa fa-search" aria-hidden="true" data-toggle="tooltip" title="Pemantauan"></i>Target</a>
                     <a href="#" class="btn btn-primary btn-flat btn-xs openModalRealiasi" data-id="'.$field->kode.'" data-nama="'.$field->uraian.'"><i class="fa fa-search" aria-hidden="true" data-toggle="tooltip" title="Pemantauan"></i>Realisasi</a>
		 	    	</center></td></tr>';
			}
			$data['dataHeader'] = $this->pantau_model->get_pemantauan_header_kegiatan($skpd,$kegiatan);
            $data['dataTable'] = $html;
	        echo json_encode($data);
		}

		public function get_pk_bidang($skpd) {
			$list = $this->master_model->get_all_pk_bidang($skpd);
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = '<a href="'.base_url("program-kegiatan/program?skpd=".$skpd.'&bidang='.$field->kd_urusan).'" class="" data-id="'.$field->kd_urusan.'" data-skpd="'.$skpd.'" data-nama="'.$field->nm_urusan.'">'.$field->kd_urusan.'</a>';
	            $row[] = '<a href="'.base_url("program-kegiatan/program?skpd=".$skpd.'&bidang='.$field->kd_urusan).'" class="" data-id="'.$field->kd_urusan.'" data-skpd="'.$skpd.'" data-nama="'.$field->nm_urusan.'">'.$field->nm_urusan.'</a>';
	            $row[] = number_format($field->pagu,2,",",".");
	            $row[] = number_format($field->pagu_ubah,2,",",".");
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_pk_bidang($skpd),
	            "recordsFiltered" => $this->master_model->count_filtered_pk_bidang($skpd),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}


		public function get_pk_program($skpd,$bidang) {
			$list = $this->master_model->get_all_pk_program($skpd,$bidang);
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = '<a href="'.base_url("program-kegiatan/kegiatan?skpd=".$skpd."&bidang=".$bidang."&program=".$field->kd_program).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-id="'.$field->kd_program.'" data-nama="'.$field->nm_program.'">'.$field->kd_program.'</a>';
	            $row[] = '<a href="'.base_url("program-kegiatan/kegiatan?skpd=".$skpd."&bidang=".$bidang."&program=".$field->kd_program).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-id="'.$field->kd_program.'" data-nama="'.$field->nm_program.'">'.$field->nm_program.'</a>';
	            $row[] = number_format($field->pagu,2,",",".");
	            $row[] = number_format($field->pagu_ubah,2,",",".");
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_skpd.'" data-nama="'.$field->nm_skpd.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_pk_program($skpd,$bidang),
	            "recordsFiltered" => $this->master_model->count_filtered_pk_program($skpd,$bidang),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}


		public function get_pk_kegiatan($skpd,$bidang,$program) {
			
			$list = $this->master_model->get_all_pk_kegiatan($skpd,$bidang,$program);
	        $data = array();
			$no = $_POST['start'];
			
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = '<a href="'.base_url("program-kegiatan/indikator?skpd=".$skpd."&bidang=".$bidang."&program=".$program."&kegiatan=".$field->kd_kegiatan).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-program="'.$program.'" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_program.'">'.$field->kd_kegiatan.'</a>';
	            $row[] = '<a href="'.base_url("program-kegiatan/indikator?skpd=".$skpd."&bidang=".$bidang."&program=".$program."&kegiatan=".$field->kd_kegiatan).'" data-skpd="'.$skpd.'" data-bidang="'.$bidang.'" data-program="'.$program.'" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_program.'">'.$field->nm_kegiatan.'</a>';
	            $row[] = number_format($field->pagu,2,",",".");
	            $row[] = number_format($field->pagu_ubah,2,",",".");
	            $row[] = '<center>
		 	    	<a href="#" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_kegiatan.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
		 	    	<a href="#" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->kd_kegiatan.'" data-nama="'.$field->nm_kegiatan.'" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->master_model->count_all_pk_kegiatan($skpd,$bidang,$program),
	            "recordsFiltered" => $this->master_model->count_filtered_pk_kegiatan($skpd,$bidang,$program),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}




		public function get_last_update_database()
		{
			
			$redaksi = 'Terakhir Update : ';

			$res['fungsi'] = $redaksi.$this->db_model->get_last_update_fungsi();
			$res['urusan'] = $redaksi.$this->db_model->get_last_update_urusan();
			$res['skpd'] = $redaksi.$this->db_model->get_last_update_skpd();
			$res['program'] = $redaksi.$this->db_model->get_last_update_program();
			$res['kegiatan'] = $redaksi.$this->db_model->get_last_update_kegiatan();
			$res['sumberdana'] = $redaksi.$this->db_model->get_last_update_sumberdana();
			
			
			echo json_encode($res);

		}

		public function check_data_database()
		{
			$dtbs = $this->input->post('db');
			$tbl = $this->input->post('tbl');
			if($tbl=='skpd'){
				$res = $this->db_model->check_data_skpd($dtbs);
			}else if($tbl=='fungsi'){
				$res = $this->db_model->check_data_fungsi($dtbs);
			}else if($tbl=='urusan'){
				$res = $this->db_model->check_data_urusan($dtbs);
			}else if($tbl=='sumberdana'){
				$res = $this->db_model->check_data_sumberdana($dtbs);
			}
			
			echo json_encode($res);

		}



		public function import_data_database()
		{
			$dtbs = $this->input->post('db');
			$tbl = $this->input->post('tbl');
			if($tbl=='skpd'){
				$res = $this->db_model->import_data_skpd($dtbs);
			}else if($tbl=='fungsi'){
				$res = $this->db_model->import_data_fungsi($dtbs);
			}else if($tbl=='urusan'){
				$res = $this->db_model->import_data_urusan($dtbs);
			}else if($tbl=='sumberdana'){
				$res = $this->db_model->import_data_sumberdana($dtbs);
			}
			
			echo json_encode($res);

		}


		public function backup()
		{

			$this->load->dbutil();
			$this->load->helper('file');
			
			$config = array(
				'format'	=> 'zip',
				'filename'	=> 'database.sql'
			);
			
			$backup =& $this->dbutil->backup($config);
			
			$save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			$res = write_file($save, $backup);
			echo $res;

		}

		public function download()
		{
			$this->load->dbutil();
			$this->load->helper('file');
			
			$config = array(
				'format'	=> 'zip',
				'filename'	=> 'database.sql'
			);
			
			$backup =& $this->dbutil->backup($config);
			
			$save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			$res = write_file($save, $backup);
			echo $res;

		}

		public function restore()
		{
			$this->load->dbutil();
			$this->load->helper('file');
			
			$config = array(
				'format'	=> 'zip',
				'filename'	=> 'database.sql'
			);
			
			$backup =& $this->dbutil->backup($config);
			
			$save = FCPATH.'database/backup-'.date("Y-m-d H-i-s").'-db.zip';
			
			$res = write_file($save, $backup);
			echo $res;

		}

		public function get_combo_prov(){
			echo $this->daerah_model->getprov();	
		}

		public function get_prov() {
			$list = $this->daerah_model->get_all_prov();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->id_daerah;
	            $row[] = $field->nm_daerah;
	            $row[] = $field->ket;
	            $row[] = '<center>
		 	    	<a href="#" data-toggle="tooltip" title="Edit" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" data-toggle="tooltip" title="Hapus" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'"><i class="lnr lnr-trash"></i></a></td>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->daerah_model->count_all_prov(),
	            "recordsFiltered" => $this->daerah_model->count_filtered_prov(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function add_prov(){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Provinsi', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Provinsi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/provView';
					$this->load->view('template/layout', $data);
				}
				else{

					$data = array(
						'id_daerah' 		=> $this->input->post('id_daerah'),
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
						'clevel' 			=> 1,
						'hd_daerah' 		=> "",
						'hd' 				=> "H",
						'ket' 				=> "Provinsi"
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->add_daerah($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url('data-provinsi'));
					}
						
				}
			}
			
		}

		public function edit_prov($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Provinsi', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Provinsi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/provView';
					$this->load->view('template/layout', $data);
				}
				else{
					$data = array(
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->edit_daerah($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url('data-provinsi'));
					}
				}
			}
			else{
				$data['view'] = 'master/provView';
				$this->load->view('template/layout', $data);
			}
		}

		public function del_prov($id = 0){
			$this->db->delete('ms_daerah', array('id_daerah' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url('data-provinsi'));
		}

		
		// kabupaten kota
		public function index_kab(){
			$data['view'] = 'master/kabKotaView';
			$this->load->view('template/layout', $data);
		}

		public function get_kab() {
			$list = $this->daerah_model->get_all_kab();

	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $field) {
	            $no++;
	            $row = array();
	            $row[] = $no;
	            $row[] = $field->id_daerah;
	            $row[] = $field->nm_daerah;
	            $row[] = $field->ket;
	            $row[] = '<center>
		 	    	<a href="#" data-toggle="tooltip" title="Edit" class="btn btn-info btn-flat btn-xs edit" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'" data-header="'.$field->hd_daerah.'"><i class="lnr lnr-pencil"></i></a>
		 	    	<a href="#" data-toggle="tooltip" title="Hapus" class="dropdown-item btn btn-danger btn-flat btn-xs tombol-hapus" data-id="'.$field->id_daerah.'" data-nama="'.$field->nm_daerah.'"><i class="lnr lnr-trash"></i></a>
		 	    	</center>';
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->daerah_model->count_all_kab(),
	            "recordsFiltered" => $this->daerah_model->count_filtered_kab(),
	            "data" => $data,
	        );
	        echo json_encode($output);
		}

		public function add_kab(){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Kabupaten/Kota', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Kabupaten/Kota', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/kabKotaView';
					$this->load->view('template/layout', $data);
				}
				else{

					$data = array(
						'id_daerah' 		=> $this->input->post('id_daerah'),
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
						'clevel' 			=> 2,
						'hd_daerah' 		=> $this->input->post('prov'),
						'hd' 				=> "D",
						'ket' 				=> "Kabupaten/Kota"
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->add_daerah($data);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Ditambahkan!');
						redirect(base_url('data-kabupaten-kota'));
					}
						
				}
			}
			
		}

		public function edit_kab($id = 0){
			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('id_daerah', 'Id Kabupaten/Kota', 'trim|required');
				$this->form_validation->set_rules('nm_daerah', 'Nama Kabupaten/Kota', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'master/kabKotaView';
					$this->load->view('template/layout', $data);
				}
				else{
					$data = array(
						'nm_daerah' 		=> $this->input->post('nm_daerah'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->daerah_model->edit_daerah($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Data Berhasil Diupdate!');
						redirect(base_url('data-kabupaten-kota'));
					}
				}
			}
			else{
				$data['view'] = 'master/kabKotaView';
				$this->load->view('template/layout', $data);
			}
		}

		public function del_kab($id = 0){
			$this->db->delete('ms_daerah', array('id_daerah' => $id));
			$this->session->set_flashdata('msg', 'Data Berhasil Dihapus!');
			redirect(base_url('data-kabupaten-kota'));
		}

		public function getmax(){
			 $header = $this->input->post('kode');			
			 $level = $this->input->post('lvl');
			 $max_id=$this->daerah_model->get_max_daerah($level,$header);
			 echo $max_id;
		}



	}


?>