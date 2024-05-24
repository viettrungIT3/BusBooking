<?= $this->extend('frontend/common/layout') ?>

<?= $this->section('content') ?>

<!-- banner -->
<div class="ct-banner">
	<div class="ct-banner_background parallax-window"
		style="background-image: url('<?php echo base_url() ?>/images/banner_bus_detail.jpg')">
	</div>
	<div class="ct-banner_content">
		<div class="home_title">contact</div>
	</div>
</div>

<!-- Contact -->
<?= $this->include('frontend/partials/contact.php') ?>

<!-- Google Map -->

<div class="travelix_map">
	<div id="google_map" class="google_map">
		<div class="map_container">
			<div id="map"></div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>