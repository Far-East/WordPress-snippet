<?php

/**
 * Удаляет лишние заголовки
 */
remove_action('wp_head','feed_links_extra', 3); // убирает ссылки на rss категорий
remove_action('wp_head','feed_links', 2); // минус ссылки на основной rss и комментарии
remove_action('wp_head','rsd_link');  // сервис Really Simple Discovery
remove_action('wp_head','wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head','wp_generator');  // скрыть версию wordpress
remove_action('wp_head','start_post_rel_link',10,0);
remove_action('wp_head','index_rel_link');
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head','wp_shortlink_wp_head', 10, 0 );
add_filter('xmlrpc_enabled', '__return_false');
// Удаляем meta name generator отовсюду
function wp_remove_version()
{
	return '';
}
add_filter('the_generator', 'wp_remove_version');

/**
 * Отключает emoji
 */
function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	
	if ('dns-prefetch' == $relation_type) {
		
		// Strip out any URLs referencing the WordPress.org emoji location
		$emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
		foreach ($urls as $key => $url) {
			if (strpos($url, $emoji_svg_url_bit) !== false) {
				unset($urls[$key]);
			}
		}
		
	}
	
	return $urls;
}

/**
 * Отключает REST API ссылки
 */
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

/**
 * Отключает загрузку скрипта wp-embed.min.js
 */
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

/**
 * Отключает загрузку скрипта jquery-migrate
 */
function remove_jquery_migrate( &$scripts ) {
	if( !is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
	}
}
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

/**
 * Отключает новый редактор блоков в WordPress (Гутенберг)
 */
if( 'disable_gutenberg' ){
	add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
	// отключим подключение базовых css стилей для блоков
	// ВАЖНО! когда выйдут виджеты на блоках или что-то еще, эту строку нужно будет комментировать
	remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );
	// Move the Privacy Policy help notice back under the title field.
	add_action( 'admin_init', function(){
		remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
		add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
	} );
}

/**
 * Отключает шрифты Google
 */
function remove_default_stylesheet() {
	wp_deregister_style('astra-google-fonts');
}
add_action('wp_enqueue_scripts', 'remove_default_stylesheet', 20);

/**
 * Заменяет заголовок H2 в навигации блога
 */
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2);
function my_navigation_template($template, $class)
{
	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}

/**
 * Настройка сжатия медиафайлов
 */
add_filter('jpeg_quality', 'filter_function_jpeg');
function filter_function_jpeg($quality)
{
	return 100;
}

/**
 * Изменяет правила вывода заголовков в категориях и метках
 */ 
add_filter('get_the_archive_title', 'artabr_remove_name_cat');
function artabr_remove_name_cat($title)
{
	if (is_category()) {
		$title = single_cat_title('', false);
	}
	elseif (is_tag()) {
		$title = single_tag_title('', false);
	}
	return $title;
}

/**
 * Длина анонса
 */
function new_excerpt_length($length)
{
	return 60;
}
add_filter('excerpt_length', 'new_excerpt_length');
// Удаление скобое
add_filter('excerpt_more', function ($more) {
	return '...';
});

/**
 * Запуск шорткода в html виджете
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Ссылка на разработчика
 */
function custom_toolbar()
{
	global $wp_admin_bar;
	
	$args = array(
		'id' => 'wp-admin-bar-new-link',
		'title' => __('Разработчик сайта', 'text_domain'),
		'href' => 'https://svsites.ru/portfolio/',
		'group' => false,
	);
	$wp_admin_bar->add_menu($args);
	
}
add_action('wp_before_admin_bar_render', 'custom_toolbar', 999);

/**
 * Добавляет размер изображения и обновляю полный размер
 */
add_image_size( 'anons-size', 410, 280, true );
update_option( 'large_size_w', 1170 );
update_option( 'large_size_h', 460 );
update_option( 'large_crop', 1 );

if ( ! function_exists( 'fw_showimagesizes' ) ) {
	function fw_showimagesizes($sizes) {
		$sizes['anons-size'] = 'Для Галереи!!!';
		return $sizes;
	}
	add_filter('image_size_names_choose', 'fw_showimagesizes');
}

/**
 * Отключает вкладку комментарии в админпанели
 */
add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu()
{
	remove_menu_page('edit-comments.php'); // Комментарии
}

/**
 * Отключает форматирование тегами <p> и <br> Contact Form 7
 */
add_action( 'wpcf7_autop_or_not', '__return_false' );
