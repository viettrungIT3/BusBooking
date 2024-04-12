<link rel="stylesheet" href="<?= base_url('assets/css/upload_images_preview.css') ?>">

<div class="upload_preview__box">
    <div class="upload_preview__btn-box">
        <label class="upload_preview__btn">
            <span>Upload images</span>
            <input type="file" multiple="" name="files[]" data-max_length="20" class="upload_preview__input_file">
        </label>
    </div>
    <div class="upload_preview__img-wrap"></div>
</div>

<script>
    jQuery(document).ready(function () {
        ImgUpload();
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload_preview__input_file').each(function () {
            $(this).on('change', function (e) {
                imgWrap = $(this).closest('.upload_preview__box').find('.upload_preview__img-wrap');
                var maxLength = $(this).attr('data-max_length');

                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function (f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var html = "<div class='upload_preview__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload_preview__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload_preview__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload_preview__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
        });
    }
</script>