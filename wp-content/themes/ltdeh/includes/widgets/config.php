<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('widgets_init', 'iniciar_widgets');
function iniciar_widgets() {

    register_sidebar(
        array(
            'name' => 'General Sidebar',
            'id' => 'sidebar-general',
            'description' => 'Barra lateral general',
            'before_widget' => '<div class="dx-widget dx-box dx-box-decorated">',
            'after_widget' => '</div>',
            'before_title' => '<div class="dx-widget-title">',
            'after_title' => '</div>'
        )
    );

}