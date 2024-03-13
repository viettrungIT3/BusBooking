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

<!-- Link css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/frontend/css/bus-detail.css">

<!-- banner -->
<div class="ct-banner">
    <div class="ct-banner_background parallax-window" style="background-image: url('<?php echo base_url() ?>/images/banner_bus_detail.jpg')">
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
                    <li class="breadcrumb-item active">Giỏ hàng & Thanh toán</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content-main">
    <div class="container">
        <div class="row mt-3 mb-5">
            <div class="col-12 col-sm-8 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Hà Nội đến Thái Nguyên</h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <h4 class="mb-3">Chọn điểm đón, trả</h4>
                            <div class="mb-3">
                                <?php foreach ($data_list_trip as $trip): ?>
                                    <div class="mb-3">
                                        <h6>
                                            <?= $trip['departure_stations']['label'] ?>
                                        </h6>
                                        <ul>
                                            <?php foreach ($trip['departure_stations']['stations'] as $station): ?>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="station_depart"
                                                            id="<?= $station['id'] ?>"
                                                            value="<?= $station['time'] . ' - ' . $station['destination_time'] ?>">
                                                        <label class="form-check-label" for="<?= $station['id'] ?>">
                                                            <?= $station['time'] . ' - ' . $station['destination_time'] ?>
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <h6>
                                            <?= $trip['destination_stations']['label'] ?>
                                        </h6>
                                        <ul>
                                            <?php foreach ($trip['destination_stations']['stations'] as $station): ?>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="station_destination"
                                                            id="<?= $station['id'] ?>"
                                                            value="<?= $station['time'] . ' - ' . $station['destination_time'] ?>">
                                                        <label class="form-check-label" for="<?= $station['id'] ?>">
                                                            <?= $station['time'] . ' - ' . $station['destination_time'] ?>
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
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
                <div class="card">
                    <div class="card-header">
                        <h3>Thông tin đặt xe</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label>Giá vé:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="120.000 đ" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Số lượng:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="1 vé" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Nhà xe:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="Đức Phúc Limousine" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Loại xe:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="Limousine VIP 9 ghế" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Bến đi:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="BigC Hà Đông" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Ngày đi:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="Thứ Sáu, 15-03-2024" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Bến đến:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="Nút giao Sông Công" disabled>
                        </div>
                        <div class="mb-2">
                            <label>Ngày đến:</label>
                            <input type="text" class="form-control" style="font-size: 0.8rem;" value="Thứ Sáu, 15-03-2024" disabled>
                        </div>
                        <div class="mt-1 mb-2">
                            <label class="form-label fw-bold">Tổng tiền vé:</label>
                            <div class="input-group">
                                <input type="text" class="form-control fw-bold" value="120.000 đ" disabled>
                                <a href="/checkout/info" class="btn btn-primary" type="button">Đặt vé</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>