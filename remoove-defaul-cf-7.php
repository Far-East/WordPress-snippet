// Отключаем дефолтные стили Contact Form 7
function remove_default_stylesheet() {
	wp_deregister_style( 'contact-form-7' );
}
add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 );
