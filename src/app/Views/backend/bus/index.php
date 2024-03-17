<?= $this->extend('backend/common/layout') ?>

<?= $this->section('content') ?>


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
					<h1 class="m-0">Quản lý xe</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
						<li class="breadcrumb-item active">Quản lý xe</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content-main">
		<div class="container-fluid">
			<!-- DataTales Example -->
			<!-- Log on to codeastro.com for more projects -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<a href="<?= base_url('admin/manage-bus/create-bus') ?>" type="button"
						class="btn btn-success pull-right">
						Thêm xe
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">

						<table id="table-view" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Mã xe</th>
									<th>Tên xe</th>
									<th>Biển số xe </th>
									<th>Số chỗ ngồi</th>
									<th>Trạng thái</th>
									<th>Hành động</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($bus as $row) {// die();
									?>
									<tr>
										<td>
											<?= $i++; ?>
										</td>
										<td>
											<?= $row['id']; ?>
										</td>
										<td>
											<?= $row['name'] ?? ''; ?>
										</td>
										<td>
											<?= $row['license_plate'] ?? ''; ?>
										</td>
										<td>
											<?= $row['seat_number'] ?? ''; ?>
										</td>
										<?php if ($row['status'] == '1') { ?>
											<td class="btn-success"> Mở</td>
										<?php } else { ?>
											<td class="btn-danger">Khóa</td>
										<?php } ?>
										<td align="center"><a
												href="<?= base_url('admin/manage-bus/view-bus/' . $row['id']) ?>"
												class="btn btn btn-info">View</a></a>
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
<script src="<?= base_url() . '/assets/backend/bus/index.js'; ?>"></script>

<?= $this->endSection() ?>