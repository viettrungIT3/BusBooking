<div class="container" id="<?= $p_id ?>">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <?= trim($schedule->route['origin']) . ' <i class="fa-solid fa-arrow-right"></i> ' . trim($schedule->route['destination']) ?>
            </h4>
            <div class="card-subtitle mb-2 text-body-secondary d-flex justify-content-between">
                <h5>
                    <?php echo $schedule->bus['name'] ?>
                </h5>

                <div class="price-wrapper">
                    <span class="price">
                        <?= number_format((float) ($schedule->price), 0, ",", "."); ?> VNĐ
                    </span>
                    <?php if ($schedule->price != $schedule->route['listed_price']): ?>
                        &nbsp;
                        <s class="original-price" style>
                            <?= number_format((float) ($schedule->route['listed_price']), 0, ",", "."); ?> VNĐ
                        </s>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-text  mb-1  d-flex justify-content-between">
                <div>
                    Limousine VIP
                    <?= $schedule->bus['seat_number']; ?> ghế
                </div>
                <!-- <div class="numbus"><i class="glyphicon glyphicon-time"></i> 17 chuyến/ngày</div> -->
            </div>
            <div class="mb-1">
                Thời gian đi:
                <b>
                    <?= date('H:i d/m/Y', strtotime($schedule->departure_time)); ?>
                </b>
            </div>
            <div class="mb-1">
                Thời gian đến:
                <b>
                    <?= date('H:i d/m/Y', strtotime($schedule->arrival_time)); ?>
                </b>
            </div>
            <table class="table table-bordered table-hover mb-1">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Trạm</th>
                        <th>Thời gian đến</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($schedule->stop_points as $row) {
                        $row = (object) $row;
                        ?>
                        <tr>
                            <td>
                                <?= $i++; ?>
                            </td>
                            <td>
                                <?= $row->name; ?>
                            </td>
                            <td>
                                <?= date('H:i d/m/Y', strtotime($row->arrival_time)); ?>
                            </td>
                        </tr>
                        <?php
                    } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-warning" id="<?= "collapseBookTicket-" . $p_id ?>-btn"
                    data-toggle="collapse" data-target="#toggle-example">
                    Liên hệ / Đặt vé
                </button>
            </div>
            <hr>
            <?php echo view('frontend/schedules/widgets/schedule-detail.php', [
                'p_id' => "collapseBookTicket-" . $p_id,
                // 'data_list_trip' => $data_list_trip
            ]);
            ?>

        </div>
    </div>
</div>
