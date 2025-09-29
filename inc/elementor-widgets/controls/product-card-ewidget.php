<?php

use Elementor\Widget_Base;

class Elementor_Nav_Product_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'product-ewidget';
    }

    public function get_title()
    {
        return esc_html__('Product Ewidget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-product-meta';
    }

    public function get_categories()
    {
        return ['Ewidget'];
    }

    protected function _register_controls()
    {



        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'profile-cards'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'product_image',
            [
                'label' => esc_html__('Image', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,

            ]
        );


        $repeater->add_responsive_control(
            'product_title',
            [
                'label' => esc_html__('Title', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'devices' => ['desktop', 'tablet', 'mobile'],
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Title Typography', 'elementor'),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .product-title-typocraphy',

            ]
        );

        $repeater->add_control(
            'product_desc',
            [
                'label' => esc_html__('Description', 'custom-widget'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Description Typography', 'elementor'),
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .product-description-typocraphy',
            ]
        );

        $repeater->add_control(
            'product_price',
            [
                'label' => esc_html__('Price', 'custom-widget'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '30',
            ]
        );

        $this->add_control(
            'product_list',
            [
                'label' => esc_html__('Product List', 'custom-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ product_title }}}',
            ]
        );




        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#BB005F',
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .styledCard' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img-radius',
            [
                'label' => esc_html__('Image Radius', 'elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => '0',
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .styledCard img' => 'border-radius: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'number-coulms',
            [
                'label' => esc_html__('Number Coulms', 'elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => '0',
                'default' => '3',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .product-cards-wrapper' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'space_between',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'textdomain'),
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .styledCard' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        require get_template_directory() . '/inc/elementor-widgets/render/product-card-ewidget-render.php';
    }
    // protected function content_template() {}
}
