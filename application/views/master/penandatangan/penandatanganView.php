<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                		<h4 style="text-align:center;" id="judul-form">Form Penandatangan</h4>
                		<hr style="border-top:1px solid red;">
	
						<form class="form-horizontal" id="form-user">
						

						 <div class="form-group user-skpd" >
							<label for="role" class="col-sm-2 control-label input-sm">OPD *</label>
							<div class="col-sm-9">
							  <select name="skpd" id="skpd" class="form-control input-sm" style="width:100%;">
								
							  </select>
							</div>
						 </div>
						
						 	
					  <div class="form-group row">
						<label for="username" class="col-sm-2 control-label input-sm">NIP *</label>
						<div class="col-sm-4">
						  <input type="text" name="nip" class="form-control input-sm" id="nip" onkeypress="return angka(event)" placeholder="">
						</div>
					  </div>
					  
					  

					   <div class="form-group row">
						<label for="nama" class="col-sm-2 control-label input-sm">Nama *</label>
						<div class="col-sm-9">
						  <input type="text" name="nama" class="form-control input-sm" id="nama" placeholder="">
						</div>
                      </div>
                      <div class="form-group row">
						<label for="nama" class="col-sm-2 control-label input-sm">Jabatan *</label>
						<div class="col-sm-9">
						  <input type="text" name="jabatan" class="form-control input-sm" id="jabatan" placeholder="">
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
                    <h4 style="text-align:center;" id="judul-form">List Penandatangan</h4>
                	<hr style="border-top:1px solid red;">
                    <div class="asset-inner">
                        <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        	<thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP/Nama</th>
                                    <th>Jabatan</th>
                                    <th>SKPD</th>
                                    <th>Status</th>
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
                "url": "<?php echo site_url('get-master-penandatangan')?>",
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
			
			$('#skpd').val('');
			$('#skpd').select2().trigger('change');
        	$('#nip').val('');
        	$('#jabatan').val('');
            $('#nama').val('');
            $('#nip').removeAttr('readonly');
        	
        	
        }

         $(document).on("click", ".edit", function() {
         	clear_form();
			
			var nip 			= $(this).attr("data-nip");
         	var jabatan 	= $(this).attr("data-jabatan");
         	var nama 		= $(this).attr("data-nama");
         	var skpd 		= $(this).attr("data-skpd");
         	
         	

         	$("#skpd").val(skpd); 
			$('#skpd').select2().trigger('change');
			
			
         	$('#nip').val(nip);
             $('#nama').val(nama);
             $('#jabatan').val(jabatan);
         	



			 
         	
         	$("#nip").attr('readonly','true'); 
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
            var opd = $('#skpd').val();
            if(opd == ''){
                Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI DATA OPD',showConfirmButton: false,timer: 2000});
                exit();   			
            }
			
		    
		    var link;
		    var nip = $('#nip').val();
		    var nama = $('#nama').val();
		    var jabatan = $('#jabatan').val();

		    if (nip == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NIP BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
		    }

		    if (nama == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NAMA BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
            }
            
            if (jabatan == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NAMA BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
            }
            
		    var aksi = $(this).attr('aksi');
		    if(aksi == 'tambah'){
			    
			    link = '<?php echo base_url('insert-penandatangan'); ?>';
		    }else{
		    	link = '<?php echo base_url('update-penandatangan'); ?>';
		    }

		   
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
                $('#batal').attr('class','hidden');
                $('#simpan').attr('class','hidden');
                $('#cetak').removeAttr('class','hidden');
                $('#cetak').attr('class','btn btn-warning btn-md');
                $('#tambah').removeAttr('class','hidden');
                $('#tambah').attr('class','btn btn-primary btn-md');
            })
            
			e.preventDefault();
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
	
	$('#skpd').select2({
		placeholder: 'Pilih OPD'
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
		    document.location.href = "<?= base_url('hapus-penandatangan/'); ?>"+id;
		  }
		})

    });
    
    $(document).on("click", ".tombol-aktif", function() {
		var id 		= $(this).attr("data-id");
        var nama 	= $(this).attr("data-nama");
        var skpd 	= $(this).attr("data-skpd");
        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Mengaktifkan Penandatangan ("+id+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#074979',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Aktifkan Data Ini.'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = "<?= base_url('aktif-penandatangan/'); ?>"+id+"/"+skpd;
		  }
		})

	});

</script>

