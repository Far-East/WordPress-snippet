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
