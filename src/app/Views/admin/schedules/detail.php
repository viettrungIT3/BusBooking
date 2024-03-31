<?= $this->extend('admin/common/layout') ?>

<?= $this->section('content') ?>

<!-- css -->
<!-- Include Date Range Picker -->
<link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css') ?>">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Xem chi tiết lịch trình </h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý lịch trình</a></li>
                        <li class="breadcrumb-item active">Xem chi tiết</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Lịch trình
                            <?= '[' . $schedule['id'] . ']' ?>
                        </h3>
                        <div class="card-tools">

                            <!-- Nút mở modal -->
                            <a href="#copyScheduleModal" data-toggle="modal" data-id="<?= $schedule['id'] ?>"
                                class="btn btn-secondary btn-sm mb-1 open-copyScheduleModal" title="Tạo bản sao">
                                <i class="fas fa-copy"></i>
                                Nhân bản
                            </a>
                            <a href="<?= base_url("admin/schedules/update/" . $schedule['id']) ?>"
                                class="btn btn-info btn-sm" title="Sửa">
                                <i class="fas fa-pencil-alt"></i>
                                Sửa
                            </a>
                            <a href="<?= base_url("admin/schedules/delete/" . $schedule['id']) ?>"
                                class="btn btn-danger btn-sm" title="Xóa">
                                <i class="fas fa-trash"></i>
                                Xóa
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul>
                                    <li>
                                        <p>
                                            Xe:
                                            <b>
                                                <?= trim($bus['name']) . " (" . trim($bus['license_plate']) . ")" ?>
                                            </b>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Tuyến đường:
                                            <b>
                                                <?= trim($route['origin']) . " ---> " . trim($route['destination']) ?>
                                            </b>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Thời gian đi:
                                            <b>
                                                <?= date('Y-m-d H:i', strtotime($schedule['departure_time'])); ?>
                                            </b>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Thời gian đến:
                                            <b>
                                                <?= date('Y-m-d H:i', strtotime($schedule['arrival_time'])); ?>
                                            </b>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Giá ve:
                                            <b>
                                                <?= number_format((float) ($schedule['price']), 0, ",", ".") . "VNĐ" ?>
                                            </b>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Các điểm dừng:
                                        </p>
                                    </li>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Điểm dừng</th>
                                                <th>Giờ đến</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $i = 1;
                                            foreach ($stop_points as $row) {
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
                                                        <?= date('Y-m-d H:i', strtotime($row->arrival_time)); ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="copyScheduleModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo bản sao lịch trình</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="copyScheduleForm" action="<?= base_url('admin/schedules/clones') ?>" method="post">
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Lưu ý:</h5>
                        <ul class="mb-0">
                            <li>
                                Khoảng thời gian được chọn sẽ áp dụng cho tất cả các điểm dừng và thông tin lịch trình
                                của bản sao.
                            </li>
                            <li>
                                Bản sao lịch trình sẽ được tạo với tất cả thông tin giống hệt lịch trình gốc, bao gồm cả
                                các điểm dừng và giá vé, nhưng với khoảng thời gian mới được chỉ định.
                            </li>
                            <li>
                                Hãy đảm bảo rằng khoảng thời gian mới không gây ra xung đột lịch trình với các chuyến đi
                                khác.
                            </li>
                            <li>
                                Việc tạo bản sao lịch trình nên được thực hiện một cách cẩn thận để tránh nhầm lẫn hoặc
                                trùng lặp không cần thiết.
                            </li>
                        </ul>
                    </div>

                    <input type="hidden" id="scheduleId" name="scheduleId" value="">
                    <div class="form-group">
                        <label>Chọn khoảng thời gian:</label>
                        <input type="text" class="form-control" id="dateRangePicker" name="dateRange" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tạo bản sao</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js -->
<script src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js') ?>"></script>


<!-- Page specific script -->
<script>
    $(function () {

        // Khởi tạo Date Range Picker
        $('#dateRangePicker').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: "Áp dụng",
                cancelLabel: "Hủy bỏ",
                customRangeLabel: "Tùy chỉnh", // Thay đổi chữ "Custom Range" thành "Tùy chỉnh"
            },
            startDate: moment().add(1, 'days'), // Khoảng thời gian mặc định bắt đầu từ ngày hiện tại
            endDate: moment().add(1, 'days'), // Khoảng thời gian kết thúc sau 29 ngày
            ranges: {
                'Ngày mai': [moment().add(1, 'days'), moment().add(1, 'days')],
                '3 ngày tới': [moment().add(1, 'days'), moment().add(3, 'days')],
                '7 ngày tới': [moment().add(1, 'days'), moment().add(7, 'days')],
                '1 tháng tới': [moment().add(1, 'days'), moment().add(1, 'month')],
                '3 tháng tới': [moment().add(1, 'days'), moment().add(3, 'months')],
                '6 tháng tới': [moment().add(1, 'days'), moment().add(6, 'months')],
            }
        }, function (start, end, label) {
            // Có thể sử dụng callback này để xử lý khi người dùng chọn một khoảng thời gian
            console.log("Bạn đã chọn: " + start.format('YYYY-MM-DD') + ' đến ' + end.format('YYYY-MM-DD'));
        });


        // Khi nút mở modal được click
        $('.open-copyScheduleModal').click(function () {
            var scheduleId = $(this).data('id'); // Lấy ID từ attribute data-id của nút
            $('#scheduleId').val(scheduleId); // Gán ID vào input hidden trong form// Cập nhật tiêu đề modal
            $('#copyScheduleModal .modal-title').text('Tạo bản sao lịch trình #' + scheduleId);
            $('#copyScheduleModal').modal('show'); // Hiển thị modal
        });
    });

</script>

<?= $this->endSection() ?>