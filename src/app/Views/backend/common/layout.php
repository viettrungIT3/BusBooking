<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>

    <!-- Thêm các thẻ meta, link CSS, và script JS cần thiết -->
    <?= $this->include('backend/common/head.php') ?>
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed dark-mode">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= get_adminLTE_url() ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <?= $this->include('backend/common/navbar.php') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('backend/common/sidebar.php') ?>


        <!-- Content -->
        <!-- <?= $this->renderSection('content') ?> -->
        <!-- /.content -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Footer -->
        <?= $this->include('backend/common/footer.php') ?>
        <!-- /.footer -->
        
    </div>
</body>

</html>