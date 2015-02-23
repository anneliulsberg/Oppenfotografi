<?php
	  
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

add_filter('nav_menu_item_id', 'oppen_nav_menu_item_id', 10, 2);

add_filter('nav_menu_css_class' , 'oppen_nav_menu_item_css_class', 10, 2);

add_action('after_setup_theme', 'oppenfotografi_setup');

?>