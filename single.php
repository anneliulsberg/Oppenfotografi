<?php get_header(); ?>

<div id="page">

	<?php while (have_posts()) : the_post(); ?>
		<article>
			
				<h1><?php the_title() ?></h1>
				
				<div id="metadata">
					Publisert <?php the_date(); ?> i 
					<?php
						$category = get_the_category();
						echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a> ';
					?>
				</div>				
			<div id="media"><?php echo get_the_post_thumbnail() ?></div>
			<div id="body"><?php the_content() ?></div>	
		</article>	
	<?php endwhile; ?>
	
</div>

<?php get_footer(); ?>