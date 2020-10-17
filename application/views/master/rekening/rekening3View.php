<?php
    $parent = $_GET['parent'];
    $dataRek1 = $this->db->query("SELECT kd_rek1,nm_rek1 FROM ms_rek1 where kd_rek1 = ".substr($parent,0,1))->row();
    $dataRek2 = $this->db->query("SELECT kd_rek2,nm_rek2 FROM ms_rek2 where kd_rek2 = ".$parent)->row();

?>
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="product-status-wrap" style="min-height:450px;">
                                <h4 style="text-align:center;color:#006df0;" id="judul-form">Rekening Jenis</h4>
                                <hr style="border-top:3px solid #006df0;">
                                <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                    <a class="btn btn-default btn-sm" href="<?= base_url('master-rekening-1');?>"><i class="fa fa-home"></i></a>
                                    <a class="btn btn-default btn-sm" href="<?= base_url('master-rekening-2?parent='.$dataRek1->kd_rek1);?>"><?=$dataRek1->nm_rek1;?></a>
                                    <a class="btn btn-primary btn-sm" href="#"><?=$dataRek2->nm_rek2;?></a>
                                </div>

                                <div class="asset-inner">
                                    <table id="table-rekening" class="table table-bordered table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Rekening</th>
                                                <th>Nama Rekening</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <span class="help-block small">Catatan : Klik Kode Rekening atau Nama Rekening Untuk Melihat List Rekening Selanjutnya</span>
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

    var tableskpd;
    // var tablefungsi;
    $(document).ready(function() {
 
         //datatables
        tableskpd = $('#table-rekening').DataTable({ 
            
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('get-rekening-3?parent='.$parent)?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],
 
        });

        function reload_table () {
            tableskpd.ajax.reload( null, false ); // user paging is not reset on reload
        }

        setInterval( function () {
            tableskpd.ajax.reload( null, false ); // user paging is not reset on reload
        }, 30000 );
    });
</script>
