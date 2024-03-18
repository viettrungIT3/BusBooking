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
					<h1 class="m-0">Quản lý các tuyến đường</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
						<li class="breadcrumb-item active">Quản lý các tuyến đường</li>
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
					<button type="button" class="btn btn-success pull-right" data-toggle="modal"
						data-target="#ModalRoutes">
						Thêm tuyến đường
					</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">

						<table id="table-view" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Mã tuyến</th>
									<th>Điểm đi</th>
									<th>Điểm đến</th>
									<th>Giá niêm yết</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($routes as $row) {// die();
									?>
									<tr>
										<td>
											<?= $i++; ?>
										</td>
										<td>
											<?= $row['id']; ?>
										</td>
										<td>
											<?= $row['origin'] ?? ''; ?>
										</td>
										<td>
											<?= $row['destination'] ?? ''; ?>
										</td>
										<td class="text-end">
											<?= number_format((float) ($row['listed_price']), 0, ",", "."); ?> VNĐ
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

<!-- Modal -->
<div class="modal fade" id="ModalRoutes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Thêm tuyến đường</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url() ?>admin/manage-routes/create-route" method="post">
					<div class="form-group">
						<div class="form-label-group">
							<input type="text" id="origin" name="origin" class="form-control" placeholder="Điểm đi"
								required="required" autofocus="autofocus">
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="text" id="destination" name="destination" class="form-control"
								placeholder="Điểm đến" required="required" autofocus="autofocus">
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="text" id="listed_price" name="listed_price" class="form-control"
								placeholder="Giá niêm yết" required="required" autofocus="autofocus">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button class="btn btn-success">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
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