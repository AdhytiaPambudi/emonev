<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class LaporanUbahController extends CI_Controller {

		public function __construct(){
			parent::__construct();
            $this->load->model('laporan/LaporanPerubahanModel', 'lap_mod');
            $this->load->model('PublicModel', 'public_model');
        }
        
        public function rekapitulasi_pdf($skpd = '',$tw='')
		{
            $margins = $_GET['margins'];
            $orientation = $_GET['orientation'];
            $mg = $this->PublicModel->getMargins($margins);

            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);
			$body = $this->lap_mod->rck_pdf($skpd,$tw);
			$filename = 'Rekapitulasi_Capaian_Kinerja_TW'.$tw.'_'.$skpdFile.'.pdf';
			$this->public_model->_mpdf('',$header,$body,$mg['L'],$mg['R'],$mg['T'],$mg['B'],10,$orientation,1,true,'A4',$filename);
        }

        public function rekapitulasi_excel($skpd = '',$tw='')
		{
            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);
			$data['table'] = $this->lap_mod->rck_pdf($skpd,$tw);
			$data['filename'] = 'Rekapitulasi_Capaian_Kinerja_Perubahan_TW'.$tw.'_'.$skpdFile.'.xls';
            $this->load->view('laporan/excel', $data);
        }
        

        public function rekapitulasi(){
			$data['view'] = 'laporanPerubahan/rekapitulasiView';
			$this->load->view('template/layout', $data);
        }

        public function rekapitulasi_kab(){
            $data['view'] = 'laporanPerubahan/rekapitulasiKabView';
            $this->load->view('template/layout', $data);
        }

        public function rekapitulasi_kab_pdf($tw='')
        {
            $margins = $_GET['margins'];
            $orientation = $_GET['orientation'];
            $mg = $this->PublicModel->getMargins($margins);

            $sd = $_GET['sd'];
            if($sd == '' || $sd == 'null'  || $sd == 'all'){
                $body = $this->lap_mod->rck_kab_all_pdf($tw);
            }else{
                $body = $this->lap_mod->rck_kab_pdf($tw);
            }

            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);
            // $body = $this->lap_mod->rck_kab_pdf($tw);
            $filename = 'Rekapitulasi_Capaian_Kinerja_Per_SD_TW'.$tw.'_'.$skpdFile.'.pdf';
            $this->public_model->_mpdf('',$header,$body,$mg['L'],$mg['R'],$mg['T'],$mg['B'],10,$orientation,1,true,'A4',$filename);
        }

        public function rekapitulasi_kab_excel($tw='')
        {
            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);

             $sd = $_GET['sd'];
            if($sd == '' || $sd == 'null'  || $sd == 'all'){
                $data['table'] = $this->lap_mod->rck_kab_all_pdf($tw);
            }else{
                $data['table'] = $this->lap_mod->rck_kab_pdf($tw);
            }

            $data['filename'] = 'Rekapitulasi_Capaian_Kinerja_KAB_TW'.$tw.'_'.$skpdFile.'.xls';
            $this->load->view('laporan/excel', $data);
        }

        public function realisasi_detail_kegiatan(){
			$data['view'] = 'laporanPerubahan/realisasiDetailKegiatanView';
			$this->load->view('template/layout', $data);
        }

        public function realisasi_detail_kegiatan_pdf($skpd = '',$keg = '',$tw='')
		{
            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);
            $kegFile = str_replace('.', '_', $keg);
             $margins = $_GET['margins'];
            $orientation = $_GET['orientation'];
            $mg = $this->PublicModel->getMargins($margins);

            if($keg == 'all' || $keg == 'null' || $keg == ''){
                $body = $this->lap_mod->realckk_all_pdf($skpd,$keg,$tw);
            }else{
                $body = $this->lap_mod->realckk_pdf($skpd,$keg,$tw);
            }
            
			// $body = $this->lap_mod->realckk_pdf($skpd,$keg,$tw);
			$filename = 'Realisasi_Capaian_Kinerja_TW'.$tw.'_'.$skpdFile.'_'.$kegFile.'.pdf';
			$this->public_model->_mpdf('',$header,$body,$mg['L'],$mg['R'],$mg['T'],$mg['B'],10,$orientation,1,true,'A4',$filename);
        }

        public function realisasi_detail_kegiatan_excel($skpd = '',$keg = '',$tw='')
		{
            $header = '';
            $skpdFile = str_replace('.', '_', $skpd);
            $kegFile = str_replace('.', '_', $keg);
            $data['table'] = $this->lap_mod->realckk_pdf($skpd,$keg,$tw);
            $data['filename'] = 'Realisasi_Capaian_Kinerja_Perubahan_TW'.$tw.'_'.$skpdFile.'_'.$kegFile.'.xls';
            $this->load->view('laporan/excel', $data);
        }
        



	}


?>