<?php
$data_list_trip = [
    [
        'id' => 1,
        'departure_time' => '05:00',
        'destination_time' => '06:30',
        'duration' => '1h30'
    ],
    [
        'id' => 2,
        'departure_time' => '06:00',
        'destination_time' => '07:30',
        'duration' => '1h30'
    ],
    [
        'id' => 3,
        'departure_time' => '07:00',
        'destination_time' => '08:30',
        'duration' => '1h30'
    ],
    [
        'id' => 4,
        'departure_time' => '08:00',
        'destination_time' => '09:30',
        'duration' => '1h30'
    ],
    [
        'id' => 5,
        'departure_time' => '09:00',
        'destination_time' => '10:30',
        'duration' => '1h30'
    ],
    [
        'id' => 6,
        'departure_time' => '10:00',
        'destination_time' => '11:30',
        'duration' => '1h30'
    ],
    [
        'id' => 7,
        'departure_time' => '11:00',
        'destination_time' => '12:30',
        'duration' => '1h30'
    ],
    [
        'id' => 8,
        'departure_time' => '12:00',
        'destination_time' => '13:30',
        'duration' => '1h30'
    ],
    [
        'id' => 9,
        'departure_time' => '13:00',
        'destination_time' => '14:30',
        'duration' => '1h30'
    ],
    [
        'id' => 10,
        'departure_time' => '14:00',
        'destination_time' => '15:30',
        'duration' => '1h30'
    ],
    [
        'id' => 11,
        'departure_time' => '15:00',
        'destination_time' => '16:30',
        'duration' => '1h30'
    ],
    [
        'id' => 12,
        'departure_time' => '16:00',
        'destination_time' => '17:30',
        'duration' => '1h30'
    ],
    [
        'id' => 13,
        'departure_time' => '17:00',
        'destination_time' => '18:30',
        'duration' => '1h30'
    ],
    [
        'id' => 14,
        'departure_time' => '18:00',
        'destination_time' => '19:30',
        'duration' => '1h30'
    ],
    [
        'id' => 15,
        'departure_time' => '19:00',
        'destination_time' => '20:30',
        'duration' => '1h30'
    ],
    [
        'id' => 16,
        'departure_time' => '20:00',
        'destination_time' => '21:30',
        'duration' => '1h30'
    ],
    [
        'id' => 17,
        'departure_time' => '21:00',
        'destination_time' => '22:30',
        'duration' => '1h30'
    ]
];
?>

