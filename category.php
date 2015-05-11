<?php
get_header();
$current_category_id = get_query_var('cat');
$current_category = get_category($current_category_id);
$is_category_blog = $current_category && $current_category->slug == 'blogg';
$orderby = $is_category_blog ? '&orderby=date&order=desc' : '&orderby=title&order=asc';
query_posts($query_string . $orderby);
$categories = get_categories(array(
	'parent' => $current_category_id,
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
						foreach ($categories as $category) :
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
					else :
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