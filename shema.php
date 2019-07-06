<?php

// Микроразметка меню навигации
<nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope"></nav>

// Функция
function fw_nav_list_shema($content) {
	$list_default = "<li ";
	$list_shema = '<li itemprop="name" ';
	$content = str_replace($list_default, $list_shema, $content);
	return $content;
}
add_filter('wp_nav_menu', 'fw_nav_list_shema');

function fw_nav_link_shema($content) {
	$link_default = "<a ";
	$link_shema = '<a itemprop="url" ';
	$content = str_replace($link_default, $link_shema, $content);
	return $content;
}
add_filter('wp_nav_menu', 'fw_nav_link_shema');


