<?= view('emails/layouts/header', ['title' => 'Cập nhật trạng thái thanh toán']) ?>

<div class="content">
    <h3>Chào <?= esc($booking['user']['name'] ?? 'bạn') ?>,</h3>
    <p>Thông tin tin vé của bạn:</p>
    <div class="details">
        <div style="padding: 8px;">
            <p><?= 'Trạng thái đặt chỗ: '.  $status ?></p>
            <p>Bạn có thể xem chi tiết: <a href="<?= esc(base_url('ticket/' . $booking['id'])) ?>">tại đây</a>
            </p>
        </div>
    </div>
    <p>Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi.</p>
    <a href="<?= esc(base_url('/contact')) ?>" class="button">Liên hệ ngay</a>
</div>

<?= view('emails/layouts/footer') ?>