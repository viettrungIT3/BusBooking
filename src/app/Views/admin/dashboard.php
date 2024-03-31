<?= $this->extend('admin/common/layout') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Bảng điều khiển</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
						<li class="breadcrumb-item active">Bảng điều khiển</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-4">
					<a href="#" class="info-box mb-3">
						<span class="info-box-icon bg-info elevation-1" style="width: 80px; height: 80px;"> <i
								class="fas fa-spinner fa-2x text-gray-300"></i> </span>
						<div class="info-box-content">
							<span class="info-box-text">Đặt vé đang chờ</span>
							<span class="info-box-number">6</span>
						</div>
					</a>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<a href="#" class="info-box mb-3">
						<span class="info-box-icon bg-danger elevation-1" style="width: 80px; height: 80px;"> <i
								class="fas fa-qrcode fa-2x text-gray-300"></i> </span>
						<div class="info-box-content">
							<span class="info-box-text">Tổng số vé đã bán</span>
							<span class="info-box-number">10</span>
						</div>
					</a>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<a href="#" class="info-box mb-3">
						<span class="info-box-icon bg-success elevation-1" style="width: 80px; height: 80px;"> <i
								class="fas fa-dollar-sign fa-2x text-gray-300"></i> </span>
						<div class="info-box-content">
							<span class="info-box-text">Danh sách thanh toán</span>
							<span class="info-box-number">11</span>
						</div>
					</a>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<a href="#" class="info-box mb-3">
						<span class="info-box-icon bg-warning elevation-1" style="width: 80px; height: 80px;"> <i
								class="fas fa-road fa-2x text-gray-300"></i> </span>
						<div class="info-box-content">
							<span class="info-box-text">Tổng số bến xe</span>
							<span class="info-box-number">13</span>
						</div>
					</a>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<a href="#" class="info-box mb-3">
						<span class="info-box-icon bg-primary elevation-1" style="width: 80px; height: 80px;"> <i
								class="fas fa-calendar-alt fa-2x text-gray-300"></i> </span>
						<div class="info-box-content">
							<span class="info-box-text">Lịch trình có sẵn</span>
							<span class="info-box-number">24</span>
						</div>
					</a>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<a href="#" class="info-box mb-3">
						<span class="info-box-icon bg-secondary elevation-1" style="width: 80px; height: 80px;"> <i
								class="fas fa-bus fa-2x text-gray-300"></i> </span>
						<div class="info-box-content">
							<span class="info-box-text">Xe buýt có sẵn</span>
							<span class="info-box-number">9</span>
						</div>
					</a>
				</div>
			</div>
		</div>

	</section>
</div>

<?= $this->endSection() ?>