<div class="collapse" id="<?= $p_id ?>">
    <div class="card card-body">
        <div class="info">

            <!-- Images -->
            <div class="mb-3 d-flex justify-content-center align-items-center">
                <img src="images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-01.jpg" style="height: 100px; margin: 0 4px;" alt="">
                <img src="images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-02.jpg" style="height: 100px; margin: 0 4px;" alt="">
                <img src="images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-03.jpg" style="height: 100px; margin: 0 4px;" alt="">
                <img src="images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-04.jpg" style="height: 100px; margin: 0 4px;" alt="">
                <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#showImagesModal">Xem thêm</a>
            </div>

            <!-- Modal for -->
            <div class="modal fade" id="showImagesModal" tabindex="-1" aria-labelledby="showImagesModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h1 class="modal-title fs-5" id="showImagesModalLabel">Modal
                                title
                            </h1> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- main slider carousel -->
                            <?php echo
                                view('frontend/partials/slider.php', [
                                    'p_id' => 'slider_1',
                                    'p_images' => [
                                        "images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-01.jpg",
                                        "images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-02.jpg",
                                        "images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-03.jpg",
                                        "images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-04.jpg",
                                        "images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-05.jpg",
                                        "images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-06.jpg",
                                        "images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-07.jpg"
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tiện nghi -->
            <div class="card mb-3">
                <div class="d-flex justify-content-center align-items-center benefit">
                    <div class="mx-1 my-2 p-2 text-center">
                        <span class="fas fa-wifi" title="Wifi"></span>
                        <div>Wifi</div>
                    </div>
                    <div class="mx-1 my-2 p-2 text-center">
                        <span class="fa-brands fa-usb" title="Cổng sạc USB"></span>
                        <div>Cổng sạc USB</div>
                    </div>
                    <div class="mx-1 my-2 p-2 text-center">
                        <span class="fas fa-tv" title="LCD"></span>
                        <div>LCD</div>
                    </div>
                    <div class="mx-1 my-2 p-2 text-center">
                        <span class="fas fa-coffee" title="Nước uống"></span>
                        <div>Nước uống</div>
                    </div>
                    <div class="mx-1 my-2 p-2 text-center">
                        <span class="fas fa-ice-cream" title="Khăn lạnh"></span>
                        <div>Khăn lạnh</div>
                    </div>
                    <div class="mx-1 my-2 p-2 text-center">
                        <span class="fas fa-snowflake" title="Điều hòa"></span>
                        <div>Điều hòa</div>
                    </div>
                    <div class="mx-1 my-2 p-2 text-center">
                        <span class="fas fa-bed" title="Chăn đắp"></span>
                        <div>Chăn đắp</div>
                    </div>
                </div>
            </div>

            <!-- Thông tin vé -->

            <div class="mb-3">
                <h5>Giá vé: </h5>
                <div class="price-wrapper">
                    Giá vé:
                    <span class="price"> 160.000 đ/vé</span>
                </div>
            </div>
            <div class="mb-3">
                <h5>Chính sách vé: </h5>
                <ul type="">
                    <li> - Đón trả tận nơi Phú Bình phụ thu 40.000đ </li>
                </ul>
            </div>
            <div class="mb-3">
                <h5>Ngày đi: </h5>
                <div class="price-wrapper">
                    <span class="price"> Thứ Bẩy, 02-03-2024</span>
                </div>
            </div>

            <div class="container">
                <div class="tab-content">
                    <ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Chọn chuyến</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">Địa
                                điểm đón trả</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">

                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <table id="table-list-trip"
                                        class="table table-responsive table-hover table-borderless accordion">
                                        <thead>
                                            <tr>
                                                <th>Giờ đi</th>
                                                <th>Giờ đến</th>
                                                <th>Thời gian đi</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_list_trip as $trip): ?>
                                                <tr class="border border-bottom-0">
                                                    <td>
                                                        <?php echo $trip['departure_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $trip['destination_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $trip['duration'] ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning"
                                                            id="collapseTrip<?= $trip['id'] ?>-btn" data-toggle="collapse"
                                                            data-target="#toggle-example">
                                                            Chọn vé
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr class="collapse border-start border-end"
                                                    id="collapseTrip<?= $trip['id'] ?>">
                                                    <td colspan="999">
                                                        <h5>Chọn số lượng vé</h5>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6>Số vé: </h6>
                                                            <div class="input-group" style="max-width: 100px;">
                                                                <input type="number" class="form-control" placeholder="0"
                                                                    min="0">
                                                                <span class="input-group-text">vé</span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6>Tổng tiền: </h6>
                                                            <span id="total-price" class="price">0đ</span>
                                                        </div>
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            <button class="btn btn-warning float-right">
                                                                Tiếp tục
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <script>
                                                    $(document).ready(function () {
                                                        $("#collapseTrip<?= $trip['id'] ?>-btn").click(function () {
                                                            $(this).text($(this).text() === 'Đóng' ? 'Chọn vé' : 'Đóng');
                                                            $("#collapseTrip<?= $trip['id'] ?>").collapse('toggle'); // toggle collapse
                                                        });
                                                    });
                                                </script>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">...</div>
                    </div>
                </div>
            </div>
            <script>
                function toggleTab(e) {
                    var hrefVal = $(e).attr('href');
                    $('.nav-tabs li').removeClass('active');
                    $('.nav-tabs li[data-active="' + hrefVal + '"]').addClass('active');
                }
            </script>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $("#<?= $p_id ?>-btn").click(function () {
            $(this).text($(this).text() === 'Đóng' ? 'Liên hệ / Đặt vé' : 'Đóng');
            $("#<?= $p_id ?>").collapse('toggle'); // toggle collapse
        });
    });
</script>