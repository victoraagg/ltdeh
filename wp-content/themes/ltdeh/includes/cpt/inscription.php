<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_custom_post_type_inscription() {

    $labels = [
        'name' => __('Inscripciones', 'ltdeh'),
        'singular_name' => __('Inscripción', 'ltdeh'),
        'add_new' => __('Insertar nueva', 'ltdeh'),
        'add_new_item' => __('Insertar nueva inscripcion', 'ltdeh'),
        'edit_item' => __('Editar inscripcion', 'ltdeh'),
        'new_item' => __('Nueva inscripcion', 'ltdeh'),
        'view_item' => __('Ver inscripcion', 'ltdeh'),
        'search_items' => __('Buscar inscripcion', 'ltdeh'),
        'not_found' => __('No hemos encontrado inscripciones', 'ltdeh'),
        'not_found_in_trash' => __('No hemos encontrado inscripciones en la papelera', 'ltdeh'),
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
        'rewrite' => array('slug' => 'inscripciones', 'with_front' => true),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail', 'custom-fields'),
        'has_archive' => true
    ];

    register_post_type('inscription', $args);
}

add_action('after_setup_theme', 'ltdeh_custom_post_type_inscription');