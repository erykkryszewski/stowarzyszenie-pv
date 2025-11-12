<?php

$section_id = get_field("section_id");
$background = get_field("background");
$items = get_field("items");
?>

<?php if (!empty($items)): ?>
<div class="four-columns <?php if ($background == 'true') { echo 'four-columns--background'; } ?>">
    <?php if (!empty($section_id)): ?>
    <div class="section-id" id="<?php echo esc_html($section_id); ?>"></div>
    <?php endif; ?>
    <div class="container">
        <div class="four-columns__wrapper">
            <div class="row">
                <?php foreach ($items as $key => $item): ?>
                <div class="col-12 col-md-6 col-lg-3 four-columns__column">
                    <div class="four-columns__item">
                        <div>
                            <?php if (!empty($item['image'])): ?>
                            <div class="four-columns__image">
                                <?php echo wp_get_attachment_image($item['image'], 'large', '', ['class' => 'object-fit-cover'],); ?>
                            </div>
                            <?php endif; ?>
                            <div class="four-columns__content">
                                <div>
                                    <?php if (!empty($item['title'])): ?>
                                    <h3 class="four-columns__title"><?php echo apply_filters('the_title', $item['title'],); ?></h3>
                                    <?php endif; ?> <?php if (!empty($item['text'])): ?> <?php echo apply_filters('acf_the_content', $item['text'],); ?> <?php endif; ?> <?php if (!empty($item['price'])): ?>
                                    <div class="four-columns__price">
                                        Już od
                                        <span><?php echo esc_html($item['price']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
