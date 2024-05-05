<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<!-- Link css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/frontend/user/profile.css">

<!-- banner -->
<div class="ct-banner">
    <div class="ct-banner_background parallax-window"
        style="background-image: url('<?php echo base_url() ?>/images/banner_bus_detail.jpg')">
    </div>
    <!-- <div class="ct-banner_content">
        <div class="ct-banner_title">about us</div>
    </div> -->
</div>

<section class="content-header">
    <div class="container">
        <div class="row mb-3 mt-3">
            <div class="col-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active">
                        Thông tin cá nhân
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="container light-style flex-grow-1 container-p-y">
    <div class="row no-gutters row-bordered row-border-light">
        <div class=" card col-md-3 p-0">
            <div class="list-group list-group-flush account-settings-links">
                <a class="list-group-item list-group-item-action active" data-toggle="list"
                    href="#account-general">Thông tin cá nhân</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Đổi
                    mật khẩu</a>
                <!-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-social-links">Social
                    links</a>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                    href="#account-connections">Connections</a>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                    href="#account-notifications">Notifications</a> -->
            </div>
        </div>
        <div class="card col-md-9">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="account-general">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Thông tin cơ bản </h6>
                            </div>
                            <div class="col-md-8 col-12">
                                <div class="form-group">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control" name="name"
                                        value="<?= esc(session()->get('current_user')['name']) ?>" id="name" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="<?= esc(session()->get('current_user')['email']) ?>" id="eMail" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" disabled />
                                        <label for="imageUpload" id="imageLabel" style="display: none;"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                            style="background-image: url(<?= esc(session()->get('current_user')['profile_img']) ?>);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Thông tin liên hệ</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="<?= esc(session()->get('current_user')['phone']) ?>" id="phone" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Street">Địa chỉ</label>
                                    <input type="name" class="form-control" name="address"
                                        value="<?= esc(session()->get('current_user')['address']) ?>" id="Street"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="float-end">
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-secondary">Hủy</button>
                                    <button type="button" id="submit" name="submit" class="btn btn-primary">Cập
                                        nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="account-change-password">
                    <div class="card-body pb-2">
                        <div class="form-group">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="account-info">
                    <div class="card-body pb-2">
                        <div class="form-group">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control"
                                rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nunc arcu, dignissim sit amet sollicitudin iaculis, vehicula id urna. Sed luctus urna nunc. Donec fermentum, magna sit amet rutrum pretium, turpis dolor molestie diam, ut lacinia diam risus eleifend sapien. Curabitur ac nibh nulla. Maecenas nec augue placerat, viverra tellus non, pulvinar risus.</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Birthday</label>
                            <input type="text" class="form-control" value="May 3, 1995">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <select class="custom-select">
                                <option>USA</option>
                                <option selected>Canada</option>
                                <option>UK</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body pb-2">
                        <h6 class="mb-4">Contacts</h6>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="+0 (123) 456 7891">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Website</label>
                            <input type="text" class="form-control" value>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="account-social-links">
                    <div class="card-body pb-2">
                        <div class="form-group">
                            <label class="form-label">Twitter</label>
                            <input type="text" class="form-control" value="https://twitter.com/user">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Facebook</label>
                            <input type="text" class="form-control" value="https://www.facebook.com/user">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Google+</label>
                            <input type="text" class="form-control" value>
                        </div>
                        <div class="form-group">
                            <label class="form-label">LinkedIn</label>
                            <input type="text" class="form-control" value>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Instagram</label>
                            <input type="text" class="form-control" value="https://www.instagram.com/user">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="account-connections">
                    <div class="card-body">
                        <button type="button" class="btn btn-twitter">Connect to <strong>Twitter</strong></button>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body">
                        <h5 class="mb-2">
                            <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i
                                    class="ion ion-md-close"></i> Remove</a>
                            <i class="ion ion-logo-google text-google"></i>
                            You are connected to Google:
                        </h5>
                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                            data-cfemail="80eeede1f8f7e5ececc0ede1e9ecaee3efed">[email&#160;protected]</a>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body">
                        <button type="button" class="btn btn-facebook">Connect to <strong>Facebook</strong></button>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body">
                        <button type="button" class="btn btn-instagram">Connect to
                            <strong>Instagram</strong></button>
                    </div>
                </div>
                <div class="tab-pane fade" id="account-notifications">
                    <div class="card-body pb-2">
                        <h6 class="mb-4">Activity</h6>
                        <div class="form-group">
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input" checked>
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">Email me when someone comments on my article</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input" checked>
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">Email me when someone answers on my forum thread</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input">
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">Email me when someone follows me</span>
                            </label>
                        </div>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body pb-2">
                        <h6 class="mb-4">Application</h6>
                        <div class="form-group">
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input" checked>
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">News and announcements</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input">
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">Weekly product updates</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input" checked>
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">Weekly blog digest</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/plugins/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    const input = document.getElementById('imageUpload');
    const label = document.getElementById('imageLabel');

    input.addEventListener('change', function () {
        if (this.disabled) {
            label.style.display = 'none';
        } else {
            label.style.display = 'inline-block';
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function () {
        readURL(this);
    });
</script>

<?= $this->endSection() ?>