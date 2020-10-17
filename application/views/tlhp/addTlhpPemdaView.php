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
		<h3 class="panel-title">Form Tambah TLHP Pemda</h3>
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
														<option value="<?= $row->id_inspektorat; ?>"><?= $row->uraian; ?></option>
														<?php endforeach; ?>
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="firstname" class="col-sm-3 control-label">Tipe Daerah</label>

												<div class="col-sm-8">
													<input checked 
													       data-radiocharm-background-color="074979" 
													       data-radiocharm-text-color="FFF" 
													       data-radiocharm-label="Provinsi"
													       type="radio" class="tipe_daerah" value="prov" name ="tipe_daerah">
													<input data-radiocharm-label="Kabupaten/Kota" 
													       data-radiocharm-background-color="F1C40F" 
													       data-radiocharm-text-color="FFF" 
													       type="radio" class="tipe_daerah" value="kab" name ="tipe_daerah">
										
										
												</div>	
										 			 <input type="text" name="daerah" class="form-control input-sm hidden" id="daerah" placeholder="" >
											  </div>
											  <div class="form-group">

												<label class="col-sm-3 control-label input-sm" id="label-tipe">Nama Daerah</label>

												<div class="col-sm-3">
												  <select name="prov" id="prov" class="form-control input-sm" style="width:100%">
																	
												  </select>
												</div>
												<div class="col-sm-3"  id="combo-kab" hidden>
												  <select name="kab" id="kab" class="form-control input-sm" style="width:100%">
													
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="password" class="col-sm-3 control-label input-sm">Tanggal Ekspose Konsep LHP</label>
												<div class="col-sm-2">
												  <input type="date" name="tgl_ekspose" class="form-control input-sm" id="tgl_ekspose" value="<?= date('Y-m-d') ?>"  placeholder="" required>
												</div>
											  </div>
											  <div class="form-group">
												<label for="password" class="col-sm-3 control-label input-sm">Tanggal LHP</label>

												<div class="col-sm-2">
												  <input type="date" name="tgl_lhp" class="form-control input-sm" id="tgl_lhp" value="<?= date('Y-m-d') ?>" placeholder="" required>
												</div>
											  </div>

											  <div class="form-group">
												<label for="lastname" class="col-sm-3 control-label input-sm">Nomor LHP</label>

												<div class="col-sm-4">
												  <input type="text" name="no_lhp" class="form-control input-sm" id="no_lhp" placeholder="Isi Nomor LHP" required>
												</div>
											  </div>

											  <div class="form-group">
												<label for="mobile_no" class="col-sm-3 control-label input-sm">Pengendali Teknis Tim</label>

												<div class="col-sm-5">
												<select name="dalnis" id="dalnis" class="form-control input-sm" required>
													
												  </select>
												  <!-- <input type="text" name="dalnis" class="form-control input-sm" id="dalnis" placeholder="" required> -->
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Tim</label>

												<div class="col-sm-4">
												  <select name="pembahas_apip" id="pembahas_apip" class="form-control input-sm" required>
													
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Daerah</label>

												<div class="col-sm-4">
												  <!-- <select name="pembahas_obrik" id="pembahas_obrik" class="form-control input-sm" required>
													
												  </select> -->
												  <input type="text" name="pembahas_obrik" class="form-control input-sm" id="pembahas_obrik" placeholder="Isi Nama Petugas Daerah" required>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Sekretariat</label>

												<div class="col-sm-4">
												  <select name="pembahas_anev" id="pembahas_anev" class="form-control input-sm" required>
													
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Validasi</label>

												<div class="col-sm-4">
												  <select name="review" id="review" class="form-control input-sm" required>
													
												  </select>
												</div>
											  </div>
											  <center>
											  <!-- <button type="button" data-aksi="simpan" class="btn btn-success btn-lg tes">tes</button> -->	
											  <a href="<?= base_url('tlhp-pemda');?>" class="btn btn-warning btn-lg"><i class="fa fa-arrow-left"></i> KEMBALI</a>
											  <button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan"><i class="fa fa-check"></i> SIMPAN</button>
											  <button type="button"  data-aksi="new" class="btn btn-primary btn-lg simpan"><i class="fa fa-plus"></i> INPUT BARU</button>
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
									                  		<td><label>Nama Daerah</label></td>
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
									                  		<td><input type="text" name="d_apip" class="form-control input-sm" id="d_apip" readonly placeholder=""></td>
									                  	</tr>	
									                  	<tr>
									                  		<td><label>Tanggal LHP</label></td>
									                  		<td><input type="text" name="d_tgl_lhp" class="form-control input-sm" id="d_tgl_lhp" readonly placeholder=""></td>
									                  		<td><label>Petugas Sekretariat</label></td>
									                  		<td><input type="text" name="d_anev" class="form-control input-sm" id="d_anev" readonly placeholder=""></td>
									                  	</tr>	
									                  	<tr>
									                  		<td><label>Tanggal Ekspose Konsep LHP</label></td>
									                  		<td><input type="text" name="d_tgl_ekspose" class="form-control input-sm" id="d_tgl_ekspose" readonly placeholder=""></td>
									                  		<td><label>Petugas Daerah</label></td>
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
																	<button type="button" class="btn btn-primary"  id="daftar_temuan">DAFTAR TEMUAN <span class="badge badge-light" id= "jml_temuan"></span></button>
																	</div> 

										                  	</th>
									                  </tfoot>
									                 
									                </table>
											<div class="form-group">
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
												  <a href="<?= base_url('tlhp-pemda');?>" class="btn btn-danger btn-lg"><i class="fa fa-arrow-down"></i> TUTUP</a>
												   <button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan"><i class="fa fa-check"></i> SIMPAN TEMUAN</button>
												  <button type="button"  data-aksi="new" class="btn btn-primary btn-lg simpan-temuan"><i class="fa fa-plus"></i> INPUT TEMUAN BARU</button>
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
      		<i class="fa fa-file ic-w mr-1" style="color:lime;"></i> SESUAI -- 
      		<i class="fa fa-file ic-w mr-1" style="color:yellow;"></i> BELUM SESUAI -- 
      		<i class="fa fa-file ic-w mr-1" style="color:gray;"></i> BELUM DITINDAKLANJUTI -- 
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
	       	<a href="<?= base_url('tlhp-pemda'); ?>" class="btn btn-default btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali ke Dashboard</a>
	       	<a href="<?= base_url('tlhp-pemda/add'); ?>" class="btn btn-default btn-lg"><i class="fa fa-plus"></i> Input LHP Baru</a>
	       	<a href="#" class="btn btn-default btn-lg " data-dismiss="modal" aria-label="Close"><i class="fa fa-hand-o-down"></i> Tetap di Halaman ini</a>
			<a href="#" class="btn btn-default btn-lg tlanjut">Lanjut ke TLHP <i class="fa fa-arrow-circle-right"></i></a>
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
// var currentTab = 0; // Current tab is set to be the first tab (0)
// showTab(currentTab); // Display the current tab

