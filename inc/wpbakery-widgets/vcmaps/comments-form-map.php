<?php

if (function_exists('vc_map')) {
    vc_map([
        'name' => 'Comments Form',
        'base' => 'comments_form',
        'category' => 'My Widgets',
        'params' => [
            [
                'type' => 'textfield',
                'heading' => 'Title',
                'param_name' => 'title',
                'value' => '',
                'description' => 'Enter title',
            ],
            [
                'type' => 'textfield',
                'heading' => 'Name of the button',
                'param_name' => 'button_name',
                'value' => '',
                'description' => 'Enter the name of the button',
            ]
        ],

    ]);
};
