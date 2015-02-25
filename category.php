<?php get_header(); ?>
<?php query_posts($query_string . "&orderby=title&order=asc"); ?>

<section class="category">
	
	<div id="page">
	
	<ul id="portfolio-menu">
		<?php 
				$category_id = get_query_var('cat');
				$category = get_category($category_id);
				
				if ($category && $category->slug != 'blogg') {
		 			wp_list_categories('&title_li=&show_count=1&child_of='.$category_id.'&hide_empty=0&depth=1');
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