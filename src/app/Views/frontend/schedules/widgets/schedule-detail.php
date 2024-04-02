<div class="collapse" id="<?= $p_id ?>">
    <div class="card card-body">
        <div class="info">

            <!-- Images -->
            <div class="mb-3 d-flex justify-content-center align-items-center">
                <img src="<?php echo base_url() ?>/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-01.jpg"
                    style="height: 100px; margin: 0 4px;" alt="">
                <img src="<?php echo base_url() ?>/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-02.jpg"
                    style="height: 100px; margin: 0 4px;" alt="">
                <img src="<?php echo base_url() ?>/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-03.jpg"
                    style="height: 100px; margin: 0 4px;" alt="">
                <img src="<?php echo base_url() ?>/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-04.jpg"
                    style="height: 100px; margin: 0 4px;" alt="">
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
                                        base_url() . "/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-01.jpg",
                                        base_url() . "/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-02.jpg",
                                        base_url() . "/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-03.jpg",
                                        base_url() . "/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-04.jpg",
                                        base_url() . "/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-05.jpg",
                                        base_url() . "/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-06.jpg",
                                        base_url() . "/images/xe-duc-phuc-limousine-thai-nguyen/1709783165_xe-duc-phuc-limousine-thai-nguyen-07.jpg"
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tiện nghi -->
            <div class="alert alert-success mb-3">
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

            <div class="alert alert-info mb-3">
                <h4>Chính sách vé: </h4>
                <ul type="circle">
                    <li> - Đón trả tận nơi Phú Bình phụ thu 40.000đ </li>
                </ul>
            </div>

            <?php
            // Chuyển đổi thời gian khởi hành sang timestamp và trừ đi 3 tiếng (10800 giây)
            $thresholdTime = strtotime($schedule->departure_time) - 10800;

            // Lấy thời gian hiện tại dưới dạng timestamp
            $currentTime = time();

            // So sánh thời gian
            if ($currentTime > $thresholdTime):
                ?>
                <div class="alert alert-danger mb-3" role="alert">
                    <h5 class="alert-heading">Liên hệ!</h5>
                    <p>
                        Chuyến xe đã gần hết vé/hết giờ đặt<br>Quý khách vui lòng liên hệ tổng đài để đặt vé.
                    </p>
                    <hr>
                    <p>
                        <label>(07h-22h)</label> </span>
                        <b>
                            <a href="tel:0903223030">090 322 3030</a>
                        </b>
                        <br>
                        <label>(07h-22h)</label>
                        <b>
                            <a href="tel:02471002020">024 7100 2020</a>
                        </b>
                        <br>
                        <label>(07h-22h)</label>
                        <b>
                            <a href="tel:0898558000">089 855 8000</a>
                        </b>
                    </p>
                </div>

            <?php else: ?>

                <div class="alert alert-warning" role="alert">
                    <h5 class="alert-heading">Đặt vé</h5>

                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Số vé: </h6>
                        <div class="input-group" style="max-width: 100px;">
                            <input id="num-ticket-<?= $p_id ?>" type="number" class="form-control" placeholder="0" min="0">
                            <span class="input-group-text">vé</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Tổng tiền: </h6>
                        <span id="total-price-<?= $p_id ?>" class="price">0đ</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end align-items-center">
                        <button id="btn-continue-<?= $p_id ?>" class="btn btn-warning float-right">
                            Tiếp tục
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {

        $('#btn-continue-<?= $p_id ?>').prop('disabled', true);

        $('#num-ticket-<?= $p_id ?>').change(function () {
            let num = $('#num-ticket-<?= $p_id ?>').val();
            let price = <?= $schedule->price; ?>;
            let total = (num * price).toLocaleString('vi', { style: 'currency', currency: 'VND' });;
            $('#total-price-<?= $p_id ?>').text(total);

            if (num > 0) {
                $('#btn-continue-<?= $p_id ?>').prop('disabled', false);
            } else
                $('#btn-continue-<?= $p_id ?>').prop('disabled', true);
        });

        $('#btn-continue-<?= $p_id ?>').click(function () {
            console.log(1);
        })

        // Sự kiện click cho các nút có thể mở/đóng các phần tử collapse
        $("#<?= $p_id ?>-btn").click(function () {
            // Đóng tất cả các phần tử collapse
            $("#container-schedules .collapse:not(#<?= $p_id ?>").collapse('hide');

            // Cập nhật lại văn bản của nút dựa trên trạng thái mới
            $(this).text($(this).text() === 'Đóng' ? 'Liên hệ / Đặt vé' : 'Đóng');

            // toggle collapse
            $("#<?= $p_id ?>").collapse('toggle');
        });
    });

</script>