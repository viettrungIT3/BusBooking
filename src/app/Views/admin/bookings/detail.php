<?= $this->extend('admin/common/layout') ?>

<?= $this->section('content') ?>

<!-- css -->

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Xem chi tiết đặt chỗ </h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý đặt chỗ</a></li>
                        <li class="breadcrumb-item active">Xem chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Trạng thái đặt chỗ</span>
                        <span class="info-box-number text-center text-muted mb-0"><?= $booking['status'] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Trạng thái thanh toán</span>
                        <span
                            class="info-box-number text-center text-muted mb-0"><?= $booking['payment_status'] ?? 'pending' ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Số chỗ còn trống</span>
                        <!-- TODO: Trả về số chỗ ngồi còn trống -->
                        <span class="info-box-number text-center text-muted mb-0">???</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card card-primary ">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin đặt chỗ</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?= $booking['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Số lượng</td>
                                                    <td><?= $booking['quantity'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Ghi chú</td>
                                                    <td><?= $booking['notes'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Trạng thái</td>
                                                    <td><?= $booking['status'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Thời gian tạo</td>
                                                    <td><?= $booking['created_at'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Thời gian cập nhật</td>
                                                    <td><?= $booking['updated_at'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-secondary ">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin thanh toán</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Hình thức</td>
                                                    <td><?= $payment['payment_method']['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kiểu</td>
                                                    <td><?= $payment['payment_method']['type'] ?></td>
                                                </tr>
                                                <?php if ($payment['image']): ?>
                                                    <tr>
                                                        <td>Hình ảnh</td>
                                                        <td><img src="<?= base_url($payment['image']) ?>" alt=""
                                                                width="200"></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <tr>
                                                    <td>Trạng thái</td>
                                                    <td><?= $payment['status'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Thời gian tạo</td>
                                                    <td><?= $payment['created_at'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-secondary ">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin chuyến đi</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Giá vé</td>
                                                    <td><?= number_format((float) ($schedule['price']), 0, ",", ".") . "VNĐ" ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Chuyến xe</td>
                                                    <td><?= $schedule['route']['origin'] . ' -> ' . $schedule['route']['destination'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Thời gian đi</td>
                                                    <td><?= $schedule['departure_time'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Thời gian đến</td>
                                                    <td><?= $schedule['arrival_time'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Các điểm đi qua</td>
                                                    <td>
                                                        <?php
                                                        $stopPoints = $schedule['stop_points'];
                                                        $pointsString = implode(" -> ", array_map(function ($point) {
                                                            return $point['name'];
                                                        }, $stopPoints));
                                                        echo $pointsString;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Chi tiết</td>
                                                    <td><a href="<?= base_url("admin/schedules/show/" . $schedule['id']) ?>"
                                                            target="_blank">tại đây</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card card-info ">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin xe</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Tên</td>
                                                    <td><?= $schedule['bus']['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Biển số</td>
                                                    <td><?= $schedule['bus']['license_plate'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tổng số chỗ ngồi</td>
                                                    <td><?= $schedule['bus']['seat_number'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Số chỗ ngồi còn chống</td>
                                                    <!-- TODO: Trả về số chỗ ngồi conf trống -->
                                                    <td><?= $schedule['bus']['seat_number'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Chi tiết</td>
                                                    <td><a href="<?= base_url("admin/bus/view/" . $schedule['bus']['id']) ?>"
                                                            target="_blank">tại đây</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-info ">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin người đặt</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Tên</td>
                                                    <td><?= $user['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?= $user['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td><?= $user['phone'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ</td>
                                                    <td><?= $user['address'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tác vụ</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form
                                    action="<?= base_url('/admin/bookings/update_booking_status/' . $booking['id']) ?>"
                                    method="post" id="bookingStatusUpdateForm">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <h4 class="info-box-text text-muted">Trạng thái đặt chỗ:
                                                <?= $booking['status'] ?>
                                            </h4>
                                            <p class="">Bạn có muốn thay đổi trạng thái sang:
                                                <select name="new_booking_status" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example" name="status"
                                                    onchange="submitBookingForm()">
                                                    <?php foreach ($meta_data['booking_status'] as $key => $value): ?>
                                                        <option value="<?= $key ?>" <?= $key == $booking['status'] ? 'selected disabled' : '' ?>>
                                                            <?= $key . ': ' . $value ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </p>
                                        </div>
                                    </div>
                                </form>

                                <form
                                    action="<?= base_url('/admin/bookings/update_payment_status/' . $booking['id']) ?>"
                                    method="post" id="paymentStatusUpdateForm">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <h4 class="info-box-text text-muted">Trạng thái thanh toán:
                                                <?= $payment['status'] ?>
                                            </h4>
                                            <p class="">Bạn có muốn thay đổi trạng thái thanh toán sang:
                                                <select name="new_payment_status" class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example" name="status"
                                                    onchange="submitPaymentForm()">
                                                    <?php foreach ($meta_data['payment_status'] as $key => $value): ?>
                                                        <option value="<?= $key ?>" <?= $key == $payment['status'] ? 'selected disabled' : '' ?>>
                                                            <?= $key . ': ' . $value ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <script>
                                function submitBookingForm() {
                                    var form = document.getElementById('bookingStatusUpdateForm');
                                    form.submit();
                                }

                                function submitPaymentForm() {
                                    var form = document.getElementById('paymentStatusUpdateForm');
                                    form.submit();
                                }
                            </script>

                            <!-- <div class="col-12">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <h4 class="info-box-text text-muted">Trạng thái thanh toán :
                                            <?= $payment['status'] ?></h4>
                                        <p class="">Bạn có muốn thay đổi trạng thái sang:
                                            <select class="form-select form-select-sm"
                                                aria-label=".form-select-sm example">
                                                <?php foreach ($meta_data['payment_status'] as $key => $value): ?>
                                                    <option value="<?= $key ?>" <?= $key == $payment['status'] ? 'selected disabled' : '' ?>>
                                                        <?= $key . ': ' . $value ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>