<?php 
  $is_admin = $this->session->userdata('is_admin');
  if ($is_admin == 1) {
    $hidden = '';
  }else if ($is_admin == 2) {
    $hidden = 'hidden';
  }else if ($is_admin == 3) {
    $hidden = 'hidden';
  }
 ?>

<div class="panel panel-headline panel-primary">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="box-body my-form-body">
					<div class="row">
						<div class="col-md-12">
							<div class="box-body my-form-body">
								<table id="list-data" class="table table-bordered table-striped;" style="background-color:#ccc;">
				                  	<thead>
				                    	<tr>
				                      		<th colspan="4" width="100%" style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:14pt;">KELENGKAPAN TLHP</th>
				                    	</tr>
			                  		</thead>
				                  	<tbody>
				                  	<?php foreach ($tlhp as $valueTlhp) {?>
				                  		<tr>
				                  			<td><label>Unit Kerja Kemendagri</label></td>
				                  			<td><input type="text" name="d_daerah" class="form-control input-sm" id="d_daerah" readonly placeholder="" value="<?= $valueTlhp->daerah; ?>">
				                  				<input type="text" name="d_id_daerah" class="form-control input-sm hidden" id="d_id_daerah" readonly placeholder="" value="<?= $valueTlhp->id_daerah; ?>">
				                  				<input type="text" name="noreg" class="form-control input-sm hidden" id="noreg" readonly placeholder="" value="<?= $noreg; ?>">
				                  			</td>
				                  			<td><label>Tanggal Ekspose Konsep LHP</label></td>
				                  			<td><input type="text" name="d_tgl_ekspose" class="form-control input-sm" id="d_tgl_ekspose" readonly placeholder="" value="<?= $valueTlhp->tgl_ekspose; ?>"></td>
				                  		</tr>	
					                  	<tr>
					                  		<td><label>Nomor LHP</label></td>
					                  		<td><input type="text" name="d_no_lhp" class="form-control input-sm" id="d_no_lhp" readonly placeholder="" value="<?= $valueTlhp->no_lhp; ?>"></td>
					                  		<td><label>Petugas Tim</label></td>
					                  		<td><input type="text" name="d_anev" class="form-control input-sm" id="d_anev" readonly placeholder="" value="<?= $valueTlhp->anev; ?>"></td>
					                  	</tr>	
					                  	<tr>
					                  		<td><label>Unit Kerja Eselon II</label></td>
					                  		<td><input type="text" name="d_inspektorat" class="form-control input-sm" id="d_inspektorat" readonly placeholder="" value="<?= $valueTlhp->inspektorat; ?>"></td>
					                  		<td><label>Petugas Sekretariat</label></td>
					                  		<td><input type="text" name="d_apip" class="form-control input-sm" id="d_apip" readonly placeholder="" value="<?= $valueTlhp->apip; ?>"></td>
					                  	</tr>	
					                  	<tr>
					                  		<td><label>Pengendali Teknis Tim</label></td>
					                  		<td><input type="text" name="d_dalnis" class="form-control input-sm" id="d_dalnis" readonly placeholder="" value="<?= $valueTlhp->dalnis; ?>"></td>
					                  		<td><label>Petugas Unit Kerja Kemendagri</label></td>
					                  		<td><input type="text" name="d_obrik" class="form-control input-sm" id="d_obrik" readonly placeholder="" value="<?= $valueTlhp->obrik; ?>"></td>
					                  	</tr>	
					                  	<tr>
					                  		<td><label>Tanggal LHP</label></td>
					                  		<td><input type="text" name="d_tgl_lhp" class="form-control input-sm" id="d_tgl_lhp" readonly placeholder="" value="<?= $valueTlhp->tgl_lhp; ?>"></td>
					                  		<td><label>Petugas Validasi</label></td>
					                  		<td><input type="text" name="d_review" class="form-control input-sm" id="d_review" readonly placeholder="" value="<?= $valueTlhp->review; ?>"></td>
					                  	</tr>
									<?php } ?>

					                  	<tr>
					                      	<td colspan="4" width="100%" style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:14pt;">DATA TEMUAN</td>
					                    </tr>
					                    <tr>
					                    	<td colspan="4" width="100%" id="tree_temuan">
					                    		
