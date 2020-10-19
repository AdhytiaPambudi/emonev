<?php
	class PublicModel extends CI_Model{
		function tgl_indo($tanggal){
			$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);
			
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
		 
			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}

		function tgl_indo_short($tanggal){
			$bulan = array (
				1 =>   'Jan',
				'Feb',
				'Mar',
				'Apr',
				'Mei',
				'Jun',
				'Jul',
				'Agu',
				'Sep',
				'Okt',
				'Nov',
				'Des'
			);
			$pecahkan = explode('-', $tanggal);
			
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
		 
			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}
		
		public function get_combo_skpd()
		{
			$akses = $this->session->userdata('is_admin');
			$ta = $this->session->userdata('thn_ang');
			$sessSKPD = $this->session->userdata('id_skpd');
			
			if($akses == 1){
				$sql = "SELECT * FROM ms_skpd where tahun_anggaran = ".$ta;
			}else if($akses == 3){

				$arrSKPD = $this->skpdByBidang($sessSKPD);
				$sql = "SELECT * FROM ms_skpd where tahun_anggaran = ".$ta." and kd_skpd in (".$arrSKPD.")";
			}else{
				$sql = "SELECT * FROM ms_skpd where tahun_anggaran = ".$ta." and kd_skpd = '".$sessSKPD."'";
			}
			


			$data=$this->db->query($sql);
			$html ='<option value="">Silahakan Pilih OPD</option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_skpd'].'">'.$value['kd_skpd'].' || '.$value['nm_skpd'].'</option>';
			}
			return $html;
		}


		public function get_group_sd()
		{
			$akses = $this->session->userdata('is_admin');
			$ta = $this->session->userdata('thn_ang');
			$sessSKPD = $this->session->userdata('id_skpd');
				
			$sql = "SELECT * FROM ms_group_sd ORDER BY kd_group_sd";
			
			$data=$this->db->query($sql);
			$html ='<option value="all">Keseluruhan</option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_group_sd'].'">'.$value['kd_group_sd'].' || '.$value['nm_group_sd'].'</option>';
			}
			return $html;
		}

		public function getMargins($set="Normal")
		{
			if ($set == "Normal") {
				$data['L'] = 25;
				$data['R'] = 25;
				$data['T'] = 25;
				$data['B'] = 25;
			}else if($set == "Narrow"){
				$data['L'] = 12;
				$data['R'] = 12;
				$data['T'] = 12;
				$data['B'] = 12;
			}else if($set == "Custom"){
				$data['L'] = 10;
				$data['R'] = 10;
				$data['T'] = 10;
				$data['B'] = 10;
			}else{
				$data['L'] = 19;
				$data['R'] = 19;
				$data['T'] = 25;
				$data['B'] = 25;
			}
			return $data;
		}

		public function get_combo_skpd_bidang()
		{

			// $dataSKPD = $this->db->query("SELECT skpd FROM m_bidang where skpd<>''")->result();
			// $where = '';
			// $no = 0;
			// foreach ($dataSKPD as $value) {

			// 	$data = explode(',', $value->skpd);
			// 	for ($i=0; $i <count($data) ; $i++) { 
			// 		if($no == 0){
			// 			$where.= "'".$data[$i]."'";	
			// 		}else{
			// 			$where.= ",'".$data[$i]."'";	
			// 		}
			// 		$no++;
					
			// 	}
			// }
			
			$data= $this->db->query("SELECT kd_skpd,nm_skpd FROM ms_skpd where kd_skpd");
			
			$html ='';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_skpd'].'">'.$value['kd_skpd'].' || '.$value['nm_skpd'].'</option>';
			}
			return $html;
		}


		public function skpdByBidang($skpd='1')
		{
			$dataSKPD = $this->db->query("SELECT skpd FROM m_bidang where id=".$skpd)->result();
				$where = "";
				$no = 0;
				foreach ($dataSKPD as $value) {

					$data = explode(',', $value->skpd);
					for ($i=0; $i <count($data) ; $i++) { 
						if($no == 0){
							$where.= "'".$data[$i]."'";	
						}else{
							$where.= ",'".$data[$i]."'";	
						}
						$no++;
						
					}
				}
				return $where;
		}

		public function get_combo_skpd_all_akses()
		{
			$this->db->select('kd_skpd,nm_skpd');
			$this->db->from('ms_skpd');
			$data=$this->db->get();
			$html ='<option value="">Silahakan Pilih OPD</option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_skpd'].'">'.$value['kd_skpd'].' || '.$value['nm_skpd'].'</option>';
			}
			return $html;
		}

		function get_combo_kegiatan($id)
		{
			
			$sql = "SELECT kd_kegiatan,nm_kegiatan FROM anggarankegiatan WHERE kd_skpd = '".$id."' AND LEFT(kd_rek5,2) = '52' 
			GROUP BY kd_kegiatan,nm_kegiatan ORDER BY kd_kegiatan ASC;";
			$data = $this->db->query($sql);
	
			$html ='<option value="all">Keseluruhan</option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_kegiatan'].'">'.$value['kd_kegiatan'].' || '.$value['nm_kegiatan'].'</option>';
			}
			return $html;
		}

		function terbilang($number) {
   
			$hyphen      = ' ';
			$conjunction = ' ';
			$separator   = ' ';
			$negative    = 'minus ';
			$decimal     = ' koma ';
			$dictionary  = array(0 => 'nol',1 => 'satu',2 => 'dua',3 => 'tiga',4 => 'empat',5 => 'lima',6 => 'enam',7 => 'tujuh',
				8 => 'delapan',9 => 'sembilan',10 => 'sepuluh',11  => 'sebelas',12 => 'dua belas',13 => 'tiga belas',14 => 'empat belas',
				15 => 'lima belas',16 => 'enam belas',17 => 'tujuh belas',18 => 'delapan belas',19 => 'sembilan belas',20 => 'dua puluh',
				30 => 'tiga puluh',40 => 'empat puluh',50 => 'lima puluh',60 => 'enam puluh',70 => 'tujuh puluh',80 => 'delapan puluh',
				90 => 'sembilan puluh',100 => 'ratus',1000 => 'ribu',1000000 => 'juta',1000000000 => 'milyar',1000000000000 => 'triliun',
			);
		   
			if (!is_numeric($number)) {
				return false;
			}
		   
		   // if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
	//            // overflow
	//            trigger_error(
	//                'terbilang only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
	//                E_USER_WARNING
	//            );
	//            return false;
	//        }
		
			if ($number < 0) {
				return $negative . $this->terbilang(abs($number));
			}
		   
			$string = $fraction = null;
		   
			if (strpos($number, '.') !== false) {
				list($number, $fraction) = explode('.', $number);
			}
		   
			switch (true) {
				case $number < 21:
					$string = $dictionary[$number];
					break;
				case $number < 100:
					$tens   = ((int) ($number / 10)) * 10;
					$units  = $number % 10;
					$string = $dictionary[$tens];
					if ($units) {
						$string .= $hyphen . $dictionary[$units];
					}
					break;
				case $number < 1000:
					$hundreds  = $number / 100;
					$remainder = $number % 100;
					$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
					if ($remainder) {
						$string .= $conjunction . $this->terbilang($remainder);
					}
					break;
				default:
					$baseUnit = pow(1000, floor(log($number, 1000)));
					$numBaseUnits = (int) ($number / $baseUnit);
					$remainder = $number % $baseUnit;
					$string = $this->terbilang($numBaseUnits) . ' ' . $dictionary[$baseUnit];
					if ($remainder) {
						$string .= $remainder < 100 ? $conjunction : $separator;
						$string .= $this->terbilang($remainder);
					}
					break;
			}
		   
			if (null !== $fraction && is_numeric($fraction)) {
				$string .= $decimal;
				$words = array();
				foreach (str_split((string) $fraction) as $number) {
					$words[] = $dictionary[$number];
				}
				$string .= implode(' ', $words);
			}
		   
			return $string;
		}

		function right($value, $count){
		return substr($value, ($count*-1));
		}
	
		function left($string, $count){
		return substr($string, 0, $count);
		}

		function convertNominalDatabase($nilai)
		{
			$hilangkanSeparator 		= str_replace('.', '', $nilai);
			$gantiKomaKeTitik			= str_replace(',', '.', $hilangkanSeparator);
			return $gantiKomaKeTitik;
		}

		// M=1000
		// D=500
		// C=100
		// L=50
		// X=10
		// V=5
		// I=1

		function KonDecRomawi($angka)
		{
			$hsl = "";
			if ($angka < 1 || $angka > 5000) { 
				// Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
				$hsl = "Batas Angka 1 s/d 5000";
			} else {
				while ($angka >= 1000) {
					// While itu termasuk kedalam statement perulangan
					// Jadi misal variable angka lebih dari sama dengan 1000
					// Kondisi ini akan di jalankan
					$hsl .= "M"; 
					// jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
					// Varible hsl
					$angka -= 1000;
					// Lalu setelah itu varible angka di kurangi 1000 ,
					// Kenapa di kurangi
					// Karena statment ini mengambil 1000 untuk di konversi menjadi M
				}
			}


			if ($angka >= 500) {
				// statement di atas akan bernilai true / benar
				// Jika var angka lebih dari sama dengan 500
				if ($angka > 500) {
					if ($angka >= 900) {
						$hsl .= "CM";
						$angka -= 900;
					} else {
						$hsl .= "D";
						$angka-=500;
					}
				}
			}
			while ($angka>=100) {
				if ($angka>=400) {
					$hsl .= "CD";
					$angka -= 400;
				} else {
					$angka -= 100;
				}
			}
			if ($angka>=50) {
				if ($angka>=90) {
					$hsl .= "XC";
					$angka -= 90;
				} else {
					$hsl .= "L";
					$angka-=50;
				}
			}
			while ($angka >= 10) {
				if ($angka >= 40) {
					$hsl .= "XL";
					$angka -= 40;
				} else {
					$hsl .= "X";
					$angka -= 10;
				}
			}
			if ($angka >= 5) {
				if ($angka == 9) {
					$hsl .= "IX";
					$angka-=9;
				} else {
					$hsl .= "V";
					$angka -= 5;
				}
			}
			while ($angka >= 1) {
				if ($angka == 4) {
					$hsl .= "IV"; 
					$angka -= 4;
				} else {
					$hsl .= "I";
					$angka -= 1;
				}
			}

			return ($hsl);
		}

		function  separator_rek($rek){
			$nrek=strlen($rek);
			switch ($nrek){
			case 1:
			$rek = $this->left($rek,1);								
				break;
			case 2:
				$rek = $this->left($rek,1).'.'.substr($rek,1,1);								
				break;
			case 3:
				$rek = $this->left($rek,1).'.'.substr($rek,1,1).'.'.substr($rek,2,1);								
				break;
			case 5:
				$rek = $this->left($rek,1).'.'.substr($rek,1,1).'.'.substr($rek,2,1).'.'.substr($rek,3,2);								
			break;
			case 7:
				$rek = $this->left($rek,1).'.'.substr($rek,1,1).'.'.substr($rek,2,1).'.'.substr($rek,3,2).'.'.substr($rek,5,2);								
			break;
			default:
			$rek = "";	
			}
			return $rek;
		}

		public function _mpdf($judul,$header,$body,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
			// ini_set("memory_limit","-1");
					// $mpdf->showImageErrors = true;
					$this->load->library('M_pdf');
				 //   $mpdf = new m_pdf('', 'Letter-L');
					$mpdf = new m_pdf('', $ckertas);
					$pdfFilePath = $filename;
					$mpdf->pdf->SetTitle($filename);
					// $stylesheet = file_get_contents(base_url("assets/css/mpdfstyletables.css"));
					// $mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
					// $mpdf->pdf->SetHTMLHeader($header);
					// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
					/* if($chalaman=='true'){
						 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
					}else{
						$mpdf->pdf->SetFooter('');				
					} */
					if($chalaman=='true'){
						 $mpdf->pdf->SetFooter(' {PAGENO}');				
					}else{
						$mpdf->pdf->SetFooter('');				
					}
					
				   // $mpdf->pdf->AddPage($orientasi)
					
				if ($halaman==0){
					 $xhal=1;
				 } else {       
					 $xhal=$halaman;
				 }
					
					
					$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
					if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
					$mpdf->pdf->WriteHTML($body);         
					$mpdf->pdf->Output($filename,'I');
					   
				}
	}

?>