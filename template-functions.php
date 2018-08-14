/* --------------------------------------------------------------------------
 * Удаляем лишнее из шапки
 * -------------------------------------------------------------------------- */
remove_action('wp_head', 'feed_links_extra', 3); // убирает ссылки на rss категорий
remove_action('wp_head', 'feed_links', 2); // минус ссылки на основной rss и комментарии
remove_action('wp_head', 'rsd_link');  // сервис Really Simple Discovery
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head', 'wp_generator');  // скрыть версию wordpress
// Удаляем meta name generator отовсюду
function wp_remove_version()
{
	return '';
}
add_filter('the_generator', 'wp_remove_version');

remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
add_filter('xmlrpc_enabled', '__return_false');


/* --------------------------------------------------------------------------
 * Отключаем Emoji
 * -------------------------------------------------------------------------- */
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


/* --------------------------------------------------------------------------
 * Отключаем REST API
 * -------------------------------------------------------------------------- */
// Remove REST API info from head and headers
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

// Удаляю H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2);
function my_navigation_template($template, $class)
{
	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}


/* --------------------------------------------------------------------------
 * Удалить H2 из шаблона пагинации
 * -------------------------------------------------------------------------- */
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2);
function my_navigation_template($template, $class)
{
	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}

/* --------------------------------------------------------------------------
 *  Отключение сжатия JPEG изображений
 * -------------------------------------------------------------------------- */

add_filter('jpeg_quality', create_function('', 'return 100;'));


/* --------------------------------------------------------------------------
 *  Изменить правило вывода заголовков в категориях и метках
 * -------------------------------------------------------------------------- */

add_filter('get_the_archive_title', 'artabr_remove_name_cat');
function artabr_remove_name_cat($title)
{
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	}
	return $title;
}


/* --------------------------------------------------------------------------
 *  Длина и скобки в анонсе
 * -------------------------------------------------------------------------- */

// Длина анонса
function new_excerpt_length($length)
{
	return 60;
}

add_filter('excerpt_length', 'new_excerpt_length');
// Убираем квадратные скобки
add_filter('excerpt_more', function ($more) {
	return '...';
});


/* --------------------------------------------------------------------------
 *  Выполнение шорткодов в текстовых виджетах
 * -------------------------------------------------------------------------- */

add_filter('widget_text', 'do_shortcode');


/* --------------------------------------------------------------------------
 *  Ссылка на разработчика сайта
 * -------------------------------------------------------------------------- */

function wp_admin_bar_new_link()
{
	global $wp_admin_bar;
	$wp_admin_bar->add_menu(array(
		'id' => 'wp-admin-bar-new-link',
		'title' => __('Разработчик сайта'),
		'href' => 'https://svsites.ru/portfolio/'
	));
}

add_action('wp_before_admin_bar_render', 'wp_admin_bar_new_link');


/* --------------------------------------------------------------------------
 * Убираем вкладку комменты из админки, если не нужны комментарии
 * -------------------------------------------------------------------------- */

add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu()
{
	remove_menu_page('edit-comments.php'); // Комментарии
}






















