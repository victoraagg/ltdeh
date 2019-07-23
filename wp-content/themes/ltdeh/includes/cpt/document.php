<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_custom_post_type_document() {

    $labels = [
        'name' => __('Documentos', 'ltdeh'),
        'singular_name' => __('Documento', 'ltdeh'),
        'add_new' => __('Insertar nuevo', 'ltdeh'),
        'add_new_item' => __('Insertar nuevo documento', 'ltdeh'),
        'edit_item' => __('Editar documento', 'ltdeh'),
        'new_item' => __('Nuevo documento', 'ltdeh'),
        'view_item' => __('Ver documento', 'ltdeh'),
        'search_items' => __('Buscar documento', 'ltdeh'),
        'not_found' => __('No hemos encontrado documentos', 'ltdeh'),
        'not_found_in_trash' => __('No hemos encontrado documentos en la papelera', 'ltdeh'),
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
        'rewrite' => array('slug' => 'documentos', 'with_front' => true),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'page-attributes'),
        'has_archive' => true
    ];

    register_post_type('document', $args);
}

add_action('after_setup_theme', 'ltdeh_custom_post_type_document');
