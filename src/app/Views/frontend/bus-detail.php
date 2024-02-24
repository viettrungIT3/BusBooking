<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<!-- Link css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/frontend/css/bus-detail.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/frontend/css/owl-carousel-sync.css">

<!-- Owl Carousel2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
	integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
	integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- banner -->
<div class="ct-banner">
	<div class="ct-banner_background parallax-window" style="background-image: url('images/banner_bus_detail.jpg')">
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
					<li class="breadcrumb-item active">Đức Phúc Limousine</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content-main">
	<div class="container">
		<div class="row mt-5 flex-lg-row-reverse">
			<div class="info-container col-lg-4">
				<h1 class="title">Đức Phúc Limousine</h1>
				<div class="info">
					<p style="text-align: justify;"><strong>*&nbsp;Điện thoại đặt vé xe Đức Phúc Limousine:</strong></p>
					<p>&nbsp;&nbsp;<span style="color: #ff6600;"><strong><a href="tel:0243 9900 333"
									style="color: #ff6600;">0243 9900 333</a></strong></span>&nbsp;(07:00 -&nbsp;22:00)
					</p>
					<p>&nbsp;&nbsp;<span style="color: #ff6600;"><strong><a href="tel:090 225 22 00"
									style="color: #ff6600;">090 225 22 00</a></strong></span>&nbsp;(07:00 - 22:00)</p>
					<p style="text-align: justify;"><strong>* Địa chỉ văn phòng hãng xe Đức Phúc Limousine:</strong></p>
					<p style="text-align: justify;">&nbsp;+ Vp&nbsp;Thống Nhất: 266 Thống Nhất, Thái Nguyên</p>
					<p style="text-align: justify;">&nbsp;+ Vp Chùa Hàng: Tổ 8, Chùa Hàng, Thái Nguyên</p>
					<p style="text-align: justify;">&nbsp;+ Vp Túc Duyên: Tổ 13, Túc Duyên, Thái Nguyên</p>
					<p style="text-align: justify;"><strong>* Các&nbsp;chuyến&nbsp;xe phổ biến:</strong></p>
					<p style="text-align: justify;"><span style="color: #0000ff;"><span
								style="color: #000000;">+</span></span><strong><span
								style="color: #0000ff;">&nbsp;<strong><a
										href="https://saodieu.vn/ve-xe-khach-duc-phuc-limousine-tu-ha-noi-di-thai-nguyen"><strong><span
												style="color: #0000ff;">Hà Nội → </span></strong></a><span
										style="text-decoration: underline;">Thái
										Nguyên</span></strong></span></strong>&nbsp;<strong><span
								style="color: #ff6600;">140.000&nbsp;</span></strong>(07:00, 22:00)</p>
					<p style="text-align: justify;"><span style="color: #0000ff;"><span
								style="color: #000000;">+</span></span><strong><span style="color: #0000ff;">&nbsp;<span
									style="text-decoration: underline;">Thái Nguyên</span><a
									href="https://saodieu.vn/ve-xe-khach-duc-phuc-limousine-tu-thai-nguyen-di-ha-noi"><strong><span
											style="color: #0000ff;"><span
												style="text-decoration: underline;">&nbsp;</span>→ Hà
											Nội</span></strong></a></span></strong>&nbsp;<strong><span
								style="color: #ff6600;">140.000&nbsp;</span></strong><strong><span
								style="color: #ff6600;">&nbsp;</span></strong>(14:00, 22:00)</p>
					<p><em><span style="color: #ff6600;"><strong>*</strong></span>&nbsp;Đón, trả&nbsp;<span
								style="color: #ff6600;"><strong>sảnh Nội Bài</strong></span>,&nbsp;phụ thu <span
								style="color: #ff6600;"><strong>20.000 đ/vé</strong></span></em></p>
					<p><em><strong><span style="color: #ff6600;">*</span></strong><em>&nbsp;Chú ý chọn lại&nbsp;<span
									style="color: #ff6600;"><strong>Ngày đi</strong></span>&nbsp;của bạn</em></em></p>
				</div>
			</div>
			<div class="col-lg-8">
				<!-- main slider carousel -->
				<div class="row">
					<div class="col-md-12" id="slider">
						<div id="owl-carousel-sync1" class="owl-carousel owl-theme owl-carousel-sync1">
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1669087926657.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1656172475810.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1649069189760.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1649069198474.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1669087815120.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1669087926657.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1656172475810.jpg" alt="">
							</div>
						</div>

						<div id="owl-carousel-sync2" class="owl-carousel owl-theme owl-carousel-sync2">
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1669087926657.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1656172475810.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1649069189760.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1649069198474.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1669087815120.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1669087926657.jpg" alt="">
							</div>
							<div class="item"><img
									src="https://saodieu.vn/media/transporter/207/1703558347_1656172475810.jpg" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5" style="padding:10px 0">
			<div class="col-lg-8">
				<h2>Thông tin chung</h2>
				<div class="info">
					<p style="text-align: justify;"><strong>Hãng xe Đức Phúc Limousine</strong>&nbsp;thuộc Công ty TNHH
						vận tải du lịch Đức Phúc.&nbsp;Đây là công ty lớn, uy tín trong ngành lữ hành du lịch, được giới
						chuyên môn và hành khách đánh giá cao về chất lượng và dịch vụ. Xe Đức Phúc Limousine được công
						ty khai trương tháng 11/2020 nhằm phục vụ nhu cầu ngày càng cao của du khách khi đi du lịch Hà
						Nội - Thái Nguyên.</p>
					<p style="text-align: justify;"><strong>Xe Đức Phúc Limousine </strong>sử dụng dòng
						xe&nbsp;Limousine Dcar VIP 9 chỗ được thiết kế từ xe Transit 16 chỗ thông thường, cho không gian
						sử dụng rộng rãi,&nbsp;đảm bảo sự thư giãn, thoải mái tối đa. Xe có 9 ghế bọc da cao
						cấp&nbsp;với 2 ghế đầu xe và 7 ghế hạng thương gia&nbsp;ở khoang sau.<strong>&nbsp;</strong>Các
						ghế đều được bọc da toàn bộ, êm ái, sạch sẽ.</p>
					<p style="text-align: justify;">Trên xe cũng trang bị đầy đủ tiện nghi như: Wifi tốc độ cao, cổng
						sạc USB mỗi ghế, màn hình Led cỡ lớn 32 inch, chăn đắp và nước&nbsp;uống&nbsp;miễn phí. Nội thất
						xe còn được trang trí hệ thống đèn LED giọt nước, đèn bầu trời sao mang lại sự thư giãn, thoải
						mái tối đa cho hành khách.</p>
					<p style="text-align: justify;">Xe Đức Phúc Limousine hỗ trợ đón trả khách tận nơi miễn phí tại 09
						quận nội thành Hà Nội (Hoàn Kiếm, Ba Đình, Tây Hồ, Đống Đa, Cầu Giấy, Hai Bà Trưng, Mỹ Đình,
						Long Biên), sảnh sân bay Nội Bài và tận nơi Thái Nguyên rất thuận tiện cho du khách.</p>
					<p style="text-align: justify;"><strong>Địa chỉ văn phòng</strong>&nbsp;của hãng xe Đức Phúc
						Limousine:</p>
					<p style="text-align: justify;">&nbsp;+ Vp&nbsp;Thống Nhất: 266 Thống Nhất, Thái Nguyên</p>
					<p style="text-align: justify;">&nbsp;+ Vp Chùa Hàng: Tổ 8, Chùa Hàng, Thái Nguyên</p>
					<p style="text-align: justify;">&nbsp;+ Vp Túc Duyên: Tổ 13, Túc Duyên, Thái Nguyên</p>
					<p><strong>Lịch trình, giá vé, thời gian xuất phát&nbsp;</strong>các chuyến xe&nbsp;của Đức Phúc
						Limousine:</p>
					<p style="text-align: justify;">&gt;<a
							href="https://saodieu.vn/ve-xe-khach-duc-phuc-limousine-tu-ha-noi-di-thai-nguyen">&nbsp;<strong><span
									style="text-decoration: underline;"><span
										style="color: #0000ff; text-decoration: underline;">Hà Nội → Thái
										Nguyên</span></span>:</strong>&nbsp;</a><strong><span
								style="color: #ff6600;">140.000&nbsp;đ/vé</span></strong>, 17chuyến/ngày, đón khách tận
						nơi tại 09 quận nội thành. Xe có đón khách tại sảnh T1, T2 sân bay Nội Bài.</p>
					<p style="text-align: justify;">&gt;<a
							href="https://saodieu.vn/ve-xe-khach-duc-phuc-limousine-tu-thai-nguyen-di-ha-noi"><strong>Thái
								Nguyên<span style="color: #0000ff;">&nbsp;→ Hà Nội</span>:</strong>&nbsp;</a><span
							style="color: #ff6600;"><strong>140.000&nbsp;đ/vé</strong></span>, 17chuyến/ngày, đón khách
						tận nơi tại sảnh văn phòng Thái Nguyên. Xe trả khách tận nơi&nbsp; tại 09 quận nội thành Hà
						Nội.&nbsp;</p>
					<p style="text-align: justify;"><span style="color: #ff6600;"><strong>* Ghi
								chú:</strong></span>&nbsp;<em>Xe có dịch vụ đón tận nơi 9 quận nội thành Hà Nội và Sảnh
							Nội Bài (có phụ thu 20.000 đ/vé)</em></p>
					<p><em><img src="https://saodieu.vn/media/icon/phoneicon_1.png" alt=""
								width="25"></em>&nbsp;&nbsp;Điện thoại đặt vé xe Đức Phúc Limousine:&nbsp;<span
							style="color: #ff6600;"><strong><a href="tel:0243 9900 333" style="color: #ff6600;">0243
									9900 333</a></strong></span>&nbsp;/&nbsp;<span style="color: #ff6600;"><strong><a
									href="tel:090 225 22 00" style="color: #ff6600;">090 225
									2200</a></strong></span>&nbsp;(07:00 - 22:00).</p>
					<p style="text-align: justify;"><span style="color: #ff6600;"><span style="color: #000000;">Hỗ trợ
								đến 06 hình thức thanh toán khác nhau vô cùng tiện lợi bao gồm:&nbsp;<strong>Chuyển
									khoản ngân hàng,&nbsp;</strong><strong>Thanh toán qua Internet
									Banking,&nbsp;</strong><strong>Thẻ tín dụng quốc tế,&nbsp;</strong><strong>Ví điện
									tử Momo,&nbsp;</strong><strong>Thanh toán qua cửa hàng tiện
									ích</strong>&nbsp;và&nbsp;<strong>Thanh toán trực tiếp tại văn
									phòng</strong>.</span></span></p>
				</div>
			</div>
			<div class="col-lg-4">
				<h2>Đặt vé</h2>
				<form action="" method="post">
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">
							<i class="fa-solid fa-location-arrow"></i>
						</span>
						<input type="text" class="form-control" placeholder="Chọn nơi đi" aria-label="Chọn nơi đi"
							aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">
							<i class="fa-solid fa-map-marker-alt"></i>
						</span>
						<input type="text" class="form-control" placeholder="Chọn nơi đến" aria-label="Chọn nơi đến"
							aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">
							<i class="fa-solid fa-calendar-days"></i>
						</span>
						<input type="text" class="form-control" placeholder="Chọn ngày đi" aria-label="Chọn ngày đi"
							aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<button type="button" class="form-control rounded btn btn-warning">Tìm vé xe</button>
					</div>
				</form>
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
					<h2 class="title">Đánh giá của bạn về hãng xe Đức Phúc Limousine</h2>
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
			<div class="mt-3">

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
			</div>
		</div>
	</div>
