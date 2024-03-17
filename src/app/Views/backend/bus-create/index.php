<?= $this->extend('backend/common/layout') ?>

<?= $this->section('content') ?>

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
                        <li class="breadcrumb-item active">Quản lý xe</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <form action="<?= base_url() ?>admin/manage-bus/create-bus" method="post">
            <div class="row">
                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if (isset ($validation)): ?>
                    <div class="col-12 mb-3">
                        <div class="alert alert-danger">
                            <?php echo $validation->listErrors(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin xe</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="platbus" class="">Tên xe</label>
                                <input type="text" class="form-control" name="name" placeholder="name">
                            </div>
                            <div class="form-group">
                                <label for="platbus" class="">Biển số xe </label>
                                <input type="text" class="form-control" name="license_plate"
                                    placeholder="license_plate">
                            </div>
                            <div class="form-group">
                                <label for="seat" class="">Số chỗ ngồi</label>
                                <input type="number" class="form-control" id="seat" name="seat_number"
                                    placeholder="seat_number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Hủy </a>
                    <input type="submit" value="Thêm" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
</div>

<?= $this->endSection() ?>