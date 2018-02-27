	<nav class="navbar navbar-expand-lg navbar-dark bg-rtlh fixed-top" id="mainNav">
		<a class="navbar-brand" href="index.html">
			<img src="<?= _resx('image') ?>/logo.png" height="50" class="d-inline-block align-top mr-2" alt="logo" />
		</a>
		<span class="navbar-text">
			<h5>WEBGIS BSPS DAN RTLH</h5>
			<span class="d-none"><a href="#">Tentang aplikasi</a> | <a href="#">Bantuan</a></span>
		</span>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarResponsive">
	    	<ul class="navbar-nav navbar-sidenav">
	    		<li class="nav-item<?= _menu($tpl, 'pencarian') ?>" data-toggle="tooltip" data-placement="right" title="Pencarian">
	    			<a class="nav-link" href="<?= _link('pencarian') ?>">
	    				<i class="fa fa-fw fa-search"></i>
	    				<span class="nav-link-text">Pencarian</span>
	    			</a>
	    		</li>
	    		<li class="nav-item<?= _menu($tpl, 'pelaporan') ?>" data-toggle="tooltip" data-placement="right" title="Pelaporan">
	    			<a class="nav-link" href="<?= _link('pelaporan') ?>">
	    				<i class="fa fa-fw fa-bar-chart"></i>
	    				<span class="nav-link-text">Pelaporan</span>
	    			</a>
	    		</li>
	    		<?php if(_isLogin()) { ?>

	    		<li class="nav-item<?= _menu($tpl, 'data') ?>" data-toggle="tooltip" data-placement="right" title="Edit">
	    			<a class="nav-link" href="<?= _link('data') ?>">
	    				<i class="fa fa-fw fa-pencil"></i>
	    				<span class="nav-link-text">Data</span>
	    			</a>
	    		</li>
	    		<?php if(_isAuthorized()) { ?>
	    		<li class="nav-item<?= _menu($tpl, 'akun') ?>" data-toggle="tooltip" data-placement="right" title="Users">
	    			<a class="nav-link" href="<?= _link('akun') ?>">
	    				<i class="fa fa-fw fa-users"></i>
	    				<span class="nav-link-text">Kelola Pengguna</span>
	    			</a>
	    		</li>
	    		<?php } ?>

	    		<?php } ?>
	    	</ul>
	    	<ul class="navbar-nav ml-auto">
	    		<li class="nav-item dropdown">
	    			<?php if(_isLogin()) { ?>
	    			<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    				Selamat datang, <strong><?= _userData('userinfo', 'name') ?></strong>
	    			</a>
	    			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
	    				<a class="dropdown-item" href="<?= _link('akun/profil') ?>">
	    					<div class="dropdown-message small">Profil user</div>
	    				</a>
	    				<a class="dropdown-item" href="<?= _link('akun/ubahpassword') ?>">
	    					<div class="dropdown-message small">Ubah password</div>
	    				</a>
	    				<div class="dropdown-divider"></div>
	    				<a class="dropdown-item" href="<?= _link('logout') ?>">
	    					<div class="dropdown-message small">Logout</div>
	    				</a>
	    			</div>
	    			<?php } else { ?>
	    			<a class="nav-link" href="<?= _link('login') ?>">Login</a>
	    			<?php } ?>
	    		</li>
	    	</ul>
	    </div>
	</nav>