</section>

<!-- Contact -->
<?= $this->include('frontend/partials/contact.php') ?>


<script>
	$(document).ready(function () {

		var owlCarouselSync1 = $("#owl-carousel-sync1");
		var owlCarouselSync2 = $("#owl-carousel-sync2");
		var slidesPerPage = 7; //globaly define number of elements per page
		var syncedSecondary = true;

		owlCarouselSync1.owlCarousel({
			items: 1,
			slideSpeed: 2000,
			nav: false,
			autoplay: true,
			dots: false,
			loop: true,
			responsiveRefreshRate: 200,
			navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
		}).on('changed.owl.carousel', syncPosition);

		owlCarouselSync2
			.on('initialized.owl.carousel', function () {
				owlCarouselSync2.find(".owl-item").eq(0).addClass("current");
			})
			.owlCarousel({
				items: slidesPerPage,
				dots: false,
				nav: false,
				smartSpeed: 200,
				slideSpeed: 500,
				slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
				responsiveRefreshRate: 100
			}).on('changed.owl.carousel', syncPosition2);

		function syncPosition(el) {
			//if you set loop to false, you have to restore this next line
			//var current = el.item.index;

			//if you disable loop you have to comment this block
			var count = el.item.count - 1;
			var current = Math.round(el.item.index - (el.item.count / 2) - .5);

			if (current < 0) {
				current = count;
			}
			if (current > count) {
				current = 0;
			}

			//end block

			owlCarouselSync2
				.find(".owl-item")
				.removeClass("current")
				.eq(current)
				.addClass("current");
			var onscreen = owlCarouselSync2.find('.owl-item.active').length - 1;
			var start = owlCarouselSync2.find('.owl-item.active').first().index();
			var end = owlCarouselSync2.find('.owl-item.active').last().index();

			if (current > end) {
				owlCarouselSync2.data('owl.carousel').to(current, 100, true);
			}
			if (current < start) {
				owlCarouselSync2.data('owl.carousel').to(current - onscreen, 100, true);
			}
		}

		function syncPosition2(el) {
			if (syncedSecondary) {
				var number = el.item.index;
				owlCarouselSync1.data('owl.carousel').to(number, 100, true);
			}
		}

		owlCarouselSync2.on("click", ".owl-item", function (e) {
			e.preventDefault();
			var number = $(this).index();
			owlCarouselSync1.data('owl.carousel').to(number, 300, true);
		});
	});
</script>

<?= $this->endSection() ?>