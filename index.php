<?php
$portfolio_category = get_category_by_slug('portefolje');
$model_category = get_category_by_slug('modellportefolje');
$categories = get_categories(array(
    'parent' => $portfolio_category->term_id,
    'exclude' => $model_category->term_id
));
?>
<?php get_header(); ?>

    <div class="wrapper">
        <ol id="slideshow">
            <?php foreach ($categories as $category) : $category_url = get_category_link($category->term_id); ?>

                <li><a href="<?php echo esc_attr($category_url) ?>"><span><?php echo $category->name ?></span></a></li>

            <?php endforeach; ?>
        </ol>
    </div>

<?php get_footer(); ?>