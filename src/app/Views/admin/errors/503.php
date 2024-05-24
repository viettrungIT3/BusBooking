<?= $this->extend('admin/common/layout') ?>

<?= $this->section('content') ?>

<div class="content-wrapper" style="min-height: 1652.44px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Trang chủ</font>
                                </font>
                            </a></li>
                        <li class="breadcrumb-item active">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Lỗi 503</font>
                            </font>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="error-page">
            <h2 class="headline text-danger">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">503</font>
                </font>
            </h2>
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Ối! Đã xảy ra lỗi.</font>
                    </font>
                </h3>
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            Chúng tôi sẽ nỗ lực khắc phục điều đó ngay lập tức. Trong thời gian chờ đợi, bạn có thể
                        </font>
                    </font>
                    <a href="<?= base_url('admin/dashboard') ?>">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">quay lại trang chủ admin</font>
                        </font>
                    </a>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            hoặc
                        </font>
                    </font>
                    <a href="javascript:history.back()">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">quay lại trang trước đó</font>
                        </font>
                    </a>
                </p>
            </div>
        </div>

    </section>

</div>

<?= $this->endSection() ?>