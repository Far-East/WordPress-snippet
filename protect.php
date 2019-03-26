/**
* Removes or edits the 'Protected:' part from posts titles. 
*/
add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text() {
return __('закрыто %s');
}

/**
* Конструкция вывода
*/
<?php
if (post_password_required()) { ?>
// Выведем посты с паролем
<?php } else { ?>
// Или любые другие
<?php }?>

/**
* Изменить форму ввода пароля
*/
function true_new_post_pass_form() {
	/*
	 * в принципе тут нужно обратить внимание на три вещи:
	 * 1) куда ссылается форма, а также method=post
	 * 2) значение атрибута name поля для ввода - post_password
	 * 3) атрибуты size и maxlength поля для ввода должны быть меньше или равны 20 (про длину пароля я писал выше)
	 * Во всём остальном у вас полная свобода действий!
	 */
	return '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	<input name="post_password" type="password" size="20" placeholder="Пароль к записи" maxlength="20" />
	<input type="submit" name="Submit" value="Разблокировать" />
	</form>';
}
add_filter( 'the_password_form', 'true_new_post_pass_form' ); // вешаем функцию на фильтр the_password_form

/**
* Изменить стандартное сообщение для цитат
*/
function true_protected_excerpt_text( $excerpt ) {
	if ( post_password_required() )
		$excerpt = '<em>[Запись заблокирована. Для получения пароля обратитесь к администратору.]</em>';
	return $excerpt; // если запись не защищена, будет выводиться стандартная цитата
}
add_filter( 'the_excerpt', 'true_protected_excerpt_text' );








