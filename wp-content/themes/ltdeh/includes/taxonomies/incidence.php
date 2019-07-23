<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'create_incidence_tax', 0);
function create_incidence_tax() {

    //Estado
    $labels = array(
        'name' => _x( 'Estado', 'taxonomy general name' ),
        'singular_name' => _x( 'Estado', 'taxonomy singular name' ),
        'search_items' =>  __( 'Buscar por estado' ),
        'all_items' => __( 'Todos los estados' ),
        'parent_item' => __( 'Estado padre' ),
        'parent_item_colon' => __( 'Estado padre:' ),
        'edit_item' => __( 'Editar estado' ),
        'update_item' => __( 'Actualizar estado' ),
        'add_new_item' => __( 'Añadir nuevo estado' ),
        'new_item_name' => __( 'Nombre del nuevo estado' )
    ); 
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
    );
    register_taxonomy( 'status_incidence', array( 'incidence' ), $args);

}