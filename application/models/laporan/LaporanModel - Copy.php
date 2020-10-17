<?php
	class LaporanModel extends CI_Model{

		

		function rck_kab_pdf($tw)
        {   

        	// print_r($_GET);die();

        	$_sd = $_GET['sd'];
        	
        	$tgl = $_GET['tgl'];
            $_tgl = $this->PublicModel->tgl_indo($tgl);


            $thn_anggaran = $this->session->userdata('thn_ang');
            $sdKode = array('DAU','DAK','OTSUS','DBH','JKN','PAD','SILPA','JML');


            
            $sdNama = array('DANA ALOKASI UMUM','DANA ALOKASI KHUSUS','DANA OTONOMI KHUSUS',
                            'DANA BAGI HASIL','DANA KAPITASI-JKN KESEHATAN','DANA PENDAPATAN ASLI DAERAH',
                            'DANA SILPA','JUMLAH DAN CAPAIAN KINERJA');
            $sts_ubah = 'Murni';
            if($sts_ubah == 'Murni'){
                $ambilNilai = 'Nilai';
            }else{
                $ambilNilai = 'Nilai_ubah';
            }
			
			$tanggal = '';
			$kab     = '';
			$daerah  = '';
			$thn     = '';
			$ibukota     = '';


			// $id = $skpd;
			// $sqldns="SELECT a.kd_urusan as kd_u,b.nm_urusan as nm_u,a.kd_skpd as kd_sk,a.nm_skpd as nm_sk FROM ms_skpd a INNER JOIN ms_urusan b ON a.kd_urusan=b.kd_urusan WHERE kd_skpd='$id'";
			// $sqlskpd=$this->db->query($sqldns);
			// foreach ($sqlskpd->result() as $rowdns)
			// {
			// 	$kd_urusan=$rowdns->kd_u;                    
			// 	$nm_urusan= $rowdns->nm_u;
			// 	$kd_skpd  = $rowdns->kd_sk;
			// 	$nm_skpd  = $rowdns->nm_sk;
			// }
	$sqlsc="SELECT * FROM ms_data_umum where tahun_anggaran =".$thn_anggaran;
			$sqlsclient=$this->db->query($sqlsc);
			foreach ($sqlsclient->result() as $rowsc)
			{  
				$tgl=$rowsc->tgl_dpa;
				$tanggal = $this->PublicModel->tgl_indo($tgl);
				$kab     = strtoupper($rowsc->nama_daerah);
				$daerah  = $rowsc->nama_daerah;
				$thn     = $rowsc->tahun_anggaran;
				$ibukota  = $rowsc->ibukota;
				$logo     = $rowsc->logo_daerah;
				$logoPath = base_url().$logo;
			}


			$sqlsd="SELECT * FROM ms_group_sd where kd_group_sd =".$_sd;
			$sqlsdana=$this->db->query($sqlsd);
			foreach ($sqlsdana->result() as $rowsd)
			{  
				$nmSdana=$rowsd->nm_group_sd;
			}
			
					
			
			$cRet='';
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                        <tr>
                             <td width=\"100%\" align=\"center\" colspan=\"6\">
                                <strong>REALISASI KINERJA PELAKSANAAN APBD TA. $thn_anggaran - $kab
                                <br>RINCIAN BERDASARKAN SUMBER DANA - TRIWULAN $tw
                                </strong></td>
						</tr>
					  </table>";
            // MULAI FOR
            // for ($i=0; $i < count($sdKode) ; $i++) { 
                
            
			$cRet .= "<table style=\"border-collapse:collapse;font-size:8pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr><td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>NO</b></td>                            
								<td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"45%\" align=\"center\"><b>ORGANISASI</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"50%\" align=\"center\"><b>$nmSdana</b></td>
								
							</tr>
							<tr>
								<td rowspan=\"2\" width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"25%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                            </tr>    
                            <tr>
								<td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
                            </tr>   
                            <tr>
                                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>1</i></b></td>
                                <td width=\"45%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>2</i></b></td>
                                <td width=\"18%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>3</i></b></td>
                                <td width=\"18%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>4</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>5</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>6</i></b></td>
							</tr>    
						 </thead>
							";
	
     //                        $sql1="SELECT
					//   `a`.`kd_skpd`     AS `kd_skpd`,
					//   `a`.`nm_skpd`     AS `nm_skpd`,
					//   SUM(`a`.`Nilai`)  AS `susun`,
					//   SUM(`a`.`Nilai_ubah`) AS `ubah`

					// FROM (`trdrka` `a`
					//    JOIN `trskpd` `b`
					//      ON ((`a`.`kd_kegiatan` = `b`.`kd_kegiatan` AND a.tahun_anggaran = b.tahun_anggaran)))
					// WHERE b.tahun_anggaran = ".$thn_anggaran."
					// GROUP BY `a`.`kd_skpd`";

							$sql1 = "SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,sum(a.total) as anggaran,SUM(a.real_keuangan) as realisasi, (sum(a.real_keuangan)/sum(a.total))*100 as persenKeu,(SUM(persenFisik)/COUNT(ta)) as persenFis 
							FROM 
							ms_skpd s 
							LEFT JOIN

							(
							SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
							p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
							keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
							(fisik$tw/p.tvolume)* 100 as persenFisik,
							ak.nm_sumberdana
							 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
							LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
							WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = ".$thn_anggaran." and sts_anggaran = 'Murni' and kd_group_sd = ".$_sd.") and ak.ta = ".$thn_anggaran."
							) a 
							ON s.kd_skpd = a.kd_skpd AND s.tahun_anggaran = a.ta

							GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd;";
                                
						
					 $this->db->close();
					 
                    $query = $this->db->query($sql1);
                    
                    
                    $no = 1;
					foreach ($query->result() as $row)
					{
                        
                        $kode=$no++;
						$uraian=$row->nm_skpd;
						$pagu=number_format($row->anggaran,'2',',','.');
						$realisasi=number_format($row->realisasi,'2',',','.');
						$persenKeu=number_format($row->persenKeu,'2',',','.');
						$persenFis=number_format($row->persenFis,'2',',','.');
                    
                        
						
						 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$kode</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$pagu</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realisasi</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$persenKeu</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$persenFis</td>
										 </tr>
										 ";
                       
                    }
                    $cRet    .= " <tr><td colspan=\"6\" style=\"vertical-align:top;border-top: solid 1px black;vertical-align:middle;\" align=\"center\"><b>&nbsp;</b></td>
                    </tr>
                    ";
                    // $cRet.="</table><br>";
                // }
                    
                    
                    // END FOR
					$cRet .="
									<tr>
										<td colspan=\"3\" width=\"60%\" align=\"left\" style=\"border:none;\">&nbsp;<br>&nbsp;
										<br>&nbsp;
										&nbsp;<br>
										&nbsp;<br>
										&nbsp;<br>
										&nbsp;	
										</td>
									<td width=\"40%\" colspan=\"3\" align=\"center\" style=\"border:none;\">$ibukota ,$_tgl
									<br><b>$jabatan</b>
									  <p>&nbsp;</p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<br><b>$nama</b>
									<br>NIP. $nip 
									</td></tr></table>";
            
            
            
			return $cRet;
        }


        function rck_kab_all_pdf($tw)
        {   
        	ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');
        	$_sd = $_GET['sd'];
        	
        	$tgl = $_GET['tgl'];
            $_tgl = $this->PublicModel->tgl_indo($tgl);


            $thn_anggaran = $this->session->userdata('thn_ang');
            $sdKode = array('DAU','DAK','OTSUS','DBH','JKN','PAD','SILPA','JML');


            
            $sdNama = array('DANA ALOKASI UMUM','DANA ALOKASI KHUSUS','DANA OTONOMI KHUSUS',
                            'DANA BAGI HASIL','DANA KAPITASI-JKN KESEHATAN','DANA PENDAPATAN ASLI DAERAH',
                            'DANA SILPA','JUMLAH DAN CAPAIAN KINERJA');
            $sts_ubah = 'Murni';
            if($sts_ubah == 'Murni'){
                $ambilNilai = 'Nilai';
            }else{
                $ambilNilai = 'Nilai_ubah';
            }
			
			$tanggal = '';
			$kab     = '';
			$daerah  = '';
			$thn     = '';
			$ibukota     = '';


			// $id = $skpd;
			// $sqldns="SELECT a.kd_urusan as kd_u,b.nm_urusan as nm_u,a.kd_skpd as kd_sk,a.nm_skpd as nm_sk FROM ms_skpd a INNER JOIN ms_urusan b ON a.kd_urusan=b.kd_urusan WHERE kd_skpd='$id'";
			// $sqlskpd=$this->db->query($sqldns);
			// foreach ($sqlskpd->result() as $rowdns)
			// {
			// 	$kd_urusan=$rowdns->kd_u;                    
			// 	$nm_urusan= $rowdns->nm_u;
			// 	$kd_skpd  = $rowdns->kd_sk;
			// 	$nm_skpd  = $rowdns->nm_sk;
			// }
	$sqlsc="SELECT * FROM ms_data_umum where tahun_anggaran =".$thn_anggaran;
			$sqlsclient=$this->db->query($sqlsc);
			foreach ($sqlsclient->result() as $rowsc)
			{  
				$tgl=$rowsc->tgl_dpa;
				$tanggal = $this->PublicModel->tgl_indo($tgl);
				$kab     = strtoupper($rowsc->nama_daerah);
				$daerah  = $rowsc->nama_daerah;
				$thn     = $rowsc->tahun_anggaran;
				$ibukota  = $rowsc->ibukota;
				$logo     = $rowsc->logo_daerah;
				$logoPath = base_url().$logo;
			}


			// $sqlsd="SELECT * FROM ms_group_sd";
			// $sqlsdana=$this->db->query($sqlsd);
			// foreach ($sqlsdana->result() as $rowsd)
			// {  
				// $kdSdana=$rowsd->kd_group_sd;
				// $nmSdana=$rowsd->nm_group_sd;

			
				$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
	                        <tr>
	                             <td width=\"100%\" align=\"center\" colspan=\"18\">
	                                <strong>REALISASI KINERJA PELAKSANAAN APBD TA. $thn_anggaran - $kab
	                                <br>RINCIAN BERDASARKAN SUMBER DANA - TRIWULAN $tw
	                                </strong></td>
							</tr>
						  </table>";


						  $cRet .= "<table style=\"border-collapse:collapse;font-size:6pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr><td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>NO</b></td>                            
								<td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>ORGANISASI</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DANA ALOKASI UMUM</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DANA ALOKASI KHUSUS</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DANA OTONOMI KHUSUS</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DANA BAGI HASIL</b></td>
							</tr>
							<tr>
								<td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                                <td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                                <td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                                <td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                            </tr>    
                            <tr>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
                            </tr>   
                            <tr>
                                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>1</i></b></td>
                                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>2</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>3</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>4</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>5</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>6</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>7</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>8</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>9</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>10</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>11</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>12</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>13</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>14</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>15</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>16</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>17</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>18</i></b></td>
                                
							</tr>    
						 </thead>
							";

				

					$sql1 = "SELECT dau.tahun_anggaran,dau.kd_skpd,dau.nm_skpd,dau.anggaran as angDAU,dau.realisasi as realDAU, dau.persenKeu as keuDAU, dau.persenFis as fisDAU,
dak.anggaran as angDAK,dak.realisasi as realDAK, dak.persenKeu as keuDAK, dak.persenFis as fisDAK,
otsus.anggaran as angOTSUS,otsus.realisasi as realOTSUS, otsus.persenKeu as keuOTSUS, otsus.persenFis as fisOTSUS,
dbh.anggaran as angDBH,dbh.realisasi as realDBH, dbh.persenKeu as keuDBH, dbh.persenFis as fisDBH,
jkn.anggaran as angJKN,jkn.realisasi as realJKN, jkn.persenKeu as keuJKN, dbh.persenFis as fisJKN,
pad.anggaran as angPAD,pad.realisasi as realPAD, pad.persenKeu as keuPAD, pad.persenFis as fisPAD,
silpa.anggaran as angSILPA,silpa.realisasi as realSILPA, silpa.persenKeu as keuSILPA, silpa.persenFis as fisSILPA,
jml.anggaran as angJML,jml.realisasi as realJML, jml.persenKeu as keuJML, jml.persenFis as fisJML
 FROM(
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd = 1) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)dau
-- dak
INNER JOIN (
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd = 2) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)dak
on dau.kd_skpd = dak.kd_skpd AND dau.tahun_anggaran = dak.tahun_anggaran
-- OTSUS
INNER JOIN (
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd = 3) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)otsus
on dau.kd_skpd = otsus.kd_skpd AND dau.tahun_anggaran = otsus.tahun_anggaran
-- DBH
INNER JOIN (
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd = 4) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)dbh
on dau.kd_skpd = dbh.kd_skpd AND dau.tahun_anggaran = dbh.tahun_anggaran

