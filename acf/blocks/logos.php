<?php
$logos_field = get_field("logos");
$section_id = get_field("section_id");
$background = get_field("background");
$dynamic_logos = get_field("dynamic_logos");

$regular_members = get_field("regular_members", "options");
$supporting_members = get_field("supporting_members", "options");

$logos = $logos_field;

if (in_array($dynamic_logos, ["regular_members", "regular", "zwyczajni"], true)) {
    $logos = $regular_members;
} elseif (
    in_array(
        $dynamic_logos,
        ["supporting_members", "supporting", "wspierający", "wspierajacy"],
        true,
    )
) {
    $logos = $supporting_members;
}

if (is_array($logos) && isset($logos[0]) && !is_array($logos[0])) {
    $logos = array_map(fn($id) => ["logo" => $id], array_filter($logos));
}
?>

<?php if (!empty($logos)): ?>
<div class="logos <?php echo $background === 'true' || $background === true ? 'logos--background' : ''; ?>">
    <?php if (!empty($section_id)): ?>
    <div class="section-id" id="<?php echo esc_attr($section_id); ?>"></div>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="logos__wrapper">
            <div class="logos__viewport">
                <div class="logos__items" data-speed="140">
                    <?php foreach ($logos as $item): ?> <?php if (empty($item['logo'])) { continue; } $img_id = is_array($item['logo']) ? $item['logo']['ID'] ?? ($item['logo']['id'] ?? null) : $item['logo']; if (!$img_id) { continue; } ?>
                    <div class="logos__image"><?php echo wp_get_attachment_image($img_id, 'large', '', [ 'loading' => 'eager', 'decoding' => 'async', ]); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
