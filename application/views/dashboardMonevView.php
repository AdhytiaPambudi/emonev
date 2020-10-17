<!doctype html>
<html lang="en">
<head>
	<title>e-Monev</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- NEW STYLE -->
	<!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/budistyle/img/logo/logosn.png">
    <!-- Google Fonts
		============================================ -->
    
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    
    
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/scrollbar/jquery.mCustomScrollbar.min.css">
    
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/metisMenu/metisMenu-vertical.css">
    
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/modals.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/notifications/Lobibox.min.css">
    
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/responsive.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/preloader/dist/prelodr.css">
	<link href="<?= base_url() ?>assets/css/font-googleapis.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">

	<script src="<?= base_url() ?>assets/budistyle/js/vendor/modernizr-2.8.3.min.js"></script>

	<style type="text/css">
	.function_separator{
		text-align: right;
	}
	textarea{  
	  display: block;
	  box-sizing: padding-box;
	  overflow: hidden;
	}

</style>
	
	<!-- <script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script> -->
	<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>

	
	<script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>
	<style type="text/css">
		html { overflow-y: scroll; overflow-x:hidden; }
		.swal-overlay {
		  background-color: rgba(43, 165, 137, 0.45);
		}
	</style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top" style="border-color:#006DF0;background-color:#fff;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img class="main-logo" src="<?= base_url() ?>assets/budistyle/img/logo/logo.png" alt="" style="width:90px;"/>
            </a>
            
        </div>
        <form class="navbar-form navbar-right text-right">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Tahun" readonly="" id="tahun" name="tahun" value="<?= date('Y'); ?>">
            </div>
            <a href="<?=base_url('login');?>" type="button" class="btn btn-primary">Login</a>
        </form>
        
    </div>
</nav>
<br><br>





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
									<select id="keuSKPD" class="form-control input-sm comboskpd searchRealKeu" style="width:100%">
														
									</select>
								</div>
								
							</div><hr>
					</div>
					
								<figure class="highcharts-figure" style="min-height:400px;vertical-align:middle;">
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
							<h1>Dokumentasi Kegiatan</h1>
							<div class="row">
								<div style="padding-bottom:10px;" class=" col-sm-12" >
									<select name="realFisikSkpd" id="fisikSKPD" class="form-control input-sm comboskpd searchRealFisik" style="width:100%">
														
									</select>
								</div>
								
								
							</div><hr>
							
							
						</div>

						
					</div>
					<figure class="highcharts-figure"  style="min-height:400px;">
                    <table id="table-keg" class="table table-bordered table-striped table-condensed" style="width:100%;font-size:8pt;">
                        <thead>
                            <tr>
                                <th style="text-align:center;">No</th>
                                <th style="text-align:center;">SKPD</th>
                                <th style="text-align:center;">Kegiatan</th>
                                <th style="text-align:center;">Lokasi</th>
                                <th style="text-align:center;">#</th>
                            </tr>
                        </thead>
                        <tbody id="container-real-fisik">
                            <tr><td colspan="5" align="center">Silahkan Pilih SKPD</td></tr>
                        </tbody>
                    </table>
					</figure>
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
        <h4 class="modal-title" id="myModalLabel">Detail Dokumentasi</h4>
      </div>
      <div class="modal-body" id="listDetail">  
      <form id="form-pemantauan" enctype="multipart/form-data" method="post">
        
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group-inner" >
                            <div class="sparkline8-list">
                                <div class="sparkline8-graph">
                                    <div class="static-table-list">
                                        <table class="table table-condensed table-bordered" style="font-size:9pt;">
                                            <thead style="background:#006DF0;color:white;">
                                                
                                                <tr>
                                                    <th style="text-align:center;">No</th>
                                                    <th style="text-align:center;">Uraian</th>
                                                    <th style="text-align:center;">Distrik</th>
                                                    <th style="text-align:center;">Kampung</th>
                                                    <th style="text-align:center;">Koordinat</th>
                                                    <th style="text-align:center;">No Kontrak</th>
                                                    <th style="text-align:center;">Kontraktor</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl-dokumentasi">
                                                <tr>
                                                    <td colspan="7" style="text-align:center;">Harap Tunggu ...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
              
                                       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-lg btn-danger" data-dismiss="modal">Tutup</button>
        </form>
      </div>
    </div>
  </div>
