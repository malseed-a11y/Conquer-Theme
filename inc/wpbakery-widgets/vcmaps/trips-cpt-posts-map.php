<?php


add_action('wp_loaded', function () {

    $terms = get_terms([
        'taxonomy' => 'trip_category',
        'hide_empty' => true
    ]);

    $term_options = [];
    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            $term_options[$term->name] = $term->term_id;
        }
    }


    if (function_exists('vc_map')) {
        vc_map([
            'name' => 'Trip Posts List',
            'base' => 'trip_posts_list',
            'category' => 'My Widgets',






            'params' => [
                [
                    'type' => 'dropdown',
                    'heading' => 'Category',
                    'param_name' => 'category',
                    'value' => $term_options,
                    'save_always' => true,
                    'group' => 'General',
                ],
                [
                    'type' => 'textfield',
                    'heading' => 'Number of Posts',
                    'param_name' => 'posts_number',
                    'value' => '5',
                    'description' => 'Enter the maximum number of posts to show.',
                    'group' => 'General',
                ],
                [
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Background Color'),
                    'param_name' => 'color',
                    'value' => '#BB005F',
                    'description' => 'Enter the color',
                    'group' => 'Style',
                ],
                [
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Content Color'),
                    'param_name' => 'content_color',
                    'value' => '#BB005F',
                    'description' => 'Enter the color',
                    'group' => 'Style',
                ],
                [
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Title Color'),
                    'param_name' => 'title_color',
                    'value' => '#ffffff',
                    'description' => 'Enter the heder color',
                    'group' => 'Style',
                ]
            ]
        ]);
    }
});
