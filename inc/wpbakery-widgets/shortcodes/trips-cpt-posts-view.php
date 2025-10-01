<?php
//=====================
// Parent shortcode
function custom_list_category($atts)
{

    $atts  = shortcode_atts([
        'category'      => '',
        'color'         => '#BB005F',
        'title_color'    => '#ffffff',
        'content_color' => '#ffffff',
        'posts_number'  => '5',
    ], $atts);

    $category_id  = intval($atts['category']);
    $posts_number = is_numeric($atts['posts_number']) ? intval($atts['posts_number']) : 5;

    if (empty($category_id)) {
        return '<p>Please select a category.</p>';
    }

    $query_args = [
        'post_type'      => 'trip',
        'posts_per_page' => $posts_number > 0 ? $posts_number : 5,
        'tax_query'      => [
            [
                'taxonomy' => 'trip_category',
                'field'    => 'term_id',
                'terms'    => $category_id,
            ],
        ],
    ];

    $query = new WP_Query($query_args);

    $term = get_term($category_id, 'trip_category');
    $category_heading = $term && !is_wp_error($term) ? $term->name : '';

    $out  = '<div class="trip_posts_container" style="background-color:' . esc_attr($atts['color']) . '">';
    $out .= '<h2 style="color:' . esc_attr($atts['title_color']) . '">' . esc_html($category_heading) . '</h2>';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $out .= '<div class="single_trip_post">';
            $out .= '<h3 style="color:' . esc_attr($atts['content_color']) . '">' . esc_html(get_the_title()) . '</h3>';
            $out .= '<div style="color:' . esc_attr($atts['content_color']) . '" class="trip_post_content">' . apply_filters('the_content', get_the_content()) . '</div>';

            $tags = wp_get_post_terms(get_the_ID(), 'trip_tag', ['fields' => 'names']);
            if (!empty($tags)) {
                $out .= '<div class="trip_post_tags"><h3 style="color:' . esc_attr($atts['content_color']) . '">Tags</h3><ul>';
                foreach ($tags as $tag) {
                    $out .= '<li style="color:' . esc_attr($atts['content_color']) . '">' . esc_html($tag) . '</li>';
                }
                $out .= '</ul></div>';
            }

            $out .= '</div>';
        }
    }

    wp_reset_postdata();

    $out .= '</div>';

    return $out;
}
add_shortcode('trip_posts_list', 'custom_list_category');