</div>


    <!-- jquery
		============================================ -->
    
    <!-- 
     -->
    <!-- bootstrap JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    
    <!-- sticky JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url() ?>assets/budistyle/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/budistyle/js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    
    <!-- morrisjs JS
		============================================ -->
    
  
    <!-- plugins JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/main.js"></script>
    <script src="<?= base_url() ?>assets/budistyle/js/notifications/Lobibox.js"></script>
    <!-- tawk chat JS
		============================================ -->
    
    <script src="<?= base_url() ?>assets/vendor/preloader/dist/prelodr.js"></script>


    <!-- PLD -->
    
	<script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>


    <!-- Datatable style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/dataTables.bootstrap.min.css">  
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/fixedHeader.bootstrap.min.css">  
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables/css/responsive.bootstrap.min.css">  
    <script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/responsive.bootstrap.min.js"></script>

    <script src="<?= base_url() ?>assets/vendor/highcharts/code/highcharts.js"></script>  
	<script type="text/javascript">
	$(document).ready(function(){
		    // Format mata uang.
		    $( '.function_separator' ).mask('00.000.000.000,00', {reverse: true});

		});

        $(window).on('load', function () {
		
            $.ajax({
                url: '<?php echo base_url('get-combo-skpd-all'); ?>',
                type: 'POST',
                success: function(data){
                    $(".comboskpd").html(data);
                }
            });

            var thn = '<?=date("Y");?>';
            var skpd = 'all';
            $("#container-real-fisik").html("<tr><td colspan='5' style='text-align:center;'>Harap Tunggu...</td></tr>");
            $.ajax({
                url: '<?php echo base_url('get-chart-fisik-front'); ?>',
                type: 'POST',
                data:{skpd:skpd,thn:thn},
                success: function(data){
                    $("#container-real-fisik").html(data);
                    $('#table-keg').DataTable({"ordering":false});
                }
            });
        });

        

	$(document)
    .one('focus.autoExpand', 'textarea.autoExpand', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
    })
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
        this.rows = minRows + rows;
    });
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			const flashdata = $('.flash-data').data('flashdata');
			if (flashdata) {
				Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: flashdata,
				  showConfirmButton: false,
				  timer: 2000
				})
			};
		});
    </script>
    
     <script type="text/javascript">
      $(document).ready(function() {	
          $(function() {
            $("#tahun").datepicker({
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

      $(".searchRealKeu").change(function(){
			
            var skpd = document.getElementById('keuSKPD').value;
            var thn = document.getElementById('tahun').value;
        	
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
					  url: '<?php echo base_url('get-chart-keu-front'); ?>',
					  type: 'POST',
					  data:{skpd:skpd,thn:thn},
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
          
          $(".searchRealFisik").change(function(){
			
            var skpd = document.getElementById('fisikSKPD').value;
            var thn = document.getElementById('tahun').value;
        	
        	if (skpd == '') {
        		// alert('HARAP PILIH DAERAH!');
        		Swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'HARAP ISI PILIHAN SKPD',
						  
						})
        	}else{
        		$("#container-real-fisik").html('<tr><td colspan="5" align="center">Harap Tunggu ...</td></tr>');
			  	$.ajax({
					  url: '<?php echo base_url('get-chart-fisik-front'); ?>',
					  type: 'POST',
					  data:{skpd:skpd,thn:thn},
					  success: function(data){
                        $("#container-real-fisik").html(data);
                        $("#table-keg").DataTable().fnDestroy();
                        $('#table-keg').DataTable({"ordering":false});
					  }
				  });
        	}

		  });



		  $(document).on("click", ".showDokumentasi", function() {
		  		
		        var thn 		= $(this).attr("data-tahun");
		        var keg 		= $(this).attr("data-keg");

		        // var rek 		= $(this).attr("data-rek");
		        // var po 	    	= $(this).attr("data-po");
		        // var skpd          = $(this).attr("data-skpd");
		        $('#myModal').modal('show');
		        
				
		        $.ajax({
			      method: 'POST',
			      url: '<?php echo base_url('get-rinci-dokumentasi'); ?>?thn='+thn+'&keg='+keg,
			    })
			    .done(function(data) {
		            var out = jQuery.parseJSON(data);

		            $('#tbl-dokumentasi').html(out.tbldokumentasi);

		            
			      	
			    })
			});
    </script>
    <script type="text/javascript">
	$('.comboskpd').select2({
          placeholder: 'Pilih OPD',
          theme: "classic"
    });
    
	
</script>
</body>

</html>