INNER JOIN (
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd = 5) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)jkn
on dau.kd_skpd = jkn.kd_skpd AND dau.tahun_anggaran = jkn.tahun_anggaran


INNER JOIN (
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd = 6) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)pad
on dau.kd_skpd = pad.kd_skpd AND dau.tahun_anggaran = pad.tahun_anggaran


INNER JOIN (
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd = 7) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)silpa
on dau.kd_skpd = silpa.kd_skpd AND dau.tahun_anggaran = silpa.tahun_anggaran

INNER JOIN (
SELECT s.tahun_anggaran,s.kd_skpd,s.nm_skpd,
	sum(dau.total) as anggaran,SUM(dau.real_keuangan) as realisasi,
 (sum(dau.real_keuangan)/sum(dau.total))*100 as persenKeu,(SUM(dau.persenFisik)/COUNT(dau.ta)) as persenFis
FROM ms_skpd s
LEFT JOIN
(
SELECT ak.ta, ak.kd_skpd,ak.nm_skpd,ak.kd_program,ak.nm_program,ak.kd_kegiatan,ak.nm_kegiatan,ak.kd_rek5,ak.nm_rek5,
p.no_po,p.uraian,p.tvolume,p.satuan1,p.tvolume_ubah,p.satuan_ubah1,p.harga1,p.harga_ubah1,p.total,p.total_ubah,fisik$tw as real_fisik,
keuangan$tw as real_keuangan, (keuangan$tw/p.total)* 100 as persenKeuangan,
(fisik$tw/p.tvolume)* 100 as persenFisik,
ak.nm_sumberdana
 FROM anggarankegiatan ak INNER JOIN trdpo p on ak.ta = p.tahun_anggaran and ak.kd_kegiatan = p.kd_kegiatan and ak.kd_rek5 = p.kd_rek5
LEFT JOIN trdreal r on r.tahun_anggaran = p.tahun_anggaran and r.kd_kegiatan = p.kd_kegiatan AND r.kd_rekening = p.kd_rek5 AND r.no_rinci = p.no_po
WHERE p.tvolume <> 0 and ak.nm_sumberdana in (SELECT nm_sumberdana FROM mapping_sd WHERE thn_anggaran = $thn_anggaran and sts_anggaran = 'Murni' and kd_group_sd in(1,2,3,4,5,6,7)) and ak.ta = $thn_anggaran
) dau
ON s.kd_skpd = dau.kd_skpd AND s.tahun_anggaran = dau.ta
GROUP BY s.tahun_anggaran,s.kd_skpd,s.nm_skpd)jml
on dau.kd_skpd = jml.kd_skpd AND dau.tahun_anggaran = jml.tahun_anggaran




