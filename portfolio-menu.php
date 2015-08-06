<?php
$current_categories = get_query_var('current_categories');
$is_category_blog = get_query_var('is_category_blog');
$is_sub_category = get_query_var('is_sub_category');
$parent_category_id = $current_categories[count($current_categories) - 1]->cat_ID;
$top_level_categories = get_categories(array(
    'parent' => $parent_category_id,
    'hide_empty' => 0,
    'orderby' => 'name',
));
?>

<?php if (!$is_category_blog) : ?>
    <ul id="portfolio-menu">
        <?php foreach ($top_level_categories as $category) : ?>
            <?php

            $slug = esc_attr($category->slug);
            $link = get_category_link($category->term_id);
            $name = $category->name;
            $active_class = '';

            foreach ($current_categories as $current_category) {
                if ($current_category->term_id == $category->term_id) {
                    $active_class = ' active';
                    break;
                }
            }

            ?>

            <li class="<?php echo esc_attr($slug . $active_class) ?>"><a href="<?php echo $link ?>"><span><?php echo $name ?></span></a></li>

        <?php endforeach; ?>
    </ul>

<?php endif; ?>