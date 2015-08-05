<article>
    <h1><a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a></h1>
    <div class="metadata">
        <?php echo date_i18n(get_option('date_format'), strtotime($post->post_date)); ?>
    </div>
    <div class="picture">
        <?php the_post_thumbnail('thumbnail') ?>
    </div>
</article>
