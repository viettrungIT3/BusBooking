<?= $this->extend('admin/common/layout') ?>

<?= $this->section('content') ?>

<!-- summernote -->
<link rel="stylesheet" href="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/summernote/summernote-bs4.min.css">
<!-- CodeMirror -->
<link rel="stylesheet" href="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/codemirror/codemirror.css">
<link rel="stylesheet" href="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/codemirror/theme/monokai.css">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm xe </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý xe</a></li>
                        <li class="breadcrumb-item active">Thêm xe </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url() ?>admin/bus/create" method="post">
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
                </div>

                <div class="row">
                    <section class="col-lg-8">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin xe</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="platbus" class="">Tên xe</label>
                                        <input type="text" class="form-control" name="name" placeholder="Tên xe"
                                            value="<?= old('name') ?>">
                                    </div>
                                    <div class="form-group col-8 col-sm-8 col-md-4">
                                        <label for="platbus" class="">Biển số xe </label>
                                        <input type="text" class="form-control" name="license_plate"
                                            placeholder="Biển số xe" value="<?= old('license_plate') ?>">
                                    </div>
                                    <div class="form-group col-4 col-sm-4 col-md-2">
                                        <label for="seat" class="">Số chỗ ngồi</label>
                                        <input type="number" class="form-control" id="seat" name="seat_number"
                                            placeholder="Số chỗ ngồi" value="<?= old('seat_number') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bus Details -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin chi tiết xe</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="description">Giới thiệu chi tiết:</label>
                                    <textarea class="form-control" id="description"
                                        name="description"><?= old('description') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="notes">Ghi chú:</label>
                                    <textarea class="form-control" id="notes"
                                        name="notes"><?= old('notes') ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Slides:</label>
                                    <?php echo view('widgets/upload_images_preview.php') ?>
                                </div>
                            </div>
                        </div>

                    </section>
                    <section class="col-lg-4">

                        <!-- Utilities -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Tiện ích xe</h3>
                            </div>
                            <div class="card-body">
                                <!-- Giả sử có danh sách tiện ích dưới dạng checkbox -->
                                <div class="form-group">
                                    <?php foreach ($utilities as $row): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="utilities[]"
                                                value="<?= $row['id'] ?>" title="<?= $row['description'] ?>">
                                            <label class="form-check-label">
                                                <?= $row['name'] ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                    <!-- Thêm các tiện ích khác tương tự -->
                                </div>
                            </div>
                        </div>

                        <!-- Bus Offices -->
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Liên hệ</h3>
                            </div>
                            <div class="card-body">
                                <!-- Bus Offices -->
                                <div class="form-group" id="office-container">
                                    <label for="office_address">Địa chỉ văn phòng:</label>
                                    <button type="button" id="add-office" class="mb-1">Thêm</button>
                                </div>

                                <!-- Bus Phones -->
                                <div class="form-group" id="phone-container">
                                    <label for="phone_number">Số điện thoại:</label>
                                    <button type="button" id="add-phone" class="mb-1">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="javascript:history.back()" class="btn btn-secondary">Hủy </a>
                        <input type="submit" value="Thêm" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Summernote -->
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/codemirror/codemirror.js"></script>
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/codemirror/mode/css/css.js"></script>
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/codemirror/mode/xml/xml.js"></script>
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/dist/js/demo.js"></script>
<!-- dropzonejs -->
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/dropzone/min/dropzone.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        // Summernote
        $('#description').summernote();
        $('#notes').summernote();

        $('#add-office').click(function () {
            $('#office-container').append('<input type="text" class="form-control mb-1" name="office_address[]" placeholder="Địa chỉ văn phòng...">');
        });

        $('#add-phone').click(function () {
            $('#phone-container').append('<input type="text" class="form-control mb-1" name="phone_number[]" placeholder="Số điện thoại...">');
        });
    })
</script>

<?= $this->endSection() ?>