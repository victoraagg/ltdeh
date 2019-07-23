<?php
if (!defined('ABSPATH')) {
    exit;
}

function custom_enqueue_style() {
    $ltdeh_theme = wp_get_theme('ltdeh');
    if(!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php'){
        wp_enqueue_style('style', get_template_directory_uri() . '/assets/scss/style.min.css', array(), $ltdeh_theme->version, 'all');
        wp_enqueue_style('vendor', get_template_directory_uri() . '/assets/scss/vendor.min.css', array(), $ltdeh_theme->version, 'all');
        wp_enqueue_style('datetimepicker', '//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css', array(), $ltdeh_theme->version, 'all');
    }
}
add_action( 'get_header', 'custom_enqueue_style' );