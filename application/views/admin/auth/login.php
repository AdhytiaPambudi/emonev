<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Emonev</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/budistyle/img/logo/logosn.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/owl.theme.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/form/all-type-forms.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/alerts.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/responsive.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">
    <!-- modernizr JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/vendor/modernizr-2.8.3.min.js"></script>
    <style type="text/css">
    body {
            /* background-image: url("<?php base_url(); ?>assets/budistyle/img/etc/background.jpg"); */
            background-color:#dbdbdb;
            background-repeat: repeat;
            background-position: center;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            font-size: 12px;
        }</style>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<!-- <h3>PANEL ADMINISTRAOTR</h3>
				<p style="font-weight:bold;">Silahkan Login</p> -->
			</div>
			<div class="content-error">
				<div class="hpanel">
          <div class="panel-heading" style="border:1px solid #fff;background:#006DF0;min-height:100px;">
            <h4 class="text-center" style="color:white;"><img src="<?= base_url() ?>assets/budistyle/img/logo/logo-login.png" alt=""><hr>Login</h4>
          </div>
          <div class="panel-body">
                        <!-- <form action="#" id="loginForm"> -->
                        <?php echo form_open(base_url('login'), 'id="loginForm"'); ?>
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="Masukkan Username" title="Silahkan Masukkan Username Anda" required="" value="" name="username" id="username" class="form-control">
                                <span class="help-block small">Masukan Username Anda</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="Masukkan Password" required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Masukan Password Anda</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Tahun Aggaran</label>
                                <input type="text" class="form-control" placeholder="Tahun" readonly="" id="tahun" name="tahun" value="<?= date('Y'); ?>">
                                <span class="help-block small">Masukan Tahun Anggaran</span>
                            </div>
                            <div class="checkbox login-checkbox">
                                <label><input type="checkbox" class="i-checks" id="perubahan" name="perubahan"> Anggaran Perubahan</label>
                            </div>
                            <?= $msg ?>
                            <input class="btn btn-success btn-block loginbtn"  type="submit" name="submit" id="submit" value="Login">              
                            <a href="info-dashboard" class="btn btn-success btn-block">Lihat Dashboard</a>              
                        </form>
                    </div>
                </div>
			</div>

			<!-- <div class="text-center login-footer">
				<p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
			</div> -->
		</div>   
    </div>
    <!-- jquery
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/vendor/jquery-1.12.4.min.js"></script>
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
    <script src="<?= base_url() ?>assets/budistyle/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url() ?>assets/budistyle/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/budistyle/js/metisMenu/metisMenu-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/icheck/icheck.min.js"></script>
    <script src="<?= base_url() ?>assets/budistyle/js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="<?= base_url() ?>assets/budistyle/js/main.js"></script>

    <script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
    <!-- tawk chat JS
		============================================ -->
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
    </script>
</body>

</html>