// function showTab(n) {
//   // This function will display the specified tab of the form...
//   var x = document.getElementsByClassName("tab");
//   x[n].style.display = "block";
//   //... and fix the Previous/Next buttons:
//   if (n == 0) {
//     document.getElementById("prevBtn").style.display = "none";
//   } else {
//     document.getElementById("prevBtn").style.display = "inline";
//   }
//   if (n == (x.length - 1)) {
//     document.getElementById("nextBtn").innerHTML = "Simpan";
//   } else {
//     document.getElementById("nextBtn").innerHTML = "Berikutnya";
//   }
//   //... and run a function that will display the correct step indicator:
//   fixStepIndicator(n)
// }

// function nextPrev(n) {
//   // This function will figure out which tab to display
//   var x = document.getElementsByClassName("tab");
//   // Exit the function if any field in the current tab is invalid:
//   if (n == 1 && !validateForm()) return false;
//   // Hide the current tab:
//   x[currentTab].style.display = "none";
//   // Increase or decrease the current tab by 1:
//   currentTab = currentTab + n;
//   // if you have reached the end of the form...
//   if (currentTab >= x.length) {
//     // ... the form gets submitted:
//     document.getElementById("regForm").submit();
//     return false;
//   }
//   // Otherwise, display the correct tab:
//   showTab(currentTab);
// }

// function validateForm() {
//   // This function deals with validation of the form fields
//   var x, y, i, valid = true;
//   x = document.getElementsByClassName("tab");
//   y = x[currentTab].getElementsByTagName("input");
//   // A loop that checks every input field in the current tab:
//   for (i = 0; i < y.length; i++) {
//     // If a field is empty...
//     if (y[i].value == "") {
//       // add an "invalid" class to the field:
//       y[i].className += " invalid";
//       // and set the current valid status to false
//       valid = false;
//     }
//   }
//   // If the valid status is true, mark the step as finished and valid:
//   if (valid) {
//     document.getElementsByClassName("step")[currentTab].className += " finish";
//   }
//   return valid; // return the valid status
// }

