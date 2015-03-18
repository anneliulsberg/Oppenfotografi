<?php
get_header();
query_posts($query_string . "&orderby=title&order=asc");
$current_category_id = get_query_var('cat');
$current_category = get_category($current_category_id);
$is_category_blog = $current_category && $current_category->slug == 'blogg';
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
						else : ?>
							<article>
								<a href="<?php echo get_permalink(); ?>" style="background-image: ...">
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