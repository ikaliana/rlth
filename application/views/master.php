<?php
  if(!isset($load_map)) $load_map=false;
  if(!isset($load_datatable)) $load_datatable=false;
  if(!isset($load_chart)) $load_chart=false;
  if(!isset($custom_css)) $custom_css="";
  if(!isset($custom_js)) $custom_js="";
  if(!isset($show_left_menu)) $show_left_menu=true; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WebGIS Surver Rumah Tangga Tidak Layak Huni</title>

    <link href="<?php echo base_url(); ?>libs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>libs/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>libs/css/sigbun.css" rel="stylesheet">

    <?php if($load_map) { ?>
    <link href="<?php echo base_url(); ?>libs/css/leaflet.css" rel="stylesheet">
    <?php } ?>

    <?php if($load_datatable) { ?>
    <link href="<?php echo base_url(); ?>libs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <?php } ?>

    <?php if($load_chart) { ?>
    <link href="<?php echo base_url(); ?>libs/css/highcharts.css" rel="stylesheet">
    <?php } ?>

    <?php if($custom_css!="") { $this->load->view($custom_css); } ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php
      $user = $this->session->userdata("userinfo");
    ?>
    <nav class="navbar navbar-default navbar-static-top sigbun-navbar">
      <div class="container-fluid">
        <div class="navbar-header sigbun-navbar-header">
          <div class="navbar-brand sigbun-navbar-brand">
            <img alt="Kalimantan Timur" src="<?php echo base_url(); ?>libs/images/logo.png">
            <h3>Sistem Informasi Geospasial Dinas Perkebunan - Kalimantan Timur</h3>
            <br>
            <div class="sigbun-navbar-menu">
              <div class="sigbun-navbar-menu-left">
                <a href="#">Tentang aplikasi</a> | 
                <a href="#">Bantuan</a>
              </div>
              <div class="sigbun-navbar-menu-right">
                <?php if(!$user) { ?>
                <a href="#">Registrasi</a> | 
                <a href="<?php echo site_url('akun/login'); ?>">Login</a>
                <?php } else { ?>
                <div class="dropdown">
                  <a id="dLabel" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Selamat datang, <strong><?php echo $user["name"]; ?></strong>
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dLabel">
                    <li><a href="<?php echo site_url('akun/profil'); ?>">Profil user</a></li>
                    <li><a href="<?php echo site_url('akun/ubahpassword'); ?>">Ubah password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url('akun/logout'); ?>">Logout</a></li>
                  </ul>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <?php if($show_left_menu) { ?>
    <div class="sigbun-left-menu">
      <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#leftmenu" aria-expanded="false" aria-controls="leftmenu">
        MENU <span class="caret"></span>
      </button>
      <?php
        if(!isset($active_menu)) $active_menu="";
        
        $dashboard_active = ($active_menu=="dashboard");
        $pelaporan_active = ($active_menu=="pelaporan");
        $admin_active = ($active_menu=="akun");
        $update_active = ($active_menu=="update");
      ?>
      <div class="collapse" id="leftmenu">
        <a <?php if($dashboard_active) { ?>class="active" <?php } ?>href="<?php echo site_url('dashboard'); ?>">
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span><br>Pencarian</a>
        <a <?php if($pelaporan_active) { ?>class="active" <?php } ?>href="<?php echo site_url('pelaporan'); ?>">
          <span class="glyphicon glyphicon-stats" aria-hidden="true"></span><br>Pelaporan</a>

        <?php if( CheckAksesGroup(["Administrator","Super Admin"]) ) { ?>
        <a <?php if($update_active) { ?>class="active" <?php } ?>href="<?php echo site_url('edit'); ?>">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><br>Edit</a>
        <?php } ?>

        <?php if( CheckAksesGroup(["Administrator","Super Admin"]) ) { ?>
        <a <?php if($admin_active) { ?>class="active" <?php } ?>href="<?php echo site_url('akun'); ?>">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span><br>Kelola<br>Pengguna</a>
        <?php } ?>
        
      </div>          
    </div>
    <!-- Mobile menu -->
    <div class="dropdown" id="leftmenumobile">
      <?php if(!$user) { ?>
      <a class="btn btn-default pull-right btn-sm" href="<?php echo site_url('akun/login'); ?>" role="button">Login</a>
      <?php } else { ?>

      <p class="pull-right" style="margin-top:5px;">Selamat datang, <strong><?php echo $user["name"]; ?></strong></p>
      <?php } ?>

      <button class="btn btn-info btn-sm" type="button" data-toggle="dropdown" data-target="#leftmenu2" aria-expanded="true" aria-haspopup="true">
        MENU <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="<?php echo site_url('peta'); ?>">
          <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;&nbsp;Peta</a></li>
        <li><a href="<?php echo site_url('dashboard'); ?>">
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;Dashboard</a></li>
        <li><a href="<?php echo site_url('pelaporan'); ?>">
          <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;&nbsp;Pelaporan</a></li>
        <?php if( CheckAksesGroup(["Administrator"]) ) { ?>
        <li><a href="<?php echo site_url('administrasi'); ?>">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Administrasi</a></li>
        <?php } ?>
        <?php if( CheckAksesGroup(["Administrator","Operator"]) ) { ?>
        <li><a href="<?php echo site_url('edit'); ?>">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;Update data</a></li>
        <?php } ?>
        <li role="separator" class="divider"></li>
        <li><a href="#">
          <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;Tentang aplikasi</a></li>
        <li><a href="#">
          <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>&nbsp;&nbsp;Bantuan</a></li>
        <?php if($user) { ?>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo site_url('akun/ubahpassword'); ?>">
          <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;&nbsp;Ubah password</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo site_url('akun/logout'); ?>">
          <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;Logout</a></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>

    <?php 
      if($template!="") { 
        $newdata['data'] = isset($data) ? $data : null;
        $this->load->view($template,$newdata); 
      } 
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>libs/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>libs/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/js/bootstrap-datetimepicker.min.js"></script>

    <?php if($load_map) { ?>
    <script src="<?php echo base_url(); ?>libs/js/leaflet.js"></script>
    <?php } ?>

    <?php if($load_datatable) { ?>
    <script src="<?php echo base_url(); ?>libs/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/js/dataTables.bootstrap.min.js"></script>
    <?php } ?>

    <?php if($load_chart) { ?>
    <script src="<?php echo base_url(); ?>libs/js/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>libs/js/modules/exporting.js"></script>
    <?php } ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#leftmenu').collapse('show');
      });

      <?php 
        if($custom_js!="") { 
          $this->load->view($custom_js,isset($custom_js_data) ? $custom_js_data : null); 
        } 
      ?>

    </script>

  </body>
</html>