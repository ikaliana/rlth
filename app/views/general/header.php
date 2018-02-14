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

	<?php if($tpl['load_map']) { ?>
	<link rel="stylesheet" href="<?= _resx('css') ?>/datatables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= _resx('css') ?>/buttons.datatables.min.css">
	<?php } ?>

	<link rel="stylesheet" href="<?= _resx('css') ?>/core.css">

	<title>WEBGIS BSPS DAN RTLH</title>

	<?= _loadView($tpl['custom_css']); ?>
</head>
<body class="fixed-nav sticky-footer bg-white" id="page-top">
	<?= _loadView('general/sidebar'); ?>
	
	<div class="content-wrapper h-100">
		<div class="container-fluid h-100 p0">
			<div class="row h-100">
				<div class="col-md-12 h-100">
					<div id="map"></div>