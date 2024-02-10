<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Đăng nhập</h4>
            </div>
            <div class="card-body">
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form action="/login" method="post">
                    <div class="mb-3">
                        <label for="identity" class="form-label">Email hoặc Số điện thoại</label>
                        <input type="text" name="identity" class="form-control" value="<?php echo set_value('identity'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>