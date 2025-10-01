<?php


if (function_exists('vc_map')) {

    // Parent
    vc_map([
        'name'            => 'Table Of Contents',
        'base'            => 'table_of_contents',
        'category'        => 'My Widgets',
        'icon'            => 'icon-wpbakery-table',
        'description'     => 'Table Of Contents with multiple rows and columns',
        'as_parent'       => ['only' => 'table_of_contents_child'],
        'content_element' => true,
        'js_view'         => 'VcColumnView',
        'params'          => [
            [
                'type'        => 'textfield',
                'heading'     => 'Header Text',
                'param_name'  => 'header_text',
                'value'       => '',
                'group'       => 'General',
            ],
            [
                'type'        => 'textfield',
                'heading'     => 'Number of Columns',
                'param_name'  => 'col_number',
                'value'       => '3',
                'group'       => 'General',
            ],
        ]
    ]);


    vc_map([
        'name'            => 'Table Of Contents Cell',
        'base'            => 'table_of_contents_child',
        'category'        => 'My Widgets',
        'icon'            => 'icon-wpbakery-table',
        'description'     => 'Single Table Cell',
        'as_child'        => ['only' => 'table_of_contents'],
        'content_element' => true,
        'params'          => [
            [
                'type'        => 'textfield',
                'heading'     => 'Cell Content',
                'param_name'  => 'cell',
                'value'       => '',
                'group'       => 'General',
            ]
        ]
    ]);
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_table_of_contents extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_table_of_contents_child extends WPBakeryShortCode {}
}
