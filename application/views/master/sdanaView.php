<div class="mailbox-compose-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="hpanel shadow-inner responsive-mg-b-30">
                            <div class="panel-body"  style = "min-height:550px;">
                                <a href="#" class="btn btn-success compose-btn btn-block m-b-md">Pilih Status Anggaran</a>
                                <hr>
                                <ul class="mailbox-list">
                                    
                                    <li>
                                        <a href="<?=base_url('sumber-dana'); ?>" class="listTriwulan" data-id="1" style="border: 1px solid red;">
                                            Sumber Dana (Murni)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('sumber-dana-perubahan'); ?>" class="listTriwulan" data-id="2">
                                            Sumber Dana (Perubahan)
                                        </a>
                                    </li>
                                    
                                </ul>
                                
                                
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="hpanel email-compose" style = "min-height:550px;">
                            <div class="panel-heading hbuilt">
                                <div class="p-xs h4" style="text-align:center;">
                                    <h4 style="text-align:center;" id="judul-form">List Sumber Dana (Murni)</h4>
                                    <hr style="border-top:1px solid red;">
                                </div>
                            </div>
                            <div class="panel-heading hbuilt">
                                <table id="table-sd" class="table table-bordered table-striped table-condensed" style="width:100%;font-size:8pt;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sumber Dana</th>
                                            <th>Mapping Sumber Dana</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-sd">
                                
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>




<!-- Single pro tab review Start-->
        <!-- <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                           
                                <div class="product-tab-list tab-pane fade active in" id="fungsi_tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="product-status-wrap" style="min-height:450px;">
                                                <h4 style="text-align:center;" id="judul-form">List Sumber Dana</h4>
                                                <hr style="border-top:1px solid red;">
                                                <div class="asset-inner">
                                                    <table id="table-sd" class="table table-bordered table-striped" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Sumber Dana</th>
                                                                <th>Mapping Sumber Dana</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="data-sd">
                                                    
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
            </div>
        </div> -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mapping</h4>
      </div>
      <div class="modal-body" id="listDetail">  
      <form id="form-sd" enctype="multipart/form-data" method="post">
            
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="form-group-inner">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label class="login2">Tahun Anggaran</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 form-group">
                                <input type="text" id="thn_anggaran" name="thn_anggaran" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label class="login2">Nama Sumber Dana</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 form-group">
                                <input type="text" id="nm_sumberdana" name="nm_sumberdana" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label class="login2">Status</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 form-group">
                                <input type="text" id="sts_anggaran" name="sts_anggaran" class="form-control" required readonly />
                            </div>
                        </div>
                       
                        <div class="form-group row" >
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label class="login2">Mapping Kode Group</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 form-group">
                              <select name="kd_group_sd" id="kd_group_sd" class="form-control input-sm" style="width:100%;">
                                
                              </select>
                            </div>
                         </div>
                    </div>

                
                </div> 
              </div>
            </div>
                  
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-flat btn-lg btn-primary">Simpan Perubahan</button> -->
        <input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-primary btn-lg"  aksi = "all">
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


<script type="text/javascript">

    $(window).on('load', function () {
        $("#data-sd").html("<tr><td colspan='4' style='text-align:center;'>Harap Tunggu...</td></tr>");
        $.ajax({
              url: "<?php echo site_url('get-sumber-dana');?>",
              type: 'POST',
              success: function(data){
                $("#data-sd").html(data);
                $('#table-sd').DataTable();
              }
          });

        $.ajax({
              url: '<?php echo base_url('get-group-sd'); ?>',
              type: 'POST',
              success: function(data){
                $("#kd_group_sd").html(data);
              }
        });
    });

     function clear_form() {
            
            $('#kd_group_sd').val('');
            $('#kd_group_sd').select2().trigger('change');
            $('#thn_anggaran').val('');
            $('#nm_sumberdana').val('');
            $('#sts_anggaran').val('');
            
            
        }

     $(document).on("click", ".showModal", function() {
        var thn         = $(this).attr("data-tahun");
        var nm_sd         = $(this).attr("data-sd");
        var sts         = $(this).attr("data-sts");
        var grp         = $(this).attr("data-grp");

        clear_form();

        // move data
        $('#thn_anggaran').val(thn);
        $('#nm_sumberdana').val(nm_sd);
        $('#sts_anggaran').val(sts);
        $('#kd_group_sd').val(grp);
        $('#kd_group_sd').select2().trigger('change');
        $('#myModal').modal('show');

    });

     $(document).on("click", "#simpan", function(e) {    

            var data = $('#form-sd').serialize();    
            var grp = $('#kd_group_sd').val();
            if(grp == ''){
                Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI GRUP SUMBER DANA',showConfirmButton: false,timer: 2000});
                exit();             
            }
            
            
            var link;
            
            link = '<?php echo base_url('mapping-sd'); ?>';

           
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
                $('#myModal').modal('hide');
                clear_form();
                location.reload(); 
            })
            
            e.preventDefault();
          });

     $('#kd_group_sd').select2({
        placeholder: 'Pilih Group'
    });

</script>

