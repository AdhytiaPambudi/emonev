<style>
/**/
	.nav-pills > li.active > a,
	.nav-pills > li.active > a:hover,
	.nav-pills > li.active > a:focus {
	  color: #fff;
	  background-color: #f8a406;
	  box-shadow: inset 3px 3px 4px #fcfcfc;
	}
	.nav-pills > li > a {
	  border-radius: 0px;
	}
	

</style>

<div class="panel panel-headline  panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">FORM EDIT TLHP KEMENDAGRI</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">

			<div class="box-body my-form-body">
				<ul id="mytabs" class="nav nav-pills nav-justified" role="tablist">
			    	<li role="presentation" id="tab_lhp" class="active"><a href="#data_lhp" aria-controls="data_lhp" role="tab" data-toggle="tab"><b>KELENGKAPAN TLHP</b></a></li>
			    	<li role="presentation" id="tab_temuan" class="disabled"><a href="#data_temuan" aria-controls="data_temuan" role="tab" data-toggle="tab"><b>KERTAS KERJA TLHP</b></a></li>
			  	</ul>
			  	<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
			  	<div class="tab-content">
				  	
					    <div role="tabpanel" class="tab-pane active" id="data_lhp">
						   	<div class="row">
								<div class="col-md-12">
									<div class="box-body my-form-body">
										<form class="form-horizontal" id="form-lhp">
											<div class="form-group">
												<label for="email" class="col-sm-3 control-label">Unit Kerja Eselon II</label>

												<div class="col-sm-3">
												   <select name="ins_pemeriksa" id="ins_pemeriksa" class="form-control" oninput="this.className = ''" required>
														<option value="">Pilih Inspektorat Pemeriksa</option>
														<?php foreach($ins as $row): ?>
														<?php if ($row->id_inspektorat == $id_inspektorat) {?>
														<option value="<?= $row->id_inspektorat; ?>" selected><?= $row->uraian; ?></option>
														<?php }else{ ?>
														<option value="<?= $row->id_inspektorat; ?>"><?= $row->uraian; ?></option>
														<?php } ?>
														<?php endforeach; ?>
												  </select>
												</div>
											  </div>
											  <div class="form-group hidden">
												<label for="firstname" class="col-sm-3 control-label">Tipe Daerah </label>

												<div class="col-sm-8">
													<input <?php echo $tipe == 'prov' ? 'checked' : '';  ?>
													       data-radiocharm-background-color="074979" 
													       data-radiocharm-text-color="FFF" 
													       data-radiocharm-label="Provinsi"
													       type="radio" class="tipe_daerah" value="prov" name ="tipe_daerah">
													<input <?php echo $tipe == 'kab' ? 'checked' : '';  ?> data-radiocharm-label="Kabupaten/Kota" 
													       data-radiocharm-background-color="F1C40F" 
													       data-radiocharm-text-color="FFF" 
													       type="radio" class="tipe_daerah" value="kab" name ="tipe_daerah">
										
										
												</div>	
													<input type="text" name="noreg" class="form-control input-sm hidden" id="noreg" placeholder="" value="<?=$noreg;?>">
										 			 <input type="text" name="daerah" class="form-control input-sm hidden" id="daerah" placeholder="" value="<?=$id_daerah;?>">
											  </div>
											  <div class="form-group">

												<label class="col-sm-3 control-label input-sm" id="label-tipe">Unit Kerja Kemendagri</label>

												<div class="col-sm-3">
												  <select name="prov" id="prov" class="form-control input-sm" style="width:100%">
														<?= $prov; ?>
												  </select>
												</div>
												<div class="col-sm-3"  id="combo-kab" <?php echo $tipe == 'kab' ? '' : 'hidden';  ?>>
												  <select name="kab" id="kab" class="form-control input-sm" style="width:100%">
														<?= $kab; ?>
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="password" class="col-sm-3 control-label input-sm">Tanggal Ekspose Konsep LHP</label>
												<div class="col-sm-2">
												  <input type="date" name="tgl_ekspose" class="form-control input-sm" id="tgl_ekspose" value="<?= $tgl_ekspose; ?>"  placeholder="" required>
												</div>
											  </div>
											  <div class="form-group">
												<label for="password" class="col-sm-3 control-label input-sm">Tanggal LHP</label>

												<div class="col-sm-2">
												  <input type="date" name="tgl_lhp" class="form-control input-sm" id="tgl_lhp" value="<?= $tgl_lhp; ?>" placeholder="" required>
												</div>
											  </div>

											  <div class="form-group">
												<label for="lastname" class="col-sm-3 control-label input-sm">Nomor LHP</label>

												<div class="col-sm-4">
												  <input type="text" name="no_lhp" class="form-control input-sm" id="no_lhp" placeholder="" value="<?=$no_lhp;?>" required readonly>
												</div>
											  </div>

											  <div class="form-group">
												<label for="mobile_no" class="col-sm-3 control-label input-sm">Pengendali Teknis Tim</label>

												<div class="col-sm-6">
													<select name="dalnis" id="dalnis" class="form-control input-sm" required>
														<?=$dalnis; ?>
												  	</select>
												  <!-- <input type="text" name="dalnis" class="form-control input-sm" id="dalnis" placeholder="" value="<?=$dalnis;?>" required> -->
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Tim</label>

												<div class="col-sm-4">
												  <select name="pembahas_apip" id="pembahas_apip" class="form-control input-sm" required>
													<?=$apip; ?>
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Unit Kerja Kemendagri</label>

												<div class="col-sm-4">
												  <!-- <select name="pembahas_obrik" id="pembahas_obrik" class="form-control input-sm" required>
													
												  </select> -->
												  <input type="text" name="pembahas_obrik" class="form-control input-sm" id="pembahas_obrik" placeholder="Isi Nama Petugas Unit Kerja Kemendagri" required value="<?=$obrik; ?>">
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Sekretariat</label>

												<div class="col-sm-4">
												  <select name="pembahas_anev" id="pembahas_anev" class="form-control input-sm" required>
														<?=$anev; ?>
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Validasi</label>

												<div class="col-sm-4">
												  <select name="review" id="review" class="form-control input-sm" required>
													<?=$review; ?>
												  </select>
												</div>
											  </div>
											  <center>
											  	
											  <a href="<?= base_url('tlhp-kemendagri');?>" class="btn btn-warning btn-lg"><i class="fa fa-arrow-left"></i> KEMBALI</a>
											  <button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan"><i class="fa fa-check"></i> UPDATE</button>
											  <button type="button"  data-aksi="new" class="btn btn-success btn-lg simpan hidden">INPUT BARU</button>
											  </center>

										</form>
									</div>
								</div>
					    	</div>

				    	</div>
					    <div role="tabpanel" class="tab-pane" id="data_temuan">
					    	<div class="row">
								<div class="col-md-12">
									<div class="box-body my-form-body">
										<form class="form-horizontal" id="form-temuan">
											<table id="list-data" class="table table-bordered table-striped;" style="background-color:#ccc;">
									                  <thead>
									                    <tr>
									                      <th colspan="4" width="100%" style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:14pt;">KELENGKAPAN TLHP</th>
									                    </tr>
									                  </thead>
									                  <tbody>
									                  	<tr>
									                  		<td><label>Unit Kerja Kemendagri</label></td>
									                  		<td><input type="text" name="d_daerah" class="form-control input-sm" id="d_daerah" readonly placeholder="">
									                  			<input type="text" name="d_id_daerah" class="form-control input-sm hidden" id="d_id_daerah" readonly placeholder="">
									                  		</td>
									                  		<td><label>Pengendali Teknis Tim</label></td>
									                  		<td><input type="text" name="d_dalnis" class="form-control input-sm" id="d_dalnis" readonly placeholder=""></td>
									                  	</tr>	
									                  	<tr>
									                  		<td><label>Nomor LHP</label></td>
									                  		<td><input type="text" name="d_no_lhp" class="form-control input-sm" id="d_no_lhp" readonly placeholder=""><input type="text" name="d_noreg" class="form-control input-sm hidden" id="d_noreg" readonly placeholder=""></td>
									                  		<td><label>Petugas Tim</label></td>
									                  		<td><input type="text" name="d_anev" class="form-control input-sm" id="d_anev" readonly placeholder=""></td>
									                  	</tr>	
									                  	<tr>
									                  		<td><label>Tanggal LHP</label></td>
									                  		<td><input type="text" name="d_tgl_lhp" class="form-control input-sm" id="d_tgl_lhp" readonly placeholder=""></td>
									                  		<td><label>Petugas Sekretariat</label></td>
									                  		<td><input type="text" name="d_apip" class="form-control input-sm" id="d_apip" readonly placeholder=""></td>
									                  	</tr>	
									                  	<tr>
									                  		<td><label>Tanggal Ekspose Konsep LHP</label></td>
									                  		<td><input type="text" name="d_tgl_ekspose" class="form-control input-sm" id="d_tgl_ekspose" readonly placeholder=""></td>
									                  		<td><label>Petugas Unit Kerja Kemendagri</label></td>
									                  		<td><input type="text" name="d_obrik" class="form-control input-sm" id="d_obrik" readonly placeholder=""></td>
									                  	</tr>	
									                  	<tr>
									                  		<td><label>Unit Kerja Eselon II</label></td>
									                  		<td><input type="text" name="d_inspektorat" class="form-control input-sm" id="d_inspektorat" readonly placeholder=""></td>
									                  		<td><label>Petugas Validasi</label></td>
									                  		<td><input type="text" name="d_review" class="form-control input-sm" id="d_review" readonly placeholder=""></td>
									                  	</tr>	
									                  </tbody>
									                 <tfoot>
										                  	<th colspan="4" width="100%" style="text-align: right;font-weight:bold;color:#fff;font-size:14pt;">
										                  		<div class="btn-group" id="print">
																	<button type="button" class="btn btn-primary"  id="daftar_temuan">DAFTAR TEMUAN <span class="badge badge-light" id='jml_temuan'></span></button>
																	</div> 

										                  	</th>
									                  </tfoot>
									                </table>
											<!-- <div class="form-group">
												<label for="firstname" class="col-sm-3 control-label">Jenis Pengawasan</label>

												<div class="col-sm-8">
													<input checked 
													       data-radiocharm-background-color="074979" 
													       data-radiocharm-text-color="FFF" 
													       data-radiocharm-label="Umum"
													       type="radio" class="jns_aspek" value="umum" name ="jns_aspek">
													<input data-radiocharm-label="Teknis" 
													       data-radiocharm-background-color="F1C40F" 
													       data-radiocharm-text-color="FFF" 
													       type="radio" class="jns_aspek" value="teknis" name ="jns_aspek">
												</div>	
											  </div> -->

											  <div class="form-group">
												<label for="firstname" class="col-sm-3 control-label">Jenis Pengawasan</label>

												<div class="col-sm-8">
													<input checked 
													       data-radiocharm-background-color="074979" 
													       data-radiocharm-text-color="FFF" 
													       data-radiocharm-label="Reviu"
													       type="radio" class="jns_aspek" value="R" name ="jns_aspek">
													<input data-radiocharm-label="Monitoring" 
													       data-radiocharm-background-color="F1C40F" 
													       data-radiocharm-text-color="FFF" 
													       type="radio" class="jns_aspek" value="M" name ="jns_aspek">
													<input data-radiocharm-label="Evaluasi" 
													       data-radiocharm-background-color="0a591a" 
													       data-radiocharm-text-color="FFF" 
													       type="radio" class="jns_aspek" value="E" name ="jns_aspek">
													<input data-radiocharm-label="Audit (Kinerja)" 
													       data-radiocharm-background-color="370b4d" 
													       data-radiocharm-text-color="FFF" 
													       type="radio" class="jns_aspek" value="K" name ="jns_aspek">
													<input data-radiocharm-label="Audit (Dekon/TP)" 
													       data-radiocharm-background-color="590b24" 
													       data-radiocharm-text-color="FFF" 
													       type="radio" class="jns_aspek" value="D" name ="jns_aspek">
												</div>	
											  </div>

											  <div class="form-group">

												<label class="col-sm-3 control-label input-sm" id="label-tipe">Aspek Pengawasan</label>

												<div class="col-sm-8">
												  <select name="aspek" id="aspek" class="form-control input-sm" style="width:100%">
																	
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="kd_temuan" class="col-sm-3 control-label input-sm">Kode Temuan</label>

												<div class="col-sm-3">
												  <input type="text" name="kd_temuan" class="form-control input-sm" readonly="" id="kd_temuan" placeholder="">
												</div>
											  </div>
											  <div class="form-group">
												<label for="kd_temuan" class="col-sm-3 control-label input-sm">Temuan</label>

												<div class="col-sm-8">
												  <input type="text" name="jdl_temuan" class="form-control input-sm" id="jdl_temuan" placeholder="">
												</div>
											  </div>

											  <div class="form-group">
											  	<label for="kd_temuan" class="col-sm-3 control-label input-sm">Rekomendasi</label>
											  	<div class="col-sm-8">
											  		<table id="list-data" class="table table-bordered table-striped">
									                  <thead>
									                    <tr>
									                      <th width="20%" style="text-align: left;">Kode Rekomendasi</th>
									                      <th width="70%" style="text-align: left;">Rekomendasi</th>
									                      <th width="10%" style="text-align: left;">Aksi</th>
									                    </tr>
									                  </thead>
									                  <tbody id="tbody_rekom">

									                  </tbody>
									                  <tfoot>
									                  	<tr>
									                  		<td colspan="2" width="100%">
									                  			<div class="btn btn-primary" id="add_rekom" style="width:100%;">Tambah</div>
									                  		</td>
									                  		<td width="100%" style="align: center;">
									                  			<center>
									                  				<div class="btn btn-danger" id="reset_rekom" style="width:100%;">Reset</div>
									                  			</center>
									                  		</td>
									                  	</tr>
									                  </tfoot>
									                </table>
											  	</div>
											  </div>
											  <div class="form-group">
												<label for="kd_temuan" class="col-sm-3 control-label input-sm">Nilai Temuan</label>

												<div class="col-sm-3">
												  <input type="text" name="nilai_temuan" class="form-control input-sm function_separator" id="nilai_temuan" placeholder="">
												</div>
											  </div>
											  <center>
												  <a href="<?= base_url('tlhp-kemendagri');?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-down"></i> TUTUP</a>
												   <button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check"></i> SIMPAN TEMUAN</button>
												  <button type="button"  data-aksi="new" class="btn btn-primary btn-lg simpan-temuan"><i class="fa fa-plus"></i> INPUT TEMUAN BARU</button>
												  <a href="#" class="btn btn-default btn-lg hidden" id="modalCon">Modal</a>
											  </center>
										</form>
									</div>
								</div>
					    	</div>

					    </div>
				  </div>
				<!-- <form id="regForm" action="/action_page.php"> -->
			  </div>
		</div>
    </div>
