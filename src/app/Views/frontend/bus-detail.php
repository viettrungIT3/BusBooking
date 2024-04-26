<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<!-- Link css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/frontend/css/bus-detail.css">

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
					<li class="breadcrumb-item"><a href="#">Xe khách</a></li>
					<li class="breadcrumb-item active">
						<?= $bus['name'] ?>
					</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content-main">
	<div class="container">
		<div class="row mt-5 flex-lg-row-reverse">
			<div class="info-container col-lg-4">
				<h1 class="title">
					<?= $bus['name'] ?>
				</h1>
				<div class="info">
					<p style="text-align: justify;"><strong>*&nbsp;Điện thoại đặt vé xe:</strong></p>
					<?php foreach ($bus['phones'] as $phone): ?>
						<p style="color: #ff6600;" title="Mọi thông tin chi tiết xin vui lòng liên hệ"> +
							<strong>
								<a href="tel:<?= $phone['phone_number'] ?>" style="color: #ff6600;">
									<?= $phone['phone_number'] ?>
								</a>
							</strong>
						</p>
					<?php endforeach; ?>
					<p style="text-align: justify;"><strong>* Địa chỉ văn phòng:</strong></p>
					<?php foreach ($bus['offices'] as $office): ?>
						<p style="text-align: justify;"> +
							<?= $office['office_address'] ?>
						</p>
					<?php endforeach; ?>


					<p style="text-align: justify;"><strong>* Các tuyên đi phổ biến:</strong></p>
					<?php
					$count_limit_routes = 5;
					foreach ($routes as $route): ?>
						<p style="text-align: justify;"> +
							<?= $route->origin . ' - ' . $route->destination ?>
							<span style="color: #ff6600;"
								title="Đây chỉ là giá niêm yết. Vui lòng tìm vé để xem thêm thông tin chi tiết về vé!">
								<?= '(' . number_format((float) ($route->listed_price), 0, ",", "."); ?> VNĐ)
							</span>
						</p>
						<?php $count_limit_routes--;
						if ($count_limit_routes == 0) {
							echo '<p style="text-align: justify;">...</p>';
							break;
						}
						?>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-lg-8">
				<!-- main slider carousel -->

				<?php
				// Lọc và tạo các URL slide
				$url_slides = array_map(function ($slide) {
					return base_url('uploads/') . $slide['slide_url'];
				}, array_filter($bus['slides'], function ($slide) {
					return $slide['slide_type'] == 'image' && !empty ($slide['slide_url']);
				}));

				// Gọi view và truyền dữ liệu
				$view_content = view('frontend/partials/slider.php', [
					'p_id' => 'slider_1',
					'p_images' => $url_slides
				]);

				echo $view_content;

				?>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-lg-8">
				<h2>Thông tin chung</h2>
				<div class="info">
					<?= $bus['description'] ?>
				</div>

				<div class="mt-3 mb-2"><strong><span>* Tiện nghi:&nbsp;</span></strong></div>
				<ul style="list-style: inside;">
					<?php foreach ($bus['utilities'] as $utility): ?>
						<li style="text-align: justify;">
							<?= '<b>' . $utility->name . ': </b>' . $utility->description ?>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="mt-3 mb-2"><strong><span style="color: #ff6600;">* Ghi chú:&nbsp;</span></strong></div>
				<div class="info">
					<?= $bus['notes'] ?>
				</div>
			</div>
			<div class="col-lg-4">
				<h2>Đặt vé</h2>
				<div>
					<div class="input-group mb-3">
						<label class="input-group-text" for="select-origin">
							<i class="fa-solid fa-location-arrow"></i>
						</label>
						<select class="form-select" id="select-origin">
							<option selected disabled>Chọn nơi đi...</option>
							<?php foreach ($stopPoints as $row): ?>
								<option value="<?= htmlspecialchars($row->name); ?>" <?= isset($_GET["origin"]) && htmlspecialchars($row->name) == $_GET["origin"] ? "selected" : ""; ?>>
									<?= htmlspecialchars($row->name); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="input-group mb-3">
						<label class="input-group-text" for="select-destination">
							<i class="fa-solid fa-map-marker-alt"></i>
						</label>
						<select class="form-select" id="select-destination">
							<option selected disabled>Chọn nơi đến...</option>
							<?php foreach ($stopPoints as $row): ?>
								<option value="<?= htmlspecialchars($row->name); ?>" <?= isset($_GET["destination"]) && htmlspecialchars($row->name) == $_GET["destination"] ? "selected" : ""; ?>>
									<?= htmlspecialchars($row->name); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" for="input-date">
							<i class="fa-solid fa-calendar-days"></i>
						</span>
						<input type="date" class="form-control" id="departureTime" name="departureTime"
							value="<?= isset($_GET["departureTime"]) ? $_GET["departureTime"] : ""; ?>" min="<?= date('Y-m-d'); ?>">
					</div>
					<div class="input-group mb-3">
						<button id="searchButton" type="button" class="form-control rounded btn btn-warning">Tìm vé
							xe</button>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row mt-5">
			<h2 class="title" style="display:inline-block">Đánh giá của khách hàng</h2>
			<span class="date">(0 Đánh giá)</span>
			<div id="rating-comment">
				<div id="rating">
					<div id="str_error" align="center">Chưa có đánh giá nào</div>
				</div>
				<div class="page clearfix"></div>
			</div>
		</div>
		<hr>
		<div class="row mt-5">
			<div id="err" style="display:none">
				<div id="str_error" class="error"></div> <iframe name="fr_submit" width="0" height="0"
					style="visibility:hidden"></iframe>
			</div>
			<div class="">

				<div>
					<h2 class="title">Đánh giá của bạn</h2>
				</div>
				<div id="rate" style="padding-bottom:10px">
					<table cellspacing="0">
						<tbody>
							<tr>
								<td id="rate-3" style="padding:0;">Chất lượng xe</td>
								<td>
									<?php echo
										view('frontend/partials/star_rating.php', [
											'name' => 'rating-1',
											'value' => '0',
											'is_disabled' => false
										]);
									?>
								</td>
							</tr>
							<tr>
								<td id="rate-3" style="padding:0;">Đúng giờ</td>
								<td>
									<?php echo
										view('frontend/partials/star_rating.php', [
											'name' => 'rating-2',
											'value' => '0',
											'is_disabled' => false
										]);
									?>
								</td>
							</tr>
							<tr>
								<td id="rate-3" style="padding:0;">Chất lượng phục vụ</td>
								<td>
									<?php echo
										view('frontend/partials/star_rating.php', [
											'name' => 'rating-3',
											'value' => '0',
											'is_disabled' => false
										]);
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div>
					<textarea name="comment" cols="60" rows="5" id="comment" class="form-control"
						placeholder="Nhận xét của bạn"></textarea>
				</div>
			</div>
			<!-- <div class="mt-3">

				<h2 class="title">Vui lòng cho chúng tôi biết thông tin chuyến xe của bạn</h2>
				<div class="row mb-3">
					<div class="col-12">
						<select name="route" id="route" class="form-control">
							<option value="">- Chọn Tuyến đường -</option>
							<option value="1352">Hà Nội - Thái Nguyên</option>
							<option value="1353">Thái Nguyên - Hà Nội</option>
							<option value="1354">Nội Bài - Thái Nguyên</option>
							<option value="1355">Thái Nguyên - Nội Bài</option>
						</select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-6">
						<input name=" name" type="text" id="name" value="" size="30" maxlength="100"
							placeholder="Họ và tên" class="form-control">
					</div>
					<div class="col-6">
						<input name=" mobile" type="text" id="mobile" value="" size="30" maxlength="11"
							placeholder="Điện thoại" class="form-control">
					</div>
				</div>
				<div class="mb-3">
					<input name="datedepart" type="text" id="datedepart" value="" size="30" maxlength="10"
						placeholder="Ngày đi" class="form-control hasDatepicker">
				</div>
				<div class="row mb-3">
					<div>
						<img src="https://saodieu.vn/action/security_image.php" id="security_image"
							name="security_image" alt="" align="absmiddle">
						<img id="reload_button" onclick="reload_security_image()"
							src="https://saodieu.vn/themes/default/images/refresh.gif" alt="">
						<input id="securitycode" name="securitycode" size="6" maxlength="6" class="form-control"
							style="width:137px; min-width:auto">
					</div>
				</div>
				<br>
				<div class="mb-3">
					<input class="btn btn-booking btn-warning" type="submit" value="Gửi đánh giá">
				</div>
			</div> -->
		</div>
	</div>
</section>

<script>
	$(document).ready(function () {
		function getNewUrlToSearch() {
			var origin = $('#select-origin').val();
			var destination = $('#select-destination').val();
			var departureTime = $('#departureTime').val();

			var searchParams = new URLSearchParams(window.location.search);

			// Cập nhật các tham số tìm kiếm dựa trên lựa chọn của người dùng
			searchParams.set('origin', origin);
			searchParams.set('destination', destination);
			searchParams.set('departureTime', departureTime);

			// Xóa các tham số không được chọn
			if (!origin) searchParams.delete('origin');
			if (!destination) searchParams.delete('destination');
			if (!departureTime) searchParams.delete('departureTime');

			var newUrl = window.location.protocol + "//" + window.location.host + '/schedules?' + searchParams.toString();
			return newUrl;
		}

		// Gắn sự kiện click cho nút Tìm kiếm
		$('#searchButton').on('click', function (e) {
			e.preventDefault();
			// Chuyển đến URL mới với các tham số đã cập nhật
			window.location.href = getNewUrlToSearch();
		});
	});
</script>

<!-- Contact -->
<?= $this->include('frontend/partials/contact.php') ?>

<?= $this->endSection() ?>