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
    
    <div class="container">
        <div class="jumbotron" style="margin-top: 126px;">
            <h1>Akses ditolak!</h1>
            <p>Anda tidak punya akses ke halaman ini.</p>
            <?php
                $user = $this->session->userdata("userinfo");
                if(!$user) { 
            ?>
            <p><a class="btn btn-primary btn-lg" href="<?= _link('akun/login'); ?>" role="button">Login</a></p>
            <?php } else { ?>
            <p><a class="btn btn-primary btn-lg" href="javascript:window.history.back()" role="button">Kembali</a></p>
            <?php } ?>
        </div>
    </div>

    <!-- jQuery first, then Bootstrap JS -->
    <script src="<?= _resx('js') ?>/jquery.min.js"></script>
    <script src="<?= _resx('js') ?>/bootstrap.min.js"></script>
</body>
</html>