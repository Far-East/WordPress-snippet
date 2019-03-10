
// SQL-запросы, необходимые для переноса сайта на WordPress на другой домен:
UPDATE wp_options SET option_value = REPLACE(option_value, 'http://site.ru', 'http://newsite') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET post_content = REPLACE (post_content, 'http://site.ru', 'http://newsite');
UPDATE wp_postmeta SET meta_value = REPLACE (meta_value, 'http://site.ru','http://newsite');

// Если переносим с localhost то в файл wp-config добавляем: 
define('WP_HOME','http://site.ru');
define('WP_SITEURL','http://newsite.ru');

// Замена в целой таблице:
update TABLE_NAME set FIELD_NAME =
replace(FIELD_NAME, 'Текст для поиска', 'Текст, который нужно заменить');

// Замена текста в контенте:
update wp_posts set post_content =
replace(post_content,'Текст для поиска','Текст, который нужно заменить');

// Замена текста в названиях:
update wp_posts set post_title =
replace(post_title,'Текст для поиска','Текст, который нужно заменить');















