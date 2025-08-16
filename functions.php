<?php
require_once 'inc/WP_Bootstrap_Navwalker.php';
require_once 'inc/areas.php';
require_once 'inc/enqueue.php';
require_once 'custom-types/review.php';
require_once 'inc/clear.php';
require_once 'inc/core.php';
require_once 'inc/last_news.php';


add_action('wpcf7_mail_sent', 'cf7_send_tg', 10, 3);
add_action('wpcf7_mail_sent', 'cf7_send_tg', 10, 1);
function cf7_send_tg($contact_form)
{
    $mail_body = $contact_form->prop('mail')['body'];
    $mail_body = wpcf7_mail_replace_tags($mail_body);

    $token = '7955415601:AAE2ECa7oquQD5bBtKT3PH4MVAgLBYaueZw';

    $url = 'https://api.telegram.org/bot' . $token . '/sendMessage?chat_id=' . 251165213 . '&text=' . urlencode($mail_body) . '&parse_mode=markdown';

    wp_remote_get($url);
}