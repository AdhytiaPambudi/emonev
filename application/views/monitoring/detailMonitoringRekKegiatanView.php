<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/alerts.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/form/all-type-forms.css">
<style type="text/css">
  .inputWrapper {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/cari.jpg");
     background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; 
}
.inputWrapperSearch {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/file.jpg");
     background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; 
}

.inputWrapperAdd {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/add.jpg");
     background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; 
}

.inputWrapperRemove {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/remove.jpg");
     background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; 
}


.fileInput {
    cursor: pointer;
    height: 100%;
    position:absolute;
    top: 0;
    right: 0;
    z-index: 99;
    /*This makes the button huge. If you want a bigger button, increase the font size*/
    font-size:50px;
    /*Opacity settings for all browsers*/
    opacity: 0;
    -moz-opacity: 0;
    filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0)
}

</style>
<style>
.gambar-dok img {
  border: 1px solid #ddd; /* Gray border */
  border-radius: 4px;  /* Rounded border */
  padding: 5px; /* Some padding */
  width: 100%; /* Set a small width */
}

/* Add a hover effect (blue shadow) */
.gambar-dok img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>


<div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="product-status-wrap" style="min-height:450px;">
                                        <h4 style="text-align:center;color:#006df0;" id="judul-form">MONITORING RINCIAN KEGIATAN</h4>
                                        <hr style="border-top:3px solid #006df0;">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <a class="btn btn-default btn-sm" href="<?=base_url('monitoring-data') ?>"><i class="fa fa-home"></i></a>
                                            <a class="btn btn-default btn-sm" href="<?=base_url('monitoring-detail?skpd='.$kode_dinas) ?>"><?= $dinas;?></a>
                                            <a class="btn btn-default btn-sm" href="<?=base_url('monitoring-detail-kegiatan?skpd='.$kode_dinas.'&prog='.$kode_program) ?>"><?= $program;?></a>
                                            <a class="btn btn-primary btn-sm" href="#"><?= $kegiatan;?></a>
                                        </div>
                                        <div class="asset-inner">
                                            <table id="table-rinci" class="table table-bordered table-striped table-condensed" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">Uraian</th>
                                                        <th style="text-align:center;">Target<br>Fisik</th>
                                                        <th style="text-align:center;">Target<br>Keuangan</th>
                                                        <th style="text-align:center;">Target<br>(%)</th>
                                                        <th style="text-align:center;">Relisasi<br>Fisik</th>
                                                        <th style="text-align:center;">Realisasi<br>Fisik (%)</th>
                                                        <th style="text-align:center;">Realisasi<br>Keuangan</th>
                                                        <th style="text-align:center;">Realisasi<br>Keuangan (%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data-rinci">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <span class="help-block small">Catatan : Klik Uraian Untuk Melihat Rincian</span>
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
        <h4 class="modal-title" id="myModalLabel">Target Realisasi</h4>
      </div>
      <div class="modal-body" id="listDetail">  
      <form id="form-pemantauan" enctype="multipart/form-data" method="post">
        <ul id="myTabedu1" class="tab-review-design">
            <li class="active"><a href="#detail_tab">Detail Realisasi</a></li>
            <li><a href="#dokumentasi_tab">Dokumentasi</a></li>
            <li><a href="#monitoring_tab">Monitoring</a></li>
        </ul>
        <div id="myTabContent" class="tab-content custom-product-edit">

      <!-- <form class="form-horizontal" id="form-tl" enctype="multipart/form-data" method="post"> -->
            <div class="product-tab-list tab-pane fade active in" id="detail_tab">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group-inner" >
                            <div class="sparkline8-list">
                                <div class="sparkline8-hd">
                                    <div class="main-sparkline8-hd">
                                        <h1>Target Realisasi Fisik</h1>
                                    </div>
                                </div>
                                <div class="sparkline8-graph">
                                    <div class="static-table-list">
                                        <table class="table table-condensed table-bordered" style="font-size:9pt;">
                                            <thead style="background:#006DF0;color:white;">
                                                <tr>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Target</th>
                                                    <th style="text-align:center;" colspan ="4">Realisasi</th>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Total Realisasi</th>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Total (%)</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:center;">Triwulan 1</th>
                                                    <th style="text-align:center;">Triwulan 2</th>
                                                    <th style="text-align:center;">Triwulan 3</th>
                                                    <th style="text-align:center;">Triwulan 4</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tb-fisik">
                                                <tr>
                                                    <td colspan="7" style="text-align:center;">Harap Tunggu ...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group-inner">
                            <div class="sparkline8-list">
                                <div class="sparkline8-hd">
                                    <div class="main-sparkline8-hd">
                                        <h1>Target Realisasi Keuangan</h1>
                                    </div>
                                </div>
                                <div class="sparkline8-graph">
                                    <div class="static-table-list">
                                        <table class="table table-condensed table-bordered" style="font-size:9pt;">
                                            <thead style="background:#006DF0;color:white;">
                                                <tr>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Target</th>
                                                    <th style="text-align:center;" colspan ="4">Realisasi</th>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Total Realisasi</th>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Total (%)</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:center;">Triwulan 1</th>
                                                    <th style="text-align:center;">Triwulan 2</th>
                                                    <th style="text-align:center;">Triwulan 3</th>
                                                    <th style="text-align:center;">Triwulan 4</th>
                                                </tr>
                                            </thead>
                                             <tbody id="tb-keu">
                                                <tr>
                                                    <td colspan="7" style="text-align:center;">Harap Tunggu ...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group-inner">
                            <div class="sparkline8-list">
                                <div class="sparkline8-hd">
                                    <div class="main-sparkline8-hd">
                                        <h1>Bentuk Pelaksanaan</h1>
                                    </div>
                                </div>
                                <div class="sparkline8-graph">
                                    <div class="static-table-list">
                                        <table class="table table-condensed table-bordered" style="font-size:9pt;">
                                            <thead style="background:#006DF0;color:white;">
                                                <tr>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Bentuk Pelaksanaan</th>
                                                    <th style="text-align:center;" colspan ="3">Rincian Kontrak</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:center;">No Kontrak</th>
                                                    <th style="text-align:center;">Kontraktor</th>
                                                    <th style="text-align:center;">Nilai Kontrak</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tb-kontrak">
                                                <tr>
                                                    <td colspan="4" style="text-align:center;">Harap Tunggu ...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group-inner">
                            <div class="sparkline8-list">
                                <div class="sparkline8-hd">
                                    <div class="main-sparkline8-hd">
                                        <h1>Lokasi dan Keterangan Lainnya</h1>
                                    </div>
                                </div>
                                <div class="sparkline8-graph">
                                    <div class="static-table-list">
                                        <table class="table table-condensed table-bordered" style="font-size:9pt;">
                                            <thead style="background:#006DF0;color:white;">
                                                <tr>
                                                    <th style="text-align:center;" colspan ="3">Lokasi</th>
                                                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Keterangan/Permasalahan</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:center;">Distrik</th>
                                                    <th style="text-align:center;">Kampung</th>
                                                    <th style="text-align:center;">Koordinat</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tb-lokasi">
                                                <tr>
                                                    <td colspan="4" style="text-align:center;">Harap Tunggu ...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-tab-list tab-pane fade" id="dokumentasi_tab">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="form-group-inner hidden">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" id="tahun_anggaran" name="tahun_anggaran" class="form-control" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" id="kd_kegiatan" name="kd_kegiatan" class="form-control" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" id="kode_rek" name="kode_rek" class="form-control" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" id="kode_po" name="kode_po" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group-inner">
                        <div class="row" id="tbl-dokumentasi">
                              
                        </div>
                    </div>
                </div>
              </div>
            </div>


            <div class="product-tab-list tab-pane fade" id="monitoring_tab">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group-inner">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="alert alert-info alert-st-two alert-st-bg1" role="alert">
                                    <i class="fa fa-table edu-inform admin-check-pro admin-check-pro-clr1" aria-hidden="true"></i>
                                    <p class="message-mg-rt"><strong>Monitoring Meja</strong> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-inner">
                        <div class="row">
                            <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label class="login2">Keterangan</label>
                            </div> -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">

                                <textarea name="monitoring_meja" id="monitoring_meja" <?=$this->session->userdata('is_admin') == 5 ? 'readonly': ''; ?>  placeholder="Isian Monitoring Meja"></textarea>
                            </div>
                        </div>
                    </div>
                
                </div> 
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group-inner">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="alert alert-info alert-st-two alert-st-bg1" role="alert">
                                    <i class="fa fa-building edu-inform admin-check-pro admin-check-pro-clr1" aria-hidden="true"></i>
                                    <p class="message-mg-rt"><strong>Monitoring Lapangan</strong> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-inner">
                        <div class="row">
                            <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label class="login2">Keterangan</label>
                            </div> -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <textarea name="monitoring_lapangan" id="monitoring_lapangan" <?=$this->session->userdata('is_admin') == 5 ? 'readonly': ''; ?> placeholder="Isian Monitoring Lapangan"></textarea>
                            </div>
                        </div>
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
<script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>



<script type="text/javascript">
     $(window).on('load', function () {
         
        $("#data-rinci").html("<tr><td colspan='8' style='text-align:center;'>Harap Tunggu...</td></tr>");
        var skpd = '<?= $kode_dinas;?>';
        var prog = '<?= $kode_program;?>';
        var keg = '<?= $kode_kegiatan;?>';
        $.ajax({
              url: "<?php echo site_url('get-monitoring-rekening-kegiatan?skpd=')?>"+skpd+"&prog="+prog+"&keg="+keg,
              type: 'POST',
              success: function(data){
                $("#data-rinci").html(data);
                $('#table-rinci').DataTable({"ordering":false});
              }
          });
          
    });

    function refresh(){
        $("#data-rinci").html("<tr><td colspan='8' style='text-align:center;'>Harap Tunggu...</td></tr>");
        var skpd = '<?= $kode_dinas;?>';
        var prog = '<?= $kode_program;?>';
        var keg = '<?= $kode_kegiatan;?>';
        $.ajax({
              url: "<?php echo site_url('get-monitoring-rekening-kegiatan?skpd=')?>"+skpd+"&prog="+prog+"&keg="+keg,
              type: 'POST',
              success: function(data){
                $("#data-rinci").html(data);
                $("#table-rinci").DataTable().fnDestroy();
                $('#table-rinci').DataTable({"ordering":false});
              }
          });
    }

    $('#form-pemantauan').submit(function(e) {
        
           $.ajax({
                method: 'POST',
                url: '<?php echo base_url('input-data-monitoring'); ?>',
                data: new FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              })
              .done(function(data) {
                var out = jQuery.parseJSON(data);
                $('#myModal').modal('hide');
                refresh();
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


      $(document).on("click", ".hapus-lampiran", function() {
          
          var thn       = $(this).attr("data-thn");
          var keg       = $(this).attr("data-keg");
          var rek       = $(this).attr("data-rek");
          var po        = $(this).attr("data-po");
          var kd_lamp        = $(this).attr("data-lamp");

           Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus data ini ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) {

                   $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('del-data-pemantauan-file'); ?>?thn='+thn+'&keg='+keg+'&rek='+rek+'&po='+po+'&lamp='+kd_lamp,
                })
                .done(function(data) {
                  
                    var out = jQuery.parseJSON(data);
                     $("#isi_lampiran2").html(out.tableLampiran);
                   
                })

              }
            })
    });

    function validateFormat(fileInput){
    // var selectedFile = objFileControl.value;
    // console.log(objFileControl.files[0].type); 
                
                var filePath = fileInput.value; 
                const fileSize = fileInput.files[0].size;
                const size = Math.round((fileSize / 1024)); 

                
                // Allowing file type 

                var allowedExtensions =  
                        /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i; 
                
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


    $(".fileInputTemuan").change(function(){

        var namaFile = $('#nm_lampiran2').val();
        var namaLamp = namaFile.replace("C:\\fakepath\\", "");
        $('#dokumentasi').val(namaLamp);
    });

    $(document).ready(function(){
        $( '.function_separator' ).mask('00.000.000.000,00', {reverse: true});
    });

    $(".change_bentuk").change(function(){
        
        var bntk = $(this).val();
        if(bntk == 'NK'){
            $('#nilai_kontrak').attr('readonly',true);
            $('#kontraktor').attr('readonly',true);
            $('#no_kontrak').attr('readonly',true);
            $('#dokumen-kontraktual').attr('hidden',true);
        }else if(bntk == 'K'){
            $('#nilai_kontrak').removeAttr('readonly');
            $('#kontraktor').removeAttr('readonly');
            $('#no_kontrak').removeAttr('readonly');
            $('#dokumen-kontraktual').removeAttr('hidden');
        }
    });

    $(document).on("click", ".showModal", function() {
        var thn 		= $(this).attr("data-tahun");
        var keg 		= $(this).attr("data-keg");
        var rek 		= $(this).attr("data-rek");
        var po 	    	= $(this).attr("data-po");
        var skpd          = $(this).attr("data-skpd");
        $('#myModal').modal('show');
        
		
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url('get-rinci-monitoring-kegiatan'); ?>?thn='+thn+'&skpd='+skpd+'&keg='+keg+'&rek='+rek+'&po='+po,
	    })
	    .done(function(data) {
            var out = jQuery.parseJSON(data);

            
            $('#myModalLabel').html(out.uraian);

            $('#tahun_anggaran').val(thn);
            $('#kd_kegiatan').val(keg);
            $('#kode_rek').val(rek);
            $('#kode_po').val(po);

            $('#monitoring_meja').val(out.monitoring_meja);
            $('#monitoring_lapangan').val(out.monitoring_lapangan);

            $('#tb-fisik').html(out.tblfisik);
            $('#tb-keu').html(out.tblkeu);
            $('#tb-kontrak').html(out.tblkontrak);
            $('#tb-lokasi').html(out.tbllokasi);
            $('#tbl-dokumentasi').html(out.tbldokumentasi);

            
	      	
	    })
	});
</script>