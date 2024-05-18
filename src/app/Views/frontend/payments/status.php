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
                <div class="card mb-3">
                    <div class="card-header">
                        <legend>Trạng thái thanh toán</legend>
                    </div>
                    <div class="card-body">
                        <?php
                        // Khai báo mảng lưu trữ các thông điệp tương ứng với mỗi trạng thái
                        $messages = [
                            'unpaid' => 'Thanh toán của quý khách chưa được thực hiện.',
                            'pending' => 'Quá trình thanh toán của quý khách đang chờ duyệt.',
                            'confirmed' => 'Thanh toán của quý khách đã được xác nhận.<br> Vui lòng kiểm tra hộp thư để xem chi tiết vé',
                            'reverification' => 'Thanh toán cần xác minh lại. Vui lòng cung cấp thông tin theo yêu cầu.',
                            'cancelled' => 'Thanh toán đã bị hủy.',
                            'refunded' => 'Thanh toán đã được hoàn trả.',
                            'failed' => 'Thanh toán không thành công. Vui lòng thử lại.'
                        ];

                        // Khai báo mảng lưu trữ các lớp CSS tương ứng với mỗi trạng thái
                        $cssClasses = [
                            'unpaid' => 'text-danger',
                            'pending' => 'text-warning',
                            'confirmed' => 'text-success',
                            'reverification' => 'text-warning',
                            'cancelled' => 'text-danger',
                            'refunded' => 'text-info',
                            'failed' => 'text-danger'
                        ];
                        ?>

                        <!-- Hiển thị thông điệp và lớp CSS tương ứng với trạng thái -->
                        <?php if (array_key_exists($booking['payment']['status'], $messages)): ?>
                            <p class="fw-bold <?= esc($cssClasses[$booking['payment']['status']]) ?>">
                                <?= esc($messages[$booking['payment']['status']]) ?>
                            </p>
                        <?php endif; ?>

                    </div>
                    <div class="card-footer text-muted">
                        <?php if ($booking['payment']['status'] == 'pending'): ?>
                            <a href="<?= esc(base_url('/payments/renew-booking/' . $booking['id'])) ?>"
                                class="btn btn-danger float-start">
                                Thanh toán lại
                            </a>
                            <a href="<?= esc(base_url('/schedules')) ?>" class="btn btn-info float-end">
                                Tiếp tục đặt vé khác
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-2">
                <?= view('frontend/payments/widgets/booking-summary.php'); ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>