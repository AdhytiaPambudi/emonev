<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/dropzone.css">
<!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#fungsi_tab"> Master Fungsi</a></li>
                                <li><a href="#urusan_tab"> Master Urusan</a></li>
                                <li><a href="#skpd_tab"> Master SKPD</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="fungsi_tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="product-status-wrap" style="min-height:450px;">
                                                <h4 style="text-align:center;" id="judul-form">List Fungsi</h4>
                                                <hr style="border-top:1px solid red;">
                                                <div class="asset-inner">
                                                    <table id="table-fungsi" class="table table-bordered table-striped" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode Fungsi</th>
                                                                <th>Nama Fungsi</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="urusan_tab">
                                     <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="product-status-wrap" style="min-height:450px;">
                                                <h4 style="text-align:center;" id="judul-form">List Urusan</h4>
                                                <hr style="border-top:1px solid red;">
                                                <div class="asset-inner">
                                                    <table id="table-urusan" class="table table-bordered table-striped" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode Urusan</th>
                                                                <th>Nama Urusan</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="product-tab-list tab-pane fade " id="skpd_tab">
                                     <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="product-status-wrap" style="min-height:450px;">
                                                <h4 style="text-align:center;" id="judul-form">List SKPD</h4>
                                                <hr style="border-top:1px solid red;">
                                                <div class="asset-inner">
                                                    <table id="table-skpd" class="table table-bordered table-striped" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode SKPD</th>
                                                                <th>Nama SKPD</th>
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

    
    var tablefungsi;
    var tableurusan;
    var tableskpd;
    // var tablefungsi;
    $(document).ready(function() {
 
        //datatables
        tablefungsi = $('#table-fungsi').DataTable({ 
            
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('get-master-fungsi')?>",
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

        //datatables
        tableurusan = $('#table-urusan').DataTable({ 
            
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('get-master-urusan')?>",
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

         //datatables
        tableskpd = $('#table-skpd').DataTable({ 
            
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('get-master-skpd')?>",
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
            tablefungsi.ajax.reload( null, false ); // user paging is not reset on reload
            tableurusan.ajax.reload( null, false ); // user paging is not reset on reload
            tableskpd.ajax.reload( null, false ); // user paging is not reset on reload
        }

        setInterval( function () {
            tablefungsi.ajax.reload( null, false ); // user paging is not reset on reload
            tableurusan.ajax.reload( null, false ); // user paging is not reset on reload
            tableskpd.ajax.reload( null, false ); // user paging is not reset on reload
        }, 30000 );
    });





</script>

<script src="<?= base_url() ?>assets/budistyle/js/dropzone/dropzone.js"></script>