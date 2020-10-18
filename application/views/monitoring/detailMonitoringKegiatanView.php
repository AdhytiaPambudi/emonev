<div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="product-status-wrap" style="min-height:450px;">
                                        <h4 style="text-align:center;color:#006df0;" id="judul-form">MONITORING KEGIATAN</h4>
                                        <hr style="border-top:3px solid #006df0;">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <a class="btn btn-default btn-sm" href="<?=base_url('data-pemantauan') ?>"><i class="fa fa-home"></i></a>
                                            <a class="btn btn-default btn-sm" href="<?=base_url('pemantauan-detail?skpd='.$kode_dinas) ?>"><?= $dinas;?></a>
                                            <a class="btn btn-primary btn-sm" href="#"><?= $program;?></a>
                                        </div>

                                        <div class="asset-inner">
                                            <table id="table-keg" class="table table-bordered table-striped table-condensed" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">No</th>
                                                        <th style="text-align:center;">Kode Kegiatan</th>
                                                        <th style="text-align:center;">Nama Kegiatan</th>
                                                        <th style="text-align:center;">Pagu</th>
                                                        <th style="text-align:center;">Pagu Ubah</th>
                                                        <?php if($this->session->userdata('is_admin') == 1 || $this->session->userdata('is_admin') == 3){ ?>
                                                        <th style="text-align:center;">Dokumentasi</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="data-keg">
                                                    
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                        <span class="help-block small">Catatan : Klik Kode Kegiatan atau Nama Kegiatan Untuk Melihat Rincian Kegiatan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Dokumentasi</h4>
      </div>
      <div class="modal-body" id="listDetail">  
      <form id="form-pemantauan" enctype="multipart/form-data" method="post">
      <!-- <form class="form-horizontal" id="form-tl" enctype="multipart/form-data" method="post"> -->
      <div class="row">
        
        
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="list-data" class="table">
                            <thead>
                            <tr class="active">
                                <th style="width:5%;text-align: center;"><b>NO</b></th>
                                <th style="width:25%;text-align: center;"><b>Dokumentasi</b></th>
                                <th style="width:40%;text-align: center;"><b>Uraian</b></th>
                                <th style="width:15%;text-align: center;"><b>Status (Publish)</b></th>
                                <th style="width:15%;text-align: center;"><b>Aksi</b></th>
                            </tr>
                            </thead>
                            <tbody id="isi_lampiran2">
                                

                            </tbody>

                        </table>
                        
                        <!-- <div class="file-upload-inner ts-forms">
                            <div class="input prepend-small-btn">
                                <div class="file-button">
                                    Browse
                                    <input type="file" id="logo_file" name="logo_file" onchange="document.getElementById('logo_daerah').value = this.value;">
                                </div>
                                <input type="text" id="logo_daerah" name="logo_daerah" readonly placeholder="Tidak ada File dipilih" required>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
      </div>
                                       
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-flat btn-lg btn-primary">Simpan Perubahan</button> -->
        <!-- <input type="submit" name="submit" value="Simpan Perubahan" id="simpan" class="btn btn-primary btn-lg"  aksi = "all">
        <button type="button" class="btn btn-flat btn-lg btn-danger" data-dismiss="modal">Tutup</button> -->
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

<script type="text/javascript">
     $(window).on('load', function () {
        $("#data-keg").html("<tr><td colspan='6' style='text-align:center;'>Harap Tunggu...</td></tr>");
        var skpd = '<?= $kode_dinas;?>';
        var prog = '<?= $kode_program;?>';
        $.ajax({
              url: "<?php echo site_url('get-monitoring-kegiatan?skpd=')?>"+skpd+"&prog="+prog,
              type: 'POST',
              success: function(data){
                $("#data-keg").html(data);
                $('#table-keg').DataTable();
              }
          });
          
    });

    $(document).on("click", ".showGambar", function() {
        

        var thn 		= $(this).attr("data-tahun");
        var keg 		= $(this).attr("data-keg");
        $('#myModal').modal('show');
        
		
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url('get-dokumentasi'); ?>?thn='+thn+'&keg='+keg,
	    })
	    .done(function(data) {
            var out = jQuery.parseJSON(data);

            $("#isi_lampiran2").html(out.tableLampiran);
            
	      	
	    })
    });
    $(document).on("click", ".aktif-lampiran", function() {
        var thn 		= $(this).attr("data-thn");
        var keg 		= $(this).attr("data-keg");
        var lamp 		= $(this).attr("data-lamp");
        var rek 		= $(this).attr("data-rek");
        var po 		    = $(this).attr("data-po");
        var aksi 		= $(this).attr("data-aksi");
        
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url('aktif-dokumentasi'); ?>?thn='+thn+'&keg='+keg+'&lamp='+lamp+'&rek='+rek+'&po='+po+'&aksi='+aksi,
	    })
	    .done(function(data) {
            var out = jQuery.parseJSON(data);

            $("#isi_lampiran2").html(out.tableLampiran);
            
	      	
	    })
	});
</script>