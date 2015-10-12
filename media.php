<?php

$is_sub_category = get_query_var('is_sub_category');

if (is_single()) : ?>

    <ul id="media">

        <?php oppen_list_images() ?>

    </ul><?php

elseif ($is_sub_category && have_posts()) : ?>

    <ul id="media"><?php

        $images = array();

        while (have_posts()) :
            the_post();
            $images = array_merge($images, array_values(get_attached_media('image')));
        endwhile;

        oppen_list_images($images); ?>

    </ul><?php

else : ?>

    <p>Ingen bilder</p><?php

endif;

function oppen_list_images($images) {
    if ($images === NULL) {
        $images = array_values(get_attached_media('image'));
    }

    if (count($images) > 0) :
        for ($i = 0; $i < count($images); $i++) :
            $image = $images[$i];

            $id = $image->ID;
            $title = apply_filters('the_title', $image->post_title);
            $large_image_data = wp_get_attachment_image_src($id, 'large');
            $large_image_src = $large_image_data[0];
            $large_image_width = $large_image_data[1];
            $large_image_height = $large_image_data[2];
            $medium_image_src = wp_get_attachment_image_src($id, 'medium-cropped')[0];
            $first = $i === 0;
            $last = $i === (count($images) - 1);
            $prev_id = $first ? $images[count($images) - 1]->ID : $images[$i - 1]->ID;
            $next_id = $last ? $images[0]->ID : $images[$i + 1]->ID; ?>

            <li>
                <a href="#image-<?php echo $id ?>" style="background-image: url('<?php echo $medium_image_src ?>')"><span><?php echo $title ?></span></a>
                <div id="image-<?php echo $id ?>" class="overlay">
                    <nav id="lightbox">
                        <ul>
                            <li class="prev"><a href="#image-<?php echo $prev_id ?>" rel="prev <?php echo $first ? 'last' : '' ?>"><span>Forrige</span></a></li>
                            <li class="close"><a href="#page" rel="index"><span>Lukk</span></a></li>
                            <li class="next"><a href="#image-<?php echo $next_id ?>" rel="next <?php echo $last ? 'first' : '' ?>"><span>Neste</span></a></li>
                        </ul>
                    </nav>
                    <img src="<?php echo $large_image_src ?>">
                </div>
            </li><?php

        endfor;
    else : ?>

        <p>Ingen bilder</p><?php

    endif;
}

?>