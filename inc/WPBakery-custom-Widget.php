<?php

if (function_exists('vc_map')) {
    vc_map(
        [
            "name" => "Custom Product Card",
            "base" => "product_card",
            "category" => "My Widgets",
            "params" => [
                [
                    "type" => "attach_image",
                    "heading" => esc_html__('Image'),
                    "param_name" => "image",
                    "value" => "",
                    "description" => "Select an image ",
                    'group' => 'Content',
                ],
                [
                    'type' => 'textfield',
                    'heading'  => esc_html__('Title', 'text-domain'),
                    'param_name' => 'title',
                    'value'  => '',
                    'group' => 'Content',
                ],
                [
                    'type' => 'textarea',
                    'heading'  => esc_html__('Description', 'text-domain'),
                    'param_name' => 'description',
                    'value'  => '',
                    'group' => 'Content',
                ],
                [
                    'type' => 'textfield',
                    'heading' => esc_html__('Price'),
                    'param_name' => 'price',
                    'value' => '',
                    'description' => 'Enter the price',
                    'group' => 'Content',
                ],
                [
                    'type' => 'textfield',
                    'heading' => esc_html__('Border radius'),
                    'param_name' => 'border_radius',
                    'value' => '',
                    'description' => 'Enter the border radius',
                    'group' => 'Style',
                ],
                [
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Color'),
                    'param_name' => 'color',
                    'value' => '#BB005F',
                    'description' => 'Enter the color',
                    'group' => 'Style',
                ]
            ]
        ]
    );
}

function custom_card_output($atts)
{

    extract(shortcode_atts([


        'image' => '',
        'title' => '',
        'description' => '',
        'price' => '',
        'border_radius' => '',
        'color' => '',
    ], $atts));


    $image_src_array = wp_get_attachment_image_src($image, 'large');


    $image_url = ! empty($image_src_array) ? $image_src_array[0] : '';


    $output = '<section class="styledCard" style="background-color:' . esc_attr($color) . ';">
 <div class="styledProductImage">
    <img style="border-radius:' . esc_attr($border_radius) . 'px;" src="' .    esc_url($image_url) . '" alt="' . esc_html($title) . '" />
 </div>
 <div class="productInfoWrap">
 <h2>' . esc_html($title) . '</h2>
 <p>' . esc_html($description) . '</p>
 <div class="price">' . esc_html($price) . ' $</div>
 </div>
 <div class="styledBtn">
 <button class="buyBtn">Buy Now</button>
 <button type="button" class="favBtn">
 <img src="https://cdn-icons-png.flaticon.com/512/18/18611.png" alt="star icon" />
 </button>
 </div>
</section>';

    return $output;
}
add_shortcode('product_card', 'custom_card_output');
