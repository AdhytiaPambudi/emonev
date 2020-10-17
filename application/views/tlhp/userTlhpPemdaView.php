<style>
/**/
</style>

<div class="panel panel-headline panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">PEMANTAUAN TLHP</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">

			<div class="box-body my-form-body">
				<!-- <ul id="mytabs" class="nav nav-pills nav-justified" role="tablist">
			    	<li role="presentation" id="tab_lhp" class="active"><a href="#data_lhp" aria-controls="data_lhp" role="tab" data-toggle="tab">DATA LHP</a></li>
			    	<li role="presentation" id="tab_temuan" ><a href="#data_temuan" aria-controls="data_temuan" role="tab" data-toggle="tab" >DATA TEMUAN</a></li>
			  	</ul> -->
			  	<!-- <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div> -->
			  	<!-- <div class="tab-content"> -->
				  	
					    <!-- <div role="tabpanel" class="tab-pane active" id="data_lhp"> -->
						   	<!-- <div class="row">
								<div class="col-md-12">
									<div class="box-body my-form-body">
										<form class="form-horizontal" id="form-lhp">
											<div class="form-group">
												<label for="email" class="col-sm-3 control-label">Inspektorat Pemeriksa</label>

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

												<label class="col-sm-3 control-label input-sm" id="label-tipe">Daerah</label>

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
												<label for="lastname" class="col-sm-3 control-label input-sm">Nomor LHP</label>

												<div class="col-sm-8">
												  <input type="text" name="no_lhp" class="form-control input-sm" id="no_lhp" placeholder="" required>
												</div>
											  </div>

											  <div class="form-group">
												<label for="mobile_no" class="col-sm-3 control-label input-sm">Pengendali Teknis</label>

												<div class="col-sm-8">
												  <input type="text" name="dalnis" class="form-control input-sm" id="dalnis" placeholder="" required>
												</div>
											  </div>
											  <div class="form-group">
												<label for="password" class="col-sm-3 control-label input-sm">Tanggal LHP</label>

												<div class="col-sm-8">
												  <input type="date" name="tgl_lhp" class="form-control input-sm" id="tgl_lhp" value="<?= date('Y-m-d') ?>" placeholder="" required>
												</div>
											  </div>
											  <div class="form-group">
												<label for="password" class="col-sm-3 control-label input-sm">Tanggal Ekspose</label>
												<div class="col-sm-8">
												  <input type="date" name="tgl_ekspose" class="form-control input-sm" id="tgl_ekspose" value="<?= date('Y-m-d') ?>"  placeholder="" required>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Pembahas ANEV</label>

												<div class="col-sm-8">
												  <select name="pembahas_anev" id="pembahas_anev" class="form-control input-sm" required>
													
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Pembahas APIP</label>

												<div class="col-sm-8">
												  <select name="pembahas_apip" id="pembahas_apip" class="form-control input-sm" required>
													
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Petugas Pembahas OBRIK</label>

												<div class="col-sm-8">
												  <select name="pembahas_obrik" id="pembahas_obrik" class="form-control input-sm" required>
													
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="role" class="col-sm-3 control-label input-sm">Di Review Oleh</label>

												<div class="col-sm-8">
												  <select name="review" id="review" class="form-control input-sm" required>
													
												  </select>
												</div>
											  </div>
											  <center>
											  	
											  <button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan">SIMPAN</button>
											  <button type="button"  data-aksi="new" class="btn btn-success btn-lg simpan">INPUT BARU</button>
											  <a href="<?= base_url('tlhp-pemda');?>" class="btn btn-default btn-lg">Kembali</a>
											  </center>

										</form>
									</div>
								</div>
					    	</div> -->

				    	<!-- </div> -->
					    <!-- <div role="tabpanel" class="tab-pane" id="data_temuan"> -->
					    	<div class="row">
								<div class="col-md-12">
									<div class="box-body my-form-body">
										<!-- <form class="form-horizontal" id="form-temuan"> -->
											<table id="list-data" class="table table-bordered table-striped;" style="background-color:#ccc;">
									                  <thead>
									                    <tr>
									                      <th colspan="4" width="100%" style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:14pt;">KELENGKAPAN TLHP</th>
									                    </tr>
									                  </thead>
									                  <tbody>
									                  	<?php foreach ($tlhp as $valueTlhp) {?>
									                  	<tr>
									                  		<td><label>Nama Daerah</label></td>
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
									                  		<td><label>Petugas Daerah</label></td>
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
									                    		<!-- <input type="text" name="noreg" class="form-control input-sm" id="noreg" readonly placeholder="" value="<?= $noreg; ?>">	 -->
									                    </tr>

									                    <tr>
									                    	<td colspan="4" width="100%" id="tree_temuan">
									                    	</td>
									                  		<!-- <td style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:12pt;"><label>KODE</label></td>
									                  		<td style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:12pt;"><label>URAIAN</label></td>
									                  		<td style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:12pt;"><label>STATUS</label></td>
									                  		<td style="text-align: center;font-weight:bold;background-color:#074979;color:#fff;font-size:12pt;"><label>AKSI</label></td> -->
									                  		
									                  	</tr>
									                   <!--  <?php foreach ($temuan as $valueTemuan) {?>
									                    <tr>
									                  		<td><label><?=$valueTemuan->kode; ?></label></td>
									                  		<td><label><?=$valueTemuan->uraian; ?></label></td>
									                  		<td><label><?=$valueTemuan->sts_tlanjut; ?></label></td>
									                  		<?php if(strlen($valueTemuan->kode)==7){ ?>
									                  		<td><a href="#" class="btn btn-info btn-flat btn-xs vTindak" data-toggle="tooltip" title="Tindak Lanjut" data-reg="<?=$valueTemuan->noreg; ?>" data-kode="<?=$valueTemuan->kode; ?>"><i class="fa fa-eye"></i></a></td>
									                  		<?php }else{?>
									                  		<td><label>&nbsp;</label></td>
									                  			<?php } ?>
									                  		
									                  	</tr>
									                  	<?php } ?> -->

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
											<!-- <div class="form-group">
												<label for="firstname" class="col-sm-3 control-label">Jenis Aspek</label>

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

												<label class="col-sm-3 control-label input-sm" id="label-tipe">Obrik/ Aspek</label>

												<div class="col-sm-8">
												  <select name="aspek" id="aspek" class="form-control input-sm" style="width:100%">
																	
												  </select>
												</div>
											  </div>
											  <div class="form-group">
												<label for="kd_temuan" class="col-sm-3 control-label input-sm">Kode Temuan</label>

												<div class="col-sm-8">
												  <input type="text" name="kd_temuan" class="form-control input-sm" id="kd_temuan" placeholder="">
												</div>
											  </div>
											  <div class="form-group">
												<label for="kd_temuan" class="col-sm-3 control-label input-sm">Judul Temuan</label>

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
									                      
									                      <th width="15%" style="text-align: left;">Kode Rekomendasi</th>
									                      <th width="75%" style="text-align: left;">Uraian Rekomendasi</th>
									                      <th width="10%" style="text-align: left;">Aksi</th>
									                    </tr>
									                  </thead>
									                  <tbody id="tbody_rekom">

									                  </tbody>
									                  <tfoot>
									                  	<tr>
									                  		<td colspan="2" width="100%" style="align:right;">
									                  			<div class="btn btn-primary btn-sm" id="add_rekom">Tambah</div>
									                  		</td>
									                  	</tr>
									                  </tfoot>
									                </table>
											  	</div>
											  </div>
											  <div class="form-group">
												<label for="kd_temuan" class="col-sm-3 control-label input-sm">Nilai Temuan</label>

												<div class="col-sm-8">
												  <input type="text" name="nilai_temuan" class="form-control input-sm" id="nilai_temuan" placeholder="">
												</div>
											  </div>
											  <center>
												   <button type="button" data-aksi="simpan" class="btn btn-success btn-lg simpan-temuan">SIMPAN</button>
												  <button type="button"  data-aksi="new" class="btn btn-success btn-lg simpan-temuan">INPUT BARU</button>
												  <a href="<?= base_url('tlhp-pemda');?>" class="btn btn-default btn-lg">Tutup</a>
											  </center> -->
										<!-- </form> -->
									</div>
								</div>
					    	</div>

					    <!-- </div> -->
				  </div>
				<!-- <form id="regForm" action="/action_page.php"> -->
			  </div>
		</div>
    </div>
</div>  


<script type="text/javascript">

function kirimChat () {
	var chat = $('#text_chat').val();
	var noreg = $('#noreg_rek').val();
	var no_lhp = $('#d_no_lhp').val();
	var kode = $('#kd_rek').val();
	$.ajax({
      method: 'POST',
      url: '<?php echo base_url('tlhp-pemda/insert-catatan'); ?>',
      data: {chat:chat,noreg:noreg,no_lhp:no_lhp,kode:kode}
    })
    .done(function(data2) {
    	var out = jQuery.parseJSON(data2);
		$("#isi_cat").html(out.chat); 
    	$('#text_chat').val('');
    })
    
    

	
	
}

function validateFormat(fileInput){
 // var selectedFile = objFileControl.value;
// console.log(objFileControl.files[0].type); 
            
            var filePath = fileInput.value; 
          	const fileSize = fileInput.files[0].size;
          	const size = Math.round((fileSize / 1024)); 


          	var _file = $(fileInput)[0].files;


          	
            // Allowing file type 

            var allowedExtensions =  
                    /(\.jpg|\.jpeg|\.png|\.gif|\.doc|\.docx|\.pdf)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                Swal.fire({
				  position: 'top-end',
				   	  icon: 'error',
					  title: 'Oops...',
					  text: 'Tipe File Tidak Diperbolehkan!',
				  showConfirmButton: false,
				  timer: 2000
				});
                fileInput.value = ''; 
                return false; 
            }  

            if (size > 1024) { 
                Swal.fire({
				  position: 'top-end',
				   	  icon: 'error',
					  title: 'Oops...',
					  text: 'Ukuran File Terlalu Besar! Maksimal Ukuran File : 1 MB',
				  showConfirmButton: false,
				  timer: 2000
				});
                fileInput.value = ''; 
                return false; 
            }

            

           
}
</script>
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
	var noreg = $('#noreg').val();
	var no_lhp = $('#d_no_lhp').val();
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
	



  	$.ajax({
		  url: '<?php echo base_url('tlhp-pemda/get_tree_temuan'); ?>',
		  type: 'POST',
		  data:{noreg:noreg,no_lhp:no_lhp},
		  success: function(data){
		  	$("#tree_temuan").html(data);
		  }
	  });

 //  	var kode = 1;
 //  	$.ajax({
	// 	  url: '<?php echo base_url('data-user/getprov'); ?>',
	// 	  data:{kode:kode},
	// 	  type: 'POST',
	// 	  success: function(data){
	// 	  	$("#prov").html(data);
	// 	  }
	//   })
  	// $.ajax({
		 //  url: '<?php echo base_url('pengawasan-teknis/target'); ?>',
		 //  type: 'POST',
		 //  success: function(data){
		 //  	$(".showTarget").html(data);
		 //  }
	  // })

	// var tipe = $('input[name=tipe_daerah]:checked').val();
 //    	var daerah;
 //    	if (tipe == 'kab') {
 //    		var kabupaten = document.getElementById('kab').value;
 //    		daerah = kabupaten;
 //    	}else{
 //    		var provinsi = document.getElementById('prov').value;
 //    		daerah = provinsi;
 //    	}
 //  	$.ajax({
	// 	  url: '<?php echo base_url('pengawasan-teknis/target'); ?>',
	// 	  type: 'POST',
	// 	  data:{kode:daerah}
	//   }).done(function(data2) {
	//   	var out = jQuery.parseJSON(data2);
	      
	//   	$(".showTarget").html(out.btn);
	//   	$("#nilai2").val(out.nilai);
	//   	$("#id_daerah2").val(daerah);
	//     })


	  
	// 	var jns='umum';
	// 	$.ajax({
	// 	  url: '<?php echo base_url('tlhp-pemda/getaspek'); ?>',
	// 	  data:{kode:jns},
	// 	  type: 'POST'
	// 	}).done(function(data2) {
	// 	  	var out = jQuery.parseJSON(data2);
	// 		  	$('#aspek').html(out.aspek);
	// 	    })
	
});

		// $('#form-lhp').submit(function(e) {
			// $(document).on("click", ".simpan", function(e) {
		 //    var data = $('#form-tl').serialize();
		 //    console.log(data);exit()
		 //    var aksi = $(this).attr('data-aksi');
		 //    $.ajax({
		 //      method: 'POST',
		 //      url: '<?php echo base_url('tlhp-pemda/insert'); ?>',
		 //      data: data
		 //    })
		 //    .done(function(data) {
		 //    	if (aksi == 'simpan') {
		 //    		$('#tab_temuan').removeAttr('class','disabled'); // Select last tab
		 //    		// $('#myTabs a:last').tab('show'); // Select last tab
		 //    		$('#tab_temuan').tab('show');
		 //    		$('#data_lhp').removeAttr('class','active');
		 //    		$('#data_lhp').attr('class','tab-pane');
		 //    		$('#data_temuan').attr('class','tab-pane active');
		    		
		 //    	}else{
		 //    		clear_form_lhp();
		 //    	}


		 //      var out = jQuery.parseJSON(data);
		 //      	$('#d_id_daerah').val(out.id_daerah);
		 //      	$('#d_daerah').val(out.daerah);
		 //      	$('#d_no_lhp').val(out.no_lhp);
		 //      	$('#d_inspektorat').val(out.inspektorat);
		 //      	$('#d_dalnis').val(out.dalnis);
		 //      	$('#d_tgl_ekspose').val(out.tgl_ekspose);
		 //      	$('#d_tgl_lhp').val(out.tgl_lhp);
		 //      	$('#d_anev').val(out.anev);
		 //      	$('#d_apip').val(out.apip);
		 //      	$('#d_obrik').val(out.obrik);
		 //      	$('#d_review').val(out.review);

		 //    	Swal.fire({
			// 	  position: 'top-end',
			// 	  icon: 'success',
			// 	  title: out.pesan,
			// 	  showConfirmButton: false,
			// 	  timer: 2000
			// 	});
		 //    })
		    
		 //    e.preventDefault();
		 //  });

	// $('#form-tl').submit(function(e) {

	// 	    // var data = $(this).serialize();
	// 	    $.ajax({
	// 	      method: 'POST',
	// 	      url: '<?php echo base_url('tlhp-pemda/insert-tindak-lanjut'); ?>',
	// 	      data: new FormData(this),
	// 	      contentType:false,
	// 	      cache : false,
	// 	      processData:false,
	// 	    })
	// 	    .done(function(data) {
	// 	      var out = jQuery.parseJSON(data);

	// 	    	$('#myModal').modal('hide');
	// 	    	$("#sts_tlanjut").val(out.status);
	// 	    	Swal.fire({
	// 			  position: 'top-end',
	// 			  icon: 'success',
	// 			  title: out.pesan,
	// 			  showConfirmButton: false,
	// 			  timer: 2000
	// 			});
	// 	    })
		    
	// 	    e.preventDefault();
	// 	  });

			$(document).on("click", ".simpan-temuan", function(e) {
		    var data = $('#form-temuan').serialize();
		    var aksi = $(this).attr('data-aksi');
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('tlhp-pemda/insert-temuan'); ?>',
		      data: data
		    })
		    .done(function(data) {
		    	if (aksi == 'simpan') {
		    		
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
		    })
		    
		    e.preventDefault();
		  });

			// $(document).on("click", ".vTindak", function() {
         	
   //       	var noreg 		= $(this).attr("data-reg");
   //       	var kode 		= $(this).attr("data-kode");
         	

   //       		$.ajax({
			// 	  url: '<?php echo base_url('tlhp-pemda/get-modal-rekomendasi'); ?>',
			// 	  type: 'POST',
			// 	  data:{noreg:noreg,kode:kode}
			// }).done(function(data2) {
			// 		clear_tl();
			// 	  	var out = jQuery.parseJSON(data2);
			// 	  	$("#isi_cat").html(out.chat); 
			// 	  	$("#noreg_rek").val(out.noreg);
			// 	  	$("#kd_rek").val(out.kd_rekom);
			// 	  	$("#tlanjut").html(out.tlanjut);
			// 	  	$("#rekomendasi").html(out.rekomendasi);
			// 	  	$("#sts_tlanjut").val(out.sts_tlanjut);
			// 	  	$("#previewFile").html(out.file);
			// 	  	$("#catatan").html(out.catatan);
			// });

   // //       	$('#parameter').html(nm_par);
   // //       	$('#kode').html(id_par);
   // //       	$('#id_parameter').val(id_par);
   // //       	$('#nilai').val(Math.round(nilai));
   // //       	$('#nilai').select2().trigger('change');
   // //       	$('#tahun').val(thn);
   // //       	$('#id_daerah').val(daerah);
			// // $('#bobot').html(bobot);
         	
			// var aksi = 'edit';

     		
   //   		// $("#form-input").attr("action", "<?php echo base_url('binwas/edit/'); ?>"+id_par+"/"+daerah+"/"+thn);
   //       	$('#tambah').attr('class','hidden');
   //      	$('#cetak').attr('class','hidden');
   //      	if(aksi == 'edit'){
   //   			$('#myModalLabel').html('Form Tindak Lanjut '+kode);	
	  //       	$('#simpan').removeAttr('class','hidden');
	  //       	$('#simpan').attr('class','btn btn-success btn-lg');
	  //       	$('#simpan').removeAttr('aksi');
	  //       	$('#simpan').attr('aksi','edit');
	  //       	$('#batal').removeAttr('class','hidden');
		 //        $('#batal').attr('class','btn btn-danger btn-lg');
		 //        $('#nilai').removeAttr('disabled','');
		 //        $('#keterangan').removeAttr('disabled','');
		 //        $('#nm_lampiran').removeAttr('disabled','');
   //      	}else{
   //      		$('#myModalLabel').html('Detail Nilai Parameter');	
			// 	$('#simpan').attr('class','btn btn-success btn-lg hidden');
		 //        $('#batal').attr('class','btn btn-success btn-lg hidden');        		
		 //        $('#nilai').attr('disabled','');
		 //        $('#keterangan').attr('disabled','');
		 //        $('#nm_lampiran').attr('disabled','');
   //      	}
         	

         	
   //      	$('#myModal').modal('show');
		 //  });

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
	$('#pembahas_obrik').select2().trigger('change');
	$('#review').val('');
	$('#review').select2().trigger('change');
	$('#no_lhp').val('');
	$('#dalnis').val('');
		
}



