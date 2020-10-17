<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/dropzone.css">
<!-- Single pro tab review Start-->
<div class="flash-data" data-flashdata = "<?= $this->session->flashdata('msg');?>">
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <div class="product-tab-list tab-pane fade active in" id="fungsi_tab">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="product-status-wrap" style="min-height:450px;">
                                            <h4 style="text-align:center;" id="judul-form">List Data Umum
                                                <a href="<?= base_url('add-data-umum'); ?>" class="btn btn-primary pull-right" >Tambah</a>
                                            </h4>
                                            
                                            <hr style="border-top:1px solid red;">
                                            <div class="asset-inner">
                                                <table id="table-data-umum" class="table table-bordered table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tahun Anggaran</th>
                                                            <th>Nama Daerah</th>
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
    
    });
    var tableumum;
    // var tablefungsi;
    $(document).ready(function() {
 
        //datatables
        tableumum = $('#table-data-umum').DataTable({ 
            
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('get-data-umum')?>",
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
            tableumum.ajax.reload( null, false ); // user paging is not reset on reload
        }

        setInterval( function () {
            tableumum.ajax.reload( null, false ); // user paging is not reset on reload
        }, 30000 );
    });

</script>

<script type="text/javascript">

	$(document).on("click", ".hapus-data", function() {
		var id 		= $(this).attr("data-id");
        var nama 	= $(this).attr("data-nama");
        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Menghapus data ("+id+") "+nama,
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#006DF0',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Ya, Hapus Data.'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = "<?= base_url('hapus-data-umum?thn='); ?>"+id;
		  }
		})

	});

</script>

<script src="<?= base_url() ?>assets/budistyle/js/dropzone/dropzone.js"></script>