<?php
get_header();

$current_categories = oppen_get_current_categories();
$current_category = $current_categories[0];
$category_description = $current_category ? trim(category_description($current_category->term_id)) : false;
$is_category_blog = $current_category && $current_category->slug == 'blogg';
$is_model_category = $current_category && $current_category->slug == 'kundeportefolje';
$is_sub_category = count($current_categories) > 1;
$orderby = $is_category_blog ? '&orderby=date&order=desc' : '&orderby=title&order=asc';
query_posts($query_string . $orderby);

set_query_var('current_categories', $current_categories);
set_query_var('is_category_blog', $is_category_blog);
set_query_var('is_sub_category', $is_sub_category);
set_query_var('is_model_category', $is_model_category);

?>

<section class="category">
    <div id="page">
        <div class="wrapper">
            <?php get_template_part('portfolio-menu'); ?>

            <h1 class="category-name"><?php echo $current_category->name ?></h1>

            <?php if ($category_description) : ?>
                <div class="category-description"><?php echo $category_description ?></div>
            <?php endif; ?>

            <?php

                if ($is_sub_category && !$is_model_category) :
                    get_template_part('media');
                else :
                    while (have_posts()) :
                        the_post();
                        get_template_part('content');
                    endwhile;
                endif;

            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>