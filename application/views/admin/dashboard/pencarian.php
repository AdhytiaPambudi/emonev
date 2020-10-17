<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/c3/c3.min.css"> -->

<style type="text/css">
	.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 500px;
    margin: 1em auto;
}

#container-real-keu {
    height: 275px;
}
#container-real-fisik {
    height: 275px;
}
#container-nilai-temuan {
    height: 275px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/alerts.css">
 <!-- Small chart Start-->
 <div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline10-list mt-b-30">
                <div class="sparkline10-hd">
                    <div class="main-sparkline10-hd">
                        <h1>Filter Berdasarkan: </h1>
                    </div>
                </div>
                <div class="sparkline10-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="basic-login-inner inline-basic-form">
                                    <form action="#">
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <select id="filter" class="form-control input-sm combofilter" style="height:40px;">
                                                        <option value="kegiatan">Nama Kegiatan</option>
                                                        <option value="uraian">Uraian Pekerjaan</option>
                                                        <option value="perusahaan">Nama Perusahaan</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                    <input type="text" id="keyword" class="form-control basic-ele-mg-b-10 responsive-mg-b-10" placeholder="Masukkan Kata Kunci ..." />
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                                    <div class="login-btn-inner">
                                                        <div class="row">
                                                            <div class="login-horizental lg-hz-mg"><button class="btn btn-lg btn-primary login-submit-cs" id="searchKegiatan" type="button">Cari</button></div>
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
        
 <div class="sparkline-area mg-b-15">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="about-sparkline responsive-mg-b-30">
					<div class="sparkline-hd">
                        <div class="main-sparkline10-hd">
                            <h1>Hasil Pencarian: </h1>
                        </div>
						<div class="main-spark-hd" style="text-align:center;min-height:400px;" id="hasilPencarian">
                        
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
	</div>
</div>
<!-- Small chart end-->



<!-- DataTables -->
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script>
	
	<script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/highcharts/code/highcharts.js"></script>  



<script type="text/javascript">
	$(window).on('load', function () {
		
		$.ajax({
            url: '<?php echo base_url('dpa-get-combo-skpd'); ?>',
            type: 'POST',
            success: function(data){
                // var res = jQuery.parseJSON(data);
                $(".comboskpd").html(data);
            }
        });


		$.ajax({
			url: '<?php echo base_url('top-real-dashboard'); ?>',
			type: 'POST',
			success: function(data){
			var out = jQuery.parseJSON(data);
				$("#topRealKeu").html(out.keu);
				$("#topRealFisik").html(out.fisik);
			}
		});

  		$(function () {
	  		$('[data-toggle="tooltip"]').tooltip();
		});

		

		

		// search
		$("#searchKegiatan").click(function(){
            
			var filter = document.getElementById('filter').value;
        	var key = document.getElementById('keyword').value;
        	
        	if (key == '') {
        		// alert('HARAP PILIH DAERAH!');
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI KATA KUNCI',
						  
						})
        	}else{
        		$("#hasilPencarian").html('<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;"><br>Harap Tunggu...</center>');
        		
				
			  	$.ajax({
					  url: '<?php echo base_url('search-kegiatan'); ?>',
					  type: 'POST',
					  data:{filter:filter,key:key},
					  success: function(data){
					  	var out = jQuery.parseJSON(data);

					  	// untuk nilai temuan
						var result = out.result;
						$("#hasilPencarian").html(result);


					  }
				  });
        	}

		  });
		  

		//   download manual book
		$(document).on("click", ".downloadManual", function() {
			
			window.open('<?php echo base_url('manual-book'); ?>','_blank');	
			
		});    


		  // search
		$(".searchRealFisik").change(function(){
			var akses = "<?php  echo $this->session->userdata('is_admin'); ?>";
			var skpd = document.getElementById('fisikSKPD').value;
			var keg = document.getElementById('fisikKeg').value;
        	
        	if (skpd == '') {
        		// alert('HARAP PILIH DAERAH!');
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN SKPD',
						  
						})
        	}else if (keg == '') {
        		// alert('HARAP PILIH DAERAH!');
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN KEGIATAN',
						  
						})
        	}else{
        		$("#container-real-fisik").html('<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;"><br>Harap Tunggu...</center>');
        		
				
			  	$.ajax({
					  url: '<?php echo base_url('get-chart-keu'); ?>',
					  type: 'POST',
					  data:{skpd:skpd},
					  success: function(data){
					  	var out = jQuery.parseJSON(data);

					  	// untuk nilai temuan
						var namaKeu = out.nama;
						var targetKeu = out.target;
						var realKeu = out.real;
						

					  	
					  	// disini highchart


						Highcharts.setOptions({
						    colors: ['deepskyblue', 'forestgreen', 'gold', 'red']
						});
						

					// nilai
					chart = new Highcharts.chart('container-real-fisik', {
					    chart: {
					        type: 'bar'
					    },
					    title: {
					        text: ''
					    },
					    xAxis: {
					        categories: namaKeu,
					        title: {
					            text: null
					        }
					    },
					    yAxis: {
					        min: 0,
					        title: {
					            text: 'Rupiah',
					            align: 'high'
					        },
					        labels: {
								overflow: 'justify',
								formatter: function() {
									return this.value / 1000000000 + 'M';
								}
					        }
					    },
					    tooltip: {
					        valueSuffix: ' '
					    },
					    plotOptions: {
					        bar: {
					            dataLabels: {
					                enabled: true
					            }
					        }
					    },
					    
					    credits: {
					        enabled: false
					    },
					    series: [{
					        name: 'TARGET',
					        data: targetKeu
					    }, {
					        name: 'REALISASI',
					        data: realKeu
					    }]
					});


					  }
				  });
        	}

		  });
		  $("#fisikSKPD").change(function(){
				var skpd = $('#fisikSKPD').val();
				$.ajax({
					url: '<?php echo base_url('dpa-get-combo-kegiatan'); ?>',
					data:{skpd:skpd},
					type: 'POST',
					success: function(data){
						$('#fisikKeg').html(data);
					}
				})
			});
	});
	

	function IDRFormatter(angka, prefix) {
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		if (ribuan) {
			var separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
    
</script>		
<script type="text/javascript">
	$('.comboskpd').select2({
          placeholder: 'Pilih OPD',
          theme: "classic"
    });
    
    $('.combokeg').select2({
        placeholder: 'Pilih Kegiatan',
        theme: "classic"
    });
	
</script>