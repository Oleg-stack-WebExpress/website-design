<?php
add_action('init', 'review_register');
function review_register()
{
    $labels = array(
        'name' => 'Анекдоты',
        'singular_name' => 'review',
        'add_new' => 'Добавить анекдот',
        'add_new_item' => 'Добавить новый анекдот',
        'edit_item' => 'Редактировать анекдот',
        'new_item' => 'Новый анекдот',
        'view_item' => 'Просмотр анекдота',
        'search_items' => 'Поиск',
        'not_found' =>  'Нет анекдотов',
        'not_found_in_trash' => 'Нет анекдотов в корзине',
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => false,
        'query_var'           => false,
        'has_archive' => false,
        'rewrite' => array('slug' => 'reviews', 'with_front' => false),
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor', 'thumbnail'),
        'exclude_from_search' => true
    );

    register_post_type('review', $args);
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
        'numberposts' => $count,
        'post_status' => 'publish'
    );

    $id = rand();
    $html = '';
    $query = new WP_Query($query_args);
    if ($query->have_posts()) {
        $html = '<div id="owl-review-' . $id . '" class="owl-carousel owl-theme owl-nav-black owl-review" data-count="' . $query->found_posts . '" data-aos="zoom-in">';
        while ($query->have_posts()) {
            $query->the_post();

            $html .= '<div class="single-review-item">';
            
            if (has_post_thumbnail()) {
                $thumbnail = get_the_post_thumbnail_url();
                $html .= '<img src="' . $thumbnail . '" class="single-review-item__image thumbnail-lazy" alt="' . get_the_title() . '" width="300" height="300" />';
            }

            $html .= '<div class="single-review-item-body">';
            $html .= '<div class="single-review-item-title">' . get_the_title() . '</div>';
            $html .= get_the_content();
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';

        wp_reset_postdata();
        wp_reset_query();

        add_action('wp_footer', function () use ($id) {
            echo <<<END
            <script>
            $("#owl-review-$id").owlCarousel({
                loop: 1,
                autoplayTimeout: 8e3,
                margin: 10,
                stagePadding: 50,
                nav: 3,
                autoplay: 1,
                dots: 0,
                lazyLoad: 1,
                responsive: {
                    0: {
                        items: 1
                    },
                    1200: {
                        items: 3
                    }
                }
            }); </script>
            END;
        }, 100);
    }

    return $html;
}


add_shortcode('review-grid', 'review_grid_shortcode');
function review_grid_shortcode($attr) {
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