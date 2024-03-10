<div class="container" id="<?= $p_id ?>">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Đức Phúc Limousine
            </h5>
            <h6 class="card-subtitle mb-2 text-body-secondary d-flex justify-content-between">
                <?php echo
                    view('frontend/partials/star_rating.php', [
                        'name' => 'rating-3',
                        'value' => '5',
                        'is_disabled' => true
                    ]);
                ?>

                <div class="price-wrapper">
                    <span class="price">160.000 đ</span>
                    &nbsp;
                    <s class="original-price" style>200.000 đ</s>
                </div>
            </h6>
            <div class="card-text  mb-2  d-flex justify-content-between">
                <p>
                    Limousine VIP 9 ghế
                </p>
                <div class="numbus"><i class="glyphicon glyphicon-time"></i> 17 chuyến/ngày</div>
            </div>
            <div class=" mb-2 ">
                <i class="fa-solid fa-location-arrow"></i>
                <b>Đón 09 quận Nội Thành</b> &nbsp;
                <i class="fa-solid fa-circle-info" style="font-size: 0.66rem;" data-toggle="tooltip"
                    data-placement="bottom"
                    title="Đón trả tận nơi miễn phí 09 quận Nội thành (Hoàn Kiếm, Ba Đình, Tây Hồ, Đống Đa, Mỹ Đình, Cầu Giấy, Thanh Xuân, Hoàng Mai, Hai Bà Trưng, Long Biên)"></i>
            </div>
            <div class="mb-2">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                <span id="schedule_duration10282">2h0'</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2 ">
                <div>
                    <i class="fa-solid fa-map-marker-alt"></i>
                    <b> Trả tận nơi Thái Nguyên</b> &nbsp;
                    <i class="fa-solid fa-circle-info" style="font-size: 0.66rem;" data-toggle="tooltip"
                        data-placement="bottom" title="Đón trả tận nơi thành phố Thái Nguyên"></i>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-warning" id="<?= "collapseBookTicket-" . $p_id ?>-btn"
                    data-toggle="collapse" data-target="#toggle-example">
                    Liên hệ / Đặt vé
                </button>
            </div>
            <hr>
            <?php echo view('frontend/tickets/widgets/collapse-book-ticket.php', [
                'p_id' => "collapseBookTicket-" . $p_id,
                // 'data_list_trip' => $data_list_trip
            ]);
            ?>

        </div>
    </div>
</div>