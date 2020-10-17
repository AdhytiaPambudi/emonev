<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/form/all-type-forms.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">
<div class="basic-form-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h4 style="text-align:center;" id="judul-form">Tambah Data</h4>
                                    <hr style="border-top:1px solid red;">
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                <form action="<?php echo base_url('insert-data-umum'); ?>" id="form-data-umum" enctype="multipart/form-data" method="post">
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Tahun Anggaran</label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <input type="text" id="ta" name="tahun_anggaran" readonly class="form-control" required value="<?= $dataumum['tahun_anggaran'] ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Nama Daerah</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" class="form-control" id="nama_daerah" name="nama_daerah" required value="<?= $dataumum['nama_daerah'] ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Ibukota</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" class="form-control" id="ibukota" name="ibukota" value="<?= $dataumum['ibukota'] ?>" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Nama Kepala Daerah</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" id="kepala_daerah" name="kepala_daerah" class="form-control" value="<?= $dataumum['kepala_daerah'] ?>" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Tanggal DPA</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="date" class="form-control" id="tgl_dpa" name="tgl_dpa" value="<?= $dataumum['tgl_dpa'] ?>" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Tanggal DPPA</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="date" class="form-control" id="tgl_dppa" name="tgl_dppa" value="<?= $dataumum['tgl_dppa'] ?>" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group-inner">
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
                                                    </div>
                                                    
                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3"></div>
                                                                <div class="col-lg-9">
                                                                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                        <input type="submit" name="submit" value="Simpan" id="simpan" class="btn btn-success btn-sm" aksi = 'all'>
                                                                        <a href="<?=base_url('data-umum-daerah');?>" class="btn btn-sm  btn-danger " type="button">Batal</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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


<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>        
<script type="text/javascript">
    $(document).ready(function() {	
        $(function() {
            $("#ta").datepicker({
              minViewMode: 2,
                format: 'yyyy',
              onSelect: function(dateText) {
                display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
                $(this).change();
              }
            }).on("change", function() {
              
            });
        });
    });



</script>