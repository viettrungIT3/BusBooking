<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<?php
$data_list_trip = [
    [
        'id' => 1,
        'departure_stations' =>
            [
                "label" => "Hà Nội",
                "stations" => [
                    ['id' => 1, 'time' => '04:50', 'destination_time' => 'BigC Hà Đông'],
                    ['id' => 2, 'time' => '04:55', 'destination_time' => '275 Nguyễn Trãi'],
                    ['id' => 3, 'time' => '05:00', 'destination_time' => '94H Đường Láng'],
                    ['id' => 4, 'time' => '05:05', 'destination_time' => '420 Đường Láng'],
                    ['id' => 5, 'time' => '05:05', 'destination_time' => '530 Đường Láng'],
                    ['id' => 6, 'time' => '05:10', 'destination_time' => '678 Đường Láng'],
                    ['id' => 7, 'time' => '05:10', 'destination_time' => '988 Đường Láng'],
                    ['id' => 8, 'time' => '05:15', 'destination_time' => 'Đại học Giao Thông'],
                    ['id' => 9, 'time' => '05:15', 'destination_time' => '180 Cầu Giấy'],
                    ['id' => 10, 'time' => '05:20', 'destination_time' => '147 Hoàng Quốc Việt'],
                    ['id' => 11, 'time' => '05:25', 'destination_time' => '50 Võ Chí Công'],
                    ['id' => 12, 'time' => '05:25', 'destination_time' => 'Ngã tư Xuân La'],
                    ['id' => 13, 'time' => '05:30', 'destination_time' => 'Winmart Nhật Tân'],
                ]
            ],
        'destination_stations' =>
            [
                "label" => "Thái Nguyên",
                "stations" => [
                    ['id' => 14, 'time' => '06:20', 'destination_time' => 'Nút giao Yên Bình'],
                    ['id' => 15, 'time' => '06:20', 'destination_time' => 'Nút giao Sông Công'],
                    ['id' => 16, 'time' => 'Chưa xác định', 'destination_time' => 'Đón trả tận nơi'],
                ]
            ]
    ]
];
?>

<!-- banner -->
<div class="ct-banner">
    <div class="ct-banner_background parallax-window"
        style="background-image: url('<?php echo base_url() ?>/images/banner_bus_detail.jpg')">
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
                    <li class="breadcrumb-item active">Thông tin thanh toán</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content-main">
    <div class="container">
        <div class="row mt-3 mb-5">
            <div class="col-12 col-sm-8 mb-2">
                <form class="card g-3 needs-validation" novalidate>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header">
                                <p class="fw-bold">
                                    Hệ thống sẽ giữ vé trong vòng
                                    <span id="countdown" class="price"></span> để quý khách hoàn tất thủ tục đặt vé.
                                    <br>
                                    Sau thời gian này, hệ thống sẽ tự động cập nhật lại hoặc <a
                                        href="/checkout/cancel">nhấn vào đây</a> để hủy vé.
                                </p>

                                <script>
                                    var remainingTime = <?php echo $remaining_time_seconds; ?>;

                                    function updateCountdown() {
                                        var minutes = Math.floor(remainingTime / 60);
                                        var seconds = remainingTime % 60;

                                        var countdownElement = document.getElementById('countdown');
                                        countdownElement.textContent = minutes.toString().padStart(2, '0') + ' phút ' + seconds.toString().padStart(2, '0') + ' giây';

                                        if (remainingTime <= 0) {
                                            sessionStorage.removeItem('ticket_hold_start_time');
                                            window.location.href = '/checkout/cancel'; // Chuyển hướng khi thời gian hết
                                        } else {
                                            remainingTime--;
                                            setTimeout(updateCountdown, 1000);
                                        }
                                    }

                                    updateCountdown();
                                </script>


                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <legend>1. Thông tin người mua hàng</legend>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div>
                                        <p>Quý khách vui lòng nhập thông tin đầy đủ và chính xác.</p>
                                        <p>Vé điện tử và tin nhắn xác nhận sẽ được gửi đến email và số điện thoại đăng
                                            ký của quý khách.</p>
                                    </div>
                                    <div>
                                        <div class="col-12">
                                            <label for="validationCustom01" class="form-label">Họ và tên <font
                                                    color="red">*
                                                </font></label>
                                            <input type="text" class="form-control" id="validationCustom01" required>
                                            <div class="invalid-feedback">
                                                Bạn cần nhập Họ và tên
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="validationCustom02" class="form-label">Email hoặc Điện thoại di
                                                động
                                                <font color="red">*</font>
                                            </label>
                                            <input type="text" class="form-control" id="validationCustom02" required>
                                            <div class="invalid-feedback">
                                                Bạn cần nhập Email hoặc Điện thoại di động
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <legend>2. Hình thức thanh toán</legend>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div>
                                        <p>Bạn hãy chọn một trong các hình thức thanh toán dưới đây:</p>
                                    </div>
                                    <ul class="payment_method">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="station_destination"
                                                    id="payment_method_1" value="1">
                                                <label class="form-check-label" for="payment_method_1">
                                                    Chuyển khoản ngân hàng
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="station_destination"
                                                    id="payment_method_2" value="2">
                                                <label class="form-check-label" for="payment_method_2">
                                                    Thanh toán Internet Banking
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="station_destination"
                                                    id="payment_method_3" value="3">
                                                <label class="form-check-label" for="payment_method_3">
                                                    Thẻ tín dụng quốc tế
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="station_destination"
                                                    id="payment_method_4" value="4">
                                                <label class="form-check-label" for="payment_method_4">
                                                    Ví điện tử MoMo
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="station_destination"
                                                    id="payment_method_5" value="5">
                                                <label class="form-check-label" for="payment_method_5">
                                                    Thanh toán qua cửa hàng tiện ích
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="station_destination"
                                                    id="payment_method_6" value="6">
                                                <label class="form-check-label" for="payment_method_6">
                                                    Thanh toán trực tiếp tại văn phòng
                                                </label>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                            required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Tôi đồng ý với <a href="/dieu-khoan-chinh-sach" class="orange">Điều Khoản Sử
                                                Dụng</a> của SaoDieu.vn
                                        </label>
                                        <div class="invalid-feedback">
                                            Bạn phải đồng ý trước khi gửi.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Đặt vé</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Thông tin đặt xe</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label>Giá vé:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="120.000 đ"
                                disabled>
                        </div>
                        <div class="mb-2">
                            <label>Số lượng:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="1 vé" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Nhà xe:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;"
                                value="Đức Phúc Limousine" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Loại xe:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;"
                                value="Limousine VIP 9 ghế" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Bến đi:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="BigC Hà Đông"
                                disabled>
                        </div>
                        <div class="mb-2">
                            <label>Ngày đi:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;"
                                value="Thứ Sáu, 15-03-2024" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Bến đến:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;"
                                value="Nút giao Sông Công" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Ngày đến:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;"
                                value="Thứ Sáu, 15-03-2024" disabled>
                        </div>
                        <div class="mt-1 mb-2">
                            <label class="form-label fw-bold">Tổng tiền vé:</label>
                            <div class="input-group">
                                <input type="text" class="form-control fw-bold" value="120.000 đ" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?= $this->endSection() ?>