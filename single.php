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

            <?php if (wp_count_attachments('image') > 0) : $images = array_values(get_attached_media('image')); ?>

                <ul id="media">

                <?php for ($i = 0; $i < count($images); $i++) :
                    $image = $images[$i];
                    $id = $image->ID;
                    $title = apply_filters('the_title', $image->post_title);
                    $large_image_data = wp_get_attachment_image_src($id, 'large');
                    $large_image_src = $large_image_data[0];
                    $large_image_width = $large_image_data[1];
                    $large_image_height = $large_image_data[2];
                    $medium_image_src = wp_get_attachment_image_src($id, 'medium-cropped')[0];
                    $first = $i === 0;
                    $last = $i === (count($images) - 1);
                    $prev_id = $first ? $images[count($images) - 1]->ID : $images[$i - 1]->ID;
                    $next_id = $last ? $images[0]->ID : $images[$i + 1]->ID; ?>

                    <li>
                        <a href="#image-<?php echo $id ?>" style="background-image: url('<?php echo $medium_image_src ?>')"><span><?php echo $title ?></span></a>
                        <div id="image-<?php echo $id ?>" class="overlay">
                            <nav>
                                <ul>
                                    <li class="close"><a href="#page" rel="index"><span>Lukk</span></a></li>
                                    <li class="prev"><a href="#image-<?php echo $prev_id ?>" rel="prev <?php echo $first ? 'last' : '' ?>"><span>Forrige</span></a></li>
                                    <li class="next"><a href="#image-<?php echo $next_id ?>" rel="next <?php echo $last ? 'first' : '' ?>"><span>Neste</span></a></li>
                                </ul>
                            </nav>
                            <img src="<?php echo $large_image_src ?>">
                        </div>
                    </li>
                <?php endfor; ?>

                </ul>

            <?php endif; ?>
        </article>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>