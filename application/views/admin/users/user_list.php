<?php if ($this->session->flashdata('msg') == TRUE): ?>
	<!-- <div class="alert alert-success alert-dismissible" role="alert">
	  <strong><?= $this->session->flashdata('msg');?></strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div> -->
<?php endif ?>
<div class="flash-data" data-flashdata = "<?= $this->session->flashdata('msg');?>">
<div class="panel panel-headline panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Data User</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
			<div class="box-body my-form-body">
			  <?php if(isset($msg) || validation_errors() !== ''): ?>
				  <div class="alert alert-warning alert-dismissible">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
					  <?= validation_errors();?>
					  <?= isset($msg)? $msg: ''; ?>
				  </div>
				<?php endif; ?>
			   
				<!-- <?php echo form_open('#', 'class="form-horizontal" id="form-input"');  ?>  -->
						<form class="form-horizontal" id="form-user">
						<div class="form-group">
							<label for="role" class="col-sm-2 control-label input-sm">Hak Akses *</label>
							<div class="col-sm-9">
							  <select name="role" id="role" class="form-control input-sm">
								<option value="1">ADMIN</option>
								<option value="2">USER PEMDA</option>
								<option value="3">USER KEMENDAGRI</option>
							  </select>
							</div>
						 </div>
						 <div class="form-group user-pemda" hidden>
							<label for="firstname" class="col-sm-2 control-label">Tipe Daerah</label>

							<div class="col-sm-8">
								<input checked 
								       data-radiocharm-background-color="074979" 
								       data-radiocharm-text-color="FFF" 
								       data-radiocharm-label="Provinsi"
								       type="radio" class="tipe_daerah" value="prov" id="prov_check" name ="tipe_daerah">
								<input data-radiocharm-label="Kabupaten/Kota" 
								       data-radiocharm-background-color="F1C40F" 
								       data-radiocharm-text-color="FFF" 
								       type="radio" class="tipe_daerah" value="kab" id="kab_check" name ="tipe_daerah">
					
					
							</div>	
					 			 <input type="text" name="daerah" class="form-control input-sm hidden" id="daerah" placeholder="" >
						  </div>
						<div class="form-group user-pemda" hidden>
							<label for="prov" class="col-sm-2 control-label input-sm">Provinsi *</label>
							<div class="col-sm-4">
							  <select name="prov" id="prov" class="form-control input-sm"  style="width:100%">
												
							  </select>
							</div>
							<div class="col-sm-4" id="combo-kab" hidden>
							  <select name="kab" id="kab" class="form-control input-sm" style="width:100%">
								
							  </select>
							</div>
						 </div>

						 <div class="form-group user-kemendagri" hidden>
							<label for="prov" class="col-sm-2 control-label input-sm">Instansi *</label>
							<div class="col-sm-4">
							  <select name="instansi" id="instansi" class="form-control input-sm"  style="width:100%">
												
							  </select>
							</div>
						 </div>

						<!--  <div class="form-group user-pemda" hidden>
							<label for="kab" class="col-sm-2 control-label input-sm">Kabupaten/Kota *</label>
							<div class="col-sm-9">
							  <select name="kab" id="kab" class="form-control input-sm" style="width:200px;">
								
							  </select>
							</div>
						 </div> -->
						 	
					  <div class="form-group row">
						<label for="username" class="col-sm-2 control-label input-sm">Username *</label>
						<div class="col-sm-4">
						  <input type="text" name="username" class="form-control input-sm" id="username" placeholder="Otomoatis Ketika User Kab/Kota">
						</div>
					  </div>
					  
					  <div class="form-group row">
						<label for="password" class="col-sm-2 control-label input-sm">Password *</label>
						<div class="col-sm-4">
						  <input type="password" name="password" class="form-control input-sm" id="password" placeholder="Password Harus Lebih dari 8 Karakter" pattern=".{8,}">
						</div>
						<div class="col-sm-4">
						  <label class="label label-warning" id="ctt" style="visibility:hidden;">* Kosongkan Jika Tidak Mengubah Password</label>
						</div>
					  </div>

					   <div class="form-group row">
						<label for="nama" class="col-sm-2 control-label input-sm">Nama *</label>
						<div class="col-sm-9">
						  <input type="text" name="nama" class="form-control input-sm" id="nama" placeholder="">
						</div>
					  </div>

					  <div class="form-group">
						<label for="telp" class="col-sm-2 control-label">Telpon</label>
						<div class="col-sm-9">
						  <input type="text" name="telp" class="form-control" id="telp" placeholder="" onkeypress="return angka(event)">
						</div>
					  </div>

					  <div class="form-group">
						<label for="telp" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-9">
						  <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com">
						</div>
					  </div>

					  

				  <div class="form-group row">
				  	<div class="col-md-2 control-label"></div>
					<div class="col-md-9">
						<div class="pull-right">
							<input type="button" name="tambah" value="Tambah" id="tambah" class="btn btn-primary btn-lg">
							<button type="button" data-aksi="simpan" id="simpan" class="btn btn-success btn-lg hidden"><i class="fa fa-check"></i> Simpan</button>
							<button type="button" data-aksi="update" id="update" class="btn btn-success btn-lg hidden"><i class="fa fa-check"></i> Update</button>
					  		<!-- <input type="button" name="cetak" value="Cetak" id="cetak" class="btn btn-warning btn-lg"> -->
					  		<input type="button" name="batal" value="Batal" id="batal" class="btn btn-danger btn-lg hidden">
						</div>
					</div>
				  </div>
				<?php echo form_close( ); ?>
			  </div>
		</div>
    </div>
