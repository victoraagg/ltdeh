<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_custom_metabox_inscription() {
    add_meta_box(
        'inscription_members', 
        __('Inscritos', 'ltdeh'), 
        'ltdeh_custom_metabox_inscription_callback', 
        'inscription', 
        'advanced', 
        'default', 
        []
    );
}
add_action('add_meta_boxes_inscription', 'ltdeh_custom_metabox_inscription');

function ltdeh_custom_metabox_inscription_callback($post, $data) {
    $postMeta = get_post_meta($post->ID, 'inscription_members', true);
    $members = unserialize($postMeta);
    echo '<h1>Listado de inscritos ('.count($members).')</h1>';
    if(!empty($members)){
        foreach ($members as $key => $member) {
            foreach ($member as $key => $value) {
                if($key == 0){
                    echo '';
                }elseif($key == 2){
                    echo ' '.$value.'</span>';
                }elseif($key == 1){
                    echo ' <span>'.$value;
                }else{
                    echo ' - <span>'.$value.'</span>';
                }
            }
            echo '<br>';
        }
    }
}