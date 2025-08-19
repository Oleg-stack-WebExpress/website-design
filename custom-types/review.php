<?php


add_action('init', 'review_register');
function review_register()
{
    $labels = array(
        'name' => 'My recent works',
        'singular_name' => 'review',
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
        'rewrite' => array('slug' => 'reviews', 'with_front' => false),
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor', 'thumbnail'),
        'exclude_from_search' => true
    );


    register_post_type('review', $args);
    register_taxonomy("review_category", array("review"), array("hierarchical" => true, "label" => "Категории", "singular_label" => "review", "rewrite" => true));

}

function archive_slider_review()
{
    if (is_post_type_archive('review')) {
        global $wp_query;

        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
}
add_filter('archive_template', 'archive_slider_review', -1);


add_shortcode('review-list', 'review_shortcode');
function review_shortcode($attr)
{

    extract(shortcode_atts(array(
        "count" => -1,
        "name" => ""
    ), $attr));

    $query_args = array(
        'post_type' => 'review',
        'posts_per_page' => $count,
        'post_status' => 'publish'
    );

    $id = 'review-' . rand();
    $html = '';
    $query = new WP_Query($query_args);

    if ($query->have_posts()) {
        $html = '<div id="' . $id . '" class="owl-carousel owl-theme owl-review">';

        while ($query->have_posts()) {
            $query->the_post();
            $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';

            $html .= '<div class="single-review-item">';
            if ($thumbnail) {
                $html .= '<div class="row">';
                $html .= '<div class="col-4">';
                $html .= '<a href="' . esc_url($thumbnail) . '" class="post-popup-link">';
                $html .= '<img src="' . esc_url($thumbnail) . '" class="single-review-item__image" alt="' . esc_attr(get_the_title()) . '" width="300" height="300">';
                $html .= '</a>';
            }
            $html .= '<div class="single-review-item-body">';
            $html .= '<div class="single-review-item-title">' . get_the_title() . '</div>';
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

add_shortcode('review-grid', 'review_grid_shortcode');
function review_grid_shortcode($attr)
{
    extract(shortcode_atts(array(
        "count" => -1,
        "name" => ""
    ), $attr));

    $query_args = array(
        'post_type' => 'review',
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
            $html .= '<div class="single-review-item">';
            if (has_post_thumbnail()) {
                $thumbnail = get_the_post_thumbnail_url();
                $html .= '<img src="' . $thumbnail . '" class="single-review-item__image thumbnail-lazy" alt="' . get_the_title() . '" width="300" height="300" />';
            }

            $html .= '<div class="single-review-grid-item-body">';
            $html .= '<div class="single-review-item-title">' . get_the_title() . '</div>';
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

add_action('init', 'review_register');