</div>  


<!-- Modal -->
<div class="modal fade" id="modalTemuan" tabindex="-1" role="dialog" aria-labelledby="modalTemuanLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalTemuanLabel">DAFTAR TEMUAN</h4>
      </div>
      <div class="modal-body" id="list_temuan">
       

        <!-- <?php echo form_close( ); ?> -->
      </div>
      <div class="modal-footer">
      	<marquee width="100%" >INFO STATUS : 
      		<i class="fa fa-file ic-w mr-1" style="color:deepskyblue;"></i> SESUAI -- 
      		<i class="fa fa-file ic-w mr-1" style="color:forestgreen;"></i> BELUM SESUAI -- 
      		<i class="fa fa-file ic-w mr-1" style="color:gold;"></i> BELUM DITINDAKLANJUTI -- 
      		<i class="fa fa-file ic-w mr-1" style="color:red;"></i> TIDAK DAPAT DITINDAKLANJUTI 
      	</marquee>
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiLabel">
  <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalKonfirmasiLabel">KONFIRMASI</h4>
      </div>
      <div class="modal-body">
      	<center><img src="<?= base_url() ?>assets/img/kemendagri.png" style="width:64px; height:80px;"></center>
      	<br>
      	<div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
      	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	       	<a href="<?= base_url('tlhp-kemendagri'); ?>" class="btn btn-default btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali ke Dashboard</a>
	       	<a href="<?= base_url('tlhp-kemendagri/add'); ?>" class="btn btn-default btn-lg"><i class="fa fa-plus"></i> Input LHP Baru</a>
	       	<a href="#" class="btn btn-default btn-lg " data-dismiss="modal" aria-label="Close"><i class="fa fa-hand-o-down"></i> Tetap di Halaman ini</a>
			<a href="<?= base_url('tlhp-kemendagri/tindak-lanjut'.'?noreg='.$noreg.'&no_lhp='.$no_lhp); ?>" class="btn btn-default btn-lg">Lanjut ke TLHP <i class="fa fa-arrow-circle-right"></i></a>
		</div>

        <!-- <?php echo form_close( ); ?> -->
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script>
$(window).on('load', function () {
	// set value
	$('#ins_pemeriksa').select2({disabled:true});
	$('#prov').select2({disabled:true});
	$('#kab').select2({disabled:true});

	var jns='R';
		$.ajax({
		  url: '<?php echo base_url('tlhp-kemendagri/getaspek'); ?>',
		  data:{kode:jns},
		  type: 'POST'
		}).done(function(data2) {
		  	var out = jQuery.parseJSON(data2);
			  	$('#aspek').html(out.aspek);
		})
})



		// $('#form-lhp').submit(function(e) {
			$(document).on("click", ".simpan", function(e) {

		    var data = $('#form-lhp').serialize();
		    var inspektorat = $('#ins_pemeriksa').val();
		    var daerah = $('#daerah').val();
		    var no_lhp = $('#no_lhp').val();
		    var dalnis = $('#dalnis').val();
		    var tgl_lhp = $('#tgl_lhp').val();
		    var tgl_ekspose = $('#tgl_ekspose').val();
		    var pembahas_anev = $('#pembahas_anev').val();
		    var pembahas_apip = $('#pembahas_apip').val();
		    var pembahas_obrik = $('#pembahas_obrik').val();
		    var review = $('#review').val();

		    var noreg = '<?=$noreg;?>';

		    if (inspektorat == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA UNIT KERJA ESELON II BELUM DIISI',showConfirmButton: false,timer: 2000});

				exit();
		    }
		    if (daerah == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA UNIT KERJA KEMENDAGRI BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (no_lhp == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NOMOR LHP BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (dalnis == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA PENGENDALI TEKNIS TIM BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (tgl_lhp == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA TANGGAL LHP BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (tgl_ekspose == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA TANGGAL EKSPOSE KONSEP LHP BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (pembahas_anev == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA PETUGAS SEKRETARIAT BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (pembahas_apip == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA PETUGAS TIM BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (pembahas_obrik == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA PETUGAS UNIT KERJA KEMENDAGRI BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (review == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA PETUGAS VALIDASI BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }

		    
		    

		    var aksi = $(this).attr('data-aksi');


		    // cek no lhp
		   
						    $.ajax({
						      method: 'POST',
						      url: '<?php echo base_url('tlhp-kemendagri/update'); ?>?noreg='+noreg+'&no_lhp='+no_lhp,
						      data: data
						    })
						    .done(function(data) {
						    	if (aksi == 'simpan') {
						    		$('#tab_temuan').removeAttr('class','disabled'); // Select last tab
						    		// $('#myTabs a:last').tab('show'); // Select last tab
						    		$('#tab_temuan').tab('show');
						    		$('#data_lhp').removeAttr('class','active');
						    		$('#data_lhp').attr('class','tab-pane');
						    		$('#data_temuan').attr('class','tab-pane active');
						    		
						    	}else{
						    		clear_form_lhp();
						    	}


						      var out = jQuery.parseJSON(data);
						      	$('#d_id_daerah').val(out.id_daerah);
						      	$('#d_daerah').val(out.daerah);
						      	$('#d_no_lhp').val(out.no_lhp);
						      	$('#d_noreg').val(out.noreg);
						      	$('#d_inspektorat').val(out.inspektorat);
						      	$('#d_dalnis').val(out.dalnis);
						      	$('#d_tgl_ekspose').val(out.tgl_ekspose);
						      	$('#d_tgl_lhp').val(out.tgl_lhp);
						      	$('#d_anev').val(out.anev);
						      	$('#d_apip').val(out.apip);
						      	$('#d_obrik').val(out.obrik);
						      	$('#d_review').val(out.review);
						      	$('#jml_temuan').html(out.jml_temuan);
						      	

						    	Swal.fire({
								  position: 'top-end',
								  icon: 'success',
								  title: out.pesan,
								  showConfirmButton: false,
								  timer: 2000
								});
						    })
						// end
					

		    // end cek no lhp

		  //   $.ajax({
		  //     method: 'POST',
		  //     url: '<?php echo base_url('tlhp-kemendagri/insert'); ?>',
		  //     data: data
		  //   })
		  //   .done(function(data) {
		  //   	if (aksi == 'simpan') {
		  //   		$('#tab_temuan').removeAttr('class','disabled'); // Select last tab
		  //   		// $('#myTabs a:last').tab('show'); // Select last tab
		  //   		$('#tab_temuan').tab('show');
		  //   		$('#data_lhp').removeAttr('class','active');
		  //   		$('#data_lhp').attr('class','tab-pane');
		  //   		$('#data_temuan').attr('class','tab-pane active');
		    		
		  //   	}else{
		  //   		clear_form_lhp();
		  //   	}


		  //     var out = jQuery.parseJSON(data);
		  //     	$('#d_id_daerah').val(out.id_daerah);
		  //     	$('#d_daerah').val(out.daerah);
		  //     	$('#d_no_lhp').val(out.no_lhp);
		  //     	$('#d_inspektorat').val(out.inspektorat);
		  //     	$('#d_dalnis').val(out.dalnis);
		  //     	$('#d_tgl_ekspose').val(out.tgl_ekspose);
		  //     	$('#d_tgl_lhp').val(out.tgl_lhp);
		  //     	$('#d_anev').val(out.anev);
		  //     	$('#d_apip').val(out.apip);
		  //     	$('#d_obrik').val(out.obrik);
		  //     	$('#d_review').val(out.review);

		  //   	Swal.fire({
				//   position: 'top-end',
				//   icon: 'success',
				//   title: out.pesan,
				//   showConfirmButton: false,
				//   timer: 2000
				// });
		  //   })
		    
		    e.preventDefault();
		  });

			$(document).on("click", ".simpan-temuan", function(e) {
		    var data = $('#form-temuan').serialize();

		    var aspek = $('#aspek').val();
		    var jdl_temuan = $('#jdl_temuan').val();
		    var nilai_temuan = $('#nilai_temuan').val();

		    if (aspek == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA ASPEK/OBRIK BELUM DIPILIH',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (jdl_temuan == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA JUDUL TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (nilai_temuan == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NILAI TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }


		    var aksi = $(this).attr('data-aksi');
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-kemendagri/insert-temuan'); ?>',
		      data: data
		    })
		    .done(function(data) {
		    	if (aksi == 'simpan') {
		    		$('#modalKonfirmasi').modal('show');
		    		e.preventDefault();
		    	}else{
		    		clear_form_temuan();
		    	}
		      var out = jQuery.parseJSON(data);
		    	Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: out.pesan,
				  showConfirmButton: false,
				  timer: 2000
				});
				$('#jml_temuan').html(out.jml_temuan);
		    })
		    
		    e.preventDefault();
		  });


		$(document).on("click", ".tes", function(e) {
		   	
		    alert('tes');
		    e.preventDefault();
		  });


		  $(document).on("click", ".back_to_list", function(e) {
		    $('#form-edit-temuan').attr('hidden','');
		    $('#form-edit-rekomendasi').attr('hidden','');
          	$('#daftar-list-lhp').removeAttr('hidden');
		    e.preventDefault();

		  });



		$(document).on("click", "#daftar_temuan", function(e) {
			var noreg = '<?=$noreg;?>';
			var no_lhp = '<?=$no_lhp;?>';
			
		    



		    var aksi = $(this).attr('data-aksi');
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-kemendagri/get-modal-temuan'); ?>?noreg='+noreg+'&no_lhp='+no_lhp,
		    })
		    .done(function(data) {
		    	$('#list_temuan').html(data);
				$('#modalTemuan').modal('show');
		      	
		    })
		    
		    e.preventDefault();
		  });

		$(document).on("click", "#modalCon", function(e) {
			$('#modalKonfirmasi').modal('show');
		    
		    e.preventDefault();
		  });

function clear_form_lhp() {
	
 	$('#ins_pemeriksa').val('');
	$('#ins_pemeriksa').select2().trigger('change');
	$('#prov').val('');
	$('#prov').select2().trigger('change');
	$('#kab').val('');
	$('#kab').select2().trigger('change');
	$('#pembahas_anev').val('');
	$('#pembahas_anev').select2().trigger('change');

	$('#pembahas_apip').val('');
	$('#pembahas_apip').select2().trigger('change');
	$('#pembahas_obrik').val('');
	// $('#pembahas_obrik').select2().trigger('change');
	$('#review').val('');
	$('#review').select2().trigger('change');
	$('#no_lhp').val('');
	$('#dalins').val('');
	$('#dalnis').select2().trigger('change');
		
}

function clear_form_temuan() {
	var jns='R';
	$.ajax({
	  url: '<?php echo base_url('tlhp-kemendagri/getaspek'); ?>',
	  data:{kode:jns},
	  type: 'POST'
	}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
		  	$('#aspek').html(out.aspek);
	 });
	$('#kd_temuan').val('');
	$('#jdl_temuan').val('');
	$('#nilai_temuan').val('');
	$('#tbody_rekom').html('');
	no = 1;
	
		
}

$("#add_user").addClass('active');
$('input:radio').radiocharm({
	'uncheckable': false
});
$('#prov').select2({
  	placeholder: 'Pilih Unit Kerja Kemendagri'
});
$('#kab').select2({
  	placeholder: 'Pilih Kabupaten/Kota'
});
$('#ins_pemeriksa').select2({
  	placeholder: 'Pilih Inspektorat Pemeriksa'
});

$('#dalnis').select2({
  	placeholder: 'Pilih Pengendali Teknis Tim'
});

$('#pembahas_anev').select2({
  	placeholder: 'Pilih Petugas Sekretariat'
});
$('#pembahas_apip').select2({
  	placeholder: 'Pilih Petugas Tim'
});
// $('#pembahas_obrik').select2({
//   	placeholder: 'Pilih Pembahas Obrik'
// });
$('#review').select2({
  	placeholder: 'Pilih Petugas Validasi'
});
$('#aspek').select2({
  	placeholder: 'Pilih Aspek Pengawasan'
});

$("#ins_pemeriksa").change(function(){
	var ins=$(this).val();
	$.ajax({
	  url: '<?php echo base_url('tlhp-kemendagri/getprov'); ?>',
	  data:{kode:ins},
	  type: 'POST'
	 //  	success: function(data){
		// }
	}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
		  	$('#prov').html(out.prov);
		  	$('#pembahas_anev').html(out.anev);
		  	$('#pembahas_apip').html(out.apip);
		  	// $('#pembahas_obrik').html(out.obrik);
		  	$('#review').html(out.review);
		  	$('#daerah').val('');
	    })

});


 $(".tipe_daerah").change(function(){
	var tipe=$(this).val();
		  	var daerah;
			if (tipe == 'kab') {
				var kabupaten = document.getElementById('kab').value;
				daerah = kabupaten;
			}else{
				var provinsi = document.getElementById('prov').value;
				daerah = provinsi;
			}
		  	$('#daerah').val(daerah);
	if (tipe=='kab') {
		$('#combo-kab').removeAttr('hidden','');
	}else{
		$('#combo-kab').attr('hidden','');
	}
});

 $(".jns_aspek").change(function(){
	var jns=$(this).val();
	
	$.ajax({
	  url: '<?php echo base_url('tlhp-kemendagri/getaspek'); ?>',
	  data:{kode:jns},
	  type: 'POST'
	}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
		  	$('#aspek').html(out.aspek);
		  	$('#kd_temuan').val('');
	    })
});

