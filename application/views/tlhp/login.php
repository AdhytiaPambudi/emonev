
<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
<title>SIP | LOGIN</title>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!-- VENDOR CSS -->

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/linearicons/style.css">

	<!-- MAIN CSS -->

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">

	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/demo.css">

	<!-- GOOGLE FONTS -->

	<link href="<?= base_url() ?>assets/css/font-googleapis.css" rel="stylesheet">

	<!-- ICONS -->

	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/kemendagri.png">

	<link rel="icon" type="image/png" sizes="90x60" href="assets/img/favicon.png">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/datepicker3.css">
	<style type="text/css">
		body {
			background-image: url("<?php base_url(); ?>assets/img/hero-bg.jpg");
			background-repeat: repeat;
			background-position: center;
			background-size: cover;
			font-family: 'Roboto', sans-serif;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-rendering: optimizeLegibility;
			font-size: 12px;
		}
	</style>
	<style type="text/css">
    body {
        color: #999;
		/*background: #f5f5f5;*/
		font-family: 'Varela Round', sans-serif;
	}
	.form-control {
		box-shadow: none;
		border-color: #ddd;
	}
	.form-control:focus {
		border-color: #074979; 
	}
	.login-form {
        width: 350px;
		margin: 40px auto;
		padding: 30px 0;
	}
    .login-form form {
        color: #434343;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
        opacity: 0.95;
		border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
	}
	.login-form h4 {
		text-align: center;
		font-size: 22px;
        margin-bottom: 20px;
	}
    .login-form .avatar {
        color: #fff;
		margin: 0 auto 20px;
        text-align: center;
		width: 105px;
		height: 105px;
		border-radius: 50%;
		border: 3px solid #f8a403;
		z-index: 9;
		background: #074979;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
	.login-form .form-control, .login-form .btn {
		min-height: 40px;
		border-radius: 2px; 
        transition: all 0.5s;
	}
	.login-form .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
	.login-form .btn {
		background: #074979;
		border: 3px solid #f8a403;
		line-height: normal;
	}
	.login-form .btn:hover, .login-form .btn:focus {
		background: #074960;
	}
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #074979;
    }
    .login-form .back a {
        color: #fff;
    }
</style>
</head>
<body>
	<div class="login-form">    
    <?php echo form_open(base_url('login'), ''); ?>
		<div class="avatar"><img src="assets/img/kemendagri.png" style="width:64px; height:80px;"></div>
    	<h4 class="modal-title">Login<br><small>Sistem Informasi Pengawasan</small></h4>
        <div class="form-group">
			<label for="signin-email" class="control-label sr-only">Username</label>
			<input type="text" name="username" class="form-control" id="signin-email" placeholder="Username"  required>
		</div>
		
		<div class="form-group">
			<label for="signin-password" class="control-label sr-only">Password</label>
			<input type="password" name="password" class="form-control" id="signin-password" placeholder="Password" required>
		</div>

        <div class="form-group">
		    <div class="input-group">
		      <div class="input-group-addon"><i class="lnr lnr-calendar-full"></i></div>
		      <input type="text" class="form-control" placeholder="Tahun" readonly="" id="tahun" name="tahun" value="<?= date('Y'); ?>">
		    </div>
	    </div>
        <input class="btn btn-primary btn-block btn-lg"  type="submit" name="submit" id="submit" value="Login">              
    <?php echo form_close( ); ?>
    <div class="text-center small back"><a href="<?php echo base_url(); ?>">Kembali Ke Dashboard</a></div>
</div>

	
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
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


