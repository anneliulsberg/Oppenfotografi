<?php get_header(); ?>

<?php
$current_categories = oppen_get_current_categories();
$current_category = $current_categories[0];
$is_category_blog = $current_category && $current_category->slug == 'blogg';
$is_sub_category = count($current_categories) > 1;
set_query_var('current_categories', $current_categories);
set_query_var('is_category_blog', $is_category_blog);
set_query_var('is_sub_category', $is_sub_category);
?>

<div id="page">
    <?php get_template_part('portfolio-menu'); ?>

    <?php while (have_posts()) : the_post(); ?>

        <article>
            <h1><?php the_title() ?></h1>

            <?php if ($is_category_blog) : ?>

                <div id="metadata">
                    Publisert <?php the_date(); ?>
                </div>

            <? endif; ?>

            <div id="body">
            <?php

                // Fetch post content
                $content = get_post_field('post_content', get_the_ID());

                // Get content parts
                $content_parts = get_extended($content);

                // Output part before <!--more--> tag
                echo $content_parts['main'];

            ?>
            </div>

            <?php if (wp_count_attachments('image') > 0) : ?>

                <ul id="media">

                <?php foreach (get_attached_media('image') as $image) :
                    $title = apply_filters('the_title', $image->post_title);
                    $link = wp_get_attachment_image_src($image->ID, 'large')[0];
                    $src = wp_get_attachment_image_src($image->ID, 'medium-cropped')[0]; ?>

                    <li><a href="<?php echo $link ?>" style="background-image: url('<?php echo $src ?>')"><span><?php echo $title ?></span></a></li>
                <?php endforeach; ?>

                </ul>

            <?php endif; ?>
        </article>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>