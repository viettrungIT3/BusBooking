<?= $this->extend('admin/common/layout') ?>

<?= $this->section('content') ?>

<!-- css -->
<!-- DataTables -->
<link rel="stylesheet"
    href="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet"
    href="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý thanh toán</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý thanh toán</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content-main">
        <div class="container-fluid">
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
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="col-12">
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <!-- DataTales Example -->
            <!-- Log on to codeastro.com for more projects -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h2 class="card-title">
                    </h2>
                    <div class="card-tools">
                        <a href="<?= base_url('/admin/payment-methods/create') ?>" type="button"
                            class="btn btn-success pull-right">
                            Thêm phương thức thanh toán mới
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="table-view" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Hình ảnh</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paymentMethods as $method): ?>
                                    <tr>
                                        <td><?= $method['id'] ?></td>
                                        <td><?= $method['name'] ?></td>
                                        <td><?= $method['description'] ?></td>
                                        <td><?= $method['image'] ? '<image src="' . base_url($method['image']) . '" height="100" />' : '' ?></td>
                                        <td class="text-center">
											<a href="<?= base_url("admin/payment-methods/edit/" . $method['id']) ?>"
												class="btn btn-info btn-sm mb-1" title="Sửa">
												<i class="fas fa-pencil-alt"></i>
												<span class="text-xxl-visible">Sửa</span>
											</a>
											<a href="<?= base_url("admin/payment-methods/delete/" . $method['id']) ?>"
												class="btn btn-danger btn-sm mb-1" title="Xóa">
												<i class="fas fa-trash"></i>
												<span class="text-xxl-visible">Xóa</span>
											</a>
										</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>



<!-- DataTables  & Plugins -->
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/pdfmake/vfs_fonts.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script
    src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
    $(function () {
        $("#table-view")
            .DataTable({
                responsive: true,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf"],
                columnDefs: [
                    {
                        targets: -1, // Đây là cách chỉ định cột cuối cùng
                        visible: true, // Đảm bảo cột này luôn được hiển thị
                        className: 'all' // Sử dụng lớp 'all' để cột này luôn hiển thị ở tất cả các điểm phá vỡ responsive
                    }
                ]
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
    });

</script>

<?= $this->endSection() ?>