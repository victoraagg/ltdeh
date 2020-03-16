<?php
if (!defined('ABSPATH')) {
    exit;
}

function redsys_custom_post_type_button_redsys() {

    $labels = [
        'name' => __('Botones pago', 'btb_redsys'),
        'singular_name' => __('Botón', 'btb_redsys'),
        'add_new' => __('Crear nuevo', 'btb_redsys'),
        'add_new_item' => __('Crear nuevo botón', 'btb_redsys'),
        'edit_item' => __('Editar botón', 'btb_redsys'),
        'new_item' => __('Nuevo botón', 'btb_redsys'),
        'view_item' => __('Ver botón', 'btb_redsys'),
        'search_items' => __('Buscar botón', 'btb_redsys'),
        'not_found' => __('No hemos encontrado botones', 'btb_redsys'),
        'not_found_in_trash' => __('No hemos encontrado botones en la papelera', 'btb_redsys'),
        'parent_item_colon' => ''
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'botones', 'with_front' => true),
        'hierarchical' => false,
        'menu_position' => null,
        'show_admin_column' => true,
        'supports' => array('title'),
        'has_archive' => false,
    ];

    register_post_type('button_redsys', $args);

}
add_action('after_setup_theme', 'redsys_custom_post_type_button_redsys');

function redsys_custom_metabox_price() {
    add_meta_box(
        '_button_price', 
        __('Precio', 'btb_redsys'), 
        'redsys_custom_metabox_button_price_callback', 
        'button_redsys', 
        'advanced', 
        'default', 
        []
    );
    add_meta_box(
        '_button_shortcode', 
        __('ShortCode', 'btb_redsys'), 
        'redsys_custom_metabox_button_shortcode_callback', 
        'button_redsys', 
        'advanced', 
        'default', 
        []
    );
}
add_action('add_meta_boxes_button_redsys', 'redsys_custom_metabox_price');

function redsys_custom_metabox_button_price_callback($post, $data) {
    $_button_price = get_post_meta($post->ID, '_button_price', true);
    echo '<input type="text" name="_button_price" value="'.$_button_price.'">';
}

function redsys_custom_metabox_button_shortcode_callback($post, $data) {
    echo '<input readonly type="text" name="_button_shortcode" value="[redsysbutton id='.$post->ID.']">';
}

function redsys_custom_metabox_button_price_save($post_id, $post) {
    if (isset($_POST['_button_price'])){
        update_post_meta($post_id, '_button_price', $_POST['_button_price']);
    }
}
add_action('save_post_button_redsys', 'redsys_custom_metabox_button_price_save', 10, 2);