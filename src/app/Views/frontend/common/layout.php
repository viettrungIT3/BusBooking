<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?php echo $this->include('frontend/common/header'); ?>

    <!-- Thêm các thẻ meta, link CSS, và script JS cần thiết -->
    <?= $this->include('frontend/common/head.php') ?>
</head>

<body class="hold-transition sidebar-mini">

    <div class="super_container">
        <!-- Header -->
        <?= $this->include('frontend/common/header.php') ?>

        <!-- Content -->
        <?= $this->renderSection('content') ?>

        <!-- Footer -->
        <?= $this->include('frontend/common/footer.php') ?>
    </div>
</body>

</html>