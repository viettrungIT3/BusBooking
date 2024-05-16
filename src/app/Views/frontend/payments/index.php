<?php
function vietnameseDayOfWeek($englishDay)
{
    // Mảng chứa tên các ngày trong tuần tiếng Việt
    $daysInVietnamese = array(
        'Sunday' => 'Chủ Nhật',
        'Monday' => 'Thứ Hai',
        'Tuesday' => 'Thứ Ba',
        'Wednesday' => 'Thứ Tư',
        'Thursday' => 'Thứ Năm',
        'Friday' => 'Thứ Sáu',
        'Saturday' => 'Thứ Bảy'
    );

    // Kiểm tra xem ngày trong tuần tiếng Anh có trong mảng không
    if (array_key_exists($englishDay, $daysInVietnamese)) {
        // Trả về tên ngày trong tuần tiếng Việt
        return $daysInVietnamese[$englishDay];
    } else {
        // Nếu không tìm thấy, trả về ngày trong tuần tiếng Anh
        return $englishDay;
    }
}

// Sử dụng hàm để định dạng ngày thứ trong tuần từ tiếng Anh sang tiếng Việt
function formatVietnameseDate($timestamp)
{
    $englishDayOfWeek = date('l', $timestamp); // Lấy ngày trong tuần (tiếng Anh)
    $vietnameseDayOfWeek = vietnameseDayOfWeek($englishDayOfWeek); // Chuyển đổi sang tiếng Việt

    // Định dạng ngày thứ trong tuần thành tiếng Việt
    $formattedDate = date('H:i ', $timestamp) . $vietnameseDayOfWeek . date(', d-m-Y', $timestamp);

    return $formattedDate;
}
?>


<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

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
                <form action="/payments/bookings/<?= $booking['id'] ?>" method="post" enctype="multipart/form-data"
                    class="card g-3 needs-validation" novalidate>
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
                                <legend>Hình thức thanh toán</legend>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div>
                                        <p>Bạn hãy chọn một trong các hình thức thanh toán dưới đây:</p>
                                    </div>
                                    <?= view('frontend/payments/widgets/payment-methods.php'); ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                            required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Tôi đồng ý với <a href="/dieu-khoan-chinh-sach" class="orange">Điều
                                                Khoản Sử Dụng</a> của Busbooking
                                        </label>
                                        <div class="invalid-feedback">
                                            Bạn phải đồng ý trước khi gửi.
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                            required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Gửi <strong>thông tin thanh toán</strong> và <strong>thông tin vé khi
                                                được duyệt</strong> tới hòm thư
                                            <input type="email" class="form-control" name="email"
                                                value="<?= esc(session()->get('current_user')['email']) ?>"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" required>
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
                <?= view('frontend/payments/widgets/booking-summary.php'); ?>
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