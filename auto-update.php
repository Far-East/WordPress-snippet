<?php
/**
 * Авто-обновления
 * functions.php
 */

 // вкл. обновл. ядра
add_filter( 'auto_update_core', '__return_true' );

// вкл. обновл. всех тем
add_filter( 'auto_update_theme', '__return_true' );

// вкл. обновл. всех  плагинов
add_filter( 'auto_update_plugin', '__return_true' );