$("#aspek").change(function(){
	var tipe = $('input[name=tipe_daerah]:checked').val();

	var daerah;
	if (tipe == 'kab') {
		var kabupaten = document.getElementById('kab').value;
		daerah = kabupaten;
	}else{
		var provinsi = document.getElementById('prov').value;
		daerah = provinsi;
	}
	var tahun = '<?= $this->session->userdata("year_selected"); ?>'
	var aspek=$(this).val();
	var noreg = '<?=$noreg; ?>';
	var no_lhp = '<?=$no_lhp ?>';
	$.ajax({
	  url: '<?php echo base_url('tlhp-kemendagri/getmax-temuan'); ?>',
	  data:{kode:aspek,noreg:noreg,no_lhp:no_lhp},
	  type: 'POST'
	}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
		  	$('#kd_temuan').val(out.max);
	    })
});

 $("#prov").change(function(){
	var header=$(this).val();

	$.ajax({
	  url: '<?php echo base_url('data-user/getkab'); ?>',
	  data:{kode:header},
	  type: 'POST',
	  	success: function(data){
		  	$('#kab').html(data);
			var tipe = $('input[name=tipe_daerah]:checked').val();
		  	var daerah;
			if (tipe == 'kab') {
				var kabupaten = document.getElementById('kab').value;
				daerah = kabupaten;
			}else{
				var provinsi = document.getElementById('prov').value;
				daerah = provinsi;
			}
		  	$('#daerah').val(daerah);
		}
	})
});

 $("#kab").change(function(){
	var header=$(this).val();	
	var tipe = $('input[name=tipe_daerah]:checked').val();
		  	var daerah;
			if (tipe == 'kab') {
				var kabupaten = document.getElementById('kab').value;
				daerah = kabupaten;
			}else{
				var provinsi = document.getElementById('prov').value;
				daerah = provinsi;
			}
		  	$('#daerah').val(daerah);
});
var no = 1;
 $("#add_rekom").click(function(event){
 	var tbl = document.getElementById("tbody_rekom").innerHTML;

 	if (tbl == '') {
 		no = 1;
 	}
 	var obrik = document.getElementById('aspek').value;
 	if (obrik == '') {
 		Swal.fire({
		  icon: 'warning',
		  title: 'PERINGATAN!',
		  text: 'HARAP ISI ASPEK TERLEBIH DAHULU',
		})
		exit();
 	};
 	var str = '0'+no;
 	var res = str.substring(-2);
 	 var kd_temuan = document.getElementById('kd_temuan').value;
 	 var urut = kd_temuan+res;
 	var rekom = '<tr id = "baris'+urut+'">'+
			      '<td width="20%" style="text-align: left;"><input type="text" value = "'+urut+'"	name="id_rekom[]" class="form-control input-sm" placeholder="" readonly></td>'+
			      '<td width="70%" style="text-align: left;"><input type="text" name="nm_rekom[]" class="form-control input-sm" placeholder=""></td>'+
			      '<td width="10%" style="text-align: left;"><input type="button" class="btn btn-sm btn-danger" value="Hapus" onclick="deleteRow(this)"/></td>'+
			    '</tr>';
	$('#tbody_rekom').append(rekom);
 	no++;
  event.preventDefault();
})

 $("#reset_rekom").click(function(event){
 	var no = 1;	
	$('#tbody_rekom').html('');
 
})

 $(document).on("click", ".hapusTemuan", function() {

		var noreg 		= $(this).attr("data-reg");
		var lhp 		= $(this).attr("data-lhp");
		var kode 		= $(this).attr("data-kode");
        var nama 	= $(this).attr("data-nama");


        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Menghapus data ("+noreg+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#074979',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Hapus Data Ini.'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-kemendagri/del-temuan'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
		    })
		    .done(function(data) {
		    	var out = jQuery.parseJSON(data);
			  	Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: out.pesan,
				  showConfirmButton: false,
				  timer: 2000
				});
				$('#jml_temuan').html(out.jml_temuan);
		    	$('#modalTemuan').modal('hide');
		    })
		    // document.location.href = "<?= base_url('tlhp-kemendagri/del-temuan?'); ?>noreg="+noreg+"&lhp="+lhp+"&kode="+kode;
		  }
		})

});

 $(document).on("click", ".hapusRekom", function() {

		var noreg 		= $(this).attr("data-reg");
		var lhp 		= $(this).attr("data-lhp");
		var kode 		= $(this).attr("data-kode");
        var nama 	= $(this).attr("data-nama");
        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Menghapus data ("+noreg+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#074979',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Hapus Data Ini.'
		}).then((result) => {
		  if (result.value) {
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-kemendagri/del-rekomendasi'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
		    })
		    .done(function(data) {
		    	var out = jQuery.parseJSON(data);
			  	Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: out.pesan,
				  showConfirmButton: false,
				  timer: 2000
				});
		    	$('#modalTemuan').modal('hide');
		    	
		    })
		  }
		})
});

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}
</script>    