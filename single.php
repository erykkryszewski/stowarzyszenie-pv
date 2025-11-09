<?php

/**
 * This file contains single post content
 *
 * @package ercodingtheme
 * @license GPL-3.0-or-later
 */

get_header();
global $post;

$post = get_post();
$page_id = $post->ID;

$prev_post = get_previous_post();
$next_post = get_next_post();

// CPT
$hero_title = get_field("hero_title", $page_id);
$hero_text = get_field("hero_text", $page_id);

//blog
$author_name = get_field("author_name", $page_id);
$author_position = get_field("author_position", $page_id);

// taxonomy
$taxonomy_slug = "category";
$taxonomy_terms = get_the_terms(get_the_ID(), $taxonomy_slug);
$taxonomy_title = "";
if (!is_wp_error($taxonomy_terms) && !empty($taxonomy_terms)) {
    $first_term = array_shift($taxonomy_terms);
    $taxonomy_title = function_exists("mb_convert_case")
        ? mb_convert_case($first_term->name, MB_CASE_TITLE, "UTF-8")
        : ucwords($first_term->name);
}
$final_title_for_hero = $taxonomy_title !== "" ? $taxonomy_title : "Blog";
?>

<main id="main" class="main main--subpage">
    <?php if (have_posts()): ?> <?php while (have_posts()): the_post(); ?> <?php if (get_post_type() == 'CPT'): ?>

    <!-- CPT -->
    <?php if (!empty($hero_title)): ?>
    <div class="subpage-hero">
        <div class="subpage-hero__background subpage-hero__background--plain"></div>
        <div class="container">
            <div class="subpage-hero__wrapper">
                <h1 class="subpage-hero__title subpage-hero__title--archive"><?php echo apply_filters('the_title', $final_title_for_hero,); ?></h1>
                <?php if (!empty($hero_text)): ?> <?php echo apply_filters('acf_the_content', $hero_text,); ?> <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="spacer" style="height: 90px"></div>
    <?php endif; ?>
    <div class="single-course"><?php the_content(); ?></div>

    <?php else: ?>

    <!-- BLOG -->
    <div class="subpage-hero">
        <div class="subpage-hero__background subpage-hero__background--plain"></div>
        <div class="container">
            <div class="subpage-hero__wrapper">
                <h1 class="subpage-hero__title subpage-hero__title--white"><?php echo apply_filters('the_title', $final_title_for_hero,); ?></h1>
            </div>
        </div>
    </div>
    <div class="single-blog-post">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                    <div class="single-blog-post__content">
                        <?php if (!empty(get_post_thumbnail_id($post->ID))): ?>
                        <div class="single-blog-post__image"><?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'full', '', [ 'class' => 'object-fit-cover', ]); ?></div>
                        <?php endif; ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_content(); ?></p>
                    </div>
                    <div class="single-blog-post__info">
                        <h4 class="single-blog-post__author-name"><?php echo esc_html($author_name); ?></h4>
                        <span class="single-blog-post__author-position"><?php echo esc_html($author_position); ?></span>
                    </div>
                    <div class="prev-and-next-posts <?php if (empty($prev_post)) { echo 'prev-and-next-posts--no-prev'; } ?> <?php if (empty($next_post)) { echo 'prev-and-next-posts--no-next'; } ?>">
                        <div class="prev-and-next-posts__item <?php if (empty($prev_post)) { echo 'prev-and-next-posts__item--blank'; } ?>">
                            <?php if (!empty($prev_post)): ?>
                            <div class="prev-and-next-posts__wrapper">
                                <div class="prev-and-next-posts__content">
                                    <a href="<?php echo get_permalink($prev_post->ID,); ?>" class="button button--single mt-4">Poprzedni wpis</a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="prev-and-next-posts__item <?php if (empty($next_post)) { echo 'prev-and-next-posts__item--blank'; } ?>">
                            <?php if (!empty($next_post)): ?>
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="button button--single mt-4">Następny wpis</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?> <?php endwhile; ?> <?php endif; ?>
</main>
<?php get_footer(); ?>
