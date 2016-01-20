<?php

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 'On');

function oppen_setup() {
    register_nav_menus(array(
        'primary' => 'Hovedmeny'
    ));

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(386, 386, array('center', 'top'));
    add_image_size('medium-cropped', 400, 400, array('center', 'top'));
    add_image_size('slideshow-1', 745, 745, array('center', 'top'));
    add_image_size('slideshow-2', 460, 460, array('center', 'top'));
    add_image_size('slideshow-3', 280, 285, array('center', 'top'));
    add_image_size('slideshow-4', 180, 165, array('center', 'top'));
    add_image_size('slideshow-5', 110, 120, array('center', 'top'));
    add_image_size('slideshow-6', 70, 120, array('center', 'top'));
}

function oppen_nav_menu_item_css_class($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        return array('active');
    }

    if ($item->object == 'category') {
        $categories = oppen_get_current_categories();

        foreach ($categories as $category) {
            if ($category->cat_ID == $item->object_id) {
                return array('active');
            }
        }
    }

    return array();
}

function oppen_nav_menu_item_id($menu_id, $item, $args, $depth) {
    if ($item) {
        switch ($item->object) {
            case "page":
                $post = get_post($item->object_id);
                return $post->post_name;
            case "category":
                $category = get_category($item->object_id);
                return $category->slug;
        }
    }

    return $menu_id;
}

function oppen_body_class($classes) {
    if (is_category()) {
        $category_slugs = array();
        $categories = oppen_get_current_categories();

        foreach ($categories as $category) {
            array_push($category_slugs, $category->slug);
        }

        return $category_slugs;
    } else if (is_page()) {
        $post = get_post($item->object_id);
        return array($post->post_name);
    } else if (is_single()) {
        $categories = oppen_get_current_categories();

        foreach ($categories as $category) {
            array_push($classes, $category->slug);
        }
    }

    return $classes;
}

function oppen_get_first_attached_image_src($size) {
    global $post;

    $images = get_attached_media('image');

    if ($images && is_array($images) && count($images) > 0) {
        reset($images);
        $first_id = key($images);

        // $image_data = array(
        //   [0] => url
        // 	 [1] => width
        //   [2] => height
        //   [3] => boolean: true if $url is a resized image, false if it is the original or if no image is available.
        // )
        $image_data = wp_get_attachment_image_src($first_id, $size);

        if ($image_data && is_array($image_data) && count($image_data) > 0) {
            // var_dump($image_data);
            return $image_data[0];
        }
    }

    return false;
}

function oppen_excerpt_length($length) {
    return 10;
}

function oppen_get_current_categories() {
    $category_id = false;

    if (is_single()) {
        $categories = get_the_category();

        if ($categories && count($categories) > 0) {
            $category_id = $categories[0]->term_id;
        }
    } else if (is_category()) {
        $category_id = get_query_var('cat');
    }

    if (!$category_id) {
        return false;
    }

    $categories = array();

    while ($category_id != 0) {
        $category = get_category($category_id);

        if (!isset($category) || !is_object($category)) {
            break;
        }

        $categories[] = $category;
        $category_id = $category->category_parent;
    }

    return $categories;
}

function oppen_image_send_to_editor($html, $id, $caption, $title, $align, $url) {
    return $html;
}

function oppen_pre_get_posts($query) {
    // If we're on the front page, fetch the 3 latest blog posts
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('is_category_blog', true);
        $query->set('category_name', 'blogg');
        $query->set('showposts', 3);
        return;
    }

    // If we're on the blog category page, increase the post limit to 90 posts
    if (!$query->is_home() && $query->is_category('blogg')) {
        $query->set('showposts', 90);
    }
}

add_action('pre_get_posts', 'oppen_pre_get_posts');
add_action('after_setup_theme', 'oppen_setup');
add_filter('body_class', 'oppen_body_class', 10, 2);
add_filter('nav_menu_item_id', 'oppen_nav_menu_item_id', 10, 2);
add_filter('nav_menu_css_class' , 'oppen_nav_menu_item_css_class', 10, 2);
add_filter('excerpt_length', 'oppenfotografi_excerpt_length', 999);
add_filter('image_send_to_editor', 'oppen_image_send_to_editor', 10, 9);

?>