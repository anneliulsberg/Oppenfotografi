<?php
get_header();

$current_categories = oppen_get_current_categories();
$current_category = $current_categories[0];
$is_category_blog = $current_category && $current_category->slug == 'blogg';
$is_model_category = $current_category && $current_category->slug == 'modellportefolje';
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
			<p class="category-description">In hac habitasse platea dictumst. Sed quam quam, fringilla in justo nec, tempor feugiat nisi. Aliquam id ligula ut purus bibendum dictum. Suspendisse id leo malesuada, laoreet neque non, vehicula tortor. Donec turpis erat, feugiat a libero ut, scelerisque mattis quam. Sed ut euismod nunc, vitae sagittis sapien. Etiam finibus sem leo, in aliquam quam condimentum vel. Integer nisi ligula, lacinia nec nibh fermentum, tincidunt rutrum nulla. Mauris luctus est mauris, et placerat risus luctus eget. Maecenas quis commodo sem. Nullam ut euismod lacus. Quisque molestie elit sollicitudin elementum condimentum. Maecenas a urna lectus. Nullam eget iaculis odio. Donec in lacinia nibh. Integer tincidunt venenatis ante, quis suscipit purus elementum at.</p>
			
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