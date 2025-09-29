<?php




final class Elementor_widgets
{
    private static $_instance = null;

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.0';
    const MINIMUM_PHP_VERSION = '7.0';

    public function __construct()
    {
        add_action('elementor/widgets/register', [$this, 'init_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'create_cat']);
        add_action('wp_enqueue_scripts', [$this, 'load_wpac_scripts']);
    }


    public function init_controls() {}

    public function init_widgets($widgets_manager)
    {
        require_once get_template_directory() . '/inc/elementor-widgets/controls/product-card-ewidget.php';
        $widgets_manager->register(new Elementor_Nav_Product_Widget());
        require_once get_template_directory() . '/inc/elementor-widgets/controls/table-widget.php';
        $widgets_manager->register(new Elementor_Tabel_Widget());
    }

    public static function get_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function load_wpac_scripts()
    {
        wp_enqueue_style('product-card-css', get_template_directory_uri() . '/style.css', array(), '1.0.0');
    }
    public function create_cat($elements_manager)
    {
        $elements_manager->add_category(
            'Ewidget',
            [
                'title' => esc_html__('Ewidget', 'elementor-addon'),

                'hideIfEmpty' => true,

            ]
        );
    }
}
Elementor_widgets::get_instance();