$("#add_user").addClass('active');
$('input:radio').radiocharm({
	'uncheckable': true
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
  	placeholder: 'Pilih Pembahas Anev'
});
$('#pembahas_apip').select2({
  	placeholder: 'Pilih Pembahas Apip'
});
$('#pembahas_obrik').select2({
  	placeholder: 'Pilih Pembahas Obrik'
});
$('#review').select2({
  	placeholder: 'Pilih Pejabat'
});
$('#aspek').select2({
  	placeholder: 'Pilih Aspek'
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
		  	$('#pembahas_obrik').html(out.obrik);
		  	$('#review').html(out.review);
		  	$('#daerah').val('');
	    })

});


//  $(".tipe_daerah").change(function(){
// 	var tipe=$(this).val();
// 		  	var daerah;
// 			if (tipe == 'kab') {
// 				var kabupaten = document.getElementById('kab').value;
// 				daerah = kabupaten;
// 			}else{
// 				var provinsi = document.getElementById('prov').value;
// 				daerah = provinsi;
// 			}
// 		  	$('#daerah').val(daerah);
// 	if (tipe=='kab') {
// 		$('#combo-kab').removeAttr('hidden','');
// 	}else{
// 		$('#combo-kab').attr('hidden','');
// 	}
// });

 $(".jns_aspek").change(function(){
	var jns=$(this).val();
	$.ajax({
	  url: '<?php echo base_url('tlhp-pemda/getaspek'); ?>',
	  data:{kode:jns},
	  type: 'POST'
	}).done(function(data2) {
	  	var out = jQuery.parseJSON(data2);
		  	$('#aspek').html(out.aspek);
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
	var noreg = tahun+'-'+daerah;
	var aspek=$(this).val();
	$.ajax({
	  url: '<?php echo base_url('tlhp-pemda/getmax-temuan'); ?>',
	  data:{kode:aspek,noreg:noreg},
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
			      '<td width="15%" style="text-align: left;"><input type="text" value = "'+urut+'"	name="id_rekom[]" class="form-control input-sm" placeholder="" readonly></td>'+
			      '<td width="75%" style="text-align: left;"><input type="text" name="nm_rekom[]" class="form-control input-sm" placeholder=""></td>'+
			      '<td width="10%" style="text-align: left;"><input type="button" class="btn btn-sm btn-danger" value="Hapus" onclick="deleteRow(this)"/></td>'+
			    '</tr>';
	$('#tbody_rekom').append(rekom);
 	no++;
  event.preventDefault();
})

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}
</script>    