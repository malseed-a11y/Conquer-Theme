<?php
if (function_exists('vc_map')) {



    vc_map([
        'name' => 'Comments Table',
        'base' => 'comments_table',
        'category' => 'My Widgets',
        'params' => [
            [
                'type' => 'colorpicker',
                'heading' => 'Table Color',
                'param_name' => 'table_color',
                'value' => '',
                'description' => 'Select table color',
            ],
            [
                'type' => 'textfield',
                'heading' => 'Tables Name',
                'param_name' => 'table_name',
                'value' => '',
                'description' => 'Select table name',
            ]
        ],
    ]);
};
