/**
 * Кнопка в меню.
 */
function add_search_to_wp_menu ( $items, $args ) {
	if( 'menu-1' === $args -> theme_location ) {
		$items .= '<li class="menu-item menu-item-button">';
		$items .= '<a href="#callme">Обратный звонок</a>';
		$items .= '</li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);
