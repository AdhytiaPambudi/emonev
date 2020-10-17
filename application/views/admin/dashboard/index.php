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
 <div class="sparkline-area mg-b-15">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="about-sparkline responsive-mg-b-30">
					<div class="sparkline-hd">
						<div class="main-spark-hd" style="text-align:center;">
							<p><strong>Download!</strong> File Manual Book Penggunaan Aplikasi Emonev.</p>
							<button class="btn btn-success downloadManual"><span class="fa fa-download"></span> Download Manual Book</button>
						</div>
					</div>
				</div>

					
						
					
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="about-sparkline responsive-mg-b-30">
					<div class="sparkline-hd">
						<div class="main-spark-hd">
							<h1>5 Peringkat Realisasi Anggaran Tertinggi</h1>
							
						</div>
					</div>
					<div class="sparkline-content" >
						<ul class="basic-list" id="topRealKeu" style="min-height:250px;">
								<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;">
								<br>Harap Tunggu...
								</center>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="about-sparkline responsive-mg-b-30">
					<div class="sparkline-hd">
						<div class="main-spark-hd">
							<h1>5 Peringkat Realisasi Anggaran Terendah</h1>
							
						</div>
					</div>
					<div class="sparkline-content" >
						<ul class="basic-list" id="botRealKeu" style="min-height:250px;">
								<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;">
								<br>Harap Tunggu...
								</center>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="about-sparkline responsive-mg-b-30">
					<div class="sparkline-hd">
						<div class="main-spark-hd">
							<h1>5 Peringkat Realisasi Fisik Tertinggi</h1>
							
						</div>
					</div>
					<div class="sparkline-content" >
						<ul class="basic-list" id="topRealFisik" style="min-height:250px;">
								<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;">
								<br>Harap Tunggu...
								</center>
							</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="about-sparkline responsive-mg-b-30">
					<div class="sparkline-hd">
						<div class="main-spark-hd">
							<h1>5 Peringkat Realisasi Fisik Terendah</h1>
							
						</div>
					</div>
					<div class="sparkline-content" >
						<ul class="basic-list" id="botRealFisik" style="min-height:250px;">
								<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;">
								<br>Harap Tunggu...
								</center>
							</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Small chart end-->
<!-- custom chart start-->
<div class="pie-bar-line-area mg-tb-30">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="sparkline7-list responsive-mg-b-30">
					<div class="sparkline7-hd">
						<div class="main-spark7-hd">
							<h1>Anggaran Realisasi Keuangan Per Triwulan</h1>
						</div>
						<div class="row">
								<div style="padding-bottom:10px;" class=" col-sm-12" id="combo-skpd">
									<select name="realFisikSkpd" id="keuSKPD" class="form-control input-sm comboskpd searchRealKeu" style="width:100%">
														
									</select>
								</div>
								
							</div><hr>
					</div>
					
								<figure class="highcharts-figure">
								<div id="container-real-keu">
									<center>
										PILIH SKPD TERLEBIH DAHULU
									</center>
								</div>
							</figure>
						
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="sparkline-list">
					<div class="smart-sparkline-hd">
						<div class="smart-main-spark-hd">
							<h1>Anggaran Realisasi Fisik Per Triwulan</h1>
							<div class="row">
								<div style="padding-bottom:10px;" class=" col-sm-12" >
									<select name="realFisikSkpd" id="fisikSKPD" class="form-control input-sm comboskpd searchRealFisik" style="width:100%">
														
									</select>
								</div>
								
							</div><hr>
							
							
						</div>

						
					</div>
					<figure class="highcharts-figure">
						<div id="container-real-fisik">
							<center>
								PILIH SKPD & KEGIATAN TERLEBIH DAHULU
							</center>
						</div>
					</figure>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- custom chart end-->



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
				$("#topRealKeu").html(out.top_keu);
				$("#botRealKeu").html(out.bot_keu);
				$("#topRealFisik").html(out.top_fisik);
				$("#botRealFisik").html(out.bot_fisik);
			}
		});

  		$(function () {
	  		$('[data-toggle="tooltip"]').tooltip();
		});

		

		

		// search
		$(".searchRealKeu").change(function(){
			var akses = "<?php  echo $this->session->userdata('is_admin'); ?>";
        	var skpd = document.getElementById('keuSKPD').value;
        	
        	if (skpd == '') {
        		// alert('HARAP PILIH DAERAH!');
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN SKPD',
						  
						})
        	}else{
        		$("#container-real-keu").html('<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;"><br>Harap Tunggu...</center>');
        		
				
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
					chart = new Highcharts.chart('container-real-keu', {
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
		  

		//   download manual book
		$(document).on("click", ".downloadManual", function() {
			
			window.open('<?php echo base_url('manual-book'); ?>','_blank');	
			
		});    


		  // search
		$(".searchRealFisik").change(function(){
			var akses = "<?php  echo $this->session->userdata('is_admin'); ?>";
			var skpd = document.getElementById('fisikSKPD').value;
			
        	
        	if (skpd == '') {
        		// alert('HARAP PILIH DAERAH!');
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN SKPD',
						  
						})
        	}else{
        		$("#container-real-fisik").html('<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;"><br>Harap Tunggu...</center>');
				
			  	$.ajax({
					  url: '<?php echo base_url('get-chart-fisik'); ?>',
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
					            text: '%',
					            align: 'high'
					        },
					        labels: {
								overflow: 'justify',
								formatter: function() {
									return this.value  + '%';
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
		 //  $("#fisikSKPD").change(function(){
			// 	var skpd = $('#fisikSKPD').val();
			// 	$.ajax({
			// 		url: '<?php echo base_url('dpa-get-combo-kegiatan'); ?>',
			// 		data:{skpd:skpd},
			// 		type: 'POST',
			// 		success: function(data){
			// 			$('#fisikKeg').html(data);
			// 		}
			// 	})
			// });
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