<?php
/**
 * Заменим слово «записи» на «продукт»
 */

add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	
	$new = array(
		'name'                  => 'Продукты',
		'singular_name'         => 'Продукт',
		'add_new'               => 'Добавить продукт',
		'add_new_item'          => 'Добавить продукт',
		'edit_item'             => 'Редактировать продукт',
		'new_item'              => 'Новый продукт',
		'view_item'             => 'Просмотреть продукт',
		'search_items'          => 'Поиск продуктов',
		'not_found'             => 'Продуктов не найдено.',
		'not_found_in_trash'    => 'Продуктов в корзине не найдено.',
		'parent_item_colon'     => '',
		'all_items'             => 'Все продукты',
		'archives'              => 'Архивы продуктов',
		'insert_into_item'      => 'Вставить в продукт',
		'uploaded_to_this_item' => 'Загруженные для этого продукта',
		'featured_image'        => 'Миниатюра продукта',
		'filter_items_list'     => 'Фильтровать список продуктов',
		'items_list_navigation' => 'Навигация по списку продуктов',
		'items_list'            => 'Список продуктов',
		'menu_name'             => 'Продукты',
		'name_admin_bar'        => 'Продукт',
	);
	
	return (object) array_merge( (array) $labels, $new );
}
