<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/mdb.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/style.css">

<div id="daftar-list-lhp">
<?php 
  $sql1 = "(SELECT noreg,id_aspek as kode,(SELECT nm_parameter from ms_was_umum where MID(id_parameter,2) = MID(tem.id_aspek,2) AND tahun = tem.tahun) as uraian, '' as nilai,tahun,'' as tlanjut,'' as sts_tlanjut, '' as file 
          FROM trd_tlhp_pemda_temuan tem where noreg = '".$noreg."' and no_lhp = '".$no_lhp."' AND LEFT(id_aspek,1) = 'U' GROUP BY id_aspek,1)
          UNION ALL
          (SELECT noreg,id_aspek as kode,(SELECT nm_parameter from ms_was_teknis where MID(id_parameter,2) = MID(tem.id_aspek,2) AND tahun = tem.tahun) as uraian, '' as nilai,tahun,'' as tlanjut,'' as sts_tlanjut, '' as file 
          FROM trd_tlhp_pemda_temuan tem where noreg = '".$noreg."' and no_lhp = '".$no_lhp."' AND LEFT(id_aspek,1) = 'T' GROUP BY id_aspek)";

  $res1 = $this->db->query($sql1)->result_array();
  $this->db->close();
  $jmlRes1 = count($res1);
  if (count($res1)>0) {
?>
<div class="treeview-colorful w-100 border border-secondary mx-4 my-4">
    <ul class="treeview-colorful-list mb-3">
<?php 
  foreach ($res1 as $value1) {
          $noreg1 = $value1['noreg'];
          $kode1 = $value1['kode'];
          $uraian1 = $value1['uraian'];
          $nilai1 = $value1['nilai'];
          $tahun1 = $value1['tahun'];

          $sql2 = "(SELECT noreg, kd_temuan as kode,judul_temuan as uraian ,nilai_temuan as nilai,tahun,'' as tlanjut,'' as sts_tlanjut, '' as file 
                  FROM trd_tlhp_pemda_temuan tem where noreg = '".$noreg1."'  and no_lhp = '".$no_lhp."' AND LEFT(kd_temuan,3) = '".$kode1."')";
          
          $res2 = $this->db->query($sql2)->result_array();
          $this->db->close();

          $jmlRes2 = count($res2);
          // tentukan ada sub nya / tidak
          if (count($res2) == 0) {


?>
        <li>
          <div class="treeview-colorful-element">
            <table border="0" width="100%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-file ic-w mr-1"></i> 
                </td>
                <td width="90%">
                   <span>
                   <?php echo $kode1; ?> -
                   <?php echo $uraian1; ?>
                   </span>
                </td>
              </tr>  
            </table>
          </div>
        </li>
<?php  
    }else{
?>
        <li class="treeview-colorful-items">
          <a class="treeview-colorful-items-header">
            

             <table border="0" width="100%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-plus-circle ic-w mx-1"></i>
                  <i class="fa fa-folder ic-w mx-1"></i>
                </td>
                <td width="90%">
                   <span>
                   <?php echo $kode1; ?> -
                   <?php echo $uraian1; ?>
                   </span>
                </td>
              </tr>  
            </table>

             </span>
          </a>
          <ul class="nested">


<?php 
    foreach ($res2 as $value2) {
              $noreg2 = $value2['noreg'];
              $kode2 = $value2['kode'];
              $uraian2 = $value2['uraian'];
              $nilai2 = $value2['nilai'];
              $tahun2 = $value2['tahun'];

      $sql3 = "
(SELECT noreg,kd_rekom as kode, rekomendasi as uraian, '' as nilai, tahun,tlanjut,sts_tlanjut,file 
FROM trd_tlhp_pemda_rekomendasi rek where noreg = '".$noreg."'  and no_lhp = '".$no_lhp."'  AND LEFT(kd_rekom,5) = '".$kode2."')";

    $res3 = $this->db->query($sql3)->result_array();
              $this->db->close();
              $jmlRes3 = count($res3);
              if (count($res3) == 0) {

?>

            <li>
          <div class="treeview-colorful-element">
            <table border="0" width="100%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-file ic-w mr-1"></i> 
                </td>
                <td width="88%">
                   <span>
                   <?php echo $kode2; ?> -
                   <?php echo $uraian2; ?>
                   </span>
                </td>
                <td width="6%"  style="font-size:14pt;">
                  <i class="fa fa-trash ic-w mr-1 pull-right hapusTemuan" data-toggle="tooltip" title="Hapus Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"  data-lhp = "<?php echo $no_lhp; ?>"  data-nama = "<?php echo $uraian2; ?>"></i>
                  <i class="fa fa-pencil ic-w mr-1 pull-right editTemuan" data-toggle="tooltip" title="Edit Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"   data-lhp = "<?php echo $no_lhp; ?>"  data-nama = "<?php echo $uraian2; ?>"></i> 
                </td>
              </tr>  
            </table>
          </div>
        </li>

<?php 
              }else{
?>
           <li class="treeview-colorful-items">
          <a class="treeview-colorful-items-header">
            <table border="0" width="100%" style="border:none;">
                <tr>
                  <td width="5%">
                    <i class="fa fa-plus-circle ic-w mx-1"></i>
                    <i class="fa fa-folder ic-w mx-1"></i>
                  </td>
                  <td width="90%">
                     <span>
                     <?php echo $kode2; ?> -
                     <?php echo $uraian2; ?>
                     </span>
                  </td>
                  <td width="5%"  style="font-size:14pt;">
                    <i class="fa fa-trash ic-w mr-1 pull-right hapusTemuan" data-toggle="tooltip" title="Hapus Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"  data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian2; ?>"></i>
                    <i class="fa fa-pencil ic-w mr-1 pull-right editTemuan" data-toggle="tooltip" title="Edit Temuan" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"   data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian2; ?>"></i> 
                  </td>
                </tr>  
              </table>
          </a>
          <ul class="nested">

<?php  
                  foreach ($res3 as $value3) {
                  $noreg3 = $value3['noreg'];
                  $kode3 = $value3['kode'];
                  $uraian3 = $value3['uraian'];
                  $nilai3 = $value3['nilai'];
                  $tahun3 = $value3['tahun'];
                  $sts_tlanjut3 = $value3['sts_tlanjut'];
                  $color = '';
                  if ($sts_tlanjut3 == 'SESUAI') {
                      $color .= ' style = "color:deepskyblue;" ';
                  }else if ($sts_tlanjut3 == 'BELUM SESUAI') {
                      $color .= ' style = "color:forestgreen;" ';
                  }else if ($sts_tlanjut3 == 'BELUM DITINDAKLANJUTI') {
                      $color .= ' style = "color:gold;" ';
                  }else if ($sts_tlanjut3 == 'TIDAK DAPAT DITINDAKLANJUTI') {
                      $color .= ' style = "color:red;" ';
                  }



?>
     <li>
          <div class="treeview-colorful-element">
            <table border="0" width="99.5%" style="border:none;">
              <tr>
                <td width="5%">
                  <i class="fa fa-file ic-w mr-1" <?=$color; ?>></i> 
                </td>
                <td width="85%">
                   <span>
                   <?php echo $kode3; ?> -
                   <?php echo $uraian3; ?>
                   </span>
                </td>
                <td width="6%"  style="font-size:14pt;">
                  <i class="fa fa-trash ic-w mr-1 pull-right hapusRekom" data-toggle="tooltip" title="Hapus Rekomendasi" data-reg ="<?php echo $noreg3; ?>" data-kode = "<?php echo $kode3; ?>"   data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian3; ?>"></i> 
                  <i class="fa fa-pencil ic-w mr-1 pull-right editRekom" data-toggle="tooltip" title="Edit Rekomendasi" data-reg ="<?php echo $noreg3; ?>" data-kode = "<?php echo $kode3; ?>"   data-lhp = "<?php echo $no_lhp; ?>" data-nama = "<?php echo $uraian3; ?>"></i> 
                </td>
              </tr>  
            </table>
            <!-- <?php echo $uraian3; ?> -->
            <!-- <i class="fa fa-eye ic-w mr-1 pull-right vTindak" data-reg ="<?php echo $noreg3; ?>" data-kode = "<?php echo $kode3; ?>"></i>  -->
          </div>
        </li>

<?php 
                }
                ?>
                </ul></li>
                <?php 

              }

    }
    ?>
    </ul></li>
    <?php 
    }
  }
  ?>
  </ul>
