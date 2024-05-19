<?= view('emails/layouts/header', ['title' => 'Biên lai chuyển tiền']) ?>

<div class="content">
    <h3>Chào <?= esc($booking['user']['name'] ?? 'bạn') ?>,</h3>
    <p>Cảm ơn bạn, chúng tôi đã nhận được yêu cầu thanh toán. Dưới đây là thông tin chi tiết:</p>
    <div class="details">
        <table class="table table-bordered w-100 m-0">
            <tr>
                <th>Thông tin thanh toán</th>
                <th>Thông tin đặt chỗ</th>
            </tr>
            <tr>
                <td>
                    <div class="card-body">
                        <ul>

                            <li>
                                <p>Thời gian:
                                    <?php echo date('H:i d/m/Y', strtotime($payment['created_at'])); ?>
                                </p>
                            </li>
                            <li>
                                <p>Hình thức: <?= esc($payment_method['name']) ?></p>
                            </li>
                            <?php if ($file_attach): ?>
                                <li>
                                    <p>
                                        Hình ảnh: <font style="color:red">file đính kèm bên dưới.</font>
                                    </p>
                                </li>
                            <?php endif; ?>
                            <li>
                                <p>Bạn có muốn thay đổi hình thức thanh toán không?</p>
                                <a href="<?= esc(base_url('/payments/renew-booking/' . $booking['id'])) ?>"
                                    class="btn btn-sm btn-warning">Thay đổi</a>
                            </li>
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="card-body">
                        <ul>
                            <li>
                                <p>
                                    Giá vé:
                                    <?= number_format((float) ($booking['schedule']['price']), 0, ",", "."); ?>
                                    VNĐ
                                </p>
                            </li>
                            <li>
                                <p>
                                    Số lượng: <?= $booking['quantity'] ?> vé
                                </p>
                            </li>
                            <li>
                                <p>
                                    Nhà xe: <?= $booking['schedule']['bus']['name'] ?>
                                </p>
                            </li>
                            <li>
                                <p>
                                    Điểm đi: <?= $booking['origin']['name'] ?>
                                </p>
                            </li>
                            <li>
                                <p>
                                    Ngày đi:
                                    <?php echo date('H:i d/m/Y', strtotime($booking['origin']['arrival_time'])); ?>
                                </p>
                            </li>
                            <li>
                                <p>
                                    Điểm đến: <?= $booking['destination']['name'] ?>
                                </p>
                            </li>
                            <li>
                                <p>
                                    Ngày đến:
                                    <?php echo date('H:i d/m/Y', strtotime($booking['destination']['arrival_time'])); ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <p>Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi.</p>
    <a href="<?= esc(base_url('/contact')) ?>" class="button">Liên hệ ngay</a>
</div>

<?= view('emails/layouts/footer') ?>