// function fixStepIndicator(n) {
//   // This function removes the "active" class of all steps...
//   var i, x = document.getElementsByClassName("step");
//   for (i = 0; i < x.length; i++) {
//     x[i].className = x[i].className.replace(" active", "");
//   }
//   //... and adds the "active" class on the current step:
//   x[n].className += " active";
// }
</script>

<script>
$(window).on('load', function () {
	
	<?php 
		$this->session->set_userdata(array('cart'=>0));
	 ?>
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip();
	});
			// Treeview Initialization
	$(document).ready(function() {
	  $('.treeview-animated').mdbTreeview();
	});
  	// $.ajax({
		 //  url: '<?php echo base_url('pengawasan-teknis/get_tree'); ?>',
		 //  type: 'POST',
		 //  success: function(data){
		 //  	$("#tree_parameter").html(data);
		 //  }
	  // })
	


	var kabupaten = "<?php  echo $this->session->userdata('id_kab'); ?>";
	if (kabupaten == 1 || kabupaten == '') {
	
	}else{
		$('.user-akses').attr('hidden','');
	}
  	$.ajax({
		  url: '<?php echo base_url('pengawasan-teknis/get_tree_mdb'); ?>',
		  type: 'POST',
		  data:{kab:kabupaten},
		  success: function(data){
		  	$("#treeview-mdbootstrap").html(data);
		  }
	  });



	 
		var jns='umum';
		$.ajax({
		  url: '<?php echo base_url('tlhp-pemda/getaspek'); ?>',
		  data:{kode:jns},
		  type: 'POST'
		}).done(function(data2) {
		  	var out = jQuery.parseJSON(data2);
			  	$('#aspek').html(out.aspek);
		})
	

  	var kode = 1;
  	$.ajax({
		  url: '<?php echo base_url('data-user/getprov'); ?>',
		  data:{kode:kode},
		  type: 'POST',
		  success: function(data){
		  	$("#prov").html(data);
		  }
	  })
  	// $.ajax({
		 //  url: '<?php echo base_url('pengawasan-teknis/target'); ?>',
		 //  type: 'POST',
		 //  success: function(data){
		 //  	$(".showTarget").html(data);
		 //  }
	  // })

	var tipe = $('input[name=tipe_daerah]:checked').val();
    	var daerah;
    	if (tipe == 'kab') {
    		var kabupaten = document.getElementById('kab').value;
    		daerah = kabupaten;
    	}else{
    		var provinsi = document.getElementById('prov').value;
    		daerah = provinsi;
    	}
  	$.ajax({
		  url: '<?php echo base_url('pengawasan-teknis/target'); ?>',
		  type: 'POST',
		  data:{kode:daerah}
	  }).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
	      
	  	$(".showTarget").html(out.btn);
	  	$("#nilai2").val(out.nilai);
	  	$("#id_daerah2").val(daerah);
	    })


	  
		var jns='umum';
		$.ajax({
		  url: '<?php echo base_url('tlhp-pemda/getaspek'); ?>',
		  data:{kode:jns},
		  type: 'POST'
		}).done(function(data2) {
		  	var out = jQuery.parseJSON(data2);
			  	$('#aspek').html(out.aspek);
		    })
	
});

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
		    var noreg = '<?=$this->session->userdata("year_selected");?>'+'-'+daerah;

		    if (inspektorat == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA UNIT KERJA ESELON II BELUM DIISI',showConfirmButton: false,timer: 2000});
				
				exit();
		    }
		    if (daerah == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NAMA DAERAH BELUM DIISI',showConfirmButton: false,timer: 2000});
		    	
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
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA PETUGAS DAERAH BELUM DIISI',showConfirmButton: false,timer: 2000});
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
		      url: '<?php echo base_url('tlhp-pemda/cek-no-lhp'); ?>',
		      data: data
		    })
		    .done(function(dataCek) {
		    	    var out = jQuery.parseJSON(dataCek);
		    	    var sts = out.status;
		    	    var lhp = out.no_lhp;
		    	    if (sts == 'ada') {
		    	    	 Swal.fire({
						  title: 'NO LHP TELAH TERDAFTAR',
						  text: "Apakah anda ingin mengupdate data "+lhp+" ?",
						  icon: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Ya, Lakukan Update Data!',
						  cancelButtonText: 'Batal'
						}).then((result) => {
						  if (result.value) {
						    $.ajax({
						      method: 'POST',
						      url: '<?php echo base_url('tlhp-pemda/update'); ?>?noreg='+noreg+'&no_lhp='+no_lhp,
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
						  }
						})
		    	    }else{
		    	    	  $.ajax({
						      method: 'POST',
						      url: '<?php echo base_url('tlhp-pemda/insert'); ?>',
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
		    	    }
		    })

		    // end cek no lhp

		  //   $.ajax({
		  //     method: 'POST',
		  //     url: '<?php echo base_url('tlhp-pemda/insert'); ?>',
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
		      url: '<?php echo base_url('tlhp-pemda/insert-temuan'); ?>',
		      data: data
		    })
		    .done(function(data) {
		      var out = jQuery.parseJSON(data);
		    	if (aksi == 'simpan') {
		    		$('#modalKonfirmasi').modal('show');
		    		e.preventDefault();
		    	}else{
		    		clear_form_temuan();
		    	}
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
		

		$(document).on("click", "#daftar_temuan", function(e) {
			var noreg = $('#d_noreg').val();
			var no_lhp = $('#d_no_lhp').val();;

		    var aksi = $(this).attr('data-aksi');
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-pemda/get-modal-temuan'); ?>?noreg='+noreg+'&no_lhp='+no_lhp,
		    })
		    .done(function(data) {
		    	$('#list_temuan').html(data);
				$('#modalTemuan').modal('show');
		      	
		    })
		    
		    e.preventDefault();
		  });

		$(document).on("click", ".tes", function(e) {
			var check = $('.tipe_daerah').getAttribute("class"); 
			console.log(check);exit();
			
			var tipe = $('input[name=tipe_daerah]:checked').val();
		    e.preventDefault();
		  });

		$(document).on("click", ".tlanjut", function() {
        	var noreg 		= $('#d_noreg').val();
        	var no_lhp 		= $('#d_no_lhp').val();
        	document.location.href = '<?php echo base_url('tlhp-pemda/tindak-lanjut'); ?>?noreg='+noreg+'&no_lhp='+no_lhp;
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
	$('#dalnis').val('');
	$('#dalnis').select2().trigger('change');
		
}

function clear_form_temuan() {
	var jns='umum';
	$.ajax({
	  url: '<?php echo base_url('tlhp-pemda/getaspek'); ?>',
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
  	placeholder: 'Pilih Provinsi'
});
$('#kab').select2({
  	placeholder: 'Pilih Kabupaten/Kota'
});
$('#ins_pemeriksa').select2({
  	placeholder: 'Pilih Inspektorat Pemeriksa'
});

$('#pembahas_anev').select2({
  	placeholder: 'Pilih Petugas Sekretariat'
});
$('#pembahas_apip').select2({
  	placeholder: 'Pilih Petugas Tim'
});
$('#dalnis').select2({
  	placeholder: 'Pilih Pengendali Teknis Tim'
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
	  url: '<?php echo base_url('tlhp-pemda/getprov'); ?>',
	  data:{kode:ins},
	  type: 'POST'
	 //  	success: function(data){
		// }
	}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
		  	$('#prov').html(out.prov);
		  	$('#pembahas_anev').html(out.anev);
		  	$('#pembahas_apip').html(out.apip);
		  	$('#dalnis').html(out.apip);
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
	  url: '<?php echo base_url('tlhp-pemda/getaspek'); ?>',
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
	var noreg = $('#d_noreg').val();
	var no_lhp = $('#d_no_lhp').val();
	var aspek=$(this).val();
	$.ajax({
	  url: '<?php echo base_url('tlhp-pemda/getmax-temuan'); ?>',
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
		      url: '<?php echo base_url('tlhp-pemda/del-temuan'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
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
		      url: '<?php echo base_url('tlhp-pemda/del-rekomendasi'); ?>?noreg='+noreg+'&lhp='+lhp+"&kode="+kode,
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

 	$(document).on("click", ".back_to_list", function(e) {
		$('#form-edit-temuan').attr('hidden','');
		$('#form-edit-rekomendasi').attr('hidden','');
	    $('#daftar-list-lhp').removeAttr('hidden');
	    e.preventDefault();
	});

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}
</script>    