<?php
if (!defined('ABSPATH')) {
    exit;
}

//Disable Admin Bar
function remove_admin_bar() {
    if (current_user_can('administrator') || current_user_can('editor')) {
        show_admin_bar(true);
    }else{
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');

// Thumbnails
add_theme_support('post-thumbnails');

// Enable shortcodes into widgets
add_filter('widget_text','do_shortcode');

// Menus
add_theme_support('menus');

//RSS support
add_theme_support('automatic-feed-links');

// Login page
add_action("login_head", "my_login_head");
function my_login_head() {
    echo "
	<style>
	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/assets/images/escudo.jpg') no-repeat scroll center top transparent;
		height: 135px;
		width: 135px;
	}
	</style>
	";
}
add_filter( 'login_headerurl', 'ltdeh_loginlogo_url' );
function ltdeh_loginlogo_url($url) {
    return get_site_url();
}

// Flush URL´s
add_action('init', 'ltdeh_rewrite_rules', 1);
function ltdeh_rewrite_rules() {
    global $wp_rewrite;
    $wp_rewrite->search_base = 'buscar';
    $wp_rewrite->pagination_base = 'pagina';
    $wp_rewrite->flush_rules();
}