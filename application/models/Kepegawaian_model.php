<?php
	class Kepegawaian_model extends CI_Model{
		function __construct()
		{
			parent::__construct();
			$this->Simpeg =  $this->load->database('simpeg', TRUE);
		}
		
		public function getPNSGender(){
			$q 		= "SELECT count(*) as Jumlah
							FROM pns
						GROUP BY kjkel ORDER BY kjkel";
			$query 	= $this->Simpeg->query($q);
			$result = $query->result();
			
			return $result = $query->result_array();
		}
		
		public function getPNSPegawai(){
			$q 		= "SELECT count(*) as Jumlah
							FROM pns
						GROUP BY kjpeg ORDER BY kjpeg";
			$query 	= $this->Simpeg->query($q);
			$result = $query->result();
			
			return $result = $query->result_array();
		}
		
		public function getPNSJabatan(){
			$q 		= "SELECT count(*) as Jumlah
							FROM jabatan
						GROUP BY jnsjab ORDER BY jnsjab";
			$query 	= $this->Simpeg->query($q);
			$result = $query->result();
			
			return $result = $query->result_array();
		}
		
	}
?>	