<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/frontend/css/owl-carousel-sync.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- main slider carousel -->
<div class="row">
    <div class="col-md-12" id="slider">
        <div id="<?= $p_id ?>-owl-carousel-sync1" class="owl-carousel owl-theme owl-carousel-sync1">
            <?php foreach ($p_images as $image): ?>
                <div class="item">
                    <img src="<?= $image ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>

        <div id="<?= $p_id ?>-owl-carousel-sync2" class="owl-carousel owl-theme owl-carousel-sync2">
            <?php foreach ($p_images as $image): ?>
                <div class="item">
                    <img src="<?= $image ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {

        var owlCarouselSync1 = $("#<?= $p_id ?>-owl-carousel-sync1");
        var owlCarouselSync2 = $("#<?= $p_id ?>-owl-carousel-sync2");
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