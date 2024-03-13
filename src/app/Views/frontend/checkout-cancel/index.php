<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<!-- banner -->
<div class="ct-banner">
    <div class="ct-banner_background parallax-window" style="background-image: url('<?php echo base_url() ?>/images/banner_bus_detail.jpg')">
    </div>
</div>

<section class="content-header">
    <div class="container">
        <div class="row mb-3 mt-3">
            <div class="col-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Xe khách</a></li>
                    <li class="breadcrumb-item"><a href="#">Đức Phúc Limousine</a></li>
                    <li class="breadcrumb-item active">Hủy vé</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content-main">
    <div class="container">
        <div class="row mt-3 mb-5">
            <div class="alert alert-danger">Thời hạn đặt vé đã hết. Quý khách vui lòng chọn lại.</div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>