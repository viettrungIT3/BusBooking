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
            <!-- filters -->
            <div class="container-filters col-lg-3">
                <div id="filters" style="padding: 10px; border: 1px #ddd solid; background: #fff;">
                    <div class="head">
                        <h3>Bộ lọc tìm kiếm</h3>
                    </div>
                    <hr>
                    <div>
                        <!-- Nơi đi -->
                        <div class="form-group mb-2">
                            <label for="origin">Nơi đi:</label>
                            <select class="form-control" id="origin" name="origin">
                                <option value="">Chọn nơi đi</option>
                                <?php foreach ($filters['uniqueOrigins'] as $origin): ?>
                                    <option value="<?= htmlspecialchars($origin->origin); ?>"
                                        <?= isset($_GET["origin"]) && htmlspecialchars($origin->origin) == $_GET["origin"] ? "selected" : ""; ?>>
                                        <?= htmlspecialchars($origin->origin); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Nơi đến -->
                        <div class="form-group mb-2">
                            <label for="destination">Nơi đến:</label>
                            <select class="form-control" id="destination" name="destination">
                                <option value="">Chọn nơi đến</option>
                                <?php foreach ($filters['uniqueDestinations'] as $destination): ?>
                                    <option value="<?= htmlspecialchars($destination->destination); ?>"
                                        <?= isset($_GET["destination"]) && htmlspecialchars($destination->destination) == $_GET["destination"] ? "selected" : ""; ?>>
                                        <?= htmlspecialchars($destination->destination); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Ngày khởi hành -->
                        <div class="form-group mb-2">Thời gian đi:</label>
                            <input type="date" class="form-control" id="departureTime" name="departureTime" value="<?= isset($_GET["departureTime"]) ? $_GET["departureTime"] : ""; ?>">
                        </div>
                        <!-- Loại ghế -->
                        <div class="form-group mb-2">
                            <label for="seatType">Loại ghế:</label>
                            <select class="form-control" id="seatType" name="seatType">
                                <option value="">Chọn loại ghế</option>
                                <?php foreach ($filters['uniqueSeatTypes'] as $seatType): ?>
                                    <option value="<?= htmlspecialchars($seatType->seat_number); ?>">
                                        <?= htmlspecialchars($seatType->seat_number); ?> ghế
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button id="searchButton" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- list schedules -->
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

<script>
    $(document).ready(function () {
        function updateURL() {
            var origin = $('#origin').val();
            var destination = $('#destination').val();
            var departureTime = $('#departureTime').val();
            var seatType = $('#seatType').val();

            var searchParams = new URLSearchParams(window.location.search);

            // Cập nhật các tham số tìm kiếm dựa trên lựa chọn của người dùng
            searchParams.set('origin', origin);
            searchParams.set('destination', destination);
            searchParams.set('departureTime', departureTime);
            searchParams.set('seatType', seatType);

            // Xóa các tham số không được chọn
            if (!origin) searchParams.delete('origin');
            if (!destination) searchParams.delete('destination');
            if (!departureTime) searchParams.delete('departureTime');
            if (!seatType) searchParams.delete('seatType');

            // Cập nhật URL mà không tải lại trang
            var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
            return newUrl;
        }

        // Gắn sự kiện click cho nút Tìm kiếm
        $('#searchButton').on('click', function (e) {
            e.preventDefault();
            // Chuyển đến URL mới với các tham số đã cập nhật
            window.location.href = updateURL();
        });
    });
</script>


<!-- Contact -->
<?= $this->include('frontend/partials/contact.php') ?>

<?= $this->endSection() ?>