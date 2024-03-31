<?= $this->extend('backend/common/layout') ?>

<?= $this->section('content') ?>

<!-- css -->
<!-- DataTables -->
<link rel="stylesheet"
	href="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
	href="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet"
	href="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Quản lý lịch trình</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
						<li class="breadcrumb-item active">Quản lý lịch trình</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content-main">
		<div class="container-fluid">
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
				<?php endif; ?>

				<?php if (session()->getFlashdata('success')): ?>
					<div class="col-12">
						<div class="alert alert-success">
							<?= session()->getFlashdata('success'); ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
			<!-- DataTales Example -->
			<!-- Log on to codeastro.com for more projects -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<a href="<?= base_url('/admin/manage-schedules/create-schedule') ?>" type="button"
						class="btn btn-success pull-right">
						Thêm lịch trình
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">

						<table id="table-view" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Mã</th>
									<th>Xe</th>
									<th>Tuyến đường</th>
									<th>Thời gian đi</th>
									<th>Thời gian đến</th>
									<th>Giá ve</th>
									<th>Các điểm dừng</th>
									<th>Hành động</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($schedules as $row) { ?>
									<tr>
										<td>
											<?= $i++; ?>
										</td>
										<td>
											<?= $row->id ?? $row['id']; ?>
										</td>
										<td>
											<?= $row->bus_name; ?>
										</td>
										<td>
											<?= $row->origin . ' --> ' . $row->destination; ?>
										</td>
										<td>
											<?= date('H:i', strtotime($row->departure_time)); ?>
										</td>
										<td>
											<?= date('H:i', strtotime($row->arrival_time)); ?>
										</td>
										<td class="text-end">
											<?= number_format((float) ($row->price), 0, ",", "."); ?> VNĐ
										</td>
										<td>
											<?= $row->stop_points; ?>
										</td>
										<td align="center">
											<a href="<?= base_url('admin/manage-schedules/show-schedule/' . $row->id) ?>"
												class="btn btn-primary btn-sm">
												<i class="fas fa-eye"></i>
												Xem
											</a>
											<a class="btn btn-info btn-sm"
												href="<?= base_url() . "admin/manage-schedules/update-schedule/" . $row->id ?>">
												<i class="fas fa-pencil-alt"></i>
												Sửa
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
</div>

<!-- DataTables  & Plugins -->
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/pdfmake/vfs_fonts.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script
	src="<?php echo base_url() . '/plugins/AdminLTE-3.2.0/'; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
	$(function () {
		$("#table-view")
			.DataTable({
				responsive: true,
				autoWidth: false,
				buttons: ["copy", "csv", "excel", "pdf"],
			})
			.buttons()
			.container()
			.appendTo("#example1_wrapper .col-md-6:eq(0)");
	});

</script>

<?= $this->endSection() ?>