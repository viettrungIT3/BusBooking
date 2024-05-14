<div class="card">
    <div class="card-header">
        <h3>Thông tin đặt vé</h3>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <label>Giá vé:</label>
            <input type="text" class="form-control" style="font-size: 0.8rem;"
                value="<?= number_format((float) ($booking['schedule']['price']), 0, ",", "."); ?> VNĐ" disabled>
        </div>
        <div class="mb-2">
            <label>Số lượng:</label>
            <input type="text" class="form-control" style="font-size: 0.8rem;" value="<?= $booking['quantity'] ?> vé"
                disabled>
        </div>
        <div class="mb-2">
            <label>Nhà xe:</label>
            <input type="text" class="form-control" style="font-size: 0.8rem;"
                value="<?= $booking['schedule']['bus']['name'] ?>" disabled>
        </div>
        <div class="mb-2">
            <label>Điểm đi:</label>
            <input type="text" id="origin-name" class="form-control" style="font-size: 0.8rem;"
                value="<?= $booking['origin']['name'] ?>" disabled>
        </div>
        <div class="mb-2">
            <label>Ngày đi:</label>
            <input type="text" id="origin-time" class="form-control" style="font-size: 0.8rem;"
                value="<?php echo formatVietnameseDate(strtotime($booking['origin']['arrival_time'])); ?>" disabled>
        </div>
        <div class="mb-2">
            <label>Điểm đến:</label>
            <input type="text" id="destination-name" class="form-control" style="font-size: 0.8rem;"
                value="<?= $booking['destination']['name'] ?>" disabled>
        </div>
        <div class="mb-2">
            <label>Ngày đến:</label>
            <input type="text" id="destination-time" class="form-control" style="font-size: 0.8rem;"
                value="<?php echo formatVietnameseDate(strtotime($booking['destination']['arrival_time'])); ?>" disabled>
        </div>
        <div class="mt-1 mb-2">
            <label class="form-label fw-bold">Tổng tiền vé:</label>
            <div class="input-group">
                <input type="text" class="form-control fw-bold"
                    value="<?= number_format((float) ($booking['quantity'] * $booking['schedule']['price']), 0, ",", "."); ?> VNĐ"
                    disabled>
            </div>
        </div>
    </div>
</div>