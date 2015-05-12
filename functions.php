<?php

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 'On');
	  
function oppenfotografi_setup() {
	register_nav_menus(array(
		'primary' => 'Hovedmeny'
	));
}  

function oppen_nav_menu_item_css_class($classes, $item) {
	if (in_array('current-menu-item', $classes) ){
		return array('active');
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
				break;
		}
	}
	
	return $menu_id;
}

function oppen_body_class($classes) {
	if (is_category()) {
		$category_id = get_query_var('cat');
		$category_slugs = array();

		while ($category_id != 0) {
			$category = get_category($category_id);
			array_push($category_slugs, $category->slug);
			$category_id = $category->category_parent;			
		}

		return $category_slugs;
	}	else if (is_page()) {
		$post = get_post($item->object_id);
		return array($post->post_name);
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
		$image_data = wp_get_attachment_image_src($first_id, array(150, 150));

		if ($image_data && is_array($image_data) && count($image_data) > 0) {
			return $image_data[0];
		}
	}

	return false;
}

function oppen_excerpt_length($length) {
	return 10;
}

add_filter('body_class', 'oppen_body_class', 10, 2);
add_filter('nav_menu_item_id', 'oppen_nav_menu_item_id', 10, 2);
add_filter('nav_menu_css_class' , 'oppen_nav_menu_item_css_class', 10, 2);
add_action('after_setup_theme', 'oppenfotografi_setup');
add_filter('excerpt_length', 'oppenfotografi_excerpt_length', 999);

?>