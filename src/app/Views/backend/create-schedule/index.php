<?= $this->extend('backend/common/layout') ?>

<?= $this->section('content') ?>

<!-- css -->
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="<?= base_url("plugins/AdminLTE-3.2.0/") ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Thêm lịch trình </h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý lịch trình</a></li>
                        <li class="breadcrumb-item active">Thêm lịch trình</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <!-- Hiển thị thông báo lỗi nếu có -->
            <?php if (isset($validation)): ?>
                <div class="col-12">
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="col-12">
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                </div>
            <?php elseif (session()->getFlashdata('success')): ?>
                <div class="col-12">
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-12">
                <div class="card">
                    <form action="<?= base_url() ?>admin/manage-schedules/create-schedule" method="post">
                        <div class="card-header">
                            <h3 class="card-title">Thêm lịch trình</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="bus-select" class="">Chọn xe</label>
                                    <select id="bus-select" class="form-control" name="bus_id">
                                        <option value="" selected disabled="">-Chọn xe-</option>
                                        <?php foreach ($buses as $row) { ?>
                                            <option value="<?= $row['id'] ?>">
                                                <?= trim($row['name']) . " (" . trim($row['license_plate']) . ")" ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="route-select" class="">Chọn tuyến </label>
                                    <select class="form-control" name="route_id" id="route-select">
                                        <option value="" selected disabled="">-Chọn xe-</option>
                                        <?php foreach ($routes as $row) { ?>
                                            <option value="<?= $row['id'] ?>">
                                                <?= trim($row['origin']) . " ---> " . trim($row['destination']) . " (" . trim(number_format((float) ($row['listed_price']), 0, ",", ".") . "VNĐ") . ")" ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div id="container-time-and-price" class="row" style="display: none;">
                                <!-- Nội dung sẽ được thêm vào đây thông qua JavaScript/jQuery -->
                            </div>
                            <div class="row">
                                <div class="col-12" id="container-stop-points" style="display: none;">
                                    <!-- Nội dung sẽ được thêm vào đây thông qua JavaScript/jQuery -->
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-danger" href="javascript:history.back()">
                                        Quay lại
                                    </a>
                                    <button type="submit" class="btn btn-success float-right" disabled>
                                        Thêm lịch trình
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- InputMask -->
<script src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
    src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
    $(document).ready(function () {
        // Khởi tạo datetimepicker, nếu cần thiết
        // Bạn cần chắc chắn khởi tạo lại các datetimepicker sau khi thêm chúng vào DOM
        function initializeDateTimePickers() {
            $('#departure_time').datetimepicker({
                sideBySide: true,
                format: 'YYYY-MM-DD HH:mm',
                icons: { time: 'far fa-clock' }
            });
            // Lắng nghe sự kiện thay đổi cho datetimepicker của departure_time
            $("#departure_time").on("change.datetimepicker", function (e) {
                // Định dạng và cập nhật giá trị vào input điểm bắt đầu
                var newTime = e.date.format('YYYY-MM-DD HH:mm'); // Chỉnh sửa định dạng thời gian theo yêu cầu của bạn
                $('#container-stop-points').find('input[name="points[][time]"]').first().val(newTime);
                console.log(newTime);
            });

            $('#arrival_time').datetimepicker({
                sideBySide: true,
                format: 'YYYY-MM-DD HH:mm',
                icons: { time: 'far fa-clock' }
            });
            // Lắng nghe sự kiện thay đổi cho datetimepicker của arrival_time
            $("#arrival_time").on("change.datetimepicker", function (e) {
                // Định dạng và cập nhật giá trị vào input điểm bắt đầu
                var newTime = e.date.format('YYYY-MM-DD HH:mm'); // Chỉnh sửa định dạng thời gian theo yêu cầu của bạn
                $('#container-stop-points').find('input[name="points[][time]"]').last().val(newTime);
                console.log(newTime);
            });
        }

        // Hàm tạo và hiển thị nội dung cho #container-time-and-price
        function renderTimeAndPriceContent() {
            var content = `
                <div class="form-group col-12 col-sm-6">
                    <label for="departure_time" class="">Giờ khởi hành</label>
                    <div class="input-group date" id="departure_time" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="departure_time"
                            data-target="#departure_time" required="" />
                        <div class="input-group-append" data-target="#departure_time"
                            data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="arrival_time" class="">Giờ đến</label>
                    <div class="input-group date" id="arrival_time" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="arrival_time"
                            data-target="#arrival_time" required="" />
                        <div class="input-group-append" data-target="#arrival_time"
                            data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-6 col-sm-3">
                    <label for="price-input" class="">Giá</label>
                    <div class="input-group mb-3">
                        <input type="number" id="price-input" class="form-control" name="price" placeholder="Giá" aria-label="Giá"
                            aria-describedby="price-span" required="">
                        <span class="input-group-text" id="price-span">VNĐ</span>
                    </div>
                </div>
            `;

            $('#container-time-and-price').html(content).show();
            initializeDateTimePickers(); // Khởi tạo lại các datetimepicker sau khi chúng được thêm vào DOM
        }

        // Hàm tạo và hiển thị nội dung bảng với điểm đi và điểm đến
        function createAndShowTableContent(startPoint, endPoint) {
            var tableContent = `
            <label for="platbus" class="">Các điểm dừng</label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Điểm dừng</th>
                        <th>Giờ đến</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="text" class="form-control" name="points[][name]" value="${startPoint}" placeholder="${startPoint}" aria-label="${startPoint}" required="" disabled>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="points[][time]" placeholder="Giờ đến" required="" disabled>
                        </td>
                        <td></td> <!-- Không cho phép xóa điểm đi -->
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <input type="text" class="form-control" name="points[][name]" value="${endPoint}" placeholder="${endPoint}" aria-label="${endPoint}" required="" disabled>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="points[][time]" placeholder="Giờ đến" required="" disabled>
                        </td>
                        <td></td> <!-- Không cho phép xóa điểm đến -->
                    </tr>
                </tbody>
                <tfoot>
                    <button type="button" class="btn btn-sm btn-success float-right" id="add-stop-point">Thêm điểm dừng</button>
                </tfoot>
            </table>
        `;

            $('#container-stop-points').html(tableContent).show();
            addStopPointEvent();
        }

        // Hàm thêm sự kiện cho nút "Thêm điểm dừng"
        function addStopPointEvent() {
            $('#add-stop-point').on('click', function () {
                var rowCount = $('#container-stop-points table tbody tr').length;
                // Tạo một hàng mới với số thứ tự là rowCount (vì điểm đến sẽ được dời xuống một vị trí)
                var newRow = `
                    <tr>
                        <td>${rowCount}</td>
                        <td>
                            <input type="text" class="form-control" name="points[${rowCount}][name]" placeholder="Điểm dừng ${rowCount}" aria-label="Điểm dừng ${rowCount}" required="">
                        </td>
                        <td>
                            <div class="input-group date" id="arrival_time_points_${rowCount}" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="points[${rowCount}][time]" placeholder="Giờ đến" 
                                    data-target="#arrival_time_points_${rowCount}" required="" />
                                <div class="input-group-append" data-target="#arrival_time_points_${rowCount}"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm delete-stop-point"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;

                // Nếu không, chèn hàng mới ngay trước hàng cuối cùng
                $(newRow).insertBefore($('#container-stop-points table tbody tr:last'));


                // Cập nhật lại tất cả các hàng để phản ánh chính xác vị trí sau khi chèn
                updateRowTableStopPoints();

                $('#arrival_time_points_' + rowCount).datetimepicker({
                    sideBySide: true,
                    format: 'YYYY-MM-DD HH:mm',
                    icons: { time: 'far fa-clock' }
                });
            });
        }


        function updateRowTableStopPoints() {
            // Cập nhật tên và ID cho các ô input và datetimepicker trong mỗi hàng
            $('#container-stop-points table tbody tr').each(function (index) {
                // Cập nhật số thứ tự dòng
                $(this).find('td:first').text(index + 1);

                // Cập nhật thuộc tính name cho ô input điểm dừng
                $(this).find('input[type="text"]').first().attr("name", `points[${index}][name]`);
                $(this).find('input[type="text"]').last().attr("name", `points[${index}][time]`);
            });
        }

        // Sự kiện xóa hàng
        $('body').on('click', '.delete-stop-point', function () {
            $(this).closest('tr').remove();
            updateRowTableStopPoints();
        });

        // Khi lựa chọn route-select thay đổi
        $('#route-select').change(function () {
            var selectedOption = $.trim($(this).find('option:selected').text());
            var points = selectedOption.split(" ---> ");
            var startPoint = points.length > 0 ? points[0] : "";
            var endPoint = points.length > 1 ? points[1].split(' (')[0] : ""; // Cắt bỏ phần giá vé
            var priceText = points.length > 1 ? points[1].split(' (')[1] : ""; // Lấy phần giá vé

            // Làm sạch chuỗi giá vé để loại bỏ ký tự không mong muốn
            // Ví dụ, chuyển "140.000VNĐ)" thành "140000"
            var price = priceText.replace(/[^\d]/g, '');

            if ($(this).val() !== "") {
                $('#container-time-and-price').empty();
                renderTimeAndPriceContent(); // Render nội dung khi có một lựa chọn được chọn

                // Cập nhật giá trị cho ô input giá vé
                // Đảm bảo bạn có một input với id là 'price-input' trong hàm renderTimeAndPriceContent()
                $('#price-input').val(price);

                // Xóa nội dung hiện tại và tạo mới với điểm đi và điểm đến
                $('#container-stop-points').empty();
                createAndShowTableContent(startPoint, endPoint);
            } else {
                $('#container-time-and-price').hide(); // Ẩn nếu không có lựa chọn nào
                $('#container-stop-points').hide();
            }
        });


        // Lắng nghe sự kiện thay đổi trên tất cả các input và select trong form
        $('input, select').change(function () {
            // Khi có một thay đổi, bỏ trạng thái disabled của nút submit
            $('button[type="submit"]').prop('disabled', false);
        });
    });


</script>

<?= $this->endSection() ?>