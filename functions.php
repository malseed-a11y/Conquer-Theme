<?php

/**
 * Conquer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Conquer
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function conquer_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Conquer, use a find and replace
		* to change 'conquer' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('conquer', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'conquer'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'conquer_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'conquer_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function conquer_content_width()
{
	$GLOBALS['content_width'] = apply_filters('conquer_content_width', 640);
}
add_action('after_setup_theme', 'conquer_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function conquer_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'conquer'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'conquer'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'conquer_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function conquer_scripts()
{
	wp_enqueue_style('conquer-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('conquer-style', 'rtl', 'replace');

	wp_enqueue_script('conquer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	//===========================
	wp_enqueue_script(
		'wpajax',
		get_template_directory_uri() . '/js/wpajax.js',
		array(),
		'1.0.0',
		true
	);


	wp_localize_script(
		'wpajax',
		'my_ajax_obj',
		array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('msb_ajax_nonce'),
		)
	);
	//===========================

	// if (is_singular() && comments_open() && get_option('thread_comments')) {
	// 	wp_enqueue_script('comment-reply');
	// }
}
add_action('wp_enqueue_scripts', 'conquer_scripts');





//===========================
//Trips CPT
require get_template_directory() . '/inc/trips_cpt.php';
//===========================


//===========================
//AJAX form handling
add_action('wp_ajax_send_comment_form', 'handle_send_comment_form');
add_action('wp_ajax_nopriv_send_comment_form', 'handle_send_comment_form');

function handle_send_comment_form()
{
	check_ajax_referer('msb_ajax_nonce', '_ajax_nonce');

	$table_name = sanitize_text_field($_POST['table_name'] ?? '');
	$username = sanitize_text_field($_POST['username'] ?? '');
	$email = sanitize_email($_POST['email'] ?? '');
	$message = sanitize_textarea_field($_POST['message'] ?? '');

	if (empty($table_name)) {
		wp_send_json_error('Missing required data.');
		wp_die();
	}




	$commentdata = [
		'comment_author'       => $username,
		'comment_author_email' => $email,
		'comment_content'      => $message,
		// 'comment_approved'       => 0,
	];

	$comment_id = wp_insert_comment($commentdata);

	if (!$comment_id || is_wp_error($comment_id)) {
		wp_send_json_error('Failed to save comment.');
		wp_die();
	}


	add_comment_meta($comment_id, 'table_name', sanitize_title($table_name));


	$new_row_data = [$username, $email, $message];
	$row_html = '<tr>';
	foreach ($new_row_data as $value) {
		$row_html .= '<td>' . esc_html($value) . '</td>';
	}
	$row_html .= '</tr>';

	wp_send_json_success(['row_html' => $row_html]);
}

//===========================

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

if (is_plugin_active('elementor/elementor.php')) {
	require_once get_template_directory() . '/inc/elementor-registration.php';
}





//===========================
//WPBAKERY 
if (is_plugin_active('js_composer/js_composer.php')) {
	require_once get_template_directory() . '/inc/wpbakery-widgets/shortcods.php';
	require_once get_template_directory() . '/inc/wpbakery-widgets/vcmaps.php';
}
//===========================
