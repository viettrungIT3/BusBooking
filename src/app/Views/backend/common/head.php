<?php
function get_adminLTE_url($path = '')
{
    return base_url() . '/plugins/AdminLTE-3.2.0/' . $path;
}
?>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?= get_adminLTE_url() ?>plugins/fontawesome-free/css/all.min.css">
<!-- IonIcons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo get_adminLTE_url(); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Theme AdminLTE-3 style -->
<link rel="stylesheet" href="<?php echo get_adminLTE_url(); ?>dist/css/adminlte.min.css">


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= get_adminLTE_url() ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= get_adminLTE_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= get_adminLTE_url() ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE -->
<script src="<?= get_adminLTE_url() ?>dist/js/adminlte.js"></script>
