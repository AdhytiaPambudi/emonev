<!-- <div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                		<h4 style="text-align:center;" id="judul-form">Form Bidang Bappeda</h4>
                		<hr style="border-top:1px solid red;">
	
						<form class="form-horizontal" id="form-user">
						

						
						
					
					   <div class="form-group row">
						<label for="nama" class="col-sm-2 control-label input-sm">Nama Bidang *</label>
						<div class="col-sm-9">
						  <input type="text" name="nm" class="form-control input-sm" id="nama" placeholder="">
						</div>
                      </div>
                      <div class="form-group row">
						<label for="nama" class="col-sm-2 control-label input-sm">Alias </label>
						<div class="col-sm-9">
						  <input type="text" name="alias" class="form-control input-sm" id="alias" placeholder="">
						</div>
					  </div>

                       <div class="form-group user-skpd" >
                            <label for="role" class="col-sm-2 control-label input-sm">Akses OPD *</label>
                            <div class="col-sm-9">
                              <select name="skpd" id="skpd" class="form-control input-sm" style="width:100%;">
                                
                              </select>
                            </div>
                        </div>


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
	 
</div>   -->

<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="text-align:center;" id="judul-form">Buka Kunci/ Pengaturan Triwulan</h4>
                	<hr style="border-top:1px solid red;">
                    <div class="asset-inner">
                        <table id="table-triwulan" class="table table-bordered table-striped table-condensed" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">No</th>
                                    <th style="text-align:center;">SKPD</th>
                                    <th style="text-align:center;">Triwulan 1</th>
                                    <th style="text-align:center;">Triwulan 2</th>
                                    <th style="text-align:center;">Triwulan 3</th>
                                    <th style="text-align:center;">Triwulan 4</th>
                                </tr>
                            </thead>
                            <tbody id="data-triwulan">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nama Bidang</h4>
      </div>
      <div class="modal-body" id="listDetail">  
      <form id="form-bidang" enctype="multipart/form-data" method="post">
      <!-- <form class="form-horizontal" id="form-tl" enctype="multipart/form-data" method="post"> -->
      
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="text" id="id_bidang" name="id_bidang" readonly class="form-control" />
                    </div>
                    
                </div>
            </div>
            
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Nama Bidang</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="text" id="nm_bidang" name="nm_bidang" readonly class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Alias</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="text" id="alias" name="alias" readonly class="form-control" />
                    </div>
                </div>
            </div>

            <div class="form-group-inner user-skpd" >
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <label class="login2">Akses SKPD</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                  <select name="skpd[]" multiple="multiple" id="skpd" class="form-control input-sm" style="width:100%;">
                    
                  </select>
                </div>
            </div>
           
            
        </div>
      </div>
                                       
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-flat btn-lg btn-primary">Simpan Perubahan</button> -->
        <input type="submit" name="submit" value="Simpan Perubahan" id="simpan" class="btn btn-primary btn-lg"  aksi = "all">
        <button type="button" class="btn btn-flat btn-lg btn-danger" data-dismiss="modal">Tutup</button>
        </form>
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
			  url: '<?php echo base_url('bidang-get-combo-skpd'); ?>',
			  type: 'POST',
			  success: function(data){
			  	$("#skpd").html(data);
			  }
		});

        $("#data-triwulan").html("<tr><td colspan='6' style='text-align:center;'>Harap Tunggu...</td></tr>");
        
        $.ajax({
              url: "<?php echo site_url('get-setting-triwulan')?>",
              type: 'POST',
              success: function(data){
                $("#data-triwulan").html(data);
                // $('#table-triwulan').DataTable({"ordering":false});
              }
          });

	  
	});
	var table;
     function refresh() {
            $("#data-triwulan").html("<tr><td colspan='6' style='text-align:center;'>Harap Tunggu...</td></tr>");
        
            $.ajax({
                  url: "<?php echo site_url('get-setting-triwulan')?>",
                  type: 'POST',
                  success: function(data){
                    $("#data-triwulan").html(data);
                    // $("#table-triwulan").DataTable().fnDestroy();
                    // $('#table-triwulan').DataTable({"ordering":false});
                  }
              });
        }
    $(document).ready(function() {
 
       

        

        

         $(document).on("click", "#simpan", function(e) { 

		    var data = $('#form-bidang').serialize();    
            
		    link = '<?php echo base_url('update-bidang'); ?>';
		    

		   
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

                $('#id_bidang').val('');
                $('#nm_bidang').val('');
                $('#alias').val('');
                $('#skpd').val('');
                $('#skpd').select2().trigger('change');
                $('#myModalLabel').html('Edit Bidang ');
                $('#myModal').modal('hide');
                
            })
            
			e.preventDefault();
		  });



    });

    $(document).on("click", ".changeCheck", function(e) {
       var checkbox = e.target;

       var skpd = $(this).attr('data-skpd');
       var thn = $(this).attr('data-thn');
       var tw = $(this).attr('data-tw');
       link = '<?php echo base_url('update-triwulan'); ?>';
        if (checkbox.checked) {
            var check = 'Y';
        } else {
            var check = 'T';
            //Checkbox has been unchecked
        }

        $.ajax({
            method: 'POST',
            url: link,
            data: {thn:thn,tw:tw,skpd:skpd,check:check}
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
           refresh();
            
        })
        
        e.preventDefault();
       
    });


    $(document).on("click", ".showModal", function() {
        
        var id         = $(this).attr("data-id");
        var nama          = $(this).attr("data-nama");
        $('#myModalLabel').html('Edit Bidang '+nama);
        $('#myModal').modal('show');
        $('#id_bidang').val('');
        $('#nm_bidang').val('');
        $('#alias').val('');
        $('#skpd').val('');
        $('#skpd').select2().trigger('change');
        
        
        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('get-modal-bidang'); ?>?id='+id,
        })
        .done(function(data) {
            var out = jQuery.parseJSON(data);

            $("#skpd").select2({
                multiple: true,
            });
            $('#skpd').val(out.skpd).trigger('change');
            
            $('#id_bidang').val(out.id);
            $('#nm_bidang').val(out.nama);
            $('#alias').val(out.alias);
            // $('#skpd').val(out.skpd);
        })
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

