<?php
	class Pendapatan_model extends CI_Model{
		function __construct()
		{
			parent::__construct();
			$this->db =  $this->load->database('pendapatan', TRUE);
			// $this->db =  $this->load->database('simakdakom1nfo', TRUE);
		}

		function dashboard_real($tahun,$rekening){
			
			$rekening1 = str_replace(".", "", $rekening);
			$where = $where2 = "";

			if ($rekening != '-') {
				$where = " and LEFT(kd_rek,8) = '$rekening'";
				$where2 = " left(kd_rek5,5)='$rekening1'";
			}else{
				$where2 = " kode in ('41106','41107','41108','41109','41110','41111','41113','41115','41116',
					'41202','41205','41206','41207','41208','41210','41212','41215','41218','41221','41222','41223','41224','41226')";
			}

			$this->db =  $this->load->database('simakdakom1nfo', TRUE);


			$target = $this->db->query("SELECT * from (SELECT kd_rek as kode, nm_rek,anggaran as target, IFNULL(bulan_lalu,0) as bulan_lalu,
IFNULL(bulan_ini,0) as bulan_ini, IFNULL(sd_bulan_ini,0) as sd_bulan_ini
 FROM (SELECT LEFT(a.kd_rek5,1) kd_rek ,b.nm_rek1 nm_rek
,case when (3=1) then sum(a.nilai) when (3=2) THEN SUM(a.nilai_sempurna) ELSE sum(a.nilai_ubah) end as anggaran
 FROM trdrka a
LEFT JOIN ms_rek1 b ON LEFT(a.kd_rek5,1)=b.kd_rek1
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,1),b.nm_rek1) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,1) as map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) < '12' THEN (rupiah) ELSE 0 END) as bulan_lalu
,SUM(CASE WHEN MONTH(a.tgl_kas) = '12' THEN (rupiah) ELSE 0 END) as bulan_ini
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) as sd_bulan_ini
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,1))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek, nm_rek,anggaran, IFNULL(bulan_lalu,0) as bulan_lalu,
IFNULL(bulan_ini,0) as bulan_ini, IFNULL(sd_bulan_ini,0) as sd_bulan_ini
 FROM (SELECT LEFT(a.kd_rek5,2) kd_rek ,b.nm_rek2 nm_rek
,case when (3=1) then sum(a.nilai) when (3=2) THEN SUM(a.nilai_sempurna) ELSE sum(a.nilai_ubah) end as anggaran
 FROM trdrka a
LEFT JOIN ms_rek2 b ON LEFT(a.kd_rek5,2)=b.kd_rek2
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,2),b.nm_rek2) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,2) as map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) < '12' THEN (rupiah) ELSE 0 END) as bulan_lalu
,SUM(CASE WHEN MONTH(a.tgl_kas) = '12' THEN (rupiah) ELSE 0 END) as bulan_ini
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) as sd_bulan_ini
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,2))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek, nm_rek,anggaran, IFNULL(bulan_lalu,0) as bulan_lalu,
IFNULL(bulan_ini,0) as bulan_ini, IFNULL(sd_bulan_ini,0) as sd_bulan_ini
 FROM (SELECT LEFT(a.kd_rek5,3) kd_rek ,b.nm_rek3 nm_rek
,case when (3=1) then sum(a.nilai) when (3=2) THEN SUM(a.nilai_sempurna) ELSE sum(a.nilai_ubah) end as anggaran
 FROM trdrka a
LEFT JOIN ms_rek3 b ON LEFT(a.kd_rek5,3)=b.kd_rek3
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,3),b.nm_rek3) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,3) as map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) < '12' THEN (rupiah) ELSE 0 END) as bulan_lalu
,SUM(CASE WHEN MONTH(a.tgl_kas) = '12' THEN (rupiah) ELSE 0 END) as bulan_ini
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) as sd_bulan_ini
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,3))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek, nm_rek,anggaran, IFNULL(bulan_lalu,0) as bulan_lalu,
IFNULL(bulan_ini,0) as bulan_ini, IFNULL(sd_bulan_ini,0) as sd_bulan_ini
 FROM (SELECT LEFT(a.kd_rek5,5) kd_rek ,b.nm_rek4 nm_rek
,case when (3=1) then sum(a.nilai) when (3=2) THEN SUM(a.nilai_sempurna) ELSE sum(a.nilai_ubah) end as anggaran
 FROM trdrka a
LEFT JOIN ms_rek4 b ON LEFT(a.kd_rek5,5)=b.kd_rek4
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,5),b.nm_rek4) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,5) as map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) < '12' THEN (rupiah) ELSE 0 END) as bulan_lalu
,SUM(CASE WHEN MONTH(a.tgl_kas) = '12' THEN (rupiah) ELSE 0 END) as bulan_ini
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) as sd_bulan_ini
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,5))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek, nm_rek,anggaran, IFNULL(bulan_lalu,0) as bulan_lalu,
IFNULL(bulan_ini,0) as bulan_ini, IFNULL(sd_bulan_ini,0) as sd_bulan_ini
 FROM (SELECT LEFT(a.kd_rek5,7) kd_rek ,b.nm_rek5 nm_rek
,case when (3=1) then sum(a.nilai) when (3=2) THEN SUM(a.nilai_sempurna) ELSE sum(a.nilai_ubah) end as anggaran
 FROM trdrka a
LEFT JOIN ms_rek5 b ON LEFT(a.kd_rek5,7)=b.kd_rek5
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,7),b.nm_rek5) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,7) as map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) < '12' THEN (rupiah) ELSE 0 END) as bulan_lalu
,SUM(CASE WHEN MONTH(a.tgl_kas) = '12' THEN (rupiah) ELSE 0 END) as bulan_ini
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) as sd_bulan_ini
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,7))b
ON a.kd_rek=b.map_real) asu where $where2 group by kode");
			

			$total 				= 0;
			$totalTarget 		= 0;
			$totalPenerimaanOPD = 0;
			$totalRealisasiBUD 	= 0;
			$totalPersen = 0;
			foreach ($target->result_array() as $value) {
			$kd1 = substr($value['kode'], 0,1);
			$kd2 = substr($value['kode'], 1,1);	
			$kd3 = substr($value['kode'], 2,1);
			$kd4 = substr($value['kode'], 3,2);	
			$kd_rek = $kd1.'.'.$kd2.'.'.$kd3.'.'.$kd4;
			$nm_rek = $value['nm_rek'];	
			$trg = $value['target'];
			$bud = $value['sd_bulan_ini'];	

			

			$this->db =  $this->load->database('pendapatan', TRUE);
			/*$query = "SELECT LEFT(kd_rek_pajak,8) AS kd_rek5,SUM(nominal_kas) AS realisasi FROM sspd 
					WHERE tahun = $tahun AND LEFT(kd_rek_pajak,8) = '$kd_rek'
					GROUP BY LEFT(kd_rek_pajak,8);";*/
			// if ($kd_rek != '4.1.1.09'){
			// 		$query = "SELECT LEFT(kd_rek_pajak,8) AS kd_rek5,SUM(nominal_kas) AS realisasi FROM sspd 
			// 		WHERE tahun = $tahun AND LEFT(kd_rek_pajak,8) = '$kd_rek'
			// 		GROUP BY LEFT(kd_rek_pajak,8);";
			// }else{
			// 		$query = "SELECT LEFT(a.kd_rek_pajak,8) AS kd_rek5,SUM(b.nominal_kas) AS realisasi FROM sspd_reklame a
			// 		INNER JOIN sspd b ON a.id_sspd=b.id
			// 		WHERE b.tahun = $tahun AND LEFT(a.kd_rek_pajak,8) = '$kd_rek'
			// 		GROUP BY LEFT(a.kd_rek_pajak,8);";
			// }
			$query = "SELECT LEFT(kd_rek,8) AS kd_rek5,SUM(jumlah) AS realisasi FROM sts_detail 
					  WHERE tahun = $tahun AND LEFT(kd_rek,8) = '$kd_rek'
					  GROUP BY LEFT(kd_rek,8);";
			$data = $this->db->query($query)->row_array();
			$dataChart['Target'][] 		= (int)$trg;
			$dataChart['nm_rek'][] 		= $nm_rek;
			$dataChart['real'][] 		= (int)$data['realisasi'];
			$dataChart['bud'][] 		= (int)$value['sd_bulan_ini'];
			$dataChart['kd_rek5'][] 	= $kd_rek;
			$dataChart['persen'][] 		= round(($bud/$trg)*100,2);
			
			$total 						= $total + (int)$bud;
			$totalRealisasiBUD 			= $totalRealisasiBUD + (int)$bud;
			$totalTarget		 		= $totalTarget + (int)$trg;
			$totalPenerimaanOPD		 	= $totalPenerimaanOPD + (int)$data['realisasi'];
			}
			$dataChart['total'] 		= (int)$totalTarget;
			$dataChart['totalRealOPD'] 	= (int)$totalPenerimaanOPD;
			$dataChart['totalRealBUD'] 	= (int)$totalRealisasiBUD;
			return $dataChart;

		}

		function dashboard_real_bulan($tahun,$rekening){
			
			$rekening1 = str_replace(".", "", $rekening);
			$where = $where2 = "";

			if ($rekening != '-') {
				//$where = " and LEFT(kd_rek_pajak,8) = '$rekening'";
				$where2 = " left(kd_rek5,5)='$rekening'";
			}else{
				$where2 = " kode in ('41106','41107','41108','41109','41110','41111','41113','41115','41116',
					'41202','41205','41206','41207','41208','41210','41212','41215','41218','41221','41222','41223','41224','41226')";
			}

			$this->db =  $this->load->database('simakdakom1nfo', TRUE);


			$target = $this->db->query("SELECT kode,kd_rek5,nm_rek,SUM(target) AS target,SUM(januari) AS januari,SUM(februari) AS februari,SUM(maret) AS maret,SUM(april) AS april,
SUM(mei) AS mei,SUM(juni) AS juni,SUM(juli) AS juli,SUM(agustus) AS agustus,
SUM(september) AS september,SUM(oktober) AS oktober,SUM(november) AS november,SUM(desember) AS desember FROM 
(SELECT kd_rek AS kode,a.kd_rek5,
 nm_rek,anggaran AS target, 
IFNULL(januari,0) AS januari,
IFNULL(februari,0) AS februari, IFNULL(maret,0) AS maret, IFNULL(april,0) AS april,
IFNULL(mei,0) AS mei, IFNULL(juni,0) AS juni, IFNULL(juli,0) AS juli,
IFNULL(agustus,0) AS agustus, IFNULL(september,0) AS september, IFNULL(oktober,0) AS oktober,
IFNULL(november,0) AS november, IFNULL(desember,0) AS desember
 FROM (SELECT LEFT(a.kd_rek5,1) kd_rek ,a.kd_rek5, b.nm_rek1 nm_rek
,CASE WHEN (3=1) THEN SUM(a.nilai) WHEN (3=2) THEN SUM(a.nilai_sempurna) ELSE SUM(a.nilai_ubah) END AS anggaran
 FROM trdrka a
LEFT JOIN ms_rek1 b ON LEFT(a.kd_rek5,1)=b.kd_rek1
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,1),b.nm_rek1) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,1) AS map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) = '1' THEN (rupiah) ELSE 0 END) AS januari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '2' THEN (rupiah) ELSE 0 END) AS februari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '3' THEN (rupiah) ELSE 0 END) AS maret
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '4' THEN (rupiah) ELSE 0 END) AS april
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '5' THEN (rupiah) ELSE 0 END) AS mei
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '6' THEN (rupiah) ELSE 0 END) AS juni
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '7' THEN (rupiah) ELSE 0 END) AS juli
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '8' THEN (rupiah) ELSE 0 END) AS agustus
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '9' THEN (rupiah) ELSE 0 END) AS september
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '10' THEN (rupiah) ELSE 0 END) AS oktober
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '11' THEN (rupiah) ELSE 0 END) AS november
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) AS desember
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,1))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek,kd_rek5, nm_rek,anggaran, IFNULL(januari,0) AS januari,
IFNULL(februari,0) AS februari, IFNULL(maret,0) AS maret, IFNULL(april,0) AS april,
IFNULL(mei,0) AS mei, IFNULL(juni,0) AS juni, IFNULL(juli,0) AS juli,
IFNULL(agustus,0) AS agustus, IFNULL(september,0) AS september, IFNULL(oktober,0) AS oktober,
IFNULL(november,0) AS november, IFNULL(desember,0) AS desember
 FROM (SELECT LEFT(a.kd_rek5,2) kd_rek ,a.kd_rek5,b.nm_rek2 nm_rek
,CASE WHEN (3=1) THEN SUM(a.nilai) WHEN (3=2) THEN SUM(a.nilai_sempurna) ELSE SUM(a.nilai_ubah) END AS anggaran
 FROM trdrka a
LEFT JOIN ms_rek2 b ON LEFT(a.kd_rek5,2)=b.kd_rek2
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,2),b.nm_rek2) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,2) AS map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) = '1' THEN (rupiah) ELSE 0 END) AS januari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '2' THEN (rupiah) ELSE 0 END) AS februari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '3' THEN (rupiah) ELSE 0 END) AS maret
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '4' THEN (rupiah) ELSE 0 END) AS april
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '5' THEN (rupiah) ELSE 0 END) AS mei
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '6' THEN (rupiah) ELSE 0 END) AS juni
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '7' THEN (rupiah) ELSE 0 END) AS juli
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '8' THEN (rupiah) ELSE 0 END) AS agustus
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '9' THEN (rupiah) ELSE 0 END) AS september
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '10' THEN (rupiah) ELSE 0 END) AS oktober
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '11' THEN (rupiah) ELSE 0 END) AS november
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) AS desember
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,2))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek, kd_rek5, nm_rek,anggaran, IFNULL(januari,0) AS januari,
IFNULL(februari,0) AS februari, IFNULL(maret,0) AS maret, IFNULL(april,0) AS april,
IFNULL(mei,0) AS mei, IFNULL(juni,0) AS juni, IFNULL(juli,0) AS juli,
IFNULL(agustus,0) AS agustus, IFNULL(september,0) AS september, IFNULL(oktober,0) AS oktober,
IFNULL(november,0) AS november, IFNULL(desember,0) AS desember
 FROM (SELECT LEFT(a.kd_rek5,3) kd_rek ,a.kd_rek5,b.nm_rek3 nm_rek
,CASE WHEN (3=1) THEN SUM(a.nilai) WHEN (3=2) THEN SUM(a.nilai_sempurna) ELSE SUM(a.nilai_ubah) END AS anggaran
 FROM trdrka a
LEFT JOIN ms_rek3 b ON LEFT(a.kd_rek5,3)=b.kd_rek3
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,3),b.nm_rek3) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,3) AS map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) = '1' THEN (rupiah) ELSE 0 END) AS januari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '2' THEN (rupiah) ELSE 0 END) AS februari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '3' THEN (rupiah) ELSE 0 END) AS maret
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '4' THEN (rupiah) ELSE 0 END) AS april
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '5' THEN (rupiah) ELSE 0 END) AS mei
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '6' THEN (rupiah) ELSE 0 END) AS juni
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '7' THEN (rupiah) ELSE 0 END) AS juli
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '8' THEN (rupiah) ELSE 0 END) AS agustus
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '9' THEN (rupiah) ELSE 0 END) AS september
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '10' THEN (rupiah) ELSE 0 END) AS oktober
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '11' THEN (rupiah) ELSE 0 END) AS november
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) AS desember
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,3))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek, kd_rek5,nm_rek,anggaran, IFNULL(januari,0) AS januari,
IFNULL(februari,0) AS februari, IFNULL(maret,0) AS maret, IFNULL(april,0) AS april,
IFNULL(mei,0) AS mei, IFNULL(juni,0) AS juni, IFNULL(juli,0) AS juli,
IFNULL(agustus,0) AS agustus, IFNULL(september,0) AS september, IFNULL(oktober,0) AS oktober,
IFNULL(november,0) AS november, IFNULL(desember,0) AS desember
 FROM (SELECT LEFT(a.kd_rek5,5) kd_rek ,a.kd_rek5,b.nm_rek4 nm_rek
,CASE WHEN (3=1) THEN SUM(a.nilai) WHEN (3=2) THEN SUM(a.nilai_sempurna) ELSE SUM(a.nilai_ubah) END AS anggaran
 FROM trdrka a
LEFT JOIN ms_rek4 b ON LEFT(a.kd_rek5,5)=b.kd_rek4
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,5),b.nm_rek4) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,5) AS map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) = '1' THEN (rupiah) ELSE 0 END) AS januari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '2' THEN (rupiah) ELSE 0 END) AS februari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '3' THEN (rupiah) ELSE 0 END) AS maret
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '4' THEN (rupiah) ELSE 0 END) AS april
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '5' THEN (rupiah) ELSE 0 END) AS mei
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '6' THEN (rupiah) ELSE 0 END) AS juni
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '7' THEN (rupiah) ELSE 0 END) AS juli
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '8' THEN (rupiah) ELSE 0 END) AS agustus
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '9' THEN (rupiah) ELSE 0 END) AS september
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '10' THEN (rupiah) ELSE 0 END) AS oktober
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '11' THEN (rupiah) ELSE 0 END) AS november
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) AS desember
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,5))b
ON a.kd_rek=b.map_real
UNION ALL
SELECT kd_rek, kd_rek5,nm_rek,anggaran, IFNULL(januari,0) AS januari,
IFNULL(februari,0) AS februari, IFNULL(maret,0) AS maret, IFNULL(april,0) AS april,
IFNULL(mei,0) AS mei, IFNULL(juni,0) AS juni, IFNULL(juli,0) AS juli,
IFNULL(agustus,0) AS agustus, IFNULL(september,0) AS september, IFNULL(oktober,0) AS oktober,
IFNULL(november,0) AS november, IFNULL(desember,0) AS desember
 FROM (SELECT LEFT(a.kd_rek5,7) kd_rek ,a.kd_rek5,b.nm_rek5 nm_rek
,CASE WHEN (3=1) THEN SUM(a.nilai) WHEN (3=2) THEN SUM(a.nilai_sempurna) ELSE SUM(a.nilai_ubah) END AS anggaran
 FROM trdrka a
LEFT JOIN ms_rek5 b ON LEFT(a.kd_rek5,7)=b.kd_rek5
WHERE LEFT(a.kd_rek5,1) IN ('4')
GROUP BY LEFT(a.kd_rek5,7),b.nm_rek5) a
LEFT JOIN
(SELECT LEFT(b.kd_rek5,7) AS map_real
,SUM(CASE WHEN MONTH(a.tgl_kas) = '1' THEN (rupiah) ELSE 0 END) AS januari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '2' THEN (rupiah) ELSE 0 END) AS februari
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '3' THEN (rupiah) ELSE 0 END) AS maret
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '4' THEN (rupiah) ELSE 0 END) AS april
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '5' THEN (rupiah) ELSE 0 END) AS mei
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '6' THEN (rupiah) ELSE 0 END) AS juni
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '7' THEN (rupiah) ELSE 0 END) AS juli
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '8' THEN (rupiah) ELSE 0 END) AS agustus
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '9' THEN (rupiah) ELSE 0 END) AS september
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '10' THEN (rupiah) ELSE 0 END) AS oktober
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '11' THEN (rupiah) ELSE 0 END) AS november
,SUM(CASE WHEN MONTH(a.tgl_kas) <= '12' THEN (rupiah) ELSE 0 END) AS desember
FROM trhkasin_ppkd a INNER JOIN trdkasin_ppkd b ON a.no_kas=b.no_kas AND a.no_sts=b.no_sts AND a.kd_skpd=b.kd_skpd
WHERE LEFT(b.kd_rek5,1) IN ('4') GROUP BY LEFT(b.kd_rek5,7))b
ON a.kd_rek=b.map_real) asu where $where2 ");
			

			$total 				= 0;
			$totalTarget 		= 0;
			$totalPenerimaanOPD = 0;
			$totalRealisasiBUD 	= 0;
			$totalPersen = 0;
			$realBUD = array();
			$bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			foreach ($target->result_array() as $value) {
			
			$kd1 = substr($value['kode'], 0,1);
			$kd2 = substr($value['kode'], 1,1);	
			$kd3 = substr($value['kode'], 2,1);
			$kd4 = substr($value['kode'], 3,2);	
			$kd_rek = $kd1.'.'.$kd2.'.'.$kd3.'.'.$kd4;
			$nm_rek = $value['nm_rek'];	
			$trg = $value['target'];
			$bud = 0;
			$realBUD = array((int)$value['januari'],(int)$value['februari'],(int)$value['maret'],(int)$value['april'],(int)$value['mei'],(int)$value['juni'],
							(int)$value['juli'],(int)$value['agustus'],(int)$value['september'],(int)$value['oktober'],(int)$value['november'],(int)$value['desember']);

			

			$this->db =  $this->load->database('pendapatan', TRUE);
			$query = "SELECT LEFT(kd_rek_pajak,8) AS kd_rek5,SUM(nominal_kas) AS realisasi FROM sspd 
					WHERE tahun = $tahun AND LEFT(kd_rek_pajak,8) = '$kd_rek'
					GROUP BY LEFT(kd_rek_pajak,8);";
			$data = $this->db->query($query)->row_array();
			$dataChart['bulan']			= $bln;
			$dataChart['nm_rek'][] 		= $nm_rek;
			$dataChart['real'][] 		= (int)$data['realisasi'];
			$dataChart['kd_rek5'][] 	= $kd_rek;
			$dataChart['persen'][] 		= round(($bud/$trg)*100,2);
			
			$total 						= $total + (int)$bud;
			$totalRealisasiBUD 			= $totalRealisasiBUD + (int)$bud;
			$totalTarget		 		= $totalTarget + (int)$trg;
			$totalPenerimaanOPD		 	= $totalPenerimaanOPD + (int)$data['realisasi'];
			}
			$dataChart['Target'] 		= array((int)$value['target'],(int)$value['target'],(int)$value['target'],(int)$value['target'],(int)$value['target'],(int)$value['target'],
							(int)$value['target'],(int)$value['target'],(int)$value['target'],(int)$value['target'],(int)$value['target'],(int)$value['target']);
			$dataChart['bud'] 			= $realBUD;
			$dataChart['total'] 		= (int)$totalTarget;
			$dataChart['totalRealOPD'] 	= (int)$totalPenerimaanOPD;
			$dataChart['totalRealBUD'] 	= (int)$totalRealisasiBUD;
			
			return $dataChart;

		}

	}

?>