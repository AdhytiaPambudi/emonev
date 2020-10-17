<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                		<h4 style="text-align:center;" id="judul-form">Form Group</h4>
                		<hr style="border-top:1px solid red;">
	
						<form class="form-horizontal" id="form-group">
						
						
						
						 	
					  <div class="form-group row">
						<label for="username" class="col-sm-2 control-label input-sm">Kode *</label>
						<div class="col-sm-4">
						  <input type="text" name="kode" class="form-control input-sm" id="kode" placeholder="Otomoatis" readonly>
						</div>
					  </div>
					  
					   <div class="form-group row">
						<label for="nama" class="col-sm-2 control-label input-sm">Nama Group *</label>
						<div class="col-sm-9">
						  <input type="text" name="nama" class="form-control input-sm" id="nama" placeholder="">
						</div>
					  </div>

					  <div class="form-group">
						<label for="telp" class="col-sm-2 control-label">Keterangan</label>
						<div class="col-sm-9">
						  <input type="text" name="ket" class="form-control" id="ket" placeholder="">
						</div>
					  </div>
					  
				  <div class="form-group row">
				  	<div class="col-md-2 control-label"></div>
					<div class="col-md-9">
						<div class="pull-right">
							<input type="button" name="tambah" value="Tambah" id="tambah" class="btn btn-primary btn-md">
							<button type="button" data-aksi="simpan" id="simpan" class="btn btn-success btn-md hidden"><i class="fa fa-check"></i> Simpan</button>
							<button type="button" data-aksi="update" id="update" class="btn btn-success btn-md hidden"><i class="fa fa-check"></i> Update</button>
					  		<!-- <input type="button" name="cetak" value="Cetak" id="cetak" class="btn btn-warning btn-md"> -->
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
                    <h4 style="text-align:center;" id="judul-form">List Group</h4>
                	<hr style="border-top:1px solid red;">
                    <div class="asset-inner">
                        <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        	<thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Group</th>
                                    <th>Keterangan</th>
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

	  

	  
	});
	var table;
    $(document).ready(function() {
 
        //datatables
        
        table = $('#example1').DataTable({ 
 			
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('setting-group/get')?>",
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
        	$.ajax({
                url: '<?php echo base_url('setting-group/getmax'); ?>',
                type: 'POST',
                success: function(data){
                    document.getElementById('kode').value =data.trim();
                }
            })
        	
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
            $('#kode').val('');
            $('#nama').val('');
            $('#ket').val('');
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
         	var nama 		= $(this).attr("data-nama");
         	var ket 		= $(this).attr("data-ket");
         	
         	$('#kode').val(id);
         	$('#nama').val(nama);
         	$("#ket").val(ket); 


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
        	$('#simpan').attr('class','btn btn-success btn-md');
        	$('#simpan').removeAttr('aksi');
        	$('#simpan').attr('aksi','edit');
        	$('#batal').removeAttr('class','hidden');
        	$('#batal').attr('class','btn btn-danger btn-md');
		  });


         $(document).on("click", "#simpan", function(e) {
         	
		    var data = $('#form-group').serialize();
            var aksi = $(this).attr('aksi');
            

		    var kode = $('#kode').val();
		    if (kode == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI KODE',showConfirmButton: false,timer: 2000});
				exit();
		    }
		    
		    var link;
		    var nama = $('#nama').val();
		    

		    if (nama == '') {
		    	Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NAMA BELUM DIISI',showConfirmButton: false,timer: 2000});
				exit();
            }
            
		    
		    if(aksi == 'tambah'){
			    link = '<?php echo base_url('setting-group/insert'); ?>';
		    }else{
		    	link = '<?php echo base_url('setting-group/update'); ?>';
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
                location.reload();
            })
			
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
		  confirmButtonText: 'Ya, Hapus Data.'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = "<?= base_url('setting-group/del/'); ?>"+id;
		  }
		})

	});

</script>

