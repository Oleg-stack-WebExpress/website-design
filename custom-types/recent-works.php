<?php


add_action('init', 'recent_works_register');
function recent_works_register()
{
    $labels = array(
        'name' => 'My recent works',
        'singular_name' => 'recent-works',
        'add_new' => 'Добавить My recent works',
        'add_new_item' => 'Добавить новый My recent works',
        'edit_item' => 'Редактировать My recent works',
        'new_item' => 'Новый My recent works',
        'view_item' => 'Просмотр My recent works',
        'search_items' => 'Поиск',
        'not_found' => 'Нет My recent works',
        'not_found_in_trash' => 'Нет My recent works в корзине',
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'query_var' => false,
        'has_archive' => false,
        'rewrite' => array('slug' => 'recent-works', 'with_front' => false),
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor', 'thumbnail'),
        'exclude_from_search' => true
    );


    register_post_type('recent-works', $args);
    register_taxonomy("recent-works_category", array("recent-works"), array("hierarchical" => true, "label" => "Категории", "singular_label" => "recent-works", "rewrite" => true));

}


add_shortcode('recent-works-list', 'recent_works_shortcode');
function recent_works_shortcode($attr)
{

    extract(shortcode_atts(array(
        "count" => -1,
        "name" => ""
    ), $attr));

    $query_args = array(
        'post_type' => 'recent-works',
        'posts_per_page' => $count,
        'post_status' => 'publish'
    );

    $html = '';
    $query = new WP_Query($query_args);

    if ($query->have_posts()) {
        $html = '<div class="owl-carousel owl-theme owl-recent-works">';

        while ($query->have_posts()) {
            $query->the_post();
            $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';

            $html .= '<div class="single-recent-works-item">';
            if ($thumbnail) {
                $html .= '<div class="row">';
                $html .= '<div class="col-4">';
                $html .= '<a href="' . esc_url($thumbnail) . '" class="post-popup-link">';
                $html .= '<img src="' . esc_url($thumbnail) . '" class="single-recent-works-item__image" alt="' . esc_attr(get_the_title()) . '" width="300" height="300">';
                $html .= '</a>';
            }
            $html .= '<div class="single-recent-works-item-body">';
            $html .= '<div class="single-recent-works-item-title">' . get_the_title() . '</div>';
            $html .= apply_filters('the_content', get_the_content());
            $html .= '</div>';
            $html .= '</div>';
        }

        $html .= '</div>';


        wp_reset_postdata();
    }

    return $html;
}


// Функция для добавления класса popup к изображениям в контенте
if (!function_exists('add_popup_class_to_images')) {
    function add_popup_class_to_images($content)
    {
        $content = preg_replace(
            '/<a(.*?)href="(.*?\.(jpg|jpeg|png|gif|webp|bmp))"(.*?)>/i',
            '<a$1href="$2" class="post-popup-link"$4>',
            $content
        );

        $content = preg_replace(
            '/<img(.*?)src="(.*?\.(jpg|jpeg|png|gif|webp|bmp))"(.*?)>/i',
            '<a href="$2" class="post-popup-link"><img$1src="$2"$4></a>',
            $content
        );

        return $content;
    }
    add_filter('the_content', 'add_popup_class_to_images', 999);
}

add_shortcode('recent-works-grid', 'recent_works_grid_shortcode');
function recent_works_grid_shortcode($attr)
{
    extract(shortcode_atts(array(
        "count" => -1,
        "name" => ""
    ), $attr));

    $query_args = array(
        'post_type' => 'recent-works',
        'numberposts' => $count,
        'post_status' => 'publish'
    );

    $html = '';
    $query = new WP_Query($query_args);
    if ($query->have_posts()) {
        $html = '<div class="row">';
        while ($query->have_posts()) {
            $query->the_post();

            $html .= '<div class="col-md-4">';
            $html .= '<div class="single-recent-works-item">';
            if (has_post_thumbnail()) {
                $thumbnail = get_the_post_thumbnail_url();
                $html .= '<img src="' . $thumbnail . '" class="single-recent-works-item__image thumbnail-lazy" alt="' . get_the_title() . '" width="300" height="300" />';
            }

            $html .= '<div class="single-recent-works-grid-item-body">';
            $html .= '<div class="single-recent-works-item-title">' . get_the_title() . '</div>';
            $html .= get_the_content();
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';

        wp_reset_postdata();
        wp_reset_query();
    }

    return $html;
}

add_action('init', 'recent_works_register');


