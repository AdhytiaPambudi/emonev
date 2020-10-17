<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/dropzone.css">
<!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#backup_tab">Backup Database</a></li>
                                <li><a href="#restore_tab">Restore Database</a></li>
                                <li><a href="#transfer_tab">Transfer Data Keuangan</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="backup_tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section" style="height:450px;">
                                                <div id="dropzone1" class="pro-ad">
                                                    
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div id="loading-icon" style="text-align:center">
                                                                    
                                                                </div>
                                                                <div class="payment-adress">
                                                                    <button type="button" class="btn btn-primary waves-effect waves-light" id="backup">Backup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="restore_tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section" style="height:450px;">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action="/upload" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                               
                                                                <div class="form-group alert-up-pd">
                                                                    <div class="dz-message needsclick download-custom" style="text-align:center;">
                                                                        <i class="fa fa-download edudropnone" aria-hidden="true"></i>
                                                                        <h2 class="edudropnone">Drop FIle here or click to upload.</h2>
                                                                        <p class="edudropnone"><span class="note needsclick">(Silahkan Pilih File)</span>
                                                                        </p>
                                                                        <input name="imageico" class="hd-pro-img" type="text" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div id="loading-icon" style="text-align:center">
                                                                    
                                                                </div>
                                                                <div class="payment-adress">
                                                                    <button type="button" class="btn btn-primary waves-effect waves-light" id="restore">Restore</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="product-tab-list tab-pane fade " id="transfer_tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section" style="height:450px;">
                                                <div id="dropzone1" class="pro-ad">
                                                        <div class="widget-program-bg">
                                                            <div class="container-fluid">
                                                                <div class="row">

                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data Fungsi</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="fungsi">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="fungsi">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateFungsi">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data Urusan</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="urusan">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="urusan">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateUrusan">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data SKPD</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="skpd">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="skpd">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateSkpd">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data Sumberdana</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="sumberdana">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="sumberdana">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateSumberDana">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>



                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="widget-program-bg">
                                                            <div class="container-fluid">
                                                                <div class="row">

                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data Program</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="program">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="program">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateProgram">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data Kegiatan</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="kegiatan">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="kegiatan">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateKegiatan">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data Rek. Anggaran</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="skpd">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="skpd">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateRekAnggaran">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                            <div class="panel-body">
                                                                                <div class="text-center content-bg-pro">
                                                                                    <h3>Data Rek. Laporan</h3>
                                                                                    <p class="text-big font-light">
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="sumberdana">My Data</button>
                                                                                        <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="sumberdana">Import</button>
                                                                                    </p>

                                                                                    <small id ="lastUpdateRekLaporan">Terakhir Update : - </small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>


                                                                
                                                            </div>
                                                        </div>


                                                        <br>
                                                        <div class="row" hidden>
                                                            <div class="col-lg-12">
                                                                <div id="loading-icon" style="text-align:center">
                                                                    
                                                                </div>
                                                                <div class="payment-adress">
                                                                    <button type="button" class="btn btn-primary waves-effect waves-light" id="backup">Transfer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div id="modalDatabase" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="namaTable">NAMA TABEL
                </h4>
            </div>
            <div class="modal-body" id="isiModalDatabase">
                
            </div>
            <div class="modal-footer">
                
                <a id="import-data" href="#" class="hidden">Import</a>
                <a data-dismiss="modal" href="#">Tutup</a>
                                    
            </div>
        </div>
    </div>
</div> 


 


<script type="text/javascript">

    $(window).on('load', function () {
        
        $.ajax({
              url: '<?php echo base_url('get-last-update-database'); ?>',
              type: 'POST',
              success: function(data){
                var res = jQuery.parseJSON(data);
                $("#lastUpdateFungsi").html(res.fungsi);
                $("#lastUpdateUrusan").html(res.urusan);
                $("#lastUpdateSkpd").html(res.skpd);
                $("#lastUpdateSumberDana").html(res.sumberdana);
                $("#lastUpdateProgram").html(res.program);
                $("#lastUpdateKegiatan").html(res.kegiatan);
              }
          });
    });

    $(document).on("click", "#backup", function() {
        $("#loading-icon").html('<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;"><br>Harap Tunggu...</center>');
        $.ajax({
            url: '<?php echo base_url('backup-database'); ?>',
            type: 'POST',
            success: function(data){
              // $("#menu-pengawasan").html(data);

                if (data == 1) {
                    Lobibox.notify('info', {
                        size: 'mini',
                        msg: 'Database Berhasil di Backup'
                    });
                }else{
                    Lobibox.notify('danger', {
                        size: 'mini',
                        msg: 'Database Gagal di Backup'
                    });
                }
                $("#loading-icon").html('');
            }
          });
      });

    $(document).on("click", ".check-data", function() {
        var tbl      = $(this).attr("data-tbl");
        var db      = $(this).attr("data-db");
         $('body').prelodr({
          prefixClass: 'prelodr',
          show: function(){
            console.log('Show callback')
          },
          hide: function(){
            console.log('Hide callback')
          }
        })
        $('body').prelodr('in', 'Sedang diproses...');
        $.ajax({
            url: '<?php echo base_url('check-data-database'); ?>',
            type: 'POST',
            data:{db:db,tbl:tbl},
            success: function(data){
                $('body').prelodr('out');
                var res = jQuery.parseJSON(data);
                $('#isiModalDatabase').html(res.preview);
                $('#namaTable').html(res.judul);
                $('#modalDatabase').modal('show');
                $('#import-data').attr('data-db',db);
                $('#import-data').attr('data-tbl',tbl);
                if (db == 'bpddata') {
                    $('#import-data').attr('class','hidden');   
                }else{
                    $('#import-data').removeAttr('class');   
                }

            }
          });
        
      });

     $(document).on("click", "#import-data", function() {
        var tbl      = $(this).attr("data-tbl");
        var db      = $(this).attr("data-db");

         $('body').prelodr({
          prefixClass: 'prelodr',
          show: function(){
            console.log('Show callback')
          },
          hide: function(){
            console.log('Hide callback')
          }
        })
        $('body').prelodr('in', 'Sedang diproses...');

        $.ajax({
            url: '<?php echo base_url('importdata-database'); ?>',
            type: 'POST',
            data:{db:db,tbl:tbl},
            success: function(data){
                $('body').prelodr('out');
                
                    Lobibox.notify('info', {
                        size: 'mini',
                        msg: 'Tabel Berhasil di Transfer'
                    });
               

                var res = jQuery.parseJSON(data);
                $('#isiModalDatabase').html(res.preview);
                $('#namaTable').html(res.judul);
                $('#modalDatabase').modal('hide');
            }
          });
        
      });



</script>

<script src="<?= base_url() ?>assets/budistyle/js/dropzone/dropzone.js"></script>