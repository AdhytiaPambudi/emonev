<?php

	class master_model extends CI_Model{

		function __construct()

		{

			parent::__construct();

			$this->DB1 				=  $this->load->database('simakdakom1nfo', TRUE);
			$this->DB2 				=  $this->load->database('default', TRUE);
			$this->DB3 				=  $this->load->database('bappeda', TRUE);
			$this->DB4 				=  $this->load->database('simbada', TRUE);
			$this->DB5 				=  $this->load->database('rpjmd', TRUE);
			$this->schoolmap 		=  $this->load->database('schoolmap', TRUE);
			$this->sik_dinkes 		=  $this->load->database('sik_dinkes', TRUE);
			$this->blp 				=  $this->load->database('blp', TRUE);
			$this->esakip 			=  $this->load->database('esakip', TRUE);
			$this->simekbang 		=  $this->load->database('simekbang', TRUE);
			$this->simpeg 			=  $this->load->database('simpeg', TRUE);
			$this->biaya_pu 		=  $this->load->database('biaya_pu', TRUE);
			$this->biaya_standar 	=  $this->load->database('biaya_standar', TRUE);
			$this->biaya_bahan_upah =  $this->load->database('biaya_bahan_upah', TRUE);
			$this->sirup_simakda 	=  $this->load->database('sirup_simakda', TRUE);
			$this->bps 				=  $this->load->database('bps', TRUE);
			$this->pbb 				=  $this->load->database('pbb', TRUE);
			$this->pendapatan 		=  $this->load->database('pendapatan', TRUE);
			$this->perizinan		=  $this->load->database('perizinan', TRUE);
			$this->pdam				=  $this->load->database('pdam', TRUE);
		}

		public function save_log_get_data($data) {

			
			$q = "SELECT * FROM opds WHERE plot = '".$data['opd']."'";
			$query = $this->DB2->query($q);
			$result = $query->result();
			$data['opd_id'] = $result[0]->id; 

			$this->DB2->insert('log_tarik_data', $data);
			return $data['last_execute'];
		}

		public function kategori_biaya_pu($data) {
			$query = $this->biaya_pu->where(['nama'=>$data['nama']])->from("kategori");
			$count = $query->count_all_results();
			if($count<1){
				$this->biaya_pu->insert('kategori', $data);
			}
			else{
				$this->biaya_pu->where('nama', $data['nama']);
				$this->biaya_pu->update('kategori', $data);
			}

			$q = "SELECT * FROM kategori WHERE nama = '".$data['nama']."'";
			$query = $this->biaya_pu->query($q);
			$result = $query->result();

			return $result[0]->id;
		}

		public function data_biaya_pu($data) {
			$query = $this->biaya_pu->where(['kategori'=>$data['kategori'],'material'=>$data['material']])->from("biaya");
			$count = $query->count_all_results();
			if($count<1){
				$this->biaya_pu->insert('biaya', $data);
			}
			else{
				$this->biaya_pu->where('kategori', $data['kategori']);
				$this->biaya_pu->where('material', $data['material']);
				$this->biaya_pu->update('biaya', $data);
			}

			return true;
		}

		public function data_biaya_standar($data) {
			$query = $this->biaya_standar->where(['parent'=>$data['parent'],'type'=>$data['type'],'uraian'=>$data['uraian']])->from("biaya");
			$count = $query->count_all_results();
			if($count<1){
				$this->biaya_standar->insert('biaya', $data);
			}
			else{
				$this->biaya_standar->where('type', $data['type']);
				$this->biaya_standar->where('parent', $data['parent']);
				$this->biaya_standar->where('uraian', $data['uraian']);
				$this->biaya_standar->update('biaya', $data);
			}

			$q = "SELECT * FROM biaya WHERE parent = '".$data['parent']."' AND type = '".$data['type']."' AND uraian = '".$data['uraian']."'";
			$query = $this->biaya_standar->query($q);
			$result = $query->result();

			return $result[0]->id;
		}

		public function data_biaya_bahan_upah($data) {
			/*$query = $this->biaya_bahan_upah->where(['parent'=>$data['parent'],'type'=>$data['type'],'uraian'=>$data['uraian']])->from("biaya");
			$count = $query->count_all_results();
			if($count<1){
				$this->biaya_bahan_upah->insert('biaya', $data);
			}
			else{
				$this->biaya_bahan_upah->where('type', $data['type']);
				$this->biaya_bahan_upah->where('parent', $data['parent']);
				$this->biaya_bahan_upah->where('uraian', $data['uraian']);
				$this->biaya_bahan_upah->update('biaya', $data);
			}

			$q = "SELECT * FROM biaya WHERE parent = '".$data['parent']."' AND type = '".$data['type']."' AND uraian = '".$data['uraian']."'";
			$query = $this->biaya_bahan_upah->query($q);
			$result = $query->result();*/
			//return $result[0]->id;
			$this->biaya_bahan_upah->insert('biaya', $data);
			return $this->biaya_bahan_upah->insert_id();
		}

		public function save_as_new($tableName, $data, $opd = '') {
			switch ($opd) {
				case 'simakda':
					$this->DB1->insert($tableName, $data);
					break;
			
				case 'bappeda':
					$this->DB3->insert($tableName, $data);
					break;
			
				case 'simbada':
					$this->DB4->insert($tableName, $data);
					break;
			
				case 'rpjmd':
					$this->DB5->insert($tableName, $data);
					break;
			
				case 'schoolmap':
					$this->schoolmap->insert($tableName, $data);
					break;
			
				case 'sik_dinkes':
					$this->sik_dinkes->insert($tableName, $data);
					break;
			
				case 'blp':
					$this->blp->insert($tableName, $data);
					break;
			
				case 'esakip':
					$this->esakip->insert($tableName, $data);
					break;
			
				case 'simekbang':
					$this->simekbang->insert($tableName, $data);
					break;
			
				case 'simpeg':
					$this->simpeg->insert($tableName, $data);
					break;
			
				case 'biaya_pu':
					$this->biaya_pu->insert($tableName, $data);
					break;
			
				case 'sirup_simakda':
					$this->sirup_simakda->insert($tableName, $data);
					break;
			
				case 'pbb':
					$this->pbb->insert($tableName, $data);
					break;
				
				case 'pendapatan':
					$this->pendapatan->insert($tableName, $data);
					break;

				case 'perizinan':
					$this->perizinan->insert($tableName, $data);
					break;

				case 'pdam':
					$this->pdam->insert($tableName, $data);
					break;

				default:
					$this->DB1->insert($tableName, $data);
					break;
			}
		}

		public function save_as_update($tableName, $data, $opd = '') {
			switch ($opd) {
				case 'simakda':
					$this->DB1->where(key($data), reset($data));
					$this->DB1->update($tableName, $data);
					break;
			
				case 'bappeda':
					$this->DB3->where(key($data), reset($data));
					$this->DB3->update($tableName, $data);
					break;
			
				case 'simbada':
					$this->DB4->where(key($data), reset($data));
					$this->DB4->update($tableName, $data);
					break;
			
				case 'rpjmd':
					$this->DB5->where(key($data), reset($data));
					$this->DB5->update($tableName, $data);
					break;
			
				case 'schoolmap':
					$this->schoolmap->where(key($data), reset($data));
					$this->schoolmap->update($tableName, $data);
					break;
			
				case 'sik_dinkes':
					$this->sik_dinkes->where(key($data), reset($data));
					$this->sik_dinkes->update($tableName, $data);
					break;
			
				case 'blp':
					$this->blp->where(key($data), reset($data));
					$this->blp->update($tableName, $data);
					break;
			
				case 'esakip':
					$this->esakip->where(key($data), reset($data));
					$this->esakip->update($tableName, $data);
					break;
			
				case 'simekbang':
					$this->simekbang->where(key($data), reset($data));
					$this->simekbang->update($tableName, $data);
					break;

				case 'simpeg':
					$this->simpeg->where(key($data), reset($data));
					$this->simpeg->update($tableName, $data);
					break;

				case 'biaya_pu':
					$this->biaya_pu->where(key($data), reset($data));
					$this->biaya_pu->update($tableName, $data);
					break;

				case 'sirup_simakda':
					$this->sirup_simakda->where(key($data), reset($data));
					$this->sirup_simakda->update($tableName, $data);
					break;

				case 'pbb':
					$this->pbb->where(key($data), reset($data));
					$this->pbb->update($tableName, $data);
					break;

				case 'pendapatan':
					$this->pendapatan->where(key($data), reset($data));
					$this->pendapatan->update($tableName, $data);
					break;

				case 'perizinan':
					$this->perizinan->where(key($data), reset($data));
					$this->perizinan->update($tableName, $data);
					break;

				case 'pdam':
					$this->pdam->where(key($data), reset($data));
					$this->pdam->update($tableName, $data);
					break;

				default:
					$this->DB1->where(key($data), reset($data));
					$this->DB1->update($tableName, $data);
					break;
			}
		}

		

		public function getCountAll($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
	 		foreach ($tableName as $row ){
				$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
				if ($i < ($jml-1))
					$q .= " UNION ";
				$i++;
			}

			return $result = $this->DB1->query($q)->result_array();
		}

		public function getCountAllBappeda($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->DB3->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllPBB($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $this->pbb->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllPendapatan($tableName) {
			$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
	 			foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->pendapatan->query($q)->result_array();
			}
			else{
				return[];
			}
		}

		public function getCountAllPerizinan($tableName) {
			$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
	 			foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->perizinan->query($q)->result_array();
			}
			else{
				return[];
			}
		}

		public function getCountAllPDAM($tableName) {
			$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
	 			foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->pdam->query($q)->result_array();
			}
			else{
				return[];
			}
		}

		public function getCountAllSimbada($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->DB4->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllSchoolmap($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->schoolmap->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllSikDinkes($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->sik_dinkes->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllBlp($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->blp->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllEsakip($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->esakip->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllSimekbang($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->simekbang->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllRPJMD($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->DB5->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllSimpeg($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->simpeg->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllBiayaPu($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->biaya_pu->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllBiayaStandar($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->biaya_standar->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllBiayaBahanUpah($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->biaya_bahan_upah->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getCountAllSirupSimakda($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->sirup_simakda->query($q)->result_array();
			}
			else{
				return [];
			}
		}

		public function getcount($tableName, $arr='') {
			if (!empty($arr)) $this->DB1->where($arr);
			$query = $this->DB1->get($tableName);
			return $query->num_rows();
		}

		public function getcountbiayapu($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->biaya_pu->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->biaya_pu->where($arr);
			$query = $this->biaya_pu->get($tableName);
			return $query->num_rows();
		}

		public function getcountbappeda($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->DB3->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->DB3->where($arr);
			$query = $this->DB3->get($tableName);
			return $query->num_rows();
		}

		public function getcountsimbada($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->DB4->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->DB4->where($arr);
			$query = $this->DB4->get($tableName);
			return $query->num_rows();
		}

		public function getcountrpjmd($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->DB5->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->DB5->where($arr);
			$query = $this->DB5->get($tableName);
			return $query->num_rows();
		}

		public function getcountschoolmap($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->schoolmap->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->schoolmap->where($arr);
			$query = $this->schoolmap->get($tableName);
			return $query->num_rows();
		}

		public function getcountsikdinkes($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->sik_dinkes->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}

			if (!empty($arr)) $this->sik_dinkes->where($arr);
			$query = $this->sik_dinkes->get($tableName);
			return $query->num_rows();
		}

		public function getcountblp($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->blp->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}

			if (!empty($arr)) $this->blp->where($arr);
			$query = $this->blp->get($tableName);
			return $query->num_rows();
		}

		public function getcountesakip($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->esakip->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}

			if (!empty($arr)) $this->esakip->where($arr);
			$query = $this->esakip->get($tableName);
			return $query->num_rows();
		}

		public function getcountsimekbang($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->simekbang->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}

			if (!empty($arr)) $this->simekbang->where($arr);
			$query = $this->simekbang->get($tableName);
			return $query->num_rows();
		}

		public function getcountsimpeg($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->simpeg->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->simpeg->where($arr);
			$query = $this->simpeg->get($tableName);
			return $query->num_rows();
		}

		public function getcountpbb($tableName, $arrs = '') {
			$this->pbb->where($arrs);
			$query = $this->pbb->get($tableName);
			return $query->num_rows();
		}

		
		public function getcountpendapatan($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->pendapatan->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->pendapatan->where($arr);
			$query = $this->pendapatan->get($tableName);
			return $query->num_rows();
		}

		public function getcountperizinan($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->perizinan->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->perizinan->where($arr);
			$query = $this->perizinan->get($tableName);
			return $query->num_rows();
		}

		public function getcountpdam($tableName, $arrs = '') {
			$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
			$query = $this->pdam->query($q);
			$result = $query->result();
			$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
			if(empty($result)){
				$arr = array(key($arrs) => reset($arrs));
			}
			if (!empty($arr)) $this->pdam->where($arr);
			$query = $this->pdam->get($tableName);
			return $query->num_rows();
		}

		public function getcountsirupsimakda($tableName, $arrs = '') {
			switch ($tableName) {
				case 'sirup_detail':
					return 0;
					break;
				case 'sirup_detail_lokasi':
					return 0;
					break;
				
				default:
					$q = "SHOW KEYS FROM `".$tableName."` WHERE Key_name = 'PRIMARY'";
					$query = $this->sirup_simakda->query($q);
					$result = $query->result();
					$arr = array($result[0]->Column_name => $arrs[$result[0]->Column_name]);
					if(empty($result)){
						$arr = array(key($arrs) => reset($arrs));
					}

					if (!empty($arr)) $this->sirup_simakda->where($arr);
					$query = $this->sirup_simakda->get($tableName);
					return $query->num_rows();
					break;
			}
		}

		public function getExeTime($opd) {
			$q = "SELECT `table_name`, MAX(`last_execute`) AS last_execute FROM `log_tarik_data` WHERE opd='".$opd."' GROUP BY table_name";
			$query = $this->DB2->query($q);

			//return $this->DB2->last_query(); exit();
			$dataExe = array();
			$result = $query->result_array();
			for ($i=0; $i < count($result); $i++) { 
				$dataExe[$result[$i]['table_name']] = $result[$i]['last_execute'];
			}

			return $dataExe;
		}

		public function getCountAllRangeSimakda($listTable, $startDate = '2018-01-01', $endDate = '2018-12-31') {

			foreach ($listTable as $nmTable) {
				// define date field range
				if ($nmTable == 'tr_tetap') {
					$fieldDateName = 'tgl_tetap';
				}
				else if ($nmTable == 'tr_terima') {
					$fieldDateName = 'tgl_terima';
				}
				else if ($nmTable == 'trhkasin_pkd' || $nmTable == 'trhkasin_ppkd') {
					$fieldDateName = 'tgl_sts';
				}
				else if ($nmTable == 'trdkasin_pkd' || $nmTable == 'trdkasin_ppkd' || $nmTable == 'trdinlain_ppkd' || $nmTable == 'trdtagih' || $nmTable == 'trdspp' || $nmTable == 'trdtransout' || $nmTable == 'trdinlain' || $nmTable == 'trdtransout_bos' || $nmTable == 'trdinlain_bos' || $nmTable == 'trdju_pkd' || $nmTable == 'trdju_pkd_bos') {
					$fieldDateName = ''; //tdk ada tgl
				}
				else if ($nmTable == 'trhinlain_ppkd' || $nmTable == 'trhtagih' || $nmTable == 'trhinlain' || $nmTable == 'trhoutlain' || $nmTable == 'trhinlain_bos' || $nmTable == 'trhoutlain_bos') {
					$fieldDateName = 'tgl_bukti';
				}
				else if ($nmTable == 'trhspp') {
					$fieldDateName = 'tgl_spp';
				}
				else if ($nmTable == 'trhspm') {
					$fieldDateName = 'tgl_spm';
				}
				else if ($nmTable == 'trhsp2d') {
					$fieldDateName = 'tgl_sp2d';
				}
				else if ($nmTable == 'trhuji' || $nmTable == 'trduji') {
					$fieldDateName = 'tgl_uji';
				}
				else if ($nmTable == 'trhtransout' || $nmTable == 'trhtransout_bos') {
					$fieldDateName = 'tgl_kas';
				}
				else if ($nmTable == 'trhju_pkd' || $nmTable == 'trhju_pkd_bos') {
					$fieldDateName = 'tgl_voucher';
				}

				$this->DB1->select('count(*) as count');
				if ($fieldDateName!=''){
					$this->DB1->where(''.$fieldDateName.' >=', $startDate);
		            $this->DB1->where(''.$fieldDateName.' <=', $endDate);
	            }
				$this->DB1->from($nmTable);
	        	$query = $this->DB1->get();
	        	//echo $this->DB1->last_query(); exit();
	        	$result = $query->result();
	        	$datacount[] = $result[0]->count;
			}
			return $datacount;
		}

		public function getCountAllRangeBappeda($listTable, $startDate = '2018-01-01', $endDate = '2018-12-31') {
			return [];
		}
		
		public function getCountAllBps($tableName) {
        	$jml 		= count($tableName); 
			$i			= 0;
			$q			= "";
			if($jml>0){
		 		foreach ($tableName as $row ){
					$q .= "SELECT '".$row."' as nmTbl, count(*) as jml FROM ".$row;
					if ($i < ($jml-1))
						$q .= " UNION ";
					$i++;
				}
				return $result = $this->bps->query($q)->result_array();
			}
			else{
				return [];
			}
		}
	}

?>