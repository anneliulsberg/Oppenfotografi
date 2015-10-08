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

                <li>
                    <a href="<?php echo esc_attr($category_url) ?>">
                        <span><?php echo $category->name ?></span>
                        <?php

                        $query = "
                            select 			attachment.`ID`
                            ,				attachment.`post_title`
                            from 			{$wpdb->posts} 					as attachment
                            inner join		{$wpdb->posts} 					as post
                                on			attachment.`post_parent` 		= post.`ID`
                                and 		post.`post_type` 				= 'post'
                                and 		post.`post_status` 				= 'publish'
                            inner join 		{$wpdb->term_relationships} 	as rel
                                on			rel.`object_id`					= post.`ID`
                                and			rel.`term_taxonomy_id`			= $category->term_id
                            where 			attachment.`post_type` 			= 'attachment'
                            limit 			2
                        ";

                        $images = $wpdb->get_results($wpdb->prepare($query));

                        for ($i = 0; $i < count($images); $i++) :
                            $image = $images[$i];
                            $id = $image->ID;
                            $title = apply_filters('the_title', $image->post_title);
                            $image_size = 'slideshow-' . ($i + 1);
                            $image_data = wp_get_attachment_image_src($id, $image_size); ?>

                            <img src="<?php echo $image_data[0] ?>" width="<?php echo $image_data[1] ?>" height="<?php echo $image_data[2] ?>" alt="<?php echo esc_attr($title) ?>">

                        <?php endfor; ?>
                    </a>
                </li>

            <?php endforeach; ?>
        </ol>
    </div>

<?php get_footer(); ?>