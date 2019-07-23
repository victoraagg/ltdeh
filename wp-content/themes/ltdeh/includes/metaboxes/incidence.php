<?php
if (!defined('ABSPATH')) {
    exit;
}

//Dirección
function ltdeh_custom_metabox_incidence_direction() {
    add_meta_box(
        'incidence_direction', 
        __('Dirección de la incidencia', 'ltdeh'), 
        'ltdeh_custom_metabox_incidence_direction_callback', 
        'incidence', 
        'advanced', 
        'default', 
        []
    );
}
add_action('add_meta_boxes_incidence', 'ltdeh_custom_metabox_incidence_direction');

function ltdeh_custom_metabox_incidence_direction_callback($post, $data) {
    $postMeta = get_post_meta($post->ID);
    $mainPostId = $data['id'];
    $mainPostMetaValue = isset($postMeta['incidence_direction']) ? $postMeta['incidence_direction'][0] : '';
    echo '<input type="text" name="'.$mainPostId.'" value="'.$mainPostMetaValue.'" style="width: 100%;">';
}

function ltdeh_custom_metabox_incidence_direction_save($post_id, $post) {
    if (isset($_POST['incidence_direction'])){
        update_post_meta($post_id, 'incidence_direction', $_POST['incidence_direction']);
    }
}
add_action('save_post_incidence', 'ltdeh_custom_metabox_incidence_direction_save', 10, 2);

//Título
function ltdeh_custom_metabox_incidence_title() {
    add_meta_box(
        'incidence_title', 
        __('Título de la incidencia', 'ltdeh'), 
        'ltdeh_custom_metabox_incidence_title_callback', 
        'incidence', 
        'advanced', 
        'default', 
        []
    );
}
add_action('add_meta_boxes_incidence', 'ltdeh_custom_metabox_incidence_title');

function ltdeh_custom_metabox_incidence_title_callback($post, $data) {
    $postMeta = get_post_meta($post->ID);
    $mainPostId = $data['id'];
    $mainPostMetaValue = isset($postMeta['incidence_title']) ? $postMeta['incidence_title'][0] : '';
    echo '<input type="text" name="'.$mainPostId.'" value="'.$mainPostMetaValue.'" style="width: 100%;">';
}

function ltdeh_custom_metabox_incidence_title_save($post_id, $post) {
    if (isset($_POST['incidence_title'])){
        update_post_meta($post_id, 'incidence_title', $_POST['incidence_title']);
    }
}
add_action('save_post_incidence', 'ltdeh_custom_metabox_incidence_title_save', 10, 2);