</div>  
<center>
  <a href="#" class="btn btn-default btn-lg tlanjut">Lanjut ke TLHP <i class="fa fa-arrow-circle-right"></i></a>
</center>

  <?php 
}else{ ?>
  <div class="panel panel-headline panel-primary">
  <div class="panel-heading" style="height:200px;">
    <h1><center><img src="<?php echo base_url('assets/img/empty.gif'); ?>"  height="100" width="100"><br>DATA TEMUAN BELUM ADA!</center></h1>
  </div>
</div>

<?php } ?>
</div>

<div id="form-edit-temuan" hidden>
  <h4 style="text-align:center;">FORM EDIT TEMUAN</h4>
  <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
  <form class="form-horizontal" id="form-isi-edit-temuan">
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Kode Temuan</label>

      <div class="col-sm-3">
        <input type="text" name="kd_temuan" class="form-control input-sm" readonly="" id="kd_temuan_e" placeholder="">
        <input type="text" name="noreg" class="form-control input-sm hidden" readonly="" id="noreg_e" placeholder="">
        <input type="text" name="no_lhp" class="form-control input-sm hidden" readonly="" id="no_lhp_e" placeholder="">
      </div>
      </div>
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Temuan</label>

      <div class="col-sm-8">
        <input type="text" name="jdl_temuan" class="form-control input-sm" id="jdl_temuan_e" placeholder="">
      </div>
      </div>

      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Nilai Temuan</label>

      <div class="col-sm-3">
        <input type="text" name="nilai_temuan" class="form-control input-sm function_separator" id="nilai_temuan_e" placeholder="">
      </div>
      </div>
      <center>
        <button type="button" data-aksi="simpan" class="btn btn-success btn-lg update-temuan"><i class="fa fa-check"></i> UPDATE TEMUAN</button>
        <button type="button" class="btn btn-danger btn-lg back_to_list"><i class="fa fa-remove"></i> BATAL</button>
      </center>
  </form>
