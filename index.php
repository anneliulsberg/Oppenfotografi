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

                <li><?php

                    $query = "
                        select 			attachment.`ID`
                        ,				attachment.`post_title`
                        from 			{$wpdb->posts} 					as attachment
                        where 			attachment.`post_type` 			= 'attachment'
                        and 			attachment.`post_parent` 		in (
                            select 		distinct post.`ID`
                            from 		{$wpdb->posts} 					as post
                            inner join 	{$wpdb->term_relationships} 	as rel
                                on		rel.`object_id`					= post.`ID`
                                and		rel.`term_taxonomy_id`			= $category->term_id
                            where 		post.`post_type` 				= 'post'
                            and 		post.`post_status` 				= 'publish'
                        )
                        limit 			2
                    ";

                    $images = $wpdb->get_results($wpdb->prepare($query));

                    for ($i = 0; $i < count($images); $i++) :
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

                        <a href="#image-<?php echo $id ?>" style="background-image: url('<?php echo $medium_image_src ?>')"><span><?php echo $title ?></span></a>
                        <div id="image-<?php echo $id ?>" class="overlay">
                            <nav>
                                <ul>
                                    <li class="prev"><a href="#image-<?php echo $prev_id ?>" rel="prev <?php echo $first ? 'last' : '' ?>"><span>Forrige</span></a></li>
                                    <li class="close"><a href="#page" rel="index"><span>Lukk</span></a></li>
                                    <li class="next"><a href="#image-<?php echo $next_id ?>" rel="next <?php echo $last ? 'first' : '' ?>"><span>Neste</span></a></li>
                                </ul>
                            </nav>
                            <img src="<?php echo $large_image_src ?>">
                        </div><?php

                    endfor; ?>
                    <a href="<?php echo esc_attr($category_url) ?>"><span><?php echo $category->name ?></span></a>
                </li>

            <?php endforeach; ?>
        </ol>
    </div>

<?php get_footer(); ?>