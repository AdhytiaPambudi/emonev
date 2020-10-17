<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/mdb.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/style.css">
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/mdb/css/bootstrap.css"> -->
<style type="text/css">
  .inputWrapper {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("../assets/img/cari.jpg");
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
    background-image: url("../assets/img/add.jpg");
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
    background-image: url("../assets/img/remove.jpg");
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
    background-image: url("../assets/img/file.jpg");
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
<div class="treeview-colorful w-100 border border-secondary mx-4 my-4">
<?php 
  $sql1 = "(SELECT noreg,no_lhp,id_aspek as kode,(SELECT nm_parameter from ms_pemeriksaan_kinerja where id_parameter = tem.id_aspek AND tahun = tem.tahun) as uraian, '' as nilai,tahun,'' as tlanjut,'' as sts_tlanjut, '' as file 
          FROM trd_tlhp_kemendagri_temuan tem where noreg = '".$noreg."' and no_lhp = '".$no_lhp."' GROUP BY id_aspek)";
  
  
  $res1 = $this->db->query($sql1)->result_array();
  $this->db->close();
  $jmlRes1 = count($res1);
  if (count($res1)>0) {
?>
    <ul class="treeview-colorful-list mb-3">
<?php 
  foreach ($res1 as $value1) {
          $noreg1 = $value1['noreg'];
          $kode1 = $value1['kode'];
          $uraian1 = $value1['uraian'];
          $nilai1 = $value1['nilai'];
          $tahun1 = $value1['tahun'];

          $sql2 = "(SELECT noreg,no_lhp, kd_temuan as kode,judul_temuan as uraian ,nilai_temuan as nilai,tahun,'' as tlanjut,'' as sts_tlanjut, '' as file 
                  FROM trd_tlhp_kemendagri_temuan tem where noreg = '".$noreg1."'  and no_lhp = '".$no_lhp."' AND LEFT(kd_temuan,3) = '".$kode1."')";
          
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
          </a>
          <ul class="nested">


<?php 
    foreach ($res2 as $value2) {
              $noreg2 = $value2['noreg'];
              $no_lhp2 = $value2['no_lhp'];
              $kode2 = $value2['kode'];
              $uraian2 = $value2['uraian'];
              $nilai2 = $value2['nilai'];
              $tahun2 = $value2['tahun'];

            $sql3 = "
(SELECT noreg,no_lhp,kd_rekom as kode, rekomendasi as uraian, '' as nilai, tahun,tlanjut,sts_tlanjut,file 
FROM trd_tlhp_kemendagri_rekomendasi rek where noreg = '".$noreg."'  and no_lhp = '".$no_lhp."'  AND LEFT(kd_rekom,5) = '".$kode2."')";

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
                <td width="90%">
                   <span>
                   <?php echo $kode2; ?> -
                   <?php echo $uraian2; ?>
                   </span>
                </td>
                <td width="5%"  style="font-size:14pt;">
                  <i class="fa fa-money ic-w mr-1 pull-right vSetoran" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"  data-lhp = "<?php echo $no_lhp2; ?>"  data-toggle="tooltip" title="Setoran"></i> 
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
                  <i class="fa fa-money ic-w mr-1 pull-right vSetoran" data-reg ="<?php echo $noreg2; ?>" data-kode = "<?php echo $kode2; ?>"  data-lhp = "<?php echo $no_lhp2; ?>"  data-toggle="tooltip" title="Setoran"></i> 
                </td>
              </tr>  
            </table>
            <!-- <i class="fa fa-plus-circle"></i>
            <i class="fa fa-folder ic-w mx-1"></i><span>

             <?php echo $uraian2; ?>
             </span> -->
          </a>
          <ul class="nested">

<?php  
                  foreach ($res3 as $value3) {
                  $noreg3 = $value3['noreg'];
                  $kode3 = $value3['kode'];
                  $no_lhp3 = $value3['no_lhp'];
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
                <td width="90%">
                   <span>
                   <?php echo $kode3; ?> -
                   <?php echo $uraian3; ?>
                   </span>
                </td>
                <td width="5%"  style="font-size:14pt;">
                  <i class="fa fa-eye ic-w mr-1 pull-right vTindak" data-reg ="<?php echo $noreg3; ?>" data-kode = "<?php echo $kode3; ?>"  data-lhp = "<?php echo $no_lhp3; ?>" data-toggle="tooltip" title="Tindak Lanjut" ></i> 
                </td>
              </tr>  
            </table>
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
  <?php 
}
 ?>
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
          <div class="row">
            <div class="col-sm-8">
        <!-- <?php echo form_open('#', 'class="form-horizontal" id="form-input"');  ?>  -->
              <form class="form-horizontal" id="form-tl" enctype="multipart/form-data" method="post">
           
                  <input type="text" name="noreg_rek" id="noreg_rek" class="form-control input-sm hidden" placeholder="">
                  <input type="text" name="no_lhp_rek" id="no_lhp_rek" class="form-control input-sm hidden" placeholder="">
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
                    <textarea name="tlanjut" class="form-control input-sm autoExpand" id="tlanjut" maxlength="300" placeholder="" value=""></textarea>
                  </div>
                </div>
                  <div class="form-group row">
                  <label for="tlanjut" class="col-sm-2 control-label input-sm">Data Dukung</label>
                  <div class="col-sm-9">
                     <table id="list-data" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th style="width:10%;text-align: center;"><b>File</b></th>
                                  <th style="width:70%;text-align: center;"><b>Nama File</b></th>
                                  <th style="width:20%;text-align: center;"><b>Aksi</b></th>
                                </tr>
                              </thead>
                              <tbody id="isi_lampiran">
                                

                              </tbody>

                              <tfoot>
                                
                                <tr>
                                    <td style="width:10%;text-align: center;">
                                      <div class="inputWrapper" data-toggle="tooltip" title="Cari File">
                                        <input type="file" class="fileInput fileInputTl" onchange="validateFormat(this)" name="nm_lampiran[]" id="nm_lampiran" />
                                      </div>
                                    </td>  
                                    <td>
                                      <input type="text" name="file_tl" id="file_tl" class="form-control input-sm" readonly placeholder="">
                                    </td>
                                    <td>
                                      <!-- <button type="button" class="btn btn-success btn-md" id="upload_setor"><i class="fa fa-plus"></i></button> -->
                                      <div class='inputWrapperAdd' data-toggle="tooltip" title="Tambah">
                                        <input type="submit" id="upload_tl" class="fileInput" value="Upload" aksi = "justFile"> 
                                      </div>
                                    </td>  
                                </tr>
                                <tr>
                                  <td colspan = "3" style="width:100%;text-align: center;"><div class="alert alert-warning" role="alert">* Maksimal Ukuran File : 1 MB || Format : image/word/pdf</div></td>
                                </tr>
                              
                              </tfoot>
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
                        <input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-lg hidden" aksi = 'all'>
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



<div class="modal fade" id="modalSetoran" tabindex="-1" role="dialog" aria-labelledby="modalSetoranLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalSetoranLabel">Modal title</h4>
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
            <div class="col-sm-12">
        <!-- <?php echo form_open('#', 'class="form-horizontal" id="form-input"');  ?>  -->
              <form class="form-horizontal" id="form-temuan" enctype="multipart/form-data" method="post">
           
                  <input type="text" name="noreg_temuan" id="noreg_temuan" class="form-control input-sm hidden" placeholder="">
                  <input type="text" name="kd_temuan" id="kd_temuan" class="form-control input-sm hidden" placeholder="">
                  <input type="text" name="lhp_temuan" id="lhp_temuan" class="form-control input-sm hidden" placeholder="">
                  <div class="form-group row">
                  <label for="rekomendasi" class="col-sm-2 control-label input-sm">Judul Temuan</label>
                  <div class="col-sm-9">
                  <textarea name="jdl_temuan" class="form-control input-sm" id="jdl_temuan" maxlength="300" placeholder="" value="" readonly=""></textarea>
                  </div>
                  </div>

                <div class="form-group row">
                  <label for="tlanjut" class="col-sm-2 control-label input-sm">Nilai Temuan</label>
                  <div class="col-sm-3">
                    <input type="text"  name="nilai_temuan" class="form-control input-sm function_separator" id="nilai_temuan" placeholder="" readonly="">
                  </div>
                </div>
                  <div class="form-group row">
                  <label for="tlanjut" class="col-sm-2 control-label input-sm">Total Setoran</label>
                  <div class="col-sm-3">
                    <input type="text" style = "color:darkgreen;" name="total_setor" class="form-control input-sm function_separator" id="total_setor" placeholder="" readonly="">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tlanjut" class="col-sm-2 control-label input-sm">Sisa Setoran</label>
                  <div class="col-sm-3">
                    <input type="text" style = "color:red;" name="sisa_temuan" class="form-control input-sm function_separator" id="sisa_temuan" placeholder="" readonly="">
                  </div>
                </div>

                <div style="border-top:2px solid #ccc;padding:5px 5px 10px 5px;"></div>
                 
                
                  <div class="form-group row">
                  <label for="tlanjut" class="col-sm-12" style="text-align:center;font-size:12pt;padding-bottom:5px;padding-top:0px;">Detail Setoran</label>
                  <div class="col-sm-12">
                     <table id="list-data" class="table">
                              <thead>
                                <tr class="active">
                                  <th style="width:5%;text-align: center;"><b>NO</b></th>
                                  <th style="width:10%;text-align: center;"><b>&nbsp;</b></th>
                                  <th style="width:5%;text-align: center;"><b>Cari File</b></th>
                                  <th style="width:20%;text-align: center;"><b>Nilai Setor</b></th>
                                  <th style="width:15%;text-align: center;"><b>Tanggal Setor</b></th>
                                  <th style="width:40%;text-align: center;"><b>Nama File Bukti Setor</b></th>
                                  <th style="width:5%;text-align: center;"><b>Aksi</b></th>
                                </tr>
                              </thead>
                              <tbody id="isi_lampiran2">
                                

                              </tbody>

                              <tfoot>
                                
                                <tr>
                                     <td class="active" style="width:5%;text-align: center;vertical-align:middle;" rowspan="2">
                                      #
                                    </td>  
                                    <td class="active" style="width:10%;text-align: center;vertical-align:middle;">
                                      LAMPIRAN
                                    </td>  
                                    <td style="width:5%;text-align: center;">
                                      <div class="inputWrapper"  data-toggle="tooltip" title="Cari File">
                                        <input type="file" class="fileInput fileInputTemuan" onchange="validateFormat(this)" name="nm_lampiran2[]" id="nm_lampiran2"/>
                                      </div>
                                    </td>  
                                    <td>
                                      <input type="text" name="setor_temuan" id="setor_temuan" class="form-control input-sm function_separator hitungSisa" placeholder="Masukkan Nilai Setor">
                                      <!-- <input type="text" name="total_setor" id="total_setor" class="form-control input-sm function_separator hidden" placeholder=""> -->
                                    </td>
                                    <td>
                                      <input type="date" name="tgl_setor" id="tgl_setor" class="form-control input-sm" placeholder="Masukkan Tanggal Setor">
                                    </td>
                                    <td>
                                      <input type="text" name="bukti_setor" id="bukti_setor" class="form-control input-sm" readonly placeholder="Pilih File (Akan Terisi Otomatis)">
                                    </td>
                                    <td rowspan="2" style="vertical-align:middle;">
                                      <!-- <button type="button" class="btn btn-success btn-md" id="upload_setor"><i class="fa fa-plus"></i></button> -->
                                      <div class='inputWrapperAdd'  data-toggle="tooltip" title="Tambah">
                                      <input type="submit"  value="UPLOAD" id="upload_setor" class="fileInput" aksi = "justFile">
                                      </div>
                                    </td>  
                                </tr>
                                <tr>
                                    <td class="active" style="width:10%;text-align: center;vertical-align:middle;">
                                      CATATAN
                                    </td>  
                                    <td>&nbsp</td>
                                    <td colspan = "3" style = "padding:10px 10px 10px 10px;">
                                      <textarea name="catatan_temuan" id="catatan_temuan" class="form-control input-sm" placeholder="Masukkan Catatan"></textarea>
                                    </td>
                                </tr>
                                <tr style="padding:0 0 0 0px;">
                                  <td colspan = "7" style="width:100%;text-align: center;padding:0 0 0 0px;"><div class="alert alert-warning" role="alert">* Maksimal Ukuran File : 1 MB || Format : image/word/pdf</div></td>
                                </tr>
                              
                              </tfoot>
                            </table>
                  </div>
                  </div>
                
                    
                 <!--  <div class="form-group row hidden">
                  <label for="tlanjut" class="col-sm-2 control-label input-sm">Tgl Setor</label>
                  <div class="col-sm-5">
                    <input type="date" name="tgl_setor" class="form-control input-sm" id="tgl_setor" placeholder="">
                  </div>
                </div> -->

                  <!--   <div style="border-top:2px solid #f8a406;padding:5px 5px 10px 5px;"></div>
                    <div class="form-group row">
                      <div class="col-md-4 control-label"></div>
                    <div class="col-md-8">-->
                      <div class="pull-right"> 
                        
                        <input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-lg" aksi = 'all'>
                          
                          <!-- <input type="button" name="batal" value="Batal" id="batal" class="btn btn-danger btn-lg" data-dismiss="modal"> -->
                     </div>
                    <!--  </div>
                    </div> -->
                </form>
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
<script type="text/javascript">
  $(function () {
          $('[data-toggle="tooltip"]').tooltip();
      });
  $(document).ready(function() {
  $('.treeview-colorful').mdbTreeview();
});

</script>
<script type="text/javascript">
  

  $('#form-tl').submit(function(e) {
        var link;
        e.preventDefault();
        var aksi = $(this).attr('aksi');
        var ev = $(document.activeElement).attr('aksi');
        if (ev == 'justFile') {
            var file_tl = $('#file_tl').val();
            if (file_tl == '') {
              Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH FILE TERLEBIH DAHULU',showConfirmButton: false,timer: 2000});
              $('.fileInputTemuan').focus();
              e.preventDefault();

              exit();
            }
            link = '<?php echo base_url('tlhp-kemendagri/insert-lampiran-tl'); ?>';
        }else{
            link  = '<?php echo base_url('tlhp-kemendagri/insert-tindak-lanjut'); ?>';
        }
        
        

        

        // var data = $(this).serialize();
        $.ajax({
          method: 'POST',
          url: link,
          data: new FormData(this),
          contentType:false,
          cache : false,
          processData:false,
        })
        .done(function(data) {
          var out = jQuery.parseJSON(data);
          if (ev == 'justFile') {
            
              $("#isi_lampiran").html(out.tableLampiran);
              $("#file_tl").val('');
          }else{
              
              $('#myModal').modal('hide');
              $("#sts_tlanjut").val(out.status);
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: out.pesan,
                showConfirmButton: false,
                timer: 2000
              });
              location.reload();
          }
          

        })

        
      });

   $('#form-temuan').submit(function(e) {
        var bukti = $('#bukti_setor').val();
        var setor = $('#setor_temuan').val();
        var tgl_setor = $('#tgl_setor').val();
        var catatan = $('#catatan_temuan').val();
        var ev = $(document.activeElement).attr('aksi');
        if (ev == 'justFile') {
            
            if (bukti == '' || setor == '' || tgl_setor == '' || catatan == '' ) {
              if (bukti == '') {
                Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH FILE TERLEBIH DAHULU',showConfirmButton: false,timer: 2000});
                $('.fileInputTemuan').focus();
                e.preventDefault();

                exit();
              }else{
                Swal.fire({position: 'top-end',icon: 'warning',title: 'DATA INPUTAN BELUM LENGKAP',showConfirmButton: false,timer: 2000});
                e.preventDefault();
                exit();
              }

            }else{
              $.ajax({
                method: 'POST',
                url: '<?php echo base_url('tlhp-kemendagri/insert-setoran'); ?>',
                data: new FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              })
              .done(function(data) {
                var out = jQuery.parseJSON(data);
                $("#sisa_temuan").val(out.sisa_temuan);
                $("#total_setor").val(out.total_setor);
                $("#isi_lampiran2").html(out.tableLampiran);
                // $('#modalSetoran').modal('hide');
                // $("#sts_tlanjut").val(out.status);
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: out.pesan,
                  showConfirmButton: false,
                  timer: 2000
                });
                $('#bukti_setor').val('');
                $('#setor_temuan').val('');
                $('#tgl_setor').val('');
                $('#catatan_temuan').val('');
              })
              
              e.preventDefault();

            }
        }else{
           $.ajax({
                method: 'POST',
                url: '<?php echo base_url('tlhp-kemendagri/insert-setoran'); ?>',
                data: new FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              })
              .done(function(data) {
                var out = jQuery.parseJSON(data);
                $("#sisa_temuan").val(out.sisa_temuan);
                $("#total_setor").val(out.total_setor);
                $("#isi_lampiran2").html(out.tableLampiran);
                // $('#modalSetoran').modal('hide');
                // $("#sts_tlanjut").val(out.status);
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: out.pesan,
                  showConfirmButton: false,
                  timer: 2000
                });
                $('#bukti_setor').val('');
                $('#setor_temuan').val('');
                $('#tgl_setor').val('');
                $('#catatan_temuan').val('');
              })
              
              e.preventDefault();

        }

        
        
        
      });

   $(document).on("click", ".hapus-lampiran", function() {
          
          var noreg     = $(this).attr("data-reg");
          var kd_temuan    = $(this).attr("data-temuan");
          var kd_lamp    = $(this).attr("data-lamp");
          var no_lhp    = $(this).attr("data-lhp");

           Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus data ini ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data Ini.'
            }).then((result) => {
              if (result.value) {

                   $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('tlhp-kemendagri/del-lampiran'); ?>?noreg='+noreg+'&lhp='+no_lhp+'&temuan='+kd_temuan+'&lamp='+kd_lamp,
                })
                .done(function(data) {
                  
          var out = jQuery.parseJSON(data);
            $("#jdl_temuan").html(out.judul_temuan); 
            $("#nilai_temuan").val(out.nilai_temuan);
            // $("#setor_temuan").val(out.setor_temuan);

            $("#kd_temuan").val(out.kd_temuan);
            $("#noreg_temuan").val(out.noreg);
            $("#lhp_temuan").val(out.no_lhp);
            $("#previewFileTemuan").html(out.file);
            
            
            $("#sisa_temuan").val(out.sisa_temuan);
            $("#total_setor").val(out.total_setor);
            $("#isi_lampiran2").html(out.tableLampiran);
                   
                })

              }
            })
    });


 $(document).on("click", ".hapus-lampiran-tl", function() {
          
          var noreg     = $(this).attr("data-reg");
          var kd_rek    = $(this).attr("data-rek");

          var kd_lamp    = $(this).attr("data-lamp");
          var no_lhp    = $(this).attr("data-lhp");

           Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus data ini ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data Ini.'
            }).then((result) => {
              if (result.value) {

                   $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('tlhp-kemendagri/del-lampiran-tl'); ?>?noreg='+noreg+'&lhp='+no_lhp+'&rek='+kd_rek+'&lamp='+kd_lamp,
                })
                .done(function(data) {
                  
          var out = jQuery.parseJSON(data);
            

            
            
            
            
            $("#isi_lampiran").html(out.tableLampiran);
                   
                })

              }
            })
    });



  $(document).on("click", ".vTindak", function() {
          
          var noreg     = $(this).attr("data-reg");
          var kode    = $(this).attr("data-kode");
          var no_lhp    = $(this).attr("data-lhp");
          

            $.ajax({
          url: '<?php echo base_url('tlhp-kemendagri/get-modal-rekomendasi'); ?>',
          type: 'POST',
          data:{noreg:noreg,no_lhp:no_lhp,kode:kode}
      }).done(function(data2) {


          clear_tl();
            var out = jQuery.parseJSON(data2);
            $("#isi_cat").html(out.chat); 
            $("#noreg_rek").val(out.noreg);
            $("#no_lhp_rek").val(out.no_lhp);
            $("#kd_rek").val(out.kd_rekom);
            $("#tlanjut").val(out.tlanjut);
            $("#rekomendasi").val(out.rekomendasi);
            $("#sts_tlanjut").val(out.sts_tlanjut);
            $("#previewFile").html(out.file);
            $("#catatan").val(out.catatan);
            $("#isi_lampiran").html(out.tableLampiran);

      });






   //         $('#parameter').html(nm_par);
   //         $('#kode').html(id_par);
   //         $('#id_parameter').val(id_par);
   //         $('#nilai').val(Math.round(nilai));
   //         $('#nilai').select2().trigger('change');
   //         $('#tahun').val(thn);
   //         $('#id_daerah').val(daerah);
      // $('#bobot').html(bobot);
          
      var aksi = 'edit';

        
        // $("#form-input").attr("action", "<?php echo base_url('binwas/edit/'); ?>"+id_par+"/"+daerah+"/"+thn);
          $('#tambah').attr('class','hidden');
          $('#cetak').attr('class','hidden');
          if(aksi == 'edit'){
          $('#myModalLabel').html('Form Tindak Lanjut '+kode);  
            $('#simpan').removeAttr('class','hidden');
            $('#simpan').attr('class','btn btn-success btn-lg');
            $('#simpan').removeAttr('aksi');
            $('#simpan').attr('aksi','edit');
            $('#batal').removeAttr('class','hidden');
            $('#batal').attr('class','btn btn-danger btn-lg');
            $('#nilai').removeAttr('disabled','');
            $('#keterangan').removeAttr('disabled','');
            $('#nm_lampiran').removeAttr('disabled','');
          }else{
            $('#myModalLabel').html('Detail Nilai Parameter');  
        $('#simpan').attr('class','btn btn-success btn-lg hidden');
            $('#batal').attr('class','btn btn-success btn-lg hidden');            
            $('#nilai').attr('disabled','');
            $('#keterangan').attr('disabled','');
            $('#nm_lampiran').attr('disabled','');
          }
          

          
          $('#myModal').modal('show');
      });



   


  $(".hitungSisa").change(function(){
    var nilai=$('#nilai_temuan').val();
    var setor=$('#setor_temuan').val();
    var totSetor=$('#total_setor').val();
    var nilai1 = nilai.replace(/,/g,'');
    var setor1 = setor.replace(/,/g,'');
    var totSetor1 = totSetor.replace(/,/g,'');
    var sisa = (parseFloat(nilai1)- parseFloat(totSetor1))- parseFloat(setor1);
    var n = sisa.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    
    if(sisa>=0){
          $('#sisa_temuan').val(n);
        }else{
          $('#setor_temuan').val('');
           Swal.fire({
              position: 'top-end',
                  icon: 'error',
                title: 'Oops...',
                text: 'Nilai Setoran Melebihi Nilai Temuan!',
              showConfirmButton: false,
              timer: 2000
            });
        }
    
    
    });

    function validateFormat(fileInput){
 // var selectedFile = objFileControl.value;
// console.log(objFileControl.files[0].type); 
              
            var filePath = fileInput.value; 
            const fileSize = fileInput.files[0].size;
            const size = Math.round((fileSize / 1024)); 

            
            // Allowing file type 

            var allowedExtensions =  
                    /(\.jpg|\.jpeg|\.png|\.gif|\.doc|\.docx|\.pdf)$/i; 
              
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
      $('#bukti_setor').val(namaLamp);
    });

    $(".fileInputTl").change(function(){


      var namaFile = $('#nm_lampiran').val();
      var namaLamp = namaFile.replace("C:\\fakepath\\", "");
      $('#file_tl').val(namaLamp);
    });

    $(document).on("click", ".vSetoran", function() {
          
          var noreg     = $(this).attr("data-reg");
          var kode    = $(this).attr("data-kode");
          var no_lhp    = $(this).attr("data-lhp");
          

          $.ajax({
          url: '<?php echo base_url('tlhp-kemendagri/get-modal-setoran'); ?>',
          type: 'POST',
          data:{noreg:noreg,no_lhp:no_lhp,kode:kode}
      }).done(function(data2) {


            clear_tl();
            var out = jQuery.parseJSON(data2);
            $("#jdl_temuan").html(out.judul_temuan); 
            $("#nilai_temuan").val(out.nilai_temuan);
            // $("#setor_temuan").val(out.setor_temuan);

            $("#kd_temuan").val(out.kd_temuan);
            $("#noreg_temuan").val(out.noreg);
            $("#lhp_temuan").val(out.no_lhp);
            $("#previewFileTemuan").html(out.file);
            
            
            $("#sisa_temuan").val(out.sisa_temuan);
            $("#total_setor").val(out.total_setor);
            $("#isi_lampiran2").html(out.tableLampiran);
            

      });

          
      var aksi = 'edit';

        
        // $("#form-input").attr("action", "<?php echo base_url('binwas/edit/'); ?>"+id_par+"/"+daerah+"/"+thn);
          $('#tambah').attr('class','hidden');
          $('#cetak').attr('class','hidden');
          if(aksi == 'edit'){
          $('#modalSetoranLabel').html('Form Setoran '+kode);  
            $('#simpan').removeAttr('class','hidden');
            $('#simpan').attr('class','btn btn-success btn-lg');
            $('#simpan').removeAttr('aksi');
            $('#simpan').attr('aksi','edit');
            $('#batal').removeAttr('class','hidden');
            $('#batal').attr('class','btn btn-danger btn-lg');
            $('#nilai').removeAttr('disabled','');
            $('#keterangan').removeAttr('disabled','');
            $('#nm_lampiran').removeAttr('disabled','');
          }else{
            $('#modalSetoranLabel').html('Detail Nilai Parameter');  
            $('#simpan').attr('class','btn btn-success btn-lg hidden');
            $('#batal').attr('class','btn btn-success btn-lg hidden');            
            $('#nilai').attr('disabled','');
            $('#keterangan').attr('disabled','');
            $('#nm_lampiran').attr('disabled','');
          }
          

          
          $('#modalSetoran').modal('show');
      });