</div>


<div id="form-edit-rekomendasi" hidden>
  <h4 style="text-align:center;">FORM EDIT REKOMENDASI</h4>
  <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
  <form class="form-horizontal" id="form-isi-edit-rekomendasi">
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Kode Rekomendasi</label>

      <div class="col-sm-3">
        <input type="text" name="kd_temuan" class="form-control input-sm hidden" readonly="" id="kd_temuan_r" placeholder="">
        <input type="text" name="kd_rekom" class="form-control input-sm" readonly="" id="kd_rekom_r" placeholder="">
        <input type="text" name="noreg" class="form-control input-sm hidden" readonly="" id="noreg_r" placeholder="">
        <input type="text" name="no_lhp" class="form-control input-sm hidden" readonly="" id="no_lhp_r" placeholder="">
      </div>
      </div>
      <div class="form-group">
      <label for="kd_temuan" class="col-sm-3 control-label input-sm">Rekomendasi</label>

      <div class="col-sm-8">
        <input type="text" name="rekomendasi" class="form-control input-sm" id="rekomendasi_r" placeholder="">
      </div>
      </div>
      <center>
        <button type="button" data-aksi="simpan" class="btn btn-success btn-lg update-rekomendasi"><i class="fa fa-check"></i> UPDATE REKOMENDASI</button>
        <button type="button" class="btn btn-danger btn-lg back_to_list"><i class="fa fa-remove"></i> BATAL</button>
        
      </center>
  </form>
</div>


<!-- 
<div class="treeview-colorful w-100 border border-secondary mx-4 my-4">
  
  <ul class="treeview-colorful-list mb-3">
    <li class="treeview-colorful-items">
      <a class="treeview-colorful-items-header">
        <i class="fa fa-plus-circle"></i>
        <i class="fa fa-folder ic-w mx-1"></i><span> <?php echo $tahun; ?></span>
      </a>
      <ul class="nested">

        <li class="treeview-colorful-items">
          <a class="treeview-colorful-items-header">
            <i class="fa fa-plus-circle"></i>
            <i class="fa fa-folder ic-w mx-1"></i><span> <?php echo $tahun; ?></span>
          </a>
          <ul class="nested">
            <li>
              <div class="treeview-colorful-element"><i class="fa fa-file ic-w mr-1"></i> Deadlines
            </li>
          </ul>
        </li>
      </ul>
    </li>
    
  </ul>
