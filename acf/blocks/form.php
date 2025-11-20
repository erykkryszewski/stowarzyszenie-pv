<?php

$form = get_field("form"); ?>

<div class="custom-form">
    <div class="container">
        <div class="custom-form__wrapper"><?php if (!empty($form)): ?> <?php echo $form; ?> <?php endif; ?></div>
    </div>
</div>
