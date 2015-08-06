<?php
$is_category_blog = get_query_var('is_category_blog');
$is_sub_category = get_query_var('is_sub_category');
$image_src = oppen_get_first_attached_image_src('medium-cropped');
$background_image = $image_src ? "style='background-image: url($image_src)'" : '';
?>
<?php if ($is_category_blog) : ?>

    <article>
        <h1>
            <a href="<?php echo get_permalink(); ?>" <?php echo $background_image ?>>
                <span>
                    <?php the_title(); ?>
                    
                    <time datetime="<?php echo esc_attr(date_i18n('c', strtotime($post->post_date))) ?>">
                        <?php echo date_i18n(get_option('date_format'), strtotime($post->post_date)) ?>
                    </time>
                </span>
            </a>
        </h1>
    </article>

<?php elseif ($is_sub_category) : ?>

    <article>
        <h2>
            <a href="<?php echo get_permalink(); ?>" <?php echo $background_image ?>>
                <span><?php the_title(); ?></span>
            </a>
        </h2>
    </article>

<?php endif; ?>