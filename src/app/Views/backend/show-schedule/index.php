<?= $this->extend('backend/common/layout') ?>

<?= $this->section('content') ?>

<!-- css -->

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
                            <a href="<?= base_url("admin/manage-schedules/update-schedule/" . $schedule['id']) ?>"
                                class="btn btn-info btn-sm" title="Sửa">
                                <i class="fas fa-pencil-alt"></i>
                                Sửa
                            </a>
                            <a href="<?= base_url("admin/manage-schedules/delete-schedule/" . $schedule['id']) ?>"
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
                                                        <?= date('Y-m-d H:i', strtotime($schedule['arrival_time'])); ?>
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

<?= $this->endSection() ?>