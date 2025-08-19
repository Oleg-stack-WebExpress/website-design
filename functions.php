<?php
require_once 'inc/WP_Bootstrap_Navwalker.php';
require_once 'inc/areas.php';
require_once 'inc/enqueue.php';
require_once 'custom-types/recent-works.php';
require_once 'inc/clear.php';
require_once 'inc/core.php';



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

function enqueue_fontello_styles() {
    wp_enqueue_style('fontello', get_template_directory_uri() . '/assets/fontello/css/fontello.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fontello_styles');

function cf7_icon_button_shortcode() {
    return '<button type="submit" class="btn btn-info mt-2"><i class="icon-paper-plane-empty me-2"></i> Send Message</button>';
}
add_shortcode('cf7_icon_button', 'cf7_icon_button_shortcode');

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<input type="submit" value="([^"]*)" class="([^"]*)"/', 
        '<button type="submit" class="$2"><i class="icon-paper-plane-empty me-2"></i> $1</button>', 
        $content);
    return $content;
});