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
			<ul id="portfolio-menu">
				<?php 
					if (!$is_category_blog) :
						foreach ($top_level_categories as $category) :
							echo '<li class="' . esc_attr($category->slug) . '"><a href="' . get_category_link($category->term_id) . '"><span>' . $category->name . '</span></a></li>';
						endforeach;
			 		endif;
				?>
			</ul>
			
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