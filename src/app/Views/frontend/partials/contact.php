<section class="contact mt-5">
    <div class="contact_background" style="background-image:url(<?php echo base_url() ?>/images/contact.png)"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact_image">

                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact_form_container">
                    <div class="contact_title">liên hệ</div>
                    <form action="#" id="contact_form" class="contact_form">
                        <input type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="Tên" required="required" data-error="Tên là bắt buộc.">
                        <input type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="Số điện thoại / E-mail" required="required" data-error="Số điện thoại / Email là bắt buộc.">
                        <input type="text" id="contact_form_subject" class="contact_form_subject input_field" placeholder="Chủ đề" required="required" data-error="Chủ đề là bắt buộc.">
                        <textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Nội dung" required="required" data-error="Vui lòng viết tin nhắn."></textarea>
                        <button type="submit" id="form_submit_button" class="form_submit_button button">gửi tin nhắn<span></span><span></span><span></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>