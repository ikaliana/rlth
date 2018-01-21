<?php
  if(!isset($load_map)) $load_map=false;
  if(!isset($load_datatable)) $load_datatable=false;
  if(!isset($load_chart)) $load_chart=false;
  if(!isset($custom_css)) $custom_css="";
  if(!isset($custom_js)) $custom_js="";
  if(!isset($show_left_menu)) $show_left_menu=true; 
  if(!isset($show_sidebar)) $show_sidebar=false;
  if(!isset($show_floatmenu)) $show_floatmenu=false;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WEBGIS BSPS DAN RTLH</title>

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

    <?php  if($show_sidebar) { ?>
    <link href="<?php echo base_url(); ?>libs/css/bootstrap-select.min.css" rel="stylesheet">
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
            <h3>WEBGIS BSPS DAN RTLH</h3>
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
      <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#leftmenu" 
        aria-expanded="false" aria-controls="leftmenu" style="border-radius:0">
        MENU <span class="caret"></span>
      </button>
      <?php
        if(!isset($active_menu)) $active_menu="";
        
        $dashboard_active = ($active_menu=="pencarian");
        $pelaporan_active = ($active_menu=="pelaporan");
        $admin_active = ($active_menu=="akun");
        $update_active = ($active_menu=="edit");
      ?>
      <div class="collapse" id="leftmenu">
        <a <?php if($dashboard_active) { ?>class="active" <?php } ?>href="<?php echo site_url('pencarian'); ?>">
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span><br>Pencarian</a>
        <a <?php if($pelaporan_active) { ?>class="active" <?php } ?>href="<?php echo site_url('pelaporan'); ?>">
          <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span><br>Pelaporan</a>

        <?php if( CheckAksesGroup(["Administrator","Super Admin"]) ) { ?>
        <a <?php if($update_active) { ?>class="active" <?php } ?>href="<?php echo site_url('edit'); ?>">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><br>Edit</a>
        <?php } ?>

        <?php if( CheckAksesGroup(["Administrator","Super Admin"]) ) { ?>
        <a <?php if($admin_active) { ?>class="active" <?php } ?>href="<?php echo site_url('akun'); ?>">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span><br>Kelola Pengguna</a>
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
        <li><a href="<?php echo site_url('pencarian'); ?>">
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;Pencarian</a></li>
        <li><a href="<?php echo site_url('pelaporan'); ?>">
          <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>&nbsp;&nbsp;Pelaporan</a></li>
        <?php if( CheckAksesGroup(["Administrator","Super Admin"]) ) { ?>
        <li><a href="<?php echo site_url('edit'); ?>">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;Edit</a></li>
        <?php } ?>
        <?php if( CheckAksesGroup(["Administrator","Super Admin"]) ) { ?>
        <li><a href="<?php echo site_url('administrasi'); ?>">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Kelola Pengguna</a></li>
        <?php } ?>
        <li role="separator" class="divider"></li>
        <li><a href="#">
          <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;Tentang aplikasi</a></li>
        <li><a href="#">
          <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>&nbsp;&nbsp;Bantuan</a></li>
        <?php if($user) { ?>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo site_url('akun/profil'); ?>">
          <span class="glyphicon glyphicon-education" aria-hidden="true"></span>&nbsp;&nbsp;Profil user</a></li>
        <li><a href="<?php echo site_url('akun/ubahpassword'); ?>">
          <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;&nbsp;Ubah password</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo site_url('akun/logout'); ?>">
          <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;Logout</a></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>


    <?php  if($show_sidebar) { ?>
    <div id="sidebar">
      <button class="btn btn-info btn-block" type="button" style="border-radius:0" id="btnSidebar"></button>
      <form id="sidebar-form">
        <div id="sidebar-search">
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
        <div id="sidebar-report">
          <div class="form-group">
            <label for="keyword">Kecamatan</label>
            <select class="selectpicker" id="kecamatan_report" data-width="100%" title="Pilih kecamatan" multiple>
              <option value="64.08.17">BATU AMPAR</option>
              <option value="64.08.09">BENGALON</option>
              <option value="64.08.06">BUSANG</option>
              <option value="64.08.10">KALIORANG</option>
              <option value="64.08.16">KARANGAN</option>
            </select>
          </div>
          <div class="form-group">
            <label for="keyword">Desa</label>
            <select class="selectpicker" id="desa_report" data-width="100%" title="Pilih desa" multiple>
              <option value="64.08.17">BATU AMPAR</option>
              <option value="64.08.09">BENGALON</option>
              <option value="64.08.06">BUSANG</option>
              <option value="64.08.10">KALIORANG</option>
              <option value="64.08.16">KARANGAN</option>
            </select>
          </div>
          <button class="btn btn-success btn-sm" id="sidebar_report_update">Update</button>
        </div>
      </form>
    </div>
    <?php } ?>
    

    <?php 
      if($template!="") { 
        $newdata['data'] = isset($data) ? $data : null;
        $this->load->view($template,$newdata); 
      } 
    ?>

    <?php if($show_floatmenu) { ?>
    <div class="floatmenu">
      <a id="floatImport"><span class="glyphicon glyphicon-open-file" aria-hidden="true"></span> Import data</a>
      <a id="floatExport"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Save ke Excel</a>
      <a id="floatAdd"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah baru</a>
      <a id="floatTable"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Table view</a>
      <a id="floatMap"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Map view</a>
    </div>
    <?php } ?>

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
    <script src="<?php echo base_url(); ?>libs/js/modules/data.js"></script>
    <script src="<?php echo base_url(); ?>libs/js/modules/exporting.js"></script>
    <?php } ?>

    <?php  if($show_sidebar) { ?>
    <script src="<?php echo base_url(); ?>libs/js/bootstrap-select.min.js"></script>
    <?php } ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#leftmenu').collapse('show');

        $('.selectpicker').selectpicker({ 
          actionsBox : true
          ,deselectAllText : "Hilangkan pilihan"
          ,selectAllText : "Pilih semua" 
        });
        $('#kecamatan_report').selectpicker('selectAll');
        $('#desa_report').selectpicker('selectAll');
      });

      $('#leftmenu').on('hide.bs.collapse', function () {
        if (!$("#sidebar").hasClass("minimize")) $("#btnSidebar").trigger("click");
      });

      $("#btnSidebar").on("click", function () {
        if (!$("#leftmenu").hasClass("in")) return;
        $("#sidebar").toggleClass("minimize");
        $("#btnSidebar").toggleClass("minimize");
        $("#sidebar-form").toggle();
        $(".sigbun-container").toggleClass("sidebar");
        $(".sigbun-container").toggleClass("sidebar-min");
      });

      <?php 
        if($custom_js!="") { 
          $this->load->view($custom_js,isset($custom_js_data) ? $custom_js_data : null); 
        } 
      ?>

    </script>

  </body>
</html>