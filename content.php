<?php
$first_post = $wp_query->current_post == 0;
$size = $first_post ? array(600, 600) : array(300, 300);
$image_src = oppen_get_first_attached_image_src($size);
?>
<article>
		<h1><a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a></h1>
		<div class="metadata">
			<?php echo date_i18n(get_option('date_format'), strtotime($post->post_date)); ?>
		</div>
		<?php if ($image_src) : ?>
			<div class="picture">
				<img src="<?php echo $image_src ?>" width="<?php echo $size[0] ?>" height="<?php echo $size[1] ?>" alt="">
			</div>
		<?php endif; ?>
		<?php

		if ($first_post) :
			// TODO: Bleuch, this is ugly. Find a cleaner way to get the image-less content. @asbjornu
			$content = get_the_content();
			$content = preg_replace("/<img[^>]+\>/i", " ", $content);          
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]>', $content);
			echo $content;
		else : 
			the_excerpt();
		endif;

		?>
</article>