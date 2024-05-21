<?= view('emails/layouts/header', ['title' => 'Thông tin vé xe']) ?>

<div class="content">
    <h3>Chào <?= esc($booking['user']['name'] ?? 'bạn') ?>,</h3>
    <p>Thông tin tin vé của bạn:</p>
    <div class="details">
        <table style="max-width:670px;">
            <tbody>
                <tr>
                    <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                        <p style="font-size:14px;margin:0 0 6px 0;">
                            <span style="font-weight:bold;display:inline-block;min-width:146px">Mã vé: </span>
                            abcd1234567890
                        </p>
                        <p style="font-size:14px;margin:0 0 6px 0;">
                            <span style="font-weight:bold;display:inline-block;min-width:150px">Trạng thái:</span>
                            <b style="color:green;font-weight:normal;margin:0"><?= $status ?></b>
                        </p>
                        <p style="font-size:14px;margin:0 0 6px 0;">
                            <span style="font-weight:bold;display:inline-block;min-width:150px">Tổng tiền:</span>
                            <b style="color:green;font-weight:normal;margin:0">
                                <?= number_format((float) ($booking['schedule']['price'] * $booking['quantity']), 0, ",", "."); ?>
                                VNĐ
                            </b>
                        </p>
                    </td>
                </tr>
                <!-- <tr>
                    <td colspan="2">Thông tin chi tiết vé</td>
                </tr> -->
                <tr>
                    <td style="width:50%;padding:20px;vertical-align:top">
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px">Số lượng</span>
                            <?= $booking['quantity'] ?? '' ?> vé
                        </p>
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px;">Nhà xe</span>
                            Nhà xe: <?= $booking['schedule']['bus']['name'] ?>
                        </p>
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px;">Điểm đi</span>
                            <?= $booking['origin']['name'] ?>
                        </p>
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px;">Thời gian đi.</span>
                            <?php echo date('H:i d/m/Y', strtotime($booking['origin']['arrival_time'])); ?>
                        </p>
                    </td>
                    <td style="width:50%;padding:20px;vertical-align:top">
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px;">Giá vé</span>
                            <?= number_format((float) ($booking['schedule']['price']), 0, ",", "."); ?> VNĐ
                        </p>
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px;">Chuyến xe</span>
                            <?= $booking['schedule']['route']['origin'] . ' - ' . $booking['schedule']['route']['destination'] ?>
                        </p>
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px;">Điểm đến</span>
                            <?= $booking['destination']['name'] ?>
                        </p>
                        <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                            <span style="display:block;font-weight:bold;font-size:13px;">Thời gian đến.</span>
                            <?php echo date('H:i d/m/Y', strtotime($booking['destination']['arrival_time'])); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi.</p>
    <a href="<?= esc(base_url('/contact')) ?>" class="button">Liên hệ ngay</a>
</div>

<?= view('emails/layouts/footer') ?>