<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= _resx('css') ?>/bootstrap.min.css">
	<link rel="stylesheet" href="<?= _resx('css') ?>/fontawesome.css">
	<link rel="stylesheet" href="<?= _resx('css') ?>/leaflet.css">

	<link href="<?= _resx('css') ?>/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?= _resx('css') ?>/bootstrap-4-select.css" rel="stylesheet">

	<link rel="stylesheet" href="<?= _resx('css') ?>/core2.css">

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
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarResponsive">
	    	<ul class="navbar-nav navbar-sidenav">
	    		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pencarian">
	    			<a class="nav-link" href="index.html">
	    				<i class="fa fa-fw fa-search"></i>
	    				<span class="nav-link-text">Pencarian</span>
	    			</a>
	    		</li>
	    		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pelaporan">
	    			<a class="nav-link" href="index.html">
	    				<i class="fa fa-fw fa-bar-chart"></i>
	    				<span class="nav-link-text">Pelaporan</span>
	    			</a>
	    		</li>
	    		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Edit">
	    			<a class="nav-link" href="index.html">
	    				<i class="fa fa-fw fa-pencil"></i>
	    				<span class="nav-link-text">Edit</span>
	    			</a>
	    		</li>
	    		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
	    			<a class="nav-link" href="index.html">
	    				<i class="fa fa-fw fa-users"></i>
	    				<span class="nav-link-text">Users</span>
	    			</a>
	    		</li>
	    	</ul>
	    	<ul class="navbar-nav ml-auto">
	    		<li class="nav-item dropdown">
	    			<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    				Selamat datang, <strong>Super Admin</strong>
	    			</a>
	    			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
	    				<a class="dropdown-item" href="#">
	    					<div class="dropdown-message small">Profil user</div>
	    				</a>
	    				<a class="dropdown-item" href="#">
	    					<div class="dropdown-message small">Ubah password</div>
	    				</a>
	    				<div class="dropdown-divider"></div>
	    				<a class="dropdown-item" href="#">
	    					<div class="dropdown-message small">Logout</div>
	    				</a>
	    			</div>
	    		</li>
	    	</ul>
	    </div>
	</nav>
	<div class="content-wrapper h-100">
		<div class="container-fluid h-100 p0">
			<div class="row h-100">
				<div class="col-md-12 h-100">
					<div id="map"></div>
					<div class="float-menu">
						<a class="float-item">
							<i class="fa fa-fw fa-th"></i> Table view
						</a>
					</div>
				</div>
			</div>
			<div id="search">
				<div class="row">
					<div class="col">
						<div class="search-toggle">
							<a href="">
								<i class="fa fa-angle-double-left"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="search-form">
							<div class="form-group">
								<label for="keyword">Kata kunci</label>
								<input type="email" class="form-control" id="keyword" placeholder="Kata kunci">
							</div>
							<div class="form-group">
								<label for="keyword">Kecamatan</label>
								<select class="selectpicker" id="kecamatan" data-width="100%" title="Pilih kecamatan" data-none-selected-text="Pilih kecamatan" multiple>
									<option value="64.08.17">BATU AMPAR</option>
									<option value="64.08.09">BENGALON</option>
									<option value="64.08.06">BUSANG</option>
									<option value="64.08.10">KALIORANG</option>
									<option value="64.08.16">KARANGAN</option>
								</select>
							</div>
							<div class="form-group">
								<label for="keyword">Desa</label>
								<select class="selectpicker" id="desa" data-width="100%" title="Pilih desa" multiple>
									<option value="64.08.17">BATU AMPAR</option>
									<option value="64.08.09">BENGALON</option>
									<option value="64.08.06">BUSANG</option>
									<option value="64.08.10">KALIORANG</option>
									<option value="64.08.16">KARANGAN</option>
								</select>
							</div>
							<label for="kriteria">Kriteria</label>
							<div class="checkbox">
								<label><input type="checkbox"> Penerima BSPS</label>
							</div>
							<div class="checkbox">
								<label><input type="checkbox"> Parameter 1</label>
							</div>
							<div class="checkbox">
								<label><input type="checkbox"> Parameter 2</label>
							</div>
							<button class="btn btn-success btn-sm" id="sidebar_update">Update</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery first, then Bootstrap JS -->
	<script src="<?= _resx('js') ?>/jquery.min.js"></script>
	<script src="<?= _resx('js') ?>/popper.min.js"></script>
	<script src="<?= _resx('js') ?>/bootstrap.min.js"></script>

	<script src="<?= _resx('js') ?>/bootstrap-select.min.js"></script>
	<script src="<?= _resx('js') ?>/leaflet.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('.selectpicker').selectpicker({ 
				actionsBox : true
				,deselectAllText : "Hilangkan pilihan"
				,selectAllText : "Pilih semua" 
			});

			var map = L.map('map', {zoomControl: false});
			mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
			L.tileLayer(
				'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
				{ attribution: '&copy; ' + mapLink + ' Contributors',maxZoom: 18,}
			).addTo(map);
			
			$.getJSON("<?= _resx('data'); ?>/kutim.geojson", function(data){
		        mapData = L.geoJson(data);
		        mapBound = mapData.getBounds();
		        mapData.addTo(map);
		        map.fitBounds(mapBound);
		    });

			$('#kecamatan_report').selectpicker('selectAll');
			$('#desa_report').selectpicker('selectAll');
		});
	</script>
</body>
</html>