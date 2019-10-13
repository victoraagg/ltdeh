<?php
if (!defined('ABSPATH')) {
    exit;
}

register_nav_menus(
    array(
        'top_menu' => 'Menú de cabecera',
        'canvas_menu' => 'Menú off canvas',
        'footer_menu' => 'Menú de pié',
    )
);

function ltdeh_admin_menu(){
    add_menu_page( 
        'Notificaciones',
        'Notificaciones',
        'manage_options',
        'notificaciones',
        'notificaciones_page',
        'dashicons-share',
        6
    ); 
}
add_action( 'admin_menu', 'ltdeh_admin_menu' );

function notificaciones_page(){
    echo '<h1>Suscripciones a notificaciones</h1>';
    $subscriptions = get_option( 'subscriptions_phone' );
    if($subscriptions){
        $numbers = unserialize($subscriptions);
        echo '<h2>Total de suscripciones: '.count($numbers).'</h2>';
        foreach ($numbers as $number) {
            echo '<p>'.$number.'</p>';
        }
    }
}