</div>  
	<div class="panel-footer">
		<div class="row">
			<div class="col-md-12">
				<table id="example1" class="table table-bordered table-striped" style="width:100%">
				<thead>
					<tr>
					  <th width="5%" class="text-center">No.</th>
					  <th width="20%" class="text-center">Nama</th>
					  <th width="30%" class="text-center">Username</th>
					  <th width="30%" class="text-center">Hak Akses</th>
					  <th width="15%" class="text-center">Aksi</th>
					</tr>
				</thead>
				</table>
			</div>
		</div>
	</div> 
</div>  

<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/dataTables.bootstrap.min.css">  
<link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/fixedHeader.bootstrap.min.css">  
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/responsive.bootstrap.min.css">  
<!-- DataTables -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/responsive.bootstrap.min.js"></script>

<script>
	$(window).on('load', function () {
  		var kode = 1;
	  	$.ajax({
			  url: '<?php echo base_url('data-user/getprov'); ?>',
			  data:{kode:kode},
			  type: 'POST',
			  success: function(data){
			  	$("#prov").html(data);
			  }
		  })
	  	$.ajax({
			  url: '<?php echo base_url('data-user/getinstansi'); ?>',
			  data:{kode:kode},
			  type: 'POST',
			  success: function(data){
			  	$("#instansi").html(data);
			  }
		  })
	});
	var table;
    $(document).ready(function() {
 
        //datatables
        var kode = document.getElementById('prov').value;
        table = $('#example1').DataTable({ 
 			
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('data-user/get')?>",
                "data": "{kode:kode}",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            }, { 
                "targets": [ 0,1,4 ],  "className": 'text-center',
            },
            ],
 
        });

        function reload_table () {
        	table.ajax.reload( null, false ); // user paging is not reset on reload
        }

        setInterval( function () {
		    table.ajax.reload( null, false ); // user paging is not reset on reload
		}, 30000 );

        

        $(document).on("click", "#tambah", function() {
        	clear_form();
        	
        	// $("#form-input").attr("action", "<?php echo base_url('data-user/add'); ?>");
        	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-lg');
        	$('#simpan').removeAttr('aksi');
        	$('#simpan').attr('aksi','tambah');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-lg');


		  });

        $(document).on("click", "#batal", function() {
        	clear_form();
        	$('#batal').attr('class','hidden');
        	$('#simpan').attr('class','hidden');
        	$('#cetak').removeAttr('class','hidden');
        	$('#cetak').attr('class','btn btn-warning btn-lg');
        	$('#tambah').removeAttr('class','hidden');
        	$('#tambah').attr('class','btn btn-primary btn-lg');

        	$('#prov').removeAttr('disabled');
		  });

        function clear_form() {
        	$('#role').val('1');
        	$('#prov').val('');
        	$('#kab').val('');
        	$('#username').val('');
        	$('#password').val('');
        	$('#nama').val('');
        	$('#telp').val('');
        	$('#email').val('');
        	$('.user-pemda').attr('hidden','');
        	$('#username').removeAttr('readonly');
        	$('#role').removeAttr('disabled');
        	$('#prov').removeAttr('disabled');
        	$('#kab').removeAttr('disabled');
        	$('#ctt').attr('style','visibility:hidden;');
        }

         $(document).on("click", ".edit", function() {
         	clear_form();
         	var id 			= $(this).attr("data-id");
         	var username 	= $(this).attr("data-username");
         	var nama 		= $(this).attr("data-nama");
         	var telp 		= $(this).attr("data-telp");
         	var prov 		= $(this).attr("data-prov");
         	var kab 		= $(this).attr("data-kab");
         	var email 		= $(this).attr("data-email");
         	var role 		= $(this).attr("data-role");

         	$("#role").val(role); 
    		$('#role').select2().trigger('change');
         	
         	$('#username').val(username);
         	$('#nama').val(nama);
         	$("#telp").val(telp); 
         	$("#email").val(email); 



         	if (role == '2' && (kab.length <= 2 || kab == '')) {
         		$('#combo-kab').attr('hidden','');
         		$('#label-radiocharm-prov_check').attr('class','label-radiocharm active');
         		$('#label-radiocharm-kab_check').attr('class','label-radiocharm');
         	}else{
         		$('#combo-kab').removeAttr('hidden','');
         		$('#label-radiocharm-prov_check').attr('class','label-radiocharm ');
         		$('#label-radiocharm-kab_check').attr('class','label-radiocharm active');
         	}

         	if (role == 1) {
         		$('.user-pemda').attr('hidden','');
         		$('.user-kemendagri').attr('hidden','');
         	}else if (role == 2) {
         		$("#prov").val(prov); 
         		$('#prov').select2().trigger('change');

				$.ajax({
				  url: '<?php echo base_url('data-user/getkab'); ?>',
				  data:{kode:prov},
				  type: 'POST',
				  	success: function(data){
		  		  		$('#kab').html(data);
         				$("#kab").val(kab);
         				$('#kab').select2().trigger('change'); 
         				$('.user-pemda').removeAttr('hidden','');
					}
				})
         	}else{
         		
         		$("#instansi").val(prov); 
         		$('#instansi').select2().trigger('change');
         	}
         	$('#ctt').removeAttr('style');
         	$("#form-input").attr("action", "<?php echo base_url('data-user/edit/'); ?>"+id);
         	$("#username").attr('readonly','true'); 
         	$("#role").attr('disabled','true'); 
         	$("#prov").attr('disabled','true'); 
         	$("#instansi").attr('disabled','true'); 
         	$("#kab").attr('disabled','true'); 
         	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-lg');
        	$('#simpan').removeAttr('aksi');
        	$('#simpan').attr('aksi','edit');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-lg');
		  });


         $("#prov").change(function(){
			
			var tipe = $('input[name=tipe_daerah]:checked').val();
			if(!tipe){
				tipe = 'prov';
			}
			var header=$(this).val();
			if (tipe == 'prov') {
				var role = 'prov';
				var header=$(this).val();
				$.ajax({
				  url: '<?php echo base_url('data-user/getmax'); ?>',
				  data:{kode:header,role:role},
				  type: 'POST',
				  	success: function(data){
		  		  		// document.getElementById('username').value =data.trim();
					}
				})
			}else{
				$.ajax({
				  url: '<?php echo base_url('data-user/getkab'); ?>',
				  data:{kode:header},
				  type: 'POST',
				  	success: function(data){
		  		  		$('#kab').html(data);
					}
				})
				
			}
		});



         $(document).on("click", "#simpan", function(e) {
         	
		    var data = $('#form-user').serialize();
         	

		    var role = $('#role').val();
		    if (role == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH PILIHAN HAK AKSES',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if (role == 1) {

		    }else if(role == 2){
		    	var tipe = $('input[name=tipe_daerah]:checked').val();
			    var prov = $('#prov').val();
			    if (prov == '') {
			 		Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI DATA PROVINSI',showConfirmButton: false,timer: 2000});
					exit();   	
			    }

			    if (tipe == 'kab') {
			    	var kab = $('#kab').val();
			    	if(kab == ''){
			    		Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI DATA KABUPATEN',showConfirmButton: false,timer: 2000});
						exit();   			
			    	}
			    }
		    }else if(role == 3){
		    	var instansi = $('#instansi').val();
		    	 if (instansi == '') {
			 		Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI DATA INSTANSI',showConfirmButton: false,timer: 2000});
					exit();   	
			    }
		    }

		    var link;
		    var username = $('#username').val();
		    var nama = $('#nama').val();
		    var password = $('#password').val();

		    if (username == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA USERNAME BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }

		    if (nama == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NAMA BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    var aksi = $(this).attr('aksi');
		    if(aksi == 'tambah'){
			    if (password == '') {
			    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA PASSWORD BELUM DIISI',showConfirmButton: false,timer: 2000});
					exit();
			    }
			    link = '<?php echo base_url('data-user/insert'); ?>';
		    }else{
		    	link = '<?php echo base_url('data-user/update'); ?>';
		    }
		    





		    // cek no lhp
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('data-user/cek-user'); ?>',
		      data: data
		    })
		    .done(function(dataCek) {
		    	    var out = jQuery.parseJSON(dataCek);

		    	    var sts = out.sts;
		    	    if (sts == 'ada' && aksi == 'tambah') {
		    	    	 Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: 'Username Telah Dipakai!',
						})
		    	    }else{

		    	    	  $.ajax({
						      method: 'POST',
						      url: link,
						      data: data
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
						    })
		    	    }
		    })

				e.preventDefault();
		  });

         $(".tipe_daerah").change(function(){	
         	$('#username').val('');
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

         $("#role").change(function(){
			var role=$(this).val();
			if (role == 1) {
				$('.user-pemda').attr('hidden','');
				$('.user-kemendagri').attr('hidden','');
				// $('#username').removeAttr('readonly','');
				$('#prov').val('');
				$('#kab').val('');
				// $('#username').val('');
			}else if(role == 2){
				$('.user-kemendagri').attr('hidden','');
				$('.user-pemda').removeAttr('hidden','');
				// $('#username').attr('readonly','');
				// $('#username').val('');
			}else{
				$('.user-pemda').attr('hidden','');
				$('.user-kemendagri').removeAttr('hidden','');
				// $('#username').attr('readonly','');
				// $('#username').val('');
			}
		});

         $("#kab").change(function(){
			var role = 'kab';
			var header=$(this).val();
			$.ajax({
			  url: '<?php echo base_url('data-user/getmax'); ?>',
			  data:{kode:header,role:role},
			  type: 'POST',
			  	success: function(data){
	  		  		// document.getElementById('username').value =data.trim();
				}
			})
		});

         $("#instansi").change(function(){
			
			var header=$(this).val();
			var role = 'ins';
			$.ajax({
			  url: '<?php echo base_url('data-user/getmax'); ?>',
			  data:{kode:header,role:role},
			  type: 'POST',
			  	success: function(data){
	  		  		// document.getElementById('username').value =data.trim();
				}
			})
		});


    });
// function konfirmasi(ckode,cnama)
//  {
// 	 tanya = confirm("Anda Yakin Akan Menghapus Data ("+ckode +". "+cnama+") ?");
// 	 if (tanya == true) {
//  		location.replace("<?= base_url('data-kabupaten-kota/del/'); ?>"+ckode)
// 	 }
// 	 else {
// 	 	alert('Data Batal Dihapus!');
// 	 }
//  }

 function angka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 33 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}

</script> 

<script type="text/javascript">
	$('#prov').select2({
		  placeholder: 'Pilih Provinsi'
		});
	$('#kab').select2({
		  placeholder: 'Pilih Kabupaten'
		});
	$('#instansi').select2({
		  placeholder: 'Pilih Instansi'
		});
	$('#role').select2({
		  placeholder: 'Pilih Hak Akses'
		});
	$('input:radio').radiocharm();
</script>

<script type="text/javascript">

	$(document).on("click", ".tombol-hapus", function() {
		var id 		= $(this).attr("data-id");
        var nama 	= $(this).attr("data-nama");
        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Menghapus data ("+id+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#074979',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Hapus Data Ini.'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = "<?= base_url('data-user/del/'); ?>"+id;
		  }
		})

	});

</script>

