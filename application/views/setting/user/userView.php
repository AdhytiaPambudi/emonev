<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                		<h4 style="text-align:center;" id="judul-form">Form User</h4>
                		<hr style="border-top:1px solid red;">
	
						<form class="form-horizontal" id="form-user">
						<div class="form-group">
							<label for="role" class="col-sm-2 control-label input-sm">Hak Akses *</label>
							<div class="col-sm-9">
							  <select name="role" id="role" class="form-control input-sm">
								
							  </select>
							</div>
						 </div>



						 <div class="form-group user-bidang" hidden>
							<label for="bidang" class="col-sm-2 control-label input-sm">Bidang *</label>
							<div class="col-sm-9">
							  <select name="bidang" id="bidang" class="form-control input-sm" style="width:100%;">
								
							  </select>
							</div>
						 </div>

						 <div class="form-group user-skpd" hidden>
							<label for="role" class="col-sm-2 control-label input-sm">OPD *</label>
							<div class="col-sm-9">
							  <select name="skpd" id="skpd" class="form-control input-sm" style="width:100%;">
								
							  </select>
							</div>
						 </div>
						
						 	
					  <div class="form-group row">
						<label for="username" class="col-sm-2 control-label input-sm">Username *</label>
						<div class="col-sm-4">
						  <input type="text" name="username" class="form-control input-sm" id="username" placeholder="Masukkan Username">
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

					  <!-- <div class="form-group">
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
					  </div> -->

					  

				  <div class="form-group row">
				  	<div class="col-md-2 control-label"></div>
					<div class="col-md-9">
						<div class="pull-right">
							<input type="button" name="tambah" value="Tambah" id="tambah" class="btn btn-primary btn-md">
							<button type="button" data-aksi="simpan" id="simpan" class="btn btn-success btn-md hidden"><i class="fa fa-check"></i> Simpan</button>
							<button type="button" data-aksi="update" id="update" class="btn btn-success btn-md hidden"><i class="fa fa-check"></i> Update</button>
					  		<input type="button" name="batal" value="Batal" id="batal" class="btn btn-danger btn-md hidden">
						</div>
					</div>
				  </div>
				<?php echo form_close( ); ?>
			  </div>
		</div>
    </div>
</div>  
	 
</div>  

