<style>
    .input-preview__src {
        display: none;
    }

    .input-preview {
        border: dashed black 0.175em;
        border-radius: 0.5em;
        width: 100%;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        position: relative;
        transition: ease-in-out 750ms;
    }

    .input-preview::after {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        transform: translateY(50%);
        content: "Sau khi thực hiện thanh toán, vui lòng chụp lại màn hình và tải biên lai lên tại đây.";
        font-style: italic;
        font-size: 1em;
    }

    .has-image::before {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(50, 50, 50, 0.5);
        content: " ";
        transition: ease-in-out 750ms;
    }

    .has-image::after {
        content: "Tải lại biên lai khác";
        color: white;
    }
</style>

<label class="input-preview" for="input-preview__src-<?= $payment_method_id ?>"
    id="input-preview-<?= $payment_method_id ?>">
    <input class="input-preview__src" id="input-preview__src-<?= $payment_method_id ?>" name="" type="file"
        accept="image/*" />
</label>

<script>
    var fileImage_<?= $payment_method_id ?> = document.getElementById('input-preview__src-<?= $payment_method_id ?>');

    fileImage_<?= $payment_method_id ?>.onchange = function () {
        resetDefaultBackgroundImages();
        resetDefaultInputPreviewSrcNames();

        document.getElementById('input-preview__src-<?= $payment_method_id ?>').setAttribute('name', 'image');

        var reader = new FileReader();
        var filePreview = document.getElementById('input-preview-<?= $payment_method_id ?>');

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            filePreview.style.backgroundImage = "url(" + e.target.result + ")";
            filePreview.classList.add("has-image");
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };

    function resetDefaultBackgroundImages() {
        var inputPreviews = document.querySelectorAll('.input-preview');

        inputPreviews.forEach(function (inputPreview) {
            inputPreview.classList.remove("has-image");
            inputPreview.style.backgroundImage = 'none';
        });
    }

    function resetDefaultInputPreviewSrcNames() {
        var inputPreviewSrcs = document.querySelectorAll('.input-preview__src');

        inputPreviewSrcs.forEach(function (inputPreviewSrc) {
            inputPreviewSrc.setAttribute('name', '');
        });
    }
</script>