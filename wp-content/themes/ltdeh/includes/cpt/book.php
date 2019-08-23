<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_custom_post_type_book() {

    $labels = [
        'name' => __('Reservas', 'ltdeh'),
        'singular_name' => __('Reserva', 'ltdeh'),
        'add_new' => __('Crear nueva', 'ltdeh'),
        'add_new_item' => __('Crear nueva reserva', 'ltdeh'),
        'edit_item' => __('Editar reserva', 'ltdeh'),
        'new_item' => __('Nueva reserva', 'ltdeh'),
        'view_item' => __('Ver reserva', 'ltdeh'),
        'search_items' => __('Buscar reserva', 'ltdeh'),
        'not_found' => __('No hemos encontrado reservas', 'ltdeh'),
        'not_found_in_trash' => __('No hemos encontrado reservas en la papelera', 'ltdeh'),
        'parent_item_colon' => ''
    ];

    $args = [
        'labels' => $labels,
        'menu_icon' => get_template_directory_uri().'/assets/images/icon-menu.png',
        'public' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'reservas', 'with_front' => true),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'page-attributes'),
        'has_archive' => false
    ];

    register_post_type('book', $args);
}

add_action('after_setup_theme', 'ltdeh_custom_post_type_book');