<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="text-align:center;" id="judul-form">List User</h4>
                	<hr style="border-top:1px solid red;">
                    <div class="asset-inner">
                        <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        	<thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>SKPD</th>
                                    <th>Group</th>
                                    <th>Aksi</th>
                                </tr>
                        	</thead>
                        </table>
                    </div>
                </div>
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

	  	$.ajax({
			  url: '<?php echo base_url('setting-user/get_jenis_user'); ?>',
			  type: 'POST',
			  success: function(data){
			  	$("#role").html(data);
			  }
		});

		$.ajax({
			  url: '<?php echo base_url('setting-user/get_bidang'); ?>',
			  type: 'POST',
			  success: function(data){
			  	$("#bidang").html(data);
			  }
		});

		$.ajax({
			  url: '<?php echo base_url('dpa-get-combo-skpd'); ?>',
			  type: 'POST',
			  success: function(data){
			  	$("#skpd").html(data);
			  }
		});

	  
	});
	var table;
    $(document).ready(function() {
 
        //datatables
        
        table = $('#example1').DataTable({ 
 			
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('setting-user/get')?>",
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
        	
        	
        	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-md');
        	$('#simpan').removeAttr('aksi');
        	$('#simpan').attr('aksi','tambah');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-md');


		  });

        $(document).on("click", "#batal", function() {
        	clear_form();
        	$('#batal').attr('class','hidden');
        	$('#simpan').attr('class','hidden');
        	$('#cetak').removeAttr('class','hidden');
        	$('#cetak').attr('class','btn btn-warning btn-md');
        	$('#tambah').removeAttr('class','hidden');
        	$('#tambah').attr('class','btn btn-primary btn-md');

		});

        function clear_form() {
			$('#role').val('1');
    		$('#role').select2().trigger('change');
			$('#skpd').val('');
			$('#skpd').select2().trigger('change');
        	$('#username').val('');
        	$('#password').val('');
        	$('#nama').val('');
        	
        	$('.user-skpd').attr('hidden','');
        	$('#username').removeAttr('readonly');
        	$('#role').removeAttr('disabled');
        	$('#prov').removeAttr('disabled');
        	$('#kab').removeAttr('disabled');
        	$('#ctt').attr('style','visibility:hidden;');
        }

         $(document).on("click", ".edit", function() {
         	clear_form();
			var role 		= $(this).attr("data-role"); 
			var id 			= $(this).attr("data-id");
         	var username 	= $(this).attr("data-username");
         	var nama 		= $(this).attr("data-nama");
         	var skpd 		= $(this).attr("data-skpd");
         	
         	

         	$("#role").val(role); 
			$('#role').select2().trigger('change');
			
			
         	$('#username').val(username);
         	$('#nama').val(nama);
         	



         	

         	if (role == 1) {
         		$('.user-skpd').attr('hidden','');
         		$('.user-bidang').attr('hidden','');
         	}else if(role == 3){
         		$("#bidang").val(skpd); 
				$('#bidang').select2().trigger('change');
				$('.user-bidang').removeAttr('hidden');	
				$('.user-skpd').attr('hidden','');
         	}else if(role == 5) {
				$("#skpd").val(skpd); 
				$('#skpd').select2().trigger('change');
				$('.user-skpd').removeAttr('hidden');	
				$('.user-bidang').attr('hidden','');
			 }
			 
         	$('#ctt').removeAttr('style');
         	$("#username").attr('readonly','true'); 
         	$('#tambah').attr('class','hidden');
        	$('#cetak').attr('class','hidden');
        	$('#simpan').removeAttr('class','hidden');
        	$('#simpan').attr('class','btn btn-success btn-md');
        	$('#simpan').removeAttr('aksi');
        	$('#simpan').attr('aksi','edit');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-md');
		  });

         $(document).on("click", "#simpan", function(e) {         	
		    var data = $('#form-user').serialize();
         	
		    var role = $('#role').val();
		    if (role == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH PILIHAN HAK AKSES',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    if(role == 5){			    
				var opd = $('#skpd').val();
				if(opd == ''){
					Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI DATA OPD',showConfirmButton: false,timer: 2000});
					exit();   			
				}
			}

			if(role == 3){			    
				var bidang = $('#bidang').val();
				if(bidang == ''){
					Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI DATA BIDANG',showConfirmButton: false,timer: 2000});
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
			    link = '<?php echo base_url('setting-user/insert'); ?>';
		    }else{
		    	link = '<?php echo base_url('setting-user/update'); ?>';
		    }

		    // cek no lhp
		    $.ajax({
		      method: 'POST',
		      url: '<?php echo base_url('setting-user/cek-user'); ?>',
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
						clear_form();
						reload_table();
					})
				}
		    })
			e.preventDefault();
		  });

       

         $("#role").change(function(){
			var role=$(this).val();
			if (role == 1) {
				$('.user-skpd').attr('hidden','');
				$('.user-bidang').attr('hidden','');
				$('#prov').val('');
			}else if(role == 3){
				$('.user-skpd').attr('hidden','');
				$('.user-bidang').removeAttr('hidden','');
			}else{
				$('.user-skpd').removeAttr('hidden','');
				$('.user-bidang').attr('hidden','');
			}
		});




    });

 function angka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 33 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}

</script> 

<script type="text/javascript">
	$('#role').select2({
		  placeholder: 'Pilih Hak Akses'
	});
	$('#skpd').select2({
		placeholder: 'Pilih OPD'
	});
	$('#bidang').select2({
		placeholder: 'Pilih Bidang'
	});
	
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
		    document.location.href = "<?= base_url('setting-user/del/'); ?>"+id;
		  }
		})

	});

</script>

