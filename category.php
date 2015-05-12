<?php
get_header();

$current_categories = oppen_get_current_categories();
$current_category = $current_categories[0];
$is_category_blog = $current_category && $current_category->slug == 'blogg';
$is_sub_category = count($current_categories) > 1;
$orderby = $is_category_blog ? '&orderby=date&order=desc' : '&orderby=title&order=asc';
query_posts($query_string . $orderby);
$parent_category_id = $current_categories[count($current_categories) - 1]->cat_ID;
$top_level_categories = get_categories(array(
	'parent' => $parent_category_id,
	'hide_empty' => 0,
	'orderby' => 'name',
));

?>

<section class="category">
	<div id="page">
		<div class="wrapper">
			<?php if (!$is_category_blog) : ?>
				<ul id="portfolio-menu">
					<?php foreach ($top_level_categories as $category) :
						$slug = esc_attr($category->slug);
						$link = get_category_link($category->term_id);
						$name = $category->name;
						$is_active = array_reduce($current_categories, function($carry, $item) {
							global $category;
							return $carry || $item->cat_ID == $category->cat_ID;
						});
						$active_class = $is_active ? ' active' : ''; ?>

						<li class="<?php echo $slug . $active_class ?>"><a href="<?php echo $link ?>"><span><?php echo $name ?></span></a></li>

					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			
			<?php 
			
			if (have_posts()) :			
				while (have_posts()) :
					the_post();
	
					if ($is_category_blog) :		
							get_template_part('content');
					elseif ($is_sub_category) :
						$image_src = oppen_get_first_attached_image_src(array(150, 150)); ?>
						<article>
							<a href="<?php echo get_permalink(); ?>" <?php echo $image_src ? "style='background-image: url($image_src)'" : '' ?>>
								<span><?php the_title(); ?></span>
							</a>
						</article>					
					<?php endif;
				endwhile;				
			else :
			
				get_template_part('content', 'none'); 
			
			endif;
			 
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>