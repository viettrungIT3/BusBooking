<?= $this->extend('admin/common/layout') ?>

<?= $this->section('content') ?>

<!-- summernote -->
<link rel="stylesheet" href="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/summernote/summernote-bs4.min.css">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- <div class="col-sm-6"> -->
                <!-- <h1 class="m-0">Thêm phương thức thanh toán </h1> -->
                <!-- </div> -->
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Phương thức thanh toán</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
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
                    <form action="<?= base_url() ?>admin/payment-methods/store" method="post"
                        enctype="multipart/form-data">
                        <div class="card-header">
                            <h3 class="card-title">Thêm phương thức thanh toán</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="inputName">Tên</label>
                                        <input type="text" list="listName" id="inputName" class="form-control"
                                            name="name" required>
                                        <datalist id="listName">
                                            <option value="Chuyển khoản ngân hàng">
                                            <option value="Ví điện tử MoMo">
                                            <option value="Thanh toán tiền mặt">
                                            <option value="Thanh toán trực tiếp tại văn phòng">
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea class="form-control" id="description"
                                            name="description"><?= old('description') ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <img id="previewImage" class="mb-2" width="250" src="" alt="">
                                    <div class="small font-italic text-muted mb-4">JPG hoặc PNG không lớn hơn 5 MB</div>
                                    <label for="inputImage">
                                        <button id="uploadButton" class="btn btn-primary" type="button">Tải lên hình ảnh
                                            mới</button>
                                    </label>
                                    <input type="file" id="inputImage" name="image" style="display: none;"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-danger" href="javascript:history.back()">
                                        Quay lại
                                    </a>
                                    <button type="submit" class="btn btn-success float-right">
                                        Thêm mới
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

<!-- Summernote -->
<script src="<?= base_url('plugins/AdminLTE-3.2.0') ?>/plugins/summernote/summernote-bs4.min.js"></script>

<script>
    $(function () {
        // Summernote
        $('#description').summernote();
        $('#notes').summernote();
    })
</script>

<script>
    document.getElementById('uploadButton').addEventListener('click', function () {
        document.getElementById('inputImage').click();
    });

    document.getElementById('inputImage').addEventListener('change', function (event) {
        var input = event.target;
        var file = input.files[0]; // Lấy tệp tin đầu tiên trong danh sách

        // Kiểm tra xem tệp tin đã được chọn và có nhỏ hơn 5MB không
        if (file && file.size <= 5 * 1024 * 1024) { // 5MB expressed in bytes
            var reader = new FileReader();

            reader.onload = function () {
                var dataURL = reader.result;
                var previewImage = document.getElementById('previewImage');
                previewImage.src = dataURL;
            };

            reader.readAsDataURL(file);
        } else {
            // Thông báo lỗi nếu tệp tin không hợp lệ
            alert('Vui lòng chọn một tệp tin JPG hoặc PNG có kích thước nhỏ hơn 5MB.');
            input.value = ''; // Xóa lựa chọn tệp tin để người dùng có thể chọn lại
        }
    });
</script>

<?= $this->endSection() ?>