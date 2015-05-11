<?php $image_src = oppen_get_first_attached_image_src(array(150, 150)); ?>
<article>
		<h1><a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a></h1>
		<?php if ($image_src) : ?>
			<div class="picture">
				<img src="<?php echo $image_src ?>" width="150" height="150" alt="">
			</div>
		<?php endif; ?>
		<?php the_excerpt(); ?>
</article>