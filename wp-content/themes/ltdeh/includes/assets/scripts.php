<?php
if (!defined('ABSPATH')) {
    exit;
}

function custom_enqueue_script() {
    $banium_theme = wp_get_theme('ltdeh');
    if(!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php'){
        wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/ac351d98a4.js', array(), $banium_theme->version, true);
        wp_enqueue_script('ofi', get_template_directory_uri() . '/assets/vendor/object-fit-images/dist/ofi.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/dist/js/bootstrap.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/vendor/fancybox/dist/jquery.fancybox.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('sticky', get_template_directory_uri() . '/assets/vendor/sticky-kit/dist/sticky-kit.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('jarallax', get_template_directory_uri() . '/assets/vendor/jarallax/dist/jarallax.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/vendor/isotope-layout/dist/isotope.pkgd.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/vendor/swiper/dist/js/swiper.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('bootstrap-select', get_template_directory_uri() . '/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('popper', get_template_directory_uri() . '/assets/vendor/popper/dist/umd/popper.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('dropzone', get_template_directory_uri() . '/assets/vendor/dropzone/dist/min/dropzone.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('quill', get_template_directory_uri() . '/assets/vendor/quill/dist/quill.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('amdesk', get_template_directory_uri() . '/assets/js/amdesk-min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('amdesk-init', get_template_directory_uri() . '/assets/js/amdesk-init.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('datetimepicker', '//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js', array('jquery'), $banium_theme->version, true);
        wp_enqueue_script('calendar', get_template_directory_uri() . '/assets/js/calendar.js', array('jquery'), $banium_theme->version, true);
        wp_localize_script('calendar', 'wp_ajax_calendar', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }
}
add_action( 'wp_footer', 'custom_enqueue_script' );