<div id="daftar-list-lhp">
  

<?php 
   $sql1 = "(SELECT noreg,no_lhp,id_aspek as kode,(SELECT nm_parameter from ms_pemeriksaan_kinerja where id_parameter = tem.id_aspek AND tahun = tem.tahun) as uraian, '' as nilai,tahun,'' as tlanjut,'' as sts_tlanjut, '' as file 
          FROM trd_tlhp_kemendagri_temuan tem where noreg = '".$noreg."' and no_lhp = '".$no_lhp."' GROUP BY id_aspek)";
  
  $res1 = $this->db->query($sql1)->result_array();
  $this->db->close();
  $jmlRes1 = count($res1);
  if (count($res1)>0) {
?>
<div class="treeview-colorful w-100 border border-secondary mx-4 my-4">
    <ul class="treeview-colorful-list mb-3">
<?php 
  foreach ($res1 as $value1) {
          $noreg1 = $value1['noreg'];
          $kode1 = $value1['kode'];
          $uraian1 = $value1['uraian'];
          $nilai1 = $value1['nilai'];
          $tahun1 = $value1['tahun'];

          $sql2 = "(SELECT noreg, kd_temuan as kode,judul_temuan as uraian ,nilai_temuan as nilai,tahun,'' as tlanjut,'' as sts_tlanjut, '' as file 
                  FROM trd_tlhp_kemendagri_temuan tem where noreg = '".$noreg1."'  and no_lhp = '".$no_lhp."' AND LEFT(kd_temuan,3) = '".$kode1."')";
          
          $res2 = $this->db->query($sql2)->result_array();
          $this->db->close();

          $jmlRes2 = count($res2);
          // tentukan ada sub nya / tidak
          if (count($res2) == 0) {


?>
        <li>
          <div class="treeview-colorful-element"><i class="fa fa-file ic-w mr-1"></i> 
           <table border="0" width="100%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-file ic-w mr-1"></i> 
                </td>
                <td width="90%">
                   <span>
                   <?php echo $kode1; ?> -
                   <?php echo $uraian1; ?>
                   </span>
                </td>
              </tr>  
            </table>
          </div>
        </li>
<?php  
    }else{
?>
        <li class="treeview-colorful-items">
          <a class="treeview-colorful-items-header">
             <table border="0" width="100%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-plus-circle ic-w mx-1"></i>
                  <i class="fa fa-folder ic-w mx-1"></i>
                </td>
                <td width="90%">
                   <span>
                   <?php echo $kode1; ?> -
                   <?php echo $uraian1; ?>
                   </span>
                </td>
              </tr>  
            </table>
          </a>
          <ul class="nested">


<?php 
    foreach ($res2 as $value2) {
              $noreg2 = $value2['noreg'];
              $kode2 = $value2['kode'];
              $uraian2 = $value2['uraian'];
              $nilai2 = $value2['nilai'];
              $tahun2 = $value2['tahun'];

      $sql3 = "
(SELECT noreg,kd_rekom as kode, rekomendasi as uraian, '' as nilai, tahun,tlanjut,sts_tlanjut,file 
FROM trd_tlhp_kemendagri_rekomendasi rek where noreg = '".$noreg."'  and no_lhp = '".$no_lhp."'  AND LEFT(kd_rekom,5) = '".$kode2."')";

    $res3 = $this->db->query($sql3)->result_array();
              $this->db->close();
              $jmlRes3 = count($res3);
              if (count($res3) == 0) {

?>

            <li>
          <div class="treeview-colorful-element">
            <table border="0" width="100%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-file ic-w mr-1"></i> 
                </td>
                <td width="80%">
                   <span>
                   <?php echo $kode2; ?> -
                   <?php echo $uraian2; ?>
                   </span>
                </td>
                <td width="6%"  style="font-size:14pt;">
                  <i class="fa fa-trash ic-w mr-1 pull-right hapusTemuan <?=$hidden; ?>" data-toggle="tooltip" title="Hapus Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"  data-lhp = "<?php echo $no_lhp; ?>"  data-nama = "<?php echo $uraian2; ?>"></i>
                  <i class="fa fa-pencil ic-w mr-1 pull-right editTemuan <?=$hidden; ?>" data-toggle="tooltip" title="Edit Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"   data-lhp = "<?php echo $no_lhp; ?>"  data-nama = "<?php echo $uraian2; ?>"></i> 
                </td>
              </tr>  
            </table>
            <!-- <?php echo $uraian2; ?> -->
            <!-- <i class="fa fa-pencil ic-w mr-1 pull-right vTindak" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"  data-lhp = "<?php echo $no_lhp; ?>"></i>  -->
          </div>
        </li>

<?php 
              }else{
?>
           <li class="treeview-colorful-items">
          <a class="treeview-colorful-items-header">
               <table border="0" width="100%" style="border:none;">
                <tr>
                  <td width="5%">
                    <i class="fa fa-plus-circle ic-w mx-1"></i>
                    <i class="fa fa-folder ic-w mx-1"></i>
                  </td>
                  <td width="80%">
                     <span>
                     <?php echo $kode2; ?> -
                     <?php echo $uraian2; ?>
                     </span>
                  </td>
                  <td width="5%"  style="font-size:14pt;">
                    <i class="fa fa-trash ic-w mr-1 pull-right hapusTemuan <?=$hidden; ?>" data-toggle="tooltip" title="Hapus Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"  data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian2; ?>"></i>
                    <i class="fa fa-pencil ic-w mr-1 pull-right editTemuan <?=$hidden; ?>" data-toggle="tooltip" title="Edit Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"   data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian2; ?>"></i> 
                  </td>
                </tr>  
              </table>

             <!-- <?php echo $uraian2; ?> -->
             </span>
          </a>
          <ul class="nested">

<?php  
                  foreach ($res3 as $value3) {
                  $noreg3 = $value3['noreg'];
                  $kode3 = $value3['kode'];
                  $uraian3 = $value3['uraian'];
                  $nilai3 = $value3['nilai'];
                  $tahun3 = $value3['tahun'];
                  $sts_tlanjut3 = $value3['sts_tlanjut'];
                  $color = '';
                  if ($sts_tlanjut3 == 'SESUAI') {
                      $color .= ' style = "color:deepskyblue;" ';
                  }else if ($sts_tlanjut3 == 'BELUM SESUAI') {
                      $color .= ' style = "color:forestgreen;" ';
                  }else if ($sts_tlanjut3 == 'BELUM DITINDAKLANJUTI') {
                      $color .= ' style = "color:gold;" ';
                  }else if ($sts_tlanjut3 == 'TIDAK DAPAT DITINDAKLANJUTI') {
                      $color .= ' style = "color:red;" ';
                  }


?>
     <li>
          <div class="treeview-colorful-element">
            <table border="0" width="99.5%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-file ic-w mr-1" <?=$color; ?>></i> 
                </td>
                <td width="85%">
                   <span>
                   <?php echo $kode3; ?> -
                   <?php echo $uraian3; ?>
                   </span>
                </td>
                <td width="6%"  style="font-size:14pt;">
                  <i class="fa fa-trash ic-w mr-1 pull-right hapusRekom <?=$hidden; ?>" data-toggle="tooltip" title="Hapus Rekomendasi" data-reg ="<?php echo $noreg3; ?>" data-kode = "<?php echo $kode3; ?>"   data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian3; ?>"></i> 
                  <i class="fa fa-pencil ic-w mr-1 pull-right editRekom <?=$hidden; ?>" data-toggle="tooltip" title="Edit Rekomendasi" data-reg ="<?php echo $noreg3; ?>" data-kode = "<?php echo $kode3; ?>"   data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian3; ?>"></i> 
                </td>
              </tr>  
            </table>
            <!-- <?php echo $uraian3; ?> -->
            <!-- <i class="fa fa-eye ic-w mr-1 pull-right vTindak" data-reg ="<?php echo $noreg3; ?>" data-kode = "<?php echo $kode3; ?>"></i>  -->
          </div>
        </li>

<?php 
                }
                ?>
                </ul></li>
                <?php 

              }

    }
    ?>
    </ul></li>
    <?php 
    }
  }
  ?>
  </ul>
