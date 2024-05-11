<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<!-- Link css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/frontend/css/bus-detail.css">

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
                    <li class="breadcrumb-item active">Đặt chỗ</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="alert alert-danger">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <form action="/bookings/create" method="post">
            <div class="row mt-3 mb-5">
                <div class="col-12 col-sm-8 mb-2">
                    <div class="card">
                        <div class="card-header">
                            <h3><?= trim($schedule['route']['origin']) . ' <i class="fa-solid fa-arrow-right"></i> ' . trim($schedule['route']['destination']) ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <h4 class="mb-3">Chọn điểm đón, trả</h4>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <h6>
                                            Điểm đi <?= session('bookings')['origin'] ?>
                                        </h6>
                                        <ul>
                                            <?php foreach ($schedule['stop_points'] as $point): ?>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="origin"
                                                            id="origin-<?= $point['id'] ?>" value="<?= $point['id'] ?>"
                                                            data-name="<?= $point['name'] ?>"
                                                            data-time="<?= strtotime($point['arrival_time']) ?>"
                                                            <?= $point['name'] == session('bookings')['origin'] ? 'checked' : '' ?> required>
                                                        <label class="form-check-label" for="origin-<?= $point['id'] ?>">
                                                            <?= $point['name'] . ' (' . date('H:i d-m-Y', strtotime($point['arrival_time'])) . ')' ?>
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <h6>
                                            Điểm đến
                                        </h6>
                                        <ul>
                                            <?php foreach ($schedule['stop_points'] as $point): ?>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="destination"
                                                            id="destination-<?= $point['id'] ?>" value="<?= $point['id'] ?>"
                                                            data-name="<?= $point['name'] ?>"
                                                            data-time="<?= strtotime($point['arrival_time']) ?>"
                                                            <?= $point['name'] == session('bookings')['destination'] ? 'checked' : '' ?> required>
                                                        <label class="form-check-label"
                                                            for="destination-<?= $point['id'] ?>">
                                                            <?= $point['name'] . ' (' . date('H:i d-m-Y', strtotime($point['arrival_time'])) . ')' ?>
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-3">Ghi chú</h4>
                                    <div class="mb-3">
                                        <textarea name="note" cols="50" rows="2" maxlength="50" id="note"
                                            class="form-control"
                                            placeholder="Các yêu cầu riêng của bạn (nếu có). Việc đáp ứng các yêu cầu này sẽ phụ thuộc vào tình trạng và chính sách từng hãng xe."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-danger-subtle">
                            <h4 class="price">* Lưu ý</h4>
                            <div class="note">
                                - Bạn cần đến trước 30 phút để sắp xếp hành lý.
                                <br>
                                - Thời gian di chuyển của xe có thể xê dịch phụ thuộc vào tình trạng giao thông thực tế
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4 mb-2">
                    <div class="card" id="card-booking">
                        <div class="card-header">
                            <h3>Thông tin đặt vé</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Giá vé:</label>
                                <input type="text" class="form-control" style="font-size: 0.8rem;"
                                    value="<?= number_format((float) ($schedule['price']), 0, ",", "."); ?> VNĐ"
                                    disabled>
                            </div>
                            <div class="mb-2">
                                <label>Số lượng:</label>
                                <input type="text" class="form-control" style="font-size: 0.8rem;"
                                    value="<?= session('bookings')['quantity'] ?> vé" disabled>
                            </div>
                            <div class="mb-2">
                                <label>Nhà xe:</label>
                                <input type="text" class="form-control" style="font-size: 0.8rem;"
                                    value="<?= $schedule['bus']['name'] ?>" disabled>
                            </div>
                            <div class="mb-2">
                                <label>Điểm đi:</label>
                                <input type="text" id="origin-name" class="form-control" style="font-size: 0.8rem;"
                                    value="BigC Hà Đông" disabled>
                            </div>
                            <div class="mb-2">
                                <label>Ngày đi:</label>
                                <input type="text" id="origin-time" class="form-control" style="font-size: 0.8rem;"
                                    value="Thứ Sáu, 15-03-2024" disabled>
                            </div>
                            <div class="mb-2">
                                <label>Điểm đến:</label>
                                <input type="text" id="destination-name" class="form-control" style="font-size: 0.8rem;"
                                    value="Nút giao Sông Công" disabled>
                            </div>
                            <div class="mb-2">
                                <label>Ngày đến:</label>
                                <input type="text" id="destination-time" class="form-control" style="font-size: 0.8rem;"
                                    value="Thứ Sáu, 15-03-2024" disabled>
                            </div>
                            <div class="mt-1 mb-2">
                                <label class="form-label fw-bold">Tổng tiền vé:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control fw-bold"
                                        value="<?= number_format((float) ($schedule['price']), 0, ",", "."); ?> VNĐ"
                                        disabled>
                                    <button type="submit" class="btn btn-primary" type="button">Tiếp tục</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="<?= base_url() ?>/assets/js/frontend/bookings/check.js"></script>

<?= $this->endSection() ?>