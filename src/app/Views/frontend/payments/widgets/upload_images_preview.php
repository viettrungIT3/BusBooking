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

<label class="input-preview" for="img"><input class="input-preview__src" name="img" id="img" type="file" /></label>

<script>
    const fileImage = document.querySelector('.input-preview__src');
    const filePreview = document.querySelector('.input-preview');

    fileImage.onchange = function () {
        const reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            filePreview.style.backgroundImage = "url(" + e.target.result + ")";
            filePreview.classList.add("has-image");
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
</script>