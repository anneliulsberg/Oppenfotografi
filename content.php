<article>
		<h1><a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a></h1>
		<?php if ($wp_query->current_post == 0) : ?>
			<?php the_content(); ?>
		<?php endif; ?>
</article>