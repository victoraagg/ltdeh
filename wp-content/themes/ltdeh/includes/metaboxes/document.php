<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_custom_metabox_document_link_list() {
    add_meta_box(
        '_document_link', 
        __('Link de descarga', 'ltdeh'), 
        'ltdeh_custom_metabox_document_link_list_callback', 
        'document', 
        'advanced', 
        'default', 
        []
    );
}
add_action('add_meta_boxes_document', 'ltdeh_custom_metabox_document_link_list');

function ltdeh_custom_metabox_document_link_list_callback($post, $data) {
    $postMeta = get_post_meta($post->ID);
    $mainPostId = $data['id'];
    $mainPostMetaValue = isset($postMeta['_document_link']) ? $postMeta['_document_link'][0] : '';
    echo '<input type="text" name="'.$mainPostId.'" value="'.$mainPostMetaValue.'" style="width: 100%;">';
}

function ltdeh_custom_metabox_document_link_list_save($post_id, $post) {
    if (isset($_POST['_document_link'])){
        update_post_meta($post_id, '_document_link', $_POST['_document_link']);
    }
}
add_action('save_post_document', 'ltdeh_custom_metabox_document_link_list_save', 10, 2);