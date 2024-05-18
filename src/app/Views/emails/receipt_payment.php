<!-- File: app/Views/emails/receipt_email.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biên lai chuyển tiền</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            line-height: 1;
        }

        /* ol,
        ul {
            list-style: none;
        } */

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }

        .header,
        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
            text-align: left;
        }

        .content h2 {
            color: #333;
        }

        .content p {
            margin: 10px 0;
        }

        .details {
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .details th,
        .details td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            display: inline-block;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Biên lai chuyển tiền</h1>
        </div>
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
                                            <p>Hình ảnh: <font style="color:red">file đính kèm bên dưới.</font> </p>
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
        <div class="footer">
            <p>© <?= date('Y') ?> BusBooking. Tất cả các quyền được bảo lưu.</p>
            <p>Hệ thống gửi thư tự động</p>
        </div>
    </div>
</body>

</html>