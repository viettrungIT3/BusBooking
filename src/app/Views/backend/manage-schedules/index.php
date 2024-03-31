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
<!-- Include Date Range Picker -->
<link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css') ?>">

<!-- js -->
<script src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url("/plugins/AdminLTE-3.2.0/") ?>plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js') ?>"></script>

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
				<div class="card-header">
					<h2 class="card-title">
						<div id="time-filer" class="pull-right"
							style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
							<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
							<span></span> <b class="caret"></b>
						</div>

						<script type="text/javascript">
							$(function () {

								const currentUrlParams = new URLSearchParams(window.location.search);
								let start = currentUrlParams.has('startDate') ? moment(currentUrlParams.get('startDate')) : moment();
								let end = currentUrlParams.has('endDate') ? moment(currentUrlParams.get('endDate')) : moment();


								function cb(start, end) {
									$('#time-filer span').html(start.format('YYYY-MM-DD') + ' --> ' + end.format('YYYY-MM-DD'));

									const currentStart = currentUrlParams.get('startDate');
									const currentEnd = currentUrlParams.get('endDate');

									// Chỉ tải lại trang nếu có sự khác biệt trong lựa chọn thời gian
									if (start.format('YYYY-MM-DD') !== currentStart || end.format('YYYY-MM-DD') !== currentEnd) {
										window.location.href = `${window.location.pathname}?startDate=${start.format('YYYY-MM-DD')}&endDate=${end.format('YYYY-MM-DD')}`;
									}
								}




								$('#time-filer').daterangepicker({
									startDate: start,
									endDate: end,
									ranges: {
										'Hôm nay': [moment(), moment()],
										'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
										'Ngày mai': [moment().add(1, 'days'), moment().add(1, 'days')],
										'7 ngày trước': [moment().subtract(6, 'days'), moment()],
										'7 ngày tới': [moment(), moment().add(6, 'days')],
										'Tháng này': [moment().startOf('month'), moment().endOf('month')],
										'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
									}
								}, cb);

								cb(start, end);

							});
						</script>

					</h2>
					<div class="card-tools">
						<a href="<?= base_url('/admin/manage-schedules/create-schedule') ?>" type="button"
							class="btn btn-success pull-right">
							Thêm lịch trình
						</a>
					</div>
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
											<?= date('Y-m-d H:i', strtotime($row->departure_time)); ?>
										</td>
										<td>
											<?= date('Y-m-d H:i', strtotime($row->arrival_time)); ?>
										</td>
										<td class="text-end">
											<?= number_format((float) ($row->price), 0, ",", "."); ?> VNĐ
										</td>
										<td>
											<?= $row->stop_points; ?>
										</td>
										<td class="center text-nowrap">
											<a href="<?= base_url('admin/manage-schedules/show-schedule/' . $row->id) ?>"
												class="btn btn-primary btn-sm" title="Xem">
												<i class="fas fa-eye"></i>
												<span class="text-xxl-visible">Xem</span>
											</a>
											<a href="<?= base_url("admin/manage-schedules/update-schedule/" . $row->id) ?>"
												class="btn btn-info btn-sm" title="Sửa">
												<i class="fas fa-pencil-alt"></i>
												<span class="text-xxl-visible">Sửa</span>
											</a>
											<a href="<?= base_url("admin/manage-schedules/delete-schedule/" . $row->id) ?>"
												class="btn btn-danger btn-sm" title="Xóa">
												<i class="fas fa-trash"></i>
												<span class="text-xxl-visible">Xóa</span>
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