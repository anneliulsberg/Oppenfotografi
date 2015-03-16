<?php get_header(); ?>
<?php query_posts($query_string . "&orderby=title&order=asc"); ?>

<section class="category">
	
	<div id="page">
	
	<ul id="portfolio-menu">
		<?php 
				$current_category_id = get_query_var('cat');
				$current_category = get_category($category_id);
				$categories = get_categories(array(
					'parent' => $current_category_id,
					'hide_empty' => 0,
					'orderby' => 'name',
				));
				
				if ($current_category && $current_category->slug != 'blogg') {
					foreach ($categories as $category) {
						echo '<li class="' . $category->slug . '"><a href="' . get_category_link($category->term_id) . '"><span>' . $category->name . '</span></a></li>';
					}
		 		}
		  ?>
	</ul>
	
		<?php 
		
		if (have_posts()) :
		
			while (have_posts()) :
				the_post();
				get_template_part('content');
			endwhile;
		
		else :
		
			get_template_part('content', 'none'); 
		
		endif;
		 
		 ?>
	</div>
</section>

<?php get_footer(); ?>