function currency(value, separator) {
    if (typeof value == "undefined") return "0";
    if (typeof separator == "undefined" || !separator) separator = ",";
 
    return value.toString()
                .replace(/[^\d]+/g, "")
                .replace(/\B(?=(?:\d{3})+(?!\d))/g, separator);
}
 
window.addEventListener('keyup', function(e) {
    var el = e.target;
    if (el.classList.contains('currency')) {
        el.value = currency(el.value, el.getAttribute('data-separator'));
    }
false});


 $("#add_file").click(function(event){
  var urut     = $(this).attr("data-number");
  var no = parseInt(urut)+1;

  var tr = ' <tr>'+
            '<td>'+no+'</td>'+
            '<td>'+
            '<div class="inputWrapper">'+
              '<input type="file" class="fileInput fileInputTemuan" name="nm_lampiran2[]" id="nm_lampiran'+no+'" onchange="validateFormat(this)" data-number="'+no+'" />'+
            '</div>'+
            '</td>'+
            '<td>'+
              '<input type="text" name="nm_file_temuan'+no+'" id="nm_file_temuan'+no+'" class="form-control input-sm" readonly placeholder="">'+
            '</td>'+
            '<td id="previewFileTemuan">'+
            '<input type="button" class="btn btn-sm btn-danger" value="Hapus" onclick="deleteRow(this)"/>'+
            '</td> '+
            '</tr>';
  $(this).removeAttr("data-number");
  $(this).attr("data-number",no);
  $('#isi_lampiran2').append(tr);
  
  event.preventDefault();
})
function clear_tl() {
  
  $('#noreg_rek').val('');
  $('#no_lhp_rek').val('');
  $('#kd_rek').val('');
  $('#tlanjut').val('');
  $('#sts_tlanjut').val('');
  $('#rekomendasi').val('');
  $('#catatan').val('');
    
}
</script>
<script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
        $( '.function_separator' ).mask('00,000,000,000.00', {reverse: true});
    })
  </script>