// Вывод повторяющихся полей с картинкой.  Для картинки тип поля Загрузить файл.  Возвращаемое значение Идентификатор вложения.
<?php
/*
    A loop field named "gallery" with sub-fields "slide_title" and "upload"
    Loop fields return an associative array containing *ALL* sub-fields and their values
    NOTE: Values of sub-loop fields are returned when using get() on the parent loop!
*/
$fields = CFS()->get( 'gallery' );
if( ! empty($fields) ):
foreach ( $fields as $field ) {
    echo $field['slide_title'];
    ?>
    <a href="<?php echo wp_get_attachment_image_url( $field['upload'], 'full' );?>">
    <?php echo wp_get_attachment_image( $field['upload'], 'medium'); ?>
    </a>
<?php    
}; 
endif;?>

// Вывод чебокса. Если отмечен, то выведет.  Тип поля True/False 

<?php
$chebox = CFS()->get( 'is_valid' );
$valid = 'Привет Мир!';
if ($chebox): 
    echo "$valid";   	
endif;?>
