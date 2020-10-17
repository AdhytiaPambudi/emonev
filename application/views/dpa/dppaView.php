<div class="mailbox-compose-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="hpanel shadow-inner responsive-mg-b-30">
                            <div class="panel-body"  style = "min-height:550px;">
                                <a href="#" class="btn btn-success compose-btn btn-block m-b-md">List Laporan</a>
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
                                        <a href="#" class="listDPPA" data-id="dppaSkpd22">
											<i class="fa fa-file"></i> DPPA SKPD 22
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listDPPA" data-id="dppaSkpd221">
											<i class="fa fa-file"></i> DPPA SKPD 221
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

                                    <!-- <li>
                                        <a href="#" class="listDPA" data-id="dpaSkpd0">
											<i class="fa fa-file"></i> DPA PPKD 0
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listDPA" data-id="dpaPpkd1">
											<i class="fa fa-file"></i> DPA PPKD 1
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listDPA" data-id="dpaPpkd21">
											<i class="fa fa-file"></i> DPA PPKD 21
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listDPA" data-id="dpaPpkd31">
											<i class="fa fa-file"></i> DPA PPKD 31
										</a>
                                    </li>
                                    <li>
                                        <a href="#" class="listDPA" data-id="dpaPpkd32">
											<i class="fa fa-file"></i> DPA PPKD 32
										</a>
                                    </li> -->
                                    
                                </ul>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="hpanel email-compose" style = "min-height:550px;">
                            <div class="panel-heading hbuilt">
                                <div class="p-xs h4" id="namaLaporan" style="text-align:center;">
                                    DPPA SKPD 22
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
                                            <input id="jnsLaporan" type="text" class="form-control input-sm hidden" value = "dppaSkpd22">
                                            </div>
                                        </div>
                                        <div class="form-group hidden" id="combo-kegiatan">
                                            <label class="col-lg-2 control-label text-left">Kegiatan</label>
                                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                                <select name="kd_kegiatan" style="width:100%;" id="kd_kegiatan" class="form-control">

                                                </select>
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

    $(document).on("click", ".listDPPA", function() {
        
        var id = $(this).attr('data-id');
        if(id == 'dppaSkpd22'){
            $('#combo-kegiatan').attr('class','hidden');
            $('#namaLaporan').html('DPPA SKPD 22');
            $('#jnsLaporan').val(id);
        }else if(id == 'dppaSkpd221'){
            $('#namaLaporan').html('DPPA SKPD 221');
            $('#combo-kegiatan').removeAttr('class');
            $('#combo-kegiatan').attr('class','form-group');
            $('#jnsLaporan').val(id);
        }
    });    

    $(document).on("click", ".cetakLaporan", function() {
        var output = $(this).attr('data-output');
        var id = $('#jnsLaporan').val();
        var skpd = $('#kd_skpd').val();
        var kegiatan = $('#kd_kegiatan').val();
        // setting
        var ori = $('#orientation').val();
        var mar = $('#margins').val();
        
        if(id == 'dppaSkpd22'){
            if(skpd == ''){
                alert('HARAP ISI SKPD');
                exit();
            }

        }else if(id == 'dppaSkpd221'){
            if(skpd == ''){
                alert('HARAP ISI SKPD');
                exit();
            }
            if(kegiatan == ''){
                alert('HARAP ISI KEGIATAN');
                exit();
            }
        }
        
        if (id == 'dppaSkpd22') {
            if(output == 'pdf'){
                window.open('<?php echo base_url('dppa22-pdf'); ?>/'+skpd+'?orientation='+ori+'&margins='+mar, '_blank');	
            }else{
                window.open('<?php echo base_url('dppa22-excel'); ?>/'+skpd, '_blank');	
            }
        }else if (id == 'dppaSkpd221') {
            if(output == 'pdf'){
                window.open('<?php echo base_url('dppa221-pdf'); ?>/'+skpd+'/'+kegiatan+'?orientation='+ori+'&margins='+mar, '_blank');	
            }else{
                window.open('<?php echo base_url('dppa221-excel'); ?>/'+skpd+'/'+kegiatan, '_blank');	
            }
        }else{
            
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
          placeholder: 'Pilih Kegiatan',
          theme: "classic"
		});
	
</script>