</div> -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <?php if(isset($msg) || validation_errors() !== ''): ?>
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <?= validation_errors();?>
            <?= isset($msg)? $msg: ''; ?>
          </div>
        <?php endif; ?>
         
          <div class="row">
            <div class="col-sm-8">
        <!-- <?php echo form_open('#', 'class="form-horizontal" id="form-input"');  ?>  -->
              <form class="form-horizontal" id="form-tl" enctype="multipart/form-data" method="post">
           
                  <input type="text" name="noreg_rek" id="noreg_rek" class="form-control input-sm hidden" placeholder="">
                  <input type="text" name="kd_rek" id="kd_rek" class="form-control input-sm hidden" placeholder="">
                  <div class="form-group row">
                  <label for="rekomendasi" class="col-sm-2 control-label input-sm">Rekomendasi</label>
                  <div class="col-sm-9">
                  <textarea name="rekomendasi" class="form-control input-sm" id="rekomendasi" maxlength="300" placeholder="" value="" readonly=""></textarea>
                  </div>
                  </div>

                <div class="form-group row">
                  <label for="tlanjut" class="col-sm-2 control-label input-sm">Tindak Lanjut</label>
                  <div class="col-sm-9">
                    <textarea name="tlanjut" class="form-control input-sm" id="tlanjut" maxlength="300" placeholder="" value=""></textarea>
                  </div>
                </div>
                  <div class="form-group row">
                  <label for="tlanjut" class="col-sm-2 control-label input-sm">Data Dukung</label>
                  <div class="col-sm-9">
                     <table id="list-data" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th style="width:5%;text-align: center;">#</th>
                                  <th style="width:75%;text-align: center;"><b>Nama File</b></th>
                                  <th style="width:20%;text-align: center;"><b>Preview</b></th>
                                </tr>
                              </thead>
                              <tbody id="isi_lampiran">
                                <tr>
                                    <td>1</td>  
                                    <td><input type="file" name="nm_lampiran[]" id="nm_lampiran" onchange="validateFormat(this)" /></td>  
                                    <td id="previewFile"></td>  
                                </tr>
                              </tbody>
                            </table>
                  </div>
                  </div>
                  <div class="form-group row">
                  <label for="rekomendasi" class="col-sm-2 control-label input-sm">Status</label>
                  <div class="col-sm-9">

                    <select name="sts_tlanjut" id="sts_tlanjut" class="form-control input-sm" <?= $this->session->userdata('is_admin') == 1 ? '' : 'disabled'; ?>>
                        <option value="SESUAI">SESUAI</option>
                        <option value="BELUM SESUAI">BELUM SESUAI</option>
                        <option value="BELUM DITINDAKLANJUTI">BELUM DITINDAKLANJUTI</option>
                        <option value="TIDAK DAPAT DITINDAKLANJUTI">TIDAK DAPAT DITINDAKLANJUTI</option>                  
                    </select>
                  </div>
                  </div>
                   <div class="form-group row">
                  <label for="rekomendasi" class="col-sm-2 control-label input-sm">Catatan</label>
                  <div class="col-sm-9">
                    <textarea name="catatan" class="form-control input-sm" id="catatan" <?= $this->session->userdata('is_admin') == 1 ? '' : 'disabled'; ?> maxlength="300" placeholder="" value=""></textarea>
                  </div>
                  </div>
                    <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
                    <div class="form-group row">
                      <div class="col-md-4 control-label"></div>
                    <div class="col-md-8">
                      <div class="pull-right">
                        <input type="button" name="tambah" value="Tambah" id="tambah" class="btn btn-primary btn-lg">
                        <input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-lg hidden">
                          <input type="button" name="cetak" value="Cetak" id="cetak" class="btn btn-danger btn-lg">
                          <input type="button" name="batal" value="Batal" id="batal" class="btn btn-danger btn-lg hidden" data-dismiss="modal">
                      </div>
                    </div>
                    </div>
                </form>
              </div>
              <div class="col-sm-4">
                <div class="panel panel-headline  panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-comments"></i> CHAT</h3>
                  </div>
                  <div class="panel-body" id="isi_cat" style="min-height:315px;height: 315px;overflow: scroll;">

                  
                  </div>

                  <div class="panel-footer">
                     <div class="input-group">
                        <input type="text" class="form-control input-sm" id="text_chat" placeholder="Ketik Pesan...">
                        <span class="input-group-btn">
                          <button class="btn btn-success btn-md" type="button" onclick="kirimChat()">Kirim</button>
                        </span>
                      </div><!-- /input-group -->
                  </div>
                </div>
              </div>
            </div>

        <!-- <?php echo form_close( ); ?> -->
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


<script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script>
<script src="<?= base_url() ?>assets/vendor/mdb/js/mdb.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('.treeview-colorful').mdbTreeview();
});
$(function () {
          $('[data-toggle="tooltip"]').tooltip();
      });  
