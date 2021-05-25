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