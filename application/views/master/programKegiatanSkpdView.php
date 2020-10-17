
<!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="product-status-wrap" style="min-height:450px;">
                                        <h4 style="text-align:center;color:#006df0;" id="judul-form">List SKPD</h4>
                                        <hr style="border-top:3px solid #006df0;">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-home"></i></a>
                                        </div>

                                        <div class="asset-inner">
                                        <table id="table-skpd" class="table table-bordered table-striped table-condensed" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">No</th>
                                                        <th style="text-align:center;">Kode SKPD</th>
                                                        <th style="text-align:center;">Nama SKPD</th>
                                                        <th style="text-align:center;">Pagu</th>
                                                        <th style="text-align:center;">Pagu Ubah</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data-skpd">
                                                    
                                                </tbody>
                                            </table>
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
        $("#data-skpd").html("<tr><td colspan='6' style='text-align:center;'>Harap Tunggu...</td></tr>");
        $.ajax({
              url: "<?php echo site_url('get-pk-skpd');?>",
              type: 'POST',
              success: function(data){
                $("#data-skpd").html(data);
                $('#table-skpd').DataTable();
              }
          });
          
    });
</script>


