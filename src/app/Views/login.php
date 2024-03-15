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
        <div class="card" style="min-width: 350px">
            <div class="card-header">
                <h4>Đăng nhập</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form action="/login" method="post">
                    <div class="mb-3">
                        <label for="identity" class="form-label">Email hoặc Số điện thoại</label>
                        <input type="text" name="identity" class="form-control"
                            value="<?php echo set_value('identity'); ?>">
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