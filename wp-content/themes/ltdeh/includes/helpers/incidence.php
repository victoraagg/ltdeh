<?php
if (!defined('ABSPATH')) {
    exit;
}

function get_status_incidence($post_id){
    $status_incidence = get_the_terms($post_id,'status_incidence');
    return $status_incidence[0]->name;
}