</div> 
<!-- <center>
  <a href="#" class="btn btn-default btn-lg tlanjut">Lanjut ke TLHP <i class="fa fa-arrow-circle-right"></i></a>
</center>  -->
  <?php 
}else{ ?>
  <div class="panel panel-headline panel-primary">
  <div class="panel-heading" style="height:200px;">
    <h1><center><img src="<?php echo base_url('assets/img/empty.gif'); ?>"  height="100" width="100"><br>DATA TEMUAN BELUM ADA!</center></h1>
  </div>
</div>

<?php } ?>
</div>
<div id="form-edit-temuan" hidden>
  <h4 style="text-align:center;">FORM EDIT TEMUAN</h4>
  <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
  <form class="form-horizontal" id="form-isi-edit-temuan">
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Kode Temuan</label>

      <div class="col-sm-3">
        <input type="text" name="kd_temuan" class="form-control input-sm" readonly="" id="kd_temuan_e" placeholder="">
        <input type="text" name="noreg" class="form-control input-sm hidden" readonly="" id="noreg_e" placeholder="">
        <input type="text" name="no_lhp" class="form-control input-sm hidden" readonly="" id="no_lhp_e" placeholder="">
      </div>
      </div>
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Temuan</label>

      <div class="col-sm-8">
        <input type="text" name="jdl_temuan" class="form-control input-sm" id="jdl_temuan_e" placeholder="">
      </div>
      </div>

      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Nilai Temuan</label>

      <div class="col-sm-3">
        <input type="text" name="nilai_temuan" class="form-control input-sm function_separator" id="nilai_temuan_e" placeholder="">
      </div>
      </div>
      <center>
        <button type="button" data-aksi="simpan" class="btn btn-success btn-lg update-temuan"><i class="fa fa-check"></i> UPDATE TEMUAN</button>
        <button type="button" class="btn btn-danger btn-lg back_to_list"><i class="fa fa-remove"></i> BATAL</button>
      </center>
  </form>
