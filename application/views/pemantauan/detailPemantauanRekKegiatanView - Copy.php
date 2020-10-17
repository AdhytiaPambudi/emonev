<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/alerts.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/form/all-type-forms.css">
<style type="text/css">
  .inputWrapper {
    height: 30px;
    width: 30px;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-image: url("./assets/img/cari.jpg");
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
    background-image: url("./assets/img/file.jpg");
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
    background-image: url("./assets/img/add.jpg");
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
    background-image: url("./assets/img/remove.jpg");
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


<div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <div class="product-status-wrap" style="min-height:450px;">
                                        <h4 style="text-align:center;color:#006df0;" id="judul-form">RINCIAN KEGIATAN</h4>
                                        <hr style="border-top:3px solid #006df0;">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <a class="btn btn-default btn-sm" href="<?=base_url('data-pemantauan') ?>"><i class="fa fa-home"></i></a>
                                            <a class="btn btn-default btn-sm" href="<?=base_url('pemantauan-detail?skpd='.$kode_dinas) ?>"><?= $dinas;?></a>
                                            <a class="btn btn-default btn-sm" href="<?=base_url('pemantauan-detail-kegiatan?skpd='.$kode_dinas.'&prog='.$kode_program) ?>"><?= $program;?></a>
                                            <a class="btn btn-primary btn-sm" href="#"><?= $kegiatan;?></a>
                                        </div>
                                        <div class="asset-inner">
                                            <table id="table-rinci" class="table table-bordered table-striped table-condensed" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;">Uraian</th>
                                                        <th style="text-align:center;">Target<br>Fisik</th>
                                                        <th style="text-align:center;">Target<br>Keuangan</th>
                                                        <th style="text-align:center;">Target<br>(%)</th>
                                                        <th style="text-align:center;">Relisasi<br>Fisik</th>
                                                        <th style="text-align:center;">Realisasi<br>Fisik (%)</th>
                                                        <th style="text-align:center;">Realisasi<br>Keuangan</th>
                                                        <th style="text-align:center;">Realisasi<br>Keuangan (%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data-rinci">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <span class="help-block small">Catatan : Klik Uraian Untuk Melihat Rincian</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Target Realisasi</h4>
      </div>
      <div class="modal-body" id="listDetail">  
      <form id="form-pemantauan" enctype="multipart/form-data" method="post">
      <!-- <form class="form-horizontal" id="form-tl" enctype="multipart/form-data" method="post"> -->
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-info alert-st-two alert-st-bg1" role="alert">
                            <i class="fa fa-building edu-inform admin-check-pro admin-check-pro-clr1" aria-hidden="true"></i>
                            <p class="message-mg-rt"><strong>Fisik</strong> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Target Fisik</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <input type="text" id="target_fisik" name="target_fisik" readonly class="form-control function_separator" required />
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <span class="help-block small label-satuan">-</span>
                    </div>
                    
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 1</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <input type="text" id="realfisik1" name="realfisik1" class="form-control maxRealFisik function_separator" required />
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <span class="help-block small label-satuan">-</span>
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 2</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <input type="text" id="realfisik2" name="realfisik2" class="form-control maxRealFisik function_separator" required />
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <span class="help-block small label-satuan">-</span>
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 3</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <input type="text" id="realfisik3" name="realfisik3" class="form-control maxRealFisik function_separator" required />
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <span class="help-block small label-satuan">-</span>
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 4</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <input type="text" id="realfisik4" name="realfisik4" class="form-control maxRealFisik function_separator" required />
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <span class="help-block small label-satuan">-</span>
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Total Realisasi</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <input type="text" id="totrealfisik" name="totrealfisik" readonly class="form-control function_separator" required />
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <span class="help-block small label-satuan">-</span>
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Persentase Realisasi</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="totrealpersenfisik" name="totrealpersenfisik" class="form-control function_separator" readonly required />
                    </div>
                </div>
            </div>
            
            
            
            <!-- <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <label class="login2 pull-right pull-right-pro">Logo Daerah</label>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="file-upload-inner ts-forms">
                            <div class="input prepend-small-btn">
                                <div class="file-button">
                                    Browse
                                    <input type="file" id="logo_file" name="logo_file" onchange="document.getElementById('logo_daerah').value = this.value;">
                                </div>
                                <input type="text" id="logo_daerah" name="logo_daerah" readonly placeholder="Tidak ada File dipilih" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-info alert-st-two alert-st-bg1" role="alert">
                            <i class="fa fa-money edu-inform admin-check-pro admin-check-pro-clr1" aria-hidden="true"></i>
                            <p class="message-mg-rt"><strong>Keuangan</strong> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Target Keuangan</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="target_keuangan" name="target_keuangan" readonly class="form-control function_separator" required />
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 1</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="realkeu1" name="realkeu1" class="form-control maxRealKeu function_separator" required />
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 2</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="realkeu2" name="realkeu2" class="form-control maxRealKeu function_separator" required />
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 3</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="realkeu3" name="realkeu3" class="form-control maxRealKeu function_separator" required />
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Realisasi Triwulan 4</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="realkeu4" name="realkeu4" class="form-control maxRealKeu function_separator" required />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Total Realisasi</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="totrealkeu" name="totrealkeu" class="form-control function_separator" readonly required />
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="login2">Persentase Realisasi</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="text" id="totrealpersenkeu" name="totrealpersenkeu" class="form-control function_separator" readonly required />
                    </div>
                </div>
            </div>
        </div>  
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Bentuk Pelaksanaan</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="inline-checkbox-cs">
                            <label class="checkbox-inline i-checks pull-left">
                                <input type="radio" class="change_bentuk" value="NK" id="bentuk_NK" name="bentuk"> <i></i>Non Kontraktual </label>
                            <label class="checkbox-inline i-checks pull-left">
                                <input type="radio" class="change_bentuk" value="K" id="bentuk_K" name="bentuk"> <i></i> Kontraktual </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group-inner hidden">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="text" id="tahun_anggaran" name="tahun_anggaran" class="form-control" />
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="text" id="kd_kegiatan" name="kd_kegiatan" class="form-control" />
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="text" id="kode_rek" name="kode_rek" class="form-control" />
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="text" id="kode_po" name="kode_po" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="login2">Detail Kontrak</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="list-data" class="table">
                            <thead>
                            <tr class="active">
                                <th style="width:5%;text-align: center;"><b>NO</b></th>
                                <th style="width:5%;text-align: center;"><b>File RAB</b></th>
                                <th style="width:10%;text-align: center;"><b>Nama File RAB</b></th>
                                <th style="width:5%;text-align: center;"><b>File Kontrak</b></th>
                                <th style="width:10%;text-align: center;"><b>Nama File Kontrak</b></th>
                                <th style="width:25%;text-align: center;"><b>Nilai Kontrak</b></th>
                                <th style="width:15%;text-align: center;"><b>Kontraktor</b></th>
                                <th style="width:15%;text-align: center;"><b>No&Tgl Kontrak</b></th>
                                <th style="width:5%;text-align: center;"><b>Aksi</b></th>
                            </tr>
                            </thead>
                            <tbody id="isi_kontrak">
                                

                            </tbody>

                            <tfoot>
                                
                                <tr>
                                    <td style="width:5%;text-align: center;vertical-align:middle;" rowspan="2">
                                      #
                                    </td>  
                                    
                                    <td style="width:5%;text-align: center;">
                                      <div class="inputWrapper" data-toggle="tooltip" title="Cari File">
                                        <input type="file" class="fileInput fileInputTemuan" onchange="validateFormat(this)" name="nm_lampiran2[]" id="nm_lampiran2"/>
                                      </div>
                                    </td>  
                                    <td>
                                      <input type="text" name="dokumentasi" id="dokumentasi" class="form-control input-sm" readonly placeholder="Pilih File (Akan Terisi Otomatis)">
                                    </td>
                                    <td rowspan="2" style="vertical-align:middle;">
                                      <!-- <button type="button" class="btn btn-success btn-md" id="upload_setor"><i class="fa fa-plus"></i></button> -->
                                      <center>
                                        <div class="inputWrapperAdd" data-toggle="tooltip" title="Tambah"  >
                                        <input type="submit"  value="UPLOAD" id="upload_setor" class="fileInput" aksi = "justFile">
                                      </div>
                                      </center>
                                    </td>  
                                </tr>
                            </tfoot>
                        </table>
                        <div class="alert alert-warning alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                            <p> File yang diperbolehkan diantaranya Format Gambar dan Pdf dengan Maksimal Size 1 MB</p>
                        </div>
                        <!-- <div class="file-upload-inner ts-forms">
                            <div class="input prepend-small-btn">
                                <div class="file-button">
                                    Browse
                                    <input type="file" id="logo_file" name="logo_file" onchange="document.getElementById('logo_daerah').value = this.value;">
                                </div>
                                <input type="text" id="logo_daerah" name="logo_daerah" readonly placeholder="Tidak ada File dipilih" required>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
             <div class="form-group-inner" id="dokumen-kontraktual" hidden>
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <label class="login2">Dokumen RAB</label>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="file-upload-inner file-upload-inner-right ts-forms">
                            <div class="input append-small-btn">
                                <div class="file-button">
                                    Browse
                                    <input type="file" id="fileRAB" name="fileRAB" onchange="document.getElementById('rab').value = this.value;">

                                </div>
                                <input type="text" id="rab" name="rab" placeholder="RAB" readonly="">
                                <div id="previewRAB">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <label class="login2">Dokumen Sampul Kontrak</label>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="file-upload-inner file-upload-inner-right ts-forms">
                            <div class="input append-small-btn">
                                <div class="file-button">
                                    Browse
                                    <input type="file" id="fileSampul" name="fileSampul" onchange="document.getElementById('sampul').value = this.value;">
                                </div>
                                <input type="text" id="sampul" name="sampul" placeholder="SAMPUL KONTRAK" readonly="">
                                <div id="previewKontrak">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Nilai Kontrak</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <input type="text" id="nilai_kontrak" name="nilai_kontrak" class="form-control function_separator" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Kontraktor</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="text" id="kontraktor" name="kontraktor" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Nomor & Tanggal Kontrak</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="text" id="no_kontrak" name="no_kontrak" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Distrik</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="text" id="distrik" name="distrik" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Kampung</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="text" id="kampung" name="kampung" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Koordinat</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="text" id="koordinat" name="koordinat" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="login2">Keterangan</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                        <textarea name="keterangan" id="keterangan" placeholder="Keterangan (Informasi Tambahan/Permasalahan)"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group-inner">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="login2">Foto Dokumentasi</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="list-data" class="table">
                            <thead>
                            <tr class="active">
                                <th style="width:5%;text-align: center;"><b>NO</b></th>
                                <th style="width:5%;text-align: center;"><b>Cari File</b></th>
                                <th style="width:75%;text-align: center;"><b>Nama File</b></th>
                                <th style="width:5%;text-align: center;"><b>Aksi</b></th>
                            </tr>
                            </thead>
                            <tbody id="isi_lampiran2">
                                

                            </tbody>

                            <tfoot>
                                
                                <tr>
                                    <td style="width:5%;text-align: center;vertical-align:middle;" rowspan="2">
                                      #
                                    </td>  
                                    
                                    <td style="width:5%;text-align: center;">
                                      <div class="inputWrapper" data-toggle="tooltip" title="Cari File">
                                        <input type="file" class="fileInput fileInputTemuan" onchange="validateFormat(this)" name="nm_lampiran2[]" id="nm_lampiran2"/>
                                      </div>
                                    </td>  
                                    <td>
                                      <input type="text" name="dokumentasi" id="dokumentasi" class="form-control input-sm" readonly placeholder="Pilih File (Akan Terisi Otomatis)">
                                    </td>
                                    <td rowspan="2" style="vertical-align:middle;">
                                      <!-- <button type="button" class="btn btn-success btn-md" id="upload_setor"><i class="fa fa-plus"></i></button> -->
                                      <center>
                                        <div class="inputWrapperAdd" data-toggle="tooltip" title="Tambah"  >
                                        <input type="submit"  value="UPLOAD" id="upload_setor" class="fileInput" aksi = "justFile">
                                      </div>
                                      </center>
                                    </td>  
                                </tr>
                            </tfoot>
                        </table>
                        <div class="alert alert-warning alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                            <p> File yang diperbolehkan diantaranya Format Gambar dan Pdf dengan Maksimal Size 1 MB</p>
                        </div>
                        <!-- <div class="file-upload-inner ts-forms">
                            <div class="input prepend-small-btn">
                                <div class="file-button">
                                    Browse
                                    <input type="file" id="logo_file" name="logo_file" onchange="document.getElementById('logo_daerah').value = this.value;">
                                </div>
                                <input type="text" id="logo_daerah" name="logo_daerah" readonly placeholder="Tidak ada File dipilih" required>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
      </div>
                                       
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-flat btn-lg btn-primary">Simpan Perubahan</button> -->
        <input type="submit" name="submit" value="Simpan Perubahan" id="simpan" class="btn btn-primary btn-lg"  aksi = "all">
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
<script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>



<script type="text/javascript">
     $(window).on('load', function () {
         
        $("#data-rinci").html("<tr><td colspan='8' style='text-align:center;'>Harap Tunggu...</td></tr>");
        var skpd = '<?= $kode_dinas;?>';
        var prog = '<?= $kode_program;?>';
        var keg = '<?= $kode_kegiatan;?>';
        $.ajax({
              url: "<?php echo site_url('get-pantau-rekening-kegiatan?skpd=')?>"+skpd+"&prog="+prog+"&keg="+keg,
              type: 'POST',
              success: function(data){
                $("#data-rinci").html(data);
                $('#table-rinci').DataTable({"ordering":false});
              }
          });
          
    });

    function refresh(){
        $("#data-rinci").html("<tr><td colspan='8' style='text-align:center;'>Harap Tunggu...</td></tr>");
        var skpd = '<?= $kode_dinas;?>';
        var prog = '<?= $kode_program;?>';
        var keg = '<?= $kode_kegiatan;?>';
        $.ajax({
              url: "<?php echo site_url('get-pantau-rekening-kegiatan?skpd=')?>"+skpd+"&prog="+prog+"&keg="+keg,
              type: 'POST',
              success: function(data){
                $("#data-rinci").html(data);
                $("#table-rinci").DataTable().fnDestroy();
                $('#table-rinci').DataTable({"ordering":false});
              }
          });
    }

    $('#form-pemantauan').submit(function(e) {
        
        var bukti = $('#dokumentasi').val();

        var ev = $(document.activeElement).attr('aksi');
        
        if (ev == 'justFile') {
            if (bukti == '' ) {
              if (bukti == '') {
                Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH FILE TERLEBIH DAHULU',showConfirmButton: false,timer: 2000});
                $('.fileInputTemuan').focus();
                e.preventDefault();

                exit();
              }

            }else{
              $.ajax({
                method: 'POST',
                url: '<?php echo base_url('input-data-pemantauan-file'); ?>',
                data: new FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              })
              .done(function(data) {
                var out = jQuery.parseJSON(data);
                $("#isi_lampiran2").html(out.tableLampiran);
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: out.pesan,
                  showConfirmButton: false,
                  timer: 2000
                });
                var inputFile = $("#dokumentasi");
                inputFile.replaceWith(inputFile.val('').clone(true));
                
              })
              e.preventDefault();
                

            }
        }else{
           var ele = document.getElementsByName('bentuk'); 
              
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked){
                    var dataCheck = ele[i].value;
                }  
            } 
            
            if(dataCheck == 'K'){
                var fileRAB = $("#rab").val();
                var fileSampul = $("#sampul").val();
                var no_kontrak = $("#no_kontrak").val();
                var nilai_kontrak = $("#nilai_kontrak").val();
                var kontraktor = $("#kontraktor").val();
                if(fileRAB == ''){
                    Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH FILE RAB',showConfirmButton: false,timer: 2000});
                    e.preventDefault();
                    exit();
                }
                if(fileSampul == ''){
                    Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH FILE SAMPUL',showConfirmButton: false,timer: 2000});
                    e.preventDefault();
                    exit();
                }

                if(nilai_kontrak == ''){
                    Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI NILAI KONTRAK',showConfirmButton: false,timer: 2000});
                    e.preventDefault();
                    exit();
                }
                if(kontraktor == ''){
                    Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI KONTRAKTOR',showConfirmButton: false,timer: 2000});
                    e.preventDefault();
                    exit();
                }
                if(no_kontrak == ''){
                    Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP ISI NO KONTRAK',showConfirmButton: false,timer: 2000});
                    e.preventDefault();
                    exit();
                }


            }else if(dataCheck == 'NK'){

            }else{
                Swal.fire({position: 'top-end',icon: 'warning',title: 'HARAP PILIH BENTUK PELAKSANAAN',showConfirmButton: false,timer: 2000});
                e.preventDefault();
                exit();
            }
            
           $.ajax({
                method: 'POST',
                url: '<?php echo base_url('input-data-pemantauan'); ?>',
                data: new FormData(this),
                contentType:false,
                cache : false,
                processData:false,
              })
              .done(function(data) {
                var out = jQuery.parseJSON(data);
                $('#myModal').modal('hide');
                refresh();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: out.pesan,
                  showConfirmButton: false,
                  timer: 2000
                });
                var inputFile = $("#dokumentasi");
                var inputFile2 = $("#fileRAB");
                var inputFile3 = $("#fileSampul");
                inputFile.replaceWith(inputFile.val('').clone(true));
                inputFile2.replaceWith(inputFile2.val('').clone(true));
                inputFile3.replaceWith(inputFile3.val('').clone(true));
                
              })
            e.preventDefault();

        }
        
        
      });


      $(document).on("click", ".hapus-lampiran", function() {
          
          var thn       = $(this).attr("data-thn");
          var keg       = $(this).attr("data-keg");
          var rek       = $(this).attr("data-rek");
          var po        = $(this).attr("data-po");
          var kd_lamp        = $(this).attr("data-lamp");

           Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus data ini ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#074979',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Ya, Hapus Data.'
            }).then((result) => {
              if (result.value) {

                   $.ajax({
                  method: 'POST',
                  url: '<?php echo base_url('del-data-pemantauan-file'); ?>?thn='+thn+'&keg='+keg+'&rek='+rek+'&po='+po+'&lamp='+kd_lamp,
                })
                .done(function(data) {
                  
                    var out = jQuery.parseJSON(data);
                     $("#isi_lampiran2").html(out.tableLampiran);
                   
                })

              }
            })
    });

    function validateFormat(fileInput){
    // var selectedFile = objFileControl.value;
    // console.log(objFileControl.files[0].type); 
                
                var filePath = fileInput.value; 
                const fileSize = fileInput.files[0].size;
                const size = Math.round((fileSize / 1024)); 

                
                // Allowing file type 

                var allowedExtensions =  
                        /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i; 
                
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


    // $(".maxRealFisik").change(function(){
    //     var fisik1 = $('#realfisik1').val();
    //     var fisik2 = $('#realfisik2').val();
    //     var fisik3 = $('#realfisik3').val();
    //     var fisik4 = $('#realfisik4').val();

    //     var realfisik1dot = fisik1.replace('.','');
    //     var realfisik1 = realfisik1dot.replace(/,/g,'.');

    //     var realfisik2dot = fisik2.replace('.','');
    //     var realfisik2 = realfisik2dot.replace(/,/g,'.');

    //     var realfisik3dot = fisik3.replace('.','');
    //     var realfisik3 = realfisik3dot.replace(/,/g,'.');

    //     var realfisik4dot = fisik4.replace('.','');
    //     var realfisik4 = realfisik4dot.replace(/,/g,'.');


    //     var arrFisik = [parseFloat(realfisik1),parseFloat(realfisik2),parseFloat(realfisik3),parseFloat(realfisik4)];
    //     var maximal = parseFloat(Math.max.apply(Math, arrFisik));
    //     var maximaldot =  maximal.toFixed(2).replace(/\./g, ',');
    //     var n = maximaldot.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    //     $('#totrealfisik').val(n);
        
    // });

    // $(".maxRealKeu").change(function(){
    //     var keu1 = $('#realkeu1').val();
    //     var keu2 = $('#realkeu2').val();
    //     var keu3 = $('#realkeu3').val();
    //     var keu4 = $('#realkeu4').val();

    //     var realkeu1dot = keu1.replace('.','');
    //     var realkeu1 = realkeu1dot.replace(/,/g,'.');

    //     var realkeu2dot = keu2.replace('.','');
    //     var realkeu2 = realkeu2dot.replace(/,/g,'.');

    //     var realkeu3dot = keu3.replace('.','');
    //     var realkeu3 = realkeu3dot.replace(/,/g,'.');

    //     var realkeu4dot = keu4.replace('.','');
    //     var realkeu4 = realkeu4dot.replace(/,/g,'.');


    //     var arrkeu = [parseFloat(realkeu1),parseFloat(realkeu2),parseFloat(realkeu3),parseFloat(realkeu4)];
    //     var maximalkeu = parseFloat(Math.max.apply(Math, arrkeu));
    //     var maximaldotkeu =  maximalkeu.toFixed(2).replace(/\./g, ',');
    //     var k = maximaldotkeu.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    //     $('#totrealkeu').val(k);
        
        
    // });


    $(".fileInputTemuan").change(function(){

        var namaFile = $('#nm_lampiran2').val();
        var namaLamp = namaFile.replace("C:\\fakepath\\", "");
        $('#dokumentasi').val(namaLamp);
    });

    $(document).ready(function(){
        $( '.function_separator' ).mask('00.000.000.000,00', {reverse: true});
    });

    $(".change_bentuk").change(function(){
        
        var bntk = $(this).val();
        if(bntk == 'NK'){
            $('#nilai_kontrak').attr('readonly',true);
            $('#kontraktor').attr('readonly',true);
            $('#no_kontrak').attr('readonly',true);
            $('#dokumen-kontraktual').attr('hidden',true);
        }else if(bntk == 'K'){
            $('#nilai_kontrak').removeAttr('readonly');
            $('#kontraktor').removeAttr('readonly');
            $('#no_kontrak').removeAttr('readonly');
            $('#dokumen-kontraktual').removeAttr('hidden');
        }
    });

    $(document).on("click", ".showModal", function() {
        var thn 		= $(this).attr("data-tahun");
        var keg 		= $(this).attr("data-keg");
        var rek 		= $(this).attr("data-rek");
        var po 	    	= $(this).attr("data-po");
        var skpd          = $(this).attr("data-skpd");
        $('#myModal').modal('show');
        
		
        $.ajax({
	      method: 'POST',
	      url: '<?php echo base_url('get-rinci-kegiatan'); ?>?thn='+thn+'&skpd='+skpd+'&keg='+keg+'&rek='+rek+'&po='+po,
	    })
	    .done(function(data) {
            var out = jQuery.parseJSON(data);

            $('.label-satuan').html(out.satuan1);
            $('#myModalLabel').html(out.uraian);

            $('#tahun_anggaran').val(thn);
            $('#kd_kegiatan').val(keg);
            $('#kode_rek').val(rek);
            $('#kode_po').val(po);

            $('#realfisik1').val(out.fisik1);
            $('#realfisik2').val(out.fisik2);
            $('#realfisik3').val(out.fisik3);
            $('#realfisik4').val(out.fisik4);

            $('#realkeu1').val(out.keuangan1);
            $('#realkeu2').val(out.keuangan2);
            $('#realkeu3').val(out.keuangan3);
            $('#realkeu4').val(out.keuangan4);

            $('#target_fisik').val(out.tvolume);
            $('#target_keuangan').val(out.total);

            $('#totrealfisik').val(out.tot_real_fisik);
            $('#totrealkeu').val(out.tot_real_keuangan);

            $('#totrealpersenfisik').val(out.tot_persen_fisik);
            $('#totrealpersenkeu').val(out.tot_persen_keuangan);

            $('#nilai_kontrak').val(out.nilai_kontrak);
            $('#kontraktor').val(out.kontraktor);
            $('#no_kontrak').val(out.no_kontrak);
            $('#distrik').val(out.distrik);
            $('#kampung').val(out.kampung);
            $('#koordinat').val(out.koordinat);
            $('#keterangan').val(out.keterangan);
            
            if(out.bentuk == 'NK'){
                $('#bentuk_'+out.bentuk).prop('checked',true);
                $('#nilai_kontrak').attr('readonly',true);
                $('#kontraktor').attr('readonly',true);
                $('#no_kontrak').attr('readonly',true);
                $('#dokumen-kontraktual').attr('hidden',true);
            }else if(out.bentuk == 'K'){
                $('#bentuk_'+out.bentuk).prop('checked',true);
                $('#nilai_kontrak').removeAttr('readonly');
                $('#kontraktor').removeAttr('readonly');
                $('#no_kontrak').removeAttr('readonly');
                $('#dokumen-kontraktual').removeAttr('hidden');
                $('#rab').val(out.file_rab);
                $('#previewRAB').html(out.preview_rab);
                $('#sampul').val(out.file_sampul);
                $('#previewKontrak').html(out.preview_kontrak);
            }else{
                $('#bentuk_NK').prop('checked',false);
                $('#bentuk_K').prop('checked',false);
                $('#nilai_kontrak').attr('readonly',true);
                $('#kontraktor').attr('readonly',true);
                $('#no_kontrak').attr('readonly',true);
                $('#dokumen-kontraktual').attr('hidden',true);
            }


            if(out.tw1 == 'T'){
                $('#realkeu1').attr('readonly',true);
                $('#realfisik1').attr('readonly',true);
            }else{
                $('#realkeu1').removeAttr('readonly');
                $('#realfisik1').removeAttr('readonly');
            }

            if(out.tw2 == 'T'){
                $('#realkeu2').attr('readonly',true);
                $('#realfisik2').attr('readonly',true);
            }else{
                $('#realkeu2').removeAttr('readonly');
                $('#realfisik2').removeAttr('readonly');
            }
            
            if(out.tw3 == 'T'){
                $('#realkeu3').attr('readonly',true);
                $('#realfisik3').attr('readonly',true);
            }else{
                $('#realkeu3').removeAttr('readonly');
                $('#realfisik3').removeAttr('readonly');
            }

            if(out.tw4 == 'T'){
                $('#realkeu4').attr('readonly',true);
                $('#realfisik4').attr('readonly',true);
            }else{
                $('#realkeu4').removeAttr('readonly');
                $('#realfisik4').removeAttr('readonly');
            }
            
            
            $("#isi_lampiran2").html(out.tableLampiran);
            
	      	
	    })
	});
</script>