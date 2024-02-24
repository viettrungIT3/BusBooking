<div class="star-rating ps-3">
    <?php
    $disabled = ($is_disabled) ? 'disabled' : '';
    for ($i = 5; $i >= 1; $i--):
        $checked = ((int) $i == (int) $value) ? 'checked="checked"' : '';
        ?>
        <input type="radio" id="<?= $name ?>-star-<?= $i ?>" name="<?= $name ?>" value="<?= $i ?>" <?= $checked ?>
            <?= $disabled ?> />
        <label for="<?= $name ?>-star-<?= $i ?>" class="star">&#9733;</label>
    <?php endfor; ?>
</div>