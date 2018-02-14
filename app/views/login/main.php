<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= _resx('css') ?>/bootstrap.min.css">

	<link rel="stylesheet" href="<?= _resx('css') ?>/core.css">

	<title>WEBGIS BSPS DAN RTLH</title>
</head>
<body class="fixed-nav sticky-footer bg-white" id="page-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-rtlh fixed-top" id="mainNav">
		<a class="navbar-brand" href="index.html">
			<img src="<?= _resx('image') ?>/logo.png" height="50" class="d-inline-block align-top mr-2" alt="logo" />
		</a>
		<span class="navbar-text">
			<h5>WEBGIS BSPS DAN RTLH</h5>
			<a href="#">Tentang aplikasi</a> | <a href="#">Bantuan</a>
		</span>
	</nav>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="login-box">
		            <form>
		                <div class="alert alert-danger" role="alert" style="display:none">
		                    <strong>Username</strong> tidak terdaftar atau <strong>password</strong> salah 
		                </div>
		                <div class="form-group">
		                    <input type="text" class="form-control input-lg" id="username" placeholder="Username">
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control input-lg" id="password" placeholder="Password">
		                </div>
		                <div class="form-group" style="padding-top:10px;">
		                    <button type="button" class="btn btn-success btn-lg btn-block" id="btnLogin">Sign in</button>
		                </div>
		                <div class="form-group" style="padding-top:0px;margin-bottom:5px;text-align:right;">
		                    <a href="<?= _link('pencarian'); ?>">Masuk tanpa login &raquo;</a>
		                </div>
		            </form>
		        </div>
			</div>
		</div>
	</div>

	<!-- jQuery first, then Bootstrap JS -->
	<script src="<?= _resx('js') ?>/jquery.min.js"></script>
	<script src="<?= _resx('js') ?>/popper.min.js"></script>
	<script src="<?= _resx('js') ?>/bootstrap.min.js"></script>
</body>
</html>
					