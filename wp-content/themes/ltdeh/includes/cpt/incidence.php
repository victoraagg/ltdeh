<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_custom_post_type_incidence() {

    $labels = [
        'name' => __('Incidencias', 'ltdeh'),
        'singular_name' => __('Incidencia', 'ltdeh'),
        'add_new' => __('Insertar nueva', 'ltdeh'),
        'add_new_item' => __('Insertar nueva incidencia', 'ltdeh'),
        'edit_item' => __('Editar incidencia', 'ltdeh'),
        'new_item' => __('Nueva incidencia', 'ltdeh'),
        'view_item' => __('Ver incidencia', 'ltdeh'),
        'search_items' => __('Buscar incidencia', 'ltdeh'),
        'not_found' => __('No hemos encontrado incidencias', 'ltdeh'),
        'not_found_in_trash' => __('No hemos encontrado incidencias en la papelera', 'ltdeh'),
        'parent_item_colon' => ''
    ];

    $args = [
        'labels' => $labels,
        'menu_icon' => get_template_directory_uri().'/assets/images/icon-menu.png',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'incidencias', 'with_front' => true),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'page-attributes'),
        'has_archive' => true
    ];

    register_post_type('incidence', $args);
}

add_action('after_setup_theme', 'ltdeh_custom_post_type_incidence');
