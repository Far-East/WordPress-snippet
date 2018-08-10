// Шорткод без параметров
function new_shortcode( $my_shortcode ) {
	
	$my_shortcode = '// Ваш код здесь';
	
	return $my_shortcode;
}
add_shortcode('my_shortcode', 'new_shortcode');
// Номер телефона
function Generate_Phone( $atts ) {
	$atts = shortcode_atts( array(
		'number'   => '+7(909) 88 8888',
	), $atts );
	return '<span>' .$atts['number']. '<span>';
}
add_shortcode('phone', 'Generate_Phone');
// использование: [phone number="+7(909) 88 8888"]
