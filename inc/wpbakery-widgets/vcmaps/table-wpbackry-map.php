<?php


if (function_exists('vc_map')) {

    // Parent
    vc_map([
        'name'            => 'Table Of Contents',
        'base'            => 'table_of_contents',
        'category'        => 'My Widgets',
        'description'     => 'Table Of Contents with multiple rows and columns',
        'as_parent'       => ['only' => 'table_of_contents_row'],
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

        ]
    ]);

    //Row
    vc_map([
        'name'            => 'Table Of Contents Row',
        'base'            => 'table_of_contents_row',
        'category'        => 'My Widgets',
        'description'     => 'Single Table Row',
        'as_child'        => ['only' => 'table_of_contents'],
        'as_parent'        => ['only' => 'table_of_contents_cell'],
        'content_element' => true,
        'js_view'         => 'VcColumnView',
        'params'          => []
    ]);
    //Cell
    vc_map([
        'name'            => 'Table Of Contents Cell',
        'base'            => 'table_of_contents_cell',
        'category'        => 'My Widgets',
        'as_child'        => ['only' => 'table_of_contents_row'],
        'content_element' => true,
        'params'          => [
            [
                'type'        => 'textfield',
                'heading'     => 'Cell Content',
                'param_name'  => 'cell',
                'value'       => '',
                'admin_label'    => true,
                'group'       => 'General',
            ]
        ]
    ]);
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_table_of_contents extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_table_of_contents_row extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_table_of_contents_cell extends WPBakeryShortCode {}
}
