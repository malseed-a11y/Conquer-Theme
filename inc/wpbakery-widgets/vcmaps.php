<?php
add_action('vc_before_init', function () {

    require_once get_template_directory() . '/inc/wpbakery-widgets/vcmaps/trips-cpt-posts-map.php';
    require_once get_template_directory() . '/inc/wpbakery-widgets/vcmaps/table-wpbackry-map.php';
    require_once get_template_directory() . '/inc/wpbakery-widgets/vcmaps/comments-form-map.php';
    require_once get_template_directory() . '/inc/wpbakery-widgets/vcmaps/comments-table-map.php';
});
