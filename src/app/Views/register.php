<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<style>
    html,
    body,
    .wrapper,
    .container {
        height: 100% !important;
    }
</style>

<div class="container">
    <div class="wrapper d-flex align-items-center justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h4>Đăng ký</h4>
            </div>
            <div class="card-body">
                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>

                <!-- Form đăng ký -->
                <form action="/register" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>