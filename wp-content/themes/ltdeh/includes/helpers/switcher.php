<?php
if (!defined('ABSPATH')) {
    exit;
}

function ltdeh_get_permalink($slug){

    if (defined('WP_DEBUG') && WP_DEBUG === false) {
        $environment = 'prod';
    }else{
        $environment = 'local';
    }

    switch ($slug) {
        case 'calendario':
            return get_permalink(96);
            break;
        case 'reserva':
            return get_permalink(120);
            break;
        case 'redsys':
            if ($environment == 'prod') {
                return get_permalink(429);
            }else{
                return get_permalink(252);
            }
            break;
        default:
            return get_permalink();
            break;
    }
    
}

function get_redsys_button_id($slug){

    if (defined('WP_DEBUG') && WP_DEBUG === false) {
        $environment = 'prod';
    }else{
        $environment = 'local';
    }

    switch ($slug) {
        case 'padel':
            if ($environment == 'prod') {
                return 425;
            }else{
                return 262;
            }
            break;
        case 'padel-luz':
            if ($environment == 'prod') {
                return 426;
            }else{
                return 208;
            }
            break;
        case 'pabellon-luz':
            if ($environment == 'prod') {
                return 428;
            }else{
                return 212;
            }
            break;
        case 'pabellon':
            if ($environment == 'prod') {
                return 427;
            }else{
                return 211;
            }
            break;
    }

}