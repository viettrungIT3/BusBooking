<div class="accordion" id="accordionPayment">
  <?php foreach ($payment_methods as $payment_method): ?>
    <div class="accordion-item mb-3 border">
      <h4 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center"
        style="font-size: 1rem;">
        <div class="form-check w-100 collapsed" data-bs-toggle="collapse"
          data-bs-target="#collapse-<?= $payment_method['id'] ?>" aria-expanded="false">
          <input class="form-check-input" type="radio" name="payment" value="<?= $payment_method['id'] ?>"
            id="payment-<?= $payment_method['id'] ?>">
          <label class="form-check-label w-100 h-100" for="payment-<?= $payment_method['id'] ?>">
            <?= $payment_method['name'] ?>
          </label>
        </div>
      </h4>
      <div id="collapse-<?= $payment_method['id'] ?>" class="accordion-collapse collapse"
        data-bs-parent="#accordionPayment">
        <div class="accordion-body ">
          <div class="row">
            <?php if ($payment_method['type'] == 'online'): ?>
              <div class="col-7">
                <div class="px-2 mb-3">
                  <?= $payment_method['description'] ?>
                </div>
                <?php if ($payment_method['image']): ?>
                  <div class="px-2 mb-3">
                    <img src="<?= base_url($payment_method['image']) ?>" style="max-width: 200px;" alt="">
                  </div>
                <?php endif; ?>
              </div>
              <div class="col-5">
                <?= view('frontend/bookings/widgets/upload_images_preview.php') ?>
              </div>

            <?php else: ?>
              <div class="px-2 mb-3">
                <?= $payment_method['description'] ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>