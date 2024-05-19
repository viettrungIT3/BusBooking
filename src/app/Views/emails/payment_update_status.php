<?= view('emails/layouts/header', ['title' => 'Cập nhật trạng thái thanh toán']) ?>

<div class="content">
    <h3>Chào <?= esc($booking['user']['name'] ?? 'bạn') ?>,</h3>
    <p>Thông tin thanh toán của bạn như sau:</p>
    <div class="details">
        <?php
        // Khai báo mảng lưu trữ các thông điệp tương ứng với mỗi trạng thái
        $messages = [
            'unpaid' => 'Thanh toán của quý khách chưa được thực hiện.',
            'pending' => 'Quá trình thanh toán của quý khách đang chờ kiểm duyệt.',
            'confirmed' => 'Thanh toán của quý khách đã được xác nhận.',
            'reverification' => 'Thanh toán cần xác minh lại. Vui lòng cung cấp thông tin theo yêu cầu.',
            'cancelled' => 'Thanh toán đã bị hủy.',
            'refunded' => 'Thanh toán đã được hoàn trả. Nhân viên hệ thống sẽ liên lạc trực tiếp',
            'failed' => 'Thanh toán không thành công. Vui lòng thử lại.'
        ];
        ?>

        <!-- Hiển thị thông điệp tương ứng với trạng thái -->
        <div class="payment-status <?= esc($status) ?>" style="    padding: 8px;">
            <p><?= $messages[$status] ?></p>
            <p>Bạn có thể xem chi tiết: <a href="<?= esc(base_url('payments/status/' . $booking['id'])) ?>">tại đây</a>
            </p>
        </div>
    </div>
    <p>Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi.</p>
    <a href="<?= esc(base_url('/contact')) ?>" class="button">Liên hệ ngay</a>
</div>

<?= view('emails/layouts/footer') ?>