$(document).ready(function(){
        // Format mata uang.
        $( '.function_separator' ).mask('00,000,000,000.00', {reverse: true});
    });
</script>
<script type="text/javascript">
  
  $('#form-tl').submit(function(e) {

        // var data = $(this).serialize();
        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('tlhp-pemda/insert-tindak-lanjut'); ?>',
          data: new FormData(this),
          contentType:false,
          cache : false,
          processData:false,
        })
        .done(function(data) {
          var out = jQuery.parseJSON(data);

          $('#myModal').modal('hide');
          $("#sts_tlanjut").val(out.status);
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

   $(document).on("click", ".update-temuan", function(e) {

        var data = $('#form-isi-edit-temuan').serialize();

        var jdl_temuan = $('#jdl_temuan_e').val();
        var nilai_temuan = $('#nilai_temuan_e').val();

       
        if (jdl_temuan == '') {
          Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA JUDUL TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
        exit();
        }
        if (nilai_temuan == '') {
          Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA NILAI TEMUAN BELUM DIISI',showConfirmButton: false,timer: 2000});
        exit();
        }


        
        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('tlhp-pemda/update-temuan'); ?>',
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
        })
        $('#modalTemuan').modal('hide');
        e.preventDefault();
      });

 $(document).on("click", ".update-rekomendasi", function(e) {

        var data = $('#form-isi-edit-rekomendasi').serialize();

        var rekomendasi = $('#rekomendasi_r').val();

        if (rekomendasi == '') {
          Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA REKOMENDASI BELUM DIISI',showConfirmButton: false,timer: 2000});
        exit();
        }


        
        $.ajax({
          method: 'POST',
          url: '<?php echo base_url('tlhp-pemda/update-rekomendasi'); ?>',
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
        })
        $('#modalTemuan').modal('hide');
        e.preventDefault();
      });


  $(document).on("click", ".editTemuan", function() {
          
          var noreg     = $(this).attr("data-reg");
          var kode    = $(this).attr("data-kode");
          var lhp    = $(this).attr("data-lhp");
          
          

            $.ajax({
          url: '<?php echo base_url('tlhp-pemda/get-edit-temuan'); ?>',
          type: 'POST',
          data:{noreg:noreg,kode:kode,lhp:lhp}
      }).done(function(data2) {
          var out = jQuery.parseJSON(data2);
          $('#form-edit-temuan').removeAttr('hidden');
          $('#daftar-list-lhp').attr('hidden','');
          $('#noreg_e').val(out.noreg);
          $('#no_lhp_e').val(out.no_lhp);
          $('#kd_temuan_e').val(out.kd_temuan);
          $('#jdl_temuan_e').val(out.judul_temuan);
          $('#nilai_temuan_e').val(out.nilai_temuan);
      });
  });

  $(document).on("click", ".editRekom", function() {
      
      var noreg     = $(this).attr("data-reg");
      var kode    = $(this).attr("data-kode");
      var lhp    = $(this).attr("data-lhp");

      $.ajax({
          url: '<?php echo base_url('tlhp-pemda/get-edit-rekomendasi'); ?>',
          type: 'POST',
          data:{noreg:noreg,kode:kode,lhp:lhp}
      }).done(function(data2) {
          var out = jQuery.parseJSON(data2);
          $('#form-edit-rekomendasi').removeAttr('hidden');
          $('#daftar-list-lhp').attr('hidden','');
          $('#noreg_r').val(out.noreg);
          $('#no_lhp_r').val(out.no_lhp);
          $('#kd_temuan_r').val(out.kd_temuan);
          $('#kd_rekom_r').val(out.kd_rekom);
          $('#rekomendasi_r').val(out.rekomendasi);
      });
  });

function clear_tl() {
  
  $('#noreg_rek').val('');
  $('#kd_rek').val('');
  $('#tlanjut').html('');
  $('#sts_tlanjut').val('');
  $('#rekomendasi').html('');
  $('#catatan').html('');
  // $('#kab').select2().trigger('change');
  // $('#pembahas_anev').val('');
  // $('#pembahas_anev').select2().trigger('change');
  // $('#pembahas_apip').val('');
  // $('#pembahas_apip').select2().trigger('change');
  // $('#pembahas_obrik').val('');
  // $('#pembahas_obrik').select2().trigger('change');
  // $('#review').val('');
  // $('#review').select2().trigger('change');
  // $('#no_lhp').val('');
  // $('#dalnis').val('');
    
}
</script>