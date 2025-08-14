<?php
    add_action('init', 'my_deregister_heartbeat', 1);
    function my_deregister_heartbeat() {
        global $pagenow;
        if ('post.php' != $pagenow && 'post-new.php' != $pagenow)
            wp_deregister_script('heartbeat');
    }

    remove_action('wp_head','feed_links_extra', 3);
    remove_action('wp_head','feed_links', 2);
    remove_action('wp_head','rsd_link');
    remove_action('wp_head','wlwmanifest_link'); 
    remove_action('wp_head','wp_generator');

    remove_action('wp_head','index_rel_link');
    remove_action('wp_head','start_post_rel_link',10,0);
    remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action('wp_head','wp_shortlink_wp_head', 10, 0 );

    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');

    add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 9999 );
    function smartwp_remove_wp_block_library_css(){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' );
    }

    add_filter('the_content', 'remove_empty_p', 11);
    function remove_empty_p($content){
        $content = force_balance_tags($content);
        return preg_replace('#<p>\s*</p>#i', '', $content);
    }

    add_filter( 'wpcf7_use_recaptcha_net', '__return_true' );
	add_filter( 'disable_wpseo_json_ld_search', '__return_true' );

	add_filter( 'language_attributes', 'artabr_opengraph_fix_yandex',20,1);
	function artabr_opengraph_fix_yandex($lang) {

	  $lang_prefix = 'prefix="article: http://ogp.me/ns/article#"';
	  $lang_fix = $lang . ' '. $lang_prefix;
	  return $lang_fix;
	}
