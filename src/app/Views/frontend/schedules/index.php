<?php

// echo '<pre>';
// var_dump($schedules);
// die();
?>

<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<!-- Link css -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/frontend/css/tickets.css"> -->

<!-- banner -->
<div class="ct-banner">
    <div class="ct-banner_background parallax-window"
        style="background-image: url('<?php echo base_url() ?>/images/banner_bus_detail.jpg')">
    </div>
    <!-- <div class="ct-banner_content">
        <div class="ct-banner_title">about us</div>
    </div> -->
</div>

<section class="content-header">
    <div class="container">
        <div class="row mb-3 mt-3">
            <!-- <div class="col-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Xe khách</a></li>
                    <li class="breadcrumb-item"><a href="#">Đức Phúc Limousine</a></li>
                    <li class="breadcrumb-item active">Đặt lịch</li>
                </ol>
            </div> -->
        </div>
    </div>
</section>

<section class="content-main">
    <div class="container">
        <div class="row">
            <div class="clo-12">
                <h1 class="title">Đức Phúc Limousine: từ Hà Nội đi Thái Nguyên</h1>
            </div>
        </div>

        <div class="row mt-5">
            <div class="container-filters col-lg-3">
                <div id="filters" style="padding: 10px; border: 1px #ddd solid; background: #fff;">
                    <div class="head">
                        <h3>Bộ lọc tìm kiếm</h3>
                    </div>
                    <hr>
                    <div class="mx-2">
                        <?php foreach ($filters as $groupKey => $filter): ?>
                            <?php if ($filter['is_show']): ?>
                                <div class="criteria-item mb-2">
                                    <h5>
                                        <?= esc($filter['label']) ?>
                                    </h5>
                                    <div class="form-controller px-2">
                                        <?php foreach ($filter['options'] as $optionKey => $option): ?>
                                            <?php if ($option['is_show']): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?= esc($optionKey) ?>"
                                                        id="<?= $groupKey . '_' . urlencode($optionKey) ?>"
                                                        name="<?= $groupKey . '[]' ?>" <?= $option['checked'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label"
                                                        for="<?= $groupKey . '_' . urlencode($optionKey) ?>">
                                                        <?= esc($option['label']) ?>
                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="foot d-flex justify-content-end">
                        <button class="btn btn-success">
                            Áp dụng <span class="fa fa-filter" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>


            </div>
            <div class="col-lg-9">
                <?php foreach ($schedules as $schedule): ?>
                    <div class="row mb-5" id="container-schedules">
                        <?php echo view('frontend/schedules/widgets/schedule.php', [
                            "p_id" => "ticket-" . $schedule->id,
                            "schedule" => $schedule
                        ]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="container-filters ">
                <div class="card" style="padding: 20px;">
                    <h3 class="text-center mb-2">Xe Từ Hà Nội Đi Thái Nguyên</h3>
                    <div class="text-center mb-2">
                        <img src="<?php echo base_url() ?>/images/city_street_with_green_bus.png" alt="Bus" class="bus">
                    </div>

                    <div class="info">
                        <p style="text-align: justify;">Đặt vé xe từ Hà Nội đi Thái Nguyên,&nbsp;đón trả tận nhà, giá rẻ
                            nhất tại SaoDieu.vn&nbsp;- Hệ thống đặt vé Online chuyên nghiệp, uy tín nhất tại Việt Nam.
                        </p>
                        <p style="text-align: justify;">Xe khách Hà Nội Thái Nguyên - Limousine VIP, Xe&nbsp;4 chỗ, 7
                            chỗ - Đón trả tận nhà - Chỉ từ 120.000 đ/vé, bao gồm:</p>
                        <ul>
                            <li style="text-align: justify;">Vé xe Limousine đi Thái Nguyên từ&nbsp;Hà Nội - Chỉ từ
                                120.000 đ/vé - Đón trả tận nhà tại Hà Nội,&nbsp;sân bay Nội Bài, Tp Thái Nguyên, Tp Sông
                                Công, Tp Phổ Yên - Hãng xe Limousine Đức Phúc.</li>
                            <li style="text-align: justify;">Vé xe&nbsp;ghép đi Thái Nguyên từ Hà Nội -&nbsp;Chỉ từ
                                180.000 đ/người -&nbsp;Đón trả tận nhà tại Hà Nội,&nbsp;sân bay Nội Bài, Tp Thái Nguyên,
                                Tp Sông Công, Tp Phổ Yên.</li>
                            <li style="text-align: justify;">Thuê xe&nbsp;4 chỗ, 7 chỗ đi Thái Nguyên từ Hà Nội - Chỉ từ
                                550.000 đ/chuyến - Đón trả tận nơi Hà Nội, sân bay Nội Bài, Tp Thái Nguyên, Tp Sông
                                Công, Tp Phổ Yên.</li>
                        </ul>
                        <p style="text-align: justify;">&nbsp;</p>
                        <p style="text-align: justify;">Đặt vé xe khách từ Hà Nội đi Thái Nguyên - Chỉ cần gọi điện đặt
                            vé - Giữ chỗ 100%&nbsp;- Đổi trả vé miễn phí&nbsp;- Nhận vé qua Email/SMS - Thanh toán: ATM
                            - Internet Banking - QR Code - Momo - Visa - Master.</p>
                        <p style="text-align: justify;">Điện thoại đặt vé xe Hà Nội - Thái Nguyên:&nbsp;<span
                                style="color: #ff6600;"><a href="tel:024 3993 9000" style="color: #ff6600;">024 3993
                                    9000</a></span>&nbsp;/&nbsp;<span style="color: #ff6600;"><a href="tel:089 855 8000"
                                    style="color: #ff6600;">089 855 8000</a></span>&nbsp;/&nbsp;<span
                                style="color: #ff6600;"><a href="tel:090 322 3030" style="color: #ff6600;">090 322
                                    3030</a></span></p>
                        <p style="text-align: justify;"><a>Hotline&nbsp;</a><a></a><strong><a href="tel:024 7100 2020"
                                    style="color: #ff6600;">024 7100 2020</a></strong>&nbsp;/&nbsp;<span
                                style="color: #ff6600;"><strong><a href="tel:0936 33 0066" style="color: #ff6600;">0936
                                        33 0066</a></strong></span>&nbsp;(07:00 - 22:00).</p>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Contact -->
<?= $this->include('frontend/partials/contact.php') ?>

<?= $this->endSection() ?>