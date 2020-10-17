<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/dropzone.css">
<!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="product-status-wrap" style="min-height:450px;">
                                        <h4 style="text-align:center;color:#006df0;" id="judul-form">List Program</h4>
                                        <hr style="border-top:3px solid #006df0;">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <a class="btn btn-default btn-sm" href="<?=base_url('program-kegiatan/skpd');?>"><i class="fa fa-home"></i></a>
                                            <a class="btn btn-default btn-sm" href="<?=base_url('program-kegiatan/bidang?skpd=').$skpd->kd_skpd;;?>"><?=$skpd->nm_skpd; ?></a>
                                            <a class="btn btn-primary btn-sm" href="#"><?=$bidang->kd_urusan.' . '.$bidang->nm_urusan; ?></a>
                                        </div>

                                        <div class="asset-inner">
                                            <table id="table-program" class="table table-bordered table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Program</th>
                                                        <th>Nama Program</th>
                                                        <th>Pagu</th>
                                                        <th>Pagu Ubah</th>
                                                        <!-- <th>Aksi</th> -->
                                                    </tr>
                                                </thead>
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

    
    var tableprogram;
    // var tablefungsi;
    $(document).ready(function() {
 
         //datatables
        tableprogram = $('#table-program').DataTable({ 
            
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('get-pk-program/').$skpd->kd_skpd.'/'.$bidang->kd_urusan;?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            }, { 
                "targets": [ 0,1,2 ],  "className": 'text-center',
            },
            ],
 
        });

        function reload_table () {
            tableprogram.ajax.reload( null, false ); // user paging is not reset on reload
        }

        setInterval( function () {
            tableprogram.ajax.reload( null, false ); // user paging is not reset on reload
        }, 30000 );
    });





</script>