;";
                     
						
					 $this->db->close();
					 
                    $query = $this->db->query($sql1);
                    
                    
                    $no = 1;
                    $tb = 0;
					foreach ($query->result() as $row)
					{
                        
                        $kode=$no++;
						$uraian=$row->nm_skpd;
						$angDAU=number_format($row->angDAU,'2',',','.');
						$realDAU=number_format($row->realDAU,'2',',','.');
						$keuDAU=number_format($row->keuDAU,'2',',','.');
						$fisDAU=number_format($row->fisDAU,'2',',','.');

						$angDAK=number_format($row->angDAK,'2',',','.');
						$realDAK=number_format($row->realDAK,'2',',','.');
						$keuDAK=number_format($row->keuDAK,'2',',','.');
						$fisDAK=number_format($row->fisDAK,'2',',','.');

						$angOTSUS=number_format($row->angOTSUS,'2',',','.');
						$realOTSUS=number_format($row->realOTSUS,'2',',','.');
						$keuOTSUS=number_format($row->keuOTSUS,'2',',','.');
						$fisOTSUS=number_format($row->fisOTSUS,'2',',','.');

						$angDBH=number_format($row->angDBH,'2',',','.');
						$realDBH=number_format($row->realDBH,'2',',','.');
						$keuDBH=number_format($row->keuDBH,'2',',','.');
						$fisDBH=number_format($row->fisDBH,'2',',','.');

						$angJKN=number_format($row->angJKN,'2',',','.');
						$realJKN=number_format($row->realJKN,'2',',','.');
						$keuJKN=number_format($row->keuJKN,'2',',','.');
						$fisJKN=number_format($row->fisJKN,'2',',','.');

						$angPAD=number_format($row->angPAD,'2',',','.');
						$realPAD=number_format($row->realPAD,'2',',','.');
						$keuPAD=number_format($row->keuPAD,'2',',','.');
						$fisPAD=number_format($row->fisPAD,'2',',','.');

						$angSILPA=number_format($row->angSILPA,'2',',','.');
						$realSILPA=number_format($row->realSILPA,'2',',','.');
						$keuSILPA=number_format($row->keuSILPA,'2',',','.');
						$fisSILPA=number_format($row->fisSILPA,'2',',','.');

						$angJML=number_format($row->angJML,'2',',','.');
						$realJML=number_format($row->realJML,'2',',','.');
						$keuJML=number_format($row->keuJML,'2',',','.');
						$fisJML=number_format($row->fisJML,'2',',','.');

						

						// $persenKeu=number_format($row->persenKeu,'2',',','.');
						// $persenFis=number_format($row->persenFis,'2',',','.');
                    	
                        
						
						 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$kode</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angDAU</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realDAU</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuDAU</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisDAU</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angDAK</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realDAK</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuDAK</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisDAK</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angOTSUS</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realOTSUS</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuOTSUS</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisOTSUS</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angDBH</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realDBH</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuDBH</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisDBH</td>
										 </tr>
										 ";

						$cRet2    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$kode</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angJKN</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realJKN</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuJKN</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisJKN</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angPAD</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realPAD</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuPAD</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisPAD</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angSILPA</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realSILPA</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuSILPA</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisSILPA</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$angJML</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$realJML</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$keuJML</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$fisJML</td>
										 </tr>
										 ";
                      


                    }

                    $cRet    .= " <tr><td colspan=\"18\" style=\"vertical-align:top;border-top: solid 1px black;vertical-align:middle;\" align=\"center\"><b>&nbsp;</b></td>
                    </tr></table><hr><br>
                    ";


                    $cRet .= "<table style=\"border-collapse:collapse;font-size:6pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr><td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>NO</b></td>                            
								<td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>ORGANISASI</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DANA KAPITASI-JKN KESEHATAN</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DANA PENDAPATAN ASLI DAERAH</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DANA SILPA</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>JUMLAH DAN CAPAIAN KINERJA</b></td>
							</tr>
							<tr>
								<td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                                <td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                                <td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                                <td rowspan=\"2\" width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI ANGGARAN</b></td>
								<td colspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>REALISASI<br>FISIK (%)</b></td>
                            </tr>    
                            <tr>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
                            </tr>   
                            <tr>
                                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>1</i></b></td>
                                <td width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>2</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>3</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>4</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>5</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>6</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>7</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>8</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>9</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>10</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>11</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>12</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>13</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>14</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>15</i></b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>16</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>17</i></b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>18</i></b></td>
                                
							</tr>    
						 </thead>
							";
					$cRet .= $cRet2;
					$cRet    .= " <tr><td colspan=\"18\" style=\"vertical-align:top;border-top: solid 1px black;vertical-align:middle;\" align=\"center\"><b>&nbsp;</b></td>
                    </tr></table><hr><br>
                    ";

			// }
			
					
            
		
	
     //                        $sql1="SELECT
					//   `a`.`kd_skpd`     AS `kd_skpd`,
					//   `a`.`nm_skpd`     AS `nm_skpd`,
					//   SUM(`a`.`Nilai`)  AS `susun`,
					//   SUM(`a`.`Nilai_ubah`) AS `ubah`

					// FROM (`trdrka` `a`
					//    JOIN `trskpd` `b`
					//      ON ((`a`.`kd_kegiatan` = `b`.`kd_kegiatan` AND a.tahun_anggaran = b.tahun_anggaran)))
					// WHERE b.tahun_anggaran = ".$thn_anggaran."
					// GROUP BY `a`.`kd_skpd`";

							
                    // $cRet    .= " <tr><td colspan=\"6\" style=\"vertical-align:top;border-top: solid 1px black;vertical-align:middle;\" align=\"center\"><b>&nbsp;</b></td>
                    // </tr>
                    // ";
                    // $cRet.="</table><br>";
                // }
                    
                    
                    // END FOR
					// $cRet .="
					// 				<tr>
					// 					<td colspan=\"3\" width=\"60%\" align=\"left\" style=\"border:none;\">&nbsp;<br>&nbsp;
					// 					<br>&nbsp;
					// 					&nbsp;<br>
					// 					&nbsp;<br>
					// 					&nbsp;<br>
					// 					&nbsp;	
					// 					</td>
					// 				<td width=\"40%\" colspan=\"3\" align=\"center\" style=\"border:none;\">$ibukota ,$_tgl
					// 				<br><b>$jabatan</b>
					// 				  <p>&nbsp;</p>
					// 				<p>&nbsp;</p>
					// 				<p>&nbsp;</p>
					// 				<br><b>$nama</b>
					// 				<br>NIP. $nip 
					// 				</td></tr></table>";
            
            
            
			return $cRet;
        }

        function rck_pdf($skpd,$tw)
        {   
        	$tgl = $_GET['tgl'];
            $_tgl = $this->PublicModel->tgl_indo($tgl);

            $thn_anggaran = $this->session->userdata('thn_ang');
            $sts_ubah = 'Murni';
            if($sts_ubah == 'Murni'){
                $ambilNilai = 'Nilai';
            }else{
                $ambilNilai = 'Nilai_ubah';
            }
			
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
			
			$sqlttd="SELECT nip,nama,jabatan FROM m_ttd WHERE aktif = '1' and id_skpd='".$skpd."' ORDER BY id_skpd LIMIT 1;";
                $resskpd=$this->db->query($sqlttd);
                if(count($resskpd->result()) > 0){
                    foreach ($resskpd->result() as $rowskpd)
                    {
                        $nip  = $rowskpd->nip;
                        $nama  = $rowskpd->nama;
                        $jabatan  = $rowskpd->jabatan;
                    }   
                }else{
                        $nip  = '';
                        $nama  = '';
                        $jabatan  = '';
                }		
			
			$cRet='';
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                        <tr>
                             <td width=\"100%\" align=\"center\" colspan=\"10\">
                                <strong>REKAPITULASI CAPAIAN KINERJA PELAKSANAAN APBD TA. $thn_anggaran
                                <br>$kab
                                <br>TRIWULAN $tw
                                <br>($nm_skpd)
                                </strong></td>
						</tr>
					  </table>";
			
			$cRet .= "<table style=\"border-collapse:collapse;font-size:8pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr><td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>NO</b></td>                            
								<td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"25%\" align=\"center\"><b>PROGRAM/KEGIATAN</b></td>
								<td colspan=\"2\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>TARGET KINERJA</b></td>
								<td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>NILAI YANG<br>DIKONTRAKKAN</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"30%\" align=\"center\"><b>REALISASI KINERJA</b></td>
								<td rowspan=\"3\" bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>KETERANGAN</b></td>
							</tr>
							<tr>
								<td rowspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>FISIK</b></td>
								<td rowspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KEUANGAN</b></td>
                                <td colspan=\"2\" width=\"15%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KEUANGAN</b></td>
                                <td rowspan=\"2\" width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>FISIK</b></td>
                                <td rowspan=\"2\" width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
                            </tr>    
                            <tr>
								<td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(Rp)</b></td>
								<td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>(%)</b></td>
                            </tr>   
                            <tr>
                                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>1</i></b></td>
                                <td width=\"25%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>2</i></b></td>
                                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>3</i></b></td>
                                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>4</i></b></td>
                                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>5</i></b></td>
                                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>6</i></b></td>
                                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>7</i></b></td>
                                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>8</i></b></td>
                                <td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>9</i></b></td>
                                <td width=\"10%\" bgcolor=\"#CCCCCC\" align=\"center\"><b><i>10</i></b></td>
							</tr>    
						 </thead>
					
							<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"5%\" align=\"center\">&nbsp;</td>                            
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"25%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"5%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"5%\">&nbsp;</td>                            
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"10%\">&nbsp;</td></tr>
							";
	
						$sql1="SELECT *,(tot_real_keuangan/nilai)*100 as persen_keu FROM 
                                            (SELECT kd_program AS kode,nm_program as uraian,'P' as jns,'' AS target,
                                            (SELECT sum(".$ambilNilai.") from trdrka where left(kd_kegiatan,18) = a.kd_program and tahun_anggaran = a.tahun_anggaran) as nilai,sum(r.nilai_kontrak) as nilai_kontrak,
                                CASE
                                    WHEN ".$tw." = 1 THEN sum(r.keuangan1)
                                    WHEN ".$tw." = 2 THEN sum(r.keuangan2)
                                    WHEN ".$tw." = 3 THEN sum(r.keuangan3)
                                    WHEN ".$tw." = 4 THEN sum(r.keuangan4)
                                ELSE 0
                            END AS tot_real_keuangan,
                                CASE
                                    WHEN ".$tw." = 1 THEN sum(r.fisik1)
                                    WHEN ".$tw." = 2 THEN sum(r.fisik1)
                                    WHEN ".$tw." = 3 THEN sum(r.fisik1)
                                    WHEN ".$tw." = 4 THEN sum(r.fisik1)
                                ELSE 0
                            END AS tot_real_fisik
                         FROM trskpd a 
                        LEFT JOIN trdreal r on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran
                        where a.kd_skpd = '".$skpd."' and a.tahun_anggaran = ".$thn_anggaran." group by kd_program
                        union all
                        SELECT a.kd_kegiatan AS kode,nm_kegiatan as uraian,'K' as jns,a.tk_kel AS target,
                        (SELECT sum(".$ambilNilai.") from trdrka where kd_kegiatan = a.kd_kegiatan  and tahun_anggaran = a.tahun_anggaran) as nilai,sum(r.nilai_kontrak) as nilai_kontrak,
                                CASE
                                    WHEN ".$tw." = 1 THEN sum(r.keuangan1)
                                    WHEN ".$tw." = 2 THEN sum(r.keuangan2)
                                    WHEN ".$tw." = 3 THEN sum(r.keuangan3)
                                    WHEN ".$tw." = 4 THEN sum(r.keuangan4)
                                ELSE 0
                            END AS tot_real_keuangan,
                                CASE
                                WHEN ".$tw." = 1 THEN sum(r.fisik1)
                                WHEN ".$tw." = 2 THEN sum(r.fisik2)
                                WHEN ".$tw." = 3 THEN sum(r.fisik3)
                                WHEN ".$tw." = 4 THEN sum(r.fisik4)
                                ELSE 0
                            END AS tot_real_fisik
                         FROM trskpd a 
                        LEFT JOIN trdreal r on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran
                        
                        where a.kd_skpd = '".$skpd."' and a.tahun_anggaran = ".$thn_anggaran." group by a.kd_kegiatan) a
                        
                        ORDER BY kode";
                                
                                // $sql1="SELECT *,CASE 
								//  WHEN LEFT(prog,4)=SUBSTRING(prog,6,4) AND RIGHT(prog,2) < 14 THEN 'A'
								//  WHEN LEFT(prog,4)!=SUBSTRING(prog,6,4) THEN 'B'
								//  ELSE 'C'
								//  END AS urut FROM (
								// SELECT a.kd_program AS prog,a.kd_program AS prog1,' ' AS giat,a.nm_program AS uraian, ' ' AS lokasi,' ' AS target,' ' AS sumber,
								// '' AS triw1,
								// '' AS triw2,
								// '' AS triw3,
								// '' AS triw4,
								// '' AS jumlah 
								// FROM trskpd a LEFT JOIN trdrka c ON c.kd_kegiatan=a.kd_kegiatan
								// WHERE RIGHT(a.kd_program,2)<>'00' AND a.kd_skpd = '$id' GROUP BY a.kd_program
								// UNION 
								// SELECT a.kd_program AS prog,' ' AS prog1,a.kd_kegiatan AS giat,a.nm_kegiatan AS uraian, a.lokasi AS lokasi,a.tk_kel AS target,GROUP_CONCAT(DISTINCT c.sumber) AS sumber,
								// (SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan) AS triw1,
								// (SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan)  AS triw2,
								// (SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan) AS triw3,
								// (SELECT sum(nilai)/4 AS nilai FROM trdrka WHERE  kd_kegiatan = a.kd_kegiatan) AS triw4,
								// (SELECT SUM(nilai) AS nilai FROM trdrka WHERE kd_kegiatan = a.kd_kegiatan ) AS jumlah 
								// FROM trskpd a LEFT JOIN trdrka c ON c.kd_kegiatan=a.kd_kegiatan 
								// WHERE RIGHT(a.kd_program,2)<>'00' AND a.kd_skpd = '$id' GROUP BY a.kd_kegiatan,a.lokasi,giat
								// ) a ORDER BY urut, a.prog,a.giat";
								
						
					 
                    $query = $this->db->query($sql1);
                    $noprog =0;
                    $nokeg =0;
					foreach ($query->result() as $row)
					{
                        $kode=$row->kode;
						$uraian=$row->uraian;
                        $targetFisik=$row->target;
                        $targetKeu= number_format($row->nilai,'2',',','.');
                        $kontrak=number_format($row->nilai_kontrak,'2',',','.');
                        $realKeu=number_format($row->tot_real_keuangan,'2',',','.');
                        $persenKeu=number_format($row->persen_keu,'2',',','.');
                        $jns=$row->jns;
						
						
						//$nilai= number_format($row->jumlah,"2",",",".");
						
						$nilaitot=$nilai;
                        
						 if ($jns=='P'){
                             $noprog++;
                             $noprogRomawi = $this->PublicModel->KonDecRomawi($noprog);
                             $nokeg = 0;
						 $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"center\"><b>$noprogRomawi</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$targetFisik</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$targetKeu</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$kontrak</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$realKeu</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$persenKeu</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 </tr>
										 ";
                        }else{
                            $nokeg++;
                            
                            $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" width=\"10%\" align=\"center\"><b>$nokeg</b></td>                                     
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$uraian</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$targetFisik</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$targetKeu</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$kontrak</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$realKeu</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$persenKeu</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                        </tr>
                                        ";

                        }
                    }
                    
                    $cRet .="<tr><td style=\"vertical-align:top;border-top: none;\" width=\"5%\" align=\"center\">&nbsp;</td>                            
                    <td style=\"vertical-align:top;border-top: none;\" width=\"25%\">&nbsp;</td>
                    <td style=\"vertical-align:top;border-top: none;\" width=\"10%\">&nbsp;</td>
                    <td style=\"vertical-align:top;border-top: none;\" width=\"10%\">&nbsp;</td>
                    <td style=\"vertical-align:top;border-top: none;\" width=\"10%\">&nbsp;</td>
                    <td style=\"vertical-align:top;border-top: none;\" width=\"10%\">&nbsp;</td>
                    <td style=\"vertical-align:top;border-top: none;\" width=\"5%\">&nbsp;</td>
                    <td style=\"vertical-align:top;border-top: none;\" width=\"10%\">&nbsp;</td>
                    <td style=\"vertical-align:top;border-top: none;\" width=\"5%\">&nbsp;</td>                            
                    <td style=\"vertical-align:top;border-top: none;\" width=\"10%\">&nbsp;</td></tr>";
					
                     $cRet.="
                        <tr style=\"border-top:none;border-bottom:none;\">
                            
                            <td colspan=\"5\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">&nbsp;</td>
                            <td colspan=\"5\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">&nbsp;</td>
                        </tr>   
                        <tr style=\"border-top:none;border-bottom:none;\">
                            
                            <td colspan=\"5\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">&nbsp;</td>
                            <td colspan=\"5\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">$ibukota, $_tgl</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td colspan=\"5\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">&nbsp;</td>
                            <td colspan=\"5\" align=\"center\" style=\"height:100px;font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">$jabatan<br>$kab</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td colspan=\"5\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"></td>
                            <td colspan=\"5\" width=\"50%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"><u>$nama</u><br>NIP: $nip</td>
                        </tr>
                        
					  ";

					$cRet2 .="<tr>
									<td width=\"100%\" align=\"left\" colspan=\"11\">
									<table border=\"0\">
									<tr>
									<td width=\"100%\" align=\"left\">&nbsp;<br>&nbsp;
									<br>&nbsp;
									&nbsp;<br>
									&nbsp;<br>
									&nbsp;<br>
									&nbsp;	
									</td>
									<td width=\"30%\" colspan=\"3\" align=\"center\">$ibukota ,$tanggal
									<br><b>$jabatan</b>
									  <p>&nbsp;</p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<br><b>$nama</b>
									<br>NIP. $nip 
									</td></tr></table></td>
								 </tr>";
            $cRet    .= "</table>";
            
			return $cRet;
        }
        
        function realckk_pdf($skpd,$keg,$tw)
        {   
            $tgl = $_GET['tgl'];
            $_tgl = $this->PublicModel->tgl_indo($tgl);
            $thn_anggaran = $this->session->userdata('thn_ang');

            // if($tw == 1){
            //     $_tgl = "31 MARET ".$thn_anggaran;
            // }else if($tw == 2){
            //     $_tgl = "30 JUNI ".$thn_anggaran;
            // }else if($tw == 3){
            //     $_tgl = "30 SEPTEMBER ".$thn_anggaran;
            // }else if($tw == 4){
            //     $_tgl = "31 DESEMBER ".$thn_anggaran;
            // }else{

            // }

            $thn_anggaran = $this->session->userdata('thn_ang');
            $ta = $thn_anggaran;
            
            $sts_ubah = 'Murni';
            if($sts_ubah == 'Murni'){
                $ambilNilai = 'Nilai';
            }else{
                $ambilNilai = 'Nilai_ubah';
            }
			
			$tanggal = '';
			$kab     = '';
			$daerah  = '';
			$thn     = '';
			$ibukota     = '';


			$id = $skpd;
            $sqldns="SELECT kd_skpd,nm_skpd,kd_program,nm_program,kd_kegiatan,nm_kegiatan,lokasi,sum(susun) as susun,sum(ubah) as ubah,nm_sumberdana,tu_capai,tu_kel,tu_has,tu_capai_ubah,tu_kel_ubah,tu_has_ubah
            from anggarankegiatan where kd_kegiatan = '".$keg."' and ta = '".$ta."'
           group by kd_skpd,nm_skpd,kd_program,nm_program,kd_kegiatan,nm_kegiatan,lokasi,nm_sumberdana,tu_capai,tu_kel,tu_has,tu_capai_ubah,tu_kel_ubah,tu_has_ubah;";
					 $sqlskpd=$this->db->query($sqldns);
					 foreach ($sqlskpd->result() as $rowdns)
					{
                        $nm_skpd  = $rowdns->nm_skpd;
                        $nm_program  = $rowdns->nm_program;
                        $nm_kegiatan  = $rowdns->nm_kegiatan;
                        $nm_kegiatan  = $rowdns->nm_kegiatan;
                        $nm_sumberdana  = $rowdns->nm_sumberdana;

                        $tu_capai  = $rowdns->tu_capai;
                        $tu_kel  = $rowdns->tu_kel;
                        $tu_has  = $rowdns->tu_has;

                        $pagu  = 'Rp. '.number_format($rowdns->susun,'2',',','.');
                    }
                    
                $sqlttd="SELECT nip,nama,jabatan FROM m_ttd WHERE aktif = '1' and id_skpd='".$id."' ORDER BY id_skpd LIMIT 1;";
                $resskpd=$this->db->query($sqlttd);
                if(count($resskpd->result()) > 0){
                    foreach ($resskpd->result() as $rowskpd)
                    {
                        $nip  = $rowskpd->nip;
                        $nama  = $rowskpd->nama;
                        $jabatan  = $rowskpd->jabatan;
                    }   
                }else{
                        $nip  = '';
                        $nama  = '';
                        $jabatan  = '';
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
			
			$cRet='';
			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                        <tr>
                             <td colspan=\"16\" width=\"100%\" align=\"center\">
                                <strong>LAPORAN REALISASI KINERJA FISIK DAN KEUANGAN <br>PELAKSANAAN APBD $kab TA. $thn_anggaran</strong>
                            </td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                             <td colspan=\"4\" width=\"30%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">Organisasi Perangkat Daerah</td>
                             <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $nm_skpd</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td colspan=\"4\" width=\"30%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">Keadaan s.d Tanggal</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $_tgl (TRIWULAN $tw)</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;\">1.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;\">Nama Program</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-left:none;\">: $nm_program</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">2.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Nama Kegiatan</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $nm_kegiatan</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">3.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Tujuan Kegiatan</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $tu_capai</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">4.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Indikator Kinerja</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $tu_kel</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">5.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Impact yang dihasilkan</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $tu_has</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">6.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Pagu Dana</td>
                            <td colspan=\"6\" width=\"30%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;border-right:none;\">: $pagu</td>
                            <td colspan=\"6\" width=\"40%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">Sumber dana : $nm_sumberdana</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">7.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Rincian Kegiatan dan Realisasinya</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: </td>
                        </tr>

                        
					  </table>";
			
			$cRet .= "<table style=\"border-collapse:collapse;font-size:5.5pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						 <thead>                       
							<tr>                         
								<td colspan=\"2\" rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>Uraian *</b></td>
								<td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>TARGET</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>REALISASI</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>BENTUK PELAKSANAAN (K/NK)</b></td>
                                <td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DIKONTRAKKAN</b></td>
                                <td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>LOKASI</b></td>
							</tr>
							<tr>
								<td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>FISIK</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KEUANGAN<br>(Rp)</b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>%</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>FISIK</b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>%</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KEUANGAN<br>(Rp)</b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>%</b></td>
                                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI KONTRAK<br>(Rp)</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KONTRAKTOR</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NOMOR DAN<br>TANGGAL KONTRAK</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>DISTRIK</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KAMPUNG</b></td>
                                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KOORDINAT</b></td>
                            </tr>    
						 </thead>
		
	
						
						 
                            <tr>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\" align=\"center\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"17%\" align=\"center\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"5%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"5%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"6%\">&nbsp;</td>                            
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"6%\">&nbsp;</td>
                            </tr>
							";

                            $query1="SELECT a.*,b.fisik1,b.fisik2,b.fisik3,b.fisik4,b.keuangan1,b.keuangan2,b.keuangan3,b.keuangan4,
                             CASE
                                    WHEN ".$tw." = 1 THEN b.keuangan1
                                    WHEN ".$tw." = 2 THEN b.keuangan2
                                    WHEN ".$tw." = 3 THEN b.keuangan3
                                    WHEN ".$tw." = 4 THEN b.keuangan4
                                ELSE 0
                            END AS tot_real_keuangan,
                                CASE
                                    WHEN ".$tw." = 1 THEN b.fisik1
                                    WHEN ".$tw." = 2 THEN b.fisik2
                                    WHEN ".$tw." = 3 THEN b.fisik3
                                    WHEN ".$tw." = 4 THEN b.fisik4
                                ELSE 0
                            END AS tot_real_fisik,
                        (SELECT sum(Nilai) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg,
                        (SELECT sum(Nilai_Ubah) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg_ubah,
                        bentuk,nilai_kontrak,kontraktor,no_kontrak,distrik,kampung,koordinat
                             FROM (SELECT tahun_anggaran,kd_kegiatan,left(kd_rek5,3) as kode,(SELECT nm_rek3 from ms_rek3 where left(k.kd_rek5,3)=kd_rek3) as uraian, 0 as no,'' as tvolume,'' as tvolume_ubah, '' as satuan1, '' as satuan_ubah1, '' as harga1,'' as harga_ubah1,
                              Nilai as total, Nilai_ubah as total_ubah FROM trdrka k where kd_kegiatan = '".$keg."' and tahun_anggaran = ".$ta." GROUP BY left(kd_rek5,3)
                             union all 
                             SELECT tahun_anggaran,kd_kegiatan,kd_rek5 as kode,uraian, no_po as no,
                             tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah FROM trdpo
                             where kd_kegiatan = '".$keg."' and tahun_anggaran = ".$ta.") a
                            left JOIN
                            (SELECT * from trdreal)b
                            on a.tahun_anggaran = b.tahun_anggaran and a.kd_kegiatan = b.kd_kegiatan and a.kode = b.kd_rekening and a.no = b.no_rinci
                            order by a.kode, a.no";
                        
                            

						$sql1="SELECT *,(tot_real_keuangan/nilai)*100 as persen_keu FROM 
                                            (SELECT kd_program AS kode,nm_program as uraian,'P' as jns,'' AS target,
                                            (SELECT sum(".$ambilNilai.") from trdrka where left(kd_kegiatan,18) = a.kd_program and tahun_anggaran = a.tahun_anggaran) as nilai,sum(r.nilai_kontrak) as nilai_kontrak,
                                CASE
                                    WHEN ".$tw." = 1 THEN sum(b.keuangan1)
                                    WHEN ".$tw." = 2 THEN sum(b.keuangan2)
                                    WHEN ".$tw." = 3 THEN sum(b.keuangan3)
                                    WHEN ".$tw." = 4 THEN sum(b.keuangan4)
                                ELSE 0
                            END AS tot_real_keuangan,
                                CASE
                                    WHEN ".$tw." = 1 THEN sum(b.fisik1)
                                    WHEN ".$tw." = 2 THEN sum(b.fisik1)
                                    WHEN ".$tw." = 3 THEN sum(b.fisik1)
                                    WHEN ".$tw." = 4 THEN sum(b.fisik1)
                                ELSE 0
                            END AS tot_real_fisik
                         FROM trskpd a 
                        LEFT JOIN trdreal r on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran
                        where a.kd_skpd = '".$skpd."' and a.tahun_anggaran = ".$thn_anggaran." group by kd_program
                        union all
                        SELECT a.kd_kegiatan AS kode,nm_kegiatan as uraian,'K' as jns,a.tk_kel AS target,
                        (SELECT sum(".$ambilNilai.") from trdrka where kd_kegiatan = a.kd_kegiatan  and tahun_anggaran = a.tahun_anggaran) as nilai,sum(r.nilai_kontrak) as nilai_kontrak,
                                CASE
                                    WHEN ".$tw." = 1 THEN sum(r.keuangan1)
                                    WHEN ".$tw." = 2 THEN sum(r.keuangan2)
                                    WHEN ".$tw." = 3 THEN sum(r.keuangan3)
                                    WHEN ".$tw." = 4 THEN sum(r.keuangan4)
                                ELSE 0
                            END AS tot_real_keuangan,
                                CASE
                                WHEN ".$tw." = 1 THEN sum(r.fisik1)
                                WHEN ".$tw." = 2 THEN sum(r.fisik2)
                                WHEN ".$tw." = 3 THEN sum(r.fisik3)
                                WHEN ".$tw." = 4 THEN sum(r.fisik4)
                                ELSE 0
                            END AS tot_real_fisik,
                            bentuk,nilai_kontrak,kontraktor,no_kontrak,distrik,kampung,koordinat
                         FROM trskpd a 
                        LEFT JOIN trdreal r on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran
                        
                        where a.kd_skpd = '".$skpd."' and a.tahun_anggaran = ".$thn_anggaran." group by a.kd_kegiatan) a
                        
                        ORDER BY kode";
                                
                            //    print_r($query);die();
								
						
					 
                    $query = $this->db->query($query1);
                    
                    $noprog =0;
                    $nokeg =0;
                    $jumlahTargetKeu = 0;
                    $jumlahTargetKeuPersen = 0;
                    $jumlahRealFisikPersen = 0;
                    $totalRincian = 0;
                    $jumlahRealKeu = 0;
                    $jumlahRealKeuPersen = 0;
                    $avgRealFisik = 0;
                    $jumlahNilaiKontrak = 0;
					foreach ($query->result() as $value)
					{
                        $jns=$value->no;
                        if($sts_ubah == 'Murni'){
                            $target_keuangan 		= number_format($value->total,2,',','.');
                            $target_fisik 			= number_format($value->tvolume,0,',','.').' '.$value->satuan1;
                            $real_fisik 			= number_format($value->tot_real_fisik,0,',','.') .' '.$value->satuan1;
                            $real_keuangan 			= number_format($value->tot_real_keuangan,2,',','.');
                            if($value->tvolume){
                                $persenFisik = ($value->tot_real_fisik/$value->tvolume)*100;
                            }
                            $tot_persen_target 	    = number_format(($value->total/$value->tot_target_keg)*100,'2',',','.');
                            $tot_persen_keuangan 	= number_format(($value->tot_real_keuangan/$value->tot_target_keg)*100,'2',',','.');
                            $persenRealKeu = ($value->tot_real_keuangan/$value->tot_target_keg)*100;
                            // last
                            if ($jns<>'0'){
                                $jumlahTargetKeu = $jumlahTargetKeu+$value->total;
                                $persenKeu = ($value->total/$value->tot_target_keg)*100;
                                $jumlahTargetKeuPersen = $jumlahTargetKeuPersen+$persenKeu;
                                $totalRincian++;

                                $jumlahRealKeu = $jumlahRealKeu+$value->tot_real_keuangan;
                            }
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
                            $persenRealKeu = ($value->tot_real_keuangan/$value->tot_target_keg_ubah)*100;
                            if ($jns<>'0'){
                                $jumlahTargetKeu = $jumlahTargetKeu+$value->total_ubah;
                                $persenKeu = ($value->total_ubah/$value->tot_target_keg_ubah)*100;
                                $jumlahTargetKeuPersen = $jumlahTargetKeuPersen+$persenKeu;
                                $totalRincian++;
                                $jumlahRealKeu = $jumlahRealKeu+$value->tot_real_keuangan;
                            }
                        }   
                        $jumlahRealFisikPersen = $jumlahRealFisikPersen+$persenFisik;
                        $jumlahRealKeuPersen = $jumlahRealKeuPersen+$persenRealKeu;

                        $tot_persen_fisik 		= number_format($persenFisik,'2',',','.'); 
                        $kode=$value->kode;
                        $uraian=$value->uraian;
                        $bentuk=$value->bentuk;
                        $kontraktor=$value->kontraktor;
                        $no_kontrak=$value->no_kontrak;
                        $nilai_kontrak=number_format($value->nilai_kontrak,2,',','.');
                        $distrik=$value->distrik;
                        $kampung=$value->kampung;
                        $koordinat=$value->koordinat;
                        
                        // $jns=$value->no;
						
						
						//$nilai= number_format($row->jumlah,"2",",",".");
						
						$nilaitot=$nilai;
                        
						 if ($jns=='0'){
                             $noprog++;
                             $noprogRomawi = $this->PublicModel->KonDecRomawi($noprog);
                             $nokeg = 0;
                         $cRet    .= " <tr>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$noprogRomawi</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b></b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 </tr>
										 ";
                        }else{
                            $nokeg++;
                            $jumlahNilaiKontrak = $jumlahNilaiKontrak+$value->nilai_kontrak;
                            $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$nokeg</td>                                     
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$uraian</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$target_fisik</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$target_keuangan</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$tot_persen_target</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$real_fisik</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$tot_persen_fisik</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$real_keuangan</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$tot_persen_keuangan</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$bentuk</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$nilai_kontrak</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$kontraktor</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$no_kontrak</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$distrik</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$kampung</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$koordinat</td>

                                        </tr>
                                        ";
                        }
                    }
                    // jumlah
                    $jumlahTargetKeu = number_format($jumlahTargetKeu,'2',',','.');
                    $jumlahTargetKeuPersen = number_format($jumlahTargetKeuPersen,'2',',','.');
                    $avgRealFisik = number_format(($jumlahRealFisikPersen/$totalRincian),'2',',','.');
                    $jumlahRealKeu = number_format($jumlahRealKeu,'2',',','.');
                    $jumlahRealKeuPersen = number_format($jumlahRealKeuPersen,'2',',','.');
                    $jumlahNilaiKontrak = number_format($jumlahNilaiKontrak,'2',',','.');

                    $cRet    .= " <tr>  <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\" colspan=\"2\"><b>Jumlah</b></td>                                     
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$jumlahTargetKeu</b></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$jumlahTargetKeuPersen</b></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$avgRealFisik</td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$jumlahRealKeu</td>
										<td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$jumlahRealKeuPersen</td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$jumlahNilaiKontrak</td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>

                                        </tr>
                                        ";
                    $cRet    .= "</table>";
                    $queryPermasalahan = "SELECT uraian,keterangan FROM trdreal r
                        inner join trdpo a on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran 
                        and a.kd_rek5 = r.kd_rekening and a.no_po = r.no_rinci
                        where keterangan <> '' and r.tahun_anggaran = '".$thn_anggaran."' and r.kd_kegiatan = '".$keg."';";

                    $dataPermasalahan = $this->db->query($queryPermasalahan)->result();

					$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">8.</td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">Keterangan :</td>
                            <td colspan=\"7\" width=\"50%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;\">Foto/Gambar Dokumentasi</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\"></td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">
                            
                            ";
                            foreach ($dataPermasalahan as $masalah) {
                                $keterangan = nl2br($masalah->keterangan);
                                $cRet .= "<b>".$masalah->uraian."</b><br>";
                                $cRet .= $keterangan."<br>";
                            }
                    $cRet .="</td>";

                    $queryGambar = "SELECT tahun_anggaran,kd_kegiatan,kd_rek,no_po,file FROM trdreal_lamp r where r.tahun_anggaran = '".$thn_anggaran."' and r.kd_kegiatan = '".$keg."' 
group by tahun_anggaran,kd_kegiatan,kd_rek,no_po
order by kd_lamp desc;";
$dataGambar = $this->db->query($queryGambar)->result();
                    $cRet .="<td colspan=\"7\" width=\"50%\" align=\"left\" style=\"font-size:8pt;border-top:none;\">";
                    foreach ($dataGambar as $gambar) {
                        $file = $gambar->file;


                        $search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
                        $searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
                        $replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
                        $filelTemp 		= str_replace($searchdok, $replace, $file);
                        $kegTemp 		= str_replace($search, $replace, $gambar->kd_kegiatan);
                        $rekTemp 		= str_replace($search, $replace, $gambar->kd_rek);
                        $poTemp 		= str_replace($search, $replace, $gambar->no_po);
                        
                        $folderFile		= 'assets/dokumentasi/'.$gambar->tahun_anggaran.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';
                        
                        $filePath = base_url().$folderFile.$file;
                        // print_r($filePath);die();
                        $cRet .= "<img src=\"".$filePath."\" width=\"100\" height=\"100\" />&nbsp;";
                    }
                    
                    $cRet.="</td>
                        </tr>   
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">*</td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">Diuraikan semua item kegiatan sesuai varian pembiayaan untuk mencapai target kinerja</td>
                            <td colspan=\"7\" width=\"50%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">$ibukota, $_tgl</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">**</td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">K &nbsp;&nbsp; : Kontraktual<br>NK : Non Kontraktual</td>
                            <td colspan=\"7\" width=\"50%\" align=\"center\" style=\"height:100px;font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">$jabatan<br>$kab</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"></td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"></td>
                            <td colspan=\"7\" width=\"50%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"><u>$nama</u><br>NIP: $nip</td>
                        </tr>
                        
					  </table>";
					
            
            
			return $cRet;
        }
        
        function realckk_all_pdf($skpd,$keg,$tw)
        {   
        	ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');


            $thn_anggaran = $this->session->userdata('thn_ang');

            if($tw == 1){
                $_tgl = "31 MARET ".$thn_anggaran;
            }else if($tw == 2){
                $_tgl = "30 JUNI ".$thn_anggaran;
            }else if($tw == 3){
                $_tgl = "30 SEPTEMBER ".$thn_anggaran;
            }else if($tw == 4){
                $_tgl = "31 DESEMBER ".$thn_anggaran;
            }else{

            }

            $thn_anggaran = $this->session->userdata('thn_ang');
            $ta = $thn_anggaran;
            
            $sts_ubah = 'Murni';
            if($sts_ubah == 'Murni'){
                $ambilNilai = 'Nilai';
            }else{
                $ambilNilai = 'Nilai_ubah';
            }
			
			$tanggal = '';
			$kab     = '';
			$daerah  = '';
			$thn     = '';
			$ibukota     = '';


            $searchKeg = "SELECT
            `b`.`kd_kegiatan`     AS `kd_kegiatan`
          FROM (`dnacreat_emonev`.`trdrka` `a`
             JOIN `dnacreat_emonev`.`trskpd` `b`
               ON ((`a`.`kd_kegiatan` = `b`.`kd_kegiatan` AND a.tahun_anggaran = b.tahun_anggaran)))
          WHERE b.tahun_anggaran = '".$ta."' AND a.kd_skpd = '".$skpd."'
          GROUP BY `b`.`kd_kegiatan`;";

          $sqlSearch=$this->db->query($searchKeg)->result();
          
          $cRet='';
          foreach ($sqlSearch as $arrKeg) {

            $keg = $arrKeg->kd_kegiatan;
            
			$id = $skpd;
            $sqldns="SELECT kd_skpd,nm_skpd,kd_program,nm_program,kd_kegiatan,nm_kegiatan,lokasi,sum(susun) as susun,sum(ubah) as ubah,nm_sumberdana,tu_capai,tu_kel,tu_has,tu_capai_ubah,tu_kel_ubah,tu_has_ubah
            from anggarankegiatan where kd_kegiatan = '".$keg."' and ta = '".$ta."'
           group by kd_skpd,nm_skpd,kd_program,nm_program,kd_kegiatan,nm_kegiatan,lokasi,nm_sumberdana,tu_capai,tu_kel,tu_has,tu_capai_ubah,tu_kel_ubah,tu_has_ubah;";
					 $sqlskpd=$this->db->query($sqldns);
					 foreach ($sqlskpd->result() as $rowdns)
					{
                        $nm_skpd  = $rowdns->nm_skpd;
                        $nm_program  = $rowdns->nm_program;
                        $nm_kegiatan  = $rowdns->nm_kegiatan;
                        $nm_kegiatan  = $rowdns->nm_kegiatan;
                        $nm_sumberdana  = $rowdns->nm_sumberdana;

                        $tu_capai  = $rowdns->tu_capai;
                        $tu_kel  = $rowdns->tu_kel;
                        $tu_has  = $rowdns->tu_has;

                        $pagu  = 'Rp. '.number_format($rowdns->susun,'2',',','.');
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
			
            
            

			$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                        <tr>
                             <td colspan=\"16\" width=\"100%\" align=\"center\">
                                <strong>LAPORAN REALISASI KINERJA FISIK DAN KEUANGAN <br>PELAKSANAAN APBD $kab TA. $thn_anggaran</strong>
                            </td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                             <td colspan=\"4\" width=\"30%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">Organisasi Perangkat Daerah</td>
                             <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $nm_skpd</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td colspan=\"4\" width=\"30%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">Keadaan s.d Tanggal</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $_tgl (TRIWULAN $tw)</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;\">1.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;\">Nama Program</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-left:none;\">: $nm_program</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">2.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Nama Kegiatan</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $nm_kegiatan</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">3.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Tujuan Kegiatan</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $tu_capai</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">4.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Indikator Kinerja</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $tu_kel</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">5.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Impact yang dihasilkan</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: $tu_has</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">6.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Pagu Dana</td>
                            <td colspan=\"6\" width=\"30%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;border-right:none;\">: $pagu</td>
                            <td colspan=\"6\" width=\"40%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">Sumber dana : $nm_sumberdana</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;\">7.</td>
                            <td colspan=\"3\" width=\"27%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">Rincian Kegiatan dan Realisasinya</td>
                            <td colspan=\"12\" width=\"70%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-left:none;\">: </td>
                        </tr>

                        
					  </table>";
			
			$cRet .= "<table style=\"border-collapse:collapse;font-size:5.5pt;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
						                  
							<tr>                         
								<td colspan=\"2\" rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>Uraian *</b></td>
								<td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>TARGET</b></td>
								<td colspan=\"4\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>REALISASI</b></td>
								<td rowspan=\"2\" bgcolor=\"#CCCCCC\" width=\"5%\" align=\"center\"><b>BENTUK PELAKSANAAN (K/NK)</b></td>
                                <td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>DIKONTRAKKAN</b></td>
                                <td colspan=\"3\" bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>LOKASI</b></td>
							</tr>
							<tr>
								<td width=\"5%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>FISIK</b></td>
								<td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KEUANGAN<br>(Rp)</b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>%</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>FISIK</b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>%</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KEUANGAN<br>(Rp)</b></td>
                                <td width=\"3%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>%</b></td>
                                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NILAI KONTRAK<br>(Rp)</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KONTRAKTOR</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>NOMOR DAN<br>TANGGAL KONTRAK</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>DISTRIK</b></td>
                                <td width=\"7%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KAMPUNG</b></td>
                                <td width=\"6%\" bgcolor=\"#CCCCCC\" align=\"center\"><b>KOORDINAT</b></td>
                            </tr>    
						 
		
                            <tr>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\" align=\"center\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"17%\" align=\"center\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"5%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"3%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"5%\">&nbsp;</td>
								<td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"6%\">&nbsp;</td>                            
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"7%\">&nbsp;</td>
                                <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" width=\"6%\">&nbsp;</td>
                            </tr>
							";

                            $query1="SELECT a.*,b.fisik1,b.fisik2,b.fisik3,b.fisik4,b.keuangan1,b.keuangan2,b.keuangan3,b.keuangan4,
                             CASE
                                    WHEN ".$tw." = 1 THEN b.keuangan1
                                    WHEN ".$tw." = 2 THEN b.keuangan2
                                    WHEN ".$tw." = 3 THEN b.keuangan3
                                    WHEN ".$tw." = 4 THEN b.keuangan4
                                ELSE 0
                            END AS tot_real_keuangan,
                                CASE
                                    WHEN ".$tw." = 1 THEN b.fisik1
                                    WHEN ".$tw." = 2 THEN b.fisik2
                                    WHEN ".$tw." = 3 THEN b.fisik3
                                    WHEN ".$tw." = 4 THEN b.fisik4
                                ELSE 0
                            END AS tot_real_fisik,
                        (SELECT sum(Nilai) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg,
                        (SELECT sum(Nilai_Ubah) FROM trdrka where kd_kegiatan = '".$keg."' and tahun_anggaran = '".$ta."') as tot_target_keg_ubah,
                        bentuk,nilai_kontrak,kontraktor,no_kontrak,distrik,kampung,koordinat
                             FROM (SELECT tahun_anggaran,kd_kegiatan,left(kd_rek5,3) as kode,(SELECT nm_rek3 from ms_rek3 where left(k.kd_rek5,3)=kd_rek3) as uraian, 0 as no,'' as tvolume,'' as tvolume_ubah, '' as satuan1, '' as satuan_ubah1, '' as harga1,'' as harga_ubah1,
                              Nilai as total, Nilai_ubah as total_ubah FROM trdrka k where kd_kegiatan = '".$keg."' and tahun_anggaran = ".$ta." GROUP BY left(kd_rek5,3)
                             union all 
                             SELECT tahun_anggaran,kd_kegiatan,kd_rek5 as kode,uraian, no_po as no,
                             tvolume,tvolume_ubah,satuan1, satuan_ubah1, harga1,harga_ubah1,total,total_ubah FROM trdpo
                             where kd_kegiatan = '".$keg."' and tahun_anggaran = ".$ta.") a
                            left JOIN
                            (SELECT * from trdreal)b
                            on a.tahun_anggaran = b.tahun_anggaran and a.kd_kegiatan = b.kd_kegiatan and a.kode = b.kd_rekening and a.no = b.no_rinci
                            order by a.kode, a.no";
                        
                            

						// $sql1="SELECT *,(tot_real_keuangan/nilai)*100 as persen_keu FROM 
      //                                       (SELECT kd_program AS kode,nm_program as uraian,'P' as jns,'' AS target,
      //                                       (SELECT sum(".$ambilNilai.") from trdrka where left(kd_kegiatan,18) = a.kd_program and tahun_anggaran = a.tahun_anggaran) as nilai,sum(r.nilai_kontrak) as nilai_kontrak,
      //                           CASE
      //                               WHEN ".$tw." = 1 THEN sum(b.keuangan1)
      //                               WHEN ".$tw." = 2 THEN sum(b.keuangan2)
      //                               WHEN ".$tw." = 3 THEN sum(b.keuangan3)
      //                               WHEN ".$tw." = 4 THEN sum(b.keuangan4)
      //                           ELSE 0
      //                       END AS tot_real_keuangan,
      //                           CASE
      //                               WHEN ".$tw." = 1 THEN sum(b.fisik1)
      //                               WHEN ".$tw." = 2 THEN sum(b.fisik1)
      //                               WHEN ".$tw." = 3 THEN sum(b.fisik1)
      //                               WHEN ".$tw." = 4 THEN sum(b.fisik1)
      //                           ELSE 0
      //                       END AS tot_real_fisik
      //                    FROM trskpd a 
      //                   LEFT JOIN trdreal r on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran
      //                   where a.kd_skpd = '".$skpd."' and a.tahun_anggaran = ".$thn_anggaran." group by kd_program
      //                   union all
      //                   SELECT a.kd_kegiatan AS kode,nm_kegiatan as uraian,'K' as jns,a.tk_kel AS target,
      //                   (SELECT sum(".$ambilNilai.") from trdrka where kd_kegiatan = a.kd_kegiatan  and tahun_anggaran = a.tahun_anggaran) as nilai,sum(r.nilai_kontrak) as nilai_kontrak,
      //                           CASE
      //                               WHEN ".$tw." = 1 THEN sum(r.keuangan1)
      //                               WHEN ".$tw." = 2 THEN sum(r.keuangan2)
      //                               WHEN ".$tw." = 3 THEN sum(r.keuangan3)
      //                               WHEN ".$tw." = 4 THEN sum(r.keuangan4)
      //                           ELSE 0
      //                       END AS tot_real_keuangan,
      //                           CASE
      //                           WHEN ".$tw." = 1 THEN sum(r.fisik1)
      //                           WHEN ".$tw." = 2 THEN sum(r.fisik2)
      //                           WHEN ".$tw." = 3 THEN sum(r.fisik3)
      //                           WHEN ".$tw." = 4 THEN sum(r.fisik4)
      //                           ELSE 0
      //                       END AS tot_real_fisik,
      //                       bentuk,nilai_kontrak,kontraktor,no_kontrak,distrik,kampung,koordinat
      //                    FROM trskpd a 
      //                   LEFT JOIN trdreal r on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran
                        
      //                   where a.kd_skpd = '".$skpd."' and a.tahun_anggaran = ".$thn_anggaran." group by a.kd_kegiatan) a
                        
      //                   ORDER BY kode";
                                
                            //    print_r($query);die();
								
						
					 
                    $query = $this->db->query($query1);
                    
                    $noprog =0;
                    $nokeg =0;
                    $jumlahTargetKeu = 0;
                    $jumlahTargetKeuPersen = 0;
                    $jumlahRealFisikPersen = 0;
                    $totalRincian = 0;
                    $jumlahRealKeu = 0;
                    $jumlahRealKeuPersen = 0;
                    $avgRealFisik = 0;
                    $jumlahNilaiKontrak = 0;
					foreach ($query->result() as $value)
					{
                        $jns=$value->no;
                        if($sts_ubah == 'Murni'){
                            $target_keuangan 		= number_format($value->total,2,',','.');
                            $target_fisik 			= number_format($value->tvolume,0,',','.').' '.$value->satuan1;
                            $real_fisik 			= number_format($value->tot_real_fisik,0,',','.') .' '.$value->satuan1;
                            $real_keuangan 			= number_format($value->tot_real_keuangan,2,',','.');
                            if($value->tvolume){
                                $persenFisik = ($value->tot_real_fisik/$value->tvolume)*100;
                            }
                            $tot_persen_target 	    = number_format(($value->total/$value->tot_target_keg)*100,'2',',','.');
                            $tot_persen_keuangan 	= number_format(($value->tot_real_keuangan/$value->tot_target_keg)*100,'2',',','.');
                            $persenRealKeu = ($value->tot_real_keuangan/$value->tot_target_keg)*100;
                            // last
                            if ($jns<>'0'){
                                $jumlahTargetKeu = $jumlahTargetKeu+$value->total;
                                $persenKeu = ($value->total/$value->tot_target_keg)*100;
                                $jumlahTargetKeuPersen = $jumlahTargetKeuPersen+$persenKeu;
                                $totalRincian++;

                                $jumlahRealKeu = $jumlahRealKeu+$value->tot_real_keuangan;
                            }
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
                            $persenRealKeu = ($value->tot_real_keuangan/$value->tot_target_keg_ubah)*100;
                            if ($jns<>'0'){
                                $jumlahTargetKeu = $jumlahTargetKeu+$value->total_ubah;
                                $persenKeu = ($value->total_ubah/$value->tot_target_keg_ubah)*100;
                                $jumlahTargetKeuPersen = $jumlahTargetKeuPersen+$persenKeu;
                                $totalRincian++;
                                $jumlahRealKeu = $jumlahRealKeu+$value->tot_real_keuangan;
                            }
                        }   
                        $jumlahRealFisikPersen = $jumlahRealFisikPersen+$persenFisik;
                        $jumlahRealKeuPersen = $jumlahRealKeuPersen+$persenRealKeu;

                        $tot_persen_fisik 		= number_format($persenFisik,'2',',','.'); 
                        $kode=$value->kode;
                        $uraian=$value->uraian;
                        $bentuk=$value->bentuk;
                        $kontraktor=$value->kontraktor;
                        $no_kontrak=$value->no_kontrak;
                        $nilai_kontrak=number_format($value->nilai_kontrak,2,',','.');
                        $distrik=$value->distrik;
                        $kampung=$value->kampung;
                        $koordinat=$value->koordinat;
                        
                        // $jns=$value->no;
						
						
						//$nilai= number_format($row->jumlah,"2",",",".");
						
						$nilaitot=$nilai;
                        
						 if ($jns=='0'){
                             $noprog++;
                             $noprogRomawi = $this->PublicModel->KonDecRomawi($noprog);
                             $nokeg = 0;
                         $cRet    .= " <tr>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$noprogRomawi</b></td>                                     
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" ><b>$uraian</b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b></b></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"></td>
										 </tr>
										 ";
                        }else{
                            $nokeg++;
                            $jumlahNilaiKontrak = $jumlahNilaiKontrak+$value->nilai_kontrak;
                            $cRet    .= " <tr><td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$nokeg</td>                                     
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" >$uraian</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$target_fisik</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$target_keuangan</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$tot_persen_target</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$real_fisik</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$tot_persen_fisik</td>
                                        <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$real_keuangan</td>
										 <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$tot_persen_keuangan</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$bentuk</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$nilai_kontrak</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$kontraktor</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$no_kontrak</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$distrik</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\">$kampung</td>
                                         <td style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$koordinat</td>

                                        </tr>
                                        ";
                        }
                    }
                    // jumlah
                    $jumlahTargetKeu = number_format($jumlahTargetKeu,'2',',','.');
                    $jumlahTargetKeuPersen = number_format($jumlahTargetKeuPersen,'2',',','.');
                    $avgRealFisik = number_format(($jumlahRealFisikPersen/$totalRincian),'2',',','.');
                    $jumlahRealKeu = number_format($jumlahRealKeu,'2',',','.');
                    $jumlahRealKeuPersen = number_format($jumlahRealKeuPersen,'2',',','.');
                    $jumlahNilaiKontrak = number_format($jumlahNilaiKontrak,'2',',','.');

                    $cRet    .= " <tr>  <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\" colspan=\"2\"><b>Jumlah</b></td>                                     
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\"><b>$jumlahTargetKeu</b></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"><b>$jumlahTargetKeuPersen</b></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$avgRealFisik</td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$jumlahRealKeu</td>
										<td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\">$jumlahRealKeuPersen</td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"right\">$jumlahNilaiKontrak</td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"left\"></td>
                                        <td bgcolor=\"#CCCCCC\" style=\"vertical-align:top;border-top: solid 1px black;border-bottom: none;\" align=\"center\"></td>

                                        </tr>
                                        ";
                    $cRet    .= "</table>";
                    $queryPermasalahan = "SELECT uraian,keterangan FROM trdreal r
                        inner join trdpo a on a.kd_kegiatan = r.kd_kegiatan and a.tahun_anggaran = r.tahun_anggaran 
                        and a.kd_rek5 = r.kd_rekening and a.no_po = r.no_rinci
                        where keterangan <> '' and r.tahun_anggaran = '".$thn_anggaran."' and r.kd_kegiatan = '".$keg."';";

                    $dataPermasalahan = $this->db->query($queryPermasalahan)->result();

					$cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">8.</td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">Keterangan :</td>
                            <td colspan=\"7\" width=\"50%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;\">Foto/Gambar Dokumentasi</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\"></td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-top:none;border-bottom:none;border-right:none;border-left:none;\">
                            
                            ";
                            foreach ($dataPermasalahan as $masalah) {
                                $keterangan = nl2br($masalah->keterangan);
                                $cRet .= "<b>".$masalah->uraian."</b><br>";
                                $cRet .= $keterangan."<br>";
                            }
                    $cRet .="</td>";

                    $queryGambar = "SELECT tahun_anggaran,kd_kegiatan,kd_rek,no_po,file FROM trdreal_lamp r where r.tahun_anggaran = '".$thn_anggaran."' and r.kd_kegiatan = '".$keg."' 
group by tahun_anggaran,kd_kegiatan,kd_rek,no_po
order by kd_lamp desc;";
$dataGambar = $this->db->query($queryGambar)->result();
                    $cRet .="<td colspan=\"7\" width=\"50%\" align=\"left\" style=\"font-size:8pt;border-top:none;\">";
                    foreach ($dataGambar as $gambar) {
                        $file = $gambar->file;


                        $search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
                        $searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
                        $replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
                        $filelTemp 		= str_replace($searchdok, $replace, $file);
                        $kegTemp 		= str_replace($search, $replace, $gambar->kd_kegiatan);
                        $rekTemp 		= str_replace($search, $replace, $gambar->kd_rek);
                        $poTemp 		= str_replace($search, $replace, $gambar->no_po);
                        
                        $folderFile		= 'assets/dokumentasi/'.$gambar->tahun_anggaran.'/'.$kegTemp.'/'.$rekTemp.'/'.$poTemp.'/';
                        
                        $filePath = base_url().$folderFile.$file;
                        // print_r($filePath);die();
                        $cRet .= "<img src=\"".$filePath."\" width=\"100\" height=\"100\" />&nbsp;";
                    }
                    
                    $cRet.="</td>
                        </tr>   
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">*</td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">Diuraikan semua item kegiatan sesuai varian pembiayaan untuk mencapai target kinerja</td>
                            <td colspan=\"7\" width=\"50%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;\">$ibukota, $_tgl</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">**</td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">K &nbsp;&nbsp; : Kontraktual<br>NK : Non Kontraktual</td>
                            <td colspan=\"7\" width=\"50%\" align=\"center\" style=\"height:100px;font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\">$jabatan<br>$kab</td>
                        </tr>
                        <tr style=\"border-top:none;border-bottom:none;\">
                            <td width=\"3%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"></td>
                            <td colspan=\"8\" width=\"47%\" align=\"left\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"></td>
                            <td colspan=\"7\" width=\"50%\" align=\"center\" style=\"font-size:8pt;border-bottom:none;border-right:none;border-left:none;border-top:none;vertical-align:top;\"><u>$nama</u><br>NIP: $nip</td>
                        </tr>
                        
                      </table>";
                }
					
            
            print_r($cRet);die();
			return $cRet;
		}


	}

?>