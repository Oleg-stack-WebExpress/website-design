<?php
add_shortcode('last_news', 'last_news_shortcode');

function last_news_shortcode($attr)
{
    extract(shortcode_atts(array(
        "count" => -1,
        "category" => ''
    ), $attr));

    $query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => $count,
        'category_name' => $category

    ]);
$output = '';
    if ($query->have_posts()) {
        $output = '<div class="last-news">';
        while ($query->have_posts()) {
            $query->the_post();

$output .= '<div class="last-news__item">';
$output .= '<a href="' . get_the_permalink() . '" class="last-news__title">' . get_the_title() . '</a>';
$output .= '</div>';
        }
        $output .= '</div>';
    } else{
        $output = '<div class="last-news">';
        $output .= '<p>Новостей нет</p>';
        $output .= '</div>';
    }

    return $output;
}