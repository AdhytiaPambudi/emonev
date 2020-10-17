<div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="product-status-wrap" style="min-height:450px;">
                                        <h4 style="text-align:center;color:#006df0;" id="judul-form">MONITORING PROGRAM</h4>
                                        <hr style="border-top:3px solid #006df0;">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <a class="btn btn-default btn-sm" href="<?=base_url('data-pemantauan') ?>"><i class="fa fa-home"></i></a>
                                            <a class="btn btn-primary btn-sm" href="#"><?= $dinas;?></a>
                                        </div>

                                        <div class="asset-inner">
                                            <table id="table-prog" class="table table-bordered table-striped table-condensed" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">No</th>
                                                        <th style="text-align:center;">Kode Program</th>
                                                        <th style="text-align:center;">Nama Program</th>
                                                        <th style="text-align:center;">Pagu</th>
                                                        <th style="text-align:center;">Pagu Ubah</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data-prog">
                                                    
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                        <span class="help-block small">Catatan : Klik Kode Program atau Nama Program Untuk Melihat List Kegiatan</span>
                                    </div>
                                </div>
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

<script type="text/javascript">
     $(window).on('load', function () {
        $("#data-prog").html("<tr><td colspan='6' style='text-align:center;'>Harap Tunggu...</td></tr>");
        var skpd = '<?= $kode;?>';
        $.ajax({
              url: "<?php echo site_url('get-monitoring-program?skpd=')?>"+skpd,
              type: 'POST',
              success: function(data){
                $("#data-prog").html(data);
                $('#table-prog').DataTable();
              }
          });
          
    });
</script>