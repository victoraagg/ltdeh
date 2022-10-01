<?php
if (!defined('ABSPATH')) {
    exit;
}

function custom_enqueue_style()
{
    $ltdeh_theme = wp_get_theme('ltdeh');
    if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
        wp_enqueue_style('style', get_template_directory_uri() . '/assets/scss/dist/css/style.min.css', array(), $ltdeh_theme->version, 'all');
        wp_enqueue_style('vendor', get_template_directory_uri() . '/assets/scss/dist/css/vendor.min.css', array(), $ltdeh_theme->version, 'all');
        wp_enqueue_style('fullcalendar', get_template_directory_uri() . '/assets/vendor/fullcalendar-4.3.1/packages/core/main.css', array(), $ltdeh_theme->version, 'all');
        wp_enqueue_style('fullcalendar-daygrid', get_template_directory_uri() . '/assets/vendor/fullcalendar-4.3.1/packages/daygrid/main.css', array(), $ltdeh_theme->version, 'all');
    }
}
add_action('get_header', 'custom_enqueue_style');
