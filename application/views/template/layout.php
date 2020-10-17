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
	<?php

		if ($this->session->userdata('is_admin_login') == FALSE) {
			redirect(base_url(''), 'refresh');
		}
		?>
	<!-- WRAPPER -->
	
	<!-- END WRAPPER -->
	
	<!-- NEW STYLE -->
	<!-- NEW SIDEBAR -->
	<?php
                                    
	$menu 	= $this->dynamic_menu->menu_panel();
	$i 		= 1;
	
    ?>
	<?php include('sidebar.php'); ?>
	<!-- END SIDEBAR -->

	<div class="all-content-wrapper">
	<?php include('navbar.php'); ?>
	<?php $this->load->view($view);?>
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
	<script type="text/javascript">
	$(document).ready(function(){
		    // Format mata uang.
		    $( '.function_separator' ).mask('00.000.000.000,00', {reverse: true});

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
		$('#orientation').select2({
	          placeholder: 'Orientation',
	          theme: "classic"
	        });
		
	    $('#margins').select2({
	          placeholder: 'Margins',
	          theme: "classic"
	        });
	     $('#spacing').select2({
	          placeholder: 'Spacing',
	          theme: "classic"
	        });
	</script>

</body>

</html>
