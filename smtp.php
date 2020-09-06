<?php
// В коде нужно вписать свой email-адрес и пароль.
function cf7_setup_phpmailer_init( PHPMailer $phpmailer ) {
    // Хост почтового сервера
    $phpmailer->Host = 'smtp.gmail.com';
    // Номер порта 
    $phpmailer->Port = 465;
    // Имя пользователя для SMTP авторизации 
    $phpmailer->Username = 'wptester54@gmail.com';
    // Пароль пользователя для SMTP авторизации 
    $phpmailer->Password = 'password'; 
    // Включение/отключение шифрования
    $phpmailer->SMTPAuth = true; 
    // Тип шифиования (ssl или tls)
    $phpmailer->SMTPSecure = 'ssl'; 
    // Обратный Email
    $phpmailer->From = 'wptester54@gmail.com'; 
    // Название сайта в поле От
    $phpmailer->FromName = get_bloginfo( 'name' ); 
    $phpmailer->IsSMTP();
}
add_action( 'phpmailer_init', 'cf7_setup_phpmailer_init' );
