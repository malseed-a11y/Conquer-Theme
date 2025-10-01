<?php
add_action('vc_before_init', function () {

    require_once get_template_directory() . '/inc/wpbakery-widgets/shortcodes/trips-cpt-posts-view.php';
    require_once get_template_directory() . '/inc/wpbakery-widgets/shortcodes/table-wpbackry-view.php';
});
