<?php




final class Elementor_widgets
{
    private static $_instance = null;

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.0';
    const MINIMUM_PHP_VERSION = '7.0';

    public function __construct()
    {

        add_action('plugins_loaded', [$this, 'init_plugin']);
        add_action('elementor/widgets/register', [$this, 'init_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'create_cat']);
    }

    public function init_plugin() {}

    public function init_controls() {}

    public function init_widgets($widgets_manager)
    {
        require_once get_template_directory() . '/widgets/nav-menu.php';
        $widgets_manager->register(new Elementor_Nav_Menu_Widget());
    }

    public static function get_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function create_cat($elements_manager)
    {
        $elements_manager->add_category(
            'Ewidget',
            [
                'title' => esc_html__('Ewidget', 'elementor-addon'),
                'icon' => 'eicon-nav-menu'
            ]
        );
    }
}
Elementor_widgets::get_instance();



// function register_hello_world_widget($widgets_manager)
// {

//     require_once(__DIR__ . '/widgets/hello-world-widget-1.php');
//     require_once(__DIR__ . '/widgets/hello-world-widget-2.php');

//     $widgets_manager->register(new \Elementor_Hello_World_Widget_1());
//     $widgets_manager->register(new \Elementor_Hello_World_Widget_2());
// }
// add_action('elementor/widgets/register', 'register_hello_world_widget');
