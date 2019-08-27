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
        'hierarchical' => false,
        'menu_position' => null,
        'show_admin_column' => true,
        'supports' => array('title', 'page-attributes'),
        'has_archive' => false,
        'capabilities' => array(
            'read_post' => 'read_book',
            'read_private_posts' => 'read_private_book',
            'edit_post' => 'edit_book',
            'edit_posts' => 'edit_books',
            'edit_others_posts' => 'edit_others_books',
            'edit_published_posts' => 'edit_published_books',
            'edit_private_posts' => 'edit_private_books',
            'delete_post' => 'delete_book',
            'delete_posts' => 'delete_books',
            'delete_others_posts' => 'delete_others_books',
            'delete_published_posts' => 'delete_published_books',
            'delete_private_posts' => 'delete_private_books',
            'publish_posts' => 'publish_books',
        ),
    ];

    register_post_type('book', $args);
}

add_action('after_setup_theme', 'ltdeh_custom_post_type_book');

function ltdeh_add_custom_caps() {
    $roles = array('subscriber', 'administrator');
    foreach($roles as $role){
        $role = get_role( $role );
        $role->add_cap( 'read' );
        $role->add_cap( 'read_book');
        $role->add_cap( 'read_private_books' );
        $role->add_cap( 'edit_book' );
        $role->add_cap( 'edit_books' );
        $role->add_cap( 'edit_others_books' );
        $role->add_cap( 'edit_published_books' );
        $role->add_cap( 'edit_private_books' );
        $role->add_cap( 'delete_book');
        $role->add_cap( 'delete_books');
        $role->add_cap( 'delete_others_books');
        $role->add_cap( 'delete_published_books' );
        $role->add_cap( 'delete_private_books' );
        $role->add_cap( 'publish_books' );
    }
}

add_action( 'admin_init', 'ltdeh_add_custom_caps');

//Estado en columnas de reservas
function show_book_active_column( $columns ) {
    $columns['_book_active'] = 'Activa';
    $columns['_book_site'] = 'Instalación';
    return $columns;
}
add_filter( 'manage_book_posts_columns', 'show_book_active_column' );

function custom_book_column( $column, $post_id ) {
    switch ( $column ) {
        case '_book_active' :
            echo get_post_meta( $post_id , '_book_active' , true ); 
            break;
        case '_book_site' :
            echo get_post_meta( $post_id , '_book_site' , true ); 
            break;
    }
}
add_action( 'manage_book_posts_custom_column' , 'custom_book_column', 10, 2 );