</div>


<div id="form-edit-rekomendasi" hidden>
  <h4 style="text-align:center;">FORM EDIT REKOMENDASI</h4>
  <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
  <form class="form-horizontal" id="form-isi-edit-rekomendasi">
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Kode Rekomendasi</label>

      <div class="col-sm-3">
        <input type="text" name="kd_temuan" class="form-control input-sm hidden" readonly="" id="kd_temuan_r" placeholder="">
        <input type="text" name="kd_rekom" class="form-control input-sm" readonly="" id="kd_rekom_r" placeholder="">
        <input type="text" name="noreg" class="form-control input-sm hidden" readonly="" id="noreg_r" placeholder="">
        <input type="text" name="no_lhp" class="form-control input-sm hidden" readonly="" id="no_lhp_r" placeholder="">
      </div>
      </div>
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Rekomendasi</label>

      <div class="col-sm-8">
        <input type="text" name="rekomendasi" class="form-control input-sm" id="rekomendasi_r" placeholder="">
      </div>
      </div>
      <center>
        <button type="button" data-aksi="simpan" class="btn btn-success btn-lg update-rekomendasi"><i class="fa fa-check"></i> UPDATE REKOMENDASI</button>
        <button type="button" class="btn btn-danger btn-lg back_to_list"><i class="fa fa-remove"></i> BATAL</button>
        
      </center>
  </form>
</div>



					                    	</td>
					                  	</tr>
									</tbody>
					                <tfoot>
					                  	<tr>
									      	<td colspan="4" width="100%" style="font-weight:bold;background-color:#074979;color:#fff;font-size:12pt;">
									      		<marquee width="100%" >INFO STATUS : 
										      		<i class="fa fa-file ic-w mr-1" style="color:deepskyblue;"></i> SESUAI -- 
										      		<i class="fa fa-file ic-w mr-1" style="color:forestgreen;"></i> BELUM SESUAI -- 
										      		<i class="fa fa-file ic-w mr-1" style="color:gold;"></i> BELUM DITINDAKLANJUTI -- 
										      		<i class="fa fa-file ic-w mr-1" style="color:red;"></i> TIDAK DAPAT DITINDAKLANJUTI 
									      		</marquee>
									      	</td>
									    </tr>
					                </tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
    </div>
</div>  
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>