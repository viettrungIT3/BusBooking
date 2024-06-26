<!-- Header -->
<header class="header">
    <!-- Top Bar -->
    <div class="top_bar">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-row">
                    <div class="phone">+45 345 3324 56789</div>
                    <div class="social">
                        <ul class="social_list">
                            <li class="social_list_item"><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa-brands fa-behance"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="user_box ml-auto ms-auto">
                        <?php if (session()->has('logged_in') && session()->get('logged_in') === true): ?>
                            <!-- Người dùng đã đăng nhập -->
                            <div class="user_box_login user_box_link">
                                <a href="/profile"
                                    title="Thông tin cá nhân"><?= esc(session()->get('current_user')['name']) ?></a>
                            </div>
                            <div class="user_box_logout user_box_link">
                                <a href="/logout">Đăng xuất</a>
                            </div>
                        <?php else: ?>
                            <!-- Người dùng chưa đăng nhập -->
                            <div class="user_box_login user_box_link">
                                <a href="/login">đăng nhập</a>
                            </div>
                            <div class="user_box_register user_box_link">
                                <a href="/register">đăng ký</a>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="main_nav">
        <div class="container">
            <div class="row">
                <div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
                    <div class="logo_container">
                        <div class="logo"><a href="<?= base_url() ?>"><img
                                    src="<?php echo base_url() ?>/images/logo.png" alt="">Bus
                                Booking</a></div>
                    </div>
                    <div class="main_nav_container ml-auto">
                        <ul class="main_nav_list">
                            <li class="main_nav_item"><a href="<?= base_url() ?>">trang chủ</a></li>
                            <li class="main_nav_item"><a href="<?= base_url('buses/view/4') ?>">Thông tin xe</a></li>
                            <li class="main_nav_item"><a href="<?= base_url('schedules') ?>">Đặt vé</a></li>
                            <li class="main_nav_item"><a href="<?= base_url() ?>">tin tức</a></li>
                            <li class="main_nav_item"><a href="<?= base_url('contact') ?>">liên hệ</a></li>
                        </ul>
                    </div>

                    <div class="hamburger">
                        <i class="fa fa-bars trans_200"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="menu trans_500">
    <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
        <div class="menu_close_container">
            <div class="menu_close"></div>
        </div>
        <div class="logo menu_logo"><a href="<?= base_url() ?>"><img src="<?php echo base_url() ?>/images/logo.png"
                    alt=""></a></div>
        <ul>
            <li class="menu_item"><a href="<?= base_url() ?>">trang chủ</a></li>
            <li class="menu_item"><a href="<?= base_url('buses/view/4') ?>">Thông tin xe</a></li>
            <li class="menu_item"><a href="<?= base_url('schedules') ?>">Đặt vé</a></li>
            <li class="menu_item"><a href="<?= base_url() ?>">tin tức</a></li>
            <li class="menu_item"><a href="<?= base_url() ?>">liên hệ</a></li>
        </ul>
    </div>
</div>