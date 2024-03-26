<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= get_adminLTE_url() ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= get_adminLTE_url() ?>dist/img/avatar.png" class="img-circle elevation-2" alt="...">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?= $current_user['name'] ?? $current_user[0]['name'] ?? 'Admin1' ?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/admin/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Trang chủ
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/manage-bus" class="nav-link">
            <i class="nav-icon fas fa fa-bus"></i>
            <p>
              Quản lý xe buýt
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/manage-routes" class="nav-link">
            <i class="nav-icon fas fa fa-compass"></i>
            <p>
              Quản lý các tuyến đường
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/manage-schedules" class="nav-link">
            <i class="nav-icon fas fa fa-clipboard-list"></i>
            <p>
              Quản lý lịch trình
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-bookmark"></i>
            <p>
              Danh sách đặt chỗ
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>
              Quản lý vé
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Đang chờ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Đã bán</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-dollar-sign"></i>
            <p>
              Danh sách thanh toán
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Hộp thư
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>

  <script>
    // Lấy tất cả các menu co thẻ a có thuộc tính href
    var links = document.querySelectorAll('a[href].nav-link');
    var currentUrl = window.location.pathname;

    // Lặp qua tất cả các thẻ a và kiểm tra xem href có trùng với url hiện tại hay không
    links.forEach(function (link) {
      if (link.getAttribute('href') == currentUrl) {
        link.classList.add('active'); // Thêm class active nếu trùng
        var parentLi = link.closest('.nav-item.has-treeview'); // Tìm thẻ cha có class nav-item
        if (parentLi) {
          parentLi.classList.add('menu-open'); // Thêm class menu-open cho thẻ cha

          var parentUl = parentLi.closest('.nav.nav-treeview'); // Tìm thẻ cha có class .nav.nav-treeview
          if (parentUl) {
            var parentLi2 = parentUl.closest('.nav-item.has-treeview'); // Tìm thẻ cha có class nav-item
            if (parentLi2) {
              parentLi2.classList.add('menu-open'); // Thêm class menu-open cho thẻ cha
            }
          }
        }
      }
    });
  </script>
  <!-- /.sidebar -->
</aside>