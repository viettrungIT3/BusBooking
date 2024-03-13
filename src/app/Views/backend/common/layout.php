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

<body>

    <!-- Header -->
    <?= $this->include('backend/common/header.php') ?>

    <!-- Content -->
    <!-- <?= $this->renderSection('content') ?> -->

    <!-- Footer -->
    <?= $this->include('backend/common/footer.php') ?>
</body>

</html>