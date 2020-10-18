<div class="mailbox-compose-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="hpanel shadow-inner responsive-mg-b-30">
                            <div class="panel-body"  style = "min-height:550px;">
                                <a href="#" class="btn btn-success compose-btn btn-block m-b-md">Pilih Triwulan</a>
                                <hr>
                                <ul class="mailbox-list">
                                    <!-- <li>
                                        <a href="#" class="listDPA" data-id="dpaSkpd0">
											<i class="fa fa-file"></i> DPA SKPD 0
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listDPA" data-id="dpaSkpd1">
											<i class="fa fa-file"></i> DPA SKPD 1
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listDPA" data-id="dpaSkpd21">
											<i class="fa fa-file"></i> DPA SKPD 21
										</a>
                                    </li> -->
                                    <li>
                                        <a href="#" class="listTriwulan" data-id="1">
											<i class="fa fa-file"></i> TRIWULAN 1
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listTriwulan" data-id="2">
											<i class="fa fa-file"></i> TRIWULAN 2
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listTriwulan" data-id="3">
											<i class="fa fa-file"></i> TRIWULAN 3
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listTriwulan" data-id="4">
											<i class="fa fa-file"></i> TRIWULAN 4
										</a>
                                    </li>
                                    
                                    
                                    
                                </ul>
                                <hr>
                                <a href="#" class="btn btn-success compose-btn btn-block m-b-md">Setting Layout</a>
                                <hr>

                                <ul class="mailbox-list">

                                    <li>

                                        <select name="orientation" style="width:100%;" id="orientation" class="form-control">
                                            <option value="L">Landscape</option>
                                            <option value="P">Potrait</option>
                                        </select>
                                        <span class="help-block small pull-right">Orientasi</span>
                                    </li>
                                    <hr>
                                    <li>
                                        <select name="margins" style="width:100%;" id="margins" class="form-control">
                                            <option value="Custom" selected>Custom</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Narrow" >Narrow</option>
                                            <option value="Moderate">Moderate</option>
                                        </select>
                                        <span class="help-block small pull-right">Margins</span>
                                    </li>
                                   <hr>
                                    <li>
                                        <select name="spacing" style="width:100%;" id="spacing" class="form-control">
                                            <option value="0" selected>0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <span class="help-block small pull-right">Baris Tambahan</span>
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
                                    REALISASI CAPAIAN KINERJA PER KEGIATAN
                                </div>
                                <div class="p-xs h4" id="namaLaporan" style="text-align:center;">
                                    TRIWULAN 1
                                </div>
                            </div>
                            <div class="panel-heading hbuilt">
                                <div class="p-xs">
                                    <form method="get" class="form-horizontal">
                                        <div class="form-group" id="combo-skpd">
                                            <label class="col-lg-2 control-label text-left">OPD</label>
                                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                            <select name="kd_skpd" width="100%" id="kd_skpd" class="form-control">

                                            </select>
                                            <input id="jnsLaporan" type="text" class="form-control input-sm hidden" value = "1">
                                            </div>
                                        </div>
                                        <div class="form-group" id="combo-kegiatan">
                                            <label class="col-lg-2 control-label text-left">Kegiatan</label>
                                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                                <select name="kd_kegiatan" style="width:100%;" id="kd_kegiatan" class="form-control">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="combo-skpd">
                                            <label class="col-lg-2 control-label text-left">Tanggal Cetak</label>
                                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                            <input id="tgl_cetak" name="tgl_cetak" type="date" class="form-control input-sm" value = "<?= date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <center>
                                <button data-output="pdf" class="btn btn-danger cetakLaporan">Cetak Pdf</button>
                                <button data-output="excel" class="btn btn-success cetakLaporan">Cetak Excel</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">

    $(window).on('load', function () {
        
        $.ajax({
            url: '<?php echo base_url('dpa-get-combo-skpd'); ?>',
            type: 'POST',
            success: function(data){
                // var res = jQuery.parseJSON(data);
                $("#kd_skpd").html(data);
            }
        });
    });

    $(document).on("click", ".listTriwulan", function() {
        var id = $(this).attr('data-id');
        $('#jnsLaporan').val(id);
        $('#namaLaporan').html('TRIWULAN '+id);
    });    

    $(document).on("click", ".cetakLaporan", function() {
        var output = $(this).attr('data-output');
        var id = $('#jnsLaporan').val();
        var skpd = $('#kd_skpd').val();
        var tgl = $('#tgl_cetak').val();
        var keg = $('#kd_kegiatan').val();
        // setting
        var ori = $('#orientation').val();
        var mar = $('#margins').val();
        var space = $('#spacing').val();
        
        
        if(skpd == ''){
            alert('HARAP ISI SKPD');
            exit();
        }

        // if(keg == ''){
        //     alert('HARAP ISI KEGIATAN');
        //     exit();
        // }
        if(output == 'pdf'){
            window.open('<?php echo base_url('realisasi-detail-kegiatan-pdf/'); ?>'+skpd+'/'+keg+'/'+id+'?tgl='+tgl+'&orientation='+ori+'&margins='+mar+'&spacing='+space, '_blank');	
        }else{
            window.open('<?php echo base_url('realisasi-detail-kegiatan-excel/'); ?>'+skpd+'/'+keg+'/'+id+'?tgl='+tgl, '_blank');	
        }

        
    });    

    $("#kd_skpd").change(function(){
        var skpd = $('#kd_skpd').val();
        $.ajax({
            url: '<?php echo base_url('dpa-get-combo-kegiatan'); ?>',
            data:{skpd:skpd},
            type: 'POST',
            success: function(data){
                $('#kd_kegiatan').html(data);
            }
        })
    });
    
   
</script>
<script type="text/javascript">
	$('#kd_skpd').select2({
          placeholder: 'Pilih OPD',
          theme: "classic"
    });
    
    $('#kd_kegiatan').select2({
        placeholder: 'Semua Kegiatan',
        theme: "classic"
    });
	
</script>