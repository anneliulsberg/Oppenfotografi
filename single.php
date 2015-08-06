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

                <div id="metadata">
                    Publisert <?php the_date(); ?> i
                    <?php
                        $category = get_the_category();
                        echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a> ';
                    ?>
                </div>
            <div id="media"><?php echo get_the_post_thumbnail() ?></div>
            <div id="body"><?php the_content() ?></div>
        </article>
    <?php endwhile; ?>

</div>